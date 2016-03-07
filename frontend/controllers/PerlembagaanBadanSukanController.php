<?php

namespace frontend\controllers;

use Yii;
use app\models\PerlembagaanBadanSukan;
use app\models\PerlembagaanBadanSukanSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

use app\models\general\Upload;
use app\models\general\GeneralVariable;
use common\models\general\GeneralFunction;

use app\models\RefStatusLaporanMesyuaratAgung;

/**
 * PerlembagaanBadanSukanController implements the CRUD actions for PerlembagaanBadanSukan model.
 */
class PerlembagaanBadanSukanController extends Controller
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
     * Lists all PerlembagaanBadanSukan models.
     * @return mixed
     */
    public function actionIndex($profil_badan_sukan_id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $queryParams = Yii::$app->request->queryParams;
        
        if($profil_badan_sukan_id!=""){
            $queryParams['PerlembagaanBadanSukanSearch']['profil_badan_sukan_id'] = $profil_badan_sukan_id;
        }
        
        $searchModel = new PerlembagaanBadanSukanSearch();
        $dataProvider = $searchModel->search($queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'profil_badan_sukan_id' => $profil_badan_sukan_id,
        ]);
    }

    /**
     * Displays a single PerlembagaanBadanSukan model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = $this->findModel($id);
        
        $profil_badan_sukan_id = $model->profil_badan_sukan_id;
        
        $ref = RefStatusLaporanMesyuaratAgung::findOne(['id' => $model->status]);
        $model->status = $ref['desc'];
        
        $model->tarikh_kelulusan = GeneralFunction::convert($model->tarikh_kelulusan);
        
        return $this->render('view', [
            'model' => $model,
            'readonly' => true,
            'profil_badan_sukan_id' => $profil_badan_sukan_id,
        ]);
    }

    /**
     * Creates a new PerlembagaanBadanSukan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($profil_badan_sukan_id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new PerlembagaanBadanSukan();
        
        if(Yii::$app->user->identity->profil_badan_sukan){
            $model->profil_badan_sukan_id = Yii::$app->user->identity->profil_badan_sukan;
            $model->status = RefStatusLaporanMesyuaratAgung::BELUM_DISAHKAN;
        } else if($profil_badan_sukan_id!=""){
            $model->profil_badan_sukan_id = $profil_badan_sukan_id;
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $file = UploadedFile::getInstance($model, 'muat_naik');
            if($file){
                $model->muat_naik = Upload::uploadFile($file, Upload::perlembagaanBadanSukanFolder, $model->perlembagaan_badan_sukan_id);
            }
            
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->perlembagaan_badan_sukan_id]);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
                'readonly' => false,
                'profil_badan_sukan_id' => $profil_badan_sukan_id,
            ]);
        }
    }

    /**
     * Updates an existing PerlembagaanBadanSukan model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $file = UploadedFile::getInstance($model, 'muat_naik');
            if($file){
                $model->muat_naik = Upload::uploadFile($file, Upload::perlembagaanBadanSukanFolder, $model->perlembagaan_badan_sukan_id);
            }
            
            if(Yii::$app->user->identity->profil_badan_sukan){
                // set status to 'Belum Disahkan' if any changes made for persatuan
                $model->status = RefStatusLaporanMesyuaratAgung::BELUM_DISAHKAN;
            }
            
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->perlembagaan_badan_sukan_id]);
            }
        } else {
            return $this->render('update', [
                'model' => $model,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Deletes an existing PerlembagaanBadanSukan model.
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
     * Finds the PerlembagaanBadanSukan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PerlembagaanBadanSukan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PerlembagaanBadanSukan::findOne($id)) !== null) {
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
