<?php

namespace frontend\controllers;

use Yii;
use app\models\PembayaranElaun;
use app\models\PembayaranElaunSearch;
use app\models\PembayaranElaunTransaksi;
use frontend\models\PembayaranElaunTransaksiSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

// table reference
use app\models\Atlet;
use app\models\RefKategoriElaun;
use app\models\RefStatusElaun;
use app\models\RefSukan;

// contant values
use app\models\general\GeneralLabel;

/**
 * PembayaranElaunController implements the CRUD actions for PembayaranElaun model.
 */
class PembayaranElaunController extends Controller
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
     * Lists all PembayaranElaun models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PembayaranElaunSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PembayaranElaun model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        
        $ref = Atlet::findOne(['atlet_id' => $model->atlet_id]);
        $model->atlet_id = $ref['nameAndIC'];
        
        $ref = RefKategoriElaun::findOne(['id' => $model->kategori_elaun]);
        $model->kategori_elaun = $ref['desc'];
        
        $ref = RefStatusElaun::findOne(['id' => $model->status_elaun]);
        $model->status_elaun = $ref['desc'];
        
        $ref = RefSukan::findOne(['id' => $model->sukan]);
        $model->sukan = $ref['desc'];
        
        $YesNo = GeneralLabel::getYesNoLabel($model->kelulusan);
        $model->kelulusan = $YesNo;
        
        $queryPar = null;
        $queryPar['PembayaranElaunTransaksiSearch']['pembayaran_elaun_id'] = $id;

        $searchModelPembayaranElaunTransaksi = new PembayaranElaunTransaksiSearch();
        $dataProviderPembayaranElaunTransaksi = $searchModelPembayaranElaunTransaksi->search($queryPar, $id);
        
        return $this->render('view', [
            'model' => $model,
            'searchModelPembayaranElaunTransaksi' => $searchModelPembayaranElaunTransaksi,
            'dataProviderPembayaranElaunTransaksi' => $dataProviderPembayaranElaunTransaksi,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new PembayaranElaun model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new PembayaranElaun();
        
        $queryPar = null;
        
        Yii::$app->session->open();
        
        if(isset(Yii::$app->session->id)){
            $queryPar['PembayaranElaunTransaksiSearch']['session_id'] = Yii::$app->session->id;
        }
        
        $searchModelPembayaranElaunTransaksi = new PembayaranElaunTransaksiSearch();
        $dataProviderPembayaranElaunTransaksi = $searchModelPembayaranElaunTransaksi->search($queryPar, null);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            PembayaranElaunTransaksi::updateAll(['pembayaran_elaun_id' => $model->pembayaran_elaun_id], 'session_id = "'.Yii::$app->session->id.'"');
            PembayaranElaunTransaksi::updateAll(['session_id' => ''], 'pembayaran_elaun_id = "'.$model->pembayaran_elaun_id.'"');
            
            return $this->redirect(['view', 'id' => $model->pembayaran_elaun_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'searchModelPembayaranElaunTransaksi' => $searchModelPembayaranElaunTransaksi,
                'dataProviderPembayaranElaunTransaksi' => $dataProviderPembayaranElaunTransaksi,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Updates an existing PembayaranElaun model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        
        $queryPar = null;
        
        $queryPar['PembayaranElaunTransaksiSearch']['pembayaran_elaun_id'] = $id;
        
        $searchModelPembayaranElaunTransaksi = new PembayaranElaunTransaksiSearch();
        $dataProviderPembayaranElaunTransaksi = $searchModelPembayaranElaunTransaksi->search($queryPar, $id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->pembayaran_elaun_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'searchModelPembayaranElaunTransaksi' => $searchModelPembayaranElaunTransaksi,
                'dataProviderPembayaranElaunTransaksi' => $dataProviderPembayaranElaunTransaksi,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Deletes an existing PembayaranElaun model.
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
     * Finds the PembayaranElaun model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PembayaranElaun the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PembayaranElaun::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
