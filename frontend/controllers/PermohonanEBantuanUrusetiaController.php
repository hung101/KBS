<?php

namespace frontend\controllers;

use Yii;
use app\models\PermohonanEBantuanUrusetia;
use frontend\models\PermohonanEBantuanUrusetiaSearch;
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
 * PermohonanEBantuanUrusetiaController implements the CRUD actions for PermohonanEBantuanUrusetia model.
 */
class PermohonanEBantuanUrusetiaController extends Controller
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
     * Lists all PermohonanEBantuanUrusetia models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $queryPar = Yii::$app->request->queryParams;
        
        $queryPar['PermohonanEBantuanUrusetiaSearch']['peranan'] = UserPeranan::PERANAN_KBS_E_BANTUAN_URUSETIA;
        
        $searchModel = new PermohonanEBantuanUrusetiaSearch();
        $dataProvider = $searchModel->search($queryPar);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PermohonanEBantuanUrusetia model.
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
        
        return $this->render('view', [
            'model' => $model,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new PermohonanEBantuanUrusetia model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new PermohonanEBantuanUrusetia();
        
        $model->peranan = UserPeranan::PERANAN_KBS_E_BANTUAN_URUSETIA;
        $model->from_module = GeneralVariable::moduleKBSeBiasiswa;

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
     * Updates an existing PermohonanEBantuanUrusetia model.
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
     * Deletes an existing PermohonanEBantuanUrusetia model.
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
     * Finds the PermohonanEBantuanUrusetia model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PermohonanEBantuanUrusetia the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PermohonanEBantuanUrusetia::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
