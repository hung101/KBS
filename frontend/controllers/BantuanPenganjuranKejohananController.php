<?php

namespace frontend\controllers;

use Yii;
use app\models\BantuanPenganjuranKejohanan;
use frontend\models\BantuanPenganjuranKejohananSearch;
use app\models\BantuanPenganjuranKejohananKewangan;
use frontend\models\BantuanPenganjuranKejohananKewanganSearch;
use app\models\BantuanPenganjuranKejohananBayaran;
use frontend\models\BantuanPenganjuranKejohananBayaranSearch;
use app\models\BantuanPenganjuranKejohananElemen;
use frontend\models\BantuanPenganjuranKejohananElemenSearch;
use app\models\BantuanPenganjuranKejohananDianjurkan;
use frontend\models\BantuanPenganjuranKejohananDianjurkanSearch;
use app\models\BantuanPenganjuranKejohananOlehMsn;
use frontend\models\BantuanPenganjuranKejohananOlehMsnSearch;
use app\models\MsnLaporan;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\helpers\BaseUrl;

use app\models\general\Upload;
use app\models\general\GeneralVariable;
use app\models\general\GeneralLabel;
use common\models\general\GeneralFunction;

// table reference
use app\models\RefSukan;
use app\models\RefBandar;
use app\models\RefNegeri;
use app\models\RefBank;
use app\models\RefPeringkatBantuanPenganjuranKejohanan;
use app\models\ProfilBadanSukan;
use app\models\RefStatusBantuanPenganjuranKejohanan;

use common\models\User;

/**
 * BantuanPenganjuranKejohananController implements the CRUD actions for BantuanPenganjuranKejohanan model.
 */
