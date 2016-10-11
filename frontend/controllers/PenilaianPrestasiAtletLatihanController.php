<?php

namespace frontend\controllers;

use Yii;
use app\models\PenilaianPrestasiAtletLatihan;
use frontend\models\PenilaianPrestasiAtletLatihanSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use app\models\general\GeneralVariable;
use app\models\general\GeneralLabel;

/**
 * PenilaianPrestasiAtletLatihanController implements the CRUD actions for PenilaianPrestasiAtletLatihan model.
 */
class PenilaianPrestasiAtletLatihanController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all PenilaianPrestasiAtletLatihan models.
     * @return mixed
     */
    public function actionIndex($penilaian_prestasi_atlet_sasaran_id, $atlet_id, $penilaian_pestasi_id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $queryPar = Yii::$app->request->queryParams;
        
        $queryPar['PenilaianPrestasiAtletLatihanSearch']['penilaian_prestasi_atlet_sasaran_id'] = $penilaian_prestasi_atlet_sasaran_id;
        
        $searchModel = new PenilaianPrestasiAtletLatihanSearch();
        $dataProvider = $searchModel->search($queryPar);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'penilaian_prestasi_atlet_sasaran_id' => $penilaian_prestasi_atlet_sasaran_id,
            'atlet_id' => $atlet_id,
            'penilaian_pestasi_id' => $penilaian_pestasi_id,
        ]);
    }

    /**
     * Displays a single PenilaianPrestasiAtletLatihan model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        return $this->render('view', [
            'model' => $this->findModel($id),
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new PenilaianPrestasiAtletLatihan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($penilaian_prestasi_atlet_sasaran_id, $atlet_id, $penilaian_pestasi_id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new PenilaianPrestasiAtletLatihan();
        
        $model->penilaian_prestasi_atlet_sasaran_id = $penilaian_prestasi_atlet_sasaran_id;
        $model->atlet_id = $atlet_id;
        $model->penilaian_pestasi_id = $penilaian_pestasi_id;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->tbl_penilaian_prestasi_atlet_latihan_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Updates an existing PenilaianPrestasiAtletLatihan model.
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
            return $this->redirect(['view', 'id' => $model->tbl_penilaian_prestasi_atlet_latihan_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Deletes an existing PenilaianPrestasiAtletLatihan model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id, $penilaian_prestasi_atlet_sasaran_id, $atlet_id, $penilaian_pestasi_id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $this->findModel($id)->delete();

        return $this->redirect(['index', 'penilaian_prestasi_atlet_sasaran_id' =>$penilaian_prestasi_atlet_sasaran_id, 'atlet_id' =>$atlet_id, 'penilaian_pestasi_id' =>$penilaian_pestasi_id]);
    }

    /**
     * Finds the PenilaianPrestasiAtletLatihan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PenilaianPrestasiAtletLatihan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PenilaianPrestasiAtletLatihan::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
