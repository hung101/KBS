<?php

namespace frontend\controllers;

use Yii;
use app\models\MesyuaratJkk;
use app\models\MesyuaratJkkSearch;
use app\models\MesyuaratJkkKehadiran;
use app\models\MesyuaratJkkKehadiranSearch;
use app\models\Atlet;
use app\models\AtletSearch;
use app\models\Jurulatih;
use frontend\models\JurulatihSearch;
use app\models\PengurusanProgramBinaan;
use frontend\models\PengurusanProgramBinaanSearch;
use app\models\PermohonanPeralatan;
use frontend\models\PermohonanPeralatanSearch;
use app\models\PenyertaanSukan;
use frontend\models\PenyertaanSukanSearch;
use app\models\ProfilPusatLatihan;
use frontend\models\ProfilPusatLatihanSearch;
use app\models\PerancanganProgram;
use frontend\models\PerancanganProgramSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

use app\models\general\Upload;

// table reference
use app\models\RefPenganjurJkk;
use app\models\PengurusanJkkJkp;
use app\models\RefProgramSemasaSukanAtlet;
use app\models\RefCawangan;
use app\models\RefSukan;
use app\models\RefTempatJkk;
use app\models\RefFasa;
use app\models\RefNegeri;
use app\models\RefStatusTawaran;
use app\models\RefStatusPermohonanProgramBinaan;
use app\models\RefKelulusanPeralatan;
use app\models\RefStatusProgram;
use app\models\RefBilJkk;

/**
 * MesyuaratJkkController implements the CRUD actions for MesyuaratJkk model.
 */
