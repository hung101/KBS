<?php

namespace frontend\controllers;

use Yii;
use app\models\GajiDanElaunJurulatih;
use frontend\models\GajiDanElaunJurulatihSearch;
use app\models\ElaunJurulatih;
use frontend\models\ElaunJurulatihSearch;
use app\models\GajiJurulatih;
use frontend\models\GajiJurulatihSearch;
use app\models\JurulatihSukan;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\helpers\BaseUrl;
use app\models\MsnLaporan;
use app\models\MsnSuratTawaranAtlet;

use app\models\general\Upload;
use app\models\general\GeneralVariable;
use common\models\general\GeneralFunction;

// table reference
use app\models\Jurulatih;
use app\models\RefBank;
use app\models\RefSukan;
use app\models\RefProgramJurulatih;
use app\models\RefGajiElaunJurulatih;
use app\models\RefBahagianJurulatih;

/**
 * GajiDanElaunJurulatihController implements the CRUD actions for GajiDanElaunJurulatih model.
 */
class GajiDanElaunJurulatihController extends Controller
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
     * Lists all GajiDanElaunJurulatih models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $searchModel = new GajiDanElaunJurulatihSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single GajiDanElaunJurulatih model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = $this->findModel($id);
        
        $ref = Jurulatih::findOne(['jurulatih_id' => $model->nama_jurulatih]);
        $model->nama_jurulatih = $ref['nameAndIC'];
        
        $ref = RefBank::findOne(['id' => $model->bank]);
        $model->bank = $ref['desc'];
        
        $ref = RefProgramJurulatih::findOne(['id' => $model->program]);
        $model->program = $ref['desc'];
        
        $ref = RefSukan::findOne(['id' => $model->nama_sukan]);
        $model->nama_sukan = $ref['desc'];
        
        if($model->tarikh_mula != "") {$model->tarikh_mula = GeneralFunction::convert($model->tarikh_mula, GeneralFunction::TYPE_DATE);}
        if($model->tarikh_tamat != "") {$model->tarikh_tamat = GeneralFunction::convert($model->tarikh_tamat, GeneralFunction::TYPE_DATE);}
        
        $queryPar = null;
        
        $queryPar['ElaunJurulatihSearch']['gaji_dan_elaun_jurulatih_id'] = $id;
        $queryPar['GajiJurulatihSearch']['gaji_dan_elaun_jurulatih_id'] = $id;
        
        $searchModelElaunJurulatih = new ElaunJurulatihSearch();
        $dataProviderElaunJurulatih= $searchModelElaunJurulatih->search($queryPar);
        
        $searchModelGajiJurulatih = new GajiJurulatihSearch();
        $dataProviderGajiJurulatih= $searchModelGajiJurulatih->search($queryPar);
        
        return $this->render('view', [
            'model' => $model,
            'searchModelElaunJurulatih' => $searchModelElaunJurulatih,
            'dataProviderElaunJurulatih' => $dataProviderElaunJurulatih,
            'searchModelGajiJurulatih' => $searchModelGajiJurulatih,
            'dataProviderGajiJurulatih' => $dataProviderGajiJurulatih,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new GajiDanElaunJurulatih model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new GajiDanElaunJurulatih();
        
        $queryPar = null;
        
        Yii::$app->session->open();
        
        if(isset(Yii::$app->session->id)){
            $queryPar['ElaunJurulatihSearch']['session_id'] = Yii::$app->session->id;
            $queryPar['GajiJurulatihSearch']['session_id'] = Yii::$app->session->id;
        }
        
        $searchModelElaunJurulatih = new ElaunJurulatihSearch();
        $dataProviderElaunJurulatih= $searchModelElaunJurulatih->search($queryPar);
        
        $searchModelGajiJurulatih = new GajiJurulatihSearch();
        $dataProviderGajiJurulatih= $searchModelGajiJurulatih->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if(isset(Yii::$app->session->id)){
                ElaunJurulatih::updateAll(['gaji_dan_elaun_jurulatih_id' => $model->gaji_dan_elaun_jurulatih_id], 'session_id = "'.Yii::$app->session->id.'"');
                ElaunJurulatih::updateAll(['session_id' => ''], 'gaji_dan_elaun_jurulatih_id = "'.$model->gaji_dan_elaun_jurulatih_id.'"');
                
                GajiJurulatih::updateAll(['gaji_dan_elaun_jurulatih_id' => $model->gaji_dan_elaun_jurulatih_id], 'session_id = "'.Yii::$app->session->id.'"');
                GajiJurulatih::updateAll(['session_id' => ''], 'gaji_dan_elaun_jurulatih_id = "'.$model->gaji_dan_elaun_jurulatih_id.'"');
            }
            
            $file = UploadedFile::getInstance($model, 'dokumen_muat_naik');
            if($file){
                $model->dokumen_muat_naik = Upload::uploadFile($file, Upload::gajiDanElaunJurulatihFolder, $model->gaji_dan_elaun_jurulatih_id . 'dokumen_muat_naik');
            }
            
            $file = UploadedFile::getInstance($model, 'surat_tawaran');
            if($file){
                $model->surat_tawaran = Upload::uploadFile($file, Upload::gajiDanElaunJurulatihFolder, $model->gaji_dan_elaun_jurulatih_id . 'surat_tawaran');
            }
            
            $file = UploadedFile::getInstance($model, 'kelulusan_pinjaman');
            if($file){
                $model->kelulusan_pinjaman = Upload::uploadFile($file, Upload::gajiDanElaunJurulatihFolder, $model->gaji_dan_elaun_jurulatih_id . 'kelulusan_pinjaman');
            }
            
            $file = UploadedFile::getInstance($model, 'rekod_cuti');
            if($file){
                $model->rekod_cuti = Upload::uploadFile($file, Upload::gajiDanElaunJurulatihFolder, $model->gaji_dan_elaun_jurulatih_id . 'rekod_cuti');
            }
            
            // update jurulatih profil Sukan dan Program - Elaun
            $modelElaunJurulatihs = ElaunJurulatih::findAll([
                    'gaji_dan_elaun_jurulatih_id' => $model->gaji_dan_elaun_jurulatih_id,
                ]);
            
            foreach($modelElaunJurulatihs as $modelElaunJurulatih){
                $modelJurulatihSukan = null;
                if (($modelJurulatihSukan = JurulatihSukan::find()->where(['jurulatih_id'=>$model->nama_jurulatih])
                                                                    ->andWhere(['gaji_dan_elaun_jurulatih_id'=>$model->gaji_dan_elaun_jurulatih_id])
                                                                    ->andWhere(['gaji_elaun'=>RefGajiElaunJurulatih::ELAUN])
                                                                    ->andWhere(['elaun_jurulatih_id'=>$modelElaunJurulatih->elaun_jurulatih_id])->one()) == null) {
                    $modelJurulatihSukan = new JurulatihSukan();
                }
                $modelJurulatihSukan->jurulatih_id = $model->nama_jurulatih;
                $modelJurulatihSukan->tarikh_mula_lantikan = $modelElaunJurulatih->tarikh_mula;
                $modelJurulatihSukan->tarikh_tamat_lantikan = $modelElaunJurulatih->tarikh_tamat;
                $modelJurulatihSukan->jumlah = $modelElaunJurulatih->jumlah_elaun;
                $modelJurulatihSukan->program = $model->program;
                $modelJurulatihSukan->sukan = $model->nama_sukan;
                $modelJurulatihSukan->gaji_dan_elaun_jurulatih_id = $model->gaji_dan_elaun_jurulatih_id;
                $modelJurulatihSukan->elaun_jurulatih_id = $modelElaunJurulatih->elaun_jurulatih_id;
                $modelJurulatihSukan->gaji_elaun = RefGajiElaunJurulatih::ELAUN;
                
                $ref = RefProgramJurulatih::findOne(['id' => $model->program]);
                if($ref['cacat']){
                    //paralimpik
                    $modelJurulatihSukan->bahagian = RefBahagianJurulatih::PARALIMPIK;
                } else {
                    //atlet
                    $modelJurulatihSukan->bahagian = RefBahagianJurulatih::ATLET;
                }
                
                $modelJurulatihSukan->save();
            }
            
            // update jurulatih profil Sukan dan Program - Gaji
            $modelGajiJurulatihs = GajiJurulatih::findAll([
                    'gaji_dan_elaun_jurulatih_id' => $model->gaji_dan_elaun_jurulatih_id,
                ]);
            
            foreach($modelGajiJurulatihs as $modelGajiJurulatih){
                $modelJurulatihSukan = null;
                if (($modelJurulatihSukan = JurulatihSukan::find()->where(['jurulatih_id'=>$model->nama_jurulatih])
                                                                    ->andWhere(['gaji_dan_elaun_jurulatih_id'=>$model->gaji_dan_elaun_jurulatih_id])
                                                                    ->andWhere(['gaji_elaun'=>RefGajiElaunJurulatih::GAJI])
                                                                    ->andWhere(['gaji_jurulatih_id'=>$modelGajiJurulatih->gaji_jurulatih_id])->one()) == null) {
                    $modelJurulatihSukan = new JurulatihSukan();
                }
                $modelJurulatihSukan->jurulatih_id = $model->nama_jurulatih;
                $modelJurulatihSukan->tarikh_mula_lantikan = $modelGajiJurulatih->tarikh_mula;
                $modelJurulatihSukan->tarikh_tamat_lantikan = $modelGajiJurulatih->tarikh_tamat;
                $modelJurulatihSukan->jumlah = $modelGajiJurulatih->jumlah;
                $modelJurulatihSukan->program = $model->program;
                $modelJurulatihSukan->sukan = $model->nama_sukan;
                $modelJurulatihSukan->gaji_dan_elaun_jurulatih_id = $model->gaji_dan_elaun_jurulatih_id;
                $modelJurulatihSukan->gaji_jurulatih_id = $modelGajiJurulatih->gaji_jurulatih_id;
                $modelJurulatihSukan->gaji_elaun = RefGajiElaunJurulatih::GAJI;
                
                $ref = RefProgramJurulatih::findOne(['id' => $model->program]);
                if($ref['cacat']){
                    //paralimpik
                    $modelJurulatihSukan->bahagian = RefBahagianJurulatih::PARALIMPIK;
                } else {
                    //atlet
                    $modelJurulatihSukan->bahagian = RefBahagianJurulatih::ATLET;
                }
                
                $modelJurulatihSukan->save();
            }
            
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->gaji_dan_elaun_jurulatih_id]);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
                'searchModelElaunJurulatih' => $searchModelElaunJurulatih,
                'dataProviderElaunJurulatih' => $dataProviderElaunJurulatih,
                'searchModelGajiJurulatih' => $searchModelGajiJurulatih,
                'dataProviderGajiJurulatih' => $dataProviderGajiJurulatih,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Updates an existing GajiDanElaunJurulatih model.
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
        
        $queryPar = null;
        
        $queryPar['ElaunJurulatihSearch']['gaji_dan_elaun_jurulatih_id'] = $id;
        $queryPar['GajiJurulatihSearch']['gaji_dan_elaun_jurulatih_id'] = $id;
        
        $searchModelElaunJurulatih = new ElaunJurulatihSearch();
        $dataProviderElaunJurulatih= $searchModelElaunJurulatih->search($queryPar);
        
        $searchModelGajiJurulatih = new GajiJurulatihSearch();
        $dataProviderGajiJurulatih= $searchModelGajiJurulatih->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $file = UploadedFile::getInstance($model, 'dokumen_muat_naik');
            if($file){
                $model->dokumen_muat_naik = Upload::uploadFile($file, Upload::gajiDanElaunJurulatihFolder, $model->gaji_dan_elaun_jurulatih_id . 'dokumen_muat_naik');
            }
            
            $file = UploadedFile::getInstance($model, 'surat_tawaran');
            if($file){
                $model->surat_tawaran = Upload::uploadFile($file, Upload::gajiDanElaunJurulatihFolder, $model->gaji_dan_elaun_jurulatih_id . 'surat_tawaran');
            }
            
            $file = UploadedFile::getInstance($model, 'kelulusan_pinjaman');
            if($file){
                $model->kelulusan_pinjaman = Upload::uploadFile($file, Upload::gajiDanElaunJurulatihFolder, $model->gaji_dan_elaun_jurulatih_id . 'kelulusan_pinjaman');
            }
            
            $file = UploadedFile::getInstance($model, 'rekod_cuti');
            if($file){
                $model->rekod_cuti = Upload::uploadFile($file, Upload::gajiDanElaunJurulatihFolder, $model->gaji_dan_elaun_jurulatih_id . 'rekod_cuti');
            }
            
            // update jurulatih profil Sukan dan Program - Elaun
            $modelElaunJurulatihs = ElaunJurulatih::findAll([
                    'gaji_dan_elaun_jurulatih_id' => $model->gaji_dan_elaun_jurulatih_id,
                ]);
            
            foreach($modelElaunJurulatihs as $modelElaunJurulatih){
                $modelJurulatihSukan = null;
                if (($modelJurulatihSukan = JurulatihSukan::find()->where(['jurulatih_id'=>$model->nama_jurulatih])
                                                                    ->andWhere(['gaji_dan_elaun_jurulatih_id'=>$model->gaji_dan_elaun_jurulatih_id])
                                                                    ->andWhere(['gaji_elaun'=>RefGajiElaunJurulatih::ELAUN])
                                                                    ->andWhere(['elaun_jurulatih_id'=>$modelElaunJurulatih->elaun_jurulatih_id])->one()) == null) {
                    $modelJurulatihSukan = new JurulatihSukan();
                }
                $modelJurulatihSukan->jurulatih_id = $model->nama_jurulatih;
                $modelJurulatihSukan->tarikh_mula_lantikan = $modelElaunJurulatih->tarikh_mula;
                $modelJurulatihSukan->tarikh_tamat_lantikan = $modelElaunJurulatih->tarikh_tamat;
                $modelJurulatihSukan->jumlah = $modelElaunJurulatih->jumlah_elaun;
                $modelJurulatihSukan->program = $model->program;
                $modelJurulatihSukan->sukan = $model->nama_sukan;
                $modelJurulatihSukan->gaji_dan_elaun_jurulatih_id = $model->gaji_dan_elaun_jurulatih_id;
                $modelJurulatihSukan->elaun_jurulatih_id = $modelElaunJurulatih->elaun_jurulatih_id;
                $modelJurulatihSukan->gaji_elaun = RefGajiElaunJurulatih::ELAUN;
                
                $ref = RefProgramJurulatih::findOne(['id' => $model->program]);
                if($ref['cacat']){
                    //paralimpik
                    $modelJurulatihSukan->bahagian = RefBahagianJurulatih::PARALIMPIK;
                } else {
                    //atlet
                    $modelJurulatihSukan->bahagian = RefBahagianJurulatih::ATLET;
                }
                
                $modelJurulatihSukan->save();
            }
            
            // update jurulatih profil Sukan dan Program - Gaji
            $modelGajiJurulatihs = GajiJurulatih::findAll([
                    'gaji_dan_elaun_jurulatih_id' => $model->gaji_dan_elaun_jurulatih_id,
                ]);
            
            foreach($modelGajiJurulatihs as $modelGajiJurulatih){
                $modelJurulatihSukan = null;
                if (($modelJurulatihSukan = JurulatihSukan::find()->where(['jurulatih_id'=>$model->nama_jurulatih])
                                                                    ->andWhere(['gaji_dan_elaun_jurulatih_id'=>$model->gaji_dan_elaun_jurulatih_id])
                                                                    ->andWhere(['gaji_elaun'=>RefGajiElaunJurulatih::GAJI])
                                                                    ->andWhere(['gaji_jurulatih_id'=>$modelGajiJurulatih->gaji_jurulatih_id])->one()) == null) {
                    $modelJurulatihSukan = new JurulatihSukan();
                }
                $modelJurulatihSukan->jurulatih_id = $model->nama_jurulatih;
                $modelJurulatihSukan->tarikh_mula_lantikan = $modelGajiJurulatih->tarikh_mula;
                $modelJurulatihSukan->tarikh_tamat_lantikan = $modelGajiJurulatih->tarikh_tamat;
                $modelJurulatihSukan->jumlah = $modelGajiJurulatih->jumlah;
                $modelJurulatihSukan->program = $model->program;
                $modelJurulatihSukan->sukan = $model->nama_sukan;
                $modelJurulatihSukan->gaji_dan_elaun_jurulatih_id = $model->gaji_dan_elaun_jurulatih_id;
                $modelJurulatihSukan->gaji_jurulatih_id = $modelGajiJurulatih->gaji_jurulatih_id;
                $modelJurulatihSukan->gaji_elaun = RefGajiElaunJurulatih::GAJI;
                
                $ref = RefProgramJurulatih::findOne(['id' => $model->program]);
                if($ref['cacat']){
                    //paralimpik
                    $modelJurulatihSukan->bahagian = RefBahagianJurulatih::PARALIMPIK;
                } else {
                    //atlet
                    $modelJurulatihSukan->bahagian = RefBahagianJurulatih::ATLET;
                }
                
                $modelJurulatihSukan->save();
            }
            
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->gaji_dan_elaun_jurulatih_id]);
            }
        } else {
            return $this->render('update', [
                'model' => $model,
                'searchModelElaunJurulatih' => $searchModelElaunJurulatih,
                'dataProviderElaunJurulatih' => $dataProviderElaunJurulatih,
                'searchModelGajiJurulatih' => $searchModelGajiJurulatih,
                'dataProviderGajiJurulatih' => $dataProviderGajiJurulatih,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Deletes an existing GajiDanElaunJurulatih model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the GajiDanElaunJurulatih model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return GajiDanElaunJurulatih the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = GajiDanElaunJurulatih::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionLaporanKewanganElaunJurulatih()
    {

        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new MsnLaporan();
        $model->format = 'html';

        if ($model->load(Yii::$app->request->post())) {
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-laporan-kewangan-elaun-jurulatih'
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'sukan' => $model->sukan
                    , 'program' => $model->program
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-laporan-kewangan-elaun-jurulatih'
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'sukan' => $model->sukan
                    , 'program' => $model->program
                    , 'format' => $model->format
                ]);
            }
        } 

        return $this->render('laporan_kewangan_elaun_jurulatih', [
            'model' => $model,
            'readonly' => false,
        ]);
    }

    public function actionGenerateLaporanKewanganElaunJurulatih($tarikh_dari, $tarikh_hingga, $sukan, $program,$format)
    {
        if($tarikh_dari == "") $tarikh_dari = array();
        else $tarikh_dari = array($tarikh_dari);
        
        if($tarikh_hingga == "") $tarikh_hingga = array();
        else $tarikh_hingga = array($tarikh_hingga);
        
        if($sukan == "") $sukan = array();
        else $sukan = array($sukan);
        
        if($program == "") $program = array();
        else $program = array($program);
        
        $controls = array(
            'FROM_DATE' => $tarikh_dari,
            'TO_DATE' => $tarikh_hingga,
            'SUKAN' => $sukan,
            'PROGRAM' => $program,
        );
        
        GeneralFunction::generateReport('/spsb/MSN/LaporanKewanganElaunJurulatih', $format, $controls, 'laporan_kewangan_elaun_jurulatih');
    }
    
    public function actionLaporanKewanganGajiJurulatih()
    {

        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new MsnLaporan();
        $model->format = 'html';

        if ($model->load(Yii::$app->request->post())) {
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-laporan-kewangan-gaji-jurulatih'
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'sukan' => $model->sukan
                    , 'program' => $model->program
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-laporan-kewangan-gaji-jurulatih'
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'sukan' => $model->sukan
                    , 'program' => $model->program
                    , 'format' => $model->format
                ]);
            }
        } 

        return $this->render('laporan_kewangan_gaji_jurulatih', [
            'model' => $model,
            'readonly' => false,
        ]);
    }

    public function actionGenerateLaporanKewanganGajiJurulatih($tarikh_dari, $tarikh_hingga, $sukan, $program,$format)
    {
        if($tarikh_dari == "") $tarikh_dari = array();
        else $tarikh_dari = array($tarikh_dari);
        
        if($tarikh_hingga == "") $tarikh_hingga = array();
        else $tarikh_hingga = array($tarikh_hingga);
        
        if($sukan == "") $sukan = array();
        else $sukan = array($sukan);
        
        if($program == "") $program = array();
        else $program = array($program);
        
        $controls = array(
            'FROM_DATE' => $tarikh_dari,
            'TO_DATE' => $tarikh_hingga,
            'SUKAN' => $sukan,
            'PROGRAM' => $program,
        );
        
        GeneralFunction::generateReport('/spsb/MSN/LaporanKewanganGajiJurulatih', $format, $controls, 'laporan_kewangan_gaji_jurulatih');
    }
    
    
    public function actionSuratPersetujuanTerimaPelantikanDanPembayaran($gaji_dan_elaun_jurulatih_id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new MsnSuratTawaranAtlet();
        $model->gaji_dan_elaun_jurulatih_id = $gaji_dan_elaun_jurulatih_id;
        $model->format = 'pdf';

        if ($model->load(Yii::$app->request->post())) {
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-surat-persetujuan-terima-pelantikan-dan-pembayaran'
                    , 'tarikh' => $model->tarikh
                    , 'bil_msnm' => $model->bil_msnm
                    , 'gaji_dan_elaun_jurulatih_id' => $model->gaji_dan_elaun_jurulatih_id
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-surat-persetujuan-terima-pelantikan-dan-pembayaran'
                    , 'tarikh' => $model->tarikh
                    , 'bil_msnm' => $model->bil_msnm
                    , 'gaji_dan_elaun_jurulatih_id' => $model->gaji_dan_elaun_jurulatih_id
                    , 'format' => $model->format
                ]);
            }
        } 

        return $this->render('surat_persetujuan_terima_pelantikan_dan_pembayaran', [
            'model' => $model,
            'readonly' => false,
        ]);
    }
    
    public function actionGenerateSuratPersetujuanTerimaPelantikanDanPembayaran($tarikh, $bil_msnm, $gaji_dan_elaun_jurulatih_id, $format)
    {
        if($tarikh == "") $tarikh = array();
        else $tarikh = array($tarikh);
        
        if($bil_msnm == "") $bil_msnm = array();
        else $bil_msnm = array($bil_msnm);
        
        if($gaji_dan_elaun_jurulatih_id == "") $gaji_dan_elaun_jurulatih_id = array();
        else $gaji_dan_elaun_jurulatih_id = array($gaji_dan_elaun_jurulatih_id);
        
        $controls = array(
            'TARIKH' => $tarikh,
            'BIL_MSNM' => $bil_msnm,
            'GAJI_ELAUN_ID' => $gaji_dan_elaun_jurulatih_id,
        );
        
        GeneralFunction::generateReport('/spsb/MSN/SuratPersetujuanTerimaPelantikanDanPembayaran', $format, $controls, 'surat_persetujuan_terima_pelantikan_dan_pembayaran');
    }
	
	public function actionPrint($id)
	{
		if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }  
        $model = $this->findModel($id);
		
		$ref = Jurulatih::findOne(['jurulatih_id' => $model->nama_jurulatih]);
        $model->nama_jurulatih = $ref['nama'];
        
        $ref = RefBank::findOne(['id' => $model->bank]);
        $model->bank = $ref['desc'];
        
        $ref = RefProgramJurulatih::findOne(['id' => $model->program]);
        $model->program = $ref['desc'];
        
        $ref = RefSukan::findOne(['id' => $model->nama_sukan]);
        $model->nama_sukan = $ref['desc'];
		
		$ElaunJurulatih = ElaunJurulatih::find()->where(['gaji_dan_elaun_jurulatih_id' => $model->gaji_dan_elaun_jurulatih_id])->all();
        $GajiJurulatih = GajiJurulatih::find()->where(['gaji_dan_elaun_jurulatih_id' => $model->gaji_dan_elaun_jurulatih_id])->all();
		
		$pdf = new \mPDF('utf-8', 'A4');

        $pdf->title = 'Elaun dan Gaji Jurulatih';

        $stylesheet = file_get_contents('css/report.css');

        $pdf->WriteHTML($stylesheet,1);
        
        $pdf->WriteHTML($this->renderpartial('print', [
             'model'  => $model,
			 'title' => $pdf->title,
			 'ElaunJurulatih' => $ElaunJurulatih,
			 'GajiJurulatih' => $GajiJurulatih,
        ]));

        $pdf->Output('Elaun_dan_gaji_jurulatih'.$model->gaji_dan_elaun_jurulatih_id.'.pdf', 'I'); 	
	}
}
