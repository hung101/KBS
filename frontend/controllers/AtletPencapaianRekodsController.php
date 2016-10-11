<?php

namespace frontend\controllers;

use Yii;
use app\models\AtletPencapaianRekods;
use frontend\models\AtletPencapaianRekodsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use app\models\general\GeneralVariable;

// table reference
use app\models\RefJenisRekod;

/**
 * AtletPencapaianRekodsController implements the CRUD actions for AtletPencapaianRekods model.
 */
class AtletPencapaianRekodsController extends Controller
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
     * Lists all AtletPencapaianRekods models.
     * @return mixed
     */
    public function actionIndex($pencapaian_id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $queryPar = null;
        
        $queryPar = Yii::$app->request->queryParams;
        
        if($pencapaian_id != ''){
            $queryPar['AtletPencapaianRekodsSearch']['pencapaian_id'] = $pencapaian_id;
        } else {
            if(isset(Yii::$app->session->id)){
                $queryPar['AtletPencapaianRekodsSearch']['session_id'] = Yii::$app->session->id;
            }
        }
        
        $searchModel = new AtletPencapaianRekodsSearch();
        $dataProvider = $searchModel->search($queryPar);

        return $this->renderAjax('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    /**
     * Lists all AtletPendidikan models.
     * @return mixed
     */
    public function actionTab()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        /*$searchModel = new AtletPencapaianRekodsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('tab', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);*/
        
        $model = new AtletPencapaianRekods();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->pendidikan_atlet_id]);
        } else {
            return $this->render('tab', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays a single AtletPencapaianRekods model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = $this->findModel($id);
        
        $ref = RefJenisRekod::findOne(['id' => $model->jenis_rekod]);
        $model->jenis_rekod = $ref['desc'];
        
        return $this->renderAjax('view', [
            'model' => $model,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new AtletPencapaianRekods model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($pencapaian_id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new AtletPencapaianRekods();
        
        Yii::$app->session->open();
        
        if($pencapaian_id != ''){
            $model->pencapaian_id = $pencapaian_id;
        } else {
            if(isset(Yii::$app->session->id)){
                $model->session_id = Yii::$app->session->id;
            }
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //return $this->redirect(['view', 'id' => $model->pencapaian_rekods_id]);
            return "1/pipe?" . self::actionIndex($pencapaian_id);
        } else {
            return $this->renderAjax('create', [
                'model' => $model,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Updates an existing AtletPencapaianRekods model.
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
        
        $pencapaian_id = '';
        
        if(isset($model->pencapaian_id)){
            $pencapaian_id = $model->pencapaian_id;
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //return $this->redirect(['view', 'id' => $model->pencapaian_rekods_id]);
            return "1/pipe?" . self::actionIndex($pencapaian_id);
        } else {
            return $this->renderAjax('update', [
                'model' => $model,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Deletes an existing AtletPencapaianRekods model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = $this->findModel($id);
        
        $pencapaian_id = '';
        
        if(isset($model->pencapaian_id)){
            $pencapaian_id = $model->pencapaian_id;
        }
        
        $this->findModel($id)->delete();
        
        return "1/pipe?" . self::actionIndex($pencapaian_id);

        //return $this->redirect(['index']);
    }

    /**
     * Finds the AtletPencapaianRekods model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AtletPencapaianRekods the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AtletPencapaianRekods::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
