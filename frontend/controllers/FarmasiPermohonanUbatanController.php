<?php

namespace frontend\controllers;

use Yii;
use app\models\FarmasiPermohonanUbatan;
use frontend\models\FarmasiPermohonanUbatanSearch;
use app\models\FarmasiUbatan;
use frontend\models\FarmasiUbatanSearch;
use app\models\IsnLaporanStatistikBulananPengunaanUbatanDanKos;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\helpers\BaseUrl;

use app\models\general\Upload;
use app\models\general\GeneralVariable;
use app\models\general\GeneralLabel;
use common\models\general\GeneralFunction;

// table reference
use app\models\Atlet;
use app\models\RefAtletTahap;
use app\models\RefSukan;

/**
 * FarmasiPermohonanUbatanController implements the CRUD actions for FarmasiPermohonanUbatan model.
 */
class FarmasiPermohonanUbatanController extends Controller
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
     * Lists all FarmasiPermohonanUbatan models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $searchModel = new FarmasiPermohonanUbatanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single FarmasiPermohonanUbatan model.
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
        
        $ref = RefAtletTahap::findOne(['id' => $model->kategori_atlet]);
        $model->kategori_atlet = $ref['desc'];
        
        $ref = RefSukan::findOne(['id' => $model->jenis_sukan]);
        $model->jenis_sukan = $ref['desc'];
        
        $YesNo = GeneralLabel::getYesNoLabel($model->kelulusan);
        $model->kelulusan = $YesNo;
        
        if($model->tarikh_pemberian != "") {$model->tarikh_pemberian = GeneralFunction::convert($model->tarikh_pemberian);}
        if($model->tarikh_kelulusan != "") {$model->tarikh_kelulusan = GeneralFunction::convert($model->tarikh_kelulusan, GeneralFunction::TYPE_DATE);}
        
        $queryPar = null;
        
        $queryPar['FarmasiUbatanSearch']['farmasi_permohonan_ubatan_id'] = $id;
        
        $searchModelFarmasiUbatan  = new FarmasiUbatanSearch();
        $dataProviderFarmasiUbatan= $searchModelFarmasiUbatan->search($queryPar);
        
        return $this->render('view', [
            'model' => $model,
            'searchModelFarmasiUbatan' => $searchModelFarmasiUbatan,
            'dataProviderFarmasiUbatan' => $dataProviderFarmasiUbatan,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new FarmasiPermohonanUbatan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new FarmasiPermohonanUbatan();
        
        $queryPar = null;
        
        Yii::$app->session->open();
        
        if(isset(Yii::$app->session->id)){
            $queryPar['FarmasiUbatanSearch']['session_id'] = Yii::$app->session->id;
        }
        
        $searchModelFarmasiUbatan  = new FarmasiUbatanSearch();
        $dataProviderFarmasiUbatan= $searchModelFarmasiUbatan->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if(isset(Yii::$app->session->id)){
                FarmasiUbatan::updateAll(['farmasi_permohonan_ubatan_id' => $model->farmasi_permohonan_ubatan_id], 'session_id = "'.Yii::$app->session->id.'"');
                FarmasiUbatan::updateAll(['session_id' => ''], 'farmasi_permohonan_ubatan_id = "'.$model->farmasi_permohonan_ubatan_id.'"');
            }
            
            $file = UploadedFile::getInstance($model, 'muat_naik');
            if($file){
                $model->muat_naik = Upload::uploadFile($file, Upload::farmasiPermohonanUbatanFolder, $model->farmasi_permohonan_ubatan_id);
            }
            
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->farmasi_permohonan_ubatan_id]);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
                'searchModelFarmasiUbatan' => $searchModelFarmasiUbatan,
                'dataProviderFarmasiUbatan' => $dataProviderFarmasiUbatan,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Updates an existing FarmasiPermohonanUbatan model.
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
        
        $queryPar['FarmasiUbatanSearch']['farmasi_permohonan_ubatan_id'] = $id;
        
        $searchModelFarmasiUbatan  = new FarmasiUbatanSearch();
        $dataProviderFarmasiUbatan= $searchModelFarmasiUbatan->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $file = UploadedFile::getInstance($model, 'muat_naik');
            if($file){
                $model->muat_naik = Upload::uploadFile($file, Upload::farmasiPermohonanUbatanFolder, $model->farmasi_permohonan_ubatan_id);
            }
            
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->farmasi_permohonan_ubatan_id]);
            }
        } else {
            return $this->render('update', [
                'model' => $model,
                'searchModelFarmasiUbatan' => $searchModelFarmasiUbatan,
                'dataProviderFarmasiUbatan' => $dataProviderFarmasiUbatan,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Deletes an existing FarmasiPermohonanUbatan model.
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
     * Finds the FarmasiPermohonanUbatan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return FarmasiPermohonanUbatan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = FarmasiPermohonanUbatan::findOne($id)) !== null) {
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
    
    public function actionLaporanStatistikBulananPengunaanUbatanDanKos()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new IsnLaporanStatistikBulananPengunaanUbatanDanKos();
        $model->format = 'html';

        if ($model->load(Yii::$app->request->post())) {
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-laporan-statistik-bulanan-pengunaan-ubatan-dan-kos'
                    , 'tahun' => $model->tahun
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-laporan-statistik-bulanan-pengunaan-ubatan-dan-kos'
                    , 'tahun' => $model->tahun
                    , 'format' => $model->format
                ]);
            }
        } 

        return $this->render('laporan_statistik_bulanan_pengunaan_ubatan_dan_kos', [
            'model' => $model,
            'readonly' => false,
        ]);
    }
    
    public function actionGenerateLaporanStatistikBulananPengunaanUbatanDanKos($tahun, $format)
    {
        if($tahun == "") $tahun = array();
        else $tahun = array($tahun);
        
        $controls = array(
            'YEAR' => $tahun,
        );
        
        GeneralFunction::generateReport('/spsb/ISN/LaporanStatistikBulananPenggunaanUbatanDanKos', $format, $controls, 'laporan_statistik_bulanan_pengunaan_ubatan_dan_kos');
    }
}
