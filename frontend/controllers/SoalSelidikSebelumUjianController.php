<?php

namespace frontend\controllers;

use Yii;
use app\models\SoalSelidikSebelumUjian;
use frontend\models\SoalSelidikSebelumUjianSearch;
use app\models\SoalSelidikSebelumUjianSoalanJawapan;
use frontend\models\SoalSelidikSebelumUjianSoalanJawapanSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use app\models\general\GeneralVariable;

// table reference
use app\models\Atlet;
use app\models\RefSoalanSoalSelidik;
use app\models\RefJawapanSoalSelidik;
use app\models\RefSukan;

/**
 * SoalSelidikSebelumUjianController implements the CRUD actions for SoalSelidikSebelumUjian model.
 */
class SoalSelidikSebelumUjianController extends Controller
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
     * Lists all SoalSelidikSebelumUjian models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $searchModel = new SoalSelidikSebelumUjianSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single SoalSelidikSebelumUjian model.
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
        
        $queryPar['SoalSelidikSebelumUjianSoalanJawapanSearch']['soal_selidik_sebelum_ujian_id'] = $id;
        
        $searchModelSoalSelidikSebelumUjianSoalanJawapan= new SoalSelidikSebelumUjianSoalanJawapanSearch();
        $dataProviderSoalSelidikSebelumUjianSoalanJawapan = $searchModelSoalSelidikSebelumUjianSoalanJawapan->search($queryPar);
        
        $ref = Atlet::findOne(['atlet_id' => $model->atlet_id]);
        $model->atlet_id = $ref['nameAndIC'];
        
        $ref = RefSoalanSoalSelidik::findOne(['id' => $model->soalan]);
        $model->soalan = $ref['desc'];
        
        $ref = RefJawapanSoalSelidik::findOne(['id' => $model->jawapan]);
        $model->jawapan = $ref['desc'];
        
        $ref = RefSukan::findOne(['id' => $model->jenis_sukan]);
        $model->jenis_sukan = $ref['desc'];
        
        return $this->render('view', [
            'model' => $model,
            'searchModelSoalSelidikSebelumUjianSoalanJawapan' => $searchModelSoalSelidikSebelumUjianSoalanJawapan,
            'dataProviderSoalSelidikSebelumUjianSoalanJawapan' => $dataProviderSoalSelidikSebelumUjianSoalanJawapan,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new SoalSelidikSebelumUjian model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new SoalSelidikSebelumUjian();
        
        $queryPar = null;
        
        Yii::$app->session->open();
        
        if(isset(Yii::$app->session->id)){
            $queryPar['SoalSelidikSebelumUjianSoalanJawapanSearch']['session_id'] = Yii::$app->session->id;
        }
        
        $searchModelSoalSelidikSebelumUjianSoalanJawapan= new SoalSelidikSebelumUjianSoalanJawapanSearch();
        $dataProviderSoalSelidikSebelumUjianSoalanJawapan = $searchModelSoalSelidikSebelumUjianSoalanJawapan->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            // update all the temporary session id with soal_selidik_sebelum_ujian_id
            if(isset(Yii::$app->session->id)){
                SoalSelidikSebelumUjianSoalanJawapan::updateAll(['soal_selidik_sebelum_ujian_id' => $model->soal_selidik_sebelum_ujian_id], 'session_id = "'.Yii::$app->session->id.'"');
                SoalSelidikSebelumUjianSoalanJawapan::updateAll(['session_id' => ''], 'soal_selidik_sebelum_ujian_id = "'.$model->soal_selidik_sebelum_ujian_id.'"');
            }
            
            return $this->redirect(['view', 'id' => $model->soal_selidik_sebelum_ujian_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'searchModelSoalSelidikSebelumUjianSoalanJawapan' => $searchModelSoalSelidikSebelumUjianSoalanJawapan,
                'dataProviderSoalSelidikSebelumUjianSoalanJawapan' => $dataProviderSoalSelidikSebelumUjianSoalanJawapan,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Updates an existing SoalSelidikSebelumUjian model.
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
        
        $queryPar['SoalSelidikSebelumUjianSoalanJawapanSearch']['soal_selidik_sebelum_ujian_id'] = $id;
        
        $searchModelSoalSelidikSebelumUjianSoalanJawapan= new SoalSelidikSebelumUjianSoalanJawapanSearch();
        $dataProviderSoalSelidikSebelumUjianSoalanJawapan = $searchModelSoalSelidikSebelumUjianSoalanJawapan->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->soal_selidik_sebelum_ujian_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'searchModelSoalSelidikSebelumUjianSoalanJawapan' => $searchModelSoalSelidikSebelumUjianSoalanJawapan,
                'dataProviderSoalSelidikSebelumUjianSoalanJawapan' => $dataProviderSoalSelidikSebelumUjianSoalanJawapan,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Deletes an existing SoalSelidikSebelumUjian model.
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
     * Finds the SoalSelidikSebelumUjian model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return SoalSelidikSebelumUjian the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SoalSelidikSebelumUjian::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
