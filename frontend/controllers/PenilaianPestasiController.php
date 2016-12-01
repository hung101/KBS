<?php

namespace frontend\controllers;

use Yii;
use app\models\PenilaianPestasi;
use app\models\PenilaianPestasiSearch;
use app\models\PenilaianPrestasiAtletSasaran;
use frontend\models\PenilaianPrestasiAtletSasaranSearch;
use app\models\MsnLaporan;
use app\models\MsnLaporanAcaraKejohananTemasya;
use app\models\AtletPencapaian;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\helpers\BaseUrl;
use yii\web\Session;

use app\models\general\GeneralVariable;
use app\models\general\Upload;
use common\models\general\GeneralFunction;

// table reference
use app\models\Atlet;
use app\models\RefKategoriKecergasan;
use app\models\RefKejohanan;
use app\models\RefSukan;
use app\models\RefAcara;
use app\models\RefProgramSemasaSukanAtlet;
use app\models\PerancanganProgram;
use app\models\RefJenisAktiviti;
use app\models\RefNegeri;

/**
 * PenilaianPestasiController implements the CRUD actions for PenilaianPestasi model.
 */
class PenilaianPestasiController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all PenilaianPestasi models.Jurulatih::findOne($id)
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $searchModel = new PenilaianPestasiSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PenilaianPestasi model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = $this->findModel($id);
        
        $ref = Atlet::findOne(['atlet_id' => $model->atlet_id]);
        $model->atlet_id = $ref['nameAndIC'];
        
        $ref = RefKategoriKecergasan::findOne(['id' => $model->kategori_kecergasan]);
        $model->kategori_kecergasan = $ref['desc'];
        
        //$ref = RefKejohanan::findOne(['id' => $model->kejohanan]);
        //$model->kejohanan = $ref['desc'];
        
        $ref = RefSukan::findOne(['id' => $model->sukan]);
        $model->sukan = $ref['desc'];
        
        $ref = RefAcara::findOne(['id' => $model->acara]);
        $model->acara = $ref['desc'];
        
        $ref = PerancanganProgram::findOne(['perancangan_program_id' => $model->kejohanan]);
        $model->kejohanan = $ref['nama_program'];
        
        $ref = RefProgramSemasaSukanAtlet::findOne(['id' => $model->program]);
        $model->program = $ref['desc'];
        
        $ref = RefNegeri::findOne(['id' => $model->negeri]);
        $model->negeri = $ref['desc'];
        
        $queryPar = null;
        
        $queryPar['PenilaianPrestasiAtletSasaranSearch']['penilaian_pestasi_id'] = $id;
        
        $searchModelPenilaianPrestasiAtletSasaran  = new PenilaianPrestasiAtletSasaranSearch();
        $dataProviderPenilaianPrestasiAtletSasaran = $searchModelPenilaianPrestasiAtletSasaran->search($queryPar);
        
        return $this->render('view', [
            'model' => $model,
            'searchModelPenilaianPrestasiAtletSasaran' => $searchModelPenilaianPrestasiAtletSasaran,
            'dataProviderPenilaianPrestasiAtletSasaran' => $dataProviderPenilaianPrestasiAtletSasaran,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new PenilaianPestasi model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->isGuest) {
            $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new PenilaianPestasi();
        
        $queryPar = null;
        
        Yii::$app->session->open();
        
        if(isset(Yii::$app->session->id)){
            $queryPar['PenilaianPrestasiAtletSasaranSearch']['session_id'] = Yii::$app->session->id;
        }
        
        $searchModelPenilaianPrestasiAtletSasaran  = new PenilaianPrestasiAtletSasaranSearch();
        $dataProviderPenilaianPrestasiAtletSasaran = $searchModelPenilaianPrestasiAtletSasaran->search($queryPar);
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $file = UploadedFile::getInstance($model, 'laporan_kesihatan');
            if($file){
                $model->laporan_kesihatan = Upload::uploadFile($file, Upload::pernilaianPrestasiFolder, $model->penilaian_pestasi_id);
            }
            
            if(isset(Yii::$app->session->id)){
                PenilaianPrestasiAtletSasaran::updateAll(['penilaian_pestasi_id' => $model->penilaian_pestasi_id], 'session_id = "'.Yii::$app->session->id.'"');
                PenilaianPrestasiAtletSasaran::updateAll(['session_id' => ''], 'penilaian_pestasi_id = "'.$model->penilaian_pestasi_id.'"');
            }
            
            // update atlet profil Pencapaian
            $modelAtletSasarans = PenilaianPrestasiAtletSasaran::findAll([
                    'penilaian_pestasi_id' => $model->penilaian_pestasi_id,
                ]);
            
            foreach($modelAtletSasarans as $modelAtletSasaran){
                $modelAtletPencapaian = null;
                if (($modelAtletPencapaian = AtletPencapaian::find()->where(['atlet_id'=>$modelAtletSasaran->atlet])->andWhere(['penilaian_pestasi_id'=>$model->penilaian_pestasi_id])->one()) == null) {
                    $modelAtletPencapaian = new AtletPencapaian();
                }
                
                $refPerancanganProgram = PerancanganProgram::findOne(['perancangan_program_id' => $model->kejohanan]);
        
                $modelAtletPencapaian->atlet_id = $modelAtletSasaran->atlet;
                $modelAtletPencapaian->nama_kejohanan_temasya = $refPerancanganProgram['nama_program'];
                $modelAtletPencapaian->nama_sukan = $model->sukan;
                $modelAtletPencapaian->nama_acara = $model->acara;
                $modelAtletPencapaian->tarikh_mula_kejohanan = $refPerancanganProgram['tarikh_mula'];
                $modelAtletPencapaian->tarikh_tamat_kejohanan = $refPerancanganProgram['tarikh_tamat'];
                $modelAtletPencapaian->lokasi_kejohanan = $refPerancanganProgram['lokasi'];
                $modelAtletPencapaian->penilaian_pestasi_id = $model->penilaian_pestasi_id;
                $modelAtletPencapaian->penilaian_prestasi_atlet_sasaran_id = $modelAtletSasaran->penilaian_prestasi_atlet_sasaran_id;
                $modelAtletPencapaian->pencapaian = $modelAtletSasaran->keputusan;
                $modelAtletPencapaian->save();
            }
            
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->penilaian_pestasi_id]);
            }
        }
        
        return $this->render('create', [
            'model' => $model,
            'searchModelPenilaianPrestasiAtletSasaran' => $searchModelPenilaianPrestasiAtletSasaran,
            'dataProviderPenilaianPrestasiAtletSasaran' => $dataProviderPenilaianPrestasiAtletSasaran,
            'readonly' => false,
        ]);
    }

    /**
     * Updates an existing PenilaianPestasi model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if (Yii::$app->user->isGuest) {
            $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = $this->findModel($id);
        
        $queryPar = null;
        
        $queryPar['PenilaianPrestasiAtletSasaranSearch']['penilaian_pestasi_id'] = $id;
        
        $searchModelPenilaianPrestasiAtletSasaran  = new PenilaianPrestasiAtletSasaranSearch();
        $dataProviderPenilaianPrestasiAtletSasaran = $searchModelPenilaianPrestasiAtletSasaran->search($queryPar);

        if ($model->load(Yii::$app->request->post())) {
            $file = UploadedFile::getInstance($model, 'laporan_kesihatan');
            if($file){
                $model->laporan_kesihatan = Upload::uploadFile($file, Upload::pernilaianPrestasiFolder, $model->penilaian_pestasi_id);
            }
            
            // update atlet profil Pencapaian
            $modelAtletSasarans = PenilaianPrestasiAtletSasaran::findAll([
                    'penilaian_pestasi_id' => $model->penilaian_pestasi_id,
                ]);
            
            foreach($modelAtletSasarans as $modelAtletSasaran){
                $modelAtletPencapaian = null;
                if (($modelAtletPencapaian = AtletPencapaian::find()->where(['atlet_id'=>$modelAtletSasaran->atlet])->andWhere(['penilaian_pestasi_id'=>$model->penilaian_pestasi_id])->one()) == null) {
                    $modelAtletPencapaian = new AtletPencapaian();
                }
                
                $refPerancanganProgram = PerancanganProgram::findOne(['perancangan_program_id' => $model->kejohanan]);
        
                $modelAtletPencapaian->atlet_id = $modelAtletSasaran->atlet;
                $modelAtletPencapaian->nama_kejohanan_temasya = $refPerancanganProgram['nama_program'];
                $modelAtletPencapaian->nama_sukan = $model->sukan;
                $modelAtletPencapaian->nama_acara = $model->acara;
                $modelAtletPencapaian->tarikh_mula_kejohanan = $refPerancanganProgram['tarikh_mula'];
                $modelAtletPencapaian->tarikh_tamat_kejohanan = $refPerancanganProgram['tarikh_tamat'];
                $modelAtletPencapaian->lokasi_kejohanan = $refPerancanganProgram['lokasi'];
                $modelAtletPencapaian->penilaian_pestasi_id = $model->penilaian_pestasi_id;
                $modelAtletPencapaian->penilaian_prestasi_atlet_sasaran_id = $modelAtletSasaran->penilaian_prestasi_atlet_sasaran_id;
                $modelAtletPencapaian->pencapaian = $modelAtletSasaran->keputusan;
                $modelAtletPencapaian->save();
            }
            
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->penilaian_pestasi_id]);
            }
        } else {
            return $this->render('update', [
                'model' => $model,
                'searchModelPenilaianPrestasiAtletSasaran' => $searchModelPenilaianPrestasiAtletSasaran,
                'dataProviderPenilaianPrestasiAtletSasaran' => $dataProviderPenilaianPrestasiAtletSasaran,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Deletes an existing PenilaianPestasi model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if (Yii::$app->user->isGuest) {
            $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        // delete upload file
        self::actionDeleteupload($id, 'laporan_kesihatan');
        
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
    
    public function actionSetSukan($sukan_id){
        
        $session = new Session;
        $session->open();

        $session['penilaian-pestasi_sukan_id'] = $sukan_id;
        
        $session->close();
    }

    /**
     * Finds the PenilaianPestasi model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PenilaianPestasi the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PenilaianPestasi::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    // Add function for delete image or file
    public function actionDeleteupload($id, $field)
    {
        if (Yii::$app->user->isGuest) {
            $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
            $img = $this->findModel($id)->$field;
            
            if($img){
                if (!unlink($img)) {
                    return false;
                }
            }

            $img = $this->findModel($id);
            $img->$field = NULL;
            $img->update();

            return $this->redirect(['update', 'id' => $id]);
    }
    
    public function actionLaporanJumlahPingatMengikutAcara()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new MsnLaporan();
        $model->format = 'html';

        if ($model->load(Yii::$app->request->post())) {
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-laporan-jumlah-pingat-mengikut-acara'
                    , 'kejohanan' => $model->kejohanan
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-laporan-jumlah-pingat-mengikut-acara'
                    , 'kejohanan' => $model->kejohanan
                    , 'format' => $model->format
                ]);
            }
        } 

        return $this->render('laporan_jumlah_pingat_mengikut_acara', [
            'model' => $model,
            'readonly' => false,
        ]);
    }
    
    public function actionGenerateLaporanJumlahPingatMengikutAcara($kejohanan, $format)
    {
        if($kejohanan == "") $kejohanan = array();
        else $kejohanan = array($kejohanan);
        
        $controls = array(
            'KEJOHANAN' => $kejohanan,
        );
        
        GeneralFunction::generateReport('/spsb/MSN/LaporanJumlahPingatMengikutAcara', $format, $controls, 'laporan_jumlah_pingat_mengikut_acara');
    }
    
    public function actionLaporanAcaraKejohananTemasya()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new MsnLaporanAcaraKejohananTemasya();
        $model->format = 'html';

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-laporan-acara-kejohanan-temasya'
                    , 'kejohanan' => $model->kejohanan
                    , 'temasya' => $model->temasya
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-laporan-acara-kejohanan-temasya'
                    , 'kejohanan' => $model->kejohanan
                    , 'temasya' => $model->temasya
                    , 'format' => $model->format
                ]);
            }
        } 

        return $this->render('laporan_acara_kejohanan_temasya', [
            'model' => $model,
            'readonly' => false,
        ]);
    }
    
    public function actionGenerateLaporanAcaraKejohananTemasya($kejohanan, $temasya, $format)
    {
        if($kejohanan == "") $kejohanan = array();
        else $kejohanan = array($kejohanan);
        
        if($temasya == "") $temasya = array();
        else $temasya = array($temasya);
        
        $controls = array(
            'KEJOHANAN' => $kejohanan,
            'TEMASYA' => $kejohanan,
        );
        
        GeneralFunction::generateReport('/spsb/MSN/LaporanAcaraKejohananTemasya', $format, $controls, 'laporan_acara_kejohanan_temasya');
    }
    
    public function actionLaporanJumlahPingatMengikutNegeri()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new MsnLaporan();
        $model->format = 'html';

        if ($model->load(Yii::$app->request->post())) {
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-laporan-jumlah-pingat-mengikut-negeri'
                    , 'kejohanan' => $model->kejohanan
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-laporan-jumlah-pingat-mengikut-negeri'
                    , 'kejohanan' => $model->kejohanan
                    , 'format' => $model->format
                ]);
            }
        } 

        return $this->render('laporan_jumlah_pingat_mengikut_negeri', [
            'model' => $model,
            'readonly' => false,
        ]);
    }
    
    public function actionGenerateLaporanJumlahPingatMengikutNegeri($kejohanan, $format)
    {
        if($kejohanan == "") $kejohanan = array();
        else $kejohanan = array($kejohanan);
        
        $controls = array(
            'KEJOHANAN' => $kejohanan,
        );
        
        GeneralFunction::generateReport('/spsb/MSN/LaporanJumlahPingatMengikutNegeri', $format, $controls, 'laporan_jumlah_pingat_mengikut_negeri');
    }
    
    public function actionLaporanRekodBaru()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new MsnLaporan();
        $model->format = 'html';

        if ($model->load(Yii::$app->request->post())) {
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-laporan-rekod-baru'
                    , 'kejohanan' => $model->kejohanan
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-laporan-rekod-baru'
                    , 'kejohanan' => $model->kejohanan
                    , 'format' => $model->format
                ]);
            }
        } 

        return $this->render('laporan_rekod_baru', [
            'model' => $model,
            'readonly' => false,
        ]);
    }
    
    public function actionGenerateLaporanRekodBaru($kejohanan, $format)
    {
        if($kejohanan == "") $kejohanan = array();
        else $kejohanan = array($kejohanan);
        
        $controls = array(
            'KEJOHANAN' => $kejohanan,
        );
        
        GeneralFunction::generateReport('/spsb/MSN/LaporanRekodBaru', $format, $controls, 'laporan_rekod_baru');
    }
    
    public function actionLaporanPenyertaanKontinjen()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new MsnLaporan();
        $model->format = 'html';

        if ($model->load(Yii::$app->request->post())) {
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-laporan-penyertaan-kontinjen'
                    , 'kejohanan' => $model->kejohanan
                    , 'temasya' => $model->temasya
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-laporan-penyertaan-kontinjen'
                    , 'kejohanan' => $model->kejohanan
                    , 'temasya' => $model->temasya
                    , 'format' => $model->format
                ]);
            }
        } 

        return $this->render('laporan_penyertaan_kontinjen', [
            'model' => $model,
            'readonly' => false,
        ]);
    }
    
    public function actionGenerateLaporanPenyertaanKontinjen($kejohanan, $temasya, $format)
    {
        if($kejohanan == "") $kejohanan = array();
        else $kejohanan = array($kejohanan);
        
        if($temasya == "") $temasya = array();
        else $temasya = array($temasya);
        
        $controls = array(
            'KEJOHANAN' => $kejohanan,
            'TEMASYA' => $kejohanan,
        );
        
        GeneralFunction::generateReport('/spsb/MSN/LaporanPenyertaanKontinjen', $format, $controls, 'laporan_penyertaan_kontinjen');
    }
}
