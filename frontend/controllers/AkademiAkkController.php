<?php

namespace frontend\controllers;

use Yii;
use app\models\AkademiAkk;
use frontend\models\AkademiAkkSearch;
use app\models\KegiatanPengalamanJurulatihAkk;
use frontend\models\KegiatanPengalamanJurulatihAkkSearch;
use app\models\KegiatanPengalamanAtletAkk;
use frontend\models\KegiatanPengalamanAtletAkkSearch;
use app\models\KelayakanAkademiAkk;
use frontend\models\KelayakanAkademiAkkSearch;
use app\models\KelayakanSukanSpesifikAkk;
use frontend\models\KelayakanSukanSpesifikAkkSearch;
use app\models\PemohonKursusTahapAkk;
use frontend\models\PemohonKursusTahapAkkSearch;
use app\models\AkkSijilPertolonganCemas;
use frontend\models\AkkSijilPertolonganCemasSearch;
use app\models\AkkSijilCpr;
use frontend\models\AkkSijilCprSearch;
use app\models\AkkPermitKerja;
use frontend\models\AkkPermitKerjaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

use app\models\general\Upload;
use app\models\general\GeneralVariable;
use common\models\general\GeneralFunction;

// table reference
use app\models\Jurulatih;
use app\models\RefKategoriPensijilanAkademiAkk;
use app\models\RefBandar;
use app\models\RefNegeri;
use app\models\RefStatusJurulatihAkk;
use app\models\RefJantina;
use app\models\RefBangsa;

/**
 * AkademiAkkController implements the CRUD actions for AkademiAkk model.
 */
