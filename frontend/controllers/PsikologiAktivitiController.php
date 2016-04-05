<?php

namespace frontend\controllers;

use Yii;
use app\models\PsikologiAktiviti;
use frontend\models\PsikologiAktivitiSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use app\models\general\GeneralVariable;
use common\models\general\GeneralFunction;

// table reference
use app\models\PsikologiProfil;

/**
 * PsikologiAktivitiController implements the CRUD actions for PsikologiAktiviti model.
 */
class PsikologiAktivitiController extends Controller
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
     * Lists all PsikologiAktiviti models.
     * @return mixed
     */
    public function actionIndex($psikologi_profil_id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $queryPar = Yii::$app->request->queryParams;
        
        if($psikologi_profil_id!=""){
            $queryPar['PsikologiAktivitiSearch']['psikologi_profil_id'] = $psikologi_profil_id;
        }
        
        $searchModel = new PsikologiAktivitiSearch();
        $dataProvider = $searchModel->search($queryPar);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'psikologi_profil_id' => $psikologi_profil_id,
        ]);
    }

    /**
     * Displays a single PsikologiAktiviti model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = $this->findModel($id);
        
        /*$ref = PsikologiProfil::findOne(['psikologi_profil_id' => $model->psikologi_profil_id]);
        $model->psikologi_profil_id = $ref['nama'];*/
        
        $model->tarikh_mula = GeneralFunction::convert($model->tarikh_mula, GeneralFunction::TYPE_DATETIME);
        
        $model->tarikh_tamat = GeneralFunction::convert($model->tarikh_tamat, GeneralFunction::TYPE_DATETIME);
        
        return $this->render('view', [
            'model' => $model,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new PsikologiAktiviti model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($psikologi_profil_id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new PsikologiAktiviti();
        
        if($psikologi_profil_id!=""){
            $model->psikologi_profil_id = $psikologi_profil_id;
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->psikologi_aktiviti_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'readonly' => false,
                'psikologi_profil_id' => $psikologi_profil_id,
            ]);
        }
    }

    /**
     * Updates an existing PsikologiAktiviti model.
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

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->psikologi_aktiviti_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Deletes an existing PsikologiAktiviti model.
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
     * Finds the PsikologiAktiviti model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PsikologiAktiviti the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PsikologiAktiviti::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
