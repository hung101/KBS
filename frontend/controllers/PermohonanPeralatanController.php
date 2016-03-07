<?php

namespace frontend\controllers;

use Yii;
use app\models\PermohonanPeralatan;
use frontend\models\PermohonanPeralatanSearch;
use app\models\Peralatan;
use frontend\models\PeralatanSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

// table reference
use app\models\RefCawangan;
use app\models\RefNegeri;
use app\models\RefSukan;
use app\models\RefProgram;

// contant values
use app\models\general\GeneralLabel;

/**
 * PermohonanPeralatanController implements the CRUD actions for PermohonanPeralatan model.
 */
class PermohonanPeralatanController extends Controller
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
     * Lists all PermohonanPeralatan models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PermohonanPeralatanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PermohonanPeralatan model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $queryPar = null;
        $queryPar['PeralatanSearch']['permohonan_peralatan_id'] = $id;
        
        $searchModel = new PeralatanSearch();
        $dataProvider = $searchModel->search($queryPar);
        
        $model = $this->findModel($id);
        
        $ref = RefCawangan::findOne(['id' => $model->cawangan]);
        $model->cawangan = $ref['desc'];
        
        $ref = RefNegeri::findOne(['id' => $model->negeri]);
        $model->negeri = $ref['desc'];
        
        $ref = RefProgram::findOne(['id' => $model->program]);
        $model->program = $ref['desc'];
        
        $ref = RefSukan::findOne(['id' => $model->sukan]);
        $model->sukan = $ref['desc'];
        
        $YesNo = GeneralLabel::getYesNoLabel($model->kelulusan);
        $model->kelulusan = $YesNo;
        
        return $this->render('view', [
            'model' => $model,
            'readonly' => true,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new PermohonanPeralatan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new PermohonanPeralatan();
        
        $queryPar = null;
        
        Yii::$app->session->open();
        
        if(isset(Yii::$app->session->id)){
            $queryPar['PeralatanSearch']['session_id'] = Yii::$app->session->id;
        }
        
        $searchModel = new PeralatanSearch();
        $dataProvider = $searchModel->search($queryPar);
        
        $model->jumlah_peralatan = $dataProvider->getTotalCount();
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->open();
        
            if(isset(Yii::$app->session->id)){
                Peralatan::updateAll(['permohonan_peralatan_id' => $model->permohonan_peralatan_id], 'session_id = "'.Yii::$app->session->id.'"');
                Peralatan::updateAll(['session_id' => ''], 'permohonan_peralatan_id = "'.$model->permohonan_peralatan_id.'"');
            }
            
            return $this->redirect(['view', 'id' => $model->permohonan_peralatan_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'readonly' => false,
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }
    }

    /**
     * Updates an existing PermohonanPeralatan model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $queryPar = null;
        $queryPar['PeralatanSearch']['permohonan_peralatan_id'] = $id;
        
        $searchModel = new PeralatanSearch();
        $dataProvider = $searchModel->search($queryPar);
        
        $model = $this->findModel($id);
        
        $model->jumlah_peralatan = $dataProvider->getTotalCount();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->permohonan_peralatan_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'readonly' => false,
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }
    }

    /**
     * Deletes an existing PermohonanPeralatan model.
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
     * Finds the PermohonanPeralatan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PermohonanPeralatan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PermohonanPeralatan::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
