<?php

namespace frontend\controllers;

use Yii;
use app\models\BantuanPenganjuranKejohananSirkitLaporan;
use frontend\models\BantuanPenganjuranKejohananSirkitLaporanSearch;
use app\models\BantuanPenganjuranKejohananSirkitLaporanTuntutan;
use frontend\models\BantuanPenganjuranKejohananSirkitLaporanTuntutanSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

use app\models\general\Upload;
use app\models\general\GeneralVariable;
use common\models\general\GeneralFunction;

/**
 * BantuanPenganjuranKejohananSirkitLaporanController implements the CRUD actions for BantuanPenganjuranKejohananSirkitLaporan model.
 */
class BantuanPenganjuranKejohananSirkitLaporanController extends Controller
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
     * Lists all BantuanPenganjuranKejohananSirkitLaporan models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $searchModel = new BantuanPenganjuranKejohananSirkitLaporanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single BantuanPenganjuranKejohananSirkitLaporan model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $queryPar = null;
        
        $queryPar['BantuanPenganjuranKejohananSirkitLaporanTuntutanSearch']['bantuan_penganjuran_kejohanan_laporan_id'] = $id;
        
        $searchModelBantuanPenganjuranKejohananSirkitLaporanTuntutan  = new BantuanPenganjuranKejohananSirkitLaporanTuntutanSearch();
        $dataProviderBantuanPenganjuranKejohananSirkitLaporanTuntutan = $searchModelBantuanPenganjuranKejohananSirkitLaporanTuntutan->search($queryPar);
        
        return $this->render('view', [
            'model' => $this->findModel($id),
            'searchModelBantuanPenganjuranKejohananSirkitLaporanTuntutan' => $searchModelBantuanPenganjuranKejohananSirkitLaporanTuntutan,
            'dataProviderBantuanPenganjuranKejohananSirkitLaporanTuntutan' => $dataProviderBantuanPenganjuranKejohananSirkitLaporanTuntutan,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new BantuanPenganjuranKejohananSirkitLaporan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($bantuan_penganjuran_kejohanan_id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new BantuanPenganjuranKejohananSirkitLaporan();
        
        $model->bantuan_penganjuran_kejohanan_id = $bantuan_penganjuran_kejohanan_id;
        
        $queryPar = null;
        
        Yii::$app->session->open();
        
        if(isset(Yii::$app->session->id)){
            $queryPar['BantuanPenganjuranKejohananSirkitLaporanTuntutanSearch']['session_id'] = Yii::$app->session->id;
        }
        
        $searchModelBantuanPenganjuranKejohananSirkitLaporanTuntutan  = new BantuanPenganjuranKejohananSirkitLaporanTuntutanSearch();
        $dataProviderBantuanPenganjuranKejohananSirkitLaporanTuntutan = $searchModelBantuanPenganjuranKejohananSirkitLaporanTuntutan->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $file = UploadedFile::getInstance($model, 'laporan_bergambar');
            $filename = $model->bantuan_penganjuran_kejohanan_laporan_id . "-laporan_bergambar";
            if($file){
                $model->laporan_bergambar = Upload::uploadFile($file, Upload::bantuanPenganjuranKejohananSirkitLaporanFolder, $filename);
            }
            
            $file = UploadedFile::getInstance($model, 'penyata_perbelanjaan_resit_yang_telah_disahkan');
            $filename = $model->bantuan_penganjuran_kejohanan_laporan_id . "-penyata_perbelanjaan_resit_yang_telah_disahkan";
            if($file){
                $model->penyata_perbelanjaan_resit_yang_telah_disahkan = Upload::uploadFile($file, Upload::bantuanPenganjuranKejohananSirkitLaporanFolder, $filename);
            }
            
            $file = UploadedFile::getInstance($model, 'jadual_keputusan_pertandingan');
            $filename = $model->bantuan_penganjuran_kejohanan_laporan_id . "-jadual_keputusan_pertandingan";
            if($file){
                $model->jadual_keputusan_pertandingan = Upload::uploadFile($file, Upload::bantuanPenganjuranKejohananSirkitLaporanFolder, $filename);
            }
            
            $file = UploadedFile::getInstance($model, 'senarai_pasukan');
            $filename = $model->bantuan_penganjuran_kejohanan_laporan_id . "-senarai_pasukan";
            if($file){
                $model->senarai_pasukan = Upload::uploadFile($file, Upload::bantuanPenganjuranKejohananSirkitLaporanFolder, $filename);
            }
            
            $file = UploadedFile::getInstance($model, 'senarai_statistik_penyertaan');
            $filename = $model->bantuan_penganjuran_kejohanan_laporan_id . "-senarai_statistik_penyertaan";
            if($file){
                $model->senarai_statistik_penyertaan = Upload::uploadFile($file, Upload::bantuanPenganjuranKejohananSirkitLaporanFolder, $filename);
            }
            
            $file = UploadedFile::getInstance($model, 'senarai_pegawai_pembantu_teknikal');
            $filename = $model->bantuan_penganjuran_kejohanan_laporan_id . "-senarai_pegawai_pembantu_teknikal";
            if($file){
                $model->senarai_pegawai_pembantu_teknikal = Upload::uploadFile($file, Upload::bantuanPenganjuranKejohananSirkitLaporanFolder, $filename);
            }
            
            $file = UploadedFile::getInstance($model, 'senarai_urusetia_sukarelawan');
            $filename = $model->bantuan_penganjuran_kejohanan_laporan_id . "-senarai_urusetia_sukarelawan";
            if($file){
                $model->senarai_urusetia_sukarelawan = Upload::uploadFile($file, Upload::bantuanPenganjuranKejohananSirkitLaporanFolder, $filename);
            }
            
            $file = UploadedFile::getInstance($model, 'senarai_pegawai_pembantu_perubatan');
            $filename = $model->bantuan_penganjuran_kejohanan_laporan_id . "-senarai_pegawai_pembantu_perubatan";
            if($file){
                $model->senarai_pegawai_pembantu_perubatan = Upload::uploadFile($file, Upload::bantuanPenganjuranKejohananSirkitLaporanFolder, $filename);
            }
            
            if(isset(Yii::$app->session->id)){
                BantuanPenganjuranKejohananSirkitLaporanTuntutan::updateAll(['bantuan_penganjuran_kejohanan_laporan_id' => $model->bantuan_penganjuran_kejohanan_laporan_id], 'session_id = "'.Yii::$app->session->id.'"');
                BantuanPenganjuranKejohananSirkitLaporanTuntutan::updateAll(['session_id' => ''], 'bantuan_penganjuran_kejohanan_laporan_id = "'.$model->bantuan_penganjuran_kejohanan_laporan_id.'"');
                
            }
            
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->bantuan_penganjuran_kejohanan_laporan_id]);
            }
        } 
        
        return $this->render('create', [
                'model' => $model,
                'searchModelBantuanPenganjuranKejohananSirkitLaporanTuntutan' => $searchModelBantuanPenganjuranKejohananSirkitLaporanTuntutan,
                'dataProviderBantuanPenganjuranKejohananSirkitLaporanTuntutan' => $dataProviderBantuanPenganjuranKejohananSirkitLaporanTuntutan,
                'readonly' => false,
            ]);
    }
    
    /**
     * Displays a single BantuanPenganjuranKejohananSirkitLaporan model.
     * @param integer $id
     * @return mixed
     */
    public function actionLoad($bantuan_penganjuran_kejohanan_id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        if (($model = BantuanPenganjuranKejohananSirkitLaporan::find()->where(['bantuan_penganjuran_kejohanan_id'=>$bantuan_penganjuran_kejohanan_id])->one()) !== null) {
            return $this->redirect(['update', 'id' => $model->bantuan_penganjuran_kejohanan_laporan_id]);
        } else {
            return $this->redirect(['create', 'bantuan_penganjuran_kejohanan_id' => $bantuan_penganjuran_kejohanan_id]);
        }
    }

    /**
     * Updates an existing BantuanPenganjuranKejohananSirkitLaporan model.
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
        $existingPenyataPerbelanjaan = $model->penyata_perbelanjaan_resit_yang_telah_disahkan;
        
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
                $model->penyata_perbelanjaan_resit_yang_telah_disahkan = Upload::uploadFile($file, Upload::bantuanPenganjuranKejohananSirkitLaporanFolder, $filename);
            } else {
                //invalid file to upload
                //remain existing file
                $model->penyata_perbelanjaan_resit_yang_telah_disahkan = $existingPenyataPerbelanjaan;
            }
            
            $file = UploadedFile::getInstance($model, 'laporan_bergambar');
            $filename = $model->bantuan_penganjuran_kejohanan_laporan_id . "-laporan_bergambar";
            if($file){
                $model->laporan_bergambar = Upload::uploadFile($file, Upload::bantuanPenganjuranKejohananSirkitLaporanFolder, $filename);
            }
            
            $file = UploadedFile::getInstance($model, 'jadual_keputusan_pertandingan');
            $filename = $model->bantuan_penganjuran_kejohanan_laporan_id . "-jadual_keputusan_pertandingan";
            if($file){
                $model->jadual_keputusan_pertandingan = Upload::uploadFile($file, Upload::bantuanPenganjuranKejohananSirkitLaporanFolder, $filename);
            }
            
            $file = UploadedFile::getInstance($model, 'senarai_pasukan');
            $filename = $model->bantuan_penganjuran_kejohanan_laporan_id . "-senarai_pasukan";
            if($file){
                $model->senarai_pasukan = Upload::uploadFile($file, Upload::bantuanPenganjuranKejohananSirkitLaporanFolder, $filename);
            }
            
            $file = UploadedFile::getInstance($model, 'senarai_statistik_penyertaan');
            $filename = $model->bantuan_penganjuran_kejohanan_laporan_id . "-senarai_statistik_penyertaan";
            if($file){
                $model->senarai_statistik_penyertaan = Upload::uploadFile($file, Upload::bantuanPenganjuranKejohananSirkitLaporanFolder, $filename);
            }
            
            $file = UploadedFile::getInstance($model, 'senarai_pegawai_pembantu_teknikal');
            $filename = $model->bantuan_penganjuran_kejohanan_laporan_id . "-senarai_pegawai_pembantu_teknikal";
            if($file){
                $model->senarai_pegawai_pembantu_teknikal = Upload::uploadFile($file, Upload::bantuanPenganjuranKejohananSirkitLaporanFolder, $filename);
            }
            
            $file = UploadedFile::getInstance($model, 'senarai_urusetia_sukarelawan');
            $filename = $model->bantuan_penganjuran_kejohanan_laporan_id . "-senarai_urusetia_sukarelawan";
            if($file){
                $model->senarai_urusetia_sukarelawan = Upload::uploadFile($file, Upload::bantuanPenganjuranKejohananSirkitLaporanFolder, $filename);
            }
            
            $file = UploadedFile::getInstance($model, 'senarai_pegawai_pembantu_perubatan');
            $filename = $model->bantuan_penganjuran_kejohanan_laporan_id . "-senarai_pegawai_pembantu_perubatan";
            if($file){
                $model->senarai_pegawai_pembantu_perubatan = Upload::uploadFile($file, Upload::bantuanPenganjuranKejohananSirkitLaporanFolder, $filename);
            }
        }
        
        $queryPar = null;
        
        $queryPar['BantuanPenganjuranKejohananSirkitLaporanTuntutanSearch']['bantuan_penganjuran_kejohanan_laporan_id'] = $id;
        
        $searchModelBantuanPenganjuranKejohananSirkitLaporanTuntutan  = new BantuanPenganjuranKejohananSirkitLaporanTuntutanSearch();
        $dataProviderBantuanPenganjuranKejohananSirkitLaporanTuntutan = $searchModelBantuanPenganjuranKejohananSirkitLaporanTuntutan->search($queryPar);

        if (Yii::$app->request->post() && $model->save()) {
            return $this->redirect(['view', 'id' => $model->bantuan_penganjuran_kejohanan_laporan_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'searchModelBantuanPenganjuranKejohananSirkitLaporanTuntutan' => $searchModelBantuanPenganjuranKejohananSirkitLaporanTuntutan,
                'dataProviderBantuanPenganjuranKejohananSirkitLaporanTuntutan' => $dataProviderBantuanPenganjuranKejohananSirkitLaporanTuntutan,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Deletes an existing BantuanPenganjuranKejohananSirkitLaporan model.
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
     * Finds the BantuanPenganjuranKejohananSirkitLaporan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return BantuanPenganjuranKejohananSirkitLaporan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = BantuanPenganjuranKejohananSirkitLaporan::findOne($id)) !== null) {
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
		
		$BantuanPenganjuranKejohananSirkitLaporanTuntutan = BantuanPenganjuranKejohananSirkitLaporanTuntutan::find()
						->where(['bantuan_penganjuran_kejohanan_laporan_id' => $model->bantuan_penganjuran_kejohanan_laporan_id])->all();
        
        $pdf = new \mPDF('utf-8', 'A4');

        $pdf->title = 'Laporan Penyertaan Kejohanan <br />(Sirkit Remaja / Karnival)';
        $stylesheet = file_get_contents('css/report.css');

        $pdf->WriteHTML($stylesheet,1);
        
        $pdf->WriteHTML($this->renderpartial('print', [
			'BantuanPenganjuranKejohananSirkitLaporanTuntutan' => $BantuanPenganjuranKejohananSirkitLaporanTuntutan,
             'model'  => $model,
			 'title' => $pdf->title,
        ]));

        $pdf->Output('Laporan_Penyertaan_Kejohanan_(Sirkit_Remaja_Karnival)'.$id.'.pdf', 'I');
    }
}
