<?php

namespace frontend\controllers;

use Yii;
use app\models\MesyuaratSenaraiNamaHadir;
use app\models\MesyuaratSenaraiNamaHadirSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

// table reference
use app\models\RefMesyuaratAhliStatus;
use app\models\RefJawatan;

use app\models\general\GeneralLabel;

/**
 * MesyuaratSenaraiNamaHadirController implements the CRUD actions for MesyuaratSenaraiNamaHadir model.
 */
class MesyuaratSenaraiNamaHadirController extends Controller
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
     * Lists all MesyuaratSenaraiNamaHadir models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MesyuaratSenaraiNamaHadirSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single MesyuaratSenaraiNamaHadir model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        
        $ref = RefMesyuaratAhliStatus::findOne(['id' => $model->status]);
        $model->status = $ref['desc'];
        
        $ref = RefJawatan::findOne(['id' => $model->jawatan]);
        $model->jawatan = $ref['desc'];
        
        $YesNo = GeneralLabel::getYesNoLabel($model->kehadiran);
        $model->kehadiran = $YesNo;
        
        return $this->renderAjax('view', [
            'model' => $model,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new MesyuaratSenaraiNamaHadir model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($mesyuarat_id)
    {
        $model = new MesyuaratSenaraiNamaHadir();
        
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
     * Updates an existing MesyuaratSenaraiNamaHadir model.
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
     * Deletes an existing MesyuaratSenaraiNamaHadir model.
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
     * Finds the MesyuaratSenaraiNamaHadir model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MesyuaratSenaraiNamaHadir the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MesyuaratSenaraiNamaHadir::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
