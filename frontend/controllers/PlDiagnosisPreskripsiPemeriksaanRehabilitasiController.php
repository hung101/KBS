<?php

namespace frontend\controllers;

use Yii;
use app\models\PlDiagnosisPreskripsiPemeriksaanRehabilitasi;
use frontend\models\PlDiagnosisPreskripsiPemeriksaanRehabilitasiSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use app\models\general\GeneralVariable;
use common\models\general\GeneralFunction;

// table reference
use app\models\RefJenisKecederaanMasalahKesihatan;
use app\models\RefStatusDiagnosisPreskripsiPemeriksaanPenyiasatan;
use app\models\RefUnitDiagnosisPreskripsiPemeriksaanPenyiasatan;
use app\models\RefBahagianKecederaan;
use app\models\RefRawatanRehabilitasi;

/**
 * PlDiagnosisPreskripsiPemeriksaanRehabilitasiController implements the CRUD actions for PlDiagnosisPreskripsiPemeriksaanRehabilitasi model.
 */
class PlDiagnosisPreskripsiPemeriksaanRehabilitasiController extends Controller
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
     * Lists all PlDiagnosisPreskripsiPemeriksaanRehabilitasi models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $searchModel = new PlDiagnosisPreskripsiPemeriksaanRehabilitasiSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PlDiagnosisPreskripsiPemeriksaanRehabilitasi model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = $this->findModel($id);
        
        $ref = RefBahagianKecederaan::findOne(['id' => $model->bahagian_kecederaan]);
        $model->bahagian_kecederaan = $ref['desc'];
        
        $ref = RefRawatanRehabilitasi::findOne(['id' => $model->rawatan_rehabilitasi]);
        $model->rawatan_rehabilitasi = $ref['desc'];
        
        $ref = RefUnitDiagnosisPreskripsiPemeriksaanPenyiasatan::findOne(['id' => $model->unit]);
        $model->unit = $ref['desc'];
        
        $model->tarikh = GeneralFunction::convert($model->tarikh, GeneralFunction::TYPE_DATETIME);
        
        return $this->renderAjax('view', [
            'model' => $model,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new PlDiagnosisPreskripsiPemeriksaanRehabilitasi model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($pl_temujanji_id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new PlDiagnosisPreskripsiPemeriksaanRehabilitasi();
        
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
     * Updates an existing PlDiagnosisPreskripsiPemeriksaanRehabilitasi model.
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
     * Deletes an existing PlDiagnosisPreskripsiPemeriksaanRehabilitasi model.
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
     * Finds the PlDiagnosisPreskripsiPemeriksaanRehabilitasi model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PlDiagnosisPreskripsiPemeriksaanRehabilitasi the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PlDiagnosisPreskripsiPemeriksaanRehabilitasi::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
