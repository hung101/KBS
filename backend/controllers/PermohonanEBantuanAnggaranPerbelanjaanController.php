<?php

namespace backend\controllers;

use Yii;
use app\models\PermohonanEBantuanAnggaranPerbelanjaan;
use backend\models\PermohonanEBantuanAnggaranPerbelanjaanSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PermohonanEBantuanAnggaranPerbelanjaanController implements the CRUD actions for PermohonanEBantuanAnggaranPerbelanjaan model.
 */
class PermohonanEBantuanAnggaranPerbelanjaanController extends Controller
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
     * Lists all PermohonanEBantuanAnggaranPerbelanjaan models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PermohonanEBantuanAnggaranPerbelanjaanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PermohonanEBantuanAnggaranPerbelanjaan model.
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
     * Creates a new PermohonanEBantuanAnggaranPerbelanjaan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($permohonan_id)
    {
        $model = new PermohonanEBantuanAnggaranPerbelanjaan();
        
        Yii::$app->session->open();
        
        if($permohonan_id != ''){
            $model->permohonan_e_bantuan_id = $permohonan_id;
        } else {
            if(isset(Yii::$app->session->id)){
                $model->session_id = Yii::$app->session->id;
            }
        }

        if ($model->load(Yii::$app->request->post())) {
            //return $this->redirect(['view', 'id' => $model->anggaran_perbelanjaan_id]);
            return $model->save();
        } else {
            return $this->renderAjax('create', [
                'model' => $model,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Updates an existing PermohonanEBantuanAnggaranPerbelanjaan model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            //return $this->redirect(['view', 'id' => $model->anggaran_perbelanjaan_id]);
            return $model->save();
        } else {
            return $this->renderAjax('update', [
                'model' => $model,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Deletes an existing PermohonanEBantuanAnggaranPerbelanjaan model.
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
     * Finds the PermohonanEBantuanAnggaranPerbelanjaan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PermohonanEBantuanAnggaranPerbelanjaan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PermohonanEBantuanAnggaranPerbelanjaan::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
