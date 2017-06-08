<?php

namespace frontend\controllers;

use Yii;
use app\models\Sukarelawan;
use frontend\models\SukarelawanSearch;
use app\models\MsnLaporanSenaraiSukarelawan;
use app\models\MsnLaporanStatistikSukarelawanMengikutBangsa;
use app\models\MsnLaporanStatistikSukarelawanMengikutNegeri;
use app\models\MsnLaporanStatistikSukarelawanMengikutJantina;
use app\models\MsnLaporanStatistikSukarelawanMengikutUmur;
use app\models\MsnLaporanStatistikSukarelawanMengikutKecenderungan;
use app\models\MsnLaporanStatistikSukarelawanMengikutKeterbatasanFizikal;
use app\models\MsnLaporan;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\helpers\BaseUrl;

use app\models\general\Upload;
use app\models\general\GeneralVariable;
use app\models\general\GeneralLabel;
use common\models\general\GeneralFunction;

// table reference
use app\models\RefJantina;
use app\models\RefSaizBajuSukarelawan;
use app\models\RefKelulusanAkademikSukarelawan;
use app\models\RefBandar;
use app\models\RefNegeri;
use app\models\RefBidangDiminatiSukarelawan;
use app\models\RefWaktuKetikaDiperlukanSukarelawan;
use app\models\RefTarafPerkahwinan;
use app\models\RefBangsa;
use app\models\RefBidangKepakaranSukarelawan;
use app\models\RefSukan;

use common\models\User;

/**
 * SukarelawanController implements the CRUD actions for Sukarelawan model.
 */
