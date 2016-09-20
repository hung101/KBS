<?php

namespace frontend\controllers;

use Yii;
use app\models\PengurusanInsentifTetapan;
use frontend\models\PengurusanInsentifTetapanSearch;
use app\models\PengurusanInsentifTetapanShakamShakar;
use frontend\models\PengurusanInsentifTetapanShakamShakarSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use app\models\general\GeneralVariable;
use common\models\general\GeneralFunction;

/**
 * PengurusanInsentifTetapanController implements the CRUD actions for PengurusanInsentifTetapan model.
 */
class PengurusanInsentifTetapanController extends Controller
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
     * Lists all PengurusanInsentifTetapan models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $searchModel = new PengurusanInsentifTetapanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PengurusanInsentifTetapan model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $queryPar = Yii::$app->request->queryParams;
        
        $queryPar['PengurusanInsentifTetapanShakamShakarSearch']['pengurusan_insentif_tetapan_id'] = $id;
        
        $searchModelPengurusanInsentifTetapanShakamShakar  = new PengurusanInsentifTetapanShakamShakarSearch();
        $dataProviderPengurusanInsentifTetapanShakamShakar = $searchModelPengurusanInsentifTetapanShakamShakar->search($queryPar);
        
        return $this->render('view', [
            'model' => $this->findModel($id),
            'searchModelPengurusanInsentifTetapanShakamShakar' => $searchModelPengurusanInsentifTetapanShakamShakar,
            'dataProviderPengurusanInsentifTetapanShakamShakar' => $dataProviderPengurusanInsentifTetapanShakamShakar,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new PengurusanInsentifTetapan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new PengurusanInsentifTetapan();
        
        $queryPar = Yii::$app->request->queryParams;
        
        Yii::$app->session->open();
        
        if(isset(Yii::$app->session->id)){
            $queryPar['PengurusanInsentifTetapanShakamShakarSearch']['session_id'] = Yii::$app->session->id;
        }
        
        $searchModelPengurusanInsentifTetapanShakamShakar  = new PengurusanInsentifTetapanShakamShakarSearch();
        $dataProviderPengurusanInsentifTetapanShakamShakar = $searchModelPengurusanInsentifTetapanShakamShakar->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if(isset(Yii::$app->session->id)){
                PengurusanInsentifTetapanShakamShakar::updateAll(['pengurusan_insentif_tetapan_id' => $model->pengurusan_insentif_tetapan_id], 'session_id = "'.Yii::$app->session->id.'"');
                PengurusanInsentifTetapanShakamShakar::updateAll(['session_id' => ''], 'pengurusan_insentif_tetapan_id = "'.$model->pengurusan_insentif_tetapan_id.'"');
            }
            
            return $this->redirect(['view', 'id' => $model->pengurusan_insentif_tetapan_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'searchModelPengurusanInsentifTetapanShakamShakar' => $searchModelPengurusanInsentifTetapanShakamShakar,
                'dataProviderPengurusanInsentifTetapanShakamShakar' => $dataProviderPengurusanInsentifTetapanShakamShakar,
                'readonly' => false,
            ]);
        }
    }
    
    /**
     * Creates a new PengurusanInsentifTetapan model.
     * If id is exist or not, the browser will be redirected to the 'create/update' page.
     * @return mixed
     */
    public function actionLoad()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        if (($model = PengurusanInsentifTetapan::findOne(1)) !== null) {
            return self::actionUpdate($model->pengurusan_insentif_tetapan_id);
        } else {
            return self::actionCreate();
        }
    }

    /**
     * Updates an existing PengurusanInsentifTetapan model.
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
        
        $queryPar = Yii::$app->request->queryParams;
        
        $queryPar['PengurusanInsentifTetapanShakamShakarSearch']['pengurusan_insentif_tetapan_id'] = $id;
        
        $searchModelPengurusanInsentifTetapanShakamShakar  = new PengurusanInsentifTetapanShakamShakarSearch();
        $dataProviderPengurusanInsentifTetapanShakamShakar = $searchModelPengurusanInsentifTetapanShakamShakar->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->pengurusan_insentif_tetapan_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'searchModelPengurusanInsentifTetapanShakamShakar' => $searchModelPengurusanInsentifTetapanShakamShakar,
                'dataProviderPengurusanInsentifTetapanShakamShakar' => $dataProviderPengurusanInsentifTetapanShakamShakar,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Deletes an existing PengurusanInsentifTetapan model.
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
     * Finds the PengurusanInsentifTetapan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PengurusanInsentifTetapan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PengurusanInsentifTetapan::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
