<?php

namespace frontend\controllers;

use Yii;
use app\models\Atlet;
use app\models\AtletSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;
use yii\filters\VerbFilter;
use yii\web\Session;

// table reference
use app\models\RefJantina;
use app\models\RefAtletTahap;
use app\models\RefCawangan;
use app\models\RefBandar;
use app\models\RefNegeri;
use app\models\RefBangsa;
use app\models\RefAgama;
use app\models\RefTarafPerkahwinan;
use app\models\RefJenisLesenMemandu;
use app\models\RefBahasa;

use app\models\general\GeneralLabel;
use app\models\general\Upload;
use app\models\general\GeneralVariable;

/**
 * AtletController implements the CRUD actions for Atlet model.
 */
class AtletController extends Controller
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
     * Lists all Atlet models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $searchModel = new AtletSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Atlet model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $session = new Session;
        $session->open();
        
        $session['atlet_id'] = $id;
        
        $session->close();
        
        // get atlet details
        $atlet = $this->findModel($id);
        
        // get atlet dropdown value's descriptions
        $ref = RefAtletTahap::findOne(['id' => $atlet->tahap]);
        $atlet->tahap = $ref['desc'];
        
        $ref = RefCawangan::findOne(['id' => $atlet->cawangan]);
        $atlet->cawangan = $ref['desc'];
        
        $ref = RefBandar::findOne(['id' => $atlet->tempat_lahir_bandar]);
        $atlet->tempat_lahir_bandar = $ref['desc'];
        
        $ref = RefNegeri::findOne(['id' => $atlet->tempat_lahir_negeri]);
        $atlet->tempat_lahir_negeri = $ref['desc'];
        
        $ref = RefBangsa::findOne(['id' => $atlet->bangsa]);
        $atlet->bangsa = $ref['desc'];
        
        $ref = RefAgama::findOne(['id' => $atlet->agama]);
        $atlet->agama = $ref['desc'];
        
        $ref = RefJantina::findOne(['id' => $atlet->jantina]);
        $atlet->jantina = $ref['desc'];
        
        $ref = RefTarafPerkahwinan::findOne(['id' => $atlet->taraf_perkahwinan]);
        $atlet->taraf_perkahwinan = $ref['desc'];
        
        $ref = RefBahasa::findOne(['id' => $atlet->bahasa_ibu]);
        $atlet->bahasa_ibu = $ref['desc'];
        
        $ref = RefJenisLesenMemandu::findOne(['id' => $atlet->jenis_lesen]);
        $atlet->jenis_lesen = $ref['desc'];
        
        $ref = RefNegeri::findOne(['id' => $atlet->alamat_rumah_negeri]);
        $atlet->alamat_rumah_negeri = $ref['desc'];
        
        $ref = RefBandar::findOne(['id' => $atlet->alamat_rumah_bandar]);
        $atlet->alamat_rumah_bandar = $ref['desc'];
        
        $ref = RefNegeri::findOne(['id' => $atlet->alamat_surat_negeri]);
        $atlet->alamat_surat_negeri = $ref['desc'];
        
        $ref = RefBandar::findOne(['id' => $atlet->alamat_surat_bandar]);
        $atlet->alamat_surat_bandar = $ref['desc'];
        
        $YesNo = GeneralLabel::getYesNoLabel($atlet->tid);
        $atlet->tid = $YesNo;
        
        $YesNo = GeneralLabel::getYesNoLabel($atlet->tawaran);
        $atlet->tawaran = $YesNo;
        
        return $this->render('layout', [
            'model' => $atlet,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new Atlet model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new Atlet();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $file = UploadedFile::getInstance($model, 'gambar');
            if($file){
                $model->gambar = Upload::uploadFile($file, Upload::atletFolder, $model->atlet_id);
            }
            
            if($model->save()){
                $session = new Session;
                $session->open();

                $session['atlet_id'] = $model->atlet_id;
                
                $session->close();
                
                return $this->redirect(['view', 'id' => $model->atlet_id]);
            }
        }
        
        return $this->render('layout', [
            'model' => $model,
            'readonly' => false,
        ]);
    }

    /**
     * Updates an existing Atlet model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $session = new Session;
        $session->open();

        $session['atlet_id'] = $id;
        
        $session->close();
                
        $model = $this->findModel($id);
        
        if ($model->load(Yii::$app->request->post())) {
            
            $file = UploadedFile::getInstance($model, 'gambar');
            if($file){
                $model->gambar = Upload::uploadFile($file, Upload::atletFolder, $model->atlet_id);
            }
            
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->atlet_id]);
            }
            
        }
        
        return $this->render('layout', [
            'model' => $model,
            'readonly' => false,
        ]);
    }

    public function actionBulk() {

        $action=Yii::$app->request->post('action');
        $selection=(array)Yii::$app->request->post('selection');

        foreach($selection as $id){
            $model = $this->findModel((int)$id);
            $model->tawaran = $action;
            $model->save();
        }
        
        return $this->redirect(['index']);
    }

    /**
     * Deletes an existing Atlet model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
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
     * Finds the Atlet model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Atlet the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Atlet::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    // Add function for delete image or file
    public function actionDeleteimg($id, $field)
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
