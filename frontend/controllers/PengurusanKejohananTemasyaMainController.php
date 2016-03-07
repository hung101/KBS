<?php

namespace frontend\controllers;

use Yii;
use app\models\PengurusanKejohananTemasyaMain;
use frontend\models\PengurusanKejohananTemasyaMainSearch;
use app\models\PengurusanKejohananTemasya;
use frontend\models\PengurusanKejohananTemasyaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use app\models\general\GeneralVariable;

// table reference
use app\models\RefTemasya;
use app\models\RefPertandinganTemasya;

/**
 * PengurusanKejohananTemasyaMainController implements the CRUD actions for PengurusanKejohananTemasyaMain model.
 */
class PengurusanKejohananTemasyaMainController extends Controller
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
     * Lists all PengurusanKejohananTemasyaMain models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $searchModel = new PengurusanKejohananTemasyaMainSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PengurusanKejohananTemasyaMain model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = $this->findModel($id);
        
        $ref = RefTemasya::findOne(['id' => $model->nama_temasya]);
        $model->nama_temasya = $ref['desc'];
        
        $ref = RefPertandinganTemasya::findOne(['id' => $model->nama_pertandingan]);
        $model->nama_pertandingan = $ref['desc'];
        
        $queryPar = null;
        
        $queryPar['PengurusanKejohananTemasyaSearch']['pengurusan_kejohanan_temasya_main_id'] = $id;
        
        $searchModelPengurusanKejohananTemasya = new PengurusanKejohananTemasyaSearch();
        $dataProviderPengurusanKejohananTemasya = $searchModelPengurusanKejohananTemasya->search($queryPar);
        
        return $this->render('view', [
            'model' => $model,
            'searchModelPengurusanKejohananTemasya' => $searchModelPengurusanKejohananTemasya,
            'dataProviderPengurusanKejohananTemasya' => $dataProviderPengurusanKejohananTemasya,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new PengurusanKejohananTemasyaMain model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new PengurusanKejohananTemasyaMain();
        
        $queryPar = null;
        
        Yii::$app->session->open();
        
        if(isset(Yii::$app->session->id)){
            $queryPar['PengurusanKejohananTemasyaSearch']['session_id'] = Yii::$app->session->id;
        }
        
        $searchModelPengurusanKejohananTemasya = new PengurusanKejohananTemasyaSearch();
        $dataProviderPengurusanKejohananTemasya = $searchModelPengurusanKejohananTemasya->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if(isset(Yii::$app->session->id)){
                PengurusanKejohananTemasya::updateAll(['pengurusan_kejohanan_temasya_main_id' => $model->pengurusan_kejohanan_temasya_main_id], 'session_id = "'.Yii::$app->session->id.'"');
                PengurusanKejohananTemasya::updateAll(['session_id' => ''], 'pengurusan_kejohanan_temasya_main_id = "'.$model->pengurusan_kejohanan_temasya_main_id.'"');
            }
            
            return $this->redirect(['view', 'id' => $model->pengurusan_kejohanan_temasya_main_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'searchModelPengurusanKejohananTemasya' => $searchModelPengurusanKejohananTemasya,
                'dataProviderPengurusanKejohananTemasya' => $dataProviderPengurusanKejohananTemasya,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Updates an existing PengurusanKejohananTemasyaMain model.
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
        
        $queryPar['PengurusanKejohananTemasyaSearch']['pengurusan_kejohanan_temasya_main_id'] = $id;
        
        $searchModelPengurusanKejohananTemasya = new PengurusanKejohananTemasyaSearch();
        $dataProviderPengurusanKejohananTemasya = $searchModelPengurusanKejohananTemasya->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->pengurusan_kejohanan_temasya_main_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'searchModelPengurusanKejohananTemasya' => $searchModelPengurusanKejohananTemasya,
                'dataProviderPengurusanKejohananTemasya' => $dataProviderPengurusanKejohananTemasya,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Deletes an existing PengurusanKejohananTemasyaMain model.
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
     * Finds the PengurusanKejohananTemasyaMain model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PengurusanKejohananTemasyaMain the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PengurusanKejohananTemasyaMain::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
