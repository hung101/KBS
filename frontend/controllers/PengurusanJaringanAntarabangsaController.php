<?php

namespace frontend\controllers;

use Yii;
use app\models\PengurusanJaringanAntarabangsa;
use frontend\models\PengurusanJaringanAntarabangsaSearch;
use app\models\PengurusanKelayakanJaringanAntarabangsa;
use frontend\models\PengurusanKelayakanJaringanAntarabangsaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use app\models\general\GeneralVariable;

// table reference
use app\models\RefJawatanPersatuan;
use app\models\RefJenisProgramJaringanAntarabangsa;
use app\models\RefPermohonanJaringanAntarabangsa;
use app\models\RefPegawaiTeknikalJaringanAntarabangsa;
use app\models\RefPemohonJaringanAntarabangsa;
use app\models\RefJantina;
use app\models\RefNegeri;
use app\models\RefBandar;
use app\models\RefNegara;

/**
 * PengurusanJaringanAntarabangsaController implements the CRUD actions for PengurusanJaringanAntarabangsa model.
 */
class PengurusanJaringanAntarabangsaController extends Controller
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
     * Lists all PengurusanJaringanAntarabangsa models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $searchModel = new PengurusanJaringanAntarabangsaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PengurusanJaringanAntarabangsa model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $queryPar = null;
        
        $queryPar['PengurusanKelayakanJaringanAntarabangsaSearch']['pengurusan_jaringan_antarabangsa_id'] = $id;
        
        $searchModelKelayakan  = new PengurusanKelayakanJaringanAntarabangsaSearch();
        $dataProviderKelayakan = $searchModelKelayakan->search($queryPar);
        
        $model = $this->findModel($id);
        
        $ref = RefNegara::findOne(['id' => $model->negara]);
        $model->negara = $ref['desc'];
        
        $ref = RefPemohonJaringanAntarabangsa::findOne(['id' => $model->nama_pemohon]);
        $model->nama_pemohon = $ref['desc'];
        
        $ref = RefJantina::findOne(['id' => $model->jantina]);
        $model->jantina = $ref['desc'];
        
        $ref = RefNegeri::findOne(['id' => $model->alamat_surat_menyurat_negeri]);
        $model->alamat_surat_menyurat_negeri = $ref['desc'];
        
        $ref = RefBandar::findOne(['id' => $model->alamat_surat_menyurat_bandar]);
        $model->alamat_surat_menyurat_bandar = $ref['desc'];
        
        $ref = RefPegawaiTeknikalJaringanAntarabangsa::findOne(['id' => $model->pegawai_teknikal]);
        $model->pegawai_teknikal = $ref['desc'];
        
        $ref = RefPermohonanJaringanAntarabangsa::findOne(['id' => $model->permohonan]);
        $model->permohonan = $ref['desc'];
        
        $ref = RefJenisProgramJaringanAntarabangsa::findOne(['id' => $model->jenis_program]);
        $model->jenis_program = $ref['desc'];
        
        $ref = RefNegeri::findOne(['id' => $model->alamat_majikan_negeri]);
        $model->alamat_majikan_negeri = $ref['desc'];
        
        $ref = RefBandar::findOne(['id' => $model->alamat_majikan_bandar]);
        $model->alamat_majikan_bandar = $ref['desc'];
        
        $ref = RefJawatanPersatuan::findOne(['id' => $model->jawatan_di_persatuan]);
        $model->jawatan_di_persatuan = $ref['desc'];
        
        return $this->render('view', [
            'model' => $model,
            'searchModelKelayakan' => $searchModelKelayakan,
            'dataProviderKelayakan' => $dataProviderKelayakan,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new PengurusanJaringanAntarabangsa model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new PengurusanJaringanAntarabangsa();
        
        $queryPar = null;
        
        Yii::$app->session->open();
        
        if(isset(Yii::$app->session->id)){
            $queryPar['PengurusanKelayakanJaringanAntarabangsaSearch']['session_id'] = Yii::$app->session->id;
        }
        
        $searchModelKelayakan  = new PengurusanKelayakanJaringanAntarabangsaSearch();
        $dataProviderKelayakan = $searchModelKelayakan->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if(isset(Yii::$app->session->id)){
                PengurusanKelayakanJaringanAntarabangsa::updateAll(['pengurusan_jaringan_antarabangsa_id' => $model->pengurusan_jaringan_antarabangsa_id], 'session_id = "'.Yii::$app->session->id.'"');
                PengurusanKelayakanJaringanAntarabangsa::updateAll(['session_id' => ''], 'pengurusan_jaringan_antarabangsa_id = "'.$model->pengurusan_jaringan_antarabangsa_id.'"');
            }
            
            return $this->redirect(['view', 'id' => $model->pengurusan_jaringan_antarabangsa_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'searchModelKelayakan' => $searchModelKelayakan,
                'dataProviderKelayakan' => $dataProviderKelayakan,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Updates an existing PengurusanJaringanAntarabangsa model.
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
        
        $queryPar['PengurusanKelayakanJaringanAntarabangsaSearch']['pengurusan_jaringan_antarabangsa_id'] = $id;
        
        $searchModelKelayakan  = new PengurusanKelayakanJaringanAntarabangsaSearch();
        $dataProviderKelayakan = $searchModelKelayakan->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->pengurusan_jaringan_antarabangsa_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'searchModelKelayakan' => $searchModelKelayakan,
                'dataProviderKelayakan' => $dataProviderKelayakan,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Deletes an existing PengurusanJaringanAntarabangsa model.
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

        return $this->redirect(['index']);
    }

    /**
     * Finds the PengurusanJaringanAntarabangsa model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PengurusanJaringanAntarabangsa the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PengurusanJaringanAntarabangsa::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
