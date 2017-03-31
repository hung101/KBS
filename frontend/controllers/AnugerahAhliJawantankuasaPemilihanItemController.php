<?php

namespace frontend\controllers;

use Yii;
use app\models\AnugerahAhliJawantankuasaPemilihanItem;
use frontend\models\AnugerahAhliJawantankuasaPemilihanItemSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use app\models\general\GeneralVariable;
use app\models\general\GeneralLabel;

use app\models\RefJawatanJawatankuasaPemilihan;
use app\models\RefPerwakilan;

/**
 * AnugerahAhliJawantankuasaPemilihanItemController implements the CRUD actions for AnugerahAhliJawantankuasaPemilihanItem model.
 */
class AnugerahAhliJawantankuasaPemilihanItemController extends Controller
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
     * Lists all AnugerahAhliJawantankuasaPemilihanItem models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AnugerahAhliJawantankuasaPemilihanItemSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AnugerahAhliJawantankuasaPemilihanItem model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        
        $ref = RefJawatanJawatankuasaPemilihan::findOne(['id' => $model->jawatan]);
        $model->jawatan = $ref['desc'];
        
        $ref = RefPerwakilan::findOne(['id' => $model->perwakilan]);
        $model->perwakilan = $ref['desc'];
        
        return $this->renderAjax('view', [
            'model' => $model,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new AnugerahAhliJawantankuasaPemilihanItem model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($anugerah_ahli_jawantankuasa_pemilihan_id)
    {
        $model = new AnugerahAhliJawantankuasaPemilihanItem();

        Yii::$app->session->open();
        
        if($anugerah_ahli_jawantankuasa_pemilihan_id != ''){
            $model->anugerah_ahli_jawantankuasa_pemilihan_id = $anugerah_ahli_jawantankuasa_pemilihan_id;
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
     * Updates an existing AnugerahAhliJawantankuasaPemilihanItem model.
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
     * Deletes an existing AnugerahAhliJawantankuasaPemilihanItem model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
    }

    /**
     * Finds the AnugerahAhliJawantankuasaPemilihanItem model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AnugerahAhliJawantankuasaPemilihanItem the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AnugerahAhliJawantankuasaPemilihanItem::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
