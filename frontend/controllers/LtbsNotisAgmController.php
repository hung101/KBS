<?php

namespace frontend\controllers;

use Yii;
use app\models\LtbsNotisAgm;
use app\models\LtbsNotisAgmSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

use app\models\general\Upload;

/**
 * LtbsNotisAgmController implements the CRUD actions for LtbsNotisAgm model.
 */
class LtbsNotisAgmController extends Controller
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
     * Lists all LtbsNotisAgm models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new LtbsNotisAgmSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single LtbsNotisAgm model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->renderAjax('view', [
            'model' => $this->findModel($id),
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new LtbsNotisAgm model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($mesyuarat_id)
    {
        $model = new LtbsNotisAgm();
        
        /*if($model->load(Yii::$app->request->post())){
            $file = UploadedFile::getInstance($model, 'notis_agm');

            if($file){
                $model->notis_agm = "uploadlater";
            } else {
                $model->notis_agm = "";
            }
        }*/
        
        Yii::$app->session->open();
        
        if($mesyuarat_id != ''){
            $model->mesyuarat_id = $mesyuarat_id;
        } else {
            if(isset(Yii::$app->session->id)){
                $model->session_id = Yii::$app->session->id;
            }
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->save()) {
            
            $file = UploadedFile::getInstance($model, 'notis_agm');
            if($file){
                $model->notis_agm = Upload::uploadFile($file, Upload::ltbsMesyuaratFolder, $model->tbl_ltbs_id, Upload::ltbsNotisAGMSubFolder);
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
     * Updates an existing LtbsNotisAgm model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $existingNotisAGM = $model->notis_agm;
        
        if($model->load(Yii::$app->request->post())){
            $file = UploadedFile::getInstance($model, 'notis_agm');

            if($file){
                //valid file to upload
                //upload file to server
                $model->notis_agm = Upload::uploadFile($file, Upload::ltbsMesyuaratFolder, $model->tbl_ltbs_id, Upload::ltbsNotisAGMSubFolder);
            } else {
                //invalid file to upload
                //remain existing file
                $model->notis_agm = $existingNotisAGM;
            }
        }

        if (Yii::$app->request->post() && $model->save()) {
            $file = UploadedFile::getInstance($model, 'notis_agm');
            if($file){
                $model->notis_agm = Upload::uploadFile($file, Upload::ltbsMesyuaratFolder, $model->tbl_ltbs_id, Upload::ltbsNotisAGMSubFolder);
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
     * Deletes an existing LtbsNotisAgm model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        //return $this->redirect(['index']);
    }

    /**
     * Finds the LtbsNotisAgm model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return LtbsNotisAgm the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = LtbsNotisAgm::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
