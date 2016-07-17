<?php

namespace frontend\controllers;

use Yii;
use app\models\PengurusanPenyambunganDanPenamatanKontrakJurulatih;
use frontend\models\PengurusanPenyambunganDanPenamatanKontrakJurulatihSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

use app\models\general\Upload;
use app\models\general\GeneralVariable;

// table reference
use app\models\Jurulatih;
use app\models\RefStatusPermohonanKontrakJurulatih;
use app\models\RefProgramJurulatih;
use app\models\RefGajiElaunJurulatih;
use app\models\RefJenisPermohonanKontrakJurulatih;

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
     * Displays a single PengurusanPenyambunganDanPenamatanKontrakJurulatih model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = $this->findModel($id);
        
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
        
        return $this->render('view', [
            'model' => $model,
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
            
            if($model->save()){
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

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $upload = new Upload();
            $file = UploadedFile::getInstance($model, 'muat_naik_document');
            if($file){
                $model->muat_naik_document = $upload->uploadFile($file, Upload::pelanjutanPenamatanKontrakJurulatihFolder, $model->pengurusan_penyambungan_dan_penamatan_kontrak_jurulatih_id);
            }
            
            if($model->save()){
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
                if (!unlink($img)) {
                    return false;
                }
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
}
