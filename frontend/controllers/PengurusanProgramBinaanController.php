<?php

namespace frontend\controllers;

use Yii;
use app\models\PengurusanProgramBinaan;
use frontend\models\PengurusanProgramBinaanSearch;
use app\models\PengurusanProgramBinaanKos;
use frontend\models\PengurusanProgramBinaanKosSearch;
use app\models\PengurusanProgramBinaanPeserta;
use frontend\models\PengurusanProgramBinaanPesertaSearch;
use app\models\PengurusanProgramBinaanTeknikal;
use frontend\models\PengurusanProgramBinaanTeknikalSearch;
use app\models\PengurusanProgramBinaanUrusetia;
use frontend\models\PengurusanProgramBinaanUrusetiaSearch;
use app\models\PengurusanProgramBinaanAtlet;
use frontend\models\PengurusanProgramBinaanAtletSearch;
use app\models\PengurusanProgramBinaanJurulatih;
use frontend\models\PengurusanProgramBinaanJurulatihSearch;
use app\models\AtletPembangunanKursuskem;
use app\models\MsnLaporanSenaraiPenganjuranProgramBinaan;
use app\models\MsnLaporanStatistikProgramBinaanMengikutNegeri;
use app\models\MsnLaporanStatistikProgramBinaanMengikutSukan;
use app\models\PengurusanProgramBinaanLaporanPenganjuran;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\BaseUrl;
use yii\web\Session;
use yii\helpers\Url;
use yii\web\UploadedFile;

use yii\helpers\Json;
use kartik\helpers\Html;
use kartik\mpdf\Pdf;

use app\models\general\Upload;
use app\models\general\GeneralVariable;
use app\models\general\GeneralLabel;
use common\models\general\GeneralFunction;

// table reference
use app\models\RefKategoriPermohonanProgramBinaan;
use app\models\RefJenisPermohonanProgramBinaan;
use app\models\RefSukan;
use app\models\RefAtletTahap;
use app\models\RefNegeri;
use app\models\RefProgramSemasaSukanAtlet;
use app\models\PerancanganProgram;
use app\models\RefJenisAktiviti;
use app\models\RefStatusPermohonanProgramBinaan;
use app\models\RefJenisKursuskem;
use app\models\RefTahapProgramBinaan;
use app\models\RefKategoriProgramBinaan;
use app\models\RefJenisLaporan;
use app\models\RefJenisAktivitiLaporanPenganjuran;

use common\models\User;

/**
 * PengurusanProgramBinaanController implements the CRUD actions for PengurusanProgramBinaan model.
 */
