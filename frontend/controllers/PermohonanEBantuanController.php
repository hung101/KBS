<?php

namespace frontend\controllers;

use Yii;
use app\models\PermohonanEBantuan;
use frontend\models\PermohonanEBantuanSearch;
use app\models\PermohonanEBantuanSenaraiPermohonan;
use frontend\models\PermohonanEBantuanSenaraiPermohonanSearch;
use app\models\PermohonanEBantuanObjektifPertubuhan;
use frontend\models\PermohonanEBantuanObjektifPertubuhanSearch;
use app\models\PermohonanEBantuanJawatankuasa;
use frontend\models\PermohonanEBantuanJawatankuasaSearch;
use app\models\PermohonanEBantuanSenaraiAktivitiProjek;
use frontend\models\PermohonanEBantuanSenaraiAktivitiProjekSearch;
use app\models\PermohonanEBantuanPendapatanTahunLepas;
use frontend\models\PermohonanEBantuanPendapatanTahunLepasSearch;
use app\models\PermohonanEBantuanAnggaranPerbelanjaan;
use frontend\models\PermohonanEBantuanAnggaranPerbelanjaanSearch;
use app\models\PermohonanEBantuanLaporanStatusPermohonanBantuan;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\helpers\BaseUrl;

// contant values
use app\models\general\Upload;
use app\models\general\GeneralVariable;
use app\models\general\GeneralLabel;
use common\models\general\GeneralFunction;
use app\models\general\GeneralMessage;

// table reference
use app\models\RefKategoriPersatuan;
use app\models\RefKategoriProgram;
use app\models\RefSokongan;
use app\models\RefBank;
use app\models\RefNegeri;
use app\models\RefBandar;
use app\models\RefLaporanEBantuan;
use app\models\RefNegeriSokonganEBantuan;
use app\models\RefKelulusanHqEBantuan;
use app\models\RefStatusPermohonanEBantuan;
use app\models\RefPeringkatProgram;
use app\models\RefPejabatYangMendaftarkan;
use app\models\RefParlimen;
use app\models\UserPublic;

/**
 * PermohonanEBantuanController implements the CRUD actions for PermohonanEBantuan model.
 */
