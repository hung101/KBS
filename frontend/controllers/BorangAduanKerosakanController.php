<?php

namespace frontend\controllers;

use Yii;
use app\models\BorangAduanKerosakan;
use frontend\models\BorangAduanKerosakanSearch;
use app\models\BorangAduanKerosakanJenisKerosakan;
use frontend\models\BorangAduanKerosakanJenisKerosakanSearch;
use app\models\MsnLaporanAduanKerosakan;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\BaseUrl;

use app\models\general\GeneralVariable;
use common\models\general\GeneralFunction;

use app\models\PengurusanPenyelia;
use app\models\UserPeranan;
use app\models\RefBahagianAduan;
use app\models\RefVenueAduan;
use app\models\RefKawasanKemudahan;

/**
 * BorangAduanKerosakanController implements the CRUD actions for BorangAduanKerosakan model.
 */
class BorangAduanKerosakanController extends Controller
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
     * Lists all BorangAduanKerosakan models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $queryPar = Yii::$app->request->queryParams;
        
        if(Yii::$app->user->identity->peranan == UserPeranan::PERANAN_MSN_ADUAN_PENYELIA){
            $queryPar['BorangAduanKerosakanSearch']['penyelia_id'] = Yii::$app->user->identity->id;
        }
        
        $searchModel = new BorangAduanKerosakanSearch();
        $dataProvider = $searchModel->search($queryPar);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single BorangAduanKerosakan model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = $this->findModel($id);
        
        $ref = PengurusanPenyelia::findOne(['id' => $model->penyelia]);
        $model->penyelia = $ref['full_name'];
        
        $ref = RefBahagianAduan::findOne(['id' => $model->bahagian]);
        $model->bahagian = $ref['desc'];
        
        $ref = RefVenueAduan::findOne(['id' => $model->venue]);
        $model->venue = $ref['desc'];
        
        $ref = RefKawasanKemudahan::findOne(['id' => $model->kawasan]);
        $model->kawasan = $ref['desc'];
        
        $queryPar = null;
        
        $queryPar['BorangAduanKerosakanJenisKerosakanSearch']['borang_aduan_kerosakan_id'] = $id;
        
        $searchModelBorangAduanKerosakanJenisKerosakan  = new BorangAduanKerosakanJenisKerosakanSearch();
        $dataProviderBorangAduanKerosakanJenisKerosakan = $searchModelBorangAduanKerosakanJenisKerosakan->search($queryPar);
        
        return $this->render('view', [
            'model' => $model,
            'searchModelBorangAduanKerosakanJenisKerosakan' => $searchModelBorangAduanKerosakanJenisKerosakan,
            'dataProviderBorangAduanKerosakanJenisKerosakan' => $dataProviderBorangAduanKerosakanJenisKerosakan,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new BorangAduanKerosakan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->isGuest) {
            $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new BorangAduanKerosakan();
        
        if(Yii::$app->user->identity->peranan == UserPeranan::PERANAN_MSN_ADUAN_PENYELIA){
            $model->penyelia = Yii::$app->user->identity->id;
            $model->jawatan = Yii::$app->user->identity->aduan_jawatan;
            $model->venue = Yii::$app->user->identity->aduan_venue;
            $model->bahagian = Yii::$app->user->identity->aduan_bahagian;
            $model->kawasan = Yii::$app->user->identity->aduan_kawasan_kemudahan;
            $model->no_tel_pejabat = Yii::$app->user->identity->tel_no;
            $model->no_tel_bimbit = Yii::$app->user->identity->tel_mobile_no;
        }
        
        $queryPar = null;
        
        Yii::$app->session->open();
        
        if(isset(Yii::$app->session->id)){
            $queryPar['BorangAduanKerosakanJenisKerosakanSearch']['session_id'] = Yii::$app->session->id;
        }
        
        $searchModelBorangAduanKerosakanJenisKerosakan  = new BorangAduanKerosakanJenisKerosakanSearch();
        $dataProviderBorangAduanKerosakanJenisKerosakan = $searchModelBorangAduanKerosakanJenisKerosakan->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if(isset(Yii::$app->session->id)){
                BorangAduanKerosakanJenisKerosakan::updateAll(['borang_aduan_kerosakan_id' => $model->borang_aduan_kerosakan_id], 'session_id = "'.Yii::$app->session->id.'"');
                BorangAduanKerosakanJenisKerosakan::updateAll(['session_id' => ''], 'borang_aduan_kerosakan_id = "'.$model->borang_aduan_kerosakan_id.'"');
            }
            
            if(Yii::$app->user->identity->peranan == UserPeranan::PERANAN_MSN_ADUAN_PENYELIA){
                Yii::$app->mailer->compose()
                        //->setTo("edward@lunas.my")
                        ->setTo("caw.teknikal@gmail.com")
                        ->setFrom('noreply@spsb.com')
                        ->setSubject('SPSB Pemberitahuan: Aduan Kerosakan')
                        ->setTextBody("Salam Sejahtera,

Aduan daripada " . Yii::$app->user->identity->full_name . " telah diterima pada " . $model->tarikh . "
Sila klik " . Yii::$app->urlManager->createAbsoluteUrl(['']) . ' untuk tindakan.

Sekian, terima kasih.
')->send();
            }
            
            return $this->redirect(['view', 'id' => $model->borang_aduan_kerosakan_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'searchModelBorangAduanKerosakanJenisKerosakan' => $searchModelBorangAduanKerosakanJenisKerosakan,
                'dataProviderBorangAduanKerosakanJenisKerosakan' => $dataProviderBorangAduanKerosakanJenisKerosakan,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Updates an existing BorangAduanKerosakan model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if (Yii::$app->user->isGuest) {
            $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = $this->findModel($id);
        
        $queryPar = null;
        
        $queryPar['BorangAduanKerosakanJenisKerosakanSearch']['borang_aduan_kerosakan_id'] = $id;
        
        $searchModelBorangAduanKerosakanJenisKerosakan  = new BorangAduanKerosakanJenisKerosakanSearch();
        $dataProviderBorangAduanKerosakanJenisKerosakan = $searchModelBorangAduanKerosakanJenisKerosakan->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->borang_aduan_kerosakan_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'searchModelBorangAduanKerosakanJenisKerosakan' => $searchModelBorangAduanKerosakanJenisKerosakan,
                'dataProviderBorangAduanKerosakanJenisKerosakan' => $dataProviderBorangAduanKerosakanJenisKerosakan,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Deletes an existing BorangAduanKerosakan model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if (Yii::$app->user->isGuest) {
            $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the BorangAduanKerosakan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return BorangAduanKerosakan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = BorangAduanKerosakan::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionBorangAduanKerosakan($borang_aduan_kerosakan_id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $format = 'pdf';
            
            if($format == "html") {
                $report_url = BaseUrl::to(['generate-borang-aduan-kerosakan'
                    , 'borang_id' => $borang_aduan_kerosakan_id
                    , 'format' => $format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-borang-aduan-kerosakan'
                    , 'borang_id' => $borang_aduan_kerosakan_id
                    , 'format' => $format
                ]);
            }
    }
    
    public function actionGenerateBorangAduanKerosakan($borang_id, $format)
    {
        $id = $borang_id;
        
        if($borang_id == "") $borang_id = array();
        else $borang_id = array($borang_id);
        
        $controls = array(
            'BORANG_ID' => $borang_id,
        );
        
        GeneralFunction::generateReport('/spsb/MSN/BorangAduanKerosakan', $format, $controls, 'borang_aduan_kerosakan_' . $id);
    }
    
    public function actionLaporanAduanKerosakan()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new MsnLaporanAduanKerosakan();
        $model->format = 'html';

        if ($model->load(Yii::$app->request->post())) {
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-laporan-aduan-kerosakan'
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'venue' => $model->venue
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-laporan-aduan-kerosakan'
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'venue' => $model->venue
                    , 'format' => $model->format
                ]);
            }
        } 

        return $this->render('laporan_aduan_kerosakan', [
            'model' => $model,
            'readonly' => false,
        ]);
    }
    
    public function actionGenerateLaporanAduanKerosakan($tarikh_dari, $tarikh_hingga, $venue, $format)
    {
        if($tarikh_dari == "") $tarikh_dari = array();
        else $tarikh_dari = array($tarikh_dari);
        
        if($tarikh_hingga == "") $tarikh_hingga = array();
        else $tarikh_hingga = array($tarikh_hingga);
        
        if($venue == "") $venue = array();
        else $venue = array($venue);
        
        $controls = array(
            'FROM_DATE' => $tarikh_dari,
            'TO_DATE' => $tarikh_hingga,
            'VENUE' => $venue,
        );
        
        GeneralFunction::generateReport('/spsb/MSN/LaporanAduanKerosakan', $format, $controls, 'laporan_aduan_kerosakan');
    }
}
