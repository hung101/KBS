<?php

namespace frontend\controllers;

use Yii;
use app\models\ProfilDelegasiTeknikal;
use frontend\models\ProfilDelegasiTeknikalSearch;
use app\models\ProfilDelegasiTeknikalAhli;
use frontend\models\ProfilDelegasiTeknikalAhliSearch;
use app\models\MsnLaporanDelegasiTeknikal;
use app\models\MsnLaporanStatistikDelegasiTeknikal;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\BaseUrl;

use app\models\general\GeneralVariable;
use common\models\general\GeneralFunction;

// table reference
use app\models\RefNegeri;
use app\models\RefPeringkatBadanSukan;
use app\models\RefSukan;
use app\models\RefBandar;
use app\models\ProfilBadanSukan;
use app\models\PengurusanJawatankuasaKhasSukanMalaysia;

/**
 * ProfilDelegasiTeknikalController implements the CRUD actions for ProfilDelegasiTeknikal model.
 */
class ProfilDelegasiTeknikalController extends Controller
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
     * Lists all ProfilDelegasiTeknikal models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $searchModel = new ProfilDelegasiTeknikalSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ProfilDelegasiTeknikal model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $queryPar = null;
        
        $queryPar['ProfilDelegasiTeknikalAhliSearch']['profil_delegasi_teknikal_id'] = $id;
        
        $searchModelProfilDelegasiTeknikalAhli  = new ProfilDelegasiTeknikalAhliSearch();
        $dataProviderProfilDelegasiTeknikalAhli = $searchModelProfilDelegasiTeknikalAhli->search($queryPar);
        
        $model = $this->findModel($id);
        
        $ref = RefNegeri::findOne(['id' => $model->negeri]);
        $model->negeri = $ref['desc'];
        
        $ref = RefPeringkatBadanSukan::findOne(['id' => $model->peringkat]);
        $model->peringkat = $ref['desc'];
        
        $ref = ProfilBadanSukan::findOne(['profil_badan_sukan' => $model->nama_badan_sukan]);
        $model->nama_badan_sukan = $ref['nama_badan_sukan'];
        
        $ref = RefSukan::findOne(['id' => $model->sukan]);
        $model->sukan = $ref['desc'];
        
        $ref = RefNegeri::findOne(['id' => $model->alamat_negeri]);
        $model->alamat_negeri = $ref['desc'];
        
        $ref = RefBandar::findOne(['id' => $model->alamat_bandar]);
        $model->alamat_bandar = $ref['desc'];
        
        $ref = PengurusanJawatankuasaKhasSukanMalaysia::findOne(['pengurusan_jawatankuasa_khas_sukan_malaysia_id' => $model->temasya]);
        $model->temasya = $ref['temasya'];
        
        return $this->render('view', [
            'model' => $model,
            'searchModelProfilDelegasiTeknikalAhli' => $searchModelProfilDelegasiTeknikalAhli,
            'dataProviderProfilDelegasiTeknikalAhli' => $dataProviderProfilDelegasiTeknikalAhli,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new ProfilDelegasiTeknikal model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new ProfilDelegasiTeknikal();
        
        $queryPar = null;
        
        Yii::$app->session->open();
        
        if(isset(Yii::$app->session->id)){
            $queryPar['ProfilDelegasiTeknikalAhliSearch']['session_id'] = Yii::$app->session->id;
        }
        
        $searchModelProfilDelegasiTeknikalAhli  = new ProfilDelegasiTeknikalAhliSearch();
        $dataProviderProfilDelegasiTeknikalAhli = $searchModelProfilDelegasiTeknikalAhli->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if(isset(Yii::$app->session->id)){
                ProfilDelegasiTeknikalAhli::updateAll(['profil_delegasi_teknikal_id' => $model->profil_delegasi_teknikal_id], 'session_id = "'.Yii::$app->session->id.'"');
                ProfilDelegasiTeknikalAhli::updateAll(['session_id' => ''], 'profil_delegasi_teknikal_id = "'.$model->profil_delegasi_teknikal_id.'"');
            }
            
            return $this->redirect(['view', 'id' => $model->profil_delegasi_teknikal_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'searchModelProfilDelegasiTeknikalAhli' => $searchModelProfilDelegasiTeknikalAhli,
                'dataProviderProfilDelegasiTeknikalAhli' => $dataProviderProfilDelegasiTeknikalAhli,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Updates an existing ProfilDelegasiTeknikal model.
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
        
        $queryPar['ProfilDelegasiTeknikalAhliSearch']['profil_delegasi_teknikal_id'] = $id;
        
        $searchModelProfilDelegasiTeknikalAhli  = new ProfilDelegasiTeknikalAhliSearch();
        $dataProviderProfilDelegasiTeknikalAhli = $searchModelProfilDelegasiTeknikalAhli->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->profil_delegasi_teknikal_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'searchModelProfilDelegasiTeknikalAhli' => $searchModelProfilDelegasiTeknikalAhli,
                'dataProviderProfilDelegasiTeknikalAhli' => $dataProviderProfilDelegasiTeknikalAhli,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Deletes an existing ProfilDelegasiTeknikal model.
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
     * Finds the ProfilDelegasiTeknikal model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ProfilDelegasiTeknikal the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ProfilDelegasiTeknikal::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionLaporanDelegasiTeknikal()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new MsnLaporanDelegasiTeknikal();
        $model->format = 'html';

        if ($model->load(Yii::$app->request->post())) {
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-laporan-delegasi-teknikal'
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'temasya' => $model->temasya
                    , 'sukan' => $model->sukan
                    , 'peringkat' => $model->peringkat
                    , 'nama_badan_sukan' => $model->nama_badan_sukan
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-laporan-delegasi-teknikal'
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'temasya' => $model->temasya
                    , 'sukan' => $model->sukan
                    , 'peringkat' => $model->peringkat
                    , 'nama_badan_sukan' => $model->nama_badan_sukan
                    , 'format' => $model->format
                ]);
            }
        } 

        return $this->render('laporan_delegasi_teknikal', [
            'model' => $model,
            'readonly' => false,
        ]);
    }
    
    public function actionGenerateLaporanDelegasiTeknikal($tarikh_dari, $tarikh_hingga, $temasya, $sukan, $peringkat, $nama_badan_sukan, $format)
    {
        if($tarikh_dari == "") $tarikh_dari = array();
        else $tarikh_dari = array($tarikh_dari);
        
        if($tarikh_hingga == "") $tarikh_hingga = array();
        else $tarikh_hingga = array($tarikh_hingga);
        
        if($temasya == "") $temasya = array();
        else $temasya = array($temasya);
        
        if($sukan == "") $sukan = array();
        else $sukan = array($sukan);
        
        if($peringkat == "") $peringkat = array();
        else $peringkat = array($peringkat);
        
        if($nama_badan_sukan == "") $nama_badan_sukan = array();
        else $nama_badan_sukan = array($nama_badan_sukan);
        
        $controls = array(
            'FROM_DATE' => $tarikh_dari,
            'TO_DATE' => $tarikh_hingga,
            'SUKAN' => $sukan,
            'PERINGKAT' => $peringkat,
            'NAMA_BADAN_SUKAN' => $nama_badan_sukan,
            'TEMASYA' => $temasya,
        );
        
        GeneralFunction::generateReport('/spsb/MSN/LaporanDelegasiTeknikal', $format, $controls, 'laporan_delegasi_teknikal');
    }
    
    public function actionLaporanStatistikDelegasiTeknikal()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new MsnLaporanStatistikDelegasiTeknikal();
        $model->format = 'html';

        if ($model->load(Yii::$app->request->post())) {
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-laporan-statistik-delegasi-teknikal'
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'temasya' => $model->temasya
                    , 'sukan' => $model->sukan
                    , 'peringkat' => $model->peringkat
                    , 'nama_badan_sukan' => $model->nama_badan_sukan
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-laporan-statistik-delegasi-teknikal'
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'temasya' => $model->temasya
                    , 'sukan' => $model->sukan
                    , 'peringkat' => $model->peringkat
                    , 'nama_badan_sukan' => $model->nama_badan_sukan
                    , 'format' => $model->format
                ]);
            }
        } 

        return $this->render('laporan_statistik_delegasi_teknikal', [
            'model' => $model,
            'readonly' => false,
        ]);
    }
    
    public function actionGenerateLaporanStatistikDelegasiTeknikal($tarikh_dari, $tarikh_hingga, $temasya, $sukan, $peringkat, $nama_badan_sukan, $format)
    {
        if($tarikh_dari == "") $tarikh_dari = array();
        else $tarikh_dari = array($tarikh_dari);
        
        if($tarikh_hingga == "") $tarikh_hingga = array();
        else $tarikh_hingga = array($tarikh_hingga);
        
        if($temasya == "") $temasya = array();
        else $temasya = array($temasya);
        
        if($sukan == "") $sukan = array();
        else $sukan = array($sukan);
        
        if($peringkat == "") $peringkat = array();
        else $peringkat = array($peringkat);
        
        if($nama_badan_sukan == "") $nama_badan_sukan = array();
        else $nama_badan_sukan = array($nama_badan_sukan);
        
        $controls = array(
            'FROM_DATE' => $tarikh_dari,
            'TO_DATE' => $tarikh_hingga,
            'SUKAN' => $sukan,
            'PERINGKAT' => $peringkat,
            'NAMA_BADAN_SUKAN' => $nama_badan_sukan,
            'TEMASYA' => $temasya,
        );
        
        GeneralFunction::generateReport('/spsb/MSN/LaporanStatistikDelegasiTeknikal', $format, $controls, 'laporan_statistik_delegasi_teknikal');
    }
}
