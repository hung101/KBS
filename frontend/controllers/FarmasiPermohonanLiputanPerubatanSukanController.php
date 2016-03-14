<?php

namespace frontend\controllers;

use Yii;
use app\models\FarmasiPermohonanLiputanPerubatanSukan;
use frontend\models\FarmasiPermohonanLiputanPerubatanSukanSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

// table reference
use app\models\RefKategoriProgramLiputanPerubatanSukan;

use app\models\general\Upload;
use app\models\general\GeneralVariable;
use app\models\general\GeneralLabel;

/**
 * FarmasiPermohonanLiputanPerubatanSukanController implements the CRUD actions for FarmasiPermohonanLiputanPerubatanSukan model.
 */
class FarmasiPermohonanLiputanPerubatanSukanController extends Controller
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
     * Lists all FarmasiPermohonanLiputanPerubatanSukan models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $searchModel = new FarmasiPermohonanLiputanPerubatanSukanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single FarmasiPermohonanLiputanPerubatanSukan model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = $this->findModel($id);
        
        $model->kelulusan_ceo = GeneralLabel::getYesNoLabel($model->kelulusan_ceo);
        
        $model->kelulusan_pbu = GeneralLabel::getYesNoLabel($model->kelulusan_pbu);
        
        $ref = RefKategoriProgramLiputanPerubatanSukan::findOne(['id' => $model->kategori_program]);
        $model->kategori_program = $ref['desc'];
        
        return $this->render('view', [
            'model' => $model,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new FarmasiPermohonanLiputanPerubatanSukan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new FarmasiPermohonanLiputanPerubatanSukan();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $upload = new Upload();
            $file = UploadedFile::getInstance($model, 'muat_naik');
            if($file){
                $model->muat_naik = $upload->uploadFile($file, Upload::farmasiPermohonanLiputanPerubatanSukanFolder, $model->permohonan_liputan_perubatan_sukan_id, "");
            }
            
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->permohonan_liputan_perubatan_sukan_id]);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Updates an existing FarmasiPermohonanLiputanPerubatanSukan model.
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
            $upload = new Upload();
            $file = UploadedFile::getInstance($model, 'muat_naik');
            if($file){
                $model->muat_naik = $upload->uploadFile($file, Upload::farmasiPermohonanLiputanPerubatanSukanFolder, $model->permohonan_liputan_perubatan_sukan_id, "");
            }
            
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->permohonan_liputan_perubatan_sukan_id]);
            }
        } else {
            return $this->render('update', [
                'model' => $model,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Deletes an existing FarmasiPermohonanLiputanPerubatanSukan model.
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
        self::actionDeleteupload($id, 'muat_naik');
        
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the FarmasiPermohonanLiputanPerubatanSukan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return FarmasiPermohonanLiputanPerubatanSukan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = FarmasiPermohonanLiputanPerubatanSukan::findOne($id)) !== null) {
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
