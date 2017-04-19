<?php

namespace frontend\controllers;

use Yii;
use app\models\BorangPenilaianKaunseling;
use frontend\models\BorangPenilaianKaunselingSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use app\models\general\GeneralVariable;

// table reference
use app\models\RefKategoriMasalahKaunseling;
use app\models\RefLatarbelakangKes;
use app\models\Atlet;
use app\models\Jurulatih;
use app\models\RefJenisKlien;

/**
 * BorangPenilaianKaunselingController implements the CRUD actions for BorangPenilaianKaunseling model.
 */
class BorangPenilaianKaunselingController extends Controller
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
     * Lists all BorangPenilaianKaunseling models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $searchModel = new BorangPenilaianKaunselingSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single BorangPenilaianKaunseling model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = $this->findModel($id);
		
		$jenisKlienID = $model->jenis_klien;
        
        $ref = Atlet::findOne(['atlet_id' => $model->atlet]);
        $model->atlet = $ref['nameAndIC'];
		
		$ref = Jurulatih::findOne(['jurulatih_id' => $model->jurulatih]);
        $model->jurulatih = $ref['nama'];
        
        $ref = RefLatarbelakangKes::findOne(['id' => $model->kategori_permasalahan]);
        $model->kategori_permasalahan = $ref['desc'];
		
		$ref = RefJenisKlien::findOne(['id' => $model->jenis_klien]);
        $model->jenis_klien = $ref['desc'];
		
        return $this->render('view', [
            'model' => $model,
            'readonly' => true,
			'jenisKlienID' => $jenisKlienID,
        ]);
    }

    /**
     * Creates a new BorangPenilaianKaunseling model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new BorangPenilaianKaunseling();
        
        $model->profil_konsultan_id =  Yii::$app->user->identity->id;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->borang_penilaian_kaunseling_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Updates an existing BorangPenilaianKaunseling model.
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
		$jenisKlienID = $model->jenis_klien;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->borang_penilaian_kaunseling_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'readonly' => false,
				'jenisKlienID' => $jenisKlienID,
            ]);
        }
    }

    /**
     * Deletes an existing BorangPenilaianKaunseling model.
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
     * Finds the BorangPenilaianKaunseling model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return BorangPenilaianKaunseling the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = BorangPenilaianKaunseling::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
