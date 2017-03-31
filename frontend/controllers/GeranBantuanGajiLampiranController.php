<?php

namespace frontend\controllers;

use Yii;
use app\models\GeranBantuanGajiLampiran;
use frontend\models\GeranBantuanGajiLampiranSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

use app\models\RefDokumenGeranBantuanGaji;

use app\models\general\Upload;
use app\models\general\GeneralVariable;

/**
 * GeranBantuanGajiLampiranController implements the CRUD actions for GeranBantuanGajiLampiran model.
 */
class GeranBantuanGajiLampiranController extends Controller
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
     * Lists all GeranBantuanGajiLampiran models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $searchModel = new GeranBantuanGajiLampiranSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single GeranBantuanGajiLampiran model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
		$model = $this->findModel($id);
		
		$ref = RefDokumenGeranBantuanGaji::findOne(['id' => $model->nama_dokumen]);
		$model->nama_dokumen = $ref['desc'];
		
        return $this->renderAjax('view', [
            'model' => $model,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new GeranBantuanGajiLampiran model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($geran_bantuan_gaji_id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new GeranBantuanGajiLampiran();
        
        if($geran_bantuan_gaji_id != ''){
            $model->geran_bantuan_gaji_id = $geran_bantuan_gaji_id;
        } else {
            if(isset(Yii::$app->session->id)){
                $model->session_id = Yii::$app->session->id;
            }
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $file = UploadedFile::getInstance($model, 'lampiran');
            $filename = $model->geran_bantuan_gaji_lampiran_id;
            if($file){
                $model->lampiran = Upload::uploadFile($file, Upload::geranBantuanGajiLampiranFolder, $filename);
            }
            
            //return $this->redirect(['view', 'id' => $model->pengurusan_insuran_lampiran_id]);
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
     * Updates an existing GeranBantuanGajiLampiran model.
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
        
        $existingLampiran = $model->lampiran;
        
        if($model->load(Yii::$app->request->post())){
            $file = UploadedFile::getInstance($model, 'lampiran');

            if($file){
                //valid file to upload
                //upload file to server
                $filename = $model->geran_bantuan_gaji_lampiran_id;
                $model->lampiran = Upload::uploadFile($file, Upload::geranBantuanGajiLampiranFolder, $filename);
            } else {
                //invalid file to upload
                //remain existing file
                $model->lampiran = $existingLampiran;
            }
        }

        if (Yii::$app->request->post() && $model->save()) {
            return '1';
        } else {
            return $this->renderAjax('update', [
                'model' => $model,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Deletes an existing GeranBantuanGajiLampiran model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        // delete upload file
        self::actionDeleteupload($id, 'lampiran');
        
        $this->findModel($id)->delete();

        //return $this->redirect(['index']);
    }

    /**
     * Finds the GeranBantuanGajiLampiran model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return GeranBantuanGajiLampiran the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = GeranBantuanGajiLampiran::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    // Add function for delete image or file
    public function actionDeleteupload($id, $field)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
            $img = $this->findModel($id)->$field;
            
            if($img){
                if (!unlink($img)) {
                    return false;
                }
            }

            $img = $this->findModel($id);
            $img->$field = NULL;
            $img->update();

            //return $this->redirect(['update', 'id' => $id]);
    }
}
