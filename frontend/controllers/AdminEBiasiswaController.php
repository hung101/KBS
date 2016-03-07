<?php

namespace frontend\controllers;

use Yii;
use app\models\AdminEBiasiswa;
use frontend\models\AdminEBiasiswaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

use app\models\general\Upload;
use app\models\general\GeneralVariable;
use app\models\general\GeneralLabel;
use common\models\general\GeneralFunction;

/**
 * AdminEBiasiswaController implements the CRUD actions for AdminEBiasiswa model.
 */
class AdminEBiasiswaController extends Controller
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
     * Lists all AdminEBiasiswa models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $searchModel = new AdminEBiasiswaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AdminEBiasiswa model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = $this->findModel($id);
        
        $model->tarikh_mula = GeneralFunction::convert($model->tarikh_mula);
        
        $model->tarikh_tamat = GeneralFunction::convert($model->tarikh_tamat);
        
        $model->tarikh_semakan_panggilan_temuduga = GeneralFunction::convert($model->tarikh_semakan_panggilan_temuduga);
        
        $model->tarikh_semakan_keputusan_temuduga = GeneralFunction::convert($model->tarikh_semakan_keputusan_temuduga);
        
        $model->tawaran_biasiswa_tarikh_masa = GeneralFunction::convert($model->tawaran_biasiswa_tarikh_masa, GeneralFunction::TYPE_DATETIME);
        
        $model->aktif = GeneralLabel::getYesNoLabel($model->aktif);
        
        return $this->render('view', [
            'model' => $model,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new AdminEBiasiswa model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new AdminEBiasiswa();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $file = UploadedFile::getInstance($model, 'muat_naik_syarat_kelayakan');
            if($file){
                $model->muat_naik_syarat_kelayakan = Upload::uploadFile($file, Upload::adminEBiasiswaFolder, $model->admin_e_biasiswa_id);
            }
            
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->admin_e_biasiswa_id]);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Updates an existing AdminEBiasiswa model.
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
        
        $existingMuatNaikSyaratKelayakan = $model->muat_naik_syarat_kelayakan;
        
        if($model->load(Yii::$app->request->post())){
            $file = UploadedFile::getInstance($model, 'muat_naik_syarat_kelayakan');

            if($file){
                //valid file to upload
                //upload file to server
                
                // delete upload file
                if($existingMuatNaikSyaratKelayakan != ""){
                    self::actionDeleteupload($id, 'muat_naik_syarat_kelayakan');
                }
                
                $model->muat_naik_syarat_kelayakan = Upload::uploadFile($file, Upload::adminEBiasiswaFolder, $model->admin_e_biasiswa_id);
            } else {
                //invalid file to upload
                //remain existing file
                $model->muat_naik_syarat_kelayakan = $existingMuatNaikSyaratKelayakan;
            }
        }

        if (Yii::$app->request->post() && $model->save()) {
            return $this->redirect(['view', 'id' => $model->admin_e_biasiswa_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Deletes an existing AdminEBiasiswa model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        self::actionDeleteupload($id, 'muat_naik_syarat_kelayakan');
        
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the AdminEBiasiswa model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AdminEBiasiswa the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AdminEBiasiswa::findOne($id)) !== null) {
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
