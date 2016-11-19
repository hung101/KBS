<?php

namespace frontend\controllers;

use Yii;
use app\models\PengurusanAnjuran;
use frontend\models\PengurusanAnjuranSearch;
use app\models\PengurusanAnjuranNegara;
use frontend\models\PengurusanAnjuranNegaraSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

// contant values
use app\models\general\GeneralVariable;

// table reference
use app\models\RefNegara;
use app\models\RefBadanSukanAntarabangsa;
use app\models\RefDelegasi;
use app\models\Atlet;

/**
 * PengurusanAnjuranController implements the CRUD actions for PengurusanAnjuran model.
 */
class PengurusanAnjuranController extends Controller
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
     * Lists all PengurusanAnjuran models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $searchModel = new PengurusanAnjuranSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PengurusanAnjuran model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = $this->findModel($id);
        
        $ref = RefBadanSukanAntarabangsa::findOne(['id' => $model->nama_badan_sukan_antarabangsa]);
        $model->nama_badan_sukan_antarabangsa = $ref['desc'];
        
        $ref = RefDelegasi::findOne(['id' => $model->nama_delegasi]);
        $model->nama_delegasi = $ref['desc'];
        
        $ref = RefNegara::findOne(['id' => $model->negara]);
        $model->negara = $ref['desc'];
        
        $queryPar = null;
        
        $queryPar['PengurusanAnjuranNegaraSearch']['pengurusan_anjuran_id'] = $id;
        
        $searchModelPengurusanAnjuranNegara  = new PengurusanAnjuranNegaraSearch();
        $dataProviderPengurusanAnjuranNegara = $searchModelPengurusanAnjuranNegara->search($queryPar);
        
        return $this->render('view', [
            'model' => $model,
            'searchModelPengurusanAnjuranNegara' => $searchModelPengurusanAnjuranNegara,
            'dataProviderPengurusanAnjuranNegara' => $dataProviderPengurusanAnjuranNegara,
            'readonly' => true,
        ]);
    }
    
    public function actionGetAlet($id)
    {
        if (($model = Atlet::findOne($id)) !== null) {
            return $model->delete();
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Creates a new PengurusanAnjuran model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new PengurusanAnjuran();
        
        $queryPar = null;
        
        Yii::$app->session->open();
        
        if(isset(Yii::$app->session->id)){
            $queryPar['PengurusanAnjuranNegaraSearch']['session_id'] = Yii::$app->session->id;
        }
        
        $searchModelPengurusanAnjuranNegara  = new PengurusanAnjuranNegaraSearch();
        $dataProviderPengurusanAnjuranNegara = $searchModelPengurusanAnjuranNegara->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if(isset(Yii::$app->session->id)){
                PengurusanAnjuranNegara::updateAll(['pengurusan_anjuran_id' => $model->pengurusan_anjuran_id], 'session_id = "'.Yii::$app->session->id.'"');
                PengurusanAnjuranNegara::updateAll(['session_id' => ''], 'pengurusan_anjuran_id = "'.$model->pengurusan_anjuran_id.'"');
            }
            
            return $this->redirect(['view', 'id' => $model->pengurusan_anjuran_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'searchModelPengurusanAnjuranNegara' => $searchModelPengurusanAnjuranNegara,
                'dataProviderPengurusanAnjuranNegara' => $dataProviderPengurusanAnjuranNegara,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Updates an existing PengurusanAnjuran model.
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
        
        $queryPar['PengurusanAnjuranNegaraSearch']['pengurusan_anjuran_id'] = $id;
        
        $searchModelPengurusanAnjuranNegara  = new PengurusanAnjuranNegaraSearch();
        $dataProviderPengurusanAnjuranNegara = $searchModelPengurusanAnjuranNegara->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->pengurusan_anjuran_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'searchModelPengurusanAnjuranNegara' => $searchModelPengurusanAnjuranNegara,
                'dataProviderPengurusanAnjuranNegara' => $dataProviderPengurusanAnjuranNegara,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Deletes an existing PengurusanAnjuran model.
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
     * Finds the PengurusanAnjuran model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PengurusanAnjuran the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PengurusanAnjuran::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
