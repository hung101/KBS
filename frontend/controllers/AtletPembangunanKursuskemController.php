<?php

namespace frontend\controllers;

use Yii;
use app\models\AtletPembangunanKursuskem;
use app\models\AtletPembangunanKursuskemSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Session;
use yii\web\UploadedFile;
use yii\helpers\Json;
use yii\helpers\BaseUrl;

use app\models\general\Upload;
use app\models\general\GeneralVariable;

// table reference
use app\models\RefJenisKursuskem;

/**
 * AtletPembangunanKursuskemController implements the CRUD actions for AtletPembangunanKursuskem model.
 */
class AtletPembangunanKursuskemController extends Controller
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
     * Lists all AtletPembangunanKursuskem models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $request = Yii::$app->request;
        
        $queryPar = Yii::$app->request->queryParams;
        
        // Filter by atlet id
        $session = new Session;
        $session->open();

        if(isset($session['atlet_id'])){
            $queryPar['AtletPembangunanKursuskemSearch']['atlet_id'] = $session['atlet_id'];
        }
        
        $session->close();
        
        $searchModel = new AtletPembangunanKursuskemSearch();
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
     * Lists all AtletPendidikan models.
     * @return mixed
     */
    public function actionTab()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        /*$searchModel = new AtletPembangunanKursuskemSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('tab', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);*/
        
        $model = new AtletPembangunanKursuskem();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->pendidikan_atlet_id]);
        } else {
            return $this->render('tab', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays a single AtletPembangunanKursuskem model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = $this->findModel($id);
        
        $ref = RefJenisKursuskem::findOne(['id' => $model->jenis]);
        $model->jenis = $ref['desc'];
        
        return $this->renderAjax('view', [
            'model' => $model,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new AtletPembangunanKursuskem model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new AtletPembangunanKursuskem();
        
        // set Atlet Id
        $session = new Session;
        $session->open();

        if(isset($session['atlet_id'])){
            $model->atlet_id = $session['atlet_id'];
        }
        
        $session->close();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $file = UploadedFile::getInstance($model, 'muat_naik_sijil');
            if($file){
                $model->muat_naik_sijil = Upload::uploadFile($file, Upload::atletKursusKemFolder, $model->kursus_kem_id);
            }
            
            //return $this->redirect(['view', 'id' => $model->kursus_kem_id]);
            if( $model->save()){
                return self::actionView($model->kursus_kem_id);
            }
        } 
        
        return $this->renderAjax('create', [
                'model' => $model,
                'readonly' => false,
            ]);
    }

    /**
     * Updates an existing AtletPembangunanKursuskem model.
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
            $file = UploadedFile::getInstance($model, 'muat_naik_sijil');
            if($file){
                $model->muat_naik_sijil = Upload::uploadFile($file, Upload::atletKursusKemFolder, $model->kursus_kem_id);
            }
            
            //return $this->redirect(['view', 'id' => $model->kursus_kem_id]);
            if( $model->save()){
                return self::actionView($model->kursus_kem_id);
            }
        } 
        
        return $this->renderAjax('update', [
                'model' => $model,
                'readonly' => false,
            ]);
    }

    /**
     * Deletes an existing AtletPembangunanKursuskem model.
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
     * Finds the AtletPembangunanKursuskem model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AtletPembangunanKursuskem the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AtletPembangunanKursuskem::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
