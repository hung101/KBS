<?php

namespace frontend\controllers;

use Yii;
use app\models\RefUnitDiagnosisPreskripsiPemeriksaanPenyiasatan;
use frontend\models\RefUnitDiagnosisPreskripsiPemeriksaanPenyiasatanSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RefUnitDiagnosisPreskripsiPemeriksaanPenyiasatanController implements the CRUD actions for RefUnitDiagnosisPreskripsiPemeriksaanPenyiasatan model.
 */
class RefUnitDiagnosisPreskripsiPemeriksaanPenyiasatanController extends Controller
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
     * Lists all RefUnitDiagnosisPreskripsiPemeriksaanPenyiasatan models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RefUnitDiagnosisPreskripsiPemeriksaanPenyiasatanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single RefUnitDiagnosisPreskripsiPemeriksaanPenyiasatan model.
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
     * Creates a new RefUnitDiagnosisPreskripsiPemeriksaanPenyiasatan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new RefUnitDiagnosisPreskripsiPemeriksaanPenyiasatan();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing RefUnitDiagnosisPreskripsiPemeriksaanPenyiasatan model.
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
     * Deletes an existing RefUnitDiagnosisPreskripsiPemeriksaanPenyiasatan model.
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
     * Finds the RefUnitDiagnosisPreskripsiPemeriksaanPenyiasatan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return RefUnitDiagnosisPreskripsiPemeriksaanPenyiasatan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = RefUnitDiagnosisPreskripsiPemeriksaanPenyiasatan::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
