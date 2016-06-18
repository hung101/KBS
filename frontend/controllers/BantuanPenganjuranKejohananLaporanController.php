<?php

namespace frontend\controllers;

use Yii;
use app\models\BantuanPenganjuranKejohananLaporan;
use frontend\models\BantuanPenganjuranKejohananLaporanSearch;
use app\models\BantuanPenganjuranKejohananLaporanTuntutan;
use frontend\models\BantuanPenganjuranKejohananLaporanTuntutanSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * BantuanPenganjuranKejohananLaporanController implements the CRUD actions for BantuanPenganjuranKejohananLaporan model.
 */
class BantuanPenganjuranKejohananLaporanController extends Controller
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
     * Lists all BantuanPenganjuranKejohananLaporan models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BantuanPenganjuranKejohananLaporanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single BantuanPenganjuranKejohananLaporan model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $queryPar = null;
        
        $queryPar['BantuanPenganjuranKejohananLaporanTuntutanSearch']['bantuan_penganjuran_kejohanan_laporan_id'] = $id;
        
        $searchModelBantuanPenganjuranKejohananLaporanTuntutan  = new BantuanPenganjuranKejohananLaporanTuntutanSearch();
        $dataProviderBantuanPenganjuranKejohananLaporanTuntutan = $searchModelBantuanPenganjuranKejohananLaporanTuntutan->search($queryPar);
        
        return $this->render('view', [
            'model' => $this->findModel($id),
            'searchModelBantuanPenganjuranKejohananLaporanTuntutan' => $searchModelBantuanPenganjuranKejohananLaporanTuntutan,
            'dataProviderBantuanPenganjuranKejohananLaporanTuntutan' => $dataProviderBantuanPenganjuranKejohananLaporanTuntutan,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new BantuanPenganjuranKejohananLaporan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new BantuanPenganjuranKejohananLaporan();
        
        $queryPar = null;
        
        Yii::$app->session->open();
        
        if(isset(Yii::$app->session->id)){
            $queryPar['BantuanPenganjuranKejohananLaporanTuntutanSearch']['session_id'] = Yii::$app->session->id;
        }
        
        $searchModelBantuanPenganjuranKejohananLaporanTuntutan  = new BantuanPenganjuranKejohananLaporanTuntutanSearch();
        $dataProviderBantuanPenganjuranKejohananLaporanTuntutan = $searchModelBantuanPenganjuranKejohananLaporanTuntutan->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if(isset(Yii::$app->session->id)){
                BantuanPenganjuranKejohananLaporanTuntutan::updateAll(['bantuan_penganjuran_kejohanan_laporan_id' => $model->bantuan_penganjuran_kejohanan_laporan_id], 'session_id = "'.Yii::$app->session->id.'"');
                BantuanPenganjuranKejohananLaporanTuntutan::updateAll(['session_id' => ''], 'bantuan_penganjuran_kejohanan_laporan_id = "'.$model->bantuan_penganjuran_kejohanan_laporan_id.'"');
                
            }
            
            return $this->redirect(['view', 'id' => $model->bantuan_penganjuran_kejohanan_laporan_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'searchModelBantuanPenganjuranKejohananLaporanTuntutan' => $searchModelBantuanPenganjuranKejohananLaporanTuntutan,
                'dataProviderBantuanPenganjuranKejohananLaporanTuntutan' => $dataProviderBantuanPenganjuranKejohananLaporanTuntutan,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Updates an existing BantuanPenganjuranKejohananLaporan model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->bantuan_penganjuran_kejohanan_laporan_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'searchModelBantuanPenganjuranKejohananLaporanTuntutan' => $searchModelBantuanPenganjuranKejohananLaporanTuntutan,
                'dataProviderBantuanPenganjuranKejohananLaporanTuntutan' => $dataProviderBantuanPenganjuranKejohananLaporanTuntutan,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Deletes an existing BantuanPenganjuranKejohananLaporan model.
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
     * Finds the BantuanPenganjuranKejohananLaporan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return BantuanPenganjuranKejohananLaporan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = BantuanPenganjuranKejohananLaporan::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
