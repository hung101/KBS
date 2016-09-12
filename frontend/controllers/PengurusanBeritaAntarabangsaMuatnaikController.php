<?php

namespace frontend\controllers;

use Yii;
use app\models\PengurusanBeritaAntarabangsaMuatnaik;
use frontend\models\PengurusanBeritaAntarabangsaMuatnaikSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

// contant values
use app\models\general\GeneralVariable;
use app\models\general\Upload;

/**
 * PengurusanBeritaAntarabangsaMuatnaikController implements the CRUD actions for PengurusanBeritaAntarabangsaMuatnaik model.
 */
class PengurusanBeritaAntarabangsaMuatnaikController extends Controller
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
     * Lists all PengurusanBeritaAntarabangsaMuatnaik models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $searchModel = new PengurusanBeritaAntarabangsaMuatnaikSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PengurusanBeritaAntarabangsaMuatnaik model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        return $this->renderAjax('view', [
            'model' => $this->findModel($id),
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new PengurusanBeritaAntarabangsaMuatnaik model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($pengurusan_berita_antarabangsa_id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new PengurusanBeritaAntarabangsaMuatnaik();
        
        Yii::$app->session->open();
        
        if($pengurusan_berita_antarabangsa_id != ''){
            $model->pengurusan_berita_antarabangsa_id = $pengurusan_berita_antarabangsa_id;
        } else {
            if(isset(Yii::$app->session->id)){
                $model->session_id = Yii::$app->session->id;
            }
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $file = UploadedFile::getInstance($model, 'muatnaik');
            if($file){
                $model->muatnaik = Upload::uploadFile($file, Upload::pengurusanBeritaAntarabangsaMuatnaikFolder, $model->pengurusan_berita_antarabangsa_muatnaik_id);
            }
            if($model->save()){
                return '1';
            }
        } 
        
        return $this->renderAjax('create', [
                'model' => $model,
                'readonly' => false,
            ]);
    }

    /**
     * Updates an existing PengurusanBeritaAntarabangsaMuatnaik model.
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
        
        $existingMuatnaik = $model->muatnaik;
        
        if($model->load(Yii::$app->request->post())){
            $file = UploadedFile::getInstance($model, 'muatnaik');

            if($file){
                //valid file to upload
                //upload file to server
                $model->muatnaik = Upload::uploadFile($file, Upload::pengurusanBeritaAntarabangsaMuatnaikFolder, $model->pengurusan_berita_antarabangsa_muatnaik_id);
            } else {
                //invalid file to upload
                //remain existing file
                $model->muatnaik = $existingMuatnaik;
            }
        }

        if (Yii::$app->request->post() && $model->save()) {
            return '1';
        } else {
            return $this->renderAjax('update', [
                'model' => $model,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Deletes an existing PengurusanBeritaAntarabangsaMuatnaik model.
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
     * Finds the PengurusanBeritaAntarabangsaMuatnaik model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PengurusanBeritaAntarabangsaMuatnaik the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PengurusanBeritaAntarabangsaMuatnaik::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
