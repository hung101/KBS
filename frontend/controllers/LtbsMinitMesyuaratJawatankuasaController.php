<?php

namespace frontend\controllers;

use Yii;
use app\models\LtbsMinitMesyuaratJawatankuasa;
use app\models\LtbsMinitMesyuaratJawatankuasaSearch;
use app\models\LtbsMinitMesyuaratJawatankuasaDokumenMuatNaik;
use frontend\models\LtbsMinitMesyuaratJawatankuasaDokumenMuatNaikSearch;
use app\models\LtbsNotisAgm;
use app\models\LtbsNotisAgmSearch;
use app\models\LtbsSenaraiNamaHadirJawatankuasa;
use app\models\LtbsSenaraiNamaHadirJawatankuasaSearch;
use app\models\LtbsSenaraiNamaHadirAgm;
use app\models\LtbsSenaraiNamaHadirAgmSearch;
use app\models\PjsMaklumatMesyuaratAgungTahunan;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\helpers\BaseUrl;

use app\models\general\Upload;
use common\models\general\GeneralFunction;
use app\models\general\GeneralVariable;

// table reference
use app\models\ProfilBadanSukan;
use app\models\RefStatusLaporanMesyuaratAgung;

/**
 * LtbsMinitMesyuaratJawatankuasaController implements the CRUD actions for LtbsMinitMesyuaratJawatankuasa model.
 */
