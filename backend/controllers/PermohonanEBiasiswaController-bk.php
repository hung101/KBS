<?php

namespace backend\controllers;

use Yii;
use app\models\PermohonanEBiasiswa;
use backend\models\PermohonanEBiasiswaSearch;
use app\models\PermohonanEBiasiswaPenyertaanKejohanan;
use backend\models\PermohonanEBiasiswaPenyertaanKejohananSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

use app\models\general\Upload;
// contant values
use app\models\general\GeneralVariable;
use app\models\general\GeneralLabel;

// table reference
use app\models\RefTarafPerkahwinan;
use app\models\RefSukan;
use app\models\RefJantina;
use app\models\RefBandar;
use app\models\RefNegeri;
use app\models\RefAgama;
use app\models\RefBangsa;
use app\models\RefKawasanTemuduga;
use app\models\RefKategoriOkuEBiasiswa;
use app\models\RefKategoriPengajianEBiasiswa;
use app\models\RefStatusPermohonanEBiasiswa;

/**
 * PermohonanEBiasiswaController implements the CRUD actions for PermohonanEBiasiswa model.
 */
class PermohonanEBiasiswaController extends Controller
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
     * Lists all PermohonanEBiasiswa models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $queryPar = Yii::$app->request->queryParams;
        
        $queryPar['PermohonanEBiasiswaSearch']['user_public_id'] = Yii::$app->user->identity->id;
        
        $searchModel = new PermohonanEBiasiswaSearch();
        $dataProvider = $searchModel->search($queryPar);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PermohonanEBiasiswa model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = $this->findModel($id);
        
        $ref = RefTarafPerkahwinan::findOne(['id' => $model->taraf_perkahwinan]);
        $model->taraf_perkahwinan = $ref['desc'];
        
        $ref = RefSukan::findOne(['id' => $model->sukan]);
        $model->sukan = $ref['desc'];
        
        $ref = RefJantina::findOne(['id' => $model->jantina]);
        $model->jantina = $ref['desc'];
        
        $ref = RefBandar::findOne(['id' => $model->alamat_bandar]);
        $model->alamat_bandar = $ref['desc'];
        
        $ref = RefNegeri::findOne(['id' => $model->alamat_negeri]);
        $model->alamat_negeri = $ref['desc'];
        
        $ref = RefAgama::findOne(['id' => $model->agama]);
        $model->agama = $ref['desc'];
        
        $ref = RefBangsa::findOne(['id' => $model->keturunan]);
        $model->keturunan = $ref['desc'];
        
        $ref = RefKawasanTemuduga::findOne(['id' => $model->kawasan_temuduga_anda]);
        $model->kawasan_temuduga_anda = $ref['desc'];
        
        $ref = RefKategoriOkuEBiasiswa::findOne(['id' => $model->kategori_oku]);
        $model->kategori_oku = $ref['desc'];
        
        $ref = RefKategoriPengajianEBiasiswa::findOne(['id' => $model->kategori]);
        $model->kategori = $ref['desc'];
        
        $ref = RefStatusPermohonanEBiasiswa::findOne(['id' => $model->status_permohonan]);
        $model->status_permohonan = $ref['desc'];
        
        $model->kelulusan = GeneralLabel::getYesNoLabel($model->kelulusan);
        
        $queryPar = null;
        
        $queryPar['PermohonanEBiasiswaPenyertaanKejohananSearch']['permohonan_e_biasiswa_id'] = $id;
        
        $searchModelPermohonanEBiasiswaPenyertaanKejohanan = new PermohonanEBiasiswaPenyertaanKejohananSearch();
        $dataProviderPermohonanEBiasiswaPenyertaanKejohanan = $searchModelPermohonanEBiasiswaPenyertaanKejohanan->search($queryPar);
        
        return $this->render('view', [
            'model' => $model,
            'searchModelPermohonanEBiasiswaPenyertaanKejohanan' => $searchModelPermohonanEBiasiswaPenyertaanKejohanan,
            'dataProviderPermohonanEBiasiswaPenyertaanKejohanan' => $dataProviderPermohonanEBiasiswaPenyertaanKejohanan,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new PermohonanEBiasiswa model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new PermohonanEBiasiswa();
        
        $queryPar = null;
        
        Yii::$app->session->open();
        
        if(isset(Yii::$app->session->id)){
            $queryPar['PermohonanEBiasiswaPenyertaanKejohananSearch']['session_id'] = Yii::$app->session->id;
        }
        
        // set public user id
        $model->user_public_id = Yii::$app->user->identity->id;
        
        // set permohonan status to 'Sedang Di Semak'
        $model->status_permohonan = '1';
        
        $searchModelPermohonanEBiasiswaPenyertaanKejohanan = new PermohonanEBiasiswaPenyertaanKejohananSearch();
        $dataProviderPermohonanEBiasiswaPenyertaanKejohanan = $searchModelPermohonanEBiasiswaPenyertaanKejohanan->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $upload = new Upload();
            $file = UploadedFile::getInstance($model, 'muat_naik_gambar');
            if($file){
                $model->muat_naik_gambar = $upload->uploadFile($file, Upload::eBiasiswaFolder, $model->permohonan_e_biasiswa_id, "");
            }
            
            if(isset(Yii::$app->session->id)){
                PermohonanEBiasiswaPenyertaanKejohanan::updateAll(['permohonan_e_biasiswa_id' => $model->permohonan_e_biasiswa_id], 'session_id = "'.Yii::$app->session->id.'"');
                PermohonanEBiasiswaPenyertaanKejohanan::updateAll(['session_id' => ''], 'permohonan_e_biasiswa_id = "'.$model->permohonan_e_biasiswa_id.'"');
            }
            
            if($model->save()){
                return $this->redirect(['index']);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
                'searchModelPermohonanEBiasiswaPenyertaanKejohanan' => $searchModelPermohonanEBiasiswaPenyertaanKejohanan,
                'dataProviderPermohonanEBiasiswaPenyertaanKejohanan' => $dataProviderPermohonanEBiasiswaPenyertaanKejohanan,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Updates an existing PermohonanEBiasiswa model.
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
        
        $queryPar = null;
        
        $queryPar['PermohonanEBiasiswaPenyertaanKejohananSearch']['permohonan_e_biasiswa_id'] = $id;
        
        $searchModelPermohonanEBiasiswaPenyertaanKejohanan = new PermohonanEBiasiswaPenyertaanKejohananSearch();
        $dataProviderPermohonanEBiasiswaPenyertaanKejohanan = $searchModelPermohonanEBiasiswaPenyertaanKejohanan->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $upload = new Upload();
            $file = UploadedFile::getInstance($model, 'muat_naik_gambar');
            if($file){
                $model->muat_naik_gambar = $upload->uploadFile($file, Upload::eBiasiswaFolder, $model->permohonan_e_biasiswa_id, "");
            }
            
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->permohonan_e_biasiswa_id]);
            }
        } else {
            return $this->render('update', [
                'model' => $model,
                'searchModelPermohonanEBiasiswaPenyertaanKejohanan' => $searchModelPermohonanEBiasiswaPenyertaanKejohanan,
                'dataProviderPermohonanEBiasiswaPenyertaanKejohanan' => $dataProviderPermohonanEBiasiswaPenyertaanKejohanan,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Deletes an existing PermohonanEBiasiswa model.
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
        self::actionDeleteupload($id, 'muat_naik_gambar');
        
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the PermohonanEBiasiswa model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PermohonanEBiasiswa the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PermohonanEBiasiswa::findOne($id)) !== null) {
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
