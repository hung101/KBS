<?php

namespace frontend\controllers;

use Yii;
use app\models\MesyuaratJkk;
use app\models\MesyuaratJkkSearch;
use app\models\MesyuaratJkkKehadiran;
use app\models\MesyuaratJkkKehadiranSearch;
use app\models\MsnLaporan;
use app\models\Atlet;
use app\models\AtletSearch;
use app\models\Jurulatih;
use frontend\models\JurulatihSearch;
use app\models\PengurusanProgramBinaan;
use frontend\models\PengurusanProgramBinaanSearch;
use app\models\PermohonanPeralatan;
use frontend\models\PermohonanPeralatanSearch;
use app\models\PenyertaanSukan;
use frontend\models\PenyertaanSukanSearch;
use app\models\ProfilPusatLatihan;
use frontend\models\ProfilPusatLatihanSearch;
use app\models\PerancanganProgram;
use frontend\models\PerancanganProgramSearch;
use app\models\PerancanganProgramPlan;
use frontend\models\PerancanganProgramPlanSearch;
use app\models\PerancanganProgramPlanMaster;
use frontend\models\PerancanganProgramPlanMasterSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\helpers\Url;
use yii\helpers\BaseUrl;
use yii\web\Session;

use app\models\general\Upload;
use common\models\general\GeneralFunction;

// table reference
use app\models\RefPenganjurJkk;
use app\models\PengurusanJkkJkp;
use app\models\RefProgramSemasaSukanAtlet;
use app\models\RefCawangan;
use app\models\RefSukan;
use app\models\RefTempatJkk;
use app\models\RefFasa;
use app\models\RefNegeri;
use app\models\RefStatusTawaran;
use app\models\RefStatusPermohonanProgramBinaan;
use app\models\RefKelulusanPeralatan;
use app\models\RefStatusProgram;
use app\models\RefBilJkk;
use app\models\RefJenisCawanganKuasaJkkJkp;
use app\models\RefKategoriPelan;

/**
 * MesyuaratJkkController implements the CRUD actions for MesyuaratJkk model.
 */
