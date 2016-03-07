<?php

namespace frontend\controllers;

use Yii;
use app\models\PengurusanKejohananTemasya;
use frontend\models\PengurusanKejohananTemasyaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use app\models\general\GeneralVariable;

// table reference
use app\models\RefSukan;
use app\models\RefAcara;
use app\models\RefPeringkatKejohananTemasya;
use app\models\Atlet;
use app\models\RefPegawaiKejohananTemasya;
use app\models\RefFisioKejohananTemasya;
use app\models\RefDoktorKejohananTemasya;

/**
 * PengurusanKejohananTemasyaController implements the CRUD actions for PengurusanKejohananTemasya model.
 */
class PengurusanKejohananTemasyaController extends Controller
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
     * Lists all PengurusanKejohananTemasya models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $searchModel = new PengurusanKejohananTemasyaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PengurusanKejohananTemasya model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = $this->findModel($id);
        
        $ref = Atlet::findOne(['atlet_id' => $model->nama_atlet]);
        $model->nama_atlet = $ref['nameAndIC'];
        
        $ref = RefSukan::findOne(['id' => $model->nama_sukan]);
        $model->nama_sukan = $ref['desc'];
        
        $ref = RefAcara::findOne(['id' => $model->nama_acara]);
        $model->nama_acara = $ref['desc'];
        
        $ref = RefPeringkatKejohananTemasya::findOne(['id' => $model->peringkat]);
        $model->peringkat = $ref['desc'];
        
        $ref = RefPegawaiKejohananTemasya::findOne(['id' => $model->nama_pegawai]);
        $model->nama_pegawai = $ref['desc'];
        
        $ref = RefFisioKejohananTemasya::findOne(['id' => $model->nama_fisio]);
        $model->nama_fisio = $ref['desc'];
        
        $ref = RefDoktorKejohananTemasya::findOne(['id' => $model->nama_doktor]);
        $model->nama_doktor = $ref['desc'];
        
        return $this->renderAjax('view', [
            'model' => $model,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new PengurusanKejohananTemasya model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($pengurusan_kejohanan_temasya_main_id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new PengurusanKejohananTemasya();
        
        Yii::$app->session->open();
        
        if($pengurusan_kejohanan_temasya_main_id != ''){
            $model->pengurusan_kejohanan_temasya_main_id = $pengurusan_kejohanan_temasya_main_id;
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
     * Updates an existing PengurusanKejohananTemasya model.
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
     * Deletes an existing PengurusanKejohananTemasya model.
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
     * Finds the PengurusanKejohananTemasya model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PengurusanKejohananTemasya the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PengurusanKejohananTemasya::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
