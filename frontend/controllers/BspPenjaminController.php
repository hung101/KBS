<?php

namespace frontend\controllers;

use Yii;
use app\models\BspPenjamin;
use frontend\models\BspPenjaminSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use app\models\general\GeneralVariable;

use app\models\RefBandar;
use app\models\RefNegeri;

/**
 * BspPenjaminController implements the CRUD actions for BspPenjamin model.
 */
class BspPenjaminController extends Controller
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
     * Lists all BspPenjamin models.
     * @return mixed
     */
    public function actionIndex($bsp_pemohon_id)
    {
        if($bsp_pemohon_id != ""){
            if (Yii::$app->user->isGuest) {
                return $this->redirect(array(GeneralVariable::loginPagePath));
            }

            $queryPar = Yii::$app->request->queryParams;

            $queryPar['BspPenjaminSearch']['bsp_pemohon_id'] = $bsp_pemohon_id;

            $searchModel = new BspPenjaminSearch();
            $dataProvider = $searchModel->search($queryPar);

            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                'bsp_pemohon_id' => $bsp_pemohon_id,
            ]);
        }
    }

    /**
     * Displays a single BspPenjamin model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = $this->findModel($id);
        
        $ref = RefNegeri::findOne(['id' => $model->alamat_surat_menyurat_negeri]);
        $model->alamat_surat_menyurat_negeri = $ref['desc'];
        
        $ref = RefBandar::findOne(['id' => $model->alamat_surat_menyurat_bandar]);
        $model->alamat_surat_menyurat_bandar = $ref['desc'];
        
        $ref = RefNegeri::findOne(['id' => $model->alamat_pejabat_negeri]);
        $model->alamat_pejabat_negeri = $ref['desc'];
        
        $ref = RefBandar::findOne(['id' => $model->alamat_pejabat_bandar]);
        $model->alamat_pejabat_bandar = $ref['desc'];
        
        $ref = RefNegeri::findOne(['id' => $model->alamat_negeri]);
        $model->alamat_negeri = $ref['desc'];
        
        $ref = RefBandar::findOne(['id' => $model->alamat_bandar]);
        $model->alamat_bandar = $ref['desc'];
        
        return $this->render('view', [
            'model' => $model,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new BspPenjamin model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($bsp_pemohon_id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new BspPenjamin();
        
        $model->bsp_pemohon_id = $bsp_pemohon_id;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->bsp_penjamin_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'readonly' => false,
                'bsp_pemohon_id' => $bsp_pemohon_id,
            ]);
        }
    }

    /**
     * Updates an existing BspPenjamin model.
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
            return $this->redirect(['view', 'id' => $model->bsp_penjamin_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Deletes an existing BspPenjamin model.
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

        return $this->redirect(['index']);
    }

    /**
     * Finds the BspPenjamin model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return BspPenjamin the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = BspPenjamin::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
