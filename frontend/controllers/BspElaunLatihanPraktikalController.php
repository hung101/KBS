<?php

namespace frontend\controllers;

use Yii;
use app\models\BspElaunLatihanPraktikal;
use frontend\models\BspElaunLatihanPraktikalSearch;
use app\models\BspElaunLatihanPraktikalMonth;
use frontend\models\BspElaunLatihanPraktikalMonthSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

use app\models\general\Upload;
use app\models\general\GeneralVariable;

// table reference
use app\models\RefJenisLatihanAmali;

/**
 * BspElaunLatihanPraktikalController implements the CRUD actions for BspElaunLatihanPraktikal model.
 */
class BspElaunLatihanPraktikalController extends Controller
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
     * Lists all BspElaunLatihanPraktikal models.
     * @return mixed
     */
    public function actionIndex($bsp_pemohon_id)
    {
        if($bsp_pemohon_id != ""){
            if (Yii::$app->user->isGuest) {
                $this->redirect(array(GeneralVariable::loginPagePath));
            }
            
            $queryPar = Yii::$app->request->queryParams;

            $queryPar['BspElaunLatihanPraktikalSearch']['bsp_pemohon_id'] = $bsp_pemohon_id;

            $searchModel = new BspElaunLatihanPraktikalSearch();
            $dataProvider = $searchModel->search($queryPar);

            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                'bsp_pemohon_id' => $bsp_pemohon_id,
            ]);
        }
    }

    /**
     * Displays a single BspElaunLatihanPraktikal model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = $this->findModel($id);
        
        $ref = RefJenisLatihanAmali::findOne(['id' => $model->jenis_latihan_amali]);
        $model->jenis_latihan_amali = $ref['desc'];
        
        $queryPar = null;
        
        $queryPar['BspElaunLatihanPraktikalMonthSearch']['bsp_elaun_latihan_praktikal_id'] = $id;
        
        $searchModel = new BspElaunLatihanPraktikalMonthSearch();
        $dataProvider = $searchModel->search($queryPar);
        
        return $this->render('view', [
            'model' => $model,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new BspElaunLatihanPraktikal model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($bsp_pemohon_id)
    {
        if (Yii::$app->user->isGuest) {
            $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new BspElaunLatihanPraktikal();
        
        $model->bsp_pemohon_id = $bsp_pemohon_id;
        
        $queryPar = null;
        
        Yii::$app->session->open();
        
        if(isset(Yii::$app->session->id)){
            $queryPar['BspElaunLatihanPraktikalMonthSearch']['session_id'] = Yii::$app->session->id;
        }
        
        $searchModel = new BspElaunLatihanPraktikalMonthSearch();
        $dataProvider = $searchModel->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            // update all the temporary session id with Elaun Latihan Pratikal Month
            if(isset(Yii::$app->session->id)){
                BspElaunLatihanPraktikalMonth::updateAll(['bsp_elaun_latihan_praktikal_id' => $model->bsp_elaun_latihan_praktikal_id], 'session_id = "'.Yii::$app->session->id.'"');
                BspElaunLatihanPraktikalMonth::updateAll(['session_id' => ''], 'bsp_elaun_latihan_praktikal_id = "'.$model->bsp_elaun_latihan_praktikal_id.'"');
            }
            
            $upload = new Upload();
            $file = UploadedFile::getInstance($model, 'muat_naik');
            if($file){
                $model->muat_naik = $upload->uploadFile($file, Upload::bspElaunLatihanPraktikal, $model->bsp_elaun_latihan_praktikal_id);
            }
            
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->bsp_elaun_latihan_praktikal_id]);
            }
        } 
        
        return $this->render('create', [
                'model' => $model,
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                'readonly' => false,
                'bsp_pemohon_id' => $bsp_pemohon_id,
            ]);
    }

    /**
     * Updates an existing BspElaunLatihanPraktikal model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if (Yii::$app->user->isGuest) {
            $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = $this->findModel($id);
        
        $queryPar = null;
        
        $queryPar['BspElaunLatihanPraktikalMonthSearch']['bsp_elaun_latihan_praktikal_id'] = $id;
        
        $searchModel = new BspElaunLatihanPraktikalMonthSearch();
        $dataProvider = $searchModel->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $upload = new Upload();
            $file = UploadedFile::getInstance($model, 'muat_naik');
            if($file){
                if($model->muat_naik){
                    // delete upload file
                    self::actionDeleteupload($id, 'muat_naik');
                }
                $model->muat_naik = $upload->uploadFile($file, Upload::bspElaunLatihanPraktikal, $model->bsp_elaun_latihan_praktikal_id);
            }
            
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->bsp_elaun_latihan_praktikal_id]);
            }
        } 
        
        return $this->render('update', [
                'model' => $model,
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                'readonly' => false,
            ]);
    }

    /**
     * Deletes an existing BspElaunLatihanPraktikal model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if (Yii::$app->user->isGuest) {
            $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the BspElaunLatihanPraktikal model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return BspElaunLatihanPraktikal the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = BspElaunLatihanPraktikal::findOne($id)) !== null) {
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
