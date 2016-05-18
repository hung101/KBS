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
use backend\models\ContactForm;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

use common\models\PublicUser;

/**
 * Site controller
 */
class SiteController extends Controller
{
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
            if(\Yii::$app->user->identity->category_access == PublicUser::ACCESS_BIASISWA){
                return $this->redirect(['e-biasiswa-home']);
            } else if(\Yii::$app->user->identity->category_access == PublicUser::ACCESS_KEMUDAHAN){
                return $this->redirect(['e-kemudahan-home']);
            } else if(\Yii::$app->user->identity->category_access == PublicUser::ACCESS_BANTUAN){
                return $this->redirect(['e-bantuan-home']);
            } else if(\Yii::$app->user->identity->category_access == PublicUser::ACCESS_LAPORAN){
                return $this->redirect(['e-laporan-home']);
            } else {
                return $this->goHome();
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
                    return $this->redirect(['e-kemudahan-home']);
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
                    return $this->redirect(['e-biasiswa-home']);
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
                    return $this->redirect(['e-bantuan-home']);
                }
            }
        }

        return $this->render('signup_e_bantuan', [
            'model' => $model,
        ]);
    }
    
    public function actionSignupELaporan()
    {
        $model = new SignupELaporanForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->redirect(['e-laporan-home']);
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
