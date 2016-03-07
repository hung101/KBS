<?php

namespace frontend\controllers;

use Yii;
use app\models\BspElaunPerjalananUdara;
use frontend\models\BspElaunPerjalananUdaraSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

use app\models\general\Upload;
use app\models\general\GeneralVariable;

/**
 * BspElaunPerjalananUdaraController implements the CRUD actions for BspElaunPerjalananUdara model.
 */
class BspElaunPerjalananUdaraController extends Controller
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
     * Lists all BspElaunPerjalananUdara models.
     * @return mixed
     */
    public function actionIndex($bsp_pemohon_id)
    {
        if($bsp_pemohon_id != ""){
            if (Yii::$app->user->isGuest) {
                return $this->redirect(array(GeneralVariable::loginPagePath));
            }
            
            $queryPar = Yii::$app->request->queryParams;

            $queryPar['BspElaunPerjalananUdaraSearch']['bsp_pemohon_id'] = $bsp_pemohon_id;

            $searchModel = new BspElaunPerjalananUdaraSearch();
            $dataProvider = $searchModel->search($queryPar);

            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                'bsp_pemohon_id' => $bsp_pemohon_id,
            ]);
        }
    }

    /**
     * Displays a single BspElaunPerjalananUdara model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        return $this->render('view', [
            'model' => $this->findModel($id),
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new BspElaunPerjalananUdara model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($bsp_pemohon_id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new BspElaunPerjalananUdara();
        
        $model->bsp_pemohon_id = $bsp_pemohon_id;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $upload = new Upload();
            $file = UploadedFile::getInstance($model, 'muat_naik');
            if($file){
                $model->muat_naik = $upload->uploadFile($file, Upload::bspElaunPerjalananUdara, $model->bsp_elaun_perjalanan_udara_id);
            }
            
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->bsp_elaun_perjalanan_udara_id]);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
                'readonly' => false,
                'bsp_pemohon_id' => $bsp_pemohon_id,
            ]);
        }
    }

    /**
     * Updates an existing BspElaunPerjalananUdara model.
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
            $upload = new Upload();
            $file = UploadedFile::getInstance($model, 'muat_naik');
            if($file){
                if($model->muat_naik){
                    // delete upload file
                    self::actionDeleteupload($id, 'muat_naik');
                }
                $model->muat_naik = $upload->uploadFile($file, Upload::bspElaunPerjalananUdara, $model->bsp_elaun_perjalanan_udara_id);
            }
            
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->bsp_elaun_perjalanan_udara_id]);
            }
        } else {
            return $this->render('update', [
                'model' => $model,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Deletes an existing BspElaunPerjalananUdara model.
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
        self::actionDeleteupload($id, 'muat_naik');
        
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the BspElaunPerjalananUdara model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return BspElaunPerjalananUdara the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = BspElaunPerjalananUdara::findOne($id)) !== null) {
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
