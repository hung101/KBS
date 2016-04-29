<?php

namespace frontend\controllers;

use Yii;
use app\models\PlTemujanjiMakmalPerubatan;
use frontend\models\PlTemujanjiMakmalPerubatanSearch;
use app\models\PlDiagnosisPreskripsiPemeriksaanMakmalPerubatan;
use frontend\models\PlDiagnosisPreskripsiPemeriksaanMakmalPerubatanSearch;
use app\models\IsnLaporanTemujanjiKedatanganPesakit;
use app\models\IsnLaporanTemujanjiKedatanganPegawai;
use app\models\IsnLaporanTemujanjiMakmalPerubatan;
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
 * PlTemujanjiMakmalPerubatanController implements the CRUD actions for PlTemujanjiMakmalPerubatan model.
 */
class PlTemujanjiMakmalPerubatanController extends Controller
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
     * Lists all PlTemujanjiMakmalPerubatan models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $searchModel = new PlTemujanjiMakmalPerubatanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PlTemujanjiMakmalPerubatan model.
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
        
        $queryPar['PlDiagnosisPreskripsiPemeriksaanMakmalPerubatanSearch']['pl_temujanji_id'] = $id;
        
        $searchModelPlDiagnosisPreskripsiPemeriksaanMakmalPerubatan  = new PlDiagnosisPreskripsiPemeriksaanMakmalPerubatanSearch();
        $dataProviderPlDiagnosisPreskripsiPemeriksaanMakmalPerubatan = $searchModelPlDiagnosisPreskripsiPemeriksaanMakmalPerubatan->search($queryPar);
        
        return $this->render('view', [
            'model' => $model,
            'searchModelPlDiagnosisPreskripsiPemeriksaanMakmalPerubatan' => $searchModelPlDiagnosisPreskripsiPemeriksaanMakmalPerubatan,
            'dataProviderPlDiagnosisPreskripsiPemeriksaanMakmalPerubatan' => $dataProviderPlDiagnosisPreskripsiPemeriksaanMakmalPerubatan,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new PlTemujanjiMakmalPerubatan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new PlTemujanjiMakmalPerubatan();
        
        $queryPar = null;
        
        Yii::$app->session->open();
        
        if(isset(Yii::$app->session->id)){
            $queryPar['PlDiagnosisPreskripsiPemeriksaanMakmalPerubatanSearch']['session_id'] = Yii::$app->session->id;
        }
        
        $searchModelPlDiagnosisPreskripsiPemeriksaanMakmalPerubatan  = new PlDiagnosisPreskripsiPemeriksaanMakmalPerubatanSearch();
        $dataProviderPlDiagnosisPreskripsiPemeriksaanMakmalPerubatan = $searchModelPlDiagnosisPreskripsiPemeriksaanMakmalPerubatan->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if(isset(Yii::$app->session->id)){
                PlDiagnosisPreskripsiPemeriksaanMakmalPerubatan::updateAll(['pl_temujanji_id' => $model->pl_temujanji_id], 'session_id = "'.Yii::$app->session->id.'"');
                PlDiagnosisPreskripsiPemeriksaanMakmalPerubatan::updateAll(['session_id' => ''], 'pl_temujanji_id = "'.$model->pl_temujanji_id.'"');
            }
            
            return $this->redirect(['view', 'id' => $model->pl_temujanji_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'searchModelPlDiagnosisPreskripsiPemeriksaanMakmalPerubatan' => $searchModelPlDiagnosisPreskripsiPemeriksaanMakmalPerubatan,
                'dataProviderPlDiagnosisPreskripsiPemeriksaanMakmalPerubatan' => $dataProviderPlDiagnosisPreskripsiPemeriksaanMakmalPerubatan,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Updates an existing PlTemujanjiMakmalPerubatan model.
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
        
        $queryPar['PlDiagnosisPreskripsiPemeriksaanMakmalPerubatanSearch']['pl_temujanji_id'] = $id;
        
        $searchModelPlDiagnosisPreskripsiPemeriksaanMakmalPerubatan  = new PlDiagnosisPreskripsiPemeriksaanMakmalPerubatanSearch();
        $dataProviderPlDiagnosisPreskripsiPemeriksaanMakmalPerubatan = $searchModelPlDiagnosisPreskripsiPemeriksaanMakmalPerubatan->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->pl_temujanji_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'searchModelPlDiagnosisPreskripsiPemeriksaanMakmalPerubatan' => $searchModelPlDiagnosisPreskripsiPemeriksaanMakmalPerubatan,
                'dataProviderPlDiagnosisPreskripsiPemeriksaanMakmalPerubatan' => $dataProviderPlDiagnosisPreskripsiPemeriksaanMakmalPerubatan,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Deletes an existing PlTemujanjiMakmalPerubatan model.
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
     * Finds the PlTemujanjiMakmalPerubatan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PlTemujanjiMakmalPerubatan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PlTemujanjiMakmalPerubatan::findOne($id)) !== null) {
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
    
    public function actionLaporanTemujanjiMakmalPerubatan()
    {

        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new IsnLaporanTemujanjiMakmalPerubatan();
        $model->format = 'html';

        if ($model->load(Yii::$app->request->post())) {
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-laporan-temujanji-makmal-perubatan'
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'pegawai_bertanggungjawab' => $model->pegawai_bertanggungjawab
                    , 'sukan' => $model->sukan
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-laporan-temujanji-makmal-perubatan'
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'pegawai_bertanggungjawab' => $model->pegawai_bertanggungjawab
                    , 'sukan' => $model->sukan
                    , 'format' => $model->format
                ]);
            }
        } 

        return $this->render('laporan_temujanji_makmal_perubatan', [
            'model' => $model,
            'readonly' => false,
        ]);
    }

    public function actionGenerateLaporanTemujanjiMakmalPerubatan($tarikh_dari, $tarikh_hingga, $pegawai_bertanggungjawab, $sukan, $format)
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
        
        GeneralFunction::generateReport('/spsb/ISN/LaporanTemujanjiMakmalPerubatan', $format, $controls, 'laporan_temujanji_makmal_perubatan');
    }
}
