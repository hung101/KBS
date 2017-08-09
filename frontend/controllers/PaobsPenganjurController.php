<?php

namespace frontend\controllers;

use Yii;
use app\models\PaobsPenganjur;
use app\models\PaobsPenganjurSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

use app\models\general\Upload;
use app\models\general\GeneralVariable;

// table reference
use app\models\RefSukan;
use app\models\RefBandar;
use app\models\RefNegeri;

/**
 * PaobsPenganjurController implements the CRUD actions for PaobsPenganjur model.
 */
class PaobsPenganjurController extends Controller
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
     * Lists all PaobsPenganjur models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $searchModel = new PaobsPenganjurSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PaobsPenganjur model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = $this->findModel($id);
        
        $ref = RefSukan::findOne(['id' => $model->jenis_sukan]);
        $model->jenis_sukan = $ref['desc'];
        
        $ref = RefNegeri::findOne(['id' => $model->alamat_penganjur_negeri]);
        $model->alamat_penganjur_negeri = $ref['desc'];
        
        $ref = RefBandar::findOne(['id' => $model->alamat_penganjur_bandar]);
        $model->alamat_penganjur_bandar = $ref['desc'];
        
        return $this->render('view', [
            'model' => $model,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new PaobsPenganjur model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new PaobsPenganjur();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $file = UploadedFile::getInstance($model, 'sijil_pendaftaran');
            if($file){
                $model->sijil_pendaftaran = Upload::uploadFile($file, Upload::paobsPenganjurFolder, 'sijil_pendaftaran_' . $model->penganjur_id);
            }
            
            $file = UploadedFile::getInstance($model, 'kertas_cadangan_pelaksanaan');
            if($file){
                $model->kertas_cadangan_pelaksanaan = Upload::uploadFile($file, Upload::paobsPenganjurFolder, 'kertas_cadangan_pelaksanaan_' . $model->penganjur_id);
            }
            
            $file = UploadedFile::getInstance($model, 'surat_sokongan');
            if($file){
                $model->surat_sokongan = Upload::uploadFile($file, Upload::paobsPenganjurFolder, 'surat_sokongan_' . $model->penganjur_id);
            }
            
            $file = UploadedFile::getInstance($model, 'laporan_penganjuran');
            if($file){
                $model->laporan_penganjuran = Upload::uploadFile($file, Upload::paobsPenganjurFolder, 'laporan_penganjuran_' . $model->penganjur_id);
            }
            
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->penganjur_id]);
            }
        } 
        
        return $this->render('create', [
                'model' => $model,
                'readonly' => false,
            ]);
    }

    /**
     * Updates an existing PaobsPenganjur model.
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

        $existingSijilPendaftaran = $model->sijil_pendaftaran;
        
        if($model->load(Yii::$app->request->post())){
            $file = UploadedFile::getInstance($model, 'sijil_pendaftaran');

            if($file){
                //valid file to upload
                //upload file to server
                /*$filename = $model->penganjur_id . '_sijil_pendaftaran';
                $model->sijil_pendaftaran = Upload::uploadFile($file, Upload::paobsPenganjurFolder, $filename);*/
            } else {
                //invalid file to upload
                //remain existing file
                $model->sijil_pendaftaran = $existingSijilPendaftaran;
            }
        }

        if (Yii::$app->request->post() && $model->save()) {
            $file = UploadedFile::getInstance($model, 'sijil_pendaftaran');
            if($file){
                $model->sijil_pendaftaran = Upload::uploadFile($file, Upload::paobsPenganjurFolder, 'sijil_pendaftaran_' . $model->penganjur_id);
            }
            
            $file = UploadedFile::getInstance($model, 'kertas_cadangan_pelaksanaan');
            if($file){
                $model->kertas_cadangan_pelaksanaan = Upload::uploadFile($file, Upload::paobsPenganjurFolder, 'kertas_cadangan_pelaksanaan_' . $model->penganjur_id);
            }
            
            $file = UploadedFile::getInstance($model, 'surat_sokongan');
            if($file){
                $model->surat_sokongan = Upload::uploadFile($file, Upload::paobsPenganjurFolder, 'surat_sokongan_' . $model->penganjur_id);
            }
            
            $file = UploadedFile::getInstance($model, 'laporan_penganjuran');
            if($file){
                $model->laporan_penganjuran = Upload::uploadFile($file, Upload::paobsPenganjurFolder, 'laporan_penganjuran_' . $model->penganjur_id);
            }
            
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->penganjur_id]);
            }
        } 
        
        return $this->render('update', [
                'model' => $model,
                'readonly' => false,
            ]);
    }

    /**
     * Deletes an existing PaobsPenganjur model.
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
        self::actionDeleteupload($id, 'sijil_pendaftaran');
        
        // delete upload file
        self::actionDeleteupload($id, 'kertas_cadangan_pelaksanaan');
        
        // delete upload file
        self::actionDeleteupload($id, 'surat_sokongan');
        
        // delete upload file
        self::actionDeleteupload($id, 'laporan_penganjuran');
        
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the PaobsPenganjur model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PaobsPenganjur the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PaobsPenganjur::findOne($id)) !== null) {
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

            return $this->redirect(['update', 'id' => $id]);
    }
}
