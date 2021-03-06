<?php

namespace frontend\controllers;

use Yii;
use app\models\PermohonanKemudahanTicketKapalTerbang;
use app\models\PermohonanKemudahanTicketKapalTerbangAtlet;
use frontend\models\PermohonanKemudahanTicketKapalTerbangAtletSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;

use app\models\Atlet;

use app\models\general\GeneralVariable;
use common\models\general\GeneralFunction;

/**
 * PermohonanKemudahanTicketKapalTerbangAtletController implements the CRUD actions for PermohonanKemudahanTicketKapalTerbangAtlet model.
 */
class PermohonanKemudahanTicketKapalTerbangAtletController extends Controller
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
     * Lists all PermohonanKemudahanTicketKapalTerbangAtlet models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $searchModel = new PermohonanKemudahanTicketKapalTerbangAtletSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PermohonanKemudahanTicketKapalTerbangAtlet model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = $this->findModel($id);
        
        $ref = Atlet::findOne(['atlet_id' => $model->atlet]);
        $model->atlet = $ref['nameAndIC'];
        
        if($model->tarikh_pergi != "") {$model->tarikh_pergi = GeneralFunction::convert($model->tarikh_pergi, GeneralFunction::TYPE_DATE);}
        if($model->tarikh_balik != "") {$model->tarikh_balik = GeneralFunction::convert($model->tarikh_balik, GeneralFunction::TYPE_DATE);}
        
        return $this->renderAjax('view', [
            'model' => $model,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new PermohonanKemudahanTicketKapalTerbangAtlet model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($permohonan_kemudahan_ticket_kapal_terbang_id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new PermohonanKemudahanTicketKapalTerbangAtlet();
        
        Yii::$app->session->open();
        
        if($permohonan_kemudahan_ticket_kapal_terbang_id != ''){
            $model->permohonan_kemudahan_ticket_kapal_terbang_id = $permohonan_kemudahan_ticket_kapal_terbang_id;
            
            $parentModel = PermohonanKemudahanTicketKapalTerbang::findOne(['permohonan_kemudahan_ticket_kapal_terbang_id' => $permohonan_kemudahan_ticket_kapal_terbang_id]);
            
            if(isset($parentModel->pri_tarikh_pergi) && $parentModel->pri_tarikh_pergi != null){
                $model->tarikh_pergi = $parentModel->pri_tarikh_pergi;
            }     
            if(isset($parentModel->pri_flight_pergi) && $parentModel->pri_flight_pergi != null){
                $model->flight_no_pergi = $parentModel->pri_flight_pergi;
            }    
            if(isset($parentModel->pri_masa_pergi) && $parentModel->pri_masa_pergi != null){
                $model->masa_pergi = $parentModel->pri_masa_pergi;
            }   
            if(isset($parentModel->pri_destinasi_pergi) && $parentModel->pri_destinasi_pergi != null){
                $model->destinasi_pergi = $parentModel->pri_destinasi_pergi;
            }              
            //balik
            if(isset($parentModel->pri_tarikh_balik) && $parentModel->pri_tarikh_balik != null){
                $model->tarikh_balik = $parentModel->pri_tarikh_balik;
            }     
            if(isset($parentModel->pri_flight_balik) && $parentModel->pri_flight_balik != null){
                $model->flight_no_balik = $parentModel->pri_flight_balik;
            }    
            if(isset($parentModel->pri_masa_balik) && $parentModel->pri_masa_balik != null){
                $model->masa_balik = $parentModel->pri_masa_balik;
            }   
            if(isset($parentModel->pri_destinasi_balik) && $parentModel->pri_destinasi_balik != null){
                $model->destinasi_balik = $parentModel->pri_destinasi_balik;
            }  
            
        } else {
            if(isset(Yii::$app->session->id)){
                $model->session_id = Yii::$app->session->id;
                
                $session = Yii::$app->session;
                if ($session->has('pri_tarikh_pergi')){
                    $model->tarikh_pergi = $session->get('pri_tarikh_pergi');
                }
                if ($session->has('pri_flight_pergi')){
                    $model->flight_no_pergi = $session->get('pri_flight_pergi');
                }
                if ($session->has('pri_masa_pergi')){
                    $model->masa_pergi = $session->get('pri_masa_pergi');
                }
                if ($session->has('pri_destinasi_pergi')){
                    $model->destinasi_pergi = $session->get('pri_destinasi_pergi');
                }
                //balik
                if ($session->has('pri_tarikh_balik')){
                    $model->tarikh_balik = $session->get('pri_tarikh_balik');
                }
                if ($session->has('pri_flight_balik')){
                    $model->flight_no_balik = $session->get('pri_flight_balik');
                }
                if ($session->has('pri_masa_balik')){
                    $model->masa_balik = $session->get('pri_masa_balik');
                }
                if ($session->has('pri_destinasi_balik')){
                    $model->destinasi_balik = $session->get('pri_destinasi_balik');
                }
            }
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //return $this->redirect(['view', 'id' => $model->permohonan_kemudahan_ticket_kapal_terbang_atlet_id]);
            return '1';
        } else {
            return $this->renderAjax('create', [
                'model' => $model,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Updates an existing PermohonanKemudahanTicketKapalTerbangAtlet model.
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
            //return $this->redirect(['view', 'id' => $model->permohonan_kemudahan_ticket_kapal_terbang_atlet_id]);
            return '1';
        } else {
            return $this->renderAjax('update', [
                'model' => $model,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Deletes an existing PermohonanKemudahanTicketKapalTerbangAtlet model.
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
     * Finds the PermohonanKemudahanTicketKapalTerbangAtlet model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PermohonanKemudahanTicketKapalTerbangAtlet the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PermohonanKemudahanTicketKapalTerbangAtlet::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionGetAtlet($atlet_id)
    {
        $model = Atlet::find()->select(['passport_no', 'ic_no', 'tel_bimbit_no_1'])->where(['atlet_id'=>$atlet_id])->asArray()->one();
        
        echo Json::encode($model);
    }
}
