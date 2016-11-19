<?php

namespace frontend\controllers;

use Yii;
use app\models\Persatuan;
use frontend\models\PersatuanSearch;
use app\models\BantuanElaun;
use frontend\models\BantuanElaunSearch;
use frontend\models\PengurusanProgramBinaan;
use frontend\models\PengurusanProgramBinaanSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use app\models\general\GeneralVariable;

// table reference
use app\models\RefJabatanUser;
use app\models\RefStatusUser;
use app\models\UserPeranan;
use app\models\ProfilBadanSukan;
use app\models\RefUniversitiInstitusiEBiasiswa;
use app\models\RefKategoriProgram;
use app\models\RefNegeri;

/**
 * PersatuanController implements the CRUD actions for Persatuan model.
 */
class PersatuanController extends Controller
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
     * Lists all Persatuan models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $queryPar = Yii::$app->request->queryParams;
        
        $queryPar['PersatuanSearch']['peranan'] = UserPeranan::PERANAN_PJS_PERSATUAN;
        
        $searchModel = new PersatuanSearch();
        $dataProvider = $searchModel->search($queryPar);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Persatuan model.
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
        
        $queryPar = Yii::$app->request->queryParams;
        
        $queryPar['BantuanElaunSearch']['created_by'] = $id;
        $queryPar['PengurusanProgramBinaanSearch']['created_by'] = $id;
        
        $searchModelBE = new BantuanElaunSearch();
        $dataProviderBE = $searchModelBE->search($queryPar);
        
        $searchModelPPB = new PengurusanProgramBinaanSearch();
        $dataProviderPPB = $searchModelPPB->search($queryPar);
        
        return $this->render('view', [
            'model' => $model,
            'readonly' => true,
            'searchModelBE' => $searchModelBE,
            'dataProviderBE' => $dataProviderBE,
            'searchModelPPB' => $searchModelPPB,
            'dataProviderPPB' => $dataProviderPPB,
        ]);
    }

    /**
     * Creates a new Persatuan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new Persatuan();
        
        $model->peranan = UserPeranan::PERANAN_PJS_PERSATUAN;
        $model->from_module = GeneralVariable::modulePJSPersatuan;
        
        if ($model->load(Yii::$app->request->post())) {
            //$stringlens = strlen($model->sukan);
            if(is_array($model->sukan)){
                $model->sukan = implode(",",$model->sukan);
            } else {
                $model->sukan = "";
            }
        }

        if (Yii::$app->request->post() && $model->validate()) {
            
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
     * Updates an existing Persatuan model.delete
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
        
        if ($model->load(Yii::$app->request->post()) && $model->sukan) {
            //$stringlens = $model->sukan;
            if(is_array($model->sukan)){
                $model->sukan = implode(",",$model->sukan);
            } else {
                $model->sukan = "";
            }
        }
        
        $queryPar = Yii::$app->request->queryParams;
        
        $queryPar['BantuanElaunSearch']['created_by'] = $id;
        $queryPar['PengurusanProgramBinaanSearch']['created_by'] = $id;
        
        $searchModelBE = new BantuanElaunSearch();
        $dataProviderBE = $searchModelBE->search($queryPar);
        
        $searchModelPPB = new PengurusanProgramBinaanSearch();
        $dataProviderPPB = $searchModelPPB->search($queryPar);

        if (Yii::$app->request->post() && $model->validate()) {
            //$model->password_hash = Yii::$app->security->generatePasswordHash($model->new_password);
            if($model->new_password != ''){
                $model->setPassword($model->new_password);
                $model->login_attempted = 0; //reset login attempt
            }
            
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            return $this->render('update', [
                'model' => $model,
                'readonly' => false,
                'searchModelBE' => $searchModelBE,
                'dataProviderBE' => $dataProviderBE,
                'searchModelPPB' => $searchModelPPB,
                'dataProviderPPB' => $dataProviderPPB,
            ]);
        }
    }

    /**
     * Deletes an existing Persatuan model.
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
     * Finds the Persatuan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Persatuan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Persatuan::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
