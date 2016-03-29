<?php

namespace frontend\controllers;

use Yii;
use app\models\FarmasiPermohonanLiputanPerubatanSukan;
use frontend\models\FarmasiPermohonanLiputanPerubatanSukanSearch;
use app\models\IsnLaporanRingkasanStatistik;
use app\models\IsnLaporanRingkasanStatistikBulanan;
use app\models\IsnLaporanBulananSecaraDetail;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\helpers\BaseUrl;

// table reference
use app\models\RefKategoriProgramLiputanPerubatanSukan;
use common\models\general\GeneralFunction;

use app\models\general\Upload;
use app\models\general\GeneralVariable;
use app\models\general\GeneralLabel;

/**
 * FarmasiPermohonanLiputanPerubatanSukanController implements the CRUD actions for FarmasiPermohonanLiputanPerubatanSukan model.
 */
class FarmasiPermohonanLiputanPerubatanSukanController extends Controller
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
     * Lists all FarmasiPermohonanLiputanPerubatanSukan models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $searchModel = new FarmasiPermohonanLiputanPerubatanSukanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single FarmasiPermohonanLiputanPerubatanSukan model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = $this->findModel($id);
        
        $model->kelulusan_ceo = GeneralLabel::getYesNoLabel($model->kelulusan_ceo);
        
        $model->kelulusan_pbu = GeneralLabel::getYesNoLabel($model->kelulusan_pbu);
        
        $ref = RefKategoriProgramLiputanPerubatanSukan::findOne(['id' => $model->kategori_program]);
        $model->kategori_program = $ref['desc'];
        
        $model->tarikh_program = GeneralFunction::convert($model->tarikh_program);
        
        return $this->render('view', [
            'model' => $model,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new FarmasiPermohonanLiputanPerubatanSukan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new FarmasiPermohonanLiputanPerubatanSukan();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $upload = new Upload();
            $file = UploadedFile::getInstance($model, 'muat_naik');
            if($file){
                $model->muat_naik = $upload->uploadFile($file, Upload::farmasiPermohonanLiputanPerubatanSukanFolder, $model->permohonan_liputan_perubatan_sukan_id, "");
            }
            
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->permohonan_liputan_perubatan_sukan_id]);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Updates an existing FarmasiPermohonanLiputanPerubatanSukan model.
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

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $upload = new Upload();
            $file = UploadedFile::getInstance($model, 'muat_naik');
            if($file){
                $model->muat_naik = $upload->uploadFile($file, Upload::farmasiPermohonanLiputanPerubatanSukanFolder, $model->permohonan_liputan_perubatan_sukan_id, "");
            }
            
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->permohonan_liputan_perubatan_sukan_id]);
            }
        } else {
            return $this->render('update', [
                'model' => $model,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Deletes an existing FarmasiPermohonanLiputanPerubatanSukan model.
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
     * Finds the FarmasiPermohonanLiputanPerubatanSukan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return FarmasiPermohonanLiputanPerubatanSukan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = FarmasiPermohonanLiputanPerubatanSukan::findOne($id)) !== null) {
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
    
    public function actionLaporanRingkasanStatistik()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new IsnLaporanRingkasanStatistik();
        $model->format = 'html';

        if ($model->load(Yii::$app->request->post())) {
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-laporan-ringkasan-statistik'
                    , 'tahun' => $model->tahun
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-laporan-ringkasan-statistik'
                    , 'tahun' => $model->tahun
                    , 'format' => $model->format
                ]);
            }
        } 

        return $this->render('laporan_ringkasan_statistik', [
            'model' => $model,
            'readonly' => false,
        ]);
    }
    
    public function actionGenerateLaporanRingkasanStatistik($tahun, $format)
    {
        if($tahun == "") $tahun = array();
        else $tahun = array($tahun);
        
        $controls = array(
            'YEAR' => $tahun,
        );
        
        GeneralFunction::generateReport('/spsb/ISN/LaporanLiputanPerubatanSukanRingkasanStatistik', $format, $controls, 'laporan_ringkasan_statistik');
    }
    
    public function actionLaporanRingkasanStatistikBulanan()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new IsnLaporanRingkasanStatistikBulanan();
        $model->format = 'html';

        if ($model->load(Yii::$app->request->post())) {
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-laporan-ringkasan-statistik-bulanan'
                    , 'tahun' => $model->tahun
                    , 'kategori_program_id' => $model->kategori_program_id
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-laporan-ringkasan-statistik-bulanan'
                    , 'tahun' => $model->tahun
                    , 'kategori_program_id' => $model->kategori_program_id
                    , 'format' => $model->format
                ]);
            }
        } 

        return $this->render('laporan_ringkasan_statistik_bulanan', [
            'model' => $model,
            'readonly' => false,
        ]);
    }
    
    public function actionGenerateLaporanRingkasanStatistikBulanan($tahun, $kategori_program_id, $format)
    {
        if($tahun == "") $tahun = array();
        else $tahun = array($tahun);
        
        if($kategori_program_id == "") $kategori_program_id = array();
        else $kategori_program_id = array($kategori_program_id);
        
        $controls = array(
            'YEAR' => $tahun,
            'KATEGORI_PROGRAM' => $kategori_program_id,
        );
        
        GeneralFunction::generateReport('/spsb/ISN/LaporanLiputanPerubatanSukanRingkasanStatistikBulanan', $format, $controls, 'laporan_ringkasan_statistik_bulanan');
    }
    
    public function actionLaporanBulananSecaraDetail()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new IsnLaporanBulananSecaraDetail();
        $model->format = 'html';

        if ($model->load(Yii::$app->request->post())) {
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-laporan-bulanan-secara-detail'
                    , 'tahun' => $model->tahun
                    , 'kategori_program_id' => $model->kategori_program_id
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-laporan-bulanan-secara-detail'
                    , 'tahun' => $model->tahun
                    , 'kategori_program_id' => $model->kategori_program_id
                    , 'format' => $model->format
                ]);
            }
        } 

        return $this->render('laporan_bulanan_secara_detail', [
            'model' => $model,
            'readonly' => false,
        ]);
    }
    
    public function actionGenerateLaporanBulananSecaraDetail($tahun, $kategori_program_id, $format)
    {
        if($tahun == "") $tahun = array();
        else $tahun = array($tahun);
        
        if($kategori_program_id == "") $kategori_program_id = array();
        else $kategori_program_id = array($kategori_program_id);
        
        $controls = array(
            'YEAR' => $tahun,
            'KATEGORI_PROGRAM' => $kategori_program_id,
        );
        
        GeneralFunction::generateReport('/spsb/ISN/LaporanLiputanPerubatanSukanBulananSecaraDetail', $format, $controls, 'laporan_bulanan_secara_detail');
    }
}
