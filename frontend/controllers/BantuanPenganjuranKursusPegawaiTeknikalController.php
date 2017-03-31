<?php

namespace frontend\controllers;

use Yii;
use app\models\BantuanPenganjuranKursusPegawaiTeknikal;
use frontend\models\BantuanPenganjuranKursusPegawaiTeknikalSearch;
use app\models\BantuanPenganjuranKursusPegawaiTeknikalDicadangkan;
use frontend\models\BantuanPenganjuranKursusPegawaiTeknikalDicadangkanSearch;
use app\models\BantuanPenganjuranKursusPegawaiTeknikalDisertai;
use frontend\models\BantuanPenganjuranKursusPegawaiTeknikalDisertaiSearch;
use app\models\BantuanPenganjuranKursusPegawaiTeknikalOlehMsn;
use frontend\models\BantuanPenganjuranKursusPegawaiTeknikalOlehMsnSearch;
use app\models\MsnLaporan;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\helpers\BaseUrl;
use yii\web\Session;

use app\models\general\GeneralLabel;
use app\models\general\Upload;
use app\models\general\GeneralVariable;
use common\models\general\GeneralFunction;

// table reference
use app\models\RefSukan;
use app\models\RefBandar;
use app\models\RefNegeri;
use app\models\RefBank;
use app\models\ProfilBadanSukan;
use app\models\RefStatusBantuanPenganjuranKursusPegawaiTeknikal;

use common\models\User;

/**
 * BantuanPenganjuranKursusPegawaiTeknikalController implements the CRUD actions for BantuanPenganjuranKursusPegawaiTeknikal model.
 */
