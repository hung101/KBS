<?php

namespace frontend\controllers;

use Yii;
use app\models\BantuanPenganjuranKursusPegawaiTeknikalOlehMsn;
use frontend\models\BantuanPenganjuranKursusPegawaiTeknikalOlehMsnSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use app\models\general\GeneralVariable;
use common\models\general\GeneralFunction;

/**
 * BantuanPenganjuranKursusPegawaiTeknikalOlehMsnController implements the CRUD actions for BantuanPenganjuranKursusPegawaiTeknikalOlehMsn model.
 */
class BantuanPenganjuranKursusPegawaiTeknikalOlehMsnController extends Controller
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
     * Lists all BantuanPenganjuranKursusPegawaiTeknikalOlehMsn models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BantuanPenganjuranKursusPegawaiTeknikalOlehMsnSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single BantuanPenganjuranKursusPegawaiTeknikalOlehMsn model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        
        if($model->tarikh_mula != "") {$model->tarikh_mula = GeneralFunction::convert($model->tarikh_mula, GeneralFunction::TYPE_DATE);}
        if($model->tarikh_tamat != "") {$model->tarikh_tamat = GeneralFunction::convert($model->tarikh_tamat, GeneralFunction::TYPE_DATE);}
        
        return $this->renderAjax('view', [
            'model' => $model,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new BantuanPenganjuranKursusPegawaiTeknikalOlehMsn model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($bantuan_penganjuran_kursus_pegawai_teknikal_id)
    {
        $model = new BantuanPenganjuranKursusPegawaiTeknikalOlehMsn();
        
        Yii::$app->session->open();
        
        if($bantuan_penganjuran_kursus_pegawai_teknikal_id != ''){
            $model->bantuan_penganjuran_kursus_pegawai_teknikal_id = $bantuan_penganjuran_kursus_pegawai_teknikal_id;
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
     * Updates an existing BantuanPenganjuranKursusPegawaiTeknikalOlehMsn model.
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
     * Deletes an existing BantuanPenganjuranKursusPegawaiTeknikalOlehMsn model.
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
     * Finds the BantuanPenganjuranKursusPegawaiTeknikalOlehMsn model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return BantuanPenganjuranKursusPegawaiTeknikalOlehMsn the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = BantuanPenganjuranKursusPegawaiTeknikalOlehMsn::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
