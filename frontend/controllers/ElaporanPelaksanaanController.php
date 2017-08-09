<?php

namespace frontend\controllers;

use Yii;
use app\models\ElaporanPelaksanaan;
use app\models\ElaporanPelaksanaanReport;
use frontend\models\ElaporanPelaksanaanSearch;
use app\models\ElaporanPelaksanaanGambar;
use frontend\models\ElaporanPelaksanaanGambarSearch;
use app\models\ElaporanPelaksanaanObjektif;
use frontend\models\ElaporanPelaksanaanObjektifSearch;
use app\models\ElaporanPelaksanaanKerjasama;
use frontend\models\ElaporanPelaksanaanKerjasamaSearch;
use app\models\ElaporanPelaksanaanKekurangan;
use frontend\models\ElaporanPelaksanaanKekuranganSearch;
use app\models\ElaporanPelaksanaanKelebihan;
use frontend\models\ElaporanPelaksanaanKelebihanSearch;
use app\models\PermohonanEBantuan;
use backend\models\PermohonanEBantuanSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\helpers\BaseUrl;

use app\models\general\Upload;
use app\models\general\GeneralVariable;
use common\models\general\GeneralFunction;

// table reference
use app\models\RefKategoriELaporan;
use app\models\RefPeringkatELaporan;
use app\models\RefProgramRumusan;
use app\models\RefNegeri;
use app\models\RefBandar;
use app\models\RefParlimen;
use app\models\RefBahagianELaporan;
use app\models\RefCawanganELaporan;
use app\models\RefKelulusanELaporan;

/**
 * ElaporanPelaksanaanController implements the CRUD actions for ElaporanPelaksanaan model.
 */
