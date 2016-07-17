<?php

namespace frontend\controllers;

use Yii;
use app\models\IsnLaporanSatelitSistemLaporanPusat;
use app\models\Satelit;
use frontend\models\SatelitSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\BaseUrl;

use app\models\general\GeneralVariable;
use common\models\general\GeneralFunction;

// table reference
use app\models\Atlet;
use app\models\RefSukan;
use app\models\RefPerkhidmatanSatelit;
use app\models\RefFasilitiSatelit;

/**
 * SatelitController implements the CRUD actions for Satelit model.
 */
class SatelitController extends Controller
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
     * Lists all Satelit models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $searchModel = new SatelitSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Satelit model.
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
        
        $ref = RefPerkhidmatanSatelit::findOne(['id' => $model->perkhidmatan]);
        $model->perkhidmatan = $ref['desc'];
        
        $ref = RefSukan::findOne(['id' => $model->sukan]);
        $model->sukan = $ref['desc'];
        
        $ref = RefFasilitiSatelit::findOne(['id' => $model->fasiliti]);
        $model->fasiliti = $ref['desc'];
        
        return $this->render('view', [
            'model' => $model,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new Satelit model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new Satelit();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->satelit_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Updates an existing Satelit model.
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
            return $this->redirect(['view', 'id' => $model->satelit_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Deletes an existing Satelit model.
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
     * Finds the Satelit model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Satelit the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Satelit::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionLaporanSatelitSistemLaporanPusat()
    {

        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new IsnLaporanSatelitSistemLaporanPusat();
        $model->format = 'html';

        if ($model->load(Yii::$app->request->post())) {
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-laporan-satelit-sistem-laporan-pusat'
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'atlet' => $model->atlet
                    , 'sukan' => $model->sukan
                        , 'perkhidmatan' => $model->perkhidmatan
                        , 'fasiliti' => $model->fasiliti
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-laporan-satelit-sistem-laporan-pusat'
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'atlet' => $model->atlet
                    , 'sukan' => $model->sukan
                        , 'perkhidmatan' => $model->perkhidmatan
                        , 'fasiliti' => $model->fasiliti
                    , 'format' => $model->format
                ]);
            }
        } 

        return $this->render('laporan_satelit_sistem_laporan_pusat', [
            'model' => $model,
            'readonly' => false,
        ]);
    }

    public function actionGenerateLaporanSatelitSistemLaporanPusat($tarikh_dari, $tarikh_hingga, $atlet, $sukan, $perkhidmatan, $fasiliti, $format)
    {
        if($tarikh_dari == "") $tarikh_dari = array();
        else $tarikh_dari = array($tarikh_dari);
        
        if($tarikh_hingga == "") $tarikh_hingga = array();
        else $tarikh_hingga = array($tarikh_hingga);
        
        if($atlet == "") $atlet = array();
        else $atlet = array($atlet);
        
        if($sukan == "") $sukan = array();
        else $sukan = array($sukan);
        
        if($perkhidmatan == "") $perkhidmatan = array();
        else $perkhidmatan = array($perkhidmatan);
        
        if($fasiliti == "") $fasiliti = array();
        else $fasiliti = array($fasiliti);
        
        $controls = array(
            'FROM_DATE' => $tarikh_dari,
            'TO_DATE' => $tarikh_hingga,
            'ATLET' => $atlet,
            'SUKAN' => $sukan,
            'PERKHIDMATAN' => $perkhidmatan,
            'FASILITI' => $fasiliti,
        );
        
        GeneralFunction::generateReport('/spsb/ISN/SatelitSistemLaporanPusat', $format, $controls, 'laporan_satelit_sistem_laporan_pusat');
    }
}
