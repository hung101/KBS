<?php

namespace frontend\controllers;

use Yii;
use app\models\AkkSijilCpr;
use frontend\models\AkkSijilCprSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

use app\models\general\Upload;
use app\models\general\GeneralVariable;
use common\models\general\GeneralFunction;

/**
 * AkkSijilCprController implements the CRUD actions for AkkSijilCpr model.
 */
class AkkSijilCprController extends Controller
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
     * Lists all AkkSijilCpr models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $searchModel = new AkkSijilCprSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AkkSijilCpr model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = $this->findModel($id);
        
        $model->tarikh_tamat = GeneralFunction::convert($model->tarikh_tamat);
        
        return $this->renderAjax('view', [
            'model' => $model,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new AkkSijilCpr model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($akademi_akk_id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new AkkSijilCpr();
        
        Yii::$app->session->open();
        
        if($akademi_akk_id != ''){
            $model->akademi_akk_id = $akademi_akk_id;
        } else {
            if(isset(Yii::$app->session->id)){
                $model->session_id = Yii::$app->session->id;
            }
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $file = UploadedFile::getInstance($model, 'sijil');
            if($file){
                $model->sijil = Upload::uploadFile($file, Upload::akademiAkkFolder, $model->akk_sijil_cpr_id, Upload::akademiAkkSijilCprFolder);
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
     * Updates an existing AkkSijilCpr model.
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

        $existingSijil= $model->sijil;
        
        if($model->load(Yii::$app->request->post())){
            $file = UploadedFile::getInstance($model, 'sijil');

            if($file){
                //valid file to upload
                //upload file to server
                
                // delete upload file
                /*if($existingSijil != ""){
                    self::actionDeleteupload($id, 'sijil');
                }
                
                $model->sijil = Upload::uploadFile($file, Upload::akademiAkkFolder, $model->akk_sijil_cpr_id, Upload::akademiAkkSijilCprFolder);*/
            } else {
                //invalid file to upload
                //remain existing file
                $model->sijil = $existingSijil;
            }
        }

        if (Yii::$app->request->post() && $model->save()) {
            $file = UploadedFile::getInstance($model, 'sijil');
            if($file){
                $model->sijil = Upload::uploadFile($file, Upload::akademiAkkFolder, $model->akk_sijil_cpr_id, Upload::akademiAkkSijilCprFolder);
            }
            
            if($model->save()){
                return '1';
            }
        } 
        
        return $this->renderAjax('update', [
                'model' => $model,
                'readonly' => false,
            ]);
    }

    /**
     * Deletes an existing AkkSijilCpr model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        self::actionDeleteupload($id, 'sijil');
        
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the AkkSijilCpr model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AkkSijilCpr the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AkkSijilCpr::findOne($id)) !== null) {
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

            //return $this->redirect(['update', 'id' => $id]);
    }
}
