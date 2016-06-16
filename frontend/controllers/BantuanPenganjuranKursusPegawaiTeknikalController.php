<?php

namespace frontend\controllers;

use Yii;
use app\models\BantuanPenganjuranKursusPegawaiTeknikal;
use frontend\models\BantuanPenganjuranKursusPegawaiTeknikalSearch;
use app\models\BantuanPenganjuranKursusPegawaiTeknikalDicadangkan;
use frontend\models\BantuanPenganjuranKursusPegawaiTeknikalDicadangkanSearch;
use app\models\BantuanPenganjuranKursusPegawaiTeknikalDisertai;
use frontend\models\BantuanPenganjuranKursusPegawaiTeknikalDisertaiSearch;
use app\models\BantuanPenganjuranKursusPegawaiTeknikalOlehMsn;
use frontend\models\BantuanPenganjuranKursusPegawaiTeknikalOlehMsnSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

use app\models\general\Upload;
use app\models\general\GeneralVariable;

/**
 * BantuanPenganjuranKursusPegawaiTeknikalController implements the CRUD actions for BantuanPenganjuranKursusPegawaiTeknikal model.
 */
class BantuanPenganjuranKursusPegawaiTeknikalController extends Controller
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
     * Lists all BantuanPenganjuranKursusPegawaiTeknikal models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BantuanPenganjuranKursusPegawaiTeknikalSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single BantuanPenganjuranKursusPegawaiTeknikal model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $queryPar = null;
        
        $queryPar['BantuanPenganjuranKursusPegawaiTeknikalDicadangkanSearch']['bantuan_penganjuran_kursus_pegawai_teknikal_id'] = $id;
        $queryPar['BantuanPenganjuranKursusPegawaiTeknikalDisertaiSearch']['bantuan_penganjuran_kursus_pegawai_teknikal_id'] = $id;
        $queryPar['BantuanPenganjuranKursusOlehMsnSearch']['bantuan_penganjuran_kursus_pegawai_teknikal_id'] = $id;
        
        $searchModelBantuanPenganjuranKursusPegawaiTeknikalDicadangkan  = new BantuanPenganjuranKursusPegawaiTeknikalDicadangkanSearch();
        $dataProviderBantuanPenganjuranKursusPegawaiTeknikalDicadangkan = $searchModelBantuanPenganjuranKursusPegawaiTeknikalDicadangkan->search($queryPar);
        
        $searchModelBantuanPenganjuranKursusPegawaiTeknikalDisertai  = new BantuanPenganjuranKursusPegawaiTeknikalDisertaiSearch();
        $dataProviderBantuanPenganjuranKursusPegawaiTeknikalDisertai = $searchModelBantuanPenganjuranKursusPegawaiTeknikalDisertai->search($queryPar);
        
        $searchModelBantuanPenganjuranKursusPegawaiTeknikalOlehMsn  = new BantuanPenganjuranKursusPegawaiTeknikalOlehMsnSearch();
        $dataProviderBantuanPenganjuranKursusPegawaiTeknikalOlehMsn = $searchModelBantuanPenganjuranKursusPegawaiTeknikalOlehMsn->search($queryPar);
        
        return $this->render('view', [
            'model' => $this->findModel($id),
            'searchModelBantuanPenganjuranKursusPegawaiTeknikalDicadangkan' => $searchModelBantuanPenganjuranKursusPegawaiTeknikalDicadangkan,
            'dataProviderBantuanPenganjuranKursusPegawaiTeknikalDicadangkan' => $dataProviderBantuanPenganjuranKursusPegawaiTeknikalDicadangkan,
            'searchModelBantuanPenganjuranKursusPegawaiTeknikalDisertai' => $searchModelBantuanPenganjuranKursusPegawaiTeknikalDisertai,
            'dataProviderBantuanPenganjuranKursusPegawaiTeknikalDisertai' => $dataProviderBantuanPenganjuranKursusPegawaiTeknikalDisertai,
            'searchModelBantuanPenganjuranKursusPegawaiTeknikalOlehMsn' => $searchModelBantuanPenganjuranKursusPegawaiTeknikalOlehMsn,
            'dataProviderBantuanPenganjuranKursusPegawaiTeknikalOlehMsn' => $dataProviderBantuanPenganjuranKursusPegawaiTeknikalOlehMsn,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new BantuanPenganjuranKursusPegawaiTeknikal model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new BantuanPenganjuranKursusPegawaiTeknikal();
        
        $queryPar = null;
        
        Yii::$app->session->open();
        
        if(isset(Yii::$app->session->id)){
            $queryPar['BantuanPenganjuranKursusPegawaiTeknikalDicadangkanSearch']['session_id'] = Yii::$app->session->id;
            $queryPar['BantuanPenganjuranKursusPegawaiTeknikalDisertaiSearch']['session_id'] = Yii::$app->session->id;
            $queryPar['BantuanPenganjuranKursusPegawaiTeknikalOlehMsnSearch']['session_id'] = Yii::$app->session->id;
        }
        
        $searchModelBantuanPenganjuranKursusPegawaiTeknikalDicadangkan  = new BantuanPenganjuranKursusPegawaiTeknikalDicadangkanSearch();
        $dataProviderBantuanPenganjuranKursusPegawaiTeknikalDicadangkan = $searchModelBantuanPenganjuranKursusPegawaiTeknikalDicadangkan->search($queryPar);
        
        $searchModelBantuanPenganjuranKursusPegawaiTeknikalDisertai  = new BantuanPenganjuranKursusPegawaiTeknikalDisertaiSearch();
        $dataProviderBantuanPenganjuranKursusPegawaiTeknikalDisertai = $searchModelBantuanPenganjuranKursusPegawaiTeknikalDisertai->search($queryPar);
        
        $searchModelBantuanPenganjuranKursusPegawaiTeknikalOlehMsn  = new BantuanPenganjuranKursusPegawaiTeknikalOlehMsnSearch();
        $dataProviderBantuanPenganjuranKursusPegawaiTeknikalOlehMsn = $searchModelBantuanPenganjuranKursusPegawaiTeknikalOlehMsn->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            
            if(isset(Yii::$app->session->id)){
                BantuanPenganjuranKursusPegawaiTeknikalDicadangkan::updateAll(['bantuan_penganjuran_kursus_pegawai_teknikal_id' => $model->bantuan_penganjuran_kursus_pegawai_teknikal_id], 'session_id = "'.Yii::$app->session->id.'"');
                BantuanPenganjuranKursusPegawaiTeknikalDicadangkan::updateAll(['session_id' => ''], 'bantuan_penganjuran_kursus_pegawai_teknikal_id = "'.$model->bantuan_penganjuran_kursus_pegawai_teknikal_id.'"');
                
                BantuanPenganjuranKursusPegawaiTeknikalDisertai::updateAll(['bantuan_penganjuran_kursus_pegawai_teknikal_id' => $model->bantuan_penganjuran_kursus_pegawai_teknikal_id], 'session_id = "'.Yii::$app->session->id.'"');
                BantuanPenganjuranKursusPegawaiTeknikalDisertai::updateAll(['session_id' => ''], 'bantuan_penganjuran_kursus_pegawai_teknikal_id = "'.$model->bantuan_penganjuran_kursus_pegawai_teknikal_id.'"');
                
                BantuanPenganjuranKursusPegawaiTeknikalOlehMsn::updateAll(['bantuan_penganjuran_kursus_pegawai_teknikal_id' => $model->bantuan_penganjuran_kursus_pegawai_teknikal_id], 'session_id = "'.Yii::$app->session->id.'"');
                BantuanPenganjuranKursusPegawaiTeknikalOlehMsn::updateAll(['session_id' => ''], 'bantuan_penganjuran_kursus_pegawai_teknikal_id = "'.$model->bantuan_penganjuran_kursus_pegawai_teknikal_id.'"');
            }
            
            return $this->redirect(['view', 'id' => $model->bantuan_penganjuran_kursus_pegawai_teknikal_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'searchModelBantuanPenganjuranKursusPegawaiTeknikalDicadangkan' => $searchModelBantuanPenganjuranKursusPegawaiTeknikalDicadangkan,
                'dataProviderBantuanPenganjuranKursusPegawaiTeknikalDicadangkan' => $dataProviderBantuanPenganjuranKursusPegawaiTeknikalDicadangkan,
                'searchModelBantuanPenganjuranKursusPegawaiTeknikalDisertai' => $searchModelBantuanPenganjuranKursusPegawaiTeknikalDisertai,
                'dataProviderBantuanPenganjuranKursusPegawaiTeknikalDisertai' => $dataProviderBantuanPenganjuranKursusPegawaiTeknikalDisertai,
                'searchModelBantuanPenganjuranKursusPegawaiTeknikalOlehMsn' => $searchModelBantuanPenganjuranKursusPegawaiTeknikalOlehMsn,
                'dataProviderBantuanPenganjuranKursusPegawaiTeknikalOlehMsn' => $dataProviderBantuanPenganjuranKursusPegawaiTeknikalOlehMsn,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Updates an existing BantuanPenganjuranKursusPegawaiTeknikal model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        
        $queryPar = null;
        
        $queryPar['BantuanPenganjuranKursusPegawaiTeknikalDicadangkanSearch']['bantuan_penganjuran_kursus_pegawai_teknikal_id'] = $id;
        $queryPar['BantuanPenganjuranKursusPegawaiTeknikalDisertaiSearch']['bantuan_penganjuran_kursus_pegawai_teknikal_id'] = $id;
        $queryPar['BantuanPenganjuranKursusOlehMsnSearch']['bantuan_penganjuran_kursus_pegawai_teknikal_id'] = $id;
        
        $searchModelBantuanPenganjuranKursusPegawaiTeknikalDicadangkan  = new BantuanPenganjuranKursusPegawaiTeknikalDicadangkanSearch();
        $dataProviderBantuanPenganjuranKursusPegawaiTeknikalDicadangkan = $searchModelBantuanPenganjuranKursusPegawaiTeknikalDicadangkan->search($queryPar);
        
        $searchModelBantuanPenganjuranKursusPegawaiTeknikalDisertai  = new BantuanPenganjuranKursusPegawaiTeknikalDisertaiSearch();
        $dataProviderBantuanPenganjuranKursusPegawaiTeknikalDisertai = $searchModelBantuanPenganjuranKursusPegawaiTeknikalDisertai->search($queryPar);
        
        $searchModelBantuanPenganjuranKursusPegawaiTeknikalOlehMsn  = new BantuanPenganjuranKursusPegawaiTeknikalOlehMsnSearch();
        $dataProviderBantuanPenganjuranKursusPegawaiTeknikalOlehMsn = $searchModelBantuanPenganjuranKursusPegawaiTeknikalOlehMsn->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->bantuan_penganjuran_kursus_pegawai_teknikal_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'searchModelBantuanPenganjuranKursusPegawaiTeknikalDicadangkan' => $searchModelBantuanPenganjuranKursusPegawaiTeknikalDicadangkan,
                'dataProviderBantuanPenganjuranKursusPegawaiTeknikalDicadangkan' => $dataProviderBantuanPenganjuranKursusPegawaiTeknikalDicadangkan,
                'searchModelBantuanPenganjuranKursusPegawaiTeknikalDisertai' => $searchModelBantuanPenganjuranKursusPegawaiTeknikalDisertai,
                'dataProviderBantuanPenganjuranKursusPegawaiTeknikalDisertai' => $dataProviderBantuanPenganjuranKursusPegawaiTeknikalDisertai,
                'searchModelBantuanPenganjuranKursusPegawaiTeknikalOlehMsn' => $searchModelBantuanPenganjuranKursusPegawaiTeknikalOlehMsn,
                'dataProviderBantuanPenganjuranKursusPegawaiTeknikalOlehMsn' => $dataProviderBantuanPenganjuranKursusPegawaiTeknikalOlehMsn,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Deletes an existing BantuanPenganjuranKursusPegawaiTeknikal model.
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
     * Finds the BantuanPenganjuranKursusPegawaiTeknikal model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return BantuanPenganjuranKursusPegawaiTeknikal the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = BantuanPenganjuranKursusPegawaiTeknikal::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
