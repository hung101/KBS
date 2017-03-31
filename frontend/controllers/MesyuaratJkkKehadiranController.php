<?php

namespace frontend\controllers;

use Yii;
use app\models\MesyuaratJkkKehadiran;
use app\models\MesyuaratJkkKehadiranSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use app\models\RefAgensiJkk;
use app\models\RefJawatanJkkJkp;
use app\models\PengurusanJkkJkp;


/**
 * MesyuaratJkkKehadiranController implements the CRUD actions for MesyuaratJkkKehadiran model.
 */
class MesyuaratJkkKehadiranController extends Controller
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
     * Lists all MesyuaratJkkKehadiran models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MesyuaratJkkKehadiranSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single MesyuaratJkkKehadiran model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
		
		$ref = PengurusanJkkJkp::findOne(['pengurusan_jkk_jkp_id' => $model->nama]);
		$model->nama = $ref['nama_pegawai_coach'];
        
        $ref = RefAgensiJkk::findOne(['id' => $model->agensi]);
        $model->agensi = $ref['desc'];
		
		$ref = RefJawatanJkkJkp::findOne(['id' => $model->jawatan]);
		$model->jawatan = $ref['desc'];
        
        return $this->renderAjax('view', [
            'model' => $model,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new MesyuaratJkkKehadiran model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($mesyuarat_id)
    {
        $model = new MesyuaratJkkKehadiran();
        
        Yii::$app->session->open();
        
        if($mesyuarat_id != ''){
            $model->mesyuarat_id = $mesyuarat_id;
        } else {
            if(isset(Yii::$app->session->id)){
                $model->session_id = Yii::$app->session->id;
            }
        }

        if ($model->load(Yii::$app->request->post())) {
            //return $this->redirect(['view', 'id' => $model->senarai_nama_hadir_id]);
            return $model->save();
        } else {
            return $this->renderAjax('create', [
                'model' => $model,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Updates an existing MesyuaratJkkKehadiran model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            //return $this->redirect(['view', 'id' => $model->senarai_nama_hadir_id]);
            return $model->save();
        } else {
            return $this->renderAjax('update', [
                'model' => $model,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Deletes an existing MesyuaratJkkKehadiran model.
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
     * Finds the MesyuaratJkkKehadiran model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MesyuaratJkkKehadiran the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MesyuaratJkkKehadiran::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
