<?php

namespace backend\controllers;

use Yii;
use app\models\ElaporanPelaksanaanGambar;
use backend\models\ElaporanPelaksanaanGambarSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

use app\models\general\Upload;

/**
 * ElaporanPelaksanaanGambarController implements the CRUD actions for ElaporanPelaksanaanGambar model.
 */
class ElaporanPelaksanaanGambarController extends Controller
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
     * Lists all ElaporanPelaksanaanGambar models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ElaporanPelaksanaanGambarSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ElaporanPelaksanaanGambar model.
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
     * Creates a new ElaporanPelaksanaanGambar model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($elaporan_pelaksaan_id)
    {
        $model = new ElaporanPelaksanaanGambar();
        
        Yii::$app->session->open();
        
        if($elaporan_pelaksaan_id != ''){
            $model->elaporan_pelaksaan_id = $elaporan_pelaksaan_id;
        } else {
            if(isset(Yii::$app->session->id)){
                $model->session_id = Yii::$app->session->id;
            }
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            
            $file = UploadedFile::getInstance($model, 'muat_naik_gambar');
            $filename = $model->elaporan_pelaksanaan_gambar_id;
            if($file){
                $model->muat_naik_gambar = Upload::uploadFile($file, Upload::eLaporanFolder, $filename, Upload::eLaporanGambarSubFolder);
            }
            
            return $model->save();
            //return $this->redirect(['view', 'id' => $model->elaporan_pelaksanaan_gambar_id]);
        } else {
            return $this->renderAjax('create', [
                'model' => $model,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Updates an existing ElaporanPelaksanaanGambar model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $existingMuatNaikGambar = $model->muat_naik_gambar;
        
        if($model->load(Yii::$app->request->post())){
            $file = UploadedFile::getInstance($model, 'muat_naik_gambar');

            if($file){
                //valid file to upload
                //upload file to server
                /*$filename = $model->elaporan_pelaksanaan_gambar_id;
                $model->muat_naik_gambar = Upload::uploadFile($file, Upload::eLaporanFolder, $filename, Upload::eLaporanGambarSubFolder);*/
            } else {
                //invalid file to upload
                //remain existing file
                $model->muat_naik_gambar = $existingMuatNaikGambar;
            }
        }

        if (Yii::$app->request->post() && $model->save()) {
            $file = UploadedFile::getInstance($model, 'muat_naik_gambar');
            $filename = $model->elaporan_pelaksanaan_gambar_id;
            if($file){
                $model->muat_naik_gambar = Upload::uploadFile($file, Upload::eLaporanFolder, $filename, Upload::eLaporanGambarSubFolder);
            }
            
            if($model->save()){
                return '1';
                //return $this->redirect(['view', 'id' => $model->elaporan_pelaksanaan_gambar_id]);
            }
        } 
        
        return $this->renderAjax('update', [
                'model' => $model,
                'readonly' => false,
            ]);
    }

    /**
     * Deletes an existing ElaporanPelaksanaanGambar model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        // delete image file
        self::actionDeleteimg($id, 'muat_naik_gambar');
        
        $this->findModel($id)->delete();

        //return $this->redirect(['index']);
    }

    /**
     * Finds the ElaporanPelaksanaanGambar model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ElaporanPelaksanaanGambar the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ElaporanPelaksanaanGambar::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    // Add function for delete image or file
    public function actionDeleteimg($id, $field)
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
