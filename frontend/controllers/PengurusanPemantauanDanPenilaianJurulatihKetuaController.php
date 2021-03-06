<?php

namespace frontend\controllers;

use Yii;
use app\models\PengurusanPemantauanDanPenilaianJurulatihKetua;
use frontend\models\PengurusanPemantauanDanPenilaianJurulatihKetuaSearch;
use app\models\PengurusanPenilaianKategoriJurulatihKetua;
use frontend\models\PengurusanPenilaianKategoriJurulatihKetuaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Session;

// contant values
use app\models\general\GeneralVariable;
use common\models\general\GeneralFunction;

// table reference
use app\models\Jurulatih;
use app\models\RefSukan;
use app\models\RefAcara;
use app\models\RefPenilaianJurulatihKetua;

/**
 * PengurusanPemantauanDanPenilaianJurulatihKetuaController implements the CRUD actions for PengurusanPemantauanDanPenilaianJurulatihKetua model.
 */
class PengurusanPemantauanDanPenilaianJurulatihKetuaController extends Controller
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
     * Lists all PengurusanPemantauanDanPenilaianJurulatihKetua models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $queryParams = Yii::$app->request->queryParams;
        
        if(isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-pemantauan-dan-penilaian-jurulatih']['kelulusan'])) {
            $queryParams['PengurusanPemantauanDanPenilaianJurulatihKetuaSearch']['hantar'] = 1;
        }
        
        $searchModel = new PengurusanPemantauanDanPenilaianJurulatihKetuaSearch();
        $dataProvider = $searchModel->search($queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PengurusanPemantauanDanPenilaianJurulatihKetua model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $session = new Session;
        $session->open();
        
        $session->remove('penilaian_oleh_ketua_id');
        
        $session->close();
        
        $model = $this->findModel($id);
        
        $ref = Jurulatih::findOne(['jurulatih_id' => $model->nama_jurulatih_dinilai]);
        $model->nama_jurulatih_dinilai = $ref['nameAndIC'];
        
        $ref = RefSukan::findOne(['id' => $model->nama_sukan]);
        $model->nama_sukan = $ref['desc'];
        
        $ref = RefAcara::findOne(['id' => $model->nama_acara]);
        $model->nama_acara = $ref['desc'];
        
        $model->penilaian_oleh_id = $model->penilaian_oleh;
        $ref = RefPenilaianJurulatihKetua::findOne(['id' => $model->penilaian_oleh]);
        $model->penilaian_oleh = $ref['desc'];
        
        if($model->tarikh_dinilai != "") {$model->tarikh_dinilai = GeneralFunction::convert($model->tarikh_dinilai, GeneralFunction::TYPE_DATE);}
        
        $queryPar = null;
        
        $queryPar['PengurusanPenilaianKategoriJurulatihKetuaSearch']['pengurusan_pemantauan_dan_penilaian_jurulatih_id'] = $id;
        
        $searchModelPengurusanPenilaianKategoriJurulatihKetua  = new PengurusanPenilaianKategoriJurulatihKetuaSearch();
        $dataProviderPengurusanPenilaianKategoriJurulatihKetua= $searchModelPengurusanPenilaianKategoriJurulatihKetua->search($queryPar);
        
        return $this->render('view', [
            'model' => $model,
            'searchModelPengurusanPenilaianKategoriJurulatihKetua' => $searchModelPengurusanPenilaianKategoriJurulatihKetua,
            'dataProviderPengurusanPenilaianKategoriJurulatihKetua' => $dataProviderPengurusanPenilaianKategoriJurulatihKetua,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new PengurusanPemantauanDanPenilaianJurulatihKetua model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new PengurusanPemantauanDanPenilaianJurulatihKetua();
        
        $model->tarikh_dinilai = date("Y-m-d");
        
        $queryPar = null;
        
        Yii::$app->session->open();
        
        if(isset(Yii::$app->session->id)){
            $queryPar['PengurusanPenilaianKategoriJurulatihKetuaSearch']['session_id'] = Yii::$app->session->id;
        }
        
        $searchModelPengurusanPenilaianKategoriJurulatihKetua  = new PengurusanPenilaianKategoriJurulatihKetuaSearch();
        $dataProviderPengurusanPenilaianKategoriJurulatihKetua= $searchModelPengurusanPenilaianKategoriJurulatihKetua->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if(isset(Yii::$app->session->id)){
                PengurusanPenilaianKategoriJurulatihKetua::updateAll(['pengurusan_pemantauan_dan_penilaian_jurulatih_id' => $model->pengurusan_pemantauan_dan_penilaian_jurulatih_id], 'session_id = "'.Yii::$app->session->id.'"');
                PengurusanPenilaianKategoriJurulatihKetua::updateAll(['session_id' => ''], 'pengurusan_pemantauan_dan_penilaian_jurulatih_id = "'.$model->pengurusan_pemantauan_dan_penilaian_jurulatih_id.'"');
            }
            
            return $this->redirect(['view', 'id' => $model->pengurusan_pemantauan_dan_penilaian_jurulatih_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'searchModelPengurusanPenilaianKategoriJurulatihKetua' => $searchModelPengurusanPenilaianKategoriJurulatihKetua,
                'dataProviderPengurusanPenilaianKategoriJurulatihKetua' => $dataProviderPengurusanPenilaianKategoriJurulatihKetua,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Updates an existing PengurusanPemantauanDanPenilaianJurulatihKetua model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $session = new Session;
        $session->open();
        
        $session->remove('penilaian_oleh_ketua_id');
        
        $session->close();
        
        $model = $this->findModel($id);
        
        $queryPar = null;
        
        $queryPar['PengurusanPenilaianKategoriJurulatihKetuaSearch']['pengurusan_pemantauan_dan_penilaian_jurulatih_id'] = $id;
        
        $searchModelPengurusanPenilaianKategoriJurulatihKetua  = new PengurusanPenilaianKategoriJurulatihKetuaSearch();
        $dataProviderPengurusanPenilaianKategoriJurulatihKetua= $searchModelPengurusanPenilaianKategoriJurulatihKetua->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->pengurusan_pemantauan_dan_penilaian_jurulatih_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'searchModelPengurusanPenilaianKategoriJurulatihKetua' => $searchModelPengurusanPenilaianKategoriJurulatihKetua,
                'dataProviderPengurusanPenilaianKategoriJurulatihKetua' => $dataProviderPengurusanPenilaianKategoriJurulatihKetua,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Deletes an existing PengurusanPemantauanDanPenilaianJurulatihKetua model.
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
     * Updates an existing Jurulatih model.
     * If approved is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionSent($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = $this->findModel($id);
        
        $model->hantar = 1; // set approved
        $model->tarikh_hantar = GeneralFunction::getCurrentTimestamp(); // set date time capture
        
        $model->save();
        
        //return $this->redirect(['view', 'id' => $model->jurulatih_id]);
        
        return $this->redirect(['index']);
    }

    /**
     * Finds the PengurusanPemantauanDanPenilaianJurulatihKetua model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PengurusanPemantauanDanPenilaianJurulatihKetua the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PengurusanPemantauanDanPenilaianJurulatihKetua::findOne($id)) !== null) {
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
		
        $ref = Jurulatih::findOne(['jurulatih_id' => $model->nama_jurulatih_dinilai]);
        $model->nama_jurulatih_dinilai = $ref['nameAndIC'];
        
        $ref = RefSukan::findOne(['id' => $model->nama_sukan]);
        $model->nama_sukan = $ref['desc'];
        
        $ref = RefAcara::findOne(['id' => $model->nama_acara]);
        $model->nama_acara = $ref['desc'];
        
        $model->penilaian_oleh_id = $model->penilaian_oleh;
        $ref = RefPenilaianJurulatihKetua::findOne(['id' => $model->penilaian_oleh]);
        $model->penilaian_oleh = $ref['desc'];
		
		$items = PengurusanPenilaianKategoriJurulatihKetua::find()->where(['pengurusan_pemantauan_dan_penilaian_jurulatih_id' => $model->pengurusan_pemantauan_dan_penilaian_jurulatih_id])->all();
		
		$pdf = new \mPDF('utf-8', 'A4');

        $pdf->title = 'Penilaian Ketua Jurulatih';

        $stylesheet = file_get_contents('css/report.css');

        $pdf->WriteHTML($stylesheet,1);
        
        $pdf->WriteHTML($this->renderpartial('print', [
             'model'  => $model,
			 'title' => $pdf->title,
			 'items' =>  $items,
        ]));

        $pdf->Output(str_replace(' ', '_', $pdf->title).'_'.$model->pengurusan_pemantauan_dan_penilaian_jurulatih_id.'.pdf', 'I'); 
	}
    
    public function actionSetPernilaianOleh($penilaian_oleh_ketua_id){
        
        $session = new Session;
        $session->open();

        $session['penilaian_oleh_ketua_id'] = $penilaian_oleh_ketua_id;
        
        $session->close();
    }
}