class MesyuaratJkkController extends Controller
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
     * Lists all MesyuaratJkk models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MesyuaratJkkSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    /**
     * Lists all MesyuaratJkk models.
     * @return mixed
     */
    public function actionAgendaPerbincangan($mesyuarat_id)
    {
        
        $queryPar = Yii::$app->request->queryParams;
        
        if($mesyuarat_id != ''){
            Atlet::updateAll(['mesyuarat_id' => $mesyuarat_id], 'mesyuarat_id = "" OR mesyuarat_id IS NULL');
            $queryPar['AtletSearch']['mesyuarat_id'] = $mesyuarat_id;
            
            Jurulatih::updateAll(['mesyuarat_id' => $mesyuarat_id], 'mesyuarat_id = "" OR mesyuarat_id IS NULL');
            $queryPar['JurulatihSearch']['mesyuarat_id'] = $mesyuarat_id;
            
            PengurusanProgramBinaan::updateAll(['mesyuarat_id' => $mesyuarat_id], 'mesyuarat_id = "" OR mesyuarat_id IS NULL');
            $queryPar['PengurusanProgramBinaanSearch']['mesyuarat_id'] = $mesyuarat_id;
            
            PermohonanPeralatan::updateAll(['mesyuarat_id' => $mesyuarat_id], 'mesyuarat_id = "" OR mesyuarat_id IS NULL');
            $queryPar['PermohonanPeralatanSearch']['mesyuarat_id'] = $mesyuarat_id;
            
            PerancanganProgram::updateAll(['mesyuarat_id' => $mesyuarat_id], 'mesyuarat_id = "" OR mesyuarat_id IS NULL');
            $queryPar['PerancanganProgramSearch']['mesyuarat_id'] = $mesyuarat_id;
            
            PenyertaanSukan::updateAll(['mesyuarat_id' => $mesyuarat_id], 'mesyuarat_id = "" OR mesyuarat_id IS NULL');
            $queryPar['PenyertaanSukanSearch']['mesyuarat_id'] = $mesyuarat_id;
            
            ProfilPusatLatihan::updateAll(['mesyuarat_id' => $mesyuarat_id], 'mesyuarat_id = "" OR mesyuarat_id IS NULL');
            $queryPar['ProfilPusatLatihanSearch']['mesyuarat_id'] = $mesyuarat_id;
        }
        
        //$queryPar['AtletSearch']['tawaran'] = RefStatusTawaran::DALAM_PROSES;
        //$queryPar['PengurusanProgramBinaanSearch']['status_permohonan_id'] = RefStatusPermohonanProgramBinaan::SEDANG_DIPROSES;
        //$queryPar['PermohonanPeralatanSearch']['kelulusan_id'] = RefKelulusanPeralatan::SEDANG_DIPROSES;
        //$queryPar['PerancanganProgramSearch']['status_program_id'] = RefStatusProgram::DALAM_PROSES;
        //$queryPar['JurulatihSearch']['status_tawaran_id'] = RefStatusTawaran::DALAM_PROSES;
        
        $searchModelAtlet = new AtletSearch();
        $dataProviderAtlet = $searchModelAtlet->search($queryPar);
        
        $searchModelJurulatih = new JurulatihSearch();
        $dataProviderJurulatih = $searchModelJurulatih->search($queryPar);
        
        $searchModelPengurusanProgramBinaan = new PengurusanProgramBinaanSearch();
        $dataProviderPengurusanProgramBinaan = $searchModelPengurusanProgramBinaan->search($queryPar);
        
        $searchModelPermohonanPeralatan = new PermohonanPeralatanSearch();
        $dataProviderPermohonanPeralatan = $searchModelPermohonanPeralatan->search($queryPar);
        
        $searchModelKejohanan = new PenyertaanSukanSearch();
        $dataProviderKejohanan = $searchModelKejohanan->search($queryPar);
        
        $searchModelPusatLatihan = new ProfilPusatLatihanSearch();
        $dataProviderPusatLatihan = $searchModelPusatLatihan->search($queryPar);
        
        $searchModelProgram= new PerancanganProgramSearch();
        $dataProviderProgram = $searchModelProgram->search($queryPar);

        return $this->render('agenda_perbincangan', [
            'searchModelAtlet' => $searchModelAtlet,
            'dataProviderAtlet' => $dataProviderAtlet,
            'searchModelJurulatih' => $searchModelJurulatih,
            'dataProviderJurulatih' => $dataProviderJurulatih,
            'searchModelPengurusanProgramBinaan' => $searchModelPengurusanProgramBinaan,
            'dataProviderPengurusanProgramBinaan' => $dataProviderPengurusanProgramBinaan,
            'searchModelPermohonanPeralatan' => $searchModelPermohonanPeralatan,
            'dataProviderPermohonanPeralatan' => $dataProviderPermohonanPeralatan,
            'searchModelKejohanan' => $searchModelKejohanan,
            'dataProviderKejohanan' => $dataProviderKejohanan,
            'searchModelPusatLatihan' => $searchModelPusatLatihan,
            'dataProviderPusatLatihan' => $dataProviderPusatLatihan,
            'searchModelProgram' => $searchModelProgram,
            'dataProviderProgram' => $dataProviderProgram,
        ]);
    }
    
    /**
     * Lists all MesyuaratJkk models.
     * @return mixed
     */
    public function actionResetAgendaPerbincangan()
    {
        Atlet::updateAll(['mesyuarat_id' => ''], 'tawaran = ' . RefStatusTawaran::DALAM_PROSES);

        Jurulatih::updateAll(['mesyuarat_id' => ''], 'status_tawaran = ' . RefStatusTawaran::DALAM_PROSES);

        PengurusanProgramBinaan::updateAll(['mesyuarat_id' => ''], 'status_permohonan = ' . RefStatusPermohonanProgramBinaan::SEDANG_DIPROSES);

        PermohonanPeralatan::updateAll(['mesyuarat_id' => ''], 'kelulusan = ' . RefKelulusanPeralatan::SEDANG_DIPROSES);

        PerancanganProgram::updateAll(['mesyuarat_id' => ''], 'status_program = ' . RefStatusProgram::DALAM_PROSES);

        PenyertaanSukan::updateAll(['mesyuarat_id' => '']);

        ProfilPusatLatihan::updateAll(['mesyuarat_id' => '']);
    }

    /**
     * Displays a single MesyuaratJkk model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {   
        $queryPar = null;
        
        $queryPar['MesyuaratJkkKehadiranSearch']['mesyuarat_id'] = $id;
        
        $SNHsearchModel = new MesyuaratJkkKehadiranSearch();
        $SNHdataProvider = $SNHsearchModel->search($queryPar);
        
        $model = $this->findModel($id);
        
        $ref = RefPenganjurJkk::findOne(['id' => $model->penganjur]);
        $model->penganjur = $ref['desc'];
        
        $ref = PengurusanJkkJkp::findOne(['pengurusan_jkk_jkp_id' => $model->pengerusi_mesyuarat]);
        $model->pengerusi_mesyuarat = $ref['nama_pegawai_coach'];
        
        $ref = RefProgramSemasaSukanAtlet::findOne(['id' => $model->program]);
        $model->program = $ref['desc'];
        
        $ref = RefCawangan::findOne(['id' => $model->cawangan]);
        $model->cawangan = $ref['desc'];
        
        $ref = RefNegeri::findOne(['id' => $model->negeri]);
        $model->negeri = $ref['desc'];
        
        $ref = RefSukan::findOne(['id' => $model->sukan]);
        $model->sukan = $ref['desc'];
        
        //$ref = RefTempatJkk::findOne(['id' => $model->tempat]);
        //$model->tempat = $ref['desc'];
        
        $ref = RefSukan::findOne(['id' => $model->sukan]);
        $model->sukan = $ref['desc'];
        
        $ref = RefBilJkk::findOne(['id' => $model->bil_mesyuarat]);
        $model->bil_mesyuarat = $ref['desc'];
        
        return $this->render('view', [
            'model' => $model,
            'SNHsearchModel' => $SNHsearchModel,
            'SNHdataProvider' => $SNHdataProvider,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new MesyuaratJkk model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new MesyuaratJkk();
        
        Yii::$app->session->open();
        
        $queryPar = null;
        
        if(isset(Yii::$app->session->id)){
            $queryPar['MesyuaratJkkKehadiranSearch']['session_id'] = Yii::$app->session->id;
        }
        
        $SNHsearchModel = new MesyuaratJkkKehadiranSearch();
        $SNHdataProvider = $SNHsearchModel->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            // set the MesyuaratJkk id base on session id
            if(isset(Yii::$app->session->id)){
                MesyuaratJkkKehadiran::updateAll(['mesyuarat_id' => $model->mesyuarat_id], 'session_id = "'.Yii::$app->session->id.'"');
                MesyuaratJkkKehadiran::updateAll(['session_id' => ''], 'mesyuarat_id = "'.$model->mesyuarat_id.'"');
            }
            
            //upload file to server
            /*$file = UploadedFile::getInstance($model, 'muat_naik');
            if($file){
                $model->muat_naik = Upload::uploadFile($file, Upload::mesyuaratFolder, $model->mesyuarat_id);
            }*/
            
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->mesyuarat_id]);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
                'SNHsearchModel' => $SNHsearchModel,
                'SNHdataProvider' => $SNHdataProvider,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Updates an existing MesyuaratJkk model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        
        $queryPar = null;
        
        $queryPar['MesyuaratJkkKehadiranSearch']['mesyuarat_id'] = $id;
        
        $SNHsearchModel = new MesyuaratJkkKehadiranSearch();
        $SNHdataProvider = $SNHsearchModel->search($queryPar);

        if ($model->load(Yii::$app->request->post())) {
            /*$file = UploadedFile::getInstance($model, 'muat_naik');
            if($file){
                $model->muat_naik = Upload::uploadFile($file, Upload::mesyuaratFolder, $model->mesyuarat_id);
            }*/
            
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->mesyuarat_id]);
            }
        } else {
            return $this->render('update', [
                'model' => $model,
                'SNHsearchModel' => $SNHsearchModel,
                'SNHdataProvider' => $SNHdataProvider,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Deletes an existing MesyuaratJkk model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the MesyuaratJkk model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MesyuaratJkk the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MesyuaratJkk::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    // Add function for delete image or file
    public function actionDeleteupload($id, $field)
    {
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
}
