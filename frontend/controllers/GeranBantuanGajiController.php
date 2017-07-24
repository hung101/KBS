<?php

namespace frontend\controllers;

use Yii;
use app\models\GeranBantuanGaji;
use frontend\models\GeranBantuanGajiSearch;
use app\models\GeranBantuanGajiLampiran;
use frontend\models\GeranBantuanGajiLampiranSearch;
use app\models\MsnLaporanMaklumatPembayaranGeranBantuan;
use yii\web\Controller;
use yii\web\Session;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\BaseUrl;
use yii\web\UploadedFile;

use app\models\general\Upload;

use app\models\general\GeneralVariable;
use app\models\general\GeneralLabel;
use common\models\general\GeneralFunction;

// table reference
use app\models\Jurulatih;
use app\models\RefStatusPermohonanGeranBantuanGajiJurulatih;
use app\models\RefKategoriGeranJurulatih;
use app\models\RefStatusGeranJurulatih;
use app\models\RefStatusJurulatih;
use app\models\RefSukan;
use app\models\RefProgramJurulatih;
use app\models\RefKelulusanGeranBantuanGajiJurulatih;
use app\models\RefAgensiJurulatih;
use app\models\User;
use app\models\RefStatusTawaran;

/**
 * GeranBantuanGajiController implements the CRUD actions for GeranBantuanGaji model.
 */
