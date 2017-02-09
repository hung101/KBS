<?php

namespace frontend\controllers;

use Yii;
use app\models\PermohonanKemudahanTicketKapalTerbangSukan;
use frontend\models\PermohonanKemudahanTicketKapalTerbangSukanSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use app\models\RefSukan;

use app\models\general\GeneralVariable;

/**
 * PermohonanKemudahanTicketKapalTerbangSukanController implements the CRUD actions for PermohonanKemudahanTicketKapalTerbangSukan model.
 */
class PermohonanKemudahanTicketKapalTerbangSukanController extends Controller
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
     * Lists all PermohonanKemudahanTicketKapalTerbangSukan models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PermohonanKemudahanTicketKapalTerbangSukanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PermohonanKemudahanTicketKapalTerbangSukan model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = $this->findModel($id);
        
        $ref = RefSukan::findOne(['id' => $model->sukan]);
        $model->sukan = $ref['desc'];
        
        return $this->renderAjax('view', [
            'model' => $model,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new PermohonanKemudahanTicketKapalTerbangSukan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($permohonan_kemudahan_ticket_kapal_terbang_id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new PermohonanKemudahanTicketKapalTerbangSukan();
        
        Yii::$app->session->open();
        
        if($permohonan_kemudahan_ticket_kapal_terbang_id != ''){
            $model->permohonan_kemudahan_ticket_kapal_terbang_id = $permohonan_kemudahan_ticket_kapal_terbang_id;
        } else {
            if(isset(Yii::$app->session->id)){
                $model->session_id = Yii::$app->session->id;
            }
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //return $this->redirect(['view', 'id' => $model->permohonan_kemudahan_ticket_kapal_terbang_sukan_id]);
            return '1';
        } else {
            return $this->renderAjax('create', [
                'model' => $model,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Updates an existing PermohonanKemudahanTicketKapalTerbangSukan model.
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
            //return $this->redirect(['view', 'id' => $model->permohonan_kemudahan_ticket_kapal_terbang_sukan_id]);
            return '1';
        } else {
            return $this->renderAjax('update', [
                'model' => $model,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Deletes an existing PermohonanKemudahanTicketKapalTerbangSukan model.
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

    /**
     * Finds the PermohonanKemudahanTicketKapalTerbangSukan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PermohonanKemudahanTicketKapalTerbangSukan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PermohonanKemudahanTicketKapalTerbangSukan::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
