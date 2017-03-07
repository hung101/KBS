<?php

namespace frontend\controllers;

use Yii;
use app\models\PengurusanProgramBinaanKategori;
use frontend\models\PengurusanProgramBinaanKategoriSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use app\models\general\GeneralVariable;

use app\models\RefKategoriProgramBinaan;

/**
 * PengurusanProgramBinaanKategoriController implements the CRUD actions for PengurusanProgramBinaanKategori model.
 */
class PengurusanProgramBinaanKategoriController extends Controller
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
     * Lists all PengurusanProgramBinaanKategori models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $searchModel = new PengurusanProgramBinaanKategoriSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PengurusanProgramBinaanKategori model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = $this->findModel($id);
        
        $ref = RefKategoriProgramBinaan::findOne(['id' => $model->kategori]);
        $model->kategori = $ref['desc'];
        
        return $this->renderAjax('view', [
            'model' => $model,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new PengurusanProgramBinaanKategori model.
     * If creation is successful, the browser will be redirected to the 'view' page.Jurulatih::findOne($id)
     * @return mixed
     */
    public function actionCreate($pengurusan_program_binaan_id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new PengurusanProgramBinaanKategori();
        
        Yii::$app->session->open();
        
        if($pengurusan_program_binaan_id != ''){
            $model->pengurusan_program_binaan_id = $pengurusan_program_binaan_id;
        } else {
            if(isset(Yii::$app->session->id)){
                $model->session_id = Yii::$app->session->id;
            }
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return '1';
        } else {
            return $this->renderAjax('create', [
                'model' => $model,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Updates an existing PengurusanProgramBinaanKategori model.
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
            return '1';
        } else {
            return $this->renderAjax('update', [
                'model' => $model,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Deletes an existing PengurusanProgramBinaanKategori model.
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

        //return $this->redirect(['index']);
    }

    /**
     * Finds the PengurusanProgramBinaanKategori model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PengurusanProgramBinaanKategori the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PengurusanProgramBinaanKategori::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
