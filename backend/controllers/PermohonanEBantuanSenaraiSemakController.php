<?php

namespace backend\controllers;

use Yii;
use app\models\PermohonanEBantuanSenaraiSemak;
use backend\models\PermohonanEBantuanSenaraiSemakSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

use app\models\general\Upload;
use app\models\general\GeneralVariable;

/**
 * PermohonanEBantuanSenaraiSemakController implements the CRUD actions for PermohonanEBantuanSenaraiSemak model.
 */
class PermohonanEBantuanSenaraiSemakController extends Controller
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
     * Lists all PermohonanEBantuanSenaraiSemak models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $searchModel = new PermohonanEBantuanSenaraiSemakSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PermohonanEBantuanSenaraiSemak model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        return $this->render('view', [
            'model' => $this->findModel($id),
            'readonly' => true,
        ]);
    }
    
    /**
     * Creates a new PermohonanEBantuanSenaraiSemak model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionLoad($permohonan_id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        if (($model = PermohonanEBantuanSenaraiSemak::findOne(['permohonan_e_bantuan_id' => $permohonan_id])) !== null) {
            return self::actionUpdate($model->senarai_semak_id);
        } else {
            return self::actionCreate($permohonan_id);
        }
    }

    /**
     * Creates a new PermohonanEBantuanSenaraiSemak model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($permohonan_id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new PermohonanEBantuanSenaraiSemak();
        
        $model->permohonan_e_bantuan_id = $permohonan_id;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            
            $file = UploadedFile::getInstance($model, 'kertas_kerja_projek_program');
            $filename = $model->senarai_semak_id . "-kertas_kerja_projek_program";
            if($file){
                $model->kertas_kerja_projek_program = Upload::uploadFile($file, Upload::eBantuanFolder, $filename, Upload::eBantuanSenaraiSemakSubFolder);
            }
            
            $file = UploadedFile::getInstance($model, 'salinan_sijil_pendaftaran_persatuan_pertubuhan');
            $filename = $model->senarai_semak_id . "-salinan_sijil_pendaftaran_persatuan_pertubuhan";
            if($file){
                $model->salinan_sijil_pendaftaran_persatuan_pertubuhan = Upload::uploadFile($file, Upload::eBantuanFolder, $filename, Upload::eBantuanSenaraiSemakSubFolder);
            }
            
            $file = UploadedFile::getInstance($model, 'salinan_perlembagaan_persatuan_pertubuhan');
            $filename = $model->senarai_semak_id . "-salinan_perlembagaan_persatuan_pertubuhan";
            if($file){
                $model->salinan_perlembagaan_persatuan_pertubuhan = Upload::uploadFile($file, Upload::eBantuanFolder, $filename, Upload::eBantuanSenaraiSemakSubFolder);
            }
            
            $file = UploadedFile::getInstance($model, 'salinan_buku_bank');
            $filename = $model->senarai_semak_id . "-salinan_buku_bank";
            if($file){
                $model->salinan_buku_bank = Upload::uploadFile($file, Upload::eBantuanFolder, $filename, Upload::eBantuanSenaraiSemakSubFolder);
            }
            
            return $model->save();
            /*if($model->save()){
                return $this->redirect(['view', 'id' => $model->senarai_semak_id]);
            }*/
        } else {
            return $this->renderAjax('create', [
                'model' => $model,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Updates an existing PermohonanEBantuanSenaraiSemak model.
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
        $existingKertasKerjaProjekProgram = $model->kertas_kerja_projek_program;
        $existingSalinanSijilPendaftaranPersatuanPertubuhan = $model->salinan_sijil_pendaftaran_persatuan_pertubuhan;
        $existingSalinanPerlembagaanPersatuanPertubuhan = $model->salinan_perlembagaan_persatuan_pertubuhan;
        $existingSalinanBukuBank = $model->salinan_buku_bank;
        
        if($model->load(Yii::$app->request->post())){
            $file = UploadedFile::getInstance($model, 'kertas_kerja_projek_program');

            if($file){
                //valid file to upload
                //upload file to server
                
                // delete upload file
                /*if($existingKertasKerjaProjekProgram != ""){
                    self::actionDeleteupload($id, 'kertas_kerja_projek_program');
                }
                
                $filename = $model->senarai_semak_id . "-kertas_kerja_projek_program";
                $model->kertas_kerja_projek_program = Upload::uploadFile($file, Upload::eBantuanFolder, $filename, Upload::eBantuanSenaraiSemakSubFolder);*/
            } else {
                //invalid file to upload
                //remain existing file
                $model->kertas_kerja_projek_program = $existingKertasKerjaProjekProgram;
            }
            
            $file = UploadedFile::getInstance($model, 'salinan_sijil_pendaftaran_persatuan_pertubuhan');

            if($file){
                //valid file to upload
                //upload file to server
                
                // delete upload file
                /*if($existingSalinanSijilPendaftaranPersatuanPertubuhan != ""){
                    self::actionDeleteupload($id, 'salinan_sijil_pendaftaran_persatuan_pertubuhan');
                }
                
                $filename = $model->senarai_semak_id . "-salinan_sijil_pendaftaran_persatuan_pertubuhan";
                $model->salinan_sijil_pendaftaran_persatuan_pertubuhan = Upload::uploadFile($file, Upload::eBantuanFolder, $filename, Upload::eBantuanSenaraiSemakSubFolder);*/
            } else {
                //invalid file to upload
                //remain existing file
                $model->salinan_sijil_pendaftaran_persatuan_pertubuhan = $existingSalinanSijilPendaftaranPersatuanPertubuhan;
            }
            
            $file = UploadedFile::getInstance($model, 'salinan_perlembagaan_persatuan_pertubuhan');

            if($file){
                //valid file to upload
                //upload file to server
                
                // delete upload file
                /*if($existingSalinanPerlembagaanPersatuanPertubuhan != ""){
                    self::actionDeleteupload($id, 'salinan_perlembagaan_persatuan_pertubuhan');
                }
                
                $filename = $model->senarai_semak_id . "-salinan_perlembagaan_persatuan_pertubuhan";
                $model->salinan_perlembagaan_persatuan_pertubuhan = Upload::uploadFile($file, Upload::eBantuanFolder, $filename, Upload::eBantuanSenaraiSemakSubFolder);*/
            } else {
                //invalid file to upload
                //remain existing file
                $model->salinan_perlembagaan_persatuan_pertubuhan = $existingSalinanPerlembagaanPersatuanPertubuhan;
            }
            
            $file = UploadedFile::getInstance($model, 'salinan_buku_bank');

            if($file){
                //valid file to upload
                //upload file to server
                
                // delete upload file
                /*if($existingSalinanBukuBank != ""){
                    self::actionDeleteupload($id, 'salinan_buku_bank');
                }
                
                $filename = $model->senarai_semak_id . "-salinan_buku_bank";
                $model->salinan_buku_bank = Upload::uploadFile($file, Upload::eBantuanFolder, $filename, Upload::eBantuanSenaraiSemakSubFolder);*/
            } else {
                //invalid file to upload
                //remain existing file
                $model->salinan_buku_bank = $existingSalinanBukuBank;
            }
        }

        if (Yii::$app->request->post() && $model->save()) {
            $file = UploadedFile::getInstance($model, 'kertas_kerja_projek_program');
            $filename = $model->senarai_semak_id . "-kertas_kerja_projek_program";
            if($file){
                $model->kertas_kerja_projek_program = Upload::uploadFile($file, Upload::eBantuanFolder, $filename, Upload::eBantuanSenaraiSemakSubFolder);
            }
            
            $file = UploadedFile::getInstance($model, 'salinan_sijil_pendaftaran_persatuan_pertubuhan');
            $filename = $model->senarai_semak_id . "-salinan_sijil_pendaftaran_persatuan_pertubuhan";
            if($file){
                $model->salinan_sijil_pendaftaran_persatuan_pertubuhan = Upload::uploadFile($file, Upload::eBantuanFolder, $filename, Upload::eBantuanSenaraiSemakSubFolder);
            }
            
            $file = UploadedFile::getInstance($model, 'salinan_perlembagaan_persatuan_pertubuhan');
            $filename = $model->senarai_semak_id . "-salinan_perlembagaan_persatuan_pertubuhan";
            if($file){
                $model->salinan_perlembagaan_persatuan_pertubuhan = Upload::uploadFile($file, Upload::eBantuanFolder, $filename, Upload::eBantuanSenaraiSemakSubFolder);
            }
            
            $file = UploadedFile::getInstance($model, 'salinan_buku_bank');
            $filename = $model->senarai_semak_id . "-salinan_buku_bank";
            if($file){
                $model->salinan_buku_bank = Upload::uploadFile($file, Upload::eBantuanFolder, $filename, Upload::eBantuanSenaraiSemakSubFolder);
            }
            
            //return $this->renderAjax(['view', 'id' => $model->senarai_semak_id]);
            if($model->save()){
                return '1';
            }
        }
        
        return $this->renderAjax('update', [
                'model' => $model,
                'readonly' => false,
            ]);
    }

    /**
     * Deletes an existing PermohonanEBantuanSenaraiSemak model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        self::actionDeleteupload($id, 'kertas_kerja_projek_program');
        self::actionDeleteupload($id, 'salinan_sijil_pendaftaran_persatuan_pertubuhan');
        self::actionDeleteupload($id, 'salinan_perlembagaan_persatuan_pertubuhan');
        self::actionDeleteupload($id, 'salinan_buku_bank');
        
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the PermohonanEBantuanSenaraiSemak model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PermohonanEBantuanSenaraiSemak the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PermohonanEBantuanSenaraiSemak::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    // Add function for delete image or file
    public function actionDeleteupload($id, $field)
    {
            $img = $this->findModel($id)->$field;
            
            if($img){
                if (!unlink($img)) {
                    return false;
                }
            }

            $img = $this->findModel($id);
            $img->$field = NULL;
            $img->update();

            //return $this->redirect(['update', 'id' => $id]);
    }
}
