<?php

namespace frontend\controllers;

use Yii;
use app\models\LtbsMinitMesyuaratAgm;
use app\models\LtbsMinitMesyuaratAgmSearch;
use app\models\LtbsSenaraiNamaHadirAgm;
use app\models\LtbsSenaraiNamaHadirAgmSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use app\models\general\GeneralVariable;

/**
 * LtbsMinitMesyuaratAgmController implements the CRUD actions for LtbsMinitMesyuaratAgm model.
 */
class LtbsMinitMesyuaratAgmController extends Controller
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
     * Lists all LtbsMinitMesyuaratAgm models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $searchModel = new LtbsMinitMesyuaratAgmSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single LtbsMinitMesyuaratAgm model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $queryPar = null;
        
        $queryPar['LtbsSenaraiNamaHadirAgmSearch']['mesyuarat_agm_id'] = $id;
        
        $searchModelSNKMA = new LtbsSenaraiNamaHadirAgmSearch();
        $dataProviderSNKMA = $searchModelSNKMA->search($queryPar);
        
        return $this->render('view', [
            'model' => $this->findModel($id),
            'readonly' => true,
            'searchModelSNKMA' => $searchModelSNKMA,
            'dataProviderSNKMA' => $dataProviderSNKMA,
        ]);
    }

    /**
     * Creates a new LtbsMinitMesyuaratAgm model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new LtbsMinitMesyuaratAgm();
        
        $queryPar = null;
        
        Yii::$app->session->open();
        
        if(isset(Yii::$app->session->id)){
            //filter only show base on user login session
            $queryPar['LtbsSenaraiNamaHadirAgmSearch']['session_id'] = Yii::$app->session->id;
        }
        
        $searchModelSNKMA = new LtbsSenaraiNamaHadirAgmSearch();
        $dataProviderSNKMA = $searchModelSNKMA->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if(isset(Yii::$app->session->id)){
                //update the new mesyuarat id instead of use login session id as reference
                LtbsSenaraiNamaHadirAgm::updateAll(['mesyuarat_agm_id' => $model->mesyuarat_agm_id], 'session_id = "'.Yii::$app->session->id.'"');
                LtbsSenaraiNamaHadirAgm::updateAll(['session_id' => ''], 'mesyuarat_agm_id = "'.$model->mesyuarat_agm_id.'"');
            }
            
            return $this->redirect(['view', 'id' => $model->mesyuarat_agm_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'readonly' => false,
                'searchModelSNKMA' => $searchModelSNKMA,
                'dataProviderSNKMA' => $dataProviderSNKMA,
            ]);
        }
    }

    /**
     * Updates an existing LtbsMinitMesyuaratAgm model.
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
        
        $queryPar['LtbsSenaraiNamaHadirAgmSearch']['mesyuarat_agm_id'] = $id;
        
        $searchModelSNKMA = new LtbsSenaraiNamaHadirAgmSearch();
        $dataProviderSNKMA = $searchModelSNKMA->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->mesyuarat_agm_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'readonly' => false,
                'searchModelSNKMA' => $searchModelSNKMA,
                'dataProviderSNKMA' => $dataProviderSNKMA,
            ]);
        }
    }

    /**
     * Deletes an existing LtbsMinitMesyuaratAgm model.
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
     * Finds the LtbsMinitMesyuaratAgm model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return LtbsMinitMesyuaratAgm the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = LtbsMinitMesyuaratAgm::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
