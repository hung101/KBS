<?php

namespace frontend\controllers;

use Yii;
use app\models\GajiDanElaunJurulatih;
use frontend\models\GajiDanElaunJurulatihSearch;
use app\models\ElaunJurulatih;
use frontend\models\ElaunJurulatihSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

use app\models\general\Upload;
use app\models\general\GeneralVariable;
use common\models\general\GeneralFunction;

// table reference
use app\models\Jurulatih;
use app\models\RefBank;
use app\models\RefSukan;
use app\models\RefProgramJurulatih;

/**
 * GajiDanElaunJurulatihController implements the CRUD actions for GajiDanElaunJurulatih model.
 */
class GajiDanElaunJurulatihController extends Controller
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
     * Lists all GajiDanElaunJurulatih models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $searchModel = new GajiDanElaunJurulatihSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single GajiDanElaunJurulatih model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = $this->findModel($id);
        
        $ref = Jurulatih::findOne(['jurulatih_id' => $model->nama_jurulatih]);
        $model->nama_jurulatih = $ref['nameAndIC'];
        
        $ref = RefBank::findOne(['id' => $model->bank]);
        $model->bank = $ref['desc'];
        
        $ref = RefProgramJurulatih::findOne(['id' => $model->program]);
        $model->program = $ref['desc'];
        
        $ref = RefSukan::findOne(['id' => $model->nama_sukan]);
        $model->nama_sukan = $ref['desc'];
        
        $queryPar = null;
        
        $queryPar['ElaunJurulatihSearch']['gaji_dan_elaun_jurulatih_id'] = $id;
        
        $searchModelElaunJurulatih = new ElaunJurulatihSearch();
        $dataProviderElaunJurulatih= $searchModelElaunJurulatih->search($queryPar);
        
        return $this->render('view', [
            'model' => $model,
            'searchModelElaunJurulatih' => $searchModelElaunJurulatih,
            'dataProviderElaunJurulatih' => $dataProviderElaunJurulatih,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new GajiDanElaunJurulatih model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new GajiDanElaunJurulatih();
        
        $queryPar = null;
        
        Yii::$app->session->open();
        
        if(isset(Yii::$app->session->id)){
            $queryPar['ElaunJurulatihSearch']['session_id'] = Yii::$app->session->id;
        }
        
        $searchModelElaunJurulatih = new ElaunJurulatihSearch();
        $dataProviderElaunJurulatih= $searchModelElaunJurulatih->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if(isset(Yii::$app->session->id)){
                ElaunJurulatih::updateAll(['gaji_dan_elaun_jurulatih_id' => $model->gaji_dan_elaun_jurulatih_id], 'session_id = "'.Yii::$app->session->id.'"');
                ElaunJurulatih::updateAll(['session_id' => ''], 'gaji_dan_elaun_jurulatih_id = "'.$model->gaji_dan_elaun_jurulatih_id.'"');
            }
            
            $file = UploadedFile::getInstance($model, 'dokumen_muat_naik');
            if($file){
                $model->dokumen_muat_naik = Upload::uploadFile($file, Upload::gajiDanElaunJurulatihFolder, $model->gaji_dan_elaun_jurulatih_id);
            }
            
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->gaji_dan_elaun_jurulatih_id]);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
                'searchModelElaunJurulatih' => $searchModelElaunJurulatih,
                'dataProviderElaunJurulatih' => $dataProviderElaunJurulatih,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Updates an existing GajiDanElaunJurulatih model.
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
        
        $queryPar = null;
        
        $queryPar['ElaunJurulatihSearch']['gaji_dan_elaun_jurulatih_id'] = $id;
        
        $searchModelElaunJurulatih = new ElaunJurulatihSearch();
        $dataProviderElaunJurulatih= $searchModelElaunJurulatih->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $file = UploadedFile::getInstance($model, 'dokumen_muat_naik');
            if($file){
                $model->dokumen_muat_naik = Upload::uploadFile($file, Upload::gajiDanElaunJurulatihFolder, $model->gaji_dan_elaun_jurulatih_id);
            }
            
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->gaji_dan_elaun_jurulatih_id]);
            }
        } else {
            return $this->render('update', [
                'model' => $model,
                'searchModelElaunJurulatih' => $searchModelElaunJurulatih,
                'dataProviderElaunJurulatih' => $dataProviderElaunJurulatih,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Deletes an existing GajiDanElaunJurulatih model.
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

        return $this->redirect(['index']);
    }

    /**
     * Finds the GajiDanElaunJurulatih model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return GajiDanElaunJurulatih the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = GajiDanElaunJurulatih::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
