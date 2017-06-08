<?php

namespace frontend\controllers;

use Yii;
use app\models\LtbsAhliGabungan;
use app\models\LtbsAhliGabunganSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use app\models\general\GeneralVariable;

use app\models\RefPeringkatBadanSukan;
use app\models\RefNegeri;
use app\models\RefBandar;
use app\models\ProfilBadanSukan;
use app\models\RefStatusLaporanMesyuaratAgung;

/**
 * LtbsAhliGabunganController implements the CRUD actions for LtbsAhliGabungan model.
 */
class LtbsAhliGabunganController extends Controller
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
     * Lists all LtbsAhliGabungan models.
     * @return mixed
     */
    public function actionIndex($profil_badan_sukan_id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $queryParams = Yii::$app->request->queryParams;
        
        if($profil_badan_sukan_id!=""){
            $queryParams['LtbsAhliGabunganSearch']['profil_badan_sukan_id'] = $profil_badan_sukan_id;
        }
        
        $searchModel = new LtbsAhliGabunganSearch();
        $dataProvider = $searchModel->search($queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'profil_badan_sukan_id' => $profil_badan_sukan_id,
        ]);
    }

    /**
     * Displays a single LtbsAhliGabungan model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        // get details
        $model = $this->findModel($id);
        
        // get dropdown value's descriptions
        $ref = RefPeringkatBadanSukan::findOne(['id' => $model->peringkat_badan_sukan]);
        $model->peringkat_badan_sukan = $ref['desc'];
        
        $ref = RefNegeri::findOne(['id' => $model->alamat_badan_sukan_negeri]);
        $model->alamat_badan_sukan_negeri = $ref['desc'];
        
        $ref = RefBandar::findOne(['id' => $model->alamat_badan_sukan_bandar]);
        $model->alamat_badan_sukan_bandar = $ref['desc'];
        
        $ref = RefStatusLaporanMesyuaratAgung::findOne(['id' => $model->status]);
        $model->status = $ref['desc'];
        
        $profil_badan_sukan_id = $model->profil_badan_sukan_id;
        $ref = ProfilBadanSukan::findOne(['profil_badan_sukan' => $model->profil_badan_sukan_id]);
        $model->profil_badan_sukan_id = $ref['nama_badan_sukan'];
        
        return $this->render('view', [
            'model' => $model,
            'readonly' => true,
            'profil_badan_sukan_id' => $profil_badan_sukan_id,
        ]);
    }

    /**
     * Creates a new LtbsAhliGabungan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($profil_badan_sukan_id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new LtbsAhliGabungan();
        
        if(Yii::$app->user->identity->profil_badan_sukan){
            $model->profil_badan_sukan_id = Yii::$app->user->identity->profil_badan_sukan;
            $model->status = RefStatusLaporanMesyuaratAgung::BELUM_DISAHKAN;
        } else if($profil_badan_sukan_id!=""){
            $model->profil_badan_sukan_id = $profil_badan_sukan_id;
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->ahli_gabungan_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'readonly' => false,
                'profil_badan_sukan_id' => $profil_badan_sukan_id,
            ]);
        }
    }

    /**
     * Updates an existing LtbsAhliGabungan model.
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
        
        $model->pengesahan = 0;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if(Yii::$app->user->identity->profil_badan_sukan){
                // set status to 'Belum Disahkan' if any changes made for persatuan
                $model->status = RefStatusLaporanMesyuaratAgung::BELUM_DISAHKAN;
            }
            
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->ahli_gabungan_id]);
            }
        } 
        
        return $this->render('update', [
                'model' => $model,
                'readonly' => false,
            ]);
    }

    /**
     * Deletes an existing LtbsAhliGabungan model.
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
     * Finds the LtbsAhliGabungan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return LtbsAhliGabungan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = LtbsAhliGabungan::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
	
	public function actionPrint($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }  
        $model = $this->findModel($id);
		
        // get dropdown value's descriptions
        $ref = RefPeringkatBadanSukan::findOne(['id' => $model->peringkat_badan_sukan]);
        $model->peringkat_badan_sukan = $ref['desc'];
        
        $ref = RefNegeri::findOne(['id' => $model->alamat_badan_sukan_negeri]);
        $model->alamat_badan_sukan_negeri = $ref['desc'];
        
        $ref = RefBandar::findOne(['id' => $model->alamat_badan_sukan_bandar]);
        $model->alamat_badan_sukan_bandar = $ref['desc'];
        
        $ref = RefStatusLaporanMesyuaratAgung::findOne(['id' => $model->status]);
        $model->status = $ref['desc'];
        
        $profil_badan_sukan_id = $model->profil_badan_sukan_id;
        $ref = ProfilBadanSukan::findOne(['profil_badan_sukan' => $model->profil_badan_sukan_id]);
        $model->profil_badan_sukan_id = $ref['nama_badan_sukan'];

        $pdf = new \mPDF('utf-8', 'A4');

        $pdf->title = 'Senarai Ahli Gabungan';

        $stylesheet = file_get_contents('css/report.css');

        $pdf->WriteHTML($stylesheet,1);
        
        $pdf->WriteHTML($this->renderpartial('print', [
             'model'  => $model,
		     'title' => $pdf->title,
        ]));

        $pdf->Output(str_replace(' ', '_', $pdf->title).'_'.$model->ahli_gabungan_id.'.pdf', 'I');
    }
}
