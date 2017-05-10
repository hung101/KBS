<?php

namespace frontend\controllers;

use Yii;
use app\models\PermohonanProgramPendidikanKesihatan;
use frontend\models\PermohonanProgramPendidikanKesihatanSearch;
use app\models\IsnLaporanRingkasanStatistikProgramPendidikan;
use app\models\IsnLaporanBulananProgramPendidikan;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\helpers\BaseUrl;

use app\models\general\Upload;
use app\models\general\GeneralVariable;
use app\models\general\GeneralLabel;
use common\models\general\GeneralFunction;

/**
 * PermohonanProgramPendidikanKesihatanController implements the CRUD actions for PermohonanProgramPendidikanKesihatan model.
 */
class PermohonanProgramPendidikanKesihatanController extends Controller
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
     * Lists all PermohonanProgramPendidikanKesihatan models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $searchModel = new PermohonanProgramPendidikanKesihatanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PermohonanProgramPendidikanKesihatan model.
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
        
        return $this->render('view', [
            'model' => $model,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new PermohonanProgramPendidikanKesihatan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new PermohonanProgramPendidikanKesihatan();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $upload = new Upload();
            $file = UploadedFile::getInstance($model, 'muat_naik');
            if($file){
                $model->muat_naik = $upload->uploadFile($file, Upload::permohonanProgramPendidikanKesihatanFolder, $model->permohonan_program_pendidikan_kesihatan_id, "");
            }
            
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->permohonan_program_pendidikan_kesihatan_id]);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Updates an existing PermohonanProgramPendidikanKesihatan model.
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
                $model->muat_naik = $upload->uploadFile($file, Upload::permohonanProgramPendidikanKesihatanFolder, $model->permohonan_program_pendidikan_kesihatan_id, "");
            }
            
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->permohonan_program_pendidikan_kesihatan_id]);
            }
        } else {
            return $this->render('update', [
                'model' => $model,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Deletes an existing PermohonanProgramPendidikanKesihatan model.
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
     * Finds the PermohonanProgramPendidikanKesihatan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PermohonanProgramPendidikanKesihatan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PermohonanProgramPendidikanKesihatan::findOne($id)) !== null) {
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
    
    public function actionLaporanRingkasanStatistikProgramPendidikan()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new IsnLaporanRingkasanStatistikProgramPendidikan();
        $model->format = 'html';

        if ($model->load(Yii::$app->request->post())) {
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-laporan-ringkasan-statistik-program-pendidikan'
                    , 'tahun' => $model->tahun
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-laporan-ringkasan-statistik-program-pendidikan'
                    , 'tahun' => $model->tahun
                    , 'format' => $model->format
                ]);
            }
        } 

        return $this->render('laporan_ringkasan_statistik_program_pendidikan', [
            'model' => $model,
            'readonly' => false,
        ]);
    }
    
    public function actionGenerateLaporanRingkasanStatistikProgramPendidikan($tahun, $format)
    {
        if($tahun == "") $tahun = array();
        else $tahun = array($tahun);
        
        $controls = array(
            'YEAR' => $tahun,
        );
        
        GeneralFunction::generateReport('/spsb/ISN/LaporanRingkasanStatistikProgramPendidikan', $format, $controls, 'laporan_ringkasan_statistik_program_pendidikan');
    }
    
    public function actionLaporanBulananProgramPendidikan()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new IsnLaporanBulananProgramPendidikan();
        $model->format = 'html';

        if ($model->load(Yii::$app->request->post())) {
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-laporan-bulanan-program-pendidikan'
                    , 'tahun' => $model->tahun
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-laporan-bulanan-program-pendidikan'
                    , 'tahun' => $model->tahun
                    , 'format' => $model->format
                ]);
            }
        } 

        return $this->render('laporan_bulanan_program_pendidikan', [
            'model' => $model,
            'readonly' => false,
        ]);
    }
    
    public function actionGenerateLaporanBulananProgramPendidikan($tahun, $format)
    {
        if($tahun == "") $tahun = array();
        else $tahun = array($tahun);
        
        $controls = array(
            'YEAR' => $tahun,
        );
        
        GeneralFunction::generateReport('/spsb/ISN/LaporanBulananProgramPendidikan', $format, $controls, 'laporan_bulanan_program_pendidikan');
    }
}

    
