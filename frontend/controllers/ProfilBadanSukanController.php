<?php

namespace frontend\controllers;

use Yii;
use app\models\ProfilBadanSukan;
use app\models\ProfilBadanSukanSearch;
use app\models\PjsLaporanAhliJawatankuasaInduk;
use app\models\PjsLaporanAhliJawatankuasaKecilBiro;
use app\models\PjsLaporanBadanSukan;
use app\models\PjsLaporanPenganjuranAcara;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\helpers\Json;
use yii\helpers\BaseUrl;

use app\models\general\Upload;
use app\models\general\GeneralVariable;
use common\models\general\GeneralFunction;

// table reference
use app\models\RefPeringkatBadanSukan;
use app\models\RefSukan;
use app\models\RefNegeri;
use app\models\RefBandar;

/**
 * ProfilBadanSukanController implements the CRUD actions for ProfilBadanSukan model.
 */
class ProfilBadanSukanController extends Controller
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
     * Lists all ProfilBadanSukan models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $queryPar = Yii::$app->request->queryParams;
        
        if(Yii::$app->user->identity->profil_badan_sukan){
            $queryPar['ProfilBadanSukanSearch']['profil_badan_sukan'] = Yii::$app->user->identity->profil_badan_sukan;
        }
        
        $searchModel = new ProfilBadanSukanSearch();
        $dataProvider = $searchModel->search($queryPar);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ProfilBadanSukan model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = $this->findModel($id);
        
        $ref = RefPeringkatBadanSukan::findOne(['id' => $model->peringkat_badan_sukan]);
        $model->peringkat_badan_sukan = $ref['desc'];
        
        $ref = RefSukan::findOne(['id' => $model->jenis_sukan]);
        $model->jenis_sukan = $ref['desc'];
        
        $ref = RefNegeri::findOne(['id' => $model->alamat_tetap_badan_sukan_negeri]);
        $model->alamat_tetap_badan_sukan_negeri = $ref['desc'];
        
        $ref = RefBandar::findOne(['id' => $model->alamat_tetap_badan_sukan_bandar]);
        $model->alamat_tetap_badan_sukan_bandar = $ref['desc'];
        
        $ref = RefNegeri::findOne(['id' => $model->alamat_surat_menyurat_badan_sukan_negeri]);
        $model->alamat_surat_menyurat_badan_sukan_negeri = $ref['desc'];
        
        $ref = RefBandar::findOne(['id' => $model->alamat_surat_menyurat_badan_sukan_bandar]);
        $model->alamat_surat_menyurat_badan_sukan_bandar = $ref['desc'];
        
        $model->tarikh_lulus_pendaftaran = GeneralFunction::convert($model->tarikh_lulus_pendaftaran);
        
        return $this->render('view', [
            'model' => $model,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new ProfilBadanSukan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new ProfilBadanSukan();
        
        if($model->load(Yii::$app->request->post())){
            $file = UploadedFile::getInstance($model, 'no_pendaftaran_sijil_pendaftaran');

            if($file){
                $model->no_pendaftaran_sijil_pendaftaran = "uploadlater";
            }
        }

        if (Yii::$app->request->post() && $model->save()) {
            $file = UploadedFile::getInstance($model, 'no_pendaftaran_sijil_pendaftaran');
            if($file){
                $model->no_pendaftaran_sijil_pendaftaran = Upload::uploadFile($file, Upload::profilBadanSukanFolder, $model->profil_badan_sukan);
            }
            
            $file = UploadedFile::getInstance($model, 'muat_naik_perlembagaan_terkini');
            if($file){
                $model->muat_naik_perlembagaan_terkini = Upload::uploadFile($file, Upload::profilBadanSukanFolder, 'muat_naik_perlembagaan_terkini-' . $model->profil_badan_sukan);
            }
            
            $file = UploadedFile::getInstance($model, 'gambar');
            if($file){
                $model->gambar = Upload::uploadFile($file, Upload::profilBadanSukanFolder, 'gambar-' . $model->profil_badan_sukan);
            }
            
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->profil_badan_sukan]);
            }
        } 
        
        return $this->render('create', [
                'model' => $model,
                'readonly' => false,
            ]);
    }

    /**
     * Updates an existing ProfilBadanSukan model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = $this->findModel($id);
        
        if($model->load(Yii::$app->request->post())){
            $file = UploadedFile::getInstance($model, 'no_pendaftaran_sijil_pendaftaran');

            if($file){
                $model->no_pendaftaran_sijil_pendaftaran = "uploadlater";
            }
        }

        if (Yii::$app->request->post() && $model->save()) {
            $file = UploadedFile::getInstance($model, 'no_pendaftaran_sijil_pendaftaran');
            if($file){
                $model->no_pendaftaran_sijil_pendaftaran = Upload::uploadFile($file, Upload::profilBadanSukanFolder, $model->profil_badan_sukan);
            }
            
            $file = UploadedFile::getInstance($model, 'muat_naik_perlembagaan_terkini');
            if($file){
                $model->muat_naik_perlembagaan_terkini = Upload::uploadFile($file, Upload::profilBadanSukanFolder, 'muat_naik_perlembagaan_terkini-' . $model->profil_badan_sukan);
            }
            
            $file = UploadedFile::getInstance($model, 'gambar');
            if($file){
                $model->gambar = Upload::uploadFile($file, Upload::profilBadanSukanFolder, 'gambar-' . $model->profil_badan_sukan);
            }
            
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->profil_badan_sukan]);
            }
        } 
        
        return $this->render('update', [
                'model' => $model,
                'readonly' => false,
            ]);
    }

    /**
     * Deletes an existing ProfilBadanSukan model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        // delete upload file
        self::actionDeleteupload($id, 'no_pendaftaran_sijil_pendaftaran');
        
        self::actionDeleteupload($id, 'muat_naik_perlembagaan_terkini');
        
        self::actionDeleteupload($id, 'gambar');
        
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ProfilBadanSukan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ProfilBadanSukan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ProfilBadanSukan::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    // Add function for delete image or file
    public function actionDeleteupload($id, $field)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
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
    
    public function actionGetBadanSukan($id){
        // find Ahli Jawatankuasa Induk
        $model = ProfilBadanSukan::find()->where(['profil_badan_sukan' => $id])->asArray()->one();
        
        echo Json::encode($model);
    }
    
    public function actionLaporanAhliJawatankuasaInduk()
    {

        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new PjsLaporanAhliJawatankuasaInduk();
        $model->format = 'html';

        if ($model->load(Yii::$app->request->post())) {
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-laporan-ahli-jawatankuasa-induk'
                    , 'bangsa' => $model->bangsa
                    , 'jantina' => $model->jantina
                    , 'umur_dari' => $model->umur_dari
                    , 'umur_hingga' => $model->umur_hingga
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-laporan-ahli-jawatankuasa-induk'
                    , 'bangsa' => $model->bangsa
                    , 'jantina' => $model->jantina
                    , 'umur_dari' => $model->umur_dari
                    , 'umur_hingga' => $model->umur_hingga
                    , 'format' => $model->format
                ]);
            }
        } 

        return $this->render('laporan_ahli_jawatankuasa_induk', [
            'model' => $model,
            'readonly' => false,
        ]);
    }

    public function actionGenerateLaporanAhliJawatankuasaInduk($bangsa, $jantina, $umur_dari, $umur_hingga, $format)
    {
        if($bangsa == "") $bangsa = array();
        else $bangsa = array($bangsa);
        
        if($jantina == "") $jantina = array();
        else $jantina = array($jantina);
        
        if($umur_dari == "") $umur_dari = array();
        else $umur_dari = array($umur_dari);
        
        if($umur_hingga == "") $umur_hingga = array();
        else $umur_hingga = array($umur_hingga);
        
        $controls = array(
            'BANGSA' => $bangsa,
            'JANTINA' => $jantina,
            'UMUR_FROM' => $umur_dari,
            'UMUR_TO' => $umur_hingga,
        );
        
        GeneralFunction::generateReport('/spsb/PJS/LaporanAhliJawatankuasaInduk', $format, $controls, 'laporan_ahli_jawatankuasa_induk');
    }
    
    public function actionLaporanAhliJawatankuasaKecilBiro()
    {

        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new PjsLaporanAhliJawatankuasaKecilBiro();
        $model->format = 'html';

        if ($model->load(Yii::$app->request->post())) {
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-laporan-ahli-jawatankuasa-kecil-biro'
                    , 'bangsa' => $model->bangsa
                    , 'jantina' => $model->jantina
                    , 'umur_dari' => $model->umur_dari
                    , 'umur_hingga' => $model->umur_hingga
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-laporan-ahli-jawatankuasa-kecil-biro'
                    , 'bangsa' => $model->bangsa
                    , 'jantina' => $model->jantina
                    , 'umur_dari' => $model->umur_dari
                    , 'umur_hingga' => $model->umur_hingga
                    , 'format' => $model->format
                ]);
            }
        } 

        return $this->render('laporan_ahli_jawatankuasa_kecil_biro', [
            'model' => $model,
            'readonly' => false,
        ]);
    }
    
    public function actionGenerateLaporanAhliJawatankuasaKecilBiro($bangsa, $jantina, $umur_dari, $umur_hingga, $format)
    {
        if($bangsa == "") $bangsa = array();
        else $bangsa = array($bangsa);
        
        if($jantina == "") $jantina = array();
        else $jantina = array($jantina);
        
        if($umur_dari == "") $umur_dari = array();
        else $umur_dari = array($umur_dari);
        
        if($umur_hingga == "") $umur_hingga = array();
        else $umur_hingga = array($umur_hingga);
        
        $controls = array(
            'BANGSA' => $bangsa,
            'JANTINA' => $jantina,
            'UMUR_FROM' => $umur_dari,
            'UMUR_TO' => $umur_hingga,
        );
        
        GeneralFunction::generateReport('/spsb/PJS/LaporanAhliJawatankuasaInduk_1', $format, $controls, 'laporan_ahli_jawatankuasa_kecil_biro');
    }
    
    public function actionLaporanBadanSukan()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new PjsLaporanBadanSukan();
        $model->format = 'html';

        if ($model->load(Yii::$app->request->post())) {
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-laporan-badan-sukan'
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-laporan-badan-sukan'
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'format' => $model->format
                ]);
            }
        } 

        return $this->render('laporan_badan_sukan', [
            'model' => $model,
            'readonly' => false,
        ]);
    }
    
    public function actionGenerateLaporanBadanSukan($tarikh_dari, $tarikh_hingga, $format)
    {
        if($tarikh_dari == "") $tarikh_dari = array();
        else $tarikh_dari = array($tarikh_dari);
        
        if($tarikh_hingga == "") $tarikh_hingga = array();
        else $tarikh_hingga = array($tarikh_hingga);
        
        $controls = array(
            'FROM_DATE' => $tarikh_dari,
            'TO_DATE' => $tarikh_hingga,
        );
        
        GeneralFunction::generateReport('/spsb/PJS/LaporanBadanSukanMengikutTarikhPendaftaran', $format, $controls, 'laporan_badan_sukan');
    }
    
    public function actionLaporanPenganjuranAcara()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new PjsLaporanPenganjuranAcara();
        $model->format = 'html';

        if ($model->load(Yii::$app->request->post())) {
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-laporan-penganjuran-acara'
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'peringkat' => $model->peringkat
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-laporan-penganjuran-acara'
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'peringkat' => $model->peringkat
                    , 'format' => $model->format
                ]);
            }
        } 

        return $this->render('laporan_penganjuran_acara', [
            'model' => $model,
            'readonly' => false,
        ]);
    }
    
    public function actionGenerateLaporanPenganjuranAcara($tarikh_dari, $tarikh_hingga, $peringkat, $format)
    {
        if($tarikh_dari == "") $tarikh_dari = array();
        else $tarikh_dari = array($tarikh_dari);
        
        if($tarikh_hingga == "") $tarikh_hingga = array();
        else $tarikh_hingga = array($tarikh_hingga);
        
        if($peringkat == "") $peringkat = array();
        else $peringkat = array($peringkat);
        
        $controls = array(
            'FROM_DATE' => $tarikh_dari,
            'TO_DATE' => $tarikh_hingga,
            'PERINGKAT' => $peringkat,
        );
        
        GeneralFunction::generateReport('/spsb/PJS/LaporanPenganjuranAcara', $format, $controls, 'laporan_penganjuran_acara');
    }
}
