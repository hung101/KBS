<?php

namespace frontend\controllers;

use Yii;
use app\models\LtbsKejohananProgramAktiviti;
use app\models\LtbsKejohananProgramAktivitiSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use common\models\general\GeneralFunction;

// table reference
use app\models\ProfilBadanSukan;

/**
 * LtbsKejohananProgramAktivitiController implements the CRUD actions for LtbsKejohananProgramAktiviti model.
 */
class LtbsKejohananProgramAktivitiController extends Controller
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
     * Lists all LtbsKejohananProgramAktiviti models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new LtbsKejohananProgramAktivitiSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single LtbsKejohananProgramAktiviti model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        // get details
        $model = $this->findModel($id);
        
        // get dropdown value's descriptions
        $ref = ProfilBadanSukan::findOne(['profil_badan_sukan' => $model->profil_badan_sukan_id]);
        $model->profil_badan_sukan_id = $ref['nama_badan_sukan'];
        
        $model->tarikh_kejohanan_program_aktiviti_yang_disertai = GeneralFunction::convert($model->tarikh_kejohanan_program_aktiviti_yang_disertai);
        
        return $this->render('view', [
            'model' => $model,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new LtbsKejohananProgramAktiviti model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new LtbsKejohananProgramAktiviti();
        
        if(Yii::$app->user->identity->profil_badan_sukan){
            $model->profil_badan_sukan_id = Yii::$app->user->identity->profil_badan_sukan;
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->kejohanan_program_aktiviti_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Updates an existing LtbsKejohananProgramAktiviti model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->kejohanan_program_aktiviti_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Deletes an existing LtbsKejohananProgramAktiviti model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the LtbsKejohananProgramAktiviti model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return LtbsKejohananProgramAktiviti the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = LtbsKejohananProgramAktiviti::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
