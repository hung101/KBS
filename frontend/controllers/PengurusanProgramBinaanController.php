<?php

namespace frontend\controllers;

use Yii;
use app\models\PengurusanProgramBinaan;
use frontend\models\PengurusanProgramBinaanSearch;
use app\models\PengurusanProgramBinaanKos;
use frontend\models\PengurusanProgramBinaanKosSearch;
use app\models\PengurusanProgramBinaanPeserta;
use frontend\models\PengurusanProgramBinaanPesertaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use app\models\general\GeneralVariable;
use app\models\general\GeneralLabel;

// table reference
use app\models\RefKategoriPermohonanProgramBinaan;
use app\models\RefJenisPermohonanProgramBinaan;
use app\models\RefSukan;
use app\models\RefAtletTahap;
use app\models\RefNegeri;

/**
 * PengurusanProgramBinaanController implements the CRUD actions for PengurusanProgramBinaan model.
 */
class PengurusanProgramBinaanController extends Controller
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
     * Lists all PengurusanProgramBinaan models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $searchModel = new PengurusanProgramBinaanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PengurusanProgramBinaan model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = $this->findModel($id);
        
        $ref = RefKategoriPermohonanProgramBinaan::findOne(['id' => $model->kategori_permohonan]);
        $model->kategori_permohonan = $ref['desc'];
        
        $ref = RefJenisPermohonanProgramBinaan::findOne(['id' => $model->jenis_permohonan]);
        $model->jenis_permohonan = $ref['desc'];
        
        $ref = RefSukan::findOne(['id' => $model->sukan]);
        $model->sukan = $ref['desc'];
        
        $ref = RefAtletTahap::findOne(['id' => $model->tahap]);
        $model->tahap = $ref['desc'];
        
        $ref = RefNegeri::findOne(['id' => $model->negeri]);
        $model->negeri = $ref['desc'];
        
        $YesNo = GeneralLabel::getYesNoLabel($model->sokongan_pn);
        $model->sokongan_pn = $YesNo;
        
        $YesNo = GeneralLabel::getYesNoLabel($model->kelulusan);
        $model->kelulusan = $YesNo;
        
        $queryPar = null;
        
        $queryPar['PengurusanProgramBinaanKosSearch']['pengurusan_program_binaan_id'] = $id;
        $queryPar['PengurusanProgramBinaanPesertaSearch']['pengurusan_program_binaan_id'] = $id;
        
        $searchModelProgramBinaanKos  = new PengurusanProgramBinaanKosSearch();
        $dataProviderProgramBinaanKos = $searchModelProgramBinaanKos->search($queryPar);
        
        $searchModelProgramBinaanPeserta = new PengurusanProgramBinaanPesertaSearch();
        $dataProviderProgramBinaanPeserta = $searchModelProgramBinaanPeserta->search($queryPar);
        
        return $this->render('view', [
            'model' => $model,
            'searchModelProgramBinaanKos' => $searchModelProgramBinaanKos,
            'dataProviderProgramBinaanKos' => $dataProviderProgramBinaanKos,
            'searchModelProgramBinaanPeserta' => $searchModelProgramBinaanPeserta,
            'dataProviderProgramBinaanPeserta' => $dataProviderProgramBinaanPeserta,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new PengurusanProgramBinaan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new PengurusanProgramBinaan();
        
        $queryPar = null;
        
        Yii::$app->session->open();
        
        if(isset(Yii::$app->session->id)){
            $queryPar['PengurusanProgramBinaanKosSearch']['session_id'] = Yii::$app->session->id;
            $queryPar['PengurusanProgramBinaanPesertaSearch']['session_id'] = Yii::$app->session->id;
        }
        
        $searchModelProgramBinaanKos  = new PengurusanProgramBinaanKosSearch();
        $dataProviderProgramBinaanKos = $searchModelProgramBinaanKos->search($queryPar);
        
        $searchModelProgramBinaanPeserta = new PengurusanProgramBinaanPesertaSearch();
        $dataProviderProgramBinaanPeserta = $searchModelProgramBinaanPeserta->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if(isset(Yii::$app->session->id)){
                PengurusanProgramBinaanKos::updateAll(['pengurusan_program_binaan_id' => $model->pengurusan_program_binaan_id], 'session_id = "'.Yii::$app->session->id.'"');
                PengurusanProgramBinaanKos::updateAll(['session_id' => ''], 'pengurusan_program_binaan_id = "'.$model->pengurusan_program_binaan_id.'"');
                
                PengurusanProgramBinaanPeserta::updateAll(['pengurusan_program_binaan_id' => $model->pengurusan_program_binaan_id], 'session_id = "'.Yii::$app->session->id.'"');
                PengurusanProgramBinaanPeserta::updateAll(['session_id' => ''], 'pengurusan_program_binaan_id = "'.$model->pengurusan_program_binaan_id.'"');
            }
            
            return $this->redirect(['view', 'id' => $model->pengurusan_program_binaan_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'searchModelProgramBinaanKos' => $searchModelProgramBinaanKos,
                'dataProviderProgramBinaanKos' => $dataProviderProgramBinaanKos,
                'searchModelProgramBinaanPeserta' => $searchModelProgramBinaanPeserta,
                'dataProviderProgramBinaanPeserta' => $dataProviderProgramBinaanPeserta,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Updates an existing PengurusanProgramBinaan model.
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
        
        $queryPar['PengurusanProgramBinaanKosSearch']['pengurusan_program_binaan_id'] = $id;
        $queryPar['PengurusanProgramBinaanPesertaSearch']['pengurusan_program_binaan_id'] = $id;
        
        $searchModelProgramBinaanKos  = new PengurusanProgramBinaanKosSearch();
        $dataProviderProgramBinaanKos = $searchModelProgramBinaanKos->search($queryPar);
        
        $searchModelProgramBinaanPeserta = new PengurusanProgramBinaanPesertaSearch();
        $dataProviderProgramBinaanPeserta = $searchModelProgramBinaanPeserta->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->pengurusan_program_binaan_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'searchModelProgramBinaanKos' => $searchModelProgramBinaanKos,
                'dataProviderProgramBinaanKos' => $dataProviderProgramBinaanKos,
                'searchModelProgramBinaanPeserta' => $searchModelProgramBinaanPeserta,
                'dataProviderProgramBinaanPeserta' => $dataProviderProgramBinaanPeserta,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Deletes an existing PengurusanProgramBinaan model.
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
     * Finds the PengurusanProgramBinaan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PengurusanProgramBinaan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        if (($model = PengurusanProgramBinaan::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
