<?php

namespace frontend\controllers;

use Yii;
use app\models\PengurusanPenyelia;
use frontend\models\PengurusanPenyeliaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;

use app\models\general\GeneralVariable;

// table reference
use app\models\RefJabatanUser;
use app\models\RefStatusUser;
use app\models\UserPeranan;
use app\models\ProfilBadanSukan;
use app\models\RefUniversitiInstitusiEBiasiswa;
use app\models\RefKategoriProgram;
use app\models\RefNegeri;
use app\models\RefBahagianAduan;
use app\models\RefVenueAduan;
use app\models\RefKawasanKemudahan;

/**
 * PengurusanPenyeliaController implements the CRUD actions for PengurusanPenyelia model.
 */
class PengurusanPenyeliaController extends Controller
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
     * Lists all PengurusanPenyelia models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $queryPar = Yii::$app->request->queryParams;
        
        $queryPar['PengurusanPenyeliaSearch']['peranan'] = UserPeranan::PERANAN_MSN_ADUAN_PENYELIA;
        
        $searchModel = new PengurusanPenyeliaSearch();
        $dataProvider = $searchModel->search($queryPar);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PengurusanPenyelia model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = $this->findModel($id);
        
        $ref = RefJabatanUser::findOne(['id' => $model->jabatan_id]);
        $model->jabatan_id = $ref['desc'];
        
        $ref = RefStatusUser::findOne(['id' => $model->status]);
        $model->status = $ref['desc'];
        
        $ref = UserPeranan::findOne(['user_peranan_id' => $model->peranan]);
        $model->peranan = $ref['nama_peranan'];
        
        $ref = RefUniversitiInstitusiEBiasiswa::findOne(['id' => $model->ipt_bendahari_e_biasiswa]);
        $model->ipt_bendahari_e_biasiswa = $ref['desc'];
        
        $ref = ProfilBadanSukan::findOne(['profil_badan_sukan' => $model->profil_badan_sukan]);
        $model->profil_badan_sukan = $ref['nama_badan_sukan'];
        
        $ref = RefKategoriProgram::findOne(['id' => $model->urusetia_kategori_program_e_bantuan]);
        $model->urusetia_kategori_program_e_bantuan = $ref['desc'];
        
        $ref = RefNegeri::findOne(['id' => $model->urusetia_negeri_e_bantuan]);
        $model->urusetia_negeri_e_bantuan = $ref['desc'];
        
        $ref = RefBahagianAduan::findOne(['id' => $model->aduan_bahagian]);
        $model->aduan_bahagian = $ref['desc'];
        
        $ref = RefVenueAduan::findOne(['id' => $model->aduan_venue]);
        $model->aduan_venue = $ref['desc'];
        
        $ref = RefKawasanKemudahan::findOne(['id' => $model->aduan_kawasan_kemudahan]);
        $model->aduan_kawasan_kemudahan = $ref['desc'];
        
        return $this->render('view', [
            'model' => $model,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new PengurusanPenyelia model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new PengurusanPenyelia();
        
        $model->peranan = UserPeranan::PERANAN_MSN_ADUAN_PENYELIA;
        $model->from_module = GeneralVariable::moduleMSNAduanPenyelia;

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            
            $model->setPassword($model->new_password);
            $model->generateAuthKey();
            
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }
        
        return $this->render('create', [
            'model' => $model,
            'readonly' => false,
        ]);
    }

    /**
     * Updates an existing PengurusanPenyelia model.
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

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            //$model->password_hash = Yii::$app->security->generatePasswordHash($model->new_password);
            if($model->new_password != ''){
                $model->setPassword($model->new_password);
            }
            
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            return $this->render('update', [
                'model' => $model,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Deletes an existing PengurusanPenyelia model.
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
     * Finds the PengurusanPenyelia model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PengurusanPenyelia the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PengurusanPenyelia::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionGetPenyelia($id){
        // find Penyelia
        $model = PengurusanPenyelia::findOne($id);
        
        echo Json::encode($model);
    }
}