class ElaporanPelaksanaanController extends Controller
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
     * Lists all ElaporanPelaksanaan models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $searchModel = new ElaporanPelaksanaanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    
    /**
     * Creates a new PermohonanEBantuanSenaraiSemak model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionLoad($permohonan_e_bantuan_id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        if (($model = ElaporanPelaksanaan::findOne(['permohonan_e_bantuan_id' => $permohonan_e_bantuan_id])) !== null) {
            return self::actionUpdate($model->elaporan_pelaksaan_id);
        } else {
            return self::actionCreate($permohonan_e_bantuan_id);
        }
    }

    // eddie (jasper) start

    public function actionReport()
    {

        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new ElaporanPelaksanaanReport();
        $model->format = 'html';

        if ($model->load(Yii::$app->request->post())) {
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-report'
                    , 'nama_penganjur' => $model->nama_penganjur
                    , 'nama_program' => $model->nama_program
                    , 'negeri' => $model->negeri
                    , 'e_laporan_kategori' => $model->e_laporan_kategori
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'tarikh_pada' => $model->tarikh_pada
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-report'
                    , 'nama_penganjur' => $model->nama_penganjur
                    , 'nama_program' => $model->nama_program
                    , 'negeri' => $model->negeri
                    , 'e_laporan_kategori' => $model->e_laporan_kategori
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'tarikh_pada' => $model->tarikh_pada
                    , 'format' => $model->format
                ]);

            }

        } 

        return $this->render('report', [
            'model' => $model,
            'readonly' => false,
        ]);
    }

    public function actionGenerateReport($nama_penganjur, $nama_program, $negeri, $e_laporan_kategori, $tarikh_dari, $tarikh_pada, $format)
    {

        if($nama_penganjur == "") $nama_penganjur = array();
        else $nama_penganjur = array($nama_penganjur);

        if($nama_program == "") $nama_program = array();
        else $nama_program = array($nama_program);

        if($negeri == "") $negeri = array();
        else $negeri = array(intval($negeri));
        
        if($e_laporan_kategori == "") $e_laporan_kategori = array();
        else $e_laporan_kategori = array(intval($e_laporan_kategori));

        if($tarikh_dari == "") $tarikh_dari = array();
        else $tarikh_dari = array($tarikh_dari);

        if($tarikh_pada == "") $tarikh_pada = array();
        else $tarikh_pada = array($tarikh_pada);
        
        $controls = array(
            'NAMA_PENGANJUR' => $nama_penganjur,
            'NAMA_PROGRAM' => $nama_program,
            'NEGERI' => $negeri,
            'E_LAPORAN_KATEGORI' => $e_laporan_kategori,
            'START_FROM_DATE' => $tarikh_dari,
            'START_TO_DATE' => $tarikh_pada,
        );
        
        GeneralFunction::generateReport('/spsb/kbs/e_laporan/laporan_perlaksaan_program', $format, $controls, 'laporan_perlaksaan_program');

    }

    // eddie (jasper) end

    /**
     * Displays a single ElaporanPelaksanaan model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $queryPar = null;
        
        $queryPar['ElaporanPelaksanaanGambarSearch']['elaporan_pelaksaan_id'] = $id;
        $queryPar['ElaporanPelaksanaanObjektifSearch']['elaporan_pelaksaan_id'] = $id;
        $queryPar['ElaporanPelaksanaanKerjasamaSearch']['elaporan_pelaksaan_id'] = $id;
        $queryPar['ElaporanPelaksanaanKekuranganSearch']['elaporan_pelaksaan_id'] = $id;
        $queryPar['ElaporanPelaksanaanKelebihanSearch']['elaporan_pelaksaan_id'] = $id;
        
        $searchModelGambar = new ElaporanPelaksanaanGambarSearch();
        $dataProviderGambar = $searchModelGambar->search($queryPar);
        
        $searchModelObjektif = new ElaporanPelaksanaanObjektifSearch();
        $dataProviderObjektif = $searchModelObjektif->search($queryPar);
        
        $searchModelKerjasama = new ElaporanPelaksanaanKerjasamaSearch();
        $dataProviderKerjasama = $searchModelKerjasama->search($queryPar);
        
        $searchModelKekurangan= new ElaporanPelaksanaanKekuranganSearch();
        $dataProviderKekurangan = $searchModelKekurangan->search($queryPar);
        
        $searchModelKelebihan= new ElaporanPelaksanaanKelebihanSearch();
        $dataProviderKelebihan = $searchModelKelebihan->search($queryPar);
        
        $model = $this->findModel($id);
        
        $ref = RefKategoriELaporan::findOne(['id' => $model->kategori_elaporan]);
        $model->kategori_elaporan = $ref['desc'];
        
        $ref = RefPeringkatELaporan::findOne(['id' => $model->peringkat]);
        $model->peringkat = $ref['desc'];
        
        $ref = RefProgramRumusan::findOne(['id' => $model->rumusan_program]);
        $model->rumusan_program = $ref['desc'];
        
        $ref = RefNegeri::findOne(['id' => $model->alamat_tempat_pelaksanaan_negeri]);
        $model->alamat_tempat_pelaksanaan_negeri = $ref['desc'];
        
        $ref = RefBandar::findOne(['id' => $model->alamat_tempat_pelaksanaan_bandar]);
        $model->alamat_tempat_pelaksanaan_bandar = $ref['desc'];
        
        $ref = RefParlimen::findOne(['id' => $model->alamat_tempat_pelaksanaan_parlimen]);
        $model->alamat_tempat_pelaksanaan_parlimen = $ref['desc'];
        
        $ref = RefBahagianELaporan::findOne(['id' => $model->bahagian]);
        $model->bahagian = $ref['desc'];
        
        $ref = RefCawanganELaporan::findOne(['id' => $model->cawangan]);
        $model->cawangan = $ref['desc'];
        
        $ref = RefKelulusanELaporan::findOne(['id' => $model->kelulusan]);
        $model->kelulusan = $ref['desc'];
        
        $model->tarikh_pelaksanaan_mula = GeneralFunction::convert($model->tarikh_pelaksanaan_mula);
        
        $model->tarikh_pelaksanaan_akhir = GeneralFunction::convert($model->tarikh_pelaksanaan_akhir);
        
        return $this->render('view', [
            'model' => $model,
            'searchModelGambar' => $searchModelGambar,
            'dataProviderGambar' => $dataProviderGambar,
            'searchModelObjektif' => $searchModelObjektif,
            'dataProviderObjektif' => $dataProviderObjektif,
            'searchModelKerjasama' => $searchModelKerjasama,
            'dataProviderKerjasama' => $dataProviderKerjasama,
            'searchModelKekurangan' => $searchModelKekurangan,
            'dataProviderKekurangan' => $dataProviderKekurangan,
            'searchModelKelebihan' => $searchModelKelebihan,
            'dataProviderKelebihan' => $dataProviderKelebihan,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new ElaporanPelaksanaan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($permohonan_e_bantuan_id=null)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new ElaporanPelaksanaan();
        
        $queryPar = null;
        
        Yii::$app->session->open();
        
        if(isset(Yii::$app->session->id)){
            $queryPar['ElaporanPelaksanaanGambarSearch']['session_id'] = Yii::$app->session->id;
            $queryPar['ElaporanPelaksanaanObjektifSearch']['session_id'] = Yii::$app->session->id;
            $queryPar['ElaporanPelaksanaanKerjasamaSearch']['session_id'] = Yii::$app->session->id;
            $queryPar['ElaporanPelaksanaanKekuranganSearch']['session_id'] = Yii::$app->session->id;
            $queryPar['ElaporanPelaksanaanKelebihanSearch']['session_id'] = Yii::$app->session->id;
        }
        
        if(Yii::$app->user->identity->full_name)
            $model->creator_nama = Yii::$app->user->identity->full_name;
        
        if(Yii::$app->user->identity->email)
            $model->creator_emel = Yii::$app->user->identity->email;
        
        if(Yii::$app->user->identity->tel_mobile_no){
            $model->creator_mobile_no = Yii::$app->user->identity->tel_mobile_no;
        } else if(Yii::$app->user->identity->tel_no){
            $model->creator_mobile_no = Yii::$app->user->identity->tel_no;
        }
        
        if($permohonan_e_bantuan_id != ""){
            $model->permohonan_e_bantuan_id = $permohonan_e_bantuan_id; //link to Permohonan e-Bantuan
            
            
            if (($modelPermohonanEBantuan = PermohonanEBantuan::findOne(['permohonan_e_bantuan_id' => $permohonan_e_bantuan_id])) !== null) {
                $model->nama_projek_program_aktiviti_kejohanan = $modelPermohonanEBantuan->nama_program;
                
                $model->nama_penganjur_persatuan_kerjasama = $modelPermohonanEBantuan->nama_pertubuhan_persatuan;
                
                $model->jumlah_bantuan_peruntukan = $modelPermohonanEBantuan->jumlah_diluluskan;
            }
        }
        
        $searchModelGambar = new ElaporanPelaksanaanGambarSearch();
        $dataProviderGambar = $searchModelGambar->search($queryPar);
        
        $searchModelObjektif = new ElaporanPelaksanaanObjektifSearch();
        $dataProviderObjektif = $searchModelObjektif->search($queryPar);
        
        $searchModelKerjasama = new ElaporanPelaksanaanKerjasamaSearch();
        $dataProviderKerjasama = $searchModelKerjasama->search($queryPar);
        
        $searchModelKekurangan= new ElaporanPelaksanaanKekuranganSearch();
        $dataProviderKekurangan = $searchModelKekurangan->search($queryPar);
        
        $searchModelKelebihan= new ElaporanPelaksanaanKelebihanSearch();
        $dataProviderKelebihan = $searchModelKelebihan->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $file = UploadedFile::getInstance($model, 'muat_naik');
            if($file){
                $model->muat_naik = Upload::uploadFile($file, Upload::eLaporanFolder, $model->elaporan_pelaksaan_id);
            }
            
            if(isset(Yii::$app->session->id)){
                ElaporanPelaksanaanGambar::updateAll(['elaporan_pelaksaan_id' => $model->elaporan_pelaksaan_id], 'session_id = "'.Yii::$app->session->id.'"');
                ElaporanPelaksanaanGambar::updateAll(['session_id' => ''], 'elaporan_pelaksaan_id = "'.$model->elaporan_pelaksaan_id.'"');
                
                ElaporanPelaksanaanObjektif::updateAll(['elaporan_pelaksaan_id' => $model->elaporan_pelaksaan_id], 'session_id = "'.Yii::$app->session->id.'"');
                ElaporanPelaksanaanObjektif::updateAll(['session_id' => ''], 'elaporan_pelaksaan_id = "'.$model->elaporan_pelaksaan_id.'"');
                
                ElaporanPelaksanaanKerjasama::updateAll(['elaporan_pelaksaan_id' => $model->elaporan_pelaksaan_id], 'session_id = "'.Yii::$app->session->id.'"');
                ElaporanPelaksanaanKerjasama::updateAll(['session_id' => ''], 'elaporan_pelaksaan_id = "'.$model->elaporan_pelaksaan_id.'"');
                
                ElaporanPelaksanaanKekurangan::updateAll(['elaporan_pelaksaan_id' => $model->elaporan_pelaksaan_id], 'session_id = "'.Yii::$app->session->id.'"');
                ElaporanPelaksanaanKekurangan::updateAll(['session_id' => ''], 'elaporan_pelaksaan_id = "'.$model->elaporan_pelaksaan_id.'"');
                
                ElaporanPelaksanaanKelebihan::updateAll(['elaporan_pelaksaan_id' => $model->elaporan_pelaksaan_id], 'session_id = "'.Yii::$app->session->id.'"');
                ElaporanPelaksanaanKelebihan::updateAll(['session_id' => ''], 'elaporan_pelaksaan_id = "'.$model->elaporan_pelaksaan_id.'"');
            }
            
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->elaporan_pelaksaan_id]);
            }
        } 
        
        return $this->render('create', [
                'model' => $model,
                'searchModelGambar' => $searchModelGambar,
                'dataProviderGambar' => $dataProviderGambar,
                'searchModelObjektif' => $searchModelObjektif,
                'dataProviderObjektif' => $dataProviderObjektif,
                'searchModelKerjasama' => $searchModelKerjasama,
                'dataProviderKerjasama' => $dataProviderKerjasama,
                'searchModelKekurangan' => $searchModelKekurangan,
                'dataProviderKekurangan' => $dataProviderKekurangan,
                'searchModelKelebihan' => $searchModelKelebihan,
                'dataProviderKelebihan' => $dataProviderKelebihan,
                'readonly' => false,
            ]);
    }

    /**
     * Updates an existing ElaporanPelaksanaan model.
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
        
        $existingMuatNaik = $model->muat_naik;
        
        $queryPar = null;
        
        $queryPar['ElaporanPelaksanaanGambarSearch']['elaporan_pelaksaan_id'] = $id;
        $queryPar['ElaporanPelaksanaanObjektifSearch']['elaporan_pelaksaan_id'] = $id;
        $queryPar['ElaporanPelaksanaanKerjasamaSearch']['elaporan_pelaksaan_id'] = $id;
        $queryPar['ElaporanPelaksanaanKekuranganSearch']['elaporan_pelaksaan_id'] = $id;
        $queryPar['ElaporanPelaksanaanKelebihanSearch']['elaporan_pelaksaan_id'] = $id;
        
        $searchModelGambar = new ElaporanPelaksanaanGambarSearch();
        $dataProviderGambar = $searchModelGambar->search($queryPar);
        
        $searchModelObjektif = new ElaporanPelaksanaanObjektifSearch();
        $dataProviderObjektif = $searchModelObjektif->search($queryPar);
        
        $searchModelKerjasama = new ElaporanPelaksanaanKerjasamaSearch();
        $dataProviderKerjasama = $searchModelKerjasama->search($queryPar);
        
        $searchModelKekurangan= new ElaporanPelaksanaanKekuranganSearch();
        $dataProviderKekurangan = $searchModelKekurangan->search($queryPar);
        
        $searchModelKelebihan= new ElaporanPelaksanaanKelebihanSearch();
        $dataProviderKelebihan = $searchModelKelebihan->search($queryPar);
        
        if($model->load(Yii::$app->request->post())){
            $file = UploadedFile::getInstance($model, 'muat_naik');

            if($file){
                //valid file to upload
                //upload file to server
                
                // delete upload file
                /*if($existingMuatNaik != ""){
                    self::actionDeleteupload($id, 'muat_naik');
                }
                
                $model->muat_naik = Upload::uploadFile($file, Upload::dokumenPenyelidikanFolder, $model->dokumen_penyelidikan_id);*/
            } else {
                //invalid file to upload
                //remain existing file
                $model->muat_naik = $existingMuatNaik;
            }
        }

        if (Yii::$app->request->post() && $model->save()) {
            $file = UploadedFile::getInstance($model, 'muat_naik');
            if($file){
                $model->muat_naik = Upload::uploadFile($file, Upload::eLaporanFolder, $model->elaporan_pelaksaan_id);
            }
            
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->elaporan_pelaksaan_id]);
            }
        }
        
        return $this->render('update', [
                'model' => $model,
                'searchModelGambar' => $searchModelGambar,
                'dataProviderGambar' => $dataProviderGambar,
                'searchModelObjektif' => $searchModelObjektif,
                'dataProviderObjektif' => $dataProviderObjektif,
                'searchModelKerjasama' => $searchModelKerjasama,
                'dataProviderKerjasama' => $dataProviderKerjasama,
                'searchModelKekurangan' => $searchModelKekurangan,
                'dataProviderKekurangan' => $dataProviderKekurangan,
                'searchModelKelebihan' => $searchModelKelebihan,
                'dataProviderKelebihan' => $dataProviderKelebihan,
                'readonly' => false,
            ]);
    }

    /**
     * Deletes an existing ElaporanPelaksanaan model.
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
        self::actionDeleteupload($id, 'muat_naik');
        
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ElaporanPelaksanaan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ElaporanPelaksanaan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ElaporanPelaksanaan::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    // Add function for delete image or file
    public function actionDeleteupload($id, $field)
    {
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