class GeranBantuanGajiController extends Controller
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
     * Lists all GeranBantuanGaji models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $queryParams = Yii::$app->request->queryParams;
        
        if(isset(Yii::$app->user->identity->peranan_akses['MSN']['geran-bantuan-gaji']['kelulusan'])) {
            $queryParams['GeranBantuanGajiSearch']['hantar_flag'] = 1;
        }
        
        $searchModel = new GeranBantuanGajiSearch();
        $dataProvider = $searchModel->search($queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single GeranBantuanGaji model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = $this->findModel($id);
        
        $ref = Jurulatih::findOne(['jurulatih_id' => $model->nama_jurulatih]);
        $model->nama_jurulatih = $ref['nameAndIC'];
        
        $ref = RefStatusPermohonanGeranBantuanGajiJurulatih::findOne(['id' => $model->status_permohonan]);
        $model->status_permohonan = $ref['desc'];
        
        $ref = RefKategoriGeranJurulatih::findOne(['id' => $model->kategori_geran]);
        $model->kategori_geran = $ref['desc'];
        
        $ref = RefStatusGeranJurulatih::findOne(['id' => $model->status_geran]);
        $model->status_geran = $ref['desc'];
        
        $ref = RefProgramJurulatih::findOne(['id' => $model->program_msn]);
        $model->program_msn = $ref['desc'];
        
        $ref = RefStatusJurulatih::findOne(['id' => $model->status_jurulatih]);
        $model->status_jurulatih = $ref['desc'];
        
        $ref = RefSukan::findOne(['id' => $model->nama_sukan]);
        $model->nama_sukan = $ref['desc'];
        
        $ref = RefKelulusanGeranBantuanGajiJurulatih::findOne(['id' => $model->kelulusan]);
        $model->kelulusan = $ref['desc'];
        
        $ref = RefAgensiJurulatih::findOne(['id' => $model->agensi]);
        $model->agensi = $ref['desc'];
        
        $ref = RefStatusTawaran::findOne(['id' => $model->status_tawaran_jkb]);
        $model->status_tawaran_jkb = $ref['desc'];
        
        $ref = RefStatusTawaran::findOne(['id' => $model->status_tawaran_mpj]);
        $model->status_tawaran_mpj = $ref['desc'];
        
        //$YesNo = GeneralLabel::getYesNoLabel($model->kelulusan);
        //$model->kelulusan = $YesNo;
        
        if($model->tarikh_mula_kontrak != "") {$model->tarikh_mula_kontrak = GeneralFunction::convert($model->tarikh_mula_kontrak, GeneralFunction::TYPE_DATE);}
        if($model->tarikh_tamat_kontrak != "") {$model->tarikh_tamat_kontrak = GeneralFunction::convert($model->tarikh_tamat_kontrak, GeneralFunction::TYPE_DATE);}
        if($model->tarikh_mula != "") {$model->tarikh_mula = GeneralFunction::convert($model->tarikh_mula, GeneralFunction::TYPE_DATE);}
        if($model->tarikh_tamat != "") {$model->tarikh_tamat = GeneralFunction::convert($model->tarikh_tamat, GeneralFunction::TYPE_DATE);}
        if($model->tarikh_cek != "") {$model->tarikh_cek = GeneralFunction::convert($model->tarikh_cek, GeneralFunction::TYPE_DATE);}
        if($model->tarikh_mpj != "") {$model->tarikh_mpj = GeneralFunction::convert($model->tarikh_mpj, GeneralFunction::TYPE_DATE);}
        if($model->tarikh_jkb != "") {$model->tarikh_jkb = GeneralFunction::convert($model->tarikh_jkb, GeneralFunction::TYPE_DATE);}
		
	$queryPar = null;
        
        $queryPar['GeranBantuanGajiLampiranSearch']['geran_bantuan_gaji_id'] = $id;
        
        $searchModelGeranBantuanGajiLampiran  = new GeranBantuanGajiLampiranSearch();
        $dataProviderGeranBantuanGajiLampiran = $searchModelGeranBantuanGajiLampiran->search($queryPar);
        
        return $this->render('view', [
            'model' => $model,
			'searchModelGeranBantuanGajiLampiran' => $searchModelGeranBantuanGajiLampiran,
            'dataProviderGeranBantuanGajiLampiran' => $dataProviderGeranBantuanGajiLampiran,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new GeranBantuanGaji model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new GeranBantuanGaji();
		
	$queryPar = null;
        
        Yii::$app->session->open();
        
        if(isset(Yii::$app->session->id)){
            $queryPar['GeranBantuanGajiLampiranSearch']['session_id'] = Yii::$app->session->id;
        }
        
        $searchModelGeranBantuanGajiLampiran  = new GeranBantuanGajiLampiranSearch();
        $dataProviderGeranBantuanGajiLampiran = $searchModelGeranBantuanGajiLampiran->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $upload = new Upload();
            $file = UploadedFile::getInstance($model, 'salinan_tawaran');
            if($file){
                $model->salinan_tawaran = $upload->uploadFile($file, Upload::geranBantuanGajiFolder, $model->geran_bantuan_gaji_id);
            }
            $file = UploadedFile::getInstance($model, 'persetujuan_terima');
            if($file){
                $model->persetujuan_terima = $upload->uploadFile($file, Upload::geranBantuanGajiFolder, $model->geran_bantuan_gaji_id);
            }
			if(isset(Yii::$app->session->id)){
                GeranBantuanGajiLampiran::updateAll(['geran_bantuan_gaji_id' => $model->geran_bantuan_gaji_id], 'session_id = "'.Yii::$app->session->id.'"');
                GeranBantuanGajiLampiran::updateAll(['session_id' => ''], 'geran_bantuan_gaji_id = "'.$model->geran_bantuan_gaji_id.'"');
            }
            if($model->save()){
                $query = RefKelulusanGeranBantuanGajiJurulatih::find()->where(['id' => $model->kelulusan])->andWhere(['or',
                ['like', 'desc', 'lulus'],
                ['like', 'desc', 'gagal']])->one();
                
                if(count($query) > 0){
                    $this->emailToCreator($model);
                }
                
                return $this->redirect(['view', 'id' => $model->geran_bantuan_gaji_id]);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
				'searchModelGeranBantuanGajiLampiran' => $searchModelGeranBantuanGajiLampiran,
				'dataProviderGeranBantuanGajiLampiran' => $dataProviderGeranBantuanGajiLampiran,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Updates an existing GeranBantuanGaji model.
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
        $oriKelulusan = $model->kelulusan;
		
		$queryPar = null;
        
        $queryPar['GeranBantuanGajiLampiranSearch']['geran_bantuan_gaji_id'] = $id;
        
        $searchModelGeranBantuanGajiLampiran  = new GeranBantuanGajiLampiranSearch();
        $dataProviderGeranBantuanGajiLampiran = $searchModelGeranBantuanGajiLampiran->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $upload = new Upload();
            $file = UploadedFile::getInstance($model, 'salinan_tawaran');
            if($file){
                $model->salinan_tawaran = $upload->uploadFile($file, Upload::geranBantuanGajiFolder, $model->geran_bantuan_gaji_id);
            }
            $file = UploadedFile::getInstance($model, 'persetujuan_terima');
            if($file){
                $model->persetujuan_terima = $upload->uploadFile($file, Upload::geranBantuanGajiFolder, $model->geran_bantuan_gaji_id);
            }
            if($model->save()){
                if($oriKelulusan != $model->kelulusan) {
                    $query = RefKelulusanGeranBantuanGajiJurulatih::find()->where(['id' => $model->kelulusan])->andWhere(['or',
                    ['like', 'desc', 'lulus'],
                    ['like', 'desc', 'gagal']])->one();
                    
                    if(count($query) > 0){
                        $this->emailToCreator($model);
                    }
                }

                return $this->redirect(['view', 'id' => $model->geran_bantuan_gaji_id]);
            }
        } else {
            return $this->render('update', [
                'model' => $model,
				'searchModelGeranBantuanGajiLampiran' => $searchModelGeranBantuanGajiLampiran,
				'dataProviderGeranBantuanGajiLampiran' => $dataProviderGeranBantuanGajiLampiran,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Deletes an existing GeranBantuanGaji model.
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
        self::actionDeleteupload($id, 'salinan_tawaran');
        self::actionDeleteupload($id, 'persetujuan_terima');
        
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
    
    /**
     * Updates an existing GeranBantuanGaji model.
     * If approved is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionHantar($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = $this->findModel($id);
        
        $model->hantar_flag = 1; // set hantar flag
        $model->tarikh_hantar = GeneralFunction::getCurrentTimestamp(); // set date capture
        $model->status_tawaran_mpj = RefStatusTawaran::DALAM_PROSES;
        $model->status_tawaran_jkb = RefStatusTawaran::DALAM_PROSES;
        
        $model->save();
        
        return $this->redirect(['view', 'id' => $model->geran_bantuan_gaji_id]);
    }

    /**
     * Finds the GeranBantuanGaji model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return GeranBantuanGaji the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = GeranBantuanGaji::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    // Add function for delete image or file
    public function actionDeleteupload($id, $field)
    {
            $img = $this->findModel($id)->$field;
            
            if($img){
/*                 if (!unlink($img)) {
                    return false;
                } */
				@unlink($img);
            }

            $img = $this->findModel($id);
            $img->$field = NULL;
            
            if ($img->update()) {
                return $this->redirect(['update', 'id' => $id]);
            } else {
                return $this->render('update', [
                    'model' => $img,
                    'readonly' => false,
                ]);
            }

            
    }
    
    public function actionLaporanMaklumatPembayaranGeranBantuan()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new MsnLaporanMaklumatPembayaranGeranBantuan();
        $model->format = 'html';

        if ($model->load(Yii::$app->request->post())) {
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-laporan-maklumat-pembayaran-geran-bantuan'
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'program' => $model->program
                    , 'sukan' => $model->sukan
                    , 'jumlah_geran_dari' => $model->jumlah_geran_dari
                    , 'jumlah_geran_hingga' => $model->jumlah_geran_hingga
                    , 'agensi' => $model->agensi
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-laporan-maklumat-pembayaran-geran-bantuan'
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'program' => $model->program
                    , 'sukan' => $model->sukan
                    , 'jumlah_geran_dari' => $model->jumlah_geran_dari
                    , 'jumlah_geran_hingga' => $model->jumlah_geran_hingga
                    , 'agensi' => $model->agensi
                    , 'format' => $model->format
                ]);
            }
        } 

        return $this->render('laporan_maklumat_pembayaran_geran_bantuan', [
            'model' => $model,
            'readonly' => false,
        ]);
    }
    
    public function emailToCreator($model)
    {
        //email
        $modelUser = User::findOne($model->created_by);
        if (count($modelUser) > 0) {
            $jurulatihModel = Jurulatih::findOne(['jurulatih_id' => $model->nama_jurulatih]);
            
            $ref = RefKelulusanGeranBantuanGajiJurulatih::findOne(['id' => $model->kelulusan]);
            $statusPermohonanDesc = $ref['desc'];
            try {
                Yii::$app->mailer->compose()
                        ->setTo($modelUser->email)
                        ->setFrom('noreply@spsb.com')
                        ->setSubject('Status Permohonan (' . $jurulatihModel->nama . '- '.$jurulatihModel->ic_no.') Geran Bantuan Gaji Jurulatih')
                        ->setHtmlBody('Salam Sejahtera,<br><br>

                Nama Jurulatih: ' . $jurulatihModel->nama . '<br>
                No Kad Pengenalan: ' . $jurulatihModel->ic_no . '<br>
                Status Permohonan Terkini: ' . $statusPermohonanDesc . '<br>
<br><br>
                "KE ARAH KECEMERLANGAN SUKAN"<br>
                Majlis Sukan Negara Malaysia.<br>
                ')->send();
            }
            catch(\Swift_SwiftException $exception)
            {
                //var_dump($exception); die;
                //return 'Can sent mail due to the following exception'.print_r($exception);
            }
        }
    }
    
    public function actionGenerateLaporanMaklumatPembayaranGeranBantuan($tarikh_dari, $tarikh_hingga, $program, $sukan, $jumlah_geran_dari, $jumlah_geran_hingga, $agensi, $format)
    {
        if($tarikh_dari == "") $tarikh_dari = array();
        else $tarikh_dari = array($tarikh_dari);
        
        if($tarikh_hingga == "") $tarikh_hingga = array();
        else $tarikh_hingga = array($tarikh_hingga);
        
        if($program == "") $program = array();
        else $program = array($program);
        
        if($sukan == "") $sukan = array();
        else $sukan = array($sukan);
        
        if($jumlah_geran_dari == "") $jumlah_geran_dari = array();
        else $jumlah_geran_dari = array($jumlah_geran_dari);
        
        if($jumlah_geran_hingga == "") $jumlah_geran_hingga = array();
        else $jumlah_geran_hingga = array($jumlah_geran_hingga);
        
        if($agensi == "") $agensi = array();
        else $agensi = array($agensi);
        
        $controls = array(
            'FROM_DATE' => $tarikh_dari,
            'TO_DATE' => $tarikh_hingga,
            'AGENSI' => $agensi,
            'SUKAN' => $sukan,
            'PROGRAM' => $program,
            'JUMLAH_GERAN_DARI' => $jumlah_geran_dari,
            'JUMLAH_GERAN_HINGGA' => $jumlah_geran_hingga,
        );
        
        GeneralFunction::generateReport('/spsb/MSN/LaporanMaklumatPembayaranGeranBantuan', $format, $controls, 'laporan_maklumat_pembayaran_geran_bantuan');
    }
	
	public function actionPrint($id)
	{
		if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }  
        $model = $this->findModel($id);
		
		$ref = Jurulatih::findOne(['jurulatih_id' => $model->nama_jurulatih]);
        $model->nama_jurulatih = $ref['nameAndIC'];
        
        $ref = RefStatusPermohonanGeranBantuanGajiJurulatih::findOne(['id' => $model->status_permohonan]);
        $model->status_permohonan = $ref['desc'];
        
        $ref = RefKategoriGeranJurulatih::findOne(['id' => $model->kategori_geran]);
        $model->kategori_geran = $ref['desc'];
        
        $ref = RefStatusGeranJurulatih::findOne(['id' => $model->status_geran]);
        $model->status_geran = $ref['desc'];
        
        $ref = RefProgramJurulatih::findOne(['id' => $model->program_msn]);
        $model->program_msn = $ref['desc'];
        
        $ref = RefStatusJurulatih::findOne(['id' => $model->status_jurulatih]);
        $model->status_jurulatih = $ref['desc'];
        
        $ref = RefSukan::findOne(['id' => $model->nama_sukan]);
        $model->nama_sukan = $ref['desc'];
        
        $ref = RefKelulusanGeranBantuanGajiJurulatih::findOne(['id' => $model->kelulusan]);
        $model->kelulusan = $ref['desc'];
        
        $ref = RefAgensiJurulatih::findOne(['id' => $model->agensi]);
        $model->agensi = $ref['desc'];
		
		$GeranBantuanGajiLampiran = GeranBantuanGajiLampiran::find()->where(['geran_bantuan_gaji_id' => $model->geran_bantuan_gaji_id])->all();
		
		$pdf = new \mPDF('utf-8', 'A4');

        $pdf->title = 'Geran Bantuan Gaji';

        $stylesheet = file_get_contents('css/report.css');

        $pdf->WriteHTML($stylesheet,1);
        
        $pdf->WriteHTML($this->renderpartial('print', [
             'model'  => $model,
			 'title' => $pdf->title,
			 'GeranBantuanGajiLampiran' => $GeranBantuanGajiLampiran,
        ]));

        $pdf->Output('Geran_bantuan_gaji'.$model->geran_bantuan_gaji_id.'.pdf', 'I'); 	
	}
}
