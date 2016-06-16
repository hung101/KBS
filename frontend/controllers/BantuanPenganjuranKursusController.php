<?php

namespace frontend\controllers;

use Yii;
use app\models\BantuanPenganjuranKursus;
use frontend\models\BantuanPenganjuranKursusSearch;
use app\models\BantuanPenganjuranKursusPenceramah;
use frontend\models\BantuanPenganjuranKursusPenceramahSearch;
use app\models\BantuanPenganjuranKursusDisertaiPenceramah;
use frontend\models\BantuanPenganjuranKursusDisertaiPenceramahSearch;
use app\models\BantuanPenganjuranKursusOlehMsn;
use frontend\models\BantuanPenganjuranKursusOlehMsnSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

use app\models\general\Upload;
use app\models\general\GeneralVariable;

/**
 * BantuanPenganjuranKursusController implements the CRUD actions for BantuanPenganjuranKursus model.
 */
class BantuanPenganjuranKursusController extends Controller
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
     * Lists all BantuanPenganjuranKursus models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BantuanPenganjuranKursusSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single BantuanPenganjuranKursus model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $queryPar = null;
        
        $queryPar['BantuanPenganjuranKursusPenceramahSearch']['bantuan_penganjuran_kursus_id'] = $id;
        $queryPar['BantuanPenganjuranKursusDisertaiPenceramahSearch']['bantuan_penganjuran_kursus_id'] = $id;
        $queryPar['BantuanPenganjuranKursusOlehMsnSearch']['bantuan_penganjuran_kursus_id'] = $id;
        
        $searchModelBantuanPenganjuranKursusPenceramah  = new BantuanPenganjuranKursusPenceramahSearch();
        $dataProviderBantuanPenganjuranKursusPenceramah = $searchModelBantuanPenganjuranKursusPenceramah->search($queryPar);
        
        $searchModelBantuanPenganjuranKursusDisertaiPenceramah  = new BantuanPenganjuranKursusDisertaiPenceramahSearch();
        $dataProviderBantuanPenganjuranKursusDisertaiPenceramah = $searchModelBantuanPenganjuranKursusDisertaiPenceramah->search($queryPar);
        
        $searchModelBantuanPenganjuranKursusOlehMsn  = new BantuanPenganjuranKursusOlehMsnSearch();
        $dataProviderBantuanPenganjuranKursusOlehMsn = $searchModelBantuanPenganjuranKursusOlehMsn->search($queryPar);
        
        return $this->render('view', [
            'model' => $this->findModel($id),
            'searchModelBantuanPenganjuranKursusPenceramah' => $searchModelBantuanPenganjuranKursusPenceramah,
            'dataProviderBantuanPenganjuranKursusPenceramah' => $dataProviderBantuanPenganjuranKursusPenceramah,
            'searchModelBantuanPenganjuranKursusDisertaiPenceramah' => $searchModelBantuanPenganjuranKursusDisertaiPenceramah,
            'dataProviderBantuanPenganjuranKursusDisertaiPenceramah' => $dataProviderBantuanPenganjuranKursusDisertaiPenceramah,
            'searchModelBantuanPenganjuranKursusOlehMsn' => $searchModelBantuanPenganjuranKursusOlehMsn,
            'dataProviderBantuanPenganjuranKursusOlehMsn' => $dataProviderBantuanPenganjuranKursusOlehMsn,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new BantuanPenganjuranKursus model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new BantuanPenganjuranKursus();
        
        $queryPar = null;
        
        Yii::$app->session->open();
        
        if(isset(Yii::$app->session->id)){
            $queryPar['BantuanPenganjuranKursusPenceramahSearch']['session_id'] = Yii::$app->session->id;
            $queryPar['BantuanPenganjuranKursusDisertaiPenceramahSearch']['session_id'] = Yii::$app->session->id;
            $queryPar['BantuanPenganjuranKursusOlehMsnSearch']['session_id'] = Yii::$app->session->id;
        }
        
        $searchModelBantuanPenganjuranKursusPenceramah  = new BantuanPenganjuranKursusPenceramahSearch();
        $dataProviderBantuanPenganjuranKursusPenceramah = $searchModelBantuanPenganjuranKursusPenceramah->search($queryPar);
        
        $searchModelBantuanPenganjuranKursusDisertaiPenceramah  = new BantuanPenganjuranKursusDisertaiPenceramahSearch();
        $dataProviderBantuanPenganjuranKursusDisertaiPenceramah = $searchModelBantuanPenganjuranKursusDisertaiPenceramah->search($queryPar);
        
        $searchModelBantuanPenganjuranKursusOlehMsn  = new BantuanPenganjuranKursusOlehMsnSearch();
        $dataProviderBantuanPenganjuranKursusOlehMsn = $searchModelBantuanPenganjuranKursusOlehMsn->search($queryPar);
        

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if(isset(Yii::$app->session->id)){
                BantuanPenganjuranKursusPenceramah::updateAll(['bantuan_penganjuran_kursus_id' => $model->bantuan_penganjuran_kursus_id], 'session_id = "'.Yii::$app->session->id.'"');
                BantuanPenganjuranKursusPenceramah::updateAll(['session_id' => ''], 'bantuan_penganjuran_kursus_id = "'.$model->bantuan_penganjuran_kursus_id.'"');
                
                BantuanPenganjuranKursusDisertaiPenceramah::updateAll(['bantuan_penganjuran_kursus_id' => $model->bantuan_penganjuran_kursus_id], 'session_id = "'.Yii::$app->session->id.'"');
                BantuanPenganjuranKursusDisertaiPenceramah::updateAll(['session_id' => ''], 'bantuan_penganjuran_kursus_id = "'.$model->bantuan_penganjuran_kursus_id.'"');
                
                BantuanPenganjuranKursusOlehMsn::updateAll(['bantuan_penganjuran_kursus_id' => $model->bantuan_penganjuran_kursus_id], 'session_id = "'.Yii::$app->session->id.'"');
                BantuanPenganjuranKursusOlehMsn::updateAll(['session_id' => ''], 'bantuan_penganjuran_kursus_id = "'.$model->bantuan_penganjuran_kursus_id.'"');
            }
            
            return $this->redirect(['view', 'id' => $model->bantuan_penganjuran_kursus_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'searchModelBantuanPenganjuranKursusPenceramah' => $searchModelBantuanPenganjuranKursusPenceramah,
                'dataProviderBantuanPenganjuranKursusPenceramah' => $dataProviderBantuanPenganjuranKursusPenceramah,
                'searchModelBantuanPenganjuranKursusDisertaiPenceramah' => $searchModelBantuanPenganjuranKursusDisertaiPenceramah,
                'dataProviderBantuanPenganjuranKursusDisertaiPenceramah' => $dataProviderBantuanPenganjuranKursusDisertaiPenceramah,
                'searchModelBantuanPenganjuranKursusOlehMsn' => $searchModelBantuanPenganjuranKursusOlehMsn,
                'dataProviderBantuanPenganjuranKursusOlehMsn' => $dataProviderBantuanPenganjuranKursusOlehMsn,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Updates an existing BantuanPenganjuranKursus model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        
        $queryPar = null;
        
        $queryPar['BantuanPenganjuranKursusPenceramahSearch']['bantuan_penganjuran_kursus_id'] = $id;
        $queryPar['BantuanPenganjuranKursusDisertaiPenceramahSearch']['bantuan_penganjuran_kursus_id'] = $id;
        $queryPar['BantuanPenganjuranKursusOlehMsnSearch']['bantuan_penganjuran_kursus_id'] = $id;
        
        $searchModelBantuanPenganjuranKursusPenceramah  = new BantuanPenganjuranKursusPenceramahSearch();
        $dataProviderBantuanPenganjuranKursusPenceramah = $searchModelBantuanPenganjuranKursusPenceramah->search($queryPar);
        
        $searchModelBantuanPenganjuranKursusDisertaiPenceramah  = new BantuanPenganjuranKursusDisertaiPenceramahSearch();
        $dataProviderBantuanPenganjuranKursusDisertaiPenceramah = $searchModelBantuanPenganjuranKursusDisertaiPenceramah->search($queryPar);
        
        $searchModelBantuanPenganjuranKursusOlehMsn  = new BantuanPenganjuranKursusOlehMsnSearch();
        $dataProviderBantuanPenganjuranKursusOlehMsn = $searchModelBantuanPenganjuranKursusOlehMsn->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->bantuan_penganjuran_kursus_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'searchModelBantuanPenganjuranKursusPenceramah' => $searchModelBantuanPenganjuranKursusPenceramah,
                'dataProviderBantuanPenganjuranKursusPenceramah' => $dataProviderBantuanPenganjuranKursusPenceramah,
                'searchModelBantuanPenganjuranKursusDisertaiPenceramah' => $searchModelBantuanPenganjuranKursusDisertaiPenceramah,
                'dataProviderBantuanPenganjuranKursusDisertaiPenceramah' => $dataProviderBantuanPenganjuranKursusDisertaiPenceramah,
                'searchModelBantuanPenganjuranKursusOlehMsn' => $searchModelBantuanPenganjuranKursusOlehMsn,
                'dataProviderBantuanPenganjuranKursusOlehMsn' => $dataProviderBantuanPenganjuranKursusOlehMsn,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Deletes an existing BantuanPenganjuranKursus model.
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
     * Finds the BantuanPenganjuranKursus model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return BantuanPenganjuranKursus the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = BantuanPenganjuranKursus::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
