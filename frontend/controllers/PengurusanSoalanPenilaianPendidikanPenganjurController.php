<?php

namespace frontend\controllers;

use Yii;
use app\models\PengurusanSoalanPenilaianPendidikanPenganjur;
use frontend\models\PengurusanSoalanPenilaianPendidikanPenganjurSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use app\models\general\GeneralVariable;

// table reference
use app\models\RefSoalanPenilaianPendidikanPenganjurInstructor;
use app\models\RefRatingSoalan;

/**
 * PengurusanSoalanPenilaianPendidikanPenganjurController implements the CRUD actions for chmod($file,0777); PengurusanSoalanPenilaianPendidikanPenganjur model.
 */
class PengurusanSoalanPenilaianPendidikanPenganjurController extends Controller
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
     * Lists all PengurusanSoalanPenilaianPendidikanPenganjur models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $searchModel = new PengurusanSoalanPenilaianPendidikanPenganjurSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PengurusanSoalanPenilaianPendidikanPenganjur model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = $this->findModel($id);
        
        $ref = RefSoalanPenilaianPendidikanPenganjurInstructor::findOne(['id' => $model->soalan]);
        $model->soalan = $ref['desc'];
        
        $ref = RefRatingSoalan::findOne(['id' => $model->rating]);
        $model->rating = $ref['desc'];
        
        return $this->renderAjax('view', [
            'model' => $model,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new PengurusanSoalanPenilaianPendidikanPenganjur model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($pengurusan_penilaian_pendidikan_penganjur_intructor_id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new PengurusanSoalanPenilaianPendidikanPenganjur();
        
        Yii::$app->session->open();
        
        if($pengurusan_penilaian_pendidikan_penganjur_intructor_id != ''){
            $model->pengurusan_penilaian_pendidikan_penganjur_intructor_id = $pengurusan_penilaian_pendidikan_penganjur_intructor_id;
        } else {
            if(isset(Yii::$app->session->id)){
                $model->session_id = Yii::$app->session->id;
            }
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return '1';
        } else {
            return $this->renderAjax('create', [
                'model' => $model,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Updates an existing PengurusanSoalanPenilaianPendidikanPenganjur model.
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
            return '1';
        } else {
            return $this->renderAjax('update', [
                'model' => $model,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Deletes an existing PengurusanSoalanPenilaianPendidikanPenganjur model.
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
     * Finds the PengurusanSoalanPenilaianPendidikanPenganjur model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PengurusanSoalanPenilaianPendidikanPenganjur the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PengurusanSoalanPenilaianPendidikanPenganjur::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
