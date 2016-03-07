<?php

namespace backend\controllers;

use Yii;
use app\models\PermohonanEBantuan;
use backend\models\PermohonanEBantuanSearch;
use app\models\PermohonanEBantuanSenaraiPermohonan;
use backend\models\PermohonanEBantuanSenaraiPermohonanSearch;
use app\models\PermohonanEBantuanObjektifPertubuhan;
use backend\models\PermohonanEBantuanObjektifPertubuhanSearch;
use app\models\PermohonanEBantuanJawatankuasa;
use backend\models\PermohonanEBantuanJawatankuasaSearch;
use app\models\PermohonanEBantuanSenaraiAktivitiProjek;
use backend\models\PermohonanEBantuanSenaraiAktivitiProjekSearch;
use app\models\PermohonanEBantuanPendapatanTahunLepas;
use backend\models\PermohonanEBantuanPendapatanTahunLepasSearch;
use app\models\PermohonanEBantuanAnggaranPerbelanjaan;
use backend\models\PermohonanEBantuanAnggaranPerbelanjaanSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

// contant values
use app\models\general\GeneralVariable;
use app\models\general\GeneralLabel;
use common\models\general\GeneralFunction;

// table reference
use app\models\RefKategoriPersatuan;
use app\models\RefKategoriProgram;
use app\models\RefSokongan;
use app\models\RefBank;
use app\models\RefNegeri;
use app\models\RefBandar;

/**
 * PermohonanEBantuanController implements the CRUD actions for PermohonanEBantuan model.
 */
