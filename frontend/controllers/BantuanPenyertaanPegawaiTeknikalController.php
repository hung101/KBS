<?php

namespace frontend\controllers;

use Yii;
use app\models\BantuanPenyertaanPegawaiTeknikal;
use frontend\models\BantuanPenyertaanPegawaiTeknikalSearch;
use app\models\BantuanPenyertaanPegawaiTeknikalDicadangkan;
use frontend\models\BantuanPenyertaanPegawaiTeknikalDicadangkanSearch;
use app\models\BantuanPenyertaanPegawaiTeknikalDisertai;
use frontend\models\BantuanPenyertaanPegawaiTeknikalDisertaiSearch;
use app\models\BantuanPenyertaanPegawaiTeknikalOlehMsn;
use frontend\models\BantuanPenyertaanPegawaiTeknikalOlehMsnSearch;
use app\models\BantuanPenyertaanPegawaiTeknikalElemen;
use frontend\models\BantuanPenyertaanPegawaiTeknikalElemenSearch;
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
use app\models\RefStatusBantuanPenyertaanPegawaiTeknikal;
use app\models\RefPeringkatBantuanPenyertaanPegawaiTeknikal;

use common\models\User;

/**
 * BantuanPenyertaanPegawaiTeknikalController implements the CRUD actions for BantuanPenyertaanPegawaiTeknikal model.
 */
