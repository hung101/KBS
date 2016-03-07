<?php

namespace frontend\controllers;

use Yii;
use app\models\LatihanDanProgram;
use app\models\LatihanDanProgramSearch;
use app\models\LatihanDanProgramPeserta;
use frontend\models\LatihanDanProgramPesertaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use app\models\general\GeneralVariable;
use common\models\general\GeneralFunction;


// table reference
use app\models\RefKategoriKursus;

/**
 * LatihanDanProgramController implements the CRUD actions for LatihanDanProgram model.
 */
class LatihanDanProgramController extends Controller
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
     * Lists all LatihanDanProgram models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $searchModel = new LatihanDanProgramSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single LatihanDanProgram model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $queryPar = null;
        
        $queryPar['LatihanDanProgramPesertaSearch']['latihan_dan_program_id'] = $id;
        
        $searchModelPeserta  = new LatihanDanProgramPesertaSearch();
        $dataProviderPeserta = $searchModelPeserta->search($queryPar);
        
        $model = $this->findModel($id);
        
        $ref = RefKategoriKursus::findOne(['id' => $model->kategori_kursus]);
        $model->kategori_kursus = $ref['desc'];
        
        $model->tarikh_kursus = GeneralFunction::convert($model->tarikh_kursus);
        
        return $this->render('view', [
            'model' => $model,
            'searchModelPeserta' => $searchModelPeserta,
            'dataProviderPeserta' => $dataProviderPeserta,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new LatihanDanProgram model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new LatihanDanProgram();
        
        $queryPar = null;
        
        Yii::$app->session->open();
        
        if(isset(Yii::$app->session->id)){
            $queryPar['LatihanDanProgramPesertaSearch']['session_id'] = Yii::$app->session->id;
        }
        
        $searchModelPeserta  = new LatihanDanProgramPesertaSearch();
        $dataProviderPeserta = $searchModelPeserta->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if(isset(Yii::$app->session->id)){
                LatihanDanProgramPeserta::updateAll(['latihan_dan_program_id' => $model->latihan_dan_program_id], 'session_id = "'.Yii::$app->session->id.'"');
                LatihanDanProgramPeserta::updateAll(['session_id' => ''], 'latihan_dan_program_id = "'.$model->latihan_dan_program_id.'"');
            }
            
            return $this->redirect(['view', 'id' => $model->latihan_dan_program_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'searchModelPeserta' => $searchModelPeserta,
                'dataProviderPeserta' => $dataProviderPeserta,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Updates an existing LatihanDanProgram model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $queryPar = null;
        
        $queryPar['LatihanDanProgramPesertaSearch']['latihan_dan_program_id'] = $id;
        
        $searchModelPeserta  = new LatihanDanProgramPesertaSearch();
        $dataProviderPeserta = $searchModelPeserta->search($queryPar);
        
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->latihan_dan_program_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'searchModelPeserta' => $searchModelPeserta,
                'dataProviderPeserta' => $dataProviderPeserta,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Deletes an existing LatihanDanProgram model.
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
     * Finds the LatihanDanProgram model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return LatihanDanProgram the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = LatihanDanProgram::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
