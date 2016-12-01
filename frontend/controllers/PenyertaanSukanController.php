<?php

namespace frontend\controllers;

use Yii;
use app\models\PenyertaanSukan;
use frontend\models\PenyertaanSukanSearch;
use app\models\PenyertaanSukanAcara;
use app\models\PenilaianPestasi;
use app\models\PenilaianPrestasiAtletSasaran;
use frontend\models\PenyertaanSukanAcaraSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Session;

use app\models\general\GeneralVariable;

// table reference
use app\models\RefKategoriPenilaian;
use app\models\RefSukan;
use app\models\Atlet;
use app\models\PerancanganProgram;
use app\models\RefJenisAktiviti;
use app\models\RefPeringkatKejohananTemasya;
use app\models\RefProgramSemasaSukanAtlet;
use app\models\RefTemasya;

/**
 * PenyertaanSukanController implements the CRUD actions for PenyertaanSukan model.
 */
class PenyertaanSukanController extends Controller
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
     * Lists all PenyertaanSukan models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $queryParams = Yii::$app->request->queryParams;
        
        $searchModel = new PenyertaanSukanSearch();
        $dataProvider = $searchModel->search($queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PenyertaanSukan model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = $this->findModel($id);
        
        $ref = RefKategoriPenilaian::findOne(['id' => $model->kategori_penilaian]);
        $model->kategori_penilaian = $ref['desc'];
        
        $ref = RefSukan::findOne(['id' => $model->nama_sukan]);
        $model->nama_sukan = $ref['desc'];
        
        $ref = Atlet::findOne(['atlet_id' => $model->nama_atlet]);
        $model->nama_atlet = $ref['nameAndIC'];
        
        $ref = PerancanganProgram::findOne(['perancangan_program_id' => $model->nama_kejohanan]);
        $model->nama_kejohanan = $ref['nama_program'];
        
        $ref = RefPeringkatKejohananTemasya::findOne(['id' => $model->peringkat]);
        $model->peringkat = $ref['desc'];
        
        $ref = RefProgramSemasaSukanAtlet::findOne(['id' => $model->program]);
        $model->program = $ref['desc'];
        
        $ref = RefTemasya::findOne(['id' => $model->nama_temasya]);
        $model->nama_temasya = $ref['desc'];
        
        $queryPar = null;
        
        $queryPar['PenyertaanSukanAcaraSearch']['penyertaan_sukan_id'] = $id;
        
        $searchModelPenyertaanSukanAcara  = new PenyertaanSukanAcaraSearch();
        $dataProviderPenyertaanSukanAcara = $searchModelPenyertaanSukanAcara->search($queryPar);
        
        return $this->render('view', [
            'model' => $model,
            'searchModelPenyertaanSukanAcara' => $searchModelPenyertaanSukanAcara,
            'dataProviderPenyertaanSukanAcara' => $dataProviderPenyertaanSukanAcara,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new PenyertaanSukan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new PenyertaanSukan();
        
        $queryPar = null;
        
        Yii::$app->session->open();
        
        if(isset(Yii::$app->session->id)){
            $queryPar['PenyertaanSukanAcaraSearch']['session_id'] = Yii::$app->session->id;
        }
        
        $searchModelPenyertaanSukanAcara  = new PenyertaanSukanAcaraSearch();
        $dataProviderPenyertaanSukanAcara = $searchModelPenyertaanSukanAcara->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if(isset(Yii::$app->session->id)){
                PenyertaanSukanAcara::updateAll(['penyertaan_sukan_id' => $model->penyertaan_sukan_id], 'session_id = "'.Yii::$app->session->id.'"');
                PenyertaanSukanAcara::updateAll(['session_id' => ''], 'penyertaan_sukan_id = "'.$model->penyertaan_sukan_id.'"');
            }
            
            
            if($model->nama_kejohanan){
                // update Penilaian Prestasi modul for Kejohanan only
                $modelPenilaianPestasi = null;
                 if (($modelPenilaianPestasi = PenilaianPestasi::find()->where(['penyertaan_sukan_id'=>$model->penyertaan_sukan_id])->one()) == null) {
                    $modelPenilaianPestasi = new PenilaianPestasi();
                }
                
                $modelPenyertaanSukanAcaraFirstOne = null;
                if (($modelPenyertaanSukanAcaraFirstOne = PenyertaanSukanAcara::find()->where(['penyertaan_sukan_id'=>$model->penyertaan_sukan_id])->orderBy(['penyertaan_sukan_acara_id' => SORT_ASC])->one()) != null) {
                    $modelPenilaianPestasi->acara = $modelPenyertaanSukanAcaraFirstOne->nama_acara;
                }

                $modelPenilaianPestasi->penyertaan_sukan_id = $model->penyertaan_sukan_id;
                $modelPenilaianPestasi->sukan = $model->nama_sukan;
                $modelPenilaianPestasi->program = $model->program;
                $modelPenilaianPestasi->kejohanan = $model->nama_kejohanan;
                $modelPenilaianPestasi->save();

                $modelPenyertaanSukanAcaras = PenyertaanSukanAcara::findAll([
                    'penyertaan_sukan_id' => $model->penyertaan_sukan_id,
                ]);

                foreach($modelPenyertaanSukanAcaras as $modelPenyertaanSukanAcara){
                    $modelPenilaianPrestasiAtletSasaran = null;
                    if (($modelPenilaianPrestasiAtletSasaran = PenilaianPrestasiAtletSasaran::find()
                            ->where(['penyertaan_sukan_id'=>$model->penyertaan_sukan_id])
                            ->andWhere(['penyertaan_sukan_acara_id'=>$modelPenyertaanSukanAcara->penyertaan_sukan_acara_id])->one()) == null) {
                        $modelPenilaianPrestasiAtletSasaran = new PenilaianPrestasiAtletSasaran();
                    }
                    
                    $modelPenilaianPrestasiAtletSasaran->penilaian_pestasi_id = $modelPenilaianPestasi->penilaian_pestasi_id;
                    $modelPenilaianPrestasiAtletSasaran->atlet = $modelPenyertaanSukanAcara->atlet;
                    $modelPenilaianPrestasiAtletSasaran->sasaran = $modelPenyertaanSukanAcara->sasaran;
                    $modelPenilaianPrestasiAtletSasaran->penyertaan_sukan_id = $modelPenyertaanSukanAcara->penyertaan_sukan_id;
                    $modelPenilaianPrestasiAtletSasaran->penyertaan_sukan_acara_id = $modelPenyertaanSukanAcara->penyertaan_sukan_acara_id;
                    $modelPenilaianPrestasiAtletSasaran->save();
                    
                    
                    
                    $modelAtletPencapaian = null;
                    if (($modelAtletPencapaian = AtletPencapaian::find()->where(['atlet_id'=>$modelPenyertaanSukanAcara->atlet])
                            ->andWhere(['penyertaan_sukan_id'=>$model->penyertaan_sukan_id])
                            ->andWhere(['penyertaan_sukan_acara_id'=>$model->penyertaan_sukan_acara_id])->one()) == null) {
                        $modelAtletPencapaian = new AtletPencapaian();
                    }

                    if($model->nama_kejohanan){
                        $refPerancanganProgram = PerancanganProgram::findOne(['perancangan_program_id' => $model->nama_kejohanan]);
                        $modelAtletPencapaian->nama_kejohanan_temasya = $refPerancanganProgram['nama_program'];
                        $modelAtletPencapaian->tarikh_mula_kejohanan = $refPerancanganProgram['tarikh_mula'];
                        $modelAtletPencapaian->tarikh_tamat_kejohanan = $refPerancanganProgram['tarikh_tamat'];
                    } elseif($model->nama_temasya) {
                        $refTemasya = RefTemasya::findOne(['perancangan_program_id' => $model->nama_temasya]);
                        $modelAtletPencapaian->nama_kejohanan_temasya = $refTemasya['desc'];
                        $modelAtletPencapaian->tarikh_mula_kejohanan = $model->tarikh_mula;
                        $modelAtletPencapaian->tarikh_tamat_kejohanan = $model->tarikh_tamat;
                    }

                    $modelAtletPencapaian->atlet_id = $model->atlet;
                    $modelAtletPencapaian->nama_sukan = $model->nama_sukan;
                    $modelAtletPencapaian->nama_acara = $modelPenyertaanSukanAcara->nama_acara;
                    $modelAtletPencapaian->peringkat_kejohanan = $model->peringkat;
                    $modelAtletPencapaian->penyertaan_sukan_id = $model->penilaian_pestasi_id;
                    $modelAtletPencapaian->penyertaan_sukan_acara_id = $model->penilaian_prestasi_atlet_sasaran_id;
                    $modelAtletPencapaian->pencapaian = $modelPenyertaanSukanAcara->keputusan;
                    $modelAtletPencapaian->save();
                }
                
                $model->penilaian_pestasi_id = $modelPenilaianPestasi->penilaian_pestasi_id;
                $model->save();
            }
            
            return $this->redirect(['view', 'id' => $model->penyertaan_sukan_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'searchModelPenyertaanSukanAcara' => $searchModelPenyertaanSukanAcara,
                'dataProviderPenyertaanSukanAcara' => $dataProviderPenyertaanSukanAcara,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Updates an existing PenyertaanSukan model.
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
        
        $queryPar['PenyertaanSukanAcaraSearch']['penyertaan_sukan_id'] = $id;
        
        $searchModelPenyertaanSukanAcara  = new PenyertaanSukanAcaraSearch();
        $dataProviderPenyertaanSukanAcara = $searchModelPenyertaanSukanAcara->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if($model->nama_kejohanan){
                // update Penilaian Prestasi modul for Kejohanan only
                $modelPenilaianPestasi = null;
                 if (($modelPenilaianPestasi = PenilaianPestasi::find()->where(['penyertaan_sukan_id'=>$model->penyertaan_sukan_id])->one()) == null) {
                    $modelPenilaianPestasi = new PenilaianPestasi();
                }
                
                $modelPenyertaanSukanAcaraFirstOne = null;
                if (($modelPenyertaanSukanAcaraFirstOne = PenyertaanSukanAcara::find()->where(['penyertaan_sukan_id'=>$model->penyertaan_sukan_id])->orderBy(['penyertaan_sukan_acara_id' => SORT_ASC])->one()) != null) {
                    $modelPenilaianPestasi->acara = $modelPenyertaanSukanAcaraFirstOne->nama_acara;
                }

                $modelPenilaianPestasi->penyertaan_sukan_id = $model->penyertaan_sukan_id;
                $modelPenilaianPestasi->sukan = $model->nama_sukan;
                $modelPenilaianPestasi->program = $model->program;
                $modelPenilaianPestasi->kejohanan = $model->nama_kejohanan;
                $modelPenilaianPestasi->save();

                $modelPenyertaanSukanAcaras = PenyertaanSukanAcara::findAll([
                        'penyertaan_sukan_id' => $model->penyertaan_sukan_id,
                    ]);

                foreach($modelPenyertaanSukanAcaras as $modelPenyertaanSukanAcara){
                    $modelPenilaianPrestasiAtletSasaran = null;
                    if (($modelPenilaianPrestasiAtletSasaran = PenilaianPrestasiAtletSasaran::find()
                            ->where(['penyertaan_sukan_id'=>$model->penyertaan_sukan_id])
                            ->andWhere(['penyertaan_sukan_acara_id'=>$modelPenyertaanSukanAcara->penyertaan_sukan_acara_id])->one()) == null) {
                        $modelPenilaianPrestasiAtletSasaran = new PenilaianPrestasiAtletSasaran();
                    }
                    
                    $modelPenilaianPrestasiAtletSasaran->penilaian_pestasi_id = $modelPenilaianPestasi->penilaian_pestasi_id;
                    $modelPenilaianPrestasiAtletSasaran->atlet = $modelPenyertaanSukanAcara->atlet;
                    $modelPenilaianPrestasiAtletSasaran->sasaran = $modelPenyertaanSukanAcara->sasaran;
                    $modelPenilaianPrestasiAtletSasaran->penyertaan_sukan_id = $modelPenyertaanSukanAcara->penyertaan_sukan_id;
                    $modelPenilaianPrestasiAtletSasaran->penyertaan_sukan_acara_id = $modelPenyertaanSukanAcara->penyertaan_sukan_acara_id;
                    $modelPenilaianPrestasiAtletSasaran->save();
                }
                
                $model->penilaian_pestasi_id = $modelPenilaianPestasi->penilaian_pestasi_id;
                $model->save();
                
                
                
                $modelAtletPencapaian = null;
                    if (($modelAtletPencapaian = AtletPencapaian::find()->where(['atlet_id'=>$modelPenyertaanSukanAcara->atlet])
                            ->andWhere(['penyertaan_sukan_id'=>$model->penyertaan_sukan_id])
                            ->andWhere(['penyertaan_sukan_acara_id'=>$model->penyertaan_sukan_acara_id])->one()) == null) {
                        $modelAtletPencapaian = new AtletPencapaian();
                    }

                    if($model->nama_kejohanan){
                        $refPerancanganProgram = PerancanganProgram::findOne(['perancangan_program_id' => $model->nama_kejohanan]);
                        $modelAtletPencapaian->nama_kejohanan_temasya = $refPerancanganProgram['nama_program'];
                        $modelAtletPencapaian->tarikh_mula_kejohanan = $refPerancanganProgram['tarikh_mula'];
                        $modelAtletPencapaian->tarikh_tamat_kejohanan = $refPerancanganProgram['tarikh_tamat'];
                    } elseif($model->nama_temasya) {
                        $refTemasya = RefTemasya::findOne(['perancangan_program_id' => $model->nama_temasya]);
                        $modelAtletPencapaian->nama_kejohanan_temasya = $refTemasya['desc'];
                        $modelAtletPencapaian->tarikh_mula_kejohanan = $model->tarikh_mula;
                        $modelAtletPencapaian->tarikh_tamat_kejohanan = $model->tarikh_tamat;
                    }

                    $modelAtletPencapaian->atlet_id = $model->atlet;
                    $modelAtletPencapaian->nama_sukan = $model->nama_sukan;
                    $modelAtletPencapaian->nama_acara = $modelPenyertaanSukanAcara->nama_acara;
                    $modelAtletPencapaian->peringkat_kejohanan = $model->peringkat;
                    $modelAtletPencapaian->penyertaan_sukan_id = $model->penilaian_pestasi_id;
                    $modelAtletPencapaian->penyertaan_sukan_acara_id = $model->penilaian_prestasi_atlet_sasaran_id;
                    $modelAtletPencapaian->pencapaian = $modelPenyertaanSukanAcara->keputusan;
                    $modelAtletPencapaian->save();
            }
            
            return $this->redirect(['view', 'id' => $model->penyertaan_sukan_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'searchModelPenyertaanSukanAcara' => $searchModelPenyertaanSukanAcara,
                'dataProviderPenyertaanSukanAcara' => $dataProviderPenyertaanSukanAcara,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Deletes an existing PenyertaanSukan model.
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
     * Finds the PenyertaanSukan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PenyertaanSukan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PenyertaanSukan::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionSetSukan($sukan_id){
        
        $session = new Session;
        $session->open();

        $session['penyertaan-sukan_sukan_id'] = $sukan_id;
        
        $session->close();
    }
}
