<?php

namespace frontend\controllers;

use Yii;
use app\models\PembayaranInsentif;
use frontend\models\PembayaranInsentifSearch;
use app\models\PembayaranInsentifAtlet;
use frontend\models\PembayaranInsentifAtletSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use app\models\general\GeneralVariable;
use app\models\general\GeneralLabel;

// table reference
use app\models\RefJenisInsentif;
use app\models\RefPingatInsentif;
use app\models\PengurusanInsentifTetapanShakamShakar;

/**
 * PembayaranInsentifController implements the CRUD actions for PembayaranInsentif model.
 */
class PembayaranInsentifController extends Controller
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
     * Lists all PembayaranInsentif models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $searchModel = new PembayaranInsentifSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PembayaranInsentif model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = $this->findModel($id);
                
        // get atlet dropdown value's descriptions
        $ref = RefJenisInsentif::findOne(['id' => $model->jenis_insentif]);
        $model->jenis_insentif = $ref['desc'];
        
        $ref = RefPingatInsentif::findOne(['id' => $model->pingat]);
        $model->pingat = $ref['desc'];
        
        $ref = PengurusanInsentifTetapanShakamShakar::findOne(['pengurusan_insentif_tetapan_shakam_shakar_id' => $model->kumpulan_temasya_kejohanan]);
        $model->kumpulan_temasya_kejohanan = $ref['kumpulan_temasya_kejohanan'];
        
        $YesNo = GeneralLabel::getYesNoLabel($model->rekod_baharu);
        $model->rekod_baharu = $YesNo;
        
        $YesNo = GeneralLabel::getYesNoLabel($model->kelulusan);
        $model->kelulusan = $YesNo;
        
        $queryPar = null;
        
        $queryPar['PembayaranInsentifAtletSearch']['pembayaran_insentif_id'] = $id;
        
        $searchModelPembayaranInsentifAtlet  = new PembayaranInsentifAtletSearch();
        $dataProviderPembayaranInsentifAtlet = $searchModelPembayaranInsentifAtlet->search($queryPar);
        
        return $this->render('view', [
            'model' => $model,
            'searchModelPembayaranInsentifAtlet' => $searchModelPembayaranInsentifAtlet,
            'dataProviderPembayaranInsentifAtlet' => $dataProviderPembayaranInsentifAtlet,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new PembayaranInsentif model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new PembayaranInsentif();
        
        $queryPar = null;
        
        Yii::$app->session->open();
        
        if(isset(Yii::$app->session->id)){
            $queryPar['PembayaranInsentifAtletSearch']['session_id'] = Yii::$app->session->id;
        }
        
        $searchModelPembayaranInsentifAtlet  = new PembayaranInsentifAtletSearch();
        $dataProviderPembayaranInsentifAtlet = $searchModelPembayaranInsentifAtlet->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if(isset(Yii::$app->session->id)){
                PembayaranInsentifAtlet::updateAll(['pembayaran_insentif_id' => $model->pembayaran_insentif_id], 'session_id = "'.Yii::$app->session->id.'"');
                PembayaranInsentifAtlet::updateAll(['session_id' => ''], 'pembayaran_insentif_id = "'.$model->pembayaran_insentif_id.'"');
            }
            
            return $this->redirect(['view', 'id' => $model->pembayaran_insentif_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'searchModelPembayaranInsentifAtlet' => $searchModelPembayaranInsentifAtlet,
                'dataProviderPembayaranInsentifAtlet' => $dataProviderPembayaranInsentifAtlet,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Updates an existing PembayaranInsentif model.
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
        
        $queryPar = null;
        
        $queryPar['PembayaranInsentifAtletSearch']['pembayaran_insentif_id'] = $id;
        
        $searchModelPembayaranInsentifAtlet  = new PembayaranInsentifAtletSearch();
        $dataProviderPembayaranInsentifAtlet = $searchModelPembayaranInsentifAtlet->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->pembayaran_insentif_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'searchModelPembayaranInsentifAtlet' => $searchModelPembayaranInsentifAtlet,
                'dataProviderPembayaranInsentifAtlet' => $dataProviderPembayaranInsentifAtlet,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Deletes an existing PembayaranInsentif model.
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

        return $this->redirect(['index']);
    }

    /**
     * Finds the PembayaranInsentif model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PembayaranInsentif the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PembayaranInsentif::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
