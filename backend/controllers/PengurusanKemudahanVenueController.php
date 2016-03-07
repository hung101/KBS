<?php

namespace backend\controllers;

use Yii;
use app\models\PengurusanKemudahanVenue;
use backend\models\PengurusanKemudahanVenueSearch;
use app\models\PengurusanKemudahanSediaAda;
use backend\models\PengurusanKemudahanSediaAdaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;

use app\models\general\GeneralVariable;

// table reference
use app\models\RefNegeri;
use app\models\RefBandar;
use app\models\RefStatusVenue;
use app\models\RefKategoriHakmilik;

/**
 * PengurusanKemudahanVenueController implements the CRUD actions for PengurusanKemudahanVenue model.
 */
class PengurusanKemudahanVenueController extends Controller
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
     * Lists all PengurusanKemudahanVenue models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $queryPar = Yii::$app->request->queryParams;
        
        $queryPar['PengurusanKemudahanVenueSearch']['public_user_id'] = Yii::$app->user->identity->id;
        
        $searchModel = new PengurusanKemudahanVenueSearch();
        $dataProvider = $searchModel->search($queryPar);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PengurusanKemudahanVenue model.
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
        
        $queryPar['PengurusanKemudahanSediaAdaSearch']['pengurusan_kemudahan_venue_id'] = $id;
        
        $searchModelPengurusanKemudahanSediaAda  = new PengurusanKemudahanSediaAdaSearch();
        $dataProviderPengurusanKemudahanSediaAda = $searchModelPengurusanKemudahanSediaAda->search($queryPar);
        
        return $this->render('view', [
            'model' => $model,
            'searchModelPengurusanKemudahanSediaAda' => $searchModelPengurusanKemudahanSediaAda,
            'dataProviderPengurusanKemudahanSediaAda' => $dataProviderPengurusanKemudahanSediaAda,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new PengurusanKemudahanVenue model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new PengurusanKemudahanVenue();
        
        //set value from public user profile
        $model->kategori_hakmilik = Yii::$app->user->identity->kategory_hakmilik_e_kemudahan;
        $model->pemilik = Yii::$app->user->identity->full_name;
        $model->no_telefon = Yii::$app->user->identity->tel_bimbit_no;
        $model->no_faks = Yii::$app->user->identity->fax_no;
        $model->emel = Yii::$app->user->identity->email;
        $model->public_user_id = Yii::$app->user->identity->id;
        
        $model->status = 3; // sedang disemakan as default status
        
        $queryPar = null;
        
        Yii::$app->session->open();
        
        if(isset(Yii::$app->session->id)){
            $queryPar['PengurusanKemudahanSediaAdaSearch']['session_id'] = Yii::$app->session->id;
        }
        
        $searchModelPengurusanKemudahanSediaAda  = new PengurusanKemudahanSediaAdaSearch();
        $dataProviderPengurusanKemudahanSediaAda = $searchModelPengurusanKemudahanSediaAda->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if(isset(Yii::$app->session->id)){
                PengurusanKemudahanSediaAda::updateAll(['pengurusan_kemudahan_venue_id' => $model->pengurusan_kemudahan_venue_id], 'session_id = "'.Yii::$app->session->id.'"');
                PengurusanKemudahanSediaAda::updateAll(['session_id' => ''], 'pengurusan_kemudahan_venue_id = "'.$model->pengurusan_kemudahan_venue_id.'"');
            }
            
            return $this->redirect(['view', 'id' => $model->pengurusan_kemudahan_venue_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'searchModelPengurusanKemudahanSediaAda' => $searchModelPengurusanKemudahanSediaAda,
                'dataProviderPengurusanKemudahanSediaAda' => $dataProviderPengurusanKemudahanSediaAda,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Updates an existing PengurusanKemudahanVenue model.
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
        
        $queryPar['PengurusanKemudahanSediaAdaSearch']['pengurusan_kemudahan_venue_id'] = $id;
        
        $searchModelPengurusanKemudahanSediaAda  = new PengurusanKemudahanSediaAdaSearch();
        $dataProviderPengurusanKemudahanSediaAda = $searchModelPengurusanKemudahanSediaAda->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->pengurusan_kemudahan_venue_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'searchModelPengurusanKemudahanSediaAda' => $searchModelPengurusanKemudahanSediaAda,
                'dataProviderPengurusanKemudahanSediaAda' => $dataProviderPengurusanKemudahanSediaAda,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Deletes an existing PengurusanKemudahanVenue model.
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
     * Finds the PengurusanKemudahanVenue model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PengurusanKemudahanVenue the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PengurusanKemudahanVenue::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionGetVenue($id){
        // find Venue
        $model = PengurusanKemudahanVenue::find()->joinWith(['refKategoriHakmilik'])->where(['pengurusan_kemudahan_venue_id' => $id])->asArray()->one();
        
        echo Json::encode($model);
    }
}
