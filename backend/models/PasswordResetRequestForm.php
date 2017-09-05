<?php
namespace backend\models;

use common\models\PublicUser;
use yii\base\Model;
use app\models\general\GeneralMessage;
use app\models\general\GeneralLabel;

/**
 * Password reset request form
 */
class PasswordResetRequestForm extends Model
{
    public $email;
    
    private $_access_id;
    
    /**
     * Creates a form model given a access id.
     *
     * @param  string $access_id
     */
    public function __construct($access_id)
    {
        $this->_access_id = $access_id;
        
        parent::__construct();
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required', 'message' => GeneralMessage::yii_validation_required],
            ['email', 'email', 'message' => GeneralMessage::yii_validation_email],
            ['email', 'exist',
                'targetClass' => '\common\models\PublicUser',
                'filter' => ['status' => PublicUser::STATUS_ACTIVE, 'category_access' => $this->_access_id],
                'message' => 'Tiada pengguna dengan e-mel seperti.'
            ],
            [['email'], function ($attribute, $params) {
                if (!\common\models\general\GeneralFunction::validateXSS($this->$attribute)) {
                    $this->addError($attribute, GeneralMessage::yii_validation_xss);
                }
            }],
        ];
    }
    
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'email' => GeneralLabel::emel,
        ];
    }

    /**
     * Sends an email with a link, for resetting the password.
     *
     * @return boolean whether the email was send
     */
    public function sendEmail()
    {
        /* @var $user PublicUser */
        $user = PublicUser::findOne([
            'status' => PublicUser::STATUS_ACTIVE,
            'email' => $this->email,
            'category_access' => $this->_access_id,
        ]);

        if ($user) {
            if (!PublicUser::isPasswordResetTokenValid($user->password_reset_token)) {
                $user->generatePasswordResetToken();
            }

            if ($user->save()) {
                return \Yii::$app->mailer->compose(['html' => 'passwordResetToken-html', 'text' => 'passwordResetToken-text'], ['user' => $user])
                    ->setFrom([\Yii::$app->params['supportEmail'] => \Yii::$app->name . ' robot'])
                    ->setTo($this->email)
                    //->setSubject('Password reset for ' . \Yii::$app->name)
                    ->setSubject('Set semula kata laluan untuk ' . \Yii::$app->name)
                    ->send();
            }
        }

        return false;
    }
}
