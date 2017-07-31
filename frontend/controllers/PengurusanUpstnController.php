<?php

namespace frontend\controllers;

use Yii;
use app\models\PengurusanUpstn;
use frontend\models\PengurusanUpstnSearch;
use app\models\PengurusanUpstnAtlet;
use frontend\models\PengurusanUpstnAtletSearch;
use app\models\PengurusanUpstnJurulatih;
use frontend\models\PengurusanUpstnJurulatihSearch;
use app\models\MsnLaporanStatistikPemantauan;
use app\models\MsnLaporanUsptnPecahanKaum;
use app\models\MsnLaporanUsptnPecahanUmur;
use app\models\MsnLaporanUsptnLawatanPemantauan;
use app\models\MsnLaporanUsptnPerjumpaanAtlet;
use app\models\MsnLaporanUsptnPerjumpaanJurulatih;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\BaseUrl;

// contant values
use app\models\general\GeneralVariable;
use common\models\general\GeneralFunction;

// table reference
use app\models\RefSukan;
use app\models\RefPpn;
use app\models\RefNegeri;

/**
 * PengurusanUpstnController implements the CRUD actions for PengurusanUpstn model.
 */
class PengurusanUpstnController extends Controller
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
     * Lists all PengurusanUpstn models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $searchModel = new PengurusanUpstnSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PengurusanUpstn model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = $this->findModel($id);
        
        $ref = RefSukan::findOne(['id' => $model->nama_sukan]);
        $model->nama_sukan = $ref['desc'];
        
        $ref = RefPpn::findOne(['id' => $model->nama_pengurus_sukan]);
        $model->nama_pengurus_sukan = $ref['desc'];
        
        $ref = RefNegeri::findOne(['id' => $model->negeri]);
        $model->negeri = $ref['desc'];
        
        if($model->tarikh_lawatan != "") {$model->tarikh_lawatan = GeneralFunction::convert($model->tarikh_lawatan, GeneralFunction::TYPE_DATETIME);}
        
        $queryPar = null;
        
        $queryPar['PengurusanUpstnAtletSearch']['pengurusan_upstn_id'] = $id;
        $queryPar['PengurusanUpstnJurulatihSearch']['pengurusan_upstn_id'] = $id;
        
        
        $searchModelPengurusanUpstnAtlet  = new PengurusanUpstnAtletSearch();
        $dataProviderPengurusanUpstnAtlet = $searchModelPengurusanUpstnAtlet->search($queryPar);
        
        $searchModelPengurusanUpstnJurulatih  = new PengurusanUpstnJurulatihSearch();
        $dataProviderPengurusanUpstnJurulatih= $searchModelPengurusanUpstnJurulatih->search($queryPar);
        
        return $this->render('view', [
            'model' => $model,
            'searchModelPengurusanUpstnAtlet' => $searchModelPengurusanUpstnAtlet,
            'dataProviderPengurusanUpstnAtlet' => $dataProviderPengurusanUpstnAtlet,
            'searchModelPengurusanUpstnJurulatih' => $searchModelPengurusanUpstnJurulatih,
            'dataProviderPengurusanUpstnJurulatih' => $dataProviderPengurusanUpstnJurulatih,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new PengurusanUpstn model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new PengurusanUpstn();
        
        $queryPar = null;
        
        Yii::$app->session->open();
        
        if(isset(Yii::$app->session->id)){
            $queryPar['PengurusanUpstnAtletSearch']['session_id'] = Yii::$app->session->id;
             $queryPar['PengurusanUpstnJurulatihSearch']['session_id'] = Yii::$app->session->id;
        }
        
        $searchModelPengurusanUpstnAtlet  = new PengurusanUpstnAtletSearch();
        $dataProviderPengurusanUpstnAtlet = $searchModelPengurusanUpstnAtlet->search($queryPar);
        
        $searchModelPengurusanUpstnJurulatih  = new PengurusanUpstnJurulatihSearch();
        $dataProviderPengurusanUpstnJurulatih= $searchModelPengurusanUpstnJurulatih->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if(isset(Yii::$app->session->id)){
                PengurusanUpstnAtlet::updateAll(['pengurusan_upstn_id' => $model->pengurusan_upstn_id], 'session_id = "'.Yii::$app->session->id.'"');
                PengurusanUpstnAtlet::updateAll(['session_id' => ''], 'pengurusan_upstn_id = "'.$model->pengurusan_upstn_id.'"');
                
                PengurusanUpstnJurulatih::updateAll(['pengurusan_upstn_id' => $model->pengurusan_upstn_id], 'session_id = "'.Yii::$app->session->id.'"');
                PengurusanUpstnJurulatih::updateAll(['session_id' => ''], 'pengurusan_upstn_id = "'.$model->pengurusan_upstn_id.'"');
            }
            
            return $this->redirect(['view', 'id' => $model->pengurusan_upstn_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'searchModelPengurusanUpstnAtlet' => $searchModelPengurusanUpstnAtlet,
                'dataProviderPengurusanUpstnAtlet' => $dataProviderPengurusanUpstnAtlet,
                'searchModelPengurusanUpstnJurulatih' => $searchModelPengurusanUpstnJurulatih,
                'dataProviderPengurusanUpstnJurulatih' => $dataProviderPengurusanUpstnJurulatih,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Updates an existing PengurusanUpstn model.
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
        
        $queryPar['PengurusanUpstnAtletSearch']['pengurusan_upstn_id'] = $id;
        $queryPar['PengurusanUpstnJurulatihSearch']['pengurusan_upstn_id'] = $id;
        
        
        $searchModelPengurusanUpstnAtlet  = new PengurusanUpstnAtletSearch();
        $dataProviderPengurusanUpstnAtlet = $searchModelPengurusanUpstnAtlet->search($queryPar);
        
        $searchModelPengurusanUpstnJurulatih  = new PengurusanUpstnJurulatihSearch();
        $dataProviderPengurusanUpstnJurulatih= $searchModelPengurusanUpstnJurulatih->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->pengurusan_upstn_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'searchModelPengurusanUpstnAtlet' => $searchModelPengurusanUpstnAtlet,
                'dataProviderPengurusanUpstnAtlet' => $dataProviderPengurusanUpstnAtlet,
                'searchModelPengurusanUpstnJurulatih' => $searchModelPengurusanUpstnJurulatih,
                'dataProviderPengurusanUpstnJurulatih' => $dataProviderPengurusanUpstnJurulatih,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Deletes an existing PengurusanUpstn model.
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
     * Finds the PengurusanUpstn model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PengurusanUpstn the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PengurusanUpstn::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionLaporanStatistikPemantauan()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new MsnLaporanStatistikPemantauan();
        $model->format = 'html';

        if ($model->load(Yii::$app->request->post())) {
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-laporan-statistik-pemantauan'
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'nama_ppn' => $model->nama_ppn
                    , 'sukan' => $model->sukan
                    , 'negeri' => $model->negeri
                    , 'jumlah_pemantauan' => $model->jumlah_pemantauan
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-laporan-statistik-pemantauan'
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'nama_ppn' => $model->nama_ppn
                    , 'sukan' => $model->sukan
                    , 'negeri' => $model->negeri
                    , 'jumlah_pemantauan' => $model->jumlah_pemantauan
                    , 'format' => $model->format
                ]);
            }
        } 

        return $this->render('laporan_statistik_pemantauan', [
            'model' => $model,
            'readonly' => false,
        ]);
    }
    
    public function actionGenerateLaporanStatistikPemantauan($tarikh_dari, $tarikh_hingga, $nama_ppn, $sukan, $negeri, $jumlah_pemantauan, $format)
    {
        if($tarikh_dari == "") $tarikh_dari = array();
        else $tarikh_dari = array($tarikh_dari);
        
        if($tarikh_hingga == "") $tarikh_hingga = array();
        else $tarikh_hingga = array($tarikh_hingga);
        
        if($nama_ppn == "") $nama_ppn = array();
        else $nama_ppn = array($nama_ppn);
        
        if($sukan == "") $sukan = array();
        else $sukan = array($sukan);
        
        if($negeri == "") $negeri = array();
        else $negeri = array($negeri);
        
        if($jumlah_pemantauan == "") $jumlah_pemantauan = array();
        else $jumlah_pemantauan = array($jumlah_pemantauan);
        
        $controls = array(
            'FROM_DATE' => $tarikh_dari,
            'TO_DATE' => $tarikh_hingga,
            'SUKAN' => $sukan,
            'NAMA_PPN' => $nama_ppn,
            'NEGERI' => $negeri,
            'JUMLAH_PEMANTAUAN' => $jumlah_pemantauan,
        );
        
        GeneralFunction::generateReport('/spsb/MSN/LaporanStatistikPemantauan', $format, $controls, 'laporan_statistik_pemantauan');
    }
    
    public function actionLaporanUsptnPecahanKaum()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new MsnLaporanUsptnPecahanKaum();
        $model->format = 'html';

        if ($model->load(Yii::$app->request->post())) {
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-laporan-usptn-pecahan-kaum'
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'nama_ppn' => $model->nama_ppn
                    , 'sukan' => $model->sukan
                    , 'negeri' => $model->negeri
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-laporan-usptn-pecahan-kaum'
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'nama_ppn' => $model->nama_ppn
                    , 'sukan' => $model->sukan
                    , 'negeri' => $model->negeri
                    , 'format' => $model->format
                ]);
            }
        } 

        return $this->render('laporan_usptn_pecahan_kaum', [
            'model' => $model,
            'readonly' => false,
        ]);
    }
    
    public function actionGenerateLaporanUsptnPecahanKaum($tarikh_dari, $tarikh_hingga, $nama_ppn, $sukan, $negeri, $format)
    {
        if($tarikh_dari == "") $tarikh_dari = array();
        else $tarikh_dari = array($tarikh_dari);
        
        if($tarikh_hingga == "") $tarikh_hingga = array();
        else $tarikh_hingga = array($tarikh_hingga);
        
        if($nama_ppn == "") $nama_ppn = array();
        else $nama_ppn = array($nama_ppn);
        
        if($sukan == "") $sukan = array();
        else $sukan = array($sukan);
        
        if($negeri == "") $negeri = array();
        else $negeri = array($negeri);
        
        $controls = array(
            'FROM_DATE' => $tarikh_dari,
            'TO_DATE' => $tarikh_hingga,
            'SUKAN' => $sukan,
            'NAMA_PPN' => $nama_ppn,
            'NEGERI' => $negeri,
        );
        
        GeneralFunction::generateReport('/spsb/MSN/LaporanUsptnPecahanKaum', $format, $controls, 'laporan_usptn_pecahan_kaum');
    }
    
    public function actionLaporanUsptnPecahanUmur()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new MsnLaporanUsptnPecahanUmur();
        $model->format = 'html';

        if ($model->load(Yii::$app->request->post())) {
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-laporan-usptn-pecahan-umur'
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'nama_ppn' => $model->nama_ppn
                    , 'sukan' => $model->sukan
                    , 'negeri' => $model->negeri
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-laporan-usptn-pecahan-umur'
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'nama_ppn' => $model->nama_ppn
                    , 'sukan' => $model->sukan
                    , 'negeri' => $model->negeri
                    , 'format' => $model->format
                ]);
            }
        } 

        return $this->render('laporan_usptn_pecahan_umur', [
            'model' => $model,
            'readonly' => false,
        ]);
    }
    
    public function actionGenerateLaporanUsptnPecahanUmur($tarikh_dari, $tarikh_hingga, $nama_ppn, $sukan, $negeri, $format)
    {
        if($tarikh_dari == "") $tarikh_dari = array();
        else $tarikh_dari = array($tarikh_dari);
        
        if($tarikh_hingga == "") $tarikh_hingga = array();
        else $tarikh_hingga = array($tarikh_hingga);
        
        if($nama_ppn == "") $nama_ppn = array();
        else $nama_ppn = array($nama_ppn);
        
        if($sukan == "") $sukan = array();
        else $sukan = array($sukan);
        
        if($negeri == "") $negeri = array();
        else $negeri = array($negeri);
        
        $controls = array(
            'FROM_DATE' => $tarikh_dari,
            'TO_DATE' => $tarikh_hingga,
            'SUKAN' => $sukan,
            'NAMA_PPN' => $nama_ppn,
            'NEGERI' => $negeri,
        );
        
        GeneralFunction::generateReport('/spsb/MSN/LaporanUsptnPecahanUmur', $format, $controls, 'laporan_usptn_pecahan_umur');
    }
    
    public function actionLaporanUsptnPerjumpaanAtlet()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new MsnLaporanUsptnPerjumpaanAtlet();
        $model->format = 'html';

        if ($model->load(Yii::$app->request->post())) {
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-laporan-usptn-perjumpaan-atlet'
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'nama_ppn' => $model->nama_ppn
                    , 'sukan' => $model->sukan
                    , 'negeri' => $model->negeri
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-laporan-usptn-perjumpaan-atlet'
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'nama_ppn' => $model->nama_ppn
                    , 'sukan' => $model->sukan
                    , 'negeri' => $model->negeri
                    , 'format' => $model->format
                ]);
            }
        } 

        return $this->render('laporan_usptn_perjumpaan_atlet', [
            'model' => $model,
            'readonly' => false,
        ]);
    }
    
    public function actionGenerateLaporanUsptnPerjumpaanAtlet($tarikh_dari, $tarikh_hingga, $nama_ppn, $sukan, $negeri, $format)
    {
        if($tarikh_dari == "") $tarikh_dari = array();
        else $tarikh_dari = array($tarikh_dari);
        
        if($tarikh_hingga == "") $tarikh_hingga = array();
        else $tarikh_hingga = array($tarikh_hingga);
        
        if($nama_ppn == "") $nama_ppn = array();
        else $nama_ppn = array($nama_ppn);
        
        if($sukan == "") $sukan = array();
        else $sukan = array($sukan);
        
        if($negeri == "") $negeri = array();
        else $negeri = array($negeri);
        
        $controls = array(
            'FROM_DATE' => $tarikh_dari,
            'TO_DATE' => $tarikh_hingga,
            'SUKAN' => $sukan,
            'NAMA_PPN' => $nama_ppn,
            'NEGERI' => $negeri,
        );
        
        GeneralFunction::generateReport('/spsb/MSN/LaporanUsptnPerjumpaanAtlet', $format, $controls, 'laporan_usptn_perjumpaan_atlet');
    }
    
    public function actionLaporanUsptnPerjumpaanJurulatih()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new MsnLaporanUsptnPerjumpaanJurulatih();
        $model->format = 'html';

        if ($model->load(Yii::$app->request->post())) {
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-laporan-usptn-perjumpaan-jurulatih'
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'nama_ppn' => $model->nama_ppn
                    , 'sukan' => $model->sukan
                    , 'negeri' => $model->negeri
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-laporan-usptn-perjumpaan-jurulatih'
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'nama_ppn' => $model->nama_ppn
                    , 'sukan' => $model->sukan
                    , 'negeri' => $model->negeri
                    , 'format' => $model->format
                ]);
            }
        } 

        return $this->render('laporan_usptn_perjumpaan_jurulatih', [
            'model' => $model,
            'readonly' => false,
        ]);
    }
    
    public function actionGenerateLaporanUsptnPerjumpaanJurulatih($tarikh_dari, $tarikh_hingga, $nama_ppn, $sukan, $negeri, $format)
    {
        if($tarikh_dari == "") $tarikh_dari = array();
        else $tarikh_dari = array($tarikh_dari);
        
        if($tarikh_hingga == "") $tarikh_hingga = array();
        else $tarikh_hingga = array($tarikh_hingga);
        
        if($nama_ppn == "") $nama_ppn = array();
        else $nama_ppn = array($nama_ppn);
        
        if($sukan == "") $sukan = array();
        else $sukan = array($sukan);
        
        if($negeri == "") $negeri = array();
        else $negeri = array($negeri);
        
        $controls = array(
            'FROM_DATE' => $tarikh_dari,
            'TO_DATE' => $tarikh_hingga,
            'SUKAN' => $sukan,
            'NAMA_PPN' => $nama_ppn,
            'NEGERI' => $negeri,
        );
        
        GeneralFunction::generateReport('/spsb/MSN/LaporanUsptnPerjumpaanJurulatih', $format, $controls, 'laporan_usptn_perjumpaan_jurulatih');
    }
    
    public function actionLaporanUsptnLawatanPemantauan()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new MsnLaporanUsptnLawatanPemantauan();
        $model->format = 'html';

        if ($model->load(Yii::$app->request->post())) {
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-laporan-usptn-lawatan-pemantauan'
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'nama_ppn' => $model->nama_ppn
                    , 'sukan' => $model->sukan
                    , 'negeri' => $model->negeri
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-laporan-usptn-lawatan-pemantauan'
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'nama_ppn' => $model->nama_ppn
                    , 'sukan' => $model->sukan
                    , 'negeri' => $model->negeri
                    , 'format' => $model->format
                ]);
            }
        } 

        return $this->render('laporan_usptn_lawatan_pemantauan', [
            'model' => $model,
            'readonly' => false,
        ]);
    }
    
    public function actionGenerateLaporanUsptnLawatanPemantauan($tarikh_dari, $tarikh_hingga, $nama_ppn, $sukan, $negeri, $format)
    {
        if($tarikh_dari == "") $tarikh_dari = array();
        else $tarikh_dari = array($tarikh_dari);
        
        if($tarikh_hingga == "") $tarikh_hingga = array();
        else $tarikh_hingga = array($tarikh_hingga);
        
        if($nama_ppn == "") $nama_ppn = array();
        else $nama_ppn = array($nama_ppn);
        
        if($sukan == "") $sukan = array();
        else $sukan = array($sukan);
        
        if($negeri == "") $negeri = array();
        else $negeri = array($negeri);
        
        $controls = array(
            'FROM_DATE' => $tarikh_dari,
            'TO_DATE' => $tarikh_hingga,
            'SUKAN' => $sukan,
            'NAMA_PPN' => $nama_ppn,
            'NEGERI' => $negeri,
        );
        
        GeneralFunction::generateReport('/spsb/MSN/LaporanUsptnLawatanPemantauan', $format, $controls, 'laporan_usptn_lawatan_pemantauan');
    }
}
