<?php

namespace frontend\controllers;

use Yii;
use app\models\Jurulatih;
// use frontend\models\JurulatihBorangKontrakSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;


use app\models\general\Upload;
use app\models\general\GeneralVariable;
use app\models\general\GeneralLabel;
use common\models\general\GeneralFunction;

/**
 * JurulatihBorangKontrakController implements the upload actions for JurulatihBorangKontrak model.
 */
class JurulatihBorangKontrakController extends Controller
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
     * Lists all JurulatihBorangKontrak models.
     * @return mixed
     */
    // public function actionIndex()
    // {
        // $searchModel = new JurulatihBorangKontrakSearch();
        // $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        // return $this->render('index', [
            // 'searchModel' => $searchModel,
            // 'dataProvider' => $dataProvider,
        // ]);
    // }

    /**
     * Displays a single JurulatihBorangKontrak model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        // return $this->render('view', [
            // 'model' => $this->findModel($id),
        // ]);
    }

    /**
     * Creates a new JurulatihBorangKontrak model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id)
    {
        $model = $this->findModel($id);

        if(Yii::$app->request->post())
        {
            $haveFile = false;
            $file = UploadedFile::getInstance($model, 'borang_maklumat');
            if(isset($file) && $file != null){
                if($model->borang_maklumat != '' || $model->borang_maklumat != null){
                    unlink($model->borang_maklumat);
                }
                
                $filename = $model->jurulatih_id . "-borang_maklumat";
                $model->borang_maklumat = Upload::uploadFile($file, Upload::jurulatihFolder, $filename);
                $haveFile = true;
            }
            
            $file = UploadedFile::getInstance($model, 'borang_kesihatan');
            if(isset($file) && $file != null){
                if($model->borang_kesihatan != '' || $model->borang_kesihatan != null){
                    unlink($model->borang_kesihatan);
                }
                
                $filename = $model->jurulatih_id . "-borang_kesihatan";
                $model->borang_kesihatan = Upload::uploadFile($file, Upload::jurulatihFolder, $filename);
                $haveFile = true;
            }
            
            $file = UploadedFile::getInstance($model, 'borang_hrmis');
            if(isset($file) && $file != null){
                if($model->borang_hrmis != '' || $model->borang_hrmis != null){
                    unlink($model->borang_hrmis);
                }
                
                $filename = $model->jurulatih_id . "-borang_hrmis";
                $model->borang_hrmis = Upload::uploadFile($file, Upload::jurulatihFolder, $filename);
                $haveFile = true;
            }
            
            $file = UploadedFile::getInstance($model, 'borang_rawatan');
            if(isset($file) && $file != null){
                if($model->borang_rawatan != '' || $model->borang_rawatan != null){
                    unlink($model->borang_rawatan);
                }
                
                $filename = $model->jurulatih_id . "-borang_rawatan";
                $model->borang_rawatan = Upload::uploadFile($file, Upload::jurulatihFolder, $filename);
                $haveFile = true;
            }
            
            $file = UploadedFile::getInstance($model, 'borang_keselamatan');
            if(isset($file) && $file != null){
                if($model->borang_keselamatan != '' || $model->borang_keselamatan != null){
                    unlink($model->borang_keselamatan);
                }
                
                $filename = $model->jurulatih_id . "-borang_keselamatan";
                $model->borang_keselamatan = Upload::uploadFile($file, Upload::jurulatihFolder, $filename);
                $haveFile = true;
            }
            
            $file = UploadedFile::getInstance($model, 'borang_pelekat');
            if(isset($file) && $file != null){
                if($model->borang_pelekat != '' || $model->borang_pelekat != null){
                    unlink($model->borang_pelekat);
                }
                
                $filename = $model->jurulatih_id . "-borang_pelekat";
                $model->borang_pelekat = Upload::uploadFile($file, Upload::jurulatihFolder, $filename);
                $haveFile = true;
            }
            
            $file = UploadedFile::getInstance($model, 'borang_income_tax');
            if(isset($file) && $file != null){
                if($model->borang_income_tax != '' || $model->borang_income_tax != null){
                    unlink($model->borang_income_tax);
                }
                
                $filename = $model->jurulatih_id . "-borang_income_tax";
                $model->borang_income_tax = Upload::uploadFile($file, Upload::jurulatihFolder, $filename);
                $haveFile = true;
            }
            
            if($haveFile){
                if($model->save()) return '1';
            }
        }

        return $this->renderAjax('create', [
                    'model' => $model,
        ]);
    }

    /**
     * Updates an existing JurulatihBorangKontrak model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    // public function actionUpdate($id)
    // {
        // $model = $this->findModel($id);

        // if ($model->load(Yii::$app->request->post()) && $model->save()) {
            // return $this->redirect(['view', 'id' => $model->id]);
        // } else {
            // return $this->render('update', [
                // 'model' => $model,
            // ]);
        // }
    // }

    /**
     * Deletes an existing JurulatihBorangKontrak model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    // public function actionDelete($id)
    // {
        // $this->findModel($id)->delete();

        // return $this->redirect(['index']);
    // }

    /**
     * Finds the JurulatihBorangKontrak model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return JurulatihBorangKontrak the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Jurulatih::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
