<?php

namespace backend\controllers;

use Yii;
use app\models\PermohonanEBantuan;
use backend\models\PermohonanEBantuanSearch;
use app\models\PermohonanEBantuanSenaraiPermohonan;
use backend\models\PermohonanEBantuanSenaraiPermohonanSearch;
use app\models\PermohonanEBantuanObjektifPertubuhan;
use backend\models\PermohonanEBantuanObjektifPertubuhanSearch;
use app\models\PermohonanEBantuanJawatankuasa;
use backend\models\PermohonanEBantuanJawatankuasaSearch;
use app\models\PermohonanEBantuanSenaraiAktivitiProjek;
use backend\models\PermohonanEBantuanSenaraiAktivitiProjekSearch;
use app\models\PermohonanEBantuanPendapatanTahunLepas;
use backend\models\PermohonanEBantuanPendapatanTahunLepasSearch;
use app\models\PermohonanEBantuanAnggaranPerbelanjaan;
use backend\models\PermohonanEBantuanAnggaranPerbelanjaanSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

// contant values
use app\models\general\Upload;
use app\models\general\GeneralVariable;
use app\models\general\GeneralLabel;
use common\models\general\GeneralFunction;

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
        
        $queryPar['PermohonanEBantuanSearch']['user_public_id'] = Yii::$app->user->identity->id;
        
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

            $JUMLAH_PEMOHONAN = number_format($JUMLAH_PEMOHONAN,2);
            $JUMLAH_BUTIRAN_DISOKONG = number_format($JUMLAH_BUTIRAN_DISOKONG,2);
            $JUMLAH_BUTIRAN_DIPERAKUKAN = number_format($JUMLAH_BUTIRAN_DIPERAKUKAN,2);

            $html_content = str_replace("[tbl_permohonan_e_bantuan - nama_pertubuhan_persatuan]",$model->nama_pertubuhan_persatuan,$html_content);
            $html_content = str_replace("[tbl_permohonan_e_bantuan - nama_program]",$model->nama_program,$html_content);
            $html_content = str_replace("[tbl_permohonan_e_bantuan - tarikh_pelaksanaan]",$model->tarikh_pelaksanaan,$html_content);
            $html_content = str_replace("[tbl_permohonan_e_bantuan - tempat_pelaksanaan]",$model->tempat_pelaksanaan,$html_content);
            $html_content = str_replace("[tbl_permohonan_e_bantuan - bilangan_peserta]",$model->bilangan_peserta,$html_content);
            $html_content = str_replace("[tbl_permohonan_e_bantuan - jumlah_bantuan_yang_dipohon]","RM ".$model->jumlah_bantuan_yang_dipohon,$html_content);
            $html_content = str_replace("[anggaran_perbelanjaan_table]",$anggaran_perbelanjaan_table,$html_content);
            $html_content = str_replace("[JUMLAH_PEMOHONAN]",$JUMLAH_PEMOHONAN,$html_content);
            $html_content = str_replace("[JUMLAH_BUTIRAN_DISOKONG]",$JUMLAH_BUTIRAN_DISOKONG,$html_content);
            $html_content = str_replace("[JUMLAH_BUTIRAN_DIPERAKUKAN]",$JUMLAH_BUTIRAN_DIPERAKUKAN,$html_content);

        }
        
        $pdf->content = $html_content;

        return $pdf->render();
    }
// eddie (print2) end

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
        
        // set public user id
        $model->user_public_id = Yii::$app->user->identity->id;
        
        // set permohonan status to 'Sedang Di Semak'
        $model->status_permohonan = '1';
        
        // set permohonan nama persatuan to public user nama persatuan
        $model->nama_pertubuhan_persatuan = Yii::$app->user->identity->nama_persatuan_e_bantuan;
        
        // set no pendaftaran to public user no pendaftaran
        $model->no_pendaftaran = Yii::$app->user->identity->username;
        
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

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
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
                $model->muat_naik_pb4 = Upload::uploadFile($file, Upload::eBantuanFolder, $model->permohonan_e_bantuan_id);
            }
            
            $file = UploadedFile::getInstance($model, 'muat_naik_pb5');
            if($file){
                $model->muat_naik_pb5 = Upload::uploadFile($file, Upload::eBantuanFolder, $model->permohonan_e_bantuan_id);
            }
            
            $file = UploadedFile::getInstance($model, 'muat_naik_pb6');
            if($file){
                $model->muat_naik_pb6 = Upload::uploadFile($file, Upload::eBantuanFolder, $model->permohonan_e_bantuan_id);
            }
            
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->permohonan_e_bantuan_id]);
            }
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

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            // set e-Bantuan ID
            //$model->ebantuan_id =  $model->permohonan_e_bantuan_id . '/' . date("Y") . '/' . $model->no_pendaftaran . '/' . $model->nama_pertubuhan_persatuan;
            //$model->save();
            $file = UploadedFile::getInstance($model, 'muat_naik_pb4');
            if($file){
                $model->muat_naik_pb4 = Upload::uploadFile($file, Upload::eBantuanFolder, $model->permohonan_e_bantuan_id);
            }
            
            $file = UploadedFile::getInstance($model, 'muat_naik_pb5');
            if($file){
                $model->muat_naik_pb5 = Upload::uploadFile($file, Upload::eBantuanFolder, $model->permohonan_e_bantuan_id);
            }
            
            $file = UploadedFile::getInstance($model, 'muat_naik_pb6');
            if($file){
                $model->muat_naik_pb6 = Upload::uploadFile($file, Upload::eBantuanFolder, $model->permohonan_e_bantuan_id);
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