class MesyuaratJkkController extends Controller
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
     * Lists all MesyuaratJkk models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $searchModel = new MesyuaratJkkSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    /**
     * Lists all MesyuaratJkk models.
     * @return mixed
     */
    public function actionAgendaPerbincangan($mesyuarat_id, $sukan_id, $program_id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $queryPar = Yii::$app->request->queryParams;
        
        $queryPar['PerancanganProgramPlanSearch']['bahagian'] = RefKategoriPelan::KEJOHANAN_LATIHAN;
        
        if($mesyuarat_id != ''){
            Atlet::updateAll(['mesyuarat_id' => $mesyuarat_id], 'mesyuarat_id = 0 OR mesyuarat_id = "" OR mesyuarat_id IS NULL');
            $queryPar['AtletSearch']['mesyuarat_id'] = $mesyuarat_id;
            
            Jurulatih::updateAll(['mesyuarat_id' => $mesyuarat_id], 'mesyuarat_id = 0 OR mesyuarat_id = "" OR mesyuarat_id IS NULL');
            $queryPar['JurulatihSearch']['mesyuarat_id'] = $mesyuarat_id;
            
            PengurusanProgramBinaan::updateAll(['mesyuarat_id' => $mesyuarat_id], 'mesyuarat_id = 0 OR mesyuarat_id = "" OR mesyuarat_id IS NULL');
            $queryPar['PengurusanProgramBinaanSearch']['mesyuarat_id'] = $mesyuarat_id;
            
            PermohonanPeralatan::updateAll(['mesyuarat_id' => $mesyuarat_id], 'mesyuarat_id = 0 OR mesyuarat_id = "" OR mesyuarat_id IS NULL');
            $queryPar['PermohonanPeralatanSearch']['mesyuarat_id'] = $mesyuarat_id;
            
            PerancanganProgramPlanMaster::updateAll(['mesyuarat_id' => $mesyuarat_id], '(mesyuarat_id = 0 OR mesyuarat_id = "" OR mesyuarat_id IS NULL) AND sukan = "'.$sukan_id.'" AND program = "'.$program_id.'"');
            $queryPar['PerancanganProgramPlanMasterSearch']['mesyuarat_id'] = $mesyuarat_id;
            
            PenyertaanSukan::updateAll(['mesyuarat_id' => $mesyuarat_id], 'mesyuarat_id = 0 OR mesyuarat_id = "" OR mesyuarat_id IS NULL');
            $queryPar['PenyertaanSukanSearch']['mesyuarat_id'] = $mesyuarat_id;
            
            ProfilPusatLatihan::updateAll(['mesyuarat_id' => $mesyuarat_id], 'mesyuarat_id = 0 OR mesyuarat_id = "" OR mesyuarat_id IS NULL');
            $queryPar['ProfilPusatLatihanSearch']['mesyuarat_id'] = $mesyuarat_id;
        }
        
        if($sukan_id != ''){
            //$queryPar['AtletSearch']['sukan'] = $sukan_id;
            //$queryPar['JurulatihSearch']['nama_sukan'] = $sukan_id;
            //$queryPar['PengurusanProgramBinaanSearch']['sukan'] = $sukan_id;
            $queryPar['PermohonanPeralatanSearch']['sukan_id'] = $sukan_id;
            $queryPar['PerancanganProgramPlanMasterSearch']['sukan_id'] = $sukan_id;
            $queryPar['PenyertaanSukanSearch']['sukan'] = $sukan_id;
            //$queryPar['PenyertaanSukanSearch']['sukan_id'] = $sukan_id;
        }
        
        if($program_id != ''){
            //$queryPar['AtletSearch']['program'] = $program_id;
            //$queryPar['JurulatihSearch']['program'] = $program_id;
            //$queryPar['PengurusanProgramBinaanSearch']['program'] = $program_id;
            $queryPar['PermohonanPeralatanSearch']['program_id'] = $program_id;
            $queryPar['PerancanganProgramPlanMasterSearch']['program_id'] = $program_id;
            $queryPar['ProfilPusatLatihanSearch']['program'] = $program_id;
            //$queryPar['PenyertaanSukanSearch']['program'] = $program_id;
            //$queryPar['ProfilPusatLatihanSearch']['program_id'] = $program_id;
        }
        
        //$queryPar['AtletSearch']['tawaran'] = RefStatusTawaran::DALAM_PROSES;
        //$queryPar['PengurusanProgramBinaanSearch']['status_permohonan_id'] = RefStatusPermohonanProgramBinaan::SEDANG_DIPROSES;
        //$queryPar['PermohonanPeralatanSearch']['kelulusan_id'] = RefKelulusanPeralatan::SEDANG_DIPROSES;
        //$queryPar['PerancanganProgramSearch']['status_program_id'] = RefStatusProgram::DALAM_PROSES;
        //$queryPar['JurulatihSearch']['status_tawaran_id'] = RefStatusTawaran::DALAM_PROSES;
        
        $searchModelAtlet = new AtletSearch();
        $dataProviderAtlet = $searchModelAtlet->search($queryPar);
        
        $searchModelJurulatih = new JurulatihSearch();
        $dataProviderJurulatih = $searchModelJurulatih->search($queryPar);
        
        $searchModelPengurusanProgramBinaan = new PengurusanProgramBinaanSearch();
        $dataProviderPengurusanProgramBinaan = $searchModelPengurusanProgramBinaan->search($queryPar);
        
        $searchModelPermohonanPeralatan = new PermohonanPeralatanSearch();
        $dataProviderPermohonanPeralatan = $searchModelPermohonanPeralatan->search($queryPar);
        
        $searchModelKejohanan = new PenyertaanSukanSearch();
        $dataProviderKejohanan = $searchModelKejohanan->search($queryPar);
        
        $searchModelPusatLatihan = new ProfilPusatLatihanSearch();
        $dataProviderPusatLatihan = $searchModelPusatLatihan->search($queryPar);
        
        $searchModelProgram= new PerancanganProgramPlanMasterSearch();
        $dataProviderProgram = $searchModelProgram->search($queryPar);

        return $this->render('agenda_perbincangan', [
            'searchModelAtlet' => $searchModelAtlet,
            'dataProviderAtlet' => $dataProviderAtlet,
            'searchModelJurulatih' => $searchModelJurulatih,
            'dataProviderJurulatih' => $dataProviderJurulatih,
            'searchModelPengurusanProgramBinaan' => $searchModelPengurusanProgramBinaan,
            'dataProviderPengurusanProgramBinaan' => $dataProviderPengurusanProgramBinaan,
            'searchModelPermohonanPeralatan' => $searchModelPermohonanPeralatan,
            'dataProviderPermohonanPeralatan' => $dataProviderPermohonanPeralatan,
            'searchModelKejohanan' => $searchModelKejohanan,
            'dataProviderKejohanan' => $dataProviderKejohanan,
            'searchModelPusatLatihan' => $searchModelPusatLatihan,
            'dataProviderPusatLatihan' => $dataProviderPusatLatihan,
            'searchModelProgram' => $searchModelProgram,
            'dataProviderProgram' => $dataProviderProgram,
            'mesyuarat_id' => $mesyuarat_id,
        ]);
    }
    
    /**
     * Lists all MesyuaratJkk models.
     * @return mixed
     */
    public function actionResetAgendaPerbincangan()
    {
        
        Atlet::updateAll(['mesyuarat_id' => ''], 'tawaran = ' . RefStatusTawaran::DALAM_PROSES);

        Jurulatih::updateAll(['mesyuarat_id' => ''], 'status_tawaran = ' . RefStatusTawaran::DALAM_PROSES);

        PengurusanProgramBinaan::updateAll(['mesyuarat_id' => ''], 'status_permohonan = ' . RefStatusPermohonanProgramBinaan::SEDANG_DIPROSES);

        PermohonanPeralatan::updateAll(['mesyuarat_id' => ''], 'kelulusan = ' . RefKelulusanPeralatan::SEDANG_DIPROSES);

        PerancanganProgramPlanMaster::updateAll(['mesyuarat_id' => '']);

        PenyertaanSukan::updateAll(['mesyuarat_id' => '']);

        ProfilPusatLatihan::updateAll(['mesyuarat_id' => '']);
    }

    /**
     * Displays a single MesyuaratJkk model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {   
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $queryPar = null;
        
        $queryPar['MesyuaratJkkKehadiranSearch']['mesyuarat_id'] = $id;
        
        $SNHsearchModel = new MesyuaratJkkKehadiranSearch();
        $SNHdataProvider = $SNHsearchModel->search($queryPar);
        
        $model = $this->findModel($id);
        
        $ref = RefPenganjurJkk::findOne(['id' => $model->penganjur]);
        $model->penganjur = $ref['desc'];
        
        $ref = PengurusanJkkJkp::findOne(['pengurusan_jkk_jkp_id' => $model->pengerusi_mesyuarat]);
        $model->pengerusi_mesyuarat = $ref['nama_pegawai_coach'];
        
        $model->program_id = $model->program;
        $ref = RefProgramSemasaSukanAtlet::findOne(['id' => $model->program]);
        $model->program = $ref['desc'];
        
        $ref = RefCawangan::findOne(['id' => $model->cawangan]);
        $model->cawangan = $ref['desc'];
        
        $ref = RefNegeri::findOne(['id' => $model->negeri]);
        $model->negeri = $ref['desc'];
        
        $model->sukan_id = $model->sukan;
        $ref = RefSukan::findOne(['id' => $model->sukan]);
        $model->sukan = $ref['desc'];
        
        //$ref = RefTempatJkk::findOne(['id' => $model->tempat]);
        //$model->tempat = $ref['desc'];
        
        $ref = RefBilJkk::findOne(['id' => $model->bil_mesyuarat]);
        $model->bil_mesyuarat = $ref['desc'];
        
        $ref = RefJenisCawanganKuasaJkkJkp::findOne(['id' => $model->jenis_mesyuarat]);
        $model->jenis_mesyuarat = $ref['desc'];
        
        if($model->tarikh != "") {$model->tarikh = GeneralFunction::convert($model->tarikh, GeneralFunction::TYPE_DATETIME);}
        
        return $this->render('view', [
            'model' => $model,
            'SNHsearchModel' => $SNHsearchModel,
            'SNHdataProvider' => $SNHdataProvider,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new MesyuaratJkk model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new MesyuaratJkk();
        
        Yii::$app->session->open();
        
        $queryPar = null;
        
        if(isset(Yii::$app->session->id)){
            $queryPar['MesyuaratJkkKehadiranSearch']['session_id'] = Yii::$app->session->id;
        }
        
        $SNHsearchModel = new MesyuaratJkkKehadiranSearch();
        $SNHdataProvider = $SNHsearchModel->search($queryPar);

        if($model->load(Yii::$app->request->post())){
            $file = UploadedFile::getInstance($model, 'minit_mesyuarat');

            if($file){
                $model->minit_mesyuarat = "uploadlater";
            }
        }
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            // set the MesyuaratJkk id base on session id
            if(isset(Yii::$app->session->id)){
                MesyuaratJkkKehadiran::updateAll(['mesyuarat_id' => $model->mesyuarat_id], 'session_id = "'.Yii::$app->session->id.'"');
                MesyuaratJkkKehadiran::updateAll(['session_id' => ''], 'mesyuarat_id = "'.$model->mesyuarat_id.'"');
            }
            
            $file = UploadedFile::getInstance($model, 'minit_mesyuarat');
            if($file){
                $model->minit_mesyuarat = Upload::uploadFile($file, Upload::MesyuaratJkkFolder, $model->mesyuarat_id);
            }
            
            //upload file to server
            /*$file = UploadedFile::getInstance($model, 'muat_naik');
            if($file){
                $model->muat_naik = Upload::uploadFile($file, Upload::mesyuaratFolder, $model->mesyuarat_id);
            }*/
            
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->mesyuarat_id]);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
                'SNHsearchModel' => $SNHsearchModel,
                'SNHdataProvider' => $SNHdataProvider,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Updates an existing MesyuaratJkk model.
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
        
        $queryPar['MesyuaratJkkKehadiranSearch']['mesyuarat_id'] = $id;
        
        $SNHsearchModel = new MesyuaratJkkKehadiranSearch();
        $SNHdataProvider = $SNHsearchModel->search($queryPar);

            
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $file = UploadedFile::getInstance($model, 'minit_mesyuarat');
            if($file){
                $model->minit_mesyuarat = Upload::uploadFile($file, Upload::MesyuaratJkkFolder, $model->mesyuarat_id);
                }
                
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->mesyuarat_id]);
            }
        } else {
            return $this->render('update', [
                'model' => $model,
                'SNHsearchModel' => $SNHsearchModel,
                'SNHdataProvider' => $SNHdataProvider,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Deletes an existing MesyuaratJkk model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        //self::actionDeleteupload($id, 'minit_mesyuarat');
        
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
    
    public function actionHantarEmel($mesyuarat_id){
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        if (($model = MesyuaratJkk::findOne($mesyuarat_id)) !== null) {
            
            $ref = RefPenganjurJkk::findOne(['id' => $model->penganjur]);
            $model->penganjur = $ref['desc'];

            $ref = PengurusanJkkJkp::findOne(['pengurusan_jkk_jkp_id' => $model->pengerusi_mesyuarat]);
            $model->pengerusi_mesyuarat = $ref['nama_pegawai_coach'];

            $ref = RefProgramSemasaSukanAtlet::findOne(['id' => $model->program]);
            $model->program = $ref['desc'];

            $ref = RefCawangan::findOne(['id' => $model->cawangan]);
            $model->cawangan = $ref['desc'];

            $ref = RefNegeri::findOne(['id' => $model->negeri]);
            $model->negeri = $ref['desc'];

            $ref = RefSukan::findOne(['id' => $model->sukan]);
            $model->sukan = $ref['desc'];

            //$ref = RefTempatJkk::findOne(['id' => $model->tempat]);
            //$model->tempat = $ref['desc'];

            $ref = RefSukan::findOne(['id' => $model->sukan]);
            $model->sukan = $ref['desc'];

            $ref = RefBilJkk::findOne(['id' => $model->bil_mesyuarat]);
            $model->bil_mesyuarat = $ref['desc'];

            $ref = RefJenisCawanganKuasaJkkJkp::findOne(['id' => $model->jenis_mesyuarat]);
            $model->jenis_mesyuarat = $ref['desc'];
        
            if(($modelMesyuaratJkkKehadirans = MesyuaratJkkKehadiran::find()
                    ->where('mesyuarat_id >= :mesyuarat_id', [':mesyuarat_id' => $mesyuarat_id])
                    ->all()) !== null) {
                foreach($modelMesyuaratJkkKehadirans as $modelMesyuaratJkkKehadiran){
                    if($modelMesyuaratJkkKehadiran->emel && $modelMesyuaratJkkKehadiran->emel != ""){
                        try {
                            $emailContent = "Assalamualaikum dan Salam Sejahtera, <br>
Ybhg./Tan Sri/Datuk/Dato'/Datin/Dr./Tuan/Puan, 
<br><br>
<b><u>Jemputan ke Mesyuarat <jkk/jkp> ". $model->bil_mesyuarat .' Tahun '. date_format(date_create($model->tarikh),"Y") .'</u></b><br>
Dengan segala hormatnya perkara diatas dirujuk. <br><br>
2. Sukacitanya dimaklumkan bahawa Mesyuarat <jkk/jkp> Bil <bil> Tahun <tahun> akan diadakan seperti butiran dibawah: <br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tarikh: '. GeneralFunction::getDateTimePrintFormat($model->tarikh) .'<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tempat: '. $model->tempat .'<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Pengerusi : '. $model->pengerusi_mesyuarat .'<br><br>
3. Dengan segala hormatnya dijemput hadir. <br><br>
4. Perhatian dan kerjasama semua berhubungn perkara ini amatlah dihargai dan didahului dengan ucapan terima kasih. 
';
                            // email minits
                            if($model->minit_mesyuarat != ""){
                                $emailContent .= '<br><br>
    Berikut adalah minit mesyuarat:-
    <br><br>
    <a href="'.Url::base(true).'/'. $model->minit_mesyuarat . '" ></a>';
                            }
                            
                            $emailContent .= '<br><br><br>
Sekian<br>
Bahagian Atlet<br>
<br>
"KE ARAH KECEMERLANGAN SUKAN"<br>
Majlis Sukan Negara Malaysia. ';
                                    
                            Yii::$app->mailer->compose()
                                    ->setTo($modelMesyuaratJkkKehadiran->emel)
                                    ->setFrom('noreply@spsb.com')
                                    ->setSubject('Mesyuarat ' . $model->jenis_mesyuarat)
                                    ->setHtmlBody($emailContent)->send();
                        }
                        catch(\Swift_SwiftException $exception)
                        {
                            Yii::$app->session->setFlash('error', 'Terdapat ralat menghantar e-mel.');
                        }
                    } 
                }

            }

            Yii::$app->session->setFlash('success', 'Minit telah dihantar melalui e-mel.');
            
            return $this->redirect(['view', 'id' => $mesyuarat_id]);
        } else {
            //echo "Tiada rekod di dalam sistem";
        }
    }

    /**
     * Finds the MesyuaratJkk model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MesyuaratJkk the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MesyuaratJkk::findOne($id)) !== null) {
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
				@unlink($img);
            }

            $img = $this->findModel($id);
            $img->$field = NULL;
            $img->update();

            return $this->redirect(['update', 'id' => $id]);
    }
    
    public function actionLaporanJadualMesyuaratJkkJkp()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new MsnLaporan();
        $model->format = 'html';

        if ($model->load(Yii::$app->request->post())) {
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-laporan-jadual-mesyuarat-jkk-jkp'
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'jenis' => $model->jenis
                    , 'negeri' => $model->negeri
                    , 'program' => $model->program
                    , 'sukan' => $model->sukan
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-laporan-jadual-mesyuarat-jkk-jkp'
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'jenis' => $model->jenis
                    , 'negeri' => $model->negeri
                    , 'program' => $model->program
                    , 'sukan' => $model->sukan
                    , 'format' => $model->format
                ]);
            }
        } 

        return $this->render('laporan_jadual_mesyuarat_jkk_jkp', [
            'model' => $model,
            'readonly' => false,
        ]);
    }
    
    public function actionGenerateLaporanJadualMesyuaratJkkJkp($tarikh_dari, $tarikh_hingga, $jenis, $negeri, $program, $sukan, $format)
    {
        if($tarikh_dari == "") $tarikh_dari = array();
        else $tarikh_dari = array($tarikh_dari);
        
        if($tarikh_hingga == "") $tarikh_hingga = array();
        else $tarikh_hingga = array($tarikh_hingga);
        
        if($jenis == "") $jenis = array();
        else $jenis = array($jenis);
        
        if($program == "") $program = array();
        else $program = array($program);
        
        if($sukan == "") $sukan = array();
        else $sukan = array($sukan);
        
        if($negeri == "") $negeri = array();
        else $negeri = array($negeri);
        
        $controls = array(
            'FROM_DATE' => $tarikh_dari,
            'TO_DATE' => $tarikh_hingga,
            'JENIS_MESYUARAT' => $jenis,
            'PROGRAM' => $program,
            'SUKAN' => $sukan,
            'NEGERI' => $negeri,
        );
        
        GeneralFunction::generateReport('/spsb/MSN/LaporanJadualMesyuaratJkkJkp', $format, $controls, 'laporan_jadual_mesyuarat_jkk_jkp');
    }
	
	public function actionSetJenisMesyuarat($jenis_mesyuarat)
	{
		$session = new Session;
        $session->open();

        $session['mesyuarat-jkk_jenis_mesyuarat'] = $jenis_mesyuarat;
        
        $session->close();
	}
}
