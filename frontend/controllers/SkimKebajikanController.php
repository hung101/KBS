<?php

namespace frontend\controllers;

use Yii;
use app\models\SkimKebajikan;
use app\models\SkimKebajikanSearch;
use app\models\MsnLaporanSkimKebajikan;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\helpers\Json;
use yii\helpers\BaseUrl;

use app\models\general\Upload;
use app\models\general\GeneralLabel;
use common\models\general\GeneralFunction;

// table reference
use app\models\Atlet;
use app\models\RefJenisKebajikan;
use app\models\RefSukan;
use app\models\RefPerkara;
use app\models\RefSukanSkimKebajikan;
use app\models\RefJenisPermohonanSkim;

/**
 * SkimKebajikanController implements the CRUD actions for SkimKebajikan model.
 */
class SkimKebajikanController extends Controller
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
     * Lists all SkimKebajikan models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SkimKebajikanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single SkimKebajikan model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        
        $ref = Atlet::findOne(['atlet_id' => $model->nama_pemohon]);
        $model->nama_pemohon = $ref['nameAndIC'];
        
        $ref = RefSukan::findOne(['id' => $model->jenis_sukan]);
        $model->jenis_sukan = $ref['desc'];
        
        $ref = RefJenisKebajikan::findOne(['id' => $model->jenis_bantuan_skak]);
        $model->jenis_bantuan_skak = $ref['desc'];
        
        $ref = RefPerkara::findOne(['id' => $model->perkara]);
        $model->perkara = $ref['desc'];
        
        $ref = RefSukanSkimKebajikan::findOne(['id' => $model->sukan]);
        $model->sukan = $ref['desc'];
        
        $ref = RefJenisPermohonanSkim::findOne(['id' => $model->jenis_permohonan]);
        $model->jenis_permohonan = $ref['desc'];
        
        $YesNo = GeneralLabel::getYesNoLabel($model->kelulusan);
        $model->kelulusan = $YesNo;
        
        return $this->render('view', [
            'model' => $model,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new SkimKebajikan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new SkimKebajikan();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $file = UploadedFile::getInstance($model, 'muat_naik');
            if($file){
                $model->muat_naik = Upload::uploadFile($file, Upload::skimKebajikanFolder, $model->skim_kebajikan_id);
            }
            
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->skim_kebajikan_id]);
            }
        } 
        
        return $this->render('create', [
                'model' => $model,
                'readonly' => false,
            ]);
    }

    /**
     * Updates an existing SkimKebajikan model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $file = UploadedFile::getInstance($model, 'muat_naik');
            if($file){
                $model->muat_naik = Upload::uploadFile($file, Upload::skimKebajikanFolder, $model->skim_kebajikan_id);
            }
            
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->skim_kebajikan_id]);
            }
        } 
        
        return $this->render('update', [
                'model' => $model,
                'readonly' => false,
            ]);
    }

    /**
     * Deletes an existing SkimKebajikan model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        // delete upload file
        self::actionDeleteupload($id, 'muat_naik');
        
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the SkimKebajikan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return SkimKebajikan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SkimKebajikan::findOne($id)) !== null) {
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
    
    public function actionLaporanSkimKebajikan()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new MsnLaporanSkimKebajikan();
        $model->format = 'html';

        if ($model->load(Yii::$app->request->post())) {
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-laporan-skim-kebajikan'
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-laporan-skim-kebajikan'
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'format' => $model->format
                ]);
            }
        } 

        return $this->render('laporan_skim_kebajikan', [
            'model' => $model,
            'readonly' => false,
        ]);
    }
    
    public function actionGenerateLaporanSkimKebajikan($tarikh_dari, $tarikh_hingga, $format)
    {
        if($tarikh_dari == "") $tarikh_dari = array();
        else $tarikh_dari = array($tarikh_dari);
        
        if($tarikh_hingga == "") $tarikh_hingga = array();
        else $tarikh_hingga = array($tarikh_hingga);
        
        $controls = array(
            'FROM_DATE' => $tarikh_dari,
            'TO_DATE' => $tarikh_hingga,
        );
        
        GeneralFunction::generateReport('/spsb/MSN/LaporanSkimKebajikan', $format, $controls, 'laporan_skim_kebajikan');
    }
}
