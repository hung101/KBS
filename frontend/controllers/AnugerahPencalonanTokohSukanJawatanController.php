<?php

namespace frontend\controllers;

use Yii;
use app\models\AnugerahPencalonanTokohSukanJawatan;
use frontend\models\AnugerahPencalonanTokohSukanJawatanSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use app\models\general\GeneralVariable;

/**
 * AnugerahPencalonanTokohSukanJawatanController implements the CRUD actions for AnugerahPencalonanTokohSukanJawatan model.
 */
class AnugerahPencalonanTokohSukanJawatanController extends Controller
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
     * Lists all AnugerahPencalonanTokohSukanJawatan models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AnugerahPencalonanTokohSukanJawatanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AnugerahPencalonanTokohSukanJawatan model.
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
     * Creates a new AnugerahPencalonanTokohSukanJawatan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($anugerah_pencalonan_lain_id)
    {
        $model = new AnugerahPencalonanTokohSukanJawatan();
        
        Yii::$app->session->open();
        
        if($anugerah_pencalonan_lain_id != ''){
            $model->anugerah_pencalonan_lain_id = $anugerah_pencalonan_lain_id;
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
     * Updates an existing AnugerahPencalonanTokohSukanJawatan model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
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
     * Deletes an existing AnugerahPencalonanTokohSukanJawatan model.
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
     * Finds the AnugerahPencalonanTokohSukanJawatan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AnugerahPencalonanTokohSukanJawatan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AnugerahPencalonanTokohSukanJawatan::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
