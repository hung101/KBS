<?php

namespace frontend\controllers;

use Yii;
use app\models\PembayaranInsentifAtlet;
use frontend\models\PembayaranInsentifAtletSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Session;

use app\models\general\GeneralVariable;
use common\models\general\GeneralFunction;

// table reference
use app\models\Atlet;
use app\models\RefAcara;
use app\models\RefSukan;
use app\models\RefPingatInsentif;
use app\models\RefPembayaranKepada;
use app\models\RefAcaraInsentif;
use app\models\RefBank;

/**
 * PembayaranInsentifAtletController implements the CRUD actions for PembayaranInsentifAtlet model.
 */
class PembayaranInsentifAtletController extends Controller
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
     * Lists all PembayaranInsentifAtlet models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $searchModel = new PembayaranInsentifAtletSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PembayaranInsentifAtlet model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = $this->findModel($id);
        
        $ref = Atlet::findOne(['atlet_id' => $model->atlet]);
        $model->atlet = $ref['nameAndIC'];
        
        $ref = RefAcara::findOne(['id' => $model->acara]);
        $model->acara = $ref['desc'];
        
        $ref = RefSukan::findOne(['id' => $model->sukan]);
        $model->sukan = $ref['desc'];
        
        $ref = RefPingatInsentif::findOne(['id' => $model->pingat]);
        $model->pingat = $ref['desc'];
        
        $ref = RefAcaraInsentif::findOne(['id' => $model->kelayakan_pingat]);
        $model->kelayakan_pingat = $ref['desc'];
        
        $ref = RefPembayaranKepada::findOne(['id' => $model->pembayaran_kepada]);
        $model->pembayaran_kepada = $ref['desc'];
        
        $ref = RefBank::findOne(['id' => $model->nama_bank]);
        $model->nama_bank = $ref['desc'];
        
        return $this->renderAjax('view', [
            'model' => $model,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new PembayaranInsentifAtlet model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($pembayaran_insentif_id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new PembayaranInsentifAtlet();
        
        Yii::$app->session->open();
        
        if($pembayaran_insentif_id != ''){
            $model->pembayaran_insentif_id = $pembayaran_insentif_id;
        } else {
            if(isset(Yii::$app->session->id)){
                $model->session_id = Yii::$app->session->id;
            }
        }
        
        if(Yii::$app->request->post()){
            $session = new Session;
            $session->open();

            if($session['acara_id'] == RefAcaraInsentif::BERPASUKAN_KURANG_5_ORANG){
                $modelCount = 0;
                if($pembayaran_insentif_id != ''){
                    $modelCount = PembayaranInsentifAtlet::find()->where(['=', 'pembayaran_insentif_id', $pembayaran_insentif_id])->count();
                } else {
                    if(isset(Yii::$app->session->id)){
                        $modelCount = PembayaranInsentifAtlet::find()->where(['=', 'session_id', Yii::$app->session->id])->count();
                    }
                }
                
                if($modelCount > 4){
                    //Yii::$app->session->setFlash('info', 'Tak boleh tambah lebih daripada 5 atlet ');
                    return '0: <div class="alert alert-danger">
  Tak boleh tambah lebih daripada 5 atlet.
</div>';
                }
            }

            $session->close();
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return '1';
        } else {
            return $this->renderAjax('create', [
                'model' => $model,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Updates an existing PembayaranInsentifAtlet model.
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
            return '1';
        } else {
            return $this->renderAjax('update', [
                'model' => $model,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Deletes an existing PembayaranInsentifAtlet model.
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

        //return $this->redirect(['index']);
    }

    /**
     * Finds the PembayaranInsentifAtlet model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PembayaranInsentifAtlet the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PembayaranInsentifAtlet::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
