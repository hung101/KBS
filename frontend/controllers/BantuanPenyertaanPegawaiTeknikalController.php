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
use app\models\ProfilBadanSukan;
use app\models\RefStatusBantuanPenyertaanPegawaiTeknikal;
use app\models\RefPeringkatBantuanPenyertaanPegawaiTeknikal;

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
            return $this->redirect($this->redirect(array(GeneralVariable::loginPagePath)));
        }
        
        $searchModel = new BantuanPenyertaanPegawaiTeknikalSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

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
            return $this->redirect($this->redirect(array(GeneralVariable::loginPagePath)));
        }
        
        $queryPar = null;
        
        $queryPar['BantuanPenyertaanPegawaiTeknikalDicadangkanSearch']['bantuan_penyertaan_pegawai_teknikal_id'] = $id;
        $queryPar['BantuanPenyertaanPegawaiTeknikalDisertaiSearch']['bantuan_penyertaan_pegawai_teknikal_id'] = $id;
        $queryPar['BantuanPenyertaanPegawaiTeknikalOlehMsnSearch']['bantuan_penyertaan_pegawai_teknikal_id'] = $id;
        
        $searchModelBantuanPenyertaanPegawaiTeknikalDicadangkan  = new BantuanPenyertaanPegawaiTeknikalDicadangkanSearch();
        $dataProviderBantuanPenyertaanPegawaiTeknikalDicadangkan = $searchModelBantuanPenyertaanPegawaiTeknikalDicadangkan->search($queryPar);
        
        $searchModelBantuanPenyertaanPegawaiTeknikalDisertai  = new BantuanPenyertaanPegawaiTeknikalDisertaiSearch();
        $dataProviderBantuanPenyertaanPegawaiTeknikalDisertai = $searchModelBantuanPenyertaanPegawaiTeknikalDisertai->search($queryPar);
        
        $searchModelBantuanPenyertaanPegawaiTeknikalOlehMsn  = new BantuanPenyertaanPegawaiTeknikalOlehMsnSearch();
        $dataProviderBantuanPenyertaanPegawaiTeknikalOlehMsn = $searchModelBantuanPenyertaanPegawaiTeknikalOlehMsn->search($queryPar);
        
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
        
        return $this->render('view', [
            'model' => $model,
            'searchModelBantuanPenyertaanPegawaiTeknikalDicadangkan' => $searchModelBantuanPenyertaanPegawaiTeknikalDicadangkan,
            'dataProviderBantuanPenyertaanPegawaiTeknikalDicadangkan' => $dataProviderBantuanPenyertaanPegawaiTeknikalDicadangkan,
            'searchModelBantuanPenyertaanPegawaiTeknikalDisertai' => $searchModelBantuanPenyertaanPegawaiTeknikalDisertai,
            'dataProviderBantuanPenyertaanPegawaiTeknikalDisertai' => $dataProviderBantuanPenyertaanPegawaiTeknikalDisertai,
            'searchModelBantuanPenyertaanPegawaiTeknikalOlehMsn' => $searchModelBantuanPenyertaanPegawaiTeknikalOlehMsn,
            'dataProviderBantuanPenyertaanPegawaiTeknikalOlehMsn' => $dataProviderBantuanPenyertaanPegawaiTeknikalOlehMsn,
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
            return $this->redirect($this->redirect(array(GeneralVariable::loginPagePath)));
        }
        
        $model = new BantuanPenyertaanPegawaiTeknikal();
        
        $model->tarikh_permohonan = GeneralFunction::getCurrentTimestamp();
        $model->status_permohonan = RefStatusBantuanPenyertaanPegawaiTeknikal::SEDANG_DIPROSES;
        
        $queryPar = null;
        
        Yii::$app->session->open();
        
        if(isset(Yii::$app->session->id)){
            $queryPar['BantuanPenyertaanPegawaiTeknikalDicadangkanSearch']['session_id'] = Yii::$app->session->id;
            $queryPar['BantuanPenyertaanPegawaiTeknikalDisertaiSearch']['session_id'] = Yii::$app->session->id;
            $queryPar['BantuanPenyertaanPegawaiTeknikalOlehMsnSearch']['session_id'] = Yii::$app->session->id;
        }
        
        $searchModelBantuanPenyertaanPegawaiTeknikalDicadangkan  = new BantuanPenyertaanPegawaiTeknikalDicadangkanSearch();
        $dataProviderBantuanPenyertaanPegawaiTeknikalDicadangkan = $searchModelBantuanPenyertaanPegawaiTeknikalDicadangkan->search($queryPar);
        
        $searchModelBantuanPenyertaanPegawaiTeknikalDisertai  = new BantuanPenyertaanPegawaiTeknikalDisertaiSearch();
        $dataProviderBantuanPenyertaanPegawaiTeknikalDisertai = $searchModelBantuanPenyertaanPegawaiTeknikalDisertai->search($queryPar);
        
        $searchModelBantuanPenyertaanPegawaiTeknikalOlehMsn  = new BantuanPenyertaanPegawaiTeknikalOlehMsnSearch();
        $dataProviderBantuanPenyertaanPegawaiTeknikalOlehMsn = $searchModelBantuanPenyertaanPegawaiTeknikalOlehMsn->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if(isset(Yii::$app->session->id)){
                BantuanPenyertaanPegawaiTeknikalDicadangkan::updateAll(['bantuan_penyertaan_pegawai_teknikal_id' => $model->bantuan_penyertaan_pegawai_teknikal_id], 'session_id = "'.Yii::$app->session->id.'"');
                BantuanPenyertaanPegawaiTeknikalDicadangkan::updateAll(['session_id' => ''], 'bantuan_penyertaan_pegawai_teknikal_id = "'.$model->bantuan_penyertaan_pegawai_teknikal_id.'"');
                
                BantuanPenyertaanPegawaiTeknikalDisertai::updateAll(['bantuan_penyertaan_pegawai_teknikal_id' => $model->bantuan_penyertaan_pegawai_teknikal_id], 'session_id = "'.Yii::$app->session->id.'"');
                BantuanPenyertaanPegawaiTeknikalDisertai::updateAll(['session_id' => ''], 'bantuan_penyertaan_pegawai_teknikal_id = "'.$model->bantuan_penyertaan_pegawai_teknikal_id.'"');
                
                BantuanPenyertaanPegawaiTeknikalOlehMsn::updateAll(['bantuan_penyertaan_pegawai_teknikal_id' => $model->bantuan_penyertaan_pegawai_teknikal_id], 'session_id = "'.Yii::$app->session->id.'"');
                BantuanPenyertaanPegawaiTeknikalOlehMsn::updateAll(['session_id' => ''], 'bantuan_penyertaan_pegawai_teknikal_id = "'.$model->bantuan_penyertaan_pegawai_teknikal_id.'"');
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
            
            if($model->save()){
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
            return $this->redirect($this->redirect(array(GeneralVariable::loginPagePath)));
        }
        
        $model = $this->findModel($id);
        
        $queryPar = null;
        
        $queryPar['BantuanPenyertaanPegawaiTeknikalDicadangkanSearch']['bantuan_penyertaan_pegawai_teknikal_id'] = $id;
        $queryPar['BantuanPenyertaanPegawaiTeknikalDisertaiSearch']['bantuan_penyertaan_pegawai_teknikal_id'] = $id;
        $queryPar['BantuanPenyertaanPegawaiTeknikalOlehMsnSearch']['bantuan_penyertaan_pegawai_teknikal_id'] = $id;
        
        $searchModelBantuanPenyertaanPegawaiTeknikalDicadangkan  = new BantuanPenyertaanPegawaiTeknikalDicadangkanSearch();
        $dataProviderBantuanPenyertaanPegawaiTeknikalDicadangkan = $searchModelBantuanPenyertaanPegawaiTeknikalDicadangkan->search($queryPar);
        
        $searchModelBantuanPenyertaanPegawaiTeknikalDisertai  = new BantuanPenyertaanPegawaiTeknikalDisertaiSearch();
        $dataProviderBantuanPenyertaanPegawaiTeknikalDisertai = $searchModelBantuanPenyertaanPegawaiTeknikalDisertai->search($queryPar);
        
        $searchModelBantuanPenyertaanPegawaiTeknikalOlehMsn  = new BantuanPenyertaanPegawaiTeknikalOlehMsnSearch();
        $dataProviderBantuanPenyertaanPegawaiTeknikalOlehMsn = $searchModelBantuanPenyertaanPegawaiTeknikalOlehMsn->search($queryPar);

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
            return $this->redirect($this->redirect(array(GeneralVariable::loginPagePath)));
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
