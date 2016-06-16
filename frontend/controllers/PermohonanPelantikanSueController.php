<?php

namespace frontend\controllers;

use Yii;
use app\models\PermohonanPelantikanSue;
use frontend\models\PermohonanPelantikanSueSearch;
use app\models\MsnNotisKontrakSetiausahaEksekutifPersatuan;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\BaseUrl;

// contant values
use app\models\general\GeneralLabel;
use app\models\general\GeneralVariable;
use common\models\general\GeneralFunction;

/**
 * PermohonanPelantikanSueController implements the CRUD actions for PermohonanPelantikanSue model.
 */
class PermohonanPelantikanSueController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all PermohonanPelantikanSue models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PermohonanPelantikanSueSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PermohonanPelantikanSue model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new PermohonanPelantikanSue model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new PermohonanPelantikanSue();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->permohonan_pelantikan_sue_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Updates an existing PermohonanPelantikanSue model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->permohonan_pelantikan_sue_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Deletes an existing PermohonanPelantikanSue model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the PermohonanPelantikanSue model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PermohonanPelantikanSue the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PermohonanPelantikanSue::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionNotisKontrakSetiausahaEksekutifPersatuan()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new MsnNotisKontrakSetiausahaEksekutifPersatuan();
        $model->format = 'html';

        if ($model->load(Yii::$app->request->post())) {
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-notis-kontrak-setiausaha-eksekutif-persatuan'
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'persatuan' => $model->persatuan
                    , 'no_rujukan_fail' => $model->no_rujukan_fail
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-notis-kontrak-setiausaha-eksekutif-persatuan'
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'persatuan' => $model->persatuan
                    , 'no_rujukan_fail' => $model->no_rujukan_fail
                    , 'format' => $model->format
                ]);
            }
        } 

        return $this->render('notis_kontrak_setiausaha_eksekutif_persatuan', [
            'model' => $model,
            'readonly' => false,
        ]);
    }
    
    public function actionGenerateNotisKontrakSetiausahaEksekutifPersatuan($tarikh_dari, $tarikh_hingga, $persatuan, $no_rujukan_fail, $format)
    {
        if($tarikh_dari == "") $tarikh_dari = array();
        else $tarikh_dari = array($tarikh_dari);
        
        if($tarikh_hingga == "") $tarikh_hingga = array();
        else $tarikh_hingga = array($tarikh_hingga);
        
        if($persatuan == "") $persatuan = array();
        else $persatuan = array($persatuan);
        
        if($no_rujukan_fail == "") $no_rujukan_fail = array();
        else $no_rujukan_fail = array($no_rujukan_fail);
        
        $controls = array(
            'FROM_DATE' => $tarikh_dari,
            'TO_DATE' => $tarikh_hingga,
            'JAWATANKUASA' => $persatuan,
            'TEMASYA' => $no_rujukan_fail,
        );
        
        GeneralFunction::generateReport('/spsb/MSN/NotisKontrakSetiausahaEksekutifPersatuan', $format, $controls, 'notis_kontrak_setiausaha_eksekutif_persatuan');
    }
}
