<?php

namespace frontend\controllers;

use Yii;
use app\models\AtletPencapaianAnugerah;
use app\models\AtletPencapaianAnugerahSearch;
use app\models\AnugerahPencalonanAtlet;
use frontend\models\AnugerahPencalonanAtletSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Session;

use app\models\general\GeneralVariable;

// table reference
use app\models\RefKategoriAnugerah;
use app\models\RefAcara;
use app\models\RefSukan;

/**
 * AtletPencapaianAnugerahController implements the CRUD actions for AtletPencapaianAnugerah model.
 */
class AtletPencapaianAnugerahController extends Controller
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
     * Lists all AtletPencapaianAnugerah models.
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
            $queryPar['AtletPencapaianAnugerahSearch']['atlet_id'] = $session['atlet_id'];
            $queryPar['AnugerahPencalonanAtletSearch']['atlet_id'] = $session['atlet_id'];
        }
        
        $session->close();
        
        $searchModel = new AtletPencapaianAnugerahSearch();
        $dataProvider = $searchModel->search($queryPar);
        
        $searchModelAP = new AnugerahPencalonanAtletSearch();
        $dataProviderAP = $searchModelAP->search($queryPar);

        $renderContent = $this->renderAjax('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'searchModelAP' => $searchModelAP,
            'dataProviderAP' => $dataProviderAP,
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
        
        /*$searchModel = new AtletPencapaianAnugerahSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('tab', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);*/
        
        $model = new AtletPencapaianAnugerah();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->pendidikan_atlet_id]);
        } else {
            return $this->render('tab', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays a single AtletPencapaianAnugerah model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = $this->findModel($id);
        
        $ref = RefKategoriAnugerah::findOne(['id' => $model->kategori]);
        $model->kategori = $ref['desc'];
        
        $ref = RefAcara::findOne(['id' => $model->nama_acara]);
        $model->nama_acara = $ref['desc'];
        
        $ref = RefSukan::findOne(['id' => $model->sukan]);
        $model->sukan = $ref['desc'];
        
        return $this->renderAjax('view', [
            'model' => $model,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new AtletPencapaianAnugerah model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new AtletPencapaianAnugerah();
        
        // set Atlet Id
        $session = new Session;
        $session->open();

        if(isset($session['atlet_id'])){
            $model->atlet_id = $session['atlet_id'];
        }
        
        $session->close();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //return $this->redirect(['view', 'id' => $model->anugerah_id]);
            return self::actionView($model->anugerah_id);
        } else {
            return $this->renderAjax('create', [
                'model' => $model,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Updates an existing AtletPencapaianAnugerah model.
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
            //return $this->redirect(['view', 'id' => $model->anugerah_id]);
            return self::actionView($model->anugerah_id);
        } else {
            return $this->renderAjax('update', [
                'model' => $model,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Deletes an existing AtletPencapaianAnugerah model.
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
     * Finds the AtletPencapaianAnugerah model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AtletPencapaianAnugerah the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AtletPencapaianAnugerah::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
