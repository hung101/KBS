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
        
        $ref = RefStatusTawaran::findOne(['id' => $model->status_tawaran]);
        $model->status_tawaran = $ref['desc'];
        
         $ref = RefAgensiJurulatih::findOne(['id' => $model->agensi]);
        $model->agensi = $ref['desc'];
        
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
        self::actionDeleteupload($id, 'gambar');
        
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
                if (!unlink($img)) {
                    return false;
                }
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
     * get list of Bandar by Negeri
     * @param integer $id
     * @return Array Bandars
     */
    public static function getChild($program_id, $sukan_id) {
        $data = Jurulatih::find()->joinWith(['refJurulatihSukan'])
               ->where(['tbl_jurulatih_sukan.program'=>$program_id])
               ->andWhere(['tbl_jurulatih_sukan.sukan'=>$sukan_id])
               ->andWhere(['=', 'status_tawaran', RefStatusTawaran::LULUS_TAWARAN])
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
    
    public function actionGenerateLaporanSenaraiJurulatih($program="", $sukan="", $status="", $negeri="", $created_by="", $negara="", $format="")
    {
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
    
    public function actionLaporanJurulatihWajaran()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new MsnLaporanJurulatihWajaran();
        $model->format = 'html';

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-laporan-jurulatih-wajaran'
                    , 'jurulatih' => $model->jurulatih
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-laporan-jurulatih-wajaran'
                    , 'jurulatih' => $model->jurulatih
                    , 'format' => $model->format
                ]);
            }
        } 

        return $this->render('laporan_jurulatih_wajaran', [
            'model' => $model,
            'readonly' => false,
        ]);
    }
    
    public function actionGenerateLaporanJurulatihWajaran($jurulatih, $format)
    {
        if($jurulatih == "") $jurulatih = array();
        else $jurulatih = array($jurulatih);
        
        $controls = array(
            'JURULATIH' => $jurulatih,
        );
        
        GeneralFunction::generateReport('/spsb/MSN/LaporanJurulatihWajaran', $format, $controls, 'laporan_jurulatih_wajaran');
    }
}
