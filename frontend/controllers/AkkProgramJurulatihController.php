<?php

namespace frontend\controllers;

use Yii;
use app\models\AkkProgramJurulatih;
use frontend\models\AkkProgramJurulatihSearch;
use app\models\AkkProgramJurulatihPeserta;
use frontend\models\AkkProgramJurulatihPesertaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use app\models\general\GeneralVariable;
use common\models\general\GeneralFunction;

// table reference
use app\models\Jurulatih;
use app\models\RefTahapKerjayaJurulatih;

/**
 * AkkProgramJurulatihController implements the CRUD actions for AkkProgramJurulatih model.
 */
class AkkProgramJurulatihController extends Controller
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
     * Lists all AkkProgramJurulatih models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $searchModel = new AkkProgramJurulatihSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AkkProgramJurulatih model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = $this->findModel($id);
        
        $ref = Jurulatih::findOne(['jurulatih_id' => $model->jurulatih]);
        $model->jurulatih = $ref['nameAndIC'];
        
        $ref = RefTahapKerjayaJurulatih::findOne(['id' => $model->tahap]);
        $model->tahap = $ref['desc'];
        
        $queryPar = null;
        
        $queryPar['AkkProgramJurulatihPesertaSearch']['akk_program_jurulatih_id'] = $id;
        
        $searchModelAkkProgramJurulatihPeserta  = new AkkProgramJurulatihPesertaSearch();
        $dataProviderAkkProgramJurulatihPeserta = $searchModelAkkProgramJurulatihPeserta->search($queryPar);
        
        return $this->render('view', [
            'model' => $model,
            'searchModelAkkProgramJurulatihPeserta' => $searchModelAkkProgramJurulatihPeserta,
            'dataProviderAkkProgramJurulatihPeserta' => $dataProviderAkkProgramJurulatihPeserta,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new AkkProgramJurulatih model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new AkkProgramJurulatih();
        
        $queryPar = null;
        
        Yii::$app->session->open();
        
        if(isset(Yii::$app->session->id)){
            $queryPar['AkkProgramJurulatihPesertaSearch']['session_id'] = Yii::$app->session->id;
        }
        
        $searchModelAkkProgramJurulatihPeserta  = new AkkProgramJurulatihPesertaSearch();
        $dataProviderAkkProgramJurulatihPeserta = $searchModelAkkProgramJurulatihPeserta->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if(isset(Yii::$app->session->id)){
                AkkProgramJurulatihPeserta::updateAll(['akk_program_jurulatih_id' => $model->akk_program_jurulatih_id], 'session_id = "'.Yii::$app->session->id.'"');
                AkkProgramJurulatihPeserta::updateAll(['session_id' => ''], 'akk_program_jurulatih_id = "'.$model->akk_program_jurulatih_id.'"');
            }
            
            return $this->redirect(['view', 'id' => $model->akk_program_jurulatih_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'searchModelAkkProgramJurulatihPeserta' => $searchModelAkkProgramJurulatihPeserta,
                'dataProviderAkkProgramJurulatihPeserta' => $dataProviderAkkProgramJurulatihPeserta,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Updates an existing AkkProgramJurulatih model.
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
        
        $queryPar['AkkProgramJurulatihPesertaSearch']['akk_program_jurulatih_id'] = $id;
        
        $searchModelAkkProgramJurulatihPeserta  = new AkkProgramJurulatihPesertaSearch();
        $dataProviderAkkProgramJurulatihPeserta = $searchModelAkkProgramJurulatihPeserta->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->akk_program_jurulatih_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'searchModelAkkProgramJurulatihPeserta' => $searchModelAkkProgramJurulatihPeserta,
                'dataProviderAkkProgramJurulatihPeserta' => $dataProviderAkkProgramJurulatihPeserta,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Deletes an existing AkkProgramJurulatih model.
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
     * Finds the AkkProgramJurulatih model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AkkProgramJurulatih the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AkkProgramJurulatih::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
