<?php

namespace frontend\controllers;

use Yii;
use app\models\PembayaranInsentifPersatuan;
use frontend\models\PembayaranInsentifPersatuanSearch;
use app\models\PembayaranInsentifAtlet;
use app\models\PengurusanInsentifTetapan;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use app\models\general\GeneralVariable;
use common\models\general\GeneralFunction;

// table reference
use app\models\ProfilBadanSukan;
use app\models\RefBank;

/**
 * PembayaranInsentifPersatuanController implements the CRUD actions for PembayaranInsentifPersatuan model.
 */
class PembayaranInsentifPersatuanController extends Controller
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
     * Lists all PembayaranInsentifPersatuan models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $searchModel = new PembayaranInsentifPersatuanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PembayaranInsentifPersatuan model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = $this->findModel($id);
        
        $ref = ProfilBadanSukan::findOne(['profil_badan_sukan' => $model->persatuan]);
        $model->persatuan = $ref['nama_badan_sukan'];
        
        $ref = RefBank::findOne(['id' => $model->nama_bank]);
        $model->nama_bank = $ref['desc'];
        
        return $this->renderAjax('view', [
            'model' => $model,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new PembayaranInsentifPersatuan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($pembayaran_insentif_id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new PembayaranInsentifPersatuan();
        
        Yii::$app->session->open();
        
        if($pembayaran_insentif_id != ''){
            $model->pembayaran_insentif_id = $pembayaran_insentif_id;
        } else {
            if(isset(Yii::$app->session->id)){
                $model->session_id = Yii::$app->session->id;
            }
        }
        
        // calculate total insentif allocated to atlets
        $jumlah_insentif_allocated_atlet = 0;
        $sikap_peratus = 0;
        $modelInsentifAtlet= null;
        
        if($model->pembayaran_insentif_id != null or $model->pembayaran_insentif_id != ""){
            $modelInsentifAtlet = PembayaranInsentifAtlet::find()->where(['pembayaran_insentif_id'=>$model->pembayaran_insentif_id])->all();
        } else if($model->session_id != null or $model->session_id != ""){
            $modelInsentifAtlet = PembayaranInsentifAtlet::find()->where(['session_id'=>$model->session_id])->all();
        }
        
        if($modelInsentifAtlet){
            foreach($modelInsentifAtlet as $insentifAtlet){
                $jumlah_insentif_allocated_atlet += $insentifAtlet->nilai;
            }
        }
        
        // get setting parameter SIKAP
        $modelInsentifTetapan = PengurusanInsentifTetapan::find()->all();
        
        if($modelInsentifTetapan){
            foreach($modelInsentifTetapan as $insentifTetapan){
                $sikap_peratus += $insentifTetapan->sikap;
                break;
            }
        }
        
        // get the percent sikap from overall insentif amount
        $model->nilai = $jumlah_insentif_allocated_atlet * ($sikap_peratus/100);
        

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
     * Updates an existing PembayaranInsentifPersatuan model.
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
     * Deletes an existing PembayaranInsentifPersatuan model.
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
     * Finds the PembayaranInsentifPersatuan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PembayaranInsentifPersatuan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PembayaranInsentifPersatuan::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
