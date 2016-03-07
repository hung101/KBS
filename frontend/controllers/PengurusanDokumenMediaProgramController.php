<?php

namespace frontend\controllers;

use Yii;
use app\models\PengurusanDokumenMediaProgram;
use frontend\models\PengurusanDokumenMediaProgramSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

use app\models\general\Upload;
use app\models\general\GeneralVariable;

// table reference
use app\models\RefKategoriDokumen;

/**
 * PengurusanDokumenMediaProgramController implements the CRUD actions for PengurusanDokumenMediaProgram model.
 */
class PengurusanDokumenMediaProgramController extends Controller
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
     * Lists all PengurusanDokumenMediaProgram models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $searchModel = new PengurusanDokumenMediaProgramSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PengurusanDokumenMediaProgram model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = $this->findModel($id);
        
        $ref = RefKategoriDokumen::findOne(['id' => $model->kategori_dokumen]);
        $model->kategori_dokumen = $ref['desc'];
        
        return $this->renderAjax('view', [
            'model' => $model,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new PengurusanDokumenMediaProgram model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($pengurusan_media_program_id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new PengurusanDokumenMediaProgram();
        
        Yii::$app->session->open();
        
        if($pengurusan_media_program_id != ''){
            $model->pengurusan_media_program_id = $pengurusan_media_program_id;
        } else {
            if(isset(Yii::$app->session->id)){
                $model->session_id = Yii::$app->session->id;
            }
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $file = UploadedFile::getInstance($model, 'muatnaik');
            $filename = $model->pengurusan_dokumen_media_program_id;
            if($file){
                $model->muatnaik = Upload::uploadFile($file, Upload::pengurusanMediaProgramFolder, $filename, Upload::pengurusanMediaProgramDokumenSubFolder);
            }
            //return $this->redirect(['view', 'id' => $model->pengurusan_dokumen_media_program_id]);
            return $model->save();
        } else {
            return $this->renderAjax('create', [
                'model' => $model,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Updates an existing PengurusanDokumenMediaProgram model.
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
        $existingMuatNaikGambar = $model->muatnaik;
        
        if($model->load(Yii::$app->request->post())){
            $file = UploadedFile::getInstance($model, 'muatnaik');

            if($file){
                //valid file to upload
                //upload file to server
                $filename = $model->pengurusan_dokumen_media_program_id;
                $model->muatnaik = Upload::uploadFile($file, Upload::pengurusanMediaProgramFolder, $filename, Upload::pengurusanMediaProgramDokumenSubFolder);
            } else {
                //invalid file to upload
                //remain existing file
                $model->muatnaik = $existingMuatNaikGambar;
            }
        }

        if (Yii::$app->request->post()) {
            return $model->save();
            //return $this->redirect(['view', 'id' => $model->pengurusan_dokumen_media_program_id]);
        } else {
            return $this->renderAjax('update', [
                'model' => $model,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Deletes an existing PengurusanDokumenMediaProgram model.
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
        self::actionDeleteupload($id, 'muatnaik');
        
        $this->findModel($id)->delete();

        //return $this->redirect(['index']);
    }

    /**
     * Finds the PengurusanDokumenMediaProgram model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PengurusanDokumenMediaProgram the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PengurusanDokumenMediaProgram::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    // Add function for delete image or file
    public function actionDeleteupload($id, $field)
    {
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
