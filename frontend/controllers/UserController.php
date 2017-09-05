<?php

namespace frontend\controllers;

use Yii;
use app\models\User;
use frontend\models\UserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use yii\helpers\BaseUrl;

use app\models\general\GeneralVariable;
use common\models\general\GeneralFunction;

// table reference
use app\models\RefJabatanUser;
use app\models\RefStatusUser;
use app\models\UserPeranan;
use app\models\ProfilBadanSukan;
use app\models\RefBahagianUser;
use app\models\RefCawanganUser;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
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
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $queryParams = Yii::$app->request->queryParams;
        
        /*if(Yii::$app->user->identity->peranan != UserPeranan::PERANAN_ADMIN){
            $queryParams['UserSearch']['created_by'] = Yii::$app->user->identity->id;
        }*/
        
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search($queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = $this->findModel($id);
        
        $ref = RefJabatanUser::findOne(['id' => $model->jabatan_id]);
        $model->jabatan_id = $ref['desc'];
        
        $ref = RefStatusUser::findOne(['id' => $model->status]);
        $model->status = $ref['desc'];
        
        $ref = UserPeranan::findOne(['user_peranan_id' => $model->peranan]);
        $model->peranan = $ref['nama_peranan'];
        
        $ref = ProfilBadanSukan::findOne(['profil_badan_sukan' => $model->profil_badan_sukan]);
        $model->profil_badan_sukan = $ref['nama_badan_sukan'];
        
        $ref = RefBahagianUser::findOne(['id' => $model->bahagian]);
        $model->bahagian = $ref['desc'];
        
        $ref = RefCawanganUser::findOne(['id' => $model->cawangan]);
        $model->cawangan = $ref['desc'];
        
        return $this->render('view', [
            'model' => $model,
            'readonly' => true,
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed delete()
     */
    public function actionCreate()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        $model = new User();
        
        $model->scenario = 'create';
        
        $model->status = \common\models\User::STATUS_ACTIVE;
        
        $model->last_active = GeneralFunction::getCurrentTimestamp();
        
        $parent_path = "";
        
        if(Yii::$app->user->identity->parent_path && Yii::$app->user->identity->parent_path != ""){
            $parent_path = Yii::$app->user->identity->parent_path . ',' . Yii::$app->user->identity->id;
        } else {
            $parent_path = Yii::$app->user->identity->id;
        }
        
        $model->parent_path = $parent_path;
                
        /*$model->peranan = 3;
        $model->jabatan_id = 4;
        $model->full_name = 'Admin ';
        $model->username = '8009010358';
        $model->new_password = 'Abcdef@123456';
        $model->password_confirm = 'Abcdef@123456';*/
        
        if ($model->load(Yii::$app->request->post())) {
            //$stringlens = strlen($model->sukan);
            if(is_array($model->sukan)){
                $model->sukan = implode(",",$model->sukan);
            } else {
                $model->sukan = "";
            }
            
            if(is_array($model->negeri)){
                $model->negeri = implode(",",$model->negeri);
            } else {
                $model->negeri = "";
            }
        }

        if (Yii::$app->request->post() && $model->validate()) {
            $password_show = $model->new_password;
            $model->setPassword($model->new_password);
            $model->generateAuthKey();
            
            if($model->save()){
                if($model->email && $model->email != ""){
                    
                    $emailContent = "Assalamualaikum dan Salam Sejahtera, 
<br><br>
Tan Sri/Datuk/Dato'/Datin/Dr./Tuan/Puan,
<br><br>
<b>AKAUN BARU SISTEM SPSB</b>
<br><br>
Dengan segala hormatnya perkara di atas adalah dirujuk.
<br><br>
2. Sukacita dimaklumkan bahawa satu akaun baru Sistem SPSB atas nama Tan Sri/Datuk/Dato'/Datin/Dr./Tuan/Puan telah diwujudkan. Sehubungan itu, id pengguna dan kata laluan Tan Sri/Datuk/Dato'/Datin/Dr./Tuan/Puan adalah seperti berikut:
<br><br>Nama Penuh   : ".$model->full_name."
<br><br>Id Pengguna   : ".$model->username."
<br><br>Kata Laluan   : ".$password_show."
    <br><br>
3. Tan Sri/Datuk/Dato'/Datin/Dr./Tuan/Puan dipohon untuk menukarkan kata laluan di atas bagi tujuan keselamatan. Sila klik di  <a href='" . BaseUrl::to(['site/login'], true) . "' target='_blank'>sini</a> untuk log masuk Tan Sri/Datuk/Dato'/Datin/Dr./Tuan/Puan.
<br><br>
4. Kerjasama dan perhatian Tan Sri/Datuk/Dato'/Datin/Dr./Tuan/Puan dalam perkara ini amat dihargai dan didahului dengan ucapan terima kasih.
<br><br>
Sekian.
<br><br>";
                    if($model->jabatan_id == RefJabatanUser::MSN){
                        $emailContent .= '"KE ARAH KECEMERLANGAN SUKAN"<br>
                                Majlis Sukan Negara Malaysia.';
                    }
                        try {
                            
                                Yii::$app->mailer->compose()
                                        ->setTo($model->email)
                                        ->setFrom('noreply@spsb.com')
                                        ->setSubject('Akaun Baru SPSB')
                                        ->setHtmlBody($emailContent)->send();
                                
                                Yii::$app->session->setFlash('success', 'E-mel telah dihantar kepada pemohon.');
                        }
                        catch(\Swift_SwiftException $exception)
                        {
                            //return 'Can sent mail due to the following exception'.print_r($exception);
                            Yii::$app->session->setFlash('error', 'Terdapat ralat menghantar e-mel.'.print_r($exception));
                        }
                }
                
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }
        
        return $this->render('create', [
            'model' => $model,
            'readonly' => false,
        ]);
    }

    /**
     * Updates an existing User model.
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
        $oldStatus = null;
        
        if ($model->load(Yii::$app->request->post()) && $model->sukan) {
            $oldStatus = $model->getOldAttribute('status');
            
            //$stringlens = $model->sukan;
            if(is_array($model->sukan)){
                $model->sukan = implode(",",$model->sukan);
            } else {
                $model->sukan = "";
            }
        }
        
        if (Yii::$app->request->post() && $model->negeri) {
            //$stringlens = $model->negeri;
            if(is_array($model->negeri)){
                $model->negeri = implode(",",$model->negeri);
            } else {
                $model->negeri = "";
            }
        }

        if (Yii::$app->request->post() && $model->validate()) {
            //$model->password_hash = Yii::$app->security->generatePasswordHash($model->new_password);
            $password_show = "";
            
            if($model->new_password != ''){
                $password_show = $model->new_password;
                $model->setPassword($model->new_password);
                $model->login_attempted = 0; //reset login attempt
                $model->is_new_user = 'YES';
            }
            
            $model->last_active = GeneralFunction::getCurrentTimestamp(); // reset last_active date
            
            if($model->save()){
                
                if($model->email && $model->email != "" && $model->status != $oldStatus && $model->status == \common\models\User::STATUS_ACTIVE){
                    
                    $emailContent = "Assalamualaikum dan Salam Sejahtera, 
<br><br>
Tan Sri/Datuk/Dato'/Datin/Dr./Tuan/Puan,
<br><br>
<b>PENGAKTIFAN SEMULA AKAUN SISTEM SPSB</b>
<br><br>
Dengan segala hormatnya perkara di atas adalah dirujuk.
<br><br>
2. Sukacita dimaklumkan bahawa satu akaun baru Sistem SPSB atas nama Tan Sri/Datuk/Dato'/Datin/Dr./Tuan/Puan telah diaktifkan semula. Sehubungan itu, id pengguna Tan Sri/Datuk/Dato'/Datin/Dr./Tuan/Puan adalah seperti berikut:
<br><br>Nama Penuh   : ".$model->full_name."
<br><br>Id Pengguna   : ".$model->username;
                    
                    if($password_show != ""){
                        $emailContent .= "<br><br>Kata Laluan   : ".$password_show;
                    }
                    
                    $emailContent .= "    <br><br>
3. Tan Sri/Datuk/Dato'/Datin/Dr./Tuan/Puan dipohon untuk menukarkan kata laluan di atas bagi tujuan keselamatan. Sila klik di  <a href='" . BaseUrl::to(['site/login'], true) . "' target='_blank'>sini</a> untuk log masuk Tan Sri/Datuk/Dato'/Datin/Dr./Tuan/Puan.
<br><br>
4. Kerjasama dan perhatian Tan Sri/Datuk/Dato'/Datin/Dr./Tuan/Puan dalam perkara ini amat dihargai dan didahului dengan ucapan terima kasih.
<br><br>
Sekian.
<br><br>";
                    if($model->jabatan_id == RefJabatanUser::MSN){
                        $emailContent .= '"KE ARAH KECEMERLANGAN SUKAN"<br>
                                Majlis Sukan Negara Malaysia.';
                    }
                        try {
                            
                                Yii::$app->mailer->compose()
                                        ->setTo($model->email)
                                        ->setFrom('noreply@spsb.com')
                                        ->setSubject('Pengaktifan Semula Akaun SPSB')
                                        ->setHtmlBody($emailContent)->send();
                                
                                Yii::$app->session->setFlash('success', 'E-mel telah dihantar kepada pemohon.');
                        }
                        catch(\Swift_SwiftException $exception)
                        {
                            //return 'Can sent mail due to the following exception'.print_r($exception);
                            Yii::$app->session->setFlash('error', 'Terdapat ralat menghantar e-mel.'.print_r($exception));
                        }
                }
                
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } 
        
        return $this->render('update', [
                'model' => $model,
                'readonly' => false,
            ]);
    }

    /**
     * Deletes an existing User model.
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
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
