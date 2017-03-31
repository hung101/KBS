<?php

namespace frontend\controllers;

use Yii;
use app\models\PenyertaanSukan;
use app\models\PenyertaanSukanAcara;
use frontend\models\PenyertaanSukanAcaraSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;

use app\models\general\GeneralVariable;
use app\models\general\GeneralLabel;

// table reference
use app\models\RefAcara;
use app\models\Atlet;
use app\models\RefKeputusan;

/**
 * PenyertaanSukanAcaraController implements the CRUD actions for PenyertaanSukanAcara model.
 */
class PenyertaanSukanAcaraController extends Controller
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
     * Lists all PenyertaanSukanAcara models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $searchModel = new PenyertaanSukanAcaraSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PenyertaanSukanAcara model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = $this->findModel($id);
        
        $ref = RefAcara::findOne(['id' => $model->nama_acara]);
        $model->nama_acara = $ref['desc'];
        
        $ref = Atlet::findOne(['atlet_id' => $model->atlet]);
        $model->atlet = $ref['nameAndIC'];
        
        $ref = RefKeputusan::findOne(['id' => $model->keputusan]);
        $model->keputusan = $ref['desc'];
        
        $model->rekod_baru = GeneralLabel::getYesNoLabel($model->rekod_baru);
        
        return $this->renderAjax('view', [
            'model' => $model,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new PenyertaanSukanAcara model. actionDhy
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($penyertaan_sukan_id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new PenyertaanSukanAcara();
        
        Yii::$app->session->open();
        
        if($penyertaan_sukan_id != ''){
            $model->penyertaan_sukan_id = $penyertaan_sukan_id;
        } else {
            if(isset(Yii::$app->session->id)){
                $model->session_id = Yii::$app->session->id;
            }
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return '1';
        } else {
            return $this->renderAjax('create', [
                'model' => $model,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Updates an existing PenyertaanSukanAcara model.
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
            return '1';
        } else {
            return $this->renderAjax('update', [
                'model' => $model,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Deletes an existing PenyertaanSukanAcara model.
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

        //return $this->redirect(['index']);
    }

    public function actionGetAtletSukan($atlet_id, $kejohanan)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $penyertaanSukanIds = PenyertaanSukan::find()->select('penyertaan_sukan_id')->where(['nama_kejohanan_temasya' => $kejohanan]);
    
        $sukanAcara = PenyertaanSukanAcara::find()->joinWith('refAtlet')->where(['IN', 'penyertaan_sukan_id', $penyertaanSukanIds])
                      ->andWhere(['atlet' => $atlet_id])->orderBy(['created' => SORT_DESC])->all();
        if(count($sukanAcara) > 0){
            return ['nama_acara' => $sukanAcara[0]->nama_acara, 'keputusan' => $sukanAcara[0]->keputusan, 'sasaran' => $sukanAcara[0]->sasaran, 'catatan' => $sukanAcara[0]->catatan];
        } else {
            return [];
        }

    }
    
    /**
     * Finds the PenyertaanSukanAcara model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PenyertaanSukanAcara the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PenyertaanSukanAcara::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
