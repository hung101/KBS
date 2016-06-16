<?php

namespace frontend\controllers;

use Yii;
use app\models\AnugerahPencalonanPasukan;
use frontend\models\AnugerahPencalonanPasukanSearch;
use app\models\AnugerahPencalonanPasukanPemain;
use frontend\models\AnugerahPencalonanPasukanPemainSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use app\models\general\GeneralVariable;
use app\models\general\GeneralLabel;

/**
 * AnugerahPencalonanPasukanController implements the CRUD actions for AnugerahPencalonanPasukan model.
 */
class AnugerahPencalonanPasukanController extends Controller
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
     * Lists all AnugerahPencalonanPasukan models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AnugerahPencalonanPasukanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AnugerahPencalonanPasukan model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $queryPar = null;
        
        $queryPar['AnugerahPencalonanPasukanPemainSearch']['anugerah_pencalonan_pasukan_id'] = $id;
        
        $searchModelAnugerahPencalonanPasukanPemain  = new AnugerahPencalonanPasukanPemainSearch();
        $dataProviderAnugerahPencalonanPasukanPemain = $searchModelAnugerahPencalonanPasukanPemain->search($queryPar);
        
        return $this->render('view', [
            'model' => $this->findModel($id),
            'searchModelAnugerahPencalonanPasukanPemain' => $searchModelAnugerahPencalonanPasukanPemain,
            'dataProviderAnugerahPencalonanPasukanPemain' => $dataProviderAnugerahPencalonanPasukanPemain,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new AnugerahPencalonanPasukan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AnugerahPencalonanPasukan();
        
        $queryPar = null;
        
        Yii::$app->session->open();
        
        if(isset(Yii::$app->session->id)){
            $queryPar['AnugerahPencalonanPasukanPemainSearch']['session_id'] = Yii::$app->session->id;
        }
        
        $searchModelAnugerahPencalonanPasukanPemain  = new AnugerahPencalonanPasukanPemainSearch();
        $dataProviderAnugerahPencalonanPasukanPemain = $searchModelAnugerahPencalonanPasukanPemain->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if(isset(Yii::$app->session->id)){
                AnugerahPencalonanPasukanPemain::updateAll(['anugerah_pencalonan_pasukan_id' => $model->anugerah_pencalonan_pasukan_id], 'session_id = "'.Yii::$app->session->id.'"');
                AnugerahPencalonanPasukanPemain::updateAll(['session_id' => ''], 'anugerah_pencalonan_pasukan_id = "'.$model->anugerah_pencalonan_pasukan_id.'"');
            }
            
            return $this->redirect(['view', 'id' => $model->anugerah_pencalonan_pasukan_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'searchModelAnugerahPencalonanPasukanPemain' => $searchModelAnugerahPencalonanPasukanPemain,
                'dataProviderAnugerahPencalonanPasukanPemain' => $dataProviderAnugerahPencalonanPasukanPemain,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Updates an existing AnugerahPencalonanPasukan model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        
        $queryPar = null;
        
        $queryPar['AnugerahPencalonanPasukanPemainSearch']['anugerah_pencalonan_pasukan_id'] = $id;
        
        $searchModelAnugerahPencalonanPasukanPemain  = new AnugerahPencalonanPasukanPemainSearch();
        $dataProviderAnugerahPencalonanPasukanPemain = $searchModelAnugerahPencalonanPasukanPemain->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->anugerah_pencalonan_pasukan_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'searchModelAnugerahPencalonanPasukanPemain' => $searchModelAnugerahPencalonanPasukanPemain,
                'dataProviderAnugerahPencalonanPasukanPemain' => $dataProviderAnugerahPencalonanPasukanPemain,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Deletes an existing AnugerahPencalonanPasukan model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the AnugerahPencalonanPasukan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AnugerahPencalonanPasukan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AnugerahPencalonanPasukan::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
