<?php

namespace frontend\controllers;

use Yii;
use app\models\BantuanPenganjuranKursusPegawaiTeknikalLaporan;
use frontend\models\BantuanPenganjuranKursusPegawaiTeknikalLaporanSearch;
use app\models\BantuanPenganjuranKursusPegawaiTeknikalLaporanTuntutan;
use frontend\models\BantuanPenganjuranKursusPegawaiTeknikalLaporanTuntutanSearch;
use app\models\BantuanPenganjuranKursusPegawaiTeknikal;
use app\models\BantuanPenyertaanPegawaiTeknikal;
use app\models\BantuanPenganjuranKursus;
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
            return $this->redirect(array(GeneralVariable::loginPagePath));
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
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = $this->findModel($id);
        
        if($model->tarikh != "") {$model->tarikh = GeneralFunction::convert($model->tarikh, GeneralFunction::TYPE_DATE);}
        if($model->tarikh_tamat != "") {$model->tarikh_tamat = GeneralFunction::convert($model->tarikh_tamat, GeneralFunction::TYPE_DATE);}
        
        
        $queryPar = null;
        
        $queryPar['BantuanPenganjuranKursusPegawaiTeknikalLaporanTuntutanSearch']['bantuan_penganjuran_kursus_pegawai_teknikal_laporan_id'] = $id;
        
        $searchModelBantuanPenganjuranKursusPegawaiTeknikalLaporanTuntutan  = new BantuanPenganjuranKursusPegawaiTeknikalLaporanTuntutanSearch();
        $dataProviderBantuanPenganjuranKursusPegawaiTeknikalLaporanTuntutan = $searchModelBantuanPenganjuranKursusPegawaiTeknikalLaporanTuntutan->search($queryPar);
        
        return $this->render('view', [
            'model' => $model,
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
    public function actionCreate($bantuan_penganjuran_kursus_pegawai_teknikal_id=0, $bantuan_penyertaan_pegawai_teknikal_id=0, $bantuan_penganjuran_kursus_id=0)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new BantuanPenganjuranKursusPegawaiTeknikalLaporan();
        
        $model->bantuan_penganjuran_kursus_pegawai_teknikal_id = $bantuan_penganjuran_kursus_pegawai_teknikal_id;
        $model->bantuan_penyertaan_pegawai_teknikal_id = $bantuan_penyertaan_pegawai_teknikal_id;
        $model->bantuan_penganjuran_kursus_id = $bantuan_penganjuran_kursus_id;
        
        if (($modelBantuanPenganjuranKursusPegawaiTeknikal = BantuanPenganjuranKursusPegawaiTeknikal::findOne($bantuan_penganjuran_kursus_pegawai_teknikal_id)) !== null && $bantuan_penganjuran_kursus_pegawai_teknikal_id != 0) {
            $model->tempat = $modelBantuanPenganjuranKursusPegawaiTeknikal->tempat;
            $model->tujuan_kursus_kejohanan = $modelBantuanPenganjuranKursusPegawaiTeknikal->nama_kursus_seminar_bengkel;
            $model->tarikh = $modelBantuanPenganjuranKursusPegawaiTeknikal->tarikh;
            $model->tarikh_tamat = $modelBantuanPenganjuranKursusPegawaiTeknikal->tarikh_tamat;
            //$model->bilangan_pasukan = $modelBantuanPenganjuranKursusPegawaiTeknikal->bil_pasukan;
            //$model->bilangan_peserta = $modelBantuanPenganjuranKursusPegawaiTeknikal->bil_peserta;
            //$model->bilangan_pegawai_teknikal = $modelBantuanPenganjuranKursusPegawaiTeknikal->bil_pegawai_teknikal;
            //$model->bilangan_pembantu = $modelBantuanPenganjuranKursusPegawaiTeknikal->bilangan_pembantu;
            $model->jumlah_kelulusan = $modelBantuanPenganjuranKursusPegawaiTeknikal->jumlah_dilulus;
        }
        
        if (($modelBantuanPenganjuranKursus = BantuanPenganjuranKursus::findOne($bantuan_penganjuran_kursus_id)) !== null && $bantuan_penganjuran_kursus_id != 0) {
            $model->tempat = $modelBantuanPenganjuranKursus->tempat;
            $model->tujuan_kursus_kejohanan = $modelBantuanPenganjuranKursus->nama_kursus_seminar_bengkel;
            $model->tarikh = $modelBantuanPenganjuranKursus->tarikh;
            $model->tarikh_tamat = $modelBantuanPenganjuranKursus->tarikh_tamat;
            //$model->bilangan_pasukan = $modelBantuanPenganjuranKursusPegawaiTeknikal->bil_pasukan;
            //$model->bilangan_peserta = $modelBantuanPenganjuranKursusPegawaiTeknikal->bil_peserta;
            //$model->bilangan_pegawai_teknikal = $modelBantuanPenganjuranKursusPegawaiTeknikal->bil_pegawai_teknikal;
            //$model->bilangan_pembantu = $modelBantuanPenganjuranKursusPegawaiTeknikal->bilangan_pembantu;
            $model->jumlah_kelulusan = $modelBantuanPenganjuranKursus->jumlah_dilulus;
        }
        
        if (($modelBantuanBantuanPenyertaanPegawaiTeknikal = BantuanPenyertaanPegawaiTeknikal::findOne($bantuan_penyertaan_pegawai_teknikal_id)) !== null && $bantuan_penyertaan_pegawai_teknikal_id != 0) {
            $model->tempat = $modelBantuanBantuanPenyertaanPegawaiTeknikal->tempat;
            $model->tujuan_kursus_kejohanan = $modelBantuanBantuanPenyertaanPegawaiTeknikal->nama_kejohanan;
            $model->tarikh = $modelBantuanBantuanPenyertaanPegawaiTeknikal->tarikh;
            $model->tarikh_tamat = $modelBantuanBantuanPenyertaanPegawaiTeknikal->tarikh_tamat;
            //$model->bilangan_pasukan = $modelBantuanPenganjuranKursusPegawaiTeknikal->bil_pasukan;
            //$model->bilangan_peserta = $modelBantuanPenganjuranKursusPegawaiTeknikal->bil_peserta;
            //$model->bilangan_pegawai_teknikal = $modelBantuanPenganjuranKursusPegawaiTeknikal->bil_pegawai_teknikal;
            //$model->bilangan_pembantu = $modelBantuanPenganjuranKursusPegawaiTeknikal->bilangan_pembantu;
            $model->jumlah_kelulusan = $modelBantuanBantuanPenyertaanPegawaiTeknikal->jumlah_dilulus;
        }
        
        $dateAdd = new \DateTime($model->tarikh_tamat);
        $dateAdd->modify('+1 month'); // 1 months after kejohanan
        
        $allowSubmit = true;
        
        if($dateAdd->format('Y-m-d') < GeneralFunction::getCurrentDate()){
            Yii::$app->session->setFlash('error', 'Tidak boleh menghantar laporan kerana sudah lepas tempoh 1 bulan selepas kejohanan');
            $allowSubmit = false;
        }
        
        $queryPar = null;
        
        Yii::$app->session->open();
        
        if(isset(Yii::$app->session->id)){
            $queryPar['BantuanPenganjuranKursusPegawaiTeknikalLaporanTuntutanSearch']['session_id'] = Yii::$app->session->id;
        }
        
        $searchModelBantuanPenganjuranKursusPegawaiTeknikalLaporanTuntutan  = new BantuanPenganjuranKursusPegawaiTeknikalLaporanTuntutanSearch();
        $dataProviderBantuanPenganjuranKursusPegawaiTeknikalLaporanTuntutan = $searchModelBantuanPenganjuranKursusPegawaiTeknikalLaporanTuntutan->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save() && $allowSubmit) {
            
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
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        if (($model = BantuanPenganjuranKursusPegawaiTeknikalLaporan::find()->where(['bantuan_penganjuran_kursus_pegawai_teknikal_id'=>$bantuan_penganjuran_kursus_pegawai_teknikal_id])->one()) !== null) {
            //return $this->redirect(['update', 'id' => $model->bantuan_penganjuran_kursus_pegawai_teknikal_laporan_id]);
            return $this->redirect(['view', 'id' => $model->bantuan_penganjuran_kursus_pegawai_teknikal_laporan_id]);
        } else {
            return $this->redirect(['create', 'bantuan_penganjuran_kursus_pegawai_teknikal_id' => $bantuan_penganjuran_kursus_pegawai_teknikal_id]);
        }
    }
    
    /**
     * Displays a single BantuanPenganjuranKejohananLaporan model.
     * @param integer $id
     * @return mixed
     */
    public function actionLoadBantuanPenyertaan($bantuan_penyertaan_pegawai_teknikal_id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        if (($model = BantuanPenganjuranKursusPegawaiTeknikalLaporan::find()->where(['bantuan_penyertaan_pegawai_teknikal_id'=>$bantuan_penyertaan_pegawai_teknikal_id])->one()) !== null) {
            //return $this->redirect(['update', 'id' => $model->bantuan_penganjuran_kursus_pegawai_teknikal_laporan_id]);
            return $this->redirect(['view', 'id' => $model->bantuan_penganjuran_kursus_pegawai_teknikal_laporan_id]);
        } else {
            return $this->redirect(['create', 'bantuan_penyertaan_pegawai_teknikal_id' => $bantuan_penyertaan_pegawai_teknikal_id]);
        }
    }
    
    /**
     * Displays a single BantuanPenganjuranKejohananLaporan model.
     * @param integer $id
     * @return mixed
     */
    public function actionLoadBantuanPenganjuran($bantuan_penganjuran_kursus_id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        if (($model = BantuanPenganjuranKursusPegawaiTeknikalLaporan::find()->where(['bantuan_penganjuran_kursus_id'=>$bantuan_penganjuran_kursus_id])->one()) !== null) {
            //return $this->redirect(['update', 'id' => $model->bantuan_penganjuran_kursus_pegawai_teknikal_laporan_id]);
            return $this->redirect(['view', 'id' => $model->bantuan_penganjuran_kursus_pegawai_teknikal_laporan_id]);
        } else {
            return $this->redirect(['create', 'bantuan_penganjuran_kursus_id' => $bantuan_penganjuran_kursus_id]);
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
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = $this->findModel($id);
        $existingPenyataPerbelanjaan = $model->penyata_perbelanjaan_resit_yang_telah_disahkan;
        
        $dateAdd = new \DateTime($model->tarikh_tamat);
        $dateAdd->modify('+1 month'); // 1 months after kejohanan
        
        $allowSubmit = true;
        
        if(($model->jumlah_kelulusan == 0 || !$model->jumlah_kelulusan)){
            if (($modelBantuanPenganjuranKursusPegawaiTeknikal = BantuanPenganjuranKursusPegawaiTeknikal::findOne($model->bantuan_penganjuran_kursus_pegawai_teknikal_id)) !== null && $model->bantuan_penganjuran_kursus_pegawai_teknikal_id != 0) {
                $model->jumlah_kelulusan = $modelBantuanPenganjuranKursusPegawaiTeknikal->jumlah_dilulus;
            }

            if (($modelBantuanPenganjuranKursus = BantuanPenganjuranKursus::findOne($model->bantuan_penganjuran_kursus_id)) !== null && $model->bantuan_penganjuran_kursus_id != 0) {
                $model->jumlah_kelulusan = $modelBantuanPenganjuranKursus->jumlah_dilulus;
            }

            if (($modelBantuanBantuanPenyertaanPegawaiTeknikal = BantuanPenyertaanPegawaiTeknikal::findOne($model->bantuan_penyertaan_pegawai_teknikal_id)) !== null && $model->bantuan_penyertaan_pegawai_teknikal_id != 0) {
                $model->jumlah_kelulusan = $modelBantuanBantuanPenyertaanPegawaiTeknikal->jumlah_dilulus;
            }
        }
        
        if($dateAdd->format('Y-m-d') < GeneralFunction::getCurrentDate()){
            Yii::$app->session->setFlash('error', 'Tidak boleh menghantar/kemaskini laporan kerana sudah lepas tempoh 1 bulan selepas kejohanan');
            $allowSubmit = false;
        }
        
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

        if (Yii::$app->request->post() && $model->save() && $allowSubmit) {
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
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
	
	public function actionPrint($id)
	{
		if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = $this->findModel($id);
		
		$BantuanPenganjuranKursusPegawaiTeknikalLaporanTuntutan = BantuanPenganjuranKursusPegawaiTeknikalLaporanTuntutan::find()->where(['bantuan_penganjuran_kursus_pegawai_teknikal_laporan_id' => $model->bantuan_penganjuran_kursus_pegawai_teknikal_laporan_id])->all();
	
		$pdf = new \mPDF('utf-8', 'A4');

        $pdf->title = 'Laporan Teknikal & Kepegawaian';

        $stylesheet = file_get_contents('css/report.css');

        $pdf->WriteHTML($stylesheet,1);
        
        $pdf->WriteHTML($this->renderpartial('print', [
             'model'  => $model,
			 'title' => $pdf->title,
			 'BantuanPenganjuranKursusPegawaiTeknikalLaporanTuntutan' => $BantuanPenganjuranKursusPegawaiTeknikalLaporanTuntutan,
        ]));

        $pdf->Output(str_replace(' ', '_', $pdf->title).'_'.$model->bantuan_penganjuran_kursus_pegawai_teknikal_laporan_id.'.pdf', 'I'); 
		
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
    
    // Add function for delete image or file
    public function actionDeleteupload($id, $field)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
            $img = $this->findModel($id)->$field;
            
            if($img){
/*                 if (!unlink($img)) {
                    return false;
                } */
				@unlink($img);
            }

            $img = $this->findModel($id);
            $img->$field = NULL;
            $img->update();

            return $this->redirect(['update', 'id' => $id]);
    }
    
    /**
     * Updates an existing BantuanPenganjuranKursusPegawaiTeknikalLaporan model.
     * If approved is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionHantar($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = $this->findModel($id);
        
        $model->hantar_flag = 1; // set approved
        $model->tarikh_hantar = GeneralFunction::getCurrentTimestamp(); // set date capture
        
        $model->save();
        
        if($model->bantuan_penganjuran_kursus_pegawai_teknikal_id && $model->bantuan_penganjuran_kursus_pegawai_teknikal_id != 0){
            if (($modelBantuanPenganjuranKursusPegawaiTeknikal = BantuanPenganjuranKursusPegawaiTeknikal::findOne($model->bantuan_penganjuran_kursus_pegawai_teknikal_id)) !== null) {
                $modelBantuanPenganjuranKursusPegawaiTeknikal->laporan_hantar_flag = $model->hantar_flag;
                $modelBantuanPenganjuranKursusPegawaiTeknikal->tarikh_laporan_hantar = $model->tarikh_hantar;

                $modelBantuanPenganjuranKursusPegawaiTeknikal->save();
            } 
        } 
        
        if($model->bantuan_penyertaan_pegawai_teknikal_id && $model->bantuan_penyertaan_pegawai_teknikal_id != 0){
            if (($modelBantuanPenyertaanPegawaiTeknikal = BantuanPenyertaanPegawaiTeknikal::findOne($model->bantuan_penyertaan_pegawai_teknikal_id)) !== null) {
                $modelBantuanPenyertaanPegawaiTeknikal->laporan_hantar_flag = $model->hantar_flag;
                $modelBantuanPenyertaanPegawaiTeknikal->tarikh_laporan_hantar = $model->tarikh_hantar;

                $modelBantuanPenyertaanPegawaiTeknikal->save();
            } 
        } 
        
        if($model->bantuan_penganjuran_kursus_id && $model->bantuan_penganjuran_kursus_id != 0){
            if (($modelBantuanPenganjuranKursus = BantuanPenganjuranKursus::findOne($model->bantuan_penganjuran_kursus_id)) !== null) {
                $modelBantuanPenganjuranKursus->laporan_hantar_flag = $model->hantar_flag;
                $modelBantuanPenganjuranKursus->tarikh_laporan_hantar = $model->tarikh_hantar;

                $modelBantuanPenganjuranKursus->save();
            } 
        } 
        
        return $this->redirect(['view', 'id' => $model->bantuan_penganjuran_kursus_pegawai_teknikal_laporan_id]);
    }
}
