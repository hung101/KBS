<?php

namespace frontend\controllers;

use Yii;
use app\models\SkimKebajikan;
use app\models\SkimKebajikanSearch;
use app\models\MsnLaporanSkimKebajikan;
use app\models\MsnLaporan;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\helpers\Json;
use yii\helpers\BaseUrl;

use app\models\general\Upload;
use app\models\general\GeneralLabel;
use app\models\general\GeneralVariable;
use common\models\general\GeneralFunction;

// table reference
use app\models\Atlet;
use app\models\RefJenisKebajikan;
use app\models\RefSukan;
use app\models\RefPerkara;
use app\models\RefSukanSkimKebajikan;
use app\models\RefJenisPermohonanSkim;
use app\models\RefBank;
use app\models\RefHubunganSkimKebajian;
use app\models\RefKelulusanInsentif;

/**
 * SkimKebajikanController implements the CRUD actions for SkimKebajikan model.
 */
class SkimKebajikanController extends Controller
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
     * Lists all SkimKebajikan models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $searchModel = new SkimKebajikanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single SkimKebajikan model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = $this->findModel($id);
        
        $ref = Atlet::findOne(['atlet_id' => $model->nama_pemohon]);
        $model->nama_pemohon = $ref['nameAndIC'];
        
        $ref = RefSukan::findOne(['id' => $model->jenis_sukan]);
        $model->jenis_sukan = $ref['desc'];
        
        $ref = RefJenisKebajikan::findOne(['id' => $model->jenis_bantuan_skak]);
        $model->jenis_bantuan_skak = $ref['desc'];
        
        $ref = RefPerkara::findOne(['id' => $model->perkara]);
        $model->perkara = $ref['desc'];
        
        $ref = RefSukanSkimKebajikan::findOne(['id' => $model->sukan]);
        $model->sukan = $ref['desc'];
        
        $ref = RefJenisPermohonanSkim::findOne(['id' => $model->jenis_permohonan]);
        $model->jenis_permohonan = $ref['desc'];
        
        $ref = RefBank::findOne(['id' => $model->bank_penerima]);
        $model->bank_penerima = $ref['desc'];
        
        //$YesNo = GeneralLabel::getYesNoLabel($model->kelulusan);
        //$model->kelulusan = $YesNo;
        
        $ref = RefKelulusanInsentif::findOne(['id' => $model->kelulusan]);
        $model->kelulusan = $ref['desc'];
        
        $ref = RefHubunganSkimKebajian::findOne(['id' => $model->hubungan_penerima]);
        $model->hubungan_penerima = $ref['desc'];
        
        return $this->render('view', [
            'model' => $model,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new SkimKebajikan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new SkimKebajikan();
        $oldKelulusan = null;
        
        if($model->load(Yii::$app->request->post())){
            $oldKelulusan = $model->getOldAttribute('kelulusan');
        }

        if (Yii::$app->request->post() && $model->save()) {
            $file = UploadedFile::getInstance($model, 'muat_naik');
            $filename = $model->skim_kebajikan_id . "-muat_naik";
            if($file){
                $model->muat_naik = Upload::uploadFile($file, Upload::skimKebajikanFolder, $filename);
            }
            
            $file = UploadedFile::getInstance($model, 'sijil_kematian');
            $filename = $model->skim_kebajikan_id . "-sijil_kematian";
            if($file){
                $model->sijil_kematian = Upload::uploadFile($file, Upload::skimKebajikanFolder, $filename);
            }
            
            $file = UploadedFile::getInstance($model, 'dokumen_yang_mengesahkan_hubungan');
            $filename = $model->skim_kebajikan_id . "-dokumen_yang_mengesahkan_hubungan";
            if($file){
                $model->dokumen_yang_mengesahkan_hubungan = Upload::uploadFile($file, Upload::skimKebajikanFolder, $filename);
            }
            
            $file = UploadedFile::getInstance($model, 'surat_pengesahan_atlet_negara');
            $filename = $model->skim_kebajikan_id . "-surat_pengesahan_atlet_negara";
            if($file){
                $model->surat_pengesahan_atlet_negara = Upload::uploadFile($file, Upload::skimKebajikanFolder, $filename);
            }
            
            $file = UploadedFile::getInstance($model, 'laporan_doktor');
            $filename = $model->skim_kebajikan_id . "-laporan_doktor";
            if($file){
                $model->laporan_doktor = Upload::uploadFile($file, Upload::skimKebajikanFolder, $filename);
            }
            
            $file = UploadedFile::getInstance($model, 'resit_perubatan');
            $filename = $model->skim_kebajikan_id . "-resit_perubatan";
            if($file){
                $model->resit_perubatan = Upload::uploadFile($file, Upload::skimKebajikanFolder, $filename);
            }
            
            $file = UploadedFile::getInstance($model, 'surat_pengesahan_atlet_majlis_sukan_negara_perubatan');
            $filename = $model->skim_kebajikan_id . "-surat_pengesahan_atlet_majlis_sukan_negara_perubatan";
            if($file){
                $model->surat_pengesahan_atlet_majlis_sukan_negara_perubatan = Upload::uploadFile($file, Upload::skimKebajikanFolder, $filename);
            }
            
            $file = UploadedFile::getInstance($model, 'keratan_akhbar');
            $filename = $model->skim_kebajikan_id . "-keratan_akhbar";
            if($file){
                $model->keratan_akhbar = Upload::uploadFile($file, Upload::skimKebajikanFolder, $filename);
            }
            
            $file = UploadedFile::getInstance($model, 'laporan_polis_bomba');
            $filename = $model->skim_kebajikan_id . "-laporan_polis_bomba";
            if($file){
                $model->laporan_polis_bomba = Upload::uploadFile($file, Upload::skimKebajikanFolder, $filename);
            }
            
            $file = UploadedFile::getInstance($model, 'surat_pengesahan_atlet_majlis_sukan_negara_bencana');
            $filename = $model->skim_kebajikan_id . "-surat_pengesahan_atlet_majlis_sukan_negara_bencana";
            if($file){
                $model->surat_pengesahan_atlet_majlis_sukan_negara_bencana = Upload::uploadFile($file, Upload::skimKebajikanFolder, $filename);
            }
            
            $file = UploadedFile::getInstance($model, 'dokumen_yang_berkenaan_mengikut_situasi_kes');
            $filename = $model->skim_kebajikan_id . "-dokumen_yang_berkenaan_mengikut_situasi_kes";
            if($file){
                $model->dokumen_yang_berkenaan_mengikut_situasi_kes = Upload::uploadFile($file, Upload::skimKebajikanFolder, $filename);
            }
            
            if($model->save()){
                if($model->emel_penerima && $model->emel_penerima != "" && $model->kelulusan ){
                    if($model->kelulusan != $oldKelulusan){
                        try {
                            $refJenisKebajikan = RefJenisKebajikan::findOne(['id' => $model->jenis_bantuan_skak]);
                            $refJenisKebajikan['desc'] = strtoupper($refJenisKebajikan['desc']);
        
                                Yii::$app->mailer->compose()
                                        ->setTo($model->emel_penerima)
                                                                    ->setFrom('noreply@spsb.com')
                                        ->setSubject('Permohonan Skim Kebajikan Tuan/Puan Telah Diproses')
                                        ->setTextBody('Salam Sejahtera,
<br><br>
Tuan/Puan,
<br><br>
MAKLUMAN PERMOHONAN ' . $refJenisKebajikan['desc'] . '
<br><br>
Dengan hormatnya saya ingin menarik perhatian tuan mengenai perkara di atas adalah berkaitan.
<br><br>
2. Adalah dimaklumkan bahawa pihak Majlis <b>' .($model->kelulusan == 1)?'TELAH MELULUSKAN':'TIDAK MELULUSKAN'. '</b> permohonan bantuan dan peruntukan seperti berikut:
<br><br>
Permohonan:  ' . $refJenisKebajikan['desc'] . '
Jumlah Bantuan:  RM' . $model->jumlah_bantuan . '
<br><br>
3. Segala kerjasama dan perhatian pihak tuan diucapkan ribuan terima kasih.
<br><br>
                                "KE ARAH KECEMERLANGAN SUKAN"
                                Majlis Sukan Negara Malaysia.
                                ')->send();
                        }
                        catch(\Swift_SwiftException $exception)
                        {
                            //return 'Can sent mail due to the following exception'.print_r($exception);
                            Yii::$app->session->setFlash('error', 'Terdapat ralat menghantar e-mel.');
                        }
                    }
                }
                
                return $this->redirect(['view', 'id' => $model->skim_kebajikan_id]);
            }
        } 
        
        return $this->render('create', [
                'model' => $model,
                'readonly' => false,
            ]);
    }

    /**
     * Updates an existing SkimKebajikan model.
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
        $oldKelulusan = null;
        
        if($model->load(Yii::$app->request->post())){
            $oldKelulusan = $model->getOldAttribute('kelulusan');
        }

        if (Yii::$app->request->post() && $model->save()) {
            $file = UploadedFile::getInstance($model, 'muat_naik');
            $filename = $model->skim_kebajikan_id . "-muat_naik";
            if($file){
                $model->muat_naik = Upload::uploadFile($file, Upload::skimKebajikanFolder, $filename);
            }
            
            $file = UploadedFile::getInstance($model, 'sijil_kematian');
            $filename = $model->skim_kebajikan_id . "-sijil_kematian";
            if($file){
                $model->sijil_kematian = Upload::uploadFile($file, Upload::skimKebajikanFolder, $filename);
            }
            
            $file = UploadedFile::getInstance($model, 'dokumen_yang_mengesahkan_hubungan');
            $filename = $model->skim_kebajikan_id . "-dokumen_yang_mengesahkan_hubungan";
            if($file){
                $model->dokumen_yang_mengesahkan_hubungan = Upload::uploadFile($file, Upload::skimKebajikanFolder, $filename);
            }
            
            $file = UploadedFile::getInstance($model, 'surat_pengesahan_atlet_negara');
            $filename = $model->skim_kebajikan_id . "-surat_pengesahan_atlet_negara";
            if($file){
                $model->surat_pengesahan_atlet_negara = Upload::uploadFile($file, Upload::skimKebajikanFolder, $filename);
            }
            
            $file = UploadedFile::getInstance($model, 'laporan_doktor');
            $filename = $model->skim_kebajikan_id . "-laporan_doktor";
            if($file){
                $model->laporan_doktor = Upload::uploadFile($file, Upload::skimKebajikanFolder, $filename);
            }
            
            $file = UploadedFile::getInstance($model, 'resit_perubatan');
            $filename = $model->skim_kebajikan_id . "-resit_perubatan";
            if($file){
                $model->resit_perubatan = Upload::uploadFile($file, Upload::skimKebajikanFolder, $filename);
            }
            
            $file = UploadedFile::getInstance($model, 'surat_pengesahan_atlet_majlis_sukan_negara_perubatan');
            $filename = $model->skim_kebajikan_id . "-surat_pengesahan_atlet_majlis_sukan_negara_perubatan";
            if($file){
                $model->surat_pengesahan_atlet_majlis_sukan_negara_perubatan = Upload::uploadFile($file, Upload::skimKebajikanFolder, $filename);
            }
            
            $file = UploadedFile::getInstance($model, 'keratan_akhbar');
            $filename = $model->skim_kebajikan_id . "-keratan_akhbar";
            if($file){
                $model->keratan_akhbar = Upload::uploadFile($file, Upload::skimKebajikanFolder, $filename);
            }
            
            $file = UploadedFile::getInstance($model, 'laporan_polis_bomba');
            $filename = $model->skim_kebajikan_id . "-laporan_polis_bomba";
            if($file){
                $model->laporan_polis_bomba = Upload::uploadFile($file, Upload::skimKebajikanFolder, $filename);
            }
            
            $file = UploadedFile::getInstance($model, 'surat_pengesahan_atlet_majlis_sukan_negara_bencana');
            $filename = $model->skim_kebajikan_id . "-surat_pengesahan_atlet_majlis_sukan_negara_bencana";
            if($file){
                $model->surat_pengesahan_atlet_majlis_sukan_negara_bencana = Upload::uploadFile($file, Upload::skimKebajikanFolder, $filename);
            }
            
            $file = UploadedFile::getInstance($model, 'dokumen_yang_berkenaan_mengikut_situasi_kes');
            $filename = $model->skim_kebajikan_id . "-dokumen_yang_berkenaan_mengikut_situasi_kes";
            if($file){
                $model->dokumen_yang_berkenaan_mengikut_situasi_kes = Upload::uploadFile($file, Upload::skimKebajikanFolder, $filename);
            }
            
            if($model->save()){
                if($model->emel_penerima && $model->emel_penerima != "" && isset($model->kelulusan) ){
                    if($model->kelulusan != $oldKelulusan){
                        try {
                            if($model->kelulusan == 1){ // Approved
                                Yii::$app->mailer->compose()
                                        ->setTo($model->emel_penerima)
                                                                    ->setFrom('noreply@spsb.com')
                                        ->setSubject('Permohonan Skim Kebajikan Tuan/Puan Telah Diproses')
                                        ->setTextBody('Salam Sejahtera,
<br><br>
Sukacita, permohonan skim kebajikan Tuan/Puan telah LULUS.
<br><br>
"KE ARAH KECEMERLANGAN SUKAN"
Majlis Sukan Negara Malaysia.
')->send();
                            } else { // Not Approved
                                Yii::$app->mailer->compose()
                                        ->setTo($model->emel_penerima)
                                                                    ->setFrom('noreply@spsb.com')
                                        ->setSubject('Permohonan Skim Kebajikan Tuan/Puan Telah Diproses')
                                        ->setTextBody('Salam Sejahtera,
<br><br>
Permohonan skim kebajikan Tuan/Puan TIDAK LULUS.
<br><br>
"KE ARAH KECEMERLANGAN SUKAN"
Majlis Sukan Negara Malaysia.
                                ')->send();
                            }
                        }
                        catch(\Swift_SwiftException $exception)
                        {
                            //return 'Can sent mail due to the following exception'.print_r($exception);
                            Yii::$app->session->setFlash('error', 'Terdapat ralat menghantar e-mel.'.print_r($exception));
                        }
                    }
                }
                
                return $this->redirect(['view', 'id' => $model->skim_kebajikan_id]);
            }
        } 
        
        return $this->render('update', [
                'model' => $model,
                'readonly' => false,
            ]);
    }

    /**
     * Deletes an existing SkimKebajikan model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        // delete upload file
        self::actionDeleteupload($id, 'muat_naik');
        self::actionDeleteupload($id, 'sijil_kematian');
        self::actionDeleteupload($id, 'dokumen_yang_mengesahkan_hubungan');
        self::actionDeleteupload($id, 'surat_pengesahan_atlet_negara');
        self::actionDeleteupload($id, 'laporan_doktor');
        self::actionDeleteupload($id, 'resit_perubatan');
        self::actionDeleteupload($id, 'surat_pengesahan_atlet_majlis_sukan_negara_perubatan');
        self::actionDeleteupload($id, 'keratan_akhbar');
        self::actionDeleteupload($id, 'laporan_polis_bomba');
        self::actionDeleteupload($id, 'surat_pengesahan_atlet_majlis_sukan_negara_bencana');
        self::actionDeleteupload($id, 'dokumen_yang_berkenaan_mengikut_situasi_kes');
        
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the SkimKebajikan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return SkimKebajikan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SkimKebajikan::findOne($id)) !== null) {
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
    
    public function actionLaporanSkimKebajikan()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new MsnLaporanSkimKebajikan();
        $model->format = 'html';

        if ($model->load(Yii::$app->request->post())) {
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-laporan-skim-kebajikan'
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'atlet' => $model->atlet
                    , 'sukan' => $model->sukan
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-laporan-skim-kebajikan'
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'atlet' => $model->atlet
                    , 'sukan' => $model->sukan
                    , 'format' => $model->format
                ]);
            }
        } 

        return $this->render('laporan_skim_kebajikan', [
            'model' => $model,
            'readonly' => false,
        ]);
    }
    
    public function actionGenerateLaporanSkimKebajikan($tarikh_dari, $tarikh_hingga, $atlet, $sukan, $format)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        if($tarikh_dari == "") $tarikh_dari = array();
        else $tarikh_dari = array($tarikh_dari);
        
        if($tarikh_hingga == "") $tarikh_hingga = array();
        else $tarikh_hingga = array($tarikh_hingga);
        
        if($atlet == "") $atlet = array();
        else $atlet = array($atlet);
        
        if($sukan == "") $sukan = array();
        else $sukan = array($sukan);
        
        $controls = array(
            'FROM_DATE' => $tarikh_dari,
            'TO_DATE' => $tarikh_hingga,
            'ATLET' => $atlet,
            'SUKAN' => $sukan,
        );
        
        GeneralFunction::generateReport('/spsb/MSN/LaporanSkimKebajikan', $format, $controls, 'laporan_skim_kebajikan');
    }
    
    public function actionLaporanStatistikPemberianSkak()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new MsnLaporan();
        $model->format = 'html';

        if ($model->load(Yii::$app->request->post())) {
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-laporan-statistik-pemberian-skak'
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-laporan-statistik-pemberian-skak'
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'format' => $model->format
                ]);
            }
        } 

        return $this->render('laporan_statistik_pemberian_skak', [
            'model' => $model,
            'readonly' => false,
        ]);
    }
    
    public function actionGenerateLaporanStatistikPemberianSkak($tarikh_dari, $tarikh_hingga, $format)
    {
        if($tarikh_dari == "") $tarikh_dari = array();
        else $tarikh_dari = array($tarikh_dari);
        
        if($tarikh_hingga == "") $tarikh_hingga = array();
        else $tarikh_hingga = array($tarikh_hingga);
        
        $controls = array(
            'FROM_DATE' => $tarikh_dari,
            'TO_DATE' => $tarikh_hingga,
        );
        
        GeneralFunction::generateReport('/spsb/MSN/LaporanStatistikPemberianSkak', $format, $controls, 'laporan_statistik_pemberian_skak');
    }
	
	public function actionPrintJkb($id)
	{
		if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }  
		
        $model = $this->findModel($id);
		
		$ref = Atlet::findOne(['atlet_id' => $model->nama_pemohon]);
        $model->nama_pemohon = $ref['name_penuh'];
        
        $ref = RefSukan::findOne(['id' => $model->jenis_sukan]);
        $model->jenis_sukan = $ref['desc'];
        
        $ref = RefJenisKebajikan::findOne(['id' => $model->jenis_bantuan_skak]);
        $model->jenis_bantuan_skak = $ref['desc'];
        
        $ref = RefPerkara::findOne(['id' => $model->perkara]);
        $model->perkara = $ref['desc'];
        
        $ref = RefSukanSkimKebajikan::findOne(['id' => $model->sukan]);
        $model->sukan = $ref['desc'];
        
        $ref = RefJenisPermohonanSkim::findOne(['id' => $model->jenis_permohonan]);
        $model->jenis_permohonan = $ref['desc'];
        
        $ref = RefBank::findOne(['id' => $model->bank_penerima]);
        $model->bank_penerima = $ref['desc'];
        
        $ref = RefKelulusanInsentif::findOne(['id' => $model->kelulusan]);
        $model->kelulusan = $ref['desc'];
        
        $ref = RefHubunganSkimKebajian::findOne(['id' => $model->hubungan_penerima]);
        $model->hubungan_penerima = $ref['desc'];
		
        $pdf = new \mPDF('utf-8', 'A4-L');

        $pdf->title = 'Borang JKB';

        //$pdf->cssFile = 'report.css';
        $stylesheet = file_get_contents('css/report.css');

        $pdf->WriteHTML($stylesheet,1);
        
        $pdf->WriteHTML($this->renderpartial('print_jkb', [
             'model'  => $model,
        ]));

        $pdf->Output('Borang_jkb_'.$model->skim_kebajikan_id.'.pdf', 'I'); 
		
	}
}
