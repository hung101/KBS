<?php

namespace frontend\controllers;

use Yii;
use app\models\PlTemujanjiFisioterapi;
use frontend\models\PlTemujanjiFisioterapiSearch;
use app\models\PlDiagnosisPreskripsiPemeriksaanFisioterapi;
use frontend\models\PlDiagnosisPreskripsiPemeriksaanFisioterapiSearch;
use app\models\IsnLaporanTemujanjiFisioterapi;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\helpers\BaseUrl;

use app\models\general\Upload;
use app\models\general\GeneralVariable;
use common\models\general\GeneralFunction;

// table reference
use app\models\Atlet;
use app\models\RefJenisTemujanjiFisioterapi;
use app\models\RefStatusTemujanjiFisioterapi;
use app\models\RefPegawaiPerubatanFisioterapi;
use app\models\RefNamaFisioterapi;
use app\models\RefKategoriPesakitLuar;
use app\models\RefTindakanSelanjutnyaFisioterapi;

/**
 * PlTemujanjiFisioterapiController implements the CRUD actions for PlTemujanjiFisioterapi model.
 */
class PlTemujanjiFisioterapiController extends Controller
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
     * Lists all PlTemujanjiFisioterapi models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $searchModel = new PlTemujanjiFisioterapiSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PlTemujanjiFisioterapi model.
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
        
        $ref = RefJenisTemujanjiFisioterapi::findOne(['id' => $model->makmal_perubatan]);
        $model->makmal_perubatan = $ref['desc'];
        
        $ref = RefStatusTemujanjiFisioterapi::findOne(['id' => $model->status_temujanji]);
        $model->status_temujanji = $ref['desc'];
        
        $ref = RefKategoriPesakitLuar::findOne(['id' => $model->kategori_pesakit_luar]);
        $model->kategori_pesakit_luar = $ref['desc'];
        
        $ref = RefTindakanSelanjutnyaFisioterapi::findOne(['id' => $model->tindakan_selanjutnya]);
        $model->tindakan_selanjutnya = $ref['desc'];
        
        $ref = RefNamaFisioterapi::findOne(['id' => $model->nama_fisioterapi]);
        $model->nama_fisioterapi = $ref['desc'];
        
        $ref = RefPegawaiPerubatanFisioterapi::findOne(['id' => $model->pegawai_yang_bertanggungjawab]);
        $model->pegawai_yang_bertanggungjawab = $ref['desc'];
        
        $model->tarikh_temujanji = GeneralFunction::convert($model->tarikh_temujanji, GeneralFunction::TYPE_DATETIME);
        
        $queryPar = null;
        
        $queryPar['PlDiagnosisPreskripsiPemeriksaanFisioterapiSearch']['pl_temujanji_id'] = $id;
        
        $searchModelPlDiagnosisPreskripsiPemeriksaanFisioterapi  = new PlDiagnosisPreskripsiPemeriksaanFisioterapiSearch();
        $dataProviderPlDiagnosisPreskripsiPemeriksaanFisioterapi = $searchModelPlDiagnosisPreskripsiPemeriksaanFisioterapi->search($queryPar);
        
        return $this->render('view', [
            'model' => $model,
            'searchModelPlDiagnosisPreskripsiPemeriksaanFisioterapi' => $searchModelPlDiagnosisPreskripsiPemeriksaanFisioterapi,
            'dataProviderPlDiagnosisPreskripsiPemeriksaanFisioterapi' => $dataProviderPlDiagnosisPreskripsiPemeriksaanFisioterapi,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new PlTemujanjiFisioterapi model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new PlTemujanjiFisioterapi();
        
        $queryPar = null;
        
        Yii::$app->session->open();
        
        if(isset(Yii::$app->session->id)){
            $queryPar['PlDiagnosisPreskripsiPemeriksaanFisioterapiSearch']['session_id'] = Yii::$app->session->id;
        }
        
        $searchModelPlDiagnosisPreskripsiPemeriksaanFisioterapi  = new PlDiagnosisPreskripsiPemeriksaanFisioterapiSearch();
        $dataProviderPlDiagnosisPreskripsiPemeriksaanFisioterapi = $searchModelPlDiagnosisPreskripsiPemeriksaanFisioterapi->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if(isset(Yii::$app->session->id)){
                PlDiagnosisPreskripsiPemeriksaanFisioterapi::updateAll(['pl_temujanji_id' => $model->pl_temujanji_id], 'session_id = "'.Yii::$app->session->id.'"');
                PlDiagnosisPreskripsiPemeriksaanFisioterapi::updateAll(['session_id' => ''], 'pl_temujanji_id = "'.$model->pl_temujanji_id.'"');
            }
            
            $file = UploadedFile::getInstance($model, 'muat_naik');
            if($file){
                $model->muat_naik = Upload::uploadFile($file, Upload::plTemujanjiFisioterapiFolder, $model->pl_temujanji_id);
            }
            
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->pl_temujanji_id]);
            }
        } 
        
        return $this->render('create', [
                'model' => $model,
                'searchModelPlDiagnosisPreskripsiPemeriksaanFisioterapi' => $searchModelPlDiagnosisPreskripsiPemeriksaanFisioterapi,
                'dataProviderPlDiagnosisPreskripsiPemeriksaanFisioterapi' => $dataProviderPlDiagnosisPreskripsiPemeriksaanFisioterapi,
                'readonly' => false,
            ]);
    }

    /**
     * Updates an existing PlTemujanjiFisioterapi model.
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
        
        $queryPar['PlDiagnosisPreskripsiPemeriksaanFisioterapiSearch']['pl_temujanji_id'] = $id;
        
        $searchModelPlDiagnosisPreskripsiPemeriksaanFisioterapi  = new PlDiagnosisPreskripsiPemeriksaanFisioterapiSearch();
        $dataProviderPlDiagnosisPreskripsiPemeriksaanFisioterapi = $searchModelPlDiagnosisPreskripsiPemeriksaanFisioterapi->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $file = UploadedFile::getInstance($model, 'muat_naik');
            if($file){
                $model->muat_naik = Upload::uploadFile($file, Upload::plTemujanjiFisioterapiFolder, $model->pl_temujanji_id);
            }
            
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->pl_temujanji_id]);
            }
        } 
        
        return $this->render('update', [
                'model' => $model,
                'searchModelPlDiagnosisPreskripsiPemeriksaanFisioterapi' => $searchModelPlDiagnosisPreskripsiPemeriksaanFisioterapi,
                'dataProviderPlDiagnosisPreskripsiPemeriksaanFisioterapi' => $dataProviderPlDiagnosisPreskripsiPemeriksaanFisioterapi,
                'readonly' => false,
            ]);
    }

    /**
     * Deletes an existing PlTemujanjiFisioterapi model.
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
     * Finds the PlTemujanjiFisioterapi model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PlTemujanjiFisioterapi the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PlTemujanjiFisioterapi::findOne($id)) !== null) {
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
    
    public function actionLaporanTemujanjiFisioterapi()
    {

        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new IsnLaporanTemujanjiFisioterapi();
        $model->format = 'html';

        if ($model->load(Yii::$app->request->post())) {
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-laporan-temujanji-fisioterapi'
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'pegawai_bertanggungjawab' => $model->pegawai_bertanggungjawab
                    , 'sukan' => $model->sukan
                    , 'bahagian_kecederaan' => $model->bahagian_kecederaan
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-laporan-temujanji-fisioterapi'
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'pegawai_bertanggungjawab' => $model->pegawai_bertanggungjawab
                    , 'sukan' => $model->sukan
                    , 'bahagian_kecederaan' => $model->bahagian_kecederaan
                    , 'format' => $model->format
                ]);
            }
        } 

        return $this->render('laporan_temujanji_fisioterapi', [
            'model' => $model,
            'readonly' => false,
        ]);
    }

    public function actionGenerateLaporanTemujanjiFisioterapi($tarikh_dari, $tarikh_hingga, $pegawai_bertanggungjawab, $sukan, $bahagian_kecederaan, $format)
    {
        if($tarikh_dari == "") $tarikh_dari = array();
        else $tarikh_dari = array($tarikh_dari);
        
        if($tarikh_hingga == "") $tarikh_hingga = array();
        else $tarikh_hingga = array($tarikh_hingga);
        
        if($pegawai_bertanggungjawab == "") $pegawai_bertanggungjawab = array();
        else $pegawai_bertanggungjawab = array($pegawai_bertanggungjawab);
        
        if($sukan == "") $sukan = array();
        else $sukan = array($sukan);
        
        if($bahagian_kecederaan == "") $bahagian_kecederaan = array();
        else $bahagian_kecederaan = array($bahagian_kecederaan);
        
        $controls = array(
            'FROM_DATE' => $tarikh_dari,
            'TO_DATE' => $tarikh_hingga,
            'PEGAWAI' => $pegawai_bertanggungjawab,
            'SUKAN' => $sukan,
            'KECEDERAAN' => $bahagian_kecederaan,
        );
        
        GeneralFunction::generateReport('/spsb/ISN/LaporanTemujanjiFisioterapi', $format, $controls, 'laporan_temujanji_fisioterapi');
    }
}
