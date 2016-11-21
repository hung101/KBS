<?php

namespace frontend\controllers;

use Yii;
use app\models\KhidmatPerubatanDanSainsSukanAtlet;
use frontend\models\KhidmatPerubatanDanSainsSukanAtletSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use app\models\general\GeneralVariable;

// table reference
use app\models\RefSukan;
use app\models\RefProgramSemasaSukanAtlet;
use app\models\Atlet;

/**
 * KhidmatPerubatanDanSainsSukanAtletController implements the CRUD actions for KhidmatPerubatanDanSainsSukanAtlet model.
 */
class KhidmatPerubatanDanSainsSukanAtletController extends Controller
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
     * Lists all KhidmatPerubatanDanSainsSukanAtlet models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $searchModel = new KhidmatPerubatanDanSainsSukanAtletSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single KhidmatPerubatanDanSainsSukanAtlet model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = $this->findModel($id);
        
        $ref = RefSukan::findOne(['id' => $model->sukan]);
        $model->sukan = $ref['desc'];
        
        $ref = RefProgramSemasaSukanAtlet::findOne(['id' => $model->program]);
        $model->program = $ref['desc'];
        
        $ref = Atlet::findOne(['atlet_id' => $model->atlet]);
        $model->atlet = $ref['nameAndIc'];
        
        return $this->renderAjax('view', [
            'model' => $model,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new KhidmatPerubatanDanSainsSukanAtlet model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($khidmat_perubatan_dan_sains_sukan_id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new KhidmatPerubatanDanSainsSukanAtlet();
        
        Yii::$app->session->open();
        
        if($khidmat_perubatan_dan_sains_sukan_id != ''){
            $model->khidmat_perubatan_dan_sains_sukan_id = $khidmat_perubatan_dan_sains_sukan_id;
        } else {
            if(isset(Yii::$app->session->id)){
                $model->session_id = Yii::$app->session->id;
            }
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //return $this->redirect(['view', 'id' => $model->khidmat_perubatan_dan_sains_sukan_atlet_id]);
            return  '1';
        } else {
            return $this->renderAjax('create', [
                'model' => $model,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Updates an existing KhidmatPerubatanDanSainsSukanAtlet model.
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

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //return $this->redirect(['view', 'id' => $model->khidmat_perubatan_dan_sains_sukan_atlet_id]);
            return  '1';
        } else {
            return $this->renderAjax('update', [
                'model' => $model,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Deletes an existing KhidmatPerubatanDanSainsSukanAtlet model.
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

        //return $this->redirect(['index']);
    }

    /**
     * Finds the KhidmatPerubatanDanSainsSukanAtlet model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return KhidmatPerubatanDanSainsSukanAtlet the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = KhidmatPerubatanDanSainsSukanAtlet::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
