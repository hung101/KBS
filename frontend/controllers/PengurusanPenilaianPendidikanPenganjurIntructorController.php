<?php

namespace frontend\controllers;

use Yii;
use app\models\PengurusanPenilaianPendidikanPenganjurIntructor;
use frontend\models\PengurusanPenilaianPendidikanPenganjurIntructorSearch;
use app\models\PengurusanSoalanPenilaianPendidikanPenganjur;
use frontend\models\PengurusanSoalanPenilaianPendidikanPenganjurSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use app\models\general\GeneralVariable;

// table reference
use app\models\RefInstructorPenilaianPendidikan;
use app\models\ProfilPanelPenasihatKpsk;
use app\models\PengurusanPermohonanKursusPersatuan;

/**
 * PengurusanPenilaianPendidikanPenganjurIntructorController implements the CRUD actions for PengurusanPenilaianPendidikanPenganjurIntructor model.
 */
class PengurusanPenilaianPendidikanPenganjurIntructorController extends Controller
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
     * Lists all PengurusanPenilaianPendidikanPenganjurIntructor models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $searchModel = new PengurusanPenilaianPendidikanPenganjurIntructorSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PengurusanPenilaianPendidikanPenganjurIntructor model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = $this->findModel($id);
        
        $ref = ProfilPanelPenasihatKpsk::findOne(['profil_panel_penasihat_kpsk_id' => $model->instructor]);
        $model->instructor = $ref['nama'];
        
        $ref = PengurusanPermohonanKursusPersatuan::findOne(['pengurusan_permohonan_kursus_persatuan_id' => $model->pengurusan_permohonan_kursus_persatuan_id]);
        $model->pengurusan_permohonan_kursus_persatuan_id = $ref['agensi'];
        
        $queryPar = null;
        
        $queryPar['PengurusanSoalanPenilaianPendidikanPenganjurSearch']['pengurusan_penilaian_pendidikan_penganjur_intructor_id'] = $id;
        
        $searchModelPengurusanSoalanPenilaianPendidikan  = new PengurusanSoalanPenilaianPendidikanPenganjurSearch();
        $dataProviderPengurusanSoalanPenilaianPendidikan = $searchModelPengurusanSoalanPenilaianPendidikan->search($queryPar);
        
        return $this->render('view', [
            'model' => $model,
            'searchModelPengurusanSoalanPenilaianPendidikan' => $searchModelPengurusanSoalanPenilaianPendidikan,
            'dataProviderPengurusanSoalanPenilaianPendidikan' => $dataProviderPengurusanSoalanPenilaianPendidikan,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new PengurusanPenilaianPendidikanPenganjurIntructor model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new PengurusanPenilaianPendidikanPenganjurIntructor();
        
        $queryPar = null;
        
        Yii::$app->session->open();
        
        if(isset(Yii::$app->session->id)){
            $queryPar['PengurusanSoalanPenilaianPendidikanPenganjurSearch']['session_id'] = Yii::$app->session->id;
        }
        
        $searchModelPengurusanSoalanPenilaianPendidikan  = new PengurusanSoalanPenilaianPendidikanPenganjurSearch();
        $dataProviderPengurusanSoalanPenilaianPendidikan = $searchModelPengurusanSoalanPenilaianPendidikan->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if(isset(Yii::$app->session->id)){
                PengurusanSoalanPenilaianPendidikanPenganjur::updateAll(['pengurusan_penilaian_pendidikan_penganjur_intructor_id' => $model->pengurusan_penilaian_pendidikan_penganjur_intructor_id], 'session_id = "'.Yii::$app->session->id.'"');
                PengurusanSoalanPenilaianPendidikanPenganjur::updateAll(['session_id' => ''], 'pengurusan_penilaian_pendidikan_penganjur_intructor_id = "'.$model->pengurusan_penilaian_pendidikan_penganjur_intructor_id.'"');
            }
            
            return $this->redirect(['view', 'id' => $model->pengurusan_penilaian_pendidikan_penganjur_intructor_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'searchModelPengurusanSoalanPenilaianPendidikan' => $searchModelPengurusanSoalanPenilaianPendidikan,
                'dataProviderPengurusanSoalanPenilaianPendidikan' => $dataProviderPengurusanSoalanPenilaianPendidikan,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Updates an existing PengurusanPenilaianPendidikanPenganjurIntructor model.
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
        
        $queryPar['PengurusanSoalanPenilaianPendidikanPenganjurSearch']['pengurusan_penilaian_pendidikan_penganjur_intructor_id'] = $id;
        
        $searchModelPengurusanSoalanPenilaianPendidikan  = new PengurusanSoalanPenilaianPendidikanPenganjurSearch();
        $dataProviderPengurusanSoalanPenilaianPendidikan = $searchModelPengurusanSoalanPenilaianPendidikan->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->pengurusan_penilaian_pendidikan_penganjur_intructor_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'searchModelPengurusanSoalanPenilaianPendidikan' => $searchModelPengurusanSoalanPenilaianPendidikan,
                'dataProviderPengurusanSoalanPenilaianPendidikan' => $dataProviderPengurusanSoalanPenilaianPendidikan,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Deletes an existing PengurusanPenilaianPendidikanPenganjurIntructor model.
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
     * Finds the PengurusanPenilaianPendidikanPenganjurIntructor model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PengurusanPenilaianPendidikanPenganjurIntructor the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PengurusanPenilaianPendidikanPenganjurIntructor::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
