<?php

namespace frontend\controllers;

use Yii;
use app\models\LtbsSenaraiNamaHadirAgm;
use app\models\LtbsSenaraiNamaHadirAgmSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use app\models\general\GeneralVariable;

/**
 * LtbsSenaraiNamaHadirAgmController implements the CRUD actions for LtbsSenaraiNamaHadirAgm model.
 */
class LtbsSenaraiNamaHadirAgmController extends Controller
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
     * Lists all LtbsSenaraiNamaHadirAgm models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $searchModel = new LtbsSenaraiNamaHadirAgmSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single LtbsSenaraiNamaHadirAgm model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        return $this->renderAjax('view', [
            'model' => $this->findModel($id),
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new LtbsSenaraiNamaHadirAgm model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($mesyuarat_agm_id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new LtbsSenaraiNamaHadirAgm();
        
        Yii::$app->session->open();
        
        if($mesyuarat_agm_id != ''){
            $model->mesyuarat_agm_id = $mesyuarat_agm_id;
        } else {
            if(isset(Yii::$app->session->id)){
                $model->session_id = Yii::$app->session->id;
            }
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //return $this->redirect(['view', 'id' => $model->senarai_nama_hadir_id]);
            return $model->save();
        } else {
            return $this->renderAjax('create', [
                'model' => $model,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Updates an existing LtbsSenaraiNamaHadirAgm model.
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
            //return $this->redirect(['view', 'id' => $model->senarai_nama_hadir_id]);
            return $model->save();
        } else {
            return $this->renderAjax('update', [
                'model' => $model,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Deletes an existing LtbsSenaraiNamaHadirAgm model.
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
     * Finds the LtbsSenaraiNamaHadirAgm model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return LtbsSenaraiNamaHadirAgm the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = LtbsSenaraiNamaHadirAgm::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
