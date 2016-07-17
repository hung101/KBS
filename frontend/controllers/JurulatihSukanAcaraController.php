<?php

namespace frontend\controllers;

use Yii;
use app\models\JurulatihSukanAcara;
use frontend\models\JurulatihSukanAcaraSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use app\models\general\GeneralVariable;

// table reference
use app\models\RefAcara;

/**
 * JurulatihSukanAcaraController implements the CRUD actions for JurulatihSukanAcara model.
 */
class JurulatihSukanAcaraController extends Controller
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
     * Lists all JurulatihSukanAcara models.
     * @return mixed
     */
    public function actionIndex($jurulatih_sukan_id)
    {
         if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $queryPar = null;
        
        $queryPar = Yii::$app->request->queryParams;
        
        if($jurulatih_sukan_id != ''){
            $queryPar['JurulatihSukanAcaraSearch']['jurulatih_sukan_id'] = $jurulatih_sukan_id;
        } else {
            if(isset(Yii::$app->session->id)){
                $queryPar['JurulatihSukanAcaraSearch']['session_id'] = Yii::$app->session->id;
            }
        }
        
        $searchModel = new JurulatihSukanAcaraSearch();
        $dataProvider = $searchModel->search($queryPar);

        return $this->renderAjax('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single JurulatihSukanAcara model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
         if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = $this->findModel($id);
        
        $ref = RefAcara::findOne(['id' => $model->acara]);
        $model->acara = $ref['desc'];
        
        return $this->renderAjax('view', [
            'model' => $model,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new JurulatihSukanAcara model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($jurulatih_sukan_id)
    {
         if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new JurulatihSukanAcara();
        
        Yii::$app->session->open();
        
        if($jurulatih_sukan_id != ''){
            $model->jurulatih_sukan_id = $jurulatih_sukan_id;
        } else {
            if(isset(Yii::$app->session->id)){
                $model->session_id = Yii::$app->session->id;
            }
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //return $this->redirect(['view', 'id' => $model->jurulatih_sukan_acara_id]);
            return "1/pipe?" . self::actionIndex($jurulatih_sukan_id);
        } else {
            return $this->renderAjax('create', [
                'model' => $model,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Updates an existing JurulatihSukanAcara model.
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
        
        $jurulatih_sukan_id = '';
        
        if(isset($model->jurulatih_sukan_id)){
            $jurulatih_sukan_id = $model->jurulatih_sukan_id;
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //return $this->redirect(['view', 'id' => $model->jurulatih_sukan_acara_id]);
            return "1/pipe?" . self::actionIndex($jurulatih_sukan_id);
        } else {
            return $this->renderAjax('update', [
                'model' => $model,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Deletes an existing JurulatihSukanAcara model.
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
        
        $jurulatih_sukan_id = '';
        
        if(isset($model->jurulatih_sukan_id)){
            $jurulatih_sukan_id = $model->jurulatih_sukan_id;
        }

        //return $this->redirect(['index']);
        return "1/pipe?" . self::actionIndex($jurulatih_sukan_id);
    }

    /**
     * Finds the JurulatihSukanAcara model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return JurulatihSukanAcara the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = JurulatihSukanAcara::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
