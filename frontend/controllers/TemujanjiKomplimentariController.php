<?php

namespace frontend\controllers;

use Yii;
use app\models\TemujanjiKomplimentari;
use frontend\models\TemujanjiKomplimentariSearch;
use app\models\IsnLaporanKomplimentori;
use app\models\IsnLaporanRingkasanStatistikKomplimentari;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\BaseUrl;

use app\models\general\GeneralVariable;
use common\models\general\GeneralFunction;

// table reference
use app\models\RefJantina;
use app\models\RefSukan;
use app\models\RefPerkhidmatanKomplimentari;
use app\models\Atlet;
use app\models\RefJuruUrut;
use app\models\RefStatusTemujanjiKomplimentari;
use app\models\RefLokasiKomplimentari;

/**
 * TemujanjiKomplimentariController implements the CRUD actions for TemujanjiKomplimentari model.
 */
class TemujanjiKomplimentariController extends Controller
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
     * Lists all TemujanjiKomplimentari models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $searchModel = new TemujanjiKomplimentariSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TemujanjiKomplimentari model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = $this->findModel($id);
        
        $ref = RefJantina::findOne(['id' => $model->jantina]);
        $model->jantina = $ref['desc'];
        
        $ref = RefSukan::findOne(['id' => $model->jenis_sukan]);
        $model->jenis_sukan = $ref['desc'];
        
        $ref = RefPerkhidmatanKomplimentari::findOne(['id' => $model->perkhidmatan]);
        $model->perkhidmatan = $ref['desc'];
        
        $ref = Atlet::findOne(['atlet_id' => $model->atlet_id]);
        $model->atlet_id = $ref['nameAndIC'];
        
        $ref = RefJuruUrut::findOne(['id' => $model->pegawai_yang_bertanggungjawab]);
        $model->pegawai_yang_bertanggungjawab = $ref['desc'];
        
        $ref = RefStatusTemujanjiKomplimentari::findOne(['id' => $model->status_temujanji]);
        $model->status_temujanji = $ref['desc'];
        
        $ref = RefLokasiKomplimentari::findOne(['id' => $model->lokasi]);
        $model->lokasi = $ref['desc'];
        
        return $this->render('view', [
            'model' => $model,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new TemujanjiKomplimentari model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new TemujanjiKomplimentari();
        
        $model->scenario = 'create';

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->temujanji_komplimentari_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Updates an existing TemujanjiKomplimentari model.
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
            return $this->redirect(['view', 'id' => $model->temujanji_komplimentari_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Deletes an existing TemujanjiKomplimentari model.
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
     * Finds the TemujanjiKomplimentari model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TemujanjiKomplimentari the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TemujanjiKomplimentari::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionLaporanKomplimentori()
    {

        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new IsnLaporanKomplimentori();
        $model->format = 'html';

        if ($model->load(Yii::$app->request->post())) {
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-laporan-komplimentori'
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'sukan' => $model->sukan
                    , 'pegawai_bertanggungjawab' => $model->pegawai_bertanggungjawab
                    , 'jantina' => $model->jantina
                    , 'perkhidmatan' => $model->perkhidmatan
                    , 'lokasi' => $model->lokasi
                    , 'status_temujanji' => $model->status_temujanji
                    , 'atlet' => $model->atlet
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-laporan-komplimentori'
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'sukan' => $model->sukan
                    , 'pegawai_bertanggungjawab' => $model->pegawai_bertanggungjawab
                    , 'jantina' => $model->jantina
                    , 'perkhidmatan' => $model->perkhidmatan
                    , 'lokasi' => $model->lokasi
                    , 'status_temujanji' => $model->status_temujanji
                    , 'atlet' => $model->atlet
                    , 'format' => $model->format
                ]);
            }
        } 

        return $this->render('laporan_komplimentori', [
            'model' => $model,
            'readonly' => false,
        ]);
    }

    public function actionGenerateLaporanKomplimentori($tarikh_dari, $tarikh_hingga, $sukan, $pegawai_bertanggungjawab, $jantina, $perkhidmatan, $lokasi, $status_temujanji, $atlet, $format)
    {
        if($tarikh_dari == "") $tarikh_dari = array();
        else $tarikh_dari = array($tarikh_dari);
        
        if($tarikh_hingga == "") $tarikh_hingga = array();
        else $tarikh_hingga = array($tarikh_hingga);
        
        if($sukan == "") $sukan = array();
        else $sukan = array($sukan);
        
        if($pegawai_bertanggungjawab == "") $pegawai_bertanggungjawab = array();
        else $pegawai_bertanggungjawab = array($pegawai_bertanggungjawab);
        
        if($jantina == "") $jantina = array();
        else $jantina = array($jantina);
        
        if($perkhidmatan == "") $perkhidmatan = array();
        else $perkhidmatan = array($perkhidmatan);
        
        if($lokasi == "") $lokasi = array();
        else $lokasi = array($lokasi);
        
        if($status_temujanji == "") $status_temujanji = array();
        else $status_temujanji = array($status_temujanji);
        
        if($atlet == "") $atlet = array();
        else $atlet = array($atlet);
        
        $controls = array(
            'FROM_DATE' => $tarikh_dari,
            'TO_DATE' => $tarikh_hingga,
            'SUKAN' => $sukan,
            'PEGAWAI_BERTANGGUNGJAWAB' => $pegawai_bertanggungjawab,
            'JANTINA' => $jantina,
            'PERKHIDMATAN' => $perkhidmatan,
            'LOKASI' => $lokasi,
            'STATUS_TEMUJANJI' => $status_temujanji,
            'ATLET' => $atlet,
        );
        
        GeneralFunction::generateReport('/spsb/ISN/LaporanKomplimentori', $format, $controls, 'laporan_komplimentori');
    }
    
    public function actionLaporanRingkasanStatistikKomplimentari()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new IsnLaporanRingkasanStatistikKomplimentari();
        $model->format = 'html';

        if ($model->load(Yii::$app->request->post())) {
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-laporan-ringkasan-statistik-komplimentari'
                    , 'tahun' => $model->tahun
                    , 'sukan' => $model->sukan
                    , 'pegawai_bertanggungjawab' => $model->pegawai_bertanggungjawab
                    , 'jantina' => $model->jantina
                    , 'perkhidmatan' => $model->perkhidmatan
                    , 'lokasi' => $model->lokasi
                    , 'status_temujanji' => $model->status_temujanji
                    , 'atlet' => $model->atlet
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-laporan-ringkasan-statistik-komplimentari'
                    , 'tahun' => $model->tahun
                    , 'sukan' => $model->sukan
                    , 'pegawai_bertanggungjawab' => $model->pegawai_bertanggungjawab
                    , 'jantina' => $model->jantina
                    , 'perkhidmatan' => $model->perkhidmatan
                    , 'lokasi' => $model->lokasi
                    , 'status_temujanji' => $model->status_temujanji
                    , 'atlet' => $model->atlet
                    , 'format' => $model->format
                ]);
            }
        } 

        return $this->render('laporan_ringkasan_statistik_komplimentari', [
            'model' => $model,
            'readonly' => false,
        ]);
    }
    
    public function actionGenerateLaporanRingkasanStatistikKomplimentari($tahun, $sukan, $pegawai_bertanggungjawab, $jantina, $perkhidmatan, $lokasi, $status_temujanji, $atlet, $format)
    {
        if($tahun == "") $tahun = array();
        else $tahun = array($tahun);
        
        if($sukan == "") $sukan = array();
        else $sukan = array($sukan);
        
        if($pegawai_bertanggungjawab == "") $pegawai_bertanggungjawab = array();
        else $pegawai_bertanggungjawab = array($pegawai_bertanggungjawab);
        
        if($jantina == "") $jantina = array();
        else $jantina = array($jantina);
        
        if($perkhidmatan == "") $perkhidmatan = array();
        else $perkhidmatan = array($perkhidmatan);
        
        if($lokasi == "") $lokasi = array();
        else $lokasi = array($lokasi);
        
        if($status_temujanji == "") $status_temujanji = array();
        else $status_temujanji = array($status_temujanji);
        
        if($atlet == "") $atlet = array();
        else $atlet = array($atlet);
        
        $controls = array(
            'YEAR' => $tahun,
            'SUKAN' => $sukan,
            'PEGAWAI_BERTANGGUNGJAWAB' => $pegawai_bertanggungjawab,
            'JANTINA' => $jantina,
            'PERKHIDMATAN' => $perkhidmatan,
            'LOKASI' => $lokasi,
            'STATUS_TEMUJANJI' => $status_temujanji,
            'ATLET' => $atlet,
        );
        
        GeneralFunction::generateReport('/spsb/ISN/LaporanRingkasanStatistikKomplimentari', $format, $controls, 'laporan_ringkasan_statistik_komplimentari');
    }
}
