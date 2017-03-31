<?php

namespace frontend\controllers;

use Yii;
use app\models\PengurusanInsuran;
use frontend\models\PengurusanInsuranSearch;
use app\models\PengurusanInsuranLampiran;
use frontend\models\PengurusanInsuranLampiranSearch;
use app\models\MsnLaporanTuntutanInsurans;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\helpers\Json;
use yii\helpers\BaseUrl;
use yii\web\Session;

use app\models\general\Upload;
use app\models\general\GeneralVariable;
use common\models\general\GeneralFunction;

// table reference
use app\models\Atlet;
use app\models\RefProgramSemasaSukanAtlet;
use app\models\RefSukan;
use app\models\RefJenisTuntutan;
use app\models\RefStatusPermohonanInsuran;
use app\models\RefBank;
use app\models\RefKelulusanJkb;

use common\models\User;

/**
 * PengurusanInsuranController implements the CRUD actions for PengurusanInsuran model.
 */
class PengurusanInsuranController extends Controller
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
     * Lists all PengurusanInsuran models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $searchModel = new PengurusanInsuranSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PengurusanInsuran model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = $this->findModel($id);
        
        $ref = Atlet::findOne(['atlet_id' => $model->atlet_id]);
        $model->atlet_id = $ref['nameAndIC'];
        
        $ref = RefProgramSemasaSukanAtlet::findOne(['id' => $model->program]);
        $model->program = $ref['desc'];
        
        $ref = RefSukan::findOne(['id' => $model->sukan]);
        $model->sukan = $ref['desc'];
        
        $ref = RefBank::findOne(['id' => $model->jenis_bank]);
        $model->jenis_bank = $ref['desc'];
        
        $ref = RefJenisTuntutan::findOne(['id' => $model->jenis_tuntutan]);
        $model->jenis_tuntutan = $ref['desc'];
        
        $ref = RefStatusPermohonanInsuran::findOne(['id' => $model->status_permohonan]);
        $model->status_permohonan = $ref['desc'];
        
        $ref = RefKelulusanJkb::findOne(['id' => $model->kelulusan_jkb]);
        $model->kelulusan_jkb = $ref['desc'];
        
        $queryPar = null;
        
        $queryPar['PengurusanInsuranLampiranSearch']['pengurusan_insuran_id'] = $id;
        
        $searchModelPengurusanInsuranLampiran  = new PengurusanInsuranLampiranSearch();
        $dataProviderPengurusanInsuranLampiran = $searchModelPengurusanInsuranLampiran->search($queryPar);
        
        return $this->render('view', [
            'model' => $model,
            'searchModelPengurusanInsuranLampiran' => $searchModelPengurusanInsuranLampiran,
            'dataProviderPengurusanInsuranLampiran' => $dataProviderPengurusanInsuranLampiran,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new PengurusanInsuran model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new PengurusanInsuran();
        
        // set public user id
        $model->pegawai_yang_bertanggungjawab = Yii::$app->user->identity->full_name;
        
        $queryPar = null;
        
        Yii::$app->session->open();
        
        if(isset(Yii::$app->session->id)){
            $queryPar['PengurusanInsuranLampiranSearch']['session_id'] = Yii::$app->session->id;
        }
        
        $searchModelPengurusanInsuranLampiran  = new PengurusanInsuranLampiranSearch();
        $dataProviderPengurusanInsuranLampiran = $searchModelPengurusanInsuranLampiran->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $file = UploadedFile::getInstance($model, 'lampiran');
            if($file){
                $model->lampiran = Upload::uploadFile($file, Upload::pengurusanInsuranFolder, $model->pengurusan_insuran_id);
            }
            
            $model->tarikh_permohonan = $model->created; // auto capture timestamp
            
            if(isset(Yii::$app->session->id)){
                PengurusanInsuranLampiran::updateAll(['pengurusan_insuran_id' => $model->pengurusan_insuran_id], 'session_id = "'.Yii::$app->session->id.'"');
                PengurusanInsuranLampiran::updateAll(['session_id' => ''], 'pengurusan_insuran_id = "'.$model->pengurusan_insuran_id.'"');
            }
            
            if($model->save()){
				if (($modelUsers = User::find()->joinWith('refUserPeranan')->andFilterWhere(['like', 'tbl_user_peranan.peranan_akses', 'pemberitahuan_emel_pengurusan-insuran'])->groupBy('id')->all()) !== null) {
        
					foreach($modelUsers as $modelUser){

						if($modelUser->email && $modelUser->email != ""){
							//echo "E-mail: " . $modelUser->email . "\n";
							Yii::$app->mailer->compose()
							->setTo($modelUser->email)
							->setFrom('noreply@spsb.com')
							->setSubject('Pemberitahuan: Permohonan Insuran')
							->setTextBody("Salam Sejahtera,
	<br><br>
	Berikut adalah permohonan insurans baru telah dihantar : 
	<br>
	Nama Pemohon: " . $model->pegawai_yang_bertanggungjawab . '
	Nama Insuran: ' . $model->nama_insuran . '
	Tarikh Kejadian: ' . $model->tarikh_kejadian . '
	Jumlah Tuntutan: RM ' . number_format($model->jumlah_tuntutan, 2) . '
	<br>
	Link: ' . BaseUrl::to(['pengurusan-insuran/view', 'id' => $model->pengurusan_insuran_id], true) . '
	<br><br>
	"KE ARAH KECEMERLANGAN SUKAN"
	Majlis Sukan Negara Malaysia.
		')->send();
						}
					}
				}
				
                return $this->redirect(['view', 'id' => $model->pengurusan_insuran_id]);
            }
        } 
        
        return $this->render('create', [
                'model' => $model,
                'searchModelPengurusanInsuranLampiran' => $searchModelPengurusanInsuranLampiran,
                'dataProviderPengurusanInsuranLampiran' => $dataProviderPengurusanInsuranLampiran,
                'readonly' => false,
            ]);
    }

    /**
     * Updates an existing PengurusanInsuran model.
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
        
        $queryPar['PengurusanInsuranLampiranSearch']['pengurusan_insuran_id'] = $id;
        
        $searchModelPengurusanInsuranLampiran  = new PengurusanInsuranLampiranSearch();
        $dataProviderPengurusanInsuranLampiran = $searchModelPengurusanInsuranLampiran->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $file = UploadedFile::getInstance($model, 'lampiran');
            if($file){
                $model->lampiran = Upload::uploadFile($file, Upload::pengurusanInsuranFolder, $model->pengurusan_insuran_id);
            }
            
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->pengurusan_insuran_id]);
            }
        } else {
            return $this->render('update', [
                'model' => $model,
                'searchModelPengurusanInsuranLampiran' => $searchModelPengurusanInsuranLampiran,
                'dataProviderPengurusanInsuranLampiran' => $dataProviderPengurusanInsuranLampiran,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Deletes an existing PengurusanInsuran model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        // delete upload file
        self::actionDeleteupload($id, 'lampiran');
        
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the PengurusanInsuran model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PengurusanInsuran the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PengurusanInsuran::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    // Add function for delete image or file
    public function actionDeleteupload($id, $field)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
            $img = $this->findModel($id)->$field;
            
            if($img){
                if (!unlink($img)) {
                    return false;
                }
            }

            $img = $this->findModel($id);
            $img->$field = NULL;
            $img->update();

            return $this->redirect(['update', 'id' => $id]);
    }
    
    public function actionLaporanTuntutanInsurans()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new MsnLaporanTuntutanInsurans();
        $model->format = 'html';

        if ($model->load(Yii::$app->request->post())) {
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-laporan-tuntutan-insurans'
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-laporan-tuntutan-insurans'
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'format' => $model->format
                ]);
            }
        } 

        return $this->render('laporan_tuntutan_insurans', [
            'model' => $model,
            'readonly' => false,
        ]);
    }
    
    public function actionGenerateLaporanTuntutanInsurans($tarikh_dari, $tarikh_hingga, $format)
    {
        if($tarikh_dari == "") $tarikh_dari = array();
        else $tarikh_dari = array($tarikh_dari);
        
        if($tarikh_hingga == "") $tarikh_hingga = array();
        else $tarikh_hingga = array($tarikh_hingga);
        
        $controls = array(
            'FROM_DATE' => $tarikh_dari,
            'TO_DATE' => $tarikh_hingga,
        );
        
        GeneralFunction::generateReport('/spsb/MSN/LaporanTuntutanInsurans', $format, $controls, 'laporan_tuntutan_insurans');
    }
	
	public function actionSetTuntutan($tuntutan_id){
        
        $session = new Session;
        $session->open();

        $session['pengurusan-insuran-tuntutan_id'] = $tuntutan_id;
        
        $session->close();
    }
}
