<?php

namespace frontend\controllers;

use Yii;
use app\models\JenisKebajikan;
use app\models\JenisKebajikanSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;

// table reference
use app\models\RefJenisKebajikan;
use app\models\RefPerkara;
use app\models\RefSukanSkimKebajikan;

/**
 * JenisKebajikanController implements the CRUD actions for JenisKebajikan model.
 */
class JenisKebajikanController extends Controller
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
     * Lists all JenisKebajikan models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new JenisKebajikanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single JenisKebajikan model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        
        $ref = RefJenisKebajikan::findOne(['id' => $model->jenis_kebajikan]);
        $model->jenis_kebajikan = $ref['desc'];
        
        $ref = RefPerkara::findOne(['id' => $model->perkara]);
        $model->perkara = $ref['desc'];
        
        $ref = RefSukanSkimKebajikan::findOne(['id' => $model->sukan]);
        $model->sukan = $ref['desc'];
        
        return $this->render('view', [
            'model' => $model,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new JenisKebajikan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new JenisKebajikan();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->jenis_kebajikan_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Updates an existing JenisKebajikan model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->jenis_kebajikan_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Deletes an existing JenisKebajikan model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the JenisKebajikan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return JenisKebajikan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = JenisKebajikan::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionGetTetapan($jenisBantuanId, $perkaraId, $sukanId){
        // find Ahli Jawatankuasa Induk
        $model = JenisKebajikan::find()->where('jenis_kebajikan = :jenisBantuanId AND perkara = :perkaraId AND sukan = :sukanId', 
                                                [':jenisBantuanId' => $jenisBantuanId, ':perkaraId' => $perkaraId, ':sukanId' => $sukanId])->one();
        
        echo Json::encode($model);
    }
}