class AkademiAkkController extends Controller
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
     * Lists all AkademiAkk models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $searchModel = new AkademiAkkSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AkademiAkk model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = $this->findModel($id);
        
        $ref = Jurulatih::findOne(['jurulatih_id' => $model->nama]);
        $model->nama = $ref['nameAndIC'];
        
        $ref = RefKategoriPensijilanAkademiAkk::findOne(['id' => $model->kategori_pensijilan]);
        $model->kategori_pensijilan = $ref['desc'];
        
        $ref = RefBandar::findOne(['id' => $model->alamat_majikan_bandar]);
        $model->alamat_majikan_bandar = $ref['desc'];
        
        $ref = RefNegeri::findOne(['id' => $model->alamat_majikan_negeri]);
        $model->alamat_majikan_negeri = $ref['desc'];
        
        $ref = RefBandar::findOne(['id' => $model->alamat_bandar]);
        $model->alamat_bandar = $ref['desc'];
        
        $ref = RefNegeri::findOne(['id' => $model->alamat_negeri]);
        $model->alamat_negeri = $ref['desc'];
        
        $ref = RefJantina::findOne(['id' => $model->jantina]);
        $model->jantina = $ref['desc'];
        
        $ref = RefBangsa::findOne(['id' => $model->bangsa]);
        $model->bangsa = $ref['desc'];
        
        $ref = RefStatusJurulatihAkk::findOne(['id' => $model->status_jurulatih]);
        $model->status_jurulatih = $ref['desc'];
        
        $model->tarikh_lahir = GeneralFunction::convert($model->tarikh_lahir);
        
        $model->tarikh_terima_borang = GeneralFunction::convert($model->tarikh_terima_borang);
        
        $model->tarikh_mula_lesen = GeneralFunction::convert($model->tarikh_mula_lesen);
        
        $model->tarikh_tamat_lesen = GeneralFunction::convert($model->tarikh_tamat_lesen);
        
        $queryPar = null;
        
        $queryPar['KegiatanPengalamanJurulatihAkkSearch']['akademi_akk_id'] = $id;
        $queryPar['KegiatanPengalamanAtletAkkSearch']['akademi_akk_id'] = $id;
        $queryPar['KelayakanAkademiAkkSearch']['akademi_akk_id'] = $id;
        $queryPar['KelayakanSukanSpesifikAkkSearch']['akademi_akk_id'] = $id;
        $queryPar['PemohonKursusTahapAkkSearch']['akademi_akk_id'] = $id;
        $queryPar['AkkSijilPertolonganCemasSearch']['akademi_akk_id'] = $id;
        $queryPar['AkkSijilCprSearch']['akademi_akk_id'] = $id;
        $queryPar['AkkPermitKerjaSearch']['akademi_akk_id'] = $id;
        
        $searchModelKegiatanPengalamanJurulatihAkk  = new KegiatanPengalamanJurulatihAkkSearch();
        $dataProviderKegiatanPengalamanJurulatihAkk = $searchModelKegiatanPengalamanJurulatihAkk->search($queryPar);
        
        $searchModelKegiatanPengalamanAtletAkk  = new KegiatanPengalamanAtletAkkSearch();
        $dataProviderKegiatanPengalamanAtletAkk = $searchModelKegiatanPengalamanAtletAkk->search($queryPar);
        
        $searchModelKelayakanAkademiAkk  = new KelayakanAkademiAkkSearch();
        $dataProviderKelayakanAkademiAkk = $searchModelKelayakanAkademiAkk->search($queryPar);
        
        $searchModelKelayakanSukanSpesifikAkk = new KelayakanSukanSpesifikAkkSearch();
        $dataProviderKelayakanSukanSpesifikAkk = $searchModelKelayakanSukanSpesifikAkk->search($queryPar);
        
        $searchModelPemohonKursusTahapAkk= new PemohonKursusTahapAkkSearch();
        $dataProviderPemohonKursusTahapAkk = $searchModelPemohonKursusTahapAkk->search($queryPar);
        
        $searchModelAkkSijilPertolonganCemas= new AkkSijilPertolonganCemasSearch();
        $dataProviderAkkSijilPertolonganCemas = $searchModelAkkSijilPertolonganCemas->search($queryPar);
        
        $searchModelAkkSijilCpr= new AkkSijilCprSearch();
        $dataProviderAkkSijilCpr = $searchModelAkkSijilCpr->search($queryPar);
        
        $searchModelAkkPermitKerja= new AkkPermitKerjaSearch();
        $dataProviderAkkPermitKerja = $searchModelAkkPermitKerja->search($queryPar);
        
        return $this->render('view', [
            'model' => $model,
            'searchModelKegiatanPengalamanJurulatihAkk' => $searchModelKegiatanPengalamanJurulatihAkk,
            'dataProviderKegiatanPengalamanJurulatihAkk' => $dataProviderKegiatanPengalamanJurulatihAkk,
            'searchModelKegiatanPengalamanAtletAkk' => $searchModelKegiatanPengalamanAtletAkk,
            'dataProviderKegiatanPengalamanAtletAkk' => $dataProviderKegiatanPengalamanAtletAkk,
            'searchModelKelayakanAkademiAkk' => $searchModelKelayakanAkademiAkk,
            'dataProviderKelayakanAkademiAkk' => $dataProviderKelayakanAkademiAkk,
            'searchModelKelayakanSukanSpesifikAkk' => $searchModelKelayakanSukanSpesifikAkk,
            'dataProviderKelayakanSukanSpesifikAkk' => $dataProviderKelayakanSukanSpesifikAkk,
            'searchModelPemohonKursusTahapAkk' => $searchModelPemohonKursusTahapAkk,
            'dataProviderPemohonKursusTahapAkk' => $dataProviderPemohonKursusTahapAkk,
            'searchModelAkkSijilPertolonganCemas' => $searchModelAkkSijilPertolonganCemas,
            'dataProviderAkkSijilPertolonganCemas' => $dataProviderAkkSijilPertolonganCemas,
            'searchModelAkkSijilCpr' => $searchModelAkkSijilCpr,
            'dataProviderAkkSijilCpr' => $dataProviderAkkSijilCpr,
            'searchModelAkkPermitKerja' => $searchModelAkkPermitKerja,
            'dataProviderAkkPermitKerja' => $dataProviderAkkPermitKerja,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new AkademiAkk model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new AkademiAkk();
        
        $queryPar = null;
        
        Yii::$app->session->open();
        
        if(isset(Yii::$app->session->id)){
            $queryPar['KegiatanPengalamanJurulatihAkkSearch']['session_id'] = Yii::$app->session->id;
            $queryPar['KegiatanPengalamanAtletAkkSearch']['session_id'] = Yii::$app->session->id;
            $queryPar['KelayakanAkademiAkkSearch']['session_id'] = Yii::$app->session->id;
            $queryPar['KelayakanSukanSpesifikAkkSearch']['session_id'] = Yii::$app->session->id;
            $queryPar['PemohonKursusTahapAkkSearch']['session_id'] = Yii::$app->session->id;
            $queryPar['AkkSijilPertolonganCemasSearch']['session_id'] = Yii::$app->session->id;
            $queryPar['AkkSijilCprSearch']['session_id'] = Yii::$app->session->id;
            $queryPar['AkkPermitKerjaSearch']['session_id'] = Yii::$app->session->id;
        }
        
        $searchModelKegiatanPengalamanJurulatihAkk  = new KegiatanPengalamanJurulatihAkkSearch();
        $dataProviderKegiatanPengalamanJurulatihAkk = $searchModelKegiatanPengalamanJurulatihAkk->search($queryPar);
        
        $searchModelKegiatanPengalamanAtletAkk  = new KegiatanPengalamanAtletAkkSearch();
        $dataProviderKegiatanPengalamanAtletAkk = $searchModelKegiatanPengalamanAtletAkk->search($queryPar);
        
        $searchModelKelayakanAkademiAkk  = new KelayakanAkademiAkkSearch();
        $dataProviderKelayakanAkademiAkk = $searchModelKelayakanAkademiAkk->search($queryPar);
        
        $searchModelKelayakanSukanSpesifikAkk = new KelayakanSukanSpesifikAkkSearch();
        $dataProviderKelayakanSukanSpesifikAkk = $searchModelKelayakanSukanSpesifikAkk->search($queryPar);
        
        $searchModelPemohonKursusTahapAkk= new PemohonKursusTahapAkkSearch();
        $dataProviderPemohonKursusTahapAkk = $searchModelPemohonKursusTahapAkk->search($queryPar);
        
        $searchModelAkkSijilPertolonganCemas= new AkkSijilPertolonganCemasSearch();
        $dataProviderAkkSijilPertolonganCemas = $searchModelAkkSijilPertolonganCemas->search($queryPar);
        
        $searchModelAkkSijilCpr= new AkkSijilCprSearch();
        $dataProviderAkkSijilCpr = $searchModelAkkSijilCpr->search($queryPar);
        
        $searchModelAkkPermitKerja= new AkkPermitKerjaSearch();
        $dataProviderAkkPermitKerja = $searchModelAkkPermitKerja->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $upload = new Upload();
            $file = UploadedFile::getInstance($model, 'muatnaik_gambar');
            if($file){
                $model->muatnaik_gambar = $upload->uploadFile($file, Upload::akademiAkkFolder, $model->akademi_akk_id);
            }
            
            if(isset(Yii::$app->session->id)){
                KegiatanPengalamanJurulatihAkk::updateAll(['akademi_akk_id' => $model->akademi_akk_id], 'session_id = "'.Yii::$app->session->id.'"');
                KegiatanPengalamanJurulatihAkk::updateAll(['session_id' => ''], 'akademi_akk_id = "'.$model->akademi_akk_id.'"');
                
                KegiatanPengalamanAtletAkk::updateAll(['akademi_akk_id' => $model->akademi_akk_id], 'session_id = "'.Yii::$app->session->id.'"');
                KegiatanPengalamanAtletAkk::updateAll(['session_id' => ''], 'akademi_akk_id = "'.$model->akademi_akk_id.'"');
                
                KelayakanAkademiAkk::updateAll(['akademi_akk_id' => $model->akademi_akk_id], 'session_id = "'.Yii::$app->session->id.'"');
                KelayakanAkademiAkk::updateAll(['session_id' => ''], 'akademi_akk_id = "'.$model->akademi_akk_id.'"');
                
                KelayakanSukanSpesifikAkk::updateAll(['akademi_akk_id' => $model->akademi_akk_id], 'session_id = "'.Yii::$app->session->id.'"');
                KelayakanSukanSpesifikAkk::updateAll(['session_id' => ''], 'akademi_akk_id = "'.$model->akademi_akk_id.'"');
                
                PemohonKursusTahapAkk::updateAll(['akademi_akk_id' => $model->akademi_akk_id], 'session_id = "'.Yii::$app->session->id.'"');
                PemohonKursusTahapAkk::updateAll(['session_id' => ''], 'akademi_akk_id = "'.$model->akademi_akk_id.'"');
                
                AkkSijilPertolonganCemas::updateAll(['akademi_akk_id' => $model->akademi_akk_id], 'session_id = "'.Yii::$app->session->id.'"');
                AkkSijilPertolonganCemas::updateAll(['session_id' => ''], 'akademi_akk_id = "'.$model->akademi_akk_id.'"');
                
                AkkSijilCpr::updateAll(['akademi_akk_id' => $model->akademi_akk_id], 'session_id = "'.Yii::$app->session->id.'"');
                AkkSijilCpr::updateAll(['session_id' => ''], 'akademi_akk_id = "'.$model->akademi_akk_id.'"');
                
                AkkPermitKerja::updateAll(['akademi_akk_id' => $model->akademi_akk_id], 'session_id = "'.Yii::$app->session->id.'"');
                AkkPermitKerja::updateAll(['session_id' => ''], 'akademi_akk_id = "'.$model->akademi_akk_id.'"');
            }
            
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->akademi_akk_id]);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
                'searchModelKegiatanPengalamanJurulatihAkk' => $searchModelKegiatanPengalamanJurulatihAkk,
                'dataProviderKegiatanPengalamanJurulatihAkk' => $dataProviderKegiatanPengalamanJurulatihAkk,
                'searchModelKegiatanPengalamanAtletAkk' => $searchModelKegiatanPengalamanAtletAkk,
                'dataProviderKegiatanPengalamanAtletAkk' => $dataProviderKegiatanPengalamanAtletAkk,
                'searchModelKelayakanAkademiAkk' => $searchModelKelayakanAkademiAkk,
                'dataProviderKelayakanAkademiAkk' => $dataProviderKelayakanAkademiAkk,
                'searchModelKelayakanSukanSpesifikAkk' => $searchModelKelayakanSukanSpesifikAkk,
                'dataProviderKelayakanSukanSpesifikAkk' => $dataProviderKelayakanSukanSpesifikAkk,
                'searchModelPemohonKursusTahapAkk' => $searchModelPemohonKursusTahapAkk,
                'dataProviderPemohonKursusTahapAkk' => $dataProviderPemohonKursusTahapAkk,
                'searchModelAkkSijilPertolonganCemas' => $searchModelAkkSijilPertolonganCemas,
                'dataProviderAkkSijilPertolonganCemas' => $dataProviderAkkSijilPertolonganCemas,
                'searchModelAkkSijilCpr' => $searchModelAkkSijilCpr,
                'dataProviderAkkSijilCpr' => $dataProviderAkkSijilCpr,
                'searchModelAkkPermitKerja' => $searchModelAkkPermitKerja,
                'dataProviderAkkPermitKerja' => $dataProviderAkkPermitKerja,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Updates an existing AkademiAkk model.
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
        
        $queryPar['KegiatanPengalamanJurulatihAkkSearch']['akademi_akk_id'] = $id;
        $queryPar['KegiatanPengalamanAtletAkkSearch']['akademi_akk_id'] = $id;
        $queryPar['KelayakanAkademiAkkSearch']['akademi_akk_id'] = $id;
        $queryPar['KelayakanSukanSpesifikAkkSearch']['akademi_akk_id'] = $id;
        $queryPar['PemohonKursusTahapAkkSearch']['akademi_akk_id'] = $id;
        $queryPar['AkkSijilPertolonganCemasSearch']['akademi_akk_id'] = $id;
        $queryPar['AkkSijilCprSearch']['akademi_akk_id'] = $id;
        $queryPar['AkkPermitKerjaSearch']['akademi_akk_id'] = $id;
        
        $searchModelKegiatanPengalamanJurulatihAkk  = new KegiatanPengalamanJurulatihAkkSearch();
        $dataProviderKegiatanPengalamanJurulatihAkk = $searchModelKegiatanPengalamanJurulatihAkk->search($queryPar);
        
        $searchModelKegiatanPengalamanAtletAkk  = new KegiatanPengalamanAtletAkkSearch();
        $dataProviderKegiatanPengalamanAtletAkk = $searchModelKegiatanPengalamanAtletAkk->search($queryPar);
        
        $searchModelKelayakanAkademiAkk  = new KelayakanAkademiAkkSearch();
        $dataProviderKelayakanAkademiAkk = $searchModelKelayakanAkademiAkk->search($queryPar);
        
        $searchModelKelayakanSukanSpesifikAkk = new KelayakanSukanSpesifikAkkSearch();
        $dataProviderKelayakanSukanSpesifikAkk = $searchModelKelayakanSukanSpesifikAkk->search($queryPar);
        
        $searchModelPemohonKursusTahapAkk= new PemohonKursusTahapAkkSearch();
        $dataProviderPemohonKursusTahapAkk = $searchModelPemohonKursusTahapAkk->search($queryPar);
        
        $searchModelAkkSijilPertolonganCemas= new AkkSijilPertolonganCemasSearch();
        $dataProviderAkkSijilPertolonganCemas = $searchModelAkkSijilPertolonganCemas->search($queryPar);
        
        $searchModelAkkSijilCpr= new AkkSijilCprSearch();
        $dataProviderAkkSijilCpr = $searchModelAkkSijilCpr->search($queryPar);
        
        $searchModelAkkPermitKerja= new AkkPermitKerjaSearch();
        $dataProviderAkkPermitKerja = $searchModelAkkPermitKerja->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $upload = new Upload();
            $file = UploadedFile::getInstance($model, 'muatnaik_gambar');
            if($file){
                $model->muatnaik_gambar = $upload->uploadFile($file, Upload::akademiAkkFolder, $model->akademi_akk_id);
            }
            
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->akademi_akk_id]);
            }
        } else {
            return $this->render('update', [
                'model' => $model,
                'searchModelKegiatanPengalamanJurulatihAkk' => $searchModelKegiatanPengalamanJurulatihAkk,
                'dataProviderKegiatanPengalamanJurulatihAkk' => $dataProviderKegiatanPengalamanJurulatihAkk,
                'searchModelKegiatanPengalamanAtletAkk' => $searchModelKegiatanPengalamanAtletAkk,
                'dataProviderKegiatanPengalamanAtletAkk' => $dataProviderKegiatanPengalamanAtletAkk,
                'searchModelKelayakanAkademiAkk' => $searchModelKelayakanAkademiAkk,
                'dataProviderKelayakanAkademiAkk' => $dataProviderKelayakanAkademiAkk,
                'searchModelKelayakanSukanSpesifikAkk' => $searchModelKelayakanSukanSpesifikAkk,
                'dataProviderKelayakanSukanSpesifikAkk' => $dataProviderKelayakanSukanSpesifikAkk,
                'searchModelPemohonKursusTahapAkk' => $searchModelPemohonKursusTahapAkk,
                'dataProviderPemohonKursusTahapAkk' => $dataProviderPemohonKursusTahapAkk,
                'searchModelAkkSijilPertolonganCemas' => $searchModelAkkSijilPertolonganCemas,
                'dataProviderAkkSijilPertolonganCemas' => $dataProviderAkkSijilPertolonganCemas,
                'searchModelAkkSijilCpr' => $searchModelAkkSijilCpr,
                'dataProviderAkkSijilCpr' => $dataProviderAkkSijilCpr,
                'searchModelAkkPermitKerja' => $searchModelAkkPermitKerja,
                'dataProviderAkkPermitKerja' => $dataProviderAkkPermitKerja,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Deletes an existing AkademiAkk model.
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
        self::actionDeleteimg($id, 'muatnaik_gambar');
        
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the AkademiAkk model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AkademiAkk the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AkademiAkk::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    // Add function for delete image or file
    public function actionDeleteimg($id, $field)
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
}
