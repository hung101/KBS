<?php

namespace frontend\controllers;

use Yii;
use app\models\PermohonanEBiasiswa;
use frontend\models\PermohonanEBiasiswaSearch;
use app\models\PermohonanEBiasiswaPenyertaanKejohanan;
use frontend\models\PermohonanEBiasiswaPenyertaanKejohananSearch;
use app\models\PermohonanEBiasiswaLaporanPenyataBayaranPelajar;
use app\models\PermohonanEBiasiswaLaporanPrestasiAkademik;
use app\models\PermohonanEBiasiswaLaporanSenaraiPenerimaBiasiswa;
use app\models\PermohonanEBiasiswaLaporanStatistikPermohonanBiasiswaMengikutIptaIpts;
use app\models\PermohonanEBiasiswaLaporanStatistikPermohonanBiasiswaMengikutJantina;
use app\models\PermohonanEBiasiswaLaporanStatistikPermohonanBiasiswaMengikutKaum;
use app\models\PermohonanEBiasiswaLaporanStatistikPermohonanBiasiswaMengikutPeringkatPengajian;
use app\models\PermohonanEBiasiswaLaporanStatistikPermohonanBiasiswaMengikutStatus;
use app\models\PermohonanEBiasiswaLaporanStatistikPermohonanBiasiswaMengikutSukan;
use app\models\PermohonanEBiasiswaLaporanStatistikPermohonanBiasiswaMengikutUniversitiInstitusi;
use app\models\BspPembayaran;
use frontend\models\BspPembayaranSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\helpers\BaseUrl;

use app\models\general\Upload;
// contant values
use app\models\general\GeneralVariable;
use app\models\general\GeneralLabel;
use common\models\general\GeneralFunction;

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
use app\models\RefProgramPengajian;
use app\models\RefSemesterTerkini;
use app\models\RefSemesterBaki;
use app\models\RefUniversitiInstitusiEBiasiswa;
use app\models\AdminEBiasiswa;
use app\models\UserPeranan;

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
        
        if(Yii::$app->user->identity->peranan == UserPeranan::PERANAN_KBS_E_BIASISWA_BENDAHARI_IPT){
            $queryPar['PermohonanEBiasiswaSearch']['universiti_institusi'] = Yii::$app->user->identity->ipt_bendahari_e_biasiswa;
            $queryPar['PermohonanEBiasiswaSearch']['status_permohonan'] = RefStatusPermohonanEBiasiswa::STATUS_BERJAYA;
        }
        
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
        
        // keep kategori OKU id before overwrite
        $model->kategori_oku_id = $model->kategori_oku;
        
        $ref = RefKategoriOkuEBiasiswa::findOne(['id' => $model->kategori_oku]);
        $model->kategori_oku = $ref['desc'];
        
        $ref = RefKategoriPengajianEBiasiswa::findOne(['id' => $model->kategori]);
        $model->kategori = $ref['desc'];
        
        $model->status_permohonan_id = $model->status_permohonan;
        
        $ref = RefStatusPermohonanEBiasiswa::findOne(['id' => $model->status_permohonan]);
        $model->status_permohonan = $ref['desc'];
        
        $ref = RefUniversitiInstitusiEBiasiswa::findOne(['id' => $model->universiti_institusi]);
        $model->universiti_institusi = $ref['desc'];
        
        $ref = RefProgramPengajian::findOne(['id' => $model->program_pengajian]);
        $model->program_pengajian = $ref['desc'];
        
        $ref = RefSemesterTerkini::findOne(['id' => $model->semester_terkini]);
        $model->semester_terkini = $ref['desc'];
        
        $ref = RefSemesterBaki::findOne(['id' => $model->baki_semester_yang_tinggal]);
        $model->baki_semester_yang_tinggal = $ref['desc'];
        
        $ref = AdminEBiasiswa::findOne(['admin_e_biasiswa_id' => $model->admin_e_biasiswa_id]);
        $model->admin_e_biasiswa_id = $ref['nama'];
        
        $model->kelulusan = GeneralLabel::getYesNoLabel($model->kelulusan);
        
        if($model->tarikh_lahir){
            $model->umur = GeneralFunction::ageCalculator($model->tarikh_lahir);
        }
        
        $model->tarikh_lahir = GeneralFunction::convert($model->tarikh_lahir);
        
        $model->tarikh_temuduga = GeneralFunction::convert($model->tarikh_temuduga, GeneralFunction::TYPE_DATETIME);
        
        $model->tarikh_mula = GeneralFunction::convert($model->tarikh_mula);
        
        $model->tarikh_tamat = GeneralFunction::convert($model->tarikh_tamat);
        
        $queryPar = null;
        
        $queryPar['PermohonanEBiasiswaPenyertaanKejohananSearch']['permohonan_e_biasiswa_id'] = $id;
        $queryPar['BspPembayaranSearch']['bsp_pemohon_id'] = $id;
        
        $searchModelPermohonanEBiasiswaPenyertaanKejohanan = new PermohonanEBiasiswaPenyertaanKejohananSearch();
        $dataProviderPermohonanEBiasiswaPenyertaanKejohanan = $searchModelPermohonanEBiasiswaPenyertaanKejohanan->search($queryPar);
        
        $searchModelBspPembayaran = new BspPembayaranSearch();
        $dataProviderBspPembayaran = $searchModelBspPembayaran->search($queryPar);
        
        return $this->render('view', [
            'model' => $model,
            'searchModelPermohonanEBiasiswaPenyertaanKejohanan' => $searchModelPermohonanEBiasiswaPenyertaanKejohanan,
            'dataProviderPermohonanEBiasiswaPenyertaanKejohanan' => $dataProviderPermohonanEBiasiswaPenyertaanKejohanan,
            'searchModelBspPembayaran' => $searchModelBspPembayaran,
            'dataProviderBspPembayaran' => $dataProviderBspPembayaran,
            'readonly' => true,
        ]);
    }
