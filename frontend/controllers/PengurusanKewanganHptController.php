<?php

namespace frontend\controllers;

use Yii;
use app\models\PengurusanKewanganHpt;
use frontend\models\PengurusanKewanganHptSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use app\models\general\GeneralVariable;
use common\models\general\GeneralFunction;

// table reference
use app\models\RefSukan;
use app\models\RefKategoriPenggunaanHpt;

/**
 * PengurusanKewanganHptController implements the CRUD actions for PengurusanKewanganHpt model.
 */
class PengurusanKewanganHptController extends Controller
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
     * Lists all PengurusanKewanganHpt models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $searchModel = new PengurusanKewanganHptSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PengurusanKewanganHpt model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = $this->findModel($id);
        
        $ref = RefSukan::findOne(['id' => $model->nama_acara_program]);
        $model->nama_acara_program = $ref['desc'];
        
        $ref = RefKategoriPenggunaanHpt::findOne(['id' => $model->kategori_penggunaan]);
        $model->kategori_penggunaan = $ref['desc'];
        
        if($model->tarikh_acara != "") {$model->tarikh_acara = GeneralFunction::convert($model->tarikh_acara, GeneralFunction::TYPE_DATE);}
        
        return $this->render('view', [
            'model' => $model,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new PengurusanKewanganHpt model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new PengurusanKewanganHpt();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->pengurusan_kewangan_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Updates an existing PengurusanKewanganHpt model.
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
            return $this->redirect(['view', 'id' => $model->pengurusan_kewangan_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Deletes an existing PengurusanKewanganHpt model.
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
     * Finds the PengurusanKewanganHpt model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PengurusanKewanganHpt the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PengurusanKewanganHpt::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
