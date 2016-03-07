<?php

namespace frontend\controllers;

use Yii;
use app\models\BantuanElaun;
use frontend\models\BantuanElaunSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

use app\models\general\Upload;
use app\models\general\GeneralVariable;

// table reference
use app\models\RefJantina;
use app\models\RefJenisBantuanSue;
use app\models\RefKelayakanAkademik;
use app\models\RefBandar;
use app\models\RefNegeri;
use app\models\RefBangsa;
use app\models\RefAgama;
use app\models\RefStatusPermohonanSue;
use app\models\RefNegara;

/**
 * BantuanElaunController implements the CRUD actions for BantuanElaun model.
 */
class BantuanElaunController extends Controller
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
     * Lists all BantuanElaun models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect($this->redirect(array(GeneralVariable::loginPagePath)));
        }
        
        $searchModel = new BantuanElaunSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single BantuanElaun model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect($this->redirect(array(GeneralVariable::loginPagePath)));
        }
        
        $model = $this->findModel($id);
        
        $ref = RefJenisBantuanSue::findOne(['id' => $model->jenis_bantuan]);
        $model->jenis_bantuan = $ref['desc'];
        
        $ref = RefJantina::findOne(['id' => $model->jantina]);
        $model->jantina = $ref['desc'];
        
        $ref = RefNegara::findOne(['id' => $model->kewarganegara]);
        $model->kewarganegara = $ref['desc'];
        
        $ref = RefBangsa::findOne(['id' => $model->bangsa]);
        $model->bangsa = $ref['desc'];
        
        $ref = RefAgama::findOne(['id' => $model->agama]);
        $model->agama = $ref['desc'];
        
        $ref = RefKelayakanAkademik::findOne(['id' => $model->kelayakan_akademi]);
        $model->kelayakan_akademi = $ref['desc'];
        
        $ref = RefNegeri::findOne(['id' => $model->alamat_negeri]);
        $model->alamat_negeri = $ref['desc'];
        
        $ref = RefBandar::findOne(['id' => $model->alamat_bandar]);
        $model->alamat_bandar = $ref['desc'];
        
        $ref = RefStatusPermohonanSue::findOne(['id' => $model->status_permohonan]);
        $model->status_permohonan = $ref['desc'];
        
        return $this->render('view', [
            'model' => $model,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new BantuanElaun model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect($this->redirect(array(GeneralVariable::loginPagePath)));
        }
        
        $model = new BantuanElaun();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $file = UploadedFile::getInstance($model, 'muatnaik_gambar');
            $filename = $model->bantuan_elaun_id . "-muatnaik_gambar";
            if($file){
                $model->muatnaik_gambar = Upload::uploadFile($file, Upload::bantuanElaunFolder, $filename);
            }
            
            $file = UploadedFile::getInstance($model, 'muatnaik_dokumen');
            $filename = $model->bantuan_elaun_id . "-muatnaik_dokumen";
            if($file){
                $model->muatnaik_dokumen = Upload::uploadFile($file, Upload::bantuanElaunFolder, $filename);
            }
            
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->bantuan_elaun_id]);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Updates an existing BantuanElaun model.
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
        
        $existingMuatnaikDokumen = $model->muatnaik_dokumen;
        
        if($model->load(Yii::$app->request->post())){
            $file = UploadedFile::getInstance($model, 'muatnaik_dokumen');

            if($file){
                //valid file to upload
                //upload file to server
                $filename = $model->bantuan_elaun_id . "-muatnaik_dokumen";
                $model->muatnaik_dokumen = Upload::uploadFile($file,  Upload::bantuanElaunFolder, $filename);
            } else {
                //invalid file to upload
                //remain existing file
                $model->muatnaik_dokumen = $existingMuatnaikDokumen;
            }
        }

        if (Yii::$app->request->post() && $model->save()) {
            $file = UploadedFile::getInstance($model, 'muatnaik_gambar');
            $filename = $model->bantuan_elaun_id . "-muatnaik_gambar";
            if($file){
                $model->muatnaik_gambar = Upload::uploadFile($file, Upload::bantuanElaunFolder, $filename);
            }
            
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->bantuan_elaun_id]);
            }
        } else {
            return $this->render('update', [
                'model' => $model,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Deletes an existing BantuanElaun model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect($this->redirect(array(GeneralVariable::loginPagePath)));
        }
        
        // delete upload file
        self::actionDeleteimg($id, 'muatnaik_dokumen');
        self::actionDeleteimg($id, 'muatnaik_gambar');
        
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the BantuanElaun model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return BantuanElaun the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = BantuanElaun::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    // Add function for delete image or file
    public function actionDeleteimg($id, $field)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect($this->redirect(array(GeneralVariable::loginPagePath)));
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
