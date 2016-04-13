<?php

namespace frontend\controllers;

use Yii;
use app\models\SoalSelidikSebelumUjianSoalanJawapanHpt;
use frontend\models\SoalSelidikSebelumUjianSoalanJawapanHptSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use app\models\general\GeneralVariable;

use app\models\RefSoalanSoalSelidikHpt;
use app\models\RefJawapanSoalSelidikHpt;

/**
 * SoalSelidikSebelumUjianSoalanJawapanHptController implements the CRUD actions for SoalSelidikSebelumUjianSoalanJawapanHpt model.
 */
class SoalSelidikSebelumUjianSoalanJawapanHptController extends Controller
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
     * Lists all SoalSelidikSebelumUjianSoalanJawapanHpt models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $searchModel = new SoalSelidikSebelumUjianSoalanJawapanHptSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single SoalSelidikSebelumUjianSoalanJawapanHpt model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = $this->findModel($id);
        
        $ref = RefSoalanSoalSelidikHpt::findOne(['id' => $model->soalan]);
        $model->soalan = $ref['desc'];
        
        $ref = RefJawapanSoalSelidikHpt::findOne(['id' => $model->jawapan]);
        $model->jawapan = $ref['desc'];
        
        return $this->renderAjax('view', [
            'model' => $model,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new SoalSelidikSebelumUjianSoalanJawapanHpt model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($soal_selidik_sebelum_ujian_id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new SoalSelidikSebelumUjianSoalanJawapanHpt();
        
        Yii::$app->session->open();
        
        if($soal_selidik_sebelum_ujian_id != ''){
            $model->soal_selidik_sebelum_ujian_id = $soal_selidik_sebelum_ujian_id;
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
     * Updates an existing SoalSelidikSebelumUjianSoalanJawapanHpt model.
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
     * Deletes an existing SoalSelidikSebelumUjianSoalanJawapanHpt model.
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
     * Finds the SoalSelidikSebelumUjianSoalanJawapanHpt model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return SoalSelidikSebelumUjianSoalanJawapanHpt the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SoalSelidikSebelumUjianSoalanJawapanHpt::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
