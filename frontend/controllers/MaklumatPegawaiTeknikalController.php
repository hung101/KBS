<?php

namespace frontend\controllers;

use Yii;
use app\models\MaklumatPegawaiTeknikal;
use frontend\models\MaklumatPegawaiTeknikalSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

use app\models\general\Upload;

// table reference
use app\models\ProfilBadanSukan;
use app\models\RefJantina;
use app\models\RefSukan;
use app\models\RefBandar;
use app\models\RefNegeri;
use app\models\RefTahapAkademikPegawaiTeknikal;

/**
 * MaklumatPegawaiTeknikalController implements the CRUD actions for MaklumatPegawaiTeknikal model.
 */
class MaklumatPegawaiTeknikalController extends Controller
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
     * Lists all MaklumatPegawaiTeknikal models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MaklumatPegawaiTeknikalSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single MaklumatPegawaiTeknikal model.
     * @param integer $id
     * @return mixed
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
        
        return $this->render('view', [
            'model' => $model,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new MaklumatPegawaiTeknikal model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new MaklumatPegawaiTeknikal();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $file = UploadedFile::getInstance($model, 'tahap_kelayakan_sukan_peringkat_kebangsaan');
            if($file){
                $model->tahap_kelayakan_sukan_peringkat_kebangsaan = Upload::uploadFile($file, Upload::maklumatPegawaiTeknikalFolder, 'muat_naik_perlembagaan_terkini-' . $model->bantuan_penganjuran_kursus_pegawai_teknikal_dicadangkan_id);
            }
            
            $file = UploadedFile::getInstance($model, 'tahap_kelayakan_sukan_peringkat_antarabangsa');
            if($file){
                $model->tahap_kelayakan_sukan_peringkat_antarabangsa = Upload::uploadFile($file, Upload::maklumatPegawaiTeknikalFolder, 'muat_naik_perlembagaan_terkini-' . $model->bantuan_penganjuran_kursus_pegawai_teknikal_dicadangkan_id);
            }
            
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->bantuan_penganjuran_kursus_pegawai_teknikal_dicadangkan_id]);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Updates an existing MaklumatPegawaiTeknikal model.
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
                $model->tahap_kelayakan_sukan_peringkat_kebangsaan = Upload::uploadFile($file, Upload::maklumatPegawaiTeknikalFolder, 'muat_naik_perlembagaan_terkini-' . $model->bantuan_penganjuran_kursus_pegawai_teknikal_dicadangkan_id);
            }
            
            $file = UploadedFile::getInstance($model, 'tahap_kelayakan_sukan_peringkat_antarabangsa');
            if($file){
                $model->tahap_kelayakan_sukan_peringkat_antarabangsa = Upload::uploadFile($file, Upload::maklumatPegawaiTeknikalFolder, 'muat_naik_perlembagaan_terkini-' . $model->bantuan_penganjuran_kursus_pegawai_teknikal_dicadangkan_id);
            }
            
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->bantuan_penganjuran_kursus_pegawai_teknikal_dicadangkan_id]);
            }
        } else {
            return $this->render('update', [
                'model' => $model,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Deletes an existing MaklumatPegawaiTeknikal model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        // delete upload file
        self::actionDeleteupload($id, 'tahap_kelayakan_sukan_peringkat_kebangsaan');
        
        self::actionDeleteupload($id, 'tahap_kelayakan_sukan_peringkat_antarabangsa');
        
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the MaklumatPegawaiTeknikal model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MaklumatPegawaiTeknikal the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MaklumatPegawaiTeknikal::findOne($id)) !== null) {
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
}