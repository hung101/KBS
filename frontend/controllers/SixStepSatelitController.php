<?php

namespace frontend\controllers;

use Yii;
use app\models\SixStepSatelit;
use frontend\models\SixStepSatelitSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use app\models\general\GeneralVariable;
use common\models\general\GeneralFunction;

// table reference
use app\models\RefAtletTahap;
use app\models\RefSukan;
use app\models\RefAcara;
use app\models\Atlet;
use app\models\RefSixstepSatelitStage;
use app\models\RefSixstepSatelitStatus;
use app\models\RefFasilitiSatelit;

/**
 * SixStepSatelitController implements the CRUD actions for SixStepSatelit model.
 */
class SixStepSatelitController extends Controller
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
     * Lists all SixStepSatelit models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $searchModel = new SixStepSatelitSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single SixStepSatelit model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = $this->findModel($id);
        
        $ref = RefAtletTahap::findOne(['id' => $model->kategori_atlet]);
        $model->kategori_atlet = $ref['desc'];
        
        $ref = RefSukan::findOne(['id' => $model->sukan]);
        $model->sukan = $ref['desc'];
        
        $ref = RefAcara::findOne(['id' => $model->acara]);
        $model->acara = $ref['desc'];
        
        $ref = Atlet::findOne(['atlet_id' => $model->atlet_id]);
        $model->atlet_id = $ref['nameAndIC'];
        
        $ref = RefSixstepSatelitStage::findOne(['id' => $model->stage]);
        $model->stage = $ref['desc'];
        
        $ref = RefSixstepSatelitStatus::findOne(['id' => $model->status]);
        $model->status = $ref['desc'];
        
        $ref = RefFasilitiSatelit::findOne(['id' => $model->pusat_satelit]);
        $model->pusat_satelit = $ref['desc'];
        
        $model->tarikh = GeneralFunction::convert($model->tarikh, GeneralFunction::TYPE_DATE);
        
        return $this->render('view', [
            'model' => $model,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new SixStepSatelit model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new SixStepSatelit();
        
        if(!Yii::$app->request->post()){
            $model->tarikh = GeneralFunction::getCurrentDate();
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->six_step_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Updates an existing SixStepSatelit model.
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
            return $this->redirect(['view', 'id' => $model->six_step_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Deletes an existing SixStepSatelit model.
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
     * Finds the SixStepSatelit model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return SixStepSatelit the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SixStepSatelit::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
