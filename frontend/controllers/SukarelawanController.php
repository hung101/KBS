<?php

namespace frontend\controllers;

use Yii;
use app\models\Sukarelawan;
use frontend\models\SukarelawanSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

use app\models\general\Upload;
use app\models\general\GeneralVariable;
use app\models\general\GeneralLabel;

// table reference
use app\models\RefJantina;
use app\models\RefSaizBajuSukarelawan;
use app\models\RefKelulusanAkademikSukarelawan;
use app\models\RefBandar;
use app\models\RefNegeri;
use app\models\RefBidangDiminatiSukarelawan;
use app\models\RefWaktuKetikaDiperlukanSukarelawan;
use app\models\RefTarafPerkahwinan;

/**
 * SukarelawanController implements the CRUD actions for Sukarelawan model.
 */
class SukarelawanController extends Controller
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
     * Lists all Sukarelawan models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $searchModel = new SukarelawanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Sukarelawan model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = $this->findModel($id);
        
        $ref = RefJantina::findOne(['id' => $model->jantina]);
        $model->jantina = $ref['desc'];
        
        $ref = RefNegeri::findOne(['id' => $model->alamat_negeri]);
        $model->alamat_negeri = $ref['desc'];
        
        $ref = RefBandar::findOne(['id' => $model->alamat_bandar]);
        $model->alamat_bandar = $ref['desc'];
        
        $ref = RefSaizBajuSukarelawan::findOne(['id' => $model->saiz_baju]);
        $model->saiz_baju = $ref['desc'];
        
        $ref = RefTarafPerkahwinan::findOne(['id' => $model->status]);
        $model->status = $ref['desc'];
        
        $ref = RefKelulusanAkademikSukarelawan::findOne(['id' => $model->kelulusan_akademi]);
        $model->kelulusan_akademi = $ref['desc'];
        
        $ref = RefNegeri::findOne(['id' => $model->alamat_majikan_negeri]);
        $model->alamat_majikan_negeri = $ref['desc'];
        
        $ref = RefBandar::findOne(['id' => $model->alamat_majikan_bandar]);
        $model->alamat_majikan_bandar = $ref['desc'];
        
        $ref = RefBidangDiminatiSukarelawan::findOne(['id' => $model->bidang_diminati]);
        $model->bidang_diminati = $ref['desc'];
        
        $ref = RefWaktuKetikaDiperlukanSukarelawan::findOne(['id' => $model->waktu_ketika_diperlukan]);
        $model->waktu_ketika_diperlukan = $ref['desc'];
        
        $model->kebatasan_fizikal = GeneralLabel::getYesNoLabel($model->kebatasan_fizikal);
        
        return $this->render('view', [
            'model' => $model,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new Sukarelawan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new Sukarelawan();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $upload = new Upload();
            $file = UploadedFile::getInstance($model, 'muatnaik');
            if($file){
                $model->muatnaik = $upload->uploadFile($file, Upload::sukarelawanFolder, $model->sukarelawan_id, "");
            }
            
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->sukarelawan_id]);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Updates an existing Sukarelawan model.
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
            $file = UploadedFile::getInstance($model, 'muatnaik');
            if($file){
                $model->muatnaik = $upload->uploadFile($file, Upload::sukarelawanFolder, $model->sukarelawan_id, "");
            }
            
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->sukarelawan_id]);
            }
        } else {
            return $this->render('update', [
                'model' => $model,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Deletes an existing Sukarelawan model.
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

        return $this->redirect(['index']);
    }

    /**
     * Finds the Sukarelawan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Sukarelawan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Sukarelawan::findOne($id)) !== null) {
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
