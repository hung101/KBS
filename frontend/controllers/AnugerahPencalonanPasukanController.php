<?php

namespace frontend\controllers;

use Yii;
use app\models\AnugerahPencalonanPasukan;
use frontend\models\AnugerahPencalonanPasukanSearch;
use app\models\AnugerahPencalonanPasukanPemain;
use frontend\models\AnugerahPencalonanPasukanPemainSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\helpers\Json;
use yii\helpers\BaseUrl;

use app\models\general\Upload;
use app\models\general\GeneralVariable;
use app\models\general\GeneralLabel;

use app\models\RefSukan;
use app\models\RefAcara;
use app\models\RefStatusPencalonan;
use app\models\Atlet;
use app\models\RefKategoriPencalonanPasukan;

/**
 * AnugerahPencalonanPasukanController implements the CRUD actions for AnugerahPencalonanPasukan model.
 */
class AnugerahPencalonanPasukanController extends Controller
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
     * Lists all AnugerahPencalonanPasukan models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AnugerahPencalonanPasukanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AnugerahPencalonanPasukan model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $queryPar = null;
        
        $queryPar['AnugerahPencalonanPasukanPemainSearch']['anugerah_pencalonan_pasukan_id'] = $id;
        
        $searchModelAnugerahPencalonanPasukanPemain  = new AnugerahPencalonanPasukanPemainSearch();
        $dataProviderAnugerahPencalonanPasukanPemain = $searchModelAnugerahPencalonanPasukanPemain->search($queryPar);
        
        $model = $this->findModel($id);
        
        $ref = RefKategoriPencalonanPasukan::findOne(['id' => $model->kategori]);
        $model->kategori = $ref['desc'];
        
        $ref = RefSukan::findOne(['id' => $model->sukan]);
        $model->sukan = $ref['desc'];
        
        return $this->render('view', [
            'model' => $model,
            'searchModelAnugerahPencalonanPasukanPemain' => $searchModelAnugerahPencalonanPasukanPemain,
            'dataProviderAnugerahPencalonanPasukanPemain' => $dataProviderAnugerahPencalonanPasukanPemain,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new AnugerahPencalonanPasukan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AnugerahPencalonanPasukan();
        
        $queryPar = null;
        
        Yii::$app->session->open();
        
        if(isset(Yii::$app->session->id)){
            $queryPar['AnugerahPencalonanPasukanPemainSearch']['session_id'] = Yii::$app->session->id;
        }
        
        $searchModelAnugerahPencalonanPasukanPemain  = new AnugerahPencalonanPasukanPemainSearch();
        $dataProviderAnugerahPencalonanPasukanPemain = $searchModelAnugerahPencalonanPasukanPemain->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if(isset(Yii::$app->session->id)){
                AnugerahPencalonanPasukanPemain::updateAll(['anugerah_pencalonan_pasukan_id' => $model->anugerah_pencalonan_pasukan_id], 'session_id = "'.Yii::$app->session->id.'"');
                AnugerahPencalonanPasukanPemain::updateAll(['session_id' => ''], 'anugerah_pencalonan_pasukan_id = "'.$model->anugerah_pencalonan_pasukan_id.'"');
            }
            
            $file = UploadedFile::getInstance($model, 'gambar_pasukan');
            if($file){
                $model->gambar_pasukan = Upload::uploadFile($file, Upload::anugerahPencalonanPasukanFolder, $model->anugerah_pencalonan_pasukan_id);
            }
            
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->anugerah_pencalonan_pasukan_id]);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
                'searchModelAnugerahPencalonanPasukanPemain' => $searchModelAnugerahPencalonanPasukanPemain,
                'dataProviderAnugerahPencalonanPasukanPemain' => $dataProviderAnugerahPencalonanPasukanPemain,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Updates an existing AnugerahPencalonanPasukan model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        
        $queryPar = null;
        
        $queryPar['AnugerahPencalonanPasukanPemainSearch']['anugerah_pencalonan_pasukan_id'] = $id;
        
        $searchModelAnugerahPencalonanPasukanPemain  = new AnugerahPencalonanPasukanPemainSearch();
        $dataProviderAnugerahPencalonanPasukanPemain = $searchModelAnugerahPencalonanPasukanPemain->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $file = UploadedFile::getInstance($model, 'gambar_pasukan');
            if($file){
                $model->gambar_pasukan = Upload::uploadFile($file, Upload::anugerahPencalonanPasukanFolder, $model->anugerah_pencalonan_pasukan_id);
            }
            
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->anugerah_pencalonan_pasukan_id]);
            }
        } else {
            return $this->render('update', [
                'model' => $model,
                'searchModelAnugerahPencalonanPasukanPemain' => $searchModelAnugerahPencalonanPasukanPemain,
                'dataProviderAnugerahPencalonanPasukanPemain' => $dataProviderAnugerahPencalonanPasukanPemain,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Deletes an existing AnugerahPencalonanPasukan model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        // delete upload file
        self::actionDeleteupload($id, 'gambar_pasukan');
        
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the AnugerahPencalonanPasukan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AnugerahPencalonanPasukan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AnugerahPencalonanPasukan::findOne($id)) !== null) {
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
