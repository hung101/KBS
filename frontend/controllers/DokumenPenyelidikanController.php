<?php

namespace frontend\controllers;

use Yii;
use app\models\DokumenPenyelidikan;
use frontend\models\DokumenPenyelidikanSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

use app\models\general\Upload;
use app\models\general\GeneralVariable;

// table reference
use app\models\RefDokumenPenyelidikan;

/**
 * DokumenPenyelidikanController implements the CRUD actions for DokumenPenyelidikan model.
 */
class DokumenPenyelidikanController extends Controller
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
     * Lists all DokumenPenyelidikan models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $searchModel = new DokumenPenyelidikanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single DokumenPenyelidikan model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = $this->findModel($id);
        
        $ref = RefDokumenPenyelidikan::findOne(['id' => $model->nama_dokumen]);
        $model->nama_dokumen = $ref['desc'];
        
        return $this->renderAjax('view', [
            'model' => $model,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new DokumenPenyelidikan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($permohonana_penyelidikan_id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new DokumenPenyelidikan();
        
        Yii::$app->session->open();
        
        if($permohonana_penyelidikan_id != ''){
            $model->permohonana_penyelidikan_id = $permohonana_penyelidikan_id;
        } else {
            if(isset(Yii::$app->session->id)){
                $model->session_id = Yii::$app->session->id;
            }
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $file = UploadedFile::getInstance($model, 'muat_naik');
            if($file){
                $model->muat_naik = Upload::uploadFile($file, Upload::dokumenPenyelidikanFolder, $model->dokumen_penyelidikan_id);
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
     * Updates an existing DokumenPenyelidikan model.
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
        
        $existingMuatNaik = $model->muat_naik;
        
        if($model->load(Yii::$app->request->post())){
            $file = UploadedFile::getInstance($model, 'muat_naik');

            if($file){
                //valid file to upload
                //upload file to server
                
                // delete upload file
                if($existingMuatNaik != ""){
                    self::actionDeleteupload($id, 'muat_naik');
                }
                
                $model->muat_naik = Upload::uploadFile($file, Upload::dokumenPenyelidikanFolder, $model->dokumen_penyelidikan_id);
            } else {
                //invalid file to upload
                //remain existing file
                $model->muat_naik = $existingMuatNaik;
            }
        }

        if (Yii::$app->request->post() && $model->save()) {
            return '1';
        } else {
            return $this->renderAjax('update', [
                'model' => $model,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Deletes an existing DokumenPenyelidikan model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        self::actionDeleteupload($id, 'muat_naik');
        
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the DokumenPenyelidikan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return DokumenPenyelidikan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = DokumenPenyelidikan::findOne($id)) !== null) {
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
}
