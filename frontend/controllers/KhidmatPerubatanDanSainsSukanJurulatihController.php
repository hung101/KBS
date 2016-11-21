<?php

namespace frontend\controllers;

use Yii;
use app\models\KhidmatPerubatanDanSainsSukanJurulatih;
use frontend\models\KhidmatPerubatanDanSainsSukanJurulatihSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use app\models\general\GeneralVariable;

// table reference
use app\models\RefSukan;
use app\models\RefProgramJurulatih;
use app\models\Jurulatih;

/**
 * KhidmatPerubatanDanSainsSukanJurulatihController implements the CRUD actions for KhidmatPerubatanDanSainsSukanJurulatih model.
 */
class KhidmatPerubatanDanSainsSukanJurulatihController extends Controller
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
     * Lists all KhidmatPerubatanDanSainsSukanJurulatih models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $searchModel = new KhidmatPerubatanDanSainsSukanJurulatihSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single KhidmatPerubatanDanSainsSukanJurulatih model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = $this->findModel($id);
        
        $ref = RefSukan::findOne(['id' => $model->sukan]);
        $model->sukan = $ref['desc'];
        
        $ref = RefProgramJurulatih::findOne(['id' => $model->program]);
        $model->program = $ref['desc'];
        
        $ref = Jurulatih::findOne(['jurulatih_id' => $model->jurulatih]);
        $model->jurulatih = $ref['nama'];
        
        return $this->renderAjax('view', [
            'model' => $model,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new KhidmatPerubatanDanSainsSukanJurulatih model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($khidmat_perubatan_dan_sains_sukan_id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new KhidmatPerubatanDanSainsSukanJurulatih();
        
        Yii::$app->session->open();
        
        if($khidmat_perubatan_dan_sains_sukan_id != ''){
            $model->khidmat_perubatan_dan_sains_sukan_id = $khidmat_perubatan_dan_sains_sukan_id;
        } else {
            if(isset(Yii::$app->session->id)){
                $model->session_id = Yii::$app->session->id;
            }
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //return $this->redirect(['view', 'id' => $model->khidmat_perubatan_dan_sains_sukan_jurulatih_id]);
            return  '1';
        } else {
            return $this->renderAjax('create', [
                'model' => $model,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Updates an existing KhidmatPerubatanDanSainsSukanJurulatih model.
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
            //return $this->redirect(['view', 'id' => $model->khidmat_perubatan_dan_sains_sukan_jurulatih_id]);
            return  '1';
        } else {
            return $this->renderAjax('update', [
                'model' => $model,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Deletes an existing KhidmatPerubatanDanSainsSukanJurulatih model.
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
     * Finds the KhidmatPerubatanDanSainsSukanJurulatih model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return KhidmatPerubatanDanSainsSukanJurulatih the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = KhidmatPerubatanDanSainsSukanJurulatih::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
