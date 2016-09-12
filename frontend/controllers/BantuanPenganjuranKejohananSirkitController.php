<?php

namespace frontend\controllers;

use Yii;
use app\models\BantuanPenganjuranKejohananSirkit;
use frontend\models\BantuanPenganjuranKejohananSirkitSearch;
use app\models\BantuanPenganjuranKejohananSirkitKewangan;
use frontend\models\BantuanPenganjuranKejohananSirkitKewanganSearch;
use app\models\BantuanPenganjuranKejohananSirkitBayaran;
use frontend\models\BantuanPenganjuranKejohananSirkitBayaranSearch;
use app\models\BantuanPenganjuranKejohananSirkitElemen;
use frontend\models\BantuanPenganjuranKejohananSirkitElemenSearch;
use app\models\BantuanPenganjuranKejohananSirkitDianjurkan;
use frontend\models\BantuanPenganjuranKejohananSirkitDianjurkanSearch;
use app\models\BantuanPenganjuranKejohananSirkitOlehMsn;
use frontend\models\BantuanPenganjuranKejohananSirkitOlehMsnSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

use app\models\general\Upload;
use app\models\general\GeneralVariable;
use common\models\general\GeneralFunction;

// table reference
use app\models\RefSukan;
use app\models\RefBandar;
use app\models\RefNegeri;
use app\models\RefBank;
use app\models\RefPeringkatBantuanPenganjuranKejohanan;
use app\models\ProfilBadanSukan;
use app\models\RefStatusBantuanPenganjuranKejohanan;

/**
 * BantuanPenganjuranKejohananSirkitController implements the CRUD actions for BantuanPenganjuranKejohananSirkit model.
 */