class BantuanPenyertaanPegawaiTeknikalController extends Controller
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
     * Lists all BantuanPenyertaanPegawaiTeknikal models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $queryParams = Yii::$app->request->queryParams;
        
        if(isset(Yii::$app->user->identity->peranan_akses['MSN']['bantuan-penyertaan-pegawai-teknikal']['data-sendiri'])){
            $queryParams['BantuanPenyertaanPegawaiTeknikalSearch']['created_by'] = Yii::$app->user->identity->id;
        }
        
        if(isset(Yii::$app->user->identity->peranan_akses['MSN']['bantuan-penyertaan-pegawai-teknikal']['kelulusan'])) {
            $queryParams['BantuanPenyertaanPegawaiTeknikalSearch']['hantar_flag'] = 1;
        }
        
        $searchModel = new BantuanPenyertaanPegawaiTeknikalSearch();
        $dataProvider = $searchModel->search($queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single BantuanPenyertaanPegawaiTeknikal model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $queryPar = null;
        
        $queryPar['BantuanPenyertaanPegawaiTeknikalDicadangkanSearch']['bantuan_penyertaan_pegawai_teknikal_id'] = $id;
        $queryPar['BantuanPenyertaanPegawaiTeknikalDisertaiSearch']['bantuan_penyertaan_pegawai_teknikal_id'] = $id;
        $queryPar['BantuanPenyertaanPegawaiTeknikalOlehMsnSearch']['bantuan_penyertaan_pegawai_teknikal_id'] = $id;
        $queryPar['BantuanPenyertaanPegawaiTeknikalElemenSearch']['bantuan_penyertaan_pegawai_teknikal_id'] = $id;
        
        $searchModelBantuanPenyertaanPegawaiTeknikalDicadangkan  = new BantuanPenyertaanPegawaiTeknikalDicadangkanSearch();
        $dataProviderBantuanPenyertaanPegawaiTeknikalDicadangkan = $searchModelBantuanPenyertaanPegawaiTeknikalDicadangkan->search($queryPar);
        
        $searchModelBantuanPenyertaanPegawaiTeknikalDisertai  = new BantuanPenyertaanPegawaiTeknikalDisertaiSearch();
        $dataProviderBantuanPenyertaanPegawaiTeknikalDisertai = $searchModelBantuanPenyertaanPegawaiTeknikalDisertai->search($queryPar);
        
        $searchModelBantuanPenyertaanPegawaiTeknikalOlehMsn  = new BantuanPenyertaanPegawaiTeknikalOlehMsnSearch();
        $dataProviderBantuanPenyertaanPegawaiTeknikalOlehMsn = $searchModelBantuanPenyertaanPegawaiTeknikalOlehMsn->search($queryPar);
        
        $searchModelBantuanPenyertaanPegawaiTeknikalElemen  = new BantuanPenyertaanPegawaiTeknikalElemenSearch();
        $dataProviderBantuanPenyertaanPegawaiTeknikalElemen = $searchModelBantuanPenyertaanPegawaiTeknikalElemen->search($queryPar);
        
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
        
        $ref = RefPeringkatBantuanPenyertaanPegawaiTeknikal::findOne(['id' => $model->peringkat]);
        $model->peringkat = $ref['desc'];
        
        $model->status_permohonan_id = $model->status_permohonan;
        $ref = RefStatusBantuanPenyertaanPegawaiTeknikal::findOne(['id' => $model->status_permohonan]);
        $model->status_permohonan = $ref['desc'];
        
        $model->selesai = GeneralLabel::getYesNoLabel($model->selesai);
        
        if($model->tarikh != "") {$model->tarikh = GeneralFunction::convert($model->tarikh, GeneralFunction::TYPE_DATE);}
        if($model->tarikh_tamat != "") {$model->tarikh_tamat = GeneralFunction::convert($model->tarikh_tamat, GeneralFunction::TYPE_DATE);}
        if($model->tarikh_permohonan != "") {$model->tarikh_permohonan = GeneralFunction::convert($model->tarikh_permohonan, GeneralFunction::TYPE_DATETIME);}
        if($model->tarikh_jkb != "") {$model->tarikh_jkb = GeneralFunction::convert($model->tarikh_jkb, GeneralFunction::TYPE_DATE);}
        
        return $this->render('view', [
            'model' => $model,
            'searchModelBantuanPenyertaanPegawaiTeknikalDicadangkan' => $searchModelBantuanPenyertaanPegawaiTeknikalDicadangkan,
            'dataProviderBantuanPenyertaanPegawaiTeknikalDicadangkan' => $dataProviderBantuanPenyertaanPegawaiTeknikalDicadangkan,
            'searchModelBantuanPenyertaanPegawaiTeknikalDisertai' => $searchModelBantuanPenyertaanPegawaiTeknikalDisertai,
            'dataProviderBantuanPenyertaanPegawaiTeknikalDisertai' => $dataProviderBantuanPenyertaanPegawaiTeknikalDisertai,
            'searchModelBantuanPenyertaanPegawaiTeknikalOlehMsn' => $searchModelBantuanPenyertaanPegawaiTeknikalOlehMsn,
            'dataProviderBantuanPenyertaanPegawaiTeknikalOlehMsn' => $dataProviderBantuanPenyertaanPegawaiTeknikalOlehMsn,
            'searchModelBantuanPenyertaanPegawaiTeknikalElemen' => $searchModelBantuanPenyertaanPegawaiTeknikalElemen,
            'dataProviderBantuanPenyertaanPegawaiTeknikalElemen' => $dataProviderBantuanPenyertaanPegawaiTeknikalElemen,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new BantuanPenyertaanPegawaiTeknikal model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new BantuanPenyertaanPegawaiTeknikal();
        
        $model->scenario = 'create';
        
        
        if(Yii::$app->user->identity->profil_badan_sukan){
            $model->badan_sukan = Yii::$app->user->identity->profil_badan_sukan;
        }
        
        $queryPar = null;
        
        Yii::$app->session->open();
        
        if(isset(Yii::$app->session->id)){
            $queryPar['BantuanPenyertaanPegawaiTeknikalDicadangkanSearch']['session_id'] = Yii::$app->session->id;
            $queryPar['BantuanPenyertaanPegawaiTeknikalDisertaiSearch']['session_id'] = Yii::$app->session->id;
            $queryPar['BantuanPenyertaanPegawaiTeknikalOlehMsnSearch']['session_id'] = Yii::$app->session->id;
            $queryPar['BantuanPenyertaanPegawaiTeknikalElemenSearch']['session_id'] = Yii::$app->session->id;
        }
        
        $searchModelBantuanPenyertaanPegawaiTeknikalDicadangkan  = new BantuanPenyertaanPegawaiTeknikalDicadangkanSearch();
        $dataProviderBantuanPenyertaanPegawaiTeknikalDicadangkan = $searchModelBantuanPenyertaanPegawaiTeknikalDicadangkan->search($queryPar);
        
        $searchModelBantuanPenyertaanPegawaiTeknikalDisertai  = new BantuanPenyertaanPegawaiTeknikalDisertaiSearch();
        $dataProviderBantuanPenyertaanPegawaiTeknikalDisertai = $searchModelBantuanPenyertaanPegawaiTeknikalDisertai->search($queryPar);
        
        $searchModelBantuanPenyertaanPegawaiTeknikalOlehMsn  = new BantuanPenyertaanPegawaiTeknikalOlehMsnSearch();
        $dataProviderBantuanPenyertaanPegawaiTeknikalOlehMsn = $searchModelBantuanPenyertaanPegawaiTeknikalOlehMsn->search($queryPar);
        
        $searchModelBantuanPenyertaanPegawaiTeknikalElemen  = new BantuanPenyertaanPegawaiTeknikalElemenSearch();
        $dataProviderBantuanPenyertaanPegawaiTeknikalElemen = $searchModelBantuanPenyertaanPegawaiTeknikalElemen->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if(isset(Yii::$app->session->id)){
                BantuanPenyertaanPegawaiTeknikalDicadangkan::updateAll(['bantuan_penyertaan_pegawai_teknikal_id' => $model->bantuan_penyertaan_pegawai_teknikal_id], 'session_id = "'.Yii::$app->session->id.'"');
                BantuanPenyertaanPegawaiTeknikalDicadangkan::updateAll(['session_id' => ''], 'bantuan_penyertaan_pegawai_teknikal_id = "'.$model->bantuan_penyertaan_pegawai_teknikal_id.'"');
                
                BantuanPenyertaanPegawaiTeknikalDisertai::updateAll(['bantuan_penyertaan_pegawai_teknikal_id' => $model->bantuan_penyertaan_pegawai_teknikal_id], 'session_id = "'.Yii::$app->session->id.'"');
                BantuanPenyertaanPegawaiTeknikalDisertai::updateAll(['session_id' => ''], 'bantuan_penyertaan_pegawai_teknikal_id = "'.$model->bantuan_penyertaan_pegawai_teknikal_id.'"');
                
                BantuanPenyertaanPegawaiTeknikalOlehMsn::updateAll(['bantuan_penyertaan_pegawai_teknikal_id' => $model->bantuan_penyertaan_pegawai_teknikal_id], 'session_id = "'.Yii::$app->session->id.'"');
                BantuanPenyertaanPegawaiTeknikalOlehMsn::updateAll(['session_id' => ''], 'bantuan_penyertaan_pegawai_teknikal_id = "'.$model->bantuan_penyertaan_pegawai_teknikal_id.'"');
                
                BantuanPenyertaanPegawaiTeknikalElemen::updateAll(['bantuan_penyertaan_pegawai_teknikal_id' => $model->bantuan_penyertaan_pegawai_teknikal_id], 'session_id = "'.Yii::$app->session->id.'"');
                BantuanPenyertaanPegawaiTeknikalElemen::updateAll(['session_id' => ''], 'bantuan_penyertaan_pegawai_teknikal_id = "'.$model->bantuan_penyertaan_pegawai_teknikal_id.'"');
            }
            
            $file = UploadedFile::getInstance($model, 'surat_rasmi_badan_sukan_ms_negeri');
            $filename = $model->bantuan_penyertaan_pegawai_teknikal_id . "-surat_rasmi_badan_sukan_ms_negeri";
            if($file){
                $model->surat_rasmi_badan_sukan_ms_negeri = Upload::uploadFile($file, Upload::bantuanPenyertaanPegawaiTeknikalFolder, $filename);
            }
            
            $file = UploadedFile::getInstance($model, 'surat_jemputan_lantikan_daripada_pengelola');
            $filename = $model->bantuan_penyertaan_pegawai_teknikal_id . "-surat_jemputan_lantikan_daripada_pengelola";
            if($file){
                $model->surat_jemputan_lantikan_daripada_pengelola = Upload::uploadFile($file, Upload::bantuanPenyertaanPegawaiTeknikalFolder, $filename);
            }
            
            $file = UploadedFile::getInstance($model, 'butiran_perbelanjaan');
            $filename = $model->bantuan_penyertaan_pegawai_teknikal_id . "-butiran_perbelanjaan";
            if($file){
                $model->butiran_perbelanjaan = Upload::uploadFile($file, Upload::bantuanPenyertaanPegawaiTeknikalFolder, $filename);
            }
            
            $file = UploadedFile::getInstance($model, 'salinan_passport');
            $filename = $model->bantuan_penyertaan_pegawai_teknikal_id . "-salinan_passport";
            if($file){
                $model->salinan_passport = Upload::uploadFile($file, Upload::bantuanPenyertaanPegawaiTeknikalFolder, $filename);
            }
            
            $file = UploadedFile::getInstance($model, 'maklumat_lain_sokongan');
            $filename = $model->bantuan_penyertaan_pegawai_teknikal_id . "-maklumat_lain_sokongan";
            if($file){
                $model->maklumat_lain_sokongan = Upload::uploadFile($file, Upload::bantuanPenyertaanPegawaiTeknikalFolder, $filename);
            }
            
            $file = UploadedFile::getInstance($model, 'surat_kelulusan');
            $filename = $model->bantuan_penyertaan_pegawai_teknikal_id . "-surat_kelulusan";
            if($file){
                $model->surat_kelulusan = Upload::uploadFile($file, Upload::bantuanPenyertaanPegawaiTeknikalFolder, $filename);
            }
            
            if($model->save()){
                if (($modelUsers = User::find()->joinWith('refUserPeranan')->andFilterWhere(['like', 'tbl_user_peranan.peranan_akses', 'pemberitahuan_emel_bantuan-penyertaan-pegawai-teknikal'])->groupBy('id')->all()) !== null) {
                    $refProfilBadanSukan = ProfilBadanSukan::findOne(['profil_badan_sukan' => $model->badan_sukan]);
                    foreach($modelUsers as $modelUser){

                        if($modelUser->email && $modelUser->email != ""){
                            //echo "E-mail: " . $modelUser->email . "\n";
                            Yii::$app->mailer->compose()
                            ->setTo($modelUser->email)
                            ->setFrom('noreply@spsb.com')
                            ->setSubject('Pemberitahuan - Permohonan Baru: Penyertaan Pegawai Teknikal Ke Kejohanan Dalam & Luar Negara ')
                            ->setHtmlBody("Assalamualaikum dan Salam Sejahtera,
    <br><br>
    Terdapat permohonan baru yang diterima: 
    <br>
    Badan Sukan: " . $refProfilBadanSukan['nama_badan_sukan'] . "
    <br>Nama Kejohanan: " . $model->nama_kejohanan . '
    <br>Tempat: ' . $model->tempat . '
    <br>Tarikh Mula: ' . $model->tarikh . '
    <br>Tarikh Tamat: ' . $model->tarikh_tamat . '
    <br>Jumlah Bantuan Yang Dipohon: RM' . $model->jumlah_bantuan_yang_dipohon . '
    <br><br>
    Link: ' . BaseUrl::to(['bantuan-penyertaan-pegawai-teknikal/view', 'id' => $model->bantuan_penyertaan_pegawai_teknikal_id], true) . '
    <br><br>
    Sekian.
    <br><br>
    "KE ARAH KECEMERLANGAN SUKAN"<br>
    Majlis Sukan Negara Malaysia.
        ')->send();
                        }
                    }
                }
                
                return $this->redirect(['view', 'id' => $model->bantuan_penyertaan_pegawai_teknikal_id]);
            }
        } 
        
        return $this->render('create', [
                'model' => $model,
                'searchModelBantuanPenyertaanPegawaiTeknikalDicadangkan' => $searchModelBantuanPenyertaanPegawaiTeknikalDicadangkan,
                'dataProviderBantuanPenyertaanPegawaiTeknikalDicadangkan' => $dataProviderBantuanPenyertaanPegawaiTeknikalDicadangkan,
                'searchModelBantuanPenyertaanPegawaiTeknikalDisertai' => $searchModelBantuanPenyertaanPegawaiTeknikalDisertai,
                'dataProviderBantuanPenyertaanPegawaiTeknikalDisertai' => $dataProviderBantuanPenyertaanPegawaiTeknikalDisertai,
                'searchModelBantuanPenyertaanPegawaiTeknikalOlehMsn' => $searchModelBantuanPenyertaanPegawaiTeknikalOlehMsn,
                'dataProviderBantuanPenyertaanPegawaiTeknikalOlehMsn' => $dataProviderBantuanPenyertaanPegawaiTeknikalOlehMsn,
                'searchModelBantuanPenyertaanPegawaiTeknikalElemen' => $searchModelBantuanPenyertaanPegawaiTeknikalElemen,
                'dataProviderBantuanPenyertaanPegawaiTeknikalElemen' => $dataProviderBantuanPenyertaanPegawaiTeknikalElemen,
                'readonly' => false,
            ]);
    }

    /**
     * Updates an existing BantuanPenyertaanPegawaiTeknikal model.
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
        
        $queryPar['BantuanPenyertaanPegawaiTeknikalDicadangkanSearch']['bantuan_penyertaan_pegawai_teknikal_id'] = $id;
        $queryPar['BantuanPenyertaanPegawaiTeknikalDisertaiSearch']['bantuan_penyertaan_pegawai_teknikal_id'] = $id;
        $queryPar['BantuanPenyertaanPegawaiTeknikalOlehMsnSearch']['bantuan_penyertaan_pegawai_teknikal_id'] = $id;
        $queryPar['BantuanPenyertaanPegawaiTeknikalElemenSearch']['bantuan_penyertaan_pegawai_teknikal_id'] = $id;
        
        $searchModelBantuanPenyertaanPegawaiTeknikalDicadangkan  = new BantuanPenyertaanPegawaiTeknikalDicadangkanSearch();
        $dataProviderBantuanPenyertaanPegawaiTeknikalDicadangkan = $searchModelBantuanPenyertaanPegawaiTeknikalDicadangkan->search($queryPar);
        
        $searchModelBantuanPenyertaanPegawaiTeknikalDisertai  = new BantuanPenyertaanPegawaiTeknikalDisertaiSearch();
        $dataProviderBantuanPenyertaanPegawaiTeknikalDisertai = $searchModelBantuanPenyertaanPegawaiTeknikalDisertai->search($queryPar);
        
        $searchModelBantuanPenyertaanPegawaiTeknikalOlehMsn  = new BantuanPenyertaanPegawaiTeknikalOlehMsnSearch();
        $dataProviderBantuanPenyertaanPegawaiTeknikalOlehMsn = $searchModelBantuanPenyertaanPegawaiTeknikalOlehMsn->search($queryPar);
        
        $searchModelBantuanPenyertaanPegawaiTeknikalElemen  = new BantuanPenyertaanPegawaiTeknikalElemenSearch();
        $dataProviderBantuanPenyertaanPegawaiTeknikalElemen = $searchModelBantuanPenyertaanPegawaiTeknikalElemen->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $file = UploadedFile::getInstance($model, 'surat_rasmi_badan_sukan_ms_negeri');
            $filename = $model->bantuan_penyertaan_pegawai_teknikal_id . "-surat_rasmi_badan_sukan_ms_negeri";
            if($file){
                $model->surat_rasmi_badan_sukan_ms_negeri = Upload::uploadFile($file, Upload::bantuanPenyertaanPegawaiTeknikalFolder, $filename);
            }
            
            $file = UploadedFile::getInstance($model, 'surat_jemputan_lantikan_daripada_pengelola');
            $filename = $model->bantuan_penyertaan_pegawai_teknikal_id . "-surat_jemputan_lantikan_daripada_pengelola";
            if($file){
                $model->surat_jemputan_lantikan_daripada_pengelola = Upload::uploadFile($file, Upload::bantuanPenyertaanPegawaiTeknikalFolder, $filename);
            }
            
            $file = UploadedFile::getInstance($model, 'butiran_perbelanjaan');
            $filename = $model->bantuan_penyertaan_pegawai_teknikal_id . "-butiran_perbelanjaan";
            if($file){
                $model->butiran_perbelanjaan = Upload::uploadFile($file, Upload::bantuanPenyertaanPegawaiTeknikalFolder, $filename);
            }
            
            $file = UploadedFile::getInstance($model, 'salinan_passport');
            $filename = $model->bantuan_penyertaan_pegawai_teknikal_id . "-salinan_passport";
            if($file){
                $model->salinan_passport = Upload::uploadFile($file, Upload::bantuanPenyertaanPegawaiTeknikalFolder, $filename);
            }
            
            $file = UploadedFile::getInstance($model, 'maklumat_lain_sokongan');
            $filename = $model->bantuan_penyertaan_pegawai_teknikal_id . "-maklumat_lain_sokongan";
            if($file){
                $model->maklumat_lain_sokongan = Upload::uploadFile($file, Upload::bantuanPenyertaanPegawaiTeknikalFolder, $filename);
            }
            
            $file = UploadedFile::getInstance($model, 'surat_kelulusan');
            $filename = $model->bantuan_penyertaan_pegawai_teknikal_id . "-surat_kelulusan";
            if($file){
                $model->surat_kelulusan = Upload::uploadFile($file, Upload::bantuanPenyertaanPegawaiTeknikalFolder, $filename);
            }
            
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->bantuan_penyertaan_pegawai_teknikal_id]);
            }
        }
        
        return $this->render('update', [
                'model' => $model,
                'searchModelBantuanPenyertaanPegawaiTeknikalDicadangkan' => $searchModelBantuanPenyertaanPegawaiTeknikalDicadangkan,
                'dataProviderBantuanPenyertaanPegawaiTeknikalDicadangkan' => $dataProviderBantuanPenyertaanPegawaiTeknikalDicadangkan,
                'searchModelBantuanPenyertaanPegawaiTeknikalDisertai' => $searchModelBantuanPenyertaanPegawaiTeknikalDisertai,
                'dataProviderBantuanPenyertaanPegawaiTeknikalDisertai' => $dataProviderBantuanPenyertaanPegawaiTeknikalDisertai,
                'searchModelBantuanPenyertaanPegawaiTeknikalOlehMsn' => $searchModelBantuanPenyertaanPegawaiTeknikalOlehMsn,
                'dataProviderBantuanPenyertaanPegawaiTeknikalOlehMsn' => $dataProviderBantuanPenyertaanPegawaiTeknikalOlehMsn,
                'searchModelBantuanPenyertaanPegawaiTeknikalElemen' => $searchModelBantuanPenyertaanPegawaiTeknikalElemen,
                'dataProviderBantuanPenyertaanPegawaiTeknikalElemen' => $dataProviderBantuanPenyertaanPegawaiTeknikalElemen,
                'readonly' => false,
            ]);
    }

    /**
     * Deletes an existing BantuanPenyertaanPegawaiTeknikal model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        // delete upload file
        self::actionDeleteupload($id, 'surat_rasmi_badan_sukan_ms_negeri');
        
        self::actionDeleteupload($id, 'surat_jemputan_lantikan_daripada_pengelola');
        
        self::actionDeleteupload($id, 'butiran_perbelanjaan');
        
        self::actionDeleteupload($id, 'salinan_passport');
        
        self::actionDeleteupload($id, 'maklumat_lain_sokongan');
        
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the BantuanPenyertaanPegawaiTeknikal model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return BantuanPenyertaanPegawaiTeknikal the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = BantuanPenyertaanPegawaiTeknikal::findOne($id)) !== null) {
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
    
    public function actionSetBadanSukan($badan_sukan_id){
        
        $session = new Session;
        $session->open();

        $session['bantuan-penyertaan-pegawai-teknikal-badan_sukan_id'] = $badan_sukan_id;
        
        $session->close();
    }
    
    /**
     * Updates an existing BantuanPenyertaanPegawaiTeknikal model.
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
        
        $model->tarikh_permohonan = GeneralFunction::getCurrentTimestamp();
        $model->status_permohonan = RefStatusBantuanPenyertaanPegawaiTeknikal::SEDANG_DIPROSES;
        $model->selesai = 0; // set tidak
        
        $model->save();
        
        if (($modelUsers = User::find()->joinWith('refUserPeranan')->andFilterWhere(['like', 'tbl_user_peranan.peranan_akses', 'pemberitahuan_emel_bantuan-penyertaan-pegawai-teknikal'])->groupBy('id')->all()) !== null) {
                    $refProfilBadanSukan = ProfilBadanSukan::findOne(['profil_badan_sukan' => $model->badan_sukan]);
                    foreach($modelUsers as $modelUser){

                        if($modelUser->email && $modelUser->email != ""){
                            //echo "E-mail: " . $modelUser->email . "\n";
                            Yii::$app->mailer->compose()
                            ->setTo($modelUser->email)
                            ->setFrom('noreply@spsb.com')
                            ->setSubject('Pemberitahuan - Permohonan Baru: Penyertaan Pegawai Teknikal Ke Kejohanan Dalam & Luar Negara ')
                            ->setHtmlBody("Assalamualaikum dan Salam Sejahtera,
    <br><br>
    Terdapat permohonan baru yang diterima: 
    <br>
    Badan Sukan: " . $refProfilBadanSukan['nama_badan_sukan'] . "
    <br>Nama Kejohanan: " . $model->nama_kejohanan . '
    <br>Tempat: ' . $model->tempat . '
    <br>Tarikh Mula: ' . $model->tarikh . '
    <br>Tarikh Tamat: ' . $model->tarikh_tamat . '
    <br>Jumlah Bantuan Yang Dipohon: RM' . $model->jumlah_bantuan_yang_dipohon . '
    <br><br>
    Link: ' . BaseUrl::to(['bantuan-penyertaan-pegawai-teknikal/view', 'id' => $model->bantuan_penyertaan_pegawai_teknikal_id], true) . '
    <br><br>
    Sekian.
    <br><br>
    "KE ARAH KECEMERLANGAN SUKAN"<br>
    Majlis Sukan Negara Malaysia.
        ')->send();
                        }
                    }
                }
        
        return $this->redirect(['view', 'id' => $model->bantuan_penyertaan_pegawai_teknikal_id]);
    }
    
    public function actionLaporanStatistikPenyertaanPegawaiTeknikalKeKejohanan()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new MsnLaporan();
        $model->format = 'html';

        if ($model->load(Yii::$app->request->post())) {
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-laporan-statistik-penyertaan-pegawai-teknikal-ke-kejohanan'
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-laporan-statistik-penyertaan-pegawai-teknikal-ke-kejohanan'
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'format' => $model->format
                ]);
            }
        } 

        return $this->render('laporan_statistik_penyertaan_pegawai_teknikal_ke_kejohanan', [
            'model' => $model,
            'readonly' => false,
        ]);
    }
    
    public function actionGenerateLaporanStatistikPenyertaanPegawaiTeknikalKeKejohanan($tarikh_dari, $tarikh_hingga, $format)
    {
        if($tarikh_dari == "") $tarikh_dari = array();
        else $tarikh_dari = array($tarikh_dari);
        
        if($tarikh_hingga == "") $tarikh_hingga = array();
        else $tarikh_hingga = array($tarikh_hingga);
        
        $controls = array(
            'FROM_DATE' => $tarikh_dari,
            'TO_DATE' => $tarikh_hingga,
        );
        
        GeneralFunction::generateReport('/spsb/MSN/LaporanStatistikPenyertaanPegawaiTeknikalKeKejohanan', $format, $controls, 'laporan_statistik_penyertaan_pegawai_teknikal_ke_kejohanan');
    }
	
	public function actionPrint($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }  
        $model = $this->findModel($id);
		
		$BantuanPenyertaanPegawaiTeknikalDicadangkan = BantuanPenyertaanPegawaiTeknikalDicadangkan::find()->where(['bantuan_penyertaan_pegawai_teknikal_id' => $model->bantuan_penyertaan_pegawai_teknikal_id])->all();
		
		$BantuanPenyertaanPegawaiTeknikalDisertai = BantuanPenyertaanPegawaiTeknikalDisertai::find()->where(['bantuan_penyertaan_pegawai_teknikal_id' => $model->bantuan_penyertaan_pegawai_teknikal_id])->all();
				
		$BantuanPenyertaanPegawaiTeknikalOlehMsn = BantuanPenyertaanPegawaiTeknikalOlehMsn::find()->where(['bantuan_penyertaan_pegawai_teknikal_id' => $model->bantuan_penyertaan_pegawai_teknikal_id])->all();
		
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
        
        $ref = RefPeringkatBantuanPenyertaanPegawaiTeknikal::findOne(['id' => $model->peringkat]);
        $model->peringkat = $ref['desc'];
        
        $model->status_permohonan_id = $model->status_permohonan;
        $ref = RefStatusBantuanPenyertaanPegawaiTeknikal::findOne(['id' => $model->status_permohonan]);
        $model->status_permohonan = $ref['desc'];

        $pdf = new \mPDF('utf-8', 'A4');

        $pdf->title = GeneralLabel::bantuan_penyertaan_pegawai_teknikal;

        $stylesheet = file_get_contents('css/report.css');

        $pdf->WriteHTML($stylesheet,1);
        
        $pdf->WriteHTML($this->renderpartial('print', [
             'model'  => $model,
		     'title' => $pdf->title,
			 'BantuanPenyertaanPegawaiTeknikalDicadangkan' => $BantuanPenyertaanPegawaiTeknikalDicadangkan,
			 'BantuanPenyertaanPegawaiTeknikalDisertai' => $BantuanPenyertaanPegawaiTeknikalDisertai,
			 'BantuanPenyertaanPegawaiTeknikalOlehMsn' => $BantuanPenyertaanPegawaiTeknikalOlehMsn,
        ]));

        $pdf->Output(str_replace(' ', '_', $pdf->title).'_'.$model->bantuan_penyertaan_pegawai_teknikal_id.'.pdf', 'I');
    }
}
