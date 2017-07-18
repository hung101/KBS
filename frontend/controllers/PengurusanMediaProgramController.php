<?php

namespace frontend\controllers;

use Yii;
use app\models\PengurusanMediaProgram;
use frontend\models\PengurusanMediaProgramSearch;
use app\models\PengurusanDokumenMediaProgram;
use frontend\models\PengurusanDokumenMediaProgramSearch;
use app\models\PengurusanKehadiranMediaProgram;
use frontend\models\PengurusanKehadiranMediaProgramSearch;
use app\models\PengurusanMediaProgramWakil;
use frontend\models\PengurusanMediaProgramWakilSearch;
use app\models\ProfilWartawanSukan;
use app\models\MsnLaporanSenaraiProgramMedia;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\BaseUrl;

use app\models\general\GeneralVariable;
use common\models\general\GeneralFunction;

/**
 * PengurusanMediaProgramController implements the CRUD actions for PengurusanMediaProgram model.
 */
class PengurusanMediaProgramController extends Controller
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
     * Lists all PengurusanMediaProgram models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $searchModel = new PengurusanMediaProgramSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PengurusanMediaProgram model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = $this->findModel($id);
        
        if($model->tarikh_mula != "") {$model->tarikh_mula = GeneralFunction::convert($model->tarikh_mula, GeneralFunction::TYPE_DATETIME);}
        if($model->tarikh_tamat != "") {$model->tarikh_tamat = GeneralFunction::convert($model->tarikh_tamat, GeneralFunction::TYPE_DATETIME);}
        
        $queryPar = null;
        
        $queryPar['PengurusanDokumenMediaProgramSearch']['pengurusan_media_program_id'] = $id;
        $queryPar['PengurusanKehadiranMediaProgramSearch']['pengurusan_media_program_id'] = $id;
        $queryPar['PengurusanMediaProgramWakilSearch']['pengurusan_media_program_id'] = $id;
        
        $searchModelDokumenMediaProgram = new PengurusanDokumenMediaProgramSearch();
        $dataProviderDokumenMediaProgram = $searchModelDokumenMediaProgram->search($queryPar);
        
        $searchModelKehadiranMediaProgram = new PengurusanKehadiranMediaProgramSearch();
        $dataProviderKehadiranMediaProgram = $searchModelKehadiranMediaProgram->search($queryPar);
        
        $searchModelPengurusanMediaProgramWakil = new PengurusanMediaProgramWakilSearch();
        $dataProviderPengurusanMediaProgramWakil = $searchModelPengurusanMediaProgramWakil->search($queryPar);
        
        return $this->render('view', [
            'model' => $model,
            'searchModelDokumenMediaProgram' => $searchModelDokumenMediaProgram,
            'dataProviderDokumenMediaProgram' => $dataProviderDokumenMediaProgram,
            'searchModelKehadiranMediaProgram' => $searchModelKehadiranMediaProgram,
            'dataProviderKehadiranMediaProgram' => $dataProviderKehadiranMediaProgram,
            'searchModelPengurusanMediaProgramWakil' => $searchModelPengurusanMediaProgramWakil,
            'dataProviderPengurusanMediaProgramWakil' => $dataProviderPengurusanMediaProgramWakil,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new PengurusanMediaProgram model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new PengurusanMediaProgram();
        
        $queryPar = null;
        
        Yii::$app->session->open();
        
        if(isset(Yii::$app->session->id)){
            $queryPar['PengurusanDokumenMediaProgramSearch']['session_id'] = Yii::$app->session->id;
            $queryPar['PengurusanKehadiranMediaProgramSearch']['session_id'] = Yii::$app->session->id;
            $queryPar['PengurusanMediaProgramWakilSearch']['session_id'] = Yii::$app->session->id;
        }
        
        $searchModelDokumenMediaProgram  = new PengurusanDokumenMediaProgramSearch();
        $dataProviderDokumenMediaProgram = $searchModelDokumenMediaProgram->search($queryPar);
        
        $searchModelKehadiranMediaProgram  = new PengurusanKehadiranMediaProgramSearch();
        $dataProviderKehadiranMediaProgram = $searchModelKehadiranMediaProgram->search($queryPar);
        
        $searchModelPengurusanMediaProgramWakil = new PengurusanMediaProgramWakilSearch();
        $dataProviderPengurusanMediaProgramWakil = $searchModelPengurusanMediaProgramWakil->search($queryPar);
                

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if(isset(Yii::$app->session->id)){
                PengurusanDokumenMediaProgram::updateAll(['pengurusan_media_program_id' => $model->pengurusan_media_program_id], 'session_id = "'.Yii::$app->session->id.'"');
                PengurusanDokumenMediaProgram::updateAll(['session_id' => ''], 'pengurusan_media_program_id = "'.$model->pengurusan_media_program_id.'"');
                
                PengurusanKehadiranMediaProgram::updateAll(['pengurusan_media_program_id' => $model->pengurusan_media_program_id], 'session_id = "'.Yii::$app->session->id.'"');
                PengurusanKehadiranMediaProgram::updateAll(['session_id' => ''], 'pengurusan_media_program_id = "'.$model->pengurusan_media_program_id.'"');
                
                PengurusanMediaProgramWakil::updateAll(['pengurusan_media_program_id' => $model->pengurusan_media_program_id], 'session_id = "'.Yii::$app->session->id.'"');
                PengurusanMediaProgramWakil::updateAll(['session_id' => ''], 'pengurusan_media_program_id = "'.$model->pengurusan_media_program_id.'"');
            }
            
            $modelWartawans = PengurusanKehadiranMediaProgram::findAll([
                    'pengurusan_media_program_id' => $model->pengurusan_media_program_id,
                ]);
            
            $emailContent = "Assalamualaikum dan Salam Sejahtera,<br>
<br>Sukacita dimaklumkan bahawa " . $model->nama_program . " akan diadakan seperti berikut: 
<br>&nbsp;&nbsp;&nbsp;&nbsp;Tarikh: " . date_format(date_create($model->tarikh_mula),"d.m.Y") . "
<br>&nbsp;&nbsp;&nbsp;&nbsp;Masa: " . date_format(date_create($model->tarikh_mula),"g:i A") . "
<br>&nbsp;&nbsp;&nbsp;&nbsp;Tempat: " . $model->tempat;
  
            $attachment = "";
            $modelPengurusanDokumenMediaPrograms = PengurusanDokumenMediaProgram::findAll([
                    'pengurusan_media_program_id' => $model->pengurusan_media_program_id,
                ]);
            
            foreach($modelPengurusanDokumenMediaPrograms as $modelPengurusanDokumenMediaProgram){
                if($attachment == ""){
                    $attachment .= "<br>&nbsp;&nbsp;&nbsp;&nbsp;Attachment:";
                }
                
                if($modelPengurusanDokumenMediaProgram->muatnaik != ""){
                    $attachment .= "<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . $modelPengurusanDokumenMediaProgram->nama_dokumen . " - " . Yii::$app->getUrlManager()->createAbsoluteUrl('') . '/' . $modelPengurusanDokumenMediaProgram->muatnaik;
                }
            }
            
            $emailContent.= $attachment;
            
            $emailContent.= "<br>
<br>Sehubungan dengan itu, semua rakan media adalah dijemput hadir bagi membuat liputan. 
<br>
<br>
Sekian, terima kasih<br>
Cawangan Komunikasi Korporat<br>
Majlis Sukan Negara Malaysia
";
            
            foreach($modelWartawans as $modelWartawan){
                $modelProfilWartawan = ProfilWartawanSukan::findOne($modelWartawan->nama_wartawan);
                if($modelProfilWartawan->emel && $modelProfilWartawan->emel != ''){
                    Yii::$app->mailer->compose()
                        ->setTo($modelProfilWartawan->emel)
                        ->setFrom('noreply@spsb.com')
                        ->setSubject('Jemputan Media')
                        ->setHtmlBody($emailContent)->send();
                }
            }
            
            return $this->redirect(['view', 'id' => $model->pengurusan_media_program_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'searchModelDokumenMediaProgram' => $searchModelDokumenMediaProgram,
                'dataProviderDokumenMediaProgram' => $dataProviderDokumenMediaProgram,
                'searchModelKehadiranMediaProgram' => $searchModelKehadiranMediaProgram,
                'dataProviderKehadiranMediaProgram' => $dataProviderKehadiranMediaProgram,
                'searchModelPengurusanMediaProgramWakil' => $searchModelPengurusanMediaProgramWakil,
                'dataProviderPengurusanMediaProgramWakil' => $dataProviderPengurusanMediaProgramWakil,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Updates an existing PengurusanMediaProgram model.
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
        
        $queryPar['PengurusanDokumenMediaProgramSearch']['pengurusan_media_program_id'] = $id;
        $queryPar['PengurusanKehadiranMediaProgramSearch']['pengurusan_media_program_id'] = $id;
        $queryPar['PengurusanMediaProgramWakilSearch']['pengurusan_media_program_id'] = $id;
        
        $searchModelDokumenMediaProgram = new PengurusanDokumenMediaProgramSearch();
        $dataProviderDokumenMediaProgram = $searchModelDokumenMediaProgram->search($queryPar);
        
        $searchModelKehadiranMediaProgram = new PengurusanKehadiranMediaProgramSearch();
        $dataProviderKehadiranMediaProgram = $searchModelKehadiranMediaProgram->search($queryPar);
        
        $searchModelPengurusanMediaProgramWakil = new PengurusanMediaProgramWakilSearch();
        $dataProviderPengurusanMediaProgramWakil = $searchModelPengurusanMediaProgramWakil->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $modelWartawans = PengurusanKehadiranMediaProgram::findAll([
                    'pengurusan_media_program_id' => $model->pengurusan_media_program_id,
                ]);
            
            $emailContent = "Assalamualaikum dan Salam Sejahtera,<br>
<br>Sukacita dimaklumkan bahawa " . $model->nama_program . " akan diadakan seperti berikut: 
<br>&nbsp;&nbsp;&nbsp;&nbsp;Tarikh: " . date_format(date_create($model->tarikh_mula),"d.m.Y") . "
<br>&nbsp;&nbsp;&nbsp;&nbsp;Masa: " . date_format(date_create($model->tarikh_mula),"g:i A") . "
<br>&nbsp;&nbsp;&nbsp;&nbsp;Tempat: " . $model->tempat;
  
            $attachment = "";
            $modelPengurusanDokumenMediaPrograms = PengurusanDokumenMediaProgram::findAll([
                    'pengurusan_media_program_id' => $model->pengurusan_media_program_id,
                ]);
            
            foreach($modelPengurusanDokumenMediaPrograms as $modelPengurusanDokumenMediaProgram){
                if($attachment == ""){
                    $attachment .= "<br>&nbsp;&nbsp;&nbsp;&nbsp;Attachment:";
                }
                
                if($modelPengurusanDokumenMediaProgram->muatnaik != ""){
                    $attachment .= "<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . $modelPengurusanDokumenMediaProgram->nama_dokumen . " - " . Yii::$app->getUrlManager()->createAbsoluteUrl('') . '/' . $modelPengurusanDokumenMediaProgram->muatnaik;
                }
            }
            
            $emailContent.= $attachment;
            
            $emailContent.= "<br>
<br>Sehubungan dengan itu, semua rakan media adalah dijemput hadir bagi membuat liputan. 
<br>
<br>
Sekian, terima kasih<br>
Cawangan Komunikasi Korporat<br>
Majlis Sukan Negara Malaysia
";
            
            foreach($modelWartawans as $modelWartawan){
                $modelProfilWartawan = ProfilWartawanSukan::findOne($modelWartawan->nama_wartawan);
                if($modelProfilWartawan->emel && $modelProfilWartawan->emel != ''){
                    Yii::$app->mailer->compose()
                        ->setTo($modelProfilWartawan->emel)
                        ->setFrom('noreply@spsb.com')
                        ->setSubject('Jemputan Media Telah Dikemaskini')
                        ->setHtmlBody($emailContent)->send();
                }
            }
            
            return $this->redirect(['view', 'id' => $model->pengurusan_media_program_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'searchModelDokumenMediaProgram' => $searchModelDokumenMediaProgram,
                'dataProviderDokumenMediaProgram' => $dataProviderDokumenMediaProgram,
                'searchModelKehadiranMediaProgram' => $searchModelKehadiranMediaProgram,
                'dataProviderKehadiranMediaProgram' => $dataProviderKehadiranMediaProgram,
                'searchModelPengurusanMediaProgramWakil' => $searchModelPengurusanMediaProgramWakil,
                'dataProviderPengurusanMediaProgramWakil' => $dataProviderPengurusanMediaProgramWakil,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Deletes an existing PengurusanMediaProgram model.
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
     * Finds the PengurusanMediaProgram model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PengurusanMediaProgram the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PengurusanMediaProgram::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionLaporanSenaraiProgramMedia()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new MsnLaporanSenaraiProgramMedia();
        $model->format = 'html';

        if ($model->load(Yii::$app->request->post())) {
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-laporan-senarai-program-media'
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-laporan-senarai-program-media'
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'format' => $model->format
                ]);
            }
        } 

        return $this->render('laporan_senarai_program_media', [
            'model' => $model,
            'readonly' => false,
        ]);
    }
    
    public function actionGenerateLaporanSenaraiProgramMedia($tarikh_dari, $tarikh_hingga, $format)
    {
        if($tarikh_dari == "") $tarikh_dari = array();
        else $tarikh_dari = array($tarikh_dari);
        
        if($tarikh_hingga == "") $tarikh_hingga = array();
        else $tarikh_hingga = array($tarikh_hingga);
        
        $controls = array(
            'FROM_DATE' => $tarikh_dari,
            'TO_DATE' => $tarikh_hingga,
        );
        
        GeneralFunction::generateReport('/spsb/MSN/LaporanSenaraiProgramMedia', $format, $controls, 'laporan_senarai_program_media');
    }
}
