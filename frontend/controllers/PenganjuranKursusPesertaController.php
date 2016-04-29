<?php

namespace frontend\controllers;

use Yii;
use app\models\PenganjuranKursusPeserta;
use frontend\models\PenganjuranKursusPesertaSearch;
use app\models\PenganjuranKursusPesertaSukan;
use frontend\models\PenganjuranKursusPesertaSukanSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

use app\models\general\Upload;
use app\models\general\GeneralVariable;
use app\models\general\GeneralLabel;

// table reference
use app\models\RefJantina;
use app\models\RefKategoriKursusPenganjuran;
use app\models\RefKelulusanAkademi;
use app\models\RefBandar;
use app\models\RefNegeri;
use app\models\RefBangsa;
use app\models\RefKelulusanSukanSpesifik;
use app\models\RefTarafPerkahwinan;
use app\models\RefSukanAkademi;
use app\models\RefKelulusanSainsSukan;
use app\models\RefSijilSpkk;
use app\models\RefLesenKejurulatihan;
use app\models\RefStatusJurulatih;
use app\models\RefLantikanPenganjuran;
use app\models\RefSukan;

/**
 * PenganjuranKursusPesertaController implements the CRUD actions for PenganjuranKursusPeserta model.
 */
class PenganjuranKursusPesertaController extends Controller
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
     * Lists all PenganjuranKursusPeserta models.
     * @return mixed
     */
    public function actionIndex($penganjuran_kursus_id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $queryParams = Yii::$app->request->queryParams;
        
        if($penganjuran_kursus_id!=""){
            $queryParams['PenganjuranKursusPesertaSearch']['penganjuran_kursus_id'] = $penganjuran_kursus_id;
        }
        
        $searchModel = new PenganjuranKursusPesertaSearch();
        $dataProvider = $searchModel->search($queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'penganjuran_kursus_id' => $penganjuran_kursus_id,
        ]);
    }

    /**
     * Displays a single PenganjuranKursusPeserta model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = $this->findModel($id);
        
        $queryPar = null;
        
        $queryPar['PenganjuranKursusPesertaSukanSearch']['penganjuran_kursus_peserta_id'] = $id;
        
        $searchModelPenganjuranKursusPesertaSukan = new PenganjuranKursusPesertaSukanSearch();
        $dataProviderPenganjuranKursusPesertaSukan = $searchModelPenganjuranKursusPesertaSukan->search($queryPar);
        
        $ref = RefJantina::findOne(['id' => $model->jantina]);
        $model->jantina = $ref['desc'];
        
        $ref = RefKategoriKursusPenganjuran::findOne(['id' => $model->kategori_kursus]);
        $model->kategori_kursus = $ref['desc'];
        
        $ref = RefKelulusanAkademi::findOne(['id' => $model->kelulusan_akademi]);
        $model->kelulusan_akademi = $ref['desc'];
        
        $ref = RefBandar::findOne(['id' => $model->alamat_bandar]);
        $model->alamat_bandar = $ref['desc'];
        
        $ref = RefNegeri::findOne(['id' => $model->alamat_negeri]);
        $model->alamat_negeri = $ref['desc'];
        
        $ref = RefBandar::findOne(['id' => $model->alamat_majikan_bandar]);
        $model->alamat_majikan_bandar = $ref['desc'];
        
        $ref = RefNegeri::findOne(['id' => $model->alamat_majikan_negeri]);
        $model->alamat_majikan_negeri = $ref['desc'];
        
        $ref = RefBangsa::findOne(['id' => $model->kaum]);
        $model->kaum = $ref['desc'];
        
        $ref = RefKelulusanSukanSpesifik::findOne(['id' => $model->kelulusan_sukan_spesifik]);
        $model->kelulusan_sukan_spesifik = $ref['desc'];
        
        $ref = RefTarafPerkahwinan::findOne(['id' => $model->taraf_perkahwinan]);
        $model->taraf_perkahwinan = $ref['desc'];
        
        $ref = RefSukanAkademi::findOne(['id' => $model->nama_sukan_akademi]);
        $model->nama_sukan_akademi = $ref['desc'];
        
        $ref = RefKelulusanSainsSukan::findOne(['id' => $model->kelulusan_sains_sukan]);
        $model->kelulusan_sains_sukan = $ref['desc'];
        
        $ref = RefSijilSpkk::findOne(['id' => $model->sijil_spkk_msn]);
        $model->sijil_spkk_msn = $ref['desc'];
        
        $ref = RefLesenKejurulatihan::findOne(['id' => $model->lesen_kejurulatihan_msn]);
        $model->lesen_kejurulatihan_msn = $ref['desc'];
        
        $ref = RefStatusJurulatih::findOne(['id' => $model->status_jurulatih]);
        $model->status_jurulatih = $ref['desc'];
        
        $ref = RefLantikanPenganjuran::findOne(['id' => $model->lantikan]);
        $model->lantikan = $ref['desc'];
        
        $ref = RefSukan::findOne(['id' => $model->nama_sukan_jurulatih]);
        $model->nama_sukan_jurulatih = $ref['desc'];
        
        $ref = RefSukan::findOne(['id' => $model->sukan]);
        $model->sukan = $ref['desc'];
        
        $model->kelulusan = GeneralLabel::getYesNoLabel($model->kelulusan);
        
        return $this->render('view', [
            'model' => $model,
            'searchModelPenganjuranKursusPesertaSukan' => $searchModelPenganjuranKursusPesertaSukan,
            'dataProviderPenganjuranKursusPesertaSukan' => $dataProviderPenganjuranKursusPesertaSukan,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new PenganjuranKursusPeserta model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($penganjuran_kursus_id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new PenganjuranKursusPeserta();
        
        $model->penganjuran_kursus_id = $penganjuran_kursus_id;
        
        $queryPar = null;
        
        Yii::$app->session->open();
        
        if(isset(Yii::$app->session->id)){
            $queryPar['PenganjuranKursusPesertaSukanSearch']['session_id'] = Yii::$app->session->id;
        }
        
        $searchModelPenganjuranKursusPesertaSukan = new PenganjuranKursusPesertaSukanSearch();
        $dataProviderPenganjuranKursusPesertaSukan = $searchModelPenganjuranKursusPesertaSukan->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            // update all the temporary session id with Permohonan e-Bantuan id
            if(isset(Yii::$app->session->id)){
                PenganjuranKursusPesertaSukan::updateAll(['penganjuran_kursus_peserta_id' => $model->penganjuran_kursus_peserta_id], 'session_id = "'.Yii::$app->session->id.'"');
                PenganjuranKursusPesertaSukan::updateAll(['session_id' => ''], 'penganjuran_kursus_peserta_id = "'.$model->penganjuran_kursus_peserta_id.'"');
            }
            
            $file = UploadedFile::getInstance($model, 'muatnaik_gambar');
            $filename = $model->penganjuran_kursus_peserta_id . "-muatnaik_gambar";
            if($file){
                $model->muatnaik_gambar = Upload::uploadFile($file, Upload::penganjuranKursusPesertaFolder, $filename);
            }
            
            $file = UploadedFile::getInstance($model, 'dokumen_lampiran');
            $filename = $model->penganjuran_kursus_peserta_id . "-dokumen_lampiran";
            if($file){
                $model->dokumen_lampiran = Upload::uploadFile($file, Upload::penganjuranKursusPesertaFolder, $filename);
            }
            
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->penganjuran_kursus_peserta_id]);
            }
        }
        
        return $this->render('create', [
            'model' => $model,
            'searchModelPenganjuranKursusPesertaSukan' => $searchModelPenganjuranKursusPesertaSukan,
            'dataProviderPenganjuranKursusPesertaSukan' => $dataProviderPenganjuranKursusPesertaSukan,
            'readonly' => false,
            'penganjuran_kursus_id' => $penganjuran_kursus_id,
        ]);
    }

    /**
     * Updates an existing PenganjuranKursusPeserta model.
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
        
        $queryPar['PenganjuranKursusPesertaSukanSearch']['penganjuran_kursus_peserta_id'] = $id;
        
        $searchModelPenganjuranKursusPesertaSukan = new PenganjuranKursusPesertaSukanSearch();
        $dataProviderPenganjuranKursusPesertaSukan = $searchModelPenganjuranKursusPesertaSukan->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $file = UploadedFile::getInstance($model, 'muatnaik_gambar');
            $filename = $model->penganjuran_kursus_peserta_id . "-muatnaik_gambar";
            if($file){
                $model->muatnaik_gambar = Upload::uploadFile($file, Upload::penganjuranKursusPesertaFolder, $filename);
            }
            
            $file = UploadedFile::getInstance($model, 'dokumen_lampiran');
            $filename = $model->penganjuran_kursus_peserta_id . "-dokumen_lampiran";
            if($file){
                $model->dokumen_lampiran = Upload::uploadFile($file, Upload::penganjuranKursusPesertaFolder, $filename);
            }
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->penganjuran_kursus_peserta_id]);
            }
        }
        
        return $this->render('update', [
            'model' => $model,
            'searchModelPenganjuranKursusPesertaSukan' => $searchModelPenganjuranKursusPesertaSukan,
            'dataProviderPenganjuranKursusPesertaSukan' => $dataProviderPenganjuranKursusPesertaSukan,
            'readonly' => false,
        ]);
    }

    /**
     * Deletes an existing PenganjuranKursusPeserta model.
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
        self::actionDeleteimg($id, 'muatnaik_gambar');
        self::actionDeleteimg($id, 'dokumen_lampiran');
        
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the PenganjuranKursusPeserta model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PenganjuranKursusPeserta the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PenganjuranKursusPeserta::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    // Add function for delete image or file
    public function actionDeleteimg($id, $field)
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
