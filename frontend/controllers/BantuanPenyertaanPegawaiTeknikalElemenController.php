<?php

namespace frontend\controllers;

use Yii;
use app\models\BantuanPenyertaanPegawaiTeknikalElemen;
use frontend\models\BantuanPenyertaanPegawaiTeknikalElemenSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use app\models\RefElemenBantuanPenganjuranKejohanan;
use app\models\RefSubElemenBantuanPenganjuranKejohanan;

/**
 * BantuanPenyertaanPegawaiTeknikalElemenController implements the CRUD actions for BantuanPenyertaanPegawaiTeknikalElemen model.
 */
class BantuanPenyertaanPegawaiTeknikalElemenController extends Controller
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
     * Lists all BantuanPenyertaanPegawaiTeknikalElemen models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BantuanPenyertaanPegawaiTeknikalElemenSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single BantuanPenyertaanPegawaiTeknikalElemen model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        
        $model = $this->findModel($id);
        
        $ref = RefElemenBantuanPenganjuranKejohanan::findOne(['id' => $model->elemen_bantuan]);
        $model->elemen_bantuan = $ref['desc'];
        
        $ref = RefSubElemenBantuanPenganjuranKejohanan::findOne(['id' => $model->sub_elemen]);
        $model->sub_elemen = $ref['desc'];
        
        return $this->renderAjax('view', [
            'model' => $model,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new BantuanPenyertaanPegawaiTeknikalElemen model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($bantuan_penyertaan_pegawai_teknikal_id)
    {
        $model = new BantuanPenyertaanPegawaiTeknikalElemen();
        
        Yii::$app->session->open();
        
        if($bantuan_penyertaan_pegawai_teknikal_id != ''){
            $model->bantuan_penyertaan_pegawai_teknikal_id = $bantuan_penyertaan_pegawai_teknikal_id;
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
     * Updates an existing BantuanPenyertaanPegawaiTeknikalElemen model.
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
     * Deletes an existing BantuanPenyertaanPegawaiTeknikalElemen model.
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
     * Finds the BantuanPenyertaanPegawaiTeknikalElemen model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return BantuanPenyertaanPegawaiTeknikalElemen the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = BantuanPenyertaanPegawaiTeknikalElemen::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