class BantuanPenganjuranKejohananSirkitController extends Controller
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
     * Lists all BantuanPenganjuranKejohananSirkit models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect($this->redirect(array(GeneralVariable::loginPagePath)));
        }
        
        $searchModel = new BantuanPenganjuranKejohananSirkitSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single BantuanPenganjuranKejohananSirkit model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect($this->redirect(array(GeneralVariable::loginPagePath)));
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
        
        $ref = RefNegeri::findOne(['id' => $model->negeri_penyertaan]);
        $model->negeri_penyertaan = $ref['desc'];
        
        $ref = RefPeringkatBantuanPenganjuranKejohanan::findOne(['id' => $model->peringkat]);
        $model->peringkat = $ref['desc'];
        
        $ref = ProfilBadanSukan::findOne(['profil_badan_sukan' => $model->badan_sukan]);
        $model->badan_sukan = $ref['nama_badan_sukan'];
        
        $model->status_permohonan_id = $model->status_permohonan;
        $ref = RefStatusBantuanPenganjuranKejohanan::findOne(['id' => $model->status_permohonan]);
        $model->status_permohonan = $ref['desc'];
        
        $queryPar = null;
        
        $queryPar['BantuanPenganjuranKejohananSirkitKewanganSearch']['bantuan_penganjuran_kejohanan_id'] = $id;
        $queryPar['BantuanPenganjuranKejohananSirkitBayaranSearch']['bantuan_penganjuran_kejohanan_id'] = $id;
        $queryPar['BantuanPenganjuranKejohananSirkitElemenSearch']['bantuan_penganjuran_kejohanan_id'] = $id;
        $queryPar['BantuanPenganjuranKejohananSirkitDianjurkanSearch']['bantuan_penganjuran_kejohanan_id'] = $id;
        $queryPar['BantuanPenganjuranKejohananSirkitOlehMsnSearch']['bantuan_penganjuran_kejohanan_id'] = $id;
        
        $searchModelBantuanPenganjuranKejohananSirkitKewangan  = new BantuanPenganjuranKejohananSirkitKewanganSearch();
        $dataProviderBantuanPenganjuranKejohananSirkitKewangan = $searchModelBantuanPenganjuranKejohananSirkitKewangan->search($queryPar);
        
        $searchModelBantuanPenganjuranKejohananSirkitBayaran  = new BantuanPenganjuranKejohananSirkitBayaranSearch();
        $dataProviderBantuanPenganjuranKejohananSirkitBayaran = $searchModelBantuanPenganjuranKejohananSirkitBayaran->search($queryPar);
        
        $searchModelBantuanPenganjuranKejohananSirkitElemen  = new BantuanPenganjuranKejohananSirkitElemenSearch();
        $dataProviderBantuanPenganjuranKejohananSirkitElemen = $searchModelBantuanPenganjuranKejohananSirkitElemen->search($queryPar);
        
        $searchModelBantuanPenganjuranKejohananSirkitDianjurkan = new BantuanPenganjuranKejohananSirkitDianjurkanSearch();
        $dataProviderBantuanPenganjuranKejohananSirkitDianjurkan = $searchModelBantuanPenganjuranKejohananSirkitDianjurkan->search($queryPar);
        
        $searchModelBantuanPenganjuranKejohananSirkitOlehMsn = new BantuanPenganjuranKejohananSirkitOlehMsnSearch();
        $dataProviderBantuanPenganjuranKejohananSirkitOlehMsn = $searchModelBantuanPenganjuranKejohananSirkitOlehMsn->search($queryPar);
        
        return $this->render('view', [
            'model' => $model,
            'searchModelBantuanPenganjuranKejohananSirkitKewangan' => $searchModelBantuanPenganjuranKejohananSirkitKewangan,
            'dataProviderBantuanPenganjuranKejohananSirkitKewangan' => $dataProviderBantuanPenganjuranKejohananSirkitKewangan,
            'searchModelBantuanPenganjuranKejohananSirkitBayaran' => $searchModelBantuanPenganjuranKejohananSirkitBayaran,
            'dataProviderBantuanPenganjuranKejohananSirkitBayaran' => $dataProviderBantuanPenganjuranKejohananSirkitBayaran,
            'searchModelBantuanPenganjuranKejohananSirkitElemen' => $searchModelBantuanPenganjuranKejohananSirkitElemen,
            'dataProviderBantuanPenganjuranKejohananSirkitElemen' => $dataProviderBantuanPenganjuranKejohananSirkitElemen,
            'searchModelBantuanPenganjuranKejohananSirkitDianjurkan' => $searchModelBantuanPenganjuranKejohananSirkitDianjurkan,
            'dataProviderBantuanPenganjuranKejohananSirkitDianjurkan' => $dataProviderBantuanPenganjuranKejohananSirkitDianjurkan,
            'searchModelBantuanPenganjuranKejohananSirkitOlehMsn' => $searchModelBantuanPenganjuranKejohananSirkitOlehMsn,
            'dataProviderBantuanPenganjuranKejohananSirkitOlehMsn' => $dataProviderBantuanPenganjuranKejohananSirkitOlehMsn,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new BantuanPenganjuranKejohananSirkit model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect($this->redirect(array(GeneralVariable::loginPagePath)));
        }
        
        $model = new BantuanPenganjuranKejohananSirkit();
        
        $model->tarikh_permohonan = GeneralFunction::getCurrentTimestamp();
        $model->status_permohonan = RefStatusBantuanPenganjuranKejohanan::SEDANG_DIPROSES;
        
        $queryPar = null;
        
        Yii::$app->session->open();
        
        if(isset(Yii::$app->session->id)){
            $queryPar['BantuanPenganjuranKejohananSirkitKewanganSearch']['session_id'] = Yii::$app->session->id;
            $queryPar['BantuanPenganjuranKejohananSirkitBayaranSearch']['session_id'] = Yii::$app->session->id;
            $queryPar['BantuanPenganjuranKejohananSirkitElemenSearch']['session_id'] = Yii::$app->session->id;
            $queryPar['BantuanPenganjuranKejohananSirkitDianjurkanSearch']['session_id'] = Yii::$app->session->id;
            $queryPar['BantuanPenganjuranKejohananSirkitOlehMsnSearch']['session_id'] = Yii::$app->session->id;
        }
        
        $searchModelBantuanPenganjuranKejohananSirkitKewangan  = new BantuanPenganjuranKejohananSirkitKewanganSearch();
        $dataProviderBantuanPenganjuranKejohananSirkitKewangan = $searchModelBantuanPenganjuranKejohananSirkitKewangan->search($queryPar);
        
        $searchModelBantuanPenganjuranKejohananSirkitBayaran  = new BantuanPenganjuranKejohananSirkitBayaranSearch();
        $dataProviderBantuanPenganjuranKejohananSirkitBayaran = $searchModelBantuanPenganjuranKejohananSirkitBayaran->search($queryPar);
        
        $searchModelBantuanPenganjuranKejohananSirkitElemen  = new BantuanPenganjuranKejohananSirkitElemenSearch();
        $dataProviderBantuanPenganjuranKejohananSirkitElemen = $searchModelBantuanPenganjuranKejohananSirkitElemen->search($queryPar);
        
        $searchModelBantuanPenganjuranKejohananSirkitDianjurkan = new BantuanPenganjuranKejohananSirkitDianjurkanSearch();
        $dataProviderBantuanPenganjuranKejohananSirkitDianjurkan = $searchModelBantuanPenganjuranKejohananSirkitDianjurkan->search($queryPar);
        
        $searchModelBantuanPenganjuranKejohananSirkitOlehMsn = new BantuanPenganjuranKejohananSirkitOlehMsnSearch();
        $dataProviderBantuanPenganjuranKejohananSirkitOlehMsn = $searchModelBantuanPenganjuranKejohananSirkitOlehMsn->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $file = UploadedFile::getInstance($model, 'kertas_kerja');
            $filename = $model->bantuan_penganjuran_kejohanan_id . "-kertas_kerja";
            if($file){
                $model->kertas_kerja = Upload::uploadFile($file, Upload::bantuanPenganjuranKejohananSirkitFolder, $filename);
            }
            
            $file = UploadedFile::getInstance($model, 'surat_rasmi_badan_sukan_ms_negeri');
            $filename = $model->bantuan_penganjuran_kejohanan_id . "-surat_rasmi_badan_sukan_ms_negeri";
            if($file){
                $model->surat_rasmi_badan_sukan_ms_negeri = Upload::uploadFile($file, Upload::bantuanPenganjuranKejohananSirkitFolder, $filename);
            }
            
            $file = UploadedFile::getInstance($model, 'permohonan_rasmi_dari_ahli_gabungan');
            $filename = $model->bantuan_penganjuran_kejohanan_id . "-permohonan_rasmi_dari_ahli_gabungan";
            if($file){
                $model->permohonan_rasmi_dari_ahli_gabungan = Upload::uploadFile($file, Upload::bantuanPenganjuranKejohananSirkitFolder, $filename);
            }
            
            $file = UploadedFile::getInstance($model, 'maklumat_lain_sokongan');
            $filename = $model->bantuan_penganjuran_kejohanan_id . "-maklumat_lain_sokongan";
            if($file){
                $model->maklumat_lain_sokongan = Upload::uploadFile($file, Upload::bantuanPenganjuranKejohananSirkitFolder, $filename);
            }
            
            if(isset(Yii::$app->session->id)){
                BantuanPenganjuranKejohananSirkitKewangan::updateAll(['bantuan_penganjuran_kejohanan_id' => $model->bantuan_penganjuran_kejohanan_id], 'session_id = "'.Yii::$app->session->id.'"');
                BantuanPenganjuranKejohananSirkitKewangan::updateAll(['session_id' => ''], 'bantuan_penganjuran_kejohanan_id = "'.$model->bantuan_penganjuran_kejohanan_id.'"');
                
                BantuanPenganjuranKejohananSirkitBayaran::updateAll(['bantuan_penganjuran_kejohanan_id' => $model->bantuan_penganjuran_kejohanan_id], 'session_id = "'.Yii::$app->session->id.'"');
                BantuanPenganjuranKejohananSirkitBayaran::updateAll(['session_id' => ''], 'bantuan_penganjuran_kejohanan_id = "'.$model->bantuan_penganjuran_kejohanan_id.'"');
                
                BantuanPenganjuranKejohananSirkitElemen::updateAll(['bantuan_penganjuran_kejohanan_id' => $model->bantuan_penganjuran_kejohanan_id], 'session_id = "'.Yii::$app->session->id.'"');
                BantuanPenganjuranKejohananSirkitElemen::updateAll(['session_id' => ''], 'bantuan_penganjuran_kejohanan_id = "'.$model->bantuan_penganjuran_kejohanan_id.'"');
                
                BantuanPenganjuranKejohananSirkitDianjurkan::updateAll(['bantuan_penganjuran_kejohanan_id' => $model->bantuan_penganjuran_kejohanan_id], 'session_id = "'.Yii::$app->session->id.'"');
                BantuanPenganjuranKejohananSirkitDianjurkan::updateAll(['session_id' => ''], 'bantuan_penganjuran_kejohanan_id = "'.$model->bantuan_penganjuran_kejohanan_id.'"');
                
                BantuanPenganjuranKejohananSirkitOlehMsn::updateAll(['bantuan_penganjuran_kejohanan_id' => $model->bantuan_penganjuran_kejohanan_id], 'session_id = "'.Yii::$app->session->id.'"');
                BantuanPenganjuranKejohananSirkitOlehMsn::updateAll(['session_id' => ''], 'bantuan_penganjuran_kejohanan_id = "'.$model->bantuan_penganjuran_kejohanan_id.'"');
            }
            
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->bantuan_penganjuran_kejohanan_id]);
            }
        } 
        
        return $this->render('create', [
                'model' => $model,
                'searchModelBantuanPenganjuranKejohananSirkitKewangan' => $searchModelBantuanPenganjuranKejohananSirkitKewangan,
                'dataProviderBantuanPenganjuranKejohananSirkitKewangan' => $dataProviderBantuanPenganjuranKejohananSirkitKewangan,
                'searchModelBantuanPenganjuranKejohananSirkitBayaran' => $searchModelBantuanPenganjuranKejohananSirkitBayaran,
                'dataProviderBantuanPenganjuranKejohananSirkitBayaran' => $dataProviderBantuanPenganjuranKejohananSirkitBayaran,
                'searchModelBantuanPenganjuranKejohananSirkitElemen' => $searchModelBantuanPenganjuranKejohananSirkitElemen,
                'dataProviderBantuanPenganjuranKejohananSirkitElemen' => $dataProviderBantuanPenganjuranKejohananSirkitElemen,
                'searchModelBantuanPenganjuranKejohananSirkitDianjurkan' => $searchModelBantuanPenganjuranKejohananSirkitDianjurkan,
                'dataProviderBantuanPenganjuranKejohananSirkitDianjurkan' => $dataProviderBantuanPenganjuranKejohananSirkitDianjurkan,
                'searchModelBantuanPenganjuranKejohananSirkitOlehMsn' => $searchModelBantuanPenganjuranKejohananSirkitOlehMsn,
                'dataProviderBantuanPenganjuranKejohananSirkitOlehMsn' => $dataProviderBantuanPenganjuranKejohananSirkitOlehMsn,
                'readonly' => false,
            ]);
    }

    /**
     * Updates an existing BantuanPenganjuranKejohananSirkit model.
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
        $existingKertasKerja = $model->kertas_kerja;
        $existingSuratRasmiBadanSukanzMsNegeri = $model->surat_rasmi_badan_sukan_ms_negeri;
        $model->status_permohonan_id = $model->status_permohonan;
        
        if($model->load(Yii::$app->request->post())){
            $file = UploadedFile::getInstance($model, 'kertas_kerja');

            if($file){
                //valid file to upload
                //upload file to server
                
                // delete upload file
                if($existingKertasKerja != ""){
                    self::actionDeleteupload($id, 'kertas_kerja');
                }
                
                $filename = $model->bantuan_penganjuran_kejohanan_id . "-kertas_kerja";
                $model->kertas_kerja = Upload::uploadFile($file, Upload::bantuanPenganjuranKejohananSirkitFolder, $filename);
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
                if($existingSuratRasmiBadanSukanzMsNegeri != ""){
                    self::actionDeleteupload($id, 'surat_rasmi_badan_sukan_ms_negeri');
                }
                
                $filename = $model->bantuan_penganjuran_kejohanan_id . "-surat_rasmi_badan_sukan_ms_negeri";
                $model->surat_rasmi_badan_sukan_ms_negeri = Upload::uploadFile($file, Upload::bantuanPenganjuranKejohananSirkitFolder, $filename);
            } else {
                //invalid file to upload
                //remain existing file
                $model->surat_rasmi_badan_sukan_ms_negeri = $existingSuratRasmiBadanSukanzMsNegeri;
            }
            
            $file = UploadedFile::getInstance($model, 'permohonan_rasmi_dari_ahli_gabungan');
            $filename = $model->bantuan_penganjuran_kejohanan_id . "-permohonan_rasmi_dari_ahli_gabungan";
            if($file){
                $model->permohonan_rasmi_dari_ahli_gabungan = Upload::uploadFile($file, Upload::bantuanPenganjuranKejohananSirkitFolder, $filename);
            }
            
            $file = UploadedFile::getInstance($model, 'maklumat_lain_sokongan');
            $filename = $model->bantuan_penganjuran_kejohanan_id . "-maklumat_lain_sokongan";
            if($file){
                $model->maklumat_lain_sokongan = Upload::uploadFile($file, Upload::bantuanPenganjuranKejohananSirkitFolder, $filename);
            }
        }
        
        $queryPar = null;
        
        $queryPar['BantuanPenganjuranKejohananSirkitKewanganSearch']['bantuan_penganjuran_kejohanan_id'] = $id;
        $queryPar['BantuanPenganjuranKejohananSirkitBayaranSearch']['bantuan_penganjuran_kejohanan_id'] = $id;
        $queryPar['BantuanPenganjuranKejohananSirkitElemenSearch']['bantuan_penganjuran_kejohanan_id'] = $id;
        $queryPar['BantuanPenganjuranKejohananSirkitDianjurkanSearch']['bantuan_penganjuran_kejohanan_id'] = $id;
        $queryPar['BantuanPenganjuranKejohananSirkitOlehMsnSearch']['bantuan_penganjuran_kejohanan_id'] = $id;
        
        $searchModelBantuanPenganjuranKejohananSirkitKewangan  = new BantuanPenganjuranKejohananSirkitKewanganSearch();
        $dataProviderBantuanPenganjuranKejohananSirkitKewangan = $searchModelBantuanPenganjuranKejohananSirkitKewangan->search($queryPar);
        
        $searchModelBantuanPenganjuranKejohananSirkitBayaran  = new BantuanPenganjuranKejohananSirkitBayaranSearch();
        $dataProviderBantuanPenganjuranKejohananSirkitBayaran = $searchModelBantuanPenganjuranKejohananSirkitBayaran->search($queryPar);
        
        $searchModelBantuanPenganjuranKejohananSirkitElemen  = new BantuanPenganjuranKejohananSirkitElemenSearch();
        $dataProviderBantuanPenganjuranKejohananSirkitElemen = $searchModelBantuanPenganjuranKejohananSirkitElemen->search($queryPar);
        
        $searchModelBantuanPenganjuranKejohananSirkitDianjurkan = new BantuanPenganjuranKejohananSirkitDianjurkanSearch();
        $dataProviderBantuanPenganjuranKejohananSirkitDianjurkan = $searchModelBantuanPenganjuranKejohananSirkitDianjurkan->search($queryPar);
        
        $searchModelBantuanPenganjuranKejohananSirkitOlehMsn = new BantuanPenganjuranKejohananSirkitOlehMsnSearch();
        $dataProviderBantuanPenganjuranKejohananSirkitOlehMsn = $searchModelBantuanPenganjuranKejohananSirkitOlehMsn->search($queryPar);

        if (Yii::$app->request->post() && $model->save()) {
            return $this->redirect(['view', 'id' => $model->bantuan_penganjuran_kejohanan_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'searchModelBantuanPenganjuranKejohananSirkitKewangan' => $searchModelBantuanPenganjuranKejohananSirkitKewangan,
                'dataProviderBantuanPenganjuranKejohananSirkitKewangan' => $dataProviderBantuanPenganjuranKejohananSirkitKewangan,
                'searchModelBantuanPenganjuranKejohananSirkitBayaran' => $searchModelBantuanPenganjuranKejohananSirkitBayaran,
                'dataProviderBantuanPenganjuranKejohananSirkitBayaran' => $dataProviderBantuanPenganjuranKejohananSirkitBayaran,
                'searchModelBantuanPenganjuranKejohananSirkitElemen' => $searchModelBantuanPenganjuranKejohananSirkitElemen,
                'dataProviderBantuanPenganjuranKejohananSirkitElemen' => $dataProviderBantuanPenganjuranKejohananSirkitElemen,
                'searchModelBantuanPenganjuranKejohananSirkitDianjurkan' => $searchModelBantuanPenganjuranKejohananSirkitDianjurkan,
                'dataProviderBantuanPenganjuranKejohananSirkitDianjurkan' => $dataProviderBantuanPenganjuranKejohananSirkitDianjurkan,
                'searchModelBantuanPenganjuranKejohananSirkitOlehMsn' => $searchModelBantuanPenganjuranKejohananSirkitOlehMsn,
                'dataProviderBantuanPenganjuranKejohananSirkitOlehMsn' => $dataProviderBantuanPenganjuranKejohananSirkitOlehMsn,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Deletes an existing BantuanPenganjuranKejohananSirkit model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect($this->redirect(array(GeneralVariable::loginPagePath)));
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
     * Finds the BantuanPenganjuranKejohananSirkit model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return BantuanPenganjuranKejohananSirkit the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = BantuanPenganjuranKejohananSirkit::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    // Add function for delete image or file
    public function actionDeleteupload($id, $field)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect($this->redirect(array(GeneralVariable::loginPagePath)));
        }
        
            $img = $this->findModel($id)->$field;
            
            if($img){
                if (!unlink($img)) {
                    return false;
                }
            }

            $img = $this->findModel($id);
            $img->$field = NULL;
            $img->update();

            return $this->redirect(['update', 'id' => $id]);
    }
}
