<?php

namespace frontend\controllers;

use Yii;
use app\models\BantuanPenganjuranKejohananSirkitOlehMsn;
use frontend\models\BantuanPenganjuranKejohananSirkitOlehMsnSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use app\models\general\GeneralLabel;
use common\models\general\GeneralFunction;

use app\models\RefPeringkatBantuanPenganjuranKejohananDianjurkan;

/**
 * BantuanPenganjuranKejohananSirkitOlehMsnController implements the CRUD actions for BantuanPenganjuranKejohananSirkitOlehMsn model.
 */
class BantuanPenganjuranKejohananSirkitOlehMsnController extends Controller
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
     * Lists all BantuanPenganjuranKejohananSirkitOlehMsn models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BantuanPenganjuranKejohananSirkitOlehMsnSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single BantuanPenganjuranKejohananSirkitOlehMsn model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        
        $ref = RefPeringkatBantuanPenganjuranKejohananDianjurkan::findOne(['id' => $model->peringkat_penganjuran]);
        $model->peringkat_penganjuran = $ref['desc'];
        
        $model->laporan_dikemukakan = GeneralLabel::getYesNoLabel($model->laporan_dikemukakan);
        
        if($model->tarikh_mula != "") {$model->tarikh_mula = GeneralFunction::convert($model->tarikh_mula, GeneralFunction::TYPE_DATE);}
        if($model->tarikh_tamat != "") {$model->tarikh_tamat = GeneralFunction::convert($model->tarikh_tamat, GeneralFunction::TYPE_DATE);}
        
        return $this->renderAjax('view', [
            'model' => $model,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new BantuanPenganjuranKejohananSirkitOlehMsn model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($bantuan_penganjuran_kejohanan_id)
    {
        $model = new BantuanPenganjuranKejohananSirkitOlehMsn();
        
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
     * Updates an existing BantuanPenganjuranKejohananSirkitOlehMsn model.
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
     * Deletes an existing BantuanPenganjuranKejohananSirkitOlehMsn model.
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
     * Finds the BantuanPenganjuranKejohananSirkitOlehMsn model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return BantuanPenganjuranKejohananSirkitOlehMsn the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = BantuanPenganjuranKejohananSirkitOlehMsn::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
