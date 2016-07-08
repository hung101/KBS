<?php

namespace frontend\controllers;

use Yii;
use app\models\ProfilKonsultan;
use frontend\models\ProfilKonsultanSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

use app\models\general\Upload;
use app\models\general\GeneralVariable;
use common\models\general\GeneralFunction;

// table reference
use app\models\RefBidangKonsultansi;
use app\models\RefNegeri;
use app\models\RefBandar;
use app\models\RefKategoriAgensi;
use app\models\RefStatusPermohonanKaunselor;

/**
 * ProfilKonsultanController implements the CRUD actions for ProfilKonsultan model.
 */
class ProfilKonsultanController extends Controller
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
     * Lists all ProfilKonsultan models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $searchModel = new ProfilKonsultanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ProfilKonsultan model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = $this->findModel($id);
        
        $ref = RefNegeri::findOne(['id' => $model->alamat_negeri]);
        $model->alamat_negeri = $ref['desc'];
        
        $ref = RefBandar::findOne(['id' => $model->alamat_bandar]);
        $model->alamat_bandar = $ref['desc'];
        
        $ref = RefKategoriAgensi::findOne(['id' => $model->kategori_agensi]);
        $model->kategori_agensi = $ref['desc'];
        
        $ref = RefStatusPermohonanKaunselor::findOne(['id' => $model->status_permohonan]);
        $model->status_permohonan = $ref['desc'];
        
        return $this->render('view', [
            'model' => $model,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new ProfilKonsultan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new ProfilKonsultan();
        
        if ($model->load(Yii::$app->request->post())) {
            if(is_array($model->bidang_konsultansi)){
                $model->bidang_konsultansi = implode(",",$model->bidang_konsultansi);
            } else {
                $model->bidang_konsultansi = "";
            }
        }
        
        $model->tarikh = GeneralFunction::getCurrentTimestamp();

        if (Yii::$app->request->post() && $model->save()) {
            $file = UploadedFile::getInstance($model, 'gambar');
            if($file){
                $model->gambar = Upload::uploadFile($file, Upload::profilKonsultanFolder, $model->profil_konsultan_id);
            }
            
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->profil_konsultan_id]);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Updates an existing ProfilKonsultan model.
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
        
        $existingGambar = $model->gambar;
        
        if($model->load(Yii::$app->request->post())){
            $file = UploadedFile::getInstance($model, 'gambar');

            if($file){
                //valid file to upload
                //upload file to server
                
                // delete upload file
                if($existingGambar != ""){
                    self::actionDeleteupload($id, 'gambar');
                }
                
                $model->gambar = Upload::uploadFile($file, Upload::profilKonsultanFolder, $model->profil_konsultan_id);
            } else {
                //invalid file to upload
                //remain existing file
                $model->gambar = $existingGambar;
            }
        }
        
        if (Yii::$app->request->post() && $model->bidang_konsultansi) {
            if(is_array($model->bidang_konsultansi)){
                $model->bidang_konsultansi = implode(",",$model->bidang_konsultansi);
            } else {
                $model->bidang_konsultansi = "";
            }
        }

        if (Yii::$app->request->post() && $model->save()) {
            return $this->redirect(['view', 'id' => $model->profil_konsultan_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Deletes an existing ProfilKonsultan model.
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
        self::actionDeleteupload($id, 'gambar');
        
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ProfilKonsultan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ProfilKonsultan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ProfilKonsultan::findOne($id)) !== null) {
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
