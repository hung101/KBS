<?php

namespace frontend\controllers;

use Yii;
use app\models\BantuanElaun;
use frontend\models\BantuanElaunSearch;
use app\models\MsnSuratSue;
use app\models\MsnLaporan;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\helpers\BaseUrl;

use app\models\general\Upload;
use app\models\general\GeneralVariable;
use common\models\general\GeneralFunction;

// table reference
use app\models\RefJantina;
use app\models\RefJenisBantuanSue;
use app\models\RefKelayakanAkademik;
use app\models\RefBandar;
use app\models\RefNegeri;
use app\models\RefBangsa;
use app\models\RefAgama;
use app\models\RefStatusPermohonanSue;
use app\models\RefNegara;
use app\models\ProfilBadanSukan;
use app\models\RefKursusBantuanElaun;

/**
 * BantuanElaunController implements the CRUD actions for BantuanElaun model.
 */
class BantuanElaunController extends Controller
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
     * Lists all BantuanElaun models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $queryParams = Yii::$app->request->queryParams;
        
        if(Yii::$app->user->identity->profil_badan_sukan){
            $queryParams['BantuanElaunSearch']['created_by'] = Yii::$app->user->identity->id;
        }
        
        $searchModel = new BantuanElaunSearch();
        $dataProvider = $searchModel->search($queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single BantuanElaun model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = $this->findModel($id);
        
        $model->jenis_bantuan_id = $model->jenis_bantuan;
        $ref = RefJenisBantuanSue::findOne(['id' => $model->jenis_bantuan]);
        $model->jenis_bantuan = $ref['desc'];
        
        $ref = RefJantina::findOne(['id' => $model->jantina]);
        $model->jantina = $ref['desc'];
        
        $ref = RefNegara::findOne(['id' => $model->kewarganegara]);
        $model->kewarganegara = $ref['desc'];
        
        $ref = RefBangsa::findOne(['id' => $model->bangsa]);
        $model->bangsa = $ref['desc'];
        
        $ref = RefAgama::findOne(['id' => $model->agama]);
        $model->agama = $ref['desc'];
        
        $ref = RefKelayakanAkademik::findOne(['id' => $model->kelayakan_akademi]);
        $model->kelayakan_akademi = $ref['desc'];
        
        $ref = RefNegeri::findOne(['id' => $model->alamat_negeri]);
        $model->alamat_negeri = $ref['desc'];
        
        $ref = RefBandar::findOne(['id' => $model->alamat_bandar]);
        $model->alamat_bandar = $ref['desc'];
        
        
        $model->status_permohonan_id = $model->status_permohonan;
        $ref = RefStatusPermohonanSue::findOne(['id' => $model->status_permohonan]);
        $model->status_permohonan = $ref['desc'];
        
        $ref = ProfilBadanSukan::findOne(['profil_badan_sukan' => $model->nama_persatuan]);
        $model->nama_persatuan = $ref['nama_badan_sukan'];
        
        //$ref = RefKursusBantuanElaun::findOne(['id' => $model->kursus]);
        //$model->kursus = $ref['desc'];
        
        if($model->tarikh != "") {$model->tarikh = GeneralFunction::convert($model->tarikh, GeneralFunction::TYPE_DATETIME);}
        if($model->tarikh_mula_dilantik != "") {$model->tarikh_mula_dilantik = GeneralFunction::convert($model->tarikh_mula_dilantik, GeneralFunction::TYPE_DATE);}
        if($model->tarikh_tamat_dilantik != "") {$model->tarikh_tamat_dilantik = GeneralFunction::convert($model->tarikh_tamat_dilantik, GeneralFunction::TYPE_DATE);}
        if($model->tarikh_lahir != "") {$model->tarikh_lahir = GeneralFunction::convert($model->tarikh_lahir, GeneralFunction::TYPE_DATE);}
        
        return $this->render('view', [
            'model' => $model,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new BantuanElaun model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new BantuanElaun();
        
		$model->tarikh = GeneralFunction::getCurrentTimestamp();
        
        $model->status_permohonan = RefStatusPermohonanSue::DALAM_PROSES;
        $oldStatusPermohonan = null;
        
        if(Yii::$app->user->identity->profil_badan_sukan){
            $model->nama_persatuan = Yii::$app->user->identity->profil_badan_sukan;
        }
        
        if($model->load(Yii::$app->request->post())){
            $oldStatusPermohonan = $model->getOldAttribute('status_permohonan');
        }
        
        if (Yii::$app->request->post() && $model->save()) {
            $file = UploadedFile::getInstance($model, 'muatnaik_gambar');
            $filename = $model->bantuan_elaun_id . "-muatnaik_gambar";
            if($file){
                $model->muatnaik_gambar = Upload::uploadFile($file, Upload::bantuanElaunFolder, $filename);
            }
            
            $file = UploadedFile::getInstance($model, 'muatnaik_dokumen');
            $filename = $model->bantuan_elaun_id . "-muatnaik_dokumen";
            if($file){
                $model->muatnaik_dokumen = Upload::uploadFile($file, Upload::bantuanElaunFolder, $filename);
            }
			
			$file = UploadedFile::getInstance($model, 'surat_permohonan');
            $filename = $model->bantuan_elaun_id . "-surat_permohonan";
            if($file){
                $model->surat_permohonan = Upload::uploadFile($file, Upload::bantuanElaunFolder, $filename);
            }
            
            if($model->emel && $model->emel != "" && $model->status_permohonan ){
                if($model->status_permohonan != $oldStatusPermohonan){
                    $ref = RefJenisBantuanSue::findOne(['id' => $model->jenis_bantuan]);
                    $jenis_bantuan = $ref['desc'];
                    
                    if(trim($jenis_bantuan) == "elaun sue"){
                        $jenis_bantuan = 'Elaun SUE';
                    } else if(trim($jenis_bantuan) == "elaun penyelaras psk"){
                       $jenis_bantuan = 'Elaun Penyelaras PSK';
                    } else if(trim($jenis_bantuan) == "emolumen psk"){
                       $jenis_bantuan = 'Emolumen PSK';
                    } 
                    
                    try {
                        if($model->status_permohonan == RefStatusPermohonanSue::LULUS){ // Approved
                            Yii::$app->mailer->compose()
                                    ->setTo($model->emel)
                                                                ->setFrom('noreply@spsb.com')
                                    ->setSubject('Permohonan ' . $jenis_bantuan . ' Tuan/Puan Telah Diproses')
                                    ->setHtmlBody('Salam Sejahtera,
<br><br>
Sukacita, permohonan ' . $jenis_bantuan . ' Tuan/Puan telah LULUS.
<br><br>
"KE ARAH KECEMERLANGAN SUKAN"
Majlis Sukan Negara Malaysia.
                            ')->send();
                        }
                    }
                    catch(\Swift_SwiftException $exception)
                    {
                        //return 'Can sent mail due to the following exception'.print_r($exception);
                        Yii::$app->session->setFlash('error', 'Terdapat ralat menghantar e-mel.');
                    }
                }
            }
            
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->bantuan_elaun_id]);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Updates an existing BantuanElaun model.
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
        
        $oldStatusPermohonan = null;
        
        $existingMuatnaikDokumen = $model->muatnaik_dokumen;
		$existingSurat = $model->surat_permohonan;
        
        if($model->load(Yii::$app->request->post())){
            $oldStatusPermohonan = $model->getOldAttribute('status_permohonan');
            
            $file = UploadedFile::getInstance($model, 'muatnaik_dokumen');

            if($file){
                //valid file to upload
                //upload file to server
                $filename = $model->bantuan_elaun_id . "-muatnaik_dokumen";
                $model->muatnaik_dokumen = Upload::uploadFile($file,  Upload::bantuanElaunFolder, $filename);
            } else {
                //invalid file to upload
                //remain existing file
                $model->muatnaik_dokumen = $existingMuatnaikDokumen;
            }
			
			$file = UploadedFile::getInstance($model, 'surat_permohonan');

            if($file){
                //valid file to upload
                //upload file to server
                $filename = $model->bantuan_elaun_id . "-surat_permohonan";
                $model->surat_permohonan = Upload::uploadFile($file,  Upload::bantuanElaunFolder, $filename);
            } else {
                //invalid file to upload
                //remain existing file
                $model->surat_permohonan = $existingSurat;
            }
        }

        if (Yii::$app->request->post() && $model->save()) {
            $file = UploadedFile::getInstance($model, 'muatnaik_gambar');
            $filename = $model->bantuan_elaun_id . "-muatnaik_gambar";
            if($file){
                $model->muatnaik_gambar = Upload::uploadFile($file, Upload::bantuanElaunFolder, $filename);
            }
            
            if($model->emel && $model->emel != "" && $model->status_permohonan ){
                if($model->status_permohonan != $oldStatusPermohonan){
                    $ref = RefJenisBantuanSue::findOne(['id' => $model->jenis_bantuan]);
                    $jenis_bantuan = $ref['desc'];
                    
                    $model->status_permohonan_id = $model->status_permohonan;
                    $ref = RefStatusPermohonanSue::findOne(['id' => $model->status_permohonan]);
                    $model->status_permohonan = $ref['desc'];
                    
                    if($model->jenis_bantuan == RefJenisBantuanSue::ELAUN_SUE){
                       $jenis_bantuan = 'Elaun SUE';
                    } else if($model->jenis_bantuan == RefJenisBantuanSue::ELAUN_PENYERLARAS_PSK){
                       $jenis_bantuan = 'Elaun Penyelaras PSK';
                    } else if($model->jenis_bantuan == RefJenisBantuanSue::EMOLUMEN_PSK){
                       $jenis_bantuan = 'Emolumen PSK';
                    } 
                    
                    
                    try {
                        //if($model->status_permohonan_id == RefStatusPermohonanSue::LULUS){ // Approved
                            Yii::$app->mailer->compose()
                                    ->setTo($model->emel)
                                                                ->setFrom('noreply@spsb.com')
                                    ->setSubject('Permohonan ' . $jenis_bantuan . ' Tuan/Puan telah diproses')
                                    ->setHtmlBody('Salam Sejahtera,
<br><br>
Dimaklumkan Permohonan ' . $jenis_bantuan . ' Persatuan Sukan Kebangsaan Tuan/Puan telah '.GeneralFunction::getUpperCaseWords($model->status_permohonan).'.
<br><br>
"KE ARAH KECEMERLANGAN SUKAN"<br><br>
Majlis Sukan Negara Malaysia.
                            ')->send();
                        //}
                    }
                    catch(\Swift_SwiftException $exception)
                    {
                        //return 'Can sent mail due to the following exception'.print_r($exception);
                        Yii::$app->session->setFlash('error', 'Terdapat ralat menghantar e-mel.');
                    }
                }
            }
            
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->bantuan_elaun_id]);
            }
        } else {
            return $this->render('update', [
                'model' => $model,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Deletes an existing BantuanElaun model.
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
        self::actionDeleteimg($id, 'muatnaik_dokumen');
        self::actionDeleteimg($id, 'muatnaik_gambar');
        
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the BantuanElaun model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return BantuanElaun the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = BantuanElaun::findOne($id)) !== null) {
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
/*                 if (!unlink($img)) {
                    return false;
                } */
				@unlink($img);
            }

            $img = $this->findModel($id);
            $img->$field = NULL;
            $img->update();

            return $this->redirect(['update', 'id' => $id]);
    }
    
    public function actionSuratLantikanSue($sue_id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new MsnSuratSue();
        $model->sue_id = $sue_id;
        $model->format = 'html';

        if ($model->load(Yii::$app->request->post())) {
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-surat-lantikan-sue'
                    , 'sue_id' => $model->sue_id
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-surat-lantikan-sue'
                    , 'sue_id' => $model->sue_id
                    , 'format' => $model->format
                ]);
            }
        } 

        return $this->render('surat_lantikan_sue', [
            'model' => $model,
            'readonly' => false,
        ]);
    }
    
    public function actionGenerateSuratLantikanSue($sue_id, $format)
    {
        if($sue_id == "") $sue_id = array();
        else $sue_id = array($sue_id);
        
        $controls = array(
            'SUE_ID' => $sue_id,
        );
        
        GeneralFunction::generateReport('/spsb/MSN/SuratLantikanSue', $format, $controls, 'surat_lantikan_sue');
    }
    
    public function actionSuratPersetujuanSue($sue_id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new MsnSuratSue();
        $model->sue_id = $sue_id;
        $model->format = 'html';

        if ($model->load(Yii::$app->request->post())) {
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-surat-persetujuan-sue'
                    //, 'sue_id' => $model->sue_id
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-surat-persetujuan-sue'
                    //, 'sue_id' => $model->sue_id
                    , 'format' => $model->format
                ]);
            }
        } 

        return $this->render('surat_persetujuan_sue', [
            'model' => $model,
            'readonly' => false,
        ]);
    }
    
    public function actionGenerateSuratPersetujuanSue( $format)
    {
        //if($sue_id == "") $sue_id = array();
        //else $sue_id = array($sue_id);
        
        $controls = array(
            //'SUE_ID' => $sue_id,
        );
        
        GeneralFunction::generateReport('/spsb/MSN/SuratPersetujuanSue', $format, $controls, 'surat_persetujuan_sue');
    }
    
    public function actionLaporanStatistikBantuanElaunSue()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new MsnLaporan();
        $model->format = 'html';

        if ($model->load(Yii::$app->request->post())) {
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-laporan-statistik-bantuan-elaun-sue'
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-laporan-statistik-bantuan-elaun-sue'
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'format' => $model->format
                ]);
            }
        } 

        return $this->render('laporan_statistik_bantuan_elaun_sue', [
            'model' => $model,
            'readonly' => false,
        ]);
    }
    
    public function actionGenerateLaporanStatistikBantuanElaunSue($tarikh_dari, $tarikh_hingga, $format)
    {
        if($tarikh_dari == "") $tarikh_dari = array();
        else $tarikh_dari = array($tarikh_dari);
        
        if($tarikh_hingga == "") $tarikh_hingga = array();
        else $tarikh_hingga = array($tarikh_hingga);
        
        $controls = array(
            'FROM_DATE' => $tarikh_dari,
            'TO_DATE' => $tarikh_hingga,
        );
        
        GeneralFunction::generateReport('/spsb/MSN/LaporanStatistikBantuanElaunSue', $format, $controls, 'laporan_statistik_bantuan_elaun_sue');
    }
    
    public function actionLaporanStatistikBantuanElaunSueJumlahKelulusan()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new MsnLaporan();
        $model->format = 'html';

        if ($model->load(Yii::$app->request->post())) {
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-laporan-statistik-bantuan-elaun-sue-jumlah-kelulusan'
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-laporan-statistik-bantuan-elaun-sue-jumlah-kelulusan'
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'format' => $model->format
                ]);
            }
        } 

        return $this->render('laporan_statistik_bantuan_elaun_sue_jumlah_kelulusan', [
            'model' => $model,
            'readonly' => false,
        ]);
    }
    
    public function actionGenerateLaporanStatistikBantuanElaunSueJumlahKelulusan($tarikh_dari, $tarikh_hingga, $format)
    {
        if($tarikh_dari == "") $tarikh_dari = array();
        else $tarikh_dari = array($tarikh_dari);
        
        if($tarikh_hingga == "") $tarikh_hingga = array();
        else $tarikh_hingga = array($tarikh_hingga);
        
        $controls = array(
            'FROM_DATE' => $tarikh_dari,
            'TO_DATE' => $tarikh_hingga,
        );
        
        GeneralFunction::generateReport('/spsb/MSN/LaporanStatistikBantuanElaunSueJumlahKelulusan', $format, $controls, 'laporan_statistik_bantuan_elaun_sue_jumlah_kelulusan');
    }
}
