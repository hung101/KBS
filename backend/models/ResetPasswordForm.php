<?php
namespace backend\models;

use common\models\PublicUser;
use yii\base\InvalidParamException;
use yii\base\Model;
use Yii;

use app\models\general\GeneralMessage;

/**
 * Password reset form
 */
class ResetPasswordForm extends Model
{
    public $password;

    /**
     * @var \common\models\PublicUser
     */
    private $_user;
    private $_access_id;

    /**
     * Creates a form model given a token.
     *
     * @param  string                          $token
     * @param  array                           $config name-value pairs that will be used to initialize the object properties
     * @throws \yii\base\InvalidParamException if token is empty or not valid
     */
    public function __construct($token, $config = [], $access_id)
    {
        $this->_access_id = $access_id;
        
        if (empty($token) || !is_string($token)) {
            //throw new InvalidParamException('Password reset token cannot be blank.');
            throw new InvalidParamException('Kata laluan token tidak boleh kosong. Sila menetapkan semula.');
        }
        $this->_user = PublicUser::findByPasswordResetTokenAndAccess($token, $this->_access_id);
        if (!$this->_user) {
            //throw new InvalidParamException('Wrong password reset token.');
            throw new InvalidParamException('Token kata laluan set semula salah. Sila menetapkan semula.');
        }
        parent::__construct($config);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['password', 'required', 'message' => GeneralMessage::yii_validation_required],
            ['password', 'string', 'min' => 12, 'tooShort' => GeneralMessage::yii_validation_string_min],
        ];
    }
    
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'password' => 'Kata Laluan',
        ];
    }

    /**
     * Resets password.
     *
     * @return boolean if password was reset.
     */
    public function resetPassword()
    {
        $user = $this->_user;
        $user->setPassword($this->password);
        $user->removePasswordResetToken();

        return $user->save();
    }
}
