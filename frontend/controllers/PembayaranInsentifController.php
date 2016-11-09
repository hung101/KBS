<?php

namespace frontend\controllers;

use Yii;
use app\models\PembayaranInsentif;
use frontend\models\PembayaranInsentifSearch;
use app\models\PembayaranInsentifAtlet;
use frontend\models\PembayaranInsentifAtletSearch;
use app\models\PembayaranInsentifJurulatih;
use frontend\models\PembayaranInsentifJurulatihSearch;
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
        
        $searchModel = new PembayaranInsentifSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

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
        
        $ref = PerancanganProgram::findOne(['perancangan_program_id' => $model->nama_kejohanan]);
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
        
        $queryPar = null;
        
        $queryPar['PembayaranInsentifAtletSearch']['pembayaran_insentif_id'] = $id;
        $queryPar['PembayaranInsentifJurulatihSearch']['pembayaran_insentif_id'] = $id;
        
        $searchModelPembayaranInsentifAtlet  = new PembayaranInsentifAtletSearch();
        $dataProviderPembayaranInsentifAtlet = $searchModelPembayaranInsentifAtlet->search($queryPar);
        
        $searchModelPembayaranInsentifJurulatih  = new PembayaranInsentifJurulatihSearch();
        $dataProviderPembayaranInsentifJurulatih = $searchModelPembayaranInsentifJurulatih->search($queryPar);
        
        return $this->render('view', [
            'model' => $model,
            'searchModelPembayaranInsentifAtlet' => $searchModelPembayaranInsentifAtlet,
            'dataProviderPembayaranInsentifAtlet' => $dataProviderPembayaranInsentifAtlet,
            'searchModelPembayaranInsentifJurulatih' => $searchModelPembayaranInsentifJurulatih,
            'dataProviderPembayaranInsentifJurulatih' => $dataProviderPembayaranInsentifJurulatih,
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
        
        $model->kelulusan = RefKelulusanInsentif::DALAM_PROSES;
        
        $queryPar = null;
        
        Yii::$app->session->open();
        
        if(isset(Yii::$app->session->id)){
            $queryPar['PembayaranInsentifAtletSearch']['session_id'] = Yii::$app->session->id;
            $queryPar['PembayaranInsentifJurulatihSearch']['session_id'] = Yii::$app->session->id;
        }
        
        $searchModelPembayaranInsentifAtlet  = new PembayaranInsentifAtletSearch();
        $dataProviderPembayaranInsentifAtlet = $searchModelPembayaranInsentifAtlet->search($queryPar);
        
        $searchModelPembayaranInsentifJurulatih  = new PembayaranInsentifJurulatihSearch();
        $dataProviderPembayaranInsentifJurulatih = $searchModelPembayaranInsentifJurulatih->search($queryPar);

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
            }
            
            return $this->redirect(['view', 'id' => $model->pembayaran_insentif_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'searchModelPembayaranInsentifAtlet' => $searchModelPembayaranInsentifAtlet,
                'dataProviderPembayaranInsentifAtlet' => $dataProviderPembayaranInsentifAtlet,
                'searchModelPembayaranInsentifJurulatih' => $searchModelPembayaranInsentifJurulatih,
                'dataProviderPembayaranInsentifJurulatih' => $dataProviderPembayaranInsentifJurulatih,
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
        
        $searchModelPembayaranInsentifAtlet  = new PembayaranInsentifAtletSearch();
        $dataProviderPembayaranInsentifAtlet = $searchModelPembayaranInsentifAtlet->search($queryPar);
        
        $searchModelPembayaranInsentifJurulatih  = new PembayaranInsentifJurulatihSearch();
        $dataProviderPembayaranInsentifJurulatih = $searchModelPembayaranInsentifJurulatih->search($queryPar);

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
                'readonly' => false,
            ]);
        }
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
}
