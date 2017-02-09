<?php

namespace frontend\controllers;

use Yii;
use app\models\LawatanRasmiLuarNegara;
use frontend\models\LawatanRasmiLuarNegaraSearch;
use app\models\LawatanRasmiLuarNegaraDelegasi;
use frontend\models\LawatanRasmiLuarNegaraDelegasiSearch;
use app\models\LawatanRasmiLuarNegaraPegawai;
use frontend\models\LawatanRasmiLuarNegaraPegawaiSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use app\models\general\GeneralVariable;
use common\models\general\GeneralFunction;


// table reference
// table reference
use app\models\RefNegara;
use app\models\RefLawatan;

/**
 * LawatanRasmiLuarNegaraController implements the CRUD actions for LawatanRasmiLuarNegara model.
 */
class LawatanRasmiLuarNegaraController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all LawatanRasmiLuarNegara models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $searchModel = new LawatanRasmiLuarNegaraSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single LawatanRasmiLuarNegara model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = $this->findModel($id);
        
        $ref = RefLawatan::findOne(['id' => $model->lawatan]);
        $model->lawatan = $ref['desc'];
        
        $ref = RefNegara::findOne(['id' => $model->negara]);
        $model->negara = $ref['desc'];
        
        $queryPar = null;
        
        $queryPar['LawatanRasmiLuarNegaraDelegasiSearch']['lawatan_rasmi_luar_negara_id'] = $id;
        $queryPar['LawatanRasmiLuarNegaraPegawaiSearch']['lawatan_rasmi_luar_negara_id'] = $id;
        
        $searchModelLawatanRasmiLuarNegaraDelegasi  = new LawatanRasmiLuarNegaraDelegasiSearch();
        $dataProviderLawatanRasmiLuarNegaraDelegasi = $searchModelLawatanRasmiLuarNegaraDelegasi->search($queryPar);
        
        $searchModelLawatanRasmiLuarNegaraPegawai  = new LawatanRasmiLuarNegaraPegawaiSearch();
        $dataProviderLawatanRasmiLuarNegaraPegawai = $searchModelLawatanRasmiLuarNegaraPegawai->search($queryPar);
        
        return $this->render('view', [
            'model' => $model,
            'searchModelLawatanRasmiLuarNegaraDelegasi' => $searchModelLawatanRasmiLuarNegaraDelegasi,
            'dataProviderLawatanRasmiLuarNegaraDelegasi' => $dataProviderLawatanRasmiLuarNegaraDelegasi,
            'searchModelLawatanRasmiLuarNegaraPegawai' => $searchModelLawatanRasmiLuarNegaraPegawai,
            'dataProviderLawatanRasmiLuarNegaraPegawai' => $dataProviderLawatanRasmiLuarNegaraPegawai,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new LawatanRasmiLuarNegara model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new LawatanRasmiLuarNegara();
        
        $queryPar = null;
        
        Yii::$app->session->open();
        
        if(isset(Yii::$app->session->id)){
            $queryPar['LawatanRasmiLuarNegaraDelegasiSearch']['session_id'] = Yii::$app->session->id;
            $queryPar['LawatanRasmiLuarNegaraPegawaiSearch']['session_id'] = Yii::$app->session->id;
        }
        
        $searchModelLawatanRasmiLuarNegaraDelegasi  = new LawatanRasmiLuarNegaraDelegasiSearch();
        $dataProviderLawatanRasmiLuarNegaraDelegasi = $searchModelLawatanRasmiLuarNegaraDelegasi->search($queryPar);
        
        $searchModelLawatanRasmiLuarNegaraPegawai  = new LawatanRasmiLuarNegaraPegawaiSearch();
        $dataProviderLawatanRasmiLuarNegaraPegawai = $searchModelLawatanRasmiLuarNegaraPegawai->search($queryPar);
        
        $model->jumlah_delegasi = $dataProviderLawatanRasmiLuarNegaraDelegasi->getTotalCount();
        

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            LawatanRasmiLuarNegaraDelegasi::updateAll(['lawatan_rasmi_luar_negara_id' => $model->lawatan_rasmi_luar_negara_id], 'session_id = "'.Yii::$app->session->id.'"');
            LawatanRasmiLuarNegaraDelegasi::updateAll(['session_id' => ''], 'lawatan_rasmi_luar_negara_id = "'.$model->lawatan_rasmi_luar_negara_id.'"');

            LawatanRasmiLuarNegaraPegawai::updateAll(['lawatan_rasmi_luar_negara_id' => $model->lawatan_rasmi_luar_negara_id], 'session_id = "'.Yii::$app->session->id.'"');
            LawatanRasmiLuarNegaraPegawai::updateAll(['session_id' => ''], 'lawatan_rasmi_luar_negara_id = "'.$model->lawatan_rasmi_luar_negara_id.'"');
            
            return $this->redirect(['view', 'id' => $model->lawatan_rasmi_luar_negara_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'searchModelLawatanRasmiLuarNegaraDelegasi' => $searchModelLawatanRasmiLuarNegaraDelegasi,
                'dataProviderLawatanRasmiLuarNegaraDelegasi' => $dataProviderLawatanRasmiLuarNegaraDelegasi,
                'searchModelLawatanRasmiLuarNegaraPegawai' => $searchModelLawatanRasmiLuarNegaraPegawai,
                'dataProviderLawatanRasmiLuarNegaraPegawai' => $dataProviderLawatanRasmiLuarNegaraPegawai,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Updates an existing LawatanRasmiLuarNegara model.
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
        
        $queryPar['LawatanRasmiLuarNegaraDelegasiSearch']['lawatan_rasmi_luar_negara_id'] = $id;
        $queryPar['LawatanRasmiLuarNegaraPegawaiSearch']['lawatan_rasmi_luar_negara_id'] = $id;
        
        $searchModelLawatanRasmiLuarNegaraDelegasi  = new LawatanRasmiLuarNegaraDelegasiSearch();
        $dataProviderLawatanRasmiLuarNegaraDelegasi = $searchModelLawatanRasmiLuarNegaraDelegasi->search($queryPar);
        
        $searchModelLawatanRasmiLuarNegaraPegawai  = new LawatanRasmiLuarNegaraPegawaiSearch();
        $dataProviderLawatanRasmiLuarNegaraPegawai = $searchModelLawatanRasmiLuarNegaraPegawai->search($queryPar);
        
        $model->jumlah_delegasi = $dataProviderLawatanRasmiLuarNegaraDelegasi->getTotalCount();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->lawatan_rasmi_luar_negara_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'searchModelLawatanRasmiLuarNegaraDelegasi' => $searchModelLawatanRasmiLuarNegaraDelegasi,
                'dataProviderLawatanRasmiLuarNegaraDelegasi' => $dataProviderLawatanRasmiLuarNegaraDelegasi,
                'searchModelLawatanRasmiLuarNegaraPegawai' => $searchModelLawatanRasmiLuarNegaraPegawai,
                'dataProviderLawatanRasmiLuarNegaraPegawai' => $dataProviderLawatanRasmiLuarNegaraPegawai,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Deletes an existing LawatanRasmiLuarNegara model.
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
     * Finds the LawatanRasmiLuarNegara model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return LawatanRasmiLuarNegara the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = LawatanRasmiLuarNegara::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
