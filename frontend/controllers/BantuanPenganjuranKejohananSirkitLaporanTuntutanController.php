<?php

namespace frontend\controllers;

use Yii;
use app\models\BantuanPenganjuranKejohananSirkitLaporanTuntutan;
use frontend\models\BantuanPenganjuranKejohananSirkitLaporanTuntutanSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * BantuanPenganjuranKejohananSirkitLaporanTuntutanController implements the CRUD actions for BantuanPenganjuranKejohananSirkitLaporanTuntutan model.
 */
class BantuanPenganjuranKejohananSirkitLaporanTuntutanController extends Controller
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
     * Lists all BantuanPenganjuranKejohananSirkitLaporanTuntutan models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BantuanPenganjuranKejohananSirkitLaporanTuntutanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single BantuanPenganjuranKejohananSirkitLaporanTuntutan model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->renderAjax('view', [
            'model' => $this->findModel($id),
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new BantuanPenganjuranKejohananSirkitLaporanTuntutan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($bantuan_penganjuran_kejohanan_laporan_id)
    {
        $model = new BantuanPenganjuranKejohananSirkitLaporanTuntutan();
        
        if($bantuan_penganjuran_kejohanan_laporan_id != ''){
            $model->bantuan_penganjuran_kejohanan_laporan_id = $bantuan_penganjuran_kejohanan_laporan_id;
        } else {
            if(isset(Yii::$app->session->id)){
                $model->session_id = Yii::$app->session->id;
            }
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
     * Updates an existing BantuanPenganjuranKejohananSirkitLaporanTuntutan model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
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
     * Deletes an existing BantuanPenganjuranKejohananSirkitLaporanTuntutan model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        //return $this->redirect(['index']);
    }

    /**
     * Finds the BantuanPenganjuranKejohananSirkitLaporanTuntutan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return BantuanPenganjuranKejohananSirkitLaporanTuntutan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = BantuanPenganjuranKejohananSirkitLaporanTuntutan::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
