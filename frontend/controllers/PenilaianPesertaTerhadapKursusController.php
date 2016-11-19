<?php

namespace frontend\controllers;

use Yii;
use app\models\PenilaianPesertaTerhadapKursus;
use frontend\models\PenilaianPesertaTerhadapKursusSearch;
use app\models\PenilaianPesertaTerhadapKursusSoalan;
use frontend\models\PenilaianPesertaTerhadapKursusSoalanSearch;
use app\models\MsnLaporan;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\BaseUrl;

// contant values
use app\models\general\GeneralVariable;
use common\models\general\GeneralFunction;

// table reference
use app\models\PengurusanPermohonanKursusPersatuan;

/**
 * PenilaianPesertaTerhadapKursusController implements the CRUD actions for PenilaianPesertaTerhadapKursus model.
 */
class PenilaianPesertaTerhadapKursusController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all PenilaianPesertaTerhadapKursus models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $searchModel = new PenilaianPesertaTerhadapKursusSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PenilaianPesertaTerhadapKursus model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        $model = $this->findModel($id);
        
        $ref = PengurusanPermohonanKursusPersatuan::findOne(['pengurusan_permohonan_kursus_persatuan_id' => $model->pengurusan_permohonan_kursus_persatuan_id]);
        $model->pengurusan_permohonan_kursus_persatuan_id = $ref['agensi'];
        
        $queryPar = null;
        
        $queryPar['PenilaianPesertaTerhadapKursusSoalanSearch']['penilaian_peserta_terhadap_kursus_id'] = $id;
        
        $searchModelPenilaianPesertaTerhadapKursusSoalan  = new PenilaianPesertaTerhadapKursusSoalanSearch();
        $dataProviderPenilaianPesertaTerhadapKursusSoalan = $searchModelPenilaianPesertaTerhadapKursusSoalan->search($queryPar);
        
        return $this->render('view', [
            'model' => $model,
            'searchModelPenilaianPesertaTerhadapKursusSoalan' => $searchModelPenilaianPesertaTerhadapKursusSoalan,
            'dataProviderPenilaianPesertaTerhadapKursusSoalan' => $dataProviderPenilaianPesertaTerhadapKursusSoalan,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new PenilaianPesertaTerhadapKursus model. actionKdjjf
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new PenilaianPesertaTerhadapKursus();
        
        $queryPar = null;
        
        Yii::$app->session->open();
        
        if(isset(Yii::$app->session->id)){
            $queryPar['PenilaianPesertaTerhadapKursusSoalanSearch']['session_id'] = Yii::$app->session->id;
        }
        
        $searchModelPenilaianPesertaTerhadapKursusSoalan  = new PenilaianPesertaTerhadapKursusSoalanSearch();
        $dataProviderPenilaianPesertaTerhadapKursusSoalan = $searchModelPenilaianPesertaTerhadapKursusSoalan->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            
            if(isset(Yii::$app->session->id)){
                PenilaianPesertaTerhadapKursusSoalan::updateAll(['penilaian_peserta_terhadap_kursus_id' => $model->penilaian_peserta_terhadap_kursus_id], 'session_id = "'.Yii::$app->session->id.'"');
                PenilaianPesertaTerhadapKursusSoalan::updateAll(['session_id' => ''], 'penilaian_peserta_terhadap_kursus_id = "'.$model->penilaian_peserta_terhadap_kursus_id.'"');
            }
            
            return $this->redirect(['view', 'id' => $model->penilaian_peserta_terhadap_kursus_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'searchModelPenilaianPesertaTerhadapKursusSoalan' => $searchModelPenilaianPesertaTerhadapKursusSoalan,
                'dataProviderPenilaianPesertaTerhadapKursusSoalan' => $dataProviderPenilaianPesertaTerhadapKursusSoalan,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Updates an existing PenilaianPesertaTerhadapKursus model.
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
        
        $queryPar['PenilaianPesertaTerhadapKursusSoalanSearch']['penilaian_peserta_terhadap_kursus_id'] = $id;
        
        $searchModelPenilaianPesertaTerhadapKursusSoalan  = new PenilaianPesertaTerhadapKursusSoalanSearch();
        $dataProviderPenilaianPesertaTerhadapKursusSoalan = $searchModelPenilaianPesertaTerhadapKursusSoalan->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->penilaian_peserta_terhadap_kursus_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'searchModelPenilaianPesertaTerhadapKursusSoalan' => $searchModelPenilaianPesertaTerhadapKursusSoalan,
                'dataProviderPenilaianPesertaTerhadapKursusSoalan' => $dataProviderPenilaianPesertaTerhadapKursusSoalan,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Deletes an existing PenilaianPesertaTerhadapKursus model.
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
     * Finds the PenilaianPesertaTerhadapKursus model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PenilaianPesertaTerhadapKursus the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PenilaianPesertaTerhadapKursus::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionLaporanKelemahanProgramKursus()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new MsnLaporan();
        $model->format = 'html';

        if ($model->load(Yii::$app->request->post())) {
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-laporan-kelemahan-program-kursus'
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-laporan-kelemahan-program-kursus'
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'format' => $model->format
                ]);
            }
        } 

        return $this->render('laporan_kelemahan_program_kursus', [
            'model' => $model,
            'readonly' => false,
        ]);
    }
    
    public function actionGenerateLaporanKelemahanProgramKursus($tarikh_dari, $tarikh_hingga, $format)
    {
        if($tarikh_dari == "") $tarikh_dari = array();
        else $tarikh_dari = array($tarikh_dari);
        
        if($tarikh_hingga == "") $tarikh_hingga = array();
        else $tarikh_hingga = array($tarikh_hingga);
        
        $controls = array(
            'FROM_DATE' => $tarikh_dari,
            'TO_DATE' => $tarikh_hingga,
        );
        
        GeneralFunction::generateReport('/spsb/MSN/LaporanKelemahanProgramKursus', $format, $controls, 'laporan_kelemahan_program_kursus');
    }
}
