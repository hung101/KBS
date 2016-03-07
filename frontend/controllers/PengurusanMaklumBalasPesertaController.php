<?php

namespace frontend\controllers;

use Yii;
use app\models\PengurusanMaklumBalasPeserta;
use frontend\models\PengurusanMaklumBalasPesertaSearch;
use app\models\PengurusanSoalanMaklumBalasPeserta;
use frontend\models\PengurusanSoalanMaklumBalasPesertaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use app\models\general\GeneralVariable;

// table reference
use app\models\RefJantina;
use app\models\RefBangsa;

/**
 * PengurusanMaklumBalasPesertaController implements the CRUD actions for PengurusanMaklumBalasPeserta model.
 */
class PengurusanMaklumBalasPesertaController extends Controller
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
     * Lists all PengurusanMaklumBalasPeserta models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $searchModel = new PengurusanMaklumBalasPesertaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PengurusanMaklumBalasPeserta model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = $this->findModel($id);
        
        $ref = RefJantina::findOne(['id' => $model->jantina]);
        $model->jantina = $ref['desc'];
        
        $ref = RefBangsa::findOne(['id' => $model->bangsa]);
        $model->bangsa = $ref['desc'];
        
        $queryPar = null;
        
        $queryPar['PengurusanSoalanMaklumBalasPesertaSearch']['pengurusan_maklum_balas_peserta_id'] = $id;
        
        $searchModelPengurusanSoalanMaklumBalasPeserta  = new PengurusanSoalanMaklumBalasPesertaSearch();
        $dataProviderPengurusanSoalanMaklumBalasPeserta = $searchModelPengurusanSoalanMaklumBalasPeserta->search($queryPar);
        
        return $this->render('view', [
            'model' => $model,
            'searchModelPengurusanSoalanMaklumBalasPeserta' => $searchModelPengurusanSoalanMaklumBalasPeserta,
            'dataProviderPengurusanSoalanMaklumBalasPeserta' => $dataProviderPengurusanSoalanMaklumBalasPeserta,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new PengurusanMaklumBalasPeserta model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new PengurusanMaklumBalasPeserta();
        $queryPar = null;
        
        Yii::$app->session->open();
        
        if(isset(Yii::$app->session->id)){
            $queryPar['PengurusanSoalanMaklumBalasPesertaSearch']['session_id'] = Yii::$app->session->id;
        }
        
        $searchModelPengurusanSoalanMaklumBalasPeserta  = new PengurusanSoalanMaklumBalasPesertaSearch();
        $dataProviderPengurusanSoalanMaklumBalasPeserta = $searchModelPengurusanSoalanMaklumBalasPeserta->search($queryPar);
        

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if(isset(Yii::$app->session->id)){
                PengurusanSoalanMaklumBalasPeserta::updateAll(['pengurusan_maklum_balas_peserta_id' => $model->pengurusan_maklum_balas_peserta_id], 'session_id = "'.Yii::$app->session->id.'"');
                PengurusanSoalanMaklumBalasPeserta::updateAll(['session_id' => ''], 'pengurusan_maklum_balas_peserta_id = "'.$model->pengurusan_maklum_balas_peserta_id.'"');
            }
            
            return $this->redirect(['view', 'id' => $model->pengurusan_maklum_balas_peserta_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'searchModelPengurusanSoalanMaklumBalasPeserta' => $searchModelPengurusanSoalanMaklumBalasPeserta,
                'dataProviderPengurusanSoalanMaklumBalasPeserta' => $dataProviderPengurusanSoalanMaklumBalasPeserta,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Updates an existing PengurusanMaklumBalasPeserta model.
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
        
        $queryPar['PengurusanSoalanMaklumBalasPesertaSearch']['pengurusan_maklum_balas_peserta_id'] = $id;
        
        $searchModelPengurusanSoalanMaklumBalasPeserta  = new PengurusanSoalanMaklumBalasPesertaSearch();
        $dataProviderPengurusanSoalanMaklumBalasPeserta = $searchModelPengurusanSoalanMaklumBalasPeserta->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->pengurusan_maklum_balas_peserta_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'searchModelPengurusanSoalanMaklumBalasPeserta' => $searchModelPengurusanSoalanMaklumBalasPeserta,
                'dataProviderPengurusanSoalanMaklumBalasPeserta' => $dataProviderPengurusanSoalanMaklumBalasPeserta,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Deletes an existing PengurusanMaklumBalasPeserta model.
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
     * Finds the PengurusanMaklumBalasPeserta model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PengurusanMaklumBalasPeserta the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PengurusanMaklumBalasPeserta::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
