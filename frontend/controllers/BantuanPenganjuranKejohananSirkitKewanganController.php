<?php

namespace frontend\controllers;

use Yii;
use app\models\BantuanPenganjuranKejohananSirkitKewangan;
use frontend\models\BantuanPenganjuranKejohananSirkitKewanganSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

// table reference
use app\models\RefSumberKewanganBantuanPenganjuranKejohanan;

/**
 * BantuanPenganjuranKejohananSirkitKewanganController implements the CRUD actions for BantuanPenganjuranKejohananSirkitKewangan model.
 */
class BantuanPenganjuranKejohananSirkitKewanganController extends Controller
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
     * Lists all BantuanPenganjuranKejohananSirkitKewangan models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BantuanPenganjuranKejohananSirkitKewanganSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single BantuanPenganjuranKejohananSirkitKewangan model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        
        $ref = RefSumberKewanganBantuanPenganjuranKejohanan::findOne(['id' => $model->sumber_kewangan]);
        $model->sumber_kewangan = $ref['desc'];
        
        return $this->renderAjax('view', [
            'model' => $model,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new BantuanPenganjuranKejohananSirkitKewangan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($bantuan_penganjuran_kejohanan_id)
    {
        $model = new BantuanPenganjuranKejohananSirkitKewangan();
        
        Yii::$app->session->open();
        
        if($bantuan_penganjuran_kejohanan_id != ''){
            $model->bantuan_penganjuran_kejohanan_id = $bantuan_penganjuran_kejohanan_id;
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
     * Updates an existing BantuanPenganjuranKejohananSirkitKewangan model.
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
     * Deletes an existing BantuanPenganjuranKejohananSirkitKewangan model.
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
     * Finds the BantuanPenganjuranKejohananSirkitKewangan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return BantuanPenganjuranKejohananSirkitKewangan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = BantuanPenganjuranKejohananSirkitKewangan::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