// eddie (print) start
    public function actionPrint($id, $template) {

        $model = $this->findModel($id);

        $pdf = Yii::$app->pdf;
        $html_content = file_get_contents(Yii::$app->request->hostInfo.Yii::$app->request->baseUrl.Yii::$app->params['pdf_template'].$template.'.html');
        $html_content = str_replace("[PDF_TEMPLATE_URL]",Yii::$app->request->hostInfo.Yii::$app->request->baseUrl.Yii::$app->params['pdf_template'],$html_content);
        
        if($template == 'SLIP_PANGGILAN_TEMUDUGA') {

            $html_content = str_replace("[NAMA]",$model->nama,$html_content);
            $html_content = str_replace("[NO_KP]",$model->no_kad_pengenalan,$html_content);
            $html_content = str_replace("[UNIVERSITI_KOLEJ]",RefUniversitiInstitusiEBiasiswa::findOne(['id' => $model->universiti_institusi])['desc'],$html_content);
            $html_content = str_replace("[TARIKH_TEMUDUGA]",date_format(date_create($model->tarikh_temuduga),"d M Y (l)"),$html_content);
            $html_content = str_replace("[MASA]",date_format(date_create($model->tarikh_temuduga),"g:i A"),$html_content);
            $html_content = str_replace("[TEMPAT]",$model->tempat_temuduga,$html_content);

        } elseif ($template == 'SLIP_BERJAYA_DAPAT_BIASISWA') {

            $html_content = str_replace("[NAMA]",$model->nama,$html_content);
            $html_content = str_replace("[NO_KP]",$model->no_kad_pengenalan,$html_content);
            $html_content = str_replace("[TARIKH]",date_format(date_create(AdminEBiasiswa::findOne(['admin_e_biasiswa_id' => $model->admin_e_biasiswa_id])['tawaran_biasiswa_tarikh_masa']),"d M Y (l)"),$html_content);
            $html_content = str_replace("[MASA]",date_format(date_create(AdminEBiasiswa::findOne(['admin_e_biasiswa_id' => $model->admin_e_biasiswa_id])['tawaran_biasiswa_tarikh_masa']),"g:i A"),$html_content);
            $html_content = str_replace("[TEMPAT]",AdminEBiasiswa::findOne(['admin_e_biasiswa_id' => $model->admin_e_biasiswa_id])['tawaran_biasiswa_tempat'],$html_content);

        }
        
        $pdf->content = $html_content;

        return $pdf->render();
    }
