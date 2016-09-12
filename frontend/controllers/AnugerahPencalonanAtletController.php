<?php

namespace frontend\controllers;

use Yii;
use app\models\AnugerahPencalonanAtlet;
use frontend\models\AnugerahPencalonanAtletSearch;
use app\models\MsnLaporanPencalonanAnugerahSukanNegaraAtlet;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\helpers\Json;
use yii\helpers\BaseUrl;

use app\models\general\Upload;
use app\models\general\GeneralVariable;
use app\models\general\GeneralLabel;
use common\models\general\GeneralFunction;

// table reference
use app\models\RefSukan;
use app\models\RefAcara;
use app\models\RefStatusPencalonan;
use app\models\Atlet;
use app\models\RefKategoriPencalonanAtlet;

/**
 * AnugerahPencalonanAtletController implements the CRUD actions for AnugerahPencalonanAtlet model.
 */
class AnugerahPencalonanAtletController extends Controller
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
     * Lists all AnugerahPencalonanAtlet models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $searchModel = new AnugerahPencalonanAtletSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AnugerahPencalonanAtlet model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = $this->findModel($id);
        
        $ref = RefSukan::findOne(['id' => $model->nama_sukan]);
        $model->nama_sukan = $ref['desc'];
        
        $ref = RefAcara::findOne(['id' => $model->nama_acara]);
        $model->nama_acara = $ref['desc'];
        
        $ref = RefStatusPencalonan::findOne(['id' => $model->status_pencalonan]);
        $model->status_pencalonan = $ref['desc'];
        
        $model->sifat_kepimpinan_ketua_pasukan = GeneralLabel::getYesNoLabel($model->sifat_kepimpinan_ketua_pasukan);
        
        $model->sifat_kepimpinan_jurulatih = GeneralLabel::getYesNoLabel($model->sifat_kepimpinan_jurulatih);
        
        $model->sifat_kepimpinan_asia_tenggara = GeneralLabel::getYesNoLabel($model->sifat_kepimpinan_asia_tenggara);
        
        $model->sifat_kepimpinan_penolong_jurulatih = GeneralLabel::getYesNoLabel($model->sifat_kepimpinan_penolong_jurulatih);
        
        $model->sifat_kepimpinan_pegawai_teknikal = GeneralLabel::getYesNoLabel($model->sifat_kepimpinan_pegawai_teknikal);
        
        $ref = RefSukan::findOne(['id' => $model->nama_sukan_sebelum_dicalon]);
        $model->nama_sukan_sebelum_dicalon = $ref['desc'];
        
        $ref = RefKategoriPencalonanAtlet::findOne(['id' => $model->kategori]);
        $model->kategori = $ref['desc'];
        
        $ref = Atlet::findOne(['atlet_id' => $model->nama_atlet]);
        $model->nama_atlet = $ref['name_penuh'];
        
        $model->memenangi_kategori_dalam_anugerah_sukan = GeneralLabel::getYesNoLabel($model->memenangi_kategori_dalam_anugerah_sukan);
        
        $model->kelulusan = GeneralLabel::getYesNoLabel($model->kelulusan);
        
        return $this->render('view', [
            'model' => $model,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new AnugerahPencalonanAtlet model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new AnugerahPencalonanAtlet();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $file = UploadedFile::getInstance($model, 'gambar');
            if($file){
                $model->gambar = Upload::uploadFile($file, Upload::anugerahPencalonanAtletFolder, $model->anugerah_pencalonan_atlet);
            }
            
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->anugerah_pencalonan_atlet]);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Updates an existing AnugerahPencalonanAtlet model.
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
            $file = UploadedFile::getInstance($model, 'gambar');
            if($file){
                $model->gambar = Upload::uploadFile($file, Upload::anugerahPencalonanAtletFolder, $model->anugerah_pencalonan_atlet);
            }
            
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->anugerah_pencalonan_atlet]);
            }
        } else {
            return $this->render('update', [
                'model' => $model,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Deletes an existing AnugerahPencalonanAtlet model.
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
     * Finds the AnugerahPencalonanAtlet model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AnugerahPencalonanAtlet the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AnugerahPencalonanAtlet::findOne($id)) !== null) {
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
    
    public function actionLaporanPencalonanAnugerahSukanNegaraAtlet()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new MsnLaporanPencalonanAnugerahSukanNegaraAtlet();
        $model->format = 'html';

        if ($model->load(Yii::$app->request->post())) {
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-laporan-pencalonan-anugerah-sukan-negara-atlet'
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-laporan-pencalonan-anugerah-sukan-negara-atlet'
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'format' => $model->format
                ]);
            }
        } 

        return $this->render('laporan_pencalonan_anugerah_sukan_negara_atlet', [
            'model' => $model,
            'readonly' => false,
        ]);
    }
    
    public function actionGenerateLaporanPencalonanAnugerahSukanNegaraAtlet($tarikh_dari, $tarikh_hingga, $format)
    {
        if($tarikh_dari == "") $tarikh_dari = array();
        else $tarikh_dari = array($tarikh_dari);
        
        if($tarikh_hingga == "") $tarikh_hingga = array();
        else $tarikh_hingga = array($tarikh_hingga);
        
        $controls = array(
            'FROM_DATE' => $tarikh_dari,
            'TO_DATE' => $tarikh_hingga,
        );
        
        GeneralFunction::generateReport('/spsb/MSN/LaporanPencalonanAnugerahSukanNegara', $format, $controls, 'laporan_pencalonan_anugerah_sukan_negara_atlet');
    }
}
