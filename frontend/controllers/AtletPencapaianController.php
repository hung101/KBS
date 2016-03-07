<?php

namespace frontend\controllers;

use Yii;
use app\models\AtletPencapaian;
use frontend\models\AtletPencapaianSearch;
use app\models\AtletPencapaianRekods;
use frontend\models\AtletPencapaianRekodsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Session;

use app\models\general\GeneralVariable;

// table reference
use app\models\RefPeringkatKejohananTemasya;
use app\models\RefSukan;
use app\models\RefAcara;

/**
 * AtletPencapaianController implements the CRUD actions for AtletPencapaian model.
 */
class AtletPencapaianController extends Controller
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
     * Lists all AtletPencapaian models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $request = Yii::$app->request;
        
        $queryPar = Yii::$app->request->queryParams;
        
        // Filter by atlet id
        $session = new Session;
        $session->open();

        if(isset($session['atlet_id'])){
            $queryPar['AtletPencapaianSearch']['atlet_id'] = $session['atlet_id'];
        }
        
        $session->close();
        
        $searchModel = new AtletPencapaianSearch();
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
     * Lists all AtletPendidikan models.
     * @return mixed
     */
    public function actionTab()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $searchModel = new AtletPencapaianSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('tab', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
        
        /*$searchModel = new AtletPencapaianRekodsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        $model = new AtletPencapaian();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->pendidikan_atlet_id]);
        } else {
            return $this->render('tab', [
                'model' => $model,
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }*/
    }

    /**
     * Displays a single AtletPencapaian model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $queryPar = null;
        
        $queryPar['AtletPencapaianRekodsSearch']['pencapaian_id'] = $id;
        
        $searchModelRekods = new AtletPencapaianRekodsSearch();
        $dataProviderRekods = $searchModelRekods->search($queryPar);
        
        $model = $this->findModel($id);
        
        $ref = RefPeringkatKejohananTemasya::findOne(['id' => $model->peringkat_kejohanan]);
        $model->peringkat_kejohanan = $ref['desc'];
        
        $ref = RefSukan::findOne(['id' => $model->nama_sukan]);
        $model->nama_sukan = $ref['desc'];
        
        $ref = RefAcara::findOne(['id' => $model->nama_acara]);
        $model->nama_acara = $ref['desc'];
        
        return $this->renderAjax('view', [
            'model' => $model,
            'searchModelRekods' => $searchModelRekods,
            'dataProviderRekods' => $dataProviderRekods,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new AtletPencapaian model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new AtletPencapaian();
        
        // set Atlet Id
        $session = new Session;
        $session->open();

        if(isset($session['atlet_id'])){
            $model->atlet_id = $session['atlet_id'];
        }
        
        $session->close();
        
        $queryPar = null;
        
        Yii::$app->session->open();
        
        if(isset(Yii::$app->session->id)){
            $queryPar['AtletPencapaianRekodsSearch']['session_id'] = Yii::$app->session->id;
        }
        
        $searchModelRekods  = new AtletPencapaianRekodsSearch();
        $dataProviderRekods = $searchModelRekods->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if(isset(Yii::$app->session->id)){
                AtletPencapaianRekods::updateAll(['pencapaian_id' => $model->pencapaian_id], 'session_id = "'.Yii::$app->session->id.'"');
                AtletPencapaianRekods::updateAll(['session_id' => ''], 'pencapaian_id = "'.$model->pencapaian_id.'"');
            }
            
            //return $this->redirect(['view', 'id' => $model->pencapaian_id]);
            return self::actionView($model->pencapaian_id);
        }
        
        return $this->renderAjax('create', [
            'model' => $model,
            'searchModelRekods' => $searchModelRekods,
            'dataProviderRekods' => $dataProviderRekods,
            'readonly' => false,
        ]);
    }

    /**
     * Updates an existing AtletPencapaian model.
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
        
        $queryPar['AtletPencapaianRekodsSearch']['pencapaian_id'] = $id;
        
        $searchModelRekods = new AtletPencapaianRekodsSearch();
        $dataProviderRekods = $searchModelRekods->search($queryPar);
        
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            
            //return $this->redirect(['view', 'id' => $model->pencapaian_id]);
            return self::actionView($model->pencapaian_id);
        } else {
            return $this->renderAjax('update', [
                'model' => $model,
                'searchModelRekods' => $searchModelRekods,
                'dataProviderRekods' => $dataProviderRekods,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Deletes an existing AtletPencapaian model.
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
     * Finds the AtletPencapaian model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AtletPencapaian the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AtletPencapaian::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
