<?php

namespace frontend\controllers;

use Yii;
use app\models\PlTemujanji;
use frontend\models\PlTemujanjiSearch;
use app\models\PlDiagnosisPreskripsiPemeriksaan;
use frontend\models\PlDiagnosisPreskripsiPemeriksaanSearch;
use app\models\IsnLaporanTemujanjiKedatanganPesakit;
use app\models\IsnLaporanTemujanjiKedatanganPegawai;
use app\models\IsnLaporanTemujanjiMengikutSukan;
use app\models\IsnLaporanTemujanjiMengikutStatus;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\BaseUrl;

use app\models\general\GeneralVariable;
use common\models\general\GeneralFunction;
use app\models\general\GeneralLabel;

// table reference
use app\models\Atlet;
use app\models\RefJenisTemujanjiPesakitLuar;
use app\models\RefStatusTemujanjiPesakitLuar;
use app\models\RefPegawaiPerubatan;
use app\models\RefAtletTahap;
use app\models\RefSukan;
use app\models\RefProgramSemasaSukanAtlet;

/**
 * PlTemujanjiController implements the CRUD actions for PlTemujanji model.
 */
class PlTemujanjiController extends Controller
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
     * Lists all PlTemujanji models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $searchModel = new PlTemujanjiSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PlTemujanji model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = $this->findModel($id);
        
        $ref = Atlet::findOne(['atlet_id' => $model->atlet_id]);
        $model->atlet_id = $ref['nameAndIC'];
        
        $ref = RefJenisTemujanjiPesakitLuar::findOne(['id' => $model->makmal_perubatan]);
        $model->makmal_perubatan = $ref['desc'];
        
        $ref = RefStatusTemujanjiPesakitLuar::findOne(['id' => $model->status_temujanji]);
        $model->status_temujanji = $ref['desc'];
        
        $ref = RefPegawaiPerubatan::findOne(['id' => $model->pegawai_yang_bertanggungjawab]);
        $model->pegawai_yang_bertanggungjawab = $ref['desc'];
        
        $ref = RefProgramSemasaSukanAtlet::findOne(['id' => $model->kategori_atlet]);
        $model->kategori_atlet = $ref['desc'];
        
        $ref = RefSukan::findOne(['id' => $model->jenis_sukan]);
        $model->jenis_sukan = $ref['desc'];
        
        $model->kehadiran_pesakit = GeneralLabel::getYesNoLabel($model->kehadiran_pesakit);
        
        $model->kehadiran_pegawai_bertanggungjawab = GeneralLabel::getYesNoLabel($model->kehadiran_pegawai_bertanggungjawab);
        
        $model->tarikh_temujanji = GeneralFunction::convert($model->tarikh_temujanji, GeneralFunction::TYPE_DATETIME);
        
        $model->masa_pendaftaran = GeneralFunction::convert($model->masa_pendaftaran, GeneralFunction::TYPE_DATETIME);
        
        $model->masa_rawatan = GeneralFunction::convert($model->masa_rawatan, GeneralFunction::TYPE_DATETIME);
        
        $model->masa_selesai = GeneralFunction::convert($model->masa_selesai, GeneralFunction::TYPE_DATETIME);
        
        $queryPar = null;
        
        $queryPar['PlDiagnosisPreskripsiPemeriksaanSearch']['pl_temujanji_id'] = $id;
        
        $searchModelPlDiagnosisPreskripsiPemeriksaan  = new PlDiagnosisPreskripsiPemeriksaanSearch();
        $dataProviderPlDiagnosisPreskripsiPemeriksaan = $searchModelPlDiagnosisPreskripsiPemeriksaan->search($queryPar);
        
        return $this->render('view', [
            'model' => $model,
            'searchModelPlDiagnosisPreskripsiPemeriksaan' => $searchModelPlDiagnosisPreskripsiPemeriksaan,
            'dataProviderPlDiagnosisPreskripsiPemeriksaan' => $dataProviderPlDiagnosisPreskripsiPemeriksaan,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new PlTemujanji model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new PlTemujanji();
        
        $queryPar = null;
        
        Yii::$app->session->open();
        
        if(isset(Yii::$app->session->id)){
            $queryPar['PlDiagnosisPreskripsiPemeriksaanSearch']['session_id'] = Yii::$app->session->id;
        }
        
        $searchModelPlDiagnosisPreskripsiPemeriksaan  = new PlDiagnosisPreskripsiPemeriksaanSearch();
        $dataProviderPlDiagnosisPreskripsiPemeriksaan = $searchModelPlDiagnosisPreskripsiPemeriksaan->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if(isset(Yii::$app->session->id)){
                PlDiagnosisPreskripsiPemeriksaan::updateAll(['pl_temujanji_id' => $model->pl_temujanji_id], 'session_id = "'.Yii::$app->session->id.'"');
                PlDiagnosisPreskripsiPemeriksaan::updateAll(['session_id' => ''], 'pl_temujanji_id = "'.$model->pl_temujanji_id.'"');
            }
            
            return $this->redirect(['view', 'id' => $model->pl_temujanji_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'searchModelPlDiagnosisPreskripsiPemeriksaan' => $searchModelPlDiagnosisPreskripsiPemeriksaan,
                'dataProviderPlDiagnosisPreskripsiPemeriksaan' => $dataProviderPlDiagnosisPreskripsiPemeriksaan,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Updates an existing PlTemujanji model.
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
        
        $queryPar['PlDiagnosisPreskripsiPemeriksaanSearch']['pl_temujanji_id'] = $id;
        
        $searchModelPlDiagnosisPreskripsiPemeriksaan  = new PlDiagnosisPreskripsiPemeriksaanSearch();
        $dataProviderPlDiagnosisPreskripsiPemeriksaan = $searchModelPlDiagnosisPreskripsiPemeriksaan->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->pl_temujanji_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'searchModelPlDiagnosisPreskripsiPemeriksaan' => $searchModelPlDiagnosisPreskripsiPemeriksaan,
                'dataProviderPlDiagnosisPreskripsiPemeriksaan' => $dataProviderPlDiagnosisPreskripsiPemeriksaan,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Deletes an existing PlTemujanji model.
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
     * Finds the PlTemujanji model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PlTemujanji the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PlTemujanji::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionLaporanTemujanjiKedatanganPesakit()
    {

        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new IsnLaporanTemujanjiKedatanganPesakit();
        $model->format = 'html';

        if ($model->load(Yii::$app->request->post())) {
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-laporan-temujanji-kedatangan-pesakit'
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'status' => $model->status
                    , 'sukan' => $model->sukan
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-laporan-temujanji-kedatangan-pesakit'
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'status' => $model->status
                    , 'sukan' => $model->sukan
                    , 'format' => $model->format
                ]);
            }
        } 

        return $this->render('laporan_temujanji_kedatangan_pesakit', [
            'model' => $model,
            'readonly' => false,
        ]);
    }

    public function actionGenerateLaporanTemujanjiKedatanganPesakit($tarikh_dari, $tarikh_hingga, $status, $sukan, $format)
    {
        if($tarikh_dari == "") $tarikh_dari = array();
        else $tarikh_dari = array($tarikh_dari);
        
        if($tarikh_hingga == "") $tarikh_hingga = array();
        else $tarikh_hingga = array($tarikh_hingga);
        
        if($status == "") $status = array();
        else $status = array($status);
        
        if($sukan == "") $sukan = array();
        else $sukan = array($sukan);
        
        $controls = array(
            'FROM_DATE' => $tarikh_dari,
            'TO_DATE' => $tarikh_hingga,
            'STATUS' => $status,
            'SUKAN' => $sukan,
        );
        
        GeneralFunction::generateReport('/spsb/ISN/LaporanTemujanjiKedatanganPesakit', $format, $controls, 'laporan_temujanji_kedatangan_pesakit');
    }
    
    public function actionLaporanTemujanjiKedatanganPegawai()
    {

        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new IsnLaporanTemujanjiKedatanganPegawai();
        $model->format = 'html';

        if ($model->load(Yii::$app->request->post())) {
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-laporan-temujanji-kedatangan-pegawai'
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'status' => $model->status
                    , 'sukan' => $model->sukan
                        , 'pegawai' => $model->pegawai
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-laporan-temujanji-kedatangan-pegawai'
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'status' => $model->status
                    , 'sukan' => $model->sukan
                        , 'pegawai' => $model->pegawai
                    , 'format' => $model->format
                ]);
            }
        } 

        return $this->render('laporan_temujanji_kedatangan_pegawai', [
            'model' => $model,
            'readonly' => false,
        ]);
    }

    public function actionGenerateLaporanTemujanjiKedatanganPegawai($tarikh_dari, $tarikh_hingga, $status, $sukan, $pegawai, $format)
    {
        if($tarikh_dari == "") $tarikh_dari = array();
        else $tarikh_dari = array($tarikh_dari);
        
        if($tarikh_hingga == "") $tarikh_hingga = array();
        else $tarikh_hingga = array($tarikh_hingga);
        
        if($status == "") $status = array();
        else $status = array($status);
        
        if($sukan == "") $sukan = array();
        else $sukan = array($sukan);
        
        if($pegawai == "") $pegawai = array();
        else $pegawai = array($pegawai);
        
        $controls = array(
            'FROM_DATE' => $tarikh_dari,
            'TO_DATE' => $tarikh_hingga,
            'STATUS' => $status,
            'SUKAN' => $sukan,
            'NAMA_PEGAWAI' => $pegawai,
        );
        
        GeneralFunction::generateReport('/spsb/ISN/LaporanTemujanji', $format, $controls, 'laporan_temujanji_kedatangan_pegawai');
    }
    
    public function actionLaporanTemujanjiMengikutSukan()
    {

        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new IsnLaporanTemujanjiMengikutSukan();
        $model->format = 'html';

        if ($model->load(Yii::$app->request->post())) {
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-laporan-temujanji-mengikut-sukan'
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'status' => $model->status
                    , 'sukan' => $model->sukan
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-laporan-temujanji-mengikut-sukan'
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'status' => $model->status
                    , 'sukan' => $model->sukan
                    , 'format' => $model->format
                ]);
            }
        } 

        return $this->render('laporan_temujanji_mengikut_sukan', [
            'model' => $model,
            'readonly' => false,
        ]);
    }

    public function actionGenerateLaporanTemujanjiMengikutSukan($tarikh_dari, $tarikh_hingga, $status, $sukan, $format)
    {
        if($tarikh_dari == "") $tarikh_dari = array();
        else $tarikh_dari = array($tarikh_dari);
        
        if($tarikh_hingga == "") $tarikh_hingga = array();
        else $tarikh_hingga = array($tarikh_hingga);
        
        if($status == "") $status = array();
        else $status = array($status);
        
        if($sukan == "") $sukan = array();
        else $sukan = array($sukan);
        
        $controls = array(
            'FROM_DATE' => $tarikh_dari,
            'TO_DATE' => $tarikh_hingga,
            'STATUS' => $status,
            'SUKAN' => $sukan,
        );
        
        GeneralFunction::generateReport('/spsb/ISN/LaporanTemujanjiMengikutSukan', $format, $controls, 'laporan_temujanji_mengikut_sukan');
    }
    
    public function actionLaporanTemujanjiMengikutStatus()
    {

        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new IsnLaporanTemujanjiMengikutStatus();
        $model->format = 'html';

        if ($model->load(Yii::$app->request->post())) {
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-laporan-temujanji-mengikut-status'
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'status' => $model->status
                    , 'sukan' => $model->sukan
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-laporan-temujanji-mengikut-status'
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'status' => $model->status
                    , 'sukan' => $model->sukan
                    , 'format' => $model->format
                ]);
            }
        } 

        return $this->render('laporan_temujanji_mengikut_status', [
            'model' => $model,
            'readonly' => false,
        ]);
    }

    public function actionGenerateLaporanTemujanjiMengikutStatus($tarikh_dari, $tarikh_hingga, $status, $sukan, $format)
    {
        if($tarikh_dari == "") $tarikh_dari = array();
        else $tarikh_dari = array($tarikh_dari);
        
        if($tarikh_hingga == "") $tarikh_hingga = array();
        else $tarikh_hingga = array($tarikh_hingga);
        
        if($status == "") $status = array();
        else $status = array($status);
        
        if($sukan == "") $sukan = array();
        else $sukan = array($sukan);
        
        $controls = array(
            'FROM_DATE' => $tarikh_dari,
            'TO_DATE' => $tarikh_hingga,
            'STATUS' => $status,
            'SUKAN' => $sukan,
        );
        
        GeneralFunction::generateReport('/spsb/ISN/LaporanTemujanjiMengikutStatus', $format, $controls, 'laporan_temujanji_mengikut_status');
    }
}
