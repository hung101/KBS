<?php

namespace frontend\controllers;

use Yii;
use app\models\PenyertaanSukan;
use frontend\models\PenyertaanSukanSearch;
use app\models\PenyertaanSukanAcara;
use app\models\PenilaianPestasi;
use app\models\PenilaianPrestasiAtletSasaran;
use app\models\AtletPencapaian;
use frontend\models\PenyertaanSukanAcaraSearch;
use app\models\PenyertaanSukanJurulatih;
use frontend\models\PenyertaanSukanJurulatihSearch;
use app\models\PenyertaanSukanPegawai;
use frontend\models\PenyertaanSukanPegawaiSearch;
use app\models\PenyertaanSukanPengurus;
use frontend\models\PenyertaanSukanPengurusSearch;
use app\models\PenyertaanSukanPerbelanjaan;
use frontend\models\PenyertaanSukanPerbelanjaanSearch;
use app\models\LaporanPenyertaanKejohanan;
use app\models\LaporanPenyertaanKejohananPegawai;
use frontend\models\LaporanPenyertaanKejohananPegawaiSearch;
use app\models\LaporanPenyertaanKejohananPengurus;
use frontend\models\LaporanPenyertaanKejohananPengurusSearch;
use app\models\LaporanPenyertaanKejohananJurulatih;
use frontend\models\LaporanPenyertaanKejohananJurulatihSearch;
use app\models\LaporanPenyertaanKejohananAtlet;
use frontend\models\LaporanPenyertaanKejohananAtletSearch;
use app\models\LaporanPenyertaanKejohananPrestasi;
use frontend\models\LaporanPenyertaanKejohananPrestasiSearch;
use app\models\LaporanPenyertaanKejohananRanking;
use frontend\models\LaporanPenyertaanKejohananRankingSearch;
use app\models\LaporanPendedahanLatihan;
use app\models\LaporanPendedahanLatihanPegawai;
use frontend\models\LaporanPendedahanLatihanPegawaiSearch;
use app\models\LaporanPendedahanLatihanJurulatih;
use frontend\models\LaporanPendedahanLatihanJurulatihSearch;
use app\models\LaporanPendedahanLatihanAtlet;
use frontend\models\LaporanPendedahanLatihanAtletSearch;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Session;
use yii\helpers\Url;
use yii\web\UploadedFile;
use app\models\MsnSuratRasmi;

use app\models\general\Upload;
use app\models\general\GeneralLabel;
use app\models\general\GeneralVariable;
use common\models\general\GeneralFunction;

// table reference
use app\models\RefKategoriPenilaian;
use app\models\RefSukan;
use app\models\Atlet;
use app\models\PerancanganProgram;
use app\models\RefJenisAktiviti;
use app\models\RefPeringkatKejohananTemasya;
use app\models\RefProgramSemasaSukanAtlet;
use app\models\RefTemasya;
use app\models\RefAcara;
use app\models\RefKeputusan;
use app\models\RefAktivitiPendedahan;
use \app\models\PerancanganProgramPlan;
use app\models\RefStatusPermohonanProgramBinaan;

/**
 * PenyertaanSukanController implements the CRUD actions for PenyertaanSukan model.
 */
