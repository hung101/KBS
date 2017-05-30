<?php

namespace frontend\controllers;

use Yii;
use app\models\PerkhidmatanAnalisaPerlawananBiomekanik;
use frontend\models\PerkhidmatanAnalisaPerlawananBiomekanikSearch;
use app\models\BiomekanikUjian;
use frontend\models\BiomekanikUjianSearch;
use app\models\BiomekanikAnthropometrics;
use frontend\models\BiomekanikAnthropometricsSearch;
use app\models\PermohonanPerkhidmatanAnalisaPerlawananDanBimekanik;
use app\models\IsnLaporanPerkhidmatanBiomekanikAtlet;
use app\models\IsnLaporanPerkhidmatanBiomekanikBilangan;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\helpers\Json;
use yii\helpers\BaseUrl;

use app\models\general\Upload;
use app\models\general\GeneralVariable;
use common\models\general\GeneralFunction;

// table reference
use app\models\Atlet;
use app\models\RefPerkhidmatanBiomekanik;
use app\models\RefUjianStatusBiomekanik;
use app\models\RefSukan;

/**
 * PerkhidmatanAnalisaPerlawananBiomekanikController implements the CRUD actions for PerkhidmatanAnalisaPerlawananBiomekanik model.
 */
class PerkhidmatanAnalisaPerlawananBiomekanikController extends Controller
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
     * Lists all PerkhidmatanAnalisaPerlawananBiomekanik models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $searchModel = new PerkhidmatanAnalisaPerlawananBiomekanikSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PerkhidmatanAnalisaPerlawananBiomekanik model.
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
        
        $ref = RefPerkhidmatanBiomekanik::findOne(['id' => $model->perkhidmatan]);
        $model->perkhidmatan = $ref['desc'];
        
        $ref = RefUjianStatusBiomekanik::findOne(['id' => $model->status_ujian]);
        $model->status_ujian = $ref['desc'];
        
        $ref = RefSukan::findOne(['id' => $model->sukan]);
        $model->sukan = $ref['desc'];
        
        if($model->tarikh != "") {$model->tarikh = GeneralFunction::convert($model->tarikh, GeneralFunction::TYPE_DATE);}
        
        $queryPar = null;
        
        $queryPar['BiomekanikUjianSearch']['perkhidmatan_analisa_perlawanan_biomekanik_id'] = $id;
        $queryPar['BiomekanikAnthropometricsSearch']['perkhidmatan_analisa_perlawanan_biomekanik_id'] = $id;
        
        $searchModelBiomekanikUjian  = new BiomekanikUjianSearch();
        $dataProviderBiomekanikUjian = $searchModelBiomekanikUjian->search($queryPar);
        
        $searchModelBiomekanikAnthropometrics  = new BiomekanikAnthropometricsSearch();
        $dataProviderBiomekanikAnthropometrics = $searchModelBiomekanikAnthropometrics->search($queryPar);
        
        return $this->render('view', [
            'model' => $model,
            'searchModelBiomekanikUjian' => $searchModelBiomekanikUjian,
            'dataProviderBiomekanikUjian' => $dataProviderBiomekanikUjian,
            'searchModelBiomekanikAnthropometrics' => $searchModelBiomekanikAnthropometrics,
            'dataProviderBiomekanikAnthropometrics' => $dataProviderBiomekanikAnthropometrics,
            'readonly' => true,
        ]);
    }
    
    /**
     * Creates a new PerkhidmatanAnalisaPerlawananBiomekanik model.
     * If creation is successful, the browser will be redirected to the 'create/update' page.
     * @return mixed
     */
    public function actionLoad($permohonan_perkhidmatan_analisa_perlawanan_dan_bimekanik_id)
    {
        if (($model = PerkhidmatanAnalisaPerlawananBiomekanik::findOne(['permohonan_perkhidmatan_analisa_perlawanan_dan_bimekanik_id' => $permohonan_perkhidmatan_analisa_perlawanan_dan_bimekanik_id])) !== null) {
            return self::actionUpdate($model->perkhidmatan_analisa_perlawanan_biomekanik_id);
        } else {
            return self::actionCreate($permohonan_perkhidmatan_analisa_perlawanan_dan_bimekanik_id);
        }
    }

    /**
     * Creates a new PerkhidmatanAnalisaPerlawananBiomekanik model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($permohonan_perkhidmatan_analisa_perlawanan_dan_bimekanik_id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new PerkhidmatanAnalisaPerlawananBiomekanik();
        
        $model->permohonan_perkhidmatan_analisa_perlawanan_dan_bimekanik_id = $permohonan_perkhidmatan_analisa_perlawanan_dan_bimekanik_id;
        
        if (($modelPermohonan = PermohonanPerkhidmatanAnalisaPerlawananDanBimekanik::findOne($permohonan_perkhidmatan_analisa_perlawanan_dan_bimekanik_id)) !== null) {
            $model->atlet_id = $modelPermohonan->atlet_id;
        }
        
        $queryPar = null;
        
        Yii::$app->session->open();
        
        if(isset(Yii::$app->session->id)){
            $queryPar['BiomekanikUjianSearch']['session_id'] = Yii::$app->session->id;
            $queryPar['BiomekanikAnthropometricsSearch']['session_id'] = Yii::$app->session->id;
        }
        
        $searchModelBiomekanikUjian  = new BiomekanikUjianSearch();
        $dataProviderBiomekanikUjian = $searchModelBiomekanikUjian->search($queryPar);
        
        $searchModelBiomekanikAnthropometrics  = new BiomekanikAnthropometricsSearch();
        $dataProviderBiomekanikAnthropometrics = $searchModelBiomekanikAnthropometrics->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $upload = new Upload();
            $file = UploadedFile::getInstance($model, 'muat_naik_video');
            if($file){
                $model->muat_naik_video = $upload->uploadFile($file, Upload::perkhidmatanAnalisaPerlawananBiomekanikFolder, $model->perkhidmatan_analisa_perlawanan_biomekanik_id);
            }
            
            if(isset(Yii::$app->session->id)){
                BiomekanikUjian::updateAll(['perkhidmatan_analisa_perlawanan_biomekanik_id' => $model->perkhidmatan_analisa_perlawanan_biomekanik_id], 'session_id = "'.Yii::$app->session->id.'"');
                BiomekanikUjian::updateAll(['session_id' => ''], 'perkhidmatan_analisa_perlawanan_biomekanik_id = "'.$model->perkhidmatan_analisa_perlawanan_biomekanik_id.'"');
                
                BiomekanikAnthropometrics::updateAll(['perkhidmatan_analisa_perlawanan_biomekanik_id' => $model->perkhidmatan_analisa_perlawanan_biomekanik_id], 'session_id = "'.Yii::$app->session->id.'"');
                BiomekanikAnthropometrics::updateAll(['session_id' => ''], 'perkhidmatan_analisa_perlawanan_biomekanik_id = "'.$model->perkhidmatan_analisa_perlawanan_biomekanik_id.'"');
            }
            
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->perkhidmatan_analisa_perlawanan_biomekanik_id]);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
                'searchModelBiomekanikUjian' => $searchModelBiomekanikUjian,
                'dataProviderBiomekanikUjian' => $dataProviderBiomekanikUjian,
                'searchModelBiomekanikAnthropometrics' => $searchModelBiomekanikAnthropometrics,
                'dataProviderBiomekanikAnthropometrics' => $dataProviderBiomekanikAnthropometrics,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Updates an existing PerkhidmatanAnalisaPerlawananBiomekanik model.
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
        
        if (($modelPermohonan = PermohonanPerkhidmatanAnalisaPerlawananDanBimekanik::findOne($model->permohonan_perkhidmatan_analisa_perlawanan_dan_bimekanik_id)) !== null) {
            $model->atlet_id = $modelPermohonan->atlet_id;
        }
        
        $queryPar = null;
        
        $queryPar['BiomekanikUjianSearch']['perkhidmatan_analisa_perlawanan_biomekanik_id'] = $id;
        $queryPar['BiomekanikAnthropometricsSearch']['perkhidmatan_analisa_perlawanan_biomekanik_id'] = $id;
        
        $searchModelBiomekanikUjian  = new BiomekanikUjianSearch();
        $dataProviderBiomekanikUjian = $searchModelBiomekanikUjian->search($queryPar);
        
        $searchModelBiomekanikAnthropometrics  = new BiomekanikAnthropometricsSearch();
        $dataProviderBiomekanikAnthropometrics = $searchModelBiomekanikAnthropometrics->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $upload = new Upload();
            $file = UploadedFile::getInstance($model, 'muat_naik_video');
            if($file){
                $model->muat_naik_video = $upload->uploadFile($file, Upload::perkhidmatanAnalisaPerlawananBiomekanikFolder, $model->perkhidmatan_analisa_perlawanan_biomekanik_id);
            }
            
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->perkhidmatan_analisa_perlawanan_biomekanik_id]);
            }
        } else {
            return $this->render('update', [
                'model' => $model,
                'searchModelBiomekanikUjian' => $searchModelBiomekanikUjian,
                'dataProviderBiomekanikUjian' => $dataProviderBiomekanikUjian,
                'searchModelBiomekanikAnthropometrics' => $searchModelBiomekanikAnthropometrics,
                'dataProviderBiomekanikAnthropometrics' => $dataProviderBiomekanikAnthropometrics,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Deletes an existing PerkhidmatanAnalisaPerlawananBiomekanik model.
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
        self::actionDeleteupload($id, 'muat_naik_video');
        
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the PerkhidmatanAnalisaPerlawananBiomekanik model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PerkhidmatanAnalisaPerlawananBiomekanik the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PerkhidmatanAnalisaPerlawananBiomekanik::findOne($id)) !== null) {
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
    
    public function actionLaporanPerkhidmatanBiomekanikAtlet()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new IsnLaporanPerkhidmatanBiomekanikAtlet();
        $model->format = 'html';

        if ($model->load(Yii::$app->request->post())) {
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-laporan-perkhidmatan-biomekanik-atlet'
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-laporan-perkhidmatan-biomekanik-atlet'
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'format' => $model->format
                ]);
            }
        } 

        return $this->render('laporan_perkhidmatan_biomekanik_atlet', [
            'model' => $model,
            'readonly' => false,
        ]);
    }
    
    public function actionGenerateLaporanPerkhidmatanBiomekanikAtlet($tarikh_dari, $tarikh_hingga, $format)
    {
        if($tarikh_dari == "") $tarikh_dari = array();
        else $tarikh_dari = array($tarikh_dari);
        
        if($tarikh_hingga == "") $tarikh_hingga = array();
        else $tarikh_hingga = array($tarikh_hingga);
        
        $controls = array(
            'FROM_DATE' => $tarikh_dari,
            'TO_DATE' => $tarikh_hingga,
        );
        
        GeneralFunction::generateReport('/spsb/ISN/LaporanPerkhidmatanBiomekanikAtlet', $format, $controls, 'laporan_perkhidmatan_biomekanik_atlet');
    }
    
    public function actionLaporanPerkhidmatanBiomekanikBilangan()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new IsnLaporanPerkhidmatanBiomekanikBilangan();
        $model->format = 'html';

        if ($model->load(Yii::$app->request->post())) {
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-laporan-perkhidmatan-biomekanik-bilangan'
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-laporan-perkhidmatan-biomekanik-bilangan'
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'format' => $model->format
                ]);
            }
        } 

        return $this->render('laporan_perkhidmatan_biomekanik_bilangan', [
            'model' => $model,
            'readonly' => false,
        ]);
    }
    
    public function actionGenerateLaporanPerkhidmatanBiomekanikBilangan($tarikh_dari, $tarikh_hingga, $format)
    {
        if($tarikh_dari == "") $tarikh_dari = array();
        else $tarikh_dari = array($tarikh_dari);
        
        if($tarikh_hingga == "") $tarikh_hingga = array();
        else $tarikh_hingga = array($tarikh_hingga);
        
        $controls = array(
            'FROM_DATE' => $tarikh_dari,
            'TO_DATE' => $tarikh_hingga,
        );
        
        GeneralFunction::generateReport('/spsb/ISN/LaporanPerkhidmatanBiomekanikBilangan', $format, $controls, 'laporan_perkhidmatan_biomekanik_bilangan');
    }
}
