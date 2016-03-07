<?php

namespace frontend\controllers;

use Yii;
use app\models\LtbsMinitMesyuaratJawatankuasaDokumenMuatNaik;
use frontend\models\LtbsMinitMesyuaratJawatankuasaDokumenMuatNaikSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

use app\models\general\Upload;

/**
 * LtbsMinitMesyuaratJawatankuasaDokumenMuatNaikController implements the CRUD actions for LtbsMinitMesyuaratJawatankuasaDokumenMuatNaik model.
 */
class LtbsMinitMesyuaratJawatankuasaDokumenMuatNaikController extends Controller
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
     * Lists all LtbsMinitMesyuaratJawatankuasaDokumenMuatNaik models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new LtbsMinitMesyuaratJawatankuasaDokumenMuatNaikSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single LtbsMinitMesyuaratJawatankuasaDokumenMuatNaik model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->renderAjax('view', [
            'model' => $this->findModel($id),
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new LtbsMinitMesyuaratJawatankuasaDokumenMuatNaik model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($mesyuarat_id)
    {
        $model = new LtbsMinitMesyuaratJawatankuasaDokumenMuatNaik();
        
        Yii::$app->session->open();
        
        if($mesyuarat_id != ''){
            $model->mesyuarat_id = $mesyuarat_id;
        } else {
            if(isset(Yii::$app->session->id)){
                $model->session_id = Yii::$app->session->id;
            }
        }
        
        if($model->load(Yii::$app->request->post())){
            $file = UploadedFile::getInstance($model, 'muat_naik');

            if($file){
                $model->muat_naik = "uploadlater";
            }
        }

        if (Yii::$app->request->post()&& $model->save()) {
            
            $file = UploadedFile::getInstance($model, 'muat_naik');
            if($file){
                $model->muat_naik = Upload::uploadFile($file, Upload::ltbsMesyuaratFolder, $model->dokumen_muat_naik_id, Upload::ltbsMesyuaratMuatNaikJawatankuasaSubFolder);
            }
            
            /*if($model->save()){
                return $this->redirect(['view', 'id' => $model->dokumen_muat_naik_id]);
            }*/
            
            return $model->save();
        } else {
            return $this->renderAjax('create', [
                'model' => $model,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Updates an existing LtbsMinitMesyuaratJawatankuasaDokumenMuatNaik model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $existingMuatNaik = $model->muat_naik;
        
        if($model->load(Yii::$app->request->post())){
            $file = UploadedFile::getInstance($model, 'muat_naik');

            if($file){
                //valid file to upload
                //upload file to server
                $model->muat_naik = Upload::uploadFile($file, Upload::ltbsMesyuaratFolder, $id, Upload::ltbsMesyuaratMuatNaikJawatankuasaSubFolder);
            } else {
                //invalid file to upload
                //remain existing file
                $model->muat_naik = $existingMuatNaik;
            }
        }

        if (Yii::$app->request->post() && $model->save()) {
            $file = UploadedFile::getInstance($model, 'muat_naik');
            if($file){
                $model->muat_naik = Upload::uploadFile($file, Upload::ltbsMesyuaratFolder, $id, Upload::ltbsMesyuaratMuatNaikJawatankuasaSubFolder);
            }
            
            /*if($model->save()){
                return $this->redirect(['view', 'id' => $model->dokumen_muat_naik_id]);
            }*/
            return $model->save();
        } else {
            return $this->renderAjax('update', [
                'model' => $model,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Deletes an existing LtbsMinitMesyuaratJawatankuasaDokumenMuatNaik model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        //return $this->redirect(['index']);
    }

    /**
     * Finds the LtbsMinitMesyuaratJawatankuasaDokumenMuatNaik model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return LtbsMinitMesyuaratJawatankuasaDokumenMuatNaik the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = LtbsMinitMesyuaratJawatankuasaDokumenMuatNaik::findOne($id)) !== null) {
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
            //return self::actionUpdate($id);
    }
}
