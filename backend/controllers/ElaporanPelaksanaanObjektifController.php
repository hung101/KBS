<?php

namespace backend\controllers;

use Yii;
use app\models\ElaporanPelaksanaanObjektif;
use backend\models\ElaporanPelaksanaanObjektifSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ElaporanPelaksanaanObjektifController implements the CRUD actions for ElaporanPelaksanaanObjektif model.
 */
class ElaporanPelaksanaanObjektifController extends Controller
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
     * Lists all ElaporanPelaksanaanObjektif models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ElaporanPelaksanaanObjektifSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ElaporanPelaksanaanObjektif model.
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
     * Creates a new ElaporanPelaksanaanObjektif model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($elaporan_pelaksaan_id)
    {
        $model = new ElaporanPelaksanaanObjektif();
        
        Yii::$app->session->open();
        
        if($elaporan_pelaksaan_id != ''){
            $model->elaporan_pelaksaan_id = $elaporan_pelaksaan_id;
        } else {
            if(isset(Yii::$app->session->id)){
                $model->session_id = Yii::$app->session->id;
            }
        }

        if ($model->load(Yii::$app->request->post())) {
            //return $this->redirect(['view', 'id' => $model->elaporan_pelaksanaan_objektif_id]);
            return $model->save();
        } else {
            return $this->renderAjax('create', [
                'model' => $model,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Updates an existing ElaporanPelaksanaanObjektif model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            //return $this->redirect(['view', 'id' => $model->elaporan_pelaksanaan_objektif_id]);
            return $model->save();
        } else {
            return $this->renderAjax('update', [
                'model' => $model,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Deletes an existing ElaporanPelaksanaanObjektif model.
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
     * Finds the ElaporanPelaksanaanObjektif model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ElaporanPelaksanaanObjektif the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ElaporanPelaksanaanObjektif::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
