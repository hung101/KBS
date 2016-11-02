<?php

namespace frontend\controllers;

use Yii;
use app\models\PermohonanKemudahanTicketKapalTerbang;
use frontend\models\PermohonanKemudahanTicketKapalTerbangSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

// table reference
use app\models\Jurulatih;
use app\models\Atlet;
use app\models\RefProgram;
use app\models\RefSukan;
use app\models\RefBahagianKemudahan;
use app\models\RefCawanganKemudahan;
use app\models\RefStatusPermohonanKemudahan;

// contant values
use app\models\general\GeneralLabel;

/**
 * PermohonanKemudahanTicketKapalTerbangController implements the CRUD actions for PermohonanKemudahanTicketKapalTerbang model.
 */
class PermohonanKemudahanTicketKapalTerbangController extends Controller
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
     * Lists all PermohonanKemudahanTicketKapalTerbang models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PermohonanKemudahanTicketKapalTerbangSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PermohonanKemudahanTicketKapalTerbang model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        
        //$ref = Atlet::findOne(['atlet_id' => $model->atlet]);
        //$model->atlet = $ref['nameAndIC'];
        
        //$ref = Jurulatih::findOne(['jurulatih_id' => $model->jurulatih]);
        //$model->jurulatih = $ref['nameAndIC'];
        
        $ref = RefProgram::findOne(['id' => $model->nama_program]);
        $model->nama_program = $ref['desc'];
        
        //$ref = RefSukan::findOne(['id' => $model->sukan]);
        //$model->sukan = $ref['desc'];
        
        $ref = RefBahagianKemudahan::findOne(['id' => $model->bahagian]);
        $model->bahagian = $ref['desc'];
        
        $ref = RefCawanganKemudahan::findOne(['id' => $model->cawangan]);
        $model->cawangan = $ref['desc'];
        
        $ref = RefStatusPermohonanKemudahan::findOne(['id' => $model->kelulusan]);
        $model->kelulusan = $ref['desc'];
        
        /*$YesNo = GeneralLabel::getYesNoLabel($model->kelulusan);
        $model->kelulusan = $YesNo;*/
        
        return $this->render('view', [
            'model' => $model,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new PermohonanKemudahanTicketKapalTerbang model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new PermohonanKemudahanTicketKapalTerbang();
        
        $model->kelulusan = RefStatusPermohonanKemudahan::SEDANG_DIPROSES;
        
        if ($model->load(Yii::$app->request->post())) {
            if($model->jurulatih){
                $model->jurulatih = implode(",",$model->jurulatih);
            }
            
            if($model->atlet){
                $model->atlet = implode(",",$model->atlet);
            }
            
            if($model->sukan){
                $model->sukan = implode(",",$model->sukan);
            }
        }

        if (Yii::$app->request->post() && $model->save()) {
            return $this->redirect(['view', 'id' => $model->permohonan_kemudahan_ticket_kapal_terbang_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Updates an existing PermohonanKemudahanTicketKapalTerbang model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        
        if ($model->load(Yii::$app->request->post())) {
            if($model->jurulatih){
                $model->jurulatih = implode(",",$model->jurulatih);
            }
            
            if($model->atlet){
                $model->atlet = implode(",",$model->atlet);
            }
            
            if($model->sukan){
                $model->sukan = implode(",",$model->sukan);
            }
        }

        if (Yii::$app->request->post() && $model->save()) {
            return $this->redirect(['view', 'id' => $model->permohonan_kemudahan_ticket_kapal_terbang_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Deletes an existing PermohonanKemudahanTicketKapalTerbang model.
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
     * Finds the PermohonanKemudahanTicketKapalTerbang model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PermohonanKemudahanTicketKapalTerbang the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PermohonanKemudahanTicketKapalTerbang::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
