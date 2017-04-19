<?php

namespace frontend\controllers;

use Yii;
use app\models\PermohonanKemudahanTicketKapalTerbang;
use frontend\models\PermohonanKemudahanTicketKapalTerbangSearch;
use app\models\PermohonanKemudahanTicketKapalTerbangSukan;
use frontend\models\PermohonanKemudahanTicketKapalTerbangSukanSearch;
use app\models\PermohonanKemudahanTicketKapalTerbangAtlet;
use frontend\models\PermohonanKemudahanTicketKapalTerbangAtletSearch;
use app\models\PermohonanKemudahanTicketKapalTerbangJurulatih;
use frontend\models\PermohonanKemudahanTicketKapalTerbangJurulatihSearch;
use app\models\PermohonanKemudahanTicketKapalTerbangPegawai;
use frontend\models\PermohonanKemudahanTicketKapalTerbangPegawaiSearch;
use app\models\PermohonanKemudahanTicketKapalTerbangPengurusSukan;
use frontend\models\PermohonanKemudahanTicketKapalTerbangPengurusSukanSearch;
use app\models\PenyertaanSukan;
use app\models\PenyertaanSukanAcara;
use app\models\PenyertaanSukanJurulatih;
use app\models\PenyertaanSukanPegawai;
use app\models\PenyertaanSukanPengurus;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\BaseUrl;
use app\models\MsnLaporan;

// table reference
use app\models\Jurulatih;
use app\models\Atlet;
use app\models\RefProgram;
use app\models\RefSukan;
use app\models\RefBahagianKemudahan;
use app\models\RefCawanganKemudahan;
use app\models\RefStatusPermohonanKemudahan;
use app\models\RefBahagianAduan;
use app\models\RefCawangan;
use app\models\PerancanganProgram;
use app\models\PerancanganProgramPlan;

// contant values
use app\models\general\GeneralLabel;
use common\models\general\GeneralFunction;
use app\models\general\GeneralVariable;

/**
 * PermohonanKemudahanTicketKapalTerbangController implements the CRUD actions for PermohonanKemudahanTicketKapalTerbang model.
 */
