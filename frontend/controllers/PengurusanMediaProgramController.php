<?php

namespace frontend\controllers;

use Yii;
use app\models\PengurusanMediaProgram;
use frontend\models\PengurusanMediaProgramSearch;
use app\models\PengurusanDokumenMediaProgram;
use frontend\models\PengurusanDokumenMediaProgramSearch;
use app\models\PengurusanKehadiranMediaProgram;
use frontend\models\PengurusanKehadiranMediaProgramSearch;
use app\models\PengurusanMediaProgramWakil;
use frontend\models\PengurusanMediaProgramWakilSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use app\models\general\GeneralVariable;

/**
 * PengurusanMediaProgramController implements the CRUD actions for PengurusanMediaProgram model.
 */
class PengurusanMediaProgramController extends Controller
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
     * Lists all PengurusanMediaProgram models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $searchModel = new PengurusanMediaProgramSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PengurusanMediaProgram model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $queryPar = null;
        
        $queryPar['PengurusanDokumenMediaProgramSearch']['pengurusan_media_program_id'] = $id;
        $queryPar['PengurusanKehadiranMediaProgramSearch']['pengurusan_media_program_id'] = $id;
        $queryPar['PengurusanMediaProgramWakilSearch']['pengurusan_media_program_id'] = $id;
        
        $searchModelDokumenMediaProgram = new PengurusanDokumenMediaProgramSearch();
        $dataProviderDokumenMediaProgram = $searchModelDokumenMediaProgram->search($queryPar);
        
        $searchModelKehadiranMediaProgram = new PengurusanKehadiranMediaProgramSearch();
        $dataProviderKehadiranMediaProgram = $searchModelKehadiranMediaProgram->search($queryPar);
        
        $searchModelPengurusanMediaProgramWakil = new PengurusanMediaProgramWakilSearch();
        $dataProviderPengurusanMediaProgramWakil = $searchModelPengurusanMediaProgramWakil->search($queryPar);
        
        return $this->render('view', [
            'model' => $this->findModel($id),
            'searchModelDokumenMediaProgram' => $searchModelDokumenMediaProgram,
            'dataProviderDokumenMediaProgram' => $dataProviderDokumenMediaProgram,
            'searchModelKehadiranMediaProgram' => $searchModelKehadiranMediaProgram,
            'dataProviderKehadiranMediaProgram' => $dataProviderKehadiranMediaProgram,
            'searchModelPengurusanMediaProgramWakil' => $searchModelPengurusanMediaProgramWakil,
            'dataProviderPengurusanMediaProgramWakil' => $dataProviderPengurusanMediaProgramWakil,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new PengurusanMediaProgram model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new PengurusanMediaProgram();
        
        $queryPar = null;
        
        Yii::$app->session->open();
        
        if(isset(Yii::$app->session->id)){
            $queryPar['PengurusanDokumenMediaProgramSearch']['session_id'] = Yii::$app->session->id;
            $queryPar['PengurusanKehadiranMediaProgramSearch']['session_id'] = Yii::$app->session->id;
            $queryPar['PengurusanMediaProgramWakilSearch']['session_id'] = Yii::$app->session->id;
        }
        
        $searchModelDokumenMediaProgram  = new PengurusanDokumenMediaProgramSearch();
        $dataProviderDokumenMediaProgram = $searchModelDokumenMediaProgram->search($queryPar);
        
        $searchModelKehadiranMediaProgram  = new PengurusanKehadiranMediaProgramSearch();
        $dataProviderKehadiranMediaProgram = $searchModelKehadiranMediaProgram->search($queryPar);
        
        $searchModelPengurusanMediaProgramWakil = new PengurusanMediaProgramWakilSearch();
        $dataProviderPengurusanMediaProgramWakil = $searchModelPengurusanMediaProgramWakil->search($queryPar);
                

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if(isset(Yii::$app->session->id)){
                PengurusanDokumenMediaProgram::updateAll(['pengurusan_media_program_id' => $model->pengurusan_media_program_id], 'session_id = "'.Yii::$app->session->id.'"');
                PengurusanDokumenMediaProgram::updateAll(['session_id' => ''], 'pengurusan_media_program_id = "'.$model->pengurusan_media_program_id.'"');
                
                PengurusanKehadiranMediaProgram::updateAll(['pengurusan_media_program_id' => $model->pengurusan_media_program_id], 'session_id = "'.Yii::$app->session->id.'"');
                PengurusanKehadiranMediaProgram::updateAll(['session_id' => ''], 'pengurusan_media_program_id = "'.$model->pengurusan_media_program_id.'"');
                
                PengurusanMediaProgramWakil::updateAll(['pengurusan_media_program_id' => $model->pengurusan_media_program_id], 'session_id = "'.Yii::$app->session->id.'"');
                PengurusanMediaProgramWakil::updateAll(['session_id' => ''], 'pengurusan_media_program_id = "'.$model->pengurusan_media_program_id.'"');
            }
            
            return $this->redirect(['view', 'id' => $model->pengurusan_media_program_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'searchModelDokumenMediaProgram' => $searchModelDokumenMediaProgram,
                'dataProviderDokumenMediaProgram' => $dataProviderDokumenMediaProgram,
                'searchModelKehadiranMediaProgram' => $searchModelKehadiranMediaProgram,
                'dataProviderKehadiranMediaProgram' => $dataProviderKehadiranMediaProgram,
                'searchModelPengurusanMediaProgramWakil' => $searchModelPengurusanMediaProgramWakil,
                'dataProviderPengurusanMediaProgramWakil' => $dataProviderPengurusanMediaProgramWakil,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Updates an existing PengurusanMediaProgram model.
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
        
        $queryPar['PengurusanDokumenMediaProgramSearch']['pengurusan_media_program_id'] = $id;
        $queryPar['PengurusanKehadiranMediaProgramSearch']['pengurusan_media_program_id'] = $id;
        $queryPar['PengurusanMediaProgramWakilSearch']['pengurusan_media_program_id'] = $id;
        
        $searchModelDokumenMediaProgram = new PengurusanDokumenMediaProgramSearch();
        $dataProviderDokumenMediaProgram = $searchModelDokumenMediaProgram->search($queryPar);
        
        $searchModelKehadiranMediaProgram = new PengurusanKehadiranMediaProgramSearch();
        $dataProviderKehadiranMediaProgram = $searchModelKehadiranMediaProgram->search($queryPar);
        
        $searchModelPengurusanMediaProgramWakil = new PengurusanMediaProgramWakilSearch();
        $dataProviderPengurusanMediaProgramWakil = $searchModelPengurusanMediaProgramWakil->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->pengurusan_media_program_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'searchModelDokumenMediaProgram' => $searchModelDokumenMediaProgram,
                'dataProviderDokumenMediaProgram' => $dataProviderDokumenMediaProgram,
                'searchModelKehadiranMediaProgram' => $searchModelKehadiranMediaProgram,
                'dataProviderKehadiranMediaProgram' => $dataProviderKehadiranMediaProgram,
                'searchModelPengurusanMediaProgramWakil' => $searchModelPengurusanMediaProgramWakil,
                'dataProviderPengurusanMediaProgramWakil' => $dataProviderPengurusanMediaProgramWakil,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Deletes an existing PengurusanMediaProgram model.
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
     * Finds the PengurusanMediaProgram model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PengurusanMediaProgram the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PengurusanMediaProgram::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
