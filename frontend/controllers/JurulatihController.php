<?php

namespace frontend\controllers;

use Yii;
use app\models\Jurulatih;
use frontend\models\JurulatihSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\web\Session;
use yii\helpers\Json;

use app\models\general\GeneralVariable;
use app\models\general\Upload;

// table reference
use app\models\RefJantina;
use app\models\RefCawangan;
use app\models\RefBandar;
use app\models\RefNegeri;
use app\models\RefNegara;
use app\models\RefBangsa;
use app\models\RefAgama;
use app\models\RefTarafPerkahwinan;
use app\models\RefBahagianJurulatih;
use app\models\RefProgramJurulatih;
use app\models\RefSubProgramPelapisJurulatih;
use app\models\RefLainProgramJurulatih;
use app\models\RefSukan;
use app\models\RefAcara;
use app\models\RefStatusJurulatih;
use app\models\RefStatusPermohonanJurulatih;
use app\models\RefKeaktifanJurulatih;
use app\models\RefSektorPekerjaan;
use app\models\RefStatusTawaran;
use app\models\RefAgensiJurulatih;

/**
 * JurulatihController implements the CRUD actions for Jurulatih model.
 */
class JurulatihController extends Controller
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
     * Lists all Jurulatih models.
     * @return mixed
     */
    public function actionIndex($filter_type = null, $id = null, $id2 = null, $desc = null)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $queryPar = Yii::$app->request->queryParams;
        
        if(isset($filter_type) && isset($id)){
            if($filter_type == 'sijil'){
                $queryPar['JurulatihSearch']['sijil'] = $id;
                $queryPar['JurulatihSearch']['tahap'] = $id2;
            } else {
                $queryPar['JurulatihSearch'][$filter_type] = $id;
            }
        }
        
        $searchModel = new JurulatihSearch();
        $dataProvider = $searchModel->search($queryPar);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'desc' => $desc,
        ]);
    }

    /**
     * Displays a single Jurulatih model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = $this->findModel($id);
        
        $session = new Session;
        $session->open();
        
        $session['jurulatih_id'] = $id;
        
        $session->close();
        
        // get atlet dropdown value's descriptions
        $ref = RefJantina::findOne(['id' => $model->jantina]);
        $model->jantina = $ref['desc'];
        
        $ref = RefCawangan::findOne(['id' => $model->cawangan]);
        $model->cawangan = $ref['desc'];
        
        $ref = RefBandar::findOne(['id' => $model->alamat_rumah_bandar]);
        $model->alamat_rumah_bandar = $ref['desc'];
        
        $ref = RefNegeri::findOne(['id' => $model->alamat_rumah_negeri]);
        $model->alamat_rumah_negeri = $ref['desc'];
        
        $ref = RefBandar::findOne(['id' => $model->alamat_surat_menyurat_bandar]);
        $model->alamat_surat_menyurat_bandar = $ref['desc'];
        
        $ref = RefNegeri::findOne(['id' => $model->alamat_surat_menyurat_negeri]);
        $model->alamat_surat_menyurat_negeri = $ref['desc'];
        
        $ref = RefBandar::findOne(['id' => $model->alamat_majikan_bandar]);
        $model->alamat_majikan_bandar = $ref['desc'];
        
        $ref = RefNegeri::findOne(['id' => $model->alamat_majikan_negeri]);
        $model->alamat_majikan_negeri = $ref['desc'];
        
        $ref = RefNegara::findOne(['id' => $model->warganegara]);
        $model->warganegara = $ref['desc'];
        
        $ref = RefBangsa::findOne(['id' => $model->bangsa]);
        $model->bangsa = $ref['desc'];
        
        $ref = RefAgama::findOne(['id' => $model->agama]);
        $model->agama = $ref['desc'];
        
        $ref = RefTarafPerkahwinan::findOne(['id' => $model->taraf_perkahwinan]);
        $model->taraf_perkahwinan = $ref['desc'];
        
        $ref = RefBahagianJurulatih::findOne(['id' => $model->bahagian]);
        $model->bahagian = $ref['desc'];
        
        $ref = RefProgramJurulatih::findOne(['id' => $model->program]);
        $model->program = $ref['desc'];
        
        $ref = RefSubProgramPelapisJurulatih::findOne(['id' => $model->sub_cawangan_pelapis]);
        $model->sub_cawangan_pelapis = $ref['desc'];
        
        $ref = RefLainProgramJurulatih::findOne(['id' => $model->lain_lain_program]);
        $model->lain_lain_program = $ref['desc'];
        
        $ref = RefSukan::findOne(['id' => $model->nama_sukan]);
        $model->nama_sukan = $ref['desc'];
        
        $ref = RefAcara::findOne(['id' => $model->nama_acara]);
        $model->nama_acara = $ref['desc'];
        
        $ref = RefStatusJurulatih::findOne(['id' => $model->status_jurulatih]);
        $model->status_jurulatih = $ref['desc'];
        
        $ref = RefStatusPermohonanJurulatih::findOne(['id' => $model->status_permohonan]);
        $model->status_permohonan = $ref['desc'];
        
        $ref = RefKeaktifanJurulatih::findOne(['id' => $model->status_keaktifan_jurulatih]);
        $model->status_keaktifan_jurulatih = $ref['desc'];
        
        $ref = RefSektorPekerjaan::findOne(['id' => $model->sektor]);
        $model->sektor = $ref['desc'];
        
        $ref = RefStatusTawaran::findOne(['id' => $model->status_tawaran]);
        $model->status_tawaran = $ref['desc'];
        
         $ref = RefAgensiJurulatih::findOne(['id' => $model->agensi]);
        $model->agensi = $ref['desc'];
        
        return $this->render('layout', [
            'model' => $model,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new Jurulatih model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $session = new Session;
        $session->open();
        
        $session->remove('jurulatih_id');
        
        $session->close();
        
        $model = new Jurulatih();
        
        $model->status_tawaran = RefStatusTawaran::DALAM_PROSES; //default

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $file = UploadedFile::getInstance($model, 'gambar');
            if($file){
                $model->gambar = Upload::uploadFile($file, Upload::jurulatihFolder, $model->jurulatih_id);
            }
            
            if($model->save()){
                $session = new Session;
                $session->open();

                $session['jurulatih_id'] = $model->jurulatih_id;

                $session->close();

                return $this->redirect(['view', 'id' => $model->jurulatih_id]);
            }
        }
        
        return $this->render('layout', [
            'model' => $model,
            'readonly' => false,
        ]);
    }

    /**
     * Updates an existing Jurulatih model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $session = new Session;
        $session->open();

        $session['jurulatih_id'] = $id;
        
        $session->close();
        
        $model = $this->findModel($id);
        
        $existingGambar = $model->gambar;
        
        if($model->load(Yii::$app->request->post())){
            $file = UploadedFile::getInstance($model, 'gambar');

            if($file){
                //valid file to upload
                //upload file to server
                $model->gambar = Upload::uploadFile($file, Upload::jurulatihFolder, $model->jurulatih_id);
            } else {
                //invalid file to upload
                //remain existing file
                $model->gambar = $existingGambar;
            }
        }

        if (Yii::$app->request->post() && $model->save()) {
            return $this->redirect(['view', 'id' => $model->jurulatih_id]);
        } else {
            return $this->render('layout', [
                'model' => $model,
                'readonly' => false,
            ]);
        }
    }
    
    /**
     * Updates an existing Jurulatih model.
     * If approved is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionApproved($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = $this->findModel($id);
        
        $model->approved = 1; // set approved
        
        $model->save();
        
        return $this->redirect(['view', 'id' => $model->jurulatih_id]);
    }

    /**
     * Deletes an existing Jurulatih model.
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
        self::actionDeleteupload($id, 'gambar');
        
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Jurulatih model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Jurulatih the loaded model
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
    
    public function actionGetJurulatih($id){
        // find Ahli Jawatankuasa Induk
        $model = Jurulatih::findOne($id);
        
        echo Json::encode($model);
    }
}
