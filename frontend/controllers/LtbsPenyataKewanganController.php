<?php

namespace frontend\controllers;

use Yii;
use app\models\LtbsPenyataKewangan;
use app\models\LtbsPenyataKewanganSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

// contant values
use app\models\general\GeneralVariable;
use app\models\general\Upload;

// table reference
use app\models\ProfilBadanSukan;

/**
 * LtbsPenyataKewanganController implements the CRUD actions for LtbsPenyataKewangan model.
 */
class LtbsPenyataKewanganController extends Controller
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
     * Lists all LtbsPenyataKewangan models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $searchModel = new LtbsPenyataKewanganSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single LtbsPenyataKewangan model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        // get details
        $model = $this->findModel($id);
        
        // get dropdown value's descriptions
        $ref = ProfilBadanSukan::findOne(['profil_badan_sukan' => $model->profil_badan_sukan_id]);
        $model->profil_badan_sukan_id = $ref['nama_badan_sukan'];
        
        return $this->render('view', [
            'model' => $model,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new LtbsPenyataKewangan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new LtbsPenyataKewangan();
        
        if(Yii::$app->user->identity->profil_badan_sukan){
            $model->profil_badan_sukan_id = Yii::$app->user->identity->profil_badan_sukan;
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->save()) {
            
            $file = UploadedFile::getInstance($model, 'penyata_penerimaan_dan_pembayaran');
            $filename = $model->penyata_kewangan_id . "-penyata_penerimaan_dan_pembayaran";
            if($file){
                $model->penyata_penerimaan_dan_pembayaran = Upload::uploadFile($file, Upload::ltbsPenyataKewanganFolder, $filename);
            }
            
            $file = UploadedFile::getInstance($model, 'penyata_pendapatan_dan_perbelanjaan');
            $filename = $model->penyata_kewangan_id . "-penyata_pendapatan_dan_perbelanjaan";
            if($file){
                $model->penyata_pendapatan_dan_perbelanjaan = Upload::uploadFile($file, Upload::ltbsPenyataKewanganFolder, $filename);
            }
            
            $file = UploadedFile::getInstance($model, 'kunci_kira_kira');
            $filename = $model->penyata_kewangan_id . "-kunci_kira_kira";
            if($file){
                $model->kunci_kira_kira = Upload::uploadFile($file, Upload::ltbsPenyataKewanganFolder, $filename);
            }
            
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->penyata_kewangan_id]);
            }
        }
        
        return $this->render('create', [
            'model' => $model,
            'readonly' => false,
        ]);
    }

    /**
     * Updates an existing LtbsPenyataKewangan model.
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
        $existingPenyataPenerimaanDanPembayaran = $model->penyata_penerimaan_dan_pembayaran;
        $existingPenyataPendapatanDanPerbelanjaan = $model->penyata_pendapatan_dan_perbelanjaan;
        $existingKunciKiraKira = $model->kunci_kira_kira;
        
        if($model->load(Yii::$app->request->post())){
            $file = UploadedFile::getInstance($model, 'penyata_penerimaan_dan_pembayaran');

            if($file){
                //valid file to upload
                //upload file to server
                /*$filename = $model->penyata_kewangan_id . "-penyata_penerimaan_dan_pembayaran";
                $model->penyata_penerimaan_dan_pembayaran = Upload::uploadFile($file, Upload::ltbsPenyataKewanganFolder, $filename);*/
            } else {
                //invalid file to upload
                //remain existing file
                $model->penyata_penerimaan_dan_pembayaran = $existingPenyataPenerimaanDanPembayaran;
            }
            
            $file = UploadedFile::getInstance($model, 'penyata_pendapatan_dan_perbelanjaan');

            if($file){
                //valid file to upload
                //upload file to server
                /*$filename = $model->penyata_kewangan_id . "-penyata_pendapatan_dan_perbelanjaan";
                $model->penyata_pendapatan_dan_perbelanjaan = Upload::uploadFile($file, Upload::ltbsPenyataKewanganFolder, $filename);*/
            } else {
                //invalid file to upload
                //remain existing file
                $model->penyata_pendapatan_dan_perbelanjaan = $existingPenyataPendapatanDanPerbelanjaan;
            }
            
            $file = UploadedFile::getInstance($model, 'kunci_kira_kira');

            if($file){
                //valid file to upload
                //upload file to server
                /*$filename = $model->penyata_kewangan_id . "-kunci_kira_kira";
                $model->kunci_kira_kira = Upload::uploadFile($file, Upload::ltbsPenyataKewanganFolder, $filename);*/
            } else {
                //invalid file to upload
                //remain existing file
                $model->kunci_kira_kira = $existingKunciKiraKira;
            }
        }

        if (Yii::$app->request->post() && $model->save()) {
            $file = UploadedFile::getInstance($model, 'penyata_penerimaan_dan_pembayaran');
            $filename = $model->penyata_kewangan_id . "-penyata_penerimaan_dan_pembayaran";
            if($file){
                $model->penyata_penerimaan_dan_pembayaran = Upload::uploadFile($file, Upload::ltbsPenyataKewanganFolder, $filename);
            }
            
            $file = UploadedFile::getInstance($model, 'penyata_pendapatan_dan_perbelanjaan');
            $filename = $model->penyata_kewangan_id . "-penyata_pendapatan_dan_perbelanjaan";
            if($file){
                $model->penyata_pendapatan_dan_perbelanjaan = Upload::uploadFile($file, Upload::ltbsPenyataKewanganFolder, $filename);
            }
            
            $file = UploadedFile::getInstance($model, 'kunci_kira_kira');
            $filename = $model->penyata_kewangan_id . "-kunci_kira_kira";
            if($file){
                $model->kunci_kira_kira = Upload::uploadFile($file, Upload::ltbsPenyataKewanganFolder, $filename);
            }
            
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->penyata_kewangan_id]);
            }
        } 
        
        return $this->render('update', [
                'model' => $model,
                'readonly' => false,
            ]);
    }

    /**
     * Deletes an existing LtbsPenyataKewangan model.
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
     * Finds the LtbsPenyataKewangan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return LtbsPenyataKewangan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = LtbsPenyataKewangan::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
