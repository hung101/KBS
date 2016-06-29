<?php

namespace frontend\controllers;

use Yii;
use app\models\PenjadualanUjianFisiologi;
use frontend\models\PenjadualanUjianFisiologiSearch;
use app\models\IsnLaporanFisiologiJumlahBilanganUjian;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\BaseUrl;

use app\models\general\GeneralVariable;
use common\models\general\GeneralFunction;

// table reference
use app\models\Atlet;
use app\models\RefPerkhidmatanFisiologi;
use app\models\RefSukan;
use app\models\RefKategoriSukan;
use app\models\RefAcara;
use app\models\RefTempatPenjadualanUjianFisiologi;

/**
 * PenjadualanUjianFisiologiController implements the CRUD actions for PenjadualanUjianFisiologi model.
 */
class PenjadualanUjianFisiologiController extends Controller
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
     * Lists all PenjadualanUjianFisiologi models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $searchModel = new PenjadualanUjianFisiologiSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PenjadualanUjianFisiologi model.
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
        
        $ref = RefSukan::findOne(['id' => $model->sukan]);
        $model->sukan = $ref['desc'];
        
        $ref = RefKategoriSukan::findOne(['id' => $model->kategori_sukan]);
        $model->kategori_sukan = $ref['desc'];
        
        $ref = RefAcara::findOne(['id' => $model->acara]);
        $model->acara = $ref['desc'];
        
        $ref = RefTempatPenjadualanUjianFisiologi::findOne(['id' => $model->tempat]);
        $model->tempat = $ref['desc'];
        
        $model->tarikh_masa = GeneralFunction::convert($model->tarikh_masa, GeneralFunction::TYPE_DATETIME);
        
        return $this->render('view', [
            'model' => $model,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new PenjadualanUjianFisiologi model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new PenjadualanUjianFisiologi();

        if ($model->load(Yii::$app->request->post())) {
            if($model->ujian){
                $model->ujian = implode(",",$model->ujian);
            }
            if($model->ujian_sub){
                $model->ujian_sub = implode(",",$model->ujian_sub);
            }
            if($model->peralatan){
                $model->peralatan = implode(",",$model->peralatan);
            }
            
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->penjadualan_ujian_fisiologi_id]);
            }
        } 
        
        return $this->render('create', [
                'model' => $model,
                'readonly' => false,
            ]);
    }

    /**
     * Updates an existing PenjadualanUjianFisiologi model.
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

        if ($model->load(Yii::$app->request->post())) {
            if($model->ujian){
                $model->ujian = implode(",",$model->ujian);
            }
            if($model->ujian_sub){
                $model->ujian_sub = implode(",",$model->ujian_sub);
            }
            if($model->peralatan){
                $model->peralatan = implode(",",$model->peralatan);
            }
            
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->penjadualan_ujian_fisiologi_id]);
            }
        } 
        
        return $this->render('update', [
                'model' => $model,
                'readonly' => false,
            ]);
    }

    /**
     * Deletes an existing PenjadualanUjianFisiologi model.
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
     * Finds the PenjadualanUjianFisiologi model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PenjadualanUjianFisiologi the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PenjadualanUjianFisiologi::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
   
    public function actionLaporanFisiologiJumlahBilanganUjian()
    {

        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new IsnLaporanFisiologiJumlahBilanganUjian();
        $model->format = 'html';

        if ($model->load(Yii::$app->request->post())) {
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-laporan-fisiologi-jumlah-bilangan-ujian'
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'sukan' => $model->sukan
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-laporan-fisiologi-jumlah-bilangan-ujian'
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'sukan' => $model->sukan
                    , 'format' => $model->format
                ]);
            }
        } 

        return $this->render('laporan_fisiologi_jumlah_bilangan_ujian', [
            'model' => $model,
            'readonly' => false,
        ]);
    }

    public function actionGenerateLaporanFisiologiJumlahBilanganUjian($tarikh_dari, $tarikh_hingga, $sukan, $format)
    {
        if($tarikh_dari == "") $tarikh_dari = array();
        else $tarikh_dari = array($tarikh_dari);
        
        if($tarikh_hingga == "") $tarikh_hingga = array();
        else $tarikh_hingga = array($tarikh_hingga);
        
        if($sukan == "") $sukan = array();
        else $sukan = array($sukan);
        
        $controls = array(
            'FROM_DATE' => $tarikh_dari,
            'TO_DATE' => $tarikh_hingga,
            'SUKAN' => $sukan,
        );
        
        GeneralFunction::generateReport('/spsb/ISN/LaporanFisiologiJumlahBilanganUjian', $format, $controls, 'laporan_fisiologi_jumlah_bilangan_ujian');
    }
}
