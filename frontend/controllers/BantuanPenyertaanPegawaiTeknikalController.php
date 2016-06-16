<?php

namespace frontend\controllers;

use Yii;
use app\models\BantuanPenyertaanPegawaiTeknikal;
use frontend\models\BantuanPenyertaanPegawaiTeknikalSearch;
use app\models\BantuanPenyertaanPegawaiTeknikalDicadangkan;
use frontend\models\BantuanPenyertaanPegawaiTeknikalDicadangkanSearch;
use app\models\BantuanPenyertaanPegawaiTeknikalDisertai;
use frontend\models\BantuanPenyertaanPegawaiTeknikalDisertaiSearch;
use app\models\BantuanPenyertaanPegawaiTeknikalOlehMsn;
use frontend\models\BantuanPenyertaanPegawaiTeknikalOlehMsnSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

use app\models\general\Upload;
use app\models\general\GeneralVariable;

/**
 * BantuanPenyertaanPegawaiTeknikalController implements the CRUD actions for BantuanPenyertaanPegawaiTeknikal model.
 */
class BantuanPenyertaanPegawaiTeknikalController extends Controller
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
     * Lists all BantuanPenyertaanPegawaiTeknikal models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BantuanPenyertaanPegawaiTeknikalSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single BantuanPenyertaanPegawaiTeknikal model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        
        $queryPar = null;
        
        $queryPar['BantuanPenyertaanPegawaiTeknikalDicadangkanSearch']['bantuan_penyertaan_pegawai_teknikal_id'] = $id;
        $queryPar['BantuanPenyertaanPegawaiTeknikalDisertaiSearch']['bantuan_penyertaan_pegawai_teknikal_id'] = $id;
        $queryPar['BantuanPenyertaanPegawaiTeknikalOlehMsnSearch']['bantuan_penyertaan_pegawai_teknikal_id'] = $id;
        
        $searchModelBantuanPenyertaanPegawaiTeknikalDicadangkan  = new BantuanPenyertaanPegawaiTeknikalDicadangkanSearch();
        $dataProviderBantuanPenyertaanPegawaiTeknikalDicadangkan = $searchModelBantuanPenyertaanPegawaiTeknikalDicadangkan->search($queryPar);
        
        $searchModelBantuanPenyertaanPegawaiTeknikalDisertai  = new BantuanPenyertaanPegawaiTeknikalDisertaiSearch();
        $dataProviderBantuanPenyertaanPegawaiTeknikalDisertai = $searchModelBantuanPenyertaanPegawaiTeknikalDisertai->search($queryPar);
        
        $searchModelBantuanPenyertaanPegawaiTeknikalOlehMsn  = new BantuanPenyertaanPegawaiTeknikalOlehMsnSearch();
        $dataProviderBantuanPenyertaanPegawaiTeknikalOlehMsn = $searchModelBantuanPenyertaanPegawaiTeknikalOlehMsn->search($queryPar);
        
        return $this->render('view', [
            'model' => $this->findModel($id),
            'searchModelBantuanPenyertaanPegawaiTeknikalDicadangkan' => $searchModelBantuanPenyertaanPegawaiTeknikalDicadangkan,
            'dataProviderBantuanPenyertaanPegawaiTeknikalDicadangkan' => $dataProviderBantuanPenyertaanPegawaiTeknikalDicadangkan,
            'searchModelBantuanPenyertaanPegawaiTeknikalDisertai' => $searchModelBantuanPenyertaanPegawaiTeknikalDisertai,
            'dataProviderBantuanPenyertaanPegawaiTeknikalDisertai' => $dataProviderBantuanPenyertaanPegawaiTeknikalDisertai,
            'searchModelBantuanPenyertaanPegawaiTeknikalOlehMsn' => $searchModelBantuanPenyertaanPegawaiTeknikalOlehMsn,
            'dataProviderBantuanPenyertaanPegawaiTeknikalOlehMsn' => $dataProviderBantuanPenyertaanPegawaiTeknikalOlehMsn,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new BantuanPenyertaanPegawaiTeknikal model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new BantuanPenyertaanPegawaiTeknikal();
        
        $queryPar = null;
        
        Yii::$app->session->open();
        
        if(isset(Yii::$app->session->id)){
            $queryPar['BantuanPenyertaanPegawaiTeknikalDicadangkanSearch']['session_id'] = Yii::$app->session->id;
            $queryPar['BantuanPenyertaanPegawaiTeknikalDisertaiSearch']['session_id'] = Yii::$app->session->id;
            $queryPar['BantuanPenyertaanPegawaiTeknikalOlehMsnSearch']['session_id'] = Yii::$app->session->id;
        }
        
        $searchModelBantuanPenyertaanPegawaiTeknikalDicadangkan  = new BantuanPenyertaanPegawaiTeknikalDicadangkanSearch();
        $dataProviderBantuanPenyertaanPegawaiTeknikalDicadangkan = $searchModelBantuanPenyertaanPegawaiTeknikalDicadangkan->search($queryPar);
        
        $searchModelBantuanPenyertaanPegawaiTeknikalDisertai  = new BantuanPenyertaanPegawaiTeknikalDisertaiSearch();
        $dataProviderBantuanPenyertaanPegawaiTeknikalDisertai = $searchModelBantuanPenyertaanPegawaiTeknikalDisertai->search($queryPar);
        
        $searchModelBantuanPenyertaanPegawaiTeknikalOlehMsn  = new BantuanPenyertaanPegawaiTeknikalOlehMsnSearch();
        $dataProviderBantuanPenyertaanPegawaiTeknikalOlehMsn = $searchModelBantuanPenyertaanPegawaiTeknikalOlehMsn->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if(isset(Yii::$app->session->id)){
                BantuanPenyertaanPegawaiTeknikalDicadangkan::updateAll(['bantuan_penyertaan_pegawai_teknikal_id' => $model->bantuan_penyertaan_pegawai_teknikal_id], 'session_id = "'.Yii::$app->session->id.'"');
                BantuanPenyertaanPegawaiTeknikalDicadangkan::updateAll(['session_id' => ''], 'bantuan_penyertaan_pegawai_teknikal_id = "'.$model->bantuan_penyertaan_pegawai_teknikal_id.'"');
                
                BantuanPenyertaanPegawaiTeknikalDisertai::updateAll(['bantuan_penyertaan_pegawai_teknikal_id' => $model->bantuan_penyertaan_pegawai_teknikal_id], 'session_id = "'.Yii::$app->session->id.'"');
                BantuanPenyertaanPegawaiTeknikalDisertai::updateAll(['session_id' => ''], 'bantuan_penyertaan_pegawai_teknikal_id = "'.$model->bantuan_penyertaan_pegawai_teknikal_id.'"');
                
                BantuanPenyertaanPegawaiTeknikalOlehMsn::updateAll(['bantuan_penyertaan_pegawai_teknikal_id' => $model->bantuan_penyertaan_pegawai_teknikal_id], 'session_id = "'.Yii::$app->session->id.'"');
                BantuanPenyertaanPegawaiTeknikalOlehMsn::updateAll(['session_id' => ''], 'bantuan_penyertaan_pegawai_teknikal_id = "'.$model->bantuan_penyertaan_pegawai_teknikal_id.'"');
            }
            
            return $this->redirect(['view', 'id' => $model->bantuan_penyertaan_pegawai_teknikal_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'searchModelBantuanPenyertaanPegawaiTeknikalDicadangkan' => $searchModelBantuanPenyertaanPegawaiTeknikalDicadangkan,
                'dataProviderBantuanPenyertaanPegawaiTeknikalDicadangkan' => $dataProviderBantuanPenyertaanPegawaiTeknikalDicadangkan,
                'searchModelBantuanPenyertaanPegawaiTeknikalDisertai' => $searchModelBantuanPenyertaanPegawaiTeknikalDisertai,
                'dataProviderBantuanPenyertaanPegawaiTeknikalDisertai' => $dataProviderBantuanPenyertaanPegawaiTeknikalDisertai,
                'searchModelBantuanPenyertaanPegawaiTeknikalOlehMsn' => $searchModelBantuanPenyertaanPegawaiTeknikalOlehMsn,
                'dataProviderBantuanPenyertaanPegawaiTeknikalOlehMsn' => $dataProviderBantuanPenyertaanPegawaiTeknikalOlehMsn,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Updates an existing BantuanPenyertaanPegawaiTeknikal model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        
        $queryPar = null;
        
        $queryPar['BantuanPenyertaanPegawaiTeknikalDicadangkanSearch']['bantuan_penyertaan_pegawai_teknikal_id'] = $id;
        $queryPar['BantuanPenyertaanPegawaiTeknikalDisertaiSearch']['bantuan_penyertaan_pegawai_teknikal_id'] = $id;
        $queryPar['BantuanPenyertaanPegawaiTeknikalOlehMsnSearch']['bantuan_penyertaan_pegawai_teknikal_id'] = $id;
        
        $searchModelBantuanPenyertaanPegawaiTeknikalDicadangkan  = new BantuanPenyertaanPegawaiTeknikalDicadangkanSearch();
        $dataProviderBantuanPenyertaanPegawaiTeknikalDicadangkan = $searchModelBantuanPenyertaanPegawaiTeknikalDicadangkan->search($queryPar);
        
        $searchModelBantuanPenyertaanPegawaiTeknikalDisertai  = new BantuanPenyertaanPegawaiTeknikalDisertaiSearch();
        $dataProviderBantuanPenyertaanPegawaiTeknikalDisertai = $searchModelBantuanPenyertaanPegawaiTeknikalDisertai->search($queryPar);
        
        $searchModelBantuanPenyertaanPegawaiTeknikalOlehMsn  = new BantuanPenyertaanPegawaiTeknikalOlehMsnSearch();
        $dataProviderBantuanPenyertaanPegawaiTeknikalOlehMsn = $searchModelBantuanPenyertaanPegawaiTeknikalOlehMsn->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->bantuan_penyertaan_pegawai_teknikal_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'searchModelBantuanPenyertaanPegawaiTeknikalDicadangkan' => $searchModelBantuanPenyertaanPegawaiTeknikalDicadangkan,
                'dataProviderBantuanPenyertaanPegawaiTeknikalDicadangkan' => $dataProviderBantuanPenyertaanPegawaiTeknikalDicadangkan,
                'searchModelBantuanPenyertaanPegawaiTeknikalDisertai' => $searchModelBantuanPenyertaanPegawaiTeknikalDisertai,
                'dataProviderBantuanPenyertaanPegawaiTeknikalDisertai' => $dataProviderBantuanPenyertaanPegawaiTeknikalDisertai,
                'searchModelBantuanPenyertaanPegawaiTeknikalOlehMsn' => $searchModelBantuanPenyertaanPegawaiTeknikalOlehMsn,
                'dataProviderBantuanPenyertaanPegawaiTeknikalOlehMsn' => $dataProviderBantuanPenyertaanPegawaiTeknikalOlehMsn,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Deletes an existing BantuanPenyertaanPegawaiTeknikal model.
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
     * Finds the BantuanPenyertaanPegawaiTeknikal model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return BantuanPenyertaanPegawaiTeknikal the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = BantuanPenyertaanPegawaiTeknikal::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
