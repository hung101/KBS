<?php

namespace frontend\controllers;

use Yii;
use app\models\PengurusanInsentif;
use frontend\models\PengurusanInsentifSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

use app\models\general\Upload;

// contant values
use app\models\general\GeneralLabel;

// table reference
use app\models\Atlet;
use app\models\Jurulatih;
use app\models\RefNamaInsentif;
use app\models\RefKumpulan;
use app\models\RefRekodBaru;
use app\models\RefSukan;
use app\models\RefKelayakanPingat;
use app\models\RefPersatuan;
use app\models\RefAcaraOlimpik;
use app\models\RefPingat;
use app\models\RefKategoriInsentif;

/**
 * PengurusanInsentifController implements the CRUD actions for PengurusanInsentif model.
 */
class PengurusanInsentifController extends Controller
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
     * Lists all PengurusanInsentif models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PengurusanInsentifSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PengurusanInsentif model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        
        $ref = Atlet::findOne(['atlet_id' => $model->atlet_id]);
        $model->atlet_id = $ref['nameAndIC'];
        
        $ref = Jurulatih::findOne(['jurulatih_id' => $model->sgar_nama_jurulatih]);
        $model->sgar_nama_jurulatih = $ref['nameAndIC'];
        
        $ref = RefKumpulan::findOne(['id' => $model->kumpulan]);
        $model->kumpulan = $ref['desc'];
        
        $ref = RefRekodBaru::findOne(['id' => $model->rekod_baru]);
        $model->rekod_baru = $ref['desc'];
        
        $ref = RefSukan::findOne(['id' => $model->nama_sukan]);
        $model->nama_sukan = $ref['desc'];
        
        $ref = RefKelayakanPingat::findOne(['id' => $model->kelayakan_pingat]);
        $model->kelayakan_pingat = $ref['desc'];
        
        $ref = RefNamaInsentif::findOne(['id' => $model->nama_insentif]);
        $model->nama_insentif = $ref['desc'];
        
        $ref = RefPersatuan::findOne(['id' => $model->sikap_nama_persatuan]);
        $model->sikap_nama_persatuan = $ref['desc'];
        
        $ref = RefAcaraOlimpik::findOne(['id' => $model->sito_nama_acara_di_olimpik]);
        $model->sito_nama_acara_di_olimpik = $ref['desc'];
        
        $ref = RefPingat::findOne(['id' => $model->sito_pingat]);
        $model->sito_pingat = $ref['desc'];
        
        $ref = RefKategoriInsentif::findOne(['id' => $model->category_insentif]);
        $model->category_insentif = $ref['desc'];
        
        $YesNo = GeneralLabel::getYesNoLabel($model->kelulusan);
        $model->kelulusan = $YesNo;
        
        return $this->render('view', [
            'model' => $model,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new PengurusanInsentif model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new PengurusanInsentif();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $file = UploadedFile::getInstance($model, 'muat_naik_dokumen');
            if($file){
                $model->muat_naik_dokumen = Upload::uploadFile($file, Upload::pengurusanInsentifFolder, $model->pengurusan_insentif_id);
            }
            
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->pengurusan_insentif_id]);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Updates an existing PengurusanInsentif model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $file = UploadedFile::getInstance($model, 'muat_naik_dokumen');
            if($file){
                $model->muat_naik_dokumen = Upload::uploadFile($file, Upload::pengurusanInsentifFolder, $model->pengurusan_insentif_id);
            }
            
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->pengurusan_insentif_id]);
            }
        } else {
            return $this->render('update', [
                'model' => $model,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Deletes an existing PengurusanInsentif model.
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
     * Finds the PengurusanInsentif model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PengurusanInsentif the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PengurusanInsentif::findOne($id)) !== null) {
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
