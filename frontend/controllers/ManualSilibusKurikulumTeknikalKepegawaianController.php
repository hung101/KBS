<?php

namespace frontend\controllers;

use Yii;
use app\models\ManualSilibusKurikulumTeknikalKepegawaian;
use frontend\models\ManualSilibusKurikulumTeknikalKepegawaianSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

use app\models\general\Upload;
use app\models\general\GeneralVariable;
use common\models\general\GeneralFunction;

// table reference
use app\models\ProfilBadanSukan;

/**
 * ManualSilibusKurikulumTeknikalKepegawaianController implements the CRUD actions for ManualSilibusKurikulumTeknikalKepegawaian model.
 */
class ManualSilibusKurikulumTeknikalKepegawaianController extends Controller
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
     * Lists all ManualSilibusKurikulumTeknikalKepegawaian models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $searchModel = new ManualSilibusKurikulumTeknikalKepegawaianSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ManualSilibusKurikulumTeknikalKepegawaian model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = $this->findModel($id);
        
        $ref = ProfilBadanSukan::findOne(['profil_badan_sukan' => $model->persatuan_sukan]);
        $model->persatuan_sukan = $ref['nama_badan_sukan'];
        
        return $this->render('view', [
            'model' => $model,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new ManualSilibusKurikulumTeknikalKepegawaian model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new ManualSilibusKurikulumTeknikalKepegawaian();
        
        $model->tarikh = date("Y-m-d");

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $file = UploadedFile::getInstance($model, 'muat_naik');
            if($file){
                $model->muat_naik = Upload::uploadFile($file, Upload::manualSilibusKurikulumTeknikalKepegawaianFolder, $model->manual_silibus_kurikulum_teknikal_kepegawaian_id);
            }
            
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->manual_silibus_kurikulum_teknikal_kepegawaian_id]);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Updates an existing ManualSilibusKurikulumTeknikalKepegawaian model.
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
        
         $existingMuatNaik = $model->muat_naik;
        
        if($model->load(Yii::$app->request->post())){
            $file = UploadedFile::getInstance($model, 'muat_naik');

            if($file){
                //valid file to upload
                //upload file to server
                
                // delete upload file
                if($existingMuatNaik != ""){
                    self::actionDeleteupload($id, 'muat_naik');
                }
                
                $model->muat_naik = Upload::uploadFile($file, Upload::manualSilibusKurikulumTeknikalKepegawaianFolder, $model->manual_silibus_kurikulum_teknikal_kepegawaian_id);
            } else {
                //invalid file to upload
                //remain existing file
                $model->muat_naik = $existingMuatNaik;
            }
        }

        if (Yii::$app->request->post() && $model->save()) {
            return $this->redirect(['view', 'id' => $model->manual_silibus_kurikulum_teknikal_kepegawaian_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Deletes an existing ManualSilibusKurikulumTeknikalKepegawaian model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        self::actionDeleteupload($id, 'muat_naik');
        
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ManualSilibusKurikulumTeknikalKepegawaian model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ManualSilibusKurikulumTeknikalKepegawaian the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ManualSilibusKurikulumTeknikalKepegawaian::findOne($id)) !== null) {
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
