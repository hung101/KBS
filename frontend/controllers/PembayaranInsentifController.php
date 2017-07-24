<?php

namespace frontend\controllers;

use Yii;
use app\models\PembayaranInsentif;
use frontend\models\PembayaranInsentifSearch;
use app\models\PembayaranInsentifAtlet;
use frontend\models\PembayaranInsentifAtletSearch;
use app\models\PembayaranInsentifJurulatih;
use frontend\models\PembayaranInsentifJurulatihSearch;
use app\models\PembayaranInsentifPersatuan;
use frontend\models\PembayaranInsentifPersatuanSearch;
use app\models\MsnLaporanInsentifMesyuaratJawatankuasaBantuanSgar;
use app\models\MsnLaporan;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Session;
use yii\helpers\BaseUrl;

use app\models\general\GeneralVariable;
use app\models\general\GeneralLabel;
use common\models\general\GeneralFunction;

// table reference
use app\models\RefJenisInsentif;
use app\models\RefPingatInsentif;
use app\models\PengurusanInsentifTetapanShakamShakar;
use app\models\RefInsentifKejohanan;
use app\models\PerancanganProgram;
use app\models\RefJenisAktiviti;
use app\models\RefSukan;
use app\models\RefInsentifPeringkat;
use app\models\RefInsentifKelas;
use app\models\RefAcaraInsentif;
use app\models\RefKelulusanInsentif;
use app\models\ProfilBadanSukan;
use app\models\PerancanganProgramPlan;

/**
 * PembayaranInsentifController implements the CRUD actions for PembayaranInsentif model.
 */
