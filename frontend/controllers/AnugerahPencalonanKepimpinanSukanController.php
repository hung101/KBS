<?php

namespace frontend\controllers;

use Yii;
use app\models\AnugerahPencalonanKepimpinanSukan;
use frontend\models\AnugerahPencalonanKepimpinanSukanSearch;
use app\models\AnugerahPencalonanKepimpinanSukanJawatan;
use frontend\models\AnugerahPencalonanKepimpinanSukanJawatanSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

use app\models\general\Upload;
use app\models\general\GeneralVariable;
use app\models\general\GeneralLabel;

// table reference
use app\models\RefKategoriPencalonanLain;

/**
 * AnugerahPencalonanKepimpinanSukanController implements the CRUD actions for AnugerahPencalonanKepimpinanSukan model.
 */
class AnugerahPencalonanKepimpinanSukanController extends Controller
{
    /** chmod(
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
     * Lists all AnugerahPencalonanKepimpinanSukan models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AnugerahPencalonanKepimpinanSukanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AnugerahPencalonanKepimpinanSukan model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $queryPar = null;
        
        $queryPar['AnugerahPencalonanKepimpinanSukanJawatanSearch']['anugerah_pencalonan_lain_id'] = $id;
        
        $searchModelAnugerahPencalonanKepimpinanSukanJawatan  = new AnugerahPencalonanKepimpinanSukanJawatanSearch();
        $dataProviderAnugerahPencalonanKepimpinanSukanJawatan = $searchModelAnugerahPencalonanKepimpinanSukanJawatan->search($queryPar);
        
        $model = $this->findModel($id);
        
        $ref = RefKategoriPencalonanLain::findOne(['id' => $model->kategori]);
        $model->kategori = $ref['desc'];
        
        return $this->render('view', [
            'model' => $model,
            'searchModelAnugerahPencalonanKepimpinanSukanJawatan' => $searchModelAnugerahPencalonanKepimpinanSukanJawatan,
            'dataProviderAnugerahPencalonanKepimpinanSukanJawatan' => $dataProviderAnugerahPencalonanKepimpinanSukanJawatan,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new AnugerahPencalonanKepimpinanSukan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AnugerahPencalonanKepimpinanSukan();
        
        $queryPar = null;
        
        Yii::$app->session->open();
        
        if(isset(Yii::$app->session->id)){
            $queryPar['AnugerahPencalonanKepimpinanSukanJawatanSearch']['session_id'] = Yii::$app->session->id;
        }
        
       $searchModelAnugerahPencalonanKepimpinanSukanJawatan  = new AnugerahPencalonanKepimpinanSukanJawatanSearch();
        $dataProviderAnugerahPencalonanKepimpinanSukanJawatan = $searchModelAnugerahPencalonanKepimpinanSukanJawatan->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if(isset(Yii::$app->session->id)){
                AnugerahPencalonanKepimpinanSukanJawatan::updateAll(['anugerah_pencalonan_lain_id' => $model->anugerah_pencalonan_lain_id], 'session_id = "'.Yii::$app->session->id.'"');
                AnugerahPencalonanKepimpinanSukanJawatan::updateAll(['session_id' => ''], 'anugerah_pencalonan_lain_id = "'.$model->anugerah_pencalonan_lain_id.'"');
            }
            
            $file = UploadedFile::getInstance($model, 'gambar');
            if($file){
                $model->gambar = Upload::uploadFile($file, Upload::anugerahPencalonanKepimpinanSukanFolder, $model->anugerah_pencalonan_lain_id);
            }
            
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->anugerah_pencalonan_lain_id]);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
                'searchModelAnugerahPencalonanKepimpinanSukanJawatan' => $searchModelAnugerahPencalonanKepimpinanSukanJawatan,
                'dataProviderAnugerahPencalonanKepimpinanSukanJawatan' => $dataProviderAnugerahPencalonanKepimpinanSukanJawatan,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Updates an existing AnugerahPencalonanKepimpinanSukan model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        
        $queryPar = null;
        
        $queryPar['AnugerahPencalonanKepimpinanSukanJawatanSearch']['anugerah_pencalonan_lain_id'] = $id;
        
        $searchModelAnugerahPencalonanKepimpinanSukanJawatan  = new AnugerahPencalonanKepimpinanSukanJawatanSearch();
        $dataProviderAnugerahPencalonanKepimpinanSukanJawatan = $searchModelAnugerahPencalonanKepimpinanSukanJawatan->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $file = UploadedFile::getInstance($model, 'gambar');
            if($file){
                $model->gambar = Upload::uploadFile($file, Upload::anugerahPencalonanKepimpinanSukanFolder, $model->anugerah_pencalonan_lain_id);
            }
            
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->anugerah_pencalonan_lain_id]);
            }
        } else {
            return $this->render('update', [
                'model' => $model,
                'searchModelAnugerahPencalonanKepimpinanSukanJawatan' => $searchModelAnugerahPencalonanKepimpinanSukanJawatan,
                'dataProviderAnugerahPencalonanKepimpinanSukanJawatan' => $dataProviderAnugerahPencalonanKepimpinanSukanJawatan,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Deletes an existing AnugerahPencalonanKepimpinanSukan model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        // delete upload file
        self::actionDeleteupload($id, 'gambar');
        
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
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

    /**
     * Finds the AnugerahPencalonanKepimpinanSukan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AnugerahPencalonanKepimpinanSukan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AnugerahPencalonanKepimpinanSukan::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
