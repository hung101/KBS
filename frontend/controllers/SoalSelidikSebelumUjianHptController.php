<?php

namespace frontend\controllers;

use Yii;
use app\models\SoalSelidikSebelumUjianHpt;
use frontend\models\SoalSelidikSebelumUjianHptSearch;
use app\models\SoalSelidikSebelumUjianSoalanJawapanHpt;
use frontend\models\SoalSelidikSebelumUjianSoalanJawapanHptSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use app\models\general\GeneralVariable;

// table reference
use app\models\Atlet;
use app\models\RefSoalanSoalSelidik;
use app\models\RefJawapanSoalSelidik;

/**
 * SoalSelidikSebelumUjianHptController implements the CRUD actions for SoalSelidikSebelumUjianHpt model.
 */
class SoalSelidikSebelumUjianHptController extends Controller
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
     * Lists all SoalSelidikSebelumUjianHpt models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $searchModel = new SoalSelidikSebelumUjianHptSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single SoalSelidikSebelumUjianHpt model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = $this->findModel($id);
        
        $queryPar = null;
        
        $queryPar['SoalSelidikSebelumUjianSoalanJawapanHptSearch']['soal_selidik_sebelum_ujian_id'] = $id;
        
        $searchModelSoalSelidikSebelumUjianSoalanJawapanHpt= new SoalSelidikSebelumUjianSoalanJawapanHptSearch();
        $dataProviderSoalSelidikSebelumUjianSoalanJawapanHpt = $searchModelSoalSelidikSebelumUjianSoalanJawapanHpt->search($queryPar);
        
        $ref = Atlet::findOne(['atlet_id' => $model->atlet_id]);
        $model->atlet_id = $ref['nameAndIC'];
        
        $ref = RefSoalanSoalSelidik::findOne(['id' => $model->soalan]);
        $model->soalan = $ref['desc'];
        
        $ref = RefJawapanSoalSelidik::findOne(['id' => $model->jawapan]);
        $model->jawapan = $ref['desc'];
        
        return $this->render('view', [
            'model' => $model,
            'searchModelSoalSelidikSebelumUjianSoalanJawapanHpt' => $searchModelSoalSelidikSebelumUjianSoalanJawapanHpt,
            'dataProviderSoalSelidikSebelumUjianSoalanJawapanHpt' => $dataProviderSoalSelidikSebelumUjianSoalanJawapanHpt,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new SoalSelidikSebelumUjianHpt model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new SoalSelidikSebelumUjianHpt();
        
        $queryPar = null;
        
        Yii::$app->session->open();
        
        if(isset(Yii::$app->session->id)){
            $queryPar['SoalSelidikSebelumUjianSoalanJawapanHptSearch']['session_id'] = Yii::$app->session->id;
        }
        
        $searchModelSoalSelidikSebelumUjianSoalanJawapanHpt= new SoalSelidikSebelumUjianSoalanJawapanHptSearch();
        $dataProviderSoalSelidikSebelumUjianSoalanJawapanHpt = $searchModelSoalSelidikSebelumUjianSoalanJawapanHpt->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            // update all the temporary session id with soal_selidik_sebelum_ujian_id
            if(isset(Yii::$app->session->id)){
                SoalSelidikSebelumUjianSoalanJawapanHpt::updateAll(['soal_selidik_sebelum_ujian_id' => $model->soal_selidik_sebelum_ujian_id], 'session_id = "'.Yii::$app->session->id.'"');
                SoalSelidikSebelumUjianSoalanJawapanHpt::updateAll(['session_id' => ''], 'soal_selidik_sebelum_ujian_id = "'.$model->soal_selidik_sebelum_ujian_id.'"');
            }
            
            return $this->redirect(['view', 'id' => $model->soal_selidik_sebelum_ujian_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'searchModelSoalSelidikSebelumUjianSoalanJawapanHpt' => $searchModelSoalSelidikSebelumUjianSoalanJawapanHpt,
                'dataProviderSoalSelidikSebelumUjianSoalanJawapanHpt' => $dataProviderSoalSelidikSebelumUjianSoalanJawapanHpt,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Updates an existing SoalSelidikSebelumUjianHpt model.
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
        
        $queryPar = null;
        
        $queryPar['SoalSelidikSebelumUjianSoalanJawapanHptSearch']['soal_selidik_sebelum_ujian_id'] = $id;
        
        $searchModelSoalSelidikSebelumUjianSoalanJawapanHpt= new SoalSelidikSebelumUjianSoalanJawapanHptSearch();
        $dataProviderSoalSelidikSebelumUjianSoalanJawapanHpt = $searchModelSoalSelidikSebelumUjianSoalanJawapanHpt->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->soal_selidik_sebelum_ujian_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'searchModelSoalSelidikSebelumUjianSoalanJawapanHpt' => $searchModelSoalSelidikSebelumUjianSoalanJawapanHpt,
                'dataProviderSoalSelidikSebelumUjianSoalanJawapanHpt' => $dataProviderSoalSelidikSebelumUjianSoalanJawapanHpt,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Deletes an existing SoalSelidikSebelumUjianHpt model.
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
     * Finds the SoalSelidikSebelumUjianHpt model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return SoalSelidikSebelumUjianHpt the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SoalSelidikSebelumUjianHpt::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
