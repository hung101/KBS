<?php

namespace frontend\controllers;

use Yii;
use app\models\PerancanganProgramPlanMaster;
use app\models\PerancanganProgramPlan;
use frontend\models\PerancanganProgramPlanSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;

use app\models\general\GeneralVariable;
use app\models\general\GeneralLabel;

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

/**
 * PerancanganProgramPlanController implements the CRUD actions for PerancanganProgramPlan model.
 */
class PerancanganProgramPlanItemController extends Controller
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
		
		$ref = RefJenisPelan::findOne(['id' => $model->jenis_aktiviti]);
        $model->jenis_aktiviti = $ref['desc'];
        
        $ref = RefKedudukanKejohanan::findOne(['id' => $model->status_program]);
        $model->status_program = $ref['desc'];
        
        $ref = RefStatusPermohonanProgramBinaan::findOne(['id' => $model->status_permohonan]);
        $model->status_permohonan = $ref['desc'];
        
        return $this->renderAjax('view', [
            'model' => $model,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new PerancanganProgramPlan model. actionDhy
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($perancangan_program_plan_master_id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new PerancanganProgramPlan();
        
        Yii::$app->session->open();
        
        if($perancangan_program_plan_master_id != ''){
            $model->perancangan_program_plan_master_id = $perancangan_program_plan_master_id;
        } else {
            if(isset(Yii::$app->session->id)){
                $model->session_id = Yii::$app->session->id;
            }
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return '1';
        } else {
            return $this->renderAjax('create', [
                'model' => $model,
                'readonly' => false,
            ]);
        }
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
            return '1';
        } else {
            return $this->renderAjax('update', [
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

        //return $this->redirect(['index']);
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
}
