<?php

namespace frontend\controllers;

use Yii;
use app\models\PengurusanJawatankuasaKhasSukanMalaysia;
use frontend\models\PengurusanJawatankuasaKhasSukanMalaysiaSearch;
use app\models\PengurusanJawatankuasaKhasSukanMalaysiaAhli;
use frontend\models\PengurusanJawatankuasaKhasSukanMalaysiaAhliSearch;
use app\models\MsnLaporanProfilAhliJawatankuasaKhasSukanMalaysia;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\BaseUrl;
use yii\helpers\Json;

use app\models\general\GeneralVariable;
use common\models\general\GeneralFunction;

use app\models\RefJawatankuasaKhas;
use app\models\RefNegeri;

/**
 * PengurusanJawatankuasaKhasSukanMalaysiaController implements the CRUD actions for PengurusanJawatankuasaKhasSukanMalaysia model.
 */
class PengurusanJawatankuasaKhasSukanMalaysiaController extends Controller
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
     * Lists all PengurusanJawatankuasaKhasSukanMalaysia models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $searchModel = new PengurusanJawatankuasaKhasSukanMalaysiaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PengurusanJawatankuasaKhasSukanMalaysia model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = $this->findModel($id);
        
        $ref = RefJawatankuasaKhas::findOne(['id' => $model->jawatankuasa]);
        $model->jawatankuasa = $ref['desc'];
        
        $ref = RefNegeri::findOne(['id' => $model->negeri]);
        $model->negeri = $ref['desc'];
        
        $queryPar = null;
        
        $queryPar['PengurusanJawatankuasaKhasSukanMalaysiaAhliSearch']['pengurusan_jawatankuasa_khas_sukan_malaysia_id'] = $id;
        
        $searchModelPengurusanJawatankuasaKhasSukanMalaysiaAhli  = new PengurusanJawatankuasaKhasSukanMalaysiaAhliSearch();
        $dataProviderPengurusanJawatankuasaKhasSukanMalaysiaAhli = $searchModelPengurusanJawatankuasaKhasSukanMalaysiaAhli->search($queryPar);
        
        return $this->render('view', [
            'model' => $model,
            'searchModelPengurusanJawatankuasaKhasSukanMalaysiaAhli' => $searchModelPengurusanJawatankuasaKhasSukanMalaysiaAhli,
            'dataProviderPengurusanJawatankuasaKhasSukanMalaysiaAhli' => $dataProviderPengurusanJawatankuasaKhasSukanMalaysiaAhli,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new PengurusanJawatankuasaKhasSukanMalaysia model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new PengurusanJawatankuasaKhasSukanMalaysia();
        
        $queryPar = null;
        
        Yii::$app->session->open();
        
        if(isset(Yii::$app->session->id)){
            $queryPar['PengurusanJawatankuasaKhasSukanMalaysiaAhliSearch']['session_id'] = Yii::$app->session->id;
        }
        
        $searchModelPengurusanJawatankuasaKhasSukanMalaysiaAhli  = new PengurusanJawatankuasaKhasSukanMalaysiaAhliSearch();
        $dataProviderPengurusanJawatankuasaKhasSukanMalaysiaAhli = $searchModelPengurusanJawatankuasaKhasSukanMalaysiaAhli->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if(isset(Yii::$app->session->id)){
                PengurusanJawatankuasaKhasSukanMalaysiaAhli::updateAll(['pengurusan_jawatankuasa_khas_sukan_malaysia_id' => $model->pengurusan_jawatankuasa_khas_sukan_malaysia_id], 'session_id = "'.Yii::$app->session->id.'"');
                PengurusanJawatankuasaKhasSukanMalaysiaAhli::updateAll(['session_id' => ''], 'pengurusan_jawatankuasa_khas_sukan_malaysia_id = "'.$model->pengurusan_jawatankuasa_khas_sukan_malaysia_id.'"');
            }
            
            return $this->redirect(['view', 'id' => $model->pengurusan_jawatankuasa_khas_sukan_malaysia_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'searchModelPengurusanJawatankuasaKhasSukanMalaysiaAhli' => $searchModelPengurusanJawatankuasaKhasSukanMalaysiaAhli,
                'dataProviderPengurusanJawatankuasaKhasSukanMalaysiaAhli' => $dataProviderPengurusanJawatankuasaKhasSukanMalaysiaAhli,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Updates an existing PengurusanJawatankuasaKhasSukanMalaysia model.
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
        
        $queryPar['PengurusanJawatankuasaKhasSukanMalaysiaAhliSearch']['pengurusan_jawatankuasa_khas_sukan_malaysia_id'] = $id;
        
        $searchModelPengurusanJawatankuasaKhasSukanMalaysiaAhli  = new PengurusanJawatankuasaKhasSukanMalaysiaAhliSearch();
        $dataProviderPengurusanJawatankuasaKhasSukanMalaysiaAhli = $searchModelPengurusanJawatankuasaKhasSukanMalaysiaAhli->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->pengurusan_jawatankuasa_khas_sukan_malaysia_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'searchModelPengurusanJawatankuasaKhasSukanMalaysiaAhli' => $searchModelPengurusanJawatankuasaKhasSukanMalaysiaAhli,
                'dataProviderPengurusanJawatankuasaKhasSukanMalaysiaAhli' => $dataProviderPengurusanJawatankuasaKhasSukanMalaysiaAhli,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Deletes an existing PengurusanJawatankuasaKhasSukanMalaysia model.
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
     * Finds the PengurusanJawatankuasaKhasSukanMalaysia model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PengurusanJawatankuasaKhasSukanMalaysia the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PengurusanJawatankuasaKhasSukanMalaysia::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionGetPengurusanJawatankuasaKhasSukanMalaysia($id){
        // find Badan Sukan by ID
        $model = PengurusanJawatankuasaKhasSukanMalaysia::find()->where(['pengurusan_jawatankuasa_khas_sukan_malaysia_id' => $id])->asArray()->one();
        
        echo Json::encode($model);
    }
    
    public function actionSendMemo($message, $pengurusan_jawatankuasa_khas_sukan_malaysia_id){
        if (($model = PengurusanJawatankuasaKhasSukanMalaysia::findOne($pengurusan_jawatankuasa_khas_sukan_malaysia_id)) !== null) {
        
            if(($modelPengurusanJawatankuasaKhasSukanMalaysiaAhlis = PengurusanJawatankuasaKhasSukanMalaysiaAhli::find()
                    ->where('pengurusan_jawatankuasa_khas_sukan_malaysia_id >= :pengurusan_jawatankuasa_khas_sukan_malaysia_id', [':pengurusan_jawatankuasa_khas_sukan_malaysia_id' => $pengurusan_jawatankuasa_khas_sukan_malaysia_id])
                    ->all()) !== null) {
                foreach($modelPengurusanJawatankuasaKhasSukanMalaysiaAhlis as $modelPengurusanJawatankuasaKhasSukanMalaysiaAhli){
                    if($modelPengurusanJawatankuasaKhasSukanMalaysiaAhli->emel && $modelPengurusanJawatankuasaKhasSukanMalaysiaAhli->emel != ""){
                        try {
                            Yii::$app->mailer->compose()
                                    ->setTo($modelPengurusanJawatankuasaKhasSukanMalaysiaAhli->emel)
                                    ->setFrom('noreply@spsb.com')
                                    ->setSubject('Memo: Jawatankuasa Khas Sukan Malaysia')
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

            echo "Memo telah dihantar melalui e-mel.";
        } else {
            //echo "Tiada rekod di dalam sistem";
        }
    }
    
    public function actionLaporanProfilAhliJawatankuasaKhasSukanMalaysia()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new MsnLaporanProfilAhliJawatankuasaKhasSukanMalaysia();
        $model->format = 'html';

        if ($model->load(Yii::$app->request->post())) {
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-laporan-profil-ahli-jawatankuasa-khas-sukan-malaysia'
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'temasya' => $model->temasya
                    //, 'jawatankuasa' => $model->jawatankuasa
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-laporan-profil-ahli-jawatankuasa-khas-sukan-malaysia'
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'temasya' => $model->temasya
                    //, 'jawatankuasa' => $model->jawatankuasa
                    , 'format' => $model->format
                ]);
            }
        } 

        return $this->render('laporan_profil_ahli_jawatankuasa_khas_sukan_malaysia', [
            'model' => $model,
            'readonly' => false,
        ]);
    }
    
    public function actionGenerateLaporanProfilAhliJawatankuasaKhasSukanMalaysia($tarikh_dari, $tarikh_hingga, $temasya, $format)
    {
        if($tarikh_dari == "") $tarikh_dari = array();
        else $tarikh_dari = array($tarikh_dari);
        
        if($tarikh_hingga == "") $tarikh_hingga = array();
        else $tarikh_hingga = array($tarikh_hingga);
        
        if($temasya == "") $temasya = array();
        else $temasya = array($temasya);
        
        //if($jawatankuasa == "") $jawatankuasa = array();
        //else $jawatankuasa = array($jawatankuasa);
        
        $controls = array(
            'FROM_DATE' => $tarikh_dari,
            'TO_DATE' => $tarikh_hingga,
            //'JAWATANKUASA' => $jawatankuasa,
            'TEMASYA' => $temasya,
        );
        
        GeneralFunction::generateReport('/spsb/MSN/LaporanProfilAhliJawatankuasaKhasSukanMalaysia', $format, $controls, 'laporan_profil_ahli_jawatankuasa_khas_sukan_malaysia');
    }
}