class PembayaranInsentifController extends Controller
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
     * Lists all PembayaranInsentif models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $queryParams = Yii::$app->request->queryParams;
        
        if(isset(Yii::$app->user->identity->peranan_akses['MSN']['pembayaran-insentif']['kelulusan'])) {
            $queryParams['PembayaranInsentifSearch']['hantar_flag'] = 1;
        }
        
        $searchModel = new PembayaranInsentifSearch();
        $dataProvider = $searchModel->search($queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PembayaranInsentif model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = $this->findModel($id);
                
        // get atlet dropdown value's descriptions
        $ref = RefJenisInsentif::findOne(['id' => $model->jenis_insentif]);
        $model->jenis_insentif = $ref['desc'];
        
        $ref = RefPingatInsentif::findOne(['id' => $model->pingat]);
        $model->pingat = $ref['desc'];
        
        $ref = PengurusanInsentifTetapanShakamShakar::findOne(['pengurusan_insentif_tetapan_shakam_shakar_id' => $model->kumpulan_temasya_kejohanan]);
        $model->kumpulan_temasya_kejohanan = $ref['kumpulan_temasya_kejohanan'];
        
        $ref = RefInsentifKejohanan::findOne(['id' => $model->kejohanan]);
        $model->kejohanan = $ref['desc'];
        
        $ref = PerancanganProgramPlan::findOne(['perancangan_program_id' => $model->nama_kejohanan]);
        $model->nama_kejohanan = $ref['nama_program'];
        
        $ref = RefSukan::findOne(['id' => $model->sukan]);
        $model->sukan = $ref['desc'];
        
        $ref = RefInsentifPeringkat::findOne(['id' => $model->peringkat]);
        $model->peringkat = $ref['desc'];
        
        $ref = RefInsentifKelas::findOne(['id' => $model->kelas]);
        $model->kelas = $ref['desc'];
        
        $model->acara_id = $model->acara;
        $ref = RefAcaraInsentif::findOne(['id' => $model->acara]);
        $model->acara = $ref['desc'];
        
        $ref = RefKelulusanInsentif::findOne(['id' => $model->kelulusan]);
        $model->kelulusan = $ref['desc'];
        
        $ref = ProfilBadanSukan::findOne(['profil_badan_sukan' => $model->persatuan]);
        $model->persatuan = $ref['nama_badan_sukan'];
        
        if($model->tarikh_mula != "") {$model->tarikh_mula = GeneralFunction::convert($model->tarikh_mula, GeneralFunction::TYPE_DATE);}
        if($model->tarikh_tamat != "") {$model->tarikh_tamat = GeneralFunction::convert($model->tarikh_tamat, GeneralFunction::TYPE_DATE);}
        if($model->tarikh_kelulusan != "") {$model->tarikh_kelulusan = GeneralFunction::convert($model->tarikh_kelulusan, GeneralFunction::TYPE_DATE);}
        if($model->tarikh_pembayaran_insentif != "") {$model->tarikh_pembayaran_insentif = GeneralFunction::convert($model->tarikh_pembayaran_insentif, GeneralFunction::TYPE_DATE);}
        
        $queryPar = null;
        
        $queryPar['PembayaranInsentifAtletSearch']['pembayaran_insentif_id'] = $id;
        $queryPar['PembayaranInsentifJurulatihSearch']['pembayaran_insentif_id'] = $id;
        $queryPar['PembayaranInsentifPersatuanSearch']['pembayaran_insentif_id'] = $id;
        
        $searchModelPembayaranInsentifAtlet  = new PembayaranInsentifAtletSearch();
        $dataProviderPembayaranInsentifAtlet = $searchModelPembayaranInsentifAtlet->search($queryPar);
        
        $searchModelPembayaranInsentifJurulatih  = new PembayaranInsentifJurulatihSearch();
        $dataProviderPembayaranInsentifJurulatih = $searchModelPembayaranInsentifJurulatih->search($queryPar);
        
        $searchModelPembayaranInsentifPersatuan  = new PembayaranInsentifPersatuanSearch();
        $dataProviderPembayaranInsentifPersatuan = $searchModelPembayaranInsentifPersatuan->search($queryPar);
        
        return $this->render('view', [
            'model' => $model,
            'searchModelPembayaranInsentifAtlet' => $searchModelPembayaranInsentifAtlet,
            'dataProviderPembayaranInsentifAtlet' => $dataProviderPembayaranInsentifAtlet,
            'searchModelPembayaranInsentifJurulatih' => $searchModelPembayaranInsentifJurulatih,
            'dataProviderPembayaranInsentifJurulatih' => $dataProviderPembayaranInsentifJurulatih,
            'searchModelPembayaranInsentifPersatuan' => $searchModelPembayaranInsentifPersatuan,
            'dataProviderPembayaranInsentifPersatuan' => $dataProviderPembayaranInsentifPersatuan,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new PembayaranInsentif model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new PembayaranInsentif();
        
        $queryPar = null;
        
        Yii::$app->session->open();
        
        if(isset(Yii::$app->session->id)){
            $queryPar['PembayaranInsentifAtletSearch']['session_id'] = Yii::$app->session->id;
            $queryPar['PembayaranInsentifJurulatihSearch']['session_id'] = Yii::$app->session->id;
            $queryPar['PembayaranInsentifPersatuanSearch']['session_id'] = Yii::$app->session->id;
        }
        
        $searchModelPembayaranInsentifAtlet  = new PembayaranInsentifAtletSearch();
        $dataProviderPembayaranInsentifAtlet = $searchModelPembayaranInsentifAtlet->search($queryPar);
        
        $searchModelPembayaranInsentifJurulatih  = new PembayaranInsentifJurulatihSearch();
        $dataProviderPembayaranInsentifJurulatih = $searchModelPembayaranInsentifJurulatih->search($queryPar);
        
        $searchModelPembayaranInsentifPersatuan  = new PembayaranInsentifPersatuanSearch();
        $dataProviderPembayaranInsentifPersatuan = $searchModelPembayaranInsentifPersatuan->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $AtletInsentif = 0;
            
            if($dataProviderPembayaranInsentifAtlet->getTotalCount() > 0){
                $totalAtlet = $dataProviderPembayaranInsentifAtlet->getTotalCount();
                $AtletInsentif = $model->jumlah / $totalAtlet;
            }
                    
            if(isset(Yii::$app->session->id)){
                PembayaranInsentifAtlet::updateAll(['pembayaran_insentif_id' => $model->pembayaran_insentif_id, 'insentif' => $AtletInsentif], 'session_id = "'.Yii::$app->session->id.'"');
                PembayaranInsentifAtlet::updateAll(['session_id' => ''], 'pembayaran_insentif_id = "'.$model->pembayaran_insentif_id.'"');
                
                PembayaranInsentifJurulatih::updateAll(['pembayaran_insentif_id' => $model->pembayaran_insentif_id], 'session_id = "'.Yii::$app->session->id.'"');
                PembayaranInsentifJurulatih::updateAll(['session_id' => ''], 'pembayaran_insentif_id = "'.$model->pembayaran_insentif_id.'"');
                
                PembayaranInsentifPersatuan::updateAll(['pembayaran_insentif_id' => $model->pembayaran_insentif_id], 'session_id = "'.Yii::$app->session->id.'"');
                PembayaranInsentifPersatuan::updateAll(['session_id' => ''], 'pembayaran_insentif_id = "'.$model->pembayaran_insentif_id.'"');
            }
            
            return $this->redirect(['view', 'id' => $model->pembayaran_insentif_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'searchModelPembayaranInsentifAtlet' => $searchModelPembayaranInsentifAtlet,
                'dataProviderPembayaranInsentifAtlet' => $dataProviderPembayaranInsentifAtlet,
                'searchModelPembayaranInsentifJurulatih' => $searchModelPembayaranInsentifJurulatih,
                'dataProviderPembayaranInsentifJurulatih' => $dataProviderPembayaranInsentifJurulatih,
                'searchModelPembayaranInsentifPersatuan' => $searchModelPembayaranInsentifPersatuan,
                'dataProviderPembayaranInsentifPersatuan' => $dataProviderPembayaranInsentifPersatuan,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Updates an existing PembayaranInsentif model.
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
        
        $queryPar['PembayaranInsentifAtletSearch']['pembayaran_insentif_id'] = $id;
        $queryPar['PembayaranInsentifJurulatihSearch']['pembayaran_insentif_id'] = $id;
        $queryPar['PembayaranInsentifPersatuanSearch']['pembayaran_insentif_id'] = $id;
        
        $searchModelPembayaranInsentifAtlet  = new PembayaranInsentifAtletSearch();
        $dataProviderPembayaranInsentifAtlet = $searchModelPembayaranInsentifAtlet->search($queryPar);
        
        $searchModelPembayaranInsentifJurulatih  = new PembayaranInsentifJurulatihSearch();
        $dataProviderPembayaranInsentifJurulatih = $searchModelPembayaranInsentifJurulatih->search($queryPar);
        
        $searchModelPembayaranInsentifPersatuan  = new PembayaranInsentifPersatuanSearch();
        $dataProviderPembayaranInsentifPersatuan = $searchModelPembayaranInsentifPersatuan->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $AtletInsentif = 0;
            
            if($dataProviderPembayaranInsentifAtlet->getTotalCount() > 0){
                $totalAtlet = $dataProviderPembayaranInsentifAtlet->getTotalCount();
                $AtletInsentif = $model->jumlah / $totalAtlet;
            }
            
            PembayaranInsentifAtlet::updateAll(['insentif' => $AtletInsentif], 'pembayaran_insentif_id = "'.$model->pembayaran_insentif_id.'"');
            
            return $this->redirect(['view', 'id' => $model->pembayaran_insentif_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'searchModelPembayaranInsentifAtlet' => $searchModelPembayaranInsentifAtlet,
                'dataProviderPembayaranInsentifAtlet' => $dataProviderPembayaranInsentifAtlet,
                'searchModelPembayaranInsentifJurulatih' => $searchModelPembayaranInsentifJurulatih,
                'dataProviderPembayaranInsentifJurulatih' => $dataProviderPembayaranInsentifJurulatih,
                'searchModelPembayaranInsentifPersatuan' => $searchModelPembayaranInsentifPersatuan,
                'dataProviderPembayaranInsentifPersatuan' => $dataProviderPembayaranInsentifPersatuan,
                'readonly' => false,
            ]);
        }
    }
    
    /**
     * Updates an existing PembayaranInsentif model.
     * If approved is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionHantar($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = $this->findModel($id);
        
        $model->hantar_flag = 1; // set approved
        $model->tarikh_hantar = GeneralFunction::getCurrentTimestamp(); // set date capture
        
        $model->kelulusan = RefKelulusanInsentif::DALAM_PROSES;
        
        $model->save();
        
        return $this->redirect(['view', 'id' => $model->pembayaran_insentif_id]);
    }

    /**
     * Deletes an existing PembayaranInsentif model.
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
     * Finds the PembayaranInsentif model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PembayaranInsentif the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PembayaranInsentif::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionSetAcara($acara_id){
        
        $session = new Session;
        $session->open();

        $session['acara_id'] = $acara_id;
        
        $session->close();
    }
    
    public function actionSetSukan($sukan_id){
        
        $session = new Session;
        $session->open();

        $session['pembayaran_insentif_sukan_id'] = $sukan_id;
        
        $session->close();
    }
    
    public function actionSetJenisInsentif($jenis_insentif_id){
        
        $session = new Session;
        $session->open();

        $session['pembayaran_insentif_jenis_insentif_id'] = $jenis_insentif_id;
        
        $session->close();
    }
    
    public function actionSetKejohanan($kejohanan_id){
        
        $session = new Session;
        $session->open();

        $session['pembayaran_insentif_kejohanan_id'] = $kejohanan_id;
        
        $session->close();
    }
    
    public function actionSetPeringkat($peringkat_id){
        
        $session = new Session;
        $session->open();

        $session['pembayaran_insentif_peringkat_id'] = $peringkat_id;
        
        $session->close();
    }
    
    public function actionSetKelas($kelas_id){
        
        $session = new Session;
        $session->open();

        $session['pembayaran_insentif_kelas_id'] = $kelas_id;
        
        $session->close();
    }
    
    public function actionLaporanInsentifMesyuaratJawatankuasaBantuanSgar()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new MsnLaporanInsentifMesyuaratJawatankuasaBantuanSgar();
        $model->format = 'html';

        if ($model->load(Yii::$app->request->post())) {
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-laporan-insentif-mesyuarat-jawatankuasa-bantuan-sgar'
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'kelulusan' => $model->kelulusan
                    , 'sukan' => $model->sukan
                    , 'nama_kejohanan' => $model->nama_kejohanan
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-laporan-insentif-mesyuarat-jawatankuasa-bantuan-sgar'
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'kelulusan' => $model->kelulusan
                    , 'sukan' => $model->sukan
                    , 'nama_kejohanan' => $model->nama_kejohanan
                    , 'format' => $model->format
                ]);
            }
        } 

        return $this->render('laporan_insentif_mesyuarat_jawatankuasa_bantuan_sgar', [
            'model' => $model,
            'readonly' => false,
        ]);
    }
    
    public function actionGenerateLaporanInsentifMesyuaratJawatankuasaBantuanSgar($tarikh_dari, $tarikh_hingga, $kelulusan, $sukan, $nama_kejohanan, $format)
    {
        if($tarikh_dari == "") $tarikh_dari = array();
        else $tarikh_dari = array($tarikh_dari);
        
        if($tarikh_hingga == "") $tarikh_hingga = array();
        else $tarikh_hingga = array($tarikh_hingga);
        
        if($kelulusan == "") $kelulusan = array();
        else $kelulusan = array($kelulusan);
        
        if($sukan == "") $sukan = array();
        else $sukan = array($sukan);
        
        if($nama_kejohanan == "") $nama_kejohanan = array();
        else $nama_kejohanan = array($nama_kejohanan);
        
        $controls = array(
            'NAMA_KEJOHANAN' => $nama_kejohanan,
            'KELULUSAN' => $kelulusan,
            'SUKAN' => $sukan,
            'FROM_DATE' => $tarikh_dari,
            'TO_DATE' => $tarikh_hingga,
        );
        
        GeneralFunction::generateReport('/spsb/MSN/LaporanInsentifMesyuaratJawatankuasaBantuanSgar', $format, $controls, 'laporan_insentif_mesyuarat_jawatankuasa_bantuan_sgar');
    }
    
    public function actionLaporanInsentifMesyuaratJawatankuasaBantuanSikap()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new MsnLaporanInsentifMesyuaratJawatankuasaBantuanSgar();
        $model->format = 'html';

        if ($model->load(Yii::$app->request->post())) {
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-laporan-insentif-mesyuarat-jawatankuasa-bantuan-sikap'
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'kelulusan' => $model->kelulusan
                    , 'sukan' => $model->sukan
                    , 'nama_kejohanan' => $model->nama_kejohanan
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-laporan-insentif-mesyuarat-jawatankuasa-bantuan-sikap'
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'kelulusan' => $model->kelulusan
                    , 'sukan' => $model->sukan
                    , 'nama_kejohanan' => $model->nama_kejohanan
                    , 'format' => $model->format
                ]);
            }
        } 

        return $this->render('laporan_insentif_mesyuarat_jawatankuasa_bantuan_sikap', [
            'model' => $model,
            'readonly' => false,
        ]);
    }
    
    public function actionGenerateLaporanInsentifMesyuaratJawatankuasaBantuanSikap($tarikh_dari, $tarikh_hingga, $kelulusan, $sukan, $nama_kejohanan, $format)
    {
        if($tarikh_dari == "") $tarikh_dari = array();
        else $tarikh_dari = array($tarikh_dari);
        
        if($tarikh_hingga == "") $tarikh_hingga = array();
        else $tarikh_hingga = array($tarikh_hingga);
        
        if($kelulusan == "") $kelulusan = array();
        else $kelulusan = array($kelulusan);
        
        if($sukan == "") $sukan = array();
        else $sukan = array($sukan);
        
        if($nama_kejohanan == "") $nama_kejohanan = array();
        else $nama_kejohanan = array($nama_kejohanan);
        
        $controls = array(
            'NAMA_KEJOHANAN' => $nama_kejohanan,
            'KELULUSAN' => $kelulusan,
            'SUKAN' => $sukan,
            'FROM_DATE' => $tarikh_dari,
            'TO_DATE' => $tarikh_hingga,
        );
        
        GeneralFunction::generateReport('/spsb/MSN/LaporanInsentifMesyuaratJawatankuasaBantuanSikap', $format, $controls, 'laporan_insentif_mesyuarat_jawatankuasa_bantuan_sikap');
    }
    
    public function actionLaporanInsentifMesyuaratJawatankuasaBantuanShakam()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new MsnLaporanInsentifMesyuaratJawatankuasaBantuanSgar();
        $model->format = 'html';

        if ($model->load(Yii::$app->request->post())) {
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-laporan-insentif-mesyuarat-jawatankuasa-bantuan-shakam'
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'kelulusan' => $model->kelulusan
                    , 'sukan' => $model->sukan
                    , 'nama_kejohanan' => $model->nama_kejohanan
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-laporan-insentif-mesyuarat-jawatankuasa-bantuan-shakam'
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'kelulusan' => $model->kelulusan
                    , 'sukan' => $model->sukan
                    , 'nama_kejohanan' => $model->nama_kejohanan
                    , 'format' => $model->format
                ]);
            }
        } 

        return $this->render('laporan_insentif_mesyuarat_jawatankuasa_bantuan_shakam', [
            'model' => $model,
            'readonly' => false,
        ]);
    }
    
    public function actionGenerateLaporanInsentifMesyuaratJawatankuasaBantuanShakam($tarikh_dari, $tarikh_hingga, $kelulusan, $sukan, $nama_kejohanan, $format)
    {
        if($tarikh_dari == "") $tarikh_dari = array();
        else $tarikh_dari = array($tarikh_dari);
        
        if($tarikh_hingga == "") $tarikh_hingga = array();
        else $tarikh_hingga = array($tarikh_hingga);
        
        if($kelulusan == "") $kelulusan = array();
        else $kelulusan = array($kelulusan);
        
        if($sukan == "") $sukan = array();
        else $sukan = array($sukan);
        
        if($nama_kejohanan == "") $nama_kejohanan = array();
        else $nama_kejohanan = array($nama_kejohanan);
        
        $controls = array(
            'NAMA_KEJOHANAN' => $nama_kejohanan,
            'KELULUSAN' => $kelulusan,
            'SUKAN' => $sukan,
            'FROM_DATE' => $tarikh_dari,
            'TO_DATE' => $tarikh_hingga,
        );
        
        GeneralFunction::generateReport('/spsb/MSN/LaporanInsentifMesyuaratJawatankuasaBantuanShakam', $format, $controls, 'laporan_insentif_mesyuarat_jawatankuasa_bantuan_shakam');
    }
    
    public function actionLaporanInsentifMesyuaratJawatankuasaBantuanShakar()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new MsnLaporanInsentifMesyuaratJawatankuasaBantuanSgar();
        $model->format = 'html';

        if ($model->load(Yii::$app->request->post())) {
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-laporan-insentif-mesyuarat-jawatankuasa-bantuan-shakar'
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'kelulusan' => $model->kelulusan
                    , 'sukan' => $model->sukan
                    , 'nama_kejohanan' => $model->nama_kejohanan
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-laporan-insentif-mesyuarat-jawatankuasa-bantuan-shakar'
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'kelulusan' => $model->kelulusan
                    , 'sukan' => $model->sukan
                    , 'nama_kejohanan' => $model->nama_kejohanan
                    , 'format' => $model->format
                ]);
            }
        } 

        return $this->render('laporan_insentif_mesyuarat_jawatankuasa_bantuan_shakar', [
            'model' => $model,
            'readonly' => false,
        ]);
    }
    
    public function actionGenerateLaporanInsentifMesyuaratJawatankuasaBantuanShakar($tarikh_dari, $tarikh_hingga, $kelulusan, $sukan, $nama_kejohanan, $format)
    {
        if($tarikh_dari == "") $tarikh_dari = array();
        else $tarikh_dari = array($tarikh_dari);
        
        if($tarikh_hingga == "") $tarikh_hingga = array();
        else $tarikh_hingga = array($tarikh_hingga);
        
        if($kelulusan == "") $kelulusan = array();
        else $kelulusan = array($kelulusan);
        
        if($sukan == "") $sukan = array();
        else $sukan = array($sukan);
        
        if($nama_kejohanan == "") $nama_kejohanan = array();
        else $nama_kejohanan = array($nama_kejohanan);
        
        $controls = array(
            'NAMA_KEJOHANAN' => $nama_kejohanan,
            'KELULUSAN' => $kelulusan,
            'SUKAN' => $sukan,
            'FROM_DATE' => $tarikh_dari,
            'TO_DATE' => $tarikh_hingga,
        );
        
        GeneralFunction::generateReport('/spsb/MSN/LaporanInsentifMesyuaratJawatankuasaBantuanShakar', $format, $controls, 'laporan_insentif_mesyuarat_jawatankuasa_bantuan_shakar');
    }
    
    public function actionLaporanStatistikBayaranSkimInsentifMsn()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new MsnLaporanInsentifMesyuaratJawatankuasaBantuanSgar();
        $model->format = 'html';

        if ($model->load(Yii::$app->request->post())) {
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-laporan-statistik-bayaran-skim-insentif-msn'
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-laporan-statistik-bayaran-skim-insentif-msn'
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'format' => $model->format
                ]);
            }
        } 

        return $this->render('laporan_statistik_bayaran_skim_insentif_msn', [
            'model' => $model,
            'readonly' => false,
        ]);
    }
    
    public function actionGenerateLaporanStatistikBayaranSkimInsentifMsn($tarikh_dari, $tarikh_hingga, $format)
    {
        if($tarikh_dari == "") $tarikh_dari = array();
        else $tarikh_dari = array($tarikh_dari);
        
        if($tarikh_hingga == "") $tarikh_hingga = array();
        else $tarikh_hingga = array($tarikh_hingga);
        
        $controls = array(
            'FROM_DATE' => $tarikh_dari,
            'TO_DATE' => $tarikh_hingga,
        );
        
        GeneralFunction::generateReport('/spsb/MSN/LaporanStatistikBayaranSkimInsentifMsn', $format, $controls, 'laporan_statistik_bayaran_skim_insentif_msn');
    }
    
    public function actionLaporanHadiahKemenanganUntukTemasyaSukan()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new MsnLaporanInsentifMesyuaratJawatankuasaBantuanSgar();
        $model->format = 'html';

        if ($model->load(Yii::$app->request->post())) {
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-laporan-hadiah-kemenangan-untuk-temasya-sukan'
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-laporan-hadiah-kemenangan-untuk-temasya-sukan'
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'format' => $model->format
                ]);
            }
        } 

        return $this->render('laporan_hadiah_kemenangan_untuk_temasya_sukan', [
            'model' => $model,
            'readonly' => false,
        ]);
    }
    
    public function actionGenerateLaporanHadiahKemenanganUntukTemasyaSukan($tarikh_dari, $tarikh_hingga, $format)
    {
        if($tarikh_dari == "") $tarikh_dari = array();
        else $tarikh_dari = array($tarikh_dari);
        
        if($tarikh_hingga == "") $tarikh_hingga = array();
        else $tarikh_hingga = array($tarikh_hingga);
        
        $controls = array(
            'FROM_DATE' => $tarikh_dari,
            'TO_DATE' => $tarikh_hingga,
        );
        
        GeneralFunction::generateReport('/spsb/MSN/LaporanHadiahKemenanganUntukTemasyaSukan', $format, $controls, 'laporan_hadiah_kemenangan_untuk_temasya_sukan');
    }
    
    public function actionLaporanInsentifAtlet()
    {

        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new MsnLaporan();
        $model->format = 'html';

        if ($model->load(Yii::$app->request->post())) {
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-laporan-insentif-atlet'
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-laporan-insentif-atlet'
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'format' => $model->format
                ]);
            }
        } 

        return $this->render('laporan_insentif_atlet', [
            'model' => $model,
            'readonly' => false,
        ]);
    }

    public function actionGenerateLaporanInsentifAtlet($tarikh_dari, $tarikh_hingga,$format)
    {
        if($tarikh_dari == "") $tarikh_dari = array();
        else $tarikh_dari = array($tarikh_dari);
        
        if($tarikh_hingga == "") $tarikh_hingga = array();
        else $tarikh_hingga = array($tarikh_hingga);
        
        $controls = array(
            'FROM_DATE' => $tarikh_dari,
            'TO_DATE' => $tarikh_hingga,
        );
        
        GeneralFunction::generateReport('/spsb/MSN/LaporanInsentifAtlet', $format, $controls, 'laporan_insentif_atlet');
    }
    
    public function actionLaporanInsentifAtletKeseluruhan()
    {

        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new MsnLaporan();
        $model->format = 'html';

        if ($model->load(Yii::$app->request->post())) {
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-laporan-insentif-atlet-keseluruhan'
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-laporan-insentif-atlet-keseluruhan'
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'format' => $model->format
                ]);
            }
        } 

        return $this->render('laporan_insentif_atlet_keseluruhan', [
            'model' => $model,
            'readonly' => false,
        ]);
    }

    public function actionGenerateLaporanInsentifAtletKeseluruhan($tarikh_dari, $tarikh_hingga,$format)
    {
        if($tarikh_dari == "") $tarikh_dari = array();
        else $tarikh_dari = array($tarikh_dari);
        
        if($tarikh_hingga == "") $tarikh_hingga = array();
        else $tarikh_hingga = array($tarikh_hingga);
        
        $controls = array(
            'FROM_DATE' => $tarikh_dari,
            'TO_DATE' => $tarikh_hingga,
        );
        
        GeneralFunction::generateReport('/spsb/MSN/LaporanInsentifAtletKeseluruhan', $format, $controls, 'laporan_insentif_atlet_keseluruhan');
    }
	
	public function actionPrintJkb($id)
	{
		if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }  
        $model = $this->findModel($id);
		
		$PembayaranInsentifAtlet = PembayaranInsentifAtlet::find()->joinWith(['refAtlet'])->joinWith(['refAcara'])
									->where(['pembayaran_insentif_id' => $model->pembayaran_insentif_id])->all();
									
		$PembayaranInsentifAtletGroupCount = PembayaranInsentifAtlet::find()->where(['pembayaran_insentif_id' => $model->pembayaran_insentif_id])
											->groupBy('atlet')->count();
									
		$PembayaranInsentifJurulatih = PembayaranInsentifJurulatih::find()->joinWith(['refJurulatih'])
										->where(['pembayaran_insentif_id' => $model->pembayaran_insentif_id])->all();
										
		$PembayaranInsentifJurulatihGroupCount = PembayaranInsentifJurulatih::find()
										->where(['pembayaran_insentif_id' => $model->pembayaran_insentif_id])->groupBy('nama_jurulatih')->count();
										
		$PembayaranInsentifPersatuan = PembayaranInsentifPersatuan::find()->where(['pembayaran_insentif_id' => $model->pembayaran_insentif_id])->all();
		
		$PembayaranInsentifPersatuanGroupCount = PembayaranInsentifPersatuan::find()->where(['pembayaran_insentif_id' => $model->pembayaran_insentif_id])->groupBy('persatuan')->count();

        // get atlet dropdown value's descriptions
        $ref = RefJenisInsentif::findOne(['id' => $model->jenis_insentif]);
        $model->jenis_insentif = $ref['desc'];
        
        $ref = RefPingatInsentif::findOne(['id' => $model->pingat]);
        $model->pingat = $ref['desc'];
        
        $ref = PengurusanInsentifTetapanShakamShakar::findOne(['pengurusan_insentif_tetapan_shakam_shakar_id' => $model->kumpulan_temasya_kejohanan]);
        $model->kumpulan_temasya_kejohanan = $ref['kumpulan_temasya_kejohanan'];
        
        $ref = RefInsentifKejohanan::findOne(['id' => $model->kejohanan]);
        $model->kejohanan = $ref['desc'];
        
        $ref = PerancanganProgramPlan::findOne(['perancangan_program_id' => $model->nama_kejohanan]);
        $model->nama_kejohanan = $ref['nama_program'];
        
        $ref = RefSukan::findOne(['id' => $model->sukan]);
        $model->sukan = $ref['desc'];
        
        $ref = RefInsentifPeringkat::findOne(['id' => $model->peringkat]);
        $model->peringkat = $ref['desc'];
        
        $ref = RefInsentifKelas::findOne(['id' => $model->kelas]);
        $model->kelas = $ref['desc'];
        
        $model->acara_id = $model->acara;
        $ref = RefAcaraInsentif::findOne(['id' => $model->acara]);
        $model->acara = $ref['desc'];
        
        $ref = RefKelulusanInsentif::findOne(['id' => $model->kelulusan]);
        $model->kelulusan = $ref['desc'];
        
        $ref = ProfilBadanSukan::findOne(['profil_badan_sukan' => $model->persatuan]);
        $model->persatuan = $ref['nama_badan_sukan'];
		
        $pdf = new \mPDF('utf-8', 'A4-L');

        $pdf->title = 'Borang JKB';

        //$pdf->cssFile = 'report.css';
        $stylesheet = file_get_contents('css/report.css');

        $pdf->WriteHTML($stylesheet,1);
        
        $pdf->WriteHTML($this->renderpartial('print_jkb', [
             'model'  => $model,
			 'PembayaranInsentifAtlet' => $PembayaranInsentifAtlet,
			 'PembayaranInsentifJurulatih' => $PembayaranInsentifJurulatih,
			 'PembayaranInsentifPersatuan' => $PembayaranInsentifPersatuan,
			 'PembayaranInsentifAtletGroupCount' => $PembayaranInsentifAtletGroupCount,
			 'PembayaranInsentifJurulatihGroupCount' => $PembayaranInsentifJurulatihGroupCount,
			 'PembayaranInsentifPersatuanGroupCount' => $PembayaranInsentifPersatuanGroupCount,
        ]));

        $pdf->Output('Borang_jkb_'.$model->pembayaran_insentif_id.'.pdf', 'I'); 
	}
	
	public function actionLaporanSkimHadiahKemenanganSukanMengikutAtlet()
	{
		if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new MsnLaporan();

        if ($model->load(Yii::$app->request->post())) {
            
			$query = PembayaranInsentifAtlet::find()
                                ->joinWith(['refAtlet'])
                                ->joinWith(['refAcara'])
                                ->joinWith(['refPembayaranInsentif'])
                                ->where(['IS NOT', 'tbl_pembayaran_insentif_atlet.sukan', null])
                                ->andWhere(['IS NOT', 'tbl_pembayaran_insentif.pembayaran_insentif_id', null])
                                ->andWhere(['=', 'tbl_pembayaran_insentif.hantar_flag', 1]);
			
			if(isset($model->sukan) && $model->sukan != '')
			{
				$query = $query->andFilterWhere(['tbl_pembayaran_insentif_atlet.sukan' => $model->sukan]);
			}
			
			if(isset($model->atlet) && $model->atlet != '')
			{
				$query = $query->andFilterWhere(['tbl_pembayaran_insentif_atlet.atlet' => $model->atlet]);
			}
			
			$query = $query->groupBy('atlet', 'tbl_pembayaran_insentif_atlet.sukan')->all();
			
			// echo '<pre>';
			// foreach($query as $key => $value){
				// var_dump($value['refAtlet']['name_penuh']);
			// }
			// die;
			
			$pdf = new \mPDF('utf-8', 'A4-L');

			$pdf->title = GeneralLabel::skim_hadiah_kemenangan_mengikut_atlet;

			//$pdf->cssFile = 'report.css';
			$stylesheet = file_get_contents('css/report.css');

			$pdf->WriteHTML($stylesheet,1);
			
			$pdf->WriteHTML($this->renderpartial('print_laporan_skim_hadiah_kemenangan_sukan_mengikut_atlet', [
				 'model'  => $model,
				 'title' => $pdf->title,
				 'query' => $query,
			]));

			$pdf->Output(str_replace(' ', '_', $pdf->title).'_.pdf', 'I'); 
        } 

        return $this->render('laporan_skim_hadiah_kemenangan_sukan_mengikut_atlet', [
            'model' => $model,
            'readonly' => false,
        ]);
	}
}
