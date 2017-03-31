<?php

namespace frontend\controllers;

use Yii;
use app\models\PerancanganProgramPlanMaster;
use frontend\models\PerancanganProgramPlanMasterSearch;
use app\models\PerancanganProgramPlan;
use frontend\models\PerancanganProgramPlanSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Session;
use yii\helpers\Url;
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
        
        $searchModel = new PerancanganProgramPlanMasterSearch();
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
		
		$queryPar = null;
        
        $queryPar['PerancanganProgramPlanSearch']['perancangan_program_plan_master_id'] = $id;
		
		$searchModelPerancanganProgramPlanItem  = new PerancanganProgramPlanSearch();
        $dataProviderPerancanganProgramPlanItem = $searchModelPerancanganProgramPlanItem->search($queryPar);
        
        $ref = RefCawangan::findOne(['id' => $model->cawangan]);
        $model->cawangan = $ref['desc'];
        
        $ref = RefProgramSemasaSukanAtlet::findOne(['id' => $model->program]);
        $model->program = $ref['desc'];
        
        $ref = RefSukan::findOne(['id' => $model->sukan]);
        $model->sukan = $ref['desc'];
        
        return $this->render('view', [
            'model' => $model,
            'readonly' => true,
			'searchModelPerancanganProgramPlanItem' => $searchModelPerancanganProgramPlanItem,
            'dataProviderPerancanganProgramPlanItem' => $dataProviderPerancanganProgramPlanItem,
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
        
        $model = new PerancanganProgramPlanMaster();
		
		$queryPar = null;
        
        Yii::$app->session->open();
        
        if(isset(Yii::$app->session->id)){
            $queryPar['PerancanganProgramPlanSearch']['session_id'] = Yii::$app->session->id;
        }
		
		$searchModelPerancanganProgramPlanItem  = new PerancanganProgramPlanSearch();
        $dataProviderPerancanganProgramPlanItem = $searchModelPerancanganProgramPlanItem->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if(isset(Yii::$app->session->id)){
                PerancanganProgramPlan::updateAll(['perancangan_program_plan_master_id' => $model->perancangan_program_plan_master_id], 'session_id = "'.Yii::$app->session->id.'"');
                PerancanganProgramPlan::updateAll(['session_id' => ''], 'perancangan_program_plan_master_id = "'.$model->perancangan_program_plan_master_id.'"');
            }
            //if($model->save()){
            return $this->redirect(['view', 'id' => $model->perancangan_program_plan_master_id]);
            //}
        }
        
        return $this->render('create', [
            'model' => $model,
            'readonly' => false,
			'searchModelPerancanganProgramPlanItem' => $searchModelPerancanganProgramPlanItem,
            'dataProviderPerancanganProgramPlanItem' => $dataProviderPerancanganProgramPlanItem,
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
		
		$queryPar = null;
        
        $queryPar['PerancanganProgramPlanSearch']['perancangan_program_plan_master_id'] = $id;
		
		$searchModelPerancanganProgramPlanItem  = new PerancanganProgramPlanSearch();
        $dataProviderPerancanganProgramPlanItem = $searchModelPerancanganProgramPlanItem->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->perancangan_program_plan_master_id]);
            }
        } else {
            return $this->render('update', [
                'model' => $model,
                'readonly' => false,
				'searchModelPerancanganProgramPlanItem' => $searchModelPerancanganProgramPlanItem,
				'dataProviderPerancanganProgramPlanItem' => $dataProviderPerancanganProgramPlanItem,
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
        if (($model = PerancanganProgramPlanMaster::findOne($id)) !== null) {
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
        // if (Yii::$app->user->isGuest) {
            // return $this->redirect(array(GeneralVariable::loginPagePath));
        // }
        
        // $model = new PerancanganProgramPlan;
        
        // if ($model->load(Yii::$app->request->post())) {
            
            // $query = PerancanganProgramPlan::find()->all();
            
            // if(isset($model->sukan) && $model->sukan != '')
            // {
                // echo 'afa';
            // } 
            // $query->andFilterWhere([
            // 'status' => $this->status
        // ]);
            
    
            // $pdf = new \mPDF('utf-8', 'A4-L');

            // $pdf->title = "Laporan Kewangan Plan Periodisasi";
            // $stylesheet = file_get_contents('css/report.css');

            // $pdf->WriteHTML($stylesheet,1);
            
            // $pdf->WriteHTML($this->renderpartial('generate_kewangan_plan_periodisasi', [
                  // 'model'  => $model,
            // ]));

            // $pdf->Output('Laporan Kewangan Plan Periodisasi'.$model->sukan.'_'.$model->jenis_program.'.pdf', 'I');
        // }
        
        // return $this->render('laporan_kewangan_plan', [
             // 'model' => $model,
        // ]);
        
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
    
    public function actionGenerateLaporanKewanganPlanPeriodisasi($tarikh_dari, $tarikh_hingga, $sukan, $program, $format)
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
        
        GeneralFunction::generateReport('/spsb/MSN/LaporanKewanganPlanPeriodisasi', $format, $controls, 'laporan_kewangan_plan');
    }
    
    public function actionLaporanPelanPeriodisasi($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new MsnLaporan();
        $model->format = 'html';

        if ($model->load(Yii::$app->request->post())) {
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-laporan-pelan-periodisasi'
                    , 'id' => $id
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-laporan-pelan-periodisasi'
                    , 'id' => $id
                    , 'format' => $model->format
                ]);
            }
        } 

        return $this->render('laporan_pelan_periodisasi', [
            'model' => $model,
            'readonly' => false,
        ]);
        
    }
    
    public function actionGenerateLaporanPelanPeriodisasi($id, $format)
    {
        if($id == "") $id = array();
        else $id = array($id);
        
        $controls = array(
            'ID' => $id,
        );
        
        GeneralFunction::generateReport('/spsb/MSN/LaporanPelanPeriodisasi', $format, $controls, 'laporan_pelan_periodisasi');
    }
    
    public function actionGetProgramPlan()
    {
        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            $id = $_GET['id'];
            $model = PerancanganProgramPlan::findOne($id);
            return $model;
        }
    }
}
