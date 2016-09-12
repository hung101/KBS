<?php

namespace frontend\controllers;

use Yii;
use app\models\PengurusanSajianMakan;
use frontend\models\PengurusanSajianMakanSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

// contant values
use app\models\general\GeneralVariable;

// table reference
use app\models\Atlet;

/**
 * PengurusanSajianMakanController implements the CRUD actions for PengurusanSajianMakan model.
 */
class PengurusanSajianMakanController extends Controller
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
     * Lists all PengurusanSajianMakan models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $searchModel = new PengurusanSajianMakanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PengurusanSajianMakan model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = $this->findModel($id);
        
        //$ref = Atlet::findOne(['atlet_id' => $model->atlet_id]);
        //$model->atlet_id = $ref['nameAndIC'];
        
        return $this->render('view', [
            'model' => $model,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new PengurusanSajianMakan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new PengurusanSajianMakan();
        
        if ($model->load(Yii::$app->request->post())) {
            $model->bilangan_tempahan_makan = implode(",",$model->bilangan_tempahan_makan);
            
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->pengurusan_sajian_makan_id]);
            }
        }
        
        return $this->render('create', [
                'model' => $model,
                'readonly' => false,
            ]);
    }

    /**
     * Updates an existing PengurusanSajianMakan model.
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

        if ($model->load(Yii::$app->request->post())) {
            $model->bilangan_tempahan_makan = implode(",",$model->bilangan_tempahan_makan);
            
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->pengurusan_sajian_makan_id]);
            }
        }
            
        $model->bilangan_tempahan_makan=explode(',',$model->bilangan_tempahan_makan);

        return $this->render('update', [
            'model' => $model,
            'readonly' => false,
        ]);
        
    }

    /**
     * Deletes an existing PengurusanSajianMakan model.
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
     * Finds the PengurusanSajianMakan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PengurusanSajianMakan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PengurusanSajianMakan::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
