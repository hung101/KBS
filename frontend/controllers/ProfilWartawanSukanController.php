<?php

namespace frontend\controllers;

use Yii;
use app\models\ProfilWartawanSukan;
use frontend\models\ProfilWartawanSukanSearch;
use app\models\MsnLaporanProfilWartawan;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\helpers\Json;
use yii\helpers\BaseUrl;

// contant values
use app\models\general\Upload;
use app\models\general\GeneralLabel;
use common\models\general\GeneralFunction;

// table reference
use app\models\RefJawatanWartawan;
use app\models\RefAgensiMedia;


/**
 * ProfilWartawanSukanController implements the CRUD actions for ProfilWartawanSukan model.
 */
class ProfilWartawanSukanController extends Controller
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
     * Lists all ProfilWartawanSukan models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $searchModel = new ProfilWartawanSukanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ProfilWartawanSukan model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = $this->findModel($id);
        
        $ref = RefJawatanWartawan::findOne(['id' => $model->jawatan]);
        $model->jawatan = $ref['desc'];

        $ref2 = RefAgensiMedia::findOne(['id' => $model->agensi]);
        $model->agensi = $ref2['desc'];

        $YesNo = GeneralLabel::getYesNoLabel($model->aktif);
        $model->aktif = $YesNo;
        
        return $this->render('view', [
            'model' => $model,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new ProfilWartawanSukan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new ProfilWartawanSukan();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $file = UploadedFile::getInstance($model, 'gambar');
            if($file){
                $model->gambar = Upload::uploadFile($file, Upload::profilWartawanSukanFolder, 'gambar-' . $model->profil_wartawan_sukan_id);
            }
            
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->profil_wartawan_sukan_id]);
            }
        } 
        
        return $this->render('create', [
                'model' => $model,
                'readonly' => false,
            ]);
    }

    /**
     * Updates an existing ProfilWartawanSukan model.
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
                $model->gambar = Upload::uploadFile($file, Upload::profilWartawanSukanFolder, 'gambar-' . $model->profil_wartawan_sukan_id);
            }
            
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->profil_wartawan_sukan_id]);
            }
        } 
        
        return $this->render('update', [
                'model' => $model,
                'readonly' => false,
            ]);
    }

    /**
     * Deletes an existing ProfilWartawanSukan model.
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
     * Finds the ProfilWartawanSukan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ProfilWartawanSukan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ProfilWartawanSukan::findOne($id)) !== null) {
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
    
    public function actionLaporanProfilWartawan()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new MsnLaporanProfilWartawan();
        $model->format = 'html';

        if ($model->load(Yii::$app->request->post())) {
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-laporan-profil-wartawan'
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'jawatan' => $model->jawatan
                    , 'agensi' => $model->agensi
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-laporan-profil-wartawan'
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'jawatan' => $model->jawatan
                    , 'agensi' => $model->agensi
                    , 'format' => $model->format
                ]);
            }
        } 

        return $this->render('laporan_profil_wartawan', [
            'model' => $model,
            'readonly' => false,
        ]);
    }
    
    public function actionGenerateLaporanProfilWartawan($tarikh_dari, $tarikh_hingga, $jawatan, $agensi, $format)
    {
        if($tarikh_dari == "") $tarikh_dari = array();
        else $tarikh_dari = array($tarikh_dari);
        
        if($tarikh_hingga == "") $tarikh_hingga = array();
        else $tarikh_hingga = array($tarikh_hingga);
        
        if($jawatan == "") $jawatan = array();
        else $jawatan = array($jawatan);
        
        $controls = array(
            'FROM_DATE' => $tarikh_dari,
            'TO_DATE' => $tarikh_hingga,
            'JAWATAN' => $jawatan,
            'AGENSI' => $agensi,
        );
        
        GeneralFunction::generateReport('/spsb/MSN/LaporanProfilWartawan', $format, $controls, 'laporan_profil_wartawan');
    }
}
