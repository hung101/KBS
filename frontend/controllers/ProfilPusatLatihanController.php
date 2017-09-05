<?php

namespace frontend\controllers;

use Yii;
use app\models\ProfilPusatLatihan;
use frontend\models\ProfilPusatLatihanSearch;
use app\models\ProfilPusatLatihanJurulatih;
use frontend\models\ProfilPusatLatihanJurulatihSearch;
use app\models\ProfilPusatLatihanPeralatan;
use frontend\models\ProfilPusatLatihanPeralatanSearch;
use app\models\ProfilPusatLatihanKemudahan;
use frontend\models\ProfilPusatLatihanKemudahanSearch;
use app\models\ProfilPusatLatihanSukan;
use frontend\models\ProfilPusatLatihanSukanSearch;
use app\models\ProfilPusatLatihanProgram;
use frontend\models\ProfilPusatLatihanProgramSearch;
use app\models\MsnLaporanPusatLatihan;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\BaseUrl;
use yii\helpers\Json;

use app\models\general\GeneralVariable;
use common\models\general\GeneralFunction;

// table reference
use app\models\RefNegeri;
use app\models\RefBandar;
use app\models\RefStatusPusatLatihan;
use app\models\RefSukan;
use app\models\RefProgramMsn;
use app\models\RefStatusBantuanPenganjuranKejohanan;
use app\models\RefJenisMaklumatPusatLatihan;
use app\models\RefKategoriPusatLatihan;

/**
 * ProfilPusatLatihanController implements the CRUD actions for ProfilPusatLatihan model.
 */
