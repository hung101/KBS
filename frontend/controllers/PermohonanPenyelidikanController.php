<?php

namespace frontend\controllers;

use Yii;
use app\models\PermohonanPenyelidikan;
use frontend\models\PermohonanPenyelidikanSearch;
use app\models\PenyelidikanKomposisiPasukan;
use frontend\models\PenyelidikanKomposisiPasukanSearch;
use app\models\DokumenPenyelidikan;
use frontend\models\DokumenPenyelidikanSearch;
use app\models\BajetPenyelidikan;
use frontend\models\BajetPenyelidikanSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

// contant values
use app\models\general\GeneralVariable;
use app\models\general\GeneralLabel;

/**
 * PermohonanPenyelidikanController implements the CRUD actions for PermohonanPenyelidikan model.
 */
class PermohonanPenyelidikanController extends Controller
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
     * Lists all PermohonanPenyelidikan models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $searchModel = new PermohonanPenyelidikanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PermohonanPenyelidikan model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = $this->findModel($id);
        
        $model->biasa_dengan_keperluan_penyelidikan  = GeneralLabel::getYesNoLabel($model->biasa_dengan_keperluan_penyelidikan);
        
        $model->kelulusan_echics  = GeneralLabel::getYesNoLabel($model->kelulusan_echics);
        
        $model->kelulusan  = GeneralLabel::getYesNoLabel($model->kelulusan);
        
        $queryPar = null;
        
        $queryPar['PenyelidikanKomposisiPasukanSearch']['pengurusan_perhimpunan_kem_id'] = $id;
        $queryPar['DokumenPenyelidikanSearch']['pengurusan_perhimpunan_kem_id'] = $id;
        $queryPar['BajetPenyelidikanSearch']['pengurusan_perhimpunan_kem_id'] = $id;
        
        $searchModelPenyelidikanKomposisiPasukan  = new PenyelidikanKomposisiPasukanSearch();
        $dataProviderPenyelidikanKomposisiPasukan = $searchModelPenyelidikanKomposisiPasukan->search($queryPar);
        
        $searchModelDokumenPenyelidikan  = new DokumenPenyelidikanSearch();
        $dataProviderDokumenPenyelidikan = $searchModelDokumenPenyelidikan->search($queryPar);
        
        $searchModelBajetPenyelidikan = new BajetPenyelidikanSearch();
        $dataProviderBajetPenyelidikan = $searchModelBajetPenyelidikan->search($queryPar);
        
        return $this->render('view', [
            'model' => $model,
            'searchModelPenyelidikanKomposisiPasukan' => $searchModelPenyelidikanKomposisiPasukan,
            'dataProviderPenyelidikanKomposisiPasukan' => $dataProviderPenyelidikanKomposisiPasukan,
            'searchModelDokumenPenyelidikan' => $searchModelDokumenPenyelidikan,
            'dataProviderDokumenPenyelidikan' => $dataProviderDokumenPenyelidikan,
            'searchModelBajetPenyelidikan' => $searchModelBajetPenyelidikan,
            'dataProviderBajetPenyelidikan' => $dataProviderBajetPenyelidikan,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new PermohonanPenyelidikan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new PermohonanPenyelidikan();
        
        $queryPar = null;
        
        Yii::$app->session->open();
        
        if(isset(Yii::$app->session->id)){
            $queryPar['PenyelidikanKomposisiPasukanSearch']['session_id'] = Yii::$app->session->id;
            $queryPar['DokumenPenyelidikanSearch']['session_id'] = Yii::$app->session->id;
            $queryPar['BajetPenyelidikanSearch']['session_id'] = Yii::$app->session->id;
        }
        
        $searchModelPenyelidikanKomposisiPasukan  = new PenyelidikanKomposisiPasukanSearch();
        $dataProviderPenyelidikanKomposisiPasukan = $searchModelPenyelidikanKomposisiPasukan->search($queryPar);
        
        $searchModelDokumenPenyelidikan  = new DokumenPenyelidikanSearch();
        $dataProviderDokumenPenyelidikan = $searchModelDokumenPenyelidikan->search($queryPar);
        
        $searchModelBajetPenyelidikan = new BajetPenyelidikanSearch();
        $dataProviderBajetPenyelidikan = $searchModelBajetPenyelidikan->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if(isset(Yii::$app->session->id)){
                PenyelidikanKomposisiPasukan::updateAll(['permohonana_penyelidikan_id' => $model->permohonana_penyelidikan_id], 'session_id = "'.Yii::$app->session->id.'"');
                PenyelidikanKomposisiPasukan::updateAll(['session_id' => ''], 'permohonana_penyelidikan_id = "'.$model->permohonana_penyelidikan_id.'"');
                
                DokumenPenyelidikan::updateAll(['permohonana_penyelidikan_id' => $model->permohonana_penyelidikan_id], 'session_id = "'.Yii::$app->session->id.'"');
                DokumenPenyelidikan::updateAll(['session_id' => ''], 'permohonana_penyelidikan_id = "'.$model->permohonana_penyelidikan_id.'"');
                
                BajetPenyelidikan::updateAll(['permohonana_penyelidikan_id' => $model->permohonana_penyelidikan_id], 'session_id = "'.Yii::$app->session->id.'"');
                BajetPenyelidikan::updateAll(['session_id' => ''], 'permohonana_penyelidikan_id = "'.$model->permohonana_penyelidikan_id.'"');
            }
            
            return $this->redirect(['view', 'id' => $model->permohonana_penyelidikan_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'searchModelPenyelidikanKomposisiPasukan' => $searchModelPenyelidikanKomposisiPasukan,
                'dataProviderPenyelidikanKomposisiPasukan' => $dataProviderPenyelidikanKomposisiPasukan,
                'searchModelDokumenPenyelidikan' => $searchModelDokumenPenyelidikan,
                'dataProviderDokumenPenyelidikan' => $dataProviderDokumenPenyelidikan,
                'searchModelBajetPenyelidikan' => $searchModelBajetPenyelidikan,
                'dataProviderBajetPenyelidikan' => $dataProviderBajetPenyelidikan,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Updates an existing PermohonanPenyelidikan model.
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
        
        $queryPar['PenyelidikanKomposisiPasukanSearch']['pengurusan_perhimpunan_kem_id'] = $id;
        $queryPar['DokumenPenyelidikanSearch']['pengurusan_perhimpunan_kem_id'] = $id;
        $queryPar['BajetPenyelidikanSearch']['pengurusan_perhimpunan_kem_id'] = $id;
        
        $searchModelPenyelidikanKomposisiPasukan  = new PenyelidikanKomposisiPasukanSearch();
        $dataProviderPenyelidikanKomposisiPasukan = $searchModelPenyelidikanKomposisiPasukan->search($queryPar);
        
        $searchModelDokumenPenyelidikan  = new DokumenPenyelidikanSearch();
        $dataProviderDokumenPenyelidikan = $searchModelDokumenPenyelidikan->search($queryPar);
        
        $searchModelBajetPenyelidikan = new BajetPenyelidikanSearch();
        $dataProviderBajetPenyelidikan = $searchModelBajetPenyelidikan->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->permohonana_penyelidikan_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'searchModelPenyelidikanKomposisiPasukan' => $searchModelPenyelidikanKomposisiPasukan,
                'dataProviderPenyelidikanKomposisiPasukan' => $dataProviderPenyelidikanKomposisiPasukan,
                'searchModelDokumenPenyelidikan' => $searchModelDokumenPenyelidikan,
                'dataProviderDokumenPenyelidikan' => $dataProviderDokumenPenyelidikan,
                'searchModelBajetPenyelidikan' => $searchModelBajetPenyelidikan,
                'dataProviderBajetPenyelidikan' => $dataProviderBajetPenyelidikan,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Deletes an existing PermohonanPenyelidikan model.
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
     * Finds the PermohonanPenyelidikan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PermohonanPenyelidikan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PermohonanPenyelidikan::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
