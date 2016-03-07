<?php

namespace frontend\controllers;

use Yii;
use app\models\BspPertukaranProgramPengajian;
use frontend\models\BspPertukaranProgramPengajianSearch;
use app\models\BspPertukaranProgramPengajianSebab;
use frontend\models\BspPertukaranProgramPengajianSebabSearch;
use app\models\BspPertukaranProgramPengajianDokumen;
use frontend\models\BspPertukaranProgramPengajianDokumenSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use app\models\general\GeneralVariable;

/**
 * BspPertukaranProgramPengajianController implements the CRUD actions for BspPertukaranProgramPengajian model.
 */
class BspPertukaranProgramPengajianController extends Controller
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
     * Lists all BspPertukaranProgramPengajian models.
     * @return mixed
     */
    public function actionIndex($bsp_pemohon_id)
    {
        if($bsp_pemohon_id != ""){
            if (Yii::$app->user->isGuest) {
                return $this->redirect(array(GeneralVariable::loginPagePath));
            }
            
            $queryPar = Yii::$app->request->queryParams;

            $queryPar['BspPertukaranProgramPengajianSearch']['bsp_pemohon_id'] = $bsp_pemohon_id;

            $searchModel = new BspPertukaranProgramPengajianSearch();
            $dataProvider = $searchModel->search($queryPar);

            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                'bsp_pemohon_id' => $bsp_pemohon_id,
            ]);
        }
    }

    /**
     * Displays a single BspPertukaranProgramPengajian model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $queryPar = null;
        
        $queryPar['BspPertukaranProgramPengajianSebabSearch']['bsp_pertukaran_program_pengajian_id'] = $id;
        $queryPar['BspPertukaranProgramPengajianDokumenSearch']['bsp_pertukaran_program_pengajian_id'] = $id;
        
        $searchModelBspPertukaranProgramPengajianSebab = new BspPertukaranProgramPengajianSebabSearch();
        $dataProviderBspPertukaranProgramPengajianSebab = $searchModelBspPertukaranProgramPengajianSebab->search($queryPar);
        
        $searchModelBspPertukaranProgramPengajianDokumen = new BspPertukaranProgramPengajianDokumenSearch();
        $dataProviderBspPertukaranProgramPengajianDokumen = $searchModelBspPertukaranProgramPengajianDokumen->search($queryPar);
        
        return $this->render('view', [
            'model' => $this->findModel($id),
            'searchModelBspPertukaranProgramPengajianSebab' => $searchModelBspPertukaranProgramPengajianSebab,
            'dataProviderBspPertukaranProgramPengajianSebab' => $dataProviderBspPertukaranProgramPengajianSebab,
            'searchModelBspPertukaranProgramPengajianDokumen' => $searchModelBspPertukaranProgramPengajianDokumen,
            'dataProviderBspPertukaranProgramPengajianDokumen' => $dataProviderBspPertukaranProgramPengajianDokumen,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new BspPertukaranProgramPengajian model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($bsp_pemohon_id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new BspPertukaranProgramPengajian();
        
        $model->bsp_pemohon_id = $bsp_pemohon_id;
        
        $queryPar = null;
        
        Yii::$app->session->open();
        
        if(isset(Yii::$app->session->id)){
            $queryPar['BspPertukaranProgramPengajianSebabSearch']['session_id'] = Yii::$app->session->id;
            $queryPar['BspPertukaranProgramPengajianDokumenSearch']['session_id'] = Yii::$app->session->id;
        }
        
        $searchModelBspPertukaranProgramPengajianSebab = new BspPertukaranProgramPengajianSebabSearch();
        $dataProviderBspPertukaranProgramPengajianSebab = $searchModelBspPertukaranProgramPengajianSebab->search($queryPar);
        
        $searchModelBspPertukaranProgramPengajianDokumen = new BspPertukaranProgramPengajianDokumenSearch();
        $dataProviderBspPertukaranProgramPengajianDokumen = $searchModelBspPertukaranProgramPengajianDokumen->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            // update all the temporary session id with Pertukaran Program Pengajian Dokumen/Sebab
            if(isset(Yii::$app->session->id)){
                BspPertukaranProgramPengajianSebab::updateAll(['bsp_pertukaran_program_pengajian_id' => $model->bsp_pertukaran_program_pengajian_id], 'session_id = "'.Yii::$app->session->id.'"');
                BspPertukaranProgramPengajianSebab::updateAll(['session_id' => ''], 'bsp_pertukaran_program_pengajian_id = "'.$model->bsp_pertukaran_program_pengajian_id.'"');
                
                BspPertukaranProgramPengajianDokumen::updateAll(['bsp_pertukaran_program_pengajian_id' => $model->bsp_pertukaran_program_pengajian_id], 'session_id = "'.Yii::$app->session->id.'"');
                BspPertukaranProgramPengajianDokumen::updateAll(['session_id' => ''], 'bsp_pertukaran_program_pengajian_id = "'.$model->bsp_pertukaran_program_pengajian_id.'"');
            }
            
            return $this->redirect(['view', 'id' => $model->bsp_pertukaran_program_pengajian_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'searchModelBspPertukaranProgramPengajianSebab' => $searchModelBspPertukaranProgramPengajianSebab,
                'dataProviderBspPertukaranProgramPengajianSebab' => $dataProviderBspPertukaranProgramPengajianSebab,
                'searchModelBspPertukaranProgramPengajianDokumen' => $searchModelBspPertukaranProgramPengajianDokumen,
                'dataProviderBspPertukaranProgramPengajianDokumen' => $dataProviderBspPertukaranProgramPengajianDokumen,
                'readonly' => false,
                'bsp_pemohon_id' => $bsp_pemohon_id,
            ]);
        }
    }

    /**
     * Updates an existing BspPertukaranProgramPengajian model.
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
        
        $queryPar['BspPertukaranProgramPengajianSebabSearch']['bsp_pertukaran_program_pengajian_id'] = $id;
        $queryPar['BspPertukaranProgramPengajianDokumenSearch']['bsp_pertukaran_program_pengajian_id'] = $id;
        
        $searchModelBspPertukaranProgramPengajianSebab = new BspPertukaranProgramPengajianSebabSearch();
        $dataProviderBspPertukaranProgramPengajianSebab = $searchModelBspPertukaranProgramPengajianSebab->search($queryPar);
        
        $searchModelBspPertukaranProgramPengajianDokumen = new BspPertukaranProgramPengajianDokumenSearch();
        $dataProviderBspPertukaranProgramPengajianDokumen = $searchModelBspPertukaranProgramPengajianDokumen->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->bsp_pertukaran_program_pengajian_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'searchModelBspPertukaranProgramPengajianSebab' => $searchModelBspPertukaranProgramPengajianSebab,
                'dataProviderBspPertukaranProgramPengajianSebab' => $dataProviderBspPertukaranProgramPengajianSebab,
                'searchModelBspPertukaranProgramPengajianDokumen' => $searchModelBspPertukaranProgramPengajianDokumen,
                'dataProviderBspPertukaranProgramPengajianDokumen' => $dataProviderBspPertukaranProgramPengajianDokumen,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Deletes an existing BspPertukaranProgramPengajian model.
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
     * Finds the BspPertukaranProgramPengajian model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return BspPertukaranProgramPengajian the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = BspPertukaranProgramPengajian::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
