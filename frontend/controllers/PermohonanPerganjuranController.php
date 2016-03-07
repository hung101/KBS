<?php

namespace frontend\controllers;

use Yii;
use app\models\PermohonanPerganjuran;
use frontend\models\PermohonanPerganjuranSearch;
use app\models\PermohonanPerganjuranInstructor;
use frontend\models\PermohonanPerganjuranInstructorSearch;
use app\models\PermohonanPenganjuranKos;
use frontend\models\PermohonanPenganjuranKosSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

// contant values
use app\models\general\GeneralVariable;
use app\models\general\GeneralLabel;

/**
 * PermohonanPerganjuranController implements the CRUD actions for PermohonanPerganjuran model.
 */
class PermohonanPerganjuranController extends Controller
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
     * Lists all PermohonanPerganjuran models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $searchModel = new PermohonanPerganjuranSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PermohonanPerganjuran model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $queryPar = null;
        
        $queryPar['PermohonanPerganjuranInstructorSearch']['permohonan_perganjuran_id'] = $id;
        $queryPar['PermohonanPenganjuranKosSearch']['permohonan_perganjuran_id'] = $id;
        
        $searchModelPermohonanPerganjuranInstructor = new PermohonanPerganjuranInstructorSearch();
        $dataProviderPermohonanPerganjuranInstructor = $searchModelPermohonanPerganjuranInstructor->search($queryPar);
        
        $searchModelPermohonanPenganjuranKos= new PermohonanPenganjuranKosSearch();
        $dataProviderPermohonanPenganjuranKos = $searchModelPermohonanPenganjuranKos->search($queryPar);
        
        $model = $this->findModel($id);
        
        $model->kelulusan = GeneralLabel::getYesNoLabel($model->kelulusan);
        
        return $this->render('view', [
            'model' => $model,
            'searchModelPermohonanPerganjuranInstructor' => $searchModelPermohonanPerganjuranInstructor,
            'dataProviderPermohonanPerganjuranInstructor' => $dataProviderPermohonanPerganjuranInstructor,
            'searchModelPermohonanPenganjuranKos' => $searchModelPermohonanPenganjuranKos,
            'dataProviderPermohonanPenganjuranKos' => $dataProviderPermohonanPenganjuranKos,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new PermohonanPerganjuran model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new PermohonanPerganjuran();
        
        $queryPar = null;
        
        Yii::$app->session->open();
        
        if(isset(Yii::$app->session->id)){
            $queryPar['PermohonanPerganjuranInstructorSearch']['session_id'] = Yii::$app->session->id;
            $queryPar['PermohonanPenganjuranKosSearch']['session_id'] = Yii::$app->session->id;
        }
        
        $searchModelPermohonanPerganjuranInstructor = new PermohonanPerganjuranInstructorSearch();
        $dataProviderPermohonanPerganjuranInstructor = $searchModelPermohonanPerganjuranInstructor->search($queryPar);
        
        $searchModelPermohonanPenganjuranKos= new PermohonanPenganjuranKosSearch();
        $dataProviderPermohonanPenganjuranKos = $searchModelPermohonanPenganjuranKos->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if(isset(Yii::$app->session->id)){
                PermohonanPerganjuranInstructor::updateAll(['permohonan_perganjuran_id' => $model->permohonan_perganjuran_id], 'session_id = "'.Yii::$app->session->id.'"');
                PermohonanPerganjuranInstructor::updateAll(['session_id' => ''], 'permohonan_perganjuran_id = "'.$model->permohonan_perganjuran_id.'"');
                
                PermohonanPenganjuranKos::updateAll(['permohonan_perganjuran_id' => $model->permohonan_perganjuran_id], 'session_id = "'.Yii::$app->session->id.'"');
                PermohonanPenganjuranKos::updateAll(['session_id' => ''], 'permohonan_perganjuran_id = "'.$model->permohonan_perganjuran_id.'"');
            }
            
            return $this->redirect(['view', 'id' => $model->permohonan_perganjuran_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'searchModelPermohonanPerganjuranInstructor' => $searchModelPermohonanPerganjuranInstructor,
                'dataProviderPermohonanPerganjuranInstructor' => $dataProviderPermohonanPerganjuranInstructor,
                'searchModelPermohonanPenganjuranKos' => $searchModelPermohonanPenganjuranKos,
                'dataProviderPermohonanPenganjuranKos' => $dataProviderPermohonanPenganjuranKos,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Updates an existing PermohonanPerganjuran model.
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
        
        $queryPar['PermohonanPerganjuranInstructorSearch']['permohonan_perganjuran_id'] = $id;
        $queryPar['PermohonanPenganjuranKosSearch']['permohonan_perganjuran_id'] = $id;
        
        $searchModelPermohonanPerganjuranInstructor = new PermohonanPerganjuranInstructorSearch();
        $dataProviderPermohonanPerganjuranInstructor = $searchModelPermohonanPerganjuranInstructor->search($queryPar);
        
        $searchModelPermohonanPenganjuranKos= new PermohonanPenganjuranKosSearch();
        $dataProviderPermohonanPenganjuranKos = $searchModelPermohonanPenganjuranKos->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->permohonan_perganjuran_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'searchModelPermohonanPerganjuranInstructor' => $searchModelPermohonanPerganjuranInstructor,
                'dataProviderPermohonanPerganjuranInstructor' => $dataProviderPermohonanPerganjuranInstructor,
                'searchModelPermohonanPenganjuranKos' => $searchModelPermohonanPenganjuranKos,
                'dataProviderPermohonanPenganjuranKos' => $dataProviderPermohonanPenganjuranKos,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Deletes an existing PermohonanPerganjuran model.
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
     * Finds the PermohonanPerganjuran model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PermohonanPerganjuran the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PermohonanPerganjuran::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
