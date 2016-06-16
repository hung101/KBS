<?php

namespace frontend\controllers;

use Yii;
use app\models\BantuanPenganjuranKursusPegawaiTeknikalLaporan;
use frontend\models\BantuanPenganjuranKursusPegawaiTeknikalLaporanSearch;
use app\models\BantuanPenganjuranKursusPegawaiTeknikalLaporanTuntutan;
use frontend\models\BantuanPenganjuranKursusPegawaiTeknikalLaporanTuntutanSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * BantuanPenganjuranKursusPegawaiTeknikalLaporanController implements the CRUD actions for BantuanPenganjuranKursusPegawaiTeknikalLaporan model.
 */
class BantuanPenganjuranKursusPegawaiTeknikalLaporanController extends Controller
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
     * Lists all BantuanPenganjuranKursusPegawaiTeknikalLaporan models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BantuanPenganjuranKursusPegawaiTeknikalLaporanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single BantuanPenganjuranKursusPegawaiTeknikalLaporan model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        
        $queryPar = null;
        
        $queryPar['BantuanPenganjuranKursusPegawaiTeknikalLaporanTuntutanSearch']['bantuan_penganjuran_kursus_pegawai_teknikal_laporan_id'] = $id;
        
        $searchModelBantuanPenganjuranKursusPegawaiTeknikalLaporanTuntutan  = new BantuanPenganjuranKursusPegawaiTeknikalLaporanTuntutanSearch();
        $dataProviderBantuanPenganjuranKursusPegawaiTeknikalLaporanTuntutan = $searchModelBantuanPenganjuranKursusPegawaiTeknikalLaporanTuntutan->search($queryPar);
        
        return $this->render('view', [
            'model' => $this->findModel($id),
            'searchModelBantuanPenganjuranKursusPegawaiTeknikalLaporanTuntutan' => $searchModelBantuanPenganjuranKursusPegawaiTeknikalLaporanTuntutan,
            'dataProviderBantuanPenganjuranKursusPegawaiTeknikalLaporanTuntutan' => $dataProviderBantuanPenganjuranKursusPegawaiTeknikalLaporanTuntutan,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new BantuanPenganjuranKursusPegawaiTeknikalLaporan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new BantuanPenganjuranKursusPegawaiTeknikalLaporan();
        
        $queryPar = null;
        
        Yii::$app->session->open();
        
        if(isset(Yii::$app->session->id)){
            $queryPar['BantuanPenganjuranKursusPegawaiTeknikalLaporanTuntutanSearch']['session_id'] = Yii::$app->session->id;
        }
        
        $searchModelBantuanPenganjuranKursusPegawaiTeknikalLaporanTuntutan  = new BantuanPenganjuranKursusPegawaiTeknikalLaporanTuntutanSearch();
        $dataProviderBantuanPenganjuranKursusPegawaiTeknikalLaporanTuntutan = $searchModelBantuanPenganjuranKursusPegawaiTeknikalLaporanTuntutan->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            
            if(isset(Yii::$app->session->id)){
                BantuanPenganjuranKursusPegawaiTeknikalLaporanTuntutan::updateAll(['bantuan_penganjuran_kursus_pegawai_teknikal_laporan_id' => $model->bantuan_penganjuran_kursus_pegawai_teknikal_laporan_id], 'session_id = "'.Yii::$app->session->id.'"');
                BantuanPenganjuranKursusPegawaiTeknikalLaporanTuntutan::updateAll(['session_id' => ''], 'bantuan_penganjuran_kursus_pegawai_teknikal_laporan_id = "'.$model->bantuan_penganjuran_kursus_pegawai_teknikal_laporan_id.'"');
                
            }
            
            return $this->redirect(['view', 'id' => $model->bantuan_penganjuran_kursus_pegawai_teknikal_laporan_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'searchModelBantuanPenganjuranKursusPegawaiTeknikalLaporanTuntutan' => $searchModelBantuanPenganjuranKursusPegawaiTeknikalLaporanTuntutan,
                'dataProviderBantuanPenganjuranKursusPegawaiTeknikalLaporanTuntutan' => $dataProviderBantuanPenganjuranKursusPegawaiTeknikalLaporanTuntutan,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Updates an existing BantuanPenganjuranKursusPegawaiTeknikalLaporan model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        
        $queryPar = null;
        
        $queryPar['BantuanPenganjuranKursusPegawaiTeknikalLaporanTuntutanSearch']['bantuan_penganjuran_kursus_pegawai_teknikal_laporan_id'] = $id;
        
        $searchModelBantuanPenganjuranKursusPegawaiTeknikalLaporanTuntutan  = new BantuanPenganjuranKursusPegawaiTeknikalLaporanTuntutanSearch();
        $dataProviderBantuanPenganjuranKursusPegawaiTeknikalLaporanTuntutan = $searchModelBantuanPenganjuranKursusPegawaiTeknikalLaporanTuntutan->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->bantuan_penganjuran_kursus_pegawai_teknikal_laporan_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'searchModelBantuanPenganjuranKursusPegawaiTeknikalLaporanTuntutan' => $searchModelBantuanPenganjuranKursusPegawaiTeknikalLaporanTuntutan,
                'dataProviderBantuanPenganjuranKursusPegawaiTeknikalLaporanTuntutan' => $dataProviderBantuanPenganjuranKursusPegawaiTeknikalLaporanTuntutan,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Deletes an existing BantuanPenganjuranKursusPegawaiTeknikalLaporan model.
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
     * Finds the BantuanPenganjuranKursusPegawaiTeknikalLaporan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return BantuanPenganjuranKursusPegawaiTeknikalLaporan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = BantuanPenganjuranKursusPegawaiTeknikalLaporan::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
