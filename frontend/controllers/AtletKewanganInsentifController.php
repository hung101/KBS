<?php

namespace frontend\controllers;

use Yii;
use app\models\AtletKewanganInsentif;
use app\models\AtletKewanganInsentifSearch;
use app\models\PembayaranInsentif;
use frontend\models\PembayaranInsentifSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Session;

use app\models\general\GeneralVariable;

// table reference
use app\models\RefJenisInsentif;

/**
 * AtletKewanganInsentifController implements the CRUD actions for AtletKewanganInsentif model.
 */
class AtletKewanganInsentifController extends Controller
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
     * Lists all AtletKewanganInsentif models.
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
            $queryPar['AtletKewanganInsentifSearch']['atlet_id'] = $session['atlet_id'];
            $queryPar['PembayaranInsentifSearch']['atlet'] = $session['atlet_id'];
        }
        
        $session->close();
        
        $searchModel = new AtletKewanganInsentifSearch();
        $dataProvider = $searchModel->search($queryPar);
        
        $searchModelPI = new PembayaranInsentifSearch();
        $dataProviderPI = $searchModelPI->search($queryPar);

        $renderContent = $this->renderAjax('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'searchModelPI' => $searchModelPI,
            'dataProviderPI' => $dataProviderPI,
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
        
        $searchModel = new AtletKewanganInsentifSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('tab', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
        
        /*$model = new AtletKewanganInsentif();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->pendidikan_atlet_id]);
        } else {
            return $this->render('tab', [
                'model' => $model,
            ]);
        }*/
    }

    /**
     * Displays a single AtletKewanganInsentif model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = $this->findModel($id);
        
        $ref = RefJenisInsentif::findOne(['id' => $model->jenis_insentif]);
        $model->jenis_insentif = $ref['desc'];
        
        return $this->renderAjax('view', [
            'model' => $model,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new AtletKewanganInsentif model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new AtletKewanganInsentif();
        
        // set Atlet Id
        $session = new Session;
        $session->open();

        if(isset($session['atlet_id'])){
            $model->atlet_id = $session['atlet_id'];
        }
        
        $session->close();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //return $this->redirect(['view', 'id' => $model->insentif_id]);
            return self::actionView($model->insentif_id);
        } else {
            return $this->renderAjax('create', [
                'model' => $model,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Updates an existing AtletKewanganInsentif model.
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

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //return $this->redirect(['view', 'id' => $model->insentif_id]);
            return self::actionView($model->insentif_id);
        } else {
            return $this->renderAjax('update', [
                'model' => $model,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Deletes an existing AtletKewanganInsentif model.
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
     * Finds the AtletKewanganInsentif model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AtletKewanganInsentif the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AtletKewanganInsentif::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
