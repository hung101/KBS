<?php

namespace frontend\controllers;

use Yii;
use app\models\PermohonanInovasiPeralatan;
use frontend\models\PermohonanInovasiPeralatanSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use app\models\general\GeneralVariable;
use common\models\general\GeneralFunction;

// table reference
use app\models\RefStatusPermohonanProjekInovasi;
use app\models\RefBahagianCawanganPusat;

/**
 * PermohonanInovasiPeralatanController implements the CRUD actions for PermohonanInovasiPeralatan model.
 */
class PermohonanInovasiPeralatanController extends Controller
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
     * Lists all PermohonanInovasiPeralatan models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $searchModel = new PermohonanInovasiPeralatanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PermohonanInovasiPeralatan model.
     * @param integer $id delete
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = $this->findModel($id);
        
        $ref = RefStatusPermohonanProjekInovasi::findOne(['id' => $model->status_permohonan]);
        $model->status_permohonan = $ref['desc'];
        
        $ref = RefBahagianCawanganPusat::findOne(['id' => $model->bahagian_cawangan_pusat]);
        $model->bahagian_cawangan_pusat = $ref['desc'];
        
        if($model->tarikh_permohonan != "") {$model->tarikh_permohonan = GeneralFunction::convert($model->tarikh_permohonan);}
        if($model->tarikh_status != "") {$model->tarikh_status = GeneralFunction::convert($model->tarikh_status, GeneralFunction::TYPE_DATE);}
        
        return $this->render('view', [
            'model' => $model,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new PermohonanInovasiPeralatan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new PermohonanInovasiPeralatan();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->permohonan_inovasi_peralatan_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Updates an existing PermohonanInovasiPeralatan model.
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

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->permohonan_inovasi_peralatan_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Deletes an existing PermohonanInovasiPeralatan model.
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
     * Finds the PermohonanInovasiPeralatan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PermohonanInovasiPeralatan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PermohonanInovasiPeralatan::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
