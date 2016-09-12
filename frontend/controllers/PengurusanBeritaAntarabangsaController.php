<?php

namespace frontend\controllers;

use Yii;
use app\models\PengurusanBeritaAntarabangsa;
use frontend\models\PengurusanBeritaAntarabangsaSearch;
use app\models\PengurusanBeritaAntarabangsaMuatnaik;
use frontend\models\PengurusanBeritaAntarabangsaMuatnaikSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

// contant values
use app\models\general\GeneralVariable;
use app\models\general\Upload;

// table reference
use app\models\RefKategoriBerita;
use app\models\RefNegara;
use app\models\RefNegeri;
use app\models\RefBandar;
use app\models\RefCountry;


/**
 * PengurusanBeritaAntarabangsaController implements the CRUD actions for PengurusanBeritaAntarabangsa model.
 */
class PengurusanBeritaAntarabangsaController extends Controller
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
     * Lists all PengurusanBeritaAntarabangsa models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $searchModel = new PengurusanBeritaAntarabangsaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PengurusanBeritaAntarabangsa model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = $this->findModel($id);
        
        $ref = RefKategoriBerita::findOne(['id' => $model->kategori_berita]);
        $model->kategori_berita = $ref['desc'];
        
        $ref = RefNegara::findOne(['id' => $model->nama_negara]);
        $model->nama_negara = $ref['desc'];
        
        $ref = RefNegeri::findOne(['id' => $model->alamat_negeri]);
        $model->alamat_negeri = $ref['desc'];
        
        $ref = RefBandar::findOne(['id' => $model->alamat_bandar]);
        $model->alamat_bandar = $ref['desc'];
        
        $ref = RefCountry::findOne(['id' => $model->country]);
        $model->country = $ref['desc'];
        
        $queryPar = null;
        
        $queryPar['PengurusanBeritaAntarabangsaMuatnaikSearch']['pengurusan_berita_antarabangsa_id'] = $id;
        
        $searchModelPengurusanBeritaAntarabangsaMuatnaik  = new PengurusanBeritaAntarabangsaMuatnaikSearch();
        $dataProviderPengurusanBeritaAntarabangsaMuatnaik = $searchModelPengurusanBeritaAntarabangsaMuatnaik->search($queryPar);
        
        return $this->render('view', [
            'model' => $model,
            'searchModelPengurusanBeritaAntarabangsaMuatnaik' => $searchModelPengurusanBeritaAntarabangsaMuatnaik,
            'dataProviderPengurusanBeritaAntarabangsaMuatnaik' => $dataProviderPengurusanBeritaAntarabangsaMuatnaik,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new PengurusanBeritaAntarabangsa model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new PengurusanBeritaAntarabangsa();
        
        $queryPar = null;
        
        Yii::$app->session->open();
        
        if(isset(Yii::$app->session->id)){
            $queryPar['PengurusanBeritaAntarabangsaMuatnaikSearch']['session_id'] = Yii::$app->session->id;
        }
        
        $searchModelPengurusanBeritaAntarabangsaMuatnaik  = new PengurusanBeritaAntarabangsaMuatnaikSearch();
        $dataProviderPengurusanBeritaAntarabangsaMuatnaik = $searchModelPengurusanBeritaAntarabangsaMuatnaik->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if(isset(Yii::$app->session->id)){
                PengurusanBeritaAntarabangsaMuatnaik::updateAll(['pengurusan_berita_antarabangsa_id' => $model->pengurusan_berita_antarabangsa_id], 'session_id = "'.Yii::$app->session->id.'"');
                PengurusanBeritaAntarabangsaMuatnaik::updateAll(['session_id' => ''], 'pengurusan_berita_antarabangsa_id = "'.$model->pengurusan_berita_antarabangsa_id.'"');
            }
            
            $file = UploadedFile::getInstance($model, 'muatnaik');
            if($file){
                $model->muatnaik = Upload::uploadFile($file, Upload::pengurusanBeritaAntarabangsaFolder, $model->pengurusan_berita_antarabangsa_id);
            }
            
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->pengurusan_berita_antarabangsa_id]);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
                'searchModelPengurusanBeritaAntarabangsaMuatnaik' => $searchModelPengurusanBeritaAntarabangsaMuatnaik,
                'dataProviderPengurusanBeritaAntarabangsaMuatnaik' => $dataProviderPengurusanBeritaAntarabangsaMuatnaik,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Updates an existing PengurusanBeritaAntarabangsa model.
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
        
        $queryPar['PengurusanBeritaAntarabangsaMuatnaikSearch']['pengurusan_berita_antarabangsa_id'] = $id;
        
        $searchModelPengurusanBeritaAntarabangsaMuatnaik  = new PengurusanBeritaAntarabangsaMuatnaikSearch();
        $dataProviderPengurusanBeritaAntarabangsaMuatnaik = $searchModelPengurusanBeritaAntarabangsaMuatnaik->search($queryPar);
        
        $existingMuatnaik = $model->muatnaik;
        
        if($model->load(Yii::$app->request->post())){
            $file = UploadedFile::getInstance($model, 'muatnaik');

            if($file){
                //valid file to upload
                //upload file to server
                $model->muatnaik = Upload::uploadFile($file, Upload::pengurusanBeritaAntarabangsaFolder, $model->pengurusan_berita_antarabangsa_id);
            } else {
                //invalid file to upload
                //remain existing file
                $model->muatnaik = $existingMuatnaik;
            }
        }

        if (Yii::$app->request->post() && $model->save()) {
            return $this->redirect(['view', 'id' => $model->pengurusan_berita_antarabangsa_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'searchModelPengurusanBeritaAntarabangsaMuatnaik' => $searchModelPengurusanBeritaAntarabangsaMuatnaik,
                'dataProviderPengurusanBeritaAntarabangsaMuatnaik' => $dataProviderPengurusanBeritaAntarabangsaMuatnaik,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Deletes an existing PengurusanBeritaAntarabangsa model.
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
     * Finds the PengurusanBeritaAntarabangsa model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PengurusanBeritaAntarabangsa the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PengurusanBeritaAntarabangsa::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
