<?php

namespace frontend\controllers;

use Yii;
use app\models\AnugerahAhliJawantankuasaPemilihan;
use frontend\models\AnugerahAhliJawantankuasaPemilihanSearch;
use app\models\AnugerahAhliJawantankuasaPemilihanItem;
use frontend\models\AnugerahAhliJawantankuasaPemilihanItemSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\BaseUrl;

use app\models\general\GeneralVariable;
use app\models\general\GeneralLabel;
use common\models\general\GeneralFunction;

use app\models\RefJawatanJawatankuasaPemilihan;
use app\models\RefPerwakilan;
use app\models\MsnLaporanAnugerahPemilihan;

/**
 * AnugerahAhliJawantankuasaPemilihanController implements the CRUD actions for AnugerahAhliJawantankuasaPemilihan model.
 */
class AnugerahAhliJawantankuasaPemilihanController extends Controller
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
     * Lists all AnugerahAhliJawantankuasaPemilihan models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AnugerahAhliJawantankuasaPemilihanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AnugerahAhliJawantankuasaPemilihan model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        
        $ref = RefJawatanJawatankuasaPemilihan::findOne(['id' => $model->jawatan]);
        $model->jawatan = $ref['desc'];
        
        $ref = RefPerwakilan::findOne(['id' => $model->perwakilan]);
        $model->perwakilan = $ref['desc'];
        
        $queryPar = null;
        
        $queryPar['AnugerahAhliJawantankuasaPemilihanItemSearch']['anugerah_ahli_jawantankuasa_pemilihan_id'] = $id;
        
        $searchModelAnugerahAhliJawantankuasaPemilihanItem  = new AnugerahAhliJawantankuasaPemilihanItemSearch();
        $dataProviderAnugerahAhliJawantankuasaPemilihanItem = $searchModelAnugerahAhliJawantankuasaPemilihanItem->search($queryPar);
        
        return $this->render('view', [
            'model' => $model,
            'readonly' => true,
            'searchModelAnugerahAhliJawantankuasaPemilihanItem' => $searchModelAnugerahAhliJawantankuasaPemilihanItem,
            'dataProviderAnugerahAhliJawantankuasaPemilihanItem' => $dataProviderAnugerahAhliJawantankuasaPemilihanItem,
        ]);
    }

    /**
     * Creates a new AnugerahAhliJawantankuasaPemilihan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AnugerahAhliJawantankuasaPemilihan();
        
        $queryPar = null;
        
        Yii::$app->session->open();
        
        if(isset(Yii::$app->session->id)){
            $queryPar['AnugerahAhliJawantankuasaPemilihanItemSearch']['session_id'] = Yii::$app->session->id;
        }
        
        $searchModelAnugerahAhliJawantankuasaPemilihanItem  = new AnugerahAhliJawantankuasaPemilihanItemSearch();
        $dataProviderAnugerahAhliJawantankuasaPemilihanItem = $searchModelAnugerahAhliJawantankuasaPemilihanItem->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            AnugerahAhliJawantankuasaPemilihanItem::updateAll(['anugerah_ahli_jawantankuasa_pemilihan_id' => $model->anugerah_ahli_jawantankuasa_pemilihan_id], 'session_id = "'.Yii::$app->session->id.'"');
            AnugerahAhliJawantankuasaPemilihanItem::updateAll(['session_id' => ''], 'anugerah_ahli_jawantankuasa_pemilihan_id = "'.$model->anugerah_ahli_jawantankuasa_pemilihan_id.'"');
            
            return $this->redirect(['view', 'id' => $model->anugerah_ahli_jawantankuasa_pemilihan_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'readonly' => false,
                'searchModelAnugerahAhliJawantankuasaPemilihanItem' => $searchModelAnugerahAhliJawantankuasaPemilihanItem,
                'dataProviderAnugerahAhliJawantankuasaPemilihanItem' => $dataProviderAnugerahAhliJawantankuasaPemilihanItem,
            ]);
        }
    }

    /**
     * Updates an existing AnugerahAhliJawantankuasaPemilihan model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $queryPar = null;
        
         $queryPar['AnugerahAhliJawantankuasaPemilihanItemSearch']['anugerah_ahli_jawantankuasa_pemilihan_id'] = $id;
         
        $searchModelAnugerahAhliJawantankuasaPemilihanItem  = new AnugerahAhliJawantankuasaPemilihanItemSearch();
        $dataProviderAnugerahAhliJawantankuasaPemilihanItem = $searchModelAnugerahAhliJawantankuasaPemilihanItem->search($queryPar);
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->anugerah_ahli_jawantankuasa_pemilihan_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'readonly' => false,
                'searchModelAnugerahAhliJawantankuasaPemilihanItem' => $searchModelAnugerahAhliJawantankuasaPemilihanItem,
                'dataProviderAnugerahAhliJawantankuasaPemilihanItem' => $dataProviderAnugerahAhliJawantankuasaPemilihanItem,
            ]);
        }
    }
    
    public function actionPrint($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $parentModel = $this->findModel($id);
        
        $model = new MsnLaporanAnugerahPemilihan();
        $model->format = 'html';
        $model->pemilihan_id = $parentModel->anugerah_ahli_jawantankuasa_pemilihan_id;
        $model->tahun = $parentModel->tahun;

        if ($model->load(Yii::$app->request->post())) {
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-laporan-anugerah-ahli-jawatankuasa-pemilihan'
                    , 'pemilihan_id' => $model->pemilihan_id
                    , 'tahun' => $model->tahun
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-laporan-anugerah-ahli-jawatankuasa-pemilihan'
                    , 'pemilihan_id' => $model->pemilihan_id
                    , 'tahun' => $model->tahun
                    , 'format' => $model->format
                ]);
            }
        } 

        return $this->render('laporan_anugerah_pemilihan', [
            'model' => $model,
            'readonly' => false,
        ]);
    }
    
    public function actionGenerateLaporanAnugerahAhliJawatankuasaPemilihan($pemilihan_id, $tahun, $format)
    {
        if($pemilihan_id == "") $pemilihan_id = array();
        else $pemilihan_id = array($pemilihan_id);
        
        if($tahun == "") $tahun = array();
        else $tahun = array($tahun);
        
        $controls = array(
            'PEMILIHAN_ID' => $pemilihan_id,
            'TAHUN' => $tahun,
        );
        
        GeneralFunction::generateReport('/spsb/MSN/LaporanAnugerahAhliJawatanKuasaPemilihan', $format, $controls, 'laporan_anugerah_ahli_jawatan_kuasa_pemilihan');
    }

    /**
     * Deletes an existing AnugerahAhliJawantankuasaPemilihan model.
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
     * Finds the AnugerahAhliJawantankuasaPemilihan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AnugerahAhliJawantankuasaPemilihan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AnugerahAhliJawantankuasaPemilihan::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
