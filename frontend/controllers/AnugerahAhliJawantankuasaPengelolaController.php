<?php

namespace frontend\controllers;

use Yii;
use app\models\AnugerahAhliJawantankuasaPengelola;
use frontend\models\AnugerahAhliJawantankuasaPengelolaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

// table reference
use app\models\RefAjk;
use app\models\RefBahagianAjk;

/**
 * AnugerahAhliJawantankuasaPengelolaController implements the CRUD actions for AnugerahAhliJawantankuasaPengelola model.
 */
class AnugerahAhliJawantankuasaPengelolaController extends Controller
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
     * Lists all AnugerahAhliJawantankuasaPengelola models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AnugerahAhliJawantankuasaPengelolaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AnugerahAhliJawantankuasaPengelola model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        
        $ref = RefAjk::findOne(['id' => $model->ajk]);
        $model->ajk = $ref['desc'];
        
        $ref = RefBahagianAjk::findOne(['id' => $model->bahagian]);
        $model->bahagian = $ref['desc'];
        
        return $this->render('view', [
            'model' => $model,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new AnugerahAhliJawantankuasaPengelola model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AnugerahAhliJawantankuasaPengelola();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->anugerah_ahli_jawantankuasa_pengelola_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Updates an existing AnugerahAhliJawantankuasaPengelola model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->anugerah_ahli_jawantankuasa_pengelola_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Deletes an existing AnugerahAhliJawantankuasaPengelola model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id chmod(
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the AnugerahAhliJawantankuasaPengelola model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AnugerahAhliJawantankuasaPengelola the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AnugerahAhliJawantankuasaPengelola::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
