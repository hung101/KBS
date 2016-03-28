<?php

namespace frontend\controllers;

use Yii;
use app\models\PlTemujanjiRehabilitasi;
use frontend\models\PlTemujanjiRehabilitasiSearch;
use app\models\PlDiagnosisPreskripsiPemeriksaanRehabilitasi;
use frontend\models\PlDiagnosisPreskripsiPemeriksaanRehabilitasiSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

use app\models\general\Upload;
use app\models\general\GeneralVariable;
use common\models\general\GeneralFunction;

// table reference
use app\models\Atlet;
use app\models\RefJenisTemujanjiRehabilitasi;
use app\models\RefStatusTemujanjiRehabilitasi;
use app\models\RefPegawaiPerubatanRehabilitasi;
use app\models\RefNamaRehabilitasi;
use app\models\RefKategoriPesakitLuar;
use app\models\RefTindakanSelanjutnyaRehabilitasi;

/**
 * PlTemujanjiRehabilitasiController implements the CRUD actions for PlTemujanjiRehabilitasi model.
 */
class PlTemujanjiRehabilitasiController extends Controller
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
     * Lists all PlTemujanjiRehabilitasi models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $searchModel = new PlTemujanjiRehabilitasiSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PlTemujanjiRehabilitasi model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = $this->findModel($id);
        
        $ref = Atlet::findOne(['atlet_id' => $model->atlet_id]);
        $model->atlet_id = $ref['nameAndIC'];
        
        $ref = RefJenisTemujanjiRehabilitasi::findOne(['id' => $model->makmal_perubatan]);
        $model->makmal_perubatan = $ref['desc'];
        
        $ref = RefStatusTemujanjiRehabilitasi::findOne(['id' => $model->status_temujanji]);
        $model->status_temujanji = $ref['desc'];
        
        $ref = RefKategoriPesakitLuar::findOne(['id' => $model->kategori_pesakit_luar]);
        $model->kategori_pesakit_luar = $ref['desc'];
        
        $ref = RefTindakanSelanjutnyaRehabilitasi::findOne(['id' => $model->tindakan_selanjutnya]);
        $model->tindakan_selanjutnya = $ref['desc'];
        
        $ref = RefNamaRehabilitasi::findOne(['id' => $model->nama_rehabilitasi]);
        $model->nama_rehabilitasi = $ref['desc'];
        
        $ref = RefPegawaiPerubatanRehabilitasi::findOne(['id' => $model->pegawai_yang_bertanggungjawab]);
        $model->pegawai_yang_bertanggungjawab = $ref['desc'];
        
        $model->tarikh_temujanji = GeneralFunction::convert($model->tarikh_temujanji, GeneralFunction::TYPE_DATETIME);
        
        $queryPar = null;
        
        $queryPar['PlDiagnosisPreskripsiPemeriksaanRehabilitasiSearch']['pl_temujanji_id'] = $id;
        
        $searchModelPlDiagnosisPreskripsiPemeriksaanRehabilitasi  = new PlDiagnosisPreskripsiPemeriksaanRehabilitasiSearch();
        $dataProviderPlDiagnosisPreskripsiPemeriksaanRehabilitasi = $searchModelPlDiagnosisPreskripsiPemeriksaanRehabilitasi->search($queryPar);
        
        return $this->render('view', [
            'model' => $model,
            'searchModelPlDiagnosisPreskripsiPemeriksaanRehabilitasi' => $searchModelPlDiagnosisPreskripsiPemeriksaanRehabilitasi,
            'dataProviderPlDiagnosisPreskripsiPemeriksaanRehabilitasi' => $dataProviderPlDiagnosisPreskripsiPemeriksaanRehabilitasi,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new PlTemujanjiRehabilitasi model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new PlTemujanjiRehabilitasi();
        
        $queryPar = null;
        
        Yii::$app->session->open();
        
        if(isset(Yii::$app->session->id)){
            $queryPar['PlDiagnosisPreskripsiPemeriksaanRehabilitasiSearch']['session_id'] = Yii::$app->session->id;
        }
        
        $searchModelPlDiagnosisPreskripsiPemeriksaanRehabilitasi  = new PlDiagnosisPreskripsiPemeriksaanRehabilitasiSearch();
        $dataProviderPlDiagnosisPreskripsiPemeriksaanRehabilitasi = $searchModelPlDiagnosisPreskripsiPemeriksaanRehabilitasi->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if(isset(Yii::$app->session->id)){
                PlDiagnosisPreskripsiPemeriksaanRehabilitasi::updateAll(['pl_temujanji_id' => $model->pl_temujanji_id], 'session_id = "'.Yii::$app->session->id.'"');
                PlDiagnosisPreskripsiPemeriksaanRehabilitasi::updateAll(['session_id' => ''], 'pl_temujanji_id = "'.$model->pl_temujanji_id.'"');
            }
            
            $file = UploadedFile::getInstance($model, 'muat_naik');
            if($file){
                $model->muat_naik = Upload::uploadFile($file, Upload::plTemujanjiRehabilitasiFolder, $model->pl_temujanji_id);
            }
            
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->pl_temujanji_id]);
            }
        } 
        
        return $this->render('create', [
                'model' => $model,
                'searchModelPlDiagnosisPreskripsiPemeriksaanRehabilitasi' => $searchModelPlDiagnosisPreskripsiPemeriksaanRehabilitasi,
                'dataProviderPlDiagnosisPreskripsiPemeriksaanRehabilitasi' => $dataProviderPlDiagnosisPreskripsiPemeriksaanRehabilitasi,
                'readonly' => false,
            ]);
    }

    /**
     * Updates an existing PlTemujanjiRehabilitasi model.
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
        
        $queryPar['PlDiagnosisPreskripsiPemeriksaanRehabilitasiSearch']['pl_temujanji_id'] = $id;
        
        $searchModelPlDiagnosisPreskripsiPemeriksaanRehabilitasi  = new PlDiagnosisPreskripsiPemeriksaanRehabilitasiSearch();
        $dataProviderPlDiagnosisPreskripsiPemeriksaanRehabilitasi = $searchModelPlDiagnosisPreskripsiPemeriksaanRehabilitasi->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $file = UploadedFile::getInstance($model, 'muat_naik');
            if($file){
                $model->muat_naik = Upload::uploadFile($file, Upload::plTemujanjiRehabilitasiFolder, $model->pl_temujanji_id);
            }
            
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->pl_temujanji_id]);
            }
        } 
        
        return $this->render('update', [
                'model' => $model,
                'searchModelPlDiagnosisPreskripsiPemeriksaanRehabilitasi' => $searchModelPlDiagnosisPreskripsiPemeriksaanRehabilitasi,
                'dataProviderPlDiagnosisPreskripsiPemeriksaanRehabilitasi' => $dataProviderPlDiagnosisPreskripsiPemeriksaanRehabilitasi,
                'readonly' => false,
            ]);
    }

    /**
     * Deletes an existing PlTemujanjiRehabilitasi model.
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
     * Finds the PlTemujanjiRehabilitasi model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PlTemujanjiRehabilitasi the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PlTemujanjiRehabilitasi::findOne($id)) !== null) {
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