// eddie (print) end

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
            $queryPar['BspPembayaranSearch']['session_id'] = Yii::$app->session->id;
        }
        
        $searchModelPermohonanEBiasiswaPenyertaanKejohanan = new PermohonanEBiasiswaPenyertaanKejohananSearch();
        $dataProviderPermohonanEBiasiswaPenyertaanKejohanan = $searchModelPermohonanEBiasiswaPenyertaanKejohanan->search($queryPar);
        
        $searchModelBspPembayaran = new BspPembayaranSearch();
        $dataProviderBspPembayaran = $searchModelBspPembayaran->search($queryPar);
        
        // set Tarikh Permohonan current timestamp
        $model->tarikh_permohonan = date(GeneralVariable::saveDateTimeFormat);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $upload = new Upload();
            $file = UploadedFile::getInstance($model, 'muat_naik_gambar');
            if($file){
                $model->muat_naik_gambar = $upload->uploadFile($file, Upload::eBiasiswaFolder, $model->permohonan_e_biasiswa_id, "");
            }
            
            if(isset(Yii::$app->session->id)){
                PermohonanEBiasiswaPenyertaanKejohanan::updateAll(['permohonan_e_biasiswa_id' => $model->permohonan_e_biasiswa_id], 'session_id = "'.Yii::$app->session->id.'"');
                PermohonanEBiasiswaPenyertaanKejohanan::updateAll(['session_id' => ''], 'permohonan_e_biasiswa_id = "'.$model->permohonan_e_biasiswa_id.'"');
                
                BspPembayaran::updateAll(['bsp_pemohon_id' => $model->permohonan_e_biasiswa_id], 'session_id = "'.Yii::$app->session->id.'"');
                BspPembayaran::updateAll(['session_id' => ''], 'bsp_pemohon_id = "'.$model->permohonan_e_biasiswa_id.'"');
            }
            
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->permohonan_e_biasiswa_id]);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
                'searchModelPermohonanEBiasiswaPenyertaanKejohanan' => $searchModelPermohonanEBiasiswaPenyertaanKejohanan,
                'dataProviderPermohonanEBiasiswaPenyertaanKejohanan' => $dataProviderPermohonanEBiasiswaPenyertaanKejohanan,
                'searchModelBspPembayaran' => $searchModelBspPembayaran,
                'dataProviderBspPembayaran' => $dataProviderBspPembayaran,
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
        $queryPar['BspPembayaranSearch']['bsp_pemohon_id'] = $id;
        
        $searchModelPermohonanEBiasiswaPenyertaanKejohanan = new PermohonanEBiasiswaPenyertaanKejohananSearch();
        $dataProviderPermohonanEBiasiswaPenyertaanKejohanan = $searchModelPermohonanEBiasiswaPenyertaanKejohanan->search($queryPar);
        
        $searchModelBspPembayaran = new BspPembayaranSearch();
        $dataProviderBspPembayaran = $searchModelBspPembayaran->search($queryPar);

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
                'searchModelBspPembayaran' => $searchModelBspPembayaran,
                'dataProviderBspPembayaran' => $dataProviderBspPembayaran,
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
    
    public function actionLaporanPenyataBayaranPelajar()
    {

        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new PermohonanEBiasiswaLaporanPenyataBayaranPelajar();
        $model->format = 'html';

        if ($model->load(Yii::$app->request->post())) {
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-laporan-penyata-bayaran-pelajar'
                    , 'e_biasiswa_id' => $model->e_biasiswa_id
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-laporan-penyata-bayaran-pelajar'
                    , 'e_biasiswa_id' => $model->e_biasiswa_id
                    , 'format' => $model->format
                ]);

            }

        } 

        return $this->render('laporan_penyata_bayaran_pelajar', [
            'model' => $model,
            'readonly' => false,
        ]);
    }

    public function actionGenerateLaporanPenyataBayaranPelajar($e_biasiswa_id, $format)
    {
        if($e_biasiswa_id == "") $e_biasiswa_id = array();
        else $e_biasiswa_id = array($e_biasiswa_id);
        
        $controls = array(
            'E_BIASISWA_ID' => $e_biasiswa_id,
        );
        
        GeneralFunction::generateReport('/spsb/kbs/e_biasiswa/laporan_penyata_bayaran_pelajar', $format, $controls, 'laporan_penyata_bayaran_pelajar');
    }
    
    public function actionLaporanPrestasiAkademik()
    {

        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new PermohonanEBiasiswaLaporanPrestasiAkademik();
        $model->format = 'html';

        if ($model->load(Yii::$app->request->post())) {
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-laporan-prestasi-akademik'
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-laporan-prestasi-akademik'
                    , 'format' => $model->format
                ]);

            }

        } 

        return $this->render('laporan_prestasi_akademik', [
            'model' => $model,
            'readonly' => false,
        ]);
    }

    public function actionGenerateLaporanPrestasiAkademik($format)
    {
        GeneralFunction::generateReport('/spsb/kbs/e_biasiswa/laporan_prestasi_akademik', $format, null, 'laporan_prestasi_akademik');
    }
    
    public function actionLaporanSenaraiPenerimaBiasiswa()
    {

        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new PermohonanEBiasiswaLaporanSenaraiPenerimaBiasiswa();
        $model->format = 'html';

        if ($model->load(Yii::$app->request->post())) {
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-laporan-senarai-penerima-biasiswa'
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-laporan-senarai-penerima-biasiswa'
                    , 'format' => $model->format
                ]);

            }

        } 

        return $this->render('laporan_senarai_penerima_biasiswa', [
            'model' => $model,
            'readonly' => false,
        ]);
    }

    public function actionGenerateLaporanSenaraiPenerimaBiasiswa($format)
    {
        GeneralFunction::generateReport('/spsb/kbs/e_biasiswa/laporan_senarai_penerima_biasiswa', $format, null, 'laporan_senarai_penerima_biasiswa');
    }
    
    public function actionLaporanStatistikPermohonanBiasiswaMengikutIptaIpts()
    {

        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new PermohonanEBiasiswaLaporanStatistikPermohonanBiasiswaMengikutIptaIpts();
        $model->format = 'html';

        if ($model->load(Yii::$app->request->post())) {
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-laporan-statistik-permohonan-biasiswa-mengikut-ipta-ipts'
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-laporan-statistik-permohonan-biasiswa-mengikut-ipta-ipts'
                    , 'format' => $model->format
                ]);

            }

        } 

        return $this->render('laporan_statistik_permohonan_biasiswa_mengikut_ipta_ipts', [
            'model' => $model,
            'readonly' => false,
        ]);
    }

    public function actionGenerateLaporanStatistikPermohonanBiasiswaMengikutIptaIpts($format)
    {
        GeneralFunction::generateReport('/spsb/kbs/e_biasiswa/laporan_statistik_permohonan_biasiswa_mengikut_ipta_ipts', $format, null, 'laporan_statistik_permohonan_biasiswa_mengikut_ipta_ipts');
    }
    
    public function actionLaporanStatistikPermohonanBiasiswaMengikutJantina()
    {

        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new PermohonanEBiasiswaLaporanStatistikPermohonanBiasiswaMengikutJantina();
        $model->format = 'html';

        if ($model->load(Yii::$app->request->post())) {
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-laporan-statistik-permohonan-biasiswa-mengikut-jantina'
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-laporan-statistik-permohonan-biasiswa-mengikut-jantina'
                    , 'format' => $model->format
                ]);

            }

        } 

        return $this->render('laporan_statistik_permohonan_biasiswa_mengikut_jantina', [
            'model' => $model,
            'readonly' => false,
        ]);
    }

    public function actionGenerateLaporanStatistikPermohonanBiasiswaMengikutJantina($format)
    {
        GeneralFunction::generateReport('/spsb/kbs/e_biasiswa/laporan_statistik_permohonan_biasiswa_mengikut_jantina', $format, null, 'laporan_statistik_permohonan_biasiswa_mengikut_jantina');
    }
    
    public function actionLaporanStatistikPermohonanBiasiswaMengikutKaum()
    {

        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new PermohonanEBiasiswaLaporanStatistikPermohonanBiasiswaMengikutKaum();
        $model->format = 'html';

        if ($model->load(Yii::$app->request->post())) {
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-laporan-statistik-permohonan-biasiswa-mengikut-kaum'
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-laporan-statistik-permohonan-biasiswa-mengikut-kaum'
                    , 'format' => $model->format
                ]);

            }

        } 

        return $this->render('laporan_statistik_permohonan_biasiswa_mengikut_kaum', [
            'model' => $model,
            'readonly' => false,
        ]);
    }

    public function actionGenerateLaporanStatistikPermohonanBiasiswaMengikutKaum($format)
    {
        GeneralFunction::generateReport('/spsb/kbs/e_biasiswa/laporan_statistik_permohonan_biasiswa_mengikut_kaum', $format, null, 'laporan_statistik_permohonan_biasiswa_mengikut_kaum');
    }
    
    public function actionLaporanStatistikPermohonanBiasiswaMengikutPeringkatPengajian()
    {

        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new PermohonanEBiasiswaLaporanStatistikPermohonanBiasiswaMengikutPeringkatPengajian();
        $model->format = 'html';

        if ($model->load(Yii::$app->request->post())) {
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-laporan-statistik-permohonan-biasiswa-mengikut-peringkat-pengajian'
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-laporan-statistik-permohonan-biasiswa-mengikut-peringkat-pengajian'
                    , 'format' => $model->format
                ]);

            }

        } 

        return $this->render('laporan_statistik_permohonan_biasiswa_mengikut_peringkat_pengajian', [
            'model' => $model,
            'readonly' => false,
        ]);
    }

    public function actionGenerateLaporanStatistikPermohonanBiasiswaMengikutPeringkatPengajian($format)
    {
        GeneralFunction::generateReport('/spsb/kbs/e_biasiswa/laporan_statistik_permohonan_biasiswa_mengikut_peringkat_pengajian', $format, null, 'laporan_statistik_permohonan_biasiswa_mengikut_peringkat_pengajian');
    }
    
    public function actionLaporanStatistikPermohonanBiasiswaMengikutStatus()
    {

        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new PermohonanEBiasiswaLaporanStatistikPermohonanBiasiswaMengikutStatus();
        $model->format = 'html';

        if ($model->load(Yii::$app->request->post())) {
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-laporan-statistik-permohonan-biasiswa-mengikut-status'
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-laporan-statistik-permohonan-biasiswa-mengikut-status'
                    , 'format' => $model->format
                ]);

            }

        } 

        return $this->render('laporan_statistik_permohonan_biasiswa_mengikut_status', [
            'model' => $model,
            'readonly' => false,
        ]);
    }

    public function actionGenerateLaporanStatistikPermohonanBiasiswaMengikutStatus($format)
    {
        GeneralFunction::generateReport('/spsb/kbs/e_biasiswa/laporan_statistik_permohonan_biasiswa_mengikut_status', $format, null, 'laporan_statistik_permohonan_biasiswa_mengikut_status');
    }
    
    public function actionLaporanStatistikPermohonanBiasiswaMengikutSukan()
    {

        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new PermohonanEBiasiswaLaporanStatistikPermohonanBiasiswaMengikutSukan();
        $model->format = 'html';

        if ($model->load(Yii::$app->request->post())) {
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-laporan-statistik-permohonan-biasiswa-mengikut-sukan'
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-laporan-statistik-permohonan-biasiswa-mengikut-sukan'
                    , 'format' => $model->format
                ]);

            }

        } 

        return $this->render('laporan_statistik_permohonan_biasiswa_mengikut_sukan', [
            'model' => $model,
            'readonly' => false,
        ]);
    }

    public function actionGenerateLaporanStatistikPermohonanBiasiswaMengikutSukan($format)
    {
        GeneralFunction::generateReport('/spsb/kbs/e_biasiswa/laporan_statistik_permohonan_biasiswa_mengikut_sukan', $format, null, 'laporan_statistik_permohonan_biasiswa_mengikut_sukan');
    }
    
    public function actionLaporanStatistikPermohonanBiasiswaMengikutUniversitiInstitusi()
    {

        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new PermohonanEBiasiswaLaporanStatistikPermohonanBiasiswaMengikutUniversitiInstitusi();
        $model->format = 'html';

        if ($model->load(Yii::$app->request->post())) {
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-laporan-statistik-permohonan-biasiswa-mengikut-universiti-institusi'
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-laporan-statistik-permohonan-biasiswa-mengikut-universiti-institusi'
                    , 'format' => $model->format
                ]);

            }

        } 

        return $this->render('laporan_statistik_permohonan_biasiswa_mengikut_universiti_institusi', [
            'model' => $model,
            'readonly' => false,
        ]);
    }

    public function actionGenerateLaporanStatistikPermohonanBiasiswaMengikutUniversitiInstitusi($format)
    {
        GeneralFunction::generateReport('/spsb/kbs/e_biasiswa/laporan_statistik_permohonan_biasiswa_mengikut_universiti_institusi', $format, null, 'laporan_statistik_permohonan_biasiswa_mengikut_universiti_institusi');
    }
}
