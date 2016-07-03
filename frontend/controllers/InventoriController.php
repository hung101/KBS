<?php

namespace frontend\controllers;

use Yii;
use app\models\Inventori;
use frontend\models\InventoriSearch;
use app\models\InventoriPeralatan;
use frontend\models\InventoriPeralatanSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

// table reference
use app\models\RefProgramSemasaSukanAtlet;
use app\models\RefSukan;
use app\models\RefNegeri;
use app\models\RefBandar;

/**
 * InventoriController implements the CRUD actions for Inventori model.
 */
class InventoriController extends Controller
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
     * Lists all Inventori models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new InventoriSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Inventori model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        
        $ref = RefProgramSemasaSukanAtlet::findOne(['id' => $model->program]);
        $model->program = $ref['desc'];
        
        $ref = RefSukan::findOne(['id' => $model->sukan]);
        $model->sukan = $ref['desc'];
        
        $ref = RefNegeri::findOne(['id' => $model->alamat_pembekal_negeri]);
        $model->alamat_pembekal_negeri = $ref['desc'];
        
        $ref = RefBandar::findOne(['id' => $model->alamat_pembekal_bandar]);
        $model->alamat_pembekal_bandar = $ref['desc'];
        
        $ref = RefNegeri::findOne(['id' => $model->negeri]);
        $model->negeri = $ref['desc'];
        
        $queryPar = null;
        
        $queryPar['InventoriPeralatanSearch']['inventori_id'] = $id;
        
        $searchModelInventoriPeralatan = new InventoriPeralatanSearch();
        $dataProviderInventoriPeralatan = $searchModelInventoriPeralatan->search($queryPar);
        
        return $this->render('view', [
            'model' => $model,
            'searchModelInventoriPeralatan' => $searchModelInventoriPeralatan,
            'dataProviderInventoriPeralatan' => $dataProviderInventoriPeralatan,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new Inventori model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Inventori();
        
        $queryPar = null;
        
        Yii::$app->session->open();
        
        if(isset(Yii::$app->session->id)){
            $queryPar['InventoriPeralatanSearch']['session_id'] = Yii::$app->session->id;
        }
        
        $searchModelInventoriPeralatan = new InventoriPeralatanSearch();
        $dataProviderInventoriPeralatan = $searchModelInventoriPeralatan->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            // update all the temporary session id with Pertukaran Program Pengajian Dokumen/Sebab
            if(isset(Yii::$app->session->id)){
                InventoriPeralatan::updateAll(['inventori_id' => $model->inventori_id], 'session_id = "'.Yii::$app->session->id.'"');
                InventoriPeralatan::updateAll(['session_id' => ''], 'inventori_id = "'.$model->inventori_id.'"');
                
            }
            
            return $this->redirect(['view', 'id' => $model->inventori_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'searchModelInventoriPeralatan' => $searchModelInventoriPeralatan,
                'dataProviderInventoriPeralatan' => $dataProviderInventoriPeralatan,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Updates an existing Inventori model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        
        $queryPar = null;
        
        $queryPar['InventoriPeralatanSearch']['inventori_id'] = $id;
        
        $searchModelInventoriPeralatan = new InventoriPeralatanSearch();
        $dataProviderInventoriPeralatan = $searchModelInventoriPeralatan->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->inventori_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'searchModelInventoriPeralatan' => $searchModelInventoriPeralatan,
                'dataProviderInventoriPeralatan' => $dataProviderInventoriPeralatan,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Deletes an existing Inventori model.
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
     * Finds the Inventori model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Inventori the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Inventori::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
