<?php

namespace frontend\controllers;

use Yii;
use app\models\MesyuaratSenaraiTugas;
use frontend\models\MesyuaratSenaraiTugasSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MesyuaratSenaraiTugasController implements the CRUD actions for MesyuaratSenaraiTugas model.
 */
class MesyuaratSenaraiTugasController extends Controller
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
     * Lists all MesyuaratSenaraiTugas models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MesyuaratSenaraiTugasSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single MesyuaratSenaraiTugas model.
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
     * Creates a new MesyuaratSenaraiTugas model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($mesyuarat_id)
    {
        $model = new MesyuaratSenaraiTugas();
        
        Yii::$app->session->open();
        
        if($mesyuarat_id != ''){
            $model->mesyuarat_id = $mesyuarat_id;
        } else {
            if(isset(Yii::$app->session->id)){
                $model->session_id = Yii::$app->session->id;
            }
        }

        if ($model->load(Yii::$app->request->post())) {
            //return $this->redirect(['view', 'id' => $model->senarai_tugas_id]);
            return $model->save();
        } else {
            return $this->renderAjax('create', [
                'model' => $model,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Updates an existing MesyuaratSenaraiTugas model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            //return $this->redirect(['view', 'id' => $model->senarai_tugas_id]);
            return $model->save();
        } else {
            return $this->renderAjax('update', [
                'model' => $model,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Deletes an existing MesyuaratSenaraiTugas model.
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
     * Finds the MesyuaratSenaraiTugas model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MesyuaratSenaraiTugas the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MesyuaratSenaraiTugas::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