class PermohonanEBantuanController extends Controller
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
     * Lists all PermohonanEBantuan models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $queryPar = Yii::$app->request->queryParams;
        
        if(Yii::$app->user->identity->urusetia_negeri_e_bantuan){
            $queryPar['PermohonanEBantuanSearch']['alamat_negeri'] = Yii::$app->user->identity->urusetia_negeri_e_bantuan;
        }
        
        if(Yii::$app->user->identity->urusetia_kategori_program_e_bantuan){
            $queryPar['PermohonanEBantuanSearch']['kategori_program'] = Yii::$app->user->identity->urusetia_kategori_program_e_bantuan;
        }
        
        $queryPar['PermohonanEBantuanSearch']['hantar_flag'] = 1; // fitler only show those hantar
        
        $searchModel = new PermohonanEBantuanSearch();
        $dataProvider = $searchModel->search($queryPar);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PermohonanEBantuan model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $queryPar = null;
        
        $queryPar['PermohonanEBantuanJawatankuasaSearch']['permohonan_e_bantuan_id'] = $id;
        $queryPar['PermohonanEBantuanObjektifPertubuhanSearch']['permohonan_e_bantuan_id'] = $id;
        $queryPar['PermohonanEBantuanSenaraiPermohonanSearch']['permohonan_e_bantuan_id'] = $id;
        $queryPar['PermohonanEBantuanPendapatanTahunLepasSearch']['permohonan_e_bantuan_id'] = $id;
        $queryPar['PermohonanEBantuanAnggaranPerbelanjaanSearch']['permohonan_e_bantuan_id'] = $id;
        
        $searchModelPermohonan = new PermohonanEBantuanSenaraiPermohonanSearch();
        $dataProviderPermohonan = $searchModelPermohonan->search($queryPar);
        
        $searchModelOP = new PermohonanEBantuanObjektifPertubuhanSearch();
        $dataProviderOP = $searchModelOP->search($queryPar);
        
        $searchModelJawatankuasa = new PermohonanEBantuanJawatankuasaSearch();
        $dataProviderJawatankuasa = $searchModelJawatankuasa->search($queryPar);
        
        $searchModelSAP = new PermohonanEBantuanSenaraiAktivitiProjekSearch();
        $dataProviderSAP = $searchModelSAP->search($queryPar);
        
        $searchModelPTL = new PermohonanEBantuanPendapatanTahunLepasSearch();
        $dataProviderPTL = $searchModelPTL->search($queryPar);
        
        $searchModelAP = new PermohonanEBantuanAnggaranPerbelanjaanSearch();
        $dataProviderAP = $searchModelAP->search($queryPar);
        
        // Get desc for each dropdown fields
        $model = $this->findModel($id);
        
        $ref = RefKategoriPersatuan::findOne(['id' => $model->kategori_persatuan]);
        $model->kategori_persatuan = $ref['desc'];
        
        $ref = RefKategoriProgram::findOne(['id' => $model->kategori_program]);
        $model->kategori_program = $ref['desc'];
        
        $ref = RefNegeri::findOne(['id' => $model->alamat_negeri]);
        $model->alamat_negeri = $ref['desc'];
        
        $ref = RefBandar::findOne(['id' => $model->alamat_bandar]);
        $model->alamat_bandar = $ref['desc'];
        
        $ref = RefNegeri::findOne(['id' => $model->alamat_surat_menyurat_negeri]);
        $model->alamat_surat_menyurat_negeri = $ref['desc'];
        
        $ref = RefBandar::findOne(['id' => $model->alamat_surat_menyurat_bandar]);
        $model->alamat_surat_menyurat_bandar = $ref['desc'];
        
        $ref = RefBank::findOne(['id' => $model->nama_bank]);
        $model->nama_bank = $ref['desc'];
        
        $ref = RefSokongan::findOne(['id' => $model->sokongan]);
        $model->sokongan = $ref['desc'];
        
        $ref = RefLaporanEBantuan::findOne(['id' => $model->laporan]);
        $model->laporan = $ref['desc'];
        
        $model->negeri_sokongan_id = $model->negeri_sokongan;
        $ref = RefNegeriSokonganEBantuan::findOne(['id' => $model->negeri_sokongan]);
        $model->negeri_sokongan = $ref['desc'];
        
        $model->kelulusan_id = $model->kelulusan;
        $ref = RefKelulusanHqEBantuan::findOne(['id' => $model->kelulusan]);
        $model->kelulusan = $ref['desc'];
        
        $ref = RefStatusPermohonanEBantuan::findOne(['id' => $model->status_permohonan]);
        $model->status_permohonan = $ref['desc'];
        
        $ref = RefPeringkatProgram::findOne(['id' => $model->peringkat_program]);
        $model->peringkat_program = $ref['desc'];
        
        $ref = RefPejabatYangMendaftarkan::findOne(['id' => $model->pejabat_yang_mendaftarkan]);
        $model->pejabat_yang_mendaftarkan = $ref['desc'];
        
        $ref = RefParlimen::findOne(['id' => $model->alamat_parlimen]);
        $model->alamat_parlimen = $ref['desc'];
        
        $ref = RefParlimen::findOne(['id' => $model->alamat_surat_menyurat_parlimen]);
        $model->alamat_surat_menyurat_parlimen = $ref['desc'];
        
        /*$YesNo = GeneralLabel::getYesNoLabel($model->kelulusan);
        $model->kelulusan = $YesNo;*/
        
        $model->tarikh_didaftarkan = GeneralFunction::convert($model->tarikh_didaftarkan);
        
        $model->tarikh_pelaksanaan = GeneralFunction::convert($model->tarikh_pelaksanaan);
        
        $model->tarikh_mesyuarat = GeneralFunction::convert($model->tarikh_mesyuarat);
        
        $model->tarikh_bayar = GeneralFunction::convert($model->tarikh_bayar);
        
        return $this->render('view', [
            'model' => $model,
            'searchModelPermohonan' => $searchModelPermohonan,
            'dataProviderPermohonan' => $dataProviderPermohonan,
            'searchModelOP' => $searchModelOP,
            'dataProviderOP' => $dataProviderOP,
            'searchModelJawatankuasa' => $searchModelJawatankuasa,
            'dataProviderJawatankuasa' => $dataProviderJawatankuasa,
            'searchModelSAP' => $searchModelSAP,
            'dataProviderSAP' => $dataProviderSAP,
            'searchModelPTL' => $searchModelPTL,
            'dataProviderPTL' => $dataProviderPTL,
            'searchModelAP' => $searchModelAP,
            'dataProviderAP' => $dataProviderAP,
            'readonly' => true,
        ]);
    }
    
    // eddie (print2) start
    public function actionPrint($id, $template) {

        $model = $this->findModel($id);

        $pdf = Yii::$app->pdf;
        $html_content = file_get_contents(Yii::$app->request->hostInfo.Yii::$app->request->baseUrl.Yii::$app->params['pdf_template'].$template.'.html');
        $html_content = str_replace("[PDF_TEMPLATE_URL]",Yii::$app->request->hostInfo.Yii::$app->request->baseUrl.Yii::$app->params['pdf_template'],$html_content);
        
        if($template == 'SURAT_SETUJU_TERIMA_BANTUAN') {

            $html_content = str_replace("[nama_pertubuhan_persatuan]",$model->nama_pertubuhan_persatuan,$html_content);
            $html_content = str_replace("[jumlah_diluluskan]",$model->jumlah_diluluskan,$html_content);
            $html_content = str_replace("[nama_program]",$model->nama_program,$html_content);
            $html_content = str_replace("[tempat_pelaksanaan]",$model->tempat_pelaksanaan,$html_content);
            $html_content = str_replace("[tarikh_pelaksanaan]",GeneralFunction::convert($model->tarikh_pelaksanaan, GeneralFunction::TYPE_DATE),$html_content);
            
        } elseif ($template == 'LAPORAN_PELAKSANAAN_PROGRAM') {

            $html_content = str_replace("[nama_program]",$model->nama_program,$html_content);
            $html_content = str_replace("[tarikh_pelaksanaan]",GeneralFunction::convert($model->tarikh_pelaksanaan, GeneralFunction::TYPE_DATE),$html_content);
            $html_content = str_replace("[tempat_pelaksanaan]",$model->tempat_pelaksanaan,$html_content);

        } elseif ($template == 'PERAKUAN_PERMOHONAN_PEMBERIAN_BANTUAN') {

            $anggaran_perbelanjaan = PermohonanEBantuanAnggaranPerbelanjaan::find()->where(['=', 'permohonan_e_bantuan_id', $model->permohonan_e_bantuan_id])->all();
            $anggaran_perbelanjaan_table = "";
            $number = 1;

            $JUMLAH_PEMOHONAN = 0;
            $JUMLAH_BUTIRAN_DISOKONG = 0;
            $JUMLAH_BUTIRAN_DIPERAKUKAN = 0;

            foreach ($anggaran_perbelanjaan as $anggaran_perbelanjaan_detail) {

                $JUMLAH_PEMOHONAN += $anggaran_perbelanjaan_detail->jumlah_perbelanjaan;
                $JUMLAH_BUTIRAN_DISOKONG += $anggaran_perbelanjaan_detail->jumlah_disokong;
                $JUMLAH_BUTIRAN_DIPERAKUKAN += $anggaran_perbelanjaan_detail->jumlah_diperakuankan;

                $anggaran_perbelanjaan_table .= "<tr><td style=\"width:3%\">".$number."</td>
                <td style=\"width:40%\">".$anggaran_perbelanjaan_detail->butir_butir_perbelanjaan."</td>
                <td style=\"width:19%\" align=\"right\">".number_format($anggaran_perbelanjaan_detail->jumlah_perbelanjaan,2)."</td>
                <td style=\"width:19%\" align=\"right\">".number_format($anggaran_perbelanjaan_detail->jumlah_disokong,2)."</td>
                <td style=\"width:19%\" align=\"right\">".number_format($anggaran_perbelanjaan_detail->jumlah_diperakuankan,2)."</td></tr>";
                $number++;
            }

            $line_space = "";
            for($line=36; $line>$number; $line--) {
                $line_space .= "<tr><td>&nbsp;</td></tr>";
            }
            $page_break = "<table cellpadding=\"1px\" cellspacing=\"0\" style=\"border-collapse:collapse;\">".$line_space."</table>";

            $JUMLAH_PEMOHONAN = number_format($JUMLAH_PEMOHONAN,2);
            $JUMLAH_BUTIRAN_DISOKONG = number_format($JUMLAH_BUTIRAN_DISOKONG,2);
            $JUMLAH_BUTIRAN_DIPERAKUKAN = number_format($JUMLAH_BUTIRAN_DIPERAKUKAN,2);

            $html_content = str_replace("[tbl_permohonan_e_bantuan - nama_pertubuhan_persatuan]",$model->nama_pertubuhan_persatuan,$html_content);
            $html_content = str_replace("[tbl_permohonan_e_bantuan - no_pendaftaran_persatuan]",$model->no_pendaftaran,$html_content);
            $html_content = str_replace("[tbl_permohonan_e_bantuan - nama_program]",$model->nama_program,$html_content);
            $html_content = str_replace("[tbl_permohonan_e_bantuan - tarikh_pelaksanaan]",$model->tarikh_pelaksanaan,$html_content);
            $html_content = str_replace("[tbl_permohonan_e_bantuan - tempat_pelaksanaan]",$model->tempat_pelaksanaan,$html_content);
            $html_content = str_replace("[tbl_permohonan_e_bantuan - bilangan_peserta]",$model->bilangan_peserta,$html_content);
            $html_content = str_replace("[tbl_permohonan_e_bantuan - jumlah_bantuan_yang_dipohon]","RM ".$model->jumlah_bantuan_yang_dipohon,$html_content);
            $html_content = str_replace("[anggaran_perbelanjaan_table]",$anggaran_perbelanjaan_table,$html_content);
            $html_content = str_replace("[JUMLAH_PEMOHONAN]",$JUMLAH_PEMOHONAN,$html_content);
            $html_content = str_replace("[JUMLAH_BUTIRAN_DISOKONG]",$JUMLAH_BUTIRAN_DISOKONG,$html_content);
            $html_content = str_replace("[JUMLAH_BUTIRAN_DIPERAKUKAN]",$JUMLAH_BUTIRAN_DIPERAKUKAN,$html_content);
            $html_content = str_replace("[page_break]",$page_break,$html_content);
            
            $pdf->methods = [
                'SetHeader'=>['PB5'], 
                'SetFooter'=>['{PAGENO}'],
            ];

        }
        
        $pdf->content = $html_content;

        return $pdf->render();
    }
