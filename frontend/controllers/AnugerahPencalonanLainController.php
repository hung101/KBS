<?php

namespace frontend\controllers;

use Yii;
use app\models\AnugerahPencalonanLain;
use frontend\models\AnugerahPencalonanLainSearch;
use app\models\AnugerahPencalonanLainJawatan;
use frontend\models\AnugerahPencalonanLainJawatanSearch;
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
 * AnugerahPencalonanLainController implements the CRUD actions for AnugerahPencalonanLain model.
 */
class AnugerahPencalonanLainController extends Controller
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
     * Lists all AnugerahPencalonanLain models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AnugerahPencalonanLainSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AnugerahPencalonanLain model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $queryPar = null;
        
        $queryPar['AnugerahPencalonanLainJawatanSearch']['anugerah_pencalonan_lain_id'] = $id;
        
        $searchModelAnugerahPencalonanLainJawatan  = new AnugerahPencalonanLainJawatanSearch();
        $dataProviderAnugerahPencalonanLainJawatan = $searchModelAnugerahPencalonanLainJawatan->search($queryPar);
        
        $model = $this->findModel($id);
        
        $ref = RefKategoriPencalonanLain::findOne(['id' => $model->kategori]);
        $model->kategori = $ref['desc'];
        
        return $this->render('view', [
            'model' => $model,
            'searchModelAnugerahPencalonanLainJawatan' => $searchModelAnugerahPencalonanLainJawatan,
            'dataProviderAnugerahPencalonanLainJawatan' => $dataProviderAnugerahPencalonanLainJawatan,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new AnugerahPencalonanLain model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AnugerahPencalonanLain();
        
        $queryPar = null;
        
        Yii::$app->session->open();
        
        if(isset(Yii::$app->session->id)){
            $queryPar['AnugerahPencalonanLainJawatanSearch']['session_id'] = Yii::$app->session->id;
        }
        
       $searchModelAnugerahPencalonanLainJawatan  = new AnugerahPencalonanLainJawatanSearch();
        $dataProviderAnugerahPencalonanLainJawatan = $searchModelAnugerahPencalonanLainJawatan->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if(isset(Yii::$app->session->id)){
                AnugerahPencalonanLainJawatan::updateAll(['anugerah_pencalonan_lain_id' => $model->anugerah_pencalonan_lain_id], 'session_id = "'.Yii::$app->session->id.'"');
                AnugerahPencalonanLainJawatan::updateAll(['session_id' => ''], 'anugerah_pencalonan_lain_id = "'.$model->anugerah_pencalonan_lain_id.'"');
            }
            
            $file = UploadedFile::getInstance($model, 'gambar');
            if($file){
                $model->gambar = Upload::uploadFile($file, Upload::anugerahPencalonanLainFolder, $model->anugerah_pencalonan_lain_id);
            }
            
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->anugerah_pencalonan_lain_id]);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
                'searchModelAnugerahPencalonanLainJawatan' => $searchModelAnugerahPencalonanLainJawatan,
                'dataProviderAnugerahPencalonanLainJawatan' => $dataProviderAnugerahPencalonanLainJawatan,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Updates an existing AnugerahPencalonanLain model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        
        $queryPar = null;
        
        $queryPar['AnugerahPencalonanLainJawatanSearch']['anugerah_pencalonan_lain_id'] = $id;
        
        $searchModelAnugerahPencalonanLainJawatan  = new AnugerahPencalonanLainJawatanSearch();
        $dataProviderAnugerahPencalonanLainJawatan = $searchModelAnugerahPencalonanLainJawatan->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $file = UploadedFile::getInstance($model, 'gambar');
            if($file){
                $model->gambar = Upload::uploadFile($file, Upload::anugerahPencalonanLainFolder, $model->anugerah_pencalonan_lain_id);
            }
            
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->anugerah_pencalonan_lain_id]);
            }
        } else {
            return $this->render('update', [
                'model' => $model,
                'searchModelAnugerahPencalonanLainJawatan' => $searchModelAnugerahPencalonanLainJawatan,
                'dataProviderAnugerahPencalonanLainJawatan' => $dataProviderAnugerahPencalonanLainJawatan,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Deletes an existing AnugerahPencalonanLain model.
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
     * Finds the AnugerahPencalonanLain model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AnugerahPencalonanLain the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AnugerahPencalonanLain::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
