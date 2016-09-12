<?php

namespace frontend\controllers;

use Yii;
use app\models\RefPeringkatBantuanMenghadiriProgramAntarabangsa;
use frontend\models\RefPeringkatBantuanMenghadiriProgramAntarabangsaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RefPeringkatBantuanMenghadiriProgramAntarabangsaController implements the CRUD actions for RefPeringkatBantuanMenghadiriProgramAntarabangsa model.
 */
class RefPeringkatBantuanMenghadiriProgramAntarabangsaController extends Controller
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
     * Lists all RefPeringkatBantuanMenghadiriProgramAntarabangsa models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RefPeringkatBantuanMenghadiriProgramAntarabangsaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single RefPeringkatBantuanMenghadiriProgramAntarabangsa model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new RefPeringkatBantuanMenghadiriProgramAntarabangsa model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new RefPeringkatBantuanMenghadiriProgramAntarabangsa();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing RefPeringkatBantuanMenghadiriProgramAntarabangsa model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing RefPeringkatBantuanMenghadiriProgramAntarabangsa model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the RefPeringkatBantuanMenghadiriProgramAntarabangsa model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return RefPeringkatBantuanMenghadiriProgramAntarabangsa the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = RefPeringkatBantuanMenghadiriProgramAntarabangsa::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
