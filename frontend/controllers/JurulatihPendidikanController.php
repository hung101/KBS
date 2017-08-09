<?php

namespace frontend\controllers;

use Yii;
use app\models\JurulatihPendidikan;
use frontend\models\JurulatihPendidikanSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\web\Session;
use yii\helpers\Json;
use yii\helpers\BaseUrl;

use app\models\general\GeneralVariable;
use app\models\general\Upload;
use common\models\general\GeneralFunction;

// table reference
use app\models\RefTahapPendidikan;

/**
 * JurulatihPendidikanController implements the CRUD actions for JurulatihPendidikan model.
 */
class JurulatihPendidikanController extends Controller
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
     * Lists all JurulatihPendidikan models.
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
            $queryPar['JurulatihPendidikanSearch']['jurulatih_id'] = $session['jurulatih_id'];
        }
        
        $session->close();
        
        $searchModel = new JurulatihPendidikanSearch();
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
     * Displays a single JurulatihPendidikan model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = $this->findModel($id);
        
        $ref = RefTahapPendidikan::findOne(['id' => $model->tahap_pendidikan]);
        $model->tahap_pendidikan = $ref['desc'];
        
        return $this->renderAjax('view', [
            'model' => $model,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new JurulatihPendidikan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new JurulatihPendidikan();
        
        // set Jurulatih Id
        $session = new Session;
        $session->open();

        if(isset($session['jurulatih_id'])){
            $model->jurulatih_id = $session['jurulatih_id'];
        }
        
        $session->close();
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $file = UploadedFile::getInstance($model, 'salinan_sijil');
            if($file){
                $filename = $model->jurulatih_id . "-salinan_sijil";
                $model->salinan_sijil = Upload::uploadFile($file, Upload::jurulatihFolder, $filename);
            }
            
            if($model->save()){
                return self::actionView($model->jurulatih_pendidikan_id);
            }
        }
            
        return $this->renderAjax('create', [
            'model' => $model,
            'readonly' => false,
        ]);
        
    }

    /**
     * Updates an existing JurulatihPendidikan model.
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
        
        $existingSijil = $model->salinan_sijil;
        if ($model->load(Yii::$app->request->post())) {
            
            $file = UploadedFile::getInstance($model, 'salinan_sijil');
            if($file){
                /*if($model->salinan_sijil != null || $model->salinan_sijil != '')//cleanup
                {
                    unlink($model->salinan_sijil);
                }
                $filename = $model->jurulatih_id . "-salinan_sijil";
                $model->salinan_sijil = Upload::uploadFile($file, Upload::jurulatihFolder, $filename);*/
            } else { $model->salinan_sijil = $existingSijil; }
        }
        
        if (Yii::$app->request->post() && $model->save()) {
            $file = UploadedFile::getInstance($model, 'salinan_sijil');
            if($file){
                $filename = $model->jurulatih_id . "-salinan_sijil";
                $model->salinan_sijil = Upload::uploadFile($file, Upload::jurulatihFolder, $filename);
            }
            
            if($model->save()){
                return self::actionView($model->jurulatih_pendidikan_id);
            }
        } 
        
        return $this->renderAjax('update', [
                'model' => $model,
                'readonly' => false,
            ]);   
    }

    /**
     * Deletes an existing JurulatihPendidikan model.
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
     * Finds the JurulatihPendidikan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return JurulatihPendidikan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = JurulatihPendidikan::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
