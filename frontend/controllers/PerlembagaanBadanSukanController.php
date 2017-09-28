<?php

namespace frontend\controllers;

use Yii;
use app\models\PerlembagaanBadanSukan;
use app\models\PerlembagaanBadanSukanSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

use app\models\general\Upload;
use app\models\general\GeneralVariable;
use common\models\general\GeneralFunction;

use app\models\RefStatusLaporanMesyuaratAgung;
use app\models\ProfilBadanSukan;
use app\models\User;
/**
 * PerlembagaanBadanSukanController implements the CRUD actions for PerlembagaanBadanSukan model.
 */
class PerlembagaanBadanSukanController extends Controller
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
     * Lists all PerlembagaanBadanSukan models.
     * @return mixed
     */
    public function actionIndex($profil_badan_sukan_id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $queryParams = Yii::$app->request->queryParams;
        
        if($profil_badan_sukan_id!=""){
            $queryParams['PerlembagaanBadanSukanSearch']['profil_badan_sukan_id'] = $profil_badan_sukan_id;
        }
        
        $searchModel = new PerlembagaanBadanSukanSearch();
        $dataProvider = $searchModel->search($queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'profil_badan_sukan_id' => $profil_badan_sukan_id,
        ]);
    }

    /**
     * Displays a single PerlembagaanBadanSukan model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = $this->findModel($id);
        
        $profil_badan_sukan_id = $model->profil_badan_sukan_id;
        
        $ref = RefStatusLaporanMesyuaratAgung::findOne(['id' => $model->status]);
        $model->status = $ref['desc'];
        
        $model->tarikh_kelulusan = GeneralFunction::convert($model->tarikh_kelulusan);
        
        return $this->render('view', [
            'model' => $model,
            'readonly' => true,
            'profil_badan_sukan_id' => $profil_badan_sukan_id,
        ]);
    }

    /**
     * Creates a new PerlembagaanBadanSukan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($profil_badan_sukan_id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new PerlembagaanBadanSukan();
        
        if(Yii::$app->user->identity->profil_badan_sukan){
            $model->profil_badan_sukan_id = Yii::$app->user->identity->profil_badan_sukan;
            $model->status = RefStatusLaporanMesyuaratAgung::BELUM_DISAHKAN;
        } else if($profil_badan_sukan_id!=""){
            $model->profil_badan_sukan_id = $profil_badan_sukan_id;
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $file = UploadedFile::getInstance($model, 'muat_naik');
            if($file){
                $model->muat_naik = Upload::uploadFile($file, Upload::perlembagaanBadanSukanFolder, $model->perlembagaan_badan_sukan_id);
            }
            
            if($model->save()){
                if (($modelUsers = User::find()->joinWith('refUserPeranan')->andFilterWhere(['like', 'tbl_user_peranan.peranan_akses', 'pemberitahuan_emel_perlembagaan-badan-sukan'])->groupBy('id')->all()) !== null) {
                    $ref = ProfilBadanSukan::findOne(['profil_badan_sukan' => $model->profil_badan_sukan_id]);
                    
                    foreach($modelUsers as $modelUser){

                        if($modelUser->email && $modelUser->email != ""){
                            //echo "E-mail: " . $modelUser->email . "\n";
                            Yii::$app->mailer->compose()
                            ->setTo($modelUser->email)
                            ->setFrom('noreply@spsb.com')
                            ->setSubject('Pemberitahuan - Perlembagaan Badan Sukan')
                            ->setHtmlBody('Salam '.$modelUser->full_name.',
    <br><br>
    Terdapat permohonan pengesahan maklumat untuk semakan dan tindakan pihak tuan/puan. Sila semak sistem SPSB bagi tindakan seterusnya 
    <br><br>
    Sekian, terima kasih.
        ')->send();
                        }
                    }
                }
                
                $refBadanSukan = ProfilBadanSukan::findOne(['profil_badan_sukan' => $model->profil_badan_sukan_id]);
                
                if(isset($refBadanSukan['emel_badan_sukan']) && $refBadanSukan['emel_badan_sukan'] != ""){

                        try {
                            if(isset($refBadanSukan['emel_badan_sukan']) && $refBadanSukan['emel_badan_sukan'] != ''){
                                Yii::$app->mailer->compose()
                                        ->setTo($refBadanSukan['emel_badan_sukan'])
                                                                    ->setFrom('noreply@spsb.com')
                                        ->setSubject('Perlembagaan Badan Sukan Tuan/Puan Sedang Diproses')
                                        ->setHtmlBody('Salam '.$refBadanSukan['nama_badan_sukan'].',
    <br><br>
    Terima kasih atas maklumat yang telah dihantar oleh pihak anda. Permohonan anda kini sedang diproses bagi tujuan pengesahan.
    <br><br>
    Sekian, terima kasih.
                                ')->send();
                            }
                        }
                        catch(\Swift_SwiftException $exception)
                        {
                            //return 'Can sent mail due to the following exception'.print_r($exception);
                            Yii::$app->session->setFlash('error', 'Terdapat ralat menghantar e-mel.');
                        }
                }
                
                
                return $this->redirect(['view', 'id' => $model->perlembagaan_badan_sukan_id]);
            }
        }
        
        return $this->render('create', [
                'model' => $model,
                'readonly' => false,
                'profil_badan_sukan_id' => $profil_badan_sukan_id,
            ]);
    }

    /**
     * Updates an existing PerlembagaanBadanSukan model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        
        $model->pengesahan = 0;
        
        $oldStatus = null;
        
        if($model->load(Yii::$app->request->post())){
            $oldStatus = $model->getOldAttribute('status');
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $file = UploadedFile::getInstance($model, 'muat_naik');
            if($file){
                $model->muat_naik = Upload::uploadFile($file, Upload::perlembagaanBadanSukanFolder, $model->perlembagaan_badan_sukan_id);
            }
            
            if(Yii::$app->user->identity->profil_badan_sukan){
                // set status to 'Belum Disahkan' if any changes made for persatuan
                $model->status = RefStatusLaporanMesyuaratAgung::BELUM_DISAHKAN;
            }
            
            if($model->save()){
                
                $refBadanSukan = ProfilBadanSukan::findOne(['profil_badan_sukan' => $model->profil_badan_sukan_id]);
                
                if(isset($refBadanSukan['emel_badan_sukan']) && $refBadanSukan['emel_badan_sukan'] != "" && $model->status ){
                    if($model->status != $oldStatus && $model->status == RefStatusLaporanMesyuaratAgung::DISAHKAN){
                        $ref = RefStatusLaporanMesyuaratAgung::findOne(['id' => $model->status]);
                        $status_desc = $ref['desc'];

                        try {
                            if(isset($refBadanSukan['emel_badan_sukan']) && $refBadanSukan['emel_badan_sukan'] != ''){
                                Yii::$app->mailer->compose()
                                        ->setTo($refBadanSukan['emel_badan_sukan'])
                                                                    ->setFrom('noreply@spsb.com')
                                        ->setSubject('Perlembagaan Badan Sukan Tuan/Puan Telah Diproses')
                                        ->setHtmlBody('Salam '.$refBadanSukan['nama_badan_sukan'].',
    <br><br>
    Maklumat yang telah dihantar oleh pihak anda telah disahkan. Kemas kini maklumat boleh dibuat dari masa ke masa.
    <br><br>
    Sekian, terima kasih.
                                ')->send();
                            }
                        }
                        catch(\Swift_SwiftException $exception)
                        {
                            //return 'Can sent mail due to the following exception'.print_r($exception);
                            Yii::$app->session->setFlash('error', 'Terdapat ralat menghantar e-mel.');
                        }
                    }
                }
                
                if ($model->status == $oldStatus && ($modelUsers = User::find()->joinWith('refUserPeranan')->andFilterWhere(['like', 'tbl_user_peranan.peranan_akses', 'pemberitahuan_emel_perlembagaan-badan-sukan'])->groupBy('id')->all()) !== null) {
                    $ref = ProfilBadanSukan::findOne(['profil_badan_sukan' => $model->profil_badan_sukan_id]);
                    
                    foreach($modelUsers as $modelUser){

                        if($modelUser->email && $modelUser->email != ""){
                            //echo "E-mail: " . $modelUser->email . "\n";
                            Yii::$app->mailer->compose()
                            ->setTo($modelUser->email)
                            ->setFrom('noreply@spsb.com')
                            ->setSubject('Pemberitahuan - Perlembagaan Badan Sukan')
                            ->setHtmlBody('Salam '.$modelUser->full_name.',
    <br><br>
    Terdapat permohonan pengesahan maklumat untuk semakan dan tindakan pihak tuan/puan. Sila semak sistem SPSB bagi tindakan seterusnya 
    <br><br>
    Sekian, terima kasih.
        ')->send();
                        }
                    }
                }
            
                return $this->redirect(['view', 'id' => $model->perlembagaan_badan_sukan_id]);
            }
        } 
        
        return $this->render('update', [
                'model' => $model,
                'readonly' => false,
            ]);
    }

    /**
     * Deletes an existing PerlembagaanBadanSukan model.
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
        self::actionDeleteupload($id, 'muat_naik');
        
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the PerlembagaanBadanSukan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PerlembagaanBadanSukan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PerlembagaanBadanSukan::findOne($id)) !== null) {
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
/*                 if (!unlink($img)) {
                    return false;
                } */
				@unlink($img);
            }

            $img = $this->findModel($id);
            $img->$field = NULL;
            $img->update();

            return $this->redirect(['update', 'id' => $id]);
    }
	
	public function actionPrint($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }  
        $model = $this->findModel($id);
		
		$profil_badan_sukan_id = $model->profil_badan_sukan_id;
		$ref = ProfilBadanSukan::findOne(['profil_badan_sukan' => $model->profil_badan_sukan_id]);
        $model->profil_badan_sukan_id = $ref['nama_badan_sukan'];
        
        $ref = RefStatusLaporanMesyuaratAgung::findOne(['id' => $model->status]);
        $model->status = $ref['desc'];
        
        $model->tarikh_kelulusan = GeneralFunction::convert($model->tarikh_kelulusan);

        $pdf = new \mPDF('utf-8', 'A4');

        $pdf->title = 'Perlembagaan Badan Sukan';

        $stylesheet = file_get_contents('css/report.css');

        $pdf->WriteHTML($stylesheet,1);
        
        $pdf->WriteHTML($this->renderpartial('print', [
             'model'  => $model,
		     'title' => $pdf->title,
        ]));

        $pdf->Output(str_replace(' ', '_', $pdf->title).'_'.$model->perlembagaan_badan_sukan_id.'.pdf', 'I');
    }
}
