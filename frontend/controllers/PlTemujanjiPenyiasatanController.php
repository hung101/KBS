<?php

namespace frontend\controllers;

use Yii;
use app\models\PlTemujanjiPenyiasatan;
use frontend\models\PlTemujanjiPenyiasatanSearch;
use app\models\PlDiagnosisPreskripsiPemeriksaanPenyiasatan;
use frontend\models\PlDiagnosisPreskripsiPemeriksaanPenyiasatanSearch;
use app\models\IsnLaporanTemujanjiKedatanganPesakit;
use app\models\IsnLaporanTemujanjiKedatanganPegawai;
use app\models\IsnLaporanTemujanjiPenyiasatan;
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

/**
 * PlTemujanjiPenyiasatanController implements the CRUD actions for PlTemujanjiPenyiasatan model.
 */
class PlTemujanjiPenyiasatanController extends Controller
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
     * Lists all PlTemujanjiPenyiasatan models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $searchModel = new PlTemujanjiPenyiasatanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PlTemujanjiPenyiasatan model.
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
        
        $ref = RefAtletTahap::findOne(['id' => $model->kategori_atlet]);
        $model->kategori_atlet = $ref['desc'];
        
        $ref = RefSukan::findOne(['id' => $model->jenis_sukan]);
        $model->jenis_sukan = $ref['desc'];
        
        $model->kehadiran_pesakit = GeneralLabel::getYesNoLabel($model->kehadiran_pesakit);
        
        $model->kehadiran_pegawai_bertanggungjawab = GeneralLabel::getYesNoLabel($model->kehadiran_pegawai_bertanggungjawab);
        
        $model->tarikh_temujanji = GeneralFunction::convert($model->tarikh_temujanji, GeneralFunction::TYPE_DATETIME);
        
        $queryPar = null;
        
        $queryPar['PlDiagnosisPreskripsiPemeriksaanPenyiasatanSearch']['pl_temujanji_id'] = $id;
        
        $searchModelPlDiagnosisPreskripsiPemeriksaanPenyiasatan  = new PlDiagnosisPreskripsiPemeriksaanPenyiasatanSearch();
        $dataProviderPlDiagnosisPreskripsiPemeriksaanPenyiasatan = $searchModelPlDiagnosisPreskripsiPemeriksaanPenyiasatan->search($queryPar);
        
        return $this->render('view', [
            'model' => $model,
            'searchModelPlDiagnosisPreskripsiPemeriksaanPenyiasatan' => $searchModelPlDiagnosisPreskripsiPemeriksaanPenyiasatan,
            'dataProviderPlDiagnosisPreskripsiPemeriksaanPenyiasatan' => $dataProviderPlDiagnosisPreskripsiPemeriksaanPenyiasatan,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new PlTemujanjiPenyiasatan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new PlTemujanjiPenyiasatan();
        
        $queryPar = null;
        
        Yii::$app->session->open();
        
        if(isset(Yii::$app->session->id)){
            $queryPar['PlDiagnosisPreskripsiPemeriksaanPenyiasatanSearch']['session_id'] = Yii::$app->session->id;
        }
        
        $searchModelPlDiagnosisPreskripsiPemeriksaanPenyiasatan  = new PlDiagnosisPreskripsiPemeriksaanPenyiasatanSearch();
        $dataProviderPlDiagnosisPreskripsiPemeriksaanPenyiasatan = $searchModelPlDiagnosisPreskripsiPemeriksaanPenyiasatan->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if(isset(Yii::$app->session->id)){
                PlDiagnosisPreskripsiPemeriksaanPenyiasatan::updateAll(['pl_temujanji_id' => $model->pl_temujanji_id], 'session_id = "'.Yii::$app->session->id.'"');
                PlDiagnosisPreskripsiPemeriksaanPenyiasatan::updateAll(['session_id' => ''], 'pl_temujanji_id = "'.$model->pl_temujanji_id.'"');
            }
            
            return $this->redirect(['view', 'id' => $model->pl_temujanji_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'searchModelPlDiagnosisPreskripsiPemeriksaanPenyiasatan' => $searchModelPlDiagnosisPreskripsiPemeriksaanPenyiasatan,
                'dataProviderPlDiagnosisPreskripsiPemeriksaanPenyiasatan' => $dataProviderPlDiagnosisPreskripsiPemeriksaanPenyiasatan,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Updates an existing PlTemujanjiPenyiasatan model.
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
        
        $queryPar['PlDiagnosisPreskripsiPemeriksaanPenyiasatanSearch']['pl_temujanji_id'] = $id;
        
        $searchModelPlDiagnosisPreskripsiPemeriksaanPenyiasatan  = new PlDiagnosisPreskripsiPemeriksaanPenyiasatanSearch();
        $dataProviderPlDiagnosisPreskripsiPemeriksaanPenyiasatan = $searchModelPlDiagnosisPreskripsiPemeriksaanPenyiasatan->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->pl_temujanji_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'searchModelPlDiagnosisPreskripsiPemeriksaanPenyiasatan' => $searchModelPlDiagnosisPreskripsiPemeriksaanPenyiasatan,
                'dataProviderPlDiagnosisPreskripsiPemeriksaanPenyiasatan' => $dataProviderPlDiagnosisPreskripsiPemeriksaanPenyiasatan,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Deletes an existing PlTemujanjiPenyiasatan model.
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
     * Finds the PlTemujanjiPenyiasatan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PlTemujanjiPenyiasatan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PlTemujanjiPenyiasatan::findOne($id)) !== null) {
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
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-laporan-temujanji-kedatangan-pesakit'
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'format' => $model->format
                ]);
            }
        } 

        return $this->render('laporan_temujanji_kedatangan_pesakit', [
            'model' => $model,
            'readonly' => false,
        ]);
    }

    public function actionGenerateLaporanTemujanjiKedatanganPesakit($tarikh_dari, $tarikh_hingga, $format)
    {
        if($tarikh_dari == "") $tarikh_dari = array();
        else $tarikh_dari = array($tarikh_dari);
        
        if($tarikh_hingga == "") $tarikh_hingga = array();
        else $tarikh_hingga = array($tarikh_hingga);
        
        $controls = array(
            'FROM_DATE' => $tarikh_dari,
            'TO_DATE' => $tarikh_hingga,
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
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-laporan-temujanji-kedatangan-pegawai'
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'format' => $model->format
                ]);
            }
        } 

        return $this->render('laporan_temujanji_kedatangan_pegawai', [
            'model' => $model,
            'readonly' => false,
        ]);
    }

    public function actionGenerateLaporanTemujanjiKedatanganPegawai($tarikh_dari, $tarikh_hingga, $format)
    {
        if($tarikh_dari == "") $tarikh_dari = array();
        else $tarikh_dari = array($tarikh_dari);
        
        if($tarikh_hingga == "") $tarikh_hingga = array();
        else $tarikh_hingga = array($tarikh_hingga);
        
        $controls = array(
            'FROM_DATE' => $tarikh_dari,
            'TO_DATE' => $tarikh_hingga,
        );
        
        GeneralFunction::generateReport('/spsb/ISN/LaporanTemujanjiKedatanganPegawai', $format, $controls, 'laporan_temujanji_kedatangan_pegawai');
    }
    
    public function actionLaporanTemujanjiPenyiasatan()
    {

        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new IsnLaporanTemujanjiPenyiasatan();
        $model->format = 'html';

        if ($model->load(Yii::$app->request->post())) {
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-laporan-temujanji-penyiasatan'
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'pegawai_bertanggungjawab' => $model->pegawai_bertanggungjawab
                    , 'sukan' => $model->sukan
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-laporan-temujanji-penyiasatan'
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'pegawai_bertanggungjawab' => $model->pegawai_bertanggungjawab
                    , 'sukan' => $model->sukan
                    , 'format' => $model->format
                ]);
            }
        } 

        return $this->render('laporan_temujanji_penyiasatan', [
            'model' => $model,
            'readonly' => false,
        ]);
    }

    public function actionGenerateLaporanTemujanjiPenyiasatan($tarikh_dari, $tarikh_hingga, $pegawai_bertanggungjawab, $sukan, $format)
    {
        if($tarikh_dari == "") $tarikh_dari = array();
        else $tarikh_dari = array($tarikh_dari);
        
        if($tarikh_hingga == "") $tarikh_hingga = array();
        else $tarikh_hingga = array($tarikh_hingga);
        
        if($pegawai_bertanggungjawab == "") $pegawai_bertanggungjawab = array();
        else $pegawai_bertanggungjawab = array($pegawai_bertanggungjawab);
        
        if($sukan == "") $sukan = array();
        else $sukan = array($sukan);
        
        $controls = array(
            'FROM_DATE' => $tarikh_dari,
            'TO_DATE' => $tarikh_hingga,
            'PEGAWAI' => $pegawai_bertanggungjawab,
            'SUKAN' => $sukan,
        );
        
        GeneralFunction::generateReport('/spsb/ISN/LaporanTemujanjiPenyiasatan', $format, $controls, 'laporan_temujanji_penyiasatan');
    }
}
