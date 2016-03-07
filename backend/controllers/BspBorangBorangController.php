<?php

namespace backend\controllers;

use Yii;
use app\models\BspPrestasiAkademik;
use backend\models\BspPrestasiAkademikSearch;
use app\models\BspBorangBorang;
use backend\models\BspBorangBorangSearch;
use app\models\BspBorang10;
use backend\models\BspBorang10Search;
use app\models\BspBorang11;
use backend\models\BspBorang11Search;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

use app\models\general\Upload;
use app\models\general\GeneralVariable;

/**
 * BspBorangBorangController implements the CRUD actions for BspBorangBorang model.
 */
class BspBorangBorangController extends Controller
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
     * Lists all BspBorangBorang models.
     * @return mixed
     */
    public function actionIndex($bsp_pemohon_id)
    {
        if($bsp_pemohon_id != ""){
            if (Yii::$app->user->isGuest) {
                return $this->redirect(array(GeneralVariable::loginPagePath));
            }

            $queryPar = Yii::$app->request->queryParams;

            $queryPar['BspPrestasiAkademikSearch']['bsp_pemohon_id'] = $bsp_pemohon_id;
            
            $searchModel = new BspBorangBorangSearch();
            $dataProvider = $searchModel->search($queryPar);

            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                'bsp_pemohon_id' => $bsp_pemohon_id,
            ]);
        }
    }

    /**
     * Displays a single BspBorangBorang model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $queryPar = null;
        
        $queryPar['BspPrestasiAkademikSearch']['bsp_borang_borang_id'] = $id;
        $queryPar['BspBorang10Search']['bsp_borang_borang_id'] = $id;
        $queryPar['BspBorang11Search']['bsp_borang_borang_id'] = $id;
        
        $searchModelBspPrestasiAkademik = new BspPrestasiAkademikSearch();
        $dataProviderBspPrestasiAkademik = $searchModelBspPrestasiAkademik->search($queryPar);
        
        $searchModelBspBorang10= new BspBorang10Search();
        $dataProviderBspBorang10 = $searchModelBspBorang10->search($queryPar);
        
        $searchModelBspBorang11= new BspBorang11Search();
        $dataProviderBspBorang11 = $searchModelBspBorang11->search($queryPar);
      
        return $this->render('view', [
            'model' => $this->findModel($id),
            'searchModelBspPrestasiAkademik' => $searchModelBspPrestasiAkademik,
            'dataProviderBspPrestasiAkademik' => $dataProviderBspPrestasiAkademik,
            'searchModelBspBorang10' => $searchModelBspBorang10,
            'dataProviderBspBorang10' => $dataProviderBspBorang10,
            'searchModelBspBorang11' => $searchModelBspBorang11,
            'dataProviderBspBorang11' => $dataProviderBspBorang11,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new BspBorangBorang model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($bsp_pemohon_id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new BspBorangBorang();
        
        $queryPar = null;
        
        Yii::$app->session->open();
        
        if(isset(Yii::$app->session->id)){
            $queryPar['BspPrestasiAkademikSearch']['session_id'] = Yii::$app->session->id;
            $queryPar['BspBorang10Search']['session_id'] = Yii::$app->session->id;
            $queryPar['BspBorang11Search']['session_id'] = Yii::$app->session->id;
        }
        
        $searchModelBspPrestasiAkademik = new BspPrestasiAkademikSearch();
        $dataProviderBspPrestasiAkademik = $searchModelBspPrestasiAkademik->search($queryPar);
        
        $searchModelBspBorang10= new BspBorang10Search();
        $dataProviderBspBorang10 = $searchModelBspBorang10->search($queryPar);
        
        $searchModelBspBorang11= new BspBorang11Search();
        $dataProviderBspBorang11 = $searchModelBspBorang11->search($queryPar);
        
        $model->bsp_pemohon_id = $bsp_pemohon_id;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $file = UploadedFile::getInstance($model, 'bsp_01');
            $filename = $model->bsp_borang_borang_id . "-bsp_01";
            if($file){
                $model->bsp_01 = Upload::uploadFile($file, Upload::bspBorangBorang, $filename);
            }
            
            $file = UploadedFile::getInstance($model, 'bsp_02');
            $filename = $model->bsp_borang_borang_id . "-bsp_02";
            if($file){
                $model->bsp_02 = Upload::uploadFile($file, Upload::bspBorangBorang, $filename);
            }
            
            $file = UploadedFile::getInstance($model, 'bsp_03');
            $filename = $model->bsp_borang_borang_id . "-bsp_03";
            if($file){
                $model->bsp_03 = Upload::uploadFile($file, Upload::bspBorangBorang, $filename);
            }
            
            $file = UploadedFile::getInstance($model, 'bsp_04');
            $filename = $model->bsp_borang_borang_id . "-bsp_04";
            if($file){
                $model->bsp_04 = Upload::uploadFile($file, Upload::bspBorangBorang, $filename);
            }
            
            $file = UploadedFile::getInstance($model, 'bsp_05');
            $filename = $model->bsp_borang_borang_id . "-bsp_05";
            if($file){
                $model->bsp_05 = Upload::uploadFile($file, Upload::bspBorangBorang, $filename);
            }
            
            $file = UploadedFile::getInstance($model, 'bsp_07');
            $filename = $model->bsp_borang_borang_id . "-bsp_07";
            if($file){
                $model->bsp_07 = Upload::uploadFile($file, Upload::bspBorangBorang, $filename);
            }
            
            $file = UploadedFile::getInstance($model, 'bsp_08');
            $filename = $model->bsp_borang_borang_id . "-bsp_08";
            if($file){
                $model->bsp_08 = Upload::uploadFile($file, Upload::bspBorangBorang, $filename);
            }
            
            $file = UploadedFile::getInstance($model, 'bsp_09');
            $filename = $model->bsp_borang_borang_id . "-bsp_09";
            if($file){
                $model->bsp_09 = Upload::uploadFile($file, Upload::bspBorangBorang, $filename);
            }
            
            $file = UploadedFile::getInstance($model, 'bsp_12');
            $filename = $model->bsp_borang_borang_id . "-bsp_12";
            if($file){
                $model->bsp_12 = Upload::uploadFile($file, Upload::bspBorangBorang, $filename);
            }
            
            $file = UploadedFile::getInstance($model, 'bsp_13');
            $filename = $model->bsp_borang_borang_id . "-bsp_13";
            if($file){
                $model->bsp_13 = Upload::uploadFile($file, Upload::bspBorangBorang, $filename);
            }
            
            $file = UploadedFile::getInstance($model, 'bsp_14');
            $filename = $model->bsp_borang_borang_id . "-bsp_14";
            if($file){
                $model->bsp_14 = Upload::uploadFile($file, Upload::bspBorangBorang, $filename);
            }
            
            if(isset(Yii::$app->session->id)){
                BspPrestasiAkademik::updateAll(['bsp_borang_borang_id' => $model->bsp_borang_borang_id], 'session_id = "'.Yii::$app->session->id.'"');
                BspPrestasiAkademik::updateAll(['session_id' => ''], 'bsp_borang_borang_id = "'.$model->bsp_borang_borang_id.'"');
                
                BspBorang10::updateAll(['bsp_borang_borang_id' => $model->bsp_borang_borang_id], 'session_id = "'.Yii::$app->session->id.'"');
                BspBorang10::updateAll(['session_id' => ''], 'bsp_borang_borang_id = "'.$model->bsp_borang_borang_id.'"');
                
                BspBorang11::updateAll(['bsp_borang_borang_id' => $model->bsp_borang_borang_id], 'session_id = "'.Yii::$app->session->id.'"');
                BspBorang11::updateAll(['session_id' => ''], 'bsp_borang_borang_id = "'.$model->bsp_borang_borang_id.'"');
            }
            
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->bsp_borang_borang_id]);
            }
        } 
        
        return $this->render('create', [
            'model' => $model,
            'readonly' => false,
            'searchModelBspPrestasiAkademik' => $searchModelBspPrestasiAkademik,
            'dataProviderBspPrestasiAkademik' => $dataProviderBspPrestasiAkademik,
            'searchModelBspBorang10' => $searchModelBspBorang10,
            'dataProviderBspBorang10' => $dataProviderBspBorang10,
            'searchModelBspBorang11' => $searchModelBspBorang11,
            'dataProviderBspBorang11' => $dataProviderBspBorang11,
            'bsp_pemohon_id' => $bsp_pemohon_id,
        ]);
    }
    
    /**
     * Creates a new BspBorangBorang model.
     * If record exist, then update else create.
     * @return mixed
     */
    public function actionLoad($bsp_pemohon_id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        if (($model = BspBorangBorang::findOne(['bsp_pemohon_id' => $bsp_pemohon_id])) !== null) {
            return self::actionUpdate($model->bsp_borang_borang_id);
        } else {
            return self::actionCreate($bsp_pemohon_id);
        }
    }

    /**
     * Updates an existing BspBorangBorang model.
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
        
        $queryPar['BspPrestasiAkademikSearch']['bsp_borang_borang_id'] = $id;
        $queryPar['BspBorang10Search']['bsp_borang_borang_id'] = $id;
        $queryPar['BspBorang11Search']['bsp_borang_borang_id'] = $id;
        
        $searchModelBspPrestasiAkademik = new BspPrestasiAkademikSearch();
        $dataProviderBspPrestasiAkademik = $searchModelBspPrestasiAkademik->search($queryPar);
        
        $searchModelBspBorang10= new BspBorang10Search();
        $dataProviderBspBorang10 = $searchModelBspBorang10->search($queryPar);
        
        $searchModelBspBorang11= new BspBorang11Search();
        $dataProviderBspBorang11 = $searchModelBspBorang11->search($queryPar);
        
        $existingBSP03 = $model->bsp_03;
        $existingBSP04 = $model->bsp_04;
        $existingBSP05 = $model->bsp_05;
        
        if($model->load(Yii::$app->request->post())){
            $file = UploadedFile::getInstance($model, 'bsp_03');

            if($file){
                //valid file to upload
                //upload file to server
                
                // delete upload file
                if($existingBSP03 != ""){
                    self::actionDeleteupload($id, 'bsp_03');
                }
                
                $filename = $model->bsp_borang_borang_id . "-bsp_03";
                $model->bsp_03 = Upload::uploadFile($file, Upload::bspBorangBorang, $filename);
            } else {
                //invalid file to upload
                //remain existing file
                $model->bsp_03 = $existingBSP03;
            }
            
            $file = UploadedFile::getInstance($model, 'bsp_04');

            if($file){
                //valid file to upload
                //upload file to server
                
                // delete upload file
                if($existingBSP04 != ""){
                    self::actionDeleteupload($id, 'bsp_04');
                }
                
                $filename = $model->bsp_borang_borang_id . "-bsp_04";
                $model->bsp_04 = Upload::uploadFile($file, Upload::bspBorangBorang, $filename);
            } else {
                //invalid file to upload
                //remain existing file
                $model->bsp_04 = $existingBSP04;
            }
            
            $file = UploadedFile::getInstance($model, 'bsp_05');

            if($file){
                //valid file to upload
                //upload file to server
                
                // delete upload file
                if($existingBSP05 != ""){
                    self::actionDeleteupload($id, 'bsp_05');
                }
                
                $filename = $model->bsp_borang_borang_id . "-bsp_05";
                $model->bsp_05 = Upload::uploadFile($file, Upload::bspBorangBorang, $filename);
            } else {
                //invalid file to upload
                //remain existing file
                $model->bsp_05 = $existingBSP05;
            }
        }

        if (Yii::$app->request->post() && $model->save()) {
            $file = UploadedFile::getInstance($model, 'bsp_01');
            $filename = $model->bsp_borang_borang_id . "-bsp_01";
            if($file){
                $model->bsp_01 = Upload::uploadFile($file, Upload::bspBorangBorang, $filename);
            }
            
            $file = UploadedFile::getInstance($model, 'bsp_02');
            $filename = $model->bsp_borang_borang_id . "-bsp_02";
            if($file){
                $model->bsp_02 = Upload::uploadFile($file, Upload::bspBorangBorang, $filename);
            }
            
            $file = UploadedFile::getInstance($model, 'bsp_07');
            $filename = $model->bsp_borang_borang_id . "-bsp_07";
            if($file){
                $model->bsp_07 = Upload::uploadFile($file, Upload::bspBorangBorang, $filename);
            }
            
            $file = UploadedFile::getInstance($model, 'bsp_08');
            $filename = $model->bsp_borang_borang_id . "-bsp_08";
            if($file){
                $model->bsp_08 = Upload::uploadFile($file, Upload::bspBorangBorang, $filename);
            }
            
            $file = UploadedFile::getInstance($model, 'bsp_09');
            $filename = $model->bsp_borang_borang_id . "-bsp_09";
            if($file){
                $model->bsp_09 = Upload::uploadFile($file, Upload::bspBorangBorang, $filename);
            }
            
            $file = UploadedFile::getInstance($model, 'bsp_12');
            $filename = $model->bsp_borang_borang_id . "-bsp_12";
            if($file){
                $model->bsp_12 = Upload::uploadFile($file, Upload::bspBorangBorang, $filename);
            }
            
            $file = UploadedFile::getInstance($model, 'bsp_13');
            $filename = $model->bsp_borang_borang_id . "-bsp_13";
            if($file){
                $model->bsp_13 = Upload::uploadFile($file, Upload::bspBorangBorang, $filename);
            }
            
            $file = UploadedFile::getInstance($model, 'bsp_14');
            $filename = $model->bsp_borang_borang_id . "-bsp_14";
            if($file){
                $model->bsp_14 = Upload::uploadFile($file, Upload::bspBorangBorang, $filename);
            }
            
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->bsp_borang_borang_id]);
            }
        }
        
        return $this->render('update', [
            'model' => $model,
            'searchModelBspPrestasiAkademik' => $searchModelBspPrestasiAkademik,
            'dataProviderBspPrestasiAkademik' => $dataProviderBspPrestasiAkademik,
            'searchModelBspBorang10' => $searchModelBspBorang10,
            'dataProviderBspBorang10' => $dataProviderBspBorang10,
            'searchModelBspBorang11' => $searchModelBspBorang11,
            'dataProviderBspBorang11' => $dataProviderBspBorang11,
            'readonly' => false,
        ]);
    }

    /**
     * Deletes an existing BspBorangBorang model.
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

        return $this->redirect(['index']);
    }

    /**
     * Finds the BspBorangBorang model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return BspBorangBorang the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = BspBorangBorang::findOne($id)) !== null) {
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
