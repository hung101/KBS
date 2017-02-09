<?php

namespace frontend\controllers;

use Yii;
use app\models\BantuanPenganjuranKursusPegawaiTeknikalDicadangkan;
use frontend\models\BantuanPenganjuranKursusPegawaiTeknikalDicadangkanSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use app\models\general\GeneralVariable;

// table reference
use app\models\ProfilBadanSukan;
use app\models\RefJantina;
use app\models\RefSukan;
use app\models\RefBandar;
use app\models\RefNegeri;
use app\models\RefTahapAkademikPegawaiTeknikal;
use app\models\MaklumatPegawaiTeknikal;

/**
 * BantuanPenganjuranKursusPegawaiTeknikalDicadangkanController implements the CRUD actions for BantuanPenganjuranKursusPegawaiTeknikalDicadangkan model.
 */
class BantuanPenganjuranKursusPegawaiTeknikalDicadangkanController extends Controller
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
     * Lists all BantuanPenganjuranKursusPegawaiTeknikalDicadangkan models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BantuanPenganjuranKursusPegawaiTeknikalDicadangkanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single BantuanPenganjuranKursusPegawaiTeknikalDicadangkan model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        
        $model = $this->findModel($id);
        
        $ref = MaklumatPegawaiTeknikal::findOne(['bantuan_penganjuran_kursus_pegawai_teknikal_dicadangkan_id' => $model->maklumat_pegawai_teknikal_id]);
        $model->maklumat_pegawai_teknikal_id = $ref['nama'];
        
        $ref = ProfilBadanSukan::findOne(['profil_badan_sukan' => $model->badan_sukan]);
        $model->badan_sukan = $ref['nama_badan_sukan'];
        
        $ref = RefJantina::findOne(['id' => $model->jantina]);
        $model->jantina = $ref['desc'];
        
        $ref = RefSukan::findOne(['id' => $model->sukan]);
        $model->sukan = $ref['desc'];

        
        $ref = RefBandar::findOne(['id' => $model->alamat_bandar]);
        $model->alamat_bandar = $ref['desc'];
        
        $ref = RefNegeri::findOne(['id' => $model->alamat_negeri]);
        $model->alamat_negeri = $ref['desc'];
        
        $ref = RefTahapAkademikPegawaiTeknikal::findOne(['id' => $model->tahap_akademik]);
        $model->tahap_akademik = $ref['desc'];
        
        return $this->renderAjax('view', [
            'model' => $model,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new BantuanPenganjuranKursusPegawaiTeknikalDicadangkan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($bantuan_penganjuran_kursus_pegawai_teknikal_id)
    {
        $model = new BantuanPenganjuranKursusPegawaiTeknikalDicadangkan();
        
        Yii::$app->session->open();
        
        if($bantuan_penganjuran_kursus_pegawai_teknikal_id != ''){
            $model->bantuan_penganjuran_kursus_pegawai_teknikal_id = $bantuan_penganjuran_kursus_pegawai_teknikal_id;
        } else {
            if(isset(Yii::$app->session->id)){
                $model->session_id = Yii::$app->session->id;
            }
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return '1';
        } else {
            return $this->renderAjax('create', [
                'model' => $model,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Updates an existing BantuanPenganjuranKursusPegawaiTeknikalDicadangkan model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return '1';
        } else {
            return $this->renderAjax('update', [
                'model' => $model,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Deletes an existing BantuanPenganjuranKursusPegawaiTeknikalDicadangkan model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        //return $this->redirect(['index']);
    }

    /**
     * Finds the BantuanPenganjuranKursusPegawaiTeknikalDicadangkan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return BantuanPenganjuranKursusPegawaiTeknikalDicadangkan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = BantuanPenganjuranKursusPegawaiTeknikalDicadangkan::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