class PenyertaanSukanController extends Controller
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
     * Lists all PenyertaanSukan models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $queryParams = Yii::$app->request->queryParams;
        
        $searchModel = new PenyertaanSukanSearch();
        $dataProvider = $searchModel->search($queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PenyertaanSukan model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = $this->findModel($id);
        
        $ref = RefKategoriPenilaian::findOne(['id' => $model->kategori_penilaian]);
        $model->kategori_penilaian = $ref['desc'];
        
        $ref = RefSukan::findOne(['id' => $model->nama_sukan]);
        $model->nama_sukan = $ref['desc'];
        
        $ref = Atlet::findOne(['atlet_id' => $model->nama_atlet]);
        $model->nama_atlet = $ref['nameAndIC'];
        
        $ref = PerancanganProgram::findOne(['perancangan_program_id' => $model->nama_kejohanan]);
        $model->nama_kejohanan = $ref['nama_program'];
        
        $ref = RefPeringkatKejohananTemasya::findOne(['id' => $model->peringkat]);
        $model->peringkat = $ref['desc'];
        
        $ref = RefProgramSemasaSukanAtlet::findOne(['id' => $model->program]);
        $model->program = $ref['desc'];
        
        $ref = RefTemasya::findOne(['id' => $model->nama_temasya]);
        $model->nama_temasya = $ref['desc'];
        
        $ref = PerancanganProgramPlan::findOne(['perancangan_program_id' => $model->nama_kejohanan_temasya]);
        $model->nama_kejohanan_temasya = $ref['nama_program'];
		
        $ref = RefStatusPermohonanProgramBinaan::findOne(['id' => $model->jkb_status_permohonan]);
        $model->jkb_status_permohonan = $ref['desc'];
                
        if($model->tarikh_mula != "") {$model->tarikh_mula = GeneralFunction::convert($model->tarikh_mula, GeneralFunction::TYPE_DATE);}
        if($model->tarikh_tamat != "") {$model->tarikh_tamat = GeneralFunction::convert($model->tarikh_tamat, GeneralFunction::TYPE_DATE);}
        if($model->tarikh_jkb != "") {$model->tarikh_jkb = GeneralFunction::convert($model->tarikh_jkb, GeneralFunction::TYPE_DATE);}
        
        $queryPar = null;
        
        $queryPar['PenyertaanSukanAcaraSearch']['penyertaan_sukan_id'] = $id;
        $queryPar['PenyertaanSukanJurulatihSearch']['penyertaan_sukan_id'] = $id;
        $queryPar['PenyertaanSukanPegawaiSearch']['penyertaan_sukan_id'] = $id;
        $queryPar['PenyertaanSukanPengurusSearch']['penyertaan_sukan_id'] = $id;
        $queryPar['PenyertaanSukanPerbelanjaanSearch']['penyertaan_sukan_id'] = $id;
        
        $searchModelPenyertaanSukanAcara  = new PenyertaanSukanAcaraSearch();
        $dataProviderPenyertaanSukanAcara = $searchModelPenyertaanSukanAcara->search($queryPar);
        $searchModelPenyertaanSukanJurulatih = new PenyertaanSukanJurulatihSearch();
        $dataProviderPenyertaanSukanJurulatih = $searchModelPenyertaanSukanJurulatih->search($queryPar);
        $searchModelPenyertaanSukanPegawai = new PenyertaanSukanPegawaiSearch();
        $dataProviderPenyertaanSukanPegawai = $searchModelPenyertaanSukanPegawai->search($queryPar);
        $searchModelPenyertaanSukanPengurus = new PenyertaanSukanPengurusSearch();
        $dataProviderPenyertaanSukanPengurus = $searchModelPenyertaanSukanPengurus->search($queryPar);
        $searchModelPenyertaanSukanPerbelanjaan = new PenyertaanSukanPerbelanjaanSearch();
        $dataProviderPenyertaanSukanPerbelanjaan = $searchModelPenyertaanSukanPerbelanjaan->search($queryPar);
        
        return $this->render('view', [
            'model' => $model,
            'searchModelPenyertaanSukanAcara' => $searchModelPenyertaanSukanAcara,
            'dataProviderPenyertaanSukanAcara' => $dataProviderPenyertaanSukanAcara,
            'searchModelPenyertaanSukanJurulatih' => $searchModelPenyertaanSukanJurulatih,
            'dataProviderPenyertaanSukanJurulatih' => $dataProviderPenyertaanSukanJurulatih,
            'searchModelPenyertaanSukanPegawai' => $searchModelPenyertaanSukanPegawai,
            'dataProviderPenyertaanSukanPegawai' => $dataProviderPenyertaanSukanPegawai,
            'searchModelPenyertaanSukanPengurus' => $searchModelPenyertaanSukanPengurus,
            'dataProviderPenyertaanSukanPengurus' => $dataProviderPenyertaanSukanPengurus,
            'searchModelPenyertaanSukanPerbelanjaan' => $searchModelPenyertaanSukanPerbelanjaan,
            'dataProviderPenyertaanSukanPerbelanjaan' => $dataProviderPenyertaanSukanPerbelanjaan,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new PenyertaanSukan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new PenyertaanSukan();
        
        $queryPar = null;
        
        Yii::$app->session->open();
        
        if(isset(Yii::$app->session->id)){
            $queryPar['PenyertaanSukanAcaraSearch']['session_id'] = Yii::$app->session->id;
            $queryPar['PenyertaanSukanJurulatihSearch']['session_id'] = Yii::$app->session->id;
            $queryPar['PenyertaanSukanPegawaiSearch']['session_id'] = Yii::$app->session->id;
            $queryPar['PenyertaanSukanPengurusSearch']['session_id'] = Yii::$app->session->id;
            $queryPar['PenyertaanSukanPerbelanjaanSearch']['session_id'] = Yii::$app->session->id;
        }
        
        $searchModelPenyertaanSukanAcara  = new PenyertaanSukanAcaraSearch();
        $dataProviderPenyertaanSukanAcara = $searchModelPenyertaanSukanAcara->search($queryPar);
        
        $searchModelPenyertaanSukanJurulatih = new PenyertaanSukanJurulatihSearch();
        $dataProviderPenyertaanSukanJurulatih = $searchModelPenyertaanSukanJurulatih->search($queryPar);
        
        $searchModelPenyertaanSukanPegawai = new PenyertaanSukanPegawaiSearch();
        $dataProviderPenyertaanSukanPegawai = $searchModelPenyertaanSukanPegawai->search($queryPar);
        
        $searchModelPenyertaanSukanPengurus = new PenyertaanSukanPengurusSearch();
        $dataProviderPenyertaanSukanPengurus = $searchModelPenyertaanSukanPengurus->search($queryPar);
        
        $searchModelPenyertaanSukanPerbelanjaan = new PenyertaanSukanPerbelanjaanSearch();
        $dataProviderPenyertaanSukanPerbelanjaan = $searchModelPenyertaanSukanPerbelanjaan->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if(isset(Yii::$app->session->id)){
                PenyertaanSukanAcara::updateAll(['penyertaan_sukan_id' => $model->penyertaan_sukan_id], 'session_id = "'.Yii::$app->session->id.'"');
                PenyertaanSukanAcara::updateAll(['session_id' => ''], 'penyertaan_sukan_id = "'.$model->penyertaan_sukan_id.'"');
                
                PenyertaanSukanJurulatih::updateAll(['penyertaan_sukan_id' => $model->penyertaan_sukan_id], 'session_id = "'.Yii::$app->session->id.'"');
                PenyertaanSukanJurulatih::updateAll(['session_id' => ''], 'penyertaan_sukan_id = "'.$model->penyertaan_sukan_id.'"');
                
                PenyertaanSukanPegawai::updateAll(['penyertaan_sukan_id' => $model->penyertaan_sukan_id], 'session_id = "'.Yii::$app->session->id.'"');
                PenyertaanSukanPegawai::updateAll(['session_id' => ''], 'penyertaan_sukan_id = "'.$model->penyertaan_sukan_id.'"');
                
                PenyertaanSukanPengurus::updateAll(['penyertaan_sukan_id' => $model->penyertaan_sukan_id], 'session_id = "'.Yii::$app->session->id.'"');
                PenyertaanSukanPengurus::updateAll(['session_id' => ''], 'penyertaan_sukan_id = "'.$model->penyertaan_sukan_id.'"');
                
                PenyertaanSukanPerbelanjaan::updateAll(['penyertaan_sukan_id' => $model->penyertaan_sukan_id], 'session_id = "'.Yii::$app->session->id.'"');
                PenyertaanSukanPerbelanjaan::updateAll(['session_id' => ''], 'penyertaan_sukan_id = "'.$model->penyertaan_sukan_id.'"');
            }
            
            //if($model->nama_kejohanan){
            if($model->nama_kejohanan_temasya){
                // update Penilaian Prestasi modul for Kejohanan only
                $modelPenilaianPestasi = null;
                 if (($modelPenilaianPestasi = PenilaianPestasi::find()->where(['penyertaan_sukan_id'=>$model->penyertaan_sukan_id])->one()) == null) {
                    $modelPenilaianPestasi = new PenilaianPestasi();
                }
                
                $modelPenyertaanSukanAcaraFirstOne = null;
                if (($modelPenyertaanSukanAcaraFirstOne = PenyertaanSukanAcara::find()->where(['penyertaan_sukan_id'=>$model->penyertaan_sukan_id])->orderBy(['penyertaan_sukan_acara_id' => SORT_ASC])->one()) != null) {
                    $modelPenilaianPestasi->acara = $modelPenyertaanSukanAcaraFirstOne->nama_acara;
                }

                $modelPenilaianPestasi->penyertaan_sukan_id = $model->penyertaan_sukan_id;
                $modelPenilaianPestasi->sukan = $model->nama_sukan;
                $modelPenilaianPestasi->program = $model->program;
                $modelPenilaianPestasi->kejohanan = $model->nama_kejohanan_temasya;
                $modelPenilaianPestasi->save();

                $modelPenyertaanSukanAcaras = PenyertaanSukanAcara::findAll([
                    'penyertaan_sukan_id' => $model->penyertaan_sukan_id,
                ]);

                foreach($modelPenyertaanSukanAcaras as $modelPenyertaanSukanAcara){
                    $modelPenilaianPrestasiAtletSasaran = null;
                    if (($modelPenilaianPrestasiAtletSasaran = PenilaianPrestasiAtletSasaran::find()
                            ->where(['penyertaan_sukan_id'=>$model->penyertaan_sukan_id])
                            ->andWhere(['penyertaan_sukan_acara_id'=>$modelPenyertaanSukanAcara->penyertaan_sukan_acara_id])->one()) == null) {
                        $modelPenilaianPrestasiAtletSasaran = new PenilaianPrestasiAtletSasaran();
                    }
                    
                    $modelPenilaianPrestasiAtletSasaran->penilaian_pestasi_id = $modelPenilaianPestasi->penilaian_pestasi_id;
                    $modelPenilaianPrestasiAtletSasaran->atlet = $modelPenyertaanSukanAcara->atlet;
                    $modelPenilaianPrestasiAtletSasaran->sasaran = $modelPenyertaanSukanAcara->sasaran;
                    $modelPenilaianPrestasiAtletSasaran->penyertaan_sukan_id = $modelPenyertaanSukanAcara->penyertaan_sukan_id;
                    $modelPenilaianPrestasiAtletSasaran->penyertaan_sukan_acara_id = $modelPenyertaanSukanAcara->penyertaan_sukan_acara_id;
                    $modelPenilaianPrestasiAtletSasaran->save();
                }
                
                $model->penilaian_pestasi_id = $modelPenilaianPestasi->penilaian_pestasi_id;
                $model->save();
            }
            
            $modelPenyertaanSukanAcaras = PenyertaanSukanAcara::findAll([
                        'penyertaan_sukan_id' => $model->penyertaan_sukan_id,
                    ]);

            foreach($modelPenyertaanSukanAcaras as $modelPenyertaanSukanAcara){

                // Atlet Profile Pencapaian
                $modelAtletPencapaian = null;
                if (($modelAtletPencapaian = AtletPencapaian::find()->where(['atlet_id'=>$modelPenyertaanSukanAcara->atlet])
                        ->andWhere(['penyertaan_sukan_id'=>$model->penyertaan_sukan_id])
                        ->andWhere(['penyertaan_sukan_acara_id'=>$modelPenyertaanSukanAcara->penyertaan_sukan_acara_id])->one()) == null) {
                    $modelAtletPencapaian = new AtletPencapaian();
                }

                //if($model->nama_kejohanan){
                if($model->nama_kejohanan_temasya){
                    $refPerancanganProgram = PerancanganProgram::findOne(['perancangan_program_id' => $model->nama_kejohanan_temasya]);
                    $modelAtletPencapaian->nama_kejohanan_temasya = $refPerancanganProgram['nama_program'];
                    $modelAtletPencapaian->tarikh_mula_kejohanan = $refPerancanganProgram['tarikh_mula'];
                    $modelAtletPencapaian->tarikh_tamat_kejohanan = $refPerancanganProgram['tarikh_tamat'];
                } /*elseif($model->nama_temasya) {
                    $refTemasya = RefTemasya::findOne(['id' => $model->nama_temasya]);
                    $modelAtletPencapaian->nama_kejohanan_temasya = $refTemasya['desc'];
                    $modelAtletPencapaian->tarikh_mula_kejohanan = $model->tarikh_mula;
                    $modelAtletPencapaian->tarikh_tamat_kejohanan = $model->tarikh_tamat;
                }*/

                $modelAtletPencapaian->atlet_id = $modelPenyertaanSukanAcara->atlet;
                $modelAtletPencapaian->nama_sukan = $model->nama_sukan;
                $modelAtletPencapaian->nama_acara = $modelPenyertaanSukanAcara->nama_acara;
                $modelAtletPencapaian->peringkat_kejohanan = $model->peringkat;
                $modelAtletPencapaian->penyertaan_sukan_id = $model->penyertaan_sukan_id;
                $modelAtletPencapaian->penyertaan_sukan_acara_id = $modelPenyertaanSukanAcara->penyertaan_sukan_acara_id;
                $modelAtletPencapaian->pencapaian = $modelPenyertaanSukanAcara->keputusan;
                $modelAtletPencapaian->save();
            }
            
            return $this->redirect(['view', 'id' => $model->penyertaan_sukan_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'searchModelPenyertaanSukanAcara' => $searchModelPenyertaanSukanAcara,
                'dataProviderPenyertaanSukanAcara' => $dataProviderPenyertaanSukanAcara,
                'searchModelPenyertaanSukanJurulatih' => $searchModelPenyertaanSukanJurulatih,
                'dataProviderPenyertaanSukanJurulatih' => $dataProviderPenyertaanSukanJurulatih,
                'searchModelPenyertaanSukanPegawai' => $searchModelPenyertaanSukanPegawai,
                'dataProviderPenyertaanSukanPegawai' => $dataProviderPenyertaanSukanPegawai,
                'searchModelPenyertaanSukanPengurus' => $searchModelPenyertaanSukanPengurus,
                'dataProviderPenyertaanSukanPengurus' => $dataProviderPenyertaanSukanPengurus,
                'searchModelPenyertaanSukanPerbelanjaan' => $searchModelPenyertaanSukanPerbelanjaan,
                'dataProviderPenyertaanSukanPerbelanjaan' => $dataProviderPenyertaanSukanPerbelanjaan,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Updates an existing PenyertaanSukan model.
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
        
        $queryPar['PenyertaanSukanAcaraSearch']['penyertaan_sukan_id'] = $id;
        $queryPar['PenyertaanSukanJurulatihSearch']['penyertaan_sukan_id'] = $id;
        $queryPar['PenyertaanSukanPegawaiSearch']['penyertaan_sukan_id'] = $id;
        $queryPar['PenyertaanSukanPengurusSearch']['penyertaan_sukan_id'] = $id;
        $queryPar['PenyertaanSukanPerbelanjaanSearch']['penyertaan_sukan_id'] = $id;
        
        $searchModelPenyertaanSukanAcara  = new PenyertaanSukanAcaraSearch();
        $dataProviderPenyertaanSukanAcara = $searchModelPenyertaanSukanAcara->search($queryPar);
        $searchModelPenyertaanSukanJurulatih = new PenyertaanSukanJurulatihSearch();
        $dataProviderPenyertaanSukanJurulatih = $searchModelPenyertaanSukanJurulatih->search($queryPar);
        $searchModelPenyertaanSukanPegawai = new PenyertaanSukanPegawaiSearch();
        $dataProviderPenyertaanSukanPegawai = $searchModelPenyertaanSukanPegawai->search($queryPar);
        $searchModelPenyertaanSukanPengurus = new PenyertaanSukanPengurusSearch();
        $dataProviderPenyertaanSukanPengurus = $searchModelPenyertaanSukanPengurus->search($queryPar);
        $searchModelPenyertaanSukanPerbelanjaan = new PenyertaanSukanPerbelanjaanSearch();
        $dataProviderPenyertaanSukanPerbelanjaan = $searchModelPenyertaanSukanPerbelanjaan->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //if($model->nama_kejohanan){
            if($model->nama_kejohanan_temasya){
                // update Penilaian Prestasi modul for Kejohanan only
                $modelPenilaianPestasi = null;
                 if (($modelPenilaianPestasi = PenilaianPestasi::find()->where(['penyertaan_sukan_id'=>$model->penyertaan_sukan_id])->one()) == null) {
                    $modelPenilaianPestasi = new PenilaianPestasi();
                }
                
                $modelPenyertaanSukanAcaraFirstOne = null;
                if (($modelPenyertaanSukanAcaraFirstOne = PenyertaanSukanAcara::find()->where(['penyertaan_sukan_id'=>$model->penyertaan_sukan_id])->orderBy(['penyertaan_sukan_acara_id' => SORT_ASC])->one()) != null) {
                    $modelPenilaianPestasi->acara = $modelPenyertaanSukanAcaraFirstOne->nama_acara;
                }

                $modelPenilaianPestasi->penyertaan_sukan_id = $model->penyertaan_sukan_id;
                $modelPenilaianPestasi->sukan = $model->nama_sukan;
                $modelPenilaianPestasi->program = $model->program;
                $modelPenilaianPestasi->kejohanan = $model->nama_kejohanan_temasya;
                $modelPenilaianPestasi->save();

                $modelPenyertaanSukanAcaras = PenyertaanSukanAcara::findAll([
                        'penyertaan_sukan_id' => $model->penyertaan_sukan_id,
                    ]);

                foreach($modelPenyertaanSukanAcaras as $modelPenyertaanSukanAcara){
                    $modelPenilaianPrestasiAtletSasaran = null;
                    if (($modelPenilaianPrestasiAtletSasaran = PenilaianPrestasiAtletSasaran::find()
                            ->where(['penyertaan_sukan_id'=>$model->penyertaan_sukan_id])
                            ->andWhere(['penyertaan_sukan_acara_id'=>$modelPenyertaanSukanAcara->penyertaan_sukan_acara_id])->one()) == null) {
                        $modelPenilaianPrestasiAtletSasaran = new PenilaianPrestasiAtletSasaran();
                    }
                    
                    $modelPenilaianPrestasiAtletSasaran->penilaian_pestasi_id = $modelPenilaianPestasi->penilaian_pestasi_id;
                    $modelPenilaianPrestasiAtletSasaran->atlet = $modelPenyertaanSukanAcara->atlet;
                    $modelPenilaianPrestasiAtletSasaran->sasaran = $modelPenyertaanSukanAcara->sasaran;
                    $modelPenilaianPrestasiAtletSasaran->penyertaan_sukan_id = $modelPenyertaanSukanAcara->penyertaan_sukan_id;
                    $modelPenilaianPrestasiAtletSasaran->penyertaan_sukan_acara_id = $modelPenyertaanSukanAcara->penyertaan_sukan_acara_id;
                    $modelPenilaianPrestasiAtletSasaran->save();
                }
                
                $model->penilaian_pestasi_id = $modelPenilaianPestasi->penilaian_pestasi_id;
                $model->save();
            }
            
            $modelPenyertaanSukanAcaras = PenyertaanSukanAcara::findAll([
                        'penyertaan_sukan_id' => $model->penyertaan_sukan_id,
                    ]);

            foreach($modelPenyertaanSukanAcaras as $modelPenyertaanSukanAcara){

                // Atlet Profile Pencapaian
                $modelAtletPencapaian = null;
                if (($modelAtletPencapaian = AtletPencapaian::find()->where(['atlet_id'=>$modelPenyertaanSukanAcara->atlet])
                        ->andWhere(['penyertaan_sukan_id'=>$model->penyertaan_sukan_id])
                        ->andWhere(['penyertaan_sukan_acara_id'=>$modelPenyertaanSukanAcara->penyertaan_sukan_acara_id])->one()) == null) {
                    $modelAtletPencapaian = new AtletPencapaian();
                }

                //if($model->nama_kejohanan){
                if($model->nama_kejohanan_temasya){
                    $refPerancanganProgram = PerancanganProgram::findOne(['perancangan_program_id' => $model->nama_kejohanan_temasya]);
                    $modelAtletPencapaian->nama_kejohanan_temasya = $refPerancanganProgram['nama_program'];
                    $modelAtletPencapaian->tarikh_mula_kejohanan = $refPerancanganProgram['tarikh_mula'];
                    $modelAtletPencapaian->tarikh_tamat_kejohanan = $refPerancanganProgram['tarikh_tamat'];
                } /*elseif($model->nama_temasya) {
                    $refTemasya = RefTemasya::findOne(['id' => $model->nama_temasya]);
                    $modelAtletPencapaian->nama_kejohanan_temasya = $refTemasya['desc'];
                    $modelAtletPencapaian->tarikh_mula_kejohanan = $model->tarikh_mula;
                    $modelAtletPencapaian->tarikh_tamat_kejohanan = $model->tarikh_tamat;
                }*/

                $modelAtletPencapaian->atlet_id = $modelPenyertaanSukanAcara->atlet;
                $modelAtletPencapaian->nama_sukan = $model->nama_sukan;
                $modelAtletPencapaian->nama_acara = $modelPenyertaanSukanAcara->nama_acara;
                $modelAtletPencapaian->peringkat_kejohanan = $model->peringkat;
                $modelAtletPencapaian->penyertaan_sukan_id = $model->penyertaan_sukan_id;
                $modelAtletPencapaian->penyertaan_sukan_acara_id = $modelPenyertaanSukanAcara->penyertaan_sukan_acara_id;
                $modelAtletPencapaian->pencapaian = $modelPenyertaanSukanAcara->keputusan;
                $modelAtletPencapaian->save();
            }
            
            return $this->redirect(['view', 'id' => $model->penyertaan_sukan_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'searchModelPenyertaanSukanAcara' => $searchModelPenyertaanSukanAcara,
                'dataProviderPenyertaanSukanAcara' => $dataProviderPenyertaanSukanAcara,
                'searchModelPenyertaanSukanJurulatih' => $searchModelPenyertaanSukanJurulatih,
                'dataProviderPenyertaanSukanJurulatih' => $dataProviderPenyertaanSukanJurulatih,
                'searchModelPenyertaanSukanPegawai' => $searchModelPenyertaanSukanPegawai,
                'dataProviderPenyertaanSukanPegawai' => $dataProviderPenyertaanSukanPegawai,
                'searchModelPenyertaanSukanPengurus' => $searchModelPenyertaanSukanPengurus,
                'dataProviderPenyertaanSukanPengurus' => $dataProviderPenyertaanSukanPengurus,
                'searchModelPenyertaanSukanPerbelanjaan' => $searchModelPenyertaanSukanPerbelanjaan,
                'dataProviderPenyertaanSukanPerbelanjaan' => $dataProviderPenyertaanSukanPerbelanjaan,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Deletes an existing PenyertaanSukan model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the PenyertaanSukan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PenyertaanSukan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PenyertaanSukan::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionSetSukan($sukan_id){
        
        $session = new Session;
        $session->open();

        $session['penyertaan-sukan_sukan_id'] = $sukan_id;
        
        $session->close();
    }
    
    public function actionPrintJkkJkp($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }  
        $model = $this->findModel($id);
        
        if(isset($model->tarikh_mula))
        {
            $model->tarikh_mula = date('d/m/Y',strtotime($model->tarikh_mula));
        }
        
        if(isset($model->tarikh_tamat))
        {
            $model->tarikh_tamat = date('d/m/Y',strtotime($model->tarikh_tamat));
        }
        
        $ref = \app\models\PerancanganProgramPlan::findOne(['perancangan_program_id' => $model->nama_kejohanan_temasya]);
        $model->nama_kejohanan_temasya = $ref['nama_program'];
        
        $ref = RefSukan::findOne(['id' => $model->nama_sukan]);
        $model->nama_sukan = $ref['desc'];
		
		$ref = RefProgramSemasaSukanAtlet::findOne(['id' => $model->program]);
        $model->program = $ref['desc'];
        
        $perbelanjaanSukanModel = PenyertaanSukanPerbelanjaan::find()->where(['penyertaan_sukan_id' => $model->penyertaan_sukan_id])->all();
        
        //count orang
        $atletCount = PenyertaanSukanAcara::find()->where(['penyertaan_sukan_id' => $model->penyertaan_sukan_id])->count();
        $jurulatihCount = PenyertaanSukanJurulatih::find()->where(['penyertaan_sukan_id' => $model->penyertaan_sukan_id])->count();
        $pegawaiCount = PenyertaanSukanPegawai::find()->where(['penyertaan_sukan_id' => $model->penyertaan_sukan_id])->count();
        $pengurusCount = PenyertaanSukanPengurus::find()->where(['penyertaan_sukan_id' => $model->penyertaan_sukan_id])->count();
        
        $totalOrang = $atletCount+$jurulatihCount+$pegawaiCount+$pengurusCount;

        $pdf = new \mPDF('utf-8', 'A4-L');

        $pdf->title = 'Borang JKB';

        $stylesheet = file_get_contents('css/report.css');

        $pdf->WriteHTML($stylesheet,1);
        
        $pdf->WriteHTML($this->renderpartial('print_jkk_jkp', [
             'model'  => $model,
             'perbelanjaanSukanModel' => $perbelanjaanSukanModel,
             'totalOrang' => $totalOrang,
			 'atletCount' => $atletCount,
			 'jurulatihCount' => $jurulatihCount,
			 'pegawaiCount' => $pegawaiCount,
			 'pengurusCount' => $pengurusCount,
        ]));

        $pdf->Output('Borang_jkb_'.$model->penyertaan_sukan_id.'.pdf', 'I');
    }
    
    public function actionLaporanCompetitionTraining()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new PenyertaanSukan;
        
        if ($model->load(Yii::$app->request->post())) {            
            $pdf = new \mPDF('utf-8', 'A4-L');

            $pdf->title = GeneralLabel::competition_and_training_information;

            //$pdf->cssFile = 'report.css';
            $stylesheet = file_get_contents('css/report.css');

            $pdf->WriteHTML($stylesheet,1);
            
            $pdf->WriteHTML($this->renderpartial('generate_competition_training', [
                  'model'  => $model,
            ]));

            $pdf->Output('Competition_Training'.$model->nama_sukan.'_'.$model->program.'.pdf', 'I');
        }
        
        return $this->render('laporan_competition_training', [
             'model' => $model,
        ]);
    }
    
    public function actionLaporanPenyertaanKejohanan($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $parentModel = $this->findModel($id);
        
        $model = LaporanPenyertaanKejohanan::findOne(['penyertaan_sukan_id' => $id]);
        
        $queryPar['KejohananPegawaiSearch']['penyertaan_sukan_id'] = $id;
        $queryPar['KejohananPengurusSearch']['penyertaan_sukan_id'] = $id;
        $queryPar['KejohananJurulatihSearch']['penyertaan_sukan_id'] = $id;
        $queryPar['KejohananAtletSearch']['penyertaan_sukan_id'] = $id;
        $queryPar['KejohananPrestasiSearch']['penyertaan_sukan_id'] = $id;
        $queryPar['KejohananRankingSearch']['penyertaan_sukan_id'] = $id;

        $searchModelKejohananPegawai  = new LaporanPenyertaanKejohananPegawaiSearch();
        $dataProviderKejohananPegawai = $searchModelKejohananPegawai->search($queryPar, $id);
        
        $searchModelKejohananPengurus  = new LaporanPenyertaanKejohananPengurusSearch();
        $dataProviderKejohananPengurus = $searchModelKejohananPengurus->search($queryPar, $id);
        
        $searchModelKejohananJurulatih  = new LaporanPenyertaanKejohananJurulatihSearch();
        $dataProviderKejohananJurulatih = $searchModelKejohananJurulatih->search($queryPar, $id);
        
        $searchModelKejohananAtlet  = new LaporanPenyertaanKejohananAtletSearch();
        $dataProviderKejohananAtlet = $searchModelKejohananAtlet->search($queryPar, $id);
        
        $searchModelKejohananPrestasi  = new LaporanPenyertaanKejohananPrestasiSearch();
        $dataProviderKejohananPrestasi = $searchModelKejohananPrestasi->search($queryPar, $id);

        $searchModelKejohananRanking  = new LaporanPenyertaanKejohananRankingSearch();
        $dataProviderKejohananRanking = $searchModelKejohananRanking->search($queryPar, $id);
        
        $oriJadualName = '';
        $oriLaporanName = '';
        
        if($model === NULL) {
            $model = new LaporanPenyertaanKejohanan;
            //autopopulate
            $pegawai = PenyertaanSukanPegawai::find()->where(['penyertaan_sukan_id' => $id])->all();
            if(count($pegawai) > 0)
            {
                foreach($pegawai as $item)
                {
                    //check if exist
                    $exist = LaporanPenyertaanKejohananPegawai::find()->where(['nama' => $item->nama, 'penyertaan_sukan_id' => $id])->one();
                    if(count($exist) === 0) {
                        $p = new LaporanPenyertaanKejohananPegawai;
                        $p->penyertaan_sukan_id = $id;
                        $p->nama = $item->nama;
                        $p->save();
                    }
                }
            }
            $pengurus = PenyertaanSukanPengurus::find()->where(['penyertaan_sukan_id' => $id])->all();
            if(count($pengurus) > 0)
            {
                foreach($pengurus as $item)
                {
                    //check if exist
                    $exist = LaporanPenyertaanKejohananPengurus::find()->where(['nama' => $item->nama, 'penyertaan_sukan_id' => $id])->one();
                    if(count($exist) === 0) {
                        $p = new LaporanPenyertaanKejohananPengurus;
                        $p->penyertaan_sukan_id = $id;
                        $p->nama = $item->nama;
                        $p->save();
                    }
                }
            }
            $jurulatih = PenyertaanSukanJurulatih::find()->where(['penyertaan_sukan_id' => $id])->all();
            if(count($jurulatih) > 0)
            {
                foreach($jurulatih as $item)
                {
                    //check if exist
                    $exist = LaporanPenyertaanKejohananJurulatih::find()->where(['jurulatih_id' => $item->jurulatih_id, 'penyertaan_sukan_id' => $id])->one();
                    if(count($exist) === 0) {
                        $p = new LaporanPenyertaanKejohananJurulatih;
                        $p->penyertaan_sukan_id = $id;
                        $p->jurulatih_id = $item->jurulatih_id;
                        $p->save();
                    }
                }
            }
            $atlet = PenyertaanSukanAcara::find()->where(['penyertaan_sukan_id' => $id])->all();
            if(count($atlet) > 0)
            {
                foreach($atlet as $item)
                {
                    //check if exist
                    $exist = LaporanPenyertaanKejohananAtlet::find()->where(['atlet_id' => $item->atlet, 'penyertaan_sukan_id' => $id])->one();
                    if(count($exist) === 0) {
                        $p = new LaporanPenyertaanKejohananAtlet;
                        $p->penyertaan_sukan_id = $id;
                        $p->atlet_id = $item->atlet;
                        $p->save();
                    }
                    //prestasi
                    $exist = LaporanPenyertaanKejohananPrestasi::find()->where(['atlet_id' => $item->atlet, 'penyertaan_sukan_id' => $id])->one();
                    if(count($exist) === 0) {
                        $ref = RefKeputusan::findOne(['id' => $item->keputusan]);
                        $keputusan = $ref['desc'];                        
                        $p = new LaporanPenyertaanKejohananPrestasi;
                        $p->penyertaan_sukan_id = $id;
                        $p->atlet_id = $item->atlet;
                        $p->acara = $item->nama_acara;
                        $p->sasaran = $item->sasaran;
                        $p->pencapaian = $keputusan;
                        $p->catatan = $item->catatan;
                        $p->save();
                        // echo '<pre>';
                        // print_r($p->getErrors());
                    }
                }
                // die;
            }
        } else
        {
            if($model->jadual_pertandingan != '' && $model->jadual_pertandingan != null)
            {
                $oriJadualName = $model->jadual_pertandingan;
            }
            if($model->laporan_kewangan != '' && $model->laporan_kewangan != null)
            {
                $oriLaporanName = $model->laporan_kewangan;
            }
        }
        
        if ($model->load(Yii::$app->request->post())) {
            $model->penyertaan_sukan_id = $id;
            
            //upload file
            $file = UploadedFile::getInstance($model, 'jadual_pertandingan');
            if(isset($file) && $file != null){
                $filename = $model->penyertaan_sukan_id . "-jadual_pertandingan";
                if($file){
                    //clean old file
                    if($oriJadualName != null || $oriJadualName != ''){
                        unlink($oriJadualName);
                    }
                    
                    $model->jadual_pertandingan = Upload::uploadFile($file, Upload::laporanPenyertaanKejohananFolder, $filename);
                }
            } else {
                $model->jadual_pertandingan = $oriJadualName;
            }
            
            //upload file
            $file = UploadedFile::getInstance($model, 'laporan_kewangan');
            if(isset($file) && $file != null){
                $filename = $model->penyertaan_sukan_id . "-laporan_kewangan";
                if($file){
                    //clean old file
                    if($oriLaporanName != null || $oriLaporanName != ''){
                        unlink($oriLaporanName);
                    }
                    
                    $model->laporan_kewangan = Upload::uploadFile($file, Upload::laporanPenyertaanKejohananFolder, $filename);
                }
            } else {
                $model->laporan_kewangan = $oriLaporanName;
            }
            
            
            if($model->save())
            {
                Yii::$app->session->setFlash('success', 'Laporan berjaya dikemaskini');
            }
        }
        
        return $this->render('laporan_penyertaan_kejohanan', [
            'parentModel' => $parentModel,
            'model' => $model,
            'dataProviderKejohananPegawai' => $dataProviderKejohananPegawai,
            'dataProviderKejohananPengurus' => $dataProviderKejohananPengurus,
            'dataProviderKejohananJurulatih' => $dataProviderKejohananJurulatih,
            'dataProviderKejohananAtlet' => $dataProviderKejohananAtlet,
            'dataProviderKejohananPrestasi' => $dataProviderKejohananPrestasi,
            'dataProviderKejohananRanking' => $dataProviderKejohananRanking,
        ]);
    }
    
    public function actionPrintLaporanPenyertaanKejohanan($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }  
        
        $model = LaporanPenyertaanKejohanan::findOne(['penyertaan_sukan_id' => $id]);
        
        $ref = RefSukan::findOne(['id' => $model->sukan]);
        $model->sukan = $ref['desc'];

        $pdf = new \mPDF('utf-8', 'A4');

        $pdf->title = 'Laporan Penyertaan Kejohanan';

        //$pdf->cssFile = 'report.css';
        $stylesheet = file_get_contents('css/report.css');

        $pdf->WriteHTML($stylesheet,1);
        
        $pdf->WriteHTML($this->renderpartial('print_laporan_penyertaan_kejohanan', [
             'model'  => $model,
        ]));

        $pdf->Output('Laporan_Penyertaan_Kejohanan'.$model->laporan_penyertaan_kejohanan_id.'.pdf', 'I');
    }
    
    public function actionLaporanPendedahanLatihan($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $parentModel = $this->findModel($id);
        
        $model = LaporanPendedahanLatihan::findOne(['penyertaan_sukan_id' => $id]);
        
        $queryPar['PendedahanPegawaiSearch']['penyertaan_sukan_id'] = $id;
        $queryPar['PendedahanJurulatihSearch']['penyertaan_sukan_id'] = $id;
        $queryPar['PendedahanAtletSearch']['penyertaan_sukan_id'] = $id;
        
        $searchModelPendedahanPegawai  = new LaporanPendedahanLatihanPegawaiSearch();
        $dataProviderPendedahanPegawai = $searchModelPendedahanPegawai->search($queryPar, $id);
        
        $searchModelPendedahanJurulatih = new LaporanPendedahanLatihanJurulatihSearch();
        $dataProviderPendedahanJurulatih = $searchModelPendedahanJurulatih->search($queryPar, $id);
        
        $searchModelPendedahanAtlet = new LaporanPendedahanLatihanAtletSearch();
        $dataProviderPendedahanAtlet = $searchModelPendedahanAtlet->search($queryPar, $id);
    
        $oriJadualName = '';
        $oriLaporanName = '';
    
        if($model === NULL) {
            $model = new LaporanPendedahanLatihan;
            //autopopulate
            $pegawai = PenyertaanSukanPegawai::find()->where(['penyertaan_sukan_id' => $id])->all();
            if(count($pegawai) > 0)
            {
                foreach($pegawai as $item)
                {
                    //check if exist
                    $exist = LaporanPendedahanLatihanPegawai::find()->where(['nama' => $item->nama, 'penyertaan_sukan_id' => $id])->one();
                    if(count($exist) === 0) {
                        $p = new LaporanPendedahanLatihanPegawai;
                        $p->penyertaan_sukan_id = $id;
                        $p->nama = $item->nama;
                        $p->save();
                    }
                }
            }
            $jurulatih = PenyertaanSukanJurulatih::find()->where(['penyertaan_sukan_id' => $id])->all();
            if(count($jurulatih) > 0)
            {
                foreach($jurulatih as $item)
                {
                    //check if exist
                    $exist = LaporanPendedahanLatihanJurulatih::find()->where(['jurulatih_id' => $item->jurulatih_id, 'penyertaan_sukan_id' => $id])->one();
                    if(count($exist) === 0) {
                        $p = new LaporanPendedahanLatihanJurulatih;
                        $p->penyertaan_sukan_id = $id;
                        $p->jurulatih_id = $item->jurulatih_id;
                        $p->save();
                    }
                }
            }
            $atlet = PenyertaanSukanAcara::find()->where(['penyertaan_sukan_id' => $id])->all();
            if(count($atlet) > 0)
            {
                foreach($atlet as $item)
                {
                    //check if exist
                    $exist = LaporanPendedahanLatihanAtlet::find()->where(['atlet_id' => $item->atlet, 'penyertaan_sukan_id' => $id])->one();
                    if(count($exist) === 0) {
                        $p = new LaporanPendedahanLatihanAtlet;
                        $p->penyertaan_sukan_id = $id;
                        $p->atlet_id = $item->atlet;
                        $p->save();
                    }
                }
            }
            
        } else {
            if($model->jadual_latihan != '' && $model->jadual_latihan != null)
            {
                $oriJadualName = $model->jadual_latihan;
            }
            if($model->laporan_kewangan != '' && $model->laporan_kewangan != null)
            {
                $oriLaporanName = $model->laporan_kewangan;
            }
        }
        
        if ($model->load(Yii::$app->request->post())) {
            $model->penyertaan_sukan_id = $id;
            
            //upload file
            $file = UploadedFile::getInstance($model, 'jadual_latihan');
            if(isset($file) && $file != null){
                $filename = $model->penyertaan_sukan_id . "-jadual_latihan";
                if($file){
                    //clean old file
                    if($oriJadualName != null || $oriJadualName != ''){
                        unlink($oriJadualName);
                    }
                    
                    $model->jadual_latihan = Upload::uploadFile($file, Upload::laporanPendedahanLatihanFolder, $filename);
                }
            } else {
                $model->jadual_latihan = $oriJadualName;
            }
            
            //upload file
            $file = UploadedFile::getInstance($model, 'laporan_kewangan');
            if(isset($file) && $file != null){
                $filename = $model->penyertaan_sukan_id . "-laporan_kewangan";
                if($file){
                    //clean old file
                    if($oriLaporanName != null || $oriLaporanName != ''){
                        unlink($oriLaporanName);
                    }
                    
                    $model->laporan_kewangan = Upload::uploadFile($file, Upload::laporanPendedahanLatihanFolder, $filename);
                }
            } else {
                $model->laporan_kewangan = $oriLaporanName;
            }
            
            
            if($model->save())
            {
                Yii::$app->session->setFlash('success', 'Laporan berjaya dikemaskini');
            }
        }
    
        return $this->render('laporan_pendedahan_latihan', [
            'parentModel' => $parentModel,
            'model' => $model,
            'dataProviderPendedahanPegawai' => $dataProviderPendedahanPegawai,
            'dataProviderPendedahanJurulatih' => $dataProviderPendedahanJurulatih,
            'dataProviderPendedahanAtlet' => $dataProviderPendedahanAtlet,
        ]);
    }
    
    public function actionPrintLaporanPendedahanLatihan($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }  
        
        $model = LaporanPendedahanLatihan::findOne(['penyertaan_sukan_id' => $id]);
        
        $ref = RefSukan::findOne(['id' => $model->sukan]);
        $model->sukan = $ref['desc'];
        
        $ref = RefAktivitiPendedahan::findOne(['id' => $model->aktiviti]);
        $model->aktiviti = $ref['desc'];
        
        $pdf = new \mPDF('utf-8', 'A4');

        $pdf->title = 'Laporan Pendedahan Latihan';

        //$pdf->cssFile = 'report.css';
        $stylesheet = file_get_contents('css/report.css');

        $pdf->WriteHTML($stylesheet,1);
        
        $pdf->WriteHTML($this->renderpartial('print_laporan_pendedahan_latihan', [
             'model'  => $model,
        ]));

        $pdf->Output('Laporan_Pendedahan_Latihan'.$model->laporan_pendedahan_latihan_id.'.pdf', 'I');
    }
    
    public function actionPrintPenilaianPrestasi($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }  
        
        $parentModel = PenyertaanSukan::findOne(['penyertaan_sukan_id' => $id]);
        
        $model = PenyertaanSukanAcara::find()->where(['penyertaan_sukan_id' => $id])->all();
        
        $pdf = new \mPDF('utf-8', 'A4-L');

        $pdf->title = 'Penilaian Prestasi Mengikut Kejohanan';

        //$pdf->cssFile = 'report.css';
        $stylesheet = file_get_contents('css/report.css');

        $pdf->WriteHTML($stylesheet,1);
        
        $pdf->WriteHTML($this->renderpartial('print_penilaian_prestasi', [
            'parentModel'  => $parentModel,
             'model'  => $model,
        ]));

        $pdf->Output('Penilaian_Prestasi_Mengikut_Kejohanan'.$parentModel->penyertaan_sukan_id.'.pdf', 'I');
    }
	
	public function actionSuratMakluman($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }    
        
        $model = new MsnSuratRasmi();

        if ($model->load(Yii::$app->request->post())) {
            $parentModel = $this->findModel($id);
			
			$ref = RefSukan::findOne(['id' => $parentModel->nama_sukan]);
			$parentModel->nama_sukan = $ref['desc'];
			
			$ref = PerancanganProgramPlan::findOne(['perancangan_program_id' => $parentModel->nama_kejohanan_temasya]);
			$parentModel->nama_kejohanan_temasya = $ref['nama_program'];
			
			$ref = RefProgramSemasaSukanAtlet::findOne(['id' => $parentModel->program]);
			$parentModel->program = $ref['desc'];
			
			$PenyertaanSukanAcara = PenyertaanSukanAcara::find()->joinWith(['refAtlet', 'refAcara'])->where(['penyertaan_sukan_id' => $parentModel->penyertaan_sukan_id])->all();
			
            $pdf = new \mPDF('utf-8', 'A4');

            $pdf->title = "Surat Makluman";
            $stylesheet = file_get_contents('css/report.css');

            $pdf->WriteHTML($stylesheet,1);
            
            $pdf->WriteHTML($this->renderpartial('generate_surat_makluman', [
                 'parentModel'  => $parentModel,
                 'model' => $model,
				 'PenyertaanSukanAcara' => $PenyertaanSukanAcara,
            ]));

            $pdf->Output('Surat_Makluman_'.$id.'.pdf', 'I');
        }
        
        return $this->render('surat_makluman', [
            'model' => $model,
        ]);
    }
}
