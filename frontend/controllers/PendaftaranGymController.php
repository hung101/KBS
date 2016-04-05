<?php

namespace frontend\controllers;

use Yii;
use app\models\PendaftaranGym;
use frontend\models\PendaftaranGymSearch;
use app\models\IsnLaporanGymJumlahAtlet;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\BaseUrl;

use app\models\general\GeneralVariable;
use common\models\general\GeneralFunction;

// table reference
use app\models\Atlet;
use app\models\RefSukan;

/**
 * PendaftaranGymController implements the CRUD actions for PendaftaranGym model.
 */
class PendaftaranGymController extends Controller
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
     * Lists all PendaftaranGym models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $searchModel = new PendaftaranGymSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PendaftaranGym model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = $this->findModel($id);
        
        //$ref = Atlet::findOne(['atlet_id' => $model->atlet_id]);
        //$model->atlet_id = $ref['nameAndIC'];
        
        // get list of Atlet Name & IC instead of atletid
        $AtletListID = explode(',', $model->atlet_id);
        $AtletListName = "";
        
        foreach($AtletListID as $AtletID){
            $ref = Atlet::findOne(['atlet_id' => $AtletID]);
            if($AtletListName != ""){
                $AtletListName .= ', ';
            }
            $AtletListName .= $ref['nameAndIC'];
        }
        
        $model->atlet_id = $AtletListName;
        
        $ref = RefSukan::findOne(['id' => $model->sukan]);
        $model->sukan = $ref['desc'];
        
        $model->tarikh = GeneralFunction::convert($model->tarikh, GeneralFunction::TYPE_DATETIME);
        
        return $this->render('view', [
            'model' => $model,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new PendaftaranGym model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new PendaftaranGym();
        
        $model->scenario = 'create';

        if ($model->load(Yii::$app->request->post())) {
            $model->jumlah_atlet = count($model->atlet_id);
            
            $model->atlet_id = implode(",",$model->atlet_id);
            
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->pendaftaran_gym_id]);
            }
        }
        
        return $this->render('create', [
                'model' => $model,
                'readonly' => false,
            ]);
    }

    /**
     * Updates an existing PendaftaranGym model.
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
            $model->jumlah_atlet = count($model->atlet_id);
            
            $model->atlet_id = implode(",",$model->atlet_id);
            
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->pendaftaran_gym_id]);
            }
        } 
        
        return $this->render('update', [
                'model' => $model,
                'readonly' => false,
            ]);
    }

    /**
     * Deletes an existing PendaftaranGym model.
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
     * Finds the PendaftaranGym model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PendaftaranGym the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PendaftaranGym::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionLaporanGymJumlahAtlet()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new IsnLaporanGymJumlahAtlet();
        $model->format = 'html';

        if ($model->load(Yii::$app->request->post())) {
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-laporan-gym-jumlah-atlet'
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-laporan-gym-jumlah-atlet'
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'format' => $model->format
                ]);
            }
        } 

        return $this->render('laporan_gym_jumlah_atlet', [
            'model' => $model,
            'readonly' => false,
        ]);
    }
    
    public function actionGenerateLaporanGymJumlahAtlet($tarikh_dari, $tarikh_hingga, $format)
    {
        if($tarikh_dari == "") $tarikh_dari = array();
        else $tarikh_dari = array($tarikh_dari);
        
        if($tarikh_hingga == "") $tarikh_hingga = array();
        else $tarikh_hingga = array($tarikh_hingga);
        
        $controls = array(
            'FROM_DATE' => $tarikh_dari,
            'TO_DATE' => $tarikh_hingga,
        );
        
        GeneralFunction::generateReport('/spsb/ISN/LaporanGymJumlahAtlet', $format, $controls, 'laporan_gym_jumlah_atlet');
    }
}
