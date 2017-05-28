<?php
namespace backend\controllers;

use Yii;
use common\models\LoginFormPublic;
use backend\models\PasswordResetRequestForm;
use backend\models\ResetPasswordForm;
use backend\models\SignupEBiasiswaForm;
use backend\models\SignupEKemudahanForm;
use backend\models\SignupEBantuanForm;
use backend\models\SignupELaporanForm;
use backend\models\SignupEKemudahanMsnForm;
use backend\models\SignupSukarelawanForm;
use backend\models\ContactForm;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

use common\models\PublicUser;

use app\models\general\GeneralLabel;

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
        if (!\Yii::$app->user->isGuest) {
            Yii::$app->user->logout();
        }
        
        return $this->render('index');
    }

    public function actionLogin($access_id)
    {
        if (!\Yii::$app->user->isGuest) {
            //return $this->redirect(['e-biasiswa-home']);
            return $this->redirect(['index']);
        }

        $model = new LoginFormPublic($access_id);
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            if(Yii::$app->user->identity->email_verified == 1){
                if(\Yii::$app->user->identity->category_access == PublicUser::ACCESS_BIASISWA){
                    return $this->redirect(['e-biasiswa-home']);
                } else if(\Yii::$app->user->identity->category_access == PublicUser::ACCESS_KEMUDAHAN){
                    return $this->redirect(['e-kemudahan-home']);
                } else if(\Yii::$app->user->identity->category_access == PublicUser::ACCESS_BANTUAN){
                    return $this->redirect(['e-bantuan-home']);
                } else if(\Yii::$app->user->identity->category_access == PublicUser::ACCESS_LAPORAN){
                    return $this->redirect(['e-laporan-home']); 
                } else if(\Yii::$app->user->identity->category_access == PublicUser::ACCESS_KEMUDAHAN_MSN){
                    return $this->redirect(['e-kemudahan-msn-home']);
                } else if(\Yii::$app->user->identity->category_access == PublicUser::ACCESS_SUKARELAWAN){
                    return $this->redirect(array('sukarelawan/load'));
                } else {
                    return $this->goHome();
                }
            } else {
                return $this->redirect(['email-verification']);
            }
        } else {
            return $this->render('login', [
                'model' => $model,
                'access_id' => $access_id,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
    
    public function actionEBiasiswaHome()
    {
        return $this->render('e_biasiswa_home');
    }
    
    public function actionEKemudahanHome()
    {
        return $this->render('e_kemudahan_home');
    }
    
    public function actionEBantuanHome()
    {
        return $this->render('e_bantuan_home');
    }
    
    public function actionELaporanHome()
    {
        return $this->render('e_laporan_home');
    }
    
    public function actionEKemudahanMsnHome()
    {
        return $this->render('e_kemudahan_msn_home');
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
    
    public function actionSignup($access_id)
    {
        if($access_id == PublicUser::ACCESS_BIASISWA){
            return $this->redirect(['signup-e-biasiswa']);
        } else if($access_id == PublicUser::ACCESS_KEMUDAHAN){
            return $this->redirect(['signup-e-kemudahan']); 
        } else if($access_id == PublicUser::ACCESS_BANTUAN){
            return $this->redirect(['signup-e-bantuan']);
        } else if($access_id == PublicUser::ACCESS_LAPORAN){
            return $this->redirect(['signup-e-laporan']);
        } else if($access_id == PublicUser::ACCESS_KEMUDAHAN_MSN){
            return $this->redirect(['signup-e-kemudahan-msn']);
        } else if($access_id == PublicUser::ACCESS_SUKARELAWAN){
            return $this->redirect(['signup-sukarelawan']);
        } else {
            return $this->goHome();
        }
    }

    public function actionSignupEKemudahan()
    {
        $model = new SignupEKemudahanForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    if(Yii::$app->user->identity->email_verified == 1){
                        return $this->redirect(['e-kemudahan-home']);
                    } else {
                        return $this->redirect(['email-verification']);
                    }
                }
            }
        }

        return $this->render('signup_e_kemudahan', [
            'model' => $model,
        ]);
    }
    
    public function actionSignupEBiasiswa()
    {
        $model = new SignupEBiasiswaForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    if(Yii::$app->user->identity->email_verified == 1){
                        return $this->redirect(['e-biasiswa-home']);
                    } else {
                        return $this->redirect(['email-verification']);
                    }
                }
            }
        }

        return $this->render('signup_e_biasiswa', [
            'model' => $model,
        ]);
    }
    
    public function actionSignupEBantuan()
    {
        $model = new SignupEBantuanForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    if(Yii::$app->user->identity->email_verified == 1){
                        return $this->redirect(['e-bantuan-home']);
                    } else {
                        return $this->redirect(['email-verification']);
                    }
                }
            }
        }

        return $this->render('signup_e_bantuan', [
            'model' => $model,
        ]);
    }
    
    public function actionSignupEKemudahanMsn()
    {
        $model = new SignupEKemudahanMsnForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    if(Yii::$app->user->identity->email_verified == 1){
                        return $this->redirect(['e-kemudahan-msn-home']);
                    } else {
                        return $this->redirect(['email-verification']);
                    }
                }
            }
        }

        return $this->render('signup_e_kemudahan_msn', [
            'model' => $model,
        ]);
    }
    
    public function actionSignupSukarelawan()
    {
        $model = new SignupSukarelawanForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    if(Yii::$app->user->identity->email_verified == 1){
                        return $this->redirect(array('sukarelawan/load'));
                    } else {
                        return $this->redirect(['email-verification']);
                    }
                }
            }
        }

        return $this->render('signup_sukarelawan', [
            'model' => $model,
        ]);
    }
    
    public function actionEmailVerification()
    {
        $user = PublicUser::findOne([
            'id' => Yii::$app->user->identity->id,
        ]);
        
        if(!Yii::$app->user->identity->email_verify_token || Yii::$app->user->identity->email_verify_token == ""){
            $user->generateEmailVerifyToken();
            
            if ($user->save()) {
                \Yii::$app->mailer->compose(['html' => 'emailVerification-html', 'text' => 'emailVerification-text'], ['user' => $user])
                    ->setFrom([\Yii::$app->params['supportEmail'] => \Yii::$app->name ])
                    ->setTo(Yii::$app->user->identity->email)
                    //->setSubject('Password reset for ' . \Yii::$app->name)
                    ->setSubject('Pengesahan E-mel ' . \Yii::$app->name)
                    ->send();
                
                Yii::$app->getSession()->setFlash('success', 'E-mel telah dihantar kepada alamat e-mel yang berdaftar. Sila buka dan klik pada link menyediakan untuk mengaktifkan akaun anda.');
            }
        }

        return $this->render('email_verification', [
            'model' => $user,
        ]);
    }
    
    public function actionVerifyEmail($token, $access_id, $email)
    {
        $category_access = 0;
        
        if($user = PublicUser::findOne([
            'email_verify_token' => $token,
            'email' => $email,
            'category_access' => $access_id,
        ])){
            //verified
            $user->email_verified = 1;
            $category_access = $user->category_access;
            
            if (!\Yii::$app->user->isGuest) {
                Yii::$app->user->logout();
            }
                    
            if($user->save()){
                Yii::$app->getSession()->setFlash('success', 'Akaun anda telah diaktifkan.');
            }
        } else {
            // cannot verify
            Yii::$app->getSession()->setFlash('error', 'Maaf, kami tidak dapat untuk mengesahkan e-mel anda. Sila daftar semula.');
        }

        return $this->redirect(['login', 'access_id'=>$category_access]);
    }
    
    public function actionUpdateProfileKemudahanMsn()
    {
        $model = new SignupEKemudahanMsnForm();
        
        if(!Yii::$app->request->post()){
            $model->loadProfile();
        }
        
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->update()) {
                Yii::$app->getUser()->login($user);
                Yii::$app->getSession()->setFlash('success', 'Profil anda telah dikemaskini.');
            }
        }

        return $this->render('update_profile_kemudahan_msn', [
            'model' => $model,
        ]);
    }
    
    public function actionSignupELaporan()
    {
        $model = new SignupELaporanForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    if(Yii::$app->user->identity->email_verified == 1){
                        return $this->redirect(['e-laporan-home']);
                    } else {
                        return $this->redirect(['email-verification']);
                    }
                }
            }
        }

        return $this->render('signup_e_laporan', [
            'model' => $model,
        ]);
    }

    public function actionRequestPasswordReset($access_id)
    {
        $model = new PasswordResetRequestForm($access_id);
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                //Yii::$app->getSession()->setFlash('success', 'Check your email for further instructions.');
                Yii::$app->getSession()->setFlash('success', GeneralLabel::sila_semak_e_mel_anda_untuk_mendapatkan_arahan_lanjut);

                return $this->goHome();
            } else {
                //Yii::$app->getSession()->setFlash('error', 'Sorry, we are unable to reset password for email provided.');
                Yii::$app->getSession()->setFlash('error', GeneralLabel::maaf_kami_tidak_dapat_untuk_menetapkan_semula_kata_laluan_untuk_e_mel_yang_disediakan);
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    public function actionResetPassword($token, $access_id)
    {
        try {
            $model = new ResetPasswordForm($token, null, $access_id);
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
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginFormPublic();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('newPassword', [
                'model' => $model,
            ]);
        }
    }
}