class LtbsMinitMesyuaratJawatankuasaController extends Controller
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
     * Lists all LtbsMinitMesyuaratJawatankuasa models.
     * @return mixed
     */
    public function actionIndex($profil_badan_sukan_id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $queryPar = Yii::$app->request->queryParams;
        
        if($profil_badan_sukan_id!=""){
            $queryPar['LtbsMinitMesyuaratJawatankuasaSearch']['profil_badan_sukan_search'] = $profil_badan_sukan_id;
        }
        
        $searchModel = new LtbsMinitMesyuaratJawatankuasaSearch();
        $dataProvider = $searchModel->search($queryPar);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'profil_badan_sukan_id' => $profil_badan_sukan_id,
        ]);
    }

    /**
     * Displays a single LtbsMinitMesyuaratJawatankuasa model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = $this->findModel($id);
        
        $profil_badan_sukan_id = $model->profil_badan_sukan_id;
        $ref = ProfilBadanSukan::findOne(['profil_badan_sukan' => $model->profil_badan_sukan_id]);
        $model->profil_badan_sukan_id = $ref['nama_badan_sukan'];
        
        $ref = RefStatusLaporanMesyuaratAgung::findOne(['id' => $model->status]);
        $model->status = $ref['desc'];
        
        $model->tarikh = GeneralFunction::convert($model->tarikh, GeneralFunction::TYPE_DATETIME);
        
        $queryPar = null;
        
        $queryPar['LtbsMinitMesyuaratJawatankuasaDokumenMuatNaikSearch']['mesyuarat_id'] = $id;
        $queryPar['LtbsSenaraiNamaHadirJawatankuasaSearch']['mesyuarat_id'] = $id;
        $queryPar['LtbsNotisAgmSearch']['mesyuarat_id'] = $id;
        $queryPar['LtbsSenaraiNamaHadirAgmSearch']['mesyuarat_agm_id'] = $id;
        
        $searchModelDMN = new LtbsMinitMesyuaratJawatankuasaDokumenMuatNaikSearch();
        $dataProviderDMN = $searchModelDMN->search($queryPar);
        
        $searchModelSNH = new LtbsSenaraiNamaHadirJawatankuasaSearch();
        $dataProviderSNH = $searchModelSNH->search($queryPar);
        
        $searchModelNMA = new LtbsNotisAgmSearch();
        $dataProviderNMA = $searchModelNMA->search($queryPar);
        
        $searchModelSNKMA = new LtbsSenaraiNamaHadirAgmSearch();
        $dataProviderSNKMA = $searchModelSNKMA->search($queryPar);
        
        return $this->render('view', [
            'model' => $model,
            'readonly' => true,
            'searchModelDMN' => $searchModelDMN,
            'dataProviderDMN' => $dataProviderDMN,
            'searchModelSNH' => $searchModelSNH,
            'dataProviderSNH' => $dataProviderSNH,
            'searchModelNMA' => $searchModelNMA,
            'dataProviderNMA' => $dataProviderNMA,
            'searchModelSNKMA' => $searchModelSNKMA,
            'dataProviderSNKMA' => $dataProviderSNKMA,
            'profil_badan_sukan_id' => $profil_badan_sukan_id,
        ]);
    }

    /**
     * Creates a new LtbsMinitMesyuaratJawatankuasa model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($profil_badan_sukan_id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new LtbsMinitMesyuaratJawatankuasa();
        
        $queryPar = null;
        
        Yii::$app->session->open();
        
        if(isset(Yii::$app->session->id)){
            //filter only show base on user login session
            $queryPar['LtbsMinitMesyuaratJawatankuasaDokumenMuatNaikSearch']['session_id'] = Yii::$app->session->id;
            $queryPar['LtbsSenaraiNamaHadirJawatankuasaSearch']['session_id'] = Yii::$app->session->id;
            $queryPar['LtbsNotisAgmSearch']['session_id'] = Yii::$app->session->id;
            $queryPar['LtbsSenaraiNamaHadirAgmSearch']['session_id'] = Yii::$app->session->id;
        }
        
        if(Yii::$app->user->identity->profil_badan_sukan){
            $model->profil_badan_sukan_id = Yii::$app->user->identity->profil_badan_sukan;
            $model->status = RefStatusLaporanMesyuaratAgung::BELUM_DISAHKAN;
        } else if($profil_badan_sukan_id!=""){
            $model->profil_badan_sukan_id = $profil_badan_sukan_id;
        }
        
        $searchModelDMN = new LtbsMinitMesyuaratJawatankuasaDokumenMuatNaikSearch();
        $dataProviderDMN = $searchModelDMN->search($queryPar);
        
        $searchModelSNH = new LtbsSenaraiNamaHadirJawatankuasaSearch();
        $dataProviderSNH = $searchModelSNH->search($queryPar);
        
        $searchModelNMA = new LtbsNotisAgmSearch();
        $dataProviderNMA = $searchModelNMA->search($queryPar);
        
        $searchModelSNKMA = new LtbsSenaraiNamaHadirAgmSearch();
        $dataProviderSNKMA = $searchModelSNKMA->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $file = UploadedFile::getInstance($model, 'minit_ajk_muat_naik');
            if($file){
                $model->minit_ajk_muat_naik = Upload::uploadFile($file, Upload::ltbsMinitMesyuaratJawatankuasaFolder, 'minit_ajk_muat_naik-' . $model->mesyuarat_id);
            }
            
            $file = UploadedFile::getInstance($model, 'notis_agm_muat_naik');
            if($file){
                $model->notis_agm_muat_naik = Upload::uploadFile($file, Upload::ltbsMinitMesyuaratJawatankuasaFolder, 'notis_agm_muat_naik-' . $model->mesyuarat_id);
            }
            
            $file = UploadedFile::getInstance($model, 'minit_agm_muat_naik');
            if($file){
                $model->minit_agm_muat_naik = Upload::uploadFile($file, Upload::ltbsMinitMesyuaratJawatankuasaFolder, 'minit_agm_muat_naik-' . $model->mesyuarat_id);
            }
            
            $file = UploadedFile::getInstance($model, 'laporan_kewangan_muat_naik');
            if($file){
                $model->laporan_kewangan_muat_naik = Upload::uploadFile($file, Upload::ltbsMinitMesyuaratJawatankuasaFolder, 'laporan_kewangan_muat_naik-' . $model->mesyuarat_id);
            }
            
            $file = UploadedFile::getInstance($model, 'laporan_aktiviti_muat_naik');
            if($file){
                $model->laporan_aktiviti_muat_naik = Upload::uploadFile($file, Upload::ltbsMinitMesyuaratJawatankuasaFolder, 'laporan_aktiviti_muat_naik-' . $model->mesyuarat_id);
            }
            
            $file = UploadedFile::getInstance($model, 'borang_pt_muat_naik');
            if($file){
                $model->borang_pt_muat_naik = Upload::uploadFile($file, Upload::ltbsMinitMesyuaratJawatankuasaFolder, 'borang_pt_muat_naik-' . $model->mesyuarat_id);
            }
            
            $file = UploadedFile::getInstance($model, 'senarai_ahli_jawatankuasa_muat_naik');
            if($file){
                $model->senarai_ahli_jawatankuasa_muat_naik = Upload::uploadFile($file, Upload::ltbsMinitMesyuaratJawatankuasaFolder, 'senarai_ahli_jawatankuasa_muat_naik-' . $model->mesyuarat_id);
            }
            
            $file = UploadedFile::getInstance($model, 'senarai_ahli_gabungan_terkini_muat_naik');
            if($file){
                $model->senarai_ahli_gabungan_terkini_muat_naik = Upload::uploadFile($file, Upload::ltbsMinitMesyuaratJawatankuasaFolder, 'senarai_ahli_gabungan_terkini_muat_naik-' . $model->mesyuarat_id);
            }
            
            if(isset(Yii::$app->session->id)){
                //update the new mesyuarat id instead of use login session id as reference
                LtbsMinitMesyuaratJawatankuasaDokumenMuatNaik::updateAll(['mesyuarat_id' => $model->mesyuarat_id], 'session_id = "'.Yii::$app->session->id.'"');
                LtbsMinitMesyuaratJawatankuasaDokumenMuatNaik::updateAll(['session_id' => ''], 'mesyuarat_id = "'.$model->mesyuarat_id.'"');
                
                LtbsSenaraiNamaHadirJawatankuasa::updateAll(['mesyuarat_id' => $model->mesyuarat_id], 'session_id = "'.Yii::$app->session->id.'"');
                LtbsSenaraiNamaHadirJawatankuasa::updateAll(['session_id' => ''], 'mesyuarat_id = "'.$model->mesyuarat_id.'"');
                
                LtbsNotisAgm::updateAll(['mesyuarat_id' => $model->mesyuarat_id], 'session_id = "'.Yii::$app->session->id.'"');
                LtbsNotisAgm::updateAll(['session_id' => ''], 'mesyuarat_id = "'.$model->mesyuarat_id.'"');
                
                LtbsSenaraiNamaHadirAgm::updateAll(['mesyuarat_agm_id' => $model->mesyuarat_id], 'session_id = "'.Yii::$app->session->id.'"');
                LtbsSenaraiNamaHadirAgm::updateAll(['session_id' => ''], 'mesyuarat_agm_id = "'.$model->mesyuarat_id.'"');
            }
            
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->mesyuarat_id]);
            }
        } 
        
        return $this->render('create', [
                'model' => $model,
                'readonly' => false,
                'searchModelDMN' => $searchModelDMN,
                'dataProviderDMN' => $dataProviderDMN,
                'searchModelSNH' => $searchModelSNH,
                'dataProviderSNH' => $dataProviderSNH,
                'searchModelNMA' => $searchModelNMA,
                'dataProviderNMA' => $dataProviderNMA,
                'searchModelSNKMA' => $searchModelSNKMA,
                'dataProviderSNKMA' => $dataProviderSNKMA,
                'profil_badan_sukan_id' => $profil_badan_sukan_id,
            ]);
    }

    /**
     * Updates an existing LtbsMinitMesyuaratJawatankuasa model.
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
        
        $existingMinitAjk = $model->minit_ajk_muat_naik;
        $existingNotisAgm = $model->notis_agm_muat_naik;
        $existingMinitAgm= $model->minit_agm_muat_naik;
        $existingKewangan = $model->laporan_kewangan_muat_naik;
        $existingAktiviti = $model->laporan_aktiviti_muat_naik;
        $existingBorangPT = $model->borang_pt_muat_naik;
        $existingSenaraiAhliJawatankuasa = $model->senarai_ahli_jawatankuasa_muat_naik;
        $existingSenaraiAhliGabungan = $model->senarai_ahli_gabungan_terkini_muat_naik;
        
        if($model->load(Yii::$app->request->post())){
            $file = UploadedFile::getInstance($model, 'minit_ajk_muat_naik');

            if($file){
                //valid file to upload
                //upload file to server
                
                // delete upload file
                if($existingMinitAjk != ""){
                    self::actionDeleteupload($id, 'minit_ajk_muat_naik');
                }
                
                $model->minit_ajk_muat_naik = Upload::uploadFile($file, Upload::ltbsMinitMesyuaratJawatankuasaFolder, 'minit_ajk_muat_naik-' . $model->mesyuarat_id);
            } else {
                //invalid file to upload
                //remain existing file
                $model->minit_ajk_muat_naik = $existingMinitAjk;
            }
            
            $file = UploadedFile::getInstance($model, 'notis_agm_muat_naik');

            if($file){
                //valid file to upload
                //upload file to server
                
                // delete upload file
                if($existingNotisAgm != ""){
                    self::actionDeleteupload($id, 'notis_agm_muat_naik');
                }
                
                $model->notis_agm_muat_naik = Upload::uploadFile($file, Upload::ltbsMinitMesyuaratJawatankuasaFolder, 'notis_agm_muat_naik-' . $model->mesyuarat_id);
            } else {
                //invalid file to upload
                //remain existing file
                $model->notis_agm_muat_naik = $existingNotisAgm;
            }
            
            $file = UploadedFile::getInstance($model, 'minit_agm_muat_naik');

            if($file){
                //valid file to upload
                //upload file to server
                
                // delete upload file
                if($existingMinitAgm != ""){
                    self::actionDeleteupload($id, 'minit_agm_muat_naik');
                }
                
                $model->minit_agm_muat_naik = Upload::uploadFile($file, Upload::ltbsMinitMesyuaratJawatankuasaFolder, 'minit_agm_muat_naik-' . $model->mesyuarat_id);
            } else {
                //invalid file to upload
                //remain existing file
                $model->minit_agm_muat_naik = $existingMinitAgm;
            }
            
            $file = UploadedFile::getInstance($model, 'laporan_kewangan_muat_naik');

            if($file){
                //valid file to upload
                //upload file to server
                
                // delete upload file
                if($existingKewangan != ""){
                    self::actionDeleteupload($id, 'laporan_kewangan_muat_naik');
                }
                
                $model->laporan_kewangan_muat_naik = Upload::uploadFile($file, Upload::ltbsMinitMesyuaratJawatankuasaFolder, 'laporan_kewangan_muat_naik-' . $model->mesyuarat_id);
            } else {
                //invalid file to upload
                //remain existing file
                $model->laporan_kewangan_muat_naik = $existingKewangan;
            }
            
            $file = UploadedFile::getInstance($model, 'laporan_aktiviti_muat_naik');

            if($file){
                //valid file to upload
                //upload file to server
                
                // delete upload file
                if($existingAktiviti != ""){
                    self::actionDeleteupload($id, 'laporan_aktiviti_muat_naik');
                }
                
                $model->laporan_aktiviti_muat_naik = Upload::uploadFile($file, Upload::ltbsMinitMesyuaratJawatankuasaFolder, 'laporan_aktiviti_muat_naik-' . $model->mesyuarat_id);
            } else {
                //invalid file to upload
                //remain existing file
                $model->laporan_aktiviti_muat_naik = $existingAktiviti;
            }
            
            $file = UploadedFile::getInstance($model, 'borang_pt_muat_naik');

            if($file){
                //valid file to upload
                //upload file to server
                
                // delete upload file
                if($existingBorangPT != ""){
                    self::actionDeleteupload($id, 'borang_pt_muat_naik');
                }
                
                $model->borang_pt_muat_naik = Upload::uploadFile($file, Upload::ltbsMinitMesyuaratJawatankuasaFolder, 'borang_pt_muat_naik-' . $model->mesyuarat_id);
            } else {
                //invalid file to upload
                //remain existing file
                $model->borang_pt_muat_naik = $existingBorangPT;
            }
            
            $file = UploadedFile::getInstance($model, 'senarai_ahli_jawatankuasa_muat_naik');

            if($file){
                //valid file to upload
                //upload file to server
                
                // delete upload file
                if($existingSenaraiAhliJawatankuasa != ""){
                    self::actionDeleteupload($id, 'senarai_ahli_jawatankuasa_muat_naik');
                }
                
                $model->senarai_ahli_jawatankuasa_muat_naik = Upload::uploadFile($file, Upload::ltbsMinitMesyuaratJawatankuasaFolder, 'senarai_ahli_jawatankuasa_muat_naik-' . $model->mesyuarat_id);
            } else {
                //invalid file to upload
                //remain existing file
                $model->senarai_ahli_jawatankuasa_muat_naik = $existingSenaraiAhliJawatankuasa;
            }
            
            $file = UploadedFile::getInstance($model, 'senarai_ahli_gabungan_terkini_muat_naik');

            if($file){
                //valid file to upload
                //upload file to server
                
                // delete upload file
                if($existingSenaraiAhliGabungan != ""){
                    self::actionDeleteupload($id, 'senarai_ahli_gabungan_terkini_muat_naik');
                }
                
                $model->senarai_ahli_gabungan_terkini_muat_naik = Upload::uploadFile($file, Upload::ltbsMinitMesyuaratJawatankuasaFolder, 'senarai_ahli_gabungan_terkini_muat_naik-' . $model->mesyuarat_id);
            } else {
                //invalid file to upload
                //remain existing file
                $model->senarai_ahli_gabungan_terkini_muat_naik = $existingSenaraiAhliGabungan;
            }
        }
        
        $queryPar['LtbsMinitMesyuaratJawatankuasaDokumenMuatNaikSearch']['mesyuarat_id'] = $id;
        $queryPar['LtbsSenaraiNamaHadirJawatankuasaSearch']['mesyuarat_id'] = $id;
        $queryPar['LtbsNotisAgmSearch']['mesyuarat_id'] = $id;
        $queryPar['LtbsSenaraiNamaHadirAgmSearch']['mesyuarat_agm_id'] = $id;
        
        $searchModelDMN = new LtbsMinitMesyuaratJawatankuasaDokumenMuatNaikSearch();
        $dataProviderDMN = $searchModelDMN->search($queryPar);
        
        $searchModelSNH = new LtbsSenaraiNamaHadirJawatankuasaSearch();
        $dataProviderSNH = $searchModelSNH->search($queryPar);
        
        $searchModelNMA = new LtbsNotisAgmSearch();
        $dataProviderNMA = $searchModelNMA->search($queryPar);
        
        $searchModelSNKMA = new LtbsSenaraiNamaHadirAgmSearch();
        $dataProviderSNKMA = $searchModelSNKMA->search($queryPar);
        
        if (Yii::$app->request->post() && $model->save()) {
            /*$file = UploadedFile::getInstance($model, 'minit_ajk_muat_naik');
            if($file){
                $model->minit_ajk_muat_naik = Upload::uploadFile($file, Upload::ltbsMinitMesyuaratJawatankuasaFolder, 'minit_ajk_muat_naik-' . $model->mesyuarat_id);
            }
            
            $file = UploadedFile::getInstance($model, 'notis_agm_muat_naik');
            if($file){
                $model->notis_agm_muat_naik = Upload::uploadFile($file, Upload::ltbsMinitMesyuaratJawatankuasaFolder, 'notis_agm_muat_naik-' . $model->mesyuarat_id);
            }
            
            $file = UploadedFile::getInstance($model, 'minit_agm_muat_naik');
            if($file){
                $model->minit_agm_muat_naik = Upload::uploadFile($file, Upload::ltbsMinitMesyuaratJawatankuasaFolder, 'minit_agm_muat_naik-' . $model->mesyuarat_id);
            }
            
            $file = UploadedFile::getInstance($model, 'laporan_kewangan_muat_naik');
            if($file){
                $model->laporan_kewangan_muat_naik = Upload::uploadFile($file, Upload::ltbsMinitMesyuaratJawatankuasaFolder, 'laporan_kewangan_muat_naik-' . $model->mesyuarat_id);
            }
            
            $file = UploadedFile::getInstance($model, 'laporan_aktiviti_muat_naik');
            if($file){
                $model->laporan_aktiviti_muat_naik = Upload::uploadFile($file, Upload::ltbsMinitMesyuaratJawatankuasaFolder, 'laporan_aktiviti_muat_naik-' . $model->mesyuarat_id);
            }*/
            
            if(Yii::$app->user->identity->profil_badan_sukan){
                // set status to 'Belum Disahkan' if any changes made for persatuan
                $model->status = RefStatusLaporanMesyuaratAgung::BELUM_DISAHKAN;
            }
            
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->mesyuarat_id]);
            }
        } 
        
        return $this->render('update', [
                'model' => $model,
                'readonly' => false,
                'searchModelDMN' => $searchModelDMN,
                'dataProviderDMN' => $dataProviderDMN,
                'searchModelSNH' => $searchModelSNH,
                'dataProviderSNH' => $dataProviderSNH,
                'searchModelNMA' => $searchModelNMA,
                'dataProviderNMA' => $dataProviderNMA,
                'searchModelSNKMA' => $searchModelSNKMA,
                'dataProviderSNKMA' => $dataProviderSNKMA,
            ]);
    }

    /**
     * Deletes an existing LtbsMinitMesyuaratJawatankuasa model.
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
        self::actionDeleteupload($id, 'minit_ajk_muat_naik');
        
        self::actionDeleteupload($id, 'notis_agm_muat_naik');
        
        self::actionDeleteupload($id, 'minit_agm_muat_naik');
        
        self::actionDeleteupload($id, 'laporan_kewangan_muat_naik');
        
        self::actionDeleteupload($id, 'laporan_aktiviti_muat_naik');
        
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the LtbsMinitMesyuaratJawatankuasa model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return LtbsMinitMesyuaratJawatankuasa the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = LtbsMinitMesyuaratJawatankuasa::findOne($id)) !== null) {
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
        
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
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
    
    public function actionMaklumatMesyuaratAgungTahunan()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new PjsMaklumatMesyuaratAgungTahunan();
        $model->format = 'html';

        if ($model->load(Yii::$app->request->post())) {
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-maklumat-mesyuarat-agung-tahunan'
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'badan_sukan' => $model->badan_sukan
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-maklumat-mesyuarat-agung-tahunan'
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'badan_sukan' => $model->badan_sukan
                    , 'format' => $model->format
                ]);
            }
        } 

        return $this->render('maklumat_mesyuarat_agung_tahunan', [
            'model' => $model,
            'readonly' => false,
        ]);
    }
    
    public function actionGenerateMaklumatMesyuaratAgungTahunan($tarikh_dari, $tarikh_hingga, $badan_sukan, $format)
    {
        if($tarikh_dari == "") $tarikh_dari = array();
        else $tarikh_dari = array($tarikh_dari);
        
        if($tarikh_hingga == "") $tarikh_hingga = array();
        else $tarikh_hingga = array($tarikh_hingga);
        
        if($badan_sukan == "") $badan_sukan = array();
        else $badan_sukan = array($badan_sukan);
        
        $controls = array(
            'FROM_DATE' => $tarikh_dari,
            'TO_DATE' => $tarikh_hingga,
            'BADAN_SUKAN' => $badan_sukan,
        );
        
        GeneralFunction::generateReport('/spsb/PJS/MaklumatMesyuaratAgungTahunan', $format, $controls, 'maklumat_mesyuarat_agung_tahunan');
    }
}
