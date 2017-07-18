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
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $queryParams = Yii::$app->request->queryParams;
        
        if(isset(Yii::$app->user->identity->peranan_akses['MSN']['permohonan-peralatan']['kelulusan'])) {
            $queryParams['PermohonanPeralatanSearch']['hantar_flag'] = 1;
        }
        
        $searchModel = new PermohonanPeralatanSearch();
        $dataProvider = $searchModel->search($queryParams);

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
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
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
        
        if($model->tarikh != "") {$model->tarikh = GeneralFunction::convert($model->tarikh, GeneralFunction::TYPE_DATETIME);}
        if($model->tarikh_jkb != "") {$model->tarikh_jkb = GeneralFunction::convert($model->tarikh_jkb, GeneralFunction::TYPE_DATE);}
        
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
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
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
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
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
     * Updates an existing PermohonanPeralatan model.
     * If approved is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionHantar($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = $this->findModel($id);
        
        $model->hantar_flag = 1; // set approved
        $model->tarikh_hantar = GeneralFunction::getCurrentTimestamp(); // set date capture
        
        $model->kelulusan = RefKelulusanPeralatan::SEDANG_DIPROSES;
        
        $model->save();
        
        return $this->redirect(['view', 'id' => $model->permohonan_peralatan_id]);
    }

    /**
     * Deletes an existing PermohonanPeralatan model.
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
        
        $model->sukan ='';
        if(Yii::$app->user->identity->sukan){
            $model->sukan = Yii::$app->user->identity->sukan;
        }

        if ($model->load(Yii::$app->request->post())) {
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-laporan-senarai-permohonan-peralatan'
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'sukan' => $model->sukan
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-laporan-senarai-permohonan-peralatan'
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'sukan' => $model->sukan
                    , 'format' => $model->format
                ]);
            }
        } 

        return $this->render('laporan_senarai_permohonan_peralatan', [
            'model' => $model,
            'readonly' => false,
        ]);
    }

    public function actionGenerateLaporanSenaraiPermohonanPeralatan($tarikh_dari, $tarikh_hingga, $sukan,$format)
    {
        if($tarikh_dari == "") $tarikh_dari = array();
        else $tarikh_dari = array($tarikh_dari);
        
        if($tarikh_hingga == "") $tarikh_hingga = array();
        else $tarikh_hingga = array($tarikh_hingga);
        
        if($sukan == "") $sukan = array();
        else $sukan = array($sukan);
        
        $controls = array(
            'FROM_DATE' => $tarikh_dari,
            'TO_DATE' => $tarikh_hingga,
            'SUKAN' => $sukan,
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
        
        $model->sukan ='';
        
        if(Yii::$app->user->identity->sukan){
            $model->sukan = Yii::$app->user->identity->sukan;
        }

        if ($model->load(Yii::$app->request->post())) {
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-laporan-statistik-permohonan-peralatan'
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'sukan' => $model->sukan
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-laporan-statistik-permohonan-peralatan'
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'sukan' => $model->sukan
                    , 'format' => $model->format
                ]);
            }
        } 

        return $this->render('laporan_statistik_permohonan_peralatan', [
            'model' => $model,
            'readonly' => false,
        ]);
    }

    public function actionGenerateLaporanStatistikPermohonanPeralatan($tarikh_dari, $tarikh_hingga, $sukan, $format)
    {
        if($tarikh_dari == "") $tarikh_dari = array();
        else $tarikh_dari = array($tarikh_dari);
        
        if($tarikh_hingga == "") $tarikh_hingga = array();
        else $tarikh_hingga = array($tarikh_hingga);
        
        if($sukan == "") $sukan = array();
        else $sukan = array($sukan);
        
        $controls = array(
            'FROM_DATE' => $tarikh_dari,
            'TO_DATE' => $tarikh_hingga,
            'SUKAN' => $sukan,
        );
        
        GeneralFunction::generateReport('/spsb/MSN/LaporanStatistikPermohonanPeralatan', $format, $controls, 'laporan_statistik_permohonan_peralatan');
    }
    
    public function actionPrintPermohonanPenerimaanPeralatan($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }  
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
        
        $peralatan = Peralatan::find()->where(['permohonan_peralatan_id' => $model->permohonan_peralatan_id])->all();
        
        $pdf = new \mPDF('utf-8', 'A4-L');

        $pdf->title = GeneralLabel::permohonan_penerimaan_peralatan;

        //$pdf->cssFile = 'report.css';
        $stylesheet = file_get_contents('css/report.css');

        $pdf->WriteHTML($stylesheet,1);
        
        $pdf->WriteHTML($this->renderpartial('print_borang_permohonan_penerimaan_peralatan', [
             'model'  => $model,
             'peralatan' => $peralatan,
        ]));

        $pdf->Output(GeneralLabel::permohonan_penerimaan_peralatan.'_'.$model->permohonan_peralatan_id.'.pdf', 'I');
    }
    
    public function actionPrintJkb($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }  
        $model = $this->findModel($id);
		
		$ref = RefCawangan::findOne(['id' => $model->cawangan]);
        $model->cawangan = $ref['desc'];
        
        $ref = RefNegeri::findOne(['id' => $model->negeri]);
        $model->negeri = $ref['desc'];
        
        $ref = RefProgramSemasaSukanAtlet::findOne(['id' => $model->program]);
        $model->program = $ref['desc'];
        
        $ref = RefSukan::findOne(['id' => $model->sukan]);
        $model->sukan = $ref['desc'];
        
        $peralatan = Peralatan::find()->where(['permohonan_peralatan_id' => $model->permohonan_peralatan_id])->all();

        $pdf = new \mPDF('utf-8', 'A4-L');

        $pdf->title = 'Borang JKB';

        //$pdf->cssFile = 'report.css';
        $stylesheet = file_get_contents('css/report.css');

        $pdf->WriteHTML($stylesheet,1);
        
        $pdf->WriteHTML($this->renderpartial('print_jkb', [
             'model'  => $model,
             'peralatan' => $peralatan,
        ]));

        $pdf->Output('Borang_jkb_'.$model->permohonan_peralatan_id.'.pdf', 'I');
    }
}
