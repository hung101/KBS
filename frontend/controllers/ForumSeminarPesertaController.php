<?php

namespace frontend\controllers;

use Yii;
use app\models\ForumSeminarPeserta;
use frontend\models\ForumSeminarPesertaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use app\models\general\GeneralVariable;

/**
 * ForumSeminarPesertaController implements the CRUD actions for ForumSeminarPeserta model.
 */
class ForumSeminarPesertaController extends Controller
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
     * Lists all ForumSeminarPeserta models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ForumSeminarPesertaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ForumSeminarPeserta model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
		if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
		
        $model = $this->findModel($id);
		
		return $this->renderAjax('view', [
            'model' => $model,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new ForumSeminarPeserta model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($forum_seminar_persidangan_di_luar_negara_id)
    {
		if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
		
        $model = new ForumSeminarPeserta();
		
		if($forum_seminar_persidangan_di_luar_negara_id != ''){
            $model->forum_seminar_persidangan_di_luar_negara_id = $forum_seminar_persidangan_di_luar_negara_id;
        } else {
            if(isset(Yii::$app->session->id)){
                $model->session_id = Yii::$app->session->id;
            }
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return '1';
        } 
		
		return $this->renderAjax('create', [
			'model' => $model,
			'readonly' => false,
		]);
    }

    /**
     * Updates an existing ForumSeminarPeserta model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
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
     * Deletes an existing ForumSeminarPeserta model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        //return $this->redirect(['index']);
    }

    /**
     * Finds the ForumSeminarPeserta model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ForumSeminarPeserta the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ForumSeminarPeserta::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