class ProfilPusatLatihanController extends Controller
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
     * Lists all ProfilPusatLatihan models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $queryParams = Yii::$app->request->queryParams;
        
        if(Yii::$app->user->identity->ppn_negeri){
            $queryParams['ProfilPusatLatihanSearch']['negeri_id'] = Yii::$app->user->identity->ppn_negeri;
        }
        
        if(isset(Yii::$app->user->identity->peranan_akses['MSN']['profil-pusat-latihan']['kelulusan'])) {
            $queryParams['ProfilPusatLatihanSearch']['hantar_flag'] = 1;
        }
        
        $searchModel = new ProfilPusatLatihanSearch();
        $dataProvider = $searchModel->search($queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ProfilPusatLatihan model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = $this->findModel($id);
        
        $ref = RefNegeri::findOne(['id' => $model->alamat_negeri]);
        $model->alamat_negeri = $ref['desc'];
        
        $ref = RefBandar::findOne(['id' => $model->alamat_bandar]);
        $model->alamat_bandar = $ref['desc'];
        
        $ref = RefStatusPusatLatihan::findOne(['id' => $model->status]);
        $model->status = $ref['desc'];
        
        $ref = RefSukan::findOne(['id' => $model->sukan]);
        $model->sukan = $ref['desc'];
        
        $ref = RefProgramMsn::findOne(['id' => $model->program]);
        $model->program = $ref['desc'];
        
        $model->status_permohonan_id = $model->status_permohonan;
        $ref = RefStatusBantuanPenganjuranKejohanan::findOne(['id' => $model->status_permohonan]);
        $model->status_permohonan = $ref['desc'];
        
        $ref = RefJenisMaklumatPusatLatihan::findOne(['id' => $model->jenis_maklumat]);
        $model->jenis_maklumat = $ref['desc'];
        
        $ref = RefKategoriPusatLatihan::findOne(['id' => $model->kategori]);
        $model->kategori = $ref['desc'];
        
        if($model->tarikh_program_bermula != "") {$model->tarikh_program_bermula = GeneralFunction::convert($model->tarikh_program_bermula, GeneralFunction::TYPE_DATE);}
        if($model->tarikh_jkk_jkb != "") {$model->tarikh_jkk_jkb = GeneralFunction::convert($model->tarikh_jkk_jkb, GeneralFunction::TYPE_DATE);}
        
        $queryPar = null;
        
        $queryPar['ProfilPusatLatihanJurulatihSearch']['profil_pusat_latihan_id'] = $id;
        $queryPar['ProfilPusatLatihanPeralatanSearch']['profil_pusat_latihan_id'] = $id;
        $queryPar['ProfilPusatLatihanKemudahanSearch']['profil_pusat_latihan_id'] = $id;
        $queryPar['ProfilPusatLatihanSukanSearch']['profil_pusat_latihan_id'] = $id;
        $queryPar['ProfilPusatLatihanProgramSearch']['profil_pusat_latihan_id'] = $id;
        
        $searchModelProfilPusatLatihanJurulatih = new ProfilPusatLatihanJurulatihSearch();
        $dataProviderProfilPusatLatihanJurulatih= $searchModelProfilPusatLatihanJurulatih->search($queryPar);
        
        $searchModelProfilPusatLatihanPeralatan = new ProfilPusatLatihanPeralatanSearch();
        $dataProviderProfilPusatLatihanPeralatan= $searchModelProfilPusatLatihanPeralatan->search($queryPar);
        
        $searchModelProfilPusatLatihanKemudahan = new ProfilPusatLatihanKemudahanSearch();
        $dataProviderProfilPusatLatihanKemudahan = $searchModelProfilPusatLatihanKemudahan->search($queryPar);
        
        $searchModelProfilPusatLatihanSukan = new ProfilPusatLatihanSukanSearch();
        $dataProviderProfilPusatLatihanSukan = $searchModelProfilPusatLatihanSukan->search($queryPar);
        
        $searchModelProfilPusatLatihanProgram = new ProfilPusatLatihanProgramSearch();
        $dataProviderProfilPusatLatihanProgram = $searchModelProfilPusatLatihanProgram->search($queryPar);
        
        return $this->render('view', [
            'model' => $model,
            'searchModelProfilPusatLatihanJurulatih' => $searchModelProfilPusatLatihanJurulatih,
            'dataProviderProfilPusatLatihanJurulatih' => $dataProviderProfilPusatLatihanJurulatih,
            'searchModelProfilPusatLatihanPeralatan' => $searchModelProfilPusatLatihanPeralatan,
            'dataProviderProfilPusatLatihanPeralatan' => $dataProviderProfilPusatLatihanPeralatan,
            'searchModelProfilPusatLatihanKemudahan' => $searchModelProfilPusatLatihanKemudahan,
            'dataProviderProfilPusatLatihanKemudahan' => $dataProviderProfilPusatLatihanKemudahan,
            'searchModelProfilPusatLatihanSukan' => $searchModelProfilPusatLatihanSukan,
            'dataProviderProfilPusatLatihanSukan' => $dataProviderProfilPusatLatihanSukan,
            'searchModelProfilPusatLatihanProgram' => $searchModelProfilPusatLatihanProgram,
            'dataProviderProfilPusatLatihanProgram' => $dataProviderProfilPusatLatihanProgram,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new ProfilPusatLatihan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new ProfilPusatLatihan();
        
        $queryPar = null;
        
        Yii::$app->session->open();
        
        if(isset(Yii::$app->session->id)){
            $queryPar['ProfilPusatLatihanJurulatihSearch']['session_id'] = Yii::$app->session->id;
            $queryPar['ProfilPusatLatihanPeralatanSearch']['session_id'] = Yii::$app->session->id;
            $queryPar['ProfilPusatLatihanKemudahanSearch']['session_id'] = Yii::$app->session->id;
            $queryPar['ProfilPusatLatihanSukanSearch']['session_id'] = Yii::$app->session->id;
            $queryPar['ProfilPusatLatihanProgramSearch']['session_id'] = Yii::$app->session->id;
        }
        
        $searchModelProfilPusatLatihanJurulatih = new ProfilPusatLatihanJurulatihSearch();
        $dataProviderProfilPusatLatihanJurulatih= $searchModelProfilPusatLatihanJurulatih->search($queryPar);
        
        $searchModelProfilPusatLatihanPeralatan = new ProfilPusatLatihanPeralatanSearch();
        $dataProviderProfilPusatLatihanPeralatan= $searchModelProfilPusatLatihanPeralatan->search($queryPar);
        
        $searchModelProfilPusatLatihanKemudahan = new ProfilPusatLatihanKemudahanSearch();
        $dataProviderProfilPusatLatihanKemudahan = $searchModelProfilPusatLatihanKemudahan->search($queryPar);
        
        $searchModelProfilPusatLatihanSukan = new ProfilPusatLatihanSukanSearch();
        $dataProviderProfilPusatLatihanSukan = $searchModelProfilPusatLatihanSukan->search($queryPar);
        
        $searchModelProfilPusatLatihanProgram = new ProfilPusatLatihanProgramSearch();
        $dataProviderProfilPusatLatihanProgram = $searchModelProfilPusatLatihanProgram->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if(isset(Yii::$app->session->id)){
                ProfilPusatLatihanJurulatih::updateAll(['profil_pusat_latihan_id' => $model->profil_pusat_latihan_id], 'session_id = "'.Yii::$app->session->id.'"');
                ProfilPusatLatihanJurulatih::updateAll(['session_id' => ''], 'profil_pusat_latihan_id = "'.$model->profil_pusat_latihan_id.'"');
                
                ProfilPusatLatihanPeralatan::updateAll(['profil_pusat_latihan_id' => $model->profil_pusat_latihan_id], 'session_id = "'.Yii::$app->session->id.'"');
                ProfilPusatLatihanPeralatan::updateAll(['session_id' => ''], 'profil_pusat_latihan_id = "'.$model->profil_pusat_latihan_id.'"');
                
                ProfilPusatLatihanKemudahan::updateAll(['profil_pusat_latihan_id' => $model->profil_pusat_latihan_id], 'session_id = "'.Yii::$app->session->id.'"');
                ProfilPusatLatihanKemudahan::updateAll(['session_id' => ''], 'profil_pusat_latihan_id = "'.$model->profil_pusat_latihan_id.'"');
                
                ProfilPusatLatihanSukan::updateAll(['profil_pusat_latihan_id' => $model->profil_pusat_latihan_id], 'session_id = "'.Yii::$app->session->id.'"');
                ProfilPusatLatihanSukan::updateAll(['session_id' => ''], 'profil_pusat_latihan_id = "'.$model->profil_pusat_latihan_id.'"');
                
                ProfilPusatLatihanProgram::updateAll(['profil_pusat_latihan_id' => $model->profil_pusat_latihan_id], 'session_id = "'.Yii::$app->session->id.'"');
                ProfilPusatLatihanProgram::updateAll(['session_id' => ''], 'profil_pusat_latihan_id = "'.$model->profil_pusat_latihan_id.'"');
            }
            
            return $this->redirect(['view', 'id' => $model->profil_pusat_latihan_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'searchModelProfilPusatLatihanJurulatih' => $searchModelProfilPusatLatihanJurulatih,
                'dataProviderProfilPusatLatihanJurulatih' => $dataProviderProfilPusatLatihanJurulatih,
                'searchModelProfilPusatLatihanPeralatan' => $searchModelProfilPusatLatihanPeralatan,
                'dataProviderProfilPusatLatihanPeralatan' => $dataProviderProfilPusatLatihanPeralatan,
                'searchModelProfilPusatLatihanKemudahan' => $searchModelProfilPusatLatihanKemudahan,
                'dataProviderProfilPusatLatihanKemudahan' => $dataProviderProfilPusatLatihanKemudahan,
                'searchModelProfilPusatLatihanSukan' => $searchModelProfilPusatLatihanSukan,
                'dataProviderProfilPusatLatihanSukan' => $dataProviderProfilPusatLatihanSukan,
                'searchModelProfilPusatLatihanProgram' => $searchModelProfilPusatLatihanProgram,
                'dataProviderProfilPusatLatihanProgram' => $dataProviderProfilPusatLatihanProgram,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Updates an existing ProfilPusatLatihan model.
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
        
        $queryPar['ProfilPusatLatihanJurulatihSearch']['profil_pusat_latihan_id'] = $id;
        $queryPar['ProfilPusatLatihanPeralatanSearch']['profil_pusat_latihan_id'] = $id;
        $queryPar['ProfilPusatLatihanKemudahanSearch']['profil_pusat_latihan_id'] = $id;
        $queryPar['ProfilPusatLatihanSukanSearch']['profil_pusat_latihan_id'] = $id;
        $queryPar['ProfilPusatLatihanProgramSearch']['profil_pusat_latihan_id'] = $id;
        
        $searchModelProfilPusatLatihanJurulatih = new ProfilPusatLatihanJurulatihSearch();
        $dataProviderProfilPusatLatihanJurulatih= $searchModelProfilPusatLatihanJurulatih->search($queryPar);
        
        $searchModelProfilPusatLatihanPeralatan = new ProfilPusatLatihanPeralatanSearch();
        $dataProviderProfilPusatLatihanPeralatan= $searchModelProfilPusatLatihanPeralatan->search($queryPar);
        
        $searchModelProfilPusatLatihanKemudahan = new ProfilPusatLatihanKemudahanSearch();
        $dataProviderProfilPusatLatihanKemudahan = $searchModelProfilPusatLatihanKemudahan->search($queryPar);
        
        $searchModelProfilPusatLatihanSukan = new ProfilPusatLatihanSukanSearch();
        $dataProviderProfilPusatLatihanSukan = $searchModelProfilPusatLatihanSukan->search($queryPar);
        
        $searchModelProfilPusatLatihanProgram = new ProfilPusatLatihanProgramSearch();
        $dataProviderProfilPusatLatihanProgram = $searchModelProfilPusatLatihanProgram->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->profil_pusat_latihan_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'searchModelProfilPusatLatihanJurulatih' => $searchModelProfilPusatLatihanJurulatih,
                'dataProviderProfilPusatLatihanJurulatih' => $dataProviderProfilPusatLatihanJurulatih,
                'searchModelProfilPusatLatihanPeralatan' => $searchModelProfilPusatLatihanPeralatan,
                'dataProviderProfilPusatLatihanPeralatan' => $dataProviderProfilPusatLatihanPeralatan,
                'searchModelProfilPusatLatihanKemudahan' => $searchModelProfilPusatLatihanKemudahan,
                'dataProviderProfilPusatLatihanKemudahan' => $dataProviderProfilPusatLatihanKemudahan,
                'searchModelProfilPusatLatihanSukan' => $searchModelProfilPusatLatihanSukan,
                'dataProviderProfilPusatLatihanSukan' => $dataProviderProfilPusatLatihanSukan,
                'searchModelProfilPusatLatihanProgram' => $searchModelProfilPusatLatihanProgram,
                'dataProviderProfilPusatLatihanProgram' => $dataProviderProfilPusatLatihanProgram,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Deletes an existing ProfilPusatLatihan model.
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
     * Updates an existing ProfilPusatLatihan model.
     * If approved is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionHantar($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = $this->findModel($id);
        
        $model->hantar_flag = 1; // set approved
        $model->tarikh_hantar = GeneralFunction::getCurrentTimestamp(); // set date capture
        
        $model->status_permohonan = RefStatusBantuanPenganjuranKejohanan::SEDANG_DIPROSES;
        
        $model->save();
        
        return $this->redirect(['view', 'id' => $model->profil_pusat_latihan_id]);
    }
    
    public function actionPrint($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }  
        $model = $this->findModel($id);
        
        $ref = RefNegeri::findOne(['id' => $model->alamat_negeri]);
        $model->alamat_negeri = $ref['desc'];
        
        $ref = RefBandar::findOne(['id' => $model->alamat_bandar]);
        $model->alamat_bandar = $ref['desc'];
        
        $ref = RefStatusPusatLatihan::findOne(['id' => $model->status]);
        $model->status = $ref['desc'];
        
        $ref = RefSukan::findOne(['id' => $model->sukan]);
        $model->sukan = $ref['desc'];
        
        $ref = RefProgramMsn::findOne(['id' => $model->program]);
        $model->program = $ref['desc'];
        
        $model->status_permohonan_id = $model->status_permohonan;
        $ref = RefStatusBantuanPenganjuranKejohanan::findOne(['id' => $model->status_permohonan]);
        $model->status_permohonan = $ref['desc'];
        
        $ref = RefJenisMaklumatPusatLatihan::findOne(['id' => $model->jenis_maklumat]);
        $model->jenis_maklumat = $ref['desc'];
        
        $ref = RefKategoriPusatLatihan::findOne(['id' => $model->kategori]);
        $model->kategori = $ref['desc'];
        
        if($model->tarikh_program_bermula != "") {$model->tarikh_program_bermula = GeneralFunction::convert($model->tarikh_program_bermula, GeneralFunction::TYPE_DATE);}
        if($model->tarikh_jkk_jkb != "") {$model->tarikh_jkk_jkb = GeneralFunction::convert($model->tarikh_jkk_jkb, GeneralFunction::TYPE_DATE);}
        
        $ProfilPusatLatihanKemudahan = ProfilPusatLatihanKemudahan::find()->where(['profil_pusat_latihan_id' => $model->profil_pusat_latihan_id])->all();

        $ProfilPusatLatihanPeralatan = ProfilPusatLatihanPeralatan::find()->where(['profil_pusat_latihan_id' => $model->profil_pusat_latihan_id])->all();

        $pdf = new \mPDF('utf-8', 'A4');

        $pdf->title = 'Permohonan / Maklumat Pusat Latihan';

        $stylesheet = file_get_contents('css/report.css');

        $pdf->WriteHTML($stylesheet,1);
        
        $pdf->WriteHTML($this->renderpartial('print', [
            'model'  => $model,
            'title' => $pdf->title,
            'ProfilPusatLatihanKemudahan'  => $ProfilPusatLatihanKemudahan,
            'ProfilPusatLatihanPeralatan'  => $ProfilPusatLatihanPeralatan,
        ]));

        $pdf->Output(str_replace(' ', '_', $pdf->title).'_'.$model->profil_pusat_latihan_id.'.pdf', 'I');
    }

    /**
     * Finds the ProfilPusatLatihan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ProfilPusatLatihan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ProfilPusatLatihan::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    /**
     * Get Bandars base on Negeri id
     * @param integer $id
     * @return mixed
     */
    public function actionGetPusatLatihanByJurulatih()
    {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $cat_id = empty($parents[0]) ? null : $parents[0];
                //$subcat_id = empty($parents[1]) ? null : $parents[1];
                $out = self::getChild($cat_id); 
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
     * get list of Pusat Latihan by Jurulatih
     * @param integer $id
     * @return Array PusatLatihans
     */
    public static function getChild($jurulatih_id) {
        $data = ProfilPusatLatihanJurulatih::find()
                ->joinWith(['refProfilPusatLatihan'])
               ->where(['jurulatih'=>$jurulatih_id])
                ->select(['tbl_profil_pusat_latihan.profil_pusat_latihan_id AS id','tbl_profil_pusat_latihan.nama_pusat_latihan AS name'])
                ->groupBy('tbl_profil_pusat_latihan.profil_pusat_latihan_id')
                ->asArray()->createCommand()->queryAll();
        
        $value = (count($data) == 0) ? ['' => ''] : $data;

        return $value;
    }
    
    public function actionLaporanPusatLatihan()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new MsnLaporanPusatLatihan();
        $model->format = 'html';

        if ($model->load(Yii::$app->request->post())) {
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-laporan-pusat-latihan'
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'program' => $model->program
                    , 'sukan' => $model->sukan
                    , 'negeri' => $model->negeri
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-laporan-pusat-latihan'
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'program' => $model->program
                    , 'sukan' => $model->sukan
                    , 'negeri' => $model->negeri
                    , 'format' => $model->format
                ]);
            }
        } 

        return $this->render('laporan_pusat_latihan', [
            'model' => $model,
            'readonly' => false,
        ]);
    }
    
    public function actionGenerateLaporanPusatLatihan($tarikh_dari, $tarikh_hingga, $program, $sukan, $negeri, $format)
    {
        if($tarikh_dari == "") $tarikh_dari = array();
        else $tarikh_dari = array($tarikh_dari);
        
        if($tarikh_hingga == "") $tarikh_hingga = array();
        else $tarikh_hingga = array($tarikh_hingga);
        
        if($program == "") $program = array();
        else $program = array($program);
        
        if($sukan == "") $sukan = array();
        else $sukan = array($sukan);
        
        if($negeri == "") $negeri = array();
        else $negeri = array($negeri);
        
        $controls = array(
            'FROM_DATE' => $tarikh_dari,
            'TO_DATE' => $tarikh_hingga,
            'SUKAN' => $sukan,
            'PROGRAM' => $program,
            'NEGERI' => $negeri,
        );
        
        GeneralFunction::generateReport('/spsb/MSN/LaporanPusatLatihan', $format, $controls, 'laporan_pusat_latihan');
    }
}
