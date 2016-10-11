<?php

namespace backend\controllers;

use Yii;
use app\models\PengurusanKemudahanVenueMsn;
use backend\models\PengurusanKemudahanVenueMsnSearch;
use app\models\PengurusanKemudahanSediaAdaMsn;
use backend\models\PengurusanKemudahanSediaAdaMsnSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use yii\web\Session;

use app\models\general\GeneralVariable;

// table reference
use app\models\RefNegeri;
use app\models\RefBandar;
use app\models\RefStatusVenue;
use app\models\RefKategoriHakmilik;

/**
 * PengurusanKemudahanVenueMsnController implements the CRUD actions for PengurusanKemudahanVenueMsn model.
 */
class PengurusanKemudahanVenueMsnController extends Controller
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
     * Lists all PengurusanKemudahanVenueMsn models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $searchModel = new PengurusanKemudahanVenueMsnSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PengurusanKemudahanVenueMsn model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = $this->findModel($id);
        
        $ref = RefNegeri::findOne(['id' => $model->alamat_negeri]);
        $model->alamat_negeri = $ref['desc'];
        
        $ref = RefBandar::findOne(['id' => $model->alamat_bandar]);
        $model->alamat_bandar = $ref['desc'];
        
        $ref = RefStatusVenue::findOne(['id' => $model->status]);
        $model->status = $ref['desc'];
        
        $ref = RefKategoriHakmilik::findOne(['id' => $model->kategori_hakmilik]);
        $model->kategori_hakmilik = $ref['desc'];
        
        $queryPar = null;
        
        $queryPar['PengurusanKemudahanSediaAdaMsnSearch']['pengurusan_kemudahan_venue_id'] = $id;
        
        $searchModelPengurusanKemudahanSediaAdaMsn  = new PengurusanKemudahanSediaAdaMsnSearch();
        $dataProviderPengurusanKemudahanSediaAdaMsn = $searchModelPengurusanKemudahanSediaAdaMsn->search($queryPar);
        
        return $this->render('view', [
            'model' => $model,
            'searchModelPengurusanKemudahanSediaAdaMsn' => $searchModelPengurusanKemudahanSediaAdaMsn,
            'dataProviderPengurusanKemudahanSediaAdaMsn' => $dataProviderPengurusanKemudahanSediaAdaMsn,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new PengurusanKemudahanVenueMsn model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new PengurusanKemudahanVenueMsn();
        
        $queryPar = null;
        
        Yii::$app->session->open();
        
        if(isset(Yii::$app->session->id)){
            $queryPar['PengurusanKemudahanSediaAdaMsnSearch']['session_id'] = Yii::$app->session->id;
        }
        
        $searchModelPengurusanKemudahanSediaAdaMsn  = new PengurusanKemudahanSediaAdaMsnSearch();
        $dataProviderPengurusanKemudahanSediaAdaMsn = $searchModelPengurusanKemudahanSediaAdaMsn->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if(isset(Yii::$app->session->id)){
                PengurusanKemudahanSediaAdaMsn::updateAll(['pengurusan_kemudahan_venue_id' => $model->pengurusan_kemudahan_venue_id], 'session_id = "'.Yii::$app->session->id.'"');
                PengurusanKemudahanSediaAdaMsn::updateAll(['session_id' => ''], 'pengurusan_kemudahan_venue_id = "'.$model->pengurusan_kemudahan_venue_id.'"');
            }
            
            return $this->redirect(['view', 'id' => $model->pengurusan_kemudahan_venue_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'searchModelPengurusanKemudahanSediaAdaMsn' => $searchModelPengurusanKemudahanSediaAdaMsn,
                'dataProviderPengurusanKemudahanSediaAdaMsn' => $dataProviderPengurusanKemudahanSediaAdaMsn,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Updates an existing PengurusanKemudahanVenueMsn model.
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
        
        $queryPar['PengurusanKemudahanSediaAdaMsnSearch']['pengurusan_kemudahan_venue_id'] = $id;
        
        $searchModelPengurusanKemudahanSediaAdaMsn  = new PengurusanKemudahanSediaAdaMsnSearch();
        $dataProviderPengurusanKemudahanSediaAdaMsn = $searchModelPengurusanKemudahanSediaAdaMsn->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->pengurusan_kemudahan_venue_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'searchModelPengurusanKemudahanSediaAdaMsn' => $searchModelPengurusanKemudahanSediaAdaMsn,
                'dataProviderPengurusanKemudahanSediaAdaMsn' => $dataProviderPengurusanKemudahanSediaAdaMsn,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Deletes an existing PengurusanKemudahanVenueMsn model.
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
     * Finds the PengurusanKemudahanVenueMsn model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PengurusanKemudahanVenueMsn the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PengurusanKemudahanVenueMsn::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionGetVenue($id){
        
        $session = new Session;
        $session->open();

        $session['tempahan-kemudahan-msn-pengurusan_kemudahan_venue_id'] = $id;
        
        $session->close();
        
        // find Venue
        $model = PengurusanKemudahanVenueMsn::find()->joinWith(['refKategoriHakmilik'])->where(['pengurusan_kemudahan_venue_id' => $id])->asArray()->one();
        
        echo Json::encode($model);
    }
    
    public function actionSetAgensi($id){
        
        $session = new Session;
        $session->open();

        $session['tempahan-kemudahan-msn-agensi_id'] = $id;
        
        $session->close();
    }
    
    public function actionSetVenue($id){
        
        $session = new Session;
        $session->open();

        $session['tempahan-kemudahan-msn-pengurusan_kemudahan_venue_id'] = $id;
        
        $session->close();
    }
}
