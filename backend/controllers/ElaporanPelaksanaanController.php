<?php

namespace backend\controllers;

use Yii;
use app\models\ElaporanPelaksanaan;
use backend\models\ElaporanPelaksanaanSearch;
use app\models\ElaporanPelaksanaanGambar;
use backend\models\ElaporanPelaksanaanGambarSearch;
use app\models\ElaporanPelaksanaanObjektif;
use backend\models\ElaporanPelaksanaanObjektifSearch;
use app\models\ElaporanPelaksanaanKerjasama;
use backend\models\ElaporanPelaksanaanKerjasamaSearch;
use app\models\ElaporanPelaksanaanKekurangan;
use backend\models\ElaporanPelaksanaanKekuranganSearch;
use app\models\ElaporanPelaksanaanKelebihan;
use backend\models\ElaporanPelaksanaanKelebihanSearch;
use app\models\PermohonanEBantuan;
use backend\models\PermohonanEBantuanSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

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
        
        $queryPar = Yii::$app->request->queryParams;
        
        $queryPar['ElaporanPelaksanaanSearch']['user_public_id'] = Yii::$app->user->identity->id;
        
        $searchModel = new ElaporanPelaksanaanSearch();
        $dataProvider = $searchModel->search($queryPar);

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
    public function actionCreate($permohonan_e_bantuan_id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new ElaporanPelaksanaan();
        
        if(Yii::$app->user->identity->full_name)
            $model->creator_nama = Yii::$app->user->identity->full_name;
        
        if(Yii::$app->user->identity->email)
            $model->creator_emel = Yii::$app->user->identity->email;
        
        if(Yii::$app->user->identity->tel_bimbit_no){
            $model->creator_mobile_no = Yii::$app->user->identity->tel_bimbit_no;
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
        
        // set Kategori E-Laporan NGO
        $model->kategori_elaporan = RefKategoriELaporan::KATEGORI_NGO;
        
        // set public user id
        $model->user_public_id = Yii::$app->user->identity->id;
        
        $queryPar = null;
        
        Yii::$app->session->open();
        
        if(isset(Yii::$app->session->id)){
            $queryPar['ElaporanPelaksanaanGambarSearch']['session_id'] = Yii::$app->session->id;
            $queryPar['ElaporanPelaksanaanObjektifSearch']['session_id'] = Yii::$app->session->id;
            $queryPar['ElaporanPelaksanaanKerjasamaSearch']['session_id'] = Yii::$app->session->id;
            $queryPar['ElaporanPelaksanaanKekuranganSearch']['session_id'] = Yii::$app->session->id;
            $queryPar['ElaporanPelaksanaanKelebihanSearch']['session_id'] = Yii::$app->session->id;
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

        if ($model->load(Yii::$app->request->post())) {
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
