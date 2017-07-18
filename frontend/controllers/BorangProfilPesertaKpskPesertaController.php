<?php

namespace frontend\controllers;

use Yii;
use app\models\BorangProfilPesertaKpsk;
use app\models\BorangProfilPesertaKpskPeserta;
use frontend\models\BorangProfilPesertaKpskPesertaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use app\models\general\GeneralVariable;
use app\models\general\GeneralLabel;
use common\models\general\GeneralFunction;

// table reference
use app\models\RefNegeri;
use app\models\RefBandar;
use app\models\RefJantina;
use app\models\RefKeputusanKpsk;
use app\models\RefAkademikKpsk;
use app\models\RefBangsa;
use app\models\RefAgama;

/**
 * BorangProfilPesertaKpskPesertaController implements the CRUD actions for BorangProfilPesertaKpskPeserta model.
 */
class BorangProfilPesertaKpskPesertaController extends Controller
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
     * Lists all BorangProfilPesertaKpskPeserta models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $searchModel = new BorangProfilPesertaKpskPesertaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single BorangProfilPesertaKpskPeserta model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = $this->findModel($id);
        
        $ref = RefNegeri::findOne(['id' => $model->alamat_negeri]);
        $model->alamat_negeri = $ref['desc'];
        
        $ref = RefBandar::findOne(['id' => $model->alamat_bandar]);
        $model->alamat_bandar = $ref['desc'];
        
        $ref = RefJantina::findOne(['id' => $model->jantina]);
        $model->jantina = $ref['desc'];
        
        $ref = RefKeputusanKpsk::findOne(['id' => $model->keputusan]);
        $model->keputusan = $ref['desc'];
        
        $ref = RefAkademikKpsk::findOne(['id' => $model->akademik]);
        $model->akademik = $ref['desc'];
        
        $ref = RefBangsa::findOne(['id' => $model->bangsa]);
        $model->bangsa = $ref['desc'];
        
        $ref = RefAgama::findOne(['id' => $model->agama]);
        $model->agama = $ref['desc'];
        
        $YesNo = GeneralLabel::getYesNoLabel($model->kehadiran);
        $model->kehadiran = $YesNo;
        
        if($model->tarikh_lahir != "") {$model->tarikh_lahir = GeneralFunction::convert($model->tarikh_lahir, GeneralFunction::TYPE_DATE);}
        
        return $this->renderAjax('view', [
            'model' => $model,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new BorangProfilPesertaKpskPeserta model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($borang_profil_peserta_kpsk_id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new BorangProfilPesertaKpskPeserta();
        
        Yii::$app->session->open();
        
        if($borang_profil_peserta_kpsk_id != ''){
            $model->borang_profil_peserta_kpsk_id = $borang_profil_peserta_kpsk_id;
        } else {
            if(isset(Yii::$app->session->id)){
                $model->session_id = Yii::$app->session->id;
            }
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return '1';
        } else {
            return $this->renderAjax('create', [
                'model' => $model,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Updates an existing BorangProfilPesertaKpskPeserta model.
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
            return '1';
        } else {
            return $this->renderAjax('update', [
                'model' => $model,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Deletes an existing BorangProfilPesertaKpskPeserta model.
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

        //return $this->redirect(['index']);
    }

    /**
     * Finds the BorangProfilPesertaKpskPeserta model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return BorangProfilPesertaKpskPeserta the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = BorangProfilPesertaKpskPeserta::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionSuratKeputusan($borang_profil_peserta_kpsk_peserta_id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $format = 'pdf'; // only pdf format
        
        $model = $this->findModel($borang_profil_peserta_kpsk_peserta_id);
        
        $tahap = "";
        
        if (($modelBorangProfilPesertaKpsk = BorangProfilPesertaKpsk::findOne($model->borang_profil_peserta_kpsk_id)) !== null) {
            $tahap = $modelBorangProfilPesertaKpsk->tahap;
        } 
            
        if($tahap == '1'){
            if($format == "html") {
                $report_url = BaseUrl::to(['generate-surat-keputusan'
                    , 'borang_profil_peserta_kpsk_peserta_id' => $borang_profil_peserta_kpsk_peserta_id
                    , 'format' => $format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-surat-keputusan'
                    , 'borang_profil_peserta_kpsk_peserta_id' => $borang_profil_peserta_kpsk_peserta_id
                    , 'format' => $format
                ]);
            }
        } else {
            if($format == "html") {
                $report_url = BaseUrl::to(['generate-surat-keputusan-tahap-2'
                    , 'borang_profil_peserta_kpsk_peserta_id' => $borang_profil_peserta_kpsk_peserta_id
                    , 'format' => $format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-surat-keputusan-tahap-2'
                    , 'borang_profil_peserta_kpsk_peserta_id' => $borang_profil_peserta_kpsk_peserta_id
                    , 'format' => $format
                ]);
            }
        }
    }
    
    public function actionGenerateSuratKeputusan($borang_profil_peserta_kpsk_peserta_id, $format)
    {
        $id = $borang_profil_peserta_kpsk_peserta_id;
        
        if($borang_profil_peserta_kpsk_peserta_id == "") $borang_profil_peserta_kpsk_peserta_id = array();
        else $borang_profil_peserta_kpsk_peserta_id = array($borang_profil_peserta_kpsk_peserta_id);
        
        $controls = array(
            'PESERTA_ID' => $borang_profil_peserta_kpsk_peserta_id,
        );
        
        GeneralFunction::generateReport('/spsb/MSN/SuratKeputusanPesertaKPSK', $format, $controls, 'surat_keputusan_' . $id);
    }
    
    public function actionGenerateSuratKeputusanTahap2($borang_profil_peserta_kpsk_peserta_id, $format)
    {
        $id = $borang_profil_peserta_kpsk_peserta_id;
        
        if($borang_profil_peserta_kpsk_peserta_id == "") $borang_profil_peserta_kpsk_peserta_id = array();
        else $borang_profil_peserta_kpsk_peserta_id = array($borang_profil_peserta_kpsk_peserta_id);
        
        $controls = array(
            'PESERTA_ID' => $borang_profil_peserta_kpsk_peserta_id,
        );
        
        GeneralFunction::generateReport('/spsb/MSN/SuratKeputusanPesertaKPSKTahap2', $format, $controls, 'surat_keputusan_' . $id);
    }
}
