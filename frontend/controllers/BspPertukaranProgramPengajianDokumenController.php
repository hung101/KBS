<?php

namespace frontend\controllers;

use Yii;
use app\models\BspPertukaranProgramPengajianDokumen;
use frontend\models\BspPertukaranProgramPengajianDokumenSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

use app\models\general\Upload;
use app\models\general\GeneralVariable;

/**
 * BspPertukaranProgramPengajianDokumenController implements the CRUD actions for BspPertukaranProgramPengajianDokumen model.
 */
class BspPertukaranProgramPengajianDokumenController extends Controller
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
     * Lists all BspPertukaranProgramPengajianDokumen models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $searchModel = new BspPertukaranProgramPengajianDokumenSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single BspPertukaranProgramPengajianDokumen model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        return $this->renderAjax('view', [
            'model' => $this->findModel($id),
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new BspPertukaranProgramPengajianDokumen model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($bsp_pertukaran_program_pengajian_id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new BspPertukaranProgramPengajianDokumen();
        
        if($bsp_pertukaran_program_pengajian_id != ''){
            $model->bsp_pertukaran_program_pengajian_id = $bsp_pertukaran_program_pengajian_id;
        } else {
            if(isset(Yii::$app->session->id)){
                $model->session_id = Yii::$app->session->id;
            }
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $file = UploadedFile::getInstance($model, 'upload');
            if($file){
                $model->upload = Upload::uploadFile($file, Upload::bspPertukaranProgramPengajianDokumenFolder, $model->bsp_pertukaran_program_pengajian_dokumen_id);
            }
            
            if($model->save()){
                return '1';
            }
        } 
        
        return $this->renderAjax('create', [
                'model' => $model,
                'readonly' => false,
            ]);
    }

    /**
     * Updates an existing BspPertukaranProgramPengajianDokumen model.
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
        $existingUpload = $model->upload;
        
        if($model->load(Yii::$app->request->post())){
            $file = UploadedFile::getInstance($model, 'upload');

            if($file){
                //valid file to upload
                //upload file to server
                
                // delete upload file
                /*if($existingUpload != ""){
                    self::actionDeleteupload($id, 'upload');
                }
                
                $model->upload = Upload::uploadFile($file, Upload::bspPertukaranProgramPengajianDokumenFolder, $model->bsp_pertukaran_program_pengajian_dokumen_id);*/
            } else {
                //invalid file to upload
                //remain existing file
                $model->upload = $existingUpload;
            }
        }

        if (Yii::$app->request->post() && $model->save()) {
            $file = UploadedFile::getInstance($model, 'upload');
            if($file){
                $model->upload = Upload::uploadFile($file, Upload::bspPertukaranProgramPengajianDokumenFolder, $model->bsp_pertukaran_program_pengajian_dokumen_id);
            }
            
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
     * Deletes an existing BspPertukaranProgramPengajianDokumen model.
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

        //return $this->redirect(['index']);
    }

    /**
     * Finds the BspPertukaranProgramPengajianDokumen model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return BspPertukaranProgramPengajianDokumen the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = BspPertukaranProgramPengajianDokumen::findOne($id)) !== null) {
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
