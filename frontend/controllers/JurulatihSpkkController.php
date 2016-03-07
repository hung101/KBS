<?php

namespace frontend\controllers;

use Yii;
use app\models\JurulatihSpkk;
use frontend\models\JurulatihSpkkSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Session;
use yii\web\UploadedFile;

use app\models\general\Upload;
use app\models\general\GeneralVariable;

// table reference
use app\models\RefJenisSijilKelayakanJurulatih;
use app\models\RefTahapKelayakanJurulatih;
use app\models\RefSukan;

/**
 * JurulatihSpkkController implements the CRUD actions for JurulatihSpkk model.
 */
class JurulatihSpkkController extends Controller
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
     * Lists all JurulatihSpkk models.
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
            $queryPar['JurulatihSpkkSearch']['jurulatih_id'] = $session['jurulatih_id'];
        }
        
        $session->close();
        
        $searchModel = new JurulatihSpkkSearch();
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
     * Displays a single JurulatihSpkk model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = $this->findModel($id);
        
        $ref = RefJenisSijilKelayakanJurulatih::findOne(['id' => $model->jenis_spkk]);
        $model->jenis_spkk = $ref['desc'];
        
        $ref = RefTahapKelayakanJurulatih::findOne(['id' => $model->tahap]);
        $model->tahap = $ref['desc'];
        
        $ref = RefSukan::findOne(['id' => $model->sukan]);
        $model->sukan = $ref['desc'];
        
        return $this->renderAjax('view', [
            'model' => $model,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new JurulatihSpkk model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new JurulatihSpkk();
        
        // set Jurulatih Id
        $session = new Session;
        $session->open();

        if(isset($session['jurulatih_id'])){
            $model->jurulatih_id = $session['jurulatih_id'];
        }
        
        $session->close();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $file = UploadedFile::getInstance($model, 'muatnaik_sijil');
            if($file){
                $model->muatnaik_sijil = Upload::uploadFile($file, Upload::jurulatihKelayakan, $model->jurulatih_spkk_id);
            }
            //return $this->redirect(['view', 'id' => $model->jurulatih_spkk_id]);
            
            if($model->save()){
                return self::actionView($model->jurulatih_spkk_id);
            }
        }
            
        return $this->renderAjax('create', [
            'model' => $model,
            'readonly' => false,
        ]);
    }

    /**
     * Updates an existing JurulatihSpkk model.
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
        
        $existingMuatnaikSijil = $model->muatnaik_sijil;
        
        if($model->load(Yii::$app->request->post())){
            $file = UploadedFile::getInstance($model, 'muatnaik_sijil');

            if($file){
                //valid file to upload
                //upload file to server
                $model->muatnaik_sijil = Upload::uploadFile($file, Upload::jurulatihKelayakan, $model->jurulatih_spkk_id);
            } else {
                //invalid file to upload
                //remain existing file
                $model->muatnaik_sijil = $existingMuatnaikSijil;
            }
        }

        if (Yii::$app->request->post() && $model->save()) {
            //return $this->redirect(['view', 'id' => $model->jurulatih_spkk_id]);
            return self::actionView($model->jurulatih_spkk_id);
        } else {
            return $this->renderAjax('update', [
                'model' => $model,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Deletes an existing JurulatihSpkk model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        // delete upload file
        self::actionDeleteupload($id, 'muatnaik_sijil');
        
        $this->findModel($id)->delete();

        //return $this->redirect(['index']);
        return self::actionIndex();
    }

    /**
     * Finds the JurulatihSpkk model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return JurulatihSpkk the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = JurulatihSpkk::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    // Add function for delete image or file
    public function actionDeleteupload($id, $field)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
            $img = $this->findModel($id)->$field;
            
            if($img){
                if (!unlink($img)) {
                    return false;
                }
            }

            $img = $this->findModel($id);
            $img->$field = NULL;
            $img->update();

            return $this->redirect(['update', 'id' => $id]);
    }
}
