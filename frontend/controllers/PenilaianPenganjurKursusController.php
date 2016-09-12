<?php

namespace frontend\controllers;

use Yii;
use app\models\PenilaianPenganjurKursus;
use frontend\models\PenilaianPenganjurKursusSearch;
use app\models\PenilaianPenganjurKursusSoalan;
use frontend\models\PenilaianPenganjurKursusSoalanSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

// contant values
use app\models\general\GeneralVariable;

// table reference
use app\models\PengurusanPermohonanKursusPersatuan;

/**
 * PenilaianPenganjurKursusController implements the CRUD actions for PenilaianPenganjurKursus model.
 */
class PenilaianPenganjurKursusController extends Controller
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
     * Lists all PenilaianPenganjurKursus models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $searchModel = new PenilaianPenganjurKursusSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PenilaianPenganjurKursus model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        $model = $this->findModel($id);
        
        $ref = PengurusanPermohonanKursusPersatuan::findOne(['pengurusan_permohonan_kursus_persatuan_id' => $model->pengurusan_permohonan_kursus_persatuan_id]);
        $model->pengurusan_permohonan_kursus_persatuan_id = $ref['agensi'];
        
        $queryPar = null;
        
        $queryPar['PenilaianPenganjurKursusSoalanSearch']['penilaian_penganjur_kursus_id'] = $id;
        
        $searchModelPenilaianPenganjurKursusSoalan  = new PenilaianPenganjurKursusSoalanSearch();
        $dataProviderPenilaianPenganjurKursusSoalan = $searchModelPenilaianPenganjurKursusSoalan->search($queryPar);
        
        return $this->render('view', [
            'model' => $model,
            'searchModelPenilaianPenganjurKursusSoalan' => $searchModelPenilaianPenganjurKursusSoalan,
            'dataProviderPenilaianPenganjurKursusSoalan' => $dataProviderPenilaianPenganjurKursusSoalan,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new PenilaianPenganjurKursus model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new PenilaianPenganjurKursus();
        
        $queryPar = null;
        
        Yii::$app->session->open();
        
        if(isset(Yii::$app->session->id)){
            $queryPar['PenilaianPenganjurKursusSoalanSearch']['session_id'] = Yii::$app->session->id;
        }
        
        $searchModelPenilaianPenganjurKursusSoalan  = new PenilaianPenganjurKursusSoalanSearch();
        $dataProviderPenilaianPenganjurKursusSoalan = $searchModelPenilaianPenganjurKursusSoalan->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            
            if(isset(Yii::$app->session->id)){
                PenilaianPenganjurKursusSoalan::updateAll(['penilaian_penganjur_kursus_id' => $model->penilaian_penganjur_kursus_id], 'session_id = "'.Yii::$app->session->id.'"');
                PenilaianPenganjurKursusSoalan::updateAll(['session_id' => ''], 'penilaian_penganjur_kursus_id = "'.$model->penilaian_penganjur_kursus_id.'"');
            }
            
            return $this->redirect(['view', 'id' => $model->penilaian_penganjur_kursus_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'searchModelPenilaianPenganjurKursusSoalan' => $searchModelPenilaianPenganjurKursusSoalan,
                'dataProviderPenilaianPenganjurKursusSoalan' => $dataProviderPenilaianPenganjurKursusSoalan,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Updates an existing PenilaianPenganjurKursus model.
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
        
        $queryPar['PenilaianPenganjurKursusSoalanSearch']['penilaian_penganjur_kursus_id'] = $id;
        
        $searchModelPenilaianPenganjurKursusSoalan  = new PenilaianPenganjurKursusSoalanSearch();
        $dataProviderPenilaianPenganjurKursusSoalan = $searchModelPenilaianPenganjurKursusSoalan->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->penilaian_penganjur_kursus_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'searchModelPenilaianPenganjurKursusSoalan' => $searchModelPenilaianPenganjurKursusSoalan,
                'dataProviderPenilaianPenganjurKursusSoalan' => $dataProviderPenilaianPenganjurKursusSoalan,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Deletes an existing PenilaianPenganjurKursus model.
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
     * Finds the PenilaianPenganjurKursus model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PenilaianPenganjurKursus the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PenilaianPenganjurKursus::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
