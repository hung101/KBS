<?php

namespace frontend\controllers;

use Yii;
use app\models\Atlet;
use app\models\AtletSearch;
use app\models\MsnLaporanSenaraiAtlet;
use app\models\MsnLaporanStatistikAtlet;
use app\models\MsnSuratTawaranAtlet;
use app\models\MsnLaporanAtletPencapaianPrestasiSecaraIndividu;
use app\models\User;
use app\models\AtletPrintForm;
use frontend\models\UserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;
use yii\filters\VerbFilter;
use yii\web\Session;
use yii\helpers\BaseUrl;
use yii\helpers\Json;
use yii\helpers\Url;
use kartik\helpers\Html;

// table reference
use app\models\RefJantina;
use app\models\RefAtletTahap;
use app\models\RefCawangan;
use app\models\RefBandar;
use app\models\RefNegeri;
use app\models\RefBangsa;
use app\models\RefAgama;
use app\models\RefTarafPerkahwinan;
use app\models\RefJenisLesenMemandu;
use app\models\RefBahasa;
use app\models\RefStatusTawaran;
use app\models\UserPeranan;
use app\models\RefStatusAtlet;
use app\models\RefJenisLesenParalimpik;
use app\models\RefAgensiOku;
use app\models\RefKategoriKecacatan;
use app\models\RefPassportTempatDikeluarkan;

use app\models\general\GeneralLabel;
use app\models\general\Upload;
use app\models\general\GeneralVariable;
use common\models\general\GeneralFunction;

/**
 * AtletController implements the CRUD actions for Atlet model.
 */
