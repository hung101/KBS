<?php

namespace frontend\controllers;

use Yii;
use app\models\RefJenisProgramBantuanMenghadiriProgramAntarabangsa;
use frontend\models\RefJenisProgramBantuanMenghadiriProgramAntarabangsaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RefJenisProgramBantuanMenghadiriProgramAntarabangsaController implements the CRUD actions for RefJenisProgramBantuanMenghadiriProgramAntarabangsa model.
 */
class RefJenisProgramBantuanMenghadiriProgramAntarabangsaController extends Controller
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
     * Lists all RefJenisProgramBantuanMenghadiriProgramAntarabangsa models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RefJenisProgramBantuanMenghadiriProgramAntarabangsaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single RefJenisProgramBantuanMenghadiriProgramAntarabangsa model.
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
     * Creates a new RefJenisProgramBantuanMenghadiriProgramAntarabangsa model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new RefJenisProgramBantuanMenghadiriProgramAntarabangsa();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing RefJenisProgramBantuanMenghadiriProgramAntarabangsa model.
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
     * Deletes an existing RefJenisProgramBantuanMenghadiriProgramAntarabangsa model.
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
     * Finds the RefJenisProgramBantuanMenghadiriProgramAntarabangsa model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return RefJenisProgramBantuanMenghadiriProgramAntarabangsa the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = RefJenisProgramBantuanMenghadiriProgramAntarabangsa::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
