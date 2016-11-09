<?php

namespace frontend\controllers;

use Yii;
use app\models\PermohonanPeralatan;
use frontend\models\PermohonanPeralatanSearch;
use app\models\Peralatan;
use frontend\models\PeralatanSearch;
use app\models\PermohonanPeralatanPenggunaan;
use frontend\models\PermohonanPeralatanPenggunaanSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\BaseUrl;
use app\models\MsnLaporan;

// table reference
use app\models\RefCawangan;
use app\models\RefNegeri;
use app\models\RefSukan;
use app\models\RefProgram;
use app\models\RefProgramSemasaSukanAtlet;
use app\models\RefKelulusanPeralatan;

// contant values
use app\models\general\GeneralLabel;
use common\models\general\GeneralFunction;

/**
 * PermohonanPeralatanController implements the CRUD actions for PermohonanPeralatan model.
 */
class PermohonanPeralatanController extends Controller
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
     * Lists all PermohonanPeralatan models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PermohonanPeralatanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PermohonanPeralatan model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $queryPar = null;
        $queryPar['PeralatanSearch']['permohonan_peralatan_id'] = $id;
        $queryPar['PermohonanPeralatanPenggunaanSearch']['permohonan_peralatan_id'] = $id;
        
        $searchModel = new PeralatanSearch();
        $dataProvider = $searchModel->search($queryPar);
        
        $searchModelPermohonanPeralatanPenggunaan = new PermohonanPeralatanPenggunaanSearch();
        $dataProviderPermohonanPeralatanPenggunaan = $searchModelPermohonanPeralatanPenggunaan->search($queryPar);
        
        $model = $this->findModel($id);
        
        $ref = RefCawangan::findOne(['id' => $model->cawangan]);
        $model->cawangan = $ref['desc'];
        
        $ref = RefNegeri::findOne(['id' => $model->negeri]);
        $model->negeri = $ref['desc'];
        
        $ref = RefProgramSemasaSukanAtlet::findOne(['id' => $model->program]);
        $model->program = $ref['desc'];
        
        $ref = RefSukan::findOne(['id' => $model->sukan]);
        $model->sukan = $ref['desc'];
        
        $ref = RefKelulusanPeralatan::findOne(['id' => $model->kelulusan]);
        $model->kelulusan = $ref['desc'];
        
        /*$YesNo = GeneralLabel::getYesNoLabel($model->kelulusan);
        $model->kelulusan = $YesNo;*/
        
        return $this->render('view', [
            'model' => $model,
            'readonly' => true,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'searchModelPermohonanPeralatanPenggunaan' => $searchModelPermohonanPeralatanPenggunaan,
            'dataProviderPermohonanPeralatanPenggunaan' => $dataProviderPermohonanPeralatanPenggunaan,
        ]);
    }

    /**
     * Creates a new PermohonanPeralatan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new PermohonanPeralatan();
        
        $queryPar = null;
        
        Yii::$app->session->open();
        
        if(isset(Yii::$app->session->id)){
            $queryPar['PeralatanSearch']['session_id'] = Yii::$app->session->id;
            $queryPar['PermohonanPeralatanPenggunaanSearch']['session_id'] = Yii::$app->session->id;
        }
        
        $searchModel = new PeralatanSearch();
        $dataProvider = $searchModel->search($queryPar);
        
        $searchModelPermohonanPeralatanPenggunaan = new PermohonanPeralatanPenggunaanSearch();
        $dataProviderPermohonanPeralatanPenggunaan = $searchModelPermohonanPeralatanPenggunaan->search($queryPar);
        
        $model->jumlah_peralatan = $dataProvider->getTotalCount();
        
        $model->tarikh = GeneralFunction::getCurrentTimestamp();
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->open();
        
            if(isset(Yii::$app->session->id)){
                Peralatan::updateAll(['permohonan_peralatan_id' => $model->permohonan_peralatan_id], 'session_id = "'.Yii::$app->session->id.'"');
                Peralatan::updateAll(['session_id' => ''], 'permohonan_peralatan_id = "'.$model->permohonan_peralatan_id.'"');
                
                PermohonanPeralatanPenggunaan::updateAll(['permohonan_peralatan_id' => $model->permohonan_peralatan_id], 'session_id = "'.Yii::$app->session->id.'"');
                PermohonanPeralatanPenggunaan::updateAll(['session_id' => ''], 'permohonan_peralatan_id = "'.$model->permohonan_peralatan_id.'"');
            }
            
            return $this->redirect(['view', 'id' => $model->permohonan_peralatan_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'readonly' => false,
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                'searchModelPermohonanPeralatanPenggunaan' => $searchModelPermohonanPeralatanPenggunaan,
                'dataProviderPermohonanPeralatanPenggunaan' => $dataProviderPermohonanPeralatanPenggunaan,
            ]);
        }
    }

    /**
     * Updates an existing PermohonanPeralatan model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $queryPar = null;
        $queryPar['PeralatanSearch']['permohonan_peralatan_id'] = $id;
        $queryPar['PermohonanPeralatanPenggunaanSearch']['permohonan_peralatan_id'] = $id;
        
        $searchModel = new PeralatanSearch();
        $dataProvider = $searchModel->search($queryPar);
        
        $searchModelPermohonanPeralatanPenggunaan = new PermohonanPeralatanPenggunaanSearch();
        $dataProviderPermohonanPeralatanPenggunaan = $searchModelPermohonanPeralatanPenggunaan->search($queryPar);
        
        $model = $this->findModel($id);
        
        $model->jumlah_peralatan = $dataProvider->getTotalCount();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->permohonan_peralatan_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'readonly' => false,
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                'searchModelPermohonanPeralatanPenggunaan' => $searchModelPermohonanPeralatanPenggunaan,
                'dataProviderPermohonanPeralatanPenggunaan' => $dataProviderPermohonanPeralatanPenggunaan,
            ]);
        }
    }

    /**
     * Deletes an existing PermohonanPeralatan model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the PermohonanPeralatan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PermohonanPeralatan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PermohonanPeralatan::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionLaporanSenaraiPermohonanPeralatan()
    {

        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new MsnLaporan();
        $model->format = 'html';

        if ($model->load(Yii::$app->request->post())) {
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-laporan-senarai-permohonan-peralatan'
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-laporan-senarai-permohonan-peralatan'
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'format' => $model->format
                ]);
            }
        } 

        return $this->render('laporan_senarai_permohonan_peralatan', [
            'model' => $model,
            'readonly' => false,
        ]);
    }

    public function actionGenerateLaporanSenaraiPermohonanPeralatan($tarikh_dari, $tarikh_hingga,$format)
    {
        if($tarikh_dari == "") $tarikh_dari = array();
        else $tarikh_dari = array($tarikh_dari);
        
        if($tarikh_hingga == "") $tarikh_hingga = array();
        else $tarikh_hingga = array($tarikh_hingga);
        
        $controls = array(
            'FROM_DATE' => $tarikh_dari,
            'TO_DATE' => $tarikh_hingga,
        );
        
        GeneralFunction::generateReport('/spsb/MSN/LaporanSenaraiPermohonanPeralatan', $format, $controls, 'laporan_senarai_permohonan_peralatan');
    }
    
    public function actionLaporanStatistikPermohonanPeralatan()
    {

        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new MsnLaporan();
        $model->format = 'html';

        if ($model->load(Yii::$app->request->post())) {
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-laporan-statistik-permohonan-peralatan'
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-laporan-statistik-permohonan-peralatan'
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'format' => $model->format
                ]);
            }
        } 

        return $this->render('laporan_statistik_permohonan_peralatan', [
            'model' => $model,
            'readonly' => false,
        ]);
    }

    public function actionGenerateLaporanStatistikPermohonanPeralatan($tarikh_dari, $tarikh_hingga,$format)
    {
        if($tarikh_dari == "") $tarikh_dari = array();
        else $tarikh_dari = array($tarikh_dari);
        
        if($tarikh_hingga == "") $tarikh_hingga = array();
        else $tarikh_hingga = array($tarikh_hingga);
        
        $controls = array(
            'FROM_DATE' => $tarikh_dari,
            'TO_DATE' => $tarikh_hingga,
        );
        
        GeneralFunction::generateReport('/spsb/MSN/LaporanStatistikPermohonanPeralatan', $format, $controls, 'laporan_statistik_permohonan_peralatan');
    }
}
