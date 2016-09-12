<?php

namespace frontend\controllers;

use Yii;
use app\models\Inventori;
use frontend\models\InventoriSearch;
use app\models\InventoriPeralatan;
use frontend\models\InventoriPeralatanSearch;
use app\models\MsnLaporanInventori;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\BaseUrl;

// table reference
use app\models\RefProgramSemasaSukanAtlet;
use app\models\RefSukan;
use app\models\RefNegeri;
use app\models\RefBandar;

use common\models\general\GeneralFunction;

/**
 * InventoriController implements the CRUD actions for Inventori model.
 */
class InventoriController extends Controller
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
     * Lists all Inventori models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new InventoriSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Inventori model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        
        $ref = RefProgramSemasaSukanAtlet::findOne(['id' => $model->program]);
        $model->program = $ref['desc'];
        
        $ref = RefSukan::findOne(['id' => $model->sukan]);
        $model->sukan = $ref['desc'];
        
        $ref = RefNegeri::findOne(['id' => $model->alamat_pembekal_negeri]);
        $model->alamat_pembekal_negeri = $ref['desc'];
        
        $ref = RefBandar::findOne(['id' => $model->alamat_pembekal_bandar]);
        $model->alamat_pembekal_bandar = $ref['desc'];
        
        $ref = RefNegeri::findOne(['id' => $model->negeri]);
        $model->negeri = $ref['desc'];
        
        $queryPar = null;
        
        $queryPar['InventoriPeralatanSearch']['inventori_id'] = $id;
        
        $searchModelInventoriPeralatan = new InventoriPeralatanSearch();
        $dataProviderInventoriPeralatan = $searchModelInventoriPeralatan->search($queryPar);
        
        return $this->render('view', [
            'model' => $model,
            'searchModelInventoriPeralatan' => $searchModelInventoriPeralatan,
            'dataProviderInventoriPeralatan' => $dataProviderInventoriPeralatan,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new Inventori model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Inventori();
        
        $queryPar = null;
        
        Yii::$app->session->open();
        
        if(isset(Yii::$app->session->id)){
            $queryPar['InventoriPeralatanSearch']['session_id'] = Yii::$app->session->id;
        }
        
        $searchModelInventoriPeralatan = new InventoriPeralatanSearch();
        $dataProviderInventoriPeralatan = $searchModelInventoriPeralatan->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            // update all the temporary session id with Pertukaran Program Pengajian Dokumen/Sebab
            if(isset(Yii::$app->session->id)){
                InventoriPeralatan::updateAll(['inventori_id' => $model->inventori_id], 'session_id = "'.Yii::$app->session->id.'"');
                InventoriPeralatan::updateAll(['session_id' => ''], 'inventori_id = "'.$model->inventori_id.'"');
                
            }
            
            return $this->redirect(['view', 'id' => $model->inventori_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'searchModelInventoriPeralatan' => $searchModelInventoriPeralatan,
                'dataProviderInventoriPeralatan' => $dataProviderInventoriPeralatan,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Updates an existing Inventori model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        
        $queryPar = null;
        
        $queryPar['InventoriPeralatanSearch']['inventori_id'] = $id;
        
        $searchModelInventoriPeralatan = new InventoriPeralatanSearch();
        $dataProviderInventoriPeralatan = $searchModelInventoriPeralatan->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->inventori_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'searchModelInventoriPeralatan' => $searchModelInventoriPeralatan,
                'dataProviderInventoriPeralatan' => $dataProviderInventoriPeralatan,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Deletes an existing Inventori model.
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
     * Finds the Inventori model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Inventori the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Inventori::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionLaporanInventori()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new MsnLaporanInventori();
        $model->format = 'html';

        if ($model->load(Yii::$app->request->post())) {
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-laporan-inventori'
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'program' => $model->program
                    , 'sukan' => $model->sukan
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-laporan-inventori'
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'program' => $model->program
                    , 'sukan' => $model->sukan
                    , 'format' => $model->format
                ]);
            }
        } 

        return $this->render('laporan_inventori', [
            'model' => $model,
            'readonly' => false,
        ]);
    }
    
    public function actionGenerateLaporanInventori($tarikh_dari, $tarikh_hingga, $program, $sukan, $format)
    {
        if($program == "") $program = array();
        else $program = array($program);
        
        if($sukan == "") $sukan = array();
        else $sukan = array($sukan);
        
        if($tarikh_dari == "") $tarikh_dari = array();
        else $tarikh_dari = array($tarikh_dari);
        
        if($tarikh_hingga == "") $tarikh_hingga = array();
        else $tarikh_hingga = array($tarikh_hingga);
        
        $controls = array(
            'FROM_DATE' => $tarikh_dari,
            'PROGRAM' => $program,
            'SUKAN' => $sukan,
            'TO_DATE' => $tarikh_hingga,
        );
        
        GeneralFunction::generateReport('/spsb/MSN/LaporanInventori', $format, $controls, 'laporan_inventori');
    }
}
