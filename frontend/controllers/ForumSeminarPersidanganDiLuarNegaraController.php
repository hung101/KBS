<?php

namespace frontend\controllers;

use Yii;
use app\models\ForumSeminarPersidanganDiLuarNegara;
use frontend\models\ForumSeminarPersidanganDiLuarNegaraSearch;
use app\models\InformasiPermohonanProgramAntarabangsa;
use frontend\models\InformasiPermohonanProgramAntarabangsaSearch;
use app\models\ForumSeminarPeserta;
use frontend\models\ForumSeminarPesertaSearch;

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
use app\models\RefJenisProgramBantuanMenghadiriProgramAntarabangsa;
use app\models\RefNegara;
use app\models\RefStatusPermohonanBantuanMenghadiriProgramAntarabangs;
use app\models\ProfilBadanSukan;
use app\models\RefPeringkatBantuanMenghadiriProgramAntarabangsa;
use app\models\RefJawatanBantuanMenghadiriProgramAntarabangsa;

/**
 * ForumSeminarPersidanganDiLuarNegaraController implements the CRUD actions for ForumSeminarPersidanganDiLuarNegara model.
 */
class ForumSeminarPersidanganDiLuarNegaraController extends Controller
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
     * Lists all ForumSeminarPersidanganDiLuarNegara models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $searchModel = new ForumSeminarPersidanganDiLuarNegaraSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ForumSeminarPersidanganDiLuarNegara model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = $this->findModel($id);
        
        $ref = RefJenisProgramBantuanMenghadiriProgramAntarabangsa::findOne(['id' => $model->jenis_program]);
        $model->jenis_program = $ref['desc'];
        
        $ref = RefNegara::findOne(['id' => $model->negara]);
        $model->negara = $ref['desc'];
        
        $ref = RefStatusPermohonanBantuanMenghadiriProgramAntarabangs::findOne(['id' => $model->status_permohonan]);
        $model->status_permohonan = $ref['desc'];
        
        $ref = ProfilBadanSukan::findOne(['profil_badan_sukan' => $model->persatuan]);
        $model->persatuan = $ref['nama_badan_sukan'];
        
        $ref = RefPeringkatBantuanMenghadiriProgramAntarabangsa::findOne(['id' => $model->peringkat]);
        $model->peringkat = $ref['desc'];
        
        $ref = RefJawatanBantuanMenghadiriProgramAntarabangsa::findOne(['id' => $model->jawatan]);
        $model->jawatan = $ref['desc'];
        
        if($model->tarikh != "") {$model->tarikh = GeneralFunction::convert($model->tarikh, GeneralFunction::TYPE_DATE);}
        if($model->tarikh_tamat != "") {$model->tarikh_tamat = GeneralFunction::convert($model->tarikh_tamat, GeneralFunction::TYPE_DATE);}
        if($model->tarikh_kelulusan_jkb != "") {$model->tarikh_kelulusan_jkb = GeneralFunction::convert($model->tarikh_kelulusan_jkb, GeneralFunction::TYPE_DATE);}
        
        $queryPar = null;
        
        $queryPar['InformasiPermohonanProgramAntarabangsaSearch']['forum_seminar_persidangan_di_luar_negara_id'] = $id;
		$queryPar['ForumSeminarPesertaSearch']['forum_seminar_persidangan_di_luar_negara_id'] = $id;
        
        $searchModelInformasiPermohonanProgramAntarabangsa  = new InformasiPermohonanProgramAntarabangsaSearch();
        $dataProviderInformasiPermohonanProgramAntarabangsa = $searchModelInformasiPermohonanProgramAntarabangsa->search($queryPar);
		
		$searchModelForumSeminarPeserta = new ForumSeminarPesertaSearch();
        $dataProviderForumSeminarPeserta = $searchModelForumSeminarPeserta->search($queryPar);
        
        return $this->render('view', [
            'model' => $model,
            'searchModelInformasiPermohonanProgramAntarabangsa' => $searchModelInformasiPermohonanProgramAntarabangsa,
            'dataProviderInformasiPermohonanProgramAntarabangsa' => $dataProviderInformasiPermohonanProgramAntarabangsa,
			'searchModelForumSeminarPeserta' => $searchModelForumSeminarPeserta,
            'dataProviderForumSeminarPeserta' => $dataProviderForumSeminarPeserta,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new ForumSeminarPersidanganDiLuarNegara model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->isGuest) {
            $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new ForumSeminarPersidanganDiLuarNegara();
        
        if(Yii::$app->user->identity->profil_badan_sukan){
            $model->persatuan = Yii::$app->user->identity->profil_badan_sukan;
        }
        
        $queryPar = null;
        
        Yii::$app->session->open();
        
        if(isset(Yii::$app->session->id)){
            $queryPar['InformasiPermohonanProgramAntarabangsaSearch']['session_id'] = Yii::$app->session->id;
			$queryPar['ForumSeminarPesertaSearch']['session_id'] = Yii::$app->session->id;
        }
        
        $searchModelInformasiPermohonanProgramAntarabangsa  = new InformasiPermohonanProgramAntarabangsaSearch();
        $dataProviderInformasiPermohonanProgramAntarabangsa = $searchModelInformasiPermohonanProgramAntarabangsa->search($queryPar);
		
		$searchModelForumSeminarPeserta = new ForumSeminarPesertaSearch();
        $dataProviderForumSeminarPeserta = $searchModelForumSeminarPeserta->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
			$file = UploadedFile::getInstance($model, 'surat_permohonan');
            $filename = $model->forum_seminar_persidangan_di_luar_negara_id . "-surat_permohonan";
            if($file){
                $model->surat_permohonan = Upload::uploadFile($file, Upload::forumSeminarPersidanganDiLuarNegaraFolder, $filename);
				$model->save();
            }			
			
			$file = UploadedFile::getInstance($model, 'surat_jemputan');
            $filename = $model->forum_seminar_persidangan_di_luar_negara_id . "-surat_jemputan";
            if($file){
                $model->surat_jemputan = Upload::uploadFile($file, Upload::forumSeminarPersidanganDiLuarNegaraFolder, $filename);
				$model->save();
            }
			
            if(isset(Yii::$app->session->id)){
                InformasiPermohonanProgramAntarabangsa::updateAll(['forum_seminar_persidangan_di_luar_negara_id' => $model->forum_seminar_persidangan_di_luar_negara_id], 'session_id = "'.Yii::$app->session->id.'"');
                InformasiPermohonanProgramAntarabangsa::updateAll(['session_id' => ''], 'forum_seminar_persidangan_di_luar_negara_id = "'.$model->forum_seminar_persidangan_di_luar_negara_id.'"');
				
				ForumSeminarPeserta::updateAll(['forum_seminar_persidangan_di_luar_negara_id' => $model->forum_seminar_persidangan_di_luar_negara_id], 'session_id = "'.Yii::$app->session->id.'"');
                ForumSeminarPeserta::updateAll(['session_id' => ''], 'forum_seminar_persidangan_di_luar_negara_id = "'.$model->forum_seminar_persidangan_di_luar_negara_id.'"');
            }
            
            return $this->redirect(['view', 'id' => $model->forum_seminar_persidangan_di_luar_negara_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'searchModelInformasiPermohonanProgramAntarabangsa' => $searchModelInformasiPermohonanProgramAntarabangsa,
                'dataProviderInformasiPermohonanProgramAntarabangsa' => $dataProviderInformasiPermohonanProgramAntarabangsa,
				'searchModelForumSeminarPeserta' => $searchModelForumSeminarPeserta,
				'dataProviderForumSeminarPeserta' => $dataProviderForumSeminarPeserta,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Updates an existing ForumSeminarPersidanganDiLuarNegara model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if (Yii::$app->user->isGuest) {
            $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = $this->findModel($id);
		
		$existingSurat = $model->surat_permohonan;
		$existingJemputan = $model->surat_jemputan;
        
        $queryPar = null;
        
        $queryPar['InformasiPermohonanProgramAntarabangsaSearch']['forum_seminar_persidangan_di_luar_negara_id'] = $id;
		$queryPar['ForumSeminarPesertaSearch']['forum_seminar_persidangan_di_luar_negara_id'] = $id;
        
        $searchModelInformasiPermohonanProgramAntarabangsa  = new InformasiPermohonanProgramAntarabangsaSearch();
        $dataProviderInformasiPermohonanProgramAntarabangsa = $searchModelInformasiPermohonanProgramAntarabangsa->search($queryPar);
		
		$searchModelForumSeminarPeserta = new ForumSeminarPesertaSearch();
        $dataProviderForumSeminarPeserta = $searchModelForumSeminarPeserta->search($queryPar);

		if($model->load(Yii::$app->request->post())){	
			$file = UploadedFile::getInstance($model, 'surat_permohonan');

            if($file){
                //valid file to upload
                //upload file to server
                $filename = $model->forum_seminar_persidangan_di_luar_negara_id . "-surat_permohonan";
                $model->surat_permohonan = Upload::uploadFile($file,  Upload::forumSeminarPersidanganDiLuarNegaraFolder, $filename);
            } else {
                $model->surat_permohonan = $existingSurat;
            }
			
			$file = UploadedFile::getInstance($model, 'surat_jemputan');

            if($file){
                $filename = $model->forum_seminar_persidangan_di_luar_negara_id . "-surat_jemputan";
                $model->surat_jemputan = Upload::uploadFile($file,  Upload::forumSeminarPersidanganDiLuarNegaraFolder, $filename);
            } else {
                $model->surat_jemputan = $existingJemputan;
            }
        }
		
        if (Yii::$app->request->post() && $model->save()) {
            return $this->redirect(['view', 'id' => $model->forum_seminar_persidangan_di_luar_negara_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'searchModelInformasiPermohonanProgramAntarabangsa' => $searchModelInformasiPermohonanProgramAntarabangsa,
                'dataProviderInformasiPermohonanProgramAntarabangsa' => $dataProviderInformasiPermohonanProgramAntarabangsa,
				'searchModelForumSeminarPeserta' => $searchModelForumSeminarPeserta,
				'dataProviderForumSeminarPeserta' => $dataProviderForumSeminarPeserta,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Deletes an existing ForumSeminarPersidanganDiLuarNegara model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if (Yii::$app->user->isGuest) {
            $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ForumSeminarPersidanganDiLuarNegara model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ForumSeminarPersidanganDiLuarNegara the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ForumSeminarPersidanganDiLuarNegara::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionLaporanStatistikBantuanMenghadiriProgramAntarabangsa()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new MsnLaporan();
        $model->format = 'html';

        if ($model->load(Yii::$app->request->post())) {
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-laporan-statistik-bantuan-menghadiri-program-antarabangsa'
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-laporan-statistik-bantuan-menghadiri-program-antarabangsa'
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'format' => $model->format
                ]);
            }
        } 

        return $this->render('laporan_statistik_bantuan_menghadiri_program_antarabangsa', [
            'model' => $model,
            'readonly' => false,
        ]);
    }
    
    public function actionGenerateLaporanStatistikBantuanMenghadiriProgramAntarabangsa($tarikh_dari, $tarikh_hingga, $format)
    {
        if($tarikh_dari == "") $tarikh_dari = array();
        else $tarikh_dari = array($tarikh_dari);
        
        if($tarikh_hingga == "") $tarikh_hingga = array();
        else $tarikh_hingga = array($tarikh_hingga);
        
        $controls = array(
            'FROM_DATE' => $tarikh_dari,
            'TO_DATE' => $tarikh_hingga,
        );
        
        GeneralFunction::generateReport('/spsb/MSN/LaporanStatistikBantuanMenghadiriProgramAntarabangsa', $format, $controls, 'laporan_statistik_bantuan_menghadiri_program_antarabangsa');
    }
    
    public function actionLaporanStatistikBantuanMenghadiriProgramAntarabangsaJumlahKelulusan()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new MsnLaporan();
        $model->format = 'html';

        if ($model->load(Yii::$app->request->post())) {
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-laporan-statistik-bantuan-menghadiri-program-antarabangsa-jumlah-kelulusan'
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-laporan-statistik-bantuan-menghadiri-program-antarabangsa-jumlah-kelulusan'
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'format' => $model->format
                ]);
            }
        } 

        return $this->render('laporan_statistik_bantuan_menghadiri_program_antarabangsa_jumlah_kelulusan', [
            'model' => $model,
            'readonly' => false,
        ]);
    }
    
    public function actionGenerateLaporanStatistikBantuanMenghadiriProgramAntarabangsaJumlahKelulusan($tarikh_dari, $tarikh_hingga, $format)
    {
        if($tarikh_dari == "") $tarikh_dari = array();
        else $tarikh_dari = array($tarikh_dari);
        
        if($tarikh_hingga == "") $tarikh_hingga = array();
        else $tarikh_hingga = array($tarikh_hingga);
        
        $controls = array(
            'FROM_DATE' => $tarikh_dari,
            'TO_DATE' => $tarikh_hingga,
        );
        
        GeneralFunction::generateReport('/spsb/MSN/LaporanStatistikBantuanMenghadiriProgramAntarabangsaJumlahKelulusan', $format, $controls, 'laporan_statistik_bantuan_menghadiri_program_antarabangsa_jumlah_kelulusan');
    }
}
