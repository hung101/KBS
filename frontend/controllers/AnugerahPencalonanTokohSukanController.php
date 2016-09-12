<?php

namespace frontend\controllers;

use Yii;
use app\models\AnugerahPencalonanTokohSukan;
use frontend\models\AnugerahPencalonanTokohSukanSearch;
use app\models\AnugerahPencalonanTokohSukanJawatan;
use frontend\models\AnugerahPencalonanTokohSukanJawatanSearch;
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
 * AnugerahPencalonanTokohSukanController implements the CRUD actions for AnugerahPencalonanTokohSukan model.
 */
class AnugerahPencalonanTokohSukanController extends Controller
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
     * Lists all AnugerahPencalonanTokohSukan models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AnugerahPencalonanTokohSukanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AnugerahPencalonanTokohSukan model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $queryPar = null;
        
        $queryPar['AnugerahPencalonanTokohSukanJawatanSearch']['anugerah_pencalonan_lain_id'] = $id;
        
        $searchModelAnugerahPencalonanTokohSukanJawatan  = new AnugerahPencalonanTokohSukanJawatanSearch();
        $dataProviderAnugerahPencalonanTokohSukanJawatan = $searchModelAnugerahPencalonanTokohSukanJawatan->search($queryPar);
        
        $model = $this->findModel($id);
        
        $ref = RefKategoriPencalonanLain::findOne(['id' => $model->kategori]);
        $model->kategori = $ref['desc'];
        
        return $this->render('view', [
            'model' => $model,
            'searchModelAnugerahPencalonanTokohSukanJawatan' => $searchModelAnugerahPencalonanTokohSukanJawatan,
            'dataProviderAnugerahPencalonanTokohSukanJawatan' => $dataProviderAnugerahPencalonanTokohSukanJawatan,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new AnugerahPencalonanTokohSukan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AnugerahPencalonanTokohSukan();
        
        $queryPar = null;
        
        Yii::$app->session->open();
        
        if(isset(Yii::$app->session->id)){
            $queryPar['AnugerahPencalonanTokohSukanJawatanSearch']['session_id'] = Yii::$app->session->id;
        }
        
       $searchModelAnugerahPencalonanTokohSukanJawatan  = new AnugerahPencalonanTokohSukanJawatanSearch();
        $dataProviderAnugerahPencalonanTokohSukanJawatan = $searchModelAnugerahPencalonanTokohSukanJawatan->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if(isset(Yii::$app->session->id)){
                AnugerahPencalonanTokohSukanJawatan::updateAll(['anugerah_pencalonan_lain_id' => $model->anugerah_pencalonan_lain_id], 'session_id = "'.Yii::$app->session->id.'"');
                AnugerahPencalonanTokohSukanJawatan::updateAll(['session_id' => ''], 'anugerah_pencalonan_lain_id = "'.$model->anugerah_pencalonan_lain_id.'"');
            }
            
            $file = UploadedFile::getInstance($model, 'gambar');
            if($file){
                $model->gambar = Upload::uploadFile($file, Upload::anugerahPencalonanTokohSukanFolder, $model->anugerah_pencalonan_lain_id);
            }
            
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->anugerah_pencalonan_lain_id]);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
                'searchModelAnugerahPencalonanTokohSukanJawatan' => $searchModelAnugerahPencalonanTokohSukanJawatan,
                'dataProviderAnugerahPencalonanTokohSukanJawatan' => $dataProviderAnugerahPencalonanTokohSukanJawatan,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Updates an existing AnugerahPencalonanTokohSukan model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        
        $queryPar = null;
        
        $queryPar['AnugerahPencalonanTokohSukanJawatanSearch']['anugerah_pencalonan_lain_id'] = $id;
        
        $searchModelAnugerahPencalonanTokohSukanJawatan  = new AnugerahPencalonanTokohSukanJawatanSearch();
        $dataProviderAnugerahPencalonanTokohSukanJawatan = $searchModelAnugerahPencalonanTokohSukanJawatan->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $file = UploadedFile::getInstance($model, 'gambar');
            if($file){
                $model->gambar = Upload::uploadFile($file, Upload::anugerahPencalonanTokohSukanFolder, $model->anugerah_pencalonan_lain_id);
            }
            
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->anugerah_pencalonan_lain_id]);
            }
        } else {
            return $this->render('update', [
                'model' => $model,
                'searchModelAnugerahPencalonanTokohSukanJawatan' => $searchModelAnugerahPencalonanTokohSukanJawatan,
                'dataProviderAnugerahPencalonanTokohSukanJawatan' => $dataProviderAnugerahPencalonanTokohSukanJawatan,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Deletes an existing AnugerahPencalonanTokohSukan model.
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
     * Finds the AnugerahPencalonanTokohSukan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AnugerahPencalonanTokohSukan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AnugerahPencalonanTokohSukan::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
