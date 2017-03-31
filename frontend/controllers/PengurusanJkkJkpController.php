<?php

namespace frontend\controllers;

use Yii;
use app\models\PengurusanJkkJkp;
use frontend\models\PengurusanJkkJkpSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;

use app\models\general\GeneralVariable;
use app\models\general\GeneralLabel;

// table reference
use app\models\RefJenisCawanganKuasaJkkJkp;
use app\models\RefStatusJkkJkp;
use app\models\RefNamaAhliJkkJkp;
use app\models\RefJawatanJkkJkp;
use app\models\RefSukan;
use app\models\RefCawangan;
use app\models\RefAgensiJkk;
use app\models\RefBahagianAduan;


/**
 * PengurusanJkkJkpController implements the CRUD actions for PengurusanJkkJkp model.
 */
class PengurusanJkkJkpController extends Controller
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
     * Lists all PengurusanJkkJkp models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $searchModel = new PengurusanJkkJkpSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PengurusanJkkJkp model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = $this->findModel($id);
        
        $ref = RefJenisCawanganKuasaJkkJkp::findOne(['id' => $model->jenis_cawangan_kuasa]);
        $model->jenis_cawangan_kuasa = $ref['desc'];
        
        $ref = RefStatusJkkJkp::findOne(['id' => $model->status]);
        $model->status = $ref['desc'];
        
        //$ref = RefNamaAhliJkkJkp::findOne(['id' => $model->nama_pegawai_coach]);
        //$model->nama_pegawai_coach = $ref['desc'];
        
        $ref = RefJawatanJkkJkp::findOne(['id' => $model->jawatan]);
        $model->jawatan = $ref['desc'];
        
        $ref = RefSukan::findOne(['id' => $model->sukan]);
        $model->sukan = $ref['desc'];
        
        $YesNo = GeneralLabel::getYesNoLabel($model->status_pilihan);
        $model->status_pilihan = $YesNo;
		
		$ref = RefCawangan::findOne(['id' => $model->cawangan]);
		$model->cawangan = $ref['desc'];
		
		$ref = RefAgensiJkk::findOne(['id' => $model->agensi]);
		$model->agensi = $ref['desc'];
		
		$ref = RefBahagianAduan::findOne(['id' => $model->bahagian]);
		$model->bahagian = $ref['desc'];
        
        return $this->render('view', [
            'model' => $model,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new PengurusanJkkJkp model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new PengurusanJkkJkp();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->pengurusan_jkk_jkp_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Updates an existing PengurusanJkkJkp model.
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
            return $this->redirect(['view', 'id' => $model->pengurusan_jkk_jkp_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Deletes an existing PengurusanJkkJkp model.
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
	
	public function actionGetAhli($id){
        // find Jurulatih
        $model = $this->findModel($id);
        
        echo Json::encode($model);
    }

    /**
     * Finds the PengurusanJkkJkp model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PengurusanJkkJkp the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PengurusanJkkJkp::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
