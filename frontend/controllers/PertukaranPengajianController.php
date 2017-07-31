<?php

namespace frontend\controllers;

use Yii;
use app\models\PertukaranPengajian;
use frontend\models\PertukaranPengajianSearch;
use app\models\MsnLaporan;
use app\models\MsnSuratRasmi;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\BaseUrl;

use app\models\general\GeneralVariable;
use common\models\general\GeneralFunction;

// table reference
use app\models\Atlet;
use app\models\RefSebabPermohonanPertukaranPengajian;
use app\models\RefPengajian;
use app\models\RefKategoriPengajian;
use app\models\RefProgramSemasaSukanAtlet;
use app\models\RefSukan;
use app\models\PerancanganProgram;
use app\models\RefStatusPermohonanPendidikan;

/**
 * PertukaranPengajianController implements the CRUD actions for PertukaranPengajian model.
 */
class PertukaranPengajianController extends Controller
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
     * Lists all PertukaranPengajian models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $searchModel = new PertukaranPengajianSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PertukaranPengajian model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = $this->findModel($id);
        
        $ref = Atlet::findOne(['atlet_id' => $model->atlet_id]);
        $model->atlet_id = $ref['nameAndIC'];
        
        $ref = RefSebabPermohonanPertukaranPengajian::findOne(['id' => $model->sebab_pemohonan]);
        $model->sebab_pemohonan = $ref['desc'];
        
        //$ref = RefKategoriPengajian::findOne(['id' => $model->kategori_pengajian]);
        //$model->kategori_pengajian = $ref['desc'];
        
        //$ref = RefPengajian::findOne(['id' => $model->nama_pertukaran_pengajian]);
        //$model->nama_pertukaran_pengajian = $ref['desc'];
        
        $ref = PerancanganProgram::findOne(['perancangan_program_id' => $model->kejohanan_program]);
        $model->kejohanan_program = $ref['nama_program'];
        
        $ref = RefProgramSemasaSukanAtlet::findOne(['id' => $model->program]);
        $model->program = $ref['desc'];
        
        $ref = RefSukan::findOne(['id' => $model->sukan]);
        $model->sukan = $ref['desc'];
        
        $ref = RefStatusPermohonanPendidikan::findOne(['id' => $model->status_permohonan]);
        $model->status_permohonan = $ref['desc'];
        
        if($model->tarikh != "") {$model->tarikh = GeneralFunction::convert($model->tarikh, GeneralFunction::TYPE_DATE);}
        if($model->tarikh_akhir != "") {$model->tarikh_akhir = GeneralFunction::convert($model->tarikh_akhir, GeneralFunction::TYPE_DATE);}
        if($model->tarikh_permohonan != "") {$model->tarikh_permohonan = GeneralFunction::convert($model->tarikh_permohonan, GeneralFunction::TYPE_DATETIME);}
        
        return $this->render('view', [
            'model' => $model,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new PertukaranPengajian model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new PertukaranPengajian();
        
        $model->tarikh_permohonan = GeneralFunction::getCurrentTimestamp();
        $model->status_permohonan = RefStatusPermohonanPendidikan::DALAM_PROSES;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->pertukaran_pengajian_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Updates an existing PertukaranPengajian model.
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

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->pertukaran_pengajian_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Deletes an existing PertukaranPengajian model.
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
     * Finds the PertukaranPengajian model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PertukaranPengajian the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PertukaranPengajian::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionLaporanPermohonanPelepasan()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new MsnLaporan();
        $model->format = 'html';

        if ($model->load(Yii::$app->request->post())) {
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-laporan-permohonan-pelepasan'
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-laporan-permohonan-pelepasan'
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'format' => $model->format
                ]);
            }
        } 

        return $this->render('laporan_permohonan_pelepasan', [
            'model' => $model,
            'readonly' => false,
        ]);
    }
    
    public function actionGenerateLaporanPermohonanPelepasan($tarikh_dari, $tarikh_hingga, $format)
    {
        if($tarikh_dari == "") $tarikh_dari = array();
        else $tarikh_dari = array($tarikh_dari);
        
        if($tarikh_hingga == "") $tarikh_hingga = array();
        else $tarikh_hingga = array($tarikh_hingga);
        
        $controls = array(
            'FROM_DATE' => $tarikh_dari,
            'TO_DATE' => $tarikh_hingga,
        );
        
        GeneralFunction::generateReport('/spsb/MSN/LaporanPermohonanPelepasan', $format, $controls, 'laporan_permohonan_pelepasan');
    }
    
    public function actionLaporanPenangguhanUniversiti()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new MsnLaporan();
        $model->format = 'html';

        if ($model->load(Yii::$app->request->post())) {
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-laporan-penangguhan-universiti'
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-laporan-penangguhan-universiti'
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'format' => $model->format
                ]);
            }
        } 

        return $this->render('laporan_penangguhan_universiti', [
            'model' => $model,
            'readonly' => false,
        ]);
    }
    
    public function actionGenerateLaporanPenangguhanUniversiti($tarikh_dari, $tarikh_hingga, $format)
    {
        if($tarikh_dari == "") $tarikh_dari = array();
        else $tarikh_dari = array($tarikh_dari);
        
        if($tarikh_hingga == "") $tarikh_hingga = array();
        else $tarikh_hingga = array($tarikh_hingga);
        
        $controls = array(
            'FROM_DATE' => $tarikh_dari,
            'TO_DATE' => $tarikh_hingga,
        );
        
        GeneralFunction::generateReport('/spsb/MSN/LaporanPenangguhanUniversiti', $format, $controls, 'laporan_penangguhan_universiti');
    }
	
    public function actionSurat($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }    
        
        $model = new MsnSuratRasmi();

        if ($model->load(Yii::$app->request->post())) {
            $parentModel = $this->findModel($id);
			
            $ref = Atlet::findOne(['atlet_id' => $parentModel->atlet_id]);
            $parentModel->atlet_id = $ref['name_penuh'];

            //$ref = RefPengajian::findOne(['id' => $parentModel->nama_pertukaran_pengajian]);
            //$parentModel->nama_pertukaran_pengajian = $ref['desc'];

            $ref = PerancanganProgram::findOne(['perancangan_program_id' => $parentModel->kejohanan_program]);
            $parentModel->kejohanan_program = $ref['nama_program'];

            $ref = RefProgramSemasaSukanAtlet::findOne(['id' => $parentModel->program]);
            $parentModel->program = $ref['desc'];

            $ref = RefSukan::findOne(['id' => $parentModel->sukan]);
            $parentModel->sukan = $ref['desc'];

            $sebab_pemohonan_id = $parentModel->sebab_pemohonan;
            $ref = RefSebabPermohonanPertukaranPengajian::findOne(['id' => $parentModel->sebab_pemohonan]);
            $parentModel->sebab_pemohonan = $ref['desc'];

            if($sebab_pemohonan_id == RefSebabPermohonanPertukaranPengajian::PERTUKARAN)//pertukaran, 2 penangguhan
            {
                    $targetView = "generate_surat_pertukaran";
            } 
            else if($sebab_pemohonan_id == RefSebabPermohonanPertukaranPengajian::PENANGGUHAN){
                    $targetView = "generate_surat_penangguhan";
            }
            else if($sebab_pemohonan_id == RefSebabPermohonanPertukaranPengajian::PELEPASAN){
                    $targetView = "generate_surat_pelepasan";
            }

            $pdf = new \mPDF('utf-8', 'A4');

            $pdf->title = "Surat Rasmi";
            $stylesheet = file_get_contents('css/report.css');

            $pdf->WriteHTML($stylesheet,1);
            
            $pdf->WriteHTML($this->renderpartial($targetView, [
                 'parentModel'  => $parentModel,
                 'model' => $model,
            ]));

            $pdf->Output('Surat_rasmi_'.$id.'.pdf', 'I');
        }
        
        return $this->render('surat_rasmi', [
            'model' => $model,
        ]);
    }
}
