<?php

namespace frontend\controllers;

use Yii;
use app\models\PermohonanPendidikan;
use frontend\models\PermohonanPendidikanSearch;
use app\models\PermohonanPendidikanKeputusanSpm;
use frontend\models\PermohonanPendidikanKeputusanSpmSearch;
use app\models\PermohonanPendidikanKursusPengajian;
use frontend\models\PermohonanPendidikanKursusPengajianSearch;
use app\models\MsnLaporanSenaraiPermohonanPendidikan;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\helpers\BaseUrl;

// contant values
use app\models\general\Upload;
use app\models\general\GeneralLabel;
use app\models\general\GeneralVariable;
use common\models\general\GeneralFunction;

// table reference
use app\models\Atlet;
use app\models\RefJenisPermohonanPendidikan;
use app\models\RefTahapPendidikan;
use app\models\RefJantina;
use app\models\RefSukan;
use app\models\RefAcara;
use app\models\RefBandar;
use app\models\RefNegeri;
use app\models\RefStatusPermohonanPendidikan;
use app\models\RefKategoriAtletPendidikan;

/**
 * PermohonanPendidikanController implements the CRUD actions for PermohonanPendidikan model.
 */
class PermohonanPendidikanController extends Controller
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
     * Lists all PermohonanPendidikan models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $searchModel = new PermohonanPendidikanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PermohonanPendidikan model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = $this->findModel($id);
        
        $ref = RefJenisPermohonanPendidikan::findOne(['id' => $model->jenis_permohonan]);
        $model->jenis_permohonan = $ref['desc'];
        
        $ref = Atlet::findOne(['atlet_id' => $model->atlet_id]);
        $model->atlet_id = $ref['nameAndIC'];
        
        $ref = RefJantina::findOne(['id' => $model->jantina]);
        $model->jantina = $ref['desc'];
        
        $ref = RefNegeri::findOne(['id' => $model->alamat_rumah_negeri]);
        $model->alamat_rumah_negeri = $ref['desc'];
        
        $ref = RefBandar::findOne(['id' => $model->alamat_rumah_bandar]);
        $model->alamat_rumah_bandar = $ref['desc'];
        
        $ref = RefTahapPendidikan::findOne(['id' => $model->tahap_pendidikan]);
        $model->tahap_pendidikan = $ref['desc'];
        
        $ref = RefSukan::findOne(['id' => $model->sukan]);
        $model->sukan = $ref['desc'];
        
        $ref = RefAcara::findOne(['id' => $model->acara]);
        $model->acara = $ref['desc'];
        
        $ref = RefNegeri::findOne(['id' => $model->alamat_pendidikan_negeri]);
        $model->alamat_pendidikan_negeri = $ref['desc'];
        
        $ref = RefBandar::findOne(['id' => $model->alamat_pendidikan_bandar]);
        $model->alamat_pendidikan_bandar = $ref['desc'];
        
        $ref = RefKategoriAtletPendidikan::findOne(['id' => $model->kategori_atlet]);
        $model->kategori_atlet = $ref['desc'];
        
        /*$YesNo = GeneralLabel::getYesNoLabel($model->kelulusan);
        $model->kelulusan = $YesNo;*/
        
        $ref = RefStatusPermohonanPendidikan::findOne(['id' => $model->kelulusan]);
        $model->kelulusan = $ref['desc'];
        
        $queryPar = null;
        
        $queryPar['PermohonanPendidikanKeputusanSpmSearch']['permohonan_pendidikan_id'] = $id;
        $queryPar['PermohonanPendidikanKursusPengajianSearch']['permohonan_pendidikan_id'] = $id;
        
        $searchModelPermohonanPendidikanKeputusanSpm = new PermohonanPendidikanKeputusanSpmSearch();
        $dataProviderPermohonanPendidikanKeputusanSpm = $searchModelPermohonanPendidikanKeputusanSpm->search($queryPar);
        
        $searchModelPermohonanPendidikanKursusPengajian = new PermohonanPendidikanKursusPengajianSearch();
        $dataProviderPermohonanPendidikanKursusPengajian = $searchModelPermohonanPendidikanKursusPengajian->search($queryPar);
        
        return $this->render('view', [
            'model' => $model,
            'searchModelPermohonanPendidikanKeputusanSpm' => $searchModelPermohonanPendidikanKeputusanSpm,
            'dataProviderPermohonanPendidikanKeputusanSpm' => $dataProviderPermohonanPendidikanKeputusanSpm,
            'searchModelPermohonanPendidikanKursusPengajian' => $searchModelPermohonanPendidikanKursusPengajian,
            'dataProviderPermohonanPendidikanKursusPengajian' => $dataProviderPermohonanPendidikanKursusPengajian,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new PermohonanPendidikan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $queryPar = null;
        
        Yii::$app->session->open();
        
        if(isset(Yii::$app->session->id)){
            $queryPar['PermohonanPendidikanKeputusanSpmSearch']['session_id'] = Yii::$app->session->id;
            $queryPar['PermohonanPendidikanKursusPengajianSearch']['session_id'] = Yii::$app->session->id;
        }
        
        $searchModelPermohonanPendidikanKeputusanSpm = new PermohonanPendidikanKeputusanSpmSearch();
        $dataProviderPermohonanPendidikanKeputusanSpm = $searchModelPermohonanPendidikanKeputusanSpm->search($queryPar);
        
        $searchModelPermohonanPendidikanKursusPengajian = new PermohonanPendidikanKursusPengajianSearch();
        $dataProviderPermohonanPendidikanKursusPengajian = $searchModelPermohonanPendidikanKursusPengajian->search($queryPar);
        
        $model = new PermohonanPendidikan();
        
        $model->tarikh_permohonan = GeneralFunction::getCurrentTimestamp();
        $model->kelulusan = RefStatusPermohonanPendidikan::DALAM_PROSES;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $file = UploadedFile::getInstance($model, 'muat_naik');
            if($file){
                $model->muat_naik = Upload::uploadFile($file, Upload::permohonanPendidikanFolder, $model->permohonan_pendidikan_id);
            }
            
            if(isset(Yii::$app->session->id)){
                PermohonanPendidikanKeputusanSpm::updateAll(['permohonan_pendidikan_id' => $model->permohonan_pendidikan_id], 'session_id = "'.Yii::$app->session->id.'"');
                PermohonanPendidikanKeputusanSpm::updateAll(['session_id' => ''], 'permohonan_pendidikan_id = "'.$model->permohonan_pendidikan_id.'"');
                
                PermohonanPendidikanKursusPengajian::updateAll(['permohonan_pendidikan_id' => $model->permohonan_pendidikan_id], 'session_id = "'.Yii::$app->session->id.'"');
                PermohonanPendidikanKursusPengajian::updateAll(['session_id' => ''], 'permohonan_pendidikan_id = "'.$model->permohonan_pendidikan_id.'"');
                
                $this->generateSPMResult($model->permohonan_pendidikan_id);
            }
            
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->permohonan_pendidikan_id]);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
                'searchModelPermohonanPendidikanKeputusanSpm' => $searchModelPermohonanPendidikanKeputusanSpm,
                'dataProviderPermohonanPendidikanKeputusanSpm' => $dataProviderPermohonanPendidikanKeputusanSpm,
                'searchModelPermohonanPendidikanKursusPengajian' => $searchModelPermohonanPendidikanKursusPengajian,
                'dataProviderPermohonanPendidikanKursusPengajian' => $dataProviderPermohonanPendidikanKursusPengajian,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Updates an existing PermohonanPendidikan model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $queryPar = null;
        
        $queryPar['PermohonanPendidikanKeputusanSpmSearch']['permohonan_pendidikan_id'] = $id;
        $queryPar['PermohonanPendidikanKursusPengajianSearch']['permohonan_pendidikan_id'] = $id;
        
        $searchModelPermohonanPendidikanKeputusanSpm = new PermohonanPendidikanKeputusanSpmSearch();
        $dataProviderPermohonanPendidikanKeputusanSpm = $searchModelPermohonanPendidikanKeputusanSpm->search($queryPar);
        
        $searchModelPermohonanPendidikanKursusPengajian = new PermohonanPendidikanKursusPengajianSearch();
        $dataProviderPermohonanPendidikanKursusPengajian = $searchModelPermohonanPendidikanKursusPengajian->search($queryPar);
        
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $file = UploadedFile::getInstance($model, 'muat_naik');
            if($file){
                $model->muat_naik = Upload::uploadFile($file, Upload::permohonanPendidikanFolder, $model->permohonan_pendidikan_id);
            }
            
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->permohonan_pendidikan_id]);
            }
        } else {
            return $this->render('update', [
                'model' => $model,
                'searchModelPermohonanPendidikanKeputusanSpm' => $searchModelPermohonanPendidikanKeputusanSpm,
                'dataProviderPermohonanPendidikanKeputusanSpm' => $dataProviderPermohonanPendidikanKeputusanSpm,
                'searchModelPermohonanPendidikanKursusPengajian' => $searchModelPermohonanPendidikanKursusPengajian,
                'dataProviderPermohonanPendidikanKursusPengajian' => $dataProviderPermohonanPendidikanKursusPengajian,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Deletes an existing PermohonanPendidikan model.
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
     * Finds the PermohonanPendidikan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PermohonanPendidikan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PermohonanPendidikan::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    // Add function for delete image or file
    public function actionDeleteupload($id, $field)
    {
            $img = $this->findModel($id)->$field;
            
            if($img){
                if (!unlink($img)) {
                    return false;
                }
            }

            $img = $this->findModel($id);
            $img->$field = NULL;
            $img->update();

            return $this->redirect(['update', 'id' => $id]);
    }
    
    protected function generateSPMResult($permohonan_pendidikan_id)
    {
        if (($KeputusanModels = PermohonanPendidikanKeputusanSpm::find()->joinWith(['refSubjekSpm'])->
                        where(['permohonan_pendidikan_id'=>$permohonan_pendidikan_id])->orderBy('sort')->all()) !== null){
            $SPMresult = "";
            foreach($KeputusanModels as $KeputusanModel){
                if($SPMresult != ""){
                    $SPMresult .= "   |   ";
                }
                $SPMresult .= $KeputusanModel['refSubjekSpm']['kod'] . " - " . $KeputusanModel->keputusan;
            }

            if (($modelPermohonanPendidikan = PermohonanPendidikan::findOne($permohonan_pendidikan_id)) !== null) {
                $modelPermohonanPendidikan->keputusan_spm = $SPMresult;
                $modelPermohonanPendidikan->save();
            }
        }
    }
    
    public function actionLaporanSenaraiPermohonanPendidikan()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new MsnLaporanSenaraiPermohonanPendidikan();
        $model->format = 'html';

        if ($model->load(Yii::$app->request->post())) {
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-laporan-senarai-permohonan-pendidikan'
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'sukan' => $model->sukan
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-laporan-senarai-permohonan-pendidikan'
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'sukan' => $model->sukan
                    , 'format' => $model->format
                ]);
            }
        } 

        return $this->render('laporan_senarai_permohonan_pendidikan', [
            'model' => $model,
            'readonly' => false,
        ]);
    }
    
    public function actionGenerateLaporanSenaraiPermohonanPendidikan($tarikh_dari, $tarikh_hingga, $sukan, $format)
    {
        if($tarikh_dari == "") $tarikh_dari = array();
        else $tarikh_dari = array($tarikh_dari);
        
        if($tarikh_hingga == "") $tarikh_hingga = array();
        else $tarikh_hingga = array($tarikh_hingga);
        
        if($sukan == "") $sukan = array();
        else $sukan = array($sukan);
        
        $controls = array(
            'FROM_DATE' => $tarikh_dari,
            'TO_DATE' => $tarikh_hingga,
            'SUKAN' => $sukan,
        );
        
        GeneralFunction::generateReport('/spsb/MSN/LaporanSenaraiPermohonanPendidikan', $format, $controls, 'laporan_senarai_permohonan_pendidikan');
    }
}
