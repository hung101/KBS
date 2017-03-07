<?php

namespace frontend\controllers;

use Yii;
use app\models\PerancanganProgramPlan;
use frontend\models\PerancanganProgramPlanSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use yii\web\UploadedFile;
use yii\web\Response;
use yii\helpers\BaseUrl;

use app\models\general\Upload;

// contant values
use app\models\general\GeneralVariable;
use common\models\general\GeneralFunction;

// table reference
use app\models\RefJenisProgram;
use app\models\RefBahagianProgram;
use app\models\RefCawangan;
use app\models\RefProgramSemasaSukanAtlet;
use app\models\RefJenisAktiviti;
use app\models\RefStatusProgram;
use app\models\RefSukan;
use app\models\RefKategoriPelan;
use app\models\RefJenisPelan;
use app\models\RefKedudukanKejohanan;
use app\models\RefStatusPermohonanProgramBinaan;
use app\models\MsnLaporan;

/**
 * PerancanganProgramPlanController implements the CRUD actions for PerancanganProgramPlan model.
 */
class PerancanganProgramPlanController extends Controller
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
     * Lists all PerancanganProgramPlan models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $searchModel = new PerancanganProgramPlanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PerancanganProgramPlan model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = $this->findModel($id);
        
        $ref = RefKategoriPelan::findOne(['id' => $model->bahagian]);
        $model->bahagian = $ref['desc'];
        
        $ref = RefCawangan::findOne(['id' => $model->cawangan]);
        $model->cawangan = $ref['desc'];
        
        $ref = RefProgramSemasaSukanAtlet::findOne(['id' => $model->jenis_program]);
        $model->jenis_program = $ref['desc'];
        
        $ref = RefJenisPelan::findOne(['id' => $model->jenis_aktiviti]);
        $model->jenis_aktiviti = $ref['desc'];
        
        $ref = RefKedudukanKejohanan::findOne(['id' => $model->status_program]);
        $model->status_program = $ref['desc'];
        
        $ref = RefSukan::findOne(['id' => $model->sukan]);
        $model->sukan = $ref['desc'];
        
        $ref = RefStatusPermohonanProgramBinaan::findOne(['id' => $model->status_permohonan]);
        $model->status_permohonan = $ref['desc'];
        
        return $this->render('view', [
            'model' => $model,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new PerancanganProgramPlan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new PerancanganProgramPlan();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $file = UploadedFile::getInstance($model, 'muat_naik');
            if($file){
                $model->muat_naik = Upload::uploadFile($file, Upload::perancanganProgramFolder, $model->perancangan_program_id);
            }
            
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->perancangan_program_id]);
            }
        }
        
        return $this->render('create', [
            'model' => $model,
            'readonly' => false,
        ]);
    }

    /**
     * Updates an existing PerancanganProgramPlan model.
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

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $file = UploadedFile::getInstance($model, 'muat_naik');
            if($file){
                $model->muat_naik = Upload::uploadFile($file, Upload::perancanganProgramFolder, $model->perancangan_program_id);
            }
            
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->perancangan_program_id]);
            }
        } else {
            return $this->render('update', [
                'model' => $model,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Deletes an existing PerancanganProgramPlan model.
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
     * Finds the PerancanganProgramPlan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PerancanganProgramPlan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PerancanganProgramPlan::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionGetProgram($id){
        // find Ahli Jawatankuasa Induk
        $model = PerancanganProgramPlan::findOne($id);
        
        echo Json::encode($model);
    }
    
    public function actionLaporanKewangan()
    {
        
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new MsnLaporan();
        $model->format = 'html';

        if ($model->load(Yii::$app->request->post())) {
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-laporan-kewangan-plan-periodisasi'
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'sukan' => $model->sukan
                    , 'program' => $model->program
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-laporan-kewangan-plan-periodisasi'
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'sukan' => $model->sukan
                    , 'program' => $model->program
                    , 'format' => $model->format
                ]);
            }
        } 

        return $this->render('laporan_kewangan_plan', [
            'model' => $model,
            'readonly' => false,
        ]);
        
    }
    
    public function actionGenerateLaporanKewanganPlanPeriodisasi($tarikh_dari="", $tarikh_hingga="", $sukan="", $program="",  $format="")
    {
        if($tarikh_dari == "") $tarikh_dari = array();
        else $tarikh_dari = array($tarikh_dari);
        
        if($tarikh_hingga == "") $tarikh_hingga = array();
        else $tarikh_hingga = array($tarikh_hingga);
        
        if($program == "") $program = array();
        else $program = array($program);
        
        if($sukan == "") $sukan = array();
        else $sukan = array($sukan);
        
        $controls = array(
            'FROM_DATE' => $tarikh_dari,
            'TO_DATE' => $tarikh_hingga,
            'PROGRAM' => $program,
            'SUKAN' => $sukan,
        );
        
        GeneralFunction::generateReport('/spsb/MSN/LaporanKewanganPlanPeriodisasi', $format, $controls, 'laporan_kewangan_plan');
    }
    
    public function actionLaporanPelanPeriodisasi()
    {
        
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new MsnLaporan();
        $model->format = 'html';

        if ($model->load(Yii::$app->request->post())) {
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-laporan-pelan-periodisasi'
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'cawangan' => $model->cawangan
                    , 'sukan' => $model->sukan
                    , 'remark' => $model->remark
                    , 'competition' => $model->competition
                    , 'competition_target' => $model->competition_target
                    , 'target_medal' => $model->target_medal
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-laporan-pelan-periodisasi'
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'cawangan' => $model->cawangan
                    , 'sukan' => $model->sukan
                    , 'remark' => $model->remark
                    , 'competition' => $model->competition
                    , 'competition_target' => $model->competition_target
                    , 'target_medal' => $model->target_medal
                    , 'format' => $model->format
                ]);
            }
        } 

        return $this->render('laporan_pelan_periodisasi', [
            'model' => $model,
            'readonly' => false,
        ]);
        
    }
    
    public function actionGenerateLaporanPelanPeriodisasi($tarikh_dari="", $tarikh_hingga="", $cawangan="", $sukan="", 
            $remark="", $competition="", $competition_target="",  $target_medal="", $format="")
    {
        if($tarikh_dari == "") $tarikh_dari = array();
        else $tarikh_dari = array($tarikh_dari);
        
        if($tarikh_hingga == "") $tarikh_hingga = array();
        else $tarikh_hingga = array($tarikh_hingga);
        
        if($cawangan == "") $cawangan = array();
        else $cawangan = array($cawangan);
        
        if($sukan == "") $sukan = array();
        else $sukan = array($sukan);
        
        if($remark == "") $remark = array();
        else $remark = array($remark);
        
        if($competition == "") $competition = array();
        else $competition = array($competition);
        
        if($competition_target == "") $competition_target = array();
        else $competition_target = array($competition_target);
        
        if($target_medal == "") $target_medal = array();
        else $target_medal = array($target_medal);
        
        $controls = array(
            'FROM_DATE' => $tarikh_dari,
            'TO_DATE' => $tarikh_hingga,
            'CAWANGAN' => $cawangan,
            'SUKAN' => $sukan,
            'PHASE_COMPETITION' => $competition,
            'PHASE_REMARK' => $remark,
            'PHASE_TARGET' => $competition_target,
            'TARGET_MEDAL' => $target_medal,
        );
        
        GeneralFunction::generateReport('/spsb/MSN/LaporanPelanPeriodisasi', $format, $controls, 'laporan_pelan_periodisasi');
    }
    
    public function actionGetProgramPlan()
    {
        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            $id = $_GET['id'];
            $model = $this->findModel($id);
            return $model;
        }
    }
}
