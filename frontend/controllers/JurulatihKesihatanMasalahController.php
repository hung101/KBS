<?php

namespace frontend\controllers;

use Yii;
use app\models\JurulatihKesihatanMasalah;
use frontend\models\JurulatihKesihatanMasalahSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use app\models\general\GeneralVariable;

// table reference
use app\models\RefMasalahKesihatan;

/**
 * JurulatihKesihatanMasalahController implements the CRUD actions for JurulatihKesihatanMasalah model.
 */
class JurulatihKesihatanMasalahController extends Controller
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
     * Lists all JurulatihKesihatanMasalah models.
     * @return mixed
     */
    public function actionIndex($jurulatih_kesihatan_id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $queryPar = null;
        
        $queryPar = Yii::$app->request->queryParams;
        
        if($jurulatih_kesihatan_id != ''){
            $queryPar['JurulatihKesihatanMasalahSearch']['jurulatih_kesihatan_id'] = $jurulatih_kesihatan_id;
        } else {
            if(isset(Yii::$app->session->id)){
                $queryPar['JurulatihKesihatanMasalahSearch']['session_id'] = Yii::$app->session->id;
            }
        }
        
        $searchModel = new JurulatihKesihatanMasalahSearch();
        $dataProvider = $searchModel->search($queryPar);

        return $this->renderAjax('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single JurulatihKesihatanMasalah model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = $this->findModel($id);
        
        $ref = RefMasalahKesihatan::findOne(['id' => $model->masalah_kesihatan]);
        $model->masalah_kesihatan = $ref['desc'];
        
        return $this->renderAjax('view', [
            'model' => $model,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new JurulatihKesihatanMasalah model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($jurulatih_kesihatan_id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new JurulatihKesihatanMasalah();
        
        Yii::$app->session->open();
        
        if($jurulatih_kesihatan_id != ''){
            $model->jurulatih_kesihatan_id = $jurulatih_kesihatan_id;
        } else {
            if(isset(Yii::$app->session->id)){
                $model->session_id = Yii::$app->session->id;
            }
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //return $this->redirect(['view', 'id' => $model->jurulatih_kesihatan_kesihatan_id]);
            return "1/pipe?" . self::actionIndex($jurulatih_kesihatan_id);
        } else {
            return $this->renderAjax('create', [
                'model' => $model,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Updates an existing JurulatihKesihatanMasalah model.
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
        
        $jurulatih_kesihatan_id = '';
        
        if(isset($model->jurulatih_kesihatan_id)){
            $jurulatih_kesihatan_id = $model->jurulatih_kesihatan_id;
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //return $this->redirect(['view', 'id' => $model->jurulatih_kesihatan_kesihatan_id]);
            return "1/pipe?" . self::actionIndex($jurulatih_kesihatan_id);
        } else {
            return $this->renderAjax('update', [
                'model' => $model,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Deletes an existing JurulatihKesihatanMasalah model.
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
        
        $jurulatih_kesihatan_id = '';
        
        if(isset($model->jurulatih_kesihatan_id)){
            $jurulatih_kesihatan_id = $model->jurulatih_kesihatan_id;
        }

        //return $this->redirect(['index']);
        return "1/pipe?" . self::actionIndex($jurulatih_kesihatan_id);
    }

    /**
     * Finds the JurulatihKesihatanMasalah model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return JurulatihKesihatanMasalah the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = JurulatihKesihatanMasalah::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
