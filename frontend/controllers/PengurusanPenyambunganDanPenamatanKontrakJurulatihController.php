<?php

namespace frontend\controllers;

use Yii;
use app\models\PengurusanPenyambunganDanPenamatanKontrakJurulatih;
use frontend\models\PengurusanPenyambunganDanPenamatanKontrakJurulatihSearch;
use app\models\JurulatihSukan;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

use app\models\general\Upload;
use app\models\general\GeneralVariable;
use common\models\general\GeneralFunction;

// table reference
use app\models\Jurulatih;
use app\models\RefStatusPermohonanKontrakJurulatih;
use app\models\RefProgramJurulatih;
use app\models\RefGajiElaunJurulatih;
use app\models\RefJenisPermohonanKontrakJurulatih;
use app\models\RefStatusTawaran;
use app\models\User;

/**
 * PengurusanPenyambunganDanPenamatanKontrakJurulatihController implements the CRUD actions for PengurusanPenyambunganDanPenamatanKontrakJurulatih model.
 */
class PengurusanPenyambunganDanPenamatanKontrakJurulatihController extends Controller
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
     * Lists all PengurusanPenyambunganDanPenamatanKontrakJurulatih models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $searchModel = new PengurusanPenyambunganDanPenamatanKontrakJurulatihSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PengurusanPenyambunganDanPenamatanKontrakJurulatih model.Jurulatih::findOne($id)
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = $this->findModel($id);
        $jurulatih_id = $model->jurulatih;
        $ref = Jurulatih::findOne(['jurulatih_id' => $model->jurulatih]);
        $model->jurulatih = $ref['nameAndIC'];
		$namaJurulatih = $ref['nama'];
        
        $ref = RefStatusPermohonanKontrakJurulatih::findOne(['id' => $model->status_permohonan]);
        $model->status_permohonan = $ref['desc'];
        
        $ref = RefProgramJurulatih::findOne(['id' => $model->program]);
        $model->program = $ref['desc'];
        
        $ref = RefGajiElaunJurulatih::findOne(['id' => $model->gaji_elaun]);
        $model->gaji_elaun = $ref['desc'];
        
        $ref = RefJenisPermohonanKontrakJurulatih::findOne(['id' => $model->jenis_permohonan]);
        $model->jenis_permohonan = $ref['desc'];
        
        $ref = RefProgramJurulatih::findOne(['id' => $model->program_baru]);
        $model->program_baru = $ref['desc'];
        
        $ref = RefGajiElaunJurulatih::findOne(['id' => $model->cadangan_gaji_elaun]);
        $model->cadangan_gaji_elaun = $ref['desc'];
        
        if($model->tarikh_mula_lantikan != "") {$model->tarikh_mula_lantikan = GeneralFunction::convert($model->tarikh_mula_lantikan, GeneralFunction::TYPE_DATE);}
        if($model->tarikh_tamat_lantikan != "") {$model->tarikh_tamat_lantikan = GeneralFunction::convert($model->tarikh_tamat_lantikan, GeneralFunction::TYPE_DATE);}
        if($model->tarikh_mula != "") {$model->tarikh_mula = GeneralFunction::convert($model->tarikh_mula, GeneralFunction::TYPE_DATE);}
        if($model->tarikh_tamat != "") {$model->tarikh_tamat = GeneralFunction::convert($model->tarikh_tamat, GeneralFunction::TYPE_DATE);}
        if($model->penamatan_tarikh_berkuatkuasa != "") {$model->penamatan_tarikh_berkuatkuasa = GeneralFunction::convert($model->penamatan_tarikh_berkuatkuasa, GeneralFunction::TYPE_DATE);}
        if($model->tarikh_mpj != "") {$model->tarikh_mpj = GeneralFunction::convert($model->tarikh_mpj, GeneralFunction::TYPE_DATE);}
        if($model->tarikh_jkb != "") {$model->tarikh_jkb = GeneralFunction::convert($model->tarikh_jkb, GeneralFunction::TYPE_DATE);}
        
        return $this->render('view', [
            'model' => $model,
            'jurulatih_id' => $jurulatih_id,
			'namaJurulatih' => $namaJurulatih,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new PengurusanPenyambunganDanPenamatanKontrakJurulatih model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new PengurusanPenyambunganDanPenamatanKontrakJurulatih();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $upload = new Upload();
            $file = UploadedFile::getInstance($model, 'muat_naik_document');
            if($file){
                $model->muat_naik_document = $upload->uploadFile($file, Upload::pelanjutanPenamatanKontrakJurulatihFolder, $model->pengurusan_penyambungan_dan_penamatan_kontrak_jurulatih_id);
            }
            $file = UploadedFile::getInstance($model, 'muat_naik_cadangan');
            if($file){
                $model->muat_naik_cadangan = $upload->uploadFile($file, Upload::pelanjutanPenamatanKontrakJurulatihFolder, $model->pengurusan_penyambungan_dan_penamatan_kontrak_jurulatih_id);
            }
            
                if($model->status_permohonan == RefStatusPermohonanKontrakJurulatih::LULUS){
                    // update to Jurulatih profile Sukan if LULUS
                    $modelJurulatihSukan = null;
                    if (($modelJurulatihSukan = JurulatihSukan::find()->where(['pengurusan_penyambungan_dan_penamatan_kontrak_jurulatih_id'=>$model->pengurusan_penyambungan_dan_penamatan_kontrak_jurulatih_id])->one()) == null) {
                        $modelJurulatihSukan = new JurulatihSukan();
                    }

                    $modelJurulatihSukan->jurulatih_id = $model->jurulatih;
                    $modelJurulatihSukan->tarikh_mula_lantikan = $model->tarikh_mula_lantikan;
                    $modelJurulatihSukan->tarikh_tamat_lantikan = $model->tarikh_tamat_lantikan;
                    $modelJurulatihSukan->gaji_elaun = $model->cadangan_gaji_elaun;
                    $modelJurulatihSukan->jumlah = $model->cadangan_jumlah_gaji_elaun;
                    $modelJurulatihSukan->program = $model->program_baru;
                    $modelJurulatihSukan->pengurusan_penyambungan_dan_penamatan_kontrak_jurulatih_id = $model->pengurusan_penyambungan_dan_penamatan_kontrak_jurulatih_id;
                    $modelJurulatihSukan->save();
                }
                
                if($model->status_permohonan == RefStatusPermohonanKontrakJurulatih::GAGAL){
                    if (($modelJurulatih = Jurulatih::findOne($model->jurulatih)) !== null) {
                        $modelJurulatih->status_tawaran = RefStatusTawaran::TIDAK_DILULUSKAN;
                        $modelJurulatih->save();
                    }
                }
            
            if($model->save()){
                //email
                $modelUser = User::findOne($model->created_by);
                if (count($modelUser) > 0) {
                    $jurulatihModel = Jurulatih::findOne(['jurulatih_id' => $model->jurulatih]);
                    
                    $ref = RefStatusPermohonanKontrakJurulatih::findOne(['id' => $model->status_permohonan]);
                    $statusPermohonanDesc = $ref['desc'];
                    try {
                        Yii::$app->mailer->compose()
                                ->setTo($modelUser->email)
                                ->setFrom('noreply@spsb.com')
                                ->setSubject('Status Permohonan (' . $jurulatihModel->nama . '- '.$jurulatihModel->ic_no.') Kontrak Jurulatih')
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
                
                return $this->redirect(['view', 'id' => $model->pengurusan_penyambungan_dan_penamatan_kontrak_jurulatih_id]);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Updates an existing PengurusanPenyambunganDanPenamatanKontrakJurulatih model.
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
        $oriStatusPermohonan = $model->status_permohonan;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $upload = new Upload();
            $file = UploadedFile::getInstance($model, 'muat_naik_document');
            if($file){
                $model->muat_naik_document = $upload->uploadFile($file, Upload::pelanjutanPenamatanKontrakJurulatihFolder, $model->pengurusan_penyambungan_dan_penamatan_kontrak_jurulatih_id);
            }
            $file = UploadedFile::getInstance($model, 'muat_naik_cadangan');
            if($file){
                $model->muat_naik_cadangan = $upload->uploadFile($file, Upload::pelanjutanPenamatanKontrakJurulatihFolder, $model->pengurusan_penyambungan_dan_penamatan_kontrak_jurulatih_id);
            }
            
            if($model->status_permohonan == RefStatusPermohonanKontrakJurulatih::LULUS){
                // update to Jurulatih profile Sukan if LULUS
                $modelJurulatihSukan = null;
                if (($modelJurulatihSukan = JurulatihSukan::find()->where(['pengurusan_penyambungan_dan_penamatan_kontrak_jurulatih_id'=>$model->pengurusan_penyambungan_dan_penamatan_kontrak_jurulatih_id])->one()) == null) {
                    $modelJurulatihSukan = new JurulatihSukan();
                }

                $modelJurulatihSukan->jurulatih_id = $model->jurulatih;
                $modelJurulatihSukan->tarikh_mula_lantikan = $model->tarikh_mula;
                $modelJurulatihSukan->tarikh_tamat_lantikan = $model->tarikh_tamat;
                $modelJurulatihSukan->gaji_elaun = $model->cadangan_gaji_elaun;
                $modelJurulatihSukan->jumlah = $model->cadangan_jumlah_gaji_elaun;
                $modelJurulatihSukan->program = $model->program_baru;
                $modelJurulatihSukan->pengurusan_penyambungan_dan_penamatan_kontrak_jurulatih_id = $model->pengurusan_penyambungan_dan_penamatan_kontrak_jurulatih_id;
                $modelJurulatihSukan->save();
            }
            
            if($model->status_permohonan == RefStatusPermohonanKontrakJurulatih::GAGAL){
                    if (($modelJurulatih = Jurulatih::findOne($id)) !== null) {
                        $modelJurulatih->status_tawaran = RefStatusTawaran::TIDAK_DILULUSKAN;
                        $modelJurulatih->save();
                    }
                }
            
            if($model->save()){
                if($oriStatusPermohonan != $model->status_permohonan) {
                    //email
                    $modelUser = User::findOne($model->created_by);
                    if (count($modelUser) > 0) {
                        $jurulatihModel = Jurulatih::findOne(['jurulatih_id' => $model->jurulatih]);
                        
                        $ref = RefStatusPermohonanKontrakJurulatih::findOne(['id' => $model->status_permohonan]);
                        $statusPermohonanDesc = $ref['desc'];
                        try {
                            Yii::$app->mailer->compose()
                                    ->setTo($modelUser->email)
                                    ->setFrom('noreply@spsb.com')
                                    ->setSubject('Status Permohonan (' . $jurulatihModel->nama . '- '.$jurulatihModel->ic_no.') Kontrak Jurulatih')
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
                
                return $this->redirect(['view', 'id' => $model->pengurusan_penyambungan_dan_penamatan_kontrak_jurulatih_id]);
            }
        }
        
        return $this->render('update', [
            'model' => $model,
            'readonly' => false,
        ]);
    }

    /**
     * Deletes an existing PengurusanPenyambunganDanPenamatanKontrakJurulatih model.
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
        self::actionDeleteupload($id, 'muat_naik_document');
        self::actionDeleteupload($id, 'muat_naik_cadangan');
        
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the PengurusanPenyambunganDanPenamatanKontrakJurulatih model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PengurusanPenyambunganDanPenamatanKontrakJurulatih the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PengurusanPenyambunganDanPenamatanKontrakJurulatih::findOne($id)) !== null) {
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
	
	public function actionPrint($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }  
        $model = $this->findModel($id);
		
		$jurulatih_id = $model->jurulatih;
        $ref = Jurulatih::findOne(['jurulatih_id' => $model->jurulatih]);
        $model->jurulatih = $ref['nameAndIC'];
        
        $ref = RefStatusPermohonanKontrakJurulatih::findOne(['id' => $model->status_permohonan]);
        $model->status_permohonan = $ref['desc'];
        
        $ref = RefProgramJurulatih::findOne(['id' => $model->program]);
        $model->program = $ref['desc'];
        
        $ref = RefGajiElaunJurulatih::findOne(['id' => $model->gaji_elaun]);
        $model->gaji_elaun = $ref['desc'];
        
        $ref = RefJenisPermohonanKontrakJurulatih::findOne(['id' => $model->jenis_permohonan]);
        $model->jenis_permohonan = $ref['desc'];
        
        $ref = RefProgramJurulatih::findOne(['id' => $model->program_baru]);
        $model->program_baru = $ref['desc'];
        
        $ref = RefGajiElaunJurulatih::findOne(['id' => $model->cadangan_gaji_elaun]);
        $model->cadangan_gaji_elaun = $ref['desc'];

        $pdf = new \mPDF('utf-8', 'A4');

        $pdf->title = 'Kontrak Jurulatih';

        $stylesheet = file_get_contents('css/report.css');

        $pdf->WriteHTML($stylesheet,1);
        
        $pdf->WriteHTML($this->renderpartial('print', [
             'model'  => $model,
			 'title' => $pdf->title,
        ]));

        $pdf->Output('Kontrak_jurulatih'.$model->pengurusan_penyambungan_dan_penamatan_kontrak_jurulatih_id.'.pdf', 'I'); 
    }
}
