<?php

namespace frontend\controllers;

use Yii;
use app\models\BspKedudukanKewanganPenjamin;
use frontend\models\BspKedudukanKewanganPenjaminSearch;
use app\models\BspKedudukanKewanganPenjaminJenisHarta;
use frontend\models\BspKedudukanKewanganPenjaminJenisHartaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use app\models\general\GeneralVariable;

/**
 * BspKedudukanKewanganPenjaminController implements the CRUD actions for BspKedudukanKewanganPenjamin model.
 */
class BspKedudukanKewanganPenjaminController extends Controller
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
     * Lists all BspKedudukanKewanganPenjamin models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $searchModel = new BspKedudukanKewanganPenjaminSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single BspKedudukanKewanganPenjamin model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $queryPar = null;
        
        $queryPar['BspKedudukanKewanganPenjaminJenisHartaSearch']['bsp_kedudukan_kewangan_penjamin_id'] = $id;
        
        $searchModelBspKedudukanKewanganPenjaminJenisHarta = new BspKedudukanKewanganPenjaminJenisHartaSearch();
        $dataProviderBspKedudukanKewanganPenjaminJenisHarta = $searchModelBspKedudukanKewanganPenjaminJenisHarta->search($queryPar);
        
        return $this->render('view', [
            'model' => $this->findModel($id),
            'searchModelBspKedudukanKewanganPenjaminJenisHarta' => $searchModelBspKedudukanKewanganPenjaminJenisHarta,
            'dataProviderBspKedudukanKewanganPenjaminJenisHarta' => $dataProviderBspKedudukanKewanganPenjaminJenisHarta,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new BspKedudukanKewanganPenjamin model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($bsp_penjamin_id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $queryPar = null;
        
        Yii::$app->session->open();
        
        if(isset(Yii::$app->session->id)){
            $queryPar['BspKedudukanKewanganPenjaminJenisHartaSearch']['session_id'] = Yii::$app->session->id;
        }
        
        $searchModelBspKedudukanKewanganPenjaminJenisHarta = new BspKedudukanKewanganPenjaminJenisHartaSearch();
        $dataProviderBspKedudukanKewanganPenjaminJenisHarta = $searchModelBspKedudukanKewanganPenjaminJenisHarta->search($queryPar);
        
        $model = new BspKedudukanKewanganPenjamin();
        
        $model->bsp_penjamin_id = $bsp_penjamin_id;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            // update all the temporary session id with Kedudukan Kewangan Penjamin
            if(isset(Yii::$app->session->id)){
                BspKedudukanKewanganPenjaminJenisHarta::updateAll(['bsp_kedudukan_kewangan_penjamin_id' => $model->bsp_kedudukan_kewangan_penjamin_id], 'session_id = "'.Yii::$app->session->id.'"');
                BspKedudukanKewanganPenjaminJenisHarta::updateAll(['session_id' => ''], 'bsp_kedudukan_kewangan_penjamin_id = "'.$model->bsp_kedudukan_kewangan_penjamin_id.'"');
            }
            
            return $this->redirect(['view', 'id' => $model->bsp_kedudukan_kewangan_penjamin_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'searchModelBspKedudukanKewanganPenjaminJenisHarta' => $searchModelBspKedudukanKewanganPenjaminJenisHarta,
                'dataProviderBspKedudukanKewanganPenjaminJenisHarta' => $dataProviderBspKedudukanKewanganPenjaminJenisHarta,
                'readonly' => false,
            ]);
        }
    }
    
    /**
     * redirect Creates/Update a new BspPenjamin model.
     * If record exist redirect update else redirect create.
     * @return mixed
     */
    public function actionLoad($bsp_penjamin_id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        if (($model = BspKedudukanKewanganPenjamin::findOne(['bsp_penjamin_id' => $bsp_penjamin_id])) !== null) {
            return self::actionUpdate($model->bsp_kedudukan_kewangan_penjamin_id);
        } else {
            return self::actionCreate($bsp_penjamin_id);
        }
    }

    /**
     * Updates an existing BspKedudukanKewanganPenjamin model.
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
        
        $queryPar['BspKedudukanKewanganPenjaminJenisHartaSearch']['bsp_kedudukan_kewangan_penjamin_id'] = $id;
        
        $searchModelBspKedudukanKewanganPenjaminJenisHarta = new BspKedudukanKewanganPenjaminJenisHartaSearch();
        $dataProviderBspKedudukanKewanganPenjaminJenisHarta = $searchModelBspKedudukanKewanganPenjaminJenisHarta->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->bsp_kedudukan_kewangan_penjamin_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'searchModelBspKedudukanKewanganPenjaminJenisHarta' => $searchModelBspKedudukanKewanganPenjaminJenisHarta,
                'dataProviderBspKedudukanKewanganPenjaminJenisHarta' => $dataProviderBspKedudukanKewanganPenjaminJenisHarta,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Deletes an existing BspKedudukanKewanganPenjamin model.
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
     * Finds the BspKedudukanKewanganPenjamin model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return BspKedudukanKewanganPenjamin the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = BspKedudukanKewanganPenjamin::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
