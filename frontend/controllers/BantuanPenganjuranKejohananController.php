<?php

namespace frontend\controllers;

use Yii;
use app\models\BantuanPenganjuranKejohanan;
use frontend\models\BantuanPenganjuranKejohananSearch;
use app\models\BantuanPenganjuranKejohananKewangan;
use frontend\models\BantuanPenganjuranKejohananKewanganSearch;
use app\models\BantuanPenganjuranKejohananBayaran;
use frontend\models\BantuanPenganjuranKejohananBayaranSearch;
use app\models\BantuanPenganjuranKejohananElemen;
use frontend\models\BantuanPenganjuranKejohananElemenSearch;
use app\models\BantuanPenganjuranKejohananDianjurkan;
use frontend\models\BantuanPenganjuranKejohananDianjurkanSearch;
use app\models\BantuanPenganjuranKejohananOlehMsn;
use frontend\models\BantuanPenganjuranKejohananOlehMsnSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

use app\models\general\Upload;
use app\models\general\GeneralVariable;

/**
 * BantuanPenganjuranKejohananController implements the CRUD actions for BantuanPenganjuranKejohanan model.
 */
class BantuanPenganjuranKejohananController extends Controller
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
     * Lists all BantuanPenganjuranKejohanan models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BantuanPenganjuranKejohananSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single BantuanPenganjuranKejohanan model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $queryPar = null;
        
        $queryPar['BantuanPenganjuranKejohananKewanganSearch']['bantuan_penganjuran_kejohanan_id'] = $id;
        $queryPar['BantuanPenganjuranKejohananBayaranSearch']['bantuan_penganjuran_kejohanan_id'] = $id;
        $queryPar['BantuanPenganjuranKejohananElemenSearch']['bantuan_penganjuran_kejohanan_id'] = $id;
        $queryPar['BantuanPenganjuranKejohananDianjurkanSearch']['bantuan_penganjuran_kejohanan_id'] = $id;
        $queryPar['BantuanPenganjuranKejohananOlehMsnSearch']['bantuan_penganjuran_kejohanan_id'] = $id;
        
        $searchModelBantuanPenganjuranKejohananKewangan  = new BantuanPenganjuranKejohananKewanganSearch();
        $dataProviderBantuanPenganjuranKejohananKewangan = $searchModelBantuanPenganjuranKejohananKewangan->search($queryPar);
        
        $searchModelBantuanPenganjuranKejohananBayaran  = new BantuanPenganjuranKejohananBayaranSearch();
        $dataProviderBantuanPenganjuranKejohananBayaran = $searchModelBantuanPenganjuranKejohananBayaran->search($queryPar);
        
        $searchModelBantuanPenganjuranKejohananElemen  = new BantuanPenganjuranKejohananElemenSearch();
        $dataProviderBantuanPenganjuranKejohananElemen = $searchModelBantuanPenganjuranKejohananElemen->search($queryPar);
        
        $searchModelBantuanPenganjuranKejohananDianjurkan = new BantuanPenganjuranKejohananDianjurkanSearch();
        $dataProviderBantuanPenganjuranKejohananDianjurkan = $searchModelBantuanPenganjuranKejohananDianjurkan->search($queryPar);
        
        $searchModelBantuanPenganjuranKejohananOlehMsn = new BantuanPenganjuranKejohananOlehMsnSearch();
        $dataProviderBantuanPenganjuranKejohananOlehMsn = $searchModelBantuanPenganjuranKejohananOlehMsn->search($queryPar);
        
        return $this->render('view', [
            'model' => $this->findModel($id),
            'searchModelBantuanPenganjuranKejohananKewangan' => $searchModelBantuanPenganjuranKejohananKewangan,
            'dataProviderBantuanPenganjuranKejohananKewangan' => $dataProviderBantuanPenganjuranKejohananKewangan,
            'searchModelBantuanPenganjuranKejohananBayaran' => $searchModelBantuanPenganjuranKejohananBayaran,
            'dataProviderBantuanPenganjuranKejohananBayaran' => $dataProviderBantuanPenganjuranKejohananBayaran,
            'searchModelBantuanPenganjuranKejohananElemen' => $searchModelBantuanPenganjuranKejohananElemen,
            'dataProviderBantuanPenganjuranKejohananElemen' => $dataProviderBantuanPenganjuranKejohananElemen,
            'searchModelBantuanPenganjuranKejohananDianjurkan' => $searchModelBantuanPenganjuranKejohananDianjurkan,
            'dataProviderBantuanPenganjuranKejohananDianjurkan' => $dataProviderBantuanPenganjuranKejohananDianjurkan,
            'searchModelBantuanPenganjuranKejohananOlehMsn' => $searchModelBantuanPenganjuranKejohananOlehMsn,
            'dataProviderBantuanPenganjuranKejohananOlehMsn' => $dataProviderBantuanPenganjuranKejohananOlehMsn,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new BantuanPenganjuranKejohanan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new BantuanPenganjuranKejohanan();
        
        $queryPar = null;
        
        Yii::$app->session->open();
        
        if(isset(Yii::$app->session->id)){
            $queryPar['BantuanPenganjuranKejohananKewanganSearch']['session_id'] = Yii::$app->session->id;
            $queryPar['BantuanPenganjuranKejohananBayaranSearch']['session_id'] = Yii::$app->session->id;
            $queryPar['BantuanPenganjuranKejohananElemenSearch']['session_id'] = Yii::$app->session->id;
            $queryPar['BantuanPenganjuranKejohananDianjurkanSearch']['session_id'] = Yii::$app->session->id;
            $queryPar['BantuanPenganjuranKejohananOlehMsnSearch']['session_id'] = Yii::$app->session->id;
        }
        
        $searchModelBantuanPenganjuranKejohananKewangan  = new BantuanPenganjuranKejohananKewanganSearch();
        $dataProviderBantuanPenganjuranKejohananKewangan = $searchModelBantuanPenganjuranKejohananKewangan->search($queryPar);
        
        $searchModelBantuanPenganjuranKejohananBayaran  = new BantuanPenganjuranKejohananBayaranSearch();
        $dataProviderBantuanPenganjuranKejohananBayaran = $searchModelBantuanPenganjuranKejohananBayaran->search($queryPar);
        
        $searchModelBantuanPenganjuranKejohananElemen  = new BantuanPenganjuranKejohananElemenSearch();
        $dataProviderBantuanPenganjuranKejohananElemen = $searchModelBantuanPenganjuranKejohananElemen->search($queryPar);
        
        $searchModelBantuanPenganjuranKejohananDianjurkan = new BantuanPenganjuranKejohananDianjurkanSearch();
        $dataProviderBantuanPenganjuranKejohananDianjurkan = $searchModelBantuanPenganjuranKejohananDianjurkan->search($queryPar);
        
        $searchModelBantuanPenganjuranKejohananOlehMsn = new BantuanPenganjuranKejohananOlehMsnSearch();
        $dataProviderBantuanPenganjuranKejohananOlehMsn = $searchModelBantuanPenganjuranKejohananOlehMsn->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if(isset(Yii::$app->session->id)){
                BantuanPenganjuranKejohananKewangan::updateAll(['bantuan_penganjuran_kursus_id' => $model->bantuan_penganjuran_kursus_id], 'session_id = "'.Yii::$app->session->id.'"');
                BantuanPenganjuranKejohananKewangan::updateAll(['session_id' => ''], 'bantuan_penganjuran_kursus_id = "'.$model->bantuan_penganjuran_kursus_id.'"');
                
                BantuanPenganjuranKejohananBayaran::updateAll(['bantuan_penganjuran_kursus_id' => $model->bantuan_penganjuran_kursus_id], 'session_id = "'.Yii::$app->session->id.'"');
                BantuanPenganjuranKejohananBayaran::updateAll(['session_id' => ''], 'bantuan_penganjuran_kursus_id = "'.$model->bantuan_penganjuran_kursus_id.'"');
                
                BantuanPenganjuranKejohananElemen::updateAll(['bantuan_penganjuran_kursus_id' => $model->bantuan_penganjuran_kursus_id], 'session_id = "'.Yii::$app->session->id.'"');
                BantuanPenganjuranKejohananElemen::updateAll(['session_id' => ''], 'bantuan_penganjuran_kursus_id = "'.$model->bantuan_penganjuran_kursus_id.'"');
                
                BantuanPenganjuranKejohananDianjurkan::updateAll(['bantuan_penganjuran_kursus_id' => $model->bantuan_penganjuran_kursus_id], 'session_id = "'.Yii::$app->session->id.'"');
                BantuanPenganjuranKejohananDianjurkan::updateAll(['session_id' => ''], 'bantuan_penganjuran_kursus_id = "'.$model->bantuan_penganjuran_kursus_id.'"');
                
                BantuanPenganjuranKejohananOlehMsn::updateAll(['bantuan_penganjuran_kursus_id' => $model->bantuan_penganjuran_kursus_id], 'session_id = "'.Yii::$app->session->id.'"');
                BantuanPenganjuranKejohananOlehMsn::updateAll(['session_id' => ''], 'bantuan_penganjuran_kursus_id = "'.$model->bantuan_penganjuran_kursus_id.'"');
            }
            
            return $this->redirect(['view', 'id' => $model->bantuan_penganjuran_kejohanan_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'searchModelBantuanPenganjuranKejohananKewangan' => $searchModelBantuanPenganjuranKejohananKewangan,
                'dataProviderBantuanPenganjuranKejohananKewangan' => $dataProviderBantuanPenganjuranKejohananKewangan,
                'searchModelBantuanPenganjuranKejohananBayaran' => $searchModelBantuanPenganjuranKejohananBayaran,
                'dataProviderBantuanPenganjuranKejohananBayaran' => $dataProviderBantuanPenganjuranKejohananBayaran,
                'searchModelBantuanPenganjuranKejohananElemen' => $searchModelBantuanPenganjuranKejohananElemen,
                'dataProviderBantuanPenganjuranKejohananElemen' => $dataProviderBantuanPenganjuranKejohananElemen,
                'searchModelBantuanPenganjuranKejohananDianjurkan' => $searchModelBantuanPenganjuranKejohananDianjurkan,
                'dataProviderBantuanPenganjuranKejohananDianjurkan' => $dataProviderBantuanPenganjuranKejohananDianjurkan,
                'searchModelBantuanPenganjuranKejohananOlehMsn' => $searchModelBantuanPenganjuranKejohananOlehMsn,
                'dataProviderBantuanPenganjuranKejohananOlehMsn' => $dataProviderBantuanPenganjuranKejohananOlehMsn,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Updates an existing BantuanPenganjuranKejohanan model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->bantuan_penganjuran_kejohanan_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Deletes an existing BantuanPenganjuranKejohanan model.
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
     * Finds the BantuanPenganjuranKejohanan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return BantuanPenganjuranKejohanan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = BantuanPenganjuranKejohanan::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
