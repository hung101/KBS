<?php

namespace frontend\controllers;

use Yii;
use app\models\PemohonKursusTahapAkk;
use frontend\models\PemohonKursusTahapAkkSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

use app\models\general\Upload;
use app\models\general\GeneralVariable;

// table reference
use app\models\RefTahapSainsSukan;

/**
 * PemohonKursusTahapAkkController implements the CRUD actions for PemohonKursusTahapAkk model.
 */
class PemohonKursusTahapAkkController extends Controller
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
     * Lists all PemohonKursusTahapAkk models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $searchModel = new PemohonKursusTahapAkkSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PemohonKursusTahapAkk model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = $this->findModel($id);
        
        $ref = RefTahapSainsSukan::findOne(['id' => $model->tahap]);
        $model->tahap = $ref['desc'];
        
        return $this->renderAjax('view', [
            'model' => $model,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new PemohonKursusTahapAkk model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($akademi_akk_id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new PemohonKursusTahapAkk();
        
        Yii::$app->session->open();
        
        if($akademi_akk_id != ''){
            $model->akademi_akk_id = $akademi_akk_id;
        } else {
            if(isset(Yii::$app->session->id)){
                $model->session_id = Yii::$app->session->id;
            }
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $file = UploadedFile::getInstance($model, 'muatnaik_sijil');
            if($file){
                $model->muatnaik_sijil = Upload::uploadFile($file, Upload::akademiAkkFolder, $model->pemohon_kursus_tahap_akk_id, Upload::akademiAkkPemohonKursusTahapAkkFolder);
            }
            
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
     * Updates an existing PemohonKursusTahapAkk model.
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
        
        $existingMuatnaikSijil = $model->muatnaik_sijil;
        
        if($model->load(Yii::$app->request->post())){
            $file = UploadedFile::getInstance($model, 'muatnaik_sijil');

            if($file){
                //valid file to upload
                //upload file to server
                $model->muatnaik_sijil = Upload::uploadFile($file, Upload::akademiAkkFolder, $model->pemohon_kursus_tahap_akk_id, Upload::akademiAkkPemohonKursusTahapAkkFolder);
            } else {
                //invalid file to upload
                //remain existing file
                $model->muatnaik_sijil = $existingMuatnaikSijil;
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
     * Deletes an existing PemohonKursusTahapAkk model.
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

    /**
     * Finds the PemohonKursusTahapAkk model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PemohonKursusTahapAkk the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PemohonKursusTahapAkk::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