class PengurusanProgramBinaanController extends Controller
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
     * Lists all PengurusanProgramBinaan models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $queryParams = Yii::$app->request->queryParams;
        
        if(Yii::$app->user->identity->profil_badan_sukan){
            $queryParams['PengurusanProgramBinaanSearch']['created_by'] = Yii::$app->user->identity->id;
        }
        
        $searchModel = new PengurusanProgramBinaanSearch();
        $dataProvider = $searchModel->search($queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PengurusanProgramBinaan model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = $this->findModel($id);
        
        $ref = RefKategoriPermohonanProgramBinaan::findOne(['id' => $model->kategori_permohonan]);
        $model->kategori_permohonan = $ref['desc'];
        
        // $ref = RefJenisPermohonanProgramBinaan::findOne(['id' => $model->jenis_permohonan]);
        // $model->jenis_permohonan = $ref['desc'];
        
        // $ref = RefSukan::findOne(['id' => $model->sukan]);
        // $model->sukan = $ref['desc'];
        
        //$model->usptn_tahap = RefTahapProgramBinaan::findOne($model->usptn_tahap)->desc;
        
        $ref = RefTahapProgramBinaan::findOne(['id' => $model->usptn_tahap]);
        $model->usptn_tahap = $ref['desc'];
        
        //$model->usptn_kategori = RefKategoriProgramBinaan::findOne($model->usptn_kategori)->desc;
        
        $ref = RefKategoriProgramBinaan::findOne(['id' => $model->usptn_kategori]);
        $model->usptn_kategori = $ref['desc'];
        
        $ref = RefAtletTahap::findOne(['id' => $model->tahap]);
        $model->tahap = $ref['desc'];
        
        $ref = RefNegeri::findOne(['id' => $model->negeri]);
        $model->negeri = $ref['desc'];
        
        $YesNo = GeneralLabel::getYesNoLabel($model->sokongan_pn);
        $model->sokongan_pn = $YesNo;
        
        $YesNo = GeneralLabel::getYesNoLabel($model->kelulusan);
        $model->kelulusan = $YesNo;
        
        $ref = RefProgramSemasaSukanAtlet::findOne(['id' => $model->program]);
        $model->program = $ref['desc'];
        
        $ref = PerancanganProgram::findOne(['perancangan_program_id' => $model->aktiviti]);
        $model->aktiviti = $ref['nama_program'];
        
        $ref = RefStatusPermohonanProgramBinaan::findOne(['id' => $model->status_permohonan]);
        $model->status_permohonan = $ref['desc'];
        
        $ref = RefJenisPermohonanProgramBinaan::findOne(['id' => $model->jenis_aktiviti]);
        $model->jenis_aktiviti = $ref['desc'];
        
        $queryPar = null;
        
        $queryPar['PengurusanProgramBinaanKosSearch']['pengurusan_program_binaan_id'] = $id;
        $queryPar['PengurusanProgramBinaanPesertaSearch']['pengurusan_program_binaan_id'] = $id;
        $queryPar['PengurusanProgramBinaanAtletSearch']['pengurusan_program_binaan_id'] = $id;
        $queryPar['PengurusanProgramBinaanJurulatihSearch']['pengurusan_program_binaan_id'] = $id;
        $queryPar['PengurusanProgramBinaanTeknikalSearch']['pengurusan_program_binaan_id'] = $id;
        $queryPar['PengurusanProgramBinaanUrusetiaSearch']['pengurusan_program_binaan_id'] = $id;
        
        $searchModelProgramBinaanKos  = new PengurusanProgramBinaanKosSearch();
        $dataProviderProgramBinaanKos = $searchModelProgramBinaanKos->search($queryPar);
        
        $searchModelProgramBinaanPeserta = new PengurusanProgramBinaanPesertaSearch();
        $dataProviderProgramBinaanPeserta = $searchModelProgramBinaanPeserta->search($queryPar);
        
        $searchModelProgramBinaanTeknikal = new PengurusanProgramBinaanTeknikalSearch();
        $dataProviderProgramBinaanTeknikal = $searchModelProgramBinaanTeknikal->search($queryPar);
        
        $searchModelProgramBinaanUrusetia = new PengurusanProgramBinaanUrusetiaSearch();
        $dataProviderProgramBinaanUrusetia = $searchModelProgramBinaanUrusetia->search($queryPar);
        
        $searchModelPengurusanProgramBinaanAtlet = new PengurusanProgramBinaanAtletSearch();
        $dataProviderPengurusanProgramBinaanAtlet = $searchModelPengurusanProgramBinaanAtlet->search($queryPar);
        
        $searchModelPengurusanProgramBinaanJurulatih = new PengurusanProgramBinaanJurulatihSearch();
        $dataProviderPengurusanProgramBinaanJurulatih = $searchModelPengurusanProgramBinaanJurulatih->search($queryPar);
        
        if(isset($model->sukan) && $model->sukan != ''){
            $sukan_selected=explode(',',$model->sukan);
            foreach($sukan_selected as $sukan_id){
                $ref = RefSukan::findOne(['id' => $sukan_id]);
                $sukanArr[] = $ref->desc;
            }
            
            $model->sukan = implode(", ",$sukanArr);
        }
        
        if(isset($model->tarikh_mula))
        {
            $model->tarikh_mula = date('d-m-Y',strtotime($model->tarikh_mula));
        }
        
        if(isset($model->tarikh_tamat))
        {
            $model->tarikh_tamat = date('d-m-Y',strtotime($model->tarikh_tamat));
        }
        
        if(isset($model->tarikh_jkb))
        {
            $model->tarikh_jkb = date('d-m-Y',strtotime($model->tarikh_jkb));
        }
        
        return $this->render('view', [
            'model' => $model,
            'searchModelProgramBinaanKos' => $searchModelProgramBinaanKos,
            'dataProviderProgramBinaanKos' => $dataProviderProgramBinaanKos,
            'searchModelProgramBinaanPeserta' => $searchModelProgramBinaanPeserta,
            'dataProviderProgramBinaanPeserta' => $dataProviderProgramBinaanPeserta,
            'searchModelProgramBinaanTeknikal' => $searchModelProgramBinaanTeknikal,
            'dataProviderProgramBinaanTeknikal' => $dataProviderProgramBinaanTeknikal,
            'searchModelProgramBinaanUrusetia' => $searchModelProgramBinaanUrusetia,
            'dataProviderProgramBinaanUrusetia' => $dataProviderProgramBinaanUrusetia,
            'searchModelPengurusanProgramBinaanAtlet' => $searchModelPengurusanProgramBinaanAtlet,
            'dataProviderPengurusanProgramBinaanAtlet' => $dataProviderPengurusanProgramBinaanAtlet,
            'searchModelPengurusanProgramBinaanJurulatih' => $searchModelPengurusanProgramBinaanJurulatih,
            'dataProviderPengurusanProgramBinaanJurulatih' => $dataProviderPengurusanProgramBinaanJurulatih,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new PengurusanProgramBinaan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new PengurusanProgramBinaan();
        
        $model->status_permohonan = RefStatusPermohonanProgramBinaan::SEDANG_DIPROSES;
        
        $queryPar = null;
        
        Yii::$app->session->open();
        
        if(isset(Yii::$app->session->id)){
            $queryPar['PengurusanProgramBinaanKosSearch']['session_id'] = Yii::$app->session->id;
            $queryPar['PengurusanProgramBinaanPesertaSearch']['session_id'] = Yii::$app->session->id;
            $queryPar['PengurusanProgramBinaanAtletSearch']['session_id'] = Yii::$app->session->id;
            $queryPar['PengurusanProgramBinaanJurulatihSearch']['session_id'] = Yii::$app->session->id;
            $queryPar['PengurusanProgramBinaanTeknikalSearch']['session_id'] = Yii::$app->session->id;
            $queryPar['PengurusanProgramBinaanUrusetiaSearch']['session_id'] = Yii::$app->session->id;
        }
        
        $searchModelProgramBinaanKos  = new PengurusanProgramBinaanKosSearch();
        $dataProviderProgramBinaanKos = $searchModelProgramBinaanKos->search($queryPar);
        
        $searchModelProgramBinaanPeserta = new PengurusanProgramBinaanPesertaSearch();
        $dataProviderProgramBinaanPeserta = $searchModelProgramBinaanPeserta->search($queryPar);
        
        $searchModelProgramBinaanTeknikal = new PengurusanProgramBinaanTeknikalSearch();
        $dataProviderProgramBinaanTeknikal = $searchModelProgramBinaanTeknikal->search($queryPar);
        
        $searchModelProgramBinaanUrusetia = new PengurusanProgramBinaanUrusetiaSearch();
        $dataProviderProgramBinaanUrusetia = $searchModelProgramBinaanUrusetia->search($queryPar);
        
        $searchModelPengurusanProgramBinaanAtlet = new PengurusanProgramBinaanAtletSearch();
        $dataProviderPengurusanProgramBinaanAtlet = $searchModelPengurusanProgramBinaanAtlet->search($queryPar);
        
        $searchModelPengurusanProgramBinaanJurulatih = new PengurusanProgramBinaanJurulatihSearch();
        $dataProviderPengurusanProgramBinaanJurulatih = $searchModelPengurusanProgramBinaanJurulatih->search($queryPar);
        
        if ($model->load(Yii::$app->request->post())) {
            if($model->sukan){
                $model->sukan = implode(",",$model->sukan);
            }
            
            //upload file
            $file = UploadedFile::getInstance($model, 'usptn_bajet');
            if(isset($file) && $file != null){
                $filename = $model->pengurusan_program_binaan_id . "-usptn_bajet";
                if($file){
                    $model->usptn_bajet = Upload::uploadFile($file, Upload::pengurusanProgramBinaanFolder, $filename);
                }
            }
            
            //upload file
            $file = UploadedFile::getInstance($model, 'usptn_jadual');
            if(isset($file) && $file != null){
                $filename = $model->pengurusan_program_binaan_id . "-usptn_jadual";
                if($file){
                    $model->usptn_jadual = Upload::uploadFile($file, Upload::pengurusanProgramBinaanFolder, $filename);
                }
            }
        }

        if (Yii::$app->request->post() && $model->save()) {
            if(isset(Yii::$app->session->id)){
                PengurusanProgramBinaanKos::updateAll(['pengurusan_program_binaan_id' => $model->pengurusan_program_binaan_id], 'session_id = "'.Yii::$app->session->id.'"');
                PengurusanProgramBinaanKos::updateAll(['session_id' => ''], 'pengurusan_program_binaan_id = "'.$model->pengurusan_program_binaan_id.'"');
                
                PengurusanProgramBinaanPeserta::updateAll(['pengurusan_program_binaan_id' => $model->pengurusan_program_binaan_id], 'session_id = "'.Yii::$app->session->id.'"');
                PengurusanProgramBinaanPeserta::updateAll(['session_id' => ''], 'pengurusan_program_binaan_id = "'.$model->pengurusan_program_binaan_id.'"');
                
                PengurusanProgramBinaanTeknikal::updateAll(['pengurusan_program_binaan_id' => $model->pengurusan_program_binaan_id], 'session_id = "'.Yii::$app->session->id.'"');
                PengurusanProgramBinaanTeknikal::updateAll(['session_id' => ''], 'pengurusan_program_binaan_id = "'.$model->pengurusan_program_binaan_id.'"');
                
                PengurusanProgramBinaanUrusetia::updateAll(['pengurusan_program_binaan_id' => $model->pengurusan_program_binaan_id], 'session_id = "'.Yii::$app->session->id.'"');
                PengurusanProgramBinaanUrusetia::updateAll(['session_id' => ''], 'pengurusan_program_binaan_id = "'.$model->pengurusan_program_binaan_id.'"');
                
                PengurusanProgramBinaanAtlet::updateAll(['pengurusan_program_binaan_id' => $model->pengurusan_program_binaan_id], 'session_id = "'.Yii::$app->session->id.'"');
                PengurusanProgramBinaanAtlet::updateAll(['session_id' => ''], 'pengurusan_program_binaan_id = "'.$model->pengurusan_program_binaan_id.'"');
                
                PengurusanProgramBinaanJurulatih::updateAll(['pengurusan_program_binaan_id' => $model->pengurusan_program_binaan_id], 'session_id = "'.Yii::$app->session->id.'"');
                PengurusanProgramBinaanJurulatih::updateAll(['session_id' => ''], 'pengurusan_program_binaan_id = "'.$model->pengurusan_program_binaan_id.'"');
            }
  
            if (($modelUsers = User::find()->joinWith('refUserPeranan')->andFilterWhere(['like', 'tbl_user_peranan.peranan_akses', 'pemberitahuan_emel_pengurusan-program-binaan'])->groupBy('id')->all()) !== null) {
        
                foreach($modelUsers as $modelUser){

                    if($modelUser->email && $modelUser->email != ""){
                        //echo "E-mail: " . $modelUser->email . "\n";
                        Yii::$app->mailer->compose()
                        ->setTo($modelUser->email)
                        ->setFrom('noreply@spsb.com')
                        ->setSubject('Pemberitahuan: Permohonan Program Binaan Baru')
                        ->setTextBody("Salam Sejahtera,
<br><br>
Berikut adalah permohonan program binaan baru telah dihantar : 
<br>
Nama Aktiviti: " . $model->nama_aktiviti . '
Tempat: ' . $model->tempat . '
Tarikh Mula: ' . $model->tarikh_mula . '
Tarikh Tamat: ' . $model->tarikh_tamat . '
<br>
Link: ' . BaseUrl::to(['pengurusan-program-binaan/view', 'id' => $model->pengurusan_program_binaan_id], true) . '
<br><br>
"KE ARAH KECEMERLANGAN SUKAN"
Majlis Sukan Negara Malaysia.
    ')->send();
                    }
                }
            }
            
            return $this->redirect(['view', 'id' => $model->pengurusan_program_binaan_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'searchModelProgramBinaanKos' => $searchModelProgramBinaanKos,
                'dataProviderProgramBinaanKos' => $dataProviderProgramBinaanKos,
                'searchModelProgramBinaanPeserta' => $searchModelProgramBinaanPeserta,
                'dataProviderProgramBinaanPeserta' => $dataProviderProgramBinaanPeserta,
                'searchModelProgramBinaanTeknikal' => $searchModelProgramBinaanTeknikal,
                'dataProviderProgramBinaanTeknikal' => $dataProviderProgramBinaanTeknikal,
                'searchModelProgramBinaanUrusetia' => $searchModelProgramBinaanUrusetia,
                'dataProviderProgramBinaanUrusetia' => $dataProviderProgramBinaanUrusetia,
                'searchModelPengurusanProgramBinaanAtlet' => $searchModelPengurusanProgramBinaanAtlet,
                'dataProviderPengurusanProgramBinaanAtlet' => $dataProviderPengurusanProgramBinaanAtlet,
                'searchModelPengurusanProgramBinaanJurulatih' => $searchModelPengurusanProgramBinaanJurulatih,
                'dataProviderPengurusanProgramBinaanJurulatih' => $dataProviderPengurusanProgramBinaanJurulatih,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Updates an existing PengurusanProgramBinaan model.
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
        $oriBajetName = '';
        $oriJadualName = '';
        
        $queryPar['PengurusanProgramBinaanKosSearch']['pengurusan_program_binaan_id'] = $id;
        $queryPar['PengurusanProgramBinaanPesertaSearch']['pengurusan_program_binaan_id'] = $id;
        $queryPar['PengurusanProgramBinaanAtletSearch']['pengurusan_program_binaan_id'] = $id;
        $queryPar['PengurusanProgramBinaanJurulatihSearch']['pengurusan_program_binaan_id'] = $id;
        $queryPar['PengurusanProgramBinaanTeknikalSearch']['pengurusan_program_binaan_id'] = $id;
        $queryPar['PengurusanProgramBinaanUrusetiaSearch']['pengurusan_program_binaan_id'] = $id;
        
        $searchModelProgramBinaanKos  = new PengurusanProgramBinaanKosSearch();
        $dataProviderProgramBinaanKos = $searchModelProgramBinaanKos->search($queryPar);
        
        $searchModelProgramBinaanPeserta = new PengurusanProgramBinaanPesertaSearch();
        $dataProviderProgramBinaanPeserta = $searchModelProgramBinaanPeserta->search($queryPar);
        
        $searchModelProgramBinaanTeknikal = new PengurusanProgramBinaanTeknikalSearch();
        $dataProviderProgramBinaanTeknikal = $searchModelProgramBinaanTeknikal->search($queryPar);
        
        $searchModelProgramBinaanUrusetia = new PengurusanProgramBinaanUrusetiaSearch();
        $dataProviderProgramBinaanUrusetia = $searchModelProgramBinaanUrusetia->search($queryPar);
        
        $searchModelPengurusanProgramBinaanAtlet = new PengurusanProgramBinaanAtletSearch();
        $dataProviderPengurusanProgramBinaanAtlet = $searchModelPengurusanProgramBinaanAtlet->search($queryPar);
        
        $searchModelPengurusanProgramBinaanJurulatih = new PengurusanProgramBinaanJurulatihSearch();
        $dataProviderPengurusanProgramBinaanJurulatih = $searchModelPengurusanProgramBinaanJurulatih->search($queryPar);
        
        if(isset($model->sukan) && $model->sukan != ''){
            $model->sukan=explode(',',$model->sukan);
        }
        
        if(isset($model->usptn_bajet) && $model->usptn_bajet != ''){
            $oriBajetName = $model->usptn_bajet;
        }
        
        if(isset($model->usptn_jadual) && $model->usptn_jadual != ''){
            $oriJadualName = $model->usptn_jadual;
        }
        
        if ($model->load(Yii::$app->request->post())) {
            if($model->sukan){
                $model->sukan = implode(",",$model->sukan);
            }
            
            //upload file
            $file = UploadedFile::getInstance($model, 'usptn_bajet');
            if(isset($file) && $file != null){
                $filename = $model->pengurusan_program_binaan_id . "-usptn_bajet";
                if($file){
                    //clean old file
                    if($oriBajetName != null || $oriBajetName != ''){
                        unlink($oriBajetName);
                    }
                    
                    $model->usptn_bajet = Upload::uploadFile($file, Upload::pengurusanProgramBinaanFolder, $filename);
                }
            } else {
                $model->usptn_bajet = $oriBajetName;
            }
            
            //upload file
            $file = UploadedFile::getInstance($model, 'usptn_jadual');
            if(isset($file) && $file != null){
                $filename = $model->pengurusan_program_binaan_id . "-usptn_jadual";
                if($file){
                    //clean old file
                    if($oriJadualName != null || $oriJadualName != ''){
                        unlink($oriJadualName);
                    }
                    
                    $model->usptn_jadual = Upload::uploadFile($file, Upload::pengurusanProgramBinaanFolder, $filename);
                }
            } else {
                $model->usptn_jadual = $oriJadualName;
            }
            
            if($model->save()) return $this->redirect(['view', 'id' => $model->pengurusan_program_binaan_id]);
        }

        return $this->render('update', [
                'model' => $model,
                'searchModelProgramBinaanKos' => $searchModelProgramBinaanKos,
                'dataProviderProgramBinaanKos' => $dataProviderProgramBinaanKos,
                'searchModelProgramBinaanPeserta' => $searchModelProgramBinaanPeserta,
                'dataProviderProgramBinaanPeserta' => $dataProviderProgramBinaanPeserta,
                'searchModelProgramBinaanTeknikal' => $searchModelProgramBinaanTeknikal,
                'dataProviderProgramBinaanTeknikal' => $dataProviderProgramBinaanTeknikal,
                'searchModelProgramBinaanUrusetia' => $searchModelProgramBinaanUrusetia,
                'dataProviderProgramBinaanUrusetia' => $dataProviderProgramBinaanUrusetia,
                'searchModelPengurusanProgramBinaanAtlet' => $searchModelPengurusanProgramBinaanAtlet,
                'dataProviderPengurusanProgramBinaanAtlet' => $dataProviderPengurusanProgramBinaanAtlet,
                'searchModelPengurusanProgramBinaanJurulatih' => $searchModelPengurusanProgramBinaanJurulatih,
                'dataProviderPengurusanProgramBinaanJurulatih' => $dataProviderPengurusanProgramBinaanJurulatih,
                'readonly' => false,
        ]);
    }

    /**
     * Deletes an existing PengurusanProgramBinaan model.
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
     * Finds the PengurusanProgramBinaan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PengurusanProgramBinaan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        if (($model = PengurusanProgramBinaan::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionSetSukan($sukan_id){
        
        $session = new Session;
        $session->open();

        $session['pengurusan_program_binaan_sukan_id'] = $sukan_id;
        
        $session->close();
    }
    
    public function actionSetProgram($program_id){
        
        $session = new Session;
        $session->open();

        $session['pengurusan_program_binaan_program_id'] = $program_id;
        
        $session->close();
    }
    
    public function actionLaporanSenaraiPenganjuranProgramBinaan()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new MsnLaporanSenaraiPenganjuranProgramBinaan();
        $model->format = 'html';

        if ($model->load(Yii::$app->request->post())) {
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-laporan-senarai-penganjuran-program-binaan'
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'negeri' => $model->negeri
                    , 'program' => $model->program
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-laporan-senarai-penganjuran-program-binaan'
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'negeri' => $model->negeri
                    , 'program' => $model->program
                    , 'format' => $model->format
                ]);
            }
        } 

        return $this->render('laporan_senarai_penganjuran_program_binaan', [
            'model' => $model,
            'readonly' => false,
        ]);
    }
    
    public function actionGenerateLaporanSenaraiPenganjuranProgramBinaan($tarikh_dari, $tarikh_hingga, $negeri, $program, $format)
    {
        if($tarikh_dari == "") $tarikh_dari = array();
        else $tarikh_dari = array($tarikh_dari);
        
        if($tarikh_hingga == "") $tarikh_hingga = array();
        else $tarikh_hingga = array($tarikh_hingga);
        
        if($negeri == "") $negeri = array();
        else $negeri = array($negeri);
        
        if($program == "") $program = array();
        else $program = array($program);
        
        $controls = array(
            'FROM_DATE' => $tarikh_dari,
            'TO_DATE' => $tarikh_hingga,
            'NEGERI' => $negeri,
            'PROGRAM' => $program,
        );
        
        GeneralFunction::generateReport('/spsb/MSN/LaporanSenaraiPenganjuranProgramBinaan', $format, $controls, 'laporan_senarai_penganjuran_program_binaan');
    }
    
    public function actionLaporanStatistikProgramBinaanMengikutNegeri()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new MsnLaporanStatistikProgramBinaanMengikutNegeri();
        $model->format = 'html';

        if ($model->load(Yii::$app->request->post())) {
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-laporan-statistik-program-binaan-mengikut-negeri'
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'negeri' => $model->negeri
                    , 'program' => $model->program 
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-laporan-statistik-program-binaan-mengikut-negeri'
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'negeri' => $model->negeri
                    , 'program' => $model->program 
                    , 'format' => $model->format
                ]);
            }
        } 

        return $this->render('laporan_statistik_program_binaan_mengikut_negeri', [
            'model' => $model,
            'readonly' => false,
        ]);
    }
    
    public function actionGenerateLaporanStatistikProgramBinaanMengikutNegeri($tarikh_dari, $tarikh_hingga, $negeri, $program, $format)
    {
        if($tarikh_dari == "") $tarikh_dari = array();
        else $tarikh_dari = array($tarikh_dari);
        
        if($tarikh_hingga == "") $tarikh_hingga = array();
        else $tarikh_hingga = array($tarikh_hingga);
        
        if($negeri == "") $negeri = array();
        else $negeri = array($negeri);
        
        if($program == "") $program = array();
        else $program = array($program);
        
        $controls = array(
            'FROM_DATE' => $tarikh_dari,
            'TO_DATE' => $tarikh_hingga,
            'NEGERI' => $negeri,
            'PROGRAM' => $program,
        );
        
        GeneralFunction::generateReport('/spsb/MSN/LaporanStatistikProgramBinaanMengikutNegeri', $format, $controls, 'laporan_statistik_program_binaan_mengikut_negeri');
    }
    
     public function actionLaporanStatistikProgramBinaanMengikutSukan()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new MsnLaporanStatistikProgramBinaanMengikutSukan();
        $model->format = 'html';

        if ($model->load(Yii::$app->request->post())) {
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-laporan-statistik-program-binaan-mengikut-sukan'
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'negeri' => $model->negeri
                    , 'program' => $model->program 
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-laporan-statistik-program-binaan-mengikut-sukan'
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'negeri' => $model->negeri
                    , 'program' => $model->program
                    , 'format' => $model->format
                ]);
            }
        } 

        return $this->render('laporan_statistik_program_binaan_mengikut_sukan', [
            'model' => $model,
            'readonly' => false,
        ]);
    }
    
    public function actionGenerateLaporanStatistikProgramBinaanMengikutSukan($tarikh_dari, $tarikh_hingga, $negeri, $program, $format)
    {
        if($tarikh_dari == "") $tarikh_dari = array();
        else $tarikh_dari = array($tarikh_dari);
        
        if($tarikh_hingga == "") $tarikh_hingga = array();
        else $tarikh_hingga = array($tarikh_hingga);
        
        if($negeri == "") $negeri = array();
        else $negeri = array($negeri);
        
        if($program == "") $program = array();
        else $program = array($program);
        
        $controls = array(
            'FROM_DATE' => $tarikh_dari,
            'TO_DATE' => $tarikh_hingga,
            'NEGERI' => $negeri,
            'PROGRAM' => $program,
        );
        
        GeneralFunction::generateReport('/spsb/MSN/LaporanStatistikProgramBinaanMengikutSukan', $format, $controls, 'laporan_statistik_program_binaan_mengikut_sukan');
    }
    
    public function actionPrintJkkJkp($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }  
        $model = $this->findModel($id);
        
        if(isset($model->sukan) && $model->sukan != ''){
            $sukan_selected=explode(',',$model->sukan);
            $count = 1;
            foreach($sukan_selected as $sukan_id){
                $ref = RefSukan::findOne(['id' => $sukan_id]);
                $sukanArr[] = $count.' '.$ref->desc;
                $count++;
            }
            
            $model->sukan = implode("<br />",$sukanArr);
        }
        
        if(isset($model->tarikh_mula))
        {
            $model->tarikh_mula = date('d/m/Y',strtotime($model->tarikh_mula));
        }
        
        if(isset($model->tarikh_tamat))
        {
            $model->tarikh_tamat = date('d/m/Y',strtotime($model->tarikh_tamat));
        }
        
        $ref = RefNegeri::findOne(['id' => $model->negeri]);
        $model->negeri = $ref['desc'];
        
        $binaanKosModel = PengurusanProgramBinaanKos::find()->where(['pengurusan_program_binaan_id' => $model->pengurusan_program_binaan_id])->all();
        
        //count orang
        $atletCount = PengurusanProgramBinaanAtlet::find()->where(['pengurusan_program_binaan_id' => $model->pengurusan_program_binaan_id])->count();
        $jurulatihCount = PengurusanProgramBinaanJurulatih::find()->where(['pengurusan_program_binaan_id' => $model->pengurusan_program_binaan_id])->count();
        $pegawaiCount = PengurusanProgramBinaanPeserta::find()->where(['pengurusan_program_binaan_id' => $model->pengurusan_program_binaan_id])->count();
        $teknikalCount = PengurusanProgramBinaanTeknikal::find()->where(['pengurusan_program_binaan_id' => $model->pengurusan_program_binaan_id])->count();
        $urusetiaCount = PengurusanProgramBinaanUrusetia::find()->where(['pengurusan_program_binaan_id' => $model->pengurusan_program_binaan_id])->count();
        
        $totalOrang = $atletCount+$jurulatihCount+$pegawaiCount+$teknikalCount+$urusetiaCount;

        $pdf = new \mPDF('utf-8', 'A4-L');

        $pdf->title = 'Borang JKK /JKP';

        //$pdf->cssFile = 'report.css';
        $stylesheet = file_get_contents('css/report.css');

        $pdf->WriteHTML($stylesheet,1);
        
        $pdf->WriteHTML($this->renderpartial('print_jkk_jkp', [
             'model'  => $model,
             'binaanKosModel' => $binaanKosModel,
             'totalOrang' => $totalOrang,
        ]));

        $pdf->Output('Borang_jkk_jkp_'.$model->pengurusan_program_binaan_id.'.pdf', 'I');
    }
    
    public function actionPrintBorangPermohonan($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }  
        $model = $this->findModel($id);
        
        //count by jantina
        $subFemale = \app\models\RefJantina::find()->select('id')->where(['LIKE', 'desc', 'perempuan']);
        $subMale = \app\models\RefJantina::find()->select('id')->where(['LIKE', 'desc', 'lelaki']);
        
        $atletFemaleCount = PengurusanProgramBinaanAtlet::find()->joinWith(['refAtlet'])
                            ->where(['pengurusan_program_binaan_id' => $model->pengurusan_program_binaan_id])
                            ->andWhere(['IN', 'jantina', $subFemale])->count();
                            
        $atletMaleCount = PengurusanProgramBinaanAtlet::find()->joinWith(['refAtlet'])
                            ->where(['pengurusan_program_binaan_id' => $model->pengurusan_program_binaan_id])
                            ->andWhere(['IN', 'jantina', $subMale])->count();
                            
        $atletCount = ['male' => $atletMaleCount, 'female' => $atletFemaleCount, 'total' => $atletMaleCount+$atletFemaleCount];
                            
        $jurulatihFemaleCount = PengurusanProgramBinaanJurulatih::find()->joinWith(['refJurulatih'])
                            ->where(['pengurusan_program_binaan_id' => $model->pengurusan_program_binaan_id])
                            ->andWhere(['IN', 'jantina', $subFemale])->count();
                            
        $jurulatihMaleCount = PengurusanProgramBinaanJurulatih::find()->joinWith(['refJurulatih'])
                            ->where(['pengurusan_program_binaan_id' => $model->pengurusan_program_binaan_id])
                            ->andWhere(['IN', 'jantina', $subMale])->count();
        
        $jurulatihCount = ['male' => $jurulatihMaleCount, 'female' => $jurulatihFemaleCount, 'total' => $jurulatihMaleCount+$jurulatihFemaleCount];
        
        $pegawaiFemaleCount = PengurusanProgramBinaanPeserta::find()->where(['pengurusan_program_binaan_id' => $model->pengurusan_program_binaan_id])
                        ->andWhere(['IN', 'jantina', $subFemale])->count();
        $pegawaiMaleCount = PengurusanProgramBinaanPeserta::find()->where(['pengurusan_program_binaan_id' => $model->pengurusan_program_binaan_id])
                        ->andWhere(['IN', 'jantina', $subMale])->count();

        $pegawaiCount = ['male' => $pegawaiMaleCount, 'female' => $pegawaiFemaleCount, 'total' => $pegawaiMaleCount+$pegawaiFemaleCount];
        
        $teknikalFemaleCount = PengurusanProgramBinaanTeknikal::find()->where(['pengurusan_program_binaan_id' => $model->pengurusan_program_binaan_id])
                        ->andWhere(['IN', 'jantina', $subFemale])->count();
        $teknikalMaleCount = PengurusanProgramBinaanTeknikal::find()->where(['pengurusan_program_binaan_id' => $model->pengurusan_program_binaan_id])
                        ->andWhere(['IN', 'jantina', $subMale])->count();

        $teknikalCount = ['male' => $teknikalMaleCount, 'female' => $teknikalFemaleCount, 'total' => $teknikalMaleCount+$teknikalFemaleCount];
        
        $urusetiaFemaleCount = PengurusanProgramBinaanUrusetia::find()->where(['pengurusan_program_binaan_id' => $model->pengurusan_program_binaan_id])
                        ->andWhere(['IN', 'jantina', $subFemale])->count();
        $urusetiaMaleCount = PengurusanProgramBinaanUrusetia::find()->where(['pengurusan_program_binaan_id' => $model->pengurusan_program_binaan_id])
                        ->andWhere(['IN', 'jantina', $subMale])->count();

        $urusetiaCount = ['male' => $urusetiaMaleCount, 'female' => $urusetiaFemaleCount, 'total' => $urusetiaMaleCount+$urusetiaFemaleCount];
        
         $binaanKosModel = PengurusanProgramBinaanKos::find()->where(['pengurusan_program_binaan_id' => $model->pengurusan_program_binaan_id])->all();
        // $pegawaiModel = PengurusanProgramBinaanPeserta::find()->where(['pengurusan_program_binaan_id' => $model->pengurusan_program_binaan_id])->all();
        // $atletModel = PengurusanProgramBinaanAtlet::find()->where(['pengurusan_program_binaan_id' => $model->pengurusan_program_binaan_id])->all();
        // $jurulatihModel = PengurusanProgramBinaanJurulatih::find()->where(['pengurusan_program_binaan_id' => $model->pengurusan_program_binaan_id])->all();
        // $teknikalModel = PengurusanProgramBinaanTeknikal::find()->where(['pengurusan_program_binaan_id' => $model->pengurusan_program_binaan_id])->all();
        // $urusetiaModel = PengurusanProgramBinaanUrusetia::find()->where(['pengurusan_program_binaan_id' => $model->pengurusan_program_binaan_id])->all();
        
        if(isset($model->sukan) && $model->sukan != ''){
            $sukan_selected=explode(',',$model->sukan);
            foreach($sukan_selected as $sukan_id){
                $ref = RefSukan::findOne(['id' => $sukan_id]);
                $sukanArr[] = $ref->desc;
            }
            
            $model->sukan = implode(", ",$sukanArr);
        }
        
        if(isset($model->tarikh_mula))
        {
            $model->tarikh_mula = date('d/m/Y',strtotime($model->tarikh_mula));
        }
        
        if(isset($model->tarikh_tamat))
        {
            $model->tarikh_tamat = date('d/m/Y',strtotime($model->tarikh_tamat));
        }
        
        $ref = RefNegeri::findOne(['id' => $model->negeri]);
        $model->negeri = $ref['desc'];
        
        $ref = RefTahapProgramBinaan::findOne(['id' => $model->usptn_tahap]);
        $model->usptn_tahap = $ref['desc'];
        
        $YesNo = GeneralLabel::getYesNoLabel($model->sokongan_pn);
        $model->sokongan_pn = $YesNo;
        
        $YesNo = GeneralLabel::getYesNoLabel($model->kelulusan);
        $model->kelulusan = $YesNo;

        $pdf = new \mPDF('utf-8', 'A4');

        $pdf->title = 'Borang Permohonan';

        //$pdf->cssFile = 'report.css';
        $stylesheet = file_get_contents('css/report.css');

        $pdf->WriteHTML($stylesheet,1);
        
        $pdf->WriteHTML($this->renderpartial('print_borang_permohonan', [
             'model'  => $model,
             'binaanKosModel' => $binaanKosModel,
             'pegawaiCount' => $pegawaiCount,
             'teknikalCount' => $teknikalCount,
             'urusetiaCount' => $urusetiaCount,
             'atletCount' => $atletCount,
             'jurulatihCount' => $jurulatihCount,
        ]));

        $pdf->Output('Borang_permohonan_'.$model->pengurusan_program_binaan_id.'.pdf', 'I');
    }
    
    public function actionLaporanPenganjuran($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }  
        $parentModel = $this->findModel($id);
        $model = PengurusanProgramBinaanLaporanPenganjuran::findOne(['pengurusan_program_binaan_id' => $id]);
        
        if($model === NULL) {
            $model = new PengurusanProgramBinaanLaporanPenganjuran;
            //autopopulate for new insert
            $model->negeri = $parentModel->negeri;
            
            if(isset($parentModel->sukan) && $parentModel->sukan != null){
                $model->sukan = explode(',',$parentModel->sukan);
            }
            $model->aktiviti = $parentModel->nama_aktiviti;
            $model->tahap = $parentModel->usptn_tahap;
            $model->tempat = $parentModel->tempat;
            $model->tarikh_mula = $parentModel->tarikh_mula;
            $model->tarikh_tamat = $parentModel->tarikh_tamat;
            
            //count by jantina
            $subFemale = \app\models\RefJantina::find()->select('id')->where(['LIKE', 'desc', 'perempuan']);
            $subMale = \app\models\RefJantina::find()->select('id')->where(['LIKE', 'desc', 'lelaki']);
            
            $atletFemaleCount = PengurusanProgramBinaanAtlet::find()->joinWith(['refAtlet'])
                                ->where(['pengurusan_program_binaan_id' => $parentModel->pengurusan_program_binaan_id])
                                ->andWhere(['IN', 'jantina', $subFemale])->count();
                                
            $atletMaleCount = PengurusanProgramBinaanAtlet::find()->joinWith(['refAtlet'])
                                ->where(['pengurusan_program_binaan_id' => $parentModel->pengurusan_program_binaan_id])
                                ->andWhere(['IN', 'jantina', $subMale])->count();
                                
            $model->atlet_lelaki = $atletMaleCount;
            $model->atlet_perempuan = $atletFemaleCount;
                                
            $jurulatihFemaleCount = PengurusanProgramBinaanJurulatih::find()->joinWith(['refJurulatih'])
                                ->where(['pengurusan_program_binaan_id' => $parentModel->pengurusan_program_binaan_id])
                                ->andWhere(['IN', 'jantina', $subFemale])->count();
                                
            $jurulatihMaleCount = PengurusanProgramBinaanJurulatih::find()->joinWith(['refJurulatih'])
                                ->where(['pengurusan_program_binaan_id' => $parentModel->pengurusan_program_binaan_id])
                                ->andWhere(['IN', 'jantina', $subMale])->count();
            
            $model->jurulatih_lelaki = $jurulatihMaleCount;
            $model->jurulatih_perempuan = $jurulatihFemaleCount;
            
            $pegawaiFemaleCount = PengurusanProgramBinaanPeserta::find()->where(['pengurusan_program_binaan_id' => $parentModel->pengurusan_program_binaan_id])
                            ->andWhere(['IN', 'jantina', $subFemale])->count();
            $pegawaiMaleCount = PengurusanProgramBinaanPeserta::find()->where(['pengurusan_program_binaan_id' => $parentModel->pengurusan_program_binaan_id])
                            ->andWhere(['IN', 'jantina', $subMale])->count();

            $model->pegawai_lelaki = $pegawaiMaleCount;
            $model->pegawai_perempuan = $pegawaiFemaleCount;
            
            $teknikalFemaleCount = PengurusanProgramBinaanTeknikal::find()->where(['pengurusan_program_binaan_id' => $parentModel->pengurusan_program_binaan_id])
                            ->andWhere(['IN', 'jantina', $subFemale])->count();
            $teknikalMaleCount = PengurusanProgramBinaanTeknikal::find()->where(['pengurusan_program_binaan_id' => $parentModel->pengurusan_program_binaan_id])
                            ->andWhere(['IN', 'jantina', $subMale])->count();
                            
            $model->teknikal_lelaki = $teknikalMaleCount;
            $model->teknikal_perempuan = $teknikalFemaleCount;
            
            $urusetiaFemaleCount = PengurusanProgramBinaanUrusetia::find()->where(['pengurusan_program_binaan_id' => $parentModel->pengurusan_program_binaan_id])
                            ->andWhere(['IN', 'jantina', $subFemale])->count();
            $urusetiaMaleCount = PengurusanProgramBinaanUrusetia::find()->where(['pengurusan_program_binaan_id' => $parentModel->pengurusan_program_binaan_id])
                            ->andWhere(['IN', 'jantina', $subMale])->count();
                            
            $model->urusetia_lelaki = $urusetiaMaleCount;
            $model->urusetia_perempuan = $urusetiaFemaleCount;
            
            //count dipohon
            $binaanKosModel = PengurusanProgramBinaanKos::find()->where(['pengurusan_program_binaan_id' => $parentModel->pengurusan_program_binaan_id])->all();
            
            $totalDipohonPSN = 0;
            foreach($binaanKosModel as $item){
                $totalDipohonPSN = $totalDipohonPSN+$item->jumlah_dipohon;
            }
            
            $model->peruntukan_dipohon_psn = $totalDipohonPSN;
            $model->peruntukan_dilulus_psn = $parentModel->jumlah_yang_diluluskan;
            
        } else {
            //var_dump($model->sukan); die;
            $model->sukan = explode(',',$model->sukan);
        }
        

        
        if (Yii::$app->request->post()) {
            
            //echo '<pre>';
            $model->load(Yii::$app->request->post());
            $model->pengurusan_program_binaan_id = $parentModel->pengurusan_program_binaan_id;
            if($model->sukan){
                $model->sukan = implode(",",$model->sukan);
            }
            //var_dump($model->sukan); die;
            if($model->save())
            {
                Yii::$app->session->setFlash('success', 'Laporan berjaya dikemaskini');
            }
            //refresh model sukan model after kemaskini
            if(isset($model->sukan) && $model->sukan != null)
            $model->sukan = explode(',',$model->sukan);
            
        }
        
        return $this->render('laporan_penganjuran_form', [
            'parentModel' => $parentModel,
            'model' => $model,
        ]);
    }
    
    public function actionPrintLaporanPenganjuran($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }  
        $model = PengurusanProgramBinaanLaporanPenganjuran::findOne(['pengurusan_program_binaan_id' => $id]);
        
        if(isset($model->sukan) && $model->sukan != ''){
            $sukan_selected = explode(',',$model->sukan);
            foreach($sukan_selected as $sukan_id){
                $ref = RefSukan::findOne(['id' => $sukan_id]);
                $sukanArr[] = $ref->desc;
            }
            $model->sukan = implode(", ",$sukanArr);
        }
        
        if(isset($model->tarikh_mula))
        {
            $model->tarikh_mula = date('d/m/Y',strtotime($model->tarikh_mula));
        }
        
        if(isset($model->tarikh_tamat))
        {
            $model->tarikh_tamat = date('d/m/Y',strtotime($model->tarikh_tamat));
        }
        
        $ref = RefNegeri::findOne(['id' => $model->negeri]);
        $model->negeri = $ref['desc'];
        
        $ref = RefJenisLaporan::findOne(['id' => $model->jenis_laporan]);
        $model->jenis_laporan = $ref['desc'];
        
        $ref = RefTahapProgramBinaan::findOne(['id' => $model->tahap]);
        $model->tahap = $ref['desc'];
        
        $ref = RefJenisAktivitiLaporanPenganjuran::findOne(['id' => $model->jenis_aktiviti]);
        $model->jenis_aktiviti = $ref['desc'];

        $pdf = new \mPDF('utf-8', 'A4');

        $pdf->title = 'Laporan Penganjuran/Penyertaan';
        $stylesheet = file_get_contents('css/report.css');

        $pdf->WriteHTML($stylesheet,1);
        
        $pdf->WriteHTML($this->renderpartial('print_laporan_penganjuran', [
             'model'  => $model,
        ]));

        $pdf->Output('Laporan_Pengajuran_'.$model->pengurusan_program_binaan_laporan_penganjuran_id.'.pdf', 'I');
    }
}