class SukarelawanController extends Controller
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
     * Lists all Sukarelawan models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $searchModel = new SukarelawanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Sukarelawan model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = $this->findModel($id);
        
        $ref = RefJantina::findOne(['id' => $model->jantina]);
        $model->jantina = $ref['desc'];
        
        $ref = RefNegeri::findOne(['id' => $model->alamat_negeri]);
        $model->alamat_negeri = $ref['desc'];
        
        $ref = RefBandar::findOne(['id' => $model->alamat_bandar]);
        $model->alamat_bandar = $ref['desc'];
        
        $ref = RefSaizBajuSukarelawan::findOne(['id' => $model->saiz_baju]);
        $model->saiz_baju = $ref['desc'];
        
        $ref = RefTarafPerkahwinan::findOne(['id' => $model->status]);
        $model->status = $ref['desc'];
        
        $ref = RefKelulusanAkademikSukarelawan::findOne(['id' => $model->kelulusan_akademi]);
        $model->kelulusan_akademi = $ref['desc'];
        
        $ref = RefNegeri::findOne(['id' => $model->alamat_majikan_negeri]);
        $model->alamat_majikan_negeri = $ref['desc'];
        
        $ref = RefBandar::findOne(['id' => $model->alamat_majikan_bandar]);
        $model->alamat_majikan_bandar = $ref['desc'];
        
        $ref = RefBidangDiminatiSukarelawan::findOne(['id' => $model->bidang_diminati]);
        $model->bidang_diminati = $ref['desc'];
        
        $ref = RefBidangKepakaranSukarelawan::findOne(['id' => $model->bidang_kepakaran]);
        $model->bidang_kepakaran = $ref['desc'];

        $ref = RefWaktuKetikaDiperlukanSukarelawan::findOne(['id' => $model->waktu_ketika_diperlukan]);
        $model->waktu_ketika_diperlukan = $ref['desc'];
        
        $ref = RefBangsa::findOne(['id' => $model->bangsa]);
        $model->bangsa = $ref['desc'];
        
        $ref = RefSukan::findOne(['id' => $model->sukan]);
        $model->sukan = $ref['desc'];

        $model->kebatasan_fizikal = GeneralLabel::getYesNoLabel($model->kebatasan_fizikal);
        
        if($model->tarikh_lahir != "") {$model->tarikh_lahir = GeneralFunction::convert($model->tarikh_lahir, GeneralFunction::TYPE_DATE);}
        
        return $this->render('view', [
            'model' => $model,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new Sukarelawan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new Sukarelawan();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $upload = new Upload();
            $file = UploadedFile::getInstance($model, 'muatnaik');
            if($file){
                $model->muatnaik = $upload->uploadFile($file, Upload::sukarelawanFolder, $model->sukarelawan_id, "");
            }
            
            if (($modelUsers = User::find()->joinWith('refUserPeranan')->andFilterWhere(['like', 'tbl_user_peranan.peranan_akses', 'pemberitahuan_emel_sukarelawan'])->groupBy('id')->all()) !== null) {
        
                foreach($modelUsers as $modelUser){

                    if($modelUser->email && $modelUser->email != ""){
                        //echo "E-mail: " . $modelUser->email . "\n";
                        Yii::$app->mailer->compose()
                        ->setTo($modelUser->email)
                        ->setFrom('noreply@spsb.com')
                        ->setSubject('Pemberitahuan: Permohonan Sukarelawan Baru')
                        ->setHtmlBody("Salam Sejahtera,
<br><br><br>
Berikut adalah permohonan sukarelawan baru telah dihantar : <br>
<br><br>
Nama : " . $model->nama . '<br>
No. Kad Pengenalan: ' . GeneralFunction::getFormatIc($model->no_kad_pengenalan) . '
<br><br>
Link: ' . BaseUrl::to(['sukarelawan/view', 'id' => $model->sukarelawan_id], true) . '
<br><br><br>
"KE ARAH KECEMERLANGAN SUKAN"<br><br>
Majlis Sukan Negara Malaysia.
    ')->send();
                    }
                }
            }
            
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->sukarelawan_id]);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Updates an existing Sukarelawan model.
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
        $existingUpload = $model->muatnaik;
        
        if($model->load(Yii::$app->request->post())){
            $file = UploadedFile::getInstance($model, 'muatnaik');

            if($file){
                //valid file to upload
                //upload file to server
                
                // delete upload file
                if($existingUpload != ""){
                    self::actionDeleteupload($id, 'muatnaik');
                }
                
                $model->muatnaik = Upload::uploadFile($file, Upload::sukarelawanFolder, $model->sukarelawan_id, "");
            } else {
                //invalid file to upload
                //remain existing file
                $model->muatnaik = $existingUpload;
            }
        }

        if (Yii::$app->request->post() && $model->save()) {
            return $this->redirect(['view', 'id' => $model->sukarelawan_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Deletes an existing Sukarelawan model.
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
        self::actionDeleteupload($id, 'muatnaik');
        
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Sukarelawan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Sukarelawan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Sukarelawan::findOne($id)) !== null) {
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
    
    public function actionLaporanSenaraiSukarelawan()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new MsnLaporanSenaraiSukarelawan();
        $model->format = 'html';

        if ($model->load(Yii::$app->request->post())) {
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-laporan-senarai-sukarelawan'
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'negeri' => $model->negeri
                    , 'jantina' => $model->jantina
                    , 'bidang_diminati' => $model->bidang_diminati
                    , 'umur_dari' => $model->umur_dari
                    , 'umur_hingga' => $model->umur_hingga
                    , 'bangsa' => $model->bangsa
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-laporan-senarai-sukarelawan'
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'negeri' => $model->negeri
                    , 'jantina' => $model->jantina
                    , 'bidang_diminati' => $model->bidang_diminati
                    , 'umur_dari' => $model->umur_dari
                    , 'umur_hingga' => $model->umur_hingga
                    , 'bangsa' => $model->bangsa
                    , 'format' => $model->format
                ]);
            }
        } 

        return $this->render('laporan_senarai_sukarelawan', [
            'model' => $model,
            'readonly' => false,
        ]);
    }
    
    public function actionGenerateLaporanSenaraiSukarelawan($tarikh_dari, $tarikh_hingga, $negeri, $jantina, $bidang_diminati, $umur_dari, $umur_hingga, $bangsa, $format)
    {
        if($tarikh_dari == "") $tarikh_dari = array();
        else $tarikh_dari = array($tarikh_dari);
        
        if($tarikh_hingga == "") $tarikh_hingga = array();
        else $tarikh_hingga = array($tarikh_hingga);
        
        if($negeri == "") $negeri = array();
        else $negeri = array($negeri);
        
        if($jantina == "") $jantina = array();
        else $jantina = array($jantina);
        
        if($bidang_diminati == "") $bidang_diminati = array();
        else $bidang_diminati = array($bidang_diminati);
        
        if($umur_dari == "") $umur_dari = array();
        else $umur_dari = array($umur_dari);
        
        if($umur_hingga == "") $umur_hingga = array();
        else $umur_hingga = array($umur_hingga);
        
        if($bangsa == "") $bangsa = array();
        else $bangsa = array($bangsa);
        
        $controls = array(
            'FROM_DATE' => $tarikh_dari,
            'TO_DATE' => $tarikh_hingga,
            'NEGERI' => $negeri,
            'JANTINA' => $jantina,
            'BIDANG_DIMINATI' => $bidang_diminati,
            'UMUR_FROM' => $umur_dari,
            'UMUR_TO' => $umur_hingga,
            'BANGSA' => $bangsa,
        );
        
        GeneralFunction::generateReport('/spsb/MSN/LaporanSenaraiSukarelawan', $format, $controls, 'laporan_senarai_sukarelawan');
    }
    
    public function actionLaporanStatistikSukarelawanMengikutBangsa()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new MsnLaporanStatistikSukarelawanMengikutBangsa();
        $model->format = 'html';

        if ($model->load(Yii::$app->request->post())) {
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-laporan-statistik-sukarelawan-mengikut-bangsa'
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-laporan-statistik-sukarelawan-mengikut-bangsa'
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'format' => $model->format
                ]);
            }
        } 

        return $this->render('laporan_statistik_sukarelawan_mengikut_bangsa', [
            'model' => $model,
            'readonly' => false,
        ]);
    }
    
    public function actionGenerateLaporanStatistikSukarelawanMengikutBangsa($tarikh_dari, $tarikh_hingga, $format)
    {
        if($tarikh_dari == "") $tarikh_dari = array();
        else $tarikh_dari = array($tarikh_dari);
        
        if($tarikh_hingga == "") $tarikh_hingga = array();
        else $tarikh_hingga = array($tarikh_hingga);
        
        $controls = array(
            'FROM_DATE' => $tarikh_dari,
            'TO_DATE' => $tarikh_hingga,
        );
        
        GeneralFunction::generateReport('/spsb/MSN/LaporanStatistikSukarelawanMengikutBangsa', $format, $controls, 'laporan_statistik_sukarelawan_mengikut_bangsa');
    }
    
    public function actionLaporanStatistikSukarelawanMengikutNegeri()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new MsnLaporanStatistikSukarelawanMengikutNegeri();
        $model->format = 'html';

        if ($model->load(Yii::$app->request->post())) {
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-laporan-statistik-sukarelawan-mengikut-negeri'
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-laporan-statistik-sukarelawan-mengikut-negeri'
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'format' => $model->format
                ]);
            }
        } 

        return $this->render('laporan_statistik_sukarelawan_mengikut_negeri', [
            'model' => $model,
            'readonly' => false,
        ]);
    }
    
    public function actionGenerateLaporanStatistikSukarelawanMengikutNegeri($tarikh_dari, $tarikh_hingga, $format)
    {
        if($tarikh_dari == "") $tarikh_dari = array();
        else $tarikh_dari = array($tarikh_dari);
        
        if($tarikh_hingga == "") $tarikh_hingga = array();
        else $tarikh_hingga = array($tarikh_hingga);
        
        $controls = array(
            'FROM_DATE' => $tarikh_dari,
            'TO_DATE' => $tarikh_hingga,
        );
        
        GeneralFunction::generateReport('/spsb/MSN/LaporanStatistikSukarelawanMengikutNegeri', $format, $controls, 'laporan_statistik_sukarelawan_mengikut_negeri');
    }
    
    public function actionLaporanStatistikSukarelawanMengikutJantina()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new MsnLaporanStatistikSukarelawanMengikutJantina();
        $model->format = 'html';

        if ($model->load(Yii::$app->request->post())) {
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-laporan-statistik-sukarelawan-mengikut-jantina'
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-laporan-statistik-sukarelawan-mengikut-jantina'
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'format' => $model->format
                ]);
            }
        } 

        return $this->render('laporan_statistik_sukarelawan_mengikut_jantina', [
            'model' => $model,
            'readonly' => false,
        ]);
    }
    
    public function actionGenerateLaporanStatistikSukarelawanMengikutJantina($tarikh_dari, $tarikh_hingga, $format)
    {
        if($tarikh_dari == "") $tarikh_dari = array();
        else $tarikh_dari = array($tarikh_dari);
        
        if($tarikh_hingga == "") $tarikh_hingga = array();
        else $tarikh_hingga = array($tarikh_hingga);
        
        $controls = array(
            'FROM_DATE' => $tarikh_dari,
            'TO_DATE' => $tarikh_hingga,
        );
        
        GeneralFunction::generateReport('/spsb/MSN/LaporanStatistikSukarelawanMengikutJantina', $format, $controls, 'laporan_statistik_sukarelawan_mengikut_jantina');
    }
    
    public function actionLaporanStatistikSukarelawanMengikutUmur()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new MsnLaporanStatistikSukarelawanMengikutUmur();
        $model->format = 'html';

        if ($model->load(Yii::$app->request->post())) {
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-laporan-statistik-sukarelawan-mengikut-umur'
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-laporan-statistik-sukarelawan-mengikut-umur'
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'format' => $model->format
                ]);
            }
        } 

        return $this->render('laporan_statistik_sukarelawan_mengikut_umur', [
            'model' => $model,
            'readonly' => false,
        ]);
    }
    
    public function actionGenerateLaporanStatistikSukarelawanMengikutUmur($tarikh_dari, $tarikh_hingga, $format)
    {
        if($tarikh_dari == "") $tarikh_dari = array();
        else $tarikh_dari = array($tarikh_dari);
        
        if($tarikh_hingga == "") $tarikh_hingga = array();
        else $tarikh_hingga = array($tarikh_hingga);
        
        $controls = array(
            'FROM_DATE' => $tarikh_dari,
            'TO_DATE' => $tarikh_hingga,
        );
        
        GeneralFunction::generateReport('/spsb/MSN/LaporanStatistikSukarelawanMengikutUmur', $format, $controls, 'laporan_statistik_sukarelawan_mengikut_umur');
    }
    
    public function actionLaporanStatistikSukarelawanMengikutKecenderungan()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new MsnLaporanStatistikSukarelawanMengikutKecenderungan();
        $model->format = 'html';

        if ($model->load(Yii::$app->request->post())) {
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-laporan-statistik-sukarelawan-mengikut-kecenderungan'
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-laporan-statistik-sukarelawan-mengikut-kecenderungan'
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'format' => $model->format
                ]);
            }
        } 

        return $this->render('laporan_statistik_sukarelawan_mengikut_kecenderungan', [
            'model' => $model,
            'readonly' => false,
        ]);
    }
    
    public function actionGenerateLaporanStatistikSukarelawanMengikutKecenderungan($tarikh_dari, $tarikh_hingga, $format)
    {
        if($tarikh_dari == "") $tarikh_dari = array();
        else $tarikh_dari = array($tarikh_dari);
        
        if($tarikh_hingga == "") $tarikh_hingga = array();
        else $tarikh_hingga = array($tarikh_hingga);
        
        $controls = array(
            'FROM_DATE' => $tarikh_dari,
            'TO_DATE' => $tarikh_hingga,
        );
        
        GeneralFunction::generateReport('/spsb/MSN/LaporanStatistikSukarelawanMengikutKecenderungan', $format, $controls, 'laporan_statistik_sukarelawan_mengikut_kecenderungan');
    }
    
    public function actionLaporanStatistikSukarelawanMengikutKeterbatasanFizikal()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new MsnLaporanStatistikSukarelawanMengikutKeterbatasanFizikal();
        $model->format = 'html';

        if ($model->load(Yii::$app->request->post())) {
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-laporan-statistik-sukarelawan-mengikut-keterbatasan-fizikal'
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-laporan-statistik-sukarelawan-mengikut-keterbatasan-fizikal'
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'format' => $model->format
                ]);
            }
        } 

        return $this->render('laporan_statistik_sukarelawan_mengikut_keterbatasan_fizikal', [
            'model' => $model,
            'readonly' => false,
        ]);
    }
    
    public function actionGenerateLaporanStatistikSukarelawanMengikutKeterbatasanFizikal($tarikh_dari, $tarikh_hingga, $format)
    {
        if($tarikh_dari == "") $tarikh_dari = array();
        else $tarikh_dari = array($tarikh_dari);
        
        if($tarikh_hingga == "") $tarikh_hingga = array();
        else $tarikh_hingga = array($tarikh_hingga);
        
        $controls = array(
            'FROM_DATE' => $tarikh_dari,
            'TO_DATE' => $tarikh_hingga,
        );
        
        GeneralFunction::generateReport('/spsb/MSN/LaporanStatistikSukarelawanMengikutKeterbatasanFizikal', $format, $controls, 'laporan_statistik_sukarelawan_mengikut_keterbatasan_fizikal');
    }
    
    public function actionLaporanStatistikSukarelawanMengikutKepakaran()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new MsnLaporan();
        $model->format = 'html';

        if ($model->load(Yii::$app->request->post())) {
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-laporan-statistik-sukarelawan-mengikut-kepakaran'
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-laporan-statistik-sukarelawan-mengikut-kepakaran'
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'format' => $model->format
                ]);
            }
        } 

        return $this->render('laporan_statistik_sukarelawan_mengikut_kepakaran', [
            'model' => $model,
            'readonly' => false,
        ]);
    }
    
    public function actionGenerateLaporanStatistikSukarelawanMengikutKepakaran($tarikh_dari, $tarikh_hingga, $format)
    {
        if($tarikh_dari == "") $tarikh_dari = array();
        else $tarikh_dari = array($tarikh_dari);
        
        if($tarikh_hingga == "") $tarikh_hingga = array();
        else $tarikh_hingga = array($tarikh_hingga);
        
        $controls = array(
            'FROM_DATE' => $tarikh_dari,
            'TO_DATE' => $tarikh_hingga,
        );
        
        GeneralFunction::generateReport('/spsb/MSN/LaporanStatistikSukarelawanMengikutKepakaran', $format, $controls, 'laporan_statistik_sukarelawan_mengikut_kepakaran');
    }
    
    public function actionLaporanStatistikSukarelawanMengikutSukan()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new MsnLaporan();
        $model->format = 'html';

        if ($model->load(Yii::$app->request->post())) {
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-laporan-statistik-sukarelawan-mengikut-sukan'
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-laporan-statistik-sukarelawan-mengikut-sukan'
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'format' => $model->format
                ]);
            }
        } 

        return $this->render('laporan_statistik_sukarelawan_mengikut_sukan', [
            'model' => $model,
            'readonly' => false,
        ]);
    }
    
    public function actionGenerateLaporanStatistikSukarelawanMengikutSukan($tarikh_dari, $tarikh_hingga, $format)
    {
        if($tarikh_dari == "") $tarikh_dari = array();
        else $tarikh_dari = array($tarikh_dari);
        
        if($tarikh_hingga == "") $tarikh_hingga = array();
        else $tarikh_hingga = array($tarikh_hingga);
        
        $controls = array(
            'FROM_DATE' => $tarikh_dari,
            'TO_DATE' => $tarikh_hingga,
        );
        
        GeneralFunction::generateReport('/spsb/MSN/LaporanStatistikSukarelawanMengikutSukan', $format, $controls, 'laporan_statistik_sukarelawan_mengikut_sukan');
    }
    
    public function actionLaporanStatistikSukarelawanMengikutTahun()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new MsnLaporan();
        $model->format = 'html';

        if ($model->load(Yii::$app->request->post())) {
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-laporan-statistik-sukarelawan-mengikut-tahun'
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-laporan-statistik-sukarelawan-mengikut-tahun'
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'format' => $model->format
                ]);
            }
        } 

        return $this->render('laporan_statistik_sukarelawan_mengikut_tahun', [
            'model' => $model,
            'readonly' => false,
        ]);
    }
    
    public function actionGenerateLaporanStatistikSukarelawanMengikutTahun($tarikh_dari, $tarikh_hingga, $format)
    {
        if($tarikh_dari == "") $tarikh_dari = array();
        else $tarikh_dari = array($tarikh_dari);
        
        if($tarikh_hingga == "") $tarikh_hingga = array();
        else $tarikh_hingga = array($tarikh_hingga);
        
        $controls = array(
            'FROM_DATE' => $tarikh_dari,
            'TO_DATE' => $tarikh_hingga,
        );
        
        GeneralFunction::generateReport('/spsb/MSN/LaporanStatistikSukarelawanMengikutTahun', $format, $controls, 'laporan_statistik_sukarelawan_mengikut_tahun');
    }
}