class PermohonanKemudahanTicketKapalTerbangController extends Controller
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
     * Lists all PermohonanKemudahanTicketKapalTerbang models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $searchModel = new PermohonanKemudahanTicketKapalTerbangSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PermohonanKemudahanTicketKapalTerbang model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = $this->findModel($id);
        
        //$ref = Atlet::findOne(['atlet_id' => $model->atlet]);
        //$model->atlet = $ref['nameAndIC'];
        
        //$ref = Jurulatih::findOne(['jurulatih_id' => $model->jurulatih]);
        //$model->jurulatih = $ref['nameAndIC'];
        
        //$ref = RefProgram::findOne(['id' => $model->nama_program]);
        $ref = PerancanganProgramPlan::findOne(['perancangan_program_id' => $model->nama_program]);
        $model->nama_program = $ref['nama_program'];
        
        //$ref = RefSukan::findOne(['id' => $model->sukan]);
        //$model->sukan = $ref['desc'];
        
        //$ref = RefBahagianKemudahan::findOne(['id' => $model->bahagian]);
        $ref = RefBahagianAduan::findOne(['id' => $model->bahagian]);
        $model->bahagian = $ref['desc'];
        
        //$ref = RefCawanganKemudahan::findOne(['id' => $model->cawangan]);
        $ref = RefCawangan::findOne(['id' => $model->cawangan]);
        $model->cawangan = $ref['desc'];
        
        $ref = RefStatusPermohonanKemudahan::findOne(['id' => $model->kelulusan]);
        $model->kelulusan = $ref['desc'];
        
        /*$YesNo = GeneralLabel::getYesNoLabel($model->kelulusan);
        $model->kelulusan = $YesNo;*/
        
        $queryPar = null;
        
        
        $queryPar['PermohonanKemudahanTicketKapalTerbangSukanSearch']['permohonan_kemudahan_ticket_kapal_terbang_id'] = $id;
        $queryPar['PermohonanKemudahanTicketKapalTerbangAtletSearch']['permohonan_kemudahan_ticket_kapal_terbang_id'] = $id;
        $queryPar['PermohonanKemudahanTicketKapalTerbangJurulatihSearch']['permohonan_kemudahan_ticket_kapal_terbang_id'] = $id;
        $queryPar['PermohonanKemudahanTicketKapalTerbangPegawaiSearch']['permohonan_kemudahan_ticket_kapal_terbang_id'] = $id;
        $queryPar['PermohonanKemudahanTicketKapalTerbangPengurusSukanSearch']['permohonan_kemudahan_ticket_kapal_terbang_id'] = $id;

        
        $searchModelPermohonanKemudahanTicketKapalTerbangSukan = new PermohonanKemudahanTicketKapalTerbangSukanSearch();
        $dataProviderPermohonanKemudahanTicketKapalTerbangSukan = $searchModelPermohonanKemudahanTicketKapalTerbangSukan->search($queryPar);
        
        $searchModelPermohonanKemudahanTicketKapalTerbangAtlet = new PermohonanKemudahanTicketKapalTerbangAtletSearch();
        $dataProviderPermohonanKemudahanTicketKapalTerbangAtlet = $searchModelPermohonanKemudahanTicketKapalTerbangAtlet->search($queryPar);
        
        $searchModelPermohonanKemudahanTicketKapalTerbangJurulatih = new PermohonanKemudahanTicketKapalTerbangJurulatihSearch();
        $dataProviderPermohonanKemudahanTicketKapalTerbangJurulatih = $searchModelPermohonanKemudahanTicketKapalTerbangJurulatih->search($queryPar);
        
        $searchModelPermohonanKemudahanTicketKapalTerbangPegawai = new PermohonanKemudahanTicketKapalTerbangPegawaiSearch();
        $dataProviderPermohonanKemudahanTicketKapalTerbangPegawai = $searchModelPermohonanKemudahanTicketKapalTerbangPegawai->search($queryPar);
        
        $searchModelPermohonanKemudahanTicketKapalTerbangPengurusSukan = new PermohonanKemudahanTicketKapalTerbangPengurusSukanSearch();
        $dataProviderPermohonanKemudahanTicketKapalTerbangPengurusSukan = $searchModelPermohonanKemudahanTicketKapalTerbangPengurusSukan->search($queryPar);
        
        return $this->render('view', [
            'model' => $model,
            'searchModelPermohonanKemudahanTicketKapalTerbangSukan' => $searchModelPermohonanKemudahanTicketKapalTerbangSukan,
            'dataProviderPermohonanKemudahanTicketKapalTerbangSukan' => $dataProviderPermohonanKemudahanTicketKapalTerbangSukan,
            'searchModelPermohonanKemudahanTicketKapalTerbangAtlet' => $searchModelPermohonanKemudahanTicketKapalTerbangAtlet,
            'dataProviderPermohonanKemudahanTicketKapalTerbangAtlet' => $dataProviderPermohonanKemudahanTicketKapalTerbangAtlet,
            'searchModelPermohonanKemudahanTicketKapalTerbangJurulatih' => $searchModelPermohonanKemudahanTicketKapalTerbangJurulatih,
            'dataProviderPermohonanKemudahanTicketKapalTerbangJurulatih' => $dataProviderPermohonanKemudahanTicketKapalTerbangJurulatih,
            'searchModelPermohonanKemudahanTicketKapalTerbangPegawai' => $searchModelPermohonanKemudahanTicketKapalTerbangPegawai,
            'dataProviderPermohonanKemudahanTicketKapalTerbangPegawai' => $dataProviderPermohonanKemudahanTicketKapalTerbangPegawai,
            'searchModelPermohonanKemudahanTicketKapalTerbangPengurusSukan' => $searchModelPermohonanKemudahanTicketKapalTerbangPengurusSukan,
            'dataProviderPermohonanKemudahanTicketKapalTerbangPengurusSukan' => $dataProviderPermohonanKemudahanTicketKapalTerbangPengurusSukan,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new PermohonanKemudahanTicketKapalTerbang model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id = null)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        $this->unsetAllPrime();
		
        $model = new PermohonanKemudahanTicketKapalTerbang();
        
        $model->kelulusan = RefStatusPermohonanKemudahan::SEDANG_DIPROSES;
        
        //auto populate nama pemohon
        $model->nama_pemohon = Yii::$app->user->identity->full_name;
        
        $queryPar = null;
        
        Yii::$app->session->open();
        
        if(isset(Yii::$app->session->id)){
            $queryPar['PermohonanKemudahanTicketKapalTerbangSukanSearch']['session_id'] = Yii::$app->session->id;
            $queryPar['PermohonanKemudahanTicketKapalTerbangAtletSearch']['session_id'] = Yii::$app->session->id;
            $queryPar['PermohonanKemudahanTicketKapalTerbangJurulatihSearch']['session_id'] = Yii::$app->session->id;
            $queryPar['PermohonanKemudahanTicketKapalTerbangPegawaiSearch']['session_id'] = Yii::$app->session->id;
            $queryPar['PermohonanKemudahanTicketKapalTerbangPengurusSukanSearch']['session_id'] = Yii::$app->session->id;
            
            if($id != null){
                //autopopulate sukan, atlet etc
                $penyertaanSukan = PenyertaanSukan::findOne(['penyertaan_sukan_id' => $id]);
                if(count($penyertaanSukan) > 0) {
                    $model->nama_program = $penyertaanSukan->nama_kejohanan_temasya;
                    if($penyertaanSukan->nama_sukan != null) {
                        $exist = PermohonanKemudahanTicketKapalTerbangSukan::findOne(['session_id' => Yii::$app->session->id, 'sukan' => $penyertaanSukan->nama_sukan]);
                        if($exist === null) {
                            $sukan = new PermohonanKemudahanTicketKapalTerbangSukan;
                            $sukan->sukan = $penyertaanSukan->nama_sukan;
                            $sukan->session_id = Yii::$app->session->id;
                            $sukan->save();
                        }
                    }
                }
                
                $penyertaanSukanAcara = PenyertaanSukanAcara::find()->joinWith('refAtlet')->where(['penyertaan_sukan_id' => $penyertaanSukan->penyertaan_sukan_id])->all();
                foreach($penyertaanSukanAcara as $atlet){
                    $exist = PermohonanKemudahanTicketKapalTerbangAtlet::findOne(['session_id' => Yii::$app->session->id, 'atlet' => $atlet->atlet]);
                    if($exist === null) {
                        $atletTiket = new PermohonanKemudahanTicketKapalTerbangAtlet;
                        $atletTiket->atlet = $atlet->atlet;
                        $atletTiket->session_id = Yii::$app->session->id;
                        $atletTiket->ic_no = $atlet->refAtlet->ic_no;
                        $atletTiket->passport_no = $atlet->refAtlet->passport_no;
                        $atletTiket->hp_no = $atlet->refAtlet->tel_bimbit_no_1;
                        $atletTiket->save();
                    }
                }
                
                $penyertaanSukanJurulatih = PenyertaanSukanJurulatih::find()->joinWith('refJurulatih')->where(['penyertaan_sukan_id' => $penyertaanSukan->penyertaan_sukan_id])->all();
                foreach($penyertaanSukanJurulatih as $jurulatih){
                    $exist = PermohonanKemudahanTicketKapalTerbangJurulatih::findOne(['session_id' => Yii::$app->session->id, 'jurulatih' => $jurulatih->jurulatih_id]);
                    if($exist === null) {
                        $jurulatihTiket = new PermohonanKemudahanTicketKapalTerbangJurulatih;
                        $jurulatihTiket->jurulatih = $jurulatih->jurulatih_id;
                        $jurulatihTiket->session_id = Yii::$app->session->id;
                        $jurulatihTiket->ic_no = $jurulatih->refJurulatih->ic_no;
                        $jurulatihTiket->passport_no = $jurulatih->refJurulatih->passport_no;
                        $jurulatihTiket->hp_no = $jurulatih->refJurulatih->no_telefon_bimbit;
                        $jurulatihTiket->save();
                    }
                }
                
                $penyertaanSukanPegawai = PenyertaanSukanPegawai::find()->where(['penyertaan_sukan_id' => $penyertaanSukan->penyertaan_sukan_id])->all();
                foreach($penyertaanSukanPegawai as $pegawai){
                    $exist = PermohonanKemudahanTicketKapalTerbangPegawai::findOne(['session_id' => Yii::$app->session->id, 'pegawai' => $pegawai->nama]);
                    if($exist === null) {
                        $pegawaiTiket = new PermohonanKemudahanTicketKapalTerbangPegawai;
                        $pegawaiTiket->pegawai = $pegawai->nama;
                        $pegawaiTiket->session_id = Yii::$app->session->id;
                        $pegawaiTiket->save();
                    }
                }
                
                $penyertaanSukanPengurus = PenyertaanSukanPengurus::find()->where(['penyertaan_sukan_id' => $penyertaanSukan->penyertaan_sukan_id])->all();
                foreach($penyertaanSukanPengurus as $pengurus){
                    $exist = PermohonanKemudahanTicketKapalTerbangPengurusSukan::findOne(['session_id' => Yii::$app->session->id, 'pengurus_sukan' => $pengurus->nama]);
                    if($exist === null) {
                        $pengurusTiket = new PermohonanKemudahanTicketKapalTerbangPengurusSukan;
                        $pengurusTiket->pengurus_sukan = $pengurus->nama;
                        $pengurusTiket->session_id = Yii::$app->session->id;
                        $pengurusTiket->save();
                    }
                }
            }
        }
        
        $searchModelPermohonanKemudahanTicketKapalTerbangSukan = new PermohonanKemudahanTicketKapalTerbangSukanSearch();
        $dataProviderPermohonanKemudahanTicketKapalTerbangSukan = $searchModelPermohonanKemudahanTicketKapalTerbangSukan->search($queryPar);
        
        $searchModelPermohonanKemudahanTicketKapalTerbangAtlet = new PermohonanKemudahanTicketKapalTerbangAtletSearch();
        $dataProviderPermohonanKemudahanTicketKapalTerbangAtlet = $searchModelPermohonanKemudahanTicketKapalTerbangAtlet->search($queryPar);
        
        $searchModelPermohonanKemudahanTicketKapalTerbangJurulatih = new PermohonanKemudahanTicketKapalTerbangJurulatihSearch();
        $dataProviderPermohonanKemudahanTicketKapalTerbangJurulatih = $searchModelPermohonanKemudahanTicketKapalTerbangJurulatih->search($queryPar);
        
        $searchModelPermohonanKemudahanTicketKapalTerbangPegawai = new PermohonanKemudahanTicketKapalTerbangPegawaiSearch();
        $dataProviderPermohonanKemudahanTicketKapalTerbangPegawai = $searchModelPermohonanKemudahanTicketKapalTerbangPegawai->search($queryPar);
        
        $searchModelPermohonanKemudahanTicketKapalTerbangPengurusSukan = new PermohonanKemudahanTicketKapalTerbangPengurusSukanSearch();
        $dataProviderPermohonanKemudahanTicketKapalTerbangPengurusSukan = $searchModelPermohonanKemudahanTicketKapalTerbangPengurusSukan->search($queryPar);
        
        
        if ($model->load(Yii::$app->request->post())) {
            if($model->jurulatih){
                $model->jurulatih = implode(",",$model->jurulatih);
            }
            
            if($model->atlet){
                $model->atlet = implode(",",$model->atlet);
            }
            
            if($model->sukan){
                $model->sukan = implode(",",$model->sukan);
            }
        }
        
        // calculate bilanga penumpang
        $model->bil_penumpang = 0;
        $model->bil_penumpang += $dataProviderPermohonanKemudahanTicketKapalTerbangAtlet->getTotalCount();
        $model->bil_penumpang += $dataProviderPermohonanKemudahanTicketKapalTerbangJurulatih->getTotalCount();
        $model->bil_penumpang += $dataProviderPermohonanKemudahanTicketKapalTerbangPegawai->getTotalCount();
        $model->bil_penumpang += $dataProviderPermohonanKemudahanTicketKapalTerbangPengurusSukan->getTotalCount();

        if (Yii::$app->request->post() && $model->save()) {
            PermohonanKemudahanTicketKapalTerbangSukan::updateAll(['permohonan_kemudahan_ticket_kapal_terbang_id' => $model->permohonan_kemudahan_ticket_kapal_terbang_id], 'session_id = "'.Yii::$app->session->id.'"');
            PermohonanKemudahanTicketKapalTerbangSukan::updateAll(['session_id' => ''], 'permohonan_kemudahan_ticket_kapal_terbang_id = "'.$model->permohonan_kemudahan_ticket_kapal_terbang_id.'"');

            PermohonanKemudahanTicketKapalTerbangAtlet::updateAll(['permohonan_kemudahan_ticket_kapal_terbang_id' => $model->permohonan_kemudahan_ticket_kapal_terbang_id], 'session_id = "'.Yii::$app->session->id.'"');
            PermohonanKemudahanTicketKapalTerbangAtlet::updateAll(['session_id' => ''], 'permohonan_kemudahan_ticket_kapal_terbang_id = "'.$model->permohonan_kemudahan_ticket_kapal_terbang_id.'"');
            
            PermohonanKemudahanTicketKapalTerbangJurulatih::updateAll(['permohonan_kemudahan_ticket_kapal_terbang_id' => $model->permohonan_kemudahan_ticket_kapal_terbang_id], 'session_id = "'.Yii::$app->session->id.'"');
            PermohonanKemudahanTicketKapalTerbangJurulatih::updateAll(['session_id' => ''], 'permohonan_kemudahan_ticket_kapal_terbang_id = "'.$model->permohonan_kemudahan_ticket_kapal_terbang_id.'"');
            
            PermohonanKemudahanTicketKapalTerbangPegawai::updateAll(['permohonan_kemudahan_ticket_kapal_terbang_id' => $model->permohonan_kemudahan_ticket_kapal_terbang_id], 'session_id = "'.Yii::$app->session->id.'"');
            PermohonanKemudahanTicketKapalTerbangPegawai::updateAll(['session_id' => ''], 'permohonan_kemudahan_ticket_kapal_terbang_id = "'.$model->permohonan_kemudahan_ticket_kapal_terbang_id.'"');
            
            PermohonanKemudahanTicketKapalTerbangPengurusSukan::updateAll(['permohonan_kemudahan_ticket_kapal_terbang_id' => $model->permohonan_kemudahan_ticket_kapal_terbang_id], 'session_id = "'.Yii::$app->session->id.'"');
            PermohonanKemudahanTicketKapalTerbangPengurusSukan::updateAll(['session_id' => ''], 'permohonan_kemudahan_ticket_kapal_terbang_id = "'.$model->permohonan_kemudahan_ticket_kapal_terbang_id.'"');
                
            return $this->redirect(['view', 'id' => $model->permohonan_kemudahan_ticket_kapal_terbang_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'searchModelPermohonanKemudahanTicketKapalTerbangSukan' => $searchModelPermohonanKemudahanTicketKapalTerbangSukan,
                'dataProviderPermohonanKemudahanTicketKapalTerbangSukan' => $dataProviderPermohonanKemudahanTicketKapalTerbangSukan,
                'searchModelPermohonanKemudahanTicketKapalTerbangAtlet' => $searchModelPermohonanKemudahanTicketKapalTerbangAtlet,
                'dataProviderPermohonanKemudahanTicketKapalTerbangAtlet' => $dataProviderPermohonanKemudahanTicketKapalTerbangAtlet,
                'searchModelPermohonanKemudahanTicketKapalTerbangJurulatih' => $searchModelPermohonanKemudahanTicketKapalTerbangJurulatih,
                'dataProviderPermohonanKemudahanTicketKapalTerbangJurulatih' => $dataProviderPermohonanKemudahanTicketKapalTerbangJurulatih,
                'searchModelPermohonanKemudahanTicketKapalTerbangPegawai' => $searchModelPermohonanKemudahanTicketKapalTerbangPegawai,
                'dataProviderPermohonanKemudahanTicketKapalTerbangPegawai' => $dataProviderPermohonanKemudahanTicketKapalTerbangPegawai,
                'searchModelPermohonanKemudahanTicketKapalTerbangPengurusSukan' => $searchModelPermohonanKemudahanTicketKapalTerbangPengurusSukan,
                'dataProviderPermohonanKemudahanTicketKapalTerbangPengurusSukan' => $dataProviderPermohonanKemudahanTicketKapalTerbangPengurusSukan,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Updates an existing PermohonanKemudahanTicketKapalTerbang model.
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
        
        
        $queryPar['PermohonanKemudahanTicketKapalTerbangSukanSearch']['permohonan_kemudahan_ticket_kapal_terbang_id'] = $id;
        $queryPar['PermohonanKemudahanTicketKapalTerbangAtletSearch']['permohonan_kemudahan_ticket_kapal_terbang_id'] = $id;
        $queryPar['PermohonanKemudahanTicketKapalTerbangJurulatihSearch']['permohonan_kemudahan_ticket_kapal_terbang_id'] = $id;
        $queryPar['PermohonanKemudahanTicketKapalTerbangPegawaiSearch']['permohonan_kemudahan_ticket_kapal_terbang_id'] = $id;
        $queryPar['PermohonanKemudahanTicketKapalTerbangPengurusSukanSearch']['permohonan_kemudahan_ticket_kapal_terbang_id'] = $id;
        
        $searchModelPermohonanKemudahanTicketKapalTerbangSukan = new PermohonanKemudahanTicketKapalTerbangSukanSearch();
        $dataProviderPermohonanKemudahanTicketKapalTerbangSukan = $searchModelPermohonanKemudahanTicketKapalTerbangSukan->search($queryPar);
        
        $searchModelPermohonanKemudahanTicketKapalTerbangAtlet = new PermohonanKemudahanTicketKapalTerbangAtletSearch();
        $dataProviderPermohonanKemudahanTicketKapalTerbangAtlet = $searchModelPermohonanKemudahanTicketKapalTerbangAtlet->search($queryPar);
        
        $searchModelPermohonanKemudahanTicketKapalTerbangJurulatih = new PermohonanKemudahanTicketKapalTerbangJurulatihSearch();
        $dataProviderPermohonanKemudahanTicketKapalTerbangJurulatih = $searchModelPermohonanKemudahanTicketKapalTerbangJurulatih->search($queryPar);
        
        $searchModelPermohonanKemudahanTicketKapalTerbangPegawai = new PermohonanKemudahanTicketKapalTerbangPegawaiSearch();
        $dataProviderPermohonanKemudahanTicketKapalTerbangPegawai = $searchModelPermohonanKemudahanTicketKapalTerbangPegawai->search($queryPar);
        
        $searchModelPermohonanKemudahanTicketKapalTerbangPengurusSukan = new PermohonanKemudahanTicketKapalTerbangPengurusSukanSearch();
        $dataProviderPermohonanKemudahanTicketKapalTerbangPengurusSukan = $searchModelPermohonanKemudahanTicketKapalTerbangPengurusSukan->search($queryPar);
        
        if ($model->load(Yii::$app->request->post())) {
            // if($model->jurulatih){
                // $model->jurulatih = implode(",",$model->jurulatih);
            // }
            
            // if($model->atlet){
                // $model->atlet = implode(",",$model->atlet);
            // }
            
            // if($model->sukan){
                // $model->sukan = implode(",",$model->sukan);
            // }
        }
        
        // calculate bilanga penumpang
        $model->bil_penumpang = 0;
        $model->bil_penumpang += $dataProviderPermohonanKemudahanTicketKapalTerbangAtlet->getTotalCount();
        $model->bil_penumpang += $dataProviderPermohonanKemudahanTicketKapalTerbangJurulatih->getTotalCount();
        $model->bil_penumpang += $dataProviderPermohonanKemudahanTicketKapalTerbangPegawai->getTotalCount();
        $model->bil_penumpang += $dataProviderPermohonanKemudahanTicketKapalTerbangPengurusSukan->getTotalCount();

        if (Yii::$app->request->post() && $model->save()) {
			$this->updateItemPergiBalik($model);
            return $this->redirect(['view', 'id' => $model->permohonan_kemudahan_ticket_kapal_terbang_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'searchModelPermohonanKemudahanTicketKapalTerbangSukan' => $searchModelPermohonanKemudahanTicketKapalTerbangSukan,
                'dataProviderPermohonanKemudahanTicketKapalTerbangSukan' => $dataProviderPermohonanKemudahanTicketKapalTerbangSukan,
                'searchModelPermohonanKemudahanTicketKapalTerbangAtlet' => $searchModelPermohonanKemudahanTicketKapalTerbangAtlet,
                'dataProviderPermohonanKemudahanTicketKapalTerbangAtlet' => $dataProviderPermohonanKemudahanTicketKapalTerbangAtlet,
                'searchModelPermohonanKemudahanTicketKapalTerbangJurulatih' => $searchModelPermohonanKemudahanTicketKapalTerbangJurulatih,
                'dataProviderPermohonanKemudahanTicketKapalTerbangJurulatih' => $dataProviderPermohonanKemudahanTicketKapalTerbangJurulatih,
                'searchModelPermohonanKemudahanTicketKapalTerbangPegawai' => $searchModelPermohonanKemudahanTicketKapalTerbangPegawai,
                'dataProviderPermohonanKemudahanTicketKapalTerbangPegawai' => $dataProviderPermohonanKemudahanTicketKapalTerbangPegawai,
                'searchModelPermohonanKemudahanTicketKapalTerbangPengurusSukan' => $searchModelPermohonanKemudahanTicketKapalTerbangPengurusSukan,
                'dataProviderPermohonanKemudahanTicketKapalTerbangPengurusSukan' => $dataProviderPermohonanKemudahanTicketKapalTerbangPengurusSukan,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Deletes an existing PermohonanKemudahanTicketKapalTerbang model.
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
     * Finds the PermohonanKemudahanTicketKapalTerbang model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PermohonanKemudahanTicketKapalTerbang the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PermohonanKemudahanTicketKapalTerbang::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionLaporanSenaraiPermohonanKemudahanTiket()
    {

        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new MsnLaporan();
        $model->format = 'html';

        if ($model->load(Yii::$app->request->post())) {
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-laporan-senarai-permohonan-kemudahan-tiket'
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-laporan-senarai-permohonan-kemudahan-tiket'
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'format' => $model->format
                ]);
            }
        } 

        return $this->render('laporan_senarai_permohonan_kemudahan_tiket', [
            'model' => $model,
            'readonly' => false,
        ]);
    }
    
    public function actionGenerateLaporanSenaraiPermohonanKemudahanTiket($tarikh_dari, $tarikh_hingga, $format)
    {
        if($tarikh_dari == "") $tarikh_dari = array();
        else $tarikh_dari = array($tarikh_dari);
        
        if($tarikh_hingga == "") $tarikh_hingga = array();
        else $tarikh_hingga = array($tarikh_hingga);
        
        $controls = array(
            'FROM_DATE' => $tarikh_dari,
            'TO_DATE' => $tarikh_hingga,
        );
        
        GeneralFunction::generateReport('/spsb/MSN/LaporanSenaraiPermohonanKemudahanTiket', $format, $controls, 'laporan_senarai_permohonan_kemudahan_tiket');
    }
    
    public function actionLaporanSenaraiPenerbanganKemudahanTiket()
    {

        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new MsnLaporan();
        $model->format = 'html';

        if ($model->load(Yii::$app->request->post())) {
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-laporan-senarai-penerbangan-kemudahan-tiket'
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-laporan-senarai-penerbangan-kemudahan-tiket'
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'format' => $model->format
                ]);
            }
        } 

        return $this->render('laporan_senarai_penerbangan_kemudahan_tiket', [
            'model' => $model,
            'readonly' => false,
        ]);
    }
    
    public function actionGenerateLaporanSenaraiPenerbanganKemudahanTiket($tarikh_dari, $tarikh_hingga, $format)
    {
        if($tarikh_dari == "") $tarikh_dari = array();
        else $tarikh_dari = array($tarikh_dari);
        
        if($tarikh_hingga == "") $tarikh_hingga = array();
        else $tarikh_hingga = array($tarikh_hingga);
        
        $controls = array(
            'FROM_DATE' => $tarikh_dari,
            'TO_DATE' => $tarikh_hingga,
        );
        
        GeneralFunction::generateReport('/spsb/MSN/LaporanSenaraiPenerbanganKemudahanTiket', $format, $controls, 'laporan_senarai_penerbangan_kemudahan_tiket');
    }
    
    public function actionLaporanStatistikPermohonanKemudahanTiket()
    {

        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new MsnLaporan();
        $model->format = 'html';

        if ($model->load(Yii::$app->request->post())) {
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-laporan-statistik-permohonan-kemudahan-tiket'
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-laporan-statistik-permohonan-kemudahan-tiket'
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'format' => $model->format
                ]);
            }
        } 

        return $this->render('laporan_statistik_permohonan_kemudahan_tiket', [
            'model' => $model,
            'readonly' => false,
        ]);
    }

    public function actionGenerateLaporanStatistikPermohonanKemudahanTiket($tarikh_dari, $tarikh_hingga,$format)
    {
        if($tarikh_dari == "") $tarikh_dari = array();
        else $tarikh_dari = array($tarikh_dari);
        
        if($tarikh_hingga == "") $tarikh_hingga = array();
        else $tarikh_hingga = array($tarikh_hingga);
        
        $controls = array(
            'FROM_DATE' => $tarikh_dari,
            'TO_DATE' => $tarikh_hingga,
        );
        
        GeneralFunction::generateReport('/spsb/MSN/LaporanStatistikPermohonanKemudahanTiket', $format, $controls, 'laporan_statistik_permohonan_kemudahan_tiket');
    }
    
    public function actionBorangPenempahan($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }  
        
        $parentModel = PermohonanKemudahanTicketKapalTerbang::findOne(['permohonan_kemudahan_ticket_kapal_terbang_id' => $id]);
        
        $pdf = new \mPDF('utf-8', 'A4-L');

        $pdf->title = 'Borang Penempahan Tiket Kapal Terbang';

        //$pdf->cssFile = 'report.css';
        $stylesheet = file_get_contents('css/report.css');

        $pdf->WriteHTML($stylesheet,1);
        
        $pdf->WriteHTML($this->renderpartial('print_borang_penempahan', [
            'parentModel'  => $parentModel,
        ]));

        $pdf->Output('Borang_Penempahan_Tiket_Kapal_Terbang'.$parentModel->permohonan_kemudahan_ticket_kapal_terbang_id.'.pdf', 'I');
    }
    
    public function actionSetPrimary()
    {
        if(Yii::$app->request->isAjax){
            $session = Yii::$app->session;
            $type = $_POST['type'];
            $setValue = $_POST['set'];
            $session->set($type, $setValue);
			
			//update existing record based on session=>for case autopopulate from penyertaan sukan
			$this->updateItemBySession(Yii::$app->session->id, $type, $setValue);
            //$session->remove($type);
        }
    }
	
	public function updateItemBySession($session_id, $type, $value)
	{
		$fieldArr = ['pri_tarikh_pergi' => 'tarikh_pergi', 'pri_flight_pergi' => 'flight_no_pergi', 'pri_masa_pergi' => 'masa_pergi', 'pri_destinasi_pergi' => 'destinasi_pergi', 'pri_tarikh_balik' => 'tarikh_balik', 'pri_flight_balik' => 'flight_no_balik', 'pri_masa_balik' => 'masa_balik', 'pri_destinasi_balik' => 'destinasi_balik'];
		
		PermohonanKemudahanTicketKapalTerbangAtlet::updateAll([$fieldArr[$type] => $value], 'session_id = "'.$session_id.'"');
		PermohonanKemudahanTicketKapalTerbangJurulatih::updateAll([$fieldArr[$type] => $value], 'session_id = "'.$session_id.'"');
		PermohonanKemudahanTicketKapalTerbangPegawai::updateAll([$fieldArr[$type] => $value], 'session_id = "'.$session_id.'"');
		PermohonanKemudahanTicketKapalTerbangPengurusSukan::updateAll([$fieldArr[$type] => $value], 'session_id = "'.$session_id.'"');
	}
	
	public function unsetAllPrime()
	{
		$session = Yii::$app->session;
		unset($session['pri_tarikh_pergi']); unset($session['pri_flight_pergi']); unset($session['pri_masa_pergi']); unset($session['pri_destinasi_pergi']);
		unset($session['pri_tarikh_balik']); unset($session['pri_flight_balik']); unset($session['pri_masa_balik']); unset($session['pri_destinasi_balik']);
		$session->close();
	}
	
	public function updateItemPergiBalik($model)
	{
		PermohonanKemudahanTicketKapalTerbangAtlet::updateAll(['tarikh_pergi' => $model->pri_tarikh_pergi, 'flight_no_pergi' => $model->pri_flight_pergi, 'masa_pergi' => $model->pri_masa_pergi, 'destinasi_pergi' => $model->pri_destinasi_pergi, 'tarikh_balik' => $model->pri_tarikh_balik, 'flight_no_balik' => $model->pri_flight_balik, 'masa_balik' => $model->pri_masa_balik, 'destinasi_balik' => $model->pri_destinasi_balik], 'permohonan_kemudahan_ticket_kapal_terbang_id = "'.$model->permohonan_kemudahan_ticket_kapal_terbang_id.'"');
		
		PermohonanKemudahanTicketKapalTerbangJurulatih::updateAll(['tarikh_pergi' => $model->pri_tarikh_pergi, 'flight_no_pergi' => $model->pri_flight_pergi, 'masa_pergi' => $model->pri_masa_pergi, 'destinasi_pergi' => $model->pri_destinasi_pergi, 'tarikh_balik' => $model->pri_tarikh_balik, 'flight_no_balik' => $model->pri_flight_balik, 'masa_balik' => $model->pri_masa_balik, 'destinasi_balik' => $model->pri_destinasi_balik], 'permohonan_kemudahan_ticket_kapal_terbang_id = "'.$model->permohonan_kemudahan_ticket_kapal_terbang_id.'"');
		
		PermohonanKemudahanTicketKapalTerbangPegawai::updateAll(['tarikh_pergi' => $model->pri_tarikh_pergi, 'flight_no_pergi' => $model->pri_flight_pergi, 'masa_pergi' => $model->pri_masa_pergi, 'destinasi_pergi' => $model->pri_destinasi_pergi, 'tarikh_balik' => $model->pri_tarikh_balik, 'flight_no_balik' => $model->pri_flight_balik, 'masa_balik' => $model->pri_masa_balik, 'destinasi_balik' => $model->pri_destinasi_balik], 'permohonan_kemudahan_ticket_kapal_terbang_id = "'.$model->permohonan_kemudahan_ticket_kapal_terbang_id.'"');
		
		PermohonanKemudahanTicketKapalTerbangPengurusSukan::updateAll(['tarikh_pergi' => $model->pri_tarikh_pergi, 'flight_no_pergi' => $model->pri_flight_pergi, 'masa_pergi' => $model->pri_masa_pergi, 'destinasi_pergi' => $model->pri_destinasi_pergi, 'tarikh_balik' => $model->pri_tarikh_balik, 'flight_no_balik' => $model->pri_flight_balik, 'masa_balik' => $model->pri_masa_balik, 'destinasi_balik' => $model->pri_destinasi_balik], 'permohonan_kemudahan_ticket_kapal_terbang_id = "'.$model->permohonan_kemudahan_ticket_kapal_terbang_id.'"');	
	}
}
