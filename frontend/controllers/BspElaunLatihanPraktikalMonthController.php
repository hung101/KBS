<?php

namespace frontend\controllers;

use Yii;
use app\models\BspElaunLatihanPraktikalMonth;
use frontend\models\BspElaunLatihanPraktikalMonthSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * BspElaunLatihanPraktikalMonthController implements the CRUD actions for BspElaunLatihanPraktikalMonth model.
 */
class BspElaunLatihanPraktikalMonthController extends Controller
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
     * Lists all BspElaunLatihanPraktikalMonth models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BspElaunLatihanPraktikalMonthSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
//delete()
    /**
     * Displays a single BspElaunLatihanPraktikalMonth model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->renderAjax('view', [
            'model' => $this->findModel($id),
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new BspElaunLatihanPraktikalMonth model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($bsp_elaun_latihan_praktikal_id)
    {
        $model = new BspElaunLatihanPraktikalMonth();
        
        Yii::$app->session->open();
        
        if($bsp_elaun_latihan_praktikal_id != ''){
            $model->bsp_elaun_latihan_praktikal_id = $bsp_elaun_latihan_praktikal_id;
        } else {
            if(isset(Yii::$app->session->id)){
                $model->session_id = Yii::$app->session->id;
            }
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return '1';
        } 
        
        return $this->renderAjax('create', [
                'model' => $model,
                'readonly' => false,
            ]);
    }

    /**
     * Updates an existing BspElaunLatihanPraktikalMonth model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
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
     * Deletes an existing BspElaunLatihanPraktikalMonth model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        //return $this->redirect(['index']);
    }

    /**
     * Finds the BspElaunLatihanPraktikalMonth model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return BspElaunLatihanPraktikalMonth the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = BspElaunLatihanPraktikalMonth::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
