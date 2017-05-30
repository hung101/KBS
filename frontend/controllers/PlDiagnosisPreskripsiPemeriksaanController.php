<?php

namespace frontend\controllers;

use Yii;
use app\models\PlDiagnosisPreskripsiPemeriksaan;
use frontend\models\PlDiagnosisPreskripsiPemeriksaanSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use app\models\general\GeneralVariable;
use common\models\general\GeneralFunction;

// table reference
use app\models\RefJenisKecederaanMasalahKesihatan;
use app\models\RefStatusDiagnosisPreskripsiPemeriksaanPenyiasatan;
use app\models\RefUnitDiagnosisPreskripsiPemeriksaanPenyiasatan;

/**
 * PlDiagnosisPreskripsiPemeriksaanController implements the CRUD actions for PlDiagnosisPreskripsiPemeriksaan model.
 */
class PlDiagnosisPreskripsiPemeriksaanController extends Controller
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
     * Lists all PlDiagnosisPreskripsiPemeriksaan models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $searchModel = new PlDiagnosisPreskripsiPemeriksaanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PlDiagnosisPreskripsiPemeriksaan model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = $this->findModel($id);
        
        $ref = RefJenisKecederaanMasalahKesihatan::findOne(['id' => $model->jenis_diagnosis_preskripsi_pemeriksaan]);
        $model->jenis_diagnosis_preskripsi_pemeriksaan = $ref['desc'];
        
        $ref = RefStatusDiagnosisPreskripsiPemeriksaanPenyiasatan::findOne(['id' => $model->status_diagnosis_preskripsi_pemeriksaan]);
        $model->status_diagnosis_preskripsi_pemeriksaan = $ref['desc'];
        
        $ref = RefUnitDiagnosisPreskripsiPemeriksaanPenyiasatan::findOne(['id' => $model->unit]);
        $model->unit = $ref['desc'];
        
        if($model->tarikh != "") {$model->tarikh = GeneralFunction::convert($model->tarikh, GeneralFunction::TYPE_DATE);}
        
        return $this->renderAjax('view', [
            'model' => $model,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new PlDiagnosisPreskripsiPemeriksaan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($pl_temujanji_id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new PlDiagnosisPreskripsiPemeriksaan();
        
        Yii::$app->session->open();
        
        if($pl_temujanji_id != ''){
            $model->pl_temujanji_id = $pl_temujanji_id;
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
     * Updates an existing PlDiagnosisPreskripsiPemeriksaan model.
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
     * Deletes an existing PlDiagnosisPreskripsiPemeriksaan model.
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
     * Finds the PlDiagnosisPreskripsiPemeriksaan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PlDiagnosisPreskripsiPemeriksaan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PlDiagnosisPreskripsiPemeriksaan::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
