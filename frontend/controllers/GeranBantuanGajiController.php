<?php

namespace frontend\controllers;

use Yii;
use app\models\GeranBantuanGaji;
use frontend\models\GeranBantuanGajiSearch;
use app\models\MsnLaporanMaklumatPembayaranGeranBantuan;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\BaseUrl;

use app\models\general\GeneralVariable;
use app\models\general\GeneralLabel;
use common\models\general\GeneralFunction;

// table reference
use app\models\Jurulatih;
use app\models\RefStatusPermohonanGeranBantuanGajiJurulatih;
use app\models\RefKategoriGeranJurulatih;
use app\models\RefStatusGeranJurulatih;
use app\models\RefStatusJurulatih;
use app\models\RefSukan;
use app\models\RefProgramJurulatih;
use app\models\RefKelulusanGeranBantuanGajiJurulatih;
use app\models\RefAgensiJurulatih;

/**
 * GeranBantuanGajiController implements the CRUD actions for GeranBantuanGaji model.
 */
class GeranBantuanGajiController extends Controller
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
     * Lists all GeranBantuanGaji models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $searchModel = new GeranBantuanGajiSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single GeranBantuanGaji model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = $this->findModel($id);
        
        $ref = Jurulatih::findOne(['jurulatih_id' => $model->nama_jurulatih]);
        $model->nama_jurulatih = $ref['nameAndIC'];
        
        $ref = RefStatusPermohonanGeranBantuanGajiJurulatih::findOne(['id' => $model->status_permohonan]);
        $model->status_permohonan = $ref['desc'];
        
        $ref = RefKategoriGeranJurulatih::findOne(['id' => $model->kategori_geran]);
        $model->kategori_geran = $ref['desc'];
        
        $ref = RefStatusGeranJurulatih::findOne(['id' => $model->status_geran]);
        $model->status_geran = $ref['desc'];
        
        $ref = RefProgramJurulatih::findOne(['id' => $model->program_msn]);
        $model->program_msn = $ref['desc'];
        
        $ref = RefStatusJurulatih::findOne(['id' => $model->status_jurulatih]);
        $model->status_jurulatih = $ref['desc'];
        
        $ref = RefSukan::findOne(['id' => $model->nama_sukan]);
        $model->nama_sukan = $ref['desc'];
        
        $ref = RefKelulusanGeranBantuanGajiJurulatih::findOne(['id' => $model->kelulusan]);
        $model->kelulusan = $ref['desc'];
        
        $ref = RefAgensiJurulatih::findOne(['id' => $model->agensi]);
        $model->agensi = $ref['desc'];
        
        //$YesNo = GeneralLabel::getYesNoLabel($model->kelulusan);
        //$model->kelulusan = $YesNo;
        
        return $this->render('view', [
            'model' => $model,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new GeranBantuanGaji model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new GeranBantuanGaji();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->geran_bantuan_gaji_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Updates an existing GeranBantuanGaji model.
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
            return $this->redirect(['view', 'id' => $model->geran_bantuan_gaji_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Deletes an existing GeranBantuanGaji model.
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
     * Finds the GeranBantuanGaji model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return GeranBantuanGaji the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = GeranBantuanGaji::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionLaporanMaklumatPembayaranGeranBantuan()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new MsnLaporanMaklumatPembayaranGeranBantuan();
        $model->format = 'html';

        if ($model->load(Yii::$app->request->post())) {
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-laporan-maklumat-pembayaran-geran-bantuan'
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'program' => $model->program
                    , 'sukan' => $model->sukan
                    , 'jumlah_geran_dari' => $model->jumlah_geran_dari
                    , 'jumlah_geran_hingga' => $model->jumlah_geran_hingga
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-laporan-maklumat-pembayaran-geran-bantuan'
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'program' => $model->program
                    , 'sukan' => $model->sukan
                    , 'jumlah_geran_dari' => $model->jumlah_geran_dari
                    , 'jumlah_geran_hingga' => $model->jumlah_geran_hingga
                    , 'format' => $model->format
                ]);
            }
        } 

        return $this->render('laporan_maklumat_pembayaran_geran_bantuan', [
            'model' => $model,
            'readonly' => false,
        ]);
    }
    
    public function actionGenerateLaporanMaklumatPembayaranGeranBantuan($tarikh_dari, $tarikh_hingga, $program, $sukan, $jumlah_geran_dari, $jumlah_geran_hingga, $format)
    {
        if($tarikh_dari == "") $tarikh_dari = array();
        else $tarikh_dari = array($tarikh_dari);
        
        if($tarikh_hingga == "") $tarikh_hingga = array();
        else $tarikh_hingga = array($tarikh_hingga);
        
        if($program == "") $program = array();
        else $program = array($program);
        
        if($sukan == "") $sukan = array();
        else $sukan = array($sukan);
        
        if($jumlah_geran_dari == "") $jumlah_geran_dari = array();
        else $jumlah_geran_dari = array($jumlah_geran_dari);
        
        if($jumlah_geran_hingga == "") $jumlah_geran_hingga = array();
        else $jumlah_geran_hingga = array($jumlah_geran_hingga);
        
        $controls = array(
            'FROM_DATE' => $tarikh_dari,
            'TO_DATE' => $tarikh_hingga,
            'SUKAN' => $sukan,
            'PROGRAM' => $program,
            'JUMLAH_GERAN_DARI' => $jumlah_geran_dari,
            'JUMLAH_GERAN_HINGGA' => $jumlah_geran_hingga,
        );
        
        GeneralFunction::generateReport('/spsb/MSN/LaporanMaklumatPembayaranGeranBantuan', $format, $controls, 'laporan_maklumat_pembayaran_geran_bantuan');
    }
}
