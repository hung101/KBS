<?php

namespace frontend\controllers;

use Yii;
use app\models\RefStatusPermohonanGeranBantuanGajiJurulatih;
use frontend\models\RefStatusPermohonanGeranBantuanGajiJurulatihSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RefStatusPermohonanGeranBantuanGajiJurulatihController implements the CRUD actions for RefStatusPermohonanGeranBantuanGajiJurulatih model.
 */
class RefStatusPermohonanGeranBantuanGajiJurulatihController extends Controller
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
     * Lists all RefStatusPermohonanGeranBantuanGajiJurulatih models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RefStatusPermohonanGeranBantuanGajiJurulatihSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single RefStatusPermohonanGeranBantuanGajiJurulatih model.
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
     * Creates a new RefStatusPermohonanGeranBantuanGajiJurulatih model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new RefStatusPermohonanGeranBantuanGajiJurulatih();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing RefStatusPermohonanGeranBantuanGajiJurulatih model.
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
     * Deletes an existing RefStatusPermohonanGeranBantuanGajiJurulatih model.
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
     * Finds the RefStatusPermohonanGeranBantuanGajiJurulatih model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return RefStatusPermohonanGeranBantuanGajiJurulatih the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = RefStatusPermohonanGeranBantuanGajiJurulatih::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