class BantuanPenganjuranKejohananController extends Controller
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
     * Lists all BantuanPenganjuranKejohanan models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $queryParams = Yii::$app->request->queryParams;
        
        if(isset(Yii::$app->user->identity->peranan_akses['MSN']['bantuan-penganjuran-kejohanan']['data-sendiri'])){
            $queryParams['BantuanPenganjuranKejohananSearch']['created_by'] = Yii::$app->user->identity->id;
        }
        
        if(isset(Yii::$app->user->identity->peranan_akses['MSN']['bantuan-penganjuran-kejohanan']['kelulusan'])) {
            $queryParams['BantuanPenganjuranKejohananSearch']['hantar_flag'] = 1;
        }
        
        $searchModel = new BantuanPenganjuranKejohananSearch();
        $dataProvider = $searchModel->search($queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single BantuanPenganjuranKejohanan model.
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
        
        $ref = RefPeringkatBantuanPenganjuranKejohanan::findOne(['id' => $model->peringkat]);
        $model->peringkat = $ref['desc'];
        
        $ref = ProfilBadanSukan::findOne(['profil_badan_sukan' => $model->badan_sukan]);
        $model->badan_sukan = $ref['nama_badan_sukan'];
        
        $model->status_permohonan_id = $model->status_permohonan;
        $ref = RefStatusBantuanPenganjuranKejohanan::findOne(['id' => $model->status_permohonan]);
        $model->status_permohonan = $ref['desc'];
        
        $model->selesai = GeneralLabel::getYesNoLabel($model->selesai);
        
        if($model->tarikh_mula != "") {$model->tarikh_mula = GeneralFunction::convert($model->tarikh_mula, GeneralFunction::TYPE_DATE);}
        if($model->tarikh_tamat != "") {$model->tarikh_tamat = GeneralFunction::convert($model->tarikh_tamat, GeneralFunction::TYPE_DATE);}
        if($model->tarikh_permohonan != "") {$model->tarikh_permohonan = GeneralFunction::convert($model->tarikh_permohonan, GeneralFunction::TYPE_DATETIME);}
        if($model->tarikh_jkb != "") {$model->tarikh_jkb = GeneralFunction::convert($model->tarikh_jkb, GeneralFunction::TYPE_DATE);}
        
        $queryPar = null;
        
        $queryPar['BantuanPenganjuranKejohananKewanganSearch']['bantuan_penganjuran_kejohanan_id'] = $id;
        $queryPar['BantuanPenganjuranKejohananBayaranSearch']['bantuan_penganjuran_kejohanan_id'] = $id;
        $queryPar['BantuanPenganjuranKejohananElemenSearch']['bantuan_penganjuran_kejohanan_id'] = $id;
        $queryPar['BantuanPenganjuranKejohananDianjurkanSearch']['bantuan_penganjuran_kejohanan_id'] = $id;
        $queryPar['BantuanPenganjuranKejohananOlehMsnSearch']['bantuan_penganjuran_kejohanan_id'] = $id;
        
        $searchModelBantuanPenganjuranKejohananKewangan  = new BantuanPenganjuranKejohananKewanganSearch();
        $dataProviderBantuanPenganjuranKejohananKewangan = $searchModelBantuanPenganjuranKejohananKewangan->search($queryPar);
        
        $searchModelBantuanPenganjuranKejohananBayaran  = new BantuanPenganjuranKejohananBayaranSearch();
        $dataProviderBantuanPenganjuranKejohananBayaran = $searchModelBantuanPenganjuranKejohananBayaran->search($queryPar);
        
        $searchModelBantuanPenganjuranKejohananElemen  = new BantuanPenganjuranKejohananElemenSearch();
        $dataProviderBantuanPenganjuranKejohananElemen = $searchModelBantuanPenganjuranKejohananElemen->search($queryPar);
        
        $searchModelBantuanPenganjuranKejohananDianjurkan = new BantuanPenganjuranKejohananDianjurkanSearch();
        $dataProviderBantuanPenganjuranKejohananDianjurkan = $searchModelBantuanPenganjuranKejohananDianjurkan->search($queryPar);
        
        $searchModelBantuanPenganjuranKejohananOlehMsn = new BantuanPenganjuranKejohananOlehMsnSearch();
        $dataProviderBantuanPenganjuranKejohananOlehMsn = $searchModelBantuanPenganjuranKejohananOlehMsn->search($queryPar);
        
        return $this->render('view', [
            'model' => $model,
            'searchModelBantuanPenganjuranKejohananKewangan' => $searchModelBantuanPenganjuranKejohananKewangan,
            'dataProviderBantuanPenganjuranKejohananKewangan' => $dataProviderBantuanPenganjuranKejohananKewangan,
            'searchModelBantuanPenganjuranKejohananBayaran' => $searchModelBantuanPenganjuranKejohananBayaran,
            'dataProviderBantuanPenganjuranKejohananBayaran' => $dataProviderBantuanPenganjuranKejohananBayaran,
            'searchModelBantuanPenganjuranKejohananElemen' => $searchModelBantuanPenganjuranKejohananElemen,
            'dataProviderBantuanPenganjuranKejohananElemen' => $dataProviderBantuanPenganjuranKejohananElemen,
            'searchModelBantuanPenganjuranKejohananDianjurkan' => $searchModelBantuanPenganjuranKejohananDianjurkan,
            'dataProviderBantuanPenganjuranKejohananDianjurkan' => $dataProviderBantuanPenganjuranKejohananDianjurkan,
            'searchModelBantuanPenganjuranKejohananOlehMsn' => $searchModelBantuanPenganjuranKejohananOlehMsn,
            'dataProviderBantuanPenganjuranKejohananOlehMsn' => $dataProviderBantuanPenganjuranKejohananOlehMsn,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new BantuanPenganjuranKejohanan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new BantuanPenganjuranKejohanan();
        
        if(Yii::$app->user->identity->profil_badan_sukan){
            $model->badan_sukan = Yii::$app->user->identity->profil_badan_sukan;
        }
        
        $queryPar = null;
        
        Yii::$app->session->open();
        
        if(isset(Yii::$app->session->id)){
            $queryPar['BantuanPenganjuranKejohananKewanganSearch']['session_id'] = Yii::$app->session->id;
            $queryPar['BantuanPenganjuranKejohananBayaranSearch']['session_id'] = Yii::$app->session->id;
            $queryPar['BantuanPenganjuranKejohananElemenSearch']['session_id'] = Yii::$app->session->id;
            $queryPar['BantuanPenganjuranKejohananDianjurkanSearch']['session_id'] = Yii::$app->session->id;
            $queryPar['BantuanPenganjuranKejohananOlehMsnSearch']['session_id'] = Yii::$app->session->id;
        }
        
        $searchModelBantuanPenganjuranKejohananKewangan  = new BantuanPenganjuranKejohananKewanganSearch();
        $dataProviderBantuanPenganjuranKejohananKewangan = $searchModelBantuanPenganjuranKejohananKewangan->search($queryPar);
        
        $searchModelBantuanPenganjuranKejohananBayaran  = new BantuanPenganjuranKejohananBayaranSearch();
        $dataProviderBantuanPenganjuranKejohananBayaran = $searchModelBantuanPenganjuranKejohananBayaran->search($queryPar);
        
        $searchModelBantuanPenganjuranKejohananElemen  = new BantuanPenganjuranKejohananElemenSearch();
        $dataProviderBantuanPenganjuranKejohananElemen = $searchModelBantuanPenganjuranKejohananElemen->search($queryPar);
        
        $searchModelBantuanPenganjuranKejohananDianjurkan = new BantuanPenganjuranKejohananDianjurkanSearch();
        $dataProviderBantuanPenganjuranKejohananDianjurkan = $searchModelBantuanPenganjuranKejohananDianjurkan->search($queryPar);
        
        $searchModelBantuanPenganjuranKejohananOlehMsn = new BantuanPenganjuranKejohananOlehMsnSearch();
        $dataProviderBantuanPenganjuranKejohananOlehMsn = $searchModelBantuanPenganjuranKejohananOlehMsn->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $file = UploadedFile::getInstance($model, 'kertas_kerja');
            $filename = $model->bantuan_penganjuran_kejohanan_id . "-kertas_kerja";
            if($file){
                $model->kertas_kerja = Upload::uploadFile($file, Upload::bantuanPenganjuranKejohananFolder, $filename);
            }
            
            $file = UploadedFile::getInstance($model, 'surat_rasmi_badan_sukan_ms_negeri');
            $filename = $model->bantuan_penganjuran_kejohanan_id . "-surat_rasmi_badan_sukan_ms_negeri";
            if($file){
                $model->surat_rasmi_badan_sukan_ms_negeri = Upload::uploadFile($file, Upload::bantuanPenganjuranKejohananFolder, $filename);
            }
            
            $file = UploadedFile::getInstance($model, 'permohonan_rasmi_dari_ahli_gabungan');
            $filename = $model->bantuan_penganjuran_kejohanan_id . "-permohonan_rasmi_dari_ahli_gabungan";
            if($file){
                $model->permohonan_rasmi_dari_ahli_gabungan = Upload::uploadFile($file, Upload::bantuanPenganjuranKejohananFolder, $filename);
            }
            
            $file = UploadedFile::getInstance($model, 'maklumat_lain_sokongan');
            $filename = $model->bantuan_penganjuran_kejohanan_id . "-maklumat_lain_sokongan";
            if($file){
                $model->maklumat_lain_sokongan = Upload::uploadFile($file, Upload::bantuanPenganjuranKejohananFolder, $filename);
            }
            
            $file = UploadedFile::getInstance($model, 'surat_kelulusan');
            $filename = $model->bantuan_penganjuran_kejohanan_id . "-surat_kelulusan";
            if($file){
                $model->surat_kelulusan = Upload::uploadFile($file, Upload::bantuanPenganjuranKejohananFolder, $filename);
            }
            
            if(isset(Yii::$app->session->id)){
                BantuanPenganjuranKejohananKewangan::updateAll(['bantuan_penganjuran_kejohanan_id' => $model->bantuan_penganjuran_kejohanan_id], 'session_id = "'.Yii::$app->session->id.'"');
                BantuanPenganjuranKejohananKewangan::updateAll(['session_id' => ''], 'bantuan_penganjuran_kejohanan_id = "'.$model->bantuan_penganjuran_kejohanan_id.'"');
                
                BantuanPenganjuranKejohananBayaran::updateAll(['bantuan_penganjuran_kejohanan_id' => $model->bantuan_penganjuran_kejohanan_id], 'session_id = "'.Yii::$app->session->id.'"');
                BantuanPenganjuranKejohananBayaran::updateAll(['session_id' => ''], 'bantuan_penganjuran_kejohanan_id = "'.$model->bantuan_penganjuran_kejohanan_id.'"');
                
                BantuanPenganjuranKejohananElemen::updateAll(['bantuan_penganjuran_kejohanan_id' => $model->bantuan_penganjuran_kejohanan_id], 'session_id = "'.Yii::$app->session->id.'"');
                BantuanPenganjuranKejohananElemen::updateAll(['session_id' => ''], 'bantuan_penganjuran_kejohanan_id = "'.$model->bantuan_penganjuran_kejohanan_id.'"');
                
                BantuanPenganjuranKejohananDianjurkan::updateAll(['bantuan_penganjuran_kejohanan_id' => $model->bantuan_penganjuran_kejohanan_id], 'session_id = "'.Yii::$app->session->id.'"');
                BantuanPenganjuranKejohananDianjurkan::updateAll(['session_id' => ''], 'bantuan_penganjuran_kejohanan_id = "'.$model->bantuan_penganjuran_kejohanan_id.'"');
                
                BantuanPenganjuranKejohananOlehMsn::updateAll(['bantuan_penganjuran_kejohanan_id' => $model->bantuan_penganjuran_kejohanan_id], 'session_id = "'.Yii::$app->session->id.'"');
                BantuanPenganjuranKejohananOlehMsn::updateAll(['session_id' => ''], 'bantuan_penganjuran_kejohanan_id = "'.$model->bantuan_penganjuran_kejohanan_id.'"');
            }
            
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->bantuan_penganjuran_kejohanan_id]);
            }
        } 
        
        return $this->render('create', [
                'model' => $model,
                'searchModelBantuanPenganjuranKejohananKewangan' => $searchModelBantuanPenganjuranKejohananKewangan,
                'dataProviderBantuanPenganjuranKejohananKewangan' => $dataProviderBantuanPenganjuranKejohananKewangan,
                'searchModelBantuanPenganjuranKejohananBayaran' => $searchModelBantuanPenganjuranKejohananBayaran,
                'dataProviderBantuanPenganjuranKejohananBayaran' => $dataProviderBantuanPenganjuranKejohananBayaran,
                'searchModelBantuanPenganjuranKejohananElemen' => $searchModelBantuanPenganjuranKejohananElemen,
                'dataProviderBantuanPenganjuranKejohananElemen' => $dataProviderBantuanPenganjuranKejohananElemen,
                'searchModelBantuanPenganjuranKejohananDianjurkan' => $searchModelBantuanPenganjuranKejohananDianjurkan,
                'dataProviderBantuanPenganjuranKejohananDianjurkan' => $dataProviderBantuanPenganjuranKejohananDianjurkan,
                'searchModelBantuanPenganjuranKejohananOlehMsn' => $searchModelBantuanPenganjuranKejohananOlehMsn,
                'dataProviderBantuanPenganjuranKejohananOlehMsn' => $dataProviderBantuanPenganjuranKejohananOlehMsn,
                'readonly' => false,
            ]);
    }

    /**
     * Updates an existing BantuanPenganjuranKejohanan model.
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
        $existingKertasKerja = $model->kertas_kerja;
        $existingSuratRasmiBadanSukanzMsNegeri = $model->surat_rasmi_badan_sukan_ms_negeri;
        $model->status_permohonan_id = $model->status_permohonan;
        
        if($model->load(Yii::$app->request->post())){
            $file = UploadedFile::getInstance($model, 'kertas_kerja');

            if($file){
                //valid file to upload
                //upload file to server
                
                // delete upload file
                /*if($existingKertasKerja != ""){
                    self::actionDeleteupload($id, 'kertas_kerja');
                }
                
                $filename = $model->bantuan_penganjuran_kejohanan_id . "-kertas_kerja";
                $model->kertas_kerja = Upload::uploadFile($file, Upload::bantuanPenganjuranKejohananFolder, $filename);*/
            } else {
                //invalid file to upload
                //remain existing file
                $model->kertas_kerja = $existingKertasKerja;
            }
            
            $file = UploadedFile::getInstance($model, 'surat_rasmi_badan_sukan_ms_negeri');

            if($file){
                //valid file to upload
                //upload file to server
                
                // delete upload file
                /*if($existingSuratRasmiBadanSukanzMsNegeri != ""){
                    self::actionDeleteupload($id, 'surat_rasmi_badan_sukan_ms_negeri');
                }
                
                $filename = $model->bantuan_penganjuran_kejohanan_id . "-surat_rasmi_badan_sukan_ms_negeri";
                $model->surat_rasmi_badan_sukan_ms_negeri = Upload::uploadFile($file, Upload::bantuanPenganjuranKejohananFolder, $filename);*/
            } else {
                //invalid file to upload
                //remain existing file
                $model->surat_rasmi_badan_sukan_ms_negeri = $existingSuratRasmiBadanSukanzMsNegeri;
            }
            
            /*$file = UploadedFile::getInstance($model, 'permohonan_rasmi_dari_ahli_gabungan');
            $filename = $model->bantuan_penganjuran_kejohanan_id . "-permohonan_rasmi_dari_ahli_gabungan";
            if($file){
                $model->permohonan_rasmi_dari_ahli_gabungan = Upload::uploadFile($file, Upload::bantuanPenganjuranKejohananFolder, $filename);
            }
            
            $file = UploadedFile::getInstance($model, 'maklumat_lain_sokongan');
            $filename = $model->bantuan_penganjuran_kejohanan_id . "-maklumat_lain_sokongan";
            if($file){
                $model->maklumat_lain_sokongan = Upload::uploadFile($file, Upload::bantuanPenganjuranKejohananFolder, $filename);
            }
            
            $file = UploadedFile::getInstance($model, 'surat_kelulusan');
            $filename = $model->bantuan_penganjuran_kejohanan_id . "-surat_kelulusan";
            if($file){
                $model->surat_kelulusan = Upload::uploadFile($file, Upload::bantuanPenganjuranKejohananFolder, $filename);
            }*/
        }
        
        $queryPar = null;
        
        $queryPar['BantuanPenganjuranKejohananKewanganSearch']['bantuan_penganjuran_kejohanan_id'] = $id;
        $queryPar['BantuanPenganjuranKejohananBayaranSearch']['bantuan_penganjuran_kejohanan_id'] = $id;
        $queryPar['BantuanPenganjuranKejohananElemenSearch']['bantuan_penganjuran_kejohanan_id'] = $id;
        $queryPar['BantuanPenganjuranKejohananDianjurkanSearch']['bantuan_penganjuran_kejohanan_id'] = $id;
        $queryPar['BantuanPenganjuranKejohananOlehMsnSearch']['bantuan_penganjuran_kejohanan_id'] = $id;
        
        $searchModelBantuanPenganjuranKejohananKewangan  = new BantuanPenganjuranKejohananKewanganSearch();
        $dataProviderBantuanPenganjuranKejohananKewangan = $searchModelBantuanPenganjuranKejohananKewangan->search($queryPar);
        
        $searchModelBantuanPenganjuranKejohananBayaran  = new BantuanPenganjuranKejohananBayaranSearch();
        $dataProviderBantuanPenganjuranKejohananBayaran = $searchModelBantuanPenganjuranKejohananBayaran->search($queryPar);
        
        $searchModelBantuanPenganjuranKejohananElemen  = new BantuanPenganjuranKejohananElemenSearch();
        $dataProviderBantuanPenganjuranKejohananElemen = $searchModelBantuanPenganjuranKejohananElemen->search($queryPar);
        
        $searchModelBantuanPenganjuranKejohananDianjurkan = new BantuanPenganjuranKejohananDianjurkanSearch();
        $dataProviderBantuanPenganjuranKejohananDianjurkan = $searchModelBantuanPenganjuranKejohananDianjurkan->search($queryPar);
        
        $searchModelBantuanPenganjuranKejohananOlehMsn = new BantuanPenganjuranKejohananOlehMsnSearch();
        $dataProviderBantuanPenganjuranKejohananOlehMsn = $searchModelBantuanPenganjuranKejohananOlehMsn->search($queryPar);

        if (Yii::$app->request->post() && $model->save()) {
            $file = UploadedFile::getInstance($model, 'kertas_kerja');
            $filename = $model->bantuan_penganjuran_kejohanan_id . "-kertas_kerja";
            if($file){
                $model->kertas_kerja = Upload::uploadFile($file, Upload::bantuanPenganjuranKejohananFolder, $filename);
            }
            
            $file = UploadedFile::getInstance($model, 'surat_rasmi_badan_sukan_ms_negeri');
            $filename = $model->bantuan_penganjuran_kejohanan_id . "-surat_rasmi_badan_sukan_ms_negeri";
            if($file){
                $model->surat_rasmi_badan_sukan_ms_negeri = Upload::uploadFile($file, Upload::bantuanPenganjuranKejohananFolder, $filename);
            }
            
            $file = UploadedFile::getInstance($model, 'permohonan_rasmi_dari_ahli_gabungan');
            $filename = $model->bantuan_penganjuran_kejohanan_id . "-permohonan_rasmi_dari_ahli_gabungan";
            if($file){
                $model->permohonan_rasmi_dari_ahli_gabungan = Upload::uploadFile($file, Upload::bantuanPenganjuranKejohananFolder, $filename);
            }
            
            $file = UploadedFile::getInstance($model, 'maklumat_lain_sokongan');
            $filename = $model->bantuan_penganjuran_kejohanan_id . "-maklumat_lain_sokongan";
            if($file){
                $model->maklumat_lain_sokongan = Upload::uploadFile($file, Upload::bantuanPenganjuranKejohananFolder, $filename);
            }
            
            $file = UploadedFile::getInstance($model, 'surat_kelulusan');
            $filename = $model->bantuan_penganjuran_kejohanan_id . "-surat_kelulusan";
            if($file){
                $model->surat_kelulusan = Upload::uploadFile($file, Upload::bantuanPenganjuranKejohananFolder, $filename);
            }
            
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->bantuan_penganjuran_kejohanan_id]);
            }
        } 
        
        return $this->render('update', [
                'model' => $model,
                'searchModelBantuanPenganjuranKejohananKewangan' => $searchModelBantuanPenganjuranKejohananKewangan,
                'dataProviderBantuanPenganjuranKejohananKewangan' => $dataProviderBantuanPenganjuranKejohananKewangan,
                'searchModelBantuanPenganjuranKejohananBayaran' => $searchModelBantuanPenganjuranKejohananBayaran,
                'dataProviderBantuanPenganjuranKejohananBayaran' => $dataProviderBantuanPenganjuranKejohananBayaran,
                'searchModelBantuanPenganjuranKejohananElemen' => $searchModelBantuanPenganjuranKejohananElemen,
                'dataProviderBantuanPenganjuranKejohananElemen' => $dataProviderBantuanPenganjuranKejohananElemen,
                'searchModelBantuanPenganjuranKejohananDianjurkan' => $searchModelBantuanPenganjuranKejohananDianjurkan,
                'dataProviderBantuanPenganjuranKejohananDianjurkan' => $dataProviderBantuanPenganjuranKejohananDianjurkan,
                'searchModelBantuanPenganjuranKejohananOlehMsn' => $searchModelBantuanPenganjuranKejohananOlehMsn,
                'dataProviderBantuanPenganjuranKejohananOlehMsn' => $dataProviderBantuanPenganjuranKejohananOlehMsn,
                'readonly' => false,
            ]);
    }

    /**
     * Deletes an existing BantuanPenganjuranKejohanan model.
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
        self::actionDeleteupload($id, 'kertas_kerja');
        
        self::actionDeleteupload($id, 'surat_rasmi_badan_sukan_ms_negeri');
        
        self::actionDeleteupload($id, 'permohonan_rasmi_dari_ahli_gabungan');
        
        self::actionDeleteupload($id, 'maklumat_lain_sokongan');
        
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
    
    /**
     * Updates an existing BantuanPenganjuranKejohanan model.
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
        $model->status_permohonan = RefStatusBantuanPenganjuranKejohanan::SEDANG_DIPROSES;
        $model->selesai = 0; // set approved
        
        $model->save();
        
        if (($modelUsers = User::find()->joinWith('refUserPeranan')->andFilterWhere(['like', 'tbl_user_peranan.peranan_akses', 'pemberitahuan_emel_bantuan-penganjuran-kejohanan'])->groupBy('id')->all()) !== null) {
                $refProfilBadanSukan = ProfilBadanSukan::findOne(['profil_badan_sukan' => $model->badan_sukan]);

                    foreach($modelUsers as $modelUser){

                        if($modelUser->email && $modelUser->email != ""){
                            //echo "E-mail: " . $modelUser->email . "\n";
                            Yii::$app->mailer->compose()
                            ->setTo($modelUser->email)
                            ->setFrom('noreply@spsb.com')
                            ->setSubject('Pemberitahuan - Permohonan Baru: Bantuan Penganjuran Kejohanan')
                            ->setHtmlBody('Assalamualaikum dan Salam Sejahtera, 
    <br><br>
    Terdapat permohonan baru yang diterima: 
    <br>Badan Sukan: ' . $refProfilBadanSukan['nama_badan_sukan'] . '
    <br>Nama Kejohanan / Pertandingan: ' . $model->nama_kejohanan_pertandingan . '
    <br>Tempat: ' . $model->tempat . '
    <br>Tarikh Mula: ' . $model->tarikh_mula . '
    <br>Tarikh Tamat: ' . $model->tarikh_tamat . '
    <br>Jumlah bantuan yang dipohon : RM  ' . $model->jumlah_bantuan_yang_dipohon . '
    <br><br>
    Link: ' . BaseUrl::to(['bantuan-penganjuran-kejohanan/view', 'id' => $model->bantuan_penganjuran_kejohanan_id], true) . '
    <br><br>
    Sekian.
    <br><br>
    "KE ARAH KECEMERLANGAN SUKAN"<br>
    Majlis Sukan Negara Malaysia.
        ')->send();
                        }
                    }
                }
        
        return $this->redirect(['view', 'id' => $model->bantuan_penganjuran_kejohanan_id]);
    }

    /**
     * Finds the BantuanPenganjuranKejohanan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return BantuanPenganjuranKejohanan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = BantuanPenganjuranKejohanan::findOne($id)) !== null) {
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
    
    public function actionLaporanStatistikBantuanPenganjuranKejohananMengikutBadanSukan()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new MsnLaporan();
        $model->format = 'html';

        if ($model->load(Yii::$app->request->post())) {
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-laporan-statistik-bantuan-penganjuran-kejohanan-mengikut-badan-sukan'
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-laporan-statistik-bantuan-penganjuran-kejohanan-mengikut-badan-sukan'
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'format' => $model->format
                ]);
            }
        } 

        return $this->render('laporan_statistik_bantuan_penganjuran_kejohanan_mengikut_badan_sukan', [
            'model' => $model,
            'readonly' => false,
        ]);
    }
    
    public function actionGenerateLaporanStatistikBantuanPenganjuranKejohananMengikutBadanSukan($tarikh_dari, $tarikh_hingga, $format)
    {
        if($tarikh_dari == "") $tarikh_dari = array();
        else $tarikh_dari = array($tarikh_dari);
        
        if($tarikh_hingga == "") $tarikh_hingga = array();
        else $tarikh_hingga = array($tarikh_hingga);
        
        $controls = array(
            'FROM_DATE' => $tarikh_dari,
            'TO_DATE' => $tarikh_hingga,
        );
        
        GeneralFunction::generateReport('/spsb/MSN/LaporanStatistikBantuanPenganjuranKejohananMengikutBadanSukan', $format, $controls, 'laporan_statistik_bantuan_penganjuran_kejohanan_mengikut_badan_sukan');
    }
    
    public function actionLaporanSenaraiBantuanGeranKejohanan()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new MsnLaporan();
        $model->format = 'html';

        if ($model->load(Yii::$app->request->post())) {
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-laporan-senarai-bantuan-geran-kejohanan'
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-laporan-senarai-bantuan-geran-kejohanan'
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'format' => $model->format
                ]);
            }
        } 

        return $this->render('laporan_senarai_bantuan_geran_kejohanan', [
            'model' => $model,
            'readonly' => false,
        ]);
    }
    
    public function actionGenerateLaporanSenaraiBantuanGeranKejohanan($tarikh_dari, $tarikh_hingga, $format)
    {
        if($tarikh_dari == "") $tarikh_dari = array();
        else $tarikh_dari = array($tarikh_dari);
        
        if($tarikh_hingga == "") $tarikh_hingga = array();
        else $tarikh_hingga = array($tarikh_hingga);
        
        $controls = array(
            'FROM_DATE' => $tarikh_dari,
            'TO_DATE' => $tarikh_hingga,
        );
        
        GeneralFunction::generateReport('/spsb/MSN/LaporanSenaraiBantuanGeranKejohanan', $format, $controls, 'laporan_senarai_bantuan_geran_kejohanan');
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
        
        $ref = RefPeringkatBantuanPenganjuranKejohanan::findOne(['id' => $model->peringkat]);
        $model->peringkat = $ref['desc'];
        
        $ref = ProfilBadanSukan::findOne(['profil_badan_sukan' => $model->badan_sukan]);
        $model->badan_sukan = $ref['nama_badan_sukan'];
        
        $model->status_permohonan_id = $model->status_permohonan;
        $ref = RefStatusBantuanPenganjuranKejohanan::findOne(['id' => $model->status_permohonan]);
        $model->status_permohonan = $ref['desc'];
		
		$BantuanPenganjuranKejohananKewangan = BantuanPenganjuranKejohananKewangan::find()->joinWith(['refSumberKewanganBantuanPenganjuranKejohanan'])->where(['bantuan_penganjuran_kejohanan_id' => $model->bantuan_penganjuran_kejohanan_id])->all();
		
		$BantuanPenganjuranKejohananBayaran = BantuanPenganjuranKejohananBayaran::find()->joinWith(['refJenisBayaranBantuanPenganjuranKejohanan'])->where(['bantuan_penganjuran_kejohanan_id' => $model->bantuan_penganjuran_kejohanan_id])->all();
		
		$BantuanPenganjuranKejohananElemen = BantuanPenganjuranKejohananElemen::find()->joinWith(['refElemenBantuanPenganjuranKejohanan'])
                ->joinWith(['refSubElemenBantuanPenganjuranKejohanan'])->where(['bantuan_penganjuran_kejohanan_id' => $model->bantuan_penganjuran_kejohanan_id])->all();
		
		$BantuanPenganjuranKejohananDianjurkan = BantuanPenganjuranKejohananDianjurkan::find()->where(['bantuan_penganjuran_kejohanan_id' => $model->bantuan_penganjuran_kejohanan_id])->all();
		
		$BantuanPenganjuranKejohananOlehMsn = BantuanPenganjuranKejohananOlehMsn::find()->where(['bantuan_penganjuran_kejohanan_id' => $model->bantuan_penganjuran_kejohanan_id])->all();

        $pdf = new \mPDF('utf-8', 'A4');

        $pdf->title = 'Bantuan Penganjuran Kejohanan';

        $stylesheet = file_get_contents('css/report.css');

        $pdf->WriteHTML($stylesheet,1);
        
        $pdf->WriteHTML($this->renderpartial('print', [
             'model'  => $model,
		     'title' => $pdf->title,
			 'BantuanPenganjuranKejohananKewangan' => $BantuanPenganjuranKejohananKewangan,
			 'BantuanPenganjuranKejohananBayaran' => $BantuanPenganjuranKejohananBayaran,
			 'BantuanPenganjuranKejohananElemen' => $BantuanPenganjuranKejohananElemen,
			 'BantuanPenganjuranKejohananDianjurkan' => $BantuanPenganjuranKejohananDianjurkan,
			 'BantuanPenganjuranKejohananOlehMsn' => $BantuanPenganjuranKejohananOlehMsn,
        ]));

        $pdf->Output(str_replace(' ', '_', $pdf->title).'_'.$model->bantuan_penganjuran_kejohanan_id.'.pdf', 'I');
    }
}