class BantuanPenganjuranKursusPegawaiTeknikalController extends Controller
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
     * Lists all BantuanPenganjuranKursusPegawaiTeknikal models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $queryParams = Yii::$app->request->queryParams;
        
        if(isset(Yii::$app->user->identity->peranan_akses['MSN']['bantuan-penganjuran-kursus-pegawai-teknikal']['data-sendiri'])){
            $queryParams['BantuanPenganjuranKursusPegawaiTeknikalSearch']['created_by'] = Yii::$app->user->identity->id;
        }
        
        $searchModel = new BantuanPenganjuranKursusPegawaiTeknikalSearch();
        $dataProvider = $searchModel->search($queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single BantuanPenganjuranKursusPegawaiTeknikal model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = $this->findModel($id);
        
        $ref = RefSukan::findOne(['id' => $model->sukan]);
        $model->sukan = $ref['desc'];
        
        $ref = RefBandar::findOne(['id' => $model->alamat_bandar]);
        $model->alamat_bandar = $ref['desc'];
        
        $ref = RefNegeri::findOne(['id' => $model->alamat_negeri]);
        $model->alamat_negeri = $ref['desc'];
        
        $ref = RefBank::findOne(['id' => $model->nama_bank]);
        $model->nama_bank = $ref['desc'];
        
        $ref = ProfilBadanSukan::findOne(['profil_badan_sukan' => $model->badan_sukan]);
        $model->badan_sukan = $ref['nama_badan_sukan'];
        
        $model->status_permohonan_id = $model->status_permohonan;
        $ref = RefStatusBantuanPenganjuranKursusPegawaiTeknikal::findOne(['id' => $model->status_permohonan]);
        $model->status_permohonan = $ref['desc'];
        
        $queryPar = null;
        
        $queryPar['BantuanPenganjuranKursusPegawaiTeknikalDicadangkanSearch']['bantuan_penganjuran_kursus_pegawai_teknikal_id'] = $id;
        $queryPar['BantuanPenganjuranKursusPegawaiTeknikalDisertaiSearch']['bantuan_penganjuran_kursus_pegawai_teknikal_id'] = $id;
        $queryPar['BantuanPenganjuranKursusPegawaiTeknikalOlehMsnSearch']['bantuan_penganjuran_kursus_pegawai_teknikal_id'] = $id;
        
        $searchModelBantuanPenganjuranKursusPegawaiTeknikalDicadangkan  = new BantuanPenganjuranKursusPegawaiTeknikalDicadangkanSearch();
        $dataProviderBantuanPenganjuranKursusPegawaiTeknikalDicadangkan = $searchModelBantuanPenganjuranKursusPegawaiTeknikalDicadangkan->search($queryPar);
        
        $searchModelBantuanPenganjuranKursusPegawaiTeknikalDisertai  = new BantuanPenganjuranKursusPegawaiTeknikalDisertaiSearch();
        $dataProviderBantuanPenganjuranKursusPegawaiTeknikalDisertai = $searchModelBantuanPenganjuranKursusPegawaiTeknikalDisertai->search($queryPar);
        
        $searchModelBantuanPenganjuranKursusPegawaiTeknikalOlehMsn  = new BantuanPenganjuranKursusPegawaiTeknikalOlehMsnSearch();
        $dataProviderBantuanPenganjuranKursusPegawaiTeknikalOlehMsn = $searchModelBantuanPenganjuranKursusPegawaiTeknikalOlehMsn->search($queryPar);
        
        return $this->render('view', [
            'model' => $model,
            'searchModelBantuanPenganjuranKursusPegawaiTeknikalDicadangkan' => $searchModelBantuanPenganjuranKursusPegawaiTeknikalDicadangkan,
            'dataProviderBantuanPenganjuranKursusPegawaiTeknikalDicadangkan' => $dataProviderBantuanPenganjuranKursusPegawaiTeknikalDicadangkan,
            'searchModelBantuanPenganjuranKursusPegawaiTeknikalDisertai' => $searchModelBantuanPenganjuranKursusPegawaiTeknikalDisertai,
            'dataProviderBantuanPenganjuranKursusPegawaiTeknikalDisertai' => $dataProviderBantuanPenganjuranKursusPegawaiTeknikalDisertai,
            'searchModelBantuanPenganjuranKursusPegawaiTeknikalOlehMsn' => $searchModelBantuanPenganjuranKursusPegawaiTeknikalOlehMsn,
            'dataProviderBantuanPenganjuranKursusPegawaiTeknikalOlehMsn' => $dataProviderBantuanPenganjuranKursusPegawaiTeknikalOlehMsn,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new BantuanPenganjuranKursusPegawaiTeknikal model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new BantuanPenganjuranKursusPegawaiTeknikal();
        
        $model->scenario = 'create';
        $model->tarikh_permohonan = GeneralFunction::getCurrentTimestamp();
        $model->status_permohonan = RefStatusBantuanPenganjuranKursusPegawaiTeknikal::SEDANG_DIPROSES;
        
        $queryPar = null;
        
        Yii::$app->session->open();
        
        if(isset(Yii::$app->session->id)){
            $queryPar['BantuanPenganjuranKursusPegawaiTeknikalDicadangkanSearch']['session_id'] = Yii::$app->session->id;
            $queryPar['BantuanPenganjuranKursusPegawaiTeknikalDisertaiSearch']['session_id'] = Yii::$app->session->id;
            $queryPar['BantuanPenganjuranKursusPegawaiTeknikalOlehMsnSearch']['session_id'] = Yii::$app->session->id;
        }
        
        $searchModelBantuanPenganjuranKursusPegawaiTeknikalDicadangkan  = new BantuanPenganjuranKursusPegawaiTeknikalDicadangkanSearch();
        $dataProviderBantuanPenganjuranKursusPegawaiTeknikalDicadangkan = $searchModelBantuanPenganjuranKursusPegawaiTeknikalDicadangkan->search($queryPar);
        
        $searchModelBantuanPenganjuranKursusPegawaiTeknikalDisertai  = new BantuanPenganjuranKursusPegawaiTeknikalDisertaiSearch();
        $dataProviderBantuanPenganjuranKursusPegawaiTeknikalDisertai = $searchModelBantuanPenganjuranKursusPegawaiTeknikalDisertai->search($queryPar);
        
        $searchModelBantuanPenganjuranKursusPegawaiTeknikalOlehMsn  = new BantuanPenganjuranKursusPegawaiTeknikalOlehMsnSearch();
        $dataProviderBantuanPenganjuranKursusPegawaiTeknikalOlehMsn = $searchModelBantuanPenganjuranKursusPegawaiTeknikalOlehMsn->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            
            if(isset(Yii::$app->session->id)){
                BantuanPenganjuranKursusPegawaiTeknikalDicadangkan::updateAll(['bantuan_penganjuran_kursus_pegawai_teknikal_id' => $model->bantuan_penganjuran_kursus_pegawai_teknikal_id], 'session_id = "'.Yii::$app->session->id.'"');
                BantuanPenganjuranKursusPegawaiTeknikalDicadangkan::updateAll(['session_id' => ''], 'bantuan_penganjuran_kursus_pegawai_teknikal_id = "'.$model->bantuan_penganjuran_kursus_pegawai_teknikal_id.'"');
                
                BantuanPenganjuranKursusPegawaiTeknikalDisertai::updateAll(['bantuan_penganjuran_kursus_pegawai_teknikal_id' => $model->bantuan_penganjuran_kursus_pegawai_teknikal_id], 'session_id = "'.Yii::$app->session->id.'"');
                BantuanPenganjuranKursusPegawaiTeknikalDisertai::updateAll(['session_id' => ''], 'bantuan_penganjuran_kursus_pegawai_teknikal_id = "'.$model->bantuan_penganjuran_kursus_pegawai_teknikal_id.'"');
                
                BantuanPenganjuranKursusPegawaiTeknikalOlehMsn::updateAll(['bantuan_penganjuran_kursus_pegawai_teknikal_id' => $model->bantuan_penganjuran_kursus_pegawai_teknikal_id], 'session_id = "'.Yii::$app->session->id.'"');
                BantuanPenganjuranKursusPegawaiTeknikalOlehMsn::updateAll(['session_id' => ''], 'bantuan_penganjuran_kursus_pegawai_teknikal_id = "'.$model->bantuan_penganjuran_kursus_pegawai_teknikal_id.'"');
            }
            
            $file = UploadedFile::getInstance($model, 'surat_rasmi_badan_sukan');
            $filename = $model->bantuan_penganjuran_kursus_pegawai_teknikal_id . "-surat_rasmi_badan_sukan";
            if($file){
                $model->surat_rasmi_badan_sukan = Upload::uploadFile($file, Upload::bantuanPenganjuranKursusPegawaiTeknikalFolder, $filename);
            }
            
            $file = UploadedFile::getInstance($model, 'surat_jemputan_daripada_pengelola');
            $filename = $model->bantuan_penganjuran_kursus_pegawai_teknikal_id . "-surat_jemputan_daripada_pengelola";
            if($file){
                $model->surat_jemputan_daripada_pengelola = Upload::uploadFile($file, Upload::bantuanPenganjuranKursusPegawaiTeknikalFolder, $filename);
            }
            
            $file = UploadedFile::getInstance($model, 'butiran_perbelanjaan');
            $filename = $model->bantuan_penganjuran_kursus_pegawai_teknikal_id . "-butiran_perbelanjaan";
            if($file){
                $model->butiran_perbelanjaan = Upload::uploadFile($file, Upload::bantuanPenganjuranKursusPegawaiTeknikalFolder, $filename);
            }
            
            $file = UploadedFile::getInstance($model, 'salinan_passport');
            $filename = $model->bantuan_penganjuran_kursus_pegawai_teknikal_id . "-salinan_passport";
            if($file){
                $model->salinan_passport = Upload::uploadFile($file, Upload::bantuanPenganjuranKursusPegawaiTeknikalFolder, $filename);
            }
            
            $file = UploadedFile::getInstance($model, 'maklumat_lain_sokongan');
            $filename = $model->bantuan_penganjuran_kursus_pegawai_teknikal_id . "-maklumat_lain_sokongan";
            if($file){
                $model->maklumat_lain_sokongan = Upload::uploadFile($file, Upload::bantuanPenganjuranKursusPegawaiTeknikalFolder, $filename);
            }
            
            $file = UploadedFile::getInstance($model, 'surat_kelulusan');
            $filename = $model->bantuan_penganjuran_kursus_pegawai_teknikal_id . "-surat_kelulusan";
            if($file){
                $model->surat_kelulusan = Upload::uploadFile($file, Upload::bantuanPenganjuranKursusPegawaiTeknikalFolder, $filename);
            }
            
            if($model->save()){
                if (($modelUsers = User::find()->joinWith('refUserPeranan')->andFilterWhere(['like', 'tbl_user_peranan.peranan_akses', 'pemberitahuan_emel_bantuan-penganjuran-kursus-pegawai-teknikal'])->groupBy('id')->all()) !== null) {
                    $refProfilBadanSukan = ProfilBadanSukan::findOne(['profil_badan_sukan' => $model->badan_sukan]);
                    foreach($modelUsers as $modelUser){

                        if($modelUser->email && $modelUser->email != ""){
                            //echo "E-mail: " . $modelUser->email . "\n";
                            Yii::$app->mailer->compose()
                            ->setTo($modelUser->email)
                            ->setFrom('noreply@spsb.com')
                            ->setSubject('Pemberitahuan - Permohonan Baru: Penyertaan Pegawai Teknikal Mengikut Kursus / Seminar / Bengkel Dalam Dan Luar Negara')
                            ->setTextBody("Salam Sejahtera,
    <br><br>
    Berikut adalah butir permohonan telah dihantar : 
    <br>
    Badan Sukan: " . $refProfilBadanSukan['nama_badan_sukan'] . "
    Nama Kursus / Seminar / Bengkel: " . $model->nama_kursus_seminar_bengkel . '
    Tempat: ' . $model->tempat . '
    Tarikh Mula: ' . $model->tarikh . '
    Tarikh Tamat: ' . $model->tarikh_tamat . '
    Jumlah Bantuan Yang Dipohon: RM' . $model->jumlah_bantuan_yang_dipohon . '
    <br>
    Link: ' . BaseUrl::to(['bantuan-penganjuran-kursus-pegawai-teknikal/view', 'id' => $model->bantuan_penganjuran_kursus_pegawai_teknikal_id], true) . '
    <br><br>
    "KE ARAH KECEMERLANGAN SUKAN"
    Majlis Sukan Negara Malaysia.
        ')->send();
                        }
                    }
                }
                
                return $this->redirect(['view', 'id' => $model->bantuan_penganjuran_kursus_pegawai_teknikal_id]);
            }
        } 
        
        return $this->render('create', [
                'model' => $model,
                'searchModelBantuanPenganjuranKursusPegawaiTeknikalDicadangkan' => $searchModelBantuanPenganjuranKursusPegawaiTeknikalDicadangkan,
                'dataProviderBantuanPenganjuranKursusPegawaiTeknikalDicadangkan' => $dataProviderBantuanPenganjuranKursusPegawaiTeknikalDicadangkan,
                'searchModelBantuanPenganjuranKursusPegawaiTeknikalDisertai' => $searchModelBantuanPenganjuranKursusPegawaiTeknikalDisertai,
                'dataProviderBantuanPenganjuranKursusPegawaiTeknikalDisertai' => $dataProviderBantuanPenganjuranKursusPegawaiTeknikalDisertai,
                'searchModelBantuanPenganjuranKursusPegawaiTeknikalOlehMsn' => $searchModelBantuanPenganjuranKursusPegawaiTeknikalOlehMsn,
                'dataProviderBantuanPenganjuranKursusPegawaiTeknikalOlehMsn' => $dataProviderBantuanPenganjuranKursusPegawaiTeknikalOlehMsn,
                'readonly' => false,
            ]);
    }

    /**
     * Updates an existing BantuanPenganjuranKursusPegawaiTeknikal model.
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
        
        $model->status_permohonan_id = $model->status_permohonan;
        
        $queryPar = null;
        
        $queryPar['BantuanPenganjuranKursusPegawaiTeknikalDicadangkanSearch']['bantuan_penganjuran_kursus_pegawai_teknikal_id'] = $id;
        $queryPar['BantuanPenganjuranKursusPegawaiTeknikalDisertaiSearch']['bantuan_penganjuran_kursus_pegawai_teknikal_id'] = $id;
        $queryPar['BantuanPenganjuranKursusPegawaiTeknikalOlehMsnSearch']['bantuan_penganjuran_kursus_pegawai_teknikal_id'] = $id;
        
        $searchModelBantuanPenganjuranKursusPegawaiTeknikalDicadangkan  = new BantuanPenganjuranKursusPegawaiTeknikalDicadangkanSearch();
        $dataProviderBantuanPenganjuranKursusPegawaiTeknikalDicadangkan = $searchModelBantuanPenganjuranKursusPegawaiTeknikalDicadangkan->search($queryPar);
        
        $searchModelBantuanPenganjuranKursusPegawaiTeknikalDisertai  = new BantuanPenganjuranKursusPegawaiTeknikalDisertaiSearch();
        $dataProviderBantuanPenganjuranKursusPegawaiTeknikalDisertai = $searchModelBantuanPenganjuranKursusPegawaiTeknikalDisertai->search($queryPar);
        
        $searchModelBantuanPenganjuranKursusPegawaiTeknikalOlehMsn  = new BantuanPenganjuranKursusPegawaiTeknikalOlehMsnSearch();
        $dataProviderBantuanPenganjuranKursusPegawaiTeknikalOlehMsn = $searchModelBantuanPenganjuranKursusPegawaiTeknikalOlehMsn->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $file = UploadedFile::getInstance($model, 'surat_rasmi_badan_sukan');
            $filename = $model->bantuan_penganjuran_kursus_pegawai_teknikal_id . "-surat_rasmi_badan_sukan";
            if($file){
                $model->surat_rasmi_badan_sukan = Upload::uploadFile($file, Upload::bantuanPenganjuranKursusPegawaiTeknikalFolder, $filename);
            }
            
            $file = UploadedFile::getInstance($model, 'surat_jemputan_daripada_pengelola');
            $filename = $model->bantuan_penganjuran_kursus_pegawai_teknikal_id . "-surat_jemputan_daripada_pengelola";
            if($file){
                $model->surat_jemputan_daripada_pengelola = Upload::uploadFile($file, Upload::bantuanPenganjuranKursusPegawaiTeknikalFolder, $filename);
            }
            
            $file = UploadedFile::getInstance($model, 'butiran_perbelanjaan');
            $filename = $model->bantuan_penganjuran_kursus_pegawai_teknikal_id . "-butiran_perbelanjaan";
            if($file){
                $model->butiran_perbelanjaan = Upload::uploadFile($file, Upload::bantuanPenganjuranKursusPegawaiTeknikalFolder, $filename);
            }
            
            $file = UploadedFile::getInstance($model, 'salinan_passport');
            $filename = $model->bantuan_penganjuran_kursus_pegawai_teknikal_id . "-salinan_passport";
            if($file){
                $model->salinan_passport = Upload::uploadFile($file, Upload::bantuanPenganjuranKursusPegawaiTeknikalFolder, $filename);
            }
            
            $file = UploadedFile::getInstance($model, 'maklumat_lain_sokongan');
            $filename = $model->bantuan_penganjuran_kursus_pegawai_teknikal_id . "-maklumat_lain_sokongan";
            if($file){
                $model->maklumat_lain_sokongan = Upload::uploadFile($file, Upload::bantuanPenganjuranKursusPegawaiTeknikalFolder, $filename);
            }
            
            $file = UploadedFile::getInstance($model, 'surat_kelulusan');
            $filename = $model->bantuan_penganjuran_kursus_pegawai_teknikal_id . "-surat_kelulusan";
            if($file){
                $model->surat_kelulusan = Upload::uploadFile($file, Upload::bantuanPenganjuranKursusPegawaiTeknikalFolder, $filename);
            }
            
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->bantuan_penganjuran_kursus_pegawai_teknikal_id]);
            }
        } 
        
        return $this->render('update', [
                'model' => $model,
                'searchModelBantuanPenganjuranKursusPegawaiTeknikalDicadangkan' => $searchModelBantuanPenganjuranKursusPegawaiTeknikalDicadangkan,
                'dataProviderBantuanPenganjuranKursusPegawaiTeknikalDicadangkan' => $dataProviderBantuanPenganjuranKursusPegawaiTeknikalDicadangkan,
                'searchModelBantuanPenganjuranKursusPegawaiTeknikalDisertai' => $searchModelBantuanPenganjuranKursusPegawaiTeknikalDisertai,
                'dataProviderBantuanPenganjuranKursusPegawaiTeknikalDisertai' => $dataProviderBantuanPenganjuranKursusPegawaiTeknikalDisertai,
                'searchModelBantuanPenganjuranKursusPegawaiTeknikalOlehMsn' => $searchModelBantuanPenganjuranKursusPegawaiTeknikalOlehMsn,
                'dataProviderBantuanPenganjuranKursusPegawaiTeknikalOlehMsn' => $dataProviderBantuanPenganjuranKursusPegawaiTeknikalOlehMsn,
                'readonly' => false,
            ]);
    }

    /**
     * Deletes an existing BantuanPenganjuranKursusPegawaiTeknikal model.
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
     * Finds the BantuanPenganjuranKursusPegawaiTeknikal model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return BantuanPenganjuranKursusPegawaiTeknikal the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = BantuanPenganjuranKursusPegawaiTeknikal::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionSetBadanSukan($badan_sukan_id){
        
        $session = new Session;
        $session->open();

        $session['bantuan-penganjuran-kursus-pegawai-teknikal-badan_sukan_id'] = $badan_sukan_id;
        
        $session->close();
    }
    
    public function actionLaporanStatistikPenyertaanPegawaiTeknikalMengikutKursus()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new MsnLaporan();
        $model->format = 'html';

        if ($model->load(Yii::$app->request->post())) {
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-laporan-statistik-penyertaan-pegawai-teknikal-mengikut-kursus'
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-laporan-statistik-penyertaan-pegawai-teknikal-mengikut-kursus'
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'format' => $model->format
                ]);
            }
        } 

        return $this->render('laporan_statistik_penyertaan_pegawai_teknikal_mengikut_kursus', [
            'model' => $model,
            'readonly' => false,
        ]);
    }
    
    public function actionGenerateLaporanStatistikPenyertaanPegawaiTeknikalMengikutKursus($tarikh_dari, $tarikh_hingga, $format)
    {
        if($tarikh_dari == "") $tarikh_dari = array();
        else $tarikh_dari = array($tarikh_dari);
        
        if($tarikh_hingga == "") $tarikh_hingga = array();
        else $tarikh_hingga = array($tarikh_hingga);
        
        $controls = array(
            'FROM_DATE' => $tarikh_dari,
            'TO_DATE' => $tarikh_hingga,
        );
        
        GeneralFunction::generateReport('/spsb/MSN/LaporanStatistikPenyertaanPegawaiTeknikalMengikutKursus', $format, $controls, 'laporan_statistik_penyertaan_pegawai_teknikal_mengikut_kursus');
    }
	
	public function actionPrint($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }  
        $model = $this->findModel($id);
		
        $ref = RefSukan::findOne(['id' => $model->sukan]);
        $model->sukan = $ref['desc'];
        
        $ref = RefBandar::findOne(['id' => $model->alamat_bandar]);
        $model->alamat_bandar = $ref['desc'];
        
        $ref = RefNegeri::findOne(['id' => $model->alamat_negeri]);
        $model->alamat_negeri = $ref['desc'];
        
        $ref = RefBank::findOne(['id' => $model->nama_bank]);
        $model->nama_bank = $ref['desc'];
        
        $ref = ProfilBadanSukan::findOne(['profil_badan_sukan' => $model->badan_sukan]);
        $model->badan_sukan = $ref['nama_badan_sukan'];
        
        $model->status_permohonan_id = $model->status_permohonan;
        $ref = RefStatusBantuanPenganjuranKursusPegawaiTeknikal::findOne(['id' => $model->status_permohonan]);
        $model->status_permohonan = $ref['desc'];

		$BantuanPenganjuranKursusPegawaiTeknikalDicadangkan = BantuanPenganjuranKursusPegawaiTeknikalDicadangkan::find()->where(['bantuan_penganjuran_kursus_pegawai_teknikal_id' => $model->bantuan_penganjuran_kursus_pegawai_teknikal_id])->all();
		
		$BantuanPenganjuranKursusPegawaiTeknikalDisertai = BantuanPenganjuranKursusPegawaiTeknikalDisertai::find()->where(['bantuan_penganjuran_kursus_pegawai_teknikal_id' => $model->bantuan_penganjuran_kursus_pegawai_teknikal_id])->all();
				
		$BantuanPenganjuranKursusPegawaiTeknikalOlehMsn = BantuanPenganjuranKursusPegawaiTeknikalOlehMsn::find()->where(['bantuan_penganjuran_kursus_pegawai_teknikal_id' => $model->bantuan_penganjuran_kursus_pegawai_teknikal_id])->all();

        $pdf = new \mPDF('utf-8', 'A4');

        $pdf->title = GeneralLabel::bantuan_penganjuran_kursus_pegawai_teknikal;

        $stylesheet = file_get_contents('css/report.css');

        $pdf->WriteHTML($stylesheet,1);
        
        $pdf->WriteHTML($this->renderpartial('print', [
             'model'  => $model,
		     'title' => $pdf->title,
			 'BantuanPenganjuranKursusPegawaiTeknikalDicadangkan' => $BantuanPenganjuranKursusPegawaiTeknikalDicadangkan,
			 'BantuanPenganjuranKursusPegawaiTeknikalDisertai' => $BantuanPenganjuranKursusPegawaiTeknikalDisertai,
			 'BantuanPenganjuranKursusPegawaiTeknikalOlehMsn' => $BantuanPenganjuranKursusPegawaiTeknikalOlehMsn,
        ]));

        $pdf->Output(str_replace(' ', '_', $pdf->title).'_'.$model->bantuan_penganjuran_kursus_pegawai_teknikal_id.'.pdf', 'I');
    }
}
