<?php

namespace frontend\controllers;

use Yii;
use app\models\BantuanPentadbiranPejabat;
use frontend\models\BantuanPentadbiranPejabatSearch;
use app\models\InformasiPermohonan;
use frontend\models\InformasiPermohonanSearch;
use app\models\MsnLaporan;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\helpers\BaseUrl;

use app\models\general\Upload;
use app\models\general\GeneralVariable;
use common\models\general\GeneralFunction;

// table reference
use app\models\RefJawatanBantuanPentadbiranPejabat;
use app\models\RefStatusPermohonanBantuanPentadbiranPejabat;
use app\models\RefBandar;
use app\models\RefNegeri;
use app\models\ProfilBadanSukan;

/**
 * BantuanPentadbiranPejabatController implements the CRUD actions for BantuanPentadbiranPejabat model.
 */
class BantuanPentadbiranPejabatController extends Controller
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
     * Lists all BantuanPentadbiranPejabat models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $searchModel = new BantuanPentadbiranPejabatSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single BantuanPentadbiranPejabat model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = $this->findModel($id);
        
        $ref = RefJawatanBantuanPentadbiranPejabat::findOne(['id' => $model->jawatan]);
        $model->jawatan = $ref['desc'];
        
        $ref = RefStatusPermohonanBantuanPentadbiranPejabat::findOne(['id' => $model->status_permohonan]);
        $model->status_permohonan = $ref['desc'];
        
        $ref = RefBandar::findOne(['id' => $model->alamat_bandar]);
        $model->alamat_bandar = $ref['desc'];
        
        $ref = RefNegeri::findOne(['id' => $model->alamat_negeri]);
        $model->alamat_negeri = $ref['desc'];
        
        $ref = ProfilBadanSukan::findOne(['profil_badan_sukan' => $model->persatuan]);
        $model->persatuan = $ref['nama_badan_sukan'];
        
        $queryPar = null;
        
        $queryPar['InformasiPermohonanSearch']['bantuan_pentadbiran_pejabat_id'] = $id;
        
        $searchModelInformasiPermohonan  = new InformasiPermohonanSearch();
        $dataProviderInformasiPermohonan = $searchModelInformasiPermohonan->search($queryPar);
        
        return $this->render('view', [
            'model' => $model,
            'searchModelInformasiPermohonan' => $searchModelInformasiPermohonan,
            'dataProviderInformasiPermohonan' => $dataProviderInformasiPermohonan,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new BantuanPentadbiranPejabat model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new BantuanPentadbiranPejabat();
        
        $model->tarikh = GeneralFunction::getCurrentTimestamp();
        
        $model->status_permohonan = RefStatusPermohonanBantuanPentadbiranPejabat::DALAM_PROSES;
        
        $oldStatusPermohonan = null;
        
        $queryPar = null;
        
        Yii::$app->session->open();
        
        if(isset(Yii::$app->session->id)){
            $queryPar['InformasiPermohonanSearch']['session_id'] = Yii::$app->session->id;
        }
        
        $searchModelInformasiPermohonan  = new InformasiPermohonanSearch();
        $dataProviderInformasiPermohonan = $searchModelInformasiPermohonan->search($queryPar);
        
        if($model->load(Yii::$app->request->post())){
            $oldStatusPermohonan = $model->getOldAttribute('status_permohonan');
			
			$file = UploadedFile::getInstance($model, 'surat_permohonan');
            $filename = $model->bantuan_pentadbiran_pejabat_id . "-surat_permohonan";
            if($file){
                $model->surat_permohonan = Upload::uploadFile($file, Upload::bantuanPentadbiranPejabatFolder, $filename);
            }
        }

        if (Yii::$app->request->post() && $model->save()) {
			
            if(isset(Yii::$app->session->id)){
                InformasiPermohonan::updateAll(['bantuan_pentadbiran_pejabat_id' => $model->bantuan_pentadbiran_pejabat_id], 'session_id = "'.Yii::$app->session->id.'"');
                InformasiPermohonan::updateAll(['session_id' => ''], 'bantuan_pentadbiran_pejabat_id = "'.$model->bantuan_pentadbiran_pejabat_id.'"');
            }
            
            if($model->emel && $model->emel != "" && $model->status_permohonan ){
                if($model->status_permohonan != $oldStatusPermohonan){
                    try {
                        if($model->status_permohonan == RefStatusPermohonanBantuanPentadbiranPejabat::LULUS){ // Approved
                            Yii::$app->mailer->compose()
                                    ->setTo($model->emel)
                                    ->setFrom('noreply@spsb.com')
                                    ->setSubject('Permohonan Bantuan Pentadbiran Pejabat Tuan/Puan Telah Diproses')
                                    ->setTextBody('Salam Sejahtera,
<br><br>
Sukacita, permohonan bantuan pentadbiran pejabat Tuan/Puan telah LULUS.
<br><br>
"KE ARAH KECEMERLANGAN SUKAN"
Majlis Sukan Negara Malaysia.
                            ')->send();
                        }
                    }
                    catch(\Swift_SwiftException $exception)
                    {
                        //return 'Can sent mail due to the following exception'.print_r($exception);
                        Yii::$app->session->setFlash('error', 'Terdapat ralat menghantar e-mel.');
                    }
                }
            }
            
            return $this->redirect(['view', 'id' => $model->bantuan_pentadbiran_pejabat_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'searchModelInformasiPermohonan' => $searchModelInformasiPermohonan,
                'dataProviderInformasiPermohonan' => $dataProviderInformasiPermohonan,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Updates an existing BantuanPentadbiranPejabat model.
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
		
		$existingSurat = $model->surat_permohonan;
        
        $oldStatusPermohonan = null;
        
        $queryPar = null;
        
        $queryPar['InformasiPermohonanSearch']['bantuan_pentadbiran_pejabat_id'] = $id;
        
        $searchModelInformasiPermohonan  = new InformasiPermohonanSearch();
        $dataProviderInformasiPermohonan = $searchModelInformasiPermohonan->search($queryPar);
        
        if($model->load(Yii::$app->request->post())){
            $oldStatusPermohonan = $model->getOldAttribute('status_permohonan');
			
			$file = UploadedFile::getInstance($model, 'surat_permohonan');

            if($file){
                //valid file to upload
                //upload file to server
                $filename = $model->bantuan_pentadbiran_pejabat_id . "-surat_permohonan";
                $model->surat_permohonan = Upload::uploadFile($file,  Upload::bantuanPentadbiranPejabatFolder, $filename);
            } else {
                //invalid file to upload
                //remain existing file
                $model->surat_permohonan = $existingSurat;
            }
        }

        if (Yii::$app->request->post() && $model->save()) {
            if($model->emel && $model->emel != "" && $model->status_permohonan ){
                if($model->status_permohonan != $oldStatusPermohonan){
                    try {
                        if($model->status_permohonan == RefStatusPermohonanBantuanPentadbiranPejabat::LULUS){ // Approved
                            Yii::$app->mailer->compose()
                                    ->setTo($model->emel)
                                                                ->setFrom('noreply@spsb.com')
                                    ->setSubject('Permohonan Bantuan Pentadbiran Pejabat Tuan/Puan Telah Diproses')
                                    ->setTextBody('Salam Sejahtera,
<br><br>
Sukacita, permohonan bantuan pentadbiran pejabat Tuan/Puan telah LULUS.
<br><br>
"KE ARAH KECEMERLANGAN SUKAN"
Majlis Sukan Negara Malaysia.
                            ')->send();
                        }
                    }
                    catch(\Swift_SwiftException $exception)
                    {
                        //return 'Can sent mail due to the following exception'.print_r($exception);
                        Yii::$app->session->setFlash('error', 'Terdapat ralat menghantar e-mel.');
                    }
                }
            }
            
            return $this->redirect(['view', 'id' => $model->bantuan_pentadbiran_pejabat_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'searchModelInformasiPermohonan' => $searchModelInformasiPermohonan,
                'dataProviderInformasiPermohonan' => $dataProviderInformasiPermohonan,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Deletes an existing BantuanPentadbiranPejabat model.
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
     * Finds the BantuanPentadbiranPejabat model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return BantuanPentadbiranPejabat the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = BantuanPentadbiranPejabat::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionLaporanStatistikPentadbiranPejabat()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new MsnLaporan();
        $model->format = 'html';

        if ($model->load(Yii::$app->request->post())) {
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-laporan-statistik-pentadbiran-pejabat'
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-laporan-statistik-pentadbiran-pejabat'
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'format' => $model->format
                ]);
            }
        } 

        return $this->render('laporan_statistik_pentadbiran_pejabat', [
            'model' => $model,
            'readonly' => false,
        ]);
    }
    
    public function actionGenerateLaporanStatistikPentadbiranPejabat($tarikh_dari, $tarikh_hingga, $format)
    {
        if($tarikh_dari == "") $tarikh_dari = array();
        else $tarikh_dari = array($tarikh_dari);
        
        if($tarikh_hingga == "") $tarikh_hingga = array();
        else $tarikh_hingga = array($tarikh_hingga);
        
        $controls = array(
            'FROM_DATE' => $tarikh_dari,
            'TO_DATE' => $tarikh_hingga,
        );
        
        GeneralFunction::generateReport('/spsb/MSN/LaporanStatistikPentadbiranPejabat', $format, $controls, 'laporan_statistik_pentadbiran_pejabat');
    }
    
    public function actionLaporanStatistikPentadbiranPejabatJumlahKelulusan()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new MsnLaporan();
        $model->format = 'html';

        if ($model->load(Yii::$app->request->post())) {
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-laporan-statistik-pentadbiran-pejabat-jumlah-kelulusan'
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-laporan-statistik-pentadbiran-pejabat-jumlah-kelulusan'
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'format' => $model->format
                ]);
            }
        } 

        return $this->render('laporan_statistik_pentadbiran_pejabat_jumlah_kelulusan', [
            'model' => $model,
            'readonly' => false,
        ]);
    }
    
    public function actionGenerateLaporanStatistikPentadbiranPejabatJumlahKelulusan($tarikh_dari, $tarikh_hingga, $format)
    {
        if($tarikh_dari == "") $tarikh_dari = array();
        else $tarikh_dari = array($tarikh_dari);
        
        if($tarikh_hingga == "") $tarikh_hingga = array();
        else $tarikh_hingga = array($tarikh_hingga);
        
        $controls = array(
            'FROM_DATE' => $tarikh_dari,
            'TO_DATE' => $tarikh_hingga,
        );
        
        GeneralFunction::generateReport('/spsb/MSN/LaporanStatistikPentadbiranPejabatJumlahKelulusan', $format, $controls, 'laporan_statistik_pentadbiran_pejabat_jumlah_kelulusan');
    }
}
