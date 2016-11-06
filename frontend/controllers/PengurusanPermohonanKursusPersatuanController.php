<?php

namespace frontend\controllers;

use Yii;
use app\models\PengurusanPermohonanKursusPersatuan;
use frontend\models\PengurusanPermohonanKursusPersatuanSearch;
use app\models\PengurusanPermohonanKursusPersatuanPenasihat;
use frontend\models\PengurusanPermohonanKursusPersatuanPenasihatSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;

// contant values
use app\models\general\GeneralVariable;
use app\models\general\GeneralLabel;
use common\models\general\GeneralFunction;

// table reference
use app\models\RefJantina;
use app\models\RefBandar;
use app\models\RefNegeri;
use app\models\RefTahapKpsk;
use app\models\RefStatusPermohonanJkk;

/**
 * PengurusanPermohonanKursusPersatuanController implements the CRUD actions for PengurusanPermohonanKursusPersatuan model.
 */
class PengurusanPermohonanKursusPersatuanController extends Controller
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
     * Lists all PengurusanPermohonanKursusPersatuan models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $searchModel = new PengurusanPermohonanKursusPersatuanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PengurusanPermohonanKursusPersatuan model.
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
        
        $ref = RefNegeri::findOne(['id' => $model->alamat_negeri]);
        $model->alamat_negeri = $ref['desc'];
        
        $ref = RefBandar::findOne(['id' => $model->alamat_bandar]);
        $model->alamat_bandar = $ref['desc'];
        
        $ref = RefTahapKpsk::findOne(['id' => $model->tahap]);
        $model->tahap = $ref['desc'];
        
        $model->kelulusan_id = $model->kelulusan;
        $ref = RefStatusPermohonanJkk::findOne(['id' => $model->kelulusan]);
        $model->kelulusan = $ref['desc'];
        
        //$model->kelulusan = GeneralLabel::getYesNoLabel($model->kelulusan);
        
        $queryPar = null;
        
        $queryPar['PengurusanPermohonanKursusPersatuanPenasihatSearch']['pengurusan_permohonan_kursus_persatuan_id'] = $id;
        
        $searchModelPengurusanPermohonanKursusPersatuanPenasihat  = new PengurusanPermohonanKursusPersatuanPenasihatSearch();
        $dataProviderPengurusanPermohonanKursusPersatuanPenasihat = $searchModelPengurusanPermohonanKursusPersatuanPenasihat->search($queryPar);
        
        return $this->render('view', [
            'model' => $model,
            'searchModelPengurusanPermohonanKursusPersatuanPenasihat' => $searchModelPengurusanPermohonanKursusPersatuanPenasihat,
            'dataProviderPengurusanPermohonanKursusPersatuanPenasihat' => $dataProviderPengurusanPermohonanKursusPersatuanPenasihat,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new PengurusanPermohonanKursusPersatuan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new PengurusanPermohonanKursusPersatuan();
        
        $queryPar = null;
        
        Yii::$app->session->open();
        
        if(isset(Yii::$app->session->id)){
            $queryPar['PengurusanPermohonanKursusPersatuanPenasihatSearch']['session_id'] = Yii::$app->session->id;
        }
        
        $searchModelPengurusanPermohonanKursusPersatuanPenasihat  = new PengurusanPermohonanKursusPersatuanPenasihatSearch();
        $dataProviderPengurusanPermohonanKursusPersatuanPenasihat = $searchModelPengurusanPermohonanKursusPersatuanPenasihat->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if(isset(Yii::$app->session->id)){
                PengurusanPermohonanKursusPersatuanPenasihat::updateAll(['pengurusan_permohonan_kursus_persatuan_id' => $model->pengurusan_permohonan_kursus_persatuan_id], 'session_id = "'.Yii::$app->session->id.'"');
                PengurusanPermohonanKursusPersatuanPenasihat::updateAll(['session_id' => ''], 'pengurusan_permohonan_kursus_persatuan_id = "'.$model->pengurusan_permohonan_kursus_persatuan_id.'"');
            }
            
            return $this->redirect(['view', 'id' => $model->pengurusan_permohonan_kursus_persatuan_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'searchModelPengurusanPermohonanKursusPersatuanPenasihat' => $searchModelPengurusanPermohonanKursusPersatuanPenasihat,
                'dataProviderPengurusanPermohonanKursusPersatuanPenasihat' => $dataProviderPengurusanPermohonanKursusPersatuanPenasihat,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Updates an existing PengurusanPermohonanKursusPersatuan model.
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
        
        $queryPar['PengurusanPermohonanKursusPersatuanPenasihatSearch']['pengurusan_permohonan_kursus_persatuan_id'] = $id;
        
        $searchModelPengurusanPermohonanKursusPersatuanPenasihat  = new PengurusanPermohonanKursusPersatuanPenasihatSearch();
        $dataProviderPengurusanPermohonanKursusPersatuanPenasihat = $searchModelPengurusanPermohonanKursusPersatuanPenasihat->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->pengurusan_permohonan_kursus_persatuan_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'searchModelPengurusanPermohonanKursusPersatuanPenasihat' => $searchModelPengurusanPermohonanKursusPersatuanPenasihat,
                'dataProviderPengurusanPermohonanKursusPersatuanPenasihat' => $dataProviderPengurusanPermohonanKursusPersatuanPenasihat,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Deletes an existing PengurusanPermohonanKursusPersatuan model.
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
     * Finds the PengurusanPermohonanKursusPersatuan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PengurusanPermohonanKursusPersatuan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PengurusanPermohonanKursusPersatuan::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionGetKursus($id){
        // find Ahli Jawatankuasa Induk
        $model = PengurusanPermohonanKursusPersatuan::findOne($id);
        
        echo Json::encode($model);
    }
    
    public function actionSendMemo($message, $pengurusan_permohonan_kursus_persatuan_id){
        if (($model = PengurusanPermohonanKursusPersatuan::findOne($pengurusan_permohonan_kursus_persatuan_id)) !== null) {
        
            if(($modelPengurusanPermohonanKursusPersatuanPenasihats = PengurusanPermohonanKursusPersatuanPenasihat::find()
                    ->joinWith(['refProfilPanelPenasihatKpsk'])
                    ->where('pengurusan_permohonan_kursus_persatuan_id >= :pengurusan_permohonan_kursus_persatuan_id', [':pengurusan_permohonan_kursus_persatuan_id' => $pengurusan_permohonan_kursus_persatuan_id])
                    ->all()) !== null) {
                foreach($modelPengurusanPermohonanKursusPersatuanPenasihats as $modelPengurusanPermohonanKursusPersatuanPenasihat){
                    if(isset($modelPengurusanPermohonanKursusPersatuanPenasihat['refProfilPanelPenasihatKpsk']['emel']) && $modelPengurusanPermohonanKursusPersatuanPenasihat['refProfilPanelPenasihatKpsk']['emel'] != ""){
                        try {
                            Yii::$app->mailer->compose()
                                    ->setTo($modelPengurusanPermohonanKursusPersatuanPenasihat['refProfilPanelPenasihatKpsk']['emel'])
                                    ->setFrom('noreply@spsb.com')
                                    ->setSubject('Memo: Permohonan Penganjuran')
                                    ->setTextBody('Salam Sejahtera,


Memo:

' . $message . '


"KE ARAH KECEMERLANGAN SUKAN"
Majlis Sukan Negara Malaysia.
                            ')->send();
                        }
                        catch(\Swift_SwiftException $exception)
                        {
                            echo "Terdapat ralat menghantar e-mel.";
                        }
                    } 
                }

            }
            
            if($model->emel && $model->emel != ""){
                //echo $model->emel . " , id=" . $model->pengurusan_permohonan_kursus_persatuan_id;
                try {
                    Yii::$app->mailer->compose()
                            ->setTo($model->emel)
                            ->setFrom('noreply@spsb.com')
                            ->setSubject('Memo: Permohonan Penganjuran')
                            ->setTextBody('Salam Sejahtera,


Memo:

' . $message . '


"KE ARAH KECEMERLANGAN SUKAN"
Majlis Sukan Negara Malaysia.
                    ')->send();
                }
                catch(\Swift_SwiftException $exception)
                {
                    echo "Terdapat ralat menghantar e-mel.";
                }
            }

            echo "Memo telah dihantar melalui e-mel.";
        } else {
            //echo "Tiada rekod di dalam sistem";
        }
    }
    
    public function actionSuratTawaran($pengurusan_permohonan_kursus_persatuan_id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $format = 'pdf';
            
            if($format == "html") {
                $report_url = BaseUrl::to(['generate-surat-tawaran'
                    , 'pengurusan_permohonan_kursus_persatuan_id' => $pengurusan_permohonan_kursus_persatuan_id
                    , 'format' => $format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-surat-tawaran'
                    , 'pengurusan_permohonan_kursus_persatuan_id' => $pengurusan_permohonan_kursus_persatuan_id
                    , 'format' => $format
                ]);
            }
    }
    
    public function actionGenerateSuratTawaran($pengurusan_permohonan_kursus_persatuan_id, $format)
    {
        $id = $pengurusan_permohonan_kursus_persatuan_id;
        
        if($pengurusan_permohonan_kursus_persatuan_id == "") $pengurusan_permohonan_kursus_persatuan_id = array();
        else $pengurusan_permohonan_kursus_persatuan_id = array($pengurusan_permohonan_kursus_persatuan_id);
        
        $controls = array(
            'KURSUS_PERSATUAN_ID' => $pengurusan_permohonan_kursus_persatuan_id,
        );
        
        GeneralFunction::generateReport('/spsb/MSN/SuratTawaranKPSK', $format, $controls, 'surat_tawaran_' . $id);
    }
}
