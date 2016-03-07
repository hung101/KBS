<?php

namespace frontend\controllers;

use Yii;
use app\models\KursusPersatuan;
use frontend\models\KursusPersatuanSearch;
use app\models\TempahanKursusPersatuan;
use frontend\models\TempahanKursusPersatuanSearch;
use app\models\PengurusanKosKursusPersatuan;
use frontend\models\PengurusanKosKursusPersatuanSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use app\models\general\GeneralVariable;

/**
 * KursusPersatuanController implements the CRUD actions for KursusPersatuan model.
 */
class KursusPersatuanController extends Controller
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
     * Lists all KursusPersatuan models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $searchModel = new KursusPersatuanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single KursusPersatuan model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $queryPar = null;
        
        $queryPar['TempahanKursusPersatuanSearch']['kursus_persatuan_id'] = $id;
        $queryPar['PengurusanKosKursusPersatuanSearch']['kursus_persatuan_id'] = $id;
        
        $searchModelTempahanKursusPersatuan = new TempahanKursusPersatuanSearch();
        $dataProviderTempahanKursusPersatuan = $searchModelTempahanKursusPersatuan->search($queryPar);
        
        $searchModelPengurusanKosKursusPersatuan = new PengurusanKosKursusPersatuanSearch();
        $dataProviderPengurusanKosKursusPersatuan = $searchModelPengurusanKosKursusPersatuan->search($queryPar);
        
        return $this->render('view', [
            'model' => $this->findModel($id),
            'searchModelTempahanKursusPersatuan' => $searchModelTempahanKursusPersatuan,
            'dataProviderTempahanKursusPersatuan' => $dataProviderTempahanKursusPersatuan,
            'searchModelPengurusanKosKursusPersatuan' => $searchModelPengurusanKosKursusPersatuan,
            'dataProviderPengurusanKosKursusPersatuan' => $dataProviderPengurusanKosKursusPersatuan,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new KursusPersatuan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new KursusPersatuan();
        
        Yii::$app->session->open();
        
        if(isset(Yii::$app->session->id)){
            $queryPar['TempahanKursusPersatuanSearch']['session_id'] = Yii::$app->session->id;
            $queryPar['PengurusanKosKursusPersatuanSearch']['session_id'] = Yii::$app->session->id;
        }
        
        $searchModelTempahanKursusPersatuan = new TempahanKursusPersatuanSearch();
        $dataProviderTempahanKursusPersatuan = $searchModelTempahanKursusPersatuan->search($queryPar);
        
        $searchModelPengurusanKosKursusPersatuan = new PengurusanKosKursusPersatuanSearch();
        $dataProviderPengurusanKosKursusPersatuan = $searchModelPengurusanKosKursusPersatuan->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            // set the Mesyuarat id base on session id
            if(isset(Yii::$app->session->id)){
                TempahanKursusPersatuan::updateAll(['kursus_persatuan_id' => $model->kursus_persatuan_id], 'session_id = "'.Yii::$app->session->id.'"');
                TempahanKursusPersatuan::updateAll(['session_id' => ''], 'kursus_persatuan_id = "'.$model->kursus_persatuan_id.'"');
                
                PengurusanKosKursusPersatuan::updateAll(['kursus_persatuan_id' => $model->kursus_persatuan_id], 'session_id = "'.Yii::$app->session->id.'"');
                PengurusanKosKursusPersatuan::updateAll(['session_id' => ''], 'kursus_persatuan_id = "'.$model->kursus_persatuan_id.'"');
            }
            
            return $this->redirect(['view', 'id' => $model->kursus_persatuan_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'searchModelTempahanKursusPersatuan' => $searchModelTempahanKursusPersatuan,
                'dataProviderTempahanKursusPersatuan' => $dataProviderTempahanKursusPersatuan,
                'searchModelPengurusanKosKursusPersatuan' => $searchModelPengurusanKosKursusPersatuan,
                'dataProviderPengurusanKosKursusPersatuan' => $dataProviderPengurusanKosKursusPersatuan,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Updates an existing KursusPersatuan model.
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
        
        $queryPar['TempahanKursusPersatuanSearch']['kursus_persatuan_id'] = $id;
        $queryPar['PengurusanKosKursusPersatuanSearch']['kursus_persatuan_id'] = $id;
        
        $searchModelTempahanKursusPersatuan = new TempahanKursusPersatuanSearch();
        $dataProviderTempahanKursusPersatuan = $searchModelTempahanKursusPersatuan->search($queryPar);
        
        $searchModelPengurusanKosKursusPersatuan = new PengurusanKosKursusPersatuanSearch();
        $dataProviderPengurusanKosKursusPersatuan = $searchModelPengurusanKosKursusPersatuan->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->kursus_persatuan_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'searchModelTempahanKursusPersatuan' => $searchModelTempahanKursusPersatuan,
                'dataProviderTempahanKursusPersatuan' => $dataProviderTempahanKursusPersatuan,
                'searchModelPengurusanKosKursusPersatuan' => $searchModelPengurusanKosKursusPersatuan,
                'dataProviderPengurusanKosKursusPersatuan' => $dataProviderPengurusanKosKursusPersatuan,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Deletes an existing KursusPersatuan model.
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
     * Finds the KursusPersatuan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return KursusPersatuan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = KursusPersatuan::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
