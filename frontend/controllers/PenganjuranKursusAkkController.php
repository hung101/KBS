<?php

namespace frontend\controllers;

use Yii;
use app\models\PenganjuranKursusAkk;
use frontend\models\PenganjuranKursusAkkSearch;
use app\models\IsnLaporanSenaraiKursus;
use app\models\IsnLaporanSenaraiPeserta;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\BaseUrl;
use yii\helpers\Json;

use app\models\general\GeneralVariable;
use common\models\general\GeneralFunction;

// table reference
use app\models\RefJenisKursusPenganjuran;
use app\models\RefNegeri;
use app\models\RefKategoriKursusPenganjuranAkk;
use app\models\RefKategoriKursusPenganjuran;

/**
 * PenganjuranKursusAkkController implements the CRUD actions for PenganjuranKursusAkk model.
 */
class PenganjuranKursusAkkController extends Controller
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
     * Lists all PenganjuranKursusAkk models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $searchModel = new PenganjuranKursusAkkSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PenganjuranKursusAkk model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = $this->findModel($id);
        
        $ref = RefKategoriKursusPenganjuran::findOne(['id' => $model->jenis_kursus]);
        $model->jenis_kursus = $ref['desc'];
        
        $ref = RefNegeri::findOne(['id' => $model->negeri]);
        $model->negeri = $ref['desc'];
        
        $ref = RefKategoriKursusPenganjuranAkk::findOne(['id' => $model->kategori_kursus_penganjuran]);
        $model->kategori_kursus_penganjuran = $ref['desc'];
        
        $model->tarikh_kursus_mula = GeneralFunction::convert($model->tarikh_kursus_mula);
        
        $model->tarikh_kursus_tamat = GeneralFunction::convert($model->tarikh_kursus_tamat);
        
        return $this->render('view', [
            'model' => $model,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new PenganjuranKursusAkk model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new PenganjuranKursusAkk();
        
        $model->load(Yii::$app->request->post());

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->penganjuran_kursus_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Updates an existing PenganjuranKursusAkk model.
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
        
        $model->load(Yii::$app->request->post());

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->penganjuran_kursus_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Deletes an existing PenganjuranKursusAkk model.
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
     * Finds the PenganjuranKursusAkk model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PenganjuranKursusAkk the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PenganjuranKursusAkk::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionGetPenganjuranKursusAkk($id){
        // find Penganjuran Kursus AKK
        $model = PenganjuranKursusAkk::findOne($id);
        
        echo Json::encode($model);
    }
    
    public function actionLaporanSenaraiKursus()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new IsnLaporanSenaraiKursus();
        $model->format = 'html';

        if ($model->load(Yii::$app->request->post())) {
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-laporan-senarai-kursus'
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-laporan-senarai-kursus'
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'format' => $model->format
                ]);
            }
        } 

        return $this->render('laporan_senarai_kursus', [
            'model' => $model,
            'readonly' => false,
        ]);
    }
    
    public function actionGenerateLaporanSenaraiKursus($tarikh_dari, $tarikh_hingga, $format)
    {
        if($tarikh_dari == "") $tarikh_dari = array();
        else $tarikh_dari = array($tarikh_dari);
        
        if($tarikh_hingga == "") $tarikh_hingga = array();
        else $tarikh_hingga = array($tarikh_hingga);
        
        $controls = array(
            'FROM_DATE' => $tarikh_dari,
            'TO_DATE' => $tarikh_hingga,
        );
        
        GeneralFunction::generateReport('/spsb/ISN/LaporanSenaraiKursusAkk', $format, $controls, 'laporan_senarai_kursus');
    }
    
    public function actionLaporanSenaraiPeserta()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new IsnLaporanSenaraiPeserta();
        $model->format = 'html';

        if ($model->load(Yii::$app->request->post())) {
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-laporan-senarai-peserta'
                    , 'penganjuran_kursus_id' => $model->penganjuran_kursus_id
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-laporan-senarai-peserta'
                    , 'penganjuran_kursus_id' => $model->penganjuran_kursus_id
                    , 'format' => $model->format
                ]);
            }
        } 

        return $this->render('laporan_senarai_peserta', [
            'model' => $model,
            'readonly' => false,
        ]);
    }
    
    public function actionGenerateLaporanSenaraiPeserta($penganjuran_kursus_id, $format)
    {
        if($penganjuran_kursus_id == "") $penganjuran_kursus_id = array();
        else $penganjuran_kursus_id = array($penganjuran_kursus_id);
        
        $controls = array(
            'PENGANJURAN_KURSUS_ID' => $penganjuran_kursus_id,
        );
        
        GeneralFunction::generateReport('/spsb/ISN/LaporanSenaraiPesertaAkk', $format, $controls, 'laporan_senarai_peserta');
    }
}
