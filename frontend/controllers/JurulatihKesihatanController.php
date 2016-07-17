<?php

namespace frontend\controllers;

use Yii;
use app\models\JurulatihKesihatan;
use frontend\models\JurulatihKesihatanSearch;
use app\models\JurulatihKesihatanMasalah;
use frontend\models\JurulatihKesihatanMasalahSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Session;

use app\models\general\GeneralVariable;

// table reference
use app\models\RefMasalahKesihatan;

/**
 * JurulatihKesihatanController implements the CRUD actions for JurulatihKesihatan model.
 */
class JurulatihKesihatanController extends Controller
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
     * Lists all JurulatihKesihatan models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $request = Yii::$app->request;
        
        $queryPar = Yii::$app->request->queryParams;
        
        // Filter by jurulatih id
        $session = new Session;
        $session->open();

        if(isset($session['jurulatih_id'])){
            $queryPar['JurulatihKesihatanSearch']['jurulatih_id'] = $session['jurulatih_id'];
        }
        
        $session->close();
        
        $searchModel = new JurulatihKesihatanSearch();
        $dataProvider = $searchModel->search($queryPar);

        $renderContent = $this->renderAjax('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);

        if($request->get('typeJson') != NULL){
            return json_encode($renderContent);
        }else {
            return $renderContent;
        }
    }

    /**
     * Displays a single JurulatihKesihatan model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $queryPar = null;
        
        $queryPar['JurulatihKesihatanMasalahSearch']['jurulatih_kesihatan_id'] = $id;
        
        $searchModelMasalah = new JurulatihKesihatanMasalahSearch();
        $dataProviderMasalah = $searchModelMasalah->search($queryPar);
        
        $model = $this->findModel($id);
        
        $ref = RefMasalahKesihatan::findOne(['id' => $model->masalah_kesihatan]);
        $model->masalah_kesihatan = $ref['desc'];
        
        return $this->renderAjax('view', [
            'model' => $model,
            'searchModelMasalah' => $searchModelMasalah,
            'dataProviderMasalah' => $dataProviderMasalah,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new JurulatihKesihatan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new JurulatihKesihatan();
        
        // set Jurulatih Id
        $session = new Session;
        $session->open();

        if(isset($session['jurulatih_id'])){
            $model->jurulatih_id = $session['jurulatih_id'];
        }
        
        $session->close();
        
        $queryPar = null;
        
        Yii::$app->session->open();
        
        if(isset(Yii::$app->session->id)){
            $queryPar['JurulatihKesihatanMasalahSearch']['session_id'] = Yii::$app->session->id;
        }
        
        $searchModelMasalah = new JurulatihKesihatanMasalahSearch();
        $dataProviderMasalah = $searchModelMasalah->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if(isset(Yii::$app->session->id)){
                JurulatihKesihatanMasalah::updateAll(['jurulatih_kesihatan_id' => $model->jurulatih_kesihatan_id], 'session_id = "'.Yii::$app->session->id.'"');
                JurulatihKesihatanMasalah::updateAll(['session_id' => ''], 'jurulatih_kesihatan_id = "'.$model->jurulatih_kesihatan_id.'"');
            }
            
            //return $this->redirect(['view', 'id' => $model->jurulatih_kesihatan_id]);
            return self::actionView($model->jurulatih_kesihatan_id);
        } else {
            return $this->renderAjax('create', [
                'model' => $model,
                'searchModelMasalah' => $searchModelMasalah,
                'dataProviderMasalah' => $dataProviderMasalah,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Updates an existing JurulatihKesihatan model.
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
        
        $queryPar['JurulatihKesihatanMasalahSearch']['jurulatih_kesihatan_id'] = $id;
        
        $searchModelMasalah = new JurulatihKesihatanMasalahSearch();
        $dataProviderMasalah = $searchModelMasalah->search($queryPar);
        
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //return $this->redirect(['view', 'id' => $model->jurulatih_kesihatan_id]);
            return self::actionView($model->jurulatih_kesihatan_id);
        } else {
            return $this->renderAjax('update', [
                'model' => $model,
                'searchModelMasalah' => $searchModelMasalah,
                'dataProviderMasalah' => $dataProviderMasalah,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Deletes an existing JurulatihKesihatan model.
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
        return self::actionIndex();
    }

    /**
     * Finds the JurulatihKesihatan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return JurulatihKesihatan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = JurulatihKesihatan::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
