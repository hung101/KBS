<?php

namespace frontend\controllers;

use Yii;
use app\models\BantuanPenganjuranKejohananOlehMsn;
use frontend\models\BantuanPenganjuranKejohananOlehMsnSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use app\models\general\GeneralLabel;

use app\models\RefPeringkatBantuanPenganjuranKejohananDianjurkan;

/**
 * BantuanPenganjuranKejohananOlehMsnController implements the CRUD actions for BantuanPenganjuranKejohananOlehMsn model.
 */
class BantuanPenganjuranKejohananOlehMsnController extends Controller
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
     * Lists all BantuanPenganjuranKejohananOlehMsn models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BantuanPenganjuranKejohananOlehMsnSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single BantuanPenganjuranKejohananOlehMsn model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        
        $ref = RefPeringkatBantuanPenganjuranKejohananDianjurkan::findOne(['id' => $model->peringkat_penganjuran]);
        $model->peringkat_penganjuran = $ref['desc'];
        
        $model->laporan_dikemukakan = GeneralLabel::getYesNoLabel($model->laporan_dikemukakan);
        
        return $this->renderAjax('view', [
            'model' => $model,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new BantuanPenganjuranKejohananOlehMsn model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($bantuan_penganjuran_kejohanan_id)
    {
        $model = new BantuanPenganjuranKejohananOlehMsn();
        
        Yii::$app->session->open();
        
        if($bantuan_penganjuran_kejohanan_id != ''){
            $model->bantuan_penganjuran_kejohanan_id = $bantuan_penganjuran_kejohanan_id;
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
     * Updates an existing BantuanPenganjuranKejohananOlehMsn model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
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
     * Deletes an existing BantuanPenganjuranKejohananOlehMsn model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        //return $this->redirect(['index']);
    }

    /**
     * Finds the BantuanPenganjuranKejohananOlehMsn model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return BantuanPenganjuranKejohananOlehMsn the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = BantuanPenganjuranKejohananOlehMsn::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
