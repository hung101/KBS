<?php

namespace frontend\controllers;

use Yii;
use app\models\RefStatusDiagnosisPreskripsiPemeriksaanPenyiasatan;
use frontend\models\RefStatusDiagnosisPreskripsiPemeriksaanPenyiasatanSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RefStatusDiagnosisPreskripsiPemeriksaanPenyiasatanController implements the CRUD actions for RefStatusDiagnosisPreskripsiPemeriksaanPenyiasatan model.
 */
class RefStatusDiagnosisPreskripsiPemeriksaanPenyiasatanController extends Controller
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
     * Lists all RefStatusDiagnosisPreskripsiPemeriksaanPenyiasatan models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RefStatusDiagnosisPreskripsiPemeriksaanPenyiasatanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single RefStatusDiagnosisPreskripsiPemeriksaanPenyiasatan model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new RefStatusDiagnosisPreskripsiPemeriksaanPenyiasatan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new RefStatusDiagnosisPreskripsiPemeriksaanPenyiasatan();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing RefStatusDiagnosisPreskripsiPemeriksaanPenyiasatan model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing RefStatusDiagnosisPreskripsiPemeriksaanPenyiasatan model.
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
     * Finds the RefStatusDiagnosisPreskripsiPemeriksaanPenyiasatan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return RefStatusDiagnosisPreskripsiPemeriksaanPenyiasatan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = RefStatusDiagnosisPreskripsiPemeriksaanPenyiasatan::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
