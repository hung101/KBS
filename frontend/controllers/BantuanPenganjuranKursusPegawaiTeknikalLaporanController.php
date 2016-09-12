<?php

namespace frontend\controllers;

use Yii;
use app\models\BantuanPenganjuranKursusPegawaiTeknikalLaporan;
use frontend\models\BantuanPenganjuranKursusPegawaiTeknikalLaporanSearch;
use app\models\BantuanPenganjuranKursusPegawaiTeknikalLaporanTuntutan;
use frontend\models\BantuanPenganjuranKursusPegawaiTeknikalLaporanTuntutanSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

use app\models\general\Upload;
use app\models\general\GeneralVariable;
use common\models\general\GeneralFunction;

/**
 * BantuanPenganjuranKursusPegawaiTeknikalLaporanController implements the CRUD actions for BantuanPenganjuranKursusPegawaiTeknikalLaporan model.
 */
class BantuanPenganjuranKursusPegawaiTeknikalLaporanController extends Controller
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
     * Lists all BantuanPenganjuranKursusPegawaiTeknikalLaporan models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect($this->redirect(array(GeneralVariable::loginPagePath)));
        }
        
        $searchModel = new BantuanPenganjuranKursusPegawaiTeknikalLaporanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single BantuanPenganjuranKursusPegawaiTeknikalLaporan model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect($this->redirect(array(GeneralVariable::loginPagePath)));
        }
        
        
        $queryPar = null;
        
        $queryPar['BantuanPenganjuranKursusPegawaiTeknikalLaporanTuntutanSearch']['bantuan_penganjuran_kursus_pegawai_teknikal_laporan_id'] = $id;
        
        $searchModelBantuanPenganjuranKursusPegawaiTeknikalLaporanTuntutan  = new BantuanPenganjuranKursusPegawaiTeknikalLaporanTuntutanSearch();
        $dataProviderBantuanPenganjuranKursusPegawaiTeknikalLaporanTuntutan = $searchModelBantuanPenganjuranKursusPegawaiTeknikalLaporanTuntutan->search($queryPar);
        
        return $this->render('view', [
            'model' => $this->findModel($id),
            'searchModelBantuanPenganjuranKursusPegawaiTeknikalLaporanTuntutan' => $searchModelBantuanPenganjuranKursusPegawaiTeknikalLaporanTuntutan,
            'dataProviderBantuanPenganjuranKursusPegawaiTeknikalLaporanTuntutan' => $dataProviderBantuanPenganjuranKursusPegawaiTeknikalLaporanTuntutan,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new BantuanPenganjuranKursusPegawaiTeknikalLaporan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($bantuan_penganjuran_kursus_pegawai_teknikal_id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect($this->redirect(array(GeneralVariable::loginPagePath)));
        }
        
        $model = new BantuanPenganjuranKursusPegawaiTeknikalLaporan();
        
        $model->bantuan_penganjuran_kursus_pegawai_teknikal_id = $bantuan_penganjuran_kursus_pegawai_teknikal_id;
        
        $queryPar = null;
        
        Yii::$app->session->open();
        
        if(isset(Yii::$app->session->id)){
            $queryPar['BantuanPenganjuranKursusPegawaiTeknikalLaporanTuntutanSearch']['session_id'] = Yii::$app->session->id;
        }
        
        $searchModelBantuanPenganjuranKursusPegawaiTeknikalLaporanTuntutan  = new BantuanPenganjuranKursusPegawaiTeknikalLaporanTuntutanSearch();
        $dataProviderBantuanPenganjuranKursusPegawaiTeknikalLaporanTuntutan = $searchModelBantuanPenganjuranKursusPegawaiTeknikalLaporanTuntutan->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            
            $file = UploadedFile::getInstance($model, 'laporan_bergambar');
            $filename = $model->bantuan_penganjuran_kursus_pegawai_teknikal_laporan_id . "-laporan_bergambar";
            if($file){
                $model->laporan_bergambar = Upload::uploadFile($file, Upload::bantuanPenganjuranKursusPegawaiTeknikalLaporanFolder, $filename);
            }
            
            $file = UploadedFile::getInstance($model, 'penyata_perbelanjaan_resit_yang_telah_disahkan');
            $filename = $model->bantuan_penganjuran_kursus_pegawai_teknikal_laporan_id . "-penyata_perbelanjaan_resit_yang_telah_disahkan";
            if($file){
                $model->penyata_perbelanjaan_resit_yang_telah_disahkan = Upload::uploadFile($file, Upload::bantuanPenganjuranKursusPegawaiTeknikalLaporanFolder, $filename);
            }
            
            $file = UploadedFile::getInstance($model, 'jadual_keputusan_pertandingan');
            $filename = $model->bantuan_penganjuran_kursus_pegawai_teknikal_laporan_id . "-jadual_keputusan_pertandingan";
            if($file){
                $model->jadual_keputusan_pertandingan = Upload::uploadFile($file, Upload::bantuanPenganjuranKursusPegawaiTeknikalLaporanFolder, $filename);
            }
            
            $file = UploadedFile::getInstance($model, 'senarai_peserta');
            $filename = $model->bantuan_penganjuran_kursus_pegawai_teknikal_laporan_id . "-senarai_peserta";
            if($file){
                $model->senarai_peserta = Upload::uploadFile($file, Upload::bantuanPenganjuranKursusPegawaiTeknikalLaporanFolder, $filename);
            }
            
            $file = UploadedFile::getInstance($model, 'statistik_penyertaan');
            $filename = $model->bantuan_penganjuran_kursus_pegawai_teknikal_laporan_id . "-statistik_penyertaan";
            if($file){
                $model->statistik_penyertaan = Upload::uploadFile($file, Upload::bantuanPenganjuranKursusPegawaiTeknikalLaporanFolder, $filename);
            }
            
            $file = UploadedFile::getInstance($model, 'senarai_pegawai_penceramah');
            $filename = $model->bantuan_penganjuran_kursus_pegawai_teknikal_laporan_id . "-senarai_pegawai_penceramah";
            if($file){
                $model->senarai_pegawai_penceramah = Upload::uploadFile($file, Upload::bantuanPenganjuranKursusPegawaiTeknikalLaporanFolder, $filename);
            }
            
            $file = UploadedFile::getInstance($model, 'senarai_urusetia_sukarelawan');
            $filename = $model->bantuan_penganjuran_kursus_pegawai_teknikal_laporan_id . "-senarai_urusetia_sukarelawan";
            if($file){
                $model->senarai_urusetia_sukarelawan = Upload::uploadFile($file, Upload::bantuanPenganjuranKursusPegawaiTeknikalLaporanFolder, $filename);
            }
            
            if(isset(Yii::$app->session->id)){
                BantuanPenganjuranKursusPegawaiTeknikalLaporanTuntutan::updateAll(['bantuan_penganjuran_kursus_pegawai_teknikal_laporan_id' => $model->bantuan_penganjuran_kursus_pegawai_teknikal_laporan_id], 'session_id = "'.Yii::$app->session->id.'"');
                BantuanPenganjuranKursusPegawaiTeknikalLaporanTuntutan::updateAll(['session_id' => ''], 'bantuan_penganjuran_kursus_pegawai_teknikal_laporan_id = "'.$model->bantuan_penganjuran_kursus_pegawai_teknikal_laporan_id.'"');
                
            }
            
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->bantuan_penganjuran_kursus_pegawai_teknikal_laporan_id]);
            }
        } 
        
        return $this->render('create', [
                'model' => $model,
                'searchModelBantuanPenganjuranKursusPegawaiTeknikalLaporanTuntutan' => $searchModelBantuanPenganjuranKursusPegawaiTeknikalLaporanTuntutan,
                'dataProviderBantuanPenganjuranKursusPegawaiTeknikalLaporanTuntutan' => $dataProviderBantuanPenganjuranKursusPegawaiTeknikalLaporanTuntutan,
                'readonly' => false,
            ]);
    }
    
    /**
     * Displays a single BantuanPenganjuranKejohananLaporan model.
     * @param integer $id
     * @return mixed
     */
    public function actionLoad($bantuan_penganjuran_kursus_pegawai_teknikal_id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect($this->redirect(array(GeneralVariable::loginPagePath)));
        }
        
        if (($model = BantuanPenganjuranKursusPegawaiTeknikalLaporan::find()->where(['bantuan_penganjuran_kursus_pegawai_teknikal_id'=>$bantuan_penganjuran_kursus_pegawai_teknikal_id])->one()) !== null) {
            return $this->redirect(['update', 'id' => $model->bantuan_penganjuran_kursus_pegawai_teknikal_laporan_id]);
        } else {
            return $this->redirect(['create', 'bantuan_penganjuran_kursus_pegawai_teknikal_id' => $bantuan_penganjuran_kursus_pegawai_teknikal_id]);
        }
    }

    /**
     * Updates an existing BantuanPenganjuranKursusPegawaiTeknikalLaporan model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect($this->redirect(array(GeneralVariable::loginPagePath)));
        }
        
        $model = $this->findModel($id);
        $existingPenyataPerbelanjaan = $model->penyata_perbelanjaan_resit_yang_telah_disahkan;
        
        if($model->load(Yii::$app->request->post())){
            $file = UploadedFile::getInstance($model, 'penyata_perbelanjaan_resit_yang_telah_disahkan');

            if($file){
                //valid file to upload
                //upload file to server
                
                // delete upload file
                if($existingPenyataPerbelanjaan != ""){
                    self::actionDeleteupload($id, 'penyata_perbelanjaan_resit_yang_telah_disahkan');
                }
                
                $filename = $model->bantuan_penganjuran_kejohanan_id . "-penyata_perbelanjaan_resit_yang_telah_disahkan";
                $model->penyata_perbelanjaan_resit_yang_telah_disahkan = Upload::uploadFile($file, Upload::bantuanPenganjuranKursusPegawaiTeknikalLaporanFolder, $filename);
            } else {
                //invalid file to upload
                //remain existing file
                $model->penyata_perbelanjaan_resit_yang_telah_disahkan = $existingPenyataPerbelanjaan;
            }
            
            $file = UploadedFile::getInstance($model, 'laporan_bergambar');
            $filename = $model->bantuan_penganjuran_kursus_pegawai_teknikal_laporan_id . "-laporan_bergambar";
            if($file){
                $model->laporan_bergambar = Upload::uploadFile($file, Upload::bantuanPenganjuranKursusPegawaiTeknikalLaporanFolder, $filename);
            }
            
            $file = UploadedFile::getInstance($model, 'jadual_keputusan_pertandingan');
            $filename = $model->bantuan_penganjuran_kursus_pegawai_teknikal_laporan_id . "-jadual_keputusan_pertandingan";
            if($file){
                $model->jadual_keputusan_pertandingan = Upload::uploadFile($file, Upload::bantuanPenganjuranKursusPegawaiTeknikalLaporanFolder, $filename);
            }
            
            $file = UploadedFile::getInstance($model, 'senarai_peserta');
            $filename = $model->bantuan_penganjuran_kursus_pegawai_teknikal_laporan_id . "-senarai_peserta";
            if($file){
                $model->senarai_peserta = Upload::uploadFile($file, Upload::bantuanPenganjuranKursusPegawaiTeknikalLaporanFolder, $filename);
            }
            
            $file = UploadedFile::getInstance($model, 'statistik_penyertaan');
            $filename = $model->bantuan_penganjuran_kursus_pegawai_teknikal_laporan_id . "-statistik_penyertaan";
            if($file){
                $model->statistik_penyertaan = Upload::uploadFile($file, Upload::bantuanPenganjuranKursusPegawaiTeknikalLaporanFolder, $filename);
            }
            
            $file = UploadedFile::getInstance($model, 'senarai_pegawai_penceramah');
            $filename = $model->bantuan_penganjuran_kursus_pegawai_teknikal_laporan_id . "-senarai_pegawai_penceramah";
            if($file){
                $model->senarai_pegawai_penceramah = Upload::uploadFile($file, Upload::bantuanPenganjuranKursusPegawaiTeknikalLaporanFolder, $filename);
            }
            
            $file = UploadedFile::getInstance($model, 'senarai_urusetia_sukarelawan');
            $filename = $model->bantuan_penganjuran_kursus_pegawai_teknikal_laporan_id . "-senarai_urusetia_sukarelawan";
            if($file){
                $model->senarai_urusetia_sukarelawan = Upload::uploadFile($file, Upload::bantuanPenganjuranKursusPegawaiTeknikalLaporanFolder, $filename);
            }
        }
        
        $queryPar = null;
        
        $queryPar['BantuanPenganjuranKursusPegawaiTeknikalLaporanTuntutanSearch']['bantuan_penganjuran_kursus_pegawai_teknikal_laporan_id'] = $id;
        
        $searchModelBantuanPenganjuranKursusPegawaiTeknikalLaporanTuntutan  = new BantuanPenganjuranKursusPegawaiTeknikalLaporanTuntutanSearch();
        $dataProviderBantuanPenganjuranKursusPegawaiTeknikalLaporanTuntutan = $searchModelBantuanPenganjuranKursusPegawaiTeknikalLaporanTuntutan->search($queryPar);

        if (Yii::$app->request->post() && $model->save()) {
            return $this->redirect(['view', 'id' => $model->bantuan_penganjuran_kursus_pegawai_teknikal_laporan_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'searchModelBantuanPenganjuranKursusPegawaiTeknikalLaporanTuntutan' => $searchModelBantuanPenganjuranKursusPegawaiTeknikalLaporanTuntutan,
                'dataProviderBantuanPenganjuranKursusPegawaiTeknikalLaporanTuntutan' => $dataProviderBantuanPenganjuranKursusPegawaiTeknikalLaporanTuntutan,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Deletes an existing BantuanPenganjuranKursusPegawaiTeknikalLaporan model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect($this->redirect(array(GeneralVariable::loginPagePath)));
        }
        
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the BantuanPenganjuranKursusPegawaiTeknikalLaporan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return BantuanPenganjuranKursusPegawaiTeknikalLaporan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = BantuanPenganjuranKursusPegawaiTeknikalLaporan::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
