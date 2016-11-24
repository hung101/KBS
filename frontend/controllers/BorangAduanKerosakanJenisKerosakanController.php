<?php

namespace frontend\controllers;

use Yii;
use app\models\BorangAduanKerosakanJenisKerosakan;
use frontend\models\BorangAduanKerosakanJenisKerosakanSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;use yii\web\UploadedFile;

use app\models\general\GeneralVariable;
use app\models\general\GeneralLabel;
use app\models\general\Upload;

// table reference
use app\models\RefNamaPemeriksaAduan;
use app\models\RefKategoriKerosakan;
use app\models\RefTindakanAduan;

/**
 * BorangAduanKerosakanJenisKerosakanController implements the CRUD actions for BorangAduanKerosakanJenisKerosakan model.
 */
class BorangAduanKerosakanJenisKerosakanController extends Controller
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
     * Lists all BorangAduanKerosakanJenisKerosakan models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $searchModel = new BorangAduanKerosakanJenisKerosakanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single BorangAduanKerosakanJenisKerosakan model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = $this->findModel($id);
        
        $ref = RefNamaPemeriksaAduan::findOne(['id' => $model->nama_pemeriksa]);
        $model->nama_pemeriksa = $ref['desc'];
        
        $ref = RefKategoriKerosakan::findOne(['id' => $model->kategori_kerosakan]);
        $model->kategori_kerosakan = $ref['desc'];
        
        $ref = RefTindakanAduan::findOne(['id' => $model->tindakan]);
        $model->tindakan = $ref['desc'];
        
        $YesNo = GeneralLabel::getYesNoLabel($model->selesai);
        $model->selesai = $YesNo;
        
        return $this->renderAjax('view', [
            'model' => $model,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new BorangAduanKerosakanJenisKerosakan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($borang_aduan_kerosakan_id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new BorangAduanKerosakanJenisKerosakan();
        
        Yii::$app->session->open();
        
        if($borang_aduan_kerosakan_id != ''){
            $model->borang_aduan_kerosakan_id = $borang_aduan_kerosakan_id;
        } else {
            if(isset(Yii::$app->session->id)){
                $model->session_id = Yii::$app->session->id;
            }
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            
             $file = UploadedFile::getInstance($model, 'gambar');
            if($file){
                $model->gambar = Upload::uploadFile($file, Upload::borangaduankerosakanjeniskerosakanFolder, $model->borang_aduan_kerosakan_jenis_kerosakan_id);
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
     * Updates an existing BorangAduanKerosakanJenisKerosakan model.
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
        
        $existingGambar = $model->gambar;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            
            $file = UploadedFile::getInstance($model, 'gambar');
            if($file){
                $model->gambar = Upload::uploadFile($file, Upload::borangaduankerosakanjeniskerosakanFolder, $model->borang_aduan_kerosakan_jenis_kerosakan_id);
            } else {
                $model->gambar = $existingGambar;
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
     * Deletes an existing BorangAduanKerosakanJenisKerosakan model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        self::actionDeleteupload($id, 'gambar');
        
        $this->findModel($id)->delete();

        //return $this->redirect(['index']);
    }

    /**
     * Finds the BorangAduanKerosakanJenisKerosakan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return BorangAduanKerosakanJenisKerosakan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = BorangAduanKerosakanJenisKerosakan::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
