<?php

namespace backend\controllers;

use Yii;
use app\models\TempahanKemudahanMsn;
use backend\models\TempahanKemudahanMsnSearch;
use app\models\TempahanKemudahanSubMsn;
use backend\models\TempahanKemudahanSubMsnSearch;
use app\models\EKemudahanLaporanPenggunaanDanHasilBagiKombes;
use app\models\EKemudahanLaporanKuantitiKemudahan;
use app\models\EKemudahanLaporanPenggunaanDanHasilBagiKombesTahunan;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\BaseUrl;

use app\models\general\GeneralVariable;
use common\models\general\GeneralFunction;

// table reference
use app\models\PengurusanKemudahanVenueMsn;
use app\models\PengurusanKemudahanSediaAdaMsn;
use app\models\RefNegeri;
use app\models\RefBandar;
use app\models\RefJenisKadarKemudahan;
use app\models\RefStatusTempahanKemudahan;
use app\models\RefAgensiKemudahan;

/**
 * TempahanKemudahanMsnController implements the CRUD actions for TempahanKemudahanMsn model.
 */
class TempahanKemudahanMsnController extends Controller
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
     * Lists all TempahanKemudahanMsn models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $queryPar = Yii::$app->request->queryParams;
        
        $queryPar['TempahanKemudahanMsnSearch']['public_user_pemohon_id'] = Yii::$app->user->identity->id;
        
        $searchModel = new TempahanKemudahanMsnSearch();
        $dataProvider = $searchModel->search($queryPar);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TempahanKemudahanMsn model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = $this->findModel($id);
        
        $ref = PengurusanKemudahanVenueMsn::findOne(['pengurusan_kemudahan_venue_id' => $model->venue]);
        $model->venue = $ref['nama_venue'];
        
        $ref = PengurusanKemudahanSediaAdaMsn::find()->joinWith(['refJenisKemudahan'])->where(['=', 'pengurusan_kemudahan_sedia_ada_id', $model->kemudahan])->asArray()->one();
        $model->kemudahan = $ref['refJenisKemudahan']['desc'];
        
        $ref = RefNegeri::findOne(['id' => $model->location_alamat_negeri]);
        $model->location_alamat_negeri = $ref['desc'];
        
        $ref = RefBandar::findOne(['id' => $model->location_alamat_bandar]);
        $model->location_alamat_bandar = $ref['desc'];
        
        $ref = RefJenisKadarKemudahan::findOne(['id' => $model->jenis_kadar]);
        $model->jenis_kadar = $ref['desc'];
        
        $ref = RefStatusTempahanKemudahan::findOne(['id' => $model->status]);
        $model->status = $ref['desc'];
        
        $ref = RefAgensiKemudahan::findOne(['id' => $model->agensi]);
        $model->agensi = $ref['desc'];
        
        //$model->tarikh_mula = GeneralFunction::convert($model->tarikh_mula, GeneralFunction::TYPE_DATETIME);
        
        $queryPar = null;
        
        $queryPar['TempahanKemudahanSubMsnSearch']['tempahan_kemudahan_id'] = $id;
        
        $searchModelTempahanKemudahanSubMsn  = new TempahanKemudahanSubMsnSearch();
        $dataProviderTempahanKemudahanSubMsn = $searchModelTempahanKemudahanSubMsn->search($queryPar);
        
        return $this->render('view', [
            'model' => $model,
            'searchModelTempahanKemudahanSubMsn' => $searchModelTempahanKemudahanSubMsn,
            'dataProviderTempahanKemudahanSubMsn' => $dataProviderTempahanKemudahanSubMsn,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new TempahanKemudahanMsn model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new TempahanKemudahanMsn();
        
        // set pemohon details
        $model->public_user_pemohon_id = Yii::$app->user->identity->id;
        $model->nama = Yii::$app->user->identity->full_name;
        $model->no_kad_pengenalan = Yii::$app->user->identity->username;
        $model->no_tel_bimbit = Yii::$app->user->identity->tel_bimbit_no;
        $model->emel = Yii::$app->user->identity->email;
        $model->alamat_pemohon = Yii::$app->user->identity->alamat_kemudahan_msn;
        $model->majikan = Yii::$app->user->identity->majikan_kemudahan_msn;
        $model->alamat_majikan = Yii::$app->user->identity->majikan_alamat_kemudahan_msn;
        
        $model->status = RefStatusTempahanKemudahan::SEDANG_DISEMAK;
        
        $queryPar = null;
        
        Yii::$app->session->open();
        
        if(isset(Yii::$app->session->id)){
            $queryPar['TempahanKemudahanSubMsnSearch']['session_id'] = Yii::$app->session->id;
        }
        
        $searchModelTempahanKemudahanSubMsn  = new TempahanKemudahanSubMsnSearch();
        $dataProviderTempahanKemudahanSubMsn = $searchModelTempahanKemudahanSubMsn->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if(isset(Yii::$app->session->id)){
                TempahanKemudahanSubMsn::updateAll(['tempahan_kemudahan_id' => $model->tempahan_kemudahan_id], 'session_id = "'.Yii::$app->session->id.'"');
                TempahanKemudahanSubMsn::updateAll(['session_id' => ''], 'tempahan_kemudahan_id = "'.$model->tempahan_kemudahan_id.'"');
            }
            
            return $this->redirect(['view', 'id' => $model->tempahan_kemudahan_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'searchModelTempahanKemudahanSubMsn' => $searchModelTempahanKemudahanSubMsn,
                'dataProviderTempahanKemudahanSubMsn' => $dataProviderTempahanKemudahanSubMsn,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Updates an existing TempahanKemudahanMsn model.
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
        
        $queryPar['TempahanKemudahanSubMsnSearch']['tempahan_kemudahan_id'] = $id;
        
        $searchModelTempahanKemudahanSubMsn  = new TempahanKemudahanSubMsnSearch();
        $dataProviderTempahanKemudahanSubMsn = $searchModelTempahanKemudahanSubMsn->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->tempahan_kemudahan_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'searchModelTempahanKemudahanSubMsn' => $searchModelTempahanKemudahanSubMsn,
                'dataProviderTempahanKemudahanSubMsn' => $dataProviderTempahanKemudahanSubMsn,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Deletes an existing TempahanKemudahanMsn model.
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
     * Finds the TempahanKemudahanMsn model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TempahanKemudahanMsn the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TempahanKemudahanMsn::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionLaporanPenggunaanDanHasilBagiKombes()
    {

        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new EKemudahanLaporanPenggunaanDanHasilBagiKombes();
        $model->format = 'html';

        if ($model->load(Yii::$app->request->post())) {
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-laporan-penggunaan-dan-hasil-bagi-kombes'
                    , 'negeri' => $model->negeri
                    , 'kategori' => $model->kategori
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-laporan-penggunaan-dan-hasil-bagi-kombes'
                    , 'negeri' => $model->negeri
                    , 'kategori' => $model->kategori
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'format' => $model->format
                ]);

            }

        } 

        return $this->render('laporan_penggunaan_dan_hasil_bagi_kombes', [
            'model' => $model,
            'readonly' => false,
        ]);
    }

    public function actionGenerateLaporanPenggunaanDanHasilBagiKombes($negeri, $kategori, $tarikh_dari, $tarikh_hingga, $format)
    {
        if($negeri == "") $negeri = array();
        else $negeri = array($negeri);
        
        if($kategori == "") $kategori = array();
        else $kategori = array($kategori);
        
        if($tarikh_dari == "") $tarikh_dari = array();
        else $tarikh_dari = array($tarikh_dari);
        
        if($tarikh_hingga == "") $tarikh_hingga = array();
        else $tarikh_hingga = array($tarikh_hingga);
        
        $controls = array(
            'NEGERI' => $negeri,
            'KATEGORI' => $kategori,
            'FROM_DATE' => $tarikh_dari,
            'TO_DATE' => $tarikh_hingga, 
        );
        
        GeneralFunction::generateReport('/spsb/kbs/eKemudahan/LaporanPenggunaanDanHasilBagiKombes', $format, $controls, 'laporan_penggunaan_dan_hasil_bagi_kombes');
    }
    
    public function actionLaporanKuantitiKemudahan()
    {

        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new EKemudahanLaporanKuantitiKemudahan();
        $model->format = 'html';

        if ($model->load(Yii::$app->request->post())) {
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-laporan-kuantiti-kemudahan'
                    , 'negeri' => $model->negeri
                    , 'kategori' => $model->kategori
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-laporan-kuantiti-kemudahan'
                    , 'negeri' => $model->negeri
                    , 'kategori' => $model->kategori
                    , 'format' => $model->format
                ]);

            }

        } 

        return $this->render('laporan_kuantiti_kemudahan', [
            'model' => $model,
            'readonly' => false,
        ]);
    }

    public function actionGenerateLaporanKuantitiKemudahan($negeri, $kategori, $format)
    {
        if($negeri == "") $negeri = array();
        else $negeri = array($negeri);
        
        if($kategori == "") $kategori = array();
        else $kategori = array($kategori);
        
        $controls = array(
            'NEGERI' => $negeri,
            'KATEGORI' => $kategori,
        );
        
        GeneralFunction::generateReport('/spsb/kbs/eKemudahan/LaporanKuantitiKemudahan', $format, $controls, 'laporan_kuantiti_kemudahan');
    }
    
    public function actionLaporanPenggunaanDanHasilBagiKombesTahunan()
    {

        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new EKemudahanLaporanPenggunaanDanHasilBagiKombesTahunan();
        $model->format = 'html';

        if ($model->load(Yii::$app->request->post())) {
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-laporan-penggunaan-dan-hasil-bagi-kombes-tahunan'
                    , 'tahun_1' => $model->tahun_1
                    , 'tahun_2' => $model->tahun_2
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-laporan-penggunaan-dan-hasil-bagi-kombes-tahunan'
                    , 'tahun_1' => $model->tahun_1
                    , 'tahun_2' => $model->tahun_2
                    , 'format' => $model->format
                ]);

            }

        } 

        return $this->render('laporan_penggunaan_dan_hasil_bagi_kombes_tahunan', [
            'model' => $model,
            'readonly' => false,
        ]);
    }

    public function actionGenerateLaporanPenggunaanDanHasilBagiKombesTahunan($tahun_1, $tahun_2, $format)
    {
        if($tahun_1 == "") $tahun_1 = array();
        else $tahun_1 = array($tahun_1);
        
        if($tahun_2 == "") $tahun_2 = array();
        else $tahun_2 = array($tahun_2);
        
        $controls = array(
            'YEAR_1' => $tahun_1,
            'YEAR_2' => $tahun_2,
        );
        
        GeneralFunction::generateReport('/spsb/kbs/eKemudahan/LaporanPenggunaanDanHasilTahunan', $format, $controls, 'laporan_penggunaan_dan_hasil_bagi_kombes_tahunan');
    }
    
    public function actionTempahanKemudahan($tempahan_kemudahan_id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $format = 'pdf';
            
            if($format == "html") {
                $report_url = BaseUrl::to(['generate-tempahan-kemudahan'
                    , 'tempahan_kemudahan_id' => $tempahan_kemudahan_id
                    , 'format' => $format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-tempahan-kemudahan'
                    , 'tempahan_kemudahan_id' => $tempahan_kemudahan_id
                    , 'format' => $format
                ]);
            }
    }
    
    public function actionGenerateTempahanKemudahan($tempahan_kemudahan_id, $format)
    {
        $id = $tempahan_kemudahan_id;
        
        if($tempahan_kemudahan_id == "") $tempahan_kemudahan_id = array();
        else $tempahan_kemudahan_id = array($tempahan_kemudahan_id);
        
        $controls = array(
            'TEMPAHAN_ID' => $tempahan_kemudahan_id,
        );
        
        GeneralFunction::generateReport('/spsb/MSN/TempahanKemudahan', $format, $controls, 'tempahan_kemudahan_' . $id);
    }
}
