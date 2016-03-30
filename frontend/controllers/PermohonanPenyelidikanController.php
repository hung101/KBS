<?php

namespace frontend\controllers;

use Yii;
use app\models\PermohonanPenyelidikan;
use frontend\models\PermohonanPenyelidikanSearch;
use app\models\PenyelidikanKomposisiPasukan;
use frontend\models\PenyelidikanKomposisiPasukanSearch;
use app\models\DokumenPenyelidikan;
use frontend\models\DokumenPenyelidikanSearch;
use app\models\BajetPenyelidikan;
use frontend\models\BajetPenyelidikanSearch;
use app\models\BajetPenyelidikanSumbangan;
use frontend\models\BajetPenyelidikanSumbanganSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

// contant values
use app\models\general\Upload;
use app\models\general\GeneralVariable;
use app\models\general\GeneralLabel;
use common\models\general\GeneralFunction;

// table reference
use app\models\RefJenisProjek;
use app\models\RefJenisPerkhidmatanAkademik;
use app\models\RefKursusAkademik;

/**
 * PermohonanPenyelidikanController implements the CRUD actions for PermohonanPenyelidikan model.
 */
class PermohonanPenyelidikanController extends Controller
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
     * Lists all PermohonanPenyelidikan models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $searchModel = new PermohonanPenyelidikanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PermohonanPenyelidikan model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = $this->findModel($id);
        
        $model->biasa_dengan_keperluan_penyelidikan  = GeneralLabel::getYesNoLabel($model->biasa_dengan_keperluan_penyelidikan);
        
        $model->kelulusan_echics  = GeneralLabel::getYesNoLabel($model->kelulusan_echics);
        
        $model->kelulusan  = GeneralLabel::getYesNoLabel($model->kelulusan);
        
        $ref = RefJenisProjek::findOne(['id' => $model->jenis_projek]);
        $model->jenis_projek = $ref['desc'];
        
        $ref = RefJenisPerkhidmatanAkademik::findOne(['id' => $model->akademik_jenis_perkhidmatan]);
        $model->akademik_jenis_perkhidmatan = $ref['desc'];
        
        $ref = RefKursusAkademik::findOne(['id' => $model->akademik_kursus]);
        $model->akademik_kursus = $ref['desc'];
        
        $model->tarikh_permohonan = GeneralFunction::convert($model->tarikh_permohonan);
        
        $model->tarikh_direkodkan = GeneralFunction::convert($model->tarikh_direkodkan);
        
        $model->tarikh_pengisytiharan = GeneralFunction::convert($model->tarikh_pengisytiharan);
        
        $model->akademik_tarikh_pelantikan_pertama = GeneralFunction::convert($model->akademik_tarikh_pelantikan_pertama);
        
        $model->akademik_kontrak_tarikh_tamat = GeneralFunction::convert($model->akademik_kontrak_tarikh_tamat);
        
        $queryPar = null;
        
        $queryPar['PenyelidikanKomposisiPasukanSearch']['permohonana_penyelidikan_id'] = $id;
        $queryPar['DokumenPenyelidikanSearch']['permohonana_penyelidikan_id'] = $id;
        $queryPar['BajetPenyelidikanSearch']['permohonana_penyelidikan_id'] = $id;
        $queryPar['BajetPenyelidikanSumbanganSearch']['permohonana_penyelidikan_id'] = $id;
        
        $searchModelPenyelidikanKomposisiPasukan  = new PenyelidikanKomposisiPasukanSearch();
        $dataProviderPenyelidikanKomposisiPasukan = $searchModelPenyelidikanKomposisiPasukan->search($queryPar);
        
        $searchModelDokumenPenyelidikan  = new DokumenPenyelidikanSearch();
        $dataProviderDokumenPenyelidikan = $searchModelDokumenPenyelidikan->search($queryPar);
        
        $searchModelBajetPenyelidikan = new BajetPenyelidikanSearch();
        $dataProviderBajetPenyelidikan = $searchModelBajetPenyelidikan->search($queryPar);
        
        $searchModelBajetPenyelidikanSumbangan = new BajetPenyelidikanSumbanganSearch();
        $dataProviderBajetPenyelidikanSumbangan = $searchModelBajetPenyelidikanSumbangan->search($queryPar);
        
        return $this->render('view', [
            'model' => $model,
            'searchModelPenyelidikanKomposisiPasukan' => $searchModelPenyelidikanKomposisiPasukan,
            'dataProviderPenyelidikanKomposisiPasukan' => $dataProviderPenyelidikanKomposisiPasukan,
            'searchModelDokumenPenyelidikan' => $searchModelDokumenPenyelidikan,
            'dataProviderDokumenPenyelidikan' => $dataProviderDokumenPenyelidikan,
            'searchModelBajetPenyelidikan' => $searchModelBajetPenyelidikan,
            'dataProviderBajetPenyelidikan' => $dataProviderBajetPenyelidikan,
            'searchModelBajetPenyelidikanSumbangan' => $searchModelBajetPenyelidikanSumbangan,
            'dataProviderBajetPenyelidikanSumbangan' => $dataProviderBajetPenyelidikanSumbangan,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new PermohonanPenyelidikan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new PermohonanPenyelidikan();
        
        $queryPar = null;
        
        Yii::$app->session->open();
        
        if(isset(Yii::$app->session->id)){
            $queryPar['PenyelidikanKomposisiPasukanSearch']['session_id'] = Yii::$app->session->id;
            $queryPar['DokumenPenyelidikanSearch']['session_id'] = Yii::$app->session->id;
            $queryPar['BajetPenyelidikanSearch']['session_id'] = Yii::$app->session->id;
            $queryPar['BajetPenyelidikanSumbanganSearch']['session_id'] = Yii::$app->session->id;
        }
        
        $searchModelPenyelidikanKomposisiPasukan  = new PenyelidikanKomposisiPasukanSearch();
        $dataProviderPenyelidikanKomposisiPasukan = $searchModelPenyelidikanKomposisiPasukan->search($queryPar);
        
        $searchModelDokumenPenyelidikan  = new DokumenPenyelidikanSearch();
        $dataProviderDokumenPenyelidikan = $searchModelDokumenPenyelidikan->search($queryPar);
        
        $searchModelBajetPenyelidikanSumbangan = new BajetPenyelidikanSumbanganSearch();
        $dataProviderBajetPenyelidikanSumbangan = $searchModelBajetPenyelidikanSumbangan->search($queryPar);
        
        $searchModelBajetPenyelidikan = new BajetPenyelidikanSearch();
        $dataProviderBajetPenyelidikan = $searchModelBajetPenyelidikan->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if(isset(Yii::$app->session->id)){
                PenyelidikanKomposisiPasukan::updateAll(['permohonana_penyelidikan_id' => $model->permohonana_penyelidikan_id], 'session_id = "'.Yii::$app->session->id.'"');
                PenyelidikanKomposisiPasukan::updateAll(['session_id' => ''], 'permohonana_penyelidikan_id = "'.$model->permohonana_penyelidikan_id.'"');
                
                DokumenPenyelidikan::updateAll(['permohonana_penyelidikan_id' => $model->permohonana_penyelidikan_id], 'session_id = "'.Yii::$app->session->id.'"');
                DokumenPenyelidikan::updateAll(['session_id' => ''], 'permohonana_penyelidikan_id = "'.$model->permohonana_penyelidikan_id.'"');
                
                BajetPenyelidikan::updateAll(['permohonana_penyelidikan_id' => $model->permohonana_penyelidikan_id], 'session_id = "'.Yii::$app->session->id.'"');
                BajetPenyelidikan::updateAll(['session_id' => ''], 'permohonana_penyelidikan_id = "'.$model->permohonana_penyelidikan_id.'"');
                
                BajetPenyelidikanSumbangan::updateAll(['permohonana_penyelidikan_id' => $model->permohonana_penyelidikan_id], 'session_id = "'.Yii::$app->session->id.'"');
                BajetPenyelidikanSumbangan::updateAll(['session_id' => ''], 'permohonana_penyelidikan_id = "'.$model->permohonana_penyelidikan_id.'"');
            }
            
            $file = UploadedFile::getInstance($model, 'akademik_dokumen_sokongan');
            if($file){
                $model->akademik_dokumen_sokongan = Upload::uploadFile($file, Upload::permohonanPenyelidikanFolder, 'akademik_dokumen_sokongan-' .$model->permohonana_penyelidikan_id);
            }
            
            $file = UploadedFile::getInstance($model, 'penyertaan_lembaran_maklumat');
            if($file){
                $model->penyertaan_lembaran_maklumat = Upload::uploadFile($file, Upload::permohonanPenyelidikanFolder, 'penyertaan_lembaran_maklumat-' .$model->permohonana_penyelidikan_id);
            }
            
            $file = UploadedFile::getInstance($model, 'borang_persetujuan_penyertaan');
            if($file){
                $model->borang_persetujuan_penyertaan = Upload::uploadFile($file, Upload::permohonanPenyelidikanFolder, 'borang_persetujuan_penyertaan-' .$model->permohonana_penyelidikan_id);
            }
            
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->permohonana_penyelidikan_id]);
            }
        } 
        
        return $this->render('create', [
                'model' => $model,
                'searchModelPenyelidikanKomposisiPasukan' => $searchModelPenyelidikanKomposisiPasukan,
                'dataProviderPenyelidikanKomposisiPasukan' => $dataProviderPenyelidikanKomposisiPasukan,
                'searchModelDokumenPenyelidikan' => $searchModelDokumenPenyelidikan,
                'dataProviderDokumenPenyelidikan' => $dataProviderDokumenPenyelidikan,
                'searchModelBajetPenyelidikan' => $searchModelBajetPenyelidikan,
                'dataProviderBajetPenyelidikan' => $dataProviderBajetPenyelidikan,
                'searchModelBajetPenyelidikanSumbangan' => $searchModelBajetPenyelidikanSumbangan,
                'dataProviderBajetPenyelidikanSumbangan' => $dataProviderBajetPenyelidikanSumbangan,
                'readonly' => false,
            ]);
    }

    /**
     * Updates an existing PermohonanPenyelidikan model.
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
        
        $queryPar['PenyelidikanKomposisiPasukanSearch']['permohonana_penyelidikan_id'] = $id;
        $queryPar['DokumenPenyelidikanSearch']['permohonana_penyelidikan_id'] = $id;
        $queryPar['BajetPenyelidikanSearch']['permohonana_penyelidikan_id'] = $id;
        $queryPar['BajetPenyelidikanSumbanganSearch']['permohonana_penyelidikan_id'] = $id;
        
        $searchModelPenyelidikanKomposisiPasukan  = new PenyelidikanKomposisiPasukanSearch();
        $dataProviderPenyelidikanKomposisiPasukan = $searchModelPenyelidikanKomposisiPasukan->search($queryPar);
        
        $searchModelDokumenPenyelidikan  = new DokumenPenyelidikanSearch();
        $dataProviderDokumenPenyelidikan = $searchModelDokumenPenyelidikan->search($queryPar);
        
        $searchModelBajetPenyelidikan = new BajetPenyelidikanSearch();
        $dataProviderBajetPenyelidikan = $searchModelBajetPenyelidikan->search($queryPar);
        
        $searchModelBajetPenyelidikanSumbangan = new BajetPenyelidikanSumbanganSearch();
        $dataProviderBajetPenyelidikanSumbangan = $searchModelBajetPenyelidikanSumbangan->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $file = UploadedFile::getInstance($model, 'akademik_dokumen_sokongan');
            if($file){
                $model->akademik_dokumen_sokongan = Upload::uploadFile($file, Upload::permohonanPenyelidikanFolder, $model->permohonana_penyelidikan_id);
            }
            
            $file = UploadedFile::getInstance($model, 'penyertaan_lembaran_maklumat');
            if($file){
                $model->penyertaan_lembaran_maklumat = Upload::uploadFile($file, Upload::permohonanPenyelidikanFolder, 'penyertaan_lembaran_maklumat-' .$model->permohonana_penyelidikan_id);
            }
            
            $file = UploadedFile::getInstance($model, 'borang_persetujuan_penyertaan');
            if($file){
                $model->borang_persetujuan_penyertaan = Upload::uploadFile($file, Upload::permohonanPenyelidikanFolder, 'borang_persetujuan_penyertaan-' .$model->permohonana_penyelidikan_id);
            }
            
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->permohonana_penyelidikan_id]);
            }
        } 
        
        return $this->render('update', [
                'model' => $model,
                'searchModelPenyelidikanKomposisiPasukan' => $searchModelPenyelidikanKomposisiPasukan,
                'dataProviderPenyelidikanKomposisiPasukan' => $dataProviderPenyelidikanKomposisiPasukan,
                'searchModelDokumenPenyelidikan' => $searchModelDokumenPenyelidikan,
                'dataProviderDokumenPenyelidikan' => $dataProviderDokumenPenyelidikan,
                'searchModelBajetPenyelidikan' => $searchModelBajetPenyelidikan,
                'dataProviderBajetPenyelidikan' => $dataProviderBajetPenyelidikan,
                'searchModelBajetPenyelidikanSumbangan' => $searchModelBajetPenyelidikanSumbangan,
                'dataProviderBajetPenyelidikanSumbangan' => $dataProviderBajetPenyelidikanSumbangan,
                'readonly' => false,
            ]);
    }

    /**
     * Deletes an existing PermohonanPenyelidikan model.
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
     * Finds the PermohonanPenyelidikan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PermohonanPenyelidikan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PermohonanPenyelidikan::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