class AtletController extends Controller
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
     * Lists all Atlet models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $session = new Session;
        $session->open();
        
        $session['atlet_cacat'] = false;
        
        $session->close();
        
        $queryPar = Yii::$app->request->queryParams;
        
        $queryPar['AtletSearch']['cacat'] = '0';
        
        $searchModel = new AtletSearch();
        $dataProvider = $searchModel->search($queryPar);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    /**
     * Lists all Atlet models.
     * @return mixed
     */
    public function actionIndexCacat()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $session = new Session;
        $session->open();
        
        $session['atlet_cacat'] = true;
        
        $session->close();
        
        $queryPar = Yii::$app->request->queryParams;
        
        $queryPar['AtletSearch']['cacat'] = '1';
        
        $searchModel = new AtletSearch();
        $dataProvider = $searchModel->search($queryPar);

        return $this->render('index_cacat', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    /**
     * Lists all Atlet models.
     * @return mixed
     */
    public function actionTawaran()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $queryPar = Yii::$app->request->queryParams;
        
        $queryPar['AtletSearch']['tawaran'] = RefStatusTawaran::DALAM_PROSES;
        
        $searchModel = new AtletSearch();
        $dataProvider = $searchModel->search($queryPar);

        return $this->render('tawaran', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    /**
     * Lists all Atlet models.
     * @return mixed
     */
    public function actionTawaranParalimpik()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $queryPar = Yii::$app->request->queryParams;
        
        $queryPar['AtletSearch']['tawaran'] = RefStatusTawaran::DALAM_PROSES;
        $queryPar['AtletSearch']['cacat'] = '1';
        
        $searchModel = new AtletSearch();
        $dataProvider = $searchModel->search($queryPar);

        return $this->render('tawaran_paralimpik', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Atlet model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $session = new Session;
        $session->open();
        
        $session['atlet_id'] = $id;
        
        // get atlet details
        $atlet = $this->findModel($id);
        
        $session['atlet_cacat'] = $atlet->cacat;
        
        // get atlet dropdown value's descriptions
        $ref = RefAtletTahap::findOne(['id' => $atlet->tahap]);
        $atlet->tahap = $ref['desc'];
        
        $ref = RefCawangan::findOne(['id' => $atlet->cawangan]);
        $atlet->cawangan = $ref['desc'];
        
        $ref = RefBandar::findOne(['id' => $atlet->tempat_lahir_bandar]);
        $atlet->tempat_lahir_bandar = $ref['desc'];
        
        $ref = RefNegeri::findOne(['id' => $atlet->tempat_lahir_negeri]);
        $atlet->tempat_lahir_negeri = $ref['desc'];
        
        $ref = RefBangsa::findOne(['id' => $atlet->bangsa]);
        $atlet->bangsa = $ref['desc'];
        
        $ref = RefAgama::findOne(['id' => $atlet->agama]);
        $atlet->agama = $ref['desc'];
        
        $ref = RefJantina::findOne(['id' => $atlet->jantina]);
        $atlet->jantina = $ref['desc'];
        
        $ref = RefTarafPerkahwinan::findOne(['id' => $atlet->taraf_perkahwinan]);
        $atlet->taraf_perkahwinan = $ref['desc'];
        
        $ref = RefBahasa::findOne(['id' => $atlet->bahasa_ibu]);
        $atlet->bahasa_ibu = $ref['desc'];
        
        //$ref = RefJenisLesenMemandu::findOne(['id' => $atlet->jenis_lesen]);
        //$atlet->jenis_lesen = $ref['desc'];
        
        $ref = RefNegeri::findOne(['id' => $atlet->alamat_rumah_negeri]);
        $atlet->alamat_rumah_negeri = $ref['desc'];
        
        $ref = RefBandar::findOne(['id' => $atlet->alamat_rumah_bandar]);
        $atlet->alamat_rumah_bandar = $ref['desc'];
        
        $ref = RefNegeri::findOne(['id' => $atlet->alamat_surat_negeri]);
        $atlet->alamat_surat_negeri = $ref['desc'];
        
        $ref = RefBandar::findOne(['id' => $atlet->alamat_surat_bandar]);
        $atlet->alamat_surat_bandar = $ref['desc'];
        
        $YesNo = GeneralLabel::getYesNoLabel($atlet->tid);
        $atlet->tid = $YesNo;
        
        $ref = RefStatusAtlet::findOne(['id' => $atlet->status_atlet]);
        $atlet->status_atlet = $ref['desc'];
        
        $ref = RefJenisLesenParalimpik::findOne(['id' => $atlet->jenis_lesen_paralimpik]);
        $atlet->jenis_lesen_paralimpik = $ref['desc'];
        
        $ref = RefAgensiOku::findOne(['id' => $atlet->agensi]);
        $atlet->agensi = $ref['desc'];
        
        $ref = RefNegeri::findOne(['id' => $atlet->ms_negeri]);
        $atlet->ms_negeri = $ref['desc'];
        
        $ref = RefKategoriKecacatan::findOne(['id' => $atlet->kategori_kecacatan]);
        $atlet->kategori_kecacatan = $ref['desc'];
        
        /*$YesNo = GeneralLabel::getYesNoLabel($atlet->tawaran);
        $atlet->tawaran = $YesNo;*/
        
        $atlet->tawaran_id = $atlet->tawaran;
        $ref = RefStatusTawaran::findOne(['id' => $atlet->tawaran]);
        $atlet->tawaran = $ref['desc'];
        
        $ref = RefPassportTempatDikeluarkan::findOne(['id' => $atlet->passport_tempat_dikeluarkan]);
        $atlet->passport_tempat_dikeluarkan = $ref['desc'];
        
        $YesNo = GeneralLabel::getYesNoLabel($atlet->cacat);
        $atlet->cacat = $YesNo;
        
        return $this->render('layout', [
            'model' => $atlet,
            'readonly' => true,
        ]);
        
        $session->close();
    }

    /**
     * Creates a new Atlet model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $session = new Session;
        $session->open();
        
        $session->remove('atlet_id');
        
        $model = new Atlet();
        
        $model->tawaran = RefStatusTawaran::DALAM_PROSES; //default
        
        $model->cacat = $session['atlet_cacat'];
        
        if ($model->load(Yii::$app->request->post())) {
            if($model->jenis_lesen){
                $model->jenis_lesen = implode(",",$model->jenis_lesen);
            }
        }

        if (Yii::$app->request->post() && $model->save()) {
            $file = UploadedFile::getInstance($model, 'gambar');
            if($file){
                $model->gambar = Upload::uploadFile($file, Upload::atletFolder, $model->atlet_id);
            }
            
            $file = UploadedFile::getInstance($model, 'muat_naik_surat_persetujuan');
            if($file){
                $model->muat_naik_surat_persetujuan = Upload::uploadFile($file, Upload::atletFolder, 'muat_naik_surat_persetujuan-' . $model->atlet_id);
            }
            
            if($model->save()){
                $session = new Session;
                $session->open();

                $session['atlet_id'] = $model->atlet_id;
                
                $session->close();
                
                // send out email to pengurus sukan if is PSK key in
                if(Yii::$app->user->identity->peranan ==  UserPeranan::PERANAN_PJS_PERSATUAN){
                    $modelPengurusSukan = User::find()->where(['peranan' => UserPeranan::PERANAN_MSN_PENGURUS_SUKAN])->all();
                    foreach($modelPengurusSukan AS $modelPS){
                        if($modelPS->email && $modelPS->email != ''){
                            Yii::$app->mailer->compose()
        ->setTo($modelPS->email)
                                    ->setFrom('noreply@spsb.com')
        ->setSubject('PSK telah memasukkan atlet baru')
        ->setTextBody("Salam Sejahtera,
            <br><br>
Nama Atlet: " . $model->name_penuh . "
No Kad Pengenalan: " . $model->ic_no . '
    
<br><br>
"KE ARAH KECEMERLANGAN SUKAN"
Majlis Sukan Negara Malaysia.
')->send();
                        }
                    }
                } elseif (Yii::$app->user->identity->peranan ==  UserPeranan::PERANAN_MSN_MAJLIS_SUKAN_NEGERI){
                    // send out email to pengurus sukan if is MSN Majlis Sukan Negeri key in
                    $modelPengurusSukan = User::find()->where(['peranan' => UserPeranan::PERANAN_MSN_PENGURUS_SUKAN])->all();
                    foreach($modelPengurusSukan AS $modelPS){
                        if($modelPS->email && $modelPS->email != ''){
                            Yii::$app->mailer->compose()
        ->setTo($modelPS->email)
                                    ->setFrom('noreply@spsb.com')
        ->setSubject('Majlis Sukan Negeri telah memasukkan atlet baru')
        ->setTextBody("Salam Sejahtera,
<br><br>
Nama Atlet: " . $model->name_penuh . "
No Kad Pengenalan: " . $model->ic_no . '
    
<br><br>
"KE ARAH KECEMERLANGAN SUKAN"
Majlis Sukan Negara Malaysia.
')->send();
                        }
                    }
                }
                
                return $this->redirect(['view', 'id' => $model->atlet_id]);
            }
        }
        
        return $this->render('layout', [
            'model' => $model,
            'readonly' => false,
        ]);
        
        $session->close();
    }

    /**
     * Updates an existing Atlet model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $session = new Session;
        $session->open();

        $session['atlet_id'] = $id;
        
                
        $model = $this->findModel($id);
        
        $session['atlet_cacat'] = $model->cacat;
        
        $existingGambar = $model->gambar;
        
        if ($model->load(Yii::$app->request->post())) {
            
            if($model->jenis_lesen){
                $model->jenis_lesen = implode(",",$model->jenis_lesen);
            }
            
            $file = UploadedFile::getInstance($model, 'gambar');
            if($file){
                $model->gambar = Upload::uploadFile($file, Upload::atletFolder, $model->atlet_id);
            } else {
                $model->gambar = $existingGambar;
            }
            
            $file = UploadedFile::getInstance($model, 'muat_naik_surat_persetujuan');
            if($file){
                $model->muat_naik_surat_persetujuan = Upload::uploadFile($file, Upload::atletFolder, 'muat_naik_surat_persetujuan-' . $model->atlet_id);
            }
            
            $changedTawaran = false;
            
            $oldTawaran = $model->getOldAttribute('tawaran');
            
            // send notification email if status tawaran has been changed and send to creator
            if($model->tawaran != $oldTawaran){
                $changedTawaran = true;
                
                if (($modelUser = User::findOne($model->created_by)) !== null) {
                    if($modelUser->email && $modelUser->email != ''){
                        $ref = RefStatusTawaran::findOne(['id' => $model->tawaran]);
                        $statusTawaranDesc = $ref['desc'];
        
                        try {
                            Yii::$app->mailer->compose()
                                    ->setTo($modelUser->email)
                                                                ->setFrom('noreply@spsb.com')
                                    ->setSubject('Status Tawaran Atlet (' . $model->name_penuh . ') Telah Diproses')
                                    ->setTextBody('Salam Sejahtera,<br><br>

                            Nama Atlet: ' . $model->name_penuh . '
                            No Kad Pengenalan: ' . $model->ic_no . '
                            Status Tawaran Terkini: ' . $statusTawaranDesc . '
<br><br>
                            "KE ARAH KECEMERLANGAN SUKAN"
                            Majlis Sukan Negara Malaysia.
                            ')->send();
                        }
                        catch(\Swift_SwiftException $exception)
                        {
                            //return 'Can sent mail due to the following exception'.print_r($exception);
                        }
                            
                    }
                }
            }
            
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->atlet_id]);
            }
            
        }
        
        $session->close();
        
        return $this->render('layout', [
            'model' => $model,
            'readonly' => false,
        ]);
    }

    public function actionBulk() {

        $action=Yii::$app->request->post('action');
        $selection=(array)Yii::$app->request->post('selection');

        foreach($selection as $id){
            $model = $this->findModel((int)$id);
            $model->tawaran = $action;
            $model->save();
        }
        
        return $this->redirect(['tawaran']);
    }

    /**
     * Deletes an existing Atlet model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        
        // delete upload file
        self::actionDeleteupload($id, 'gambar');
        
        self::actionDeleteupload($id, 'muat_naik_surat_persetujuan');
        
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Atlet model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Atlet the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Atlet::find()->joinWith(['refAtletSukan' => function($query) {
                        $query->orderBy(['tbl_atlet_sukan.created' => SORT_DESC])->one();
                    },
                ])->where(['tbl_atlet.atlet_id'=>$id])->one()) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    // Add function for delete image or file
    public function actionDeleteimg($id, $field)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
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
    
    // Add function for delete image or file
    public function actionDeleteupload($id, $field)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
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
    
    public function actionGetAtlet($id){
        // find Ahli Jawatankuasa Induk
        $model = Atlet::find()->where(['tbl_atlet.atlet_id'=>$id])->joinWith(['refAtletSukan' => function($query) {
                        $query->orderBy(['tbl_atlet_sukan.created' => SORT_DESC])->one();
                    },
                ])->joinWith(['refAtletPendidikan' => function($query) {
                        $query->orderBy(['tbl_atlet_pendidikan.created' => SORT_DESC])->one();
                    },
                ])->asArray()->one();
        
        //$model['ic_no'] = \Yii::$app->encrypter->decrypt($model['ic_no']);
        //$model['passport_no$model'] = \Yii::$app->encrypter->decrypt($model['passport_no']);
        //$model['tel_bimbit_no_1'] = \Yii::$app->encrypter->decrypt($model['tel_bimbit_no_1']);
        //$model['tel_bimbit_no_2'] = \Yii::$app->encrypter->decrypt($model['tel_bimbit_no_2']);
             
        $model['institusi_sekolah'] = '';
        if(isset($model['refAtletPendidikan'][0]['nama'])){
            $ref = \app\models\RefSekolahInstitusi::findOne(['id' => $model['refAtletPendidikan'][0]['nama']]);
            $model['institusi_sekolah'] = $ref['desc'];
        }
        
        $model['view_url'] = Url::to(['/atlet/view', 'id' => $model['atlet_id']]);
        $model['view_url_button'] = Html::a(GeneralLabel::view . ' ' . GeneralLabel::profil, '#', ['class'=>'btn btn-primary custom_button', 'onclick' => 'window.open("' . Url::to(['/atlet/view', 'id' => $model['atlet_id']]) . '", "PopupWindow", "width=1300,height=800,scrollbars=yes,resizable=no"); return false;']) ;
                    
        echo Json::encode($model);
    }
    
    /**
     * Get Bandars base on Negeri id
     * @param integer $id actionHryye
     * @return mixed
     */
    public function actionSubAtlets()
    {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $cat1_id = $parents[0];
                $cat2_id = $parents[1];
                $cat3_id = $parents[2];
                $out = self::getAtletsBySukanAcaraProgram($cat1_id, $cat2_id, $cat3_id); 
                // the getSubCatList function will query the database based on the
                // cat_id and return an array like below:
                // [
                //    ['id'=>'<sub-cat-id-1>', 'name'=>'<sub-cat-name1>'],
                //    ['id'=>'<sub-cat_id_2>', 'name'=>'<sub-cat-name2>']
                // ]
                echo Json::encode(['output'=>$out, 'selected'=>'']);
                return;
            }
        }
        echo Json::encode(['output'=>'', 'selected'=>'']);
    }
    
    /**
     * get list of Bandar by Negeri
     * @param integer $id
     * @return Array Bandars
     */
    public static function getAtletsBySukanAcaraProgram($program_id, $sukan_id, $acara_id) {
        $data = Atlet::find()->joinWith(['refAtletSukan' => function($query) {
                        $query->orderBy(['tbl_atlet_sukan.created' => SORT_DESC])->one();
                    },
                ])
                            ->select(['DISTINCT(`tbl_atlet`.`atlet_id`) AS id','tbl_atlet.name_penuh AS name']);
                    
        if($sukan_id!="" && isset($sukan_id)){
            $data = $data->andWhere(['tbl_atlet_sukan.nama_sukan'=>$sukan_id]);
        }
        
        if($acara_id!="" && isset($acara_id)){
            $data = $data->andWhere(['tbl_atlet_sukan.acara'=>$acara_id]);
        }
        
        if($program_id!="" && isset($program_id)){
            $data = $data->andWhere(['tbl_atlet_sukan.program_semasa'=>$program_id]);
        }

        $data = $data->asArray()->createCommand()->queryAll();
                    
        $value = (count($data) == 0) ? ['' => ''] : $data;

        return $value;
    }
    
    /**
     * Get Bandars base on Negeri id
     * @param integer $id actionHryye
     * @return mixed
     */
    public function actionSubAtletsSukan()
    {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $cat1_id = $parents[0];
                $out = self::getAtletsBySukan($cat1_id); 
                // the getSubCatList function will query the database based on the
                // cat_id and return an array like below:
                // [
                //    ['id'=>'<sub-cat-id-1>', 'name'=>'<sub-cat-name1>'],
                //    ['id'=>'<sub-cat_id_2>', 'name'=>'<sub-cat-name2>']
                // ]
                echo Json::encode(['output'=>$out, 'selected'=>'']);
                return;
            }
        }
        echo Json::encode(['output'=>'', 'selected'=>'']);
    }
    
    /**
     * get list of Bandar by Negeri
     * @param integer $id
     * @return Array Bandars
     */
    public static function getAtletsBySukan($sukan_id) {
        $data = Atlet::find()->joinWith(['refAtletSukan' => function($query) {
                        $query->orderBy(['tbl_atlet_sukan.created' => SORT_DESC])->one();
                    },
                ])
                            ->select(['DISTINCT(`tbl_atlet`.`atlet_id`) AS id','tbl_atlet.name_penuh AS name']);
                    
                    if($sukan_id!="" && isset($sukan_id)){
                        $data = $data->andWhere(['tbl_atlet_sukan.nama_sukan'=>$sukan_id])->groupBy('tbl_atlet.atlet_id');
                    }
                    
                    $data = $data->asArray()->createCommand()->queryAll();
                    
        $value = (count($data) == 0) ? ['' => ''] : $data;

        return $value;
    }
    
    /**
     * Get Bandars base on Negeri id
     * @param integer $id actionHryye
     * @return mixed
     */
    public function actionSubAtletsByProgramSukan()
    {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $cat1_id = $parents[0];
                $cat2_id = $parents[1];
                $out = self::getAtletsByProgramSukan($cat1_id, $cat2_id); 
                // the getSubCatList function will query the database based on the
                // cat_id and return an array like below:
                // [
                //    ['id'=>'<sub-cat-id-1>', 'name'=>'<sub-cat-name1>'],
                //    ['id'=>'<sub-cat_id_2>', 'name'=>'<sub-cat-name2>']
                // ]
                echo Json::encode(['output'=>$out, 'selected'=>'']);
                return;
            }
        }
        echo Json::encode(['output'=>'', 'selected'=>'']);
    }
    
    /**
     * get list of Bandar by Negeri
     * @param integer $id
     * @return Array Bandars
     */
    public static function getAtletsByProgramSukan($program_id, $sukan_id) {
        $data = Atlet::find()->joinWith(['refAtletSukan' => function($query) {
                        $query->orderBy(['tbl_atlet_sukan.created' => SORT_DESC])->one();
                    },
                ])
                            
                            ->select(['DISTINCT(`tbl_atlet`.`atlet_id`) AS id','tbl_atlet.name_penuh AS name']);
                    
        if($sukan_id!="" && isset($sukan_id)){
            $data = $data->andWhere(['tbl_atlet_sukan.nama_sukan'=>$sukan_id]);
        }
        
        if($program_id!="" && isset($program_id)){
            $data = $data->andWhere(['tbl_atlet_sukan.program_semasa'=>$program_id]);
        }

        $data = $data->asArray()->createCommand()->queryAll();
                    
        $value = (count($data) == 0) ? ['' => ''] : $data;

        return $value;
    }
    
    public function actionPrint($id) {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new AtletPrintForm();
                
        if ($model->load(Yii::$app->request->post())) {
            $pdf = Yii::$app->pdf;
            $pdf->mode = \kartik\mpdf\Pdf::MODE_CORE;
            $pdf->filename = 'atlet'.'-'.$id.'.pdf';
            $pdf->content = $this->renderPartial('print_atlet', [
                                        'id' => $id,
                                        'model' => $model,
                                    ]);
            $pdf->cssFile = '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css';
            $pdf->cssFile = '';

            $pdf->options = [
            'title' => 'Atlet',
            'subject' => 'Print',
            ];

            $pdf->methods = [
                'SetHeader'=>['Krajee Report Header'], 
                'SetFooter'=>['{PAGENO}'],
            ];

            return $pdf->render();
        } 
        
        return $this->render('print_atlet_form', [
            'model' => $model,
        ]);
    }
    
    public function actionPrintParalimpik($id) {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new AtletPrintForm();
                
        if ($model->load(Yii::$app->request->post())) {
            $pdf = Yii::$app->pdf;
            $pdf->mode = \kartik\mpdf\Pdf::MODE_CORE;
            $pdf->filename = 'atlet'.'-'.$id.'.pdf';
            $pdf->content = $this->renderPartial('print_atlet_paralimpik', [
                                        'id' => $id,
                                        'model' => $model,
                                    ]);
            $pdf->cssFile = '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css';
            $pdf->cssFile = '';

            $pdf->options = [
            'title' => 'Atlet',
            'subject' => 'Print',
            ];

            $pdf->methods = [
                'SetHeader'=>['Krajee Report Header'], 
                'SetFooter'=>['{PAGENO}'],
            ];

            return $pdf->render();
        } 
        
        return $this->render('print_atlet_paralimpik_form', [
            'model' => $model,
        ]);
    }
    
    public function actionLaporanSenaraiAtlet()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new MsnLaporanSenaraiAtlet();
        $model->format = 'html';

        if ($model->load(Yii::$app->request->post())) {
            
            
            if(!empty($model->program))$model->program = implode(",",$model->program);
            if(!empty($model->sukan))$model->sukan = implode(",",$model->sukan);
            if(!empty($model->acara))$model->acara = implode(",",$model->acara);
            if(!empty($model->negeri))$model->negeri = implode(",",$model->negeri);
            if(!empty($model->source))$model->source = implode(",",$model->source);
            if(!empty($model->cawangan))$model->cawangan = implode(",",$model->cawangan);
            if(!empty($model->tahap_pendidikan))$model->tahap_pendidikan = implode(",",$model->tahap_pendidikan);
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-laporan-senarai-atlet'
                    , 'program' => $model->program
                    , 'sukan' => $model->sukan
                    , 'acara' => $model->acara
                    , 'negeri' => $model->negeri
                    , 'source' => $model->source
                    , 'umur_dari' => $model->umur_dari
                    , 'umur_hingga' => $model->umur_hingga
                    , 'cawangan' => $model->cawangan
                    , 'tahap_pendidikan' => $model->tahap_pendidikan
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-laporan-senarai-atlet'
                    , 'program' => $model->program
                    , 'sukan' => $model->sukan
                    , 'acara' => $model->acara
                    , 'negeri' => $model->negeri
                    , 'source' => $model->source
                    , 'umur_dari' => $model->umur_dari
                    , 'umur_hingga' => $model->umur_hingga
                    , 'cawangan' => $model->cawangan
                    , 'tahap_pendidikan' => $model->tahap_pendidikan
                    , 'format' => $model->format
                ]);
            }
        } 

        return $this->render('laporan_senarai_atlet', [
            'model' => $model,
            'readonly' => false,
        ]);
    }
    
    public function actionGenerateLaporanSenaraiAtlet($program, $sukan, $acara, $negeri, $source, $umur_dari, $umur_hingga, $cawangan, $tahap_pendidikan, $format)
    {
        if($program == "") $program = array();
        else $program = array($program);
        
        if($sukan == "") $sukan = array();
        else $sukan = array($sukan);
        
        if($acara == "") $acara = array();
        else $acara = array($acara);
        
        if($negeri == "") $negeri = array();
        else $negeri = array($negeri);
        
        if($source == "") $source = array();
        else $source = array($source);
        
        if($umur_dari == "") $umur_dari = array();
        else $umur_dari = array($umur_dari);
        
        if($umur_hingga == "") $umur_hingga = array();
        else $umur_hingga = array($umur_hingga);
        
        if($cawangan == "") $cawangan = array();
        else $cawangan = array($cawangan);
        
        if($tahap_pendidikan == "") $tahap_pendidikan = array();
        else $tahap_pendidikan = array($tahap_pendidikan);
        
        $controls = array(
            'ACARA' => $acara,
            'PROGRAM' => $program,
            'SUKAN' => $sukan,
            'NEGERI' => $negeri,
            'SOURCE' => $source,
            'FROM_UMUR' => $umur_dari,
            'TO_UMUR' => $umur_hingga,
            'CAWANGAN' => $cawangan,
            'TAHAP_PENDIDIKAN' => $tahap_pendidikan,
        );
        
        GeneralFunction::generateReport('/spsb/MSN/LaporanSenaraiAtlet', $format, $controls, 'laporan_senarai_atlet');
    }
    
    public function actionLaporanSenaraiAtletParalimpik()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new MsnLaporanSenaraiAtlet();
        $model->format = 'html';

        if ($model->load(Yii::$app->request->post())) {
            
            if(!empty($model->program))$model->program = implode(",",$model->program);
            if(!empty($model->sukan))$model->sukan = implode(",",$model->sukan);
            if(!empty($model->acara))$model->acara = implode(",",$model->acara);
            if(!empty($model->negeri))$model->negeri = implode(",",$model->negeri);
            if(!empty($model->kategori_kecacatan))$model->kategori_kecacatan = implode(",",$model->kategori_kecacatan);
            if(!empty($model->source))$model->source = implode(",",$model->source);
            if(!empty($model->cawangan))$model->cawangan = implode(",",$model->cawangan);
            if(!empty($model->tahap_pendidikan))$model->tahap_pendidikan = implode(",",$model->tahap_pendidikan);
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-laporan-senarai-atlet-paralimpik'
                    , 'program' => $model->program
                    , 'sukan' => $model->sukan
                    , 'acara' => $model->acara
                    , 'negeri' => $model->negeri
                    , 'kategori_kecacatan' => $model->kategori_kecacatan
                    , 'source' => $model->source
                    , 'umur_dari' => $model->umur_dari
                    , 'umur_hingga' => $model->umur_hingga
                    , 'cawangan' => $model->cawangan
                    , 'tahap_pendidikan' => $model->tahap_pendidikan
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-laporan-senarai-atlet-paralimpik'
                    , 'program' => $model->program
                    , 'sukan' => $model->sukan
                    , 'acara' => $model->acara
                    , 'negeri' => $model->negeri
                    , 'kategori_kecacatan' => $model->kategori_kecacatan
                    , 'source' => $model->source
                    , 'umur_dari' => $model->umur_dari
                    , 'umur_hingga' => $model->umur_hingga
                    , 'cawangan' => $model->cawangan
                    , 'tahap_pendidikan' => $model->tahap_pendidikan
                    , 'format' => $model->format
                ]);
            }
        } 

        return $this->render('laporan_senarai_atlet_paralimpik', [
            'model' => $model,
            'readonly' => false,
        ]);
    }
    
    public function actionGenerateLaporanSenaraiAtletParalimpik($program, $sukan, $acara, $negeri, $kategori_kecacatan, $source, $umur_dari, $umur_hingga, $cawangan, $tahap_pendidikan, $format)
    {
        if($program == "") $program = array();
        else $program = array($program);
        
        if($sukan == "") $sukan = array();
        else $sukan = array($sukan);
        
        if($acara == "") $acara = array();
        else $acara = array($acara);
        
        if($negeri == "") $negeri = array();
        else $negeri = array($negeri);
        
        if($kategori_kecacatan == "") $kategori_kecacatan = array();
        else $kategori_kecacatan = array($kategori_kecacatan);
        
        if($source == "") $source = array();
        else $source = array($source);
        
        if($umur_dari == "") $umur_dari = array();
        else $umur_dari = array($umur_dari);
        
        if($umur_hingga == "") $umur_hingga = array();
        else $umur_hingga = array($umur_hingga);
        
        if($cawangan == "") $cawangan = array();
        else $cawangan = array($cawangan);
        
        if($tahap_pendidikan == "") $tahap_pendidikan = array();
        else $tahap_pendidikan = array($tahap_pendidikan);
        
        $controls = array(
            'ACARA' => $acara,
            'PROGRAM' => $program,
            'SUKAN' => $sukan,
            'NEGERI' => $negeri,
            'KATEGORI_CACAT' => $kategori_kecacatan,
            'SOURCE' => $source,
            'FROM_UMUR' => $umur_dari,
            'TO_UMUR' => $umur_hingga,
            'CAWANGAN' => $cawangan,
            'TAHAP_PENDIDIKAN' => $tahap_pendidikan,
        );
        
        GeneralFunction::generateReport('/spsb/MSN/LaporanSenaraiAtletParalimpik', $format, $controls, 'laporan_senarai_atlet_paralimpik');
    }
    
    public function actionLaporanStatistikAtlet()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new MsnLaporanStatistikAtlet();
        $model->format = 'html';

        if ($model->load(Yii::$app->request->post())) {
            
            if(!empty($model->program))$model->program = implode(",",$model->program);
            if(!empty($model->sukan))$model->sukan = implode(",",$model->sukan);
            if(!empty($model->acara))$model->acara = implode(",",$model->acara);
            if(!empty($model->negeri))$model->negeri = implode(",",$model->negeri);
            if(!empty($model->cawangan))$model->cawangan = implode(",",$model->cawangan);
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-laporan-statistik-atlet'
                    , 'program' => $model->program
                    , 'sukan' => $model->sukan
                    , 'acara' => $model->acara
                    , 'negeri' => $model->negeri
                    , 'cawangan' => $model->cawangan
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-laporan-statistik-atlet'
                    , 'program' => $model->program
                    , 'sukan' => $model->sukan
                    , 'acara' => $model->acara
                    , 'negeri' => $model->negeri
                    , 'cawangan' => $model->cawangan
                    , 'format' => $model->format
                ]);
            }
        } 

        return $this->render('laporan_statistik_atlet', [
            'model' => $model,
            'readonly' => false,
        ]);
    }
    
    public function actionGenerateLaporanStatistikAtlet($program, $sukan, $acara, $negeri, $cawangan, $format)
    {
        if($program == "") $program = array();
        else $program = array($program);
        
        if($sukan == "") $sukan = array();
        else $sukan = array($sukan);
        
        if($acara == "") $acara = array();
        else $acara = array($acara);
        
        if($negeri == "") $negeri = array();
        else $negeri = array($negeri);
        
        if($cawangan == "") $cawangan = array();
        else $cawangan = array($cawangan);
        
        $controls = array(
            'ACARA' => $acara,
            'PROGRAM' => $program,
            'SUKAN' => $sukan,
            'NEGERI' => $negeri,
            'CAWANGAN' => $cawangan,
        );
        
        GeneralFunction::generateReport('/spsb/MSN/LaporanStatistikAtlet', $format, $controls, 'laporan_statistik_atlet');
    }
    
    public function actionLaporanStatistikAtletParalimpik()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new MsnLaporanStatistikAtlet();
        $model->format = 'html';

        if ($model->load(Yii::$app->request->post())) {
            
            if(!empty($model->program))$model->program = implode(",",$model->program);
            if(!empty($model->sukan))$model->sukan = implode(",",$model->sukan);
            if(!empty($model->acara))$model->acara = implode(",",$model->acara);
            if(!empty($model->negeri))$model->negeri = implode(",",$model->negeri);
            if(!empty($model->kategori_kecacatan))$model->kategori_kecacatan = implode(",",$model->kategori_kecacatan);
            if(!empty($model->cawangan))$model->cawangan = implode(",",$model->cawangan);
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-laporan-statistik-atlet-paralimpik'
                    , 'program' => $model->program
                    , 'sukan' => $model->sukan
                    , 'acara' => $model->acara
                    , 'negeri' => $model->negeri
                    , 'kategori_kecacatan' => $model->kategori_kecacatan
                    , 'cawangan' => $model->cawangan
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-laporan-statistik-atlet-paralimpik'
                    , 'program' => $model->program
                    , 'sukan' => $model->sukan
                    , 'acara' => $model->acara
                    , 'negeri' => $model->negeri
                    , 'kategori_kecacatan' => $model->kategori_kecacatan
                    , 'cawangan' => $model->cawangan
                    , 'format' => $model->format
                ]);
            }
        } 

        return $this->render('laporan_statistik_atlet_paralimpik', [
            'model' => $model,
            'readonly' => false,
        ]);
    }
    
    public function actionGenerateLaporanStatistikAtletParalimpik($program, $sukan, $acara, $negeri, $kategori_kecacatan, $cawangan, $format)
    {
        if($program == "") $program = array();
        else $program = array($program);
        
        if($sukan == "") $sukan = array();
        else $sukan = array($sukan);
        
        if($acara == "") $acara = array();
        else $acara = array($acara);
        
        if($negeri == "") $negeri = array();
        else $negeri = array($negeri);
        
        if($kategori_kecacatan == "") $kategori_kecacatan = array();
        else $kategori_kecacatan = array($kategori_kecacatan);
        
        if($cawangan == "") $cawangan = array();
        else $cawangan = array($cawangan);
        
        $controls = array(
            'ACARA' => $acara,
            'PROGRAM' => $program,
            'SUKAN' => $sukan,
            'NEGERI' => $negeri,
            'KATEGORI_CACAT' => $kategori_kecacatan,
            'CAWANGAN' => $cawangan,
        );
        
        GeneralFunction::generateReport('/spsb/MSN/LaporanStatistikAtletParalimpik', $format, $controls, 'laporan_statistik_atlet_paralimpik');
    }
    
    public function actionLaporanStatistikAtletJantina()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new MsnLaporanStatistikAtlet();
        $model->format = 'html';

        if ($model->load(Yii::$app->request->post())) {
            
            if(!empty($model->program))$model->program = implode(",",$model->program);
            if(!empty($model->sukan))$model->sukan = implode(",",$model->sukan);
            if(!empty($model->acara))$model->acara = implode(",",$model->acara);
            if(!empty($model->negeri))$model->negeri = implode(",",$model->negeri);
            if(!empty($model->cawangan))$model->cawangan = implode(",",$model->cawangan);
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-laporan-statistik-atlet-jantina'
                    , 'program' => $model->program
                    , 'sukan' => $model->sukan
                    , 'acara' => $model->acara
                    , 'negeri' => $model->negeri
                    , 'cawangan' => $model->cawangan
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-laporan-statistik-atlet-jantina'
                    , 'program' => $model->program
                    , 'sukan' => $model->sukan
                    , 'acara' => $model->acara
                    , 'negeri' => $model->negeri
                    , 'cawangan' => $model->cawangan
                    , 'format' => $model->format
                ]);
            }
        } 

        return $this->render('laporan_statistik_atlet_jantina', [
            'model' => $model,
            'readonly' => false,
        ]);
    }
    
    public function actionGenerateLaporanStatistikAtletJantina($program, $sukan, $acara, $negeri, $cawangan, $format)
    {
        if($program == "") $program = array();
        else $program = array($program);
        
        if($sukan == "") $sukan = array();
        else $sukan = array($sukan);
        
        if($acara == "") $acara = array();
        else $acara = array($acara);
        
        if($negeri == "") $negeri = array();
        else $negeri = array($negeri);
        
        if($cawangan == "") $cawangan = array();
        else $cawangan = array($cawangan);
        
        $controls = array(
            'ACARA' => $acara,
            'PROGRAM' => $program,
            'SUKAN' => $sukan,
            'NEGERI' => $negeri,
            'CAWANGAN' => $cawangan,
        );
        
        GeneralFunction::generateReport('/spsb/MSN/LaporanStatistikAtletJantina', $format, $controls, 'laporan_statistik_atlet_jantina');
    }
    
    public function actionLaporanStatistikAtletJantinaParalimpik()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new MsnLaporanStatistikAtlet();
        $model->format = 'html';

        if ($model->load(Yii::$app->request->post())) {
            
            if(!empty($model->program))$model->program = implode(",",$model->program);
            if(!empty($model->sukan))$model->sukan = implode(",",$model->sukan);
            if(!empty($model->acara))$model->acara = implode(",",$model->acara);
            if(!empty($model->negeri))$model->negeri = implode(",",$model->negeri);
            //if(!empty($model->kategori_kecacatan))$model->kategori_kecacatan = implode(",",$model->kategori_kecacatan);
            if(!empty($model->cawangan))$model->cawangan = implode(",",$model->cawangan);
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-laporan-statistik-atlet-jantina-paralimpik'
                    , 'program' => $model->program
                    , 'sukan' => $model->sukan
                    , 'acara' => $model->acara
                    , 'negeri' => $model->negeri
                    //, 'kategori_kecacatan' => $model->kategori_kecacatan
                    , 'cawangan' => $model->cawangan
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-laporan-statistik-atlet-jantina-paralimpik'
                    , 'program' => $model->program
                    , 'sukan' => $model->sukan
                    , 'acara' => $model->acara
                    , 'negeri' => $model->negeri
                    //, 'kategori_kecacatan' => $model->kategori_kecacatan
                    , 'cawangan' => $model->cawangan
                    , 'format' => $model->format
                ]);
            }
        } 

        return $this->render('laporan_statistik_atlet_jantina_paralimpik', [
            'model' => $model,
            'readonly' => false,
        ]);
    }
    
    public function actionGenerateLaporanStatistikAtletJantinaParalimpik($program, $sukan, $acara, $negeri, $cawangan, $format)
    {
        if($program == "") $program = array();
        else $program = array($program);
        
        if($sukan == "") $sukan = array();
        else $sukan = array($sukan);
        
        if($acara == "") $acara = array();
        else $acara = array($acara);
        
        if($negeri == "") $negeri = array();
        else $negeri = array($negeri);
        
        //if($kategori_kecacatan == "") $kategori_kecacatan = array();
        //else $kategori_kecacatan = array($kategori_kecacatan);
        
        if($cawangan == "") $cawangan = array();
        else $cawangan = array($cawangan);
        
        $controls = array(
            'ACARA' => $acara,
            'PROGRAM' => $program,
            'SUKAN' => $sukan,
            'NEGERI' => $negeri,
            //'KATEGORI_CACAT' => $kategori_kecacatan,
            'CAWANGAN' => $cawangan,
        );
        
        GeneralFunction::generateReport('/spsb/MSN/LaporanStatistikAtletJantinaParalimpik', $format, $controls, 'laporan_statistik_atlet_jantina_paralimpik');
    }
    
    public function actionSuratTawaranAtlet($atlet_id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new MsnSuratTawaranAtlet();
        $model->atlet_id = $atlet_id;
        $model->format = 'html';

        if ($model->load(Yii::$app->request->post())) {
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-surat-tawaran-atlet'
                    , 'tarikh' => $model->tarikh
                    , 'bil_msnm' => $model->bil_msnm
                    , 'atlet_id' => $model->atlet_id
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-surat-tawaran-atlet'
                    , 'tarikh' => $model->tarikh
                    , 'bil_msnm' => $model->bil_msnm
                    , 'atlet_id' => $model->atlet_id
                    , 'format' => $model->format
                ]);
            }
        } 

        return $this->render('surat_tawaran_atlet', [
            'model' => $model,
            'readonly' => false,
        ]);
    }
    
    public function actionGenerateSuratTawaranAtlet($tarikh, $bil_msnm, $atlet_id, $format)
    {
        if($tarikh == "") $tarikh = array();
        else $tarikh = array($tarikh);
        
        if($bil_msnm == "") $bil_msnm = array();
        else $bil_msnm = array($bil_msnm);
        
        if($atlet_id == "") $atlet_id = array();
        else $atlet_id = array($atlet_id);
        
        $controls = array(
            'TARIKH' => $tarikh,
            'BIL_MSNM' => $bil_msnm,
            'ATLET' => $atlet_id,
        );
        
        GeneralFunction::generateReport('/spsb/MSN/SuratTawaranAtlet', $format, $controls, 'surat_tawaran_atlet');
    }
    
    
    public function actionSuratTawaranAtletParalimpik($atlet_id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new MsnSuratTawaranAtlet();
        $model->atlet_id = $atlet_id;
        $model->format = 'html';

        if ($model->load(Yii::$app->request->post())) {
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-surat-tawaran-atlet-paralimpik'
                    , 'tarikh' => $model->tarikh
                    , 'bil_msnm' => $model->bil_msnm
                    , 'atlet_id' => $model->atlet_id
                    , 'tarikh_luput' => $model->tarikh_luput
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-surat-tawaran-atlet-paralimpik'
                    , 'tarikh' => $model->tarikh
                    , 'bil_msnm' => $model->bil_msnm
                    , 'atlet_id' => $model->atlet_id
                    , 'tarikh_luput' => $model->tarikh_luput
                    , 'format' => $model->format
                ]);
            }
        } 

        return $this->render('surat_tawaran_atlet_paralimpik', [
            'model' => $model,
            'readonly' => false,
        ]);
    }
    
    public function actionGenerateSuratTawaranAtletParalimpik($tarikh, $bil_msnm, $atlet_id, $tarikh_luput, $format)
    {
        if($tarikh == "") $tarikh = array();
        else $tarikh = array($tarikh);
        
        if($bil_msnm == "") $bil_msnm = array();
        else $bil_msnm = array($bil_msnm);
        
        if($atlet_id == "") $atlet_id = array();
        else $atlet_id = array($atlet_id);
        
        if($tarikh_luput == "") $tarikh_luput = array();
        else $tarikh_luput = array($tarikh_luput);
        
        $controls = array(
            'TARIKH' => $tarikh,
            'BIL_MSNM' => $bil_msnm,
            'ATLET' => $atlet_id,
            'TARIKH_LUPUT' => $tarikh_luput,
        );
        
        GeneralFunction::generateReport('/spsb/MSN/SuratTawaranAtletParalimpik', $format, $controls, 'surat_tawaran_atlet_paralimpik');
    }
    
    public function actionLaporanAtletPencapaianPrestasi()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new MsnLaporanSenaraiAtlet();
        $model->format = 'html';

        if ($model->load(Yii::$app->request->post())) {
            
            if(!empty($model->program))$model->program = implode(",",$model->program);
            if(!empty($model->sukan))$model->sukan = implode(",",$model->sukan);
            if(!empty($model->acara))$model->acara = implode(",",$model->acara);
            if(!empty($model->negeri))$model->negeri = implode(",",$model->negeri);
            if(!empty($model->atlet))$model->atlet = implode(",",$model->atlet);
            if(!empty($model->cawangan))$model->cawangan = implode(",",$model->cawangan);
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-laporan-atlet-pencapaian-prestasi'
                    , 'program' => $model->program
                    , 'sukan' => $model->sukan
                    , 'acara' => $model->acara
                    , 'negeri' => $model->negeri
                    , 'atlet' => $model->atlet
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'cawangan' => $model->cawangan
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-laporan-atlet-pencapaian-prestasi'
                    , 'program' => $model->program
                    , 'sukan' => $model->sukan
                    , 'acara' => $model->acara
                    , 'negeri' => $model->negeri
                    , 'atlet' => $model->atlet
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'cawangan' => $model->cawangan
                    , 'format' => $model->format
                ]);
            }
        } 

        return $this->render('laporan_atlet_pencapaian_prestasi', [
            'model' => $model,
            'readonly' => false,
        ]);
    }
    
    public function actionGenerateLaporanAtletPencapaianPrestasi($program, $sukan, $acara, $negeri, $atlet, $tarikh_dari, $tarikh_hingga, $cawangan, $format)
    {
        if($program == "") $program = array();
        else $program = array($program);
        
        if($sukan == "") $sukan = array();
        else $sukan = array($sukan);
        
        if($acara == "") $acara = array();
        else $acara = array($acara);
        
        if($negeri == "") $negeri = array();
        else $negeri = array($negeri);
        
        if($atlet == "") $atlet = array();
        else $atlet = array($atlet);
        
        if($tarikh_dari == "") $tarikh_dari = array();
        else $tarikh_dari = array($tarikh_dari);
        
        if($tarikh_hingga == "") $tarikh_hingga = array();
        else $tarikh_hingga = array($tarikh_hingga);
        
        if($cawangan == "") $cawangan = array();
        else $cawangan = array($cawangan);
        
        $controls = array(
            'ACARA' => $acara,
            'PROGRAM' => $program,
            'SUKAN' => $sukan,
            'NEGERI' => $negeri,
            'ATLET' => $atlet,
            'FROM_DATE' => $tarikh_dari,
            'TO_DATE' => $tarikh_hingga,
            'CAWANGAN' => $cawangan,
        );
        
        GeneralFunction::generateReport('/spsb/MSN/LaporanAtletPencapianPrestasi', $format, $controls, 'laporan_atlet_pencapaian_prestasi');
    }
    
    public function actionLaporanAtletPencapaianPrestasiParalimpik()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new MsnLaporanSenaraiAtlet();
        $model->format = 'html';

        if ($model->load(Yii::$app->request->post())) {
            
            if(!empty($model->program))$model->program = implode(",",$model->program);
            if(!empty($model->sukan))$model->sukan = implode(",",$model->sukan);
            if(!empty($model->acara))$model->acara = implode(",",$model->acara);
            if(!empty($model->negeri))$model->negeri = implode(",",$model->negeri);
            if(!empty($model->atlet))$model->atlet = implode(",",$model->atlet);
            if(!empty($model->cawangan))$model->cawangan = implode(",",$model->cawangan);
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-laporan-atlet-pencapaian-prestasi-paralimpik'
                    , 'program' => $model->program
                    , 'sukan' => $model->sukan
                    , 'acara' => $model->acara
                    , 'negeri' => $model->negeri
                    , 'atlet' => $model->atlet
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'cawangan' => $model->cawangan
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-laporan-atlet-pencapaian-prestasi-paralimpik'
                    , 'program' => $model->program
                    , 'sukan' => $model->sukan
                    , 'acara' => $model->acara
                    , 'negeri' => $model->negeri
                    , 'atlet' => $model->atlet
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'cawangan' => $model->cawangan
                    , 'format' => $model->format
                ]);
            }
        } 

        return $this->render('laporan_atlet_pencapaian_prestasi_paralimpik', [
            'model' => $model,
            'readonly' => false,
        ]);
    }
    
    public function actionGenerateLaporanAtletPencapaianPrestasiParalimpik($program, $sukan, $acara, $negeri, $atlet, $tarikh_dari, $tarikh_hingga, $cawangan, $format)
    {
        if($program == "") $program = array();
        else $program = array($program);
        
        if($sukan == "") $sukan = array();
        else $sukan = array($sukan);
        
        if($acara == "") $acara = array();
        else $acara = array($acara);
        
        if($negeri == "") $negeri = array();
        else $negeri = array($negeri);
        
        if($atlet == "") $atlet = array();
        else $atlet = array($atlet);
        
        if($tarikh_dari == "") $tarikh_dari = array();
        else $tarikh_dari = array($tarikh_dari);
        
        if($tarikh_hingga == "") $tarikh_hingga = array();
        else $tarikh_hingga = array($tarikh_hingga);
        
        if($cawangan == "") $cawangan = array();
        else $cawangan = array($cawangan);
        
        $controls = array(
            'ACARA' => $acara,
            'PROGRAM' => $program,
            'SUKAN' => $sukan,
            'NEGERI' => $negeri,
            'ATLET' => $atlet,
            'FROM_DATE' => $tarikh_dari,
            'TO_DATE' => $tarikh_hingga,
            'CAWANGAN' => $cawangan,
        );
        
        GeneralFunction::generateReport('/spsb/MSN/LaporanAtletPencapianPrestasiParalimpik', $format, $controls, 'laporan_atlet_pencapaian_prestasi_paralimpik');
    }
    
    public function actionLaporanStatistikAtletAgama()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new MsnLaporanSenaraiAtlet();
        $model->format = 'html';

        if ($model->load(Yii::$app->request->post())) {
            
            if(!empty($model->program))$model->program = implode(",",$model->program);
            if(!empty($model->sukan))$model->sukan = implode(",",$model->sukan);
            if(!empty($model->acara))$model->acara = implode(",",$model->acara);
            if(!empty($model->negeri))$model->negeri = implode(",",$model->negeri);
            if(!empty($model->cawangan))$model->cawangan = implode(",",$model->cawangan);
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-laporan-statistik-atlet-agama'
                    , 'program' => $model->program
                    , 'sukan' => $model->sukan
                    , 'acara' => $model->acara
                    , 'negeri' => $model->negeri
                   // , 'atlet' => $model->atlet
                    , 'cawangan' => $model->cawangan
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-laporan-statistik-atlet-agama'
                    , 'program' => $model->program
                    , 'sukan' => $model->sukan
                    , 'acara' => $model->acara
                    , 'negeri' => $model->negeri
                   // , 'atlet' => $model->atlet
                    , 'cawangan' => $model->cawangan
                    , 'format' => $model->format
                ]);
            }
        } 

        return $this->render('laporan_statistik_atlet_agama', [
            'model' => $model,
            'readonly' => false,
        ]);
    }
    
    public function actionGenerateLaporanStatistikAtletAgama($program, $sukan, $acara, $negeri, $cawangan, $format)
    {
        if($program == "") $program = array();
        else $program = array($program);
        
        if($sukan == "") $sukan = array();
        else $sukan = array($sukan);
        
        if($acara == "") $acara = array();
        else $acara = array($acara);
        
        if($negeri == "") $negeri = array();
        else $negeri = array($negeri);
        
       // if($atlet == "") $atlet = array();
        //else $atlet = array($atlet);
        
        if($cawangan == "") $cawangan = array();
        else $cawangan = array($cawangan);
        
        $controls = array(
            'ACARA' => $acara,
            'PROGRAM' => $program,
            'SUKAN' => $sukan,
            'NEGERI' => $negeri,
            //'ATLET' => $atlet,
            'CAWANGAN' => $cawangan,
        );
        
        GeneralFunction::generateReport('/spsb/MSN/LaporanStatistikAtletAgama', $format, $controls, 'laporan_statistik_atlet_agama');
    }
    
    public function actionLaporanStatistikAtletAgamaParalimpik()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new MsnLaporanSenaraiAtlet();
        $model->format = 'html';

        if ($model->load(Yii::$app->request->post())) {
            
            if(!empty($model->program))$model->program = implode(",",$model->program);
            if(!empty($model->sukan))$model->sukan = implode(",",$model->sukan);
            if(!empty($model->acara))$model->acara = implode(",",$model->acara);
            if(!empty($model->negeri))$model->negeri = implode(",",$model->negeri);
            if(!empty($model->cawangan))$model->cawangan = implode(",",$model->cawangan);
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-laporan-statistik-atlet-agama-paralimpik'
                    , 'program' => $model->program
                    , 'sukan' => $model->sukan
                    , 'acara' => $model->acara
                    , 'negeri' => $model->negeri
                   // , 'atlet' => $model->atlet
                    , 'cawangan' => $model->cawangan
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-laporan-statistik-atlet-agama-paralimpik'
                    , 'program' => $model->program
                    , 'sukan' => $model->sukan
                    , 'acara' => $model->acara
                    , 'negeri' => $model->negeri
                   // , 'atlet' => $model->atlet
                    , 'cawangan' => $model->cawangan
                    , 'format' => $model->format
                ]);
            }
        } 

        return $this->render('laporan_statistik_atlet_agama_paralimpik', [
            'model' => $model,
            'readonly' => false,
        ]);
    }
    
    public function actionGenerateLaporanStatistikAtletAgamaParalimpik($program, $sukan, $acara, $negeri, $cawangan, $format)
    {
        if($program == "") $program = array();
        else $program = array($program);
        
        if($sukan == "") $sukan = array();
        else $sukan = array($sukan);
        
        if($acara == "") $acara = array();
        else $acara = array($acara);
        
        if($negeri == "") $negeri = array();
        else $negeri = array($negeri);
        
        //if($atlet == "") $atlet = array();
       // else $atlet = array($atlet);
        
        if($cawangan == "") $cawangan = array();
        else $cawangan = array($cawangan);
        
        $controls = array(
            'ACARA' => $acara,
            'PROGRAM' => $program,
            'SUKAN' => $sukan,
            'NEGERI' => $negeri,
            //'ATLET' => $atlet,
            'CAWANGAN' => $cawangan,
        );
        
        GeneralFunction::generateReport('/spsb/MSN/LaporanStatistikAtletAgamaParalimpik', $format, $controls, 'laporan_statistik_atlet_agama_paralimpik');
    }
    
    public function actionLaporanStatistikAtletBangsa()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new MsnLaporanSenaraiAtlet();
        $model->format = 'html';

        if ($model->load(Yii::$app->request->post())) {
            
            if(!empty($model->program))$model->program = implode(",",$model->program);
            if(!empty($model->sukan))$model->sukan = implode(",",$model->sukan);
            if(!empty($model->acara))$model->acara = implode(",",$model->acara);
            if(!empty($model->negeri))$model->negeri = implode(",",$model->negeri);
            if(!empty($model->cawangan))$model->cawangan = implode(",",$model->cawangan);
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-laporan-statistik-atlet-bangsa'
                    , 'program' => $model->program
                    , 'sukan' => $model->sukan
                    , 'acara' => $model->acara
                    , 'negeri' => $model->negeri
                    //, 'atlet' => $model->atlet
                    , 'cawangan' => $model->cawangan
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-laporan-statistik-atlet-bangsa'
                    , 'program' => $model->program
                    , 'sukan' => $model->sukan
                    , 'acara' => $model->acara
                    , 'negeri' => $model->negeri
                    //, 'atlet' => $model->atlet
                    , 'cawangan' => $model->cawangan
                    , 'format' => $model->format
                ]);
            }
        } 

        return $this->render('laporan_statistik_atlet_bangsa', [
            'model' => $model,
            'readonly' => false,
        ]);
    }
    
    public function actionGenerateLaporanStatistikAtletBangsa($program, $sukan, $acara, $negeri, $cawangan, $format)
    {
        if($program == "") $program = array();
        else $program = array($program);
        
        if($sukan == "") $sukan = array();
        else $sukan = array($sukan);
        
        if($acara == "") $acara = array();
        else $acara = array($acara);
        
        if($negeri == "") $negeri = array();
        else $negeri = array($negeri);
        
        //if($atlet == "") $atlet = array();
        //else $atlet = array($atlet);
        
        if($cawangan == "") $cawangan = array();
        else $cawangan = array($cawangan);
        
        $controls = array(
            'ACARA' => $acara,
            'PROGRAM' => $program,
            'SUKAN' => $sukan,
            'NEGERI' => $negeri,
            //'ATLET' => $atlet,
            'CAWANGAN' => $cawangan,
        );
        
        GeneralFunction::generateReport('/spsb/MSN/LaporanStatistikAtletBangsa', $format, $controls, 'laporan_statistik_atlet_bangsa');
    }
    
    public function actionLaporanStatistikAtletBangsaParalimpik()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new MsnLaporanSenaraiAtlet();
        $model->format = 'html';

        if ($model->load(Yii::$app->request->post())) {
            
            if(!empty($model->program))$model->program = implode(",",$model->program);
            if(!empty($model->sukan))$model->sukan = implode(",",$model->sukan);
            if(!empty($model->acara))$model->acara = implode(",",$model->acara);
            if(!empty($model->negeri))$model->negeri = implode(",",$model->negeri);
            if(!empty($model->cawangan))$model->cawangan = implode(",",$model->cawangan);
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-laporan-statistik-atlet-bangsa-paralimpik'
                    , 'program' => $model->program
                    , 'sukan' => $model->sukan
                    , 'acara' => $model->acara
                    , 'negeri' => $model->negeri
                   // , 'atlet' => $model->atlet
                    , 'cawangan' => $model->cawangan
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-laporan-statistik-atlet-bangsa-paralimpik'
                    , 'program' => $model->program
                    , 'sukan' => $model->sukan
                    , 'acara' => $model->acara
                    , 'negeri' => $model->negeri
                    //, 'atlet' => $model->atlet
                    , 'cawangan' => $model->cawangan
                    , 'format' => $model->format
                ]);
            }
        } 

        return $this->render('laporan_statistik_atlet_bangsa_paralimpik', [
            'model' => $model,
            'readonly' => false,
        ]);
    }
    
    public function actionGenerateLaporanStatistikAtletBangsaParalimpik($program, $sukan, $acara, $negeri, $cawangan, $format)
    {
        if($program == "") $program = array();
        else $program = array($program);
        
        if($sukan == "") $sukan = array();
        else $sukan = array($sukan);
        
        if($acara == "") $acara = array();
        else $acara = array($acara);
        
        if($negeri == "") $negeri = array();
        else $negeri = array($negeri);
        
        //if($atlet == "") $atlet = array();
        //else $atlet = array($atlet);
        
        if($cawangan == "") $cawangan = array();
        else $cawangan = array($cawangan);
        
        $controls = array(
            'ACARA' => $acara,
            'PROGRAM' => $program,
            'SUKAN' => $sukan,
            'NEGERI' => $negeri,
            //'ATLET' => $atlet,
            'CAWANGAN' => $cawangan,
        );
        
        GeneralFunction::generateReport('/spsb/MSN/LaporanStatistikAtletBangsaParalimpik', $format, $controls, 'laporan_statistik_atlet_bangsa_paralimpik');
    }
    
    public function actionLaporanStatistikAtletPendidikan()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new MsnLaporanSenaraiAtlet();
        $model->format = 'html';

        if ($model->load(Yii::$app->request->post())) {
            if(!empty($model->program))$model->program = implode(",",$model->program);
            if(!empty($model->sukan))$model->sukan = implode(",",$model->sukan);
            if(!empty($model->acara))$model->acara = implode(",",$model->acara);
            if(!empty($model->negeri))$model->negeri = implode(",",$model->negeri);
            if(!empty($model->cawangan))$model->cawangan = implode(",",$model->cawangan);
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-laporan-statistik-atlet-pendidikan'
                    , 'program' => $model->program
                    , 'sukan' => $model->sukan
                    , 'acara' => $model->acara
                    , 'negeri' => $model->negeri
                    //, 'atlet' => $model->atlet
                    , 'cawangan' => $model->cawangan
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-laporan-statistik-atlet-pendidikan'
                    , 'program' => $model->program
                    , 'sukan' => $model->sukan
                    , 'acara' => $model->acara
                    , 'negeri' => $model->negeri
                    //, 'atlet' => $model->atlet
                    , 'cawangan' => $model->cawangan
                    , 'format' => $model->format
                ]);
            }
        } 

        return $this->render('laporan_statistik_atlet_pendidikan', [
            'model' => $model,
            'readonly' => false,
        ]);
    }
    
    public function actionGenerateLaporanStatistikAtletPendidikan($program, $sukan, $acara, $negeri, $cawangan, $format)
    {
        if($program == "") $program = array();
        else $program = array($program);
        
        if($sukan == "") $sukan = array();
        else $sukan = array($sukan);
        
        if($acara == "") $acara = array();
        else $acara = array($acara);
        
        if($negeri == "") $negeri = array();
        else $negeri = array($negeri);
        
        //if($atlet == "") $atlet = array();
        //else $atlet = array($atlet);
        
        if($cawangan == "") $cawangan = array();
        else $cawangan = array($cawangan);
        
        $controls = array(
            'ACARA' => $acara,
            'PROGRAM' => $program,
            'SUKAN' => $sukan,
            'NEGERI' => $negeri,
            //'ATLET' => $atlet,
            'CAWANGAN' => $cawangan,
        );
        
        GeneralFunction::generateReport('/spsb/MSN/LaporanStatistikAtletPendidikan', $format, $controls, 'laporan_statistik_atlet_pendidikan');
    }
    
    public function actionLaporanStatistikAtletPendidikanParalimpik()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new MsnLaporanSenaraiAtlet();
        $model->format = 'html';

        if ($model->load(Yii::$app->request->post())) {
            if(!empty($model->program))$model->program = implode(",",$model->program);
            if(!empty($model->sukan))$model->sukan = implode(",",$model->sukan);
            if(!empty($model->acara))$model->acara = implode(",",$model->acara);
            if(!empty($model->negeri))$model->negeri = implode(",",$model->negeri);
            if(!empty($model->cawangan))$model->cawangan = implode(",",$model->cawangan);
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-laporan-statistik-atlet-pendidikan-paralimpik'
                    , 'program' => $model->program
                    , 'sukan' => $model->sukan
                    , 'acara' => $model->acara
                    , 'negeri' => $model->negeri
                    //, 'atlet' => $model->atlet
                    , 'cawangan' => $model->cawangan
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-laporan-statistik-atlet-pendidikan-paralimpik'
                    , 'program' => $model->program
                    , 'sukan' => $model->sukan
                    , 'acara' => $model->acara
                    , 'negeri' => $model->negeri
                   // , 'atlet' => $model->atlet
                    , 'cawangan' => $model->cawangan
                    , 'format' => $model->format
                ]);
            }
        } 

        return $this->render('laporan_statistik_atlet_pendidikan_paralimpik', [
            'model' => $model,
            'readonly' => false,
        ]);
    }
    
    public function actionGenerateLaporanStatistikAtletPendidikanParalimpik($program, $sukan, $acara, $negeri, $cawangan, $format)
    {
        if($program == "") $program = array();
        else $program = array($program);
        
        if($sukan == "") $sukan = array();
        else $sukan = array($sukan);
        
        if($acara == "") $acara = array();
        else $acara = array($acara);
        
        if($negeri == "") $negeri = array();
        else $negeri = array($negeri);
        
        //if($atlet == "") $atlet = array();
        //else $atlet = array($atlet);
        
        if($cawangan == "") $cawangan = array();
        else $cawangan = array($cawangan);
        
        $controls = array(
            'ACARA' => $acara,
            'PROGRAM' => $program,
            'SUKAN' => $sukan,
            'NEGERI' => $negeri,
            //'ATLET' => $atlet,
            'CAWANGAN' => $cawangan,
        );
        
        GeneralFunction::generateReport('/spsb/MSN/LaporanStatistikAtletPendidikanParalimpik', $format, $controls, 'laporan_statistik_atlet_pendidikan_paralimpik');
    }
    
    public function actionLaporanStatistikAtletUmur()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new MsnLaporanSenaraiAtlet();
        $model->format = 'html';

        if ($model->load(Yii::$app->request->post())) {
            
            if(!empty($model->program))$model->program = implode(",",$model->program);
            if(!empty($model->sukan))$model->sukan = implode(",",$model->sukan);
            if(!empty($model->acara))$model->acara = implode(",",$model->acara);
            if(!empty($model->negeri))$model->negeri = implode(",",$model->negeri);
            if(!empty($model->cawangan))$model->cawangan = implode(",",$model->cawangan);
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-laporan-statistik-atlet-umur'
                    , 'program' => $model->program
                    , 'sukan' => $model->sukan
                    , 'acara' => $model->acara
                    , 'negeri' => $model->negeri
                    //, 'atlet' => $model->atlet
                    , 'cawangan' => $model->cawangan
                   /* , 'umur_dari' => $model->umur_dari
                    , 'umur_hingga' => $model->umur_hingga
                    , 'umur_dari_2' => $model->umur_dari_2
                    , 'umur_hingga_2' => $model->umur_hingga_2
                    , 'umur_dari_3' => $model->umur_dari_3
                    , 'umur_hingga_3' => $model->umur_hingga_3
                    , 'umur_dari_4' => $model->umur_dari_4
                    , 'umur_hingga_4' => $model->umur_hingga_4
                    , 'umur_dari_5' => $model->umur_dari_5
                    , 'umur_hingga_5' => $model->umur_hingga_5
                    , 'umur_dari_6' => $model->umur_dari_6
                    , 'umur_hingga_6' => $model->umur_hingga_6*/
                    , 'format' => $model->format
                ], true);
                $report_url .= '&umur_dari=' . $model->umur_dari . '&umur_hingga=' . $model->umur_hingga;
                $report_url .= '&umur_dari_2=' . $model->umur_dari_2 . '&umur_hingga_2=' . $model->umur_hingga_2;
                $report_url .= '&umur_dari_3=' . $model->umur_dari_3 . '&umur_hingga_3=' . $model->umur_hingga_3;
                $report_url .= '&umur_dari_4=' . $model->umur_dari_4 . '&umur_hingga_4=' . $model->umur_hingga_4;
                $report_url .= '&umur_dari_5=' . $model->umur_dari_5 . '&umur_hingga_5=' . $model->umur_hingga_5;
                $report_url .= '&umur_dari_6=' . $model->umur_dari_6 . '&umur_hingga_6=' . $model->umur_hingga_6;
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                /*return $this->redirect(['generate-laporan-statistik-atlet-umur'
                    , 'program' => $model->program
                    , 'sukan' => $model->sukan
                    , 'acara' => $model->acara
                    , 'negeri' => $model->negeri
                    //, 'atlet' => $model->atlet
                    , 'cawangan' => $model->cawangan
                    , 'umur_dari' => $model->umur_dari
                    , 'umur_hingga' => $model->umur_hingga
                    , 'umur_dari_2' => $model->umur_dari_2
                    , 'umur_hingga_2' => $model->umur_hingga_2
                    , 'umur_dari_3' => $model->umur_dari_3
                    , 'umur_hingga_3' => $model->umur_hingga_3
                    , 'umur_dari_4' => $model->umur_dari_4
                    , 'umur_hingga_4' => $model->umur_hingga_4
                    , 'umur_dari_5' => $model->umur_dari_5
                    , 'umur_hingga_5' => $model->umur_hingga_5
                    , 'umur_dari_6' => $model->umur_dari_6
                    , 'umur_hingga_6' => $model->umur_hingga_6
                    , 'format' => $model->format
                ]);*/
                
                if($model->program == "") $program = array();
                else $program = array($model->program);

                if($model->sukan == "") $sukan = array();
                else $sukan = array($model->sukan);

                if($model->acara == "") $acara = array();
                else $acara = array($model->acara);

                if($model->negeri == "") $negeri = array();
                else $negeri = array($model->negeri);

                if($model->cawangan == "") $cawangan = array();
                else $cawangan = array($model->cawangan);
                
                if($model->umur_dari == "") $umur_dari = array();
                else $umur_dari = array($model->umur_dari);

                if($model->umur_hingga == "") $umur_hingga = array();
                else $umur_hingga = array($model->umur_hingga);

                if($model->umur_dari_2 == "") $umur_dari_2 = array();
                else $umur_dari_2 = array($model->umur_dari_2);

                if($model->umur_hingga_2 == "") $umur_hingga_2 = array();
                else $umur_hingga_2 = array($model->umur_hingga_2);

                if($model->umur_dari_3 == "") $umur_dari_3 = array();
                else $umur_dari_3 = array($model->umur_dari_3);

                if($model->umur_hingga_3 == "") $umur_hingga_3 = array();
                else $umur_hingga_3 = array($model->umur_hingga_3);

                if($model->umur_dari_4 == "") $umur_dari_4 = array();
                else $umur_dari_4 = array($model->umur_dari_4);

                if($model->umur_hingga_4 == "") $umur_hingga_4 = array();
                else $umur_hingga_4 = array($model->umur_hingga_4);

                if($model->umur_dari_5 == "") $umur_dari_5 = array();
                else $umur_dari_5 = array($model->umur_dari_5);

                if($model->umur_hingga_5 == "") $umur_hingga_5 = array();
                else $umur_hingga_5 = array($model->umur_hingga_5);

                if($model->umur_dari_6 == "") $umur_dari_6 = array();
                else $umur_dari_6 = array($model->umur_dari_6);

                if($model->umur_hingga_6 == "") $umur_hingga_6 = array();
                else $umur_hingga_6 = array($model->umur_hingga_6);
                
                $controls = array(
                    'ACARA' => $acara,
                    'PROGRAM' => $program,
                    'SUKAN' => $sukan,
                    'NEGERI' => $negeri,
                    //'ATLET' => $atlet,
                    'CAWANGAN' => $cawangan,
                    'UMUR_FROM_1' => $umur_dari,
                    'UMUR_TO_1' => $umur_hingga,
                    'UMUR_FROM_2' => $umur_dari_2,
                    'UMUR_TO_2' => $umur_hingga_2,
                    'UMUR_FROM_3' => $umur_dari_3,
                    'UMUR_TO_3' => $umur_hingga_3,
                    'UMUR_FROM_4' => $umur_dari_4,
                    'UMUR_TO_4' => $umur_hingga_4,
                    'UMUR_FROM_5' => $umur_dari_5,
                    'UMUR_TO_5' => $umur_hingga_5,
                    'UMUR_FROM_6' => $umur_dari_6,
                    'UMUR_TO_6' => $umur_hingga_6,
                );

                GeneralFunction::generateReport('/spsb/MSN/LaporanStatistikAtletUmur', $model->format, $controls, 'laporan_statistik_atlet_umur');
            }
        } 

        return $this->render('laporan_statistik_atlet_umur', [
            'model' => $model,
            'readonly' => false,
        ]);
    }
    
    public function actionGenerateLaporanStatistikAtletUmur($program, $sukan, $acara, $negeri, $cawangan,
            $umur_dari, $umur_hingga, $umur_dari_2, $umur_hingga_2, $umur_dari_3, $umur_hingga_3, $umur_dari_4, $umur_hingga_4, $umur_dari_5, $umur_hingga_5, 
            $umur_dari_6, $umur_hingga_6,  $format)
    {
        if($program == "") $program = array();
        else $program = array($program);
        
        if($sukan == "") $sukan = array();
        else $sukan = array($sukan);
        
        if($acara == "") $acara = array();
        else $acara = array($acara);
        
        if($negeri == "") $negeri = array();
        else $negeri = array($negeri);
        
        //if($atlet == "") $atlet = array();
        //else $atlet = array($atlet);
        
        if($cawangan == "") $cawangan = array();
        else $cawangan = array($cawangan);
        
        if($umur_dari == "") $umur_dari = array();
        else $umur_dari = array($umur_dari);
        
        if($umur_hingga == "") $umur_hingga = array();
        else $umur_hingga = array($umur_hingga);
        
        if($umur_dari_2 == "") $umur_dari_2 = array();
        else $umur_dari_2 = array($umur_dari_2);
        
        if($umur_hingga_2 == "") $umur_hingga_2 = array();
        else $umur_hingga_2 = array($umur_hingga_2);
        
        if($umur_dari_3 == "") $umur_dari_3 = array();
        else $umur_dari_3 = array($umur_dari_3);
        
        if($umur_hingga_3 == "") $umur_hingga_3 = array();
        else $umur_hingga_3 = array($umur_hingga_3);
        
        if($umur_dari_4 == "") $umur_dari_4 = array();
        else $umur_dari_4 = array($umur_dari_4);
        
        if($umur_hingga_4 == "") $umur_hingga_4 = array();
        else $umur_hingga_4 = array($umur_hingga_4);
        
        if($umur_dari_5 == "") $umur_dari_5 = array();
        else $umur_dari_5 = array($umur_dari_5);
        
        if($umur_hingga_5 == "") $umur_hingga_5 = array();
        else $umur_hingga_5 = array($umur_hingga_5);
        
        if($umur_dari_6 == "") $umur_dari_6 = array();
        else $umur_dari_6 = array($umur_dari_6);
        
        if($umur_hingga_6 == "") $umur_hingga_6 = array();
        else $umur_hingga_6 = array($umur_hingga_6);
        
        $controls = array(
            'ACARA' => $acara,
            'PROGRAM' => $program,
            'SUKAN' => $sukan,
            'NEGERI' => $negeri,
            //'ATLET' => $atlet,
            'CAWANGAN' => $cawangan,
            'UMUR_FROM_1' => $umur_dari,
            'UMUR_TO_1' => $umur_hingga,
            'UMUR_FROM_2' => $umur_dari_2,
            'UMUR_TO_2' => $umur_hingga_2,
            'UMUR_FROM_3' => $umur_dari_3,
            'UMUR_TO_3' => $umur_hingga_3,
            'UMUR_FROM_4' => $umur_dari_4,
            'UMUR_TO_4' => $umur_hingga_4,
            'UMUR_FROM_5' => $umur_dari_5,
            'UMUR_TO_5' => $umur_hingga_5,
            'UMUR_FROM_6' => $umur_dari_6,
            'UMUR_TO_6' => $umur_hingga_6,
        );
        
        GeneralFunction::generateReport('/spsb/MSN/LaporanStatistikAtletUmur', $format, $controls, 'laporan_statistik_atlet_umur');
    }
    
    public function actionLaporanStatistikAtletUmurParalimpik()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new MsnLaporanSenaraiAtlet();
        $model->format = 'html';

        if ($model->load(Yii::$app->request->post())) {
            
            if(!empty($model->program))$model->program = implode(",",$model->program);
            if(!empty($model->sukan))$model->sukan = implode(",",$model->sukan);
            if(!empty($model->acara))$model->acara = implode(",",$model->acara);
            if(!empty($model->negeri))$model->negeri = implode(",",$model->negeri);
            if(!empty($model->cawangan))$model->cawangan = implode(",",$model->cawangan);
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-laporan-statistik-atlet-umur-paralimpik'
                    , 'program' => $model->program
                    , 'sukan' => $model->sukan
                    , 'acara' => $model->acara
                    , 'negeri' => $model->negeri
                    //, 'atlet' => $model->atlet
                    , 'cawangan' => $model->cawangan
                   /* , 'umur_dari' => $model->umur_dari
                    , 'umur_hingga' => $model->umur_hingga
                    , 'umur_dari_2' => $model->umur_dari_2
                    , 'umur_hingga_2' => $model->umur_hingga_2
                    , 'umur_dari_3' => $model->umur_dari_3
                    , 'umur_hingga_3' => $model->umur_hingga_3
                    , 'umur_dari_4' => $model->umur_dari_4
                    , 'umur_hingga_4' => $model->umur_hingga_4
                    , 'umur_dari_5' => $model->umur_dari_5
                    , 'umur_hingga_5' => $model->umur_hingga_5
                    , 'umur_dari_6' => $model->umur_dari_6
                    , 'umur_hingga_6' => $model->umur_hingga_6*/
                    , 'format' => $model->format
                ], true);
                $report_url .= '&umur_dari=' . $model->umur_dari . '&umur_hingga=' . $model->umur_hingga;
                $report_url .= '&umur_dari_2=' . $model->umur_dari_2 . '&umur_hingga_2=' . $model->umur_hingga_2;
                $report_url .= '&umur_dari_3=' . $model->umur_dari_3 . '&umur_hingga_3=' . $model->umur_hingga_3;
                $report_url .= '&umur_dari_4=' . $model->umur_dari_4 . '&umur_hingga_4=' . $model->umur_hingga_4;
                $report_url .= '&umur_dari_5=' . $model->umur_dari_5 . '&umur_hingga_5=' . $model->umur_hingga_5;
                $report_url .= '&umur_dari_6=' . $model->umur_dari_6 . '&umur_hingga_6=' . $model->umur_hingga_6;
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                /*return $this->redirect(['generate-laporan-statistik-atlet-umur-paralimpik'
                    , 'program' => $model->program
                    , 'sukan' => $model->sukan
                    , 'acara' => $model->acara
                    , 'negeri' => $model->negeri
                    //, 'atlet' => $model->atlet
                    , 'cawangan' => $model->cawangan
                    , 'umur_dari' => $model->umur_dari
                    , 'umur_hingga' => $model->umur_hingga
                    , 'umur_dari_2' => $model->umur_dari_2
                    , 'umur_hingga_2' => $model->umur_hingga_2
                    , 'umur_dari_3' => $model->umur_dari_3
                    , 'umur_hingga_3' => $model->umur_hingga_3
                    , 'umur_dari_4' => $model->umur_dari_4
                    , 'umur_hingga_4' => $model->umur_hingga_4
                    , 'umur_dari_5' => $model->umur_dari_5
                    , 'umur_hingga_5' => $model->umur_hingga_5
                    , 'umur_dari_6' => $model->umur_dari_6
                    , 'umur_hingga_6' => $model->umur_hingga_6
                    , 'format' => $model->format
                ]);*/
                
                if($model->program == "") $program = array();
                else $program = array($model->program);

                if($model->sukan == "") $sukan = array();
                else $sukan = array($model->sukan);

                if($model->acara == "") $acara = array();
                else $acara = array($model->acara);

                if($model->negeri == "") $negeri = array();
                else $negeri = array($model->negeri);

                if($model->cawangan == "") $cawangan = array();
                else $cawangan = array($model->cawangan);
                
                if($model->umur_dari == "") $umur_dari = array();
                else $umur_dari = array($model->umur_dari);

                if($model->umur_hingga == "") $umur_hingga = array();
                else $umur_hingga = array($model->umur_hingga);

                if($model->umur_dari_2 == "") $umur_dari_2 = array();
                else $umur_dari_2 = array($model->umur_dari_2);

                if($model->umur_hingga_2 == "") $umur_hingga_2 = array();
                else $umur_hingga_2 = array($model->umur_hingga_2);

                if($model->umur_dari_3 == "") $umur_dari_3 = array();
                else $umur_dari_3 = array($model->umur_dari_3);

                if($model->umur_hingga_3 == "") $umur_hingga_3 = array();
                else $umur_hingga_3 = array($model->umur_hingga_3);

                if($model->umur_dari_4 == "") $umur_dari_4 = array();
                else $umur_dari_4 = array($model->umur_dari_4);

                if($model->umur_hingga_4 == "") $umur_hingga_4 = array();
                else $umur_hingga_4 = array($model->umur_hingga_4);

                if($model->umur_dari_5 == "") $umur_dari_5 = array();
                else $umur_dari_5 = array($model->umur_dari_5);

                if($model->umur_hingga_5 == "") $umur_hingga_5 = array();
                else $umur_hingga_5 = array($model->umur_hingga_5);

                if($model->umur_dari_6 == "") $umur_dari_6 = array();
                else $umur_dari_6 = array($model->umur_dari_6);

                if($model->umur_hingga_6 == "") $umur_hingga_6 = array();
                else $umur_hingga_6 = array($model->umur_hingga_6);
                
                $controls = array(
                    'ACARA' => $acara,
                    'PROGRAM' => $program,
                    'SUKAN' => $sukan,
                    'NEGERI' => $negeri,
                    //'ATLET' => $atlet,
                    'CAWANGAN' => $cawangan,
                    'UMUR_FROM_1' => $umur_dari,
                    'UMUR_TO_1' => $umur_hingga,
                    'UMUR_FROM_2' => $umur_dari_2,
                    'UMUR_TO_2' => $umur_hingga_2,
                    'UMUR_FROM_3' => $umur_dari_3,
                    'UMUR_TO_3' => $umur_hingga_3,
                    'UMUR_FROM_4' => $umur_dari_4,
                    'UMUR_TO_4' => $umur_hingga_4,
                    'UMUR_FROM_5' => $umur_dari_5,
                    'UMUR_TO_5' => $umur_hingga_5,
                    'UMUR_FROM_6' => $umur_dari_6,
                    'UMUR_TO_6' => $umur_hingga_6,
                );

                GeneralFunction::generateReport('/spsb/MSN/LaporanStatistikAtletUmurParalimpik', $model->format, $controls, 'laporan_statistik_atlet_umur_paralimpik');
            }
        } 

        return $this->render('laporan_statistik_atlet_umur_paralimpik', [
            'model' => $model,
            'readonly' => false,
        ]);
    }
    
    public function actionGenerateLaporanStatistikAtletUmurParalimpik($program, $sukan, $acara, $negeri, $cawangan,
            $umur_dari, $umur_hingga, $umur_dari_2, $umur_hingga_2, $umur_dari_3, $umur_hingga_3, $umur_dari_4, $umur_hingga_4, $umur_dari_5, $umur_hingga_5, 
            $umur_dari_6, $umur_hingga_6, $format)
    {
        if($program == "") $program = array();
        else $program = array($program);
        
        if($sukan == "") $sukan = array();
        else $sukan = array($sukan);
        
        if($acara == "") $acara = array();
        else $acara = array($acara);
        
        if($negeri == "") $negeri = array();
        else $negeri = array($negeri);
        
        //if($atlet == "") $atlet = array();
        //else $atlet = array($atlet);
        
        if($cawangan == "") $cawangan = array();
        else $cawangan = array($cawangan);
        
        if($umur_dari == "") $umur_dari = array();
        else $umur_dari = array($umur_dari);
        
        if($umur_hingga == "") $umur_hingga = array();
        else $umur_hingga = array($umur_hingga);
        
        if($umur_dari_2 == "") $umur_dari_2 = array();
        else $umur_dari_2 = array($umur_dari_2);
        
        if($umur_hingga_2 == "") $umur_hingga_2 = array();
        else $umur_hingga_2 = array($umur_hingga_2);
        
        if($umur_dari_3 == "") $umur_dari_3 = array();
        else $umur_dari_3 = array($umur_dari_3);
        
        if($umur_hingga_3 == "") $umur_hingga_3 = array();
        else $umur_hingga_3 = array($umur_hingga_3);
        
        if($umur_dari_4 == "") $umur_dari_4 = array();
        else $umur_dari_4 = array($umur_dari_4);
        
        if($umur_hingga_4 == "") $umur_hingga_4 = array();
        else $umur_hingga_4 = array($umur_hingga_4);
        
        if($umur_dari_5 == "") $umur_dari_5 = array();
        else $umur_dari_5 = array($umur_dari_5);
        
        if($umur_hingga_5 == "") $umur_hingga_5 = array();
        else $umur_hingga_5 = array($umur_hingga_5);
        
        if($umur_dari_6 == "") $umur_dari_6 = array();
        else $umur_dari_6 = array($umur_dari_6);
        
        if($umur_hingga_6 == "") $umur_hingga_6 = array();
        else $umur_hingga_6 = array($umur_hingga_6);
        
        $controls = array(
            'ACARA' => $acara,
            'PROGRAM' => $program,
            'SUKAN' => $sukan,
            'NEGERI' => $negeri,
            //'ATLET' => $atlet,
            'CAWANGAN' => $cawangan,
            'UMUR_FROM_1' => $umur_dari,
            'UMUR_TO_1' => $umur_hingga,
            'UMUR_FROM_2' => $umur_dari_2,
            'UMUR_TO_2' => $umur_hingga_2,
            'UMUR_FROM_3' => $umur_dari_3,
            'UMUR_TO_3' => $umur_hingga_3,
            'UMUR_FROM_4' => $umur_dari_4,
            'UMUR_TO_4' => $umur_hingga_4,
            'UMUR_FROM_5' => $umur_dari_5,
            'UMUR_TO_5' => $umur_hingga_5,
            'UMUR_FROM_6' => $umur_dari_6,
            'UMUR_TO_6' => $umur_hingga_6,
        );
        
        GeneralFunction::generateReport('/spsb/MSN/LaporanStatistikAtletUmurParalimpik', $format, $controls, 'laporan_statistik_atlet_umur_paralimpik');
    }
    
    public function actionLaporanStatistikAtletInstitusiSekolah()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new MsnLaporanSenaraiAtlet();
        $model->format = 'html';

        if ($model->load(Yii::$app->request->post())) {
            if(!empty($model->program))$model->program = implode(",",$model->program);
            if(!empty($model->sukan))$model->sukan = implode(",",$model->sukan);
            if(!empty($model->acara))$model->acara = implode(",",$model->acara);
            if(!empty($model->negeri))$model->negeri = implode(",",$model->negeri);
            if(!empty($model->cawangan))$model->cawangan = implode(",",$model->cawangan);
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-laporan-statistik-atlet-institusi-sekolah'
                    , 'program' => $model->program
                    , 'sukan' => $model->sukan
                    , 'acara' => $model->acara
                    , 'negeri' => $model->negeri
                    //, 'atlet' => $model->atlet
                    , 'cawangan' => $model->cawangan
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-laporan-statistik-atlet-institusi-sekolah'
                    , 'program' => $model->program
                    , 'sukan' => $model->sukan
                    , 'acara' => $model->acara
                    , 'negeri' => $model->negeri
                    //, 'atlet' => $model->atlet
                    , 'cawangan' => $model->cawangan
                    , 'format' => $model->format
                ]);
            }
        } 

        return $this->render('laporan_statistik_atlet_institusi_sekolah', [
            'model' => $model,
            'readonly' => false,
        ]);
    }
    
    public function actionGenerateLaporanStatistikAtletInstitusiSekolah($program, $sukan, $acara, $negeri, $cawangan, $format)
    {
        if($program == "") $program = array();
        else $program = array($program);
        
        if($sukan == "") $sukan = array();
        else $sukan = array($sukan);
        
        if($acara == "") $acara = array();
        else $acara = array($acara);
        
        if($negeri == "") $negeri = array();
        else $negeri = array($negeri);
        
        //if($atlet == "") $atlet = array();
        //else $atlet = array($atlet);
        
        if($cawangan == "") $cawangan = array();
        else $cawangan = array($cawangan);
        
        $controls = array(
            'ACARA' => $acara,
            'PROGRAM' => $program,
            'SUKAN' => $sukan,
            'NEGERI' => $negeri,
            //'ATLET' => $atlet,
            'CAWANGAN' => $cawangan,
        );
        
        GeneralFunction::generateReport('/spsb/MSN/LaporanStatistikAtletInstitusiSekolah', $format, $controls, 'laporan_statistik_atlet_institusi_sekolah');
    }
    
    public function actionLaporanStatistikAtletInstitusiSekolahParalimpik()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new MsnLaporanSenaraiAtlet();
        $model->format = 'html';

        if ($model->load(Yii::$app->request->post())) {
            if(!empty($model->program))$model->program = implode(",",$model->program);
            if(!empty($model->sukan))$model->sukan = implode(",",$model->sukan);
            if(!empty($model->acara))$model->acara = implode(",",$model->acara);
            if(!empty($model->negeri))$model->negeri = implode(",",$model->negeri);
            if(!empty($model->cawangan))$model->cawangan = implode(",",$model->cawangan);
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-laporan-statistik-atlet-institusi-sekolah-paralimpik'
                    , 'program' => $model->program
                    , 'sukan' => $model->sukan
                    , 'acara' => $model->acara
                    , 'negeri' => $model->negeri
                   // , 'atlet' => $model->atlet
                    , 'cawangan' => $model->cawangan
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-laporan-statistik-atlet-institusi-sekolah-paralimpik'
                    , 'program' => $model->program
                    , 'sukan' => $model->sukan
                    , 'acara' => $model->acara
                    , 'negeri' => $model->negeri
                    //, 'atlet' => $model->atlet
                    , 'cawangan' => $model->cawangan
                    , 'format' => $model->format
                ]);
            }
        } 

        return $this->render('laporan_statistik_atlet_institusi_sekolah_paralimpik', [
            'model' => $model,
            'readonly' => false,
        ]);
    }
    
    public function actionGenerateLaporanStatistikAtletInstitusiSekolahParalimpik($program, $sukan, $acara, $negeri, $cawangan, $format)
    {
        if($program == "") $program = array();
        else $program = array($program);
        
        if($sukan == "") $sukan = array();
        else $sukan = array($sukan);
        
        if($acara == "") $acara = array();
        else $acara = array($acara);
        
        if($negeri == "") $negeri = array();
        else $negeri = array($negeri);
        
        //if($atlet == "") $atlet = array();
        //else $atlet = array($atlet);
        
        if($cawangan == "") $cawangan = array();
        else $cawangan = array($cawangan);
        
        $controls = array(
            'ACARA' => $acara,
            'PROGRAM' => $program,
            'SUKAN' => $sukan,
            'NEGERI' => $negeri,
            //'ATLET' => $atlet,
            'CAWANGAN' => $cawangan,
        );
        
        GeneralFunction::generateReport('/spsb/MSN/LaporanStatistikAtletInstitusiSekolahParalimpik', $format, $controls, 'laporan_statistik_atlet_institusi_sekolah_paralimpik');
    }
    
    public function actionLaporanAtletElaun()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new MsnLaporanSenaraiAtlet();
        $model->format = 'html';

        if ($model->load(Yii::$app->request->post())) {
            if(!empty($model->program))$model->program = implode(",",$model->program);
            if(!empty($model->sukan))$model->sukan = implode(",",$model->sukan);
            if(!empty($model->acara))$model->acara = implode(",",$model->acara);
            if(!empty($model->negeri))$model->negeri = implode(",",$model->negeri);
            if(!empty($model->atlet))$model->atlet = implode(",",$model->atlet);
            if(!empty($model->cawangan))$model->cawangan = implode(",",$model->cawangan);
            if(!empty($model->jenis_elaun))$model->jenis_elaun = implode(",",$model->jenis_elaun);
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-laporan-atlet-elaun'
                    , 'program' => $model->program
                    , 'sukan' => $model->sukan
                    , 'acara' => $model->acara
                    , 'negeri' => $model->negeri
                    , 'atlet' => $model->atlet
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'cawangan' => $model->cawangan
                    , 'jenis_elaun' => $model->jenis_elaun
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-laporan-atlet-elaun'
                    , 'program' => $model->program
                    , 'sukan' => $model->sukan
                    , 'acara' => $model->acara
                    , 'negeri' => $model->negeri
                    , 'atlet' => $model->atlet
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'cawangan' => $model->cawangan
                    , 'jenis_elaun' => $model->jenis_elaun
                    , 'format' => $model->format
                ]);
            }
        } 

        return $this->render('laporan_atlet_elaun', [
            'model' => $model,
            'readonly' => false,
        ]);
    }
    
    public function actionGenerateLaporanAtletElaun($program, $sukan, $acara, $negeri, $atlet, $tarikh_dari, $tarikh_hingga, $cawangan, $jenis_elaun, $format)
    {
        if($program == "") $program = array();
        else $program = array($program);
        
        if($sukan == "") $sukan = array();
        else $sukan = array($sukan);
        
        if($acara == "") $acara = array();
        else $acara = array($acara);
        
        if($negeri == "") $negeri = array();
        else $negeri = array($negeri);
        
        if($atlet == "") $atlet = array();
        else $atlet = array($atlet);
        
        if($tarikh_dari == "") $tarikh_dari = array();
        else $tarikh_dari = array($tarikh_dari);
        
        if($tarikh_hingga == "") $tarikh_hingga = array();
        else $tarikh_hingga = array($tarikh_hingga);
        
        if($cawangan == "") $cawangan = array();
        else $cawangan = array($cawangan);
        
        if($jenis_elaun == "") $jenis_elaun = array();
        else $jenis_elaun = array($jenis_elaun);
        
        $controls = array(
            'ACARA' => $acara,
            'PROGRAM' => $program,
            'SUKAN' => $sukan,
            'NEGERI' => $negeri,
            'ATLET' => $atlet,
            'FROM_DATE' => $tarikh_dari,
            'TO_DATE' => $tarikh_hingga,
            'CAWANGAN' => $cawangan,
            'JENIS_ELAUN' => $jenis_elaun,
        );
        
        GeneralFunction::generateReport('/spsb/MSN/LaporanAtletElaun', $format, $controls, 'laporan_atlet_elaun');
    }
    
    public function actionLaporanAtletElaunParalimpik()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new MsnLaporanSenaraiAtlet();
        $model->format = 'html';

        if ($model->load(Yii::$app->request->post())) {
            if(!empty($model->program))$model->program = implode(",",$model->program);
            if(!empty($model->sukan))$model->sukan = implode(",",$model->sukan);
            if(!empty($model->acara))$model->acara = implode(",",$model->acara);
            if(!empty($model->negeri))$model->negeri = implode(",",$model->negeri);
            if(!empty($model->atlet))$model->atlet = implode(",",$model->atlet);
            if(!empty($model->cawangan))$model->cawangan = implode(",",$model->cawangan);
            if(!empty($model->jenis_elaun))$model->jenis_elaun = implode(",",$model->jenis_elaun);
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-laporan-atlet-elaun-paralimpik'
                    , 'program' => $model->program
                    , 'sukan' => $model->sukan
                    , 'acara' => $model->acara
                    , 'negeri' => $model->negeri
                    , 'atlet' => $model->atlet
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'cawangan' => $model->cawangan
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-laporan-atlet-elaun-paralimpik'
                    , 'program' => $model->program
                    , 'sukan' => $model->sukan
                    , 'acara' => $model->acara
                    , 'negeri' => $model->negeri
                    , 'atlet' => $model->atlet
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'cawangan' => $model->cawangan
                    , 'format' => $model->format
                ]);
            }
        } 

        return $this->render('laporan_atlet_elaun_paralimpik', [
            'model' => $model,
            'readonly' => false,
        ]);
    }
    
    public function actionGenerateLaporanAtletElaunParalimpik($program, $sukan, $acara, $negeri, $atlet, $tarikh_dari, $tarikh_hingga, $cawangan, $format)
    {
        if($program == "") $program = array();
        else $program = array($program);
        
        if($sukan == "") $sukan = array();
        else $sukan = array($sukan);
        
        if($acara == "") $acara = array();
        else $acara = array($acara);
        
        if($negeri == "") $negeri = array();
        else $negeri = array($negeri);
        
        if($atlet == "") $atlet = array();
        else $atlet = array($atlet);
        
        if($tarikh_dari == "") $tarikh_dari = array();
        else $tarikh_dari = array($tarikh_dari);
        
        if($tarikh_hingga == "") $tarikh_hingga = array();
        else $tarikh_hingga = array($tarikh_hingga);
        
        if($cawangan == "") $cawangan = array();
        else $cawangan = array($cawangan);
        
        $controls = array(
            'ACARA' => $acara,
            'PROGRAM' => $program,
            'SUKAN' => $sukan,
            'NEGERI' => $negeri,
            'ATLET' => $atlet,
            'FROM_DATE' => $tarikh_dari,
            'TO_DATE' => $tarikh_hingga,
            'CAWANGAN' => $cawangan,
        );
        
        GeneralFunction::generateReport('/spsb/MSN/LaporanAtletElaunParalimpik', $format, $controls, 'laporan_atlet_elaun_paralimpik');
    }
    
    public function actionLaporanAtletPakaianSukan()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new MsnLaporanSenaraiAtlet();
        $model->format = 'html';

        /*if ($model->load(Yii::$app->request->post())) {
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-laporan-atlet-pakaian-sukan'
                    , 'program' => $model->program
                    , 'sukan' => $model->sukan
                    , 'acara' => $model->acara
                    , 'negeri' => $model->negeri
                    , 'atlet' => $model->atlet
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'cawangan' => $model->cawangan
                    , 'jenis_pakaian' => $model->jenis_pakaian
                    , 'saiz_pakaian' => $model->saiz_pakaian
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-laporan-atlet-pakaian-sukan'
                    , 'program' => $model->program
                    , 'sukan' => $model->sukan
                    , 'acara' => $model->acara
                    , 'negeri' => $model->negeri
                    , 'atlet' => $model->atlet
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'cawangan' => $model->cawangan
                    , 'jenis_pakaian' => $model->jenis_pakaian
                    , 'saiz_pakaian' => $model->saiz_pakaian
                    , 'format' => $model->format
                ]);
            }
        } 

        return $this->render('laporan_atlet_pakaian_sukan', [
            'model' => $model,
            'readonly' => false,
        ]);*/
        
        
        
        if ($model->load(Yii::$app->request->post())) {
            
            if(!empty($model->program))$model->program = implode(",",$model->program);
            if(!empty($model->sukan))$model->sukan = implode(",",$model->sukan);
            if(!empty($model->acara))$model->acara = implode(",",$model->acara);
            if(!empty($model->negeri))$model->negeri = implode(",",$model->negeri);
            if(!empty($model->atlet))$model->atlet = implode(",",$model->atlet);
            if(!empty($model->cawangan))$model->cawangan = implode(",",$model->cawangan);
            if(!empty($model->jenis_pakaian))$model->jenis_pakaian = implode(",",$model->jenis_pakaian);
            if(!empty($model->saiz_pakaian))$model->saiz_pakaian = implode(",",$model->saiz_pakaian);
            
            if($model->format == "html") {
                /*$report_url = BaseUrl::to(['generate-laporan-atlet-pakaian-sukan-paralimpik'
                    , 'program' => $model->program
                    , 'sukan' => $model->sukan
                    , 'acara' => $model->acara
                    , 'negeri' => $model->negeri
                    , 'atlet' => $model->atlet
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'cawangan' => $model->cawangan
                    , 'jenis_pakaian' => $model->jenis_pakaian
                    , 'saiz_pakaian' => $model->saiz_pakaian
                    , 'format' => $model->format
                ], true);*/
                $report_url = BaseUrl::to(['generate-laporan-atlet-pakaian-sukan'
                    , 'program' => $model->program
                    , 'sukan' => $model->sukan
                    , 'acara' => $model->acara
                    , 'negeri' => $model->negeri
                    , 'atlet' => $model->atlet
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'cawangan' => $model->cawangan
                    , 'format' => $model->format
                ], true);
                $report_url .= '&jenis_pakaian=' . $model->jenis_pakaian . '&saiz_pakaian=' . $model->saiz_pakaian;
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                /*return $this->redirect(['generate-laporan-atlet-pakaian-sukan-paralimpik'
                    , 'program' => $model->program
                    , 'sukan' => $model->sukan
                    , 'acara' => $model->acara
                    , 'negeri' => $model->negeri
                    , 'atlet' => $model->atlet
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'cawangan' => $model->cawangan
                    , 'jenis_pakaian' => $model->jenis_pakaian
                    , 'saiz_pakaian' => $model->saiz_pakaian
                    , 'format' => $model->format
                ]);*/
                
                if($model->program == "") $program = array();
        else $program = array($model->program);
        
        if($model->sukan == "") $sukan = array();
        else $sukan = array($model->sukan);
        
        if($model->acara == "") $acara = array();
        else $acara = array($model->acara);
        
        if($model->negeri == "") $negeri = array();
        else $negeri = array($model->negeri);
        
        if($model->atlet == "") $atlet = array();
        else $atlet = array($model->atlet);
        
        if($model->tarikh_dari == "") $tarikh_dari = array();
        else $tarikh_dari = array($model->tarikh_dari);
        
        if($model->tarikh_hingga == "") $tarikh_hingga = array();
        else $tarikh_hingga = array($model->tarikh_hingga);
        
        if($model->cawangan == "") $cawangan = array();
        else $cawangan = array($model->cawangan);
        
        if($model->jenis_pakaian == "") $jenis_pakaian = array();
        else $jenis_pakaian = array($model->jenis_pakaian);
        
        if($model->saiz_pakaian == "") $saiz_pakaian = array();
        else $saiz_pakaian = array($model->saiz_pakaian);
        
        $controls = array(
            'ACARA' => $acara,
            'PROGRAM' => $program,
            'SUKAN' => $sukan,
            'NEGERI' => $negeri,
            'ATLET' => $atlet,
            'FROM_DATE' => $tarikh_dari,
            'TO_DATE' => $tarikh_hingga,
            'CAWANGAN' => $cawangan,
            'JENIS_PAKAIAN' => $jenis_pakaian,
            'SAIZ' => $saiz_pakaian,
        );
        
        GeneralFunction::generateReport('/spsb/MSN/LaporanAtletPakaianSukan', $model->format, $controls, 'laporan_atlet_pakaian_sukan');
            }
        } 

        return $this->render('laporan_atlet_pakaian_sukan', [
            'model' => $model,
            'readonly' => false,
        ]);
    }
    
    public function actionGenerateLaporanAtletPakaianSukan($program, $sukan, $acara, $negeri, $atlet, $tarikh_dari, $tarikh_hingga, $cawangan, $jenis_pakaian, $saiz_pakaian, $format)
    {
        if($program == "") $program = array();
        else $program = array($program);
        
        if($sukan == "") $sukan = array();
        else $sukan = array($sukan);
        
        if($acara == "") $acara = array();
        else $acara = array($acara);
        
        if($negeri == "") $negeri = array();
        else $negeri = array($negeri);
        
        if($atlet == "") $atlet = array();
        else $atlet = array($atlet);
        
        if($tarikh_dari == "") $tarikh_dari = array();
        else $tarikh_dari = array($tarikh_dari);
        
        if($tarikh_hingga == "") $tarikh_hingga = array();
        else $tarikh_hingga = array($tarikh_hingga);
        
        if($cawangan == "") $cawangan = array();
        else $cawangan = array($cawangan);
        
        if($jenis_pakaian == "") $jenis_pakaian = array();
        else $jenis_pakaian = array($jenis_pakaian);
        
        if($saiz_pakaian == "") $saiz_pakaian = array();
        else $saiz_pakaian = array($saiz_pakaian);
        
        $controls = array(
            'ACARA' => $acara,
            'PROGRAM' => $program,
            'SUKAN' => $sukan,
            'NEGERI' => $negeri,
            'ATLET' => $atlet,
            'FROM_DATE' => $tarikh_dari,
            'TO_DATE' => $tarikh_hingga,
            'CAWANGAN' => $cawangan,
            'JENIS_PAKAIAN' => $jenis_pakaian,
            'SAIZ' => $saiz_pakaian,
        );
        
        GeneralFunction::generateReport('/spsb/MSN/LaporanAtletPakaianSukan', $format, $controls, 'laporan_atlet_pakaian_sukan');
    }
    
    public function actionLaporanAtletPakaianSukanParalimpik()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new MsnLaporanSenaraiAtlet();
        $model->format = 'html';

        if ($model->load(Yii::$app->request->post())) {
            
            if(!empty($model->program))$model->program = implode(",",$model->program);
            if(!empty($model->sukan))$model->sukan = implode(",",$model->sukan);
            if(!empty($model->acara))$model->acara = implode(",",$model->acara);
            if(!empty($model->negeri))$model->negeri = implode(",",$model->negeri);
            if(!empty($model->atlet))$model->atlet = implode(",",$model->atlet);
            if(!empty($model->cawangan))$model->cawangan = implode(",",$model->cawangan);
            if(!empty($model->jenis_pakaian))$model->jenis_pakaian = implode(",",$model->jenis_pakaian);
            if(!empty($model->saiz_pakaian))$model->saiz_pakaian = implode(",",$model->saiz_pakaian);
            
            if($model->format == "html") {
                /*$report_url = BaseUrl::to(['generate-laporan-atlet-pakaian-sukan-paralimpik'
                    , 'program' => $model->program
                    , 'sukan' => $model->sukan
                    , 'acara' => $model->acara
                    , 'negeri' => $model->negeri
                    , 'atlet' => $model->atlet
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'cawangan' => $model->cawangan
                    , 'jenis_pakaian' => $model->jenis_pakaian
                    , 'saiz_pakaian' => $model->saiz_pakaian
                    , 'format' => $model->format
                ], true);*/
                $report_url = BaseUrl::to(['generate-laporan-atlet-pakaian-sukan-paralimpik'
                    , 'program' => $model->program
                    , 'sukan' => $model->sukan
                    , 'acara' => $model->acara
                    , 'negeri' => $model->negeri
                    , 'atlet' => $model->atlet
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'cawangan' => $model->cawangan
                    , 'format' => $model->format
                ], true);
                $report_url .= '&jenis_pakaian=' . $model->jenis_pakaian . '&saiz_pakaian=' . $model->saiz_pakaian;
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                /*return $this->redirect(['generate-laporan-atlet-pakaian-sukan-paralimpik'
                    , 'program' => $model->program
                    , 'sukan' => $model->sukan
                    , 'acara' => $model->acara
                    , 'negeri' => $model->negeri
                    , 'atlet' => $model->atlet
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'cawangan' => $model->cawangan
                    , 'jenis_pakaian' => $model->jenis_pakaian
                    , 'saiz_pakaian' => $model->saiz_pakaian
                    , 'format' => $model->format
                ]);*/
                
                if($model->program == "") $program = array();
        else $program = array($model->program);
        
        if($model->sukan == "") $sukan = array();
        else $sukan = array($model->sukan);
        
        if($model->acara == "") $acara = array();
        else $acara = array($model->acara);
        
        if($model->negeri == "") $negeri = array();
        else $negeri = array($model->negeri);
        
        if($model->atlet == "") $atlet = array();
        else $atlet = array($model->atlet);
        
        if($model->tarikh_dari == "") $tarikh_dari = array();
        else $tarikh_dari = array($model->tarikh_dari);
        
        if($model->tarikh_hingga == "") $tarikh_hingga = array();
        else $tarikh_hingga = array($model->tarikh_hingga);
        
        if($model->cawangan == "") $cawangan = array();
        else $cawangan = array($model->cawangan);
        
        if($model->jenis_pakaian == "") $jenis_pakaian = array();
        else $jenis_pakaian = array($model->jenis_pakaian);
        
        if($model->saiz_pakaian == "") $saiz_pakaian = array();
        else $saiz_pakaian = array($model->saiz_pakaian);
        
        $controls = array(
            'ACARA' => $acara,
            'PROGRAM' => $program,
            'SUKAN' => $sukan,
            'NEGERI' => $negeri,
            'ATLET' => $atlet,
            'FROM_DATE' => $tarikh_dari,
            'TO_DATE' => $tarikh_hingga,
            'CAWANGAN' => $cawangan,
            'JENIS_PAKAIAN' => $jenis_pakaian,
            'SAIZ' => $saiz_pakaian,
        );
        
        GeneralFunction::generateReport('/spsb/MSN/LaporanAtletPakaianSukanParalimpik', $model->format, $controls, 'laporan_atlet_pakaian_sukan_paralimpik');
            }
        } 

        return $this->render('laporan_atlet_pakaian_sukan_paralimpik', [
            'model' => $model,
            'readonly' => false,
        ]);
    }
    
    public function actionGenerateLaporanAtletPakaianSukanParalimpik($program, $sukan, $acara, $negeri, $atlet, $tarikh_dari, $tarikh_hingga, $cawangan, $jenis_pakaian, $saiz_pakaian, $format)
    {
        if($program == "") $program = array();
        else $program = array($program);
        
        if($sukan == "") $sukan = array();
        else $sukan = array($sukan);
        
        if($acara == "") $acara = array();
        else $acara = array($acara);
        
        if($negeri == "") $negeri = array();
        else $negeri = array($negeri);
        
        if($atlet == "") $atlet = array();
        else $atlet = array($atlet);
        
        if($tarikh_dari == "") $tarikh_dari = array();
        else $tarikh_dari = array($tarikh_dari);
        
        if($tarikh_hingga == "") $tarikh_hingga = array();
        else $tarikh_hingga = array($tarikh_hingga);
        
        if($cawangan == "") $cawangan = array();
        else $cawangan = array($cawangan);
        
        if($jenis_pakaian == "") $jenis_pakaian = array();
        else $jenis_pakaian = array($jenis_pakaian);
        
        if($saiz_pakaian == "") $saiz_pakaian = array();
        else $saiz_pakaian = array($saiz_pakaian);
        
        $controls = array(
            'ACARA' => $acara,
            'PROGRAM' => $program,
            'SUKAN' => $sukan,
            'NEGERI' => $negeri,
            'ATLET' => $atlet,
            'FROM_DATE' => $tarikh_dari,
            'TO_DATE' => $tarikh_hingga,
            'CAWANGAN' => $cawangan,
            'JENIS_PAKAIAN' => $jenis_pakaian,
            'SAIZ' => $saiz_pakaian,
        );
        
        GeneralFunction::generateReport('/spsb/MSN/LaporanAtletPakaianSukanParalimpik', $format, $controls, 'laporan_atlet_pakaian_sukan_paralimpik');
    }
    
    public function actionLaporanAtletPencapaianPrestasiSecaraIndividu()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new MsnLaporanAtletPencapaianPrestasiSecaraIndividu();
        $model->format = 'html';

        if ($model->load(Yii::$app->request->post())) {
            
            if(!empty($model->program))$model->program = implode(",",$model->program);
            if(!empty($model->sukan))$model->sukan = implode(",",$model->sukan);
            if(!empty($model->acara))$model->acara = implode(",",$model->acara);
            if(!empty($model->negeri))$model->negeri = implode(",",$model->negeri);
            if(!empty($model->atlet))$model->atlet = implode(",",$model->atlet);
            if(!empty($model->nama_kejohanan_temasya))$model->nama_kejohanan_temasya = implode(",",$model->nama_kejohanan_temasya);
            if(!empty($model->cawangan))$model->cawangan = implode(",",$model->cawangan);
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-laporan-atlet-pencapaian-prestasi-secara-individu'
                    , 'program' => $model->program
                    , 'sukan' => $model->sukan
                    , 'acara' => $model->acara
                    , 'negeri' => $model->negeri
                    , 'atlet' => $model->atlet
                    , 'opponent' => $model->opponent
                    , 'nama_kejohanan_temasya' => $model->nama_kejohanan_temasya
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'cawangan' => $model->cawangan
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-laporan-atlet-pencapaian-prestasi-secara-individu'
                    , 'program' => $model->program
                    , 'sukan' => $model->sukan
                    , 'acara' => $model->acara
                    , 'negeri' => $model->negeri
                    , 'atlet' => $model->atlet
                    , 'opponent' => $model->opponent
                    , 'nama_kejohanan_temasya' => $model->nama_kejohanan_temasya
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'cawangan' => $model->cawangan
                    , 'format' => $model->format
                ]);
            }
        } 

        return $this->render('laporan_atlet_pencapaian_prestasi_secara_individu', [
            'model' => $model,
            'readonly' => false,
        ]);
    }
    
    public function actionGenerateLaporanAtletPencapaianPrestasiSecaraIndividu($program, $sukan, $acara, $negeri, $atlet, $opponent, $nama_kejohanan_temasya, $tarikh_dari, $tarikh_hingga, $cawangan, $format)
    {
        if($program == "") $program = array();
        else $program = array($program);
        
        if($sukan == "") $sukan = array();
        else $sukan = array($sukan);
        
        if($acara == "") $acara = array();
        else $acara = array($acara);
        
        if($negeri == "") $negeri = array();
        else $negeri = array($negeri);
        
        if($atlet == "") $atlet = array();
        else $atlet = array($atlet);
        
        if($opponent == "") $opponent = array();
        else $opponent = array($opponent);
        
        if($nama_kejohanan_temasya == "") $nama_kejohanan_temasya = array();
        else $nama_kejohanan_temasya = array($nama_kejohanan_temasya);
        
        if($tarikh_dari == "") $tarikh_dari = array();
        else $tarikh_dari = array($tarikh_dari);
        
        if($tarikh_hingga == "") $tarikh_hingga = array();
        else $tarikh_hingga = array($tarikh_hingga);
        
        if($cawangan == "") $cawangan = array();
        else $cawangan = array($cawangan);
        
        $controls = array(
            'ACARA' => $acara,
            'PROGRAM' => $program,
            'SUKAN' => $sukan,
            'NEGERI' => $negeri,
            'ATLET' => $atlet,
            'OPPONENT' => $opponent,
            'PENCAPAIAN' => $nama_kejohanan_temasya,
            'FROM_DATE' => $tarikh_dari,
            'TO_DATE' => $tarikh_hingga,
            'CAWANGAN' => $cawangan,
        );
        
        GeneralFunction::generateReport('/spsb/MSN/LaporanAtletPencapaianPrestasiSecaraIndividu', $format, $controls, 'laporan_atlet_pencapaian_prestasi_secara_individu');
    }
    
    public function actionLaporanAtletPencapaianPrestasiSecaraIndividuParalimpik()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new MsnLaporanAtletPencapaianPrestasiSecaraIndividu();
        $model->format = 'html';

        if ($model->load(Yii::$app->request->post())) {
            
            if(!empty($model->program))$model->program = implode(",",$model->program);
            if(!empty($model->sukan))$model->sukan = implode(",",$model->sukan);
            if(!empty($model->acara))$model->acara = implode(",",$model->acara);
            if(!empty($model->negeri))$model->negeri = implode(",",$model->negeri);
            if(!empty($model->atlet))$model->atlet = implode(",",$model->atlet);
            if(!empty($model->nama_kejohanan_temasya))$model->nama_kejohanan_temasya = implode(",",$model->nama_kejohanan_temasya);
            if(!empty($model->cawangan))$model->cawangan = implode(",",$model->cawangan);
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-laporan-atlet-pencapaian-prestasi-secara-individu-paralimpik'
                    , 'program' => $model->program
                    , 'sukan' => $model->sukan
                    , 'acara' => $model->acara
                    , 'negeri' => $model->negeri
                    , 'atlet' => $model->atlet
                    , 'opponent' => $model->opponent
                    , 'nama_kejohanan_temasya' => $model->nama_kejohanan_temasya
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'cawangan' => $model->cawangan
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-laporan-atlet-pencapaian-prestasi-secara-individu-paralimpik'
                    , 'program' => $model->program
                    , 'sukan' => $model->sukan
                    , 'acara' => $model->acara
                    , 'negeri' => $model->negeri
                    , 'atlet' => $model->atlet
                    , 'opponent' => $model->opponent
                    , 'nama_kejohanan_temasya' => $model->nama_kejohanan_temasya
                    , 'tarikh_dari' => $model->tarikh_dari
                    , 'tarikh_hingga' => $model->tarikh_hingga
                    , 'cawangan' => $model->cawangan
                    , 'format' => $model->format
                ]);
            }
        } 

        return $this->render('laporan_atlet_pencapaian_prestasi_secara_individu_paralimpik', [
            'model' => $model,
            'readonly' => false,
        ]);
    }
    
    public function actionGenerateLaporanAtletPencapaianPrestasiSecaraIndividuParalimpik($program, $sukan, $acara, $negeri, $atlet, $opponent, $nama_kejohanan_temasya, $tarikh_dari, $tarikh_hingga, $cawangan, $format)
    {
        if($program == "") $program = array();
        else $program = array($program);
        
        if($sukan == "") $sukan = array();
        else $sukan = array($sukan);
        
        if($acara == "") $acara = array();
        else $acara = array($acara);
        
        if($negeri == "") $negeri = array();
        else $negeri = array($negeri);
        
        if($atlet == "") $atlet = array();
        else $atlet = array($atlet);
        
        if($opponent == "") $opponent = array();
        else $opponent = array($opponent);
        
        if($nama_kejohanan_temasya == "") $nama_kejohanan_temasya = array();
        else $nama_kejohanan_temasya = array($nama_kejohanan_temasya);
        
        if($tarikh_dari == "") $tarikh_dari = array();
        else $tarikh_dari = array($tarikh_dari);
        
        if($tarikh_hingga == "") $tarikh_hingga = array();
        else $tarikh_hingga = array($tarikh_hingga);
        
        if($cawangan == "") $cawangan = array();
        else $cawangan = array($cawangan);
        
        $controls = array(
            'ACARA' => $acara,
            'PROGRAM' => $program,
            'SUKAN' => $sukan,
            'NEGERI' => $negeri,
            'ATLET' => $atlet,
            'PENCAPAIAN' => $nama_kejohanan_temasya,
            'FROM_DATE' => $tarikh_dari,
            'TO_DATE' => $tarikh_hingga,
            'CAWANGAN' => $cawangan,
        );
        
        GeneralFunction::generateReport('/spsb/MSN/LaporanAtletPencapaianPrestasiSecaraIndividuParalimpik', $format, $controls, 'laporan_atlet_pencapaian_prestasi_secara_individu_paralimpik');
    }
    
    public function actionSuratAkuanPersetujuanAtlet($atlet_id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new MsnSuratTawaranAtlet();
        $model->atlet_id = $atlet_id;
        $model->format = 'html';

        if ($model->load(Yii::$app->request->post())) {
            
            if($model->format == "html") {
                $report_url = BaseUrl::to(['generate-surat-akuan-persetujuan-atlet'
                    , 'atlet_id' => $model->atlet_id
                    , 'format' => $model->format
                ], true);
                echo "<script type=\"text/javascript\" language=\"Javascript\">window.open('".$report_url."');</script>";
            } else {
                return $this->redirect(['generate-surat-akuan-persetujuan-atlet'
                    , 'atlet_id' => $model->atlet_id
                    , 'format' => $model->format
                ]);
            }
        } 

        return $this->render('surat_akuan_persetujuan_atlet', [
            'model' => $model,
            'readonly' => false,
        ]);
    }
    
    public function actionGenerateSuratAkuanPersetujuanAtlet($atlet_id, $format)
    {
        
        if($atlet_id == "") $atlet_id = array();
        else $atlet_id = array($atlet_id);
        
        $controls = array(
            'ATLET' => $atlet_id,
        );
        
        GeneralFunction::generateReport('/spsb/MSN/SuratAkuanPersetujuanAtlet', $format, $controls, 'surat_akuan_persetujuan_atlet');
    }
}
