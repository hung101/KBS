<?php

namespace frontend\controllers;

use Yii;
use app\models\BspPerlanjutanDokumen;
use frontend\models\BspPerlanjutanDokumenSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

use app\models\general\Upload;
use app\models\general\GeneralVariable;

/**
 * BspPerlanjutanDokumenController implements the CRUD actions for BspPerlanjutanDokumen model.
 */
class BspPerlanjutanDokumenController extends Controller
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
     * Lists all BspPerlanjutanDokumen models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $searchModel = new BspPerlanjutanDokumenSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single BspPerlanjutanDokumen model.
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
     * Creates a new BspPerlanjutanDokumen model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($bsp_perlanjutan_id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new BspPerlanjutanDokumen();
        
        if($bsp_perlanjutan_id != ''){
            $model->bsp_perlanjutan_id = $bsp_perlanjutan_id;
        } else {
            if(isset(Yii::$app->session->id)){
                $model->session_id = Yii::$app->session->id;
            }
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $file = UploadedFile::getInstance($model, 'upload');
            if($file){
                $model->upload = Upload::uploadFile($file, Upload::bspPerlanjutanDokumenFolder, $model->bsp_perlanjutan_dokumen_id);
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
     * Updates an existing BspPerlanjutanDokumen model.
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
                if($existingUpload != ""){
                    self::actionDeleteupload($id, 'upload');
                }
                
                $model->upload = Upload::uploadFile($file, Upload::bspPerlanjutanDokumenFolder, $model->bsp_perlanjutan_dokumen_id);
            } else {
                //invalid file to upload
                //remain existing file
                $model->upload = $existingUpload;
            }
        }

        if (Yii::$app->request->post()) {
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
     * Deletes an existing BspPerlanjutanDokumen model.
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
     * Finds the BspPerlanjutanDokumen model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return BspPerlanjutanDokumen the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = BspPerlanjutanDokumen::findOne($id)) !== null) {
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
