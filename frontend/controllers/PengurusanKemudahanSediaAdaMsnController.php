<?php

namespace frontend\controllers;

use Yii;
use app\models\PengurusanKemudahanSediaAdaMsn;
use frontend\models\PengurusanKemudahanSediaAdaMsnSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\helpers\Json;
use yii\web\Session;

use app\models\general\Upload;
use app\models\general\GeneralVariable;

// table reference
use app\models\PengurusanKemudahanVenueMsn;
use app\models\RefLokasiPengurusanKemudahan;
use app\models\RefJenisKemudahan;
use app\models\RefSukanRekreasi;
use app\models\RefAgensiKemudahan;

/**
 * PengurusanKemudahanSediaAdaMsnController implements the CRUD actions for PengurusanKemudahanSediaAdaMsn model.
 */
class PengurusanKemudahanSediaAdaMsnController extends Controller
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
     * Lists all PengurusanKemudahanSediaAdaMsn models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $searchModel = new PengurusanKemudahanSediaAdaMsnSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PengurusanKemudahanSediaAdaMsn model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = $this->findModel($id);
        
        $ref = PengurusanKemudahanVenueMsn::findOne(['pengurusan_kemudahan_venue_id' => $model->pengurusan_kemudahan_venue_id]);
        $model->pengurusan_kemudahan_venue_id = $ref['nama_venue'];
        
        $ref = RefJenisKemudahan::findOne(['id' => $model->jenis_kemudahan]);
        $model->jenis_kemudahan = $ref['desc'];
        
        $ref = RefSukanRekreasi::findOne(['id' => $model->sukan_rekreasi]);
        $model->sukan_rekreasi = $ref['desc'];
        
        $ref = RefLokasiPengurusanKemudahan::findOne(['id' => $model->lokasi]);
        $model->lokasi = $ref['desc'];
        
        $ref = RefAgensiKemudahan::findOne(['id' => $model->agensi]);
        $model->agensi = $ref['desc'];
        
        return $this->renderAjax('view', [
            'model' => $model,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new PengurusanKemudahanSediaAdaMsn model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($pengurusan_kemudahan_venue_id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new PengurusanKemudahanSediaAdaMsn();
        
        Yii::$app->session->open();
        
        if($pengurusan_kemudahan_venue_id != ''){
            $model->pengurusan_kemudahan_venue_id = $pengurusan_kemudahan_venue_id;
        } else {
            if(isset(Yii::$app->session->id)){
                $model->session_id = Yii::$app->session->id;
            }
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $upload = new Upload();
            $file = UploadedFile::getInstance($model, 'gambar_1');
            $file_id = 'gambar_1_' . $model->pengurusan_kemudahan_sedia_ada_id;
            if($file){
                $model->gambar_1 = $upload->uploadFile($file, Upload::pengurusanKemudahanSediaAdaMsnFolder, $file_id);
            }
            
            $file = UploadedFile::getInstance($model, 'gambar_2');
            $file_id = 'gambar_2_' . $model->pengurusan_kemudahan_sedia_ada_id;
            if($file){
                $model->gambar_2 = $upload->uploadFile($file, Upload::pengurusanKemudahanSediaAdaMsnFolder, $file_id);
            }
            
            $file = UploadedFile::getInstance($model, 'gambar_3');
            $file_id = 'gambar_3_' . $model->pengurusan_kemudahan_sedia_ada_id;
            if($file){
                $model->gambar_3 = $upload->uploadFile($file, Upload::pengurusanKemudahanSediaAdaMsnFolder, $file_id);
            }
            
            $file = UploadedFile::getInstance($model, 'gambar_4');
            $file_id = 'gambar_4_' . $model->pengurusan_kemudahan_sedia_ada_id;
            if($file){
                $model->gambar_4 = $upload->uploadFile($file, Upload::pengurusanKemudahanSediaAdaMsnFolder, $file_id);
            }
            
            $file = UploadedFile::getInstance($model, 'gambar_5');
            $file_id = 'gambar_5_' . $model->pengurusan_kemudahan_sedia_ada_id;
            if($file){
                $model->gambar_5 = $upload->uploadFile($file, Upload::pengurusanKemudahanSediaAdaMsnFolder, $file_id);
            }
            
            if($model->save()){
                return '1';
            }
        } 
        
        return $this->renderAjax('create', [
                'model' => $model,
                'readonly' => false,
            ]);
    }

    /**
     * Updates an existing PengurusanKemudahanSediaAdaMsn model.
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
            $file = UploadedFile::getInstance($model, 'gambar_1');
            $file_id = 'gambar_1_' . $model->pengurusan_kemudahan_sedia_ada_id;
            if($file){
                $model->gambar_1 = $upload->uploadFile($file, Upload::pengurusanKemudahanSediaAdaMsnFolder, $file_id);
            }
            
            $file = UploadedFile::getInstance($model, 'gambar_2');
            $file_id = 'gambar_2_' . $model->pengurusan_kemudahan_sedia_ada_id;
            if($file){
                $model->gambar_2 = $upload->uploadFile($file, Upload::pengurusanKemudahanSediaAdaMsnFolder, $file_id);
            }
            
            $file = UploadedFile::getInstance($model, 'gambar_3');
            $file_id = 'gambar_3_' . $model->pengurusan_kemudahan_sedia_ada_id;
            if($file){
                $model->gambar_3 = $upload->uploadFile($file, Upload::pengurusanKemudahanSediaAdaMsnFolder, $file_id);
            }
            
            $file = UploadedFile::getInstance($model, 'gambar_4');
            $file_id = 'gambar_4_' . $model->pengurusan_kemudahan_sedia_ada_id;
            if($file){
                $model->gambar_4 = $upload->uploadFile($file, Upload::pengurusanKemudahanSediaAdaMsnFolder, $file_id);
            }
            
            $file = UploadedFile::getInstance($model, 'gambar_5');
            $file_id = 'gambar_5_' . $model->pengurusan_kemudahan_sedia_ada_id;
            if($file){
                $model->gambar_5 = $upload->uploadFile($file, Upload::pengurusanKemudahanSediaAdaMsnFolder, $file_id);
            }
            
            if($model->save()){
                return '1';
            }
        } 
        
        return $this->renderAjax('update', [
                'model' => $model,
                'readonly' => false,
            ]);
    }

    /**
     * Deletes an existing PengurusanKemudahanSediaAdaMsn model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        // delete upload files
        self::actionDeleteupload($id, 'gambar_1');
        self::actionDeleteupload($id, 'gambar_2');
        self::actionDeleteupload($id, 'gambar_3');
        self::actionDeleteupload($id, 'gambar_4');
        self::actionDeleteupload($id, 'gambar_5');
        
        $this->findModel($id)->delete();

        //return $this->redirect(['index']);
    }

    /**
     * Finds the PengurusanKemudahanSediaAdaMsn model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PengurusanKemudahanSediaAdaMsn the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PengurusanKemudahanSediaAdaMsn::findOne($id)) !== null) {
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

            //return $this->redirect(['update', 'id' => $id]);
            return self::actionUpdate($id);
    }
    
    /**
     * Get Bandars base on Negeri id
     * @param integer $id
     * @return mixed
     */
    public function actionSubkemudahans()
    {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $cat_id = $parents[0];
                $out = self::getKemudahansByVenue($cat_id); 
                // the getSubCatList function will query the database based on the
                // cat_id and return an array like below:
                // [
                //    ['id'=>'<sub-cat-id-1>', 'name'=>'<sub-cat-name1>'],
                //    ['id'=>'<sub-cat_id_2>', 'name'=>'<sub-cat-name2>']
                // ]
                echo Json::encode(['output'=>$out, 'selected'=>'']);
                return;
            }
        }
        echo Json::encode(['output'=>'', 'selected'=>'']);
    }
    
    /**
     * get list of Kemudahan by Venue
     * @param integer $id
     * @return Array Bandars
     */
    public static function getKemudahansByVenue($agensi_id) {
        $session = new Session;
        $session->open();
        
        $data = null;
        
        if(isset($session['tempahan-kemudahan-msn-pengurusan_kemudahan_venue_id'])){
            $data = PengurusanKemudahanSediaAdaMsn::find()->where(['pengurusan_kemudahan_venue_id'=>$session['tempahan-kemudahan-msn-pengurusan_kemudahan_venue_id']])->andWhere(['agensi'=>$agensi_id])
                ->select(['pengurusan_kemudahan_sedia_ada_id as id',
                    //'CONCAT((SELECT sr.desc FROM tbl_ref_sukan_rekreasi sr WHERE sr.id = tbl_pengurusan_kemudahan_sedia_ada_msn.sukan_rekreasi)'
                    'CONCAT((SELECT sr.desc FROM tbl_ref_agensi_kemudahan sr WHERE sr.id = tbl_pengurusan_kemudahan_sedia_ada_msn.agensi)'
                    . '," - ",(SELECT rjk.desc FROM tbl_ref_jenis_kemudahan rjk WHERE rjk.id = tbl_pengurusan_kemudahan_sedia_ada_msn.jenis_kemudahan)) AS name'])->asArray()->all();
        } else {
            $data = PengurusanKemudahanSediaAdaMsn::find()->where(['agensi'=>$agensi_id])
                ->select(['pengurusan_kemudahan_sedia_ada_id as id',
                    //'CONCAT((SELECT sr.desc FROM tbl_ref_sukan_rekreasi sr WHERE sr.id = tbl_pengurusan_kemudahan_sedia_ada_msn.sukan_rekreasi)'
                    'CONCAT((SELECT sr.desc FROM tbl_ref_agensi_kemudahan sr WHERE sr.id = tbl_pengurusan_kemudahan_sedia_ada_msn.agensi)'
                    . '," - ",(SELECT rjk.desc FROM tbl_ref_jenis_kemudahan rjk WHERE rjk.id = tbl_pengurusan_kemudahan_sedia_ada_msn.jenis_kemudahan)) AS name'])->asArray()->all();
        }
        
        $value = (count($data) == 0) ? ['' => ''] : $data;
        
        $session->close();

        return $value;
    }
    
    /**
     * Get Agensis base on Negeri id
     * @param integer $id
     * @return mixed
     */
    public function actionSubagensis()
    {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $cat_id = $parents[0];
                $out = self::getAgensisByVenue($cat_id); 
                // the getSubCatList function will query the database based on the
                // cat_id and return an array like below:
                // [
                //    ['id'=>'<sub-cat-id-1>', 'name'=>'<sub-cat-name1>'],
                //    ['id'=>'<sub-cat_id_2>', 'name'=>'<sub-cat-name2>']
                // ]
                echo Json::encode(['output'=>$out, 'selected'=>'']);
                return;
            }
        }
        echo Json::encode(['output'=>'', 'selected'=>'']);
    }
    
    /**
     * get list of Agensi by Venue
     * @param integer $id
     * @return Array Bandars
     */
    public static function getAgensisByVenue($venue_id) {
        
        $data = null;
            $data = PengurusanKemudahanSediaAdaMsn::find()->andWhere(['pengurusan_kemudahan_venue_id'=>$venue_id])->select(['agensi as id',
                    '(SELECT sr.desc FROM tbl_ref_agensi_kemudahan sr WHERE sr.id = tbl_pengurusan_kemudahan_sedia_ada_msn.agensi) AS name'])->groupBy('agensi')->asArray()->all();

        $value = (count($data) == 0) ? ['' => ''] : $data;

        return $value;
    }
    
    public function actionGetKemudahan($id){
        // find Venue
        $model = PengurusanKemudahanSediaAdaMsn::find()->where(['pengurusan_kemudahan_sedia_ada_id' => $id])->asArray()->one();
        
        echo Json::encode($model);
    }
}
