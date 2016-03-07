<?php

namespace frontend\controllers;

use Yii;
use app\models\FarmasiPermohonanUbatan;
use frontend\models\FarmasiPermohonanUbatanSearch;
use app\models\FarmasiUbatan;
use frontend\models\FarmasiUbatanSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use app\models\general\GeneralVariable;
use app\models\general\GeneralLabel;

// table reference
use app\models\Atlet;

/**
 * FarmasiPermohonanUbatanController implements the CRUD actions for FarmasiPermohonanUbatan model.
 */
class FarmasiPermohonanUbatanController extends Controller
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
     * Lists all FarmasiPermohonanUbatan models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $searchModel = new FarmasiPermohonanUbatanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single FarmasiPermohonanUbatan model.
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
        
        $YesNo = GeneralLabel::getYesNoLabel($model->kelulusan);
        $model->kelulusan = $YesNo;
        
        $queryPar = null;
        
        $queryPar['FarmasiUbatanSearch']['farmasi_permohonan_ubatan_id'] = $id;
        
        $searchModelFarmasiUbatan  = new FarmasiUbatanSearch();
        $dataProviderFarmasiUbatan= $searchModelFarmasiUbatan->search($queryPar);
        
        return $this->render('view', [
            'model' => $model,
            'searchModelFarmasiUbatan' => $searchModelFarmasiUbatan,
            'dataProviderFarmasiUbatan' => $dataProviderFarmasiUbatan,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new FarmasiPermohonanUbatan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new FarmasiPermohonanUbatan();
        
        $queryPar = null;
        
        Yii::$app->session->open();
        
        if(isset(Yii::$app->session->id)){
            $queryPar['FarmasiUbatanSearch']['session_id'] = Yii::$app->session->id;
        }
        
        $searchModelFarmasiUbatan  = new FarmasiUbatanSearch();
        $dataProviderFarmasiUbatan= $searchModelFarmasiUbatan->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if(isset(Yii::$app->session->id)){
                FarmasiUbatan::updateAll(['farmasi_permohonan_ubatan_id' => $model->farmasi_permohonan_ubatan_id], 'session_id = "'.Yii::$app->session->id.'"');
                FarmasiUbatan::updateAll(['session_id' => ''], 'farmasi_permohonan_ubatan_id = "'.$model->farmasi_permohonan_ubatan_id.'"');
            }
            
            return $this->redirect(['view', 'id' => $model->farmasi_permohonan_ubatan_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'searchModelFarmasiUbatan' => $searchModelFarmasiUbatan,
                'dataProviderFarmasiUbatan' => $dataProviderFarmasiUbatan,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Updates an existing FarmasiPermohonanUbatan model.
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
        
        $queryPar['FarmasiUbatanSearch']['farmasi_permohonan_ubatan_id'] = $id;
        
        $searchModelFarmasiUbatan  = new FarmasiUbatanSearch();
        $dataProviderFarmasiUbatan= $searchModelFarmasiUbatan->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->farmasi_permohonan_ubatan_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'searchModelFarmasiUbatan' => $searchModelFarmasiUbatan,
                'dataProviderFarmasiUbatan' => $dataProviderFarmasiUbatan,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Deletes an existing FarmasiPermohonanUbatan model.
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
     * Finds the FarmasiPermohonanUbatan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return FarmasiPermohonanUbatan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = FarmasiPermohonanUbatan::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
