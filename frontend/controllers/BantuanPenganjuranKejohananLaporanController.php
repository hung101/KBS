<?php

namespace frontend\controllers;

use Yii;
use app\models\BantuanPenganjuranKejohananLaporan;
use frontend\models\BantuanPenganjuranKejohananLaporanSearch;
use app\models\BantuanPenganjuranKejohananLaporanTuntutan;
use frontend\models\BantuanPenganjuranKejohananLaporanTuntutanSearch;
use app\models\BantuanPenganjuranKejohanan;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

use app\models\general\Upload;
use app\models\general\GeneralVariable;
use common\models\general\GeneralFunction;

/** chmod(
 * BantuanPenganjuranKejohananLaporanController implements the CRUD actions for BantuanPenganjuranKejohananLaporan model.
 */
class BantuanPenganjuranKejohananLaporanController extends Controller
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
     * Lists all BantuanPenganjuranKejohananLaporan models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect($this->redirect(array(GeneralVariable::loginPagePath)));
        }
        
        $searchModel = new BantuanPenganjuranKejohananLaporanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single BantuanPenganjuranKejohananLaporan model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect($this->redirect(array(GeneralVariable::loginPagePath)));
        }
        
        $queryPar = null;
        
        $queryPar['BantuanPenganjuranKejohananLaporanTuntutanSearch']['bantuan_penganjuran_kejohanan_laporan_id'] = $id;
        
        $searchModelBantuanPenganjuranKejohananLaporanTuntutan  = new BantuanPenganjuranKejohananLaporanTuntutanSearch();
        $dataProviderBantuanPenganjuranKejohananLaporanTuntutan = $searchModelBantuanPenganjuranKejohananLaporanTuntutan->search($queryPar);
        
        return $this->render('view', [
            'model' => $this->findModel($id),
            'searchModelBantuanPenganjuranKejohananLaporanTuntutan' => $searchModelBantuanPenganjuranKejohananLaporanTuntutan,
            'dataProviderBantuanPenganjuranKejohananLaporanTuntutan' => $dataProviderBantuanPenganjuranKejohananLaporanTuntutan,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new BantuanPenganjuranKejohananLaporan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($bantuan_penganjuran_kejohanan_id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect($this->redirect(array(GeneralVariable::loginPagePath)));
        }
        
        $model = new BantuanPenganjuranKejohananLaporan();
        
        $model->bantuan_penganjuran_kejohanan_id = $bantuan_penganjuran_kejohanan_id;
        
        if (($modelBantuanPenganjuranKejohanan = BantuanPenganjuranKejohanan::findOne($bantuan_penganjuran_kejohanan_id)) !== null) {
            $model->tempat = $modelBantuanPenganjuranKejohanan->tempat;
            $model->tujuan_penganjuran = $modelBantuanPenganjuranKejohanan->nama_kejohanan_pertandingan;
            $model->bilangan_pasukan = $modelBantuanPenganjuranKejohanan->bil_pasukan;
            $model->bilangan_peserta = $modelBantuanPenganjuranKejohanan->bil_peserta;
            $model->bilangan_pegawai_teknikal = $modelBantuanPenganjuranKejohanan->bil_pegawai_teknikal;
            $model->bilangan_pembantu = $modelBantuanPenganjuranKejohanan->bilangan_pembantu;
            $model->tarikh = $modelBantuanPenganjuranKejohanan->tarikh_mula;
            $model->tarikh_tamat = $modelBantuanPenganjuranKejohanan->tarikh_tamat;
        }
        
        $dateAdd = new \DateTime($model->tarikh_tamat);
        $dateAdd->modify('+1 month'); // 1 months after kejohanan
        
        $allowSubmit = true;
        
        if($dateAdd->format('Y-m-d') < GeneralFunction::getCurrentDate()){
            Yii::$app->session->setFlash('error', 'Tidak boleh menghantar laporan kerana sudah lepas tempoh 1 bulan selepas kejohanan');
            $allowSubmit = false;
        }
        
        $queryPar = null;
        
        Yii::$app->session->open();
        
        if(isset(Yii::$app->session->id)){
            $queryPar['BantuanPenganjuranKejohananLaporanTuntutanSearch']['session_id'] = Yii::$app->session->id;
        }
        
        $searchModelBantuanPenganjuranKejohananLaporanTuntutan  = new BantuanPenganjuranKejohananLaporanTuntutanSearch();
        $dataProviderBantuanPenganjuranKejohananLaporanTuntutan = $searchModelBantuanPenganjuranKejohananLaporanTuntutan->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save() && $allowSubmit) {
            $file = UploadedFile::getInstance($model, 'laporan_bergambar');
            $filename = $model->bantuan_penganjuran_kejohanan_laporan_id . "-laporan_bergambar";
            if($file){
                $model->laporan_bergambar = Upload::uploadFile($file, Upload::bantuanPenganjuranKejohananLaporanFolder, $filename);
            }
            
            $file = UploadedFile::getInstance($model, 'penyata_perbelanjaan_resit_yang_telah_disahkan');
            $filename = $model->bantuan_penganjuran_kejohanan_laporan_id . "-penyata_perbelanjaan_resit_yang_telah_disahkan";
            if($file){
                $model->penyata_perbelanjaan_resit_yang_telah_disahkan = Upload::uploadFile($file, Upload::bantuanPenganjuranKejohananLaporanFolder, $filename);
            }
            
            $file = UploadedFile::getInstance($model, 'jadual_keputusan_pertandingan');
            $filename = $model->bantuan_penganjuran_kejohanan_laporan_id . "-jadual_keputusan_pertandingan";
            if($file){
                $model->jadual_keputusan_pertandingan = Upload::uploadFile($file, Upload::bantuanPenganjuranKejohananLaporanFolder, $filename);
            }
            
            $file = UploadedFile::getInstance($model, 'senarai_pasukan');
            $filename = $model->bantuan_penganjuran_kejohanan_laporan_id . "-senarai_pasukan";
            if($file){
                $model->senarai_pasukan = Upload::uploadFile($file, Upload::bantuanPenganjuranKejohananLaporanFolder, $filename);
            }
            
            $file = UploadedFile::getInstance($model, 'senarai_statistik_penyertaan');
            $filename = $model->bantuan_penganjuran_kejohanan_laporan_id . "-senarai_statistik_penyertaan";
            if($file){
                $model->senarai_statistik_penyertaan = Upload::uploadFile($file, Upload::bantuanPenganjuranKejohananLaporanFolder, $filename);
            }
            
            $file = UploadedFile::getInstance($model, 'senarai_pegawai_pembantu_teknikal');
            $filename = $model->bantuan_penganjuran_kejohanan_laporan_id . "-senarai_pegawai_pembantu_teknikal";
            if($file){
                $model->senarai_pegawai_pembantu_teknikal = Upload::uploadFile($file, Upload::bantuanPenganjuranKejohananLaporanFolder, $filename);
            }
            
            $file = UploadedFile::getInstance($model, 'senarai_urusetia_sukarelawan');
            $filename = $model->bantuan_penganjuran_kejohanan_laporan_id . "-senarai_urusetia_sukarelawan";
            if($file){
                $model->senarai_urusetia_sukarelawan = Upload::uploadFile($file, Upload::bantuanPenganjuranKejohananLaporanFolder, $filename);
            }
            
            $file = UploadedFile::getInstance($model, 'senarai_pegawai_pembantu_perubatan');
            $filename = $model->bantuan_penganjuran_kejohanan_laporan_id . "-senarai_pegawai_pembantu_perubatan";
            if($file){
                $model->senarai_pegawai_pembantu_perubatan = Upload::uploadFile($file, Upload::bantuanPenganjuranKejohananLaporanFolder, $filename);
            }
            
            if(isset(Yii::$app->session->id)){
                BantuanPenganjuranKejohananLaporanTuntutan::updateAll(['bantuan_penganjuran_kejohanan_laporan_id' => $model->bantuan_penganjuran_kejohanan_laporan_id], 'session_id = "'.Yii::$app->session->id.'"');
                BantuanPenganjuranKejohananLaporanTuntutan::updateAll(['session_id' => ''], 'bantuan_penganjuran_kejohanan_laporan_id = "'.$model->bantuan_penganjuran_kejohanan_laporan_id.'"');
                
            }
            
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->bantuan_penganjuran_kejohanan_laporan_id]);
            }
        } 
        
        return $this->render('create', [
                'model' => $model,
                'searchModelBantuanPenganjuranKejohananLaporanTuntutan' => $searchModelBantuanPenganjuranKejohananLaporanTuntutan,
                'dataProviderBantuanPenganjuranKejohananLaporanTuntutan' => $dataProviderBantuanPenganjuranKejohananLaporanTuntutan,
                'readonly' => false,
            ]);
    }
    
    /**
     * Displays a single BantuanPenganjuranKejohananLaporan model.
     * @param integer $id
     * @return mixed
     */
    public function actionLoad($bantuan_penganjuran_kejohanan_id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect($this->redirect(array(GeneralVariable::loginPagePath)));
        }
        
        if (($model = BantuanPenganjuranKejohananLaporan::find()->where(['bantuan_penganjuran_kejohanan_id'=>$bantuan_penganjuran_kejohanan_id])->one()) !== null) {
            return $this->redirect(['update', 'id' => $model->bantuan_penganjuran_kejohanan_laporan_id]);
        } else {
            return $this->redirect(['create', 'bantuan_penganjuran_kejohanan_id' => $bantuan_penganjuran_kejohanan_id]);
        }
    }

    /**
     * Updates an existing BantuanPenganjuranKejohananLaporan model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect($this->redirect(array(GeneralVariable::loginPagePath)));
        }
        
        $model = $this->findModel($id);
        $existingPenyataPerbelanjaan = $model->penyata_perbelanjaan_resit_yang_telah_disahkan;
        
        $dateAdd = new \DateTime($model->tarikh_tamat);
        $dateAdd->modify('+1 month'); // 1 months after kejohanan
        
        $allowSubmit = true;
        
        if($dateAdd->format('Y-m-d') < GeneralFunction::getCurrentDate()){
            Yii::$app->session->setFlash('error', 'Tidak boleh menghantar laporan kerana sudah lepas tempoh 1 bulan selepas kejohanan');
            $allowSubmit = false;
        }
        
        if($model->load(Yii::$app->request->post())){
            $file = UploadedFile::getInstance($model, 'penyata_perbelanjaan_resit_yang_telah_disahkan');

            if($file){
                //valid file to upload
                //upload file to server
                
                // delete upload file
                if($existingPenyataPerbelanjaan != ""){
                    self::actionDeleteupload($id, 'penyata_perbelanjaan_resit_yang_telah_disahkan');
                }
                
                $filename = $model->bantuan_penganjuran_kejohanan_id . "-penyata_perbelanjaan_resit_yang_telah_disahkan";
                $model->penyata_perbelanjaan_resit_yang_telah_disahkan = Upload::uploadFile($file, Upload::bantuanPenganjuranKejohananLaporanFolder, $filename);
            } else {
                //invalid file to upload
                //remain existing file
                $model->penyata_perbelanjaan_resit_yang_telah_disahkan = $existingPenyataPerbelanjaan;
            }
            
            $file = UploadedFile::getInstance($model, 'laporan_bergambar');
            $filename = $model->bantuan_penganjuran_kejohanan_laporan_id . "-laporan_bergambar";
            if($file){
                $model->laporan_bergambar = Upload::uploadFile($file, Upload::bantuanPenganjuranKejohananLaporanFolder, $filename);
            }
            
            $file = UploadedFile::getInstance($model, 'jadual_keputusan_pertandingan');
            $filename = $model->bantuan_penganjuran_kejohanan_laporan_id . "-jadual_keputusan_pertandingan";
            if($file){
                $model->jadual_keputusan_pertandingan = Upload::uploadFile($file, Upload::bantuanPenganjuranKejohananLaporanFolder, $filename);
            }
            
            $file = UploadedFile::getInstance($model, 'senarai_pasukan');
            $filename = $model->bantuan_penganjuran_kejohanan_laporan_id . "-senarai_pasukan";
            if($file){
                $model->senarai_pasukan = Upload::uploadFile($file, Upload::bantuanPenganjuranKejohananLaporanFolder, $filename);
            }
            
            $file = UploadedFile::getInstance($model, 'senarai_statistik_penyertaan');
            $filename = $model->bantuan_penganjuran_kejohanan_laporan_id . "-senarai_statistik_penyertaan";
            if($file){
                $model->senarai_statistik_penyertaan = Upload::uploadFile($file, Upload::bantuanPenganjuranKejohananLaporanFolder, $filename);
            }
            
            $file = UploadedFile::getInstance($model, 'senarai_pegawai_pembantu_teknikal');
            $filename = $model->bantuan_penganjuran_kejohanan_laporan_id . "-senarai_pegawai_pembantu_teknikal";
            if($file){
                $model->senarai_pegawai_pembantu_teknikal = Upload::uploadFile($file, Upload::bantuanPenganjuranKejohananLaporanFolder, $filename);
            }
            
            $file = UploadedFile::getInstance($model, 'senarai_urusetia_sukarelawan');
            $filename = $model->bantuan_penganjuran_kejohanan_laporan_id . "-senarai_urusetia_sukarelawan";
            if($file){
                $model->senarai_urusetia_sukarelawan = Upload::uploadFile($file, Upload::bantuanPenganjuranKejohananLaporanFolder, $filename);
            }
            
            $file = UploadedFile::getInstance($model, 'senarai_pegawai_pembantu_perubatan');
            $filename = $model->bantuan_penganjuran_kejohanan_laporan_id . "-senarai_pegawai_pembantu_perubatan";
            if($file){
                $model->senarai_pegawai_pembantu_perubatan = Upload::uploadFile($file, Upload::bantuanPenganjuranKejohananLaporanFolder, $filename);
            }
        }
        
        $queryPar = null;
        
        $queryPar['BantuanPenganjuranKejohananLaporanTuntutanSearch']['bantuan_penganjuran_kejohanan_laporan_id'] = $id;
        
        $searchModelBantuanPenganjuranKejohananLaporanTuntutan  = new BantuanPenganjuranKejohananLaporanTuntutanSearch();
        $dataProviderBantuanPenganjuranKejohananLaporanTuntutan = $searchModelBantuanPenganjuranKejohananLaporanTuntutan->search($queryPar);

        if (Yii::$app->request->post() && $model->save() && $allowSubmit) {
            return $this->redirect(['view', 'id' => $model->bantuan_penganjuran_kejohanan_laporan_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'searchModelBantuanPenganjuranKejohananLaporanTuntutan' => $searchModelBantuanPenganjuranKejohananLaporanTuntutan,
                'dataProviderBantuanPenganjuranKejohananLaporanTuntutan' => $dataProviderBantuanPenganjuranKejohananLaporanTuntutan,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Deletes an existing BantuanPenganjuranKejohananLaporan model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect($this->redirect(array(GeneralVariable::loginPagePath)));
        }
        
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the BantuanPenganjuranKejohananLaporan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return BantuanPenganjuranKejohananLaporan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = BantuanPenganjuranKejohananLaporan::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    // Add function for delete image or file
    public function actionDeleteupload($id, $field)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect($this->redirect(array(GeneralVariable::loginPagePath)));
        }
        
            $img = $this->findModel($id)->$field;
            
            if($img){
/*                 if (!unlink($img)) {
                    return false;
                } */
				@unlink($img);
            }

            $img = $this->findModel($id);
            $img->$field = NULL;
            $img->update();

            return $this->redirect(['update', 'id' => $id]);
    }
	
	public function actionPrint($id)
	{
		if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = $this->findModel($id);
		
		$BantuanPenganjuranKejohananLaporanTuntutan  = BantuanPenganjuranKejohananLaporanTuntutan::find()->where(['bantuan_penganjuran_kejohanan_laporan_id' => $model->bantuan_penganjuran_kejohanan_laporan_id])->all();
	
		$pdf = new \mPDF('utf-8', 'A4');

        $pdf->title = 'Laporan Penganjuran Kejohanan';

        $stylesheet = file_get_contents('css/report.css');

        $pdf->WriteHTML($stylesheet,1);
        
        $pdf->WriteHTML($this->renderpartial('print', [
             'model'  => $model,
			 'title' => $pdf->title,
			 'BantuanPenganjuranKejohananLaporanTuntutan' => $BantuanPenganjuranKejohananLaporanTuntutan,
        ]));

        $pdf->Output(str_replace(' ', '_', $pdf->title).'_'.$model->bantuan_penganjuran_kejohanan_id.'.pdf', 'I'); 
		
	}
}
