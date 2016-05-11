<?php

namespace frontend\controllers;

use Yii;
use app\models\PublicUserEBantuan;
use frontend\models\PublicUserEBantuanSearch;
use common\models\PublicUser;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

use app\models\general\Upload;
use app\models\general\GeneralVariable;

use app\models\RefStatusUser;


/**
 * PublicUserEBantuanController implements the CRUD actions for PublicUserEBantuan model.
 */
class PublicUserEBantuanController extends Controller
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
     * Lists all PublicUserEBantuan models.
     * @return mixed
     */
    public function actionIndex()
    {
        $queryPar = Yii::$app->request->queryParams;
        
        $queryPar['PublicUserEBantuanSearch']['category_access'] = PublicUser::ACCESS_BANTUAN;
        
        $searchModel = new PublicUserEBantuanSearch();
        $dataProvider = $searchModel->search($queryPar);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PublicUserEBantuan model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        
        $ref = RefStatusUser::findOne(['id' => $model->status]);
        $model->status = $ref['desc'];
        
        return $this->render('view', [
            'model' => $model,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new PublicUserEBantuan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new PublicUserEBantuan();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            
            $model->setPassword($model->new_password);
            $model->generateAuthKey();
            
            $model->category_access = PublicUser::ACCESS_BANTUAN;
            
            $file = UploadedFile::getInstance($model, 'sijil_pendaftaran');
            if($file){
                $model->sijil_pendaftaran = Upload::uploadFile($file, Upload::eBantuanPublicUserFolder, $model->id);
            }
            
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }
        
        return $this->render('create', [
            'model' => $model,
            'readonly' => false,
        ]);
    }

    /**
     * Updates an existing PublicUserEBantuan model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        
        $existingSijilPendaftaran = $model->sijil_pendaftaran;
        
        if($model->load(Yii::$app->request->post())){
            $file = UploadedFile::getInstance($model, 'sijil_pendaftaran');

            if($file){
                //valid file to upload
                //upload file to server
                
                // delete upload file
                if($existingSijilPendaftaran != ""){
                    self::actionDeleteupload($id, 'sijil_pendaftaran');
                }
                
                $model->sijil_pendaftaran = Upload::uploadFile($file, Upload::eBantuanPublicUserFolder, $model->id);
            } else {
                //invalid file to upload
                //remain existing file
                $model->sijil_pendaftaran = $existingSijilPendaftaran;
            }
        }

        if (Yii::$app->request->post() && $model->validate()) {
            //$model->password_hash = Yii::$app->security->generatePasswordHash($model->new_password);
            if($model->new_password != ''){
                $model->setPassword($model->new_password);
            }
            
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            return $this->render('update', [
                'model' => $model,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Deletes an existing PublicUserEBantuan model.
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
     * Finds the PublicUserEBantuan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PublicUserEBantuan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PublicUserEBantuan::findOne($id)) !== null) {
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

            return $this->redirect(['update', 'id' => $id]);
    }
}
