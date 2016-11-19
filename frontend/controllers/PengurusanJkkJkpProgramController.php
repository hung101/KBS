<?php

namespace frontend\controllers;

use Yii;
use app\models\PengurusanJkkJkpProgram;
use frontend\models\PengurusanJkkJkpProgramSearch;
use app\models\SenaraiAtlet;
use frontend\models\SenaraiAtletSearch;
use app\models\SenaraiJurulatih;
use frontend\models\SenaraiJurulatihSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use app\models\general\GeneralVariable;

// table reference
use app\models\PengurusanJkkJkp;
use app\models\RefPesertaJkkJkp;

/**
 * PengurusanJkkJkpProgramController implements the CRUD actions for PengurusanJkkJkpProgram model.
 */
class PengurusanJkkJkpProgramController extends Controller
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
     * Lists all PengurusanJkkJkpProgram models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $searchModel = new PengurusanJkkJkpProgramSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PengurusanJkkJkpProgram model.
     * @param integer $idJurulatih::findOne($id)
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $queryPar = null;
        
        $queryPar['SenaraiAtletSearch']['pengurusan_jkk_jkp_program_id'] = $id;
        $queryPar['SenaraiJurulatihSearch']['pengurusan_jkk_jkp_program_id'] = $id;
        
        $searchModelSenaraiAtlet  = new SenaraiAtletSearch();
        $dataProviderSenaraiAtlet = $searchModelSenaraiAtlet->search($queryPar);
        $searchModelSenaraiJurulatih  = new SenaraiJurulatihSearch();
        $dataProviderSenaraiJurulatih = $searchModelSenaraiJurulatih->search($queryPar);
        
        $model = $this->findModel($id);
        
        $ref = PengurusanJkkJkp::find()->joinWith(['refNamaAhliJkkJkp'])->andFilterWhere(['pengurusan_jkk_jkp_id' => $model->pengurusan_jkk_jkp_id])->one();
        $model->pengurusan_jkk_jkp_id = $ref['refNamaAhliJkkJkp']['desc'];
        
        $ref = RefPesertaJkkJkp::findOne(['id' => $model->nama_pesserta]);
        $model->nama_pesserta = $ref['desc'];
        
        return $this->render('view', [
            'model' => $model,
            'searchModelSenaraiAtlet' => $searchModelSenaraiAtlet,
            'dataProviderSenaraiAtlet' => $dataProviderSenaraiAtlet,
            'searchModelSenaraiJurulatih' => $searchModelSenaraiJurulatih,
            'dataProviderSenaraiJurulatih' => $dataProviderSenaraiJurulatih,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new PengurusanJkkJkpProgram model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new PengurusanJkkJkpProgram();
        
        $queryPar = null;
        
        Yii::$app->session->open();
        
        if(isset(Yii::$app->session->id)){
            $queryPar['SenaraiAtletSearch']['session_id'] = Yii::$app->session->id;
            $queryPar['SenaraiAtletSearch']['session_id'] = Yii::$app->session->id;
        }
        
        $searchModelSenaraiAtlet  = new SenaraiAtletSearch();
        $dataProviderSenaraiAtlet = $searchModelSenaraiAtlet->search($queryPar);
        $searchModelSenaraiJurulatih  = new SenaraiJurulatihSearch();
        $dataProviderSenaraiJurulatih = $searchModelSenaraiJurulatih->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if(isset(Yii::$app->session->id)){
                SenaraiAtlet::updateAll(['pengurusan_jkk_jkp_program_id' => $model->pengurusan_jkk_jkp_program_id], 'session_id = "'.Yii::$app->session->id.'"');
                SenaraiAtlet::updateAll(['session_id' => ''], 'pengurusan_jkk_jkp_program_id = "'.$model->pengurusan_jkk_jkp_program_id.'"');
                
                SenaraiJurulatih::updateAll(['pengurusan_jkk_jkp_program_id' => $model->pengurusan_jkk_jkp_program_id], 'session_id = "'.Yii::$app->session->id.'"');
                SenaraiJurulatih::updateAll(['session_id' => ''], 'pengurusan_jkk_jkp_program_id = "'.$model->pengurusan_jkk_jkp_program_id.'"');
            }
            
            return $this->redirect(['view', 'id' => $model->pengurusan_jkk_jkp_program_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'searchModelSenaraiAtlet' => $searchModelSenaraiAtlet,
                'dataProviderSenaraiAtlet' => $dataProviderSenaraiAtlet,
                'searchModelSenaraiJurulatih' => $searchModelSenaraiJurulatih,
                'dataProviderSenaraiJurulatih' => $dataProviderSenaraiJurulatih,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Updates an existing PengurusanJkkJkpProgram model.
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
        
        $queryPar['SenaraiAtletSearch']['pengurusan_jkk_jkp_program_id'] = $id;
        $queryPar['SenaraiJurulatihSearch']['pengurusan_jkk_jkp_program_id'] = $id;
        
        $searchModelSenaraiAtlet  = new SenaraiAtletSearch();
        $dataProviderSenaraiAtlet = $searchModelSenaraiAtlet->search($queryPar);
        $searchModelSenaraiJurulatih  = new SenaraiJurulatihSearch();
        $dataProviderSenaraiJurulatih = $searchModelSenaraiJurulatih->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->pengurusan_jkk_jkp_program_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'searchModelSenaraiAtlet' => $searchModelSenaraiAtlet,
                'dataProviderSenaraiAtlet' => $dataProviderSenaraiAtlet,
                'searchModelSenaraiJurulatih' => $searchModelSenaraiJurulatih,
                'dataProviderSenaraiJurulatih' => $dataProviderSenaraiJurulatih,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Deletes an existing PengurusanJkkJkpProgram model.
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
     * Finds the PengurusanJkkJkpProgram model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PengurusanJkkJkpProgram the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PengurusanJkkJkpProgram::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