class PermohonanEBantuanController extends Controller
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
     * Lists all PermohonanEBantuan models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PermohonanEBantuanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PermohonanEBantuan model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $queryPar = null;
        
        $queryPar['PermohonanEBantuanJawatankuasaSearch']['permohonan_e_bantuan_id'] = $id;
        $queryPar['PermohonanEBantuanObjektifPertubuhanSearch']['permohonan_e_bantuan_id'] = $id;
        $queryPar['PermohonanEBantuanSenaraiPermohonanSearch']['permohonan_e_bantuan_id'] = $id;
        $queryPar['PermohonanEBantuanPendapatanTahunLepasSearch']['permohonan_e_bantuan_id'] = $id;
        $queryPar['PermohonanEBantuanAnggaranPerbelanjaanSearch']['permohonan_e_bantuan_id'] = $id;
        
        $searchModelPermohonan = new PermohonanEBantuanSenaraiPermohonanSearch();
        $dataProviderPermohonan = $searchModelPermohonan->search($queryPar);
        
        $searchModelOP = new PermohonanEBantuanObjektifPertubuhanSearch();
        $dataProviderOP = $searchModelOP->search($queryPar);
        
        $searchModelJawatankuasa = new PermohonanEBantuanJawatankuasaSearch();
        $dataProviderJawatankuasa = $searchModelJawatankuasa->search($queryPar);
        
        $searchModelSAP = new PermohonanEBantuanSenaraiAktivitiProjekSearch();
        $dataProviderSAP = $searchModelSAP->search($queryPar);
        
        $searchModelPTL = new PermohonanEBantuanPendapatanTahunLepasSearch();
        $dataProviderPTL = $searchModelPTL->search($queryPar);
        
        $searchModelAP = new PermohonanEBantuanAnggaranPerbelanjaanSearch();
        $dataProviderAP = $searchModelAP->search($queryPar);
        
        // Get desc for each dropdown fields
        $model = $this->findModel($id);
        
        $ref = RefKategoriPersatuan::findOne(['id' => $model->kategori_persatuan]);
        $model->kategori_persatuan = $ref['desc'];
        
        $ref = RefKategoriProgram::findOne(['id' => $model->kategori_program]);
        $model->kategori_program = $ref['desc'];
        
        $ref = RefNegeri::findOne(['id' => $model->alamat_negeri]);
        $model->alamat_negeri = $ref['desc'];
        
        $ref = RefBandar::findOne(['id' => $model->alamat_bandar]);
        $model->alamat_bandar = $ref['desc'];
        
        $ref = RefNegeri::findOne(['id' => $model->alamat_surat_menyurat_negeri]);
        $model->alamat_surat_menyurat_negeri = $ref['desc'];
        
        $ref = RefBandar::findOne(['id' => $model->alamat_surat_menyurat_bandar]);
        $model->alamat_surat_menyurat_bandar = $ref['desc'];
        
        $ref = RefBank::findOne(['id' => $model->nama_bank]);
        $model->nama_bank = $ref['desc'];
        
        $ref = RefSokongan::findOne(['id' => $model->sokongan]);
        $model->sokongan = $ref['desc'];
        
        $YesNo = GeneralLabel::getYesNoLabel($model->kelulusan);
        $model->kelulusan = $YesNo;
        
        $model->tarikh_didaftarkan = GeneralFunction::convert($model->tarikh_didaftarkan);
        
        $model->tarikh_pelaksanaan = GeneralFunction::convert($model->tarikh_pelaksanaan);
        
        return $this->render('view', [
            'model' => $model,
            'searchModelPermohonan' => $searchModelPermohonan,
            'dataProviderPermohonan' => $dataProviderPermohonan,
            'searchModelOP' => $searchModelOP,
            'dataProviderOP' => $dataProviderOP,
            'searchModelJawatankuasa' => $searchModelJawatankuasa,
            'dataProviderJawatankuasa' => $dataProviderJawatankuasa,
            'searchModelSAP' => $searchModelSAP,
            'dataProviderSAP' => $dataProviderSAP,
            'searchModelPTL' => $searchModelPTL,
            'dataProviderPTL' => $dataProviderPTL,
            'searchModelAP' => $searchModelAP,
            'dataProviderAP' => $dataProviderAP,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new PermohonanEBantuan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new PermohonanEBantuan();
        
        $queryPar = null;
        
        Yii::$app->session->open();
        
        if(isset(Yii::$app->session->id)){
            $queryPar['PermohonanEBantuanJawatankuasaSearch']['session_id'] = Yii::$app->session->id;
            $queryPar['PermohonanEBantuanObjektifPertubuhanSearch']['session_id'] = Yii::$app->session->id;
            $queryPar['PermohonanEBantuanSenaraiPermohonanSearch']['session_id'] = Yii::$app->session->id;
            $queryPar['PermohonanEBantuanPendapatanTahunLepasSearch']['session_id'] = Yii::$app->session->id;
            $queryPar['PermohonanEBantuanAnggaranPerbelanjaanSearch']['session_id'] = Yii::$app->session->id;
        }
        
        $searchModelPermohonan = new PermohonanEBantuanSenaraiPermohonanSearch();
        $dataProviderPermohonan = $searchModelPermohonan->search($queryPar);
        
        $searchModelOP = new PermohonanEBantuanObjektifPertubuhanSearch();
        $dataProviderOP = $searchModelOP->search($queryPar);
        
        $searchModelJawatankuasa = new PermohonanEBantuanJawatankuasaSearch();
        $dataProviderJawatankuasa = $searchModelJawatankuasa->search($queryPar);
        
        $searchModelSAP = new PermohonanEBantuanSenaraiAktivitiProjekSearch();
        $dataProviderSAP = $searchModelSAP->search($queryPar);
        
        $searchModelPTL = new PermohonanEBantuanPendapatanTahunLepasSearch();
        $dataProviderPTL = $searchModelPTL->search($queryPar);
        
        $searchModelAP = new PermohonanEBantuanAnggaranPerbelanjaanSearch();
        $dataProviderAP = $searchModelAP->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            // set e-Bantuan ID
            $model->ebantuan_id =  $model->permohonan_e_bantuan_id . '/' . date("Y") . '/' . $model->no_pendaftaran . '/' . $model->nama_pertubuhan_persatuan;
            $model->save();
                    
            // update all the temporary session id with Permohonan e-Bantuan id
            if(isset(Yii::$app->session->id)){
                PermohonanEBantuanJawatankuasa::updateAll(['permohonan_e_bantuan_id' => $model->permohonan_e_bantuan_id], 'session_id = "'.Yii::$app->session->id.'"');
                PermohonanEBantuanJawatankuasa::updateAll(['session_id' => ''], 'permohonan_e_bantuan_id = "'.$model->permohonan_e_bantuan_id.'"');
                
                PermohonanEBantuanObjektifPertubuhan::updateAll(['permohonan_e_bantuan_id' => $model->permohonan_e_bantuan_id], 'session_id = "'.Yii::$app->session->id.'"');
                PermohonanEBantuanObjektifPertubuhan::updateAll(['session_id' => ''], 'permohonan_e_bantuan_id = "'.$model->permohonan_e_bantuan_id.'"');
                
                PermohonanEBantuanSenaraiPermohonan::updateAll(['permohonan_e_bantuan_id' => $model->permohonan_e_bantuan_id], 'session_id = "'.Yii::$app->session->id.'"');
                PermohonanEBantuanSenaraiPermohonan::updateAll(['session_id' => ''], 'permohonan_e_bantuan_id = "'.$model->permohonan_e_bantuan_id.'"');
                
                PermohonanEBantuanPendapatanTahunLepas::updateAll(['permohonan_e_bantuan_id' => $model->permohonan_e_bantuan_id], 'session_id = "'.Yii::$app->session->id.'"');
                PermohonanEBantuanPendapatanTahunLepas::updateAll(['session_id' => ''], 'permohonan_e_bantuan_id = "'.$model->permohonan_e_bantuan_id.'"');
                
                PermohonanEBantuanAnggaranPerbelanjaan::updateAll(['permohonan_e_bantuan_id' => $model->permohonan_e_bantuan_id], 'session_id = "'.Yii::$app->session->id.'"');
                PermohonanEBantuanAnggaranPerbelanjaan::updateAll(['session_id' => ''], 'permohonan_e_bantuan_id = "'.$model->permohonan_e_bantuan_id.'"');
            }
            
            return $this->redirect(['view', 'id' => $model->permohonan_e_bantuan_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'searchModelPermohonan' => $searchModelPermohonan,
                'dataProviderPermohonan' => $dataProviderPermohonan,
                'searchModelOP' => $searchModelOP,
                'dataProviderOP' => $dataProviderOP,
                'searchModelJawatankuasa' => $searchModelJawatankuasa,
                'dataProviderJawatankuasa' => $dataProviderJawatankuasa,
                'searchModelSAP' => $searchModelSAP,
                'dataProviderSAP' => $dataProviderSAP,
                'searchModelPTL' => $searchModelPTL,
                'dataProviderPTL' => $dataProviderPTL,
                'searchModelAP' => $searchModelAP,
                'dataProviderAP' => $dataProviderAP,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Updates an existing PermohonanEBantuan model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        
        $queryPar = null;
        
        $queryPar['PermohonanEBantuanJawatankuasaSearch']['permohonan_e_bantuan_id'] = $id;
        $queryPar['PermohonanEBantuanObjektifPertubuhanSearch']['permohonan_e_bantuan_id'] = $id;
        $queryPar['PermohonanEBantuanSenaraiPermohonanSearch']['permohonan_e_bantuan_id'] = $id;
        $queryPar['PermohonanEBantuanPendapatanTahunLepasSearch']['permohonan_e_bantuan_id'] = $id;
        $queryPar['PermohonanEBantuanAnggaranPerbelanjaanSearch']['permohonan_e_bantuan_id'] = $id;
        
        $searchModelPermohonan = new PermohonanEBantuanSenaraiPermohonanSearch();
        $dataProviderPermohonan = $searchModelPermohonan->search($queryPar);
        
        $searchModelOP = new PermohonanEBantuanObjektifPertubuhanSearch();
        $dataProviderOP = $searchModelOP->search($queryPar);
        
        $searchModelJawatankuasa = new PermohonanEBantuanJawatankuasaSearch();
        $dataProviderJawatankuasa = $searchModelJawatankuasa->search($queryPar);
        
        $searchModelSAP = new PermohonanEBantuanSenaraiAktivitiProjekSearch();
        $dataProviderSAP = $searchModelSAP->search($queryPar);
        
        $searchModelPTL = new PermohonanEBantuanPendapatanTahunLepasSearch();
        $dataProviderPTL = $searchModelPTL->search($queryPar);
        
        $searchModelAP = new PermohonanEBantuanAnggaranPerbelanjaanSearch();
        $dataProviderAP = $searchModelAP->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            // set e-Bantuan ID
            //$model->ebantuan_id =  $model->permohonan_e_bantuan_id . '/' . date("Y") . '/' . $model->no_pendaftaran . '/' . $model->nama_pertubuhan_persatuan;
            //$model->save();
            
            return $this->redirect(['view', 'id' => $model->permohonan_e_bantuan_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'searchModelPermohonan' => $searchModelPermohonan,
                'dataProviderPermohonan' => $dataProviderPermohonan,
                'searchModelOP' => $searchModelOP,
                'dataProviderOP' => $dataProviderOP,
                'searchModelJawatankuasa' => $searchModelJawatankuasa,
                'dataProviderJawatankuasa' => $dataProviderJawatankuasa,
                'searchModelSAP' => $searchModelSAP,
                'dataProviderSAP' => $dataProviderSAP,
                'searchModelPTL' => $searchModelPTL,
                'dataProviderPTL' => $dataProviderPTL,
                'searchModelAP' => $searchModelAP,
                'dataProviderAP' => $dataProviderAP,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Deletes an existing PermohonanEBantuan model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the PermohonanEBantuan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PermohonanEBantuan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PermohonanEBantuan::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
