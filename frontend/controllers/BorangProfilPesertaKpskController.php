<?php

namespace frontend\controllers;

use Yii;
use app\models\BorangProfilPesertaKpsk;
use frontend\models\BorangProfilPesertaKpskSearch;
use app\models\BorangProfilPesertaKpskPeserta;
use app\models\PengurusanPermohonanKursusPersatuan;
use frontend\models\BorangProfilPesertaKpskPesertaSearch;
use app\models\MsnLaporanStatistikKehadiranPesertaMengikutKursusJantina;
use app\models\MsnLaporanStatistikKehadiranPesertaMengikutKursusBangsa;
use app\models\MsnLaporanStatistikKehadiranPesertaMengikutKursusUmur;
use app\models\MsnLaporanStatistikKeputusanPesertaMengikutKursus;
use app\models\MsnLaporan;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\BaseUrl;
use yii\web\Session;

use app\models\general\GeneralVariable;
use common\models\general\GeneralFunction;

/**
 * BorangProfilPesertaKpskController implements the CRUD actions for BorangProfilPesertaKpsk model.
 */
class BorangProfilPesertaKpskController extends Controller
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
     * Lists all BorangProfilPesertaKpsk models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $searchModel = new BorangProfilPesertaKpskSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single BorangProfilPesertaKpsk model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
		
        $model = $this->findModel($id);
        
        if($model->tarikh_kursus != "") {$model->tarikh_kursus = GeneralFunction::convert($model->tarikh_kursus, GeneralFunction::TYPE_DATE);}
        if($model->tarikh_tamat_kursus != "") {$model->tarikh_tamat_kursus = GeneralFunction::convert($model->tarikh_tamat_kursus, GeneralFunction::TYPE_DATE);}

        $session = new Session;
        $session->open();

        $session['borang_profil_peserta_kpsk_tahap_id'] = $model->tahap;
        
        $session->close();
        
        $queryPar = null;
        
        $queryPar['BorangProfilPesertaKpskPesertaSearch']['borang_profil_peserta_kpsk_id'] = $id;
        
        $searchModelBorangProfilPesertaKpskPeserta  = new BorangProfilPesertaKpskPesertaSearch();
        $dataProviderBorangProfilPesertaKpskPeserta = $searchModelBorangProfilPesertaKpskPeserta->search($queryPar);
        
        return $this->render('view', [
            'model' => $model,
            'searchModelBorangProfilPesertaKpskPeserta' => $searchModelBorangProfilPesertaKpskPeserta,
            'dataProviderBorangProfilPesertaKpskPeserta' => $dataProviderBorangProfilPesertaKpskPeserta,
            'readonly' => true,
            'disabled' => false,
        ]);
    }

    /**
     * Creates a new BorangProfilPesertaKpsk model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id = null)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
		
        $model = new BorangProfilPesertaKpsk();
        
        $disabled = false;
        if($id != null){
            $model->pengurusan_permohonan_kursus_persatuan_id = $id;
                    
            $disabled = true;
            $pengurusanPermohonan = PengurusanPermohonanKursusPersatuan::findOne(['pengurusan_permohonan_kursus_persatuan_id' => $id]);

            //check if exist
            /*$exist = BorangProfilPesertaKpsk::findOne(['penganjur_kursus' => $pengurusanPermohonan->agensi, 'tarikh_kursus' => $pengurusanPermohonan->tarikh_kursus, 'tarikh_tamat_kursus' => $pengurusanPermohonan->tarikh_tamat_kursus, 'kod_kursus' => $pengurusanPermohonan->kod_kursus, 'tahap' => $pengurusanPermohonan->tahap]);

            if(count($exist) > 0){
                    return $this->redirect(['view', 'id' => $exist->borang_profil_peserta_kpsk_id]);
            }*/

            if($pengurusanPermohonan != null){
                    $model->penganjur_kursus = $pengurusanPermohonan->agensi;
                    $model->tarikh_kursus = $pengurusanPermohonan->tarikh_kursus;
                    $model->tarikh_tamat_kursus = $pengurusanPermohonan->tarikh_tamat_kursus;
                    $model->kod_kursus = $pengurusanPermohonan->kod_kursus;
                    $model->tahap = $pengurusanPermohonan->tahap;
            }
        }
		
         $queryPar = null;
        
        Yii::$app->session->open();
        
        if(isset(Yii::$app->session->id)){
            $queryPar['BorangProfilPesertaKpskPesertaSearch']['session_id'] = Yii::$app->session->id;
        }
        
        $session = new Session;
        $session->open();

        $session['borang_profil_peserta_kpsk_tahap_id'] = $model->tahap;
        
        $session->close();
        
        $searchModelBorangProfilPesertaKpskPeserta  = new BorangProfilPesertaKpskPesertaSearch();
        $dataProviderBorangProfilPesertaKpskPeserta = $searchModelBorangProfilPesertaKpskPeserta->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if(isset(Yii::$app->session->id)){
                BorangProfilPesertaKpskPeserta::updateAll(['borang_profil_peserta_kpsk_id' => $model->borang_profil_peserta_kpsk_id], 'session_id = "'.Yii::$app->session->id.'"');
                BorangProfilPesertaKpskPeserta::updateAll(['session_id' => ''], 'borang_profil_peserta_kpsk_id = "'.$model->borang_profil_peserta_kpsk_id.'"');
            }
            
            return $this->redirect(['view', 'id' => $model->borang_profil_peserta_kpsk_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'searchModelBorangProfilPesertaKpskPeserta' => $searchModelBorangProfilPesertaKpskPeserta,
                'dataProviderBorangProfilPesertaKpskPeserta' => $dataProviderBorangProfilPesertaKpskPeserta,
                'disabled' => $disabled,
                'readonly' => false,
            ]);
        }
    }
    
    /**
     * Displays a single BorangProfilPesertaKpsk model.
     * @param integer $id
     * @return mixed
     */
    public function actionLoad($id = null)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        if (($model = BorangProfilPesertaKpsk::find()->where(['pengurusan_permohonan_kursus_persatuan_id'=>$id])->one()) !== null) {
            return $this->redirect(['view', 'id' => $model->borang_profil_peserta_kpsk_id]);
        } else {
            return $this->redirect(['create', 'id' => $id]);
        }
    }

    /**
     * Updates an existing BorangProfilPesertaKpsk model.
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
        
        if(isset($model->pengurusan_permohonan_kursus_persatuan_id)){
            $pengurusanPermohonan = PengurusanPermohonanKursusPersatuan::findOne(['pengurusan_permohonan_kursus_persatuan_id' => $model->pengurusan_permohonan_kursus_persatuan_id]);

            if($pengurusanPermohonan != null){
                    $model->penganjur_kursus = $pengurusanPermohonan->agensi;
                    $model->tarikh_kursus = $pengurusanPermohonan->tarikh_kursus;
                    $model->tarikh_tamat_kursus = $pengurusanPermohonan->tarikh_tamat_kursus;
                    $model->kod_kursus = $pengurusanPermohonan->kod_kursus;
                    $model->tahap = $pengurusanPermohonan->tahap;
            }
        }
        
        $session = new Session;
        $session->open();

        $session['borang_profil_peserta_kpsk_tahap_id'] = $model->tahap;
        
        $session->close();
		
        $queryPar = null;
        
        $queryPar['BorangProfilPesertaKpskPesertaSearch']['borang_profil_peserta_kpsk_id'] = $id;
        
        $searchModelBorangProfilPesertaKpskPeserta  = new BorangProfilPesertaKpskPesertaSearch();
        $dataProviderBorangProfilPesertaKpskPeserta = $searchModelBorangProfilPesertaKpskPeserta->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->borang_profil_peserta_kpsk_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'searchModelBorangProfilPesertaKpskPeserta' => $searchModelBorangProfilPesertaKpskPeserta,
                'dataProviderBorangProfilPesertaKpskPeserta' => $dataProviderBorangProfilPesertaKpskPeserta,
                'readonly' => false,
				'disabled' => true,
            ]);
        }
    }

    /**
     * Deletes an existing BorangProfilPesertaKpsk model.
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
     * Updates an existing BorangProfilPesertaKpsk model.
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
        
        //return $this->redirect(['index']);
        
        return $this->redirect(['view', 'id' => $model->borang_profil_peserta_kpsk_id]);
    }

    /**
     * Finds the BorangProfilPesertaKpsk model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return BorangProfilPesertaKpsk the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = BorangProfilPesertaKpsk::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionHantarKeputusanEmel($borang_profil_peserta_kpsk_id){
        if (($model = BorangProfilPesertaKpsk::findOne($borang_profil_peserta_kpsk_id)) !== null) {
        
            if(($modelBorangProfilPesertaKpskPesertas = BorangProfilPesertaKpskPeserta::find()
                    ->joinWith(['refKeputusanKpsk'])
                    ->where('borang_profil_peserta_kpsk_id >= :borang_profil_peserta_kpsk_id', [':borang_profil_peserta_kpsk_id' => $borang_profil_peserta_kpsk_id])
                    ->all()) !== null) {
                foreach($modelBorangProfilPesertaKpskPesertas as $modelBorangProfilPesertaKpskPeserta){
                    if($modelBorangProfilPesertaKpskPeserta->emel && $modelBorangProfilPesertaKpskPeserta->emel != ""){
                        try {
                            Yii::$app->mailer->compose()
                                    ->setTo($modelBorangProfilPesertaKpskPeserta->emel)
                                    ->setFrom('noreply@spsb.com')
                                    ->setSubject('Keputusan Kursus : Pengurusan Sukan Kebangsaan ('. $model->kod_kursus .')')
                                    ->setHtmlBody('Assalamualaikum dan Salam Sejahtera, <br>
Tuan/Puan, 
<br><br>
Sukacita dimaklumkan bahawa keputusan Kursus Persatuan Sukan Kebangsaan Tahap '. $model->tahap .' anda adalah seperti berikut: <br>
Nama : '. GeneralFunction::getUpperCaseWords($modelBorangProfilPesertaKpskPeserta->nama) .'<br>
No. Kad Pengenalan : '. GeneralFunction::getFormatIc($modelBorangProfilPesertaKpskPeserta->no_kad_pengenalan) .'<br><br>
Kursus : Pengurusan Sukan Kebangsaan<br>
Tahap : '. $model->tahap .'<br>
Kod Kursus : '. $model->kod_kursus .'<br>
Keputusan:
<br>
&nbsp;&nbsp;&nbsp;&nbsp;Objektif : '. $modelBorangProfilPesertaKpskPeserta->objektif .'%<br>
&nbsp;&nbsp;&nbsp;&nbsp;Esei : '. $modelBorangProfilPesertaKpskPeserta->esei .'%<br>
'. (($model->tahap != '1')?'&nbsp;&nbsp;&nbsp;&nbsp;Laporan Projek : '. $modelBorangProfilPesertaKpskPeserta->laporan_projek .'%<br>': '') .'
&nbsp;&nbsp;&nbsp;&nbsp;Penilaian Refleksi : '. $modelBorangProfilPesertaKpskPeserta->penilaian_refleksi .'%<br>
&nbsp;&nbsp;&nbsp;&nbsp;Jumlah : '. $modelBorangProfilPesertaKpskPeserta->jumlah .'%<br>
&nbsp;&nbsp;&nbsp;&nbsp;Keputusan: ' . ((isset($modelBorangProfilPesertaKpskPeserta['refKeputusanKpsk']['desc']) && $modelBorangProfilPesertaKpskPeserta['refKeputusanKpsk']['desc'] != "") ? $modelBorangProfilPesertaKpskPeserta['refKeputusanKpsk']['desc'] : "") . '
<br><br><br>
Sekian, terima kasih
<br><br>
"KE ARAH KECEMERLANGAN SUKAN"<br>
Bahagian Pengurusan Sukan
                            ')->send();
                        }
                        catch(\Swift_SwiftException $exception)
                        {
                            Yii::$app->session->setFlash('error', 'Terdapat ralat menghantar e-mel.');
                        }
                    } 
                }

            }

            Yii::$app->session->setFlash('success', 'Keputusan kursus telah dihantar kepada peserta melalui e-mel.');
            
            return $this->redirect(['view', 'id' => $borang_profil_peserta_kpsk_id]);
        } else {
            //echo "Tiada rekod di dalam sistem";
        }
    }
    
    public function actionLaporanStatistikKehadiranPesertaMengikutKursusJantina()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new MsnLaporanStatistikKehadiranPesertaMengikutKursusJantina();
        $model->format = 'html';

        if ($model->load(Yii::$app->request->post())) {
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-laporan-statistik-kehadiran-peserta-mengikut-kursus-jantina'
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-laporan-statistik-kehadiran-peserta-mengikut-kursus-jantina'
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'format' => $model->format
                ]);
            }
        } 

        return $this->render('laporan_statistik_kehadiran_peserta_mengikut_kursus_jantina', [
            'model' => $model,
            'readonly' => false,
        ]);
    }
    
    public function actionGenerateLaporanStatistikKehadiranPesertaMengikutKursusJantina($tarikh_dari, $tarikh_hingga, $format)
    {
        if($tarikh_dari == "") $tarikh_dari = array();
        else $tarikh_dari = array($tarikh_dari);
        
        if($tarikh_hingga == "") $tarikh_hingga = array();
        else $tarikh_hingga = array($tarikh_hingga);
        
        $controls = array(
            'FROM_DATE' => $tarikh_dari,
            'TO_DATE' => $tarikh_hingga,
        );
        
        GeneralFunction::generateReport('/spsb/MSN/LaporanStatistikKehadiranPesertaMengikutKursusJantina', $format, $controls, 'laporan_statistik_kehadiran_peserta_mengikut_kursus_jantina');
    }
    
    public function actionLaporanStatistikKehadiranPesertaMengikutKursusBangsa()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new MsnLaporanStatistikKehadiranPesertaMengikutKursusBangsa();
        $model->format = 'html';

        if ($model->load(Yii::$app->request->post())) {
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-laporan-statistik-kehadiran-peserta-mengikut-kursus-bangsa'
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-laporan-statistik-kehadiran-peserta-mengikut-kursus-bangsa'
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'format' => $model->format
                ]);
            }
        } 

        return $this->render('laporan_statistik_kehadiran_peserta_mengikut_kursus_bangsa', [
            'model' => $model,
            'readonly' => false,
        ]);
    }
    
    public function actionGenerateLaporanStatistikKehadiranPesertaMengikutKursusBangsa($tarikh_dari, $tarikh_hingga, $format)
    {
        if($tarikh_dari == "") $tarikh_dari = array();
        else $tarikh_dari = array($tarikh_dari);
        
        if($tarikh_hingga == "") $tarikh_hingga = array();
        else $tarikh_hingga = array($tarikh_hingga);
        
        $controls = array(
            'FROM_DATE' => $tarikh_dari,
            'TO_DATE' => $tarikh_hingga,
        );
        
        GeneralFunction::generateReport('/spsb/MSN/LaporanStatistikKehadiranPesertaMengikutKursusBangsa', $format, $controls, 'laporan_statistik_kehadiran_peserta_mengikut_kursus_bangsa');
    }
    
    public function actionLaporanStatistikKehadiranPesertaMengikutKursusUmur()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new MsnLaporanStatistikKehadiranPesertaMengikutKursusUmur();
        $model->format = 'html';

        if ($model->load(Yii::$app->request->post())) {
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-laporan-statistik-kehadiran-peserta-mengikut-kursus-umur'
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-laporan-statistik-kehadiran-peserta-mengikut-kursus-umur'
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'format' => $model->format
                ]);
            }
        } 

        return $this->render('laporan_statistik_kehadiran_peserta_mengikut_kursus_umur', [
            'model' => $model,
            'readonly' => false,
        ]);
    }
    
    public function actionGenerateLaporanStatistikKehadiranPesertaMengikutKursusUmur($tarikh_dari, $tarikh_hingga, $format)
    {
        if($tarikh_dari == "") $tarikh_dari = array();
        else $tarikh_dari = array($tarikh_dari);
        
        if($tarikh_hingga == "") $tarikh_hingga = array();
        else $tarikh_hingga = array($tarikh_hingga);
        
        $controls = array(
            'FROM_DATE' => $tarikh_dari,
            'TO_DATE' => $tarikh_hingga,
        );
        
        GeneralFunction::generateReport('/spsb/MSN/LaporanStatistikKehadiranPesertaMengikutKursusUmur', $format, $controls, 'laporan_statistik_kehadiran_peserta_mengikut_kursus_umur');
    }
    
    public function actionLaporanStatistikKeputusanPesertaMengikutKursus()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new MsnLaporanStatistikKeputusanPesertaMengikutKursus();
        $model->format = 'html';

        if ($model->load(Yii::$app->request->post())) {
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-laporan-statistik-keputusan-peserta-mengikut-kursus'
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-laporan-statistik-keputusan-peserta-mengikut-kursus'
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'format' => $model->format
                ]);
            }
        } 

        return $this->render('laporan_statistik_keputusan_peserta_mengikut_kursus', [
            'model' => $model,
            'readonly' => false,
        ]);
    }
    
    public function actionGenerateLaporanStatistikKeputusanPesertaMengikutKursus($tarikh_dari, $tarikh_hingga, $format)
    {
        if($tarikh_dari == "") $tarikh_dari = array();
        else $tarikh_dari = array($tarikh_dari);
        
        if($tarikh_hingga == "") $tarikh_hingga = array();
        else $tarikh_hingga = array($tarikh_hingga);
        
        $controls = array(
            'FROM_DATE' => $tarikh_dari,
            'TO_DATE' => $tarikh_hingga,
        );
        
        GeneralFunction::generateReport('/spsb/MSN/LaporanStatistikKeputusanPesertaMengikutKursus', $format, $controls, 'laporan_statistik_keputusan_peserta_mengikut_kursus');
    }
    
    public function actionLaporanSenaraiKehadiranPesertaMengikutKursus()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new MsnLaporan();
        $model->format = 'html';

        if ($model->load(Yii::$app->request->post())) {
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-laporan-senarai-kehadiran-peserta-mengikut-kursus'
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'kod_kursus' => $model->kod_kursus
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-laporan-senarai-kehadiran-peserta-mengikut-kursus'
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'kod_kursus' => $model->kod_kursus
                    , 'format' => $model->format
                ]);
            }
        } 

        return $this->render('laporan_senarai_kehadiran_peserta_mengikut_kursus', [
            'model' => $model,
            'readonly' => false,
        ]);
    }
    
    public function actionGenerateLaporanSenaraiKehadiranPesertaMengikutKursus($tarikh_dari, $tarikh_hingga, $kod_kursus, $format)
    {
        if($tarikh_dari == "") $tarikh_dari = array();
        else $tarikh_dari = array($tarikh_dari);
        
        if($tarikh_hingga == "") $tarikh_hingga = array();
        else $tarikh_hingga = array($tarikh_hingga);
        
        if($kod_kursus == "") $kod_kursus = array();
        else $kod_kursus = array($kod_kursus);
        
        $controls = array(
            'FROM_DATE1' => $tarikh_dari,
            'TO_DATE' => $tarikh_hingga,
            'KURSUS' => $kod_kursus,
        );
        
        GeneralFunction::generateReport('/spsb/MSN/LaporanSenaraiKehadiranPesertaMengikutKursus', $format, $controls, 'laporan_senarai_kehadiran_peserta_mengikut_kursus');
    }
	
	public function actionSetTahap($tahap_id){
        
        $session = new Session;
        $session->open();

        $session['borang_profil_peserta_kpsk_tahap_id'] = $tahap_id;
        
        $session->close();
    }
}
