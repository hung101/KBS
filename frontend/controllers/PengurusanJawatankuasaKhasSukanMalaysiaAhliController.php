<?php

namespace frontend\controllers;

use Yii;
use app\models\PengurusanJawatankuasaKhasSukanMalaysiaAhli;
use frontend\models\PengurusanJawatankuasaKhasSukanMalaysiaAhliSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use app\models\general\GeneralVariable;

// table reference
use app\models\RefNegeri;
use app\models\RefJenisKeahlian;
use app\models\RefJawatanJawatankuasaKhas;
use app\models\RefAgensiOrganisasi;
use app\models\RefJawatankuasaKhas;


/**
 * PengurusanJawatankuasaKhasSukanMalaysiaAhliController implements the CRUD actions for PengurusanJawatankuasaKhasSukanMalaysiaAhli model.
 */
class PengurusanJawatankuasaKhasSukanMalaysiaAhliController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all PengurusanJawatankuasaKhasSukanMalaysiaAhli models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $searchModel = new PengurusanJawatankuasaKhasSukanMalaysiaAhliSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PengurusanJawatankuasaKhasSukanMalaysiaAhli model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = $this->findModel($id);
        
        $ref = RefJenisKeahlian::findOne(['id' => $model->jenis_keahlian]);
        $model->jenis_keahlian = $ref['desc'];
        
        $ref = RefJawatanJawatankuasaKhas::findOne(['id' => $model->jawatan]);
        $model->jawatan = $ref['desc'];
        
        $ref = RefNegeri::findOne(['id' => $model->negeri]);
        $model->negeri = $ref['desc'];
        
        $ref = RefAgensiOrganisasi::findOne(['id' => $model->agensi_organisasi]);
        $model->agensi_organisasi = $ref['desc'];
        
        $ref = RefJawatankuasaKhas::findOne(['id' => $model->jawatankuasa]);
        $model->jawatankuasa = $ref['desc'];
        
        return $this->renderAjax('view', [
            'model' => $model,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new PengurusanJawatankuasaKhasSukanMalaysiaAhli model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($pengurusan_jawatankuasa_khas_sukan_malaysia_id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new PengurusanJawatankuasaKhasSukanMalaysiaAhli();
        
        Yii::$app->session->open();
        
        if($pengurusan_jawatankuasa_khas_sukan_malaysia_id != ''){
            $model->pengurusan_jawatankuasa_khas_sukan_malaysia_id = $pengurusan_jawatankuasa_khas_sukan_malaysia_id;
        } else {
            if(isset(Yii::$app->session->id)){
                $model->session_id = Yii::$app->session->id;
            }
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return '1';
        } else {
            return $this->renderAjax('create', [
                'model' => $model,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Updates an existing PengurusanJawatankuasaKhasSukanMalaysiaAhli model.
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
            return '1';
        } else {
            return $this->renderAjax('update', [
                'model' => $model,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Deletes an existing PengurusanJawatankuasaKhasSukanMalaysiaAhli model.
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

        //return $this->redirect(['index']);
    }

    /**
     * Finds the PengurusanJawatankuasaKhasSukanMalaysiaAhli model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PengurusanJawatankuasaKhasSukanMalaysiaAhli the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PengurusanJawatankuasaKhasSukanMalaysiaAhli::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
