<?php

namespace frontend\controllers;

use Yii;
use app\models\PengurusanPenginapan;
use frontend\models\PengurusanPenginapanSearch;
use app\models\PengurusanPenginapanAtlet;
use frontend\models\PengurusanPenginapanAtletSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

// contant values
use app\models\general\GeneralVariable;

// table reference
use app\models\Atlet;
use app\models\RefPegawaiPengurusanPenginapan;

/**
 * PengurusanPenginapanController implements the CRUD actions for PengurusanPenginapan model.
 */
class PengurusanPenginapanController extends Controller
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
     * Lists all PengurusanPenginapan models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $searchModel = new PengurusanPenginapanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PengurusanPenginapan model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = $this->findModel($id);
        
        $ref = RefPegawaiPengurusanPenginapan::findOne(['id' => $model->nama_pegawai]);
        $model->nama_pegawai = $ref['desc'];
        
        $ref = Atlet::findOne(['atlet_id' => $model->atlet_id]);
        $model->atlet_id = $ref['nameAndIC'];
        
        $queryPar = null;
        
        $queryPar['PengurusanPenginapanAtletSearch']['pengurusan_penginapan_id'] = $id;
        
        $searchModelPengurusanPenginapanAtlet  = new PengurusanPenginapanAtletSearch();
        $dataProviderPengurusanPenginapanAtlet = $searchModelPengurusanPenginapanAtlet->search($queryPar);
        
        return $this->render('view', [
            'model' => $model,
            'searchModelPengurusanPenginapanAtlet' => $searchModelPengurusanPenginapanAtlet,
            'dataProviderPengurusanPenginapanAtlet' => $dataProviderPengurusanPenginapanAtlet,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new PengurusanPenginapan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new PengurusanPenginapan();
        
        $queryPar = null;
        
        Yii::$app->session->open();
        
        if(isset(Yii::$app->session->id)){
            $queryPar['PengurusanPenginapanAtletSearch']['session_id'] = Yii::$app->session->id;
        }
        
        $searchModelPengurusanPenginapanAtlet  = new PengurusanPenginapanAtletSearch();
        $dataProviderPengurusanPenginapanAtlet = $searchModelPengurusanPenginapanAtlet->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if(isset(Yii::$app->session->id)){
                PengurusanPenginapanAtlet::updateAll(['pengurusan_penginapan_id' => $model->pengurusan_penginapan_id], 'session_id = "'.Yii::$app->session->id.'"');
                PengurusanPenginapanAtlet::updateAll(['session_id' => ''], 'pengurusan_penginapan_id = "'.$model->pengurusan_penginapan_id.'"');
            }
            
            return $this->redirect(['view', 'id' => $model->pengurusan_penginapan_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'searchModelPengurusanPenginapanAtlet' => $searchModelPengurusanPenginapanAtlet,
                'dataProviderPengurusanPenginapanAtlet' => $dataProviderPengurusanPenginapanAtlet,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Updates an existing PengurusanPenginapan model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = $this->findModel($id);
        
        $queryPar = null;
        
        $queryPar['PengurusanPenginapanAtletSearch']['pengurusan_penginapan_id'] = $id;
        
        $searchModelPengurusanPenginapanAtlet  = new PengurusanPenginapanAtletSearch();
        $dataProviderPengurusanPenginapanAtlet = $searchModelPengurusanPenginapanAtlet->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->pengurusan_penginapan_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'searchModelPengurusanPenginapanAtlet' => $searchModelPengurusanPenginapanAtlet,
                'dataProviderPengurusanPenginapanAtlet' => $dataProviderPengurusanPenginapanAtlet,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Deletes an existing PengurusanPenginapan model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the PengurusanPenginapan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PengurusanPenginapan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PengurusanPenginapan::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