// eddie (print2) end
    

    public function actionLaporanStatusPermohonanBantuan()
    {

        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new PermohonanEBantuanLaporanStatusPermohonanBantuan();
        $model->format = 'html';

        if ($model->load(Yii::$app->request->post())) {
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-laporan-status-permohonan-bantuan'
                    , 'jumlah_dilulus_dari' => $model->jumlah_dilulus_dari
                    , 'jumlah_dilulus_hingga' => $model->jumlah_dilulus_hingga
                    , 'jumlah_dipohon_dari' => $model->jumlah_dipohon_dari
                    , 'jumlah_dipohon_hingga' => $model->jumlah_dipohon_hingga
                    , 'negeri' => $model->negeri
                    , 'tarikh_terima_dari' => $model->tarikh_terima_dari
                    , 'tarikh_terima_hingga' => $model->tarikh_terima_hingga
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-laporan-status-permohonan-bantuan'
                    , 'jumlah_dilulus_dari' => $model->jumlah_dilulus_dari
                    , 'jumlah_dilulus_hingga' => $model->jumlah_dilulus_hingga
                    , 'jumlah_dipohon_dari' => $model->jumlah_dipohon_dari
                    , 'jumlah_dipohon_hingga' => $model->jumlah_dipohon_hingga
                    , 'negeri' => $model->negeri
                    , 'tarikh_terima_dari' => $model->tarikh_terima_dari
                    , 'tarikh_terima_hingga' => $model->tarikh_terima_hingga
                    , 'format' => $model->format
                ]);

            }

        } 

        return $this->render('laporan_status_permohonan_bantuan', [
            'model' => $model,
            'readonly' => false,
        ]);
    }

    public function actionGenerateLaporanStatusPermohonanBantuan($jumlah_dilulus_dari, $jumlah_dilulus_hingga, $jumlah_dipohon_dari, $jumlah_dipohon_hingga, $negeri, $tarikh_terima_dari, $tarikh_terima_hingga, $format)
    {

        if($jumlah_dilulus_dari == "") $jumlah_dilulus_dari = array();
        else $jumlah_dilulus_dari = array($jumlah_dilulus_dari);

        if($jumlah_dilulus_hingga == "") $jumlah_dilulus_hingga = array();
        else $jumlah_dilulus_hingga = array($jumlah_dilulus_hingga);

        if($jumlah_dipohon_dari == "") $jumlah_dipohon_dari = array();
        else $jumlah_dipohon_dari = array($jumlah_dipohon_dari);

        if($jumlah_dipohon_hingga == "") $jumlah_dipohon_hingga = array();
        else $jumlah_dipohon_hingga = array($jumlah_dipohon_hingga);

        if($negeri == "") $negeri = array();
        else $negeri = array($negeri);
        
        if($tarikh_terima_dari == "") $tarikh_terima_dari = array();
        else $tarikh_terima_dari = array($tarikh_terima_dari);
        
        if($tarikh_terima_hingga == "") $tarikh_terima_hingga = array();
        else $tarikh_terima_hingga = array($tarikh_terima_hingga);
        
        $controls = array(
            'JUMLAH_DILULUS_START' => $jumlah_dilulus_dari,
            'JUMLAH_DILULUS_END' => $jumlah_dilulus_hingga,
            'JUMLAH_DIPOHON_START' => $jumlah_dipohon_dari,
            'JUMLAH_DIPOHON_END' => $jumlah_dipohon_hingga,
            'NEGERI' => $negeri,
            'TARIKH_TERIMA_START' => $tarikh_terima_dari,
            'TARIKH_TERIMA_END' => $tarikh_terima_hingga, 
        );
        
        GeneralFunction::generateReport('/spsb/kbs/e-Bantuan/StatusPermohonanEBantuan', $format, $controls, 'status_permohonan_bantuan');

    }

    /**
     * Creates a new PermohonanEBantuan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new PermohonanEBantuan();
        
        $queryPar = null;
        
        Yii::$app->session->open();
        
        if(isset(Yii::$app->session->id)){
            $queryPar['PermohonanEBantuanJawatankuasaSearch']['session_id'] = Yii::$app->session->id;
            $queryPar['PermohonanEBantuanObjektifPertubuhanSearch']['session_id'] = Yii::$app->session->id;
            $queryPar['PermohonanEBantuanSenaraiPermohonanSearch']['session_id'] = Yii::$app->session->id;
            $queryPar['PermohonanEBantuanPendapatanTahunLepasSearch']['session_id'] = Yii::$app->session->id;
            $queryPar['PermohonanEBantuanAnggaranPerbelanjaanSearch']['session_id'] = Yii::$app->session->id;
        }
        
        $searchModelPermohonan = new PermohonanEBantuanSenaraiPermohonanSearch();
        $dataProviderPermohonan = $searchModelPermohonan->search($queryPar);
        
        $searchModelOP = new PermohonanEBantuanObjektifPertubuhanSearch();
        $dataProviderOP = $searchModelOP->search($queryPar);
        
        $searchModelJawatankuasa = new PermohonanEBantuanJawatankuasaSearch();
        $dataProviderJawatankuasa = $searchModelJawatankuasa->search($queryPar);
        
        $searchModelSAP = new PermohonanEBantuanSenaraiAktivitiProjekSearch();
        $dataProviderSAP = $searchModelSAP->search($queryPar);
        
        $searchModelPTL = new PermohonanEBantuanPendapatanTahunLepasSearch();
        $dataProviderPTL = $searchModelPTL->search($queryPar);
        
        $searchModelAP = new PermohonanEBantuanAnggaranPerbelanjaanSearch();
        $dataProviderAP = $searchModelAP->search($queryPar);
        
        $error_flag = 0;
        $error_message = '';
        
        if(Yii::$app->request->post()){
            if(!PermohonanEBantuanObjektifPertubuhan::find()->where(['session_id' => Yii::$app->session->id])->exists()){
                $error_flag = 1;
                $error_message .= ' - ' . GeneralMessage::objektif_pertubuhan_wajid_diisi;
            }
            
            if(!PermohonanEBantuanAnggaranPerbelanjaan::find()->where(['session_id' => Yii::$app->session->id])->exists()){
                $error_flag = 1;
                $error_message .= '<br> - ' . GeneralMessage::anggaran_perbelanjaan_program_aktivit_yang_dipohon_wajid_diisi;
            }
        }

        if ($model->load(Yii::$app->request->post()) && $error_flag==0) {
            // set e-Bantuan ID
            //$model->ebantuan_id =  $model->permohonan_e_bantuan_id . '/' . date("Y") . '/' . $model->no_pendaftaran . '/' . $model->nama_pertubuhan_persatuan;
            $model->ebantuan_id =  $model->permohonan_e_bantuan_id . '/' . date("Y");
            $model->save();
                    
            // update all the temporary session id with Permohonan e-Bantuan id
            if(isset(Yii::$app->session->id)){
                PermohonanEBantuanJawatankuasa::updateAll(['permohonan_e_bantuan_id' => $model->permohonan_e_bantuan_id], 'session_id = "'.Yii::$app->session->id.'"');
                PermohonanEBantuanJawatankuasa::updateAll(['session_id' => ''], 'permohonan_e_bantuan_id = "'.$model->permohonan_e_bantuan_id.'"');
                
                PermohonanEBantuanObjektifPertubuhan::updateAll(['permohonan_e_bantuan_id' => $model->permohonan_e_bantuan_id], 'session_id = "'.Yii::$app->session->id.'"');
                PermohonanEBantuanObjektifPertubuhan::updateAll(['session_id' => ''], 'permohonan_e_bantuan_id = "'.$model->permohonan_e_bantuan_id.'"');
                
                PermohonanEBantuanSenaraiPermohonan::updateAll(['permohonan_e_bantuan_id' => $model->permohonan_e_bantuan_id], 'session_id = "'.Yii::$app->session->id.'"');
                PermohonanEBantuanSenaraiPermohonan::updateAll(['session_id' => ''], 'permohonan_e_bantuan_id = "'.$model->permohonan_e_bantuan_id.'"');
                
                PermohonanEBantuanPendapatanTahunLepas::updateAll(['permohonan_e_bantuan_id' => $model->permohonan_e_bantuan_id], 'session_id = "'.Yii::$app->session->id.'"');
                PermohonanEBantuanPendapatanTahunLepas::updateAll(['session_id' => ''], 'permohonan_e_bantuan_id = "'.$model->permohonan_e_bantuan_id.'"');
                
                PermohonanEBantuanAnggaranPerbelanjaan::updateAll(['permohonan_e_bantuan_id' => $model->permohonan_e_bantuan_id], 'session_id = "'.Yii::$app->session->id.'"');
                PermohonanEBantuanAnggaranPerbelanjaan::updateAll(['session_id' => ''], 'permohonan_e_bantuan_id = "'.$model->permohonan_e_bantuan_id.'"');
            }
            
            $file = UploadedFile::getInstance($model, 'muat_naik_pb4');
            if($file){
                $model->muat_naik_pb4 = Upload::uploadFile($file, Upload::eBantuanFolder, 'muat_naik_pb4-' . $model->permohonan_e_bantuan_id);
            }
            
            $file = UploadedFile::getInstance($model, 'muat_naik_pb5');
            if($file){
                $model->muat_naik_pb5 = Upload::uploadFile($file, Upload::eBantuanFolder, 'muat_naik_pb5-' . $model->permohonan_e_bantuan_id);
            }
            
            $file = UploadedFile::getInstance($model, 'muat_naik_pb6');
            if($file){
                $model->muat_naik_pb6 = Upload::uploadFile($file, Upload::eBantuanFolder, 'muat_naik_pb6-' . $model->permohonan_e_bantuan_id);
            }
            
            $file = UploadedFile::getInstance($model, 'kertas_kerja');
            if($file){
                $model->kertas_kerja = Upload::uploadFile($file, Upload::eBantuanFolder, 'kertas_kerja-' . $model->permohonan_e_bantuan_id);
            }
            
            $file = UploadedFile::getInstance($model, 'sijil_pendaftaran_persatuan');
            if($file){
                $model->sijil_pendaftaran_persatuan = Upload::uploadFile($file, Upload::eBantuanFolder, 'sijil_pendaftaran_persatuan-' . $model->permohonan_e_bantuan_id);
            }
            
            $file = UploadedFile::getInstance($model, 'salinan_perlembagaan_persatuan');
            if($file){
                $model->salinan_perlembagaan_persatuan = Upload::uploadFile($file, Upload::eBantuanFolder, 'salinan_perlembagaan_persatuan-' . $model->permohonan_e_bantuan_id);
            }
            
            $file = UploadedFile::getInstance($model, 'senarai_ahli_jawatankuasa_persatuan');
            if($file){
                $model->senarai_ahli_jawatankuasa_persatuan = Upload::uploadFile($file, Upload::eBantuanFolder, 'senarai_ahli_jawatankuasa_persatuan-' . $model->permohonan_e_bantuan_id);
            }
            
            $file = UploadedFile::getInstance($model, 'salinan_akaun_bank_persatuan');
            if($file){
                $model->salinan_akaun_bank_persatuan = Upload::uploadFile($file, Upload::eBantuanFolder, 'salinan_akaun_bank_persatuan-' . $model->permohonan_e_bantuan_id);
            }
            
            $file = UploadedFile::getInstance($model, 'laporan_penyata_kewangan_tahunan');
            if($file){
                $model->laporan_penyata_kewangan_tahunan = Upload::uploadFile($file, Upload::eBantuanFolder, 'laporan_penyata_kewangan_tahunan-' . $model->permohonan_e_bantuan_id);
            }
            
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->permohonan_e_bantuan_id]);
            }
        } 
        
        if($error_flag == 1 && $error_message != ''){
            Yii::$app->getSession()->setFlash('error', $error_message);
        }
        
        return $this->render('create', [
            'model' => $model,
            'searchModelPermohonan' => $searchModelPermohonan,
            'dataProviderPermohonan' => $dataProviderPermohonan,
            'searchModelOP' => $searchModelOP,
            'dataProviderOP' => $dataProviderOP,
            'searchModelJawatankuasa' => $searchModelJawatankuasa,
            'dataProviderJawatankuasa' => $dataProviderJawatankuasa,
            'searchModelSAP' => $searchModelSAP,
            'dataProviderSAP' => $dataProviderSAP,
            'searchModelPTL' => $searchModelPTL,
            'dataProviderPTL' => $dataProviderPTL,
            'searchModelAP' => $searchModelAP,
            'dataProviderAP' => $dataProviderAP,
            'readonly' => false,
        ]);
    }

    /**
     * Updates an existing PermohonanEBantuan model.
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
        
        $model->kelulusan_id = $model->kelulusan;
        $model->negeri_sokongan_id = $model->negeri_sokongan;
        
        $queryPar = null;
        
        $queryPar['PermohonanEBantuanJawatankuasaSearch']['permohonan_e_bantuan_id'] = $id;
        $queryPar['PermohonanEBantuanObjektifPertubuhanSearch']['permohonan_e_bantuan_id'] = $id;
        $queryPar['PermohonanEBantuanSenaraiPermohonanSearch']['permohonan_e_bantuan_id'] = $id;
        $queryPar['PermohonanEBantuanPendapatanTahunLepasSearch']['permohonan_e_bantuan_id'] = $id;
        $queryPar['PermohonanEBantuanAnggaranPerbelanjaanSearch']['permohonan_e_bantuan_id'] = $id;
        
        $searchModelPermohonan = new PermohonanEBantuanSenaraiPermohonanSearch();
        $dataProviderPermohonan = $searchModelPermohonan->search($queryPar);
        
        $searchModelOP = new PermohonanEBantuanObjektifPertubuhanSearch();
        $dataProviderOP = $searchModelOP->search($queryPar);
        
        $searchModelJawatankuasa = new PermohonanEBantuanJawatankuasaSearch();
        $dataProviderJawatankuasa = $searchModelJawatankuasa->search($queryPar);
        
        $searchModelSAP = new PermohonanEBantuanSenaraiAktivitiProjekSearch();
        $dataProviderSAP = $searchModelSAP->search($queryPar);
        
        $searchModelPTL = new PermohonanEBantuanPendapatanTahunLepasSearch();
        $dataProviderPTL = $searchModelPTL->search($queryPar);
        
        $searchModelAP = new PermohonanEBantuanAnggaranPerbelanjaanSearch();
        $dataProviderAP = $searchModelAP->search($queryPar);
        
        $boolStatusPermohonanChanged = 0;
        
        if($model->load(Yii::$app->request->post()) && ($model->status_permohonan != $model->getOldAttribute('status_permohonan'))){
            $boolStatusPermohonanChanged = 1;
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $email = "";
            
            if(isset($model->user_public_id)){
                $modelPublicUser = UserPublic::findOne($model->user_public_id);
                if(isset($modelPublicUser->email)){
                    $email = $modelPublicUser->email;
                }
            } else {
                $email = $model->email;
            }
            
            if($boolStatusPermohonanChanged && $email != ""){
                if($model->status_permohonan == RefStatusPermohonanEBantuan::STATUS_LULUS){
                    Yii::$app->mailer->compose()
                    ->setTo($email)
                    ->setSubject('SPSB: Permohonan e-Bantuan')
                    ->setHtmlBody('Tuan/Puan,<br><br>
Sukacita dimaklumkan permohonan anda diluluskan. Surat kelulusan 
akan dihantar ke alamat surat menyurat. Sila muat turun borang Surat Setuju Terima (PB-4) dan 
kemukakan kepada urus setia dalam tempoh 14 hari dari tarikh penerimaan surat kelulusan untuk 
tujuan penyelarasan dan pembayaran. Kegagalan mengemukakan dokumen tersebut di dalam tempoh yang 
ditetapkan akan menyebabkan kelulusan ini terbatal.
<br>
<br>
<br>
Sekian, terima kasih.

<br>
<br>
Urusetia Bantuan Induk <br>
Jabatan Belia dan Sukan Negara<br><br>

Ini adalah cetakan komputer tandatangan tidak diperlukan')->send();
                } elseif($model->status_permohonan == RefStatusPermohonanEBantuan::STATUS_TOLAK){
                     Yii::$app->mailer->compose()
                    ->setTo($email)
                    ->setSubject('SPSB: Permohonan e-Bantuan')
                    ->setHtmlBody('Dimaklumkan bahawa permohonan tuan TIDAK BERJAYA.')->send();
                }
            }
            
            if($boolStatusPermohonanChanged && $model->status_permohonan == RefStatusPermohonanEBantuan::STATUS_TAK_LENGKAP){
                $model->hantar_flag = 0; //if tidak lengkap allow pemohon to kemaskini
            }
            
            // set e-Bantuan ID
            //$model->ebantuan_id =  $model->permohonan_e_bantuan_id . '/' . date("Y") . '/' . $model->no_pendaftaran . '/' . $model->nama_pertubuhan_persatuan;
            //$model->save();
            $file = UploadedFile::getInstance($model, 'muat_naik_pb4');
            if($file){
                $model->muat_naik_pb4 = Upload::uploadFile($file, Upload::eBantuanFolder, 'muat_naik_pb4-' . $model->permohonan_e_bantuan_id);
            }
            
            $file = UploadedFile::getInstance($model, 'muat_naik_pb5');
            if($file){
                $model->muat_naik_pb5 = Upload::uploadFile($file, Upload::eBantuanFolder, 'muat_naik_pb5-' . $model->permohonan_e_bantuan_id);
            }
            
            $file = UploadedFile::getInstance($model, 'muat_naik_pb6');
            if($file){
                $model->muat_naik_pb6 = Upload::uploadFile($file, Upload::eBantuanFolder, 'muat_naik_pb6-' . $model->permohonan_e_bantuan_id);
            }
            
            $file = UploadedFile::getInstance($model, 'kertas_kerja');
            if($file){
                $model->kertas_kerja = Upload::uploadFile($file, Upload::eBantuanFolder, 'kertas_kerja-' . $model->permohonan_e_bantuan_id);
            }
            
            $file = UploadedFile::getInstance($model, 'sijil_pendaftaran_persatuan');
            if($file){
                $model->sijil_pendaftaran_persatuan = Upload::uploadFile($file, Upload::eBantuanFolder, 'sijil_pendaftaran_persatuan-' . $model->permohonan_e_bantuan_id);
            }
            
            $file = UploadedFile::getInstance($model, 'salinan_perlembagaan_persatuan');
            if($file){
                $model->salinan_perlembagaan_persatuan = Upload::uploadFile($file, Upload::eBantuanFolder, 'salinan_perlembagaan_persatuan-' . $model->permohonan_e_bantuan_id);
            }
            
            $file = UploadedFile::getInstance($model, 'senarai_ahli_jawatankuasa_persatuan');
            if($file){
                $model->senarai_ahli_jawatankuasa_persatuan = Upload::uploadFile($file, Upload::eBantuanFolder, 'senarai_ahli_jawatankuasa_persatuan-' . $model->permohonan_e_bantuan_id);
            }
            
            $file = UploadedFile::getInstance($model, 'salinan_akaun_bank_persatuan');
            if($file){
                $model->salinan_akaun_bank_persatuan = Upload::uploadFile($file, Upload::eBantuanFolder, 'salinan_akaun_bank_persatuan-' . $model->permohonan_e_bantuan_id);
            }
            
            $file = UploadedFile::getInstance($model, 'laporan_penyata_kewangan_tahunan');
            if($file){
                $model->laporan_penyata_kewangan_tahunan = Upload::uploadFile($file, Upload::eBantuanFolder, 'laporan_penyata_kewangan_tahunan-' . $model->permohonan_e_bantuan_id);
            }
            
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->permohonan_e_bantuan_id]);
            }
        } 
        
        return $this->render('update', [
            'model' => $model,
            'searchModelPermohonan' => $searchModelPermohonan,
            'dataProviderPermohonan' => $dataProviderPermohonan,
            'searchModelOP' => $searchModelOP,
            'dataProviderOP' => $dataProviderOP,
            'searchModelJawatankuasa' => $searchModelJawatankuasa,
            'dataProviderJawatankuasa' => $dataProviderJawatankuasa,
            'searchModelSAP' => $searchModelSAP,
            'dataProviderSAP' => $dataProviderSAP,
            'searchModelPTL' => $searchModelPTL,
            'dataProviderPTL' => $dataProviderPTL,
            'searchModelAP' => $searchModelAP,
            'dataProviderAP' => $dataProviderAP,
            'readonly' => false,
        ]);
    }

    /**
     * Deletes an existing PermohonanEBantuan model.
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
        self::actionDeleteupload($id, 'muat_naik_pb4');
        
        self::actionDeleteupload($id, 'muat_naik_pb5');
        
        self::actionDeleteupload($id, 'muat_naik_pb6');
        
        self::actionDeleteupload($id, 'kertas_kerja');
        
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the PermohonanEBantuan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PermohonanEBantuan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PermohonanEBantuan::findOne($id)) !== null) {
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
/*                 if (!unlink($img)) {
                    return false;
                } */
				$img = substr($img, strrpos( $img, 'uploads'));
				@unlink($img);
            }

            $img = $this->findModel($id);
            $img->$field = NULL;
            $img->update();

            return $this->redirect(['update', 'id' => $id]);
    }
    
    /**
     * Updates an existing PermohonanEBantuan model.
     * If hantar is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionHantar($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = $this->findModel($id);
        
        $model->hantar_flag = 1; // set hantar flag
        $model->tarikh_hantar = GeneralFunction::getCurrentTimestamp(); // set hantar date
        
        $model->save();
        
        return $this->redirect(['index']);
    }
}
