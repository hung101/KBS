<?php

namespace frontend\controllers;

use Yii;
use app\models\PermohonanBimbinganKaunseling;
use frontend\models\PermohonanBimbinganKaunselingSearch;
use app\models\MsnLaporanBimbinganKaunselingKesRujukan;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\BaseUrl;

use app\models\general\GeneralVariable;
use common\models\general\GeneralFunction;

// table reference
use app\models\RefStatusPermohonan;
use app\models\RefLatarbelakangKes;
use app\models\Atlet;
use app\models\ProfilBadanSukan;
use app\models\RefCawangan;
use app\models\Jurulatih;
use app\models\RefProgramSemasaSukanAtlet;
use app\models\RefAgensiKaunseling;
use app\models\RefNegeri;
use app\models\RefSukan;
use app\models\RefJantina;
use app\models\RefTarafPerkahwinan;
use common\models\User;

/**
 * PermohonanBimbinganKaunselingController implements the CRUD actions for PermohonanBimbinganKaunseling model.
 */
class PermohonanBimbinganKaunselingController extends Controller
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
     * Lists all PermohonanBimbinganKaunseling models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $searchModel = new PermohonanBimbinganKaunselingSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PermohonanBimbinganKaunseling model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = $this->findModel($id);
        
        $ref = RefStatusPermohonan::findOne(['id' => $model->status_permohonan]);
        $model->status_permohonan = $ref['desc'];
        
        $ref = RefLatarbelakangKes::findOne(['id' => $model->kes_latarbelakang]);
        $model->kes_latarbelakang = $ref['desc'];
        
        $ref = Atlet::findOne(['atlet_id' => $model->atlet_id]);
        $model->atlet_id = $ref['nameAndIC'];
        
        $ref = ProfilBadanSukan::findOne(['profil_badan_sukan' => $model->persatuan]);
        $model->persatuan = $ref['nama_badan_sukan'];
        
        $ref = RefCawangan::findOne(['id' => $model->cawangan]);
        $model->cawangan = $ref['desc'];
        
        $ref = Jurulatih::findOne(['jurulatih_id' => $model->jurulatih]);
        $model->jurulatih = $ref['nameAndIC'];
        
        $ref = RefProgramSemasaSukanAtlet::findOne(['id' => $model->program]);
        $model->program = $ref['desc'];
        
        $ref = RefAgensiKaunseling::findOne(['id' => $model->agensi]);
        $model->agensi = $ref['desc'];
        
        $ref = RefNegeri::findOne(['id' => $model->negeri]);
        $model->negeri = $ref['desc'];
        
        $ref = RefSukan::findOne(['id' => $model->sukan]);
        $model->sukan = $ref['desc'];
        
        $ref = RefSukan::findOne(['id' => $model->sukan_atlet_jurulatih]);
        $model->sukan_atlet_jurulatih = $ref['desc'];   
        
        $ref = RefJantina::findOne(['id' => $model->jantina]);
        $model->jantina = $ref['desc'];  
        
        $ref = RefTarafPerkahwinan::findOne(['id' => $model->taraf_perkahwinan]);
        $model->taraf_perkahwinan = $ref['desc'];  
        
        return $this->render('view', [
            'model' => $model,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new PermohonanBimbinganKaunseling model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new PermohonanBimbinganKaunseling();
        
        $model->tarikh_permohonan = GeneralFunction::getCurrentTimestamp();
        
        $model->status_permohonan = RefStatusPermohonan::SEDANG_DISEMAK;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
			
			if (($modelUsers = User::find()->joinWith('refUserPeranan')->andFilterWhere(['like', 'tbl_user_peranan.peranan_akses', 'pemberitahuan_emel_permohonan-bimbingan-kaunseling'])->groupBy('id')->all()) !== null) {
        
                foreach($modelUsers as $modelUser){

                    if($modelUser->email && $modelUser->email != ""){
                        //echo "E-mail: " . $modelUser->email . "\n";
                        Yii::$app->mailer->compose()
                        ->setTo($modelUser->email)
                        ->setFrom('noreply@spsb.com')
                        ->setSubject('Pemberitahuan: Permohonan Bimbingan Kaunseling (Kes Rujukan)')
                        ->setTextBody("Salam Sejahtera,
<br><br>
Berikut adalah permohonan bimbingan kaunseling (kes rujukan) baru telah dihantar : 
<br>
Nama Pemohon: " . $model->nama_pemohon_rujukan . '
E-mail: ' . $model->emel . '
Jawatan: ' . $model->jawatan . '
No. Telefon: ' . $model->no_telefon . '
<br>
Link: ' . BaseUrl::to(['permohonan-bimbingan-kaunseling/view', 'id' => $model->permohonan_bimbingan_kaunseling_id], true) . '
<br><br>
"KE ARAH KECEMERLANGAN SUKAN"
Majlis Sukan Negara Malaysia.
    ')->send();
                    }
                }
            }
			
            return $this->redirect(['view', 'id' => $model->permohonan_bimbingan_kaunseling_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Updates an existing PermohonanBimbinganKaunseling model.
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
            return $this->redirect(['view', 'id' => $model->permohonan_bimbingan_kaunseling_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Deletes an existing PermohonanBimbinganKaunseling model.
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
     * Finds the PermohonanBimbinganKaunseling model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PermohonanBimbinganKaunseling the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PermohonanBimbinganKaunseling::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionLaporanBimbinganKaunselingKesRujukan()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new MsnLaporanBimbinganKaunselingKesRujukan();
        $model->format = 'html';

        if ($model->load(Yii::$app->request->post())) {
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-laporan-bimbingan-kaunseling-kes-rujukan'
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'jenis_client' => $model->jenis_client
                    , 'kategori_masalah' => $model->kategori_masalah
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-laporan-bimbingan-kaunseling-kes-rujukan'
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'jenis_client' => $model->jenis_client
                    , 'kategori_masalah' => $model->kategori_masalah
                    , 'format' => $model->format
                ]);
            }
        } 

        return $this->render('laporan_bimbingan_kaunseling_kes_rujukan', [
            'model' => $model,
            'readonly' => false,
        ]);
    }
    
    public function actionGenerateLaporanBimbinganKaunselingKesRujukan($tarikh_dari, $tarikh_hingga, $jenis_client, $kategori_masalah, $format)
    {
        if($tarikh_dari == "") $tarikh_dari = array();
        else $tarikh_dari = array($tarikh_dari);
        
        if($tarikh_hingga == "") $tarikh_hingga = array();
        else $tarikh_hingga = array($tarikh_hingga);
        
        if($jenis_client == "") $jenis_client = array();
        else $jenis_client = array($jenis_client);
        
        if($kategori_masalah == "") $kategori_masalah = array();
        else $kategori_masalah = array($kategori_masalah);
        
        $controls = array(
            'FROM_DATE' => $tarikh_dari,
            'TO_DATE' => $tarikh_hingga,
            'KATEGORI_MASALAH' => $kategori_masalah,
            'JENIS_CLIENT' => $jenis_client,
        );
        
        GeneralFunction::generateReport('/spsb/MSN/LaporanBimbinganKaunselingKesRujukan', $format, $controls, 'laporan_bimbingan_kaunseling_kes_rujukan');
    }
}
