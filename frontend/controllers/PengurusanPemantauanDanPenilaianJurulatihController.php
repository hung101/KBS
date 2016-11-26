<?php

namespace frontend\controllers;

use Yii;
use app\models\PengurusanPemantauanDanPenilaianJurulatih;
use frontend\models\PengurusanPemantauanDanPenilaianJurulatihSearch;
use app\models\PengurusanPenilaianKategoriJurulatih;
use frontend\models\PengurusanPenilaianKategoriJurulatihSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Session;

// contant values
use app\models\general\GeneralVariable;
use common\models\general\GeneralFunction;

// table reference
use app\models\Jurulatih;
use app\models\RefSukan;
use app\models\RefAcara;
use app\models\RefPenilaianJurulatih;

/**
 * PengurusanPemantauanDanPenilaianJurulatihController implements the CRUD actions for PengurusanPemantauanDanPenilaianJurulatih model.
 */
class PengurusanPemantauanDanPenilaianJurulatihController extends Controller
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
     * Lists all PengurusanPemantauanDanPenilaianJurulatih models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $session = new Session;
        $session->open();
        
        $session->remove('penilaian_oleh_id');
        
        $session->close();
        
        $searchModel = new PengurusanPemantauanDanPenilaianJurulatihSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PengurusanPemantauanDanPenilaianJurulatih model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $session = new Session;
        $session->open();
        
        $session->remove('penilaian_oleh_id');
        
        $session->close();
        
        $model = $this->findModel($id);
        
        $ref = Jurulatih::findOne(['jurulatih_id' => $model->nama_jurulatih_dinilai]);
        $model->nama_jurulatih_dinilai = $ref['nameAndIC'];
        
        $ref = RefSukan::findOne(['id' => $model->nama_sukan]);
        $model->nama_sukan = $ref['desc'];
        
        $ref = RefAcara::findOne(['id' => $model->nama_acara]);
        $model->nama_acara = $ref['desc'];
        
        $model->penilaian_oleh_id = $model->penilaian_oleh;
        $ref = RefPenilaianJurulatih::findOne(['id' => $model->penilaian_oleh]);
        $model->penilaian_oleh = $ref['desc'];
        
        $queryPar = null;
        
        $queryPar['PengurusanPenilaianKategoriJurulatihSearch']['pengurusan_pemantauan_dan_penilaian_jurulatih_id'] = $id;
        
        $searchModelPengurusanPenilaianKategoriJurulatih  = new PengurusanPenilaianKategoriJurulatihSearch();
        $dataProviderPengurusanPenilaianKategoriJurulatih= $searchModelPengurusanPenilaianKategoriJurulatih->search($queryPar);
        
        return $this->render('view', [
            'model' => $model,
            'searchModelPengurusanPenilaianKategoriJurulatih' => $searchModelPengurusanPenilaianKategoriJurulatih,
            'dataProviderPengurusanPenilaianKategoriJurulatih' => $dataProviderPengurusanPenilaianKategoriJurulatih,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new PengurusanPemantauanDanPenilaianJurulatih model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new PengurusanPemantauanDanPenilaianJurulatih();
        
        $model->tarikh_dinilai = date("Y-m-d");
        
        $queryPar = null;
        
        Yii::$app->session->open();
        
        if(isset(Yii::$app->session->id)){
            $queryPar['PengurusanPenilaianKategoriJurulatihSearch']['session_id'] = Yii::$app->session->id;
        }
        
        $searchModelPengurusanPenilaianKategoriJurulatih  = new PengurusanPenilaianKategoriJurulatihSearch();
        $dataProviderPengurusanPenilaianKategoriJurulatih= $searchModelPengurusanPenilaianKategoriJurulatih->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if(isset(Yii::$app->session->id)){
                PengurusanPenilaianKategoriJurulatih::updateAll(['pengurusan_pemantauan_dan_penilaian_jurulatih_id' => $model->pengurusan_pemantauan_dan_penilaian_jurulatih_id], 'session_id = "'.Yii::$app->session->id.'"');
                PengurusanPenilaianKategoriJurulatih::updateAll(['session_id' => ''], 'pengurusan_pemantauan_dan_penilaian_jurulatih_id = "'.$model->pengurusan_pemantauan_dan_penilaian_jurulatih_id.'"');
            }
            
            return $this->redirect(['view', 'id' => $model->pengurusan_pemantauan_dan_penilaian_jurulatih_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'searchModelPengurusanPenilaianKategoriJurulatih' => $searchModelPengurusanPenilaianKategoriJurulatih,
                'dataProviderPengurusanPenilaianKategoriJurulatih' => $dataProviderPengurusanPenilaianKategoriJurulatih,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Updates an existing PengurusanPemantauanDanPenilaianJurulatih model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $session = new Session;
        $session->open();
        
        $session->remove('penilaian_oleh_id');
        
        $session->close();
        
        $model = $this->findModel($id);
        
        $queryPar = null;
        
        $queryPar['PengurusanPenilaianKategoriJurulatihSearch']['pengurusan_pemantauan_dan_penilaian_jurulatih_id'] = $id;
        
        $searchModelPengurusanPenilaianKategoriJurulatih  = new PengurusanPenilaianKategoriJurulatihSearch();
        $dataProviderPengurusanPenilaianKategoriJurulatih= $searchModelPengurusanPenilaianKategoriJurulatih->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->pengurusan_pemantauan_dan_penilaian_jurulatih_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'searchModelPengurusanPenilaianKategoriJurulatih' => $searchModelPengurusanPenilaianKategoriJurulatih,
                'dataProviderPengurusanPenilaianKategoriJurulatih' => $dataProviderPengurusanPenilaianKategoriJurulatih,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Deletes an existing PengurusanPemantauanDanPenilaianJurulatih model.
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
     * Updates an existing Jurulatih model.
     * If approved is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionSent($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = $this->findModel($id);
        
        $model->hantar = 1; // set approved
        $model->tarikh_hantar = GeneralFunction::getCurrentTimestamp(); // set date time capture
        
        $model->save();
        
        //return $this->redirect(['view', 'id' => $model->jurulatih_id]);
        
        return $this->redirect(['index']);
    }

    /**
     * Finds the PengurusanPemantauanDanPenilaianJurulatih model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PengurusanPemantauanDanPenilaianJurulatih the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PengurusanPemantauanDanPenilaianJurulatih::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionSetPernilaianOleh($penilaian_oleh_id){
        
        $session = new Session;
        $session->open();

        $session['penilaian_oleh_id'] = $penilaian_oleh_id;
        
        $session->close();
    }
}
