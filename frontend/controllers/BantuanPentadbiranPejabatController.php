<?php

namespace frontend\controllers;

use Yii;
use app\models\BantuanPentadbiranPejabat;
use frontend\models\BantuanPentadbiranPejabatSearch;
use app\models\InformasiPermohonan;
use frontend\models\InformasiPermohonanSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use app\models\general\GeneralVariable;

// table reference
use app\models\RefJawatanBantuanPentadbiranPejabat;
use app\models\RefStatusPermohonanBantuanPentadbiranPejabat;
use app\models\RefBandar;
use app\models\RefNegeri;

/**
 * BantuanPentadbiranPejabatController implements the CRUD actions for BantuanPentadbiranPejabat model.
 */
class BantuanPentadbiranPejabatController extends Controller
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
     * Lists all BantuanPentadbiranPejabat models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect($this->redirect(array(GeneralVariable::loginPagePath)));
        }
        
        $searchModel = new BantuanPentadbiranPejabatSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single BantuanPentadbiranPejabat model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect($this->redirect(array(GeneralVariable::loginPagePath)));
        }
        
        $model = $this->findModel($id);
        
        $ref = RefJawatanBantuanPentadbiranPejabat::findOne(['id' => $model->jawatan]);
        $model->jawatan = $ref['desc'];
        
        $ref = RefStatusPermohonanBantuanPentadbiranPejabat::findOne(['id' => $model->status_permohonan]);
        $model->status_permohonan = $ref['desc'];
        
        $ref = RefBandar::findOne(['id' => $model->alamat_bandar]);
        $model->alamat_bandar = $ref['desc'];
        
        $ref = RefNegeri::findOne(['id' => $model->alamat_negeri]);
        $model->alamat_negeri = $ref['desc'];
        
        $queryPar = null;
        
        $queryPar['InformasiPermohonanSearch']['bantuan_pentadbiran_pejabat_id'] = $id;
        
        $searchModelInformasiPermohonan  = new InformasiPermohonanSearch();
        $dataProviderInformasiPermohonan = $searchModelInformasiPermohonan->search($queryPar);
        
        return $this->render('view', [
            'model' => $model,
            'searchModelInformasiPermohonan' => $searchModelInformasiPermohonan,
            'dataProviderInformasiPermohonan' => $dataProviderInformasiPermohonan,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new BantuanPentadbiranPejabat model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect($this->redirect(array(GeneralVariable::loginPagePath)));
        }
        
        $model = new BantuanPentadbiranPejabat();
        
        $queryPar = null;
        
        Yii::$app->session->open();
        
        if(isset(Yii::$app->session->id)){
            $queryPar['InformasiPermohonanSearch']['session_id'] = Yii::$app->session->id;
        }
        
        $searchModelInformasiPermohonan  = new InformasiPermohonanSearch();
        $dataProviderInformasiPermohonan = $searchModelInformasiPermohonan->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if(isset(Yii::$app->session->id)){
                InformasiPermohonan::updateAll(['bantuan_pentadbiran_pejabat_id' => $model->bantuan_pentadbiran_pejabat_id], 'session_id = "'.Yii::$app->session->id.'"');
                InformasiPermohonan::updateAll(['session_id' => ''], 'bantuan_pentadbiran_pejabat_id = "'.$model->bantuan_pentadbiran_pejabat_id.'"');
            }
            
            return $this->redirect(['view', 'id' => $model->bantuan_pentadbiran_pejabat_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'searchModelInformasiPermohonan' => $searchModelInformasiPermohonan,
                'dataProviderInformasiPermohonan' => $dataProviderInformasiPermohonan,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Updates an existing BantuanPentadbiranPejabat model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect($this->redirect(array(GeneralVariable::loginPagePath)));
        }
        
        $model = $this->findModel($id);
        
        $queryPar = null;
        
        $queryPar['InformasiPermohonanSearch']['bantuan_pentadbiran_pejabat_id'] = $id;
        
        $searchModelInformasiPermohonan  = new InformasiPermohonanSearch();
        $dataProviderInformasiPermohonan = $searchModelInformasiPermohonan->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->bantuan_pentadbiran_pejabat_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'searchModelInformasiPermohonan' => $searchModelInformasiPermohonan,
                'dataProviderInformasiPermohonan' => $dataProviderInformasiPermohonan,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Deletes an existing BantuanPentadbiranPejabat model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect($this->redirect(array(GeneralVariable::loginPagePath)));
        }
        
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the BantuanPentadbiranPejabat model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return BantuanPentadbiranPejabat the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = BantuanPentadbiranPejabat::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
