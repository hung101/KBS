<?php

namespace frontend\controllers;

use Yii;
use app\models\PenilaianPestasi;
use app\models\PenilaianPestasiSearch;
use app\models\PenilaianPrestasiAtletSasaran;
use frontend\models\PenilaianPrestasiAtletSasaranSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

use app\models\general\Upload;

// table reference
use app\models\Atlet;
use app\models\RefKategoriKecergasan;
use app\models\RefKejohanan;
use app\models\RefSukan;
use app\models\RefAcara;
use app\models\RefProgramSemasaSukanAtlet;
use app\models\PerancanganProgram;
use app\models\RefJenisAktiviti;
use app\models\RefNegeri;

/**
 * PenilaianPestasiController implements the CRUD actions for PenilaianPestasi model.
 */
class PenilaianPestasiController extends Controller
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
     * Lists all PenilaianPestasi models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PenilaianPestasiSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PenilaianPestasi model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        
        $ref = Atlet::findOne(['atlet_id' => $model->atlet_id]);
        $model->atlet_id = $ref['nameAndIC'];
        
        $ref = RefKategoriKecergasan::findOne(['id' => $model->kategori_kecergasan]);
        $model->kategori_kecergasan = $ref['desc'];
        
        //$ref = RefKejohanan::findOne(['id' => $model->kejohanan]);
        //$model->kejohanan = $ref['desc'];
        
        $ref = RefSukan::findOne(['id' => $model->sukan]);
        $model->sukan = $ref['desc'];
        
        $ref = RefAcara::findOne(['id' => $model->acara]);
        $model->acara = $ref['desc'];
        
        $ref = PerancanganProgram::findOne(['perancangan_program_id' => $model->kejohanan]);
        $model->kejohanan = $ref['nama_program'];
        
        $ref = RefProgramSemasaSukanAtlet::findOne(['id' => $model->program]);
        $model->program = $ref['desc'];
        
        $ref = RefNegeri::findOne(['id' => $model->negeri]);
        $model->negeri = $ref['desc'];
        
        $queryPar = null;
        
        $queryPar['PenilaianPrestasiAtletSasaranSearch']['penilaian_pestasi_id'] = $id;
        
        $searchModelPenilaianPrestasiAtletSasaran  = new PenilaianPrestasiAtletSasaranSearch();
        $dataProviderPenilaianPrestasiAtletSasaran = $searchModelPenilaianPrestasiAtletSasaran->search($queryPar);
        
        return $this->render('view', [
            'model' => $model,
            'searchModelPenilaianPrestasiAtletSasaran' => $searchModelPenilaianPrestasiAtletSasaran,
            'dataProviderPenilaianPrestasiAtletSasaran' => $dataProviderPenilaianPrestasiAtletSasaran,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new PenilaianPestasi model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new PenilaianPestasi();
        
        $queryPar = null;
        
        Yii::$app->session->open();
        
        if(isset(Yii::$app->session->id)){
            $queryPar['PenilaianPrestasiAtletSasaranSearch']['session_id'] = Yii::$app->session->id;
        }
        
        $searchModelPenilaianPrestasiAtletSasaran  = new PenilaianPrestasiAtletSasaranSearch();
        $dataProviderPenilaianPrestasiAtletSasaran = $searchModelPenilaianPrestasiAtletSasaran->search($queryPar);
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $file = UploadedFile::getInstance($model, 'laporan_kesihatan');
            if($file){
                $model->laporan_kesihatan = Upload::uploadFile($file, Upload::pernilaianPrestasiFolder, $model->penilaian_pestasi_id);
            }
            
            if(isset(Yii::$app->session->id)){
                PenilaianPrestasiAtletSasaran::updateAll(['penilaian_pestasi_id' => $model->penilaian_pestasi_id], 'session_id = "'.Yii::$app->session->id.'"');
                PenilaianPrestasiAtletSasaran::updateAll(['session_id' => ''], 'penilaian_pestasi_id = "'.$model->penilaian_pestasi_id.'"');
            }
            
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->penilaian_pestasi_id]);
            }
        }
        
        return $this->render('create', [
            'model' => $model,
            'searchModelPenilaianPrestasiAtletSasaran' => $searchModelPenilaianPrestasiAtletSasaran,
            'dataProviderPenilaianPrestasiAtletSasaran' => $dataProviderPenilaianPrestasiAtletSasaran,
            'readonly' => false,
        ]);
    }

    /**
     * Updates an existing PenilaianPestasi model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        
        $queryPar = null;
        
        $queryPar['PenilaianPrestasiAtletSasaranSearch']['penilaian_pestasi_id'] = $id;
        
        $searchModelPenilaianPrestasiAtletSasaran  = new PenilaianPrestasiAtletSasaranSearch();
        $dataProviderPenilaianPrestasiAtletSasaran = $searchModelPenilaianPrestasiAtletSasaran->search($queryPar);

        if ($model->load(Yii::$app->request->post())) {
            $file = UploadedFile::getInstance($model, 'laporan_kesihatan');
            if($file){
                $model->laporan_kesihatan = Upload::uploadFile($file, Upload::pernilaianPrestasiFolder, $model->penilaian_pestasi_id);
            }
            
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->penilaian_pestasi_id]);
            }
        } else {
            return $this->render('update', [
                'model' => $model,
                'searchModelPenilaianPrestasiAtletSasaran' => $searchModelPenilaianPrestasiAtletSasaran,
                'dataProviderPenilaianPrestasiAtletSasaran' => $dataProviderPenilaianPrestasiAtletSasaran,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Deletes an existing PenilaianPestasi model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        // delete upload file
        self::actionDeleteupload($id, 'laporan_kesihatan');
        
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the PenilaianPestasi model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PenilaianPestasi the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PenilaianPestasi::findOne($id)) !== null) {
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
