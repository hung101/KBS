<?php

namespace frontend\controllers;

use Yii;
use app\models\LaporanPemantauanJurulatih;
use frontend\models\LaporanPemantauanJurulatihSearch;
use app\models\LaporanPemantauanJurulatihKategori;
use frontend\models\LaporanPemantauanJurulatihKategoriSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Session;

// contant values
use app\models\general\GeneralVariable;
use common\models\general\GeneralFunction;

// table reference
use app\models\Jurulatih;
use app\models\JurulatihSukan;
use app\models\RefSukan;
use app\models\RefProgramSemasaSukanAtlet;

/**
 * LaporanPemantauanJurulatihController implements the CRUD actions for LaporanPemantauanJurulatih model.
 */
class LaporanPemantauanJurulatihController extends Controller
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
     * Lists all LaporanPemantauanJurulatih models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $searchModel = new LaporanPemantauanJurulatihSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single LaporanPemantauanJurulatih model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = $this->findModel($id);
        
        $ref = Jurulatih::findOne(['jurulatih_id' => $model->jurulatih_id]);
        $model->jurulatih_id = $ref['nameAndIC'];
        
        $ref = RefSukan::findOne(['id' => $model->sukan_id]);
        $model->sukan_id = $ref['desc'];
        
        $ref = RefProgramSemasaSukanAtlet::findOne(['id' => $model->program_id]);
        $model->program_id = $ref['desc'];
        
        $queryPar = null;
        
        $queryPar['LaporanPemantauanJurulatihKategoriSearch']['laporan_pemantauan_jurulatih_id'] = $id;
        
        $searchModelLaporanPemantauanJurulatihKategori  = new LaporanPemantauanJurulatihKategoriSearch();
        $dataProviderLaporanPemantauanJurulatihKategori= $searchModelLaporanPemantauanJurulatihKategori->search($queryPar);
        
        return $this->render('view', [
            'model' => $model,
            'searchModelLaporanPemantauanJurulatihKategori' => $searchModelLaporanPemantauanJurulatihKategori,
            'dataProviderLaporanPemantauanJurulatihKategori' => $dataProviderLaporanPemantauanJurulatihKategori,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new LaporanPemantauanJurulatih model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id = null)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new LaporanPemantauanJurulatih();

        if($id != null){
            $jurulatihModel = Jurulatih::findOne($id);
            $model->jurulatih_id = $jurulatihModel->jurulatih_id;
            $model->pusat_latihan = $jurulatihModel->pusat_latihan;
            
            $jurulatihSukan = JurulatihSukan::find()->where(['tbl_jurulatih_sukan.jurulatih_id'=>$id])->joinWith(['refJurulatihAcara' => function($query) {
                        $query->orderBy(['tbl_jurulatih_sukan_acara.created' => SORT_DESC])->one();
                    },
            ])->orderBy(['tbl_jurulatih_sukan.created' => SORT_DESC])->one();
        
            $model->sukan_id = $jurulatihSukan->sukan;
            $model->program_id = $jurulatihSukan->program;
        }
        
        //var_dump($model->program_id); die;
        
        $queryPar = null;
        
         Yii::$app->session->open();
        
        if(isset(Yii::$app->session->id)){
            $queryPar['LaporanPemantauanJurulatihKategoriSearch']['session_id'] = Yii::$app->session->id;
        }
        
        $searchModelLaporanPemantauanJurulatihKategori = new LaporanPemantauanJurulatihKategoriSearch();
        $dataProviderLaporanPemantauanJurulatihKategori = $searchModelLaporanPemantauanJurulatihKategori->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if(isset(Yii::$app->session->id)){
                LaporanPemantauanJurulatihKategori::updateAll(['laporan_pemantauan_jurulatih_id' => $model->laporan_pemantauan_jurulatih_id], 'session_id = "'.Yii::$app->session->id.'"');
                LaporanPemantauanJurulatihKategori::updateAll(['session_id' => ''], 'laporan_pemantauan_jurulatih_id = "'.$model->laporan_pemantauan_jurulatih_id.'"');
            }
            
            return $this->redirect(['view', 'id' => $model->laporan_pemantauan_jurulatih_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'searchModelLaporanPemantauanJurulatihKategori' => $searchModelLaporanPemantauanJurulatihKategori,
                'dataProviderLaporanPemantauanJurulatihKategori' => $dataProviderLaporanPemantauanJurulatihKategori,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Updates an existing LaporanPemantauanJurulatih model.
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
        
        $queryPar = null;
        
        $queryPar['LaporanPemantauanJurulatihKategoriSearch']['laporan_pemantauan_jurulatih_id'] = $id;
        
        $searchModelLaporanPemantauanJurulatihKategori  = new LaporanPemantauanJurulatihKategoriSearch();
        $dataProviderLaporanPemantauanJurulatihKategori= $searchModelLaporanPemantauanJurulatihKategori->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->laporan_pemantauan_jurulatih_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'searchModelLaporanPemantauanJurulatihKategori' => $searchModelLaporanPemantauanJurulatihKategori,
                'dataProviderLaporanPemantauanJurulatihKategori' => $dataProviderLaporanPemantauanJurulatihKategori,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Deletes an existing LaporanPemantauanJurulatih model.
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
     * Finds the LaporanPemantauanJurulatih model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return LaporanPemantauanJurulatih the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = LaporanPemantauanJurulatih::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
