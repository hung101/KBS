<?php

namespace frontend\controllers;

use Yii;
use app\models\BorangProfilPesertaKpsk;
use frontend\models\BorangProfilPesertaKpskSearch;
use app\models\BorangProfilPesertaKpskPeserta;
use frontend\models\BorangProfilPesertaKpskPesertaSearch;
use app\models\MsnLaporanStatistikKehadiranPesertaMengikutKursusJantina;
use app\models\MsnLaporanStatistikKehadiranPesertaMengikutKursusBangsa;
use app\models\MsnLaporanStatistikKehadiranPesertaMengikutKursusUmur;
use app\models\MsnLaporanStatistikKeputusanPesertaMengikutKursus;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\BaseUrl;

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
            return $this->redirect($this->redirect(array(GeneralVariable::loginPagePath)));
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
            return $this->redirect($this->redirect(array(GeneralVariable::loginPagePath)));
        }
        
        $queryPar = null;
        
        $queryPar['BorangProfilPesertaKpskPesertaSearch']['borang_profil_peserta_kpsk_id'] = $id;
        
        $searchModelBorangProfilPesertaKpskPeserta  = new BorangProfilPesertaKpskPesertaSearch();
        $dataProviderBorangProfilPesertaKpskPeserta = $searchModelBorangProfilPesertaKpskPeserta->search($queryPar);
        
        return $this->render('view', [
            'model' => $this->findModel($id),
            'searchModelBorangProfilPesertaKpskPeserta' => $searchModelBorangProfilPesertaKpskPeserta,
            'dataProviderBorangProfilPesertaKpskPeserta' => $dataProviderBorangProfilPesertaKpskPeserta,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new BorangProfilPesertaKpsk model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect($this->redirect(array(GeneralVariable::loginPagePath)));
        }
        
        $model = new BorangProfilPesertaKpsk();
        
         $queryPar = null;
        
        Yii::$app->session->open();
        
        if(isset(Yii::$app->session->id)){
            $queryPar['BorangProfilPesertaKpskPesertaSearch']['session_id'] = Yii::$app->session->id;
        }
        
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
                'readonly' => false,
            ]);
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
            return $this->redirect($this->redirect(array(GeneralVariable::loginPagePath)));
        }
        
        $model = $this->findModel($id);
        
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
            return $this->redirect($this->redirect(array(GeneralVariable::loginPagePath)));
        }
        
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
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
                                    ->setSubject('Keputusan Kursus')
                                    ->setTextBody('Salam Sejahtera,

Nama Kursus: '. GeneralFunction::getUpperCaseWords($model->penganjur_kursus) .'
Kod Kursus: '. $model->kod_kursus .'
Tarikh Kursus: '. GeneralFunction::getDatePrintFormat($model->tarikh_kursus) .'

Berikut adalah keputusan kursus:-

Objektif (%): '. $modelBorangProfilPesertaKpskPeserta->objektif .'
Struktur (%): '. $modelBorangProfilPesertaKpskPeserta->struktur .'
Esei (%): '. $modelBorangProfilPesertaKpskPeserta->esei .'
Jumlah (%): '. $modelBorangProfilPesertaKpskPeserta->jumlah .'
Keputusan: ' . ((isset($modelBorangProfilPesertaKpskPeserta['refKeputusanKpsk']['desc']) && $modelBorangProfilPesertaKpskPeserta['refKeputusanKpsk']['desc'] != "") ? $modelBorangProfilPesertaKpskPeserta['refKeputusanKpsk']['desc'] : "") . '


"KE ARAH KECEMERLANGAN SUKAN"
Majlis Sukan Negara Malaysia.
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
}
