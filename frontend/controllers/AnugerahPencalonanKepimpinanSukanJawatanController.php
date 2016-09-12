<?php

namespace frontend\controllers;

use Yii;
use app\models\AnugerahPencalonanKepimpinanSukanJawatan;
use frontend\models\AnugerahPencalonanKepimpinanSukanJawatanSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use app\models\general\GeneralVariable;

/**
 * AnugerahPencalonanKepimpinanSukanJawatanController implements the CRUD actions for AnugerahPencalonanKepimpinanSukanJawatan model.
 */
class AnugerahPencalonanKepimpinanSukanJawatanController extends Controller
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
     * Lists all AnugerahPencalonanKepimpinanSukanJawatan models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AnugerahPencalonanKepimpinanSukanJawatanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AnugerahPencalonanKepimpinanSukanJawatan model.
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
     * Creates a new AnugerahPencalonanKepimpinanSukanJawatan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($anugerah_pencalonan_lain_id)
    {
        $model = new AnugerahPencalonanKepimpinanSukanJawatan();
        
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
     * Updates an existing AnugerahPencalonanKepimpinanSukanJawatan model.
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
     * Deletes an existing AnugerahPencalonanKepimpinanSukanJawatan model.
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
     * Finds the AnugerahPencalonanKepimpinanSukanJawatan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AnugerahPencalonanKepimpinanSukanJawatan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AnugerahPencalonanKepimpinanSukanJawatan::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
