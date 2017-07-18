<?php

namespace frontend\controllers;

use Yii;
use app\models\BantuanPenganjuranKursus;
use frontend\models\BantuanPenganjuranKursusSearch;
use app\models\BantuanPenganjuranKursusPenceramah;
use frontend\models\BantuanPenganjuranKursusPenceramahSearch;
use app\models\BantuanPenganjuranKursusDisertaiPenceramah;
use frontend\models\BantuanPenganjuranKursusDisertaiPenceramahSearch;
use app\models\BantuanPenganjuranKursusOlehMsn;
use frontend\models\BantuanPenganjuranKursusOlehMsnSearch;
use app\models\BantuanPenganjuranKursusElemen;
use frontend\models\BantuanPenganjuranKursusElemenSearch;
use app\models\MsnLaporanBantuanTeknikalDanKepegawaian;
use app\models\MsnLaporanBantuanTeknikalDanKepegawaianMengikutSukan;
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
use app\models\RefStatusBantuanPenganjuranKursus;

use common\models\User;

/**
 * BantuanPenganjuranKursusController implements the CRUD actions for BantuanPenganjuranKursus model.
 */
class BantuanPenganjuranKursusController extends Controller
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
     * Lists all BantuanPenganjuranKursus models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $queryParams = Yii::$app->request->queryParams;
        
        if(isset(Yii::$app->user->identity->peranan_akses['MSN']['bantuan-penganjuran-kursus']['data-sendiri'])){
            $queryParams['BantuanPenganjuranKursusSearch']['created_by'] = Yii::$app->user->identity->id;
        }
        
        if(isset(Yii::$app->user->identity->peranan_akses['MSN']['bantuan-penganjuran-kursus']['kelulusan'])) {
            $queryParams['BantuanPenganjuranKursusSearch']['hantar_flag'] = 1;
        }
        
        $searchModel = new BantuanPenganjuranKursusSearch();
        $dataProvider = $searchModel->search($queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single BantuanPenganjuranKursus model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $queryPar = null;
        
        $queryPar['BantuanPenganjuranKursusPenceramahSearch']['bantuan_penganjuran_kursus_id'] = $id;
        $queryPar['BantuanPenganjuranKursusDisertaiPenceramahSearch']['bantuan_penganjuran_kursus_id'] = $id;
        $queryPar['BantuanPenganjuranKursusOlehMsnSearch']['bantuan_penganjuran_kursus_id'] = $id;
        $queryPar['BantuanPenganjuranKursusElemenSearch']['bantuan_penganjuran_kursus_id'] = $id;
        
        $searchModelBantuanPenganjuranKursusPenceramah  = new BantuanPenganjuranKursusPenceramahSearch();
        $dataProviderBantuanPenganjuranKursusPenceramah = $searchModelBantuanPenganjuranKursusPenceramah->search($queryPar);
        
        $searchModelBantuanPenganjuranKursusDisertaiPenceramah  = new BantuanPenganjuranKursusDisertaiPenceramahSearch();
        $dataProviderBantuanPenganjuranKursusDisertaiPenceramah = $searchModelBantuanPenganjuranKursusDisertaiPenceramah->search($queryPar);
        
        $searchModelBantuanPenganjuranKursusOlehMsn  = new BantuanPenganjuranKursusOlehMsnSearch();
        $dataProviderBantuanPenganjuranKursusOlehMsn = $searchModelBantuanPenganjuranKursusOlehMsn->search($queryPar);
        
        $searchModelBantuanPenganjuranKursusElemen  = new BantuanPenganjuranKursusElemenSearch();
        $dataProviderBantuanPenganjuranKursusElemen = $searchModelBantuanPenganjuranKursusElemen->search($queryPar);
        
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
        $ref = RefStatusBantuanPenganjuranKursus::findOne(['id' => $model->status_permohonan]);
        $model->status_permohonan = $ref['desc'];
        
        if($model->tarikh != "") {$model->tarikh = GeneralFunction::convert($model->tarikh, GeneralFunction::TYPE_DATE);}
        if($model->tarikh_tamat != "") {$model->tarikh_tamat = GeneralFunction::convert($model->tarikh_tamat, GeneralFunction::TYPE_DATE);}
        if($model->tarikh_permohonan != "") {$model->tarikh_permohonan = GeneralFunction::convert($model->tarikh_permohonan, GeneralFunction::TYPE_DATETIME);}
        if($model->tarikh_jkb != "") {$model->tarikh_jkb = GeneralFunction::convert($model->tarikh_jkb, GeneralFunction::TYPE_DATE);}
        
        return $this->render('view', [
            'model' => $model,
            'searchModelBantuanPenganjuranKursusPenceramah' => $searchModelBantuanPenganjuranKursusPenceramah,
            'dataProviderBantuanPenganjuranKursusPenceramah' => $dataProviderBantuanPenganjuranKursusPenceramah,
            'searchModelBantuanPenganjuranKursusDisertaiPenceramah' => $searchModelBantuanPenganjuranKursusDisertaiPenceramah,
            'dataProviderBantuanPenganjuranKursusDisertaiPenceramah' => $dataProviderBantuanPenganjuranKursusDisertaiPenceramah,
            'searchModelBantuanPenganjuranKursusOlehMsn' => $searchModelBantuanPenganjuranKursusOlehMsn,
            'dataProviderBantuanPenganjuranKursusOlehMsn' => $dataProviderBantuanPenganjuranKursusOlehMsn,
            'searchModelBantuanPenganjuranKursusElemen' => $searchModelBantuanPenganjuranKursusElemen,
            'dataProviderBantuanPenganjuranKursusElemen' => $dataProviderBantuanPenganjuranKursusElemen,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new BantuanPenganjuranKursus model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new BantuanPenganjuranKursus();
        
        $model->scenario = 'create';
        
        if(Yii::$app->user->identity->profil_badan_sukan){
            $model->badan_sukan = Yii::$app->user->identity->profil_badan_sukan;
        }
        
        $queryPar = null;
        
        Yii::$app->session->open();
        
        if(isset(Yii::$app->session->id)){
            $queryPar['BantuanPenganjuranKursusPenceramahSearch']['session_id'] = Yii::$app->session->id;
            $queryPar['BantuanPenganjuranKursusDisertaiPenceramahSearch']['session_id'] = Yii::$app->session->id;
            $queryPar['BantuanPenganjuranKursusOlehMsnSearch']['session_id'] = Yii::$app->session->id;
            $queryPar['BantuanPenganjuranKursusElemenSearch']['session_id'] = Yii::$app->session->id;
        }
        
        $searchModelBantuanPenganjuranKursusPenceramah  = new BantuanPenganjuranKursusPenceramahSearch();
        $dataProviderBantuanPenganjuranKursusPenceramah = $searchModelBantuanPenganjuranKursusPenceramah->search($queryPar);
        
        $searchModelBantuanPenganjuranKursusDisertaiPenceramah  = new BantuanPenganjuranKursusDisertaiPenceramahSearch();
        $dataProviderBantuanPenganjuranKursusDisertaiPenceramah = $searchModelBantuanPenganjuranKursusDisertaiPenceramah->search($queryPar);
        
        $searchModelBantuanPenganjuranKursusOlehMsn  = new BantuanPenganjuranKursusOlehMsnSearch();
        $dataProviderBantuanPenganjuranKursusOlehMsn = $searchModelBantuanPenganjuranKursusOlehMsn->search($queryPar);
        
        $searchModelBantuanPenganjuranKursusElemen  = new BantuanPenganjuranKursusElemenSearch();
        $dataProviderBantuanPenganjuranKursusElemen = $searchModelBantuanPenganjuranKursusElemen->search($queryPar);
        

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if(isset(Yii::$app->session->id)){
                BantuanPenganjuranKursusPenceramah::updateAll(['bantuan_penganjuran_kursus_id' => $model->bantuan_penganjuran_kursus_id], 'session_id = "'.Yii::$app->session->id.'"');
                BantuanPenganjuranKursusPenceramah::updateAll(['session_id' => ''], 'bantuan_penganjuran_kursus_id = "'.$model->bantuan_penganjuran_kursus_id.'"');
                
                BantuanPenganjuranKursusDisertaiPenceramah::updateAll(['bantuan_penganjuran_kursus_id' => $model->bantuan_penganjuran_kursus_id], 'session_id = "'.Yii::$app->session->id.'"');
                BantuanPenganjuranKursusDisertaiPenceramah::updateAll(['session_id' => ''], 'bantuan_penganjuran_kursus_id = "'.$model->bantuan_penganjuran_kursus_id.'"');
                
                BantuanPenganjuranKursusOlehMsn::updateAll(['bantuan_penganjuran_kursus_id' => $model->bantuan_penganjuran_kursus_id], 'session_id = "'.Yii::$app->session->id.'"');
                BantuanPenganjuranKursusOlehMsn::updateAll(['session_id' => ''], 'bantuan_penganjuran_kursus_id = "'.$model->bantuan_penganjuran_kursus_id.'"');
                
                BantuanPenganjuranKursusElemen::updateAll(['bantuan_penganjuran_kursus_id' => $model->bantuan_penganjuran_kursus_id], 'session_id = "'.Yii::$app->session->id.'"');
                BantuanPenganjuranKursusElemen::updateAll(['session_id' => ''], 'bantuan_penganjuran_kursus_id = "'.$model->bantuan_penganjuran_kursus_id.'"');
            }
            
            $file = UploadedFile::getInstance($model, 'kertas_kerja');
            $filename = $model->bantuan_penganjuran_kursus_id . "-kertas_kerja";
            if($file){
                $model->kertas_kerja = Upload::uploadFile($file, Upload::bantuanPenganjuranKursusFolder, $filename);
            }
            
            $file = UploadedFile::getInstance($model, 'surat_rasmi_badan_sukan_ms_negeri');
            $filename = $model->bantuan_penganjuran_kursus_id . "-surat_rasmi_badan_sukan_ms_negeri";
            if($file){
                $model->surat_rasmi_badan_sukan_ms_negeri = Upload::uploadFile($file, Upload::bantuanPenganjuranKursusFolder, $filename);
            }
            
            $file = UploadedFile::getInstance($model, 'butiran_perbelanjaan');
            $filename = $model->bantuan_penganjuran_kursus_id . "-butiran_perbelanjaan";
            if($file){
                $model->butiran_perbelanjaan = Upload::uploadFile($file, Upload::bantuanPenganjuranKursusFolder, $filename);
            }
            
            $file = UploadedFile::getInstance($model, 'maklumat_lain_sokongan');
            $filename = $model->bantuan_penganjuran_kursus_id . "-maklumat_lain_sokongan";
            if($file){
                $model->maklumat_lain_sokongan = Upload::uploadFile($file, Upload::bantuanPenganjuranKursusFolder, $filename);
            }
            
            $file = UploadedFile::getInstance($model, 'surat_kelulusan');
            $filename = $model->bantuan_penganjuran_kursus_id . "-surat_kelulusan";
            if($file){
                $model->surat_kelulusan = Upload::uploadFile($file, Upload::bantuanPenganjuranKursusFolder, $filename);
            }
            
            if($model->save()){
                if (($modelUsers = User::find()->joinWith('refUserPeranan')->andFilterWhere(['like', 'tbl_user_peranan.peranan_akses', 'pemberitahuan_emel_bantuan-penganjuran-kursus'])->groupBy('id')->all()) !== null) {
                    $refProfilBadanSukan = ProfilBadanSukan::findOne(['profil_badan_sukan' => $model->badan_sukan]);
                    foreach($modelUsers as $modelUser){

                        if($modelUser->email && $modelUser->email != ""){
                            //echo "E-mail: " . $modelUser->email . "\n";
                            Yii::$app->mailer->compose()
                            ->setTo($modelUser->email)
                            ->setFrom('noreply@spsb.com')
                            ->setSubject('Pemberitahuan - Permohonan Baru: Bantuan Penganjuran Kursus / Bengkel / Seminar')
                            ->setHtmlBody("Assalamualaikum dan Salam Sejahtera, 
    <br><br>
    Terdapat permohonan baru yang diterima: 
    <br>
    Badan Sukan: " . $refProfilBadanSukan['nama_badan_sukan'] . "
    <br>Nama Kursus / Seminar / Bengkel: " . $model->nama_kursus_seminar_bengkel . '
    <br>Tempat: ' . $model->tempat . '
    <br>Tarikh Mula: ' . $model->tarikh . '
    <br>Tarikh Tamat: ' . $model->tarikh_tamat . '
    <br>Jumlah Bantuan Yang Dipohon: RM' . $model->jumlah_bantuan_yang_dipohon . '
    <br><br>
    Link: ' . BaseUrl::to(['bantuan-penganjuran-kursus/view', 'id' => $model->bantuan_penganjuran_kursus_id], true) . '
    <br><br>
    Sekian.
    <br><br>
    "KE ARAH KECEMERLANGAN SUKAN"<br>
    Majlis Sukan Negara Malaysia.
        ')->send();
                        }
                    }
                }
                
                return $this->redirect(['view', 'id' => $model->bantuan_penganjuran_kursus_id]);
            }
        } 
        
        return $this->render('create', [
                'model' => $model,
                'searchModelBantuanPenganjuranKursusPenceramah' => $searchModelBantuanPenganjuranKursusPenceramah,
                'dataProviderBantuanPenganjuranKursusPenceramah' => $dataProviderBantuanPenganjuranKursusPenceramah,
                'searchModelBantuanPenganjuranKursusDisertaiPenceramah' => $searchModelBantuanPenganjuranKursusDisertaiPenceramah,
                'dataProviderBantuanPenganjuranKursusDisertaiPenceramah' => $dataProviderBantuanPenganjuranKursusDisertaiPenceramah,
                'searchModelBantuanPenganjuranKursusOlehMsn' => $searchModelBantuanPenganjuranKursusOlehMsn,
                'dataProviderBantuanPenganjuranKursusOlehMsn' => $dataProviderBantuanPenganjuranKursusOlehMsn,
                'searchModelBantuanPenganjuranKursusElemen' => $searchModelBantuanPenganjuranKursusElemen,
                'dataProviderBantuanPenganjuranKursusElemen' => $dataProviderBantuanPenganjuranKursusElemen,
                'readonly' => false,
            ]);
    }

    /**
     * Updates an existing BantuanPenganjuranKursus model.
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
        
        $queryPar['BantuanPenganjuranKursusPenceramahSearch']['bantuan_penganjuran_kursus_id'] = $id;
        $queryPar['BantuanPenganjuranKursusDisertaiPenceramahSearch']['bantuan_penganjuran_kursus_id'] = $id;
        $queryPar['BantuanPenganjuranKursusOlehMsnSearch']['bantuan_penganjuran_kursus_id'] = $id;
        $queryPar['BantuanPenganjuranKursusElemenSearch']['bantuan_penganjuran_kursus_id'] = $id;
        
        $searchModelBantuanPenganjuranKursusPenceramah  = new BantuanPenganjuranKursusPenceramahSearch();
        $dataProviderBantuanPenganjuranKursusPenceramah = $searchModelBantuanPenganjuranKursusPenceramah->search($queryPar);
        
        $searchModelBantuanPenganjuranKursusDisertaiPenceramah  = new BantuanPenganjuranKursusDisertaiPenceramahSearch();
        $dataProviderBantuanPenganjuranKursusDisertaiPenceramah = $searchModelBantuanPenganjuranKursusDisertaiPenceramah->search($queryPar);
        
        $searchModelBantuanPenganjuranKursusOlehMsn  = new BantuanPenganjuranKursusOlehMsnSearch();
        $dataProviderBantuanPenganjuranKursusOlehMsn = $searchModelBantuanPenganjuranKursusOlehMsn->search($queryPar);
        
        $searchModelBantuanPenganjuranKursusElemen  = new BantuanPenganjuranKursusElemenSearch();
        $dataProviderBantuanPenganjuranKursusElemen = $searchModelBantuanPenganjuranKursusElemen->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $file = UploadedFile::getInstance($model, 'kertas_kerja');
            $filename = $model->bantuan_penganjuran_kursus_id . "-kertas_kerja";
            if($file){
                $model->kertas_kerja = Upload::uploadFile($file, Upload::bantuanPenganjuranKursusFolder, $filename);
            }
            
            $file = UploadedFile::getInstance($model, 'surat_rasmi_badan_sukan_ms_negeri');
            $filename = $model->bantuan_penganjuran_kursus_id . "-surat_rasmi_badan_sukan_ms_negeri";
            if($file){
                $model->surat_rasmi_badan_sukan_ms_negeri = Upload::uploadFile($file, Upload::bantuanPenganjuranKursusFolder, $filename);
            }
            
            $file = UploadedFile::getInstance($model, 'butiran_perbelanjaan');
            $filename = $model->bantuan_penganjuran_kursus_id . "-butiran_perbelanjaan";
            if($file){
                $model->butiran_perbelanjaan = Upload::uploadFile($file, Upload::bantuanPenganjuranKursusFolder, $filename);
            }
            
            $file = UploadedFile::getInstance($model, 'maklumat_lain_sokongan');
            $filename = $model->bantuan_penganjuran_kursus_id . "-maklumat_lain_sokongan";
            if($file){
                $model->maklumat_lain_sokongan = Upload::uploadFile($file, Upload::bantuanPenganjuranKursusFolder, $filename);
            }
            
            $file = UploadedFile::getInstance($model, 'surat_kelulusan');
            $filename = $model->bantuan_penganjuran_kursus_id . "-surat_kelulusan";
            if($file){
                $model->surat_kelulusan = Upload::uploadFile($file, Upload::bantuanPenganjuranKursusFolder, $filename);
            }
            
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->bantuan_penganjuran_kursus_id]);
            }
        } 
        
        return $this->render('update', [
                'model' => $model,
                'searchModelBantuanPenganjuranKursusPenceramah' => $searchModelBantuanPenganjuranKursusPenceramah,
                'dataProviderBantuanPenganjuranKursusPenceramah' => $dataProviderBantuanPenganjuranKursusPenceramah,
                'searchModelBantuanPenganjuranKursusDisertaiPenceramah' => $searchModelBantuanPenganjuranKursusDisertaiPenceramah,
                'dataProviderBantuanPenganjuranKursusDisertaiPenceramah' => $dataProviderBantuanPenganjuranKursusDisertaiPenceramah,
                'searchModelBantuanPenganjuranKursusOlehMsn' => $searchModelBantuanPenganjuranKursusOlehMsn,
                'dataProviderBantuanPenganjuranKursusOlehMsn' => $dataProviderBantuanPenganjuranKursusOlehMsn,
                'searchModelBantuanPenganjuranKursusElemen' => $searchModelBantuanPenganjuranKursusElemen,
                'dataProviderBantuanPenganjuranKursusElemen' => $dataProviderBantuanPenganjuranKursusElemen,
                'readonly' => false,
            ]);
    }

    /**
     * Deletes an existing BantuanPenganjuranKursus model.
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
        
        self::actionDeleteupload($id, 'butiran_perbelanjaan');
        
        self::actionDeleteupload($id, 'maklumat_lain_sokongan');
        
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the BantuanPenganjuranKursus model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return BantuanPenganjuranKursus the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = BantuanPenganjuranKursus::findOne($id)) !== null) {
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
        $model->status_permohonan = RefStatusBantuanPenganjuranKursus::SEDANG_DIPROSES;
        
        $model->save();
        
        return $this->redirect(['view', 'id' => $model->bantuan_penganjuran_kursus_id]);
    }
    
    public function actionLaporanBantuanTeknikalDanKepegawaian()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new MsnLaporanBantuanTeknikalDanKepegawaian();
        $model->format = 'html';

        if ($model->load(Yii::$app->request->post())) {
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-laporan-bantuan-teknikal-dan-kepegawaian'
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'sukan' => $model->sukan
                    , 'status_permohonan' => $model->status_permohonan
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-laporan-bantuan-teknikal-dan-kepegawaian'
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'sukan' => $model->sukan
                    , 'status_permohonan' => $model->status_permohonan
                    , 'format' => $model->format
                ]);
            }
        } 

        return $this->render('laporan_bantuan_teknikal_dan_kepegawaian', [
            'model' => $model,
            'readonly' => false,
        ]);
    }
    
    public function actionGenerateLaporanBantuanTeknikalDanKepegawaian($tarikh_dari, $tarikh_hingga, $sukan, $status_permohonan, $format)
    {
        if($tarikh_dari == "") $tarikh_dari = array();
        else $tarikh_dari = array($tarikh_dari);
        
        if($tarikh_hingga == "") $tarikh_hingga = array();
        else $tarikh_hingga = array($tarikh_hingga);
        
        if($sukan == "") $sukan = array();
        else $sukan = array($sukan);
        
        if($status_permohonan == "") $status_permohonan = array();
        else $status_permohonan = array($status_permohonan);
        
        $controls = array(
            'FROM_DATE' => $tarikh_dari,
            'TO_DATE' => $tarikh_hingga,
            'SUKAN' => $sukan,
            'STATUS_PERMOHONAN' => $status_permohonan,
        );
        
        GeneralFunction::generateReport('/spsb/MSN/LaporanBantuanTeknikalDanKepegawaian', $format, $controls, 'laporan_bantuan_teknikal_dan_kepegawaian');
    }
    
    public function actionLaporanBantuanTeknikalDanKepegawaianMengikutSukan()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new MsnLaporanBantuanTeknikalDanKepegawaianMengikutSukan();
        $model->format = 'html';

        if ($model->load(Yii::$app->request->post())) {
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-laporan-bantuan-teknikal-dan-kepegawaian-mengikut-sukan'
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'sukan' => $model->sukan
                    , 'status_permohonan' => $model->status_permohonan
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-laporan-bantuan-teknikal-dan-kepegawaian-mengikut-sukan'
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'sukan' => $model->sukan
                    , 'status_permohonan' => $model->status_permohonan
                    , 'format' => $model->format
                ]);
            }
        } 

        return $this->render('laporan_bantuan_teknikal_dan_kepegawaian_mengikut_sukan', [
            'model' => $model,
            'readonly' => false,
        ]);
    }
    
    public function actionGenerateLaporanBantuanTeknikalDanKepegawaianMengikutSukan($tarikh_dari, $tarikh_hingga, $sukan, $status_permohonan, $format)
    {
        if($tarikh_dari == "") $tarikh_dari = array();
        else $tarikh_dari = array($tarikh_dari);
        
        if($tarikh_hingga == "") $tarikh_hingga = array();
        else $tarikh_hingga = array($tarikh_hingga);
        
        if($sukan == "") $sukan = array();
        else $sukan = array($sukan);
        
        if($status_permohonan == "") $status_permohonan = array();
        else $status_permohonan = array($status_permohonan);
        
        $controls = array(
            'FROM_DATE' => $tarikh_dari,
            'TO_DATE' => $tarikh_hingga,
            'SUKAN' => $sukan,
            'STATUS_PERMOHONAN' => $status_permohonan,
        );
        
        GeneralFunction::generateReport('/spsb/MSN/LaporanBantuanTeknikalDanKepegawaianMengikutSukan', $format, $controls, 'laporan_bantuan_teknikal_dan_kepegawaian_mengikut_sukan');
    }
    
    public function actionLaporanStatistikPengawaiTeknikalMengikutJawatan()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new MsnLaporan();
        $model->format = 'html';

        if ($model->load(Yii::$app->request->post())) {
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-laporan-statistik-pengawai-teknikal-mengikut-jawatan'
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-laporan-statistik-pengawai-teknikal-mengikut-jawatan'
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'format' => $model->format
                ]);
            }
        } 

        return $this->render('laporan_statistik_pengawai_teknikal_mengikut_jawatan', [
            'model' => $model,
            'readonly' => false,
        ]);
    }
    
    public function actionGenerateLaporanStatistikPengawaiTeknikalMengikutJawatan($tarikh_dari, $tarikh_hingga, $format)
    {
        if($tarikh_dari == "") $tarikh_dari = array();
        else $tarikh_dari = array($tarikh_dari);
        
        if($tarikh_hingga == "") $tarikh_hingga = array();
        else $tarikh_hingga = array($tarikh_hingga);
        
        $controls = array(
            'FROM_DATE' => $tarikh_dari,
            'TO_DATE' => $tarikh_hingga,
        );
        
        GeneralFunction::generateReport('/spsb/MSN/LaporanStatistikPengawaiTeknikalMengikutJawatan', $format, $controls, 'laporan_statistik_pengawai_teknikal_mengikut_jawatan');
    }
    
    public function actionLaporanStatistikPengawaiTeknikalMengikutProgram()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new MsnLaporan();
        $model->format = 'html';

        if ($model->load(Yii::$app->request->post())) {
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-laporan-statistik-pengawai-teknikal-mengikut-program'
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-laporan-statistik-pengawai-teknikal-mengikut-program'
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'format' => $model->format
                ]);
            }
        } 

        return $this->render('laporan_statistik_pengawai_teknikal_mengikut_program', [
            'model' => $model,
            'readonly' => false,
        ]);
    }
    
    public function actionGenerateLaporanStatistikPengawaiTeknikalMengikutProgram($tarikh_dari, $tarikh_hingga, $format)
    {
        if($tarikh_dari == "") $tarikh_dari = array();
        else $tarikh_dari = array($tarikh_dari);
        
        if($tarikh_hingga == "") $tarikh_hingga = array();
        else $tarikh_hingga = array($tarikh_hingga);
        
        $controls = array(
            'FROM_DATE' => $tarikh_dari,
            'TO_DATE' => $tarikh_hingga,
        );
        
        GeneralFunction::generateReport('/spsb/MSN/LaporanStatistikPengawaiTeknikalMengikutProgram', $format, $controls, 'laporan_statistik_pengawai_teknikal_mengikut_program');
    }
    
    public function actionLaporanStatistikPengawaiTeknikalMengikutKategori()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new MsnLaporan();
        $model->format = 'html';

        if ($model->load(Yii::$app->request->post())) {
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-laporan-statistik-pengawai-teknikal-mengikut-kategori'
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-laporan-statistik-pengawai-teknikal-mengikut-kategori'
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'format' => $model->format
                ]);
            }
        } 

        return $this->render('laporan_statistik_pengawai_teknikal_mengikut_kategori', [
            'model' => $model,
            'readonly' => false,
        ]);
    }
    
    public function actionGenerateLaporanStatistikPengawaiTeknikalMengikutKategori($tarikh_dari, $tarikh_hingga, $format)
    {
        if($tarikh_dari == "") $tarikh_dari = array();
        else $tarikh_dari = array($tarikh_dari);
        
        if($tarikh_hingga == "") $tarikh_hingga = array();
        else $tarikh_hingga = array($tarikh_hingga);
        
        $controls = array(
            'FROM_DATE' => $tarikh_dari,
            'TO_DATE' => $tarikh_hingga,
        );
        
        GeneralFunction::generateReport('/spsb/MSN/LaporanStatistikPengawaiTeknikalMengikutKategori', $format, $controls, 'laporan_statistik_pengawai_teknikal_mengikut_kategori');
    }
    
    public function actionLaporanStatistikBantuanPenganjuranKursusBengkelSeminar()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new MsnLaporan();
        $model->format = 'html';

        if ($model->load(Yii::$app->request->post())) {
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-laporan-statistik-bantuan-penganjuran-kursus-bengkel-seminar'
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-laporan-statistik-bantuan-penganjuran-kursus-bengkel-seminar'
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'format' => $model->format
                ]);
            }
        } 

        return $this->render('laporan_statistik_bantuan_penganjuran_kursus_bengkel_seminar', [
            'model' => $model,
            'readonly' => false,
        ]);
    }
    
    public function actionGenerateLaporanStatistikBantuanPenganjuranKursusBengkelSeminar($tarikh_dari, $tarikh_hingga, $format)
    {
        if($tarikh_dari == "") $tarikh_dari = array();
        else $tarikh_dari = array($tarikh_dari);
        
        if($tarikh_hingga == "") $tarikh_hingga = array();
        else $tarikh_hingga = array($tarikh_hingga);
        
        $controls = array(
            'FROM_DATE' => $tarikh_dari,
            'TO_DATE' => $tarikh_hingga,
        );
        
        GeneralFunction::generateReport('/spsb/MSN/LaporanStatistikBantuanPenganjuranKursusBengkelSeminar', $format, $controls, 'laporan_statistik_bantuan_penganjuran_kursus_bengkel_seminar');
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
        $ref = RefStatusBantuanPenganjuranKursus::findOne(['id' => $model->status_permohonan]);
        $model->status_permohonan = $ref['desc'];
		
		$BantuanPenganjuranKursusPenceramah = BantuanPenganjuranKursusPenceramah::find()->where(['bantuan_penganjuran_kursus_id' => $model->bantuan_penganjuran_kursus_id])->all();
		
		$BantuanPenganjuranKursusDisertaiPenceramah = BantuanPenganjuranKursusDisertaiPenceramah::find()->where(['bantuan_penganjuran_kursus_id' => $model->bantuan_penganjuran_kursus_id])->all();
		
		$BantuanPenganjuranKursusOlehMsn = BantuanPenganjuranKursusOlehMsn::find()->where(['bantuan_penganjuran_kursus_id' => $model->bantuan_penganjuran_kursus_id])->all();

        $pdf = new \mPDF('utf-8', 'A4');

        $pdf->title = 'Bantuan Penganjuran Kursus / Bengkel / Seminar';

        $stylesheet = file_get_contents('css/report.css');

        $pdf->WriteHTML($stylesheet,1);
        
        $pdf->WriteHTML($this->renderpartial('print', [
             'model'  => $model,
		     'title' => $pdf->title,
			 'BantuanPenganjuranKursusPenceramah' => $BantuanPenganjuranKursusPenceramah,
			 'BantuanPenganjuranKursusDisertaiPenceramah' => $BantuanPenganjuranKursusDisertaiPenceramah,
			 'BantuanPenganjuranKursusOlehMsn' => $BantuanPenganjuranKursusOlehMsn,

        ]));

        $pdf->Output(str_replace(' ', '_', $pdf->title).'_'.$model->bantuan_penganjuran_kursus_id.'.pdf', 'I');
    }
}
