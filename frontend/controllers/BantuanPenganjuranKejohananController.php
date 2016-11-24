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
            return $this->redirect($this->redirect(array(GeneralVariable::loginPagePath)));
        }
        
        $searchModel = new BantuanPenganjuranKejohananSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

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
        
        $ref = RefPeringkatBantuanPenganjuranKejohanan::findOne(['id' => $model->peringkat]);
        $model->peringkat = $ref['desc'];
        
        $ref = ProfilBadanSukan::findOne(['profil_badan_sukan' => $model->badan_sukan]);
        $model->badan_sukan = $ref['nama_badan_sukan'];
        
        $model->status_permohonan_id = $model->status_permohonan;
        $ref = RefStatusBantuanPenganjuranKejohanan::findOne(['id' => $model->status_permohonan]);
        $model->status_permohonan = $ref['desc'];
        
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
            return $this->redirect($this->redirect(array(GeneralVariable::loginPagePath)));
        }
        
        $model = new BantuanPenganjuranKejohanan();
        
        $model->tarikh_permohonan = GeneralFunction::getCurrentTimestamp();
        $model->status_permohonan = RefStatusBantuanPenganjuranKejohanan::SEDANG_DIPROSES;
        
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
                $model->kertas_kerja = Upload::uploadFile($file, Upload::bantuanPenganjuranKejohananFolder, $filename);
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
                $model->surat_rasmi_badan_sukan_ms_negeri = Upload::uploadFile($file, Upload::bantuanPenganjuranKejohananFolder, $filename);
            } else {
                //invalid file to upload
                //remain existing file
                $model->surat_rasmi_badan_sukan_ms_negeri = $existingSuratRasmiBadanSukanzMsNegeri;
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
            return $this->redirect(['view', 'id' => $model->bantuan_penganjuran_kejohanan_id]);
        } else {
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
}
