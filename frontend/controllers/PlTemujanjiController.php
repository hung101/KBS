<?php

namespace frontend\controllers;

use Yii;
use app\models\PlTemujanji;
use frontend\models\PlTemujanjiSearch;
use app\models\PlDiagnosisPreskripsiPemeriksaan;
use frontend\models\PlDiagnosisPreskripsiPemeriksaanSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use app\models\general\GeneralVariable;

// table reference
use app\models\Atlet;
use app\models\RefJenisTemujanjiPesakitLuar;
use app\models\RefStatusTemujanjiPesakitLuar;

/**
 * PlTemujanjiController implements the CRUD actions for PlTemujanji model.
 */
class PlTemujanjiController extends Controller
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
     * Lists all PlTemujanji models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $searchModel = new PlTemujanjiSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PlTemujanji model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = $this->findModel($id);
        
        $ref = Atlet::findOne(['atlet_id' => $model->atlet_id]);
        $model->atlet_id = $ref['nameAndIC'];
        
        $ref = RefJenisTemujanjiPesakitLuar::findOne(['id' => $model->makmal_perubatan]);
        $model->makmal_perubatan = $ref['desc'];
        
        $ref = RefStatusTemujanjiPesakitLuar::findOne(['id' => $model->status_temujanji]);
        $model->status_temujanji = $ref['desc'];
        
        $queryPar = null;
        
        $queryPar['PlDiagnosisPreskripsiPemeriksaanSearch']['pl_temujanji_id'] = $id;
        
        $searchModelPlDiagnosisPreskripsiPemeriksaan  = new PlDiagnosisPreskripsiPemeriksaanSearch();
        $dataProviderPlDiagnosisPreskripsiPemeriksaan = $searchModelPlDiagnosisPreskripsiPemeriksaan->search($queryPar);
        
        return $this->render('view', [
            'model' => $model,
            'searchModelPlDiagnosisPreskripsiPemeriksaan' => $searchModelPlDiagnosisPreskripsiPemeriksaan,
            'dataProviderPlDiagnosisPreskripsiPemeriksaan' => $dataProviderPlDiagnosisPreskripsiPemeriksaan,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new PlTemujanji model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new PlTemujanji();
        
        $queryPar = null;
        
        Yii::$app->session->open();
        
        if(isset(Yii::$app->session->id)){
            $queryPar['PlDiagnosisPreskripsiPemeriksaanSearch']['session_id'] = Yii::$app->session->id;
        }
        
        $searchModelPlDiagnosisPreskripsiPemeriksaan  = new PlDiagnosisPreskripsiPemeriksaanSearch();
        $dataProviderPlDiagnosisPreskripsiPemeriksaan = $searchModelPlDiagnosisPreskripsiPemeriksaan->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if(isset(Yii::$app->session->id)){
                PlDiagnosisPreskripsiPemeriksaan::updateAll(['pl_temujanji_id' => $model->pl_temujanji_id], 'session_id = "'.Yii::$app->session->id.'"');
                PlDiagnosisPreskripsiPemeriksaan::updateAll(['session_id' => ''], 'pl_temujanji_id = "'.$model->pl_temujanji_id.'"');
            }
            
            return $this->redirect(['view', 'id' => $model->pl_temujanji_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'searchModelPlDiagnosisPreskripsiPemeriksaan' => $searchModelPlDiagnosisPreskripsiPemeriksaan,
                'dataProviderPlDiagnosisPreskripsiPemeriksaan' => $dataProviderPlDiagnosisPreskripsiPemeriksaan,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Updates an existing PlTemujanji model.
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
        
        $queryPar['PlDiagnosisPreskripsiPemeriksaanSearch']['pl_temujanji_id'] = $id;
        
        $searchModelPlDiagnosisPreskripsiPemeriksaan  = new PlDiagnosisPreskripsiPemeriksaanSearch();
        $dataProviderPlDiagnosisPreskripsiPemeriksaan = $searchModelPlDiagnosisPreskripsiPemeriksaan->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->pl_temujanji_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'searchModelPlDiagnosisPreskripsiPemeriksaan' => $searchModelPlDiagnosisPreskripsiPemeriksaan,
                'dataProviderPlDiagnosisPreskripsiPemeriksaan' => $dataProviderPlDiagnosisPreskripsiPemeriksaan,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Deletes an existing PlTemujanji model.
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
     * Finds the PlTemujanji model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PlTemujanji the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PlTemujanji::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
