<?php

namespace frontend\controllers;

use Yii;
use app\models\AnugerahAhliJawantankuasaPengelola;
use frontend\models\AnugerahAhliJawantankuasaPengelolaSearch;
use app\models\AnugerahAhliJawantankuasaPengelolaItem;
use frontend\models\AnugerahAhliJawantankuasaPengelolaItemSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\BaseUrl;

use app\models\general\GeneralVariable;
use app\models\general\GeneralLabel;
use common\models\general\GeneralFunction;

// table reference
use app\models\RefAjk;
use app\models\RefBahagianAjk;
use app\models\MsnLaporanAnugerahPengelola;

/**
 * AnugerahAhliJawantankuasaPengelolaController implements the CRUD actions for AnugerahAhliJawantankuasaPengelola model.
 */
class AnugerahAhliJawantankuasaPengelolaController extends Controller
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
     * Lists all AnugerahAhliJawantankuasaPengelola models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AnugerahAhliJawantankuasaPengelolaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AnugerahAhliJawantankuasaPengelola model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        
        $ref = RefAjk::findOne(['id' => $model->ajk]);
        $model->ajk = $ref['desc'];
        
        $ref = RefBahagianAjk::findOne(['id' => $model->bahagian]);
        $model->bahagian = $ref['desc'];
        
        $queryPar = null;
        
        $queryPar['AnugerahAhliJawantankuasaPengelolaItemSearch']['anugerah_ahli_jawantankuasa_pengelola_id'] = $id;
        
        $searchModelAnugerahAhliJawantankuasaPengelolaItem  = new AnugerahAhliJawantankuasaPengelolaItemSearch();
        $dataProviderAnugerahAhliJawantankuasaPengelolaItem = $searchModelAnugerahAhliJawantankuasaPengelolaItem->search($queryPar);
        
        return $this->render('view', [
            'model' => $model,
            'readonly' => true,
            'searchModelAnugerahAhliJawantankuasaPengelolaItem' => $searchModelAnugerahAhliJawantankuasaPengelolaItem,
            'dataProviderAnugerahAhliJawantankuasaPengelolaItem' => $dataProviderAnugerahAhliJawantankuasaPengelolaItem,
        ]);
    }

    /**
     * Creates a new AnugerahAhliJawantankuasaPengelola model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AnugerahAhliJawantankuasaPengelola();
        
        $queryPar = null;
        
        Yii::$app->session->open();
        
        if(isset(Yii::$app->session->id)){
            $queryPar['AnugerahAhliJawantankuasaPengelolaItemSearch']['session_id'] = Yii::$app->session->id;
        }
        
        $searchModelAnugerahAhliJawantankuasaPengelolaItem  = new AnugerahAhliJawantankuasaPengelolaItemSearch();
        $dataProviderAnugerahAhliJawantankuasaPengelolaItem = $searchModelAnugerahAhliJawantankuasaPengelolaItem->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
			AnugerahAhliJawantankuasaPengelolaItem::updateAll(['anugerah_ahli_jawantankuasa_pengelola_id' => $model->anugerah_ahli_jawantankuasa_pengelola_id], 'session_id = "'.Yii::$app->session->id.'"');
            AnugerahAhliJawantankuasaPengelolaItem::updateAll(['session_id' => ''], 'anugerah_ahli_jawantankuasa_pengelola_id = "'.$model->anugerah_ahli_jawantankuasa_pengelola_id.'"');
			
            return $this->redirect(['view', 'id' => $model->anugerah_ahli_jawantankuasa_pengelola_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'readonly' => false,
                'searchModelAnugerahAhliJawantankuasaPengelolaItem' => $searchModelAnugerahAhliJawantankuasaPengelolaItem,
                'dataProviderAnugerahAhliJawantankuasaPengelolaItem' => $dataProviderAnugerahAhliJawantankuasaPengelolaItem,
            ]);
        }
    }

    /**
     * Updates an existing AnugerahAhliJawantankuasaPengelola model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $queryPar = null;
        
        $queryPar['AnugerahAhliJawantankuasaPengelolaItemSearch']['anugerah_ahli_jawantankuasa_pengelola_id'] = $id;
        
        $searchModelAnugerahAhliJawantankuasaPengelolaItem  = new AnugerahAhliJawantankuasaPengelolaItemSearch();
        $dataProviderAnugerahAhliJawantankuasaPengelolaItem = $searchModelAnugerahAhliJawantankuasaPengelolaItem->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->anugerah_ahli_jawantankuasa_pengelola_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'readonly' => false,
                'searchModelAnugerahAhliJawantankuasaPengelolaItem' => $searchModelAnugerahAhliJawantankuasaPengelolaItem,
                'dataProviderAnugerahAhliJawantankuasaPengelolaItem' => $dataProviderAnugerahAhliJawantankuasaPengelolaItem,
            ]);
        }
    }

    /**
     * Deletes an existing AnugerahAhliJawantankuasaPengelola model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id chmod(
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
    
    public function actionPrint($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $parentModel = $this->findModel($id);
        
        $model = new MsnLaporanAnugerahPengelola();
        $model->format = 'html';
        $model->pengelola_id = $parentModel->anugerah_ahli_jawantankuasa_pengelola_id;
        $model->tahun = $parentModel->tahun;

        if ($model->load(Yii::$app->request->post())) {
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-laporan-anugerah-ahli-jawatankuasa-pengelola'
                    , 'pengelola_id' => $model->pengelola_id
                    , 'tahun' => $model->tahun
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-laporan-anugerah-ahli-jawatankuasa-pengelola'
                    , 'pengelola_id' => $model->pengelola_id
                    , 'tahun' => $model->tahun
                    , 'format' => $model->format
                ]);
            }
        } 

        return $this->render('laporan_anugerah_pengelola', [
            'model' => $model,
            'readonly' => false,
        ]);
    }
    
    public function actionGenerateLaporanAnugerahAhliJawatankuasaPengelola($pengelola_id, $tahun, $format)
    {
        if($pengelola_id == "") $pengelola_id = array();
        else $pengelola_id = array($pengelola_id);
        
        if($tahun == "") $tahun = array();
        else $tahun = array($tahun);
        
        $controls = array(
            'PENGELOLA_ID' => $pengelola_id,
            'TAHUN' => $tahun,
        );
        
        GeneralFunction::generateReport('/spsb/MSN/LaporanAnugerahAhliJawatanKuasaPengelola', $format, $controls, 'laporan_anugerah_ahli_jawatan_kuasa_pengelola');
    }

    /**
     * Finds the AnugerahAhliJawantankuasaPengelola model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AnugerahAhliJawantankuasaPengelola the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AnugerahAhliJawantankuasaPengelola::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
