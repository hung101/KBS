<?php

namespace frontend\controllers;

use Yii;
use app\models\JurulatihSukan;
use frontend\models\JurulatihSukanSearch;
use app\models\JurulatihSukanAcara;
use frontend\models\JurulatihSukanAcaraSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Session;
use yii\web\UploadedFile;
use yii\helpers\Json;

use app\models\general\Upload;
use app\models\general\GeneralVariable;

// table reference
use app\models\RefSukan;
use app\models\RefCawangan;
use app\models\RefGajiElaunJurulatih;
use app\models\RefProgramJurulatih;
use app\models\RefBahagianJurulatih;


/**
 * JurulatihSukanController implements the CRUD actions for JurulatihSukan model.
 */
class JurulatihSukanController extends Controller
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
     * Lists all JurulatihSukan models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $request = Yii::$app->request;
        
        $queryPar = Yii::$app->request->queryParams;
        
        // Filter by jurulatih id
        $session = new Session;
        $session->open();

        if(isset($session['jurulatih_id'])){
            $queryPar['JurulatihSukanSearch']['jurulatih_id'] = $session['jurulatih_id'];
        }
        
        $session->close();
        
        $searchModel = new JurulatihSukanSearch();
        $dataProvider = $searchModel->search($queryPar);

        $renderContent = $this->renderAjax('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);

        if($request->get('typeJson') != NULL){
            return json_encode($renderContent);
        }else {
            return $renderContent;
        }
    }

    /**
     * Displays a single JurulatihSukan model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $queryPar = null;
        
        $queryPar['JurulatihSukanAcaraSearch']['jurulatih_sukan_id'] = $id;
        
        $searchModelAcara = new JurulatihSukanAcaraSearch();
        $dataProviderAcara = $searchModelAcara->search($queryPar);
        
        $model = $this->findModel($id);
        
        $ref = RefCawangan::findOne(['id' => $model->cawangan]);
        $model->cawangan = $ref['desc'];
        
        $ref = RefGajiElaunJurulatih::findOne(['id' => $model->gaji_elaun]);
        $model->gaji_elaun = $ref['desc'];
        
        $ref = RefSukan::findOne(['id' => $model->sukan]);
        $model->sukan = $ref['desc'];
        
        $ref = RefProgramJurulatih::findOne(['id' => $model->program]);
        $model->program = $ref['desc'];
        
        $ref = RefBahagianJurulatih::findOne(['id' => $model->bahagian]);
        $model->bahagian = $ref['desc'];
        
        return $this->renderAjax('view', [
            'model' => $model,
            'searchModelAcara' => $searchModelAcara,
            'dataProviderAcara' => $dataProviderAcara,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new JurulatihSukan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new JurulatihSukan();
        
        // set Jurulatih Id
        $session = new Session;
        $session->open();

        if(isset($session['jurulatih_id'])){
            $model->jurulatih_id = $session['jurulatih_id'];
        }
        
        $session->close();
        
        $queryPar = null;
        
        Yii::$app->session->open();
        
        if(isset(Yii::$app->session->id)){
            $queryPar['JurulatihSukanAcaraSearch']['session_id'] = Yii::$app->session->id;
        }
        
        $searchModelAcara = new JurulatihSukanAcaraSearch();
        $dataProviderAcara = $searchModelAcara->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if(isset(Yii::$app->session->id)){
                JurulatihSukanAcara::updateAll(['jurulatih_sukan_id' => $model->jurulatih_sukan_id], 'session_id = "'.Yii::$app->session->id.'"');
                JurulatihSukanAcara::updateAll(['session_id' => ''], 'jurulatih_sukan_id = "'.$model->jurulatih_sukan_id.'"');
            }
            
            //return $this->redirect(['view', 'id' => $model->jurulatih_sukan_id]);
            return self::actionView($model->jurulatih_sukan_id);
        } else {
            return $this->renderAjax('create', [
                'model' => $model,
                'searchModelAcara' => $searchModelAcara,
                'dataProviderAcara' => $dataProviderAcara,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Updates an existing JurulatihSukan model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $queryPar = null;
        
        $queryPar['JurulatihSukanAcaraSearch']['jurulatih_sukan_id'] = $id;
        
        $searchModelAcara = new JurulatihSukanAcaraSearch();
        $dataProviderAcara = $searchModelAcara->search($queryPar);
        
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //return $this->redirect(['view', 'id' => $model->jurulatih_sukan_id]);
            return self::actionView($model->jurulatih_sukan_id);
        } else {
            return $this->renderAjax('update', [
                'model' => $model,
                'searchModelAcara' => $searchModelAcara,
                'dataProviderAcara' => $dataProviderAcara,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Deletes an existing JurulatihSukan model.
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
        return self::actionIndex();
    }

    /**
     * Finds the JurulatihSukan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return JurulatihSukan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = JurulatihSukan::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionGetJurulatihSukanAcara($jurulatih_id){
        $model = JurulatihSukan::find()->where(['tbl_jurulatih_sukan.jurulatih_id'=>$jurulatih_id])->joinWith(['refJurulatihAcara' => function($query) {
                        $query->orderBy(['tbl_jurulatih_sukan_acara.created' => SORT_DESC])->one();
                    },
                ])->orderBy(['tbl_jurulatih_sukan.created' => SORT_DESC])->asArray()->one();
        
        echo Json::encode($model);
    }
    
    public function actionSetSukan($sukan_id){
        
        $session = new Session;
        $session->open();

        $session['jurulatih-sukan_sukan_id'] = $sukan_id;
        
        $session->close();
    }
}
