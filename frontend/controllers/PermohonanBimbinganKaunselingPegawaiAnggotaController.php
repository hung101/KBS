<?php

namespace frontend\controllers;

use Yii;
use app\models\PermohonanBimbinganKaunselingPegawaiAnggota;
use frontend\models\PermohonanBimbinganKaunselingPegawaiAnggotaSearch;
use app\models\MsnLaporanBimbinganKaunselingPegawai;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\BaseUrl;

use app\models\general\GeneralVariable;
use common\models\general\GeneralFunction;

// table reference
use app\models\RefStatusPermohonan;
use app\models\RefTarafPerkahwinan;
use app\models\RefJantina;
use app\models\RefLatarbelakangKes;
use app\models\RefStatusJawatan;
use app\models\RefBahagianBimbinganKaunseling;

/**
 * PermohonanBimbinganKaunselingPegawaiAnggotaController implements the CRUD actions for PermohonanBimbinganKaunselingPegawaiAnggota model.
 */
class PermohonanBimbinganKaunselingPegawaiAnggotaController extends Controller
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
     * Lists all PermohonanBimbinganKaunselingPegawaiAnggota models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PermohonanBimbinganKaunselingPegawaiAnggotaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PermohonanBimbinganKaunselingPegawaiAnggota model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        
        $model = $this->findModel($id);
        
        $ref = RefStatusPermohonan::findOne(['id' => $model->status_permohonan]);
        $model->status_permohonan = $ref['desc'];
        
        $ref = RefTarafPerkahwinan::findOne(['id' => $model->taraf_perkahwinan]);
        $model->taraf_perkahwinan = $ref['desc'];
        
        $ref = RefJantina::findOne(['id' => $model->jantina]);
        $model->jantina = $ref['desc'];
        
        $ref = RefLatarbelakangKes::findOne(['id' => $model->kategori_masalah]);
        $model->kategori_masalah = $ref['desc'];
        
        $ref = RefStatusJawatan::findOne(['id' => $model->status_jawatan]);
        $model->status_jawatan = $ref['desc'];
        
        $ref = RefTarafPerkahwinan::findOne(['id' => $model->taraf_perkahwinan_pegawai]);
        $model->taraf_perkahwinan_pegawai = $ref['desc'];
        
        $ref = RefJantina::findOne(['id' => $model->jantina_pegawai]);
        $model->jantina_pegawai = $ref['desc'];
        
        $ref = RefStatusJawatan::findOne(['id' => $model->status_jawatan_pegawai]);
        $model->status_jawatan_pegawai = $ref['desc'];
        
        $ref = RefBahagianBimbinganKaunseling::findOne(['id' => $model->bahagian]);
        $model->bahagian = $ref['desc'];
        
        $ref = RefBahagianBimbinganKaunseling::findOne(['id' => $model->bahagian_pegawai]);
        $model->bahagian_pegawai = $ref['desc'];
        
        return $this->render('view', [
            'model' => $model,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new PermohonanBimbinganKaunselingPegawaiAnggota model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new PermohonanBimbinganKaunselingPegawaiAnggota();
        
        $model->tarikh_permohonan = date("Y-m-d H:i:s");

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->permohonan_bimbingan_kaunseling_pegawai_anggota_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Updates an existing PermohonanBimbinganKaunselingPegawaiAnggota model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->permohonan_bimbingan_kaunseling_pegawai_anggota_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Deletes an existing PermohonanBimbinganKaunselingPegawaiAnggota model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the PermohonanBimbinganKaunselingPegawaiAnggota model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PermohonanBimbinganKaunselingPegawaiAnggota the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PermohonanBimbinganKaunselingPegawaiAnggota::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionLaporanBimbinganKaunselingPegawai()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new MsnLaporanBimbinganKaunselingPegawai();
        $model->format = 'html';

        if ($model->load(Yii::$app->request->post())) {
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-laporan-bimbingan-kaunseling-pegawai'
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'nama_ppn' => $model->nama_ppn
                    , 'sukan' => $model->sukan
                    , 'negeri' => $model->negeri
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-laporan-bimbingan-kaunseling-pegawai'
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'nama_ppn' => $model->nama_ppn
                    , 'sukan' => $model->sukan
                    , 'negeri' => $model->negeri
                    , 'format' => $model->format
                ]);
            }
        } 

        return $this->render('laporan_bimbingan_kaunseling_pegawai', [
            'model' => $model,
            'readonly' => false,
        ]);
    }
    
    public function actionGenerateLaporanBimbinganKaunselingPegawai($tarikh_dari, $tarikh_hingga, $nama_ppn, $sukan, $negeri, $format)
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
        
        GeneralFunction::generateReport('/spsb/MSN/LaporanBimbinganKaunselingPegawai', $format, $controls, 'laporan_bimbingan_kaunseling_pegawai');
    }
}
