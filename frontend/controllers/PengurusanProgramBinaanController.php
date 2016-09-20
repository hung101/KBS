<?php

namespace frontend\controllers;

use Yii;
use app\models\PengurusanProgramBinaan;
use frontend\models\PengurusanProgramBinaanSearch;
use app\models\PengurusanProgramBinaanKos;
use frontend\models\PengurusanProgramBinaanKosSearch;
use app\models\PengurusanProgramBinaanPeserta;
use frontend\models\PengurusanProgramBinaanPesertaSearch;
use app\models\PengurusanProgramBinaanAtlet;
use frontend\models\PengurusanProgramBinaanAtletSearch;
use app\models\PengurusanProgramBinaanJurulatih;
use frontend\models\PengurusanProgramBinaanJurulatihSearch;
use app\models\AtletPembangunanKursuskem;
use app\models\MsnLaporanSenaraiPenganjuranProgramBinaan;
use app\models\MsnLaporanStatistikProgramBinaanMengikutNegeri;
use app\models\MsnLaporanStatistikProgramBinaanMengikutSukan;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\BaseUrl;

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
        
        $ref = RefJenisPermohonanProgramBinaan::findOne(['id' => $model->jenis_permohonan]);
        $model->jenis_permohonan = $ref['desc'];
        
        $ref = RefSukan::findOne(['id' => $model->sukan]);
        $model->sukan = $ref['desc'];
        
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
        
        $searchModelProgramBinaanKos  = new PengurusanProgramBinaanKosSearch();
        $dataProviderProgramBinaanKos = $searchModelProgramBinaanKos->search($queryPar);
        
        $searchModelProgramBinaanPeserta = new PengurusanProgramBinaanPesertaSearch();
        $dataProviderProgramBinaanPeserta = $searchModelProgramBinaanPeserta->search($queryPar);
        
        $searchModelPengurusanProgramBinaanAtlet = new PengurusanProgramBinaanAtletSearch();
        $dataProviderPengurusanProgramBinaanAtlet = $searchModelPengurusanProgramBinaanAtlet->search($queryPar);
        
        $searchModelPengurusanProgramBinaanJurulatih = new PengurusanProgramBinaanJurulatihSearch();
        $dataProviderPengurusanProgramBinaanJurulatih = $searchModelPengurusanProgramBinaanJurulatih->search($queryPar);
        
        return $this->render('view', [
            'model' => $model,
            'searchModelProgramBinaanKos' => $searchModelProgramBinaanKos,
            'dataProviderProgramBinaanKos' => $dataProviderProgramBinaanKos,
            'searchModelProgramBinaanPeserta' => $searchModelProgramBinaanPeserta,
            'dataProviderProgramBinaanPeserta' => $dataProviderProgramBinaanPeserta,
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
        }
        
        $searchModelProgramBinaanKos  = new PengurusanProgramBinaanKosSearch();
        $dataProviderProgramBinaanKos = $searchModelProgramBinaanKos->search($queryPar);
        
        $searchModelProgramBinaanPeserta = new PengurusanProgramBinaanPesertaSearch();
        $dataProviderProgramBinaanPeserta = $searchModelProgramBinaanPeserta->search($queryPar);
        
        $searchModelPengurusanProgramBinaanAtlet = new PengurusanProgramBinaanAtletSearch();
        $dataProviderPengurusanProgramBinaanAtlet = $searchModelPengurusanProgramBinaanAtlet->search($queryPar);
        
        $searchModelPengurusanProgramBinaanJurulatih = new PengurusanProgramBinaanJurulatihSearch();
        $dataProviderPengurusanProgramBinaanJurulatih = $searchModelPengurusanProgramBinaanJurulatih->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if(isset(Yii::$app->session->id)){
                PengurusanProgramBinaanKos::updateAll(['pengurusan_program_binaan_id' => $model->pengurusan_program_binaan_id], 'session_id = "'.Yii::$app->session->id.'"');
                PengurusanProgramBinaanKos::updateAll(['session_id' => ''], 'pengurusan_program_binaan_id = "'.$model->pengurusan_program_binaan_id.'"');
                
                PengurusanProgramBinaanPeserta::updateAll(['pengurusan_program_binaan_id' => $model->pengurusan_program_binaan_id], 'session_id = "'.Yii::$app->session->id.'"');
                PengurusanProgramBinaanPeserta::updateAll(['session_id' => ''], 'pengurusan_program_binaan_id = "'.$model->pengurusan_program_binaan_id.'"');
                
                PengurusanProgramBinaanAtlet::updateAll(['pengurusan_program_binaan_id' => $model->pengurusan_program_binaan_id], 'session_id = "'.Yii::$app->session->id.'"');
                PengurusanProgramBinaanAtlet::updateAll(['session_id' => ''], 'pengurusan_program_binaan_id = "'.$model->pengurusan_program_binaan_id.'"');
                
                PengurusanProgramBinaanJurulatih::updateAll(['pengurusan_program_binaan_id' => $model->pengurusan_program_binaan_id], 'session_id = "'.Yii::$app->session->id.'"');
                PengurusanProgramBinaanJurulatih::updateAll(['session_id' => ''], 'pengurusan_program_binaan_id = "'.$model->pengurusan_program_binaan_id.'"');
            }
            
            // update atlet profil Kem/Kursus
            /*$modelAtlets = PengurusanProgramBinaanAtlet::findAll([
                    'pengurusan_program_binaan_id' => $model->pengurusan_program_binaan_id,
                ]);
            
            foreach($modelAtlets as $modelAtlet){
                $modelAtletKursusKem = null;
                if (($modelAtletKursusKem = AtletPembangunanKursuskem::find()->where(['atlet_id'=>$modelAtlet->atlet_id])->andWhere(['pengurusan_program_binaan_id'=>$modelAtlet->pengurusan_program_binaan_id])->one()) == null) {
                    $modelAtletKursusKem = new AtletPembangunanKursuskem();
                }
                $modelAtletKursusKem->atlet_id = $modelAtlet->atlet_id;
                $modelAtletKursusKem->tarikh_mula = $model->tarikh_mula;
                $modelAtletKursusKem->tarikh_tamat = $model->tarikh_mula;
                $modelAtletKursusKem->lokasi = $model->tempat;
                $modelAtletKursusKem->nama_kursus_kem = $model->nama_aktiviti;
                $modelAtletKursusKem->pengurusan_program_binaan_id = $model->pengurusan_program_binaan_id;
                $modelAtletKursusKem->save();
            }*/
            
            return $this->redirect(['view', 'id' => $model->pengurusan_program_binaan_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'searchModelProgramBinaanKos' => $searchModelProgramBinaanKos,
                'dataProviderProgramBinaanKos' => $dataProviderProgramBinaanKos,
                'searchModelProgramBinaanPeserta' => $searchModelProgramBinaanPeserta,
                'dataProviderProgramBinaanPeserta' => $dataProviderProgramBinaanPeserta,
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
        
        $queryPar['PengurusanProgramBinaanKosSearch']['pengurusan_program_binaan_id'] = $id;
        $queryPar['PengurusanProgramBinaanPesertaSearch']['pengurusan_program_binaan_id'] = $id;
        $queryPar['PengurusanProgramBinaanAtletSearch']['pengurusan_program_binaan_id'] = $id;
        $queryPar['PengurusanProgramBinaanJurulatihSearch']['pengurusan_program_binaan_id'] = $id;
        
        $searchModelProgramBinaanKos  = new PengurusanProgramBinaanKosSearch();
        $dataProviderProgramBinaanKos = $searchModelProgramBinaanKos->search($queryPar);
        
        $searchModelProgramBinaanPeserta = new PengurusanProgramBinaanPesertaSearch();
        $dataProviderProgramBinaanPeserta = $searchModelProgramBinaanPeserta->search($queryPar);
        
        $searchModelPengurusanProgramBinaanAtlet = new PengurusanProgramBinaanAtletSearch();
        $dataProviderPengurusanProgramBinaanAtlet = $searchModelPengurusanProgramBinaanAtlet->search($queryPar);
        
        $searchModelPengurusanProgramBinaanJurulatih = new PengurusanProgramBinaanJurulatihSearch();
        $dataProviderPengurusanProgramBinaanJurulatih = $searchModelPengurusanProgramBinaanJurulatih->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            AtletPembangunanKursuskem::deleteAll(['pengurusan_program_binaan_id' => $model->pengurusan_program_binaan_id]);
            
            // update atlet profil Kem/Kursus
            /*$modelAtlets = PengurusanProgramBinaanAtlet::findAll([
                    'pengurusan_program_binaan_id' => $model->pengurusan_program_binaan_id,
                ]);
            
            foreach($modelAtlets as $modelAtlet){
                $modelAtletKursusKem = null;
                if (($modelAtletKursusKem = AtletPembangunanKursuskem::find()->where(['atlet_id'=>$modelAtlet->atlet_id])->andWhere(['pengurusan_program_binaan_id'=>$modelAtlet->pengurusan_program_binaan_id])->one()) == null) {
                    $modelAtletKursusKem = new AtletPembangunanKursuskem();
                }
                $modelAtletKursusKem->atlet_id = $modelAtlet->atlet_id;
                $modelAtletKursusKem->tarikh_mula = $model->tarikh_mula;
                $modelAtletKursusKem->tarikh_tamat = $model->tarikh_tamat;
                $modelAtletKursusKem->lokasi = $model->tempat;
                $modelAtletKursusKem->nama_kursus_kem = $model->nama_aktiviti;
                $modelAtletKursusKem->pengurusan_program_binaan_id = $model->pengurusan_program_binaan_id;
                $modelAtletKursusKem->save();
            }*/
            
            return $this->redirect(['view', 'id' => $model->pengurusan_program_binaan_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'searchModelProgramBinaanKos' => $searchModelProgramBinaanKos,
                'dataProviderProgramBinaanKos' => $dataProviderProgramBinaanKos,
                'searchModelProgramBinaanPeserta' => $searchModelProgramBinaanPeserta,
                'dataProviderProgramBinaanPeserta' => $dataProviderProgramBinaanPeserta,
                'searchModelPengurusanProgramBinaanAtlet' => $searchModelPengurusanProgramBinaanAtlet,
                'dataProviderPengurusanProgramBinaanAtlet' => $dataProviderPengurusanProgramBinaanAtlet,
                'searchModelPengurusanProgramBinaanJurulatih' => $searchModelPengurusanProgramBinaanJurulatih,
                'dataProviderPengurusanProgramBinaanJurulatih' => $dataProviderPengurusanProgramBinaanJurulatih,
                'readonly' => false,
            ]);
        }
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
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-laporan-senarai-penganjuran-program-binaan'
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'format' => $model->format
                ]);
            }
        } 

        return $this->render('laporan_senarai_penganjuran_program_binaan', [
            'model' => $model,
            'readonly' => false,
        ]);
    }
    
    public function actionGenerateLaporanSenaraiPenganjuranProgramBinaan($tarikh_dari, $tarikh_hingga, $format)
    {
        if($tarikh_dari == "") $tarikh_dari = array();
        else $tarikh_dari = array($tarikh_dari);
        
        if($tarikh_hingga == "") $tarikh_hingga = array();
        else $tarikh_hingga = array($tarikh_hingga);
        
        $controls = array(
            'FROM_DATE' => $tarikh_dari,
            'TO_DATE' => $tarikh_hingga,
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
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-laporan-statistik-program-binaan-mengikut-negeri'
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'format' => $model->format
                ]);
            }
        } 

        return $this->render('laporan_statistik_program_binaan_mengikut_negeri', [
            'model' => $model,
            'readonly' => false,
        ]);
    }
    
    public function actionGenerateLaporanStatistikProgramBinaanMengikutNegeri($tarikh_dari, $tarikh_hingga, $format)
    {
        if($tarikh_dari == "") $tarikh_dari = array();
        else $tarikh_dari = array($tarikh_dari);
        
        if($tarikh_hingga == "") $tarikh_hingga = array();
        else $tarikh_hingga = array($tarikh_hingga);
        
        $controls = array(
            'FROM_DATE' => $tarikh_dari,
            'TO_DATE' => $tarikh_hingga,
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
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-laporan-statistik-program-binaan-mengikut-sukan'
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'format' => $model->format
                ]);
            }
        } 

        return $this->render('laporan_statistik_program_binaan_mengikut_sukan', [
            'model' => $model,
            'readonly' => false,
        ]);
    }
    
    public function actionGenerateLaporanStatistikProgramBinaanMengikutSukan($tarikh_dari, $tarikh_hingga, $format)
    {
        if($tarikh_dari == "") $tarikh_dari = array();
        else $tarikh_dari = array($tarikh_dari);
        
        if($tarikh_hingga == "") $tarikh_hingga = array();
        else $tarikh_hingga = array($tarikh_hingga);
        
        $controls = array(
            'FROM_DATE' => $tarikh_dari,
            'TO_DATE' => $tarikh_hingga,
        );
        
        GeneralFunction::generateReport('/spsb/MSN/LaporanStatistikProgramBinaanMengikutSukan', $format, $controls, 'laporan_statistik_program_binaan_mengikut_sukan');
    }
}
