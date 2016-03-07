<?php

namespace frontend\controllers;

use Yii;
use app\models\ProfilBadanSukan;
use app\models\ProfilBadanSukanSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\helpers\Json;

use app\models\general\Upload;
use app\models\general\GeneralVariable;
use common\models\general\GeneralFunction;

// table reference
use app\models\RefPeringkatBadanSukan;
use app\models\RefSukan;
use app\models\RefNegeri;
use app\models\RefBandar;

/**
 * ProfilBadanSukanController implements the CRUD actions for ProfilBadanSukan model.
 */
class ProfilBadanSukanController extends Controller
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
     * Lists all ProfilBadanSukan models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $queryPar = Yii::$app->request->queryParams;
        
        if(Yii::$app->user->identity->profil_badan_sukan){
            $queryPar['ProfilBadanSukanSearch']['profil_badan_sukan'] = Yii::$app->user->identity->profil_badan_sukan;
        }
        
        $searchModel = new ProfilBadanSukanSearch();
        $dataProvider = $searchModel->search($queryPar);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ProfilBadanSukan model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = $this->findModel($id);
        
        $ref = RefPeringkatBadanSukan::findOne(['id' => $model->peringkat_badan_sukan]);
        $model->peringkat_badan_sukan = $ref['desc'];
        
        $ref = RefSukan::findOne(['id' => $model->jenis_sukan]);
        $model->jenis_sukan = $ref['desc'];
        
        $ref = RefNegeri::findOne(['id' => $model->alamat_tetap_badan_sukan_negeri]);
        $model->alamat_tetap_badan_sukan_negeri = $ref['desc'];
        
        $ref = RefBandar::findOne(['id' => $model->alamat_tetap_badan_sukan_bandar]);
        $model->alamat_tetap_badan_sukan_bandar = $ref['desc'];
        
        $ref = RefNegeri::findOne(['id' => $model->alamat_surat_menyurat_badan_sukan_negeri]);
        $model->alamat_surat_menyurat_badan_sukan_negeri = $ref['desc'];
        
        $ref = RefBandar::findOne(['id' => $model->alamat_surat_menyurat_badan_sukan_bandar]);
        $model->alamat_surat_menyurat_badan_sukan_bandar = $ref['desc'];
        
        $model->tarikh_lulus_pendaftaran = GeneralFunction::convert($model->tarikh_lulus_pendaftaran);
        
        return $this->render('view', [
            'model' => $model,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new ProfilBadanSukan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new ProfilBadanSukan();
        
        if($model->load(Yii::$app->request->post())){
            $file = UploadedFile::getInstance($model, 'no_pendaftaran_sijil_pendaftaran');

            if($file){
                $model->no_pendaftaran_sijil_pendaftaran = "uploadlater";
            }
        }

        if (Yii::$app->request->post() && $model->save()) {
            $file = UploadedFile::getInstance($model, 'no_pendaftaran_sijil_pendaftaran');
            if($file){
                $model->no_pendaftaran_sijil_pendaftaran = Upload::uploadFile($file, Upload::profilBadanSukanFolder, $model->profil_badan_sukan);
            }
            
            $file = UploadedFile::getInstance($model, 'muat_naik_perlembagaan_terkini');
            if($file){
                $model->muat_naik_perlembagaan_terkini = Upload::uploadFile($file, Upload::profilBadanSukanFolder, 'muat_naik_perlembagaan_terkini-' . $model->profil_badan_sukan);
            }
            
            $file = UploadedFile::getInstance($model, 'gambar');
            if($file){
                $model->gambar = Upload::uploadFile($file, Upload::profilBadanSukanFolder, 'gambar-' . $model->profil_badan_sukan);
            }
            
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->profil_badan_sukan]);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Updates an existing ProfilBadanSukan model.
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
        
        if($model->load(Yii::$app->request->post())){
            $file = UploadedFile::getInstance($model, 'no_pendaftaran_sijil_pendaftaran');

            if($file){
                $model->no_pendaftaran_sijil_pendaftaran = "uploadlater";
            }
        }

        if (Yii::$app->request->post() && $model->save()) {
            $file = UploadedFile::getInstance($model, 'no_pendaftaran_sijil_pendaftaran');
            if($file){
                $model->no_pendaftaran_sijil_pendaftaran = Upload::uploadFile($file, Upload::profilBadanSukanFolder, $model->profil_badan_sukan);
            }
            
            $file = UploadedFile::getInstance($model, 'muat_naik_perlembagaan_terkini');
            if($file){
                $model->muat_naik_perlembagaan_terkini = Upload::uploadFile($file, Upload::profilBadanSukanFolder, 'muat_naik_perlembagaan_terkini-' . $model->profil_badan_sukan);
            }
            
            $file = UploadedFile::getInstance($model, 'gambar');
            if($file){
                $model->gambar = Upload::uploadFile($file, Upload::profilBadanSukanFolder, 'gambar-' . $model->profil_badan_sukan);
            }
            
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->profil_badan_sukan]);
            }
        } else {
            return $this->render('update', [
                'model' => $model,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Deletes an existing ProfilBadanSukan model.
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
        self::actionDeleteupload($id, 'no_pendaftaran_sijil_pendaftaran');
        
        self::actionDeleteupload($id, 'muat_naik_perlembagaan_terkini');
        
        self::actionDeleteupload($id, 'gambar');
        
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ProfilBadanSukan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ProfilBadanSukan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ProfilBadanSukan::findOne($id)) !== null) {
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
    
    public function actionGetBadanSukan($id){
        // find Ahli Jawatankuasa Induk
        $model = ProfilBadanSukan::find()->where(['profil_badan_sukan' => $id])->asArray()->one();
        
        echo Json::encode($model);
    }
}
