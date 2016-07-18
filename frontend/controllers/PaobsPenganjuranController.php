<?php

namespace frontend\controllers;

use Yii;
use app\models\PaobsPenganjuran;
use app\models\PaobsPenganjuranSearch;
use app\models\PaobsPenganjuranSumberKewangan;
use frontend\models\PaobsPenganjuranSumberKewanganSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

use app\models\general\Upload;
use app\models\general\GeneralVariable;
use common\models\general\GeneralFunction;

// table reference
use app\models\RefSukan;
use app\models\RefNegeri;
use app\models\RefBandar;
use app\models\RefPeringkatBadanSukan;

// eddie (jasper)
use Jaspersoft\Client\Client;

/**
 * PaobsPenganjuranController implements the CRUD actions for PaobsPenganjuran model.
 */
class PaobsPenganjuranController extends Controller
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
     * Lists all PaobsPenganjuran models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $searchModel = new PaobsPenganjuranSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    // eddie (jasper) start

    public function actionReport()
    {

        $c = new Client(
            Yii::$app->params['jasperurl'],
            Yii::$app->params['jasperuser'],
            Yii::$app->params['jasperpass']
        );
        
        $controls = array(
            'NEGERI' =>array('5') 
        );

        //$report = $c->reportService()->runReport('/spsb/kbs/e_laporan/laporan_perlaksaan_program', 'html', null, null, $controls);
        
        $report_format = 'pdf'; // Edward e.g pdf, xls, csv, docx, rtf, odt, ods, xlsx, pptx

        $report = $c->reportService()->runReport('/spsb/kbs/e_laporan/laporan_perlaksaan_program', $report_format, null, null, $controls);
        
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Description: File Transfer');
        header('Content-Disposition: attachment; filename=laporan_perlaksaan_program.' . $report_format);
        header('Content-Transfer-Encoding: binary');
        header('Content-Length: ' . strlen($report));
        header('Content-Type: application/'.$report_format);

        echo $report;
    }

    // eddie (jasper) end

    /**
     * Displays a single PaobsPenganjuran model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = $this->findModel($id);
        
        $ref = RefSukan::findOne(['id' => $model->jenis_sukan]);
        $model->jenis_sukan = $ref['desc'];
        
        $ref = RefNegeri::findOne(['id' => $model->alamat_lokasi_negeri]);
        $model->alamat_lokasi_negeri = $ref['desc'];
        
        $ref = RefBandar::findOne(['id' => $model->alamat_lokasi_bandar]);
        $model->alamat_lokasi_bandar = $ref['desc'];
        
        $ref = RefPeringkatBadanSukan::findOne(['id' => $model->peringkat_sukan]);
        $model->peringkat_sukan = $ref['desc'];
        
        $model->tarikh_aktiviti = GeneralFunction::convert($model->tarikh_aktiviti);
        
        $model->tarikh_tamat_aktiviti = GeneralFunction::convert($model->tarikh_tamat_aktiviti);
        
        $queryPar = null;
        
        $queryPar['PaobsPenganjuranSumberKewanganSearch']['penganjuran_id'] = $id;
        
        $searchModelPaobsPenganjuranSumberKewangan  = new PaobsPenganjuranSumberKewanganSearch();
        $dataProviderPaobsPenganjuranSumberKewangan = $searchModelPaobsPenganjuranSumberKewangan->search($queryPar);
        
        return $this->render('view', [
            'model' => $model,
            'readonly' => true,
            'searchModelPaobsPenganjuranSumberKewangan' => $searchModelPaobsPenganjuranSumberKewangan,
            'dataProviderPaobsPenganjuranSumberKewangan' => $dataProviderPaobsPenganjuranSumberKewangan,
        ]);
    }

    /**
     * Creates a new PaobsPenganjuran model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new PaobsPenganjuran();
        
        $queryPar = null;
        
        Yii::$app->session->open();
        
        if(isset(Yii::$app->session->id)){
            $queryPar['PaobsPenganjuranSumberKewanganSearch']['session_id'] = Yii::$app->session->id;
        }
        
        $searchModelPaobsPenganjuranSumberKewangan  = new PaobsPenganjuranSumberKewanganSearch();
        $dataProviderPaobsPenganjuranSumberKewangan = $searchModelPaobsPenganjuranSumberKewangan->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $file = UploadedFile::getInstance($model, 'surat_sokongan');
            if($file){
                $model->surat_sokongan = Upload::uploadFile($file, Upload::paobsPenganjuranFolder, 'surat_sokongan_' . $model->penganjuran_id);
            }
            
            $file = UploadedFile::getInstance($model, 'laporan_penganjuran');
            if($file){
                $model->laporan_penganjuran = Upload::uploadFile($file, Upload::paobsPenganjuranFolder, 'laporan_penganjuran_' . $model->penganjuran_id);
            }
            
            if(isset(Yii::$app->session->id)){
                PaobsPenganjuranSumberKewangan::updateAll(['penganjuran_id' => $model->penganjuran_id], 'session_id = "'.Yii::$app->session->id.'"');
                PaobsPenganjuranSumberKewangan::updateAll(['session_id' => ''], 'penganjuran_id = "'.$model->penganjuran_id.'"');
            }
            
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->penganjuran_id]);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
                'readonly' => false,
                'searchModelPaobsPenganjuranSumberKewangan' => $searchModelPaobsPenganjuranSumberKewangan,
                'dataProviderPaobsPenganjuranSumberKewangan' => $dataProviderPaobsPenganjuranSumberKewangan,
            ]);
        }
    }

    /**
     * Updates an existing PaobsPenganjuran model.
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
        
        $queryPar['PaobsPenganjuranSumberKewanganSearch']['penganjuran_id'] = $id;
        
        $searchModelPaobsPenganjuranSumberKewangan  = new PaobsPenganjuranSumberKewanganSearch();
        $dataProviderPaobsPenganjuranSumberKewangan = $searchModelPaobsPenganjuranSumberKewangan->search($queryPar);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $file = UploadedFile::getInstance($model, 'surat_sokongan');
            if($file){
                $model->surat_sokongan = Upload::uploadFile($file, Upload::paobsPenganjuranFolder, 'surat_sokongan_' . $model->penganjuran_id);
            }
            
            $file = UploadedFile::getInstance($model, 'laporan_penganjuran');
            if($file){
                $model->laporan_penganjuran = Upload::uploadFile($file, Upload::paobsPenganjuranFolder, 'laporan_penganjuran_' . $model->penganjuran_id);
            }
            
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->penganjuran_id]);
            }
        }
        
        return $this->render('update', [
                'model' => $model,
                'readonly' => false,
                'searchModelPaobsPenganjuranSumberKewangan' => $searchModelPaobsPenganjuranSumberKewangan,
                'dataProviderPaobsPenganjuranSumberKewangan' => $dataProviderPaobsPenganjuranSumberKewangan,
            ]);
    }

    /**
     * Deletes an existing PaobsPenganjuran model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        // delete upload file
        self::actionDeleteupload($id, 'surat_sokongan');
        
        // delete upload file
        self::actionDeleteupload($id, 'laporan_penganjuran');
        
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the PaobsPenganjuran model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PaobsPenganjuran the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PaobsPenganjuran::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    // Add function for delete image or file
    public function actionDeleteupload($id, $field)
    {
            $img = $this->findModel($id)->$field;
            
            if($img){
                if (!unlink($img)) {
                    return false;
                }
            }

            $img = $this->findModel($id);
            $img->$field = NULL;
            $img->update();

            return $this->redirect(['update', 'id' => $id]);
    }
}
