<?php

namespace frontend\controllers;

use Yii;
use app\models\BantuanPenyertaanPegawaiTeknikalDicadangkan;
use frontend\models\BantuanPenyertaanPegawaiTeknikalDicadangkanSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use app\models\general\GeneralVariable;

/**
 * BantuanPenyertaanPegawaiTeknikalDicadangkanController implements the CRUD actions for BantuanPenyertaanPegawaiTeknikalDicadangkan model.
 */
class BantuanPenyertaanPegawaiTeknikalDicadangkanController extends Controller
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
     * Lists all BantuanPenyertaanPegawaiTeknikalDicadangkan models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BantuanPenyertaanPegawaiTeknikalDicadangkanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single BantuanPenyertaanPegawaiTeknikalDicadangkan model.
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
     * Creates a new BantuanPenyertaanPegawaiTeknikalDicadangkan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($bantuan_penyertaan_pegawai_teknikal_id)
    {
        $model = new BantuanPenyertaanPegawaiTeknikalDicadangkan();
        
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
     * Updates an existing BantuanPenyertaanPegawaiTeknikalDicadangkan model.
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
     * Deletes an existing BantuanPenyertaanPegawaiTeknikalDicadangkan model.
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
     * Finds the BantuanPenyertaanPegawaiTeknikalDicadangkan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return BantuanPenyertaanPegawaiTeknikalDicadangkan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = BantuanPenyertaanPegawaiTeknikalDicadangkan::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
