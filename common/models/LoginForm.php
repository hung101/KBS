<?php
namespace common\models;

use Yii;
use yii\base\Model;
use app\models\UserPeranan;
use kartik\password\StrengthValidator;

use app\models\general\GeneralMessage;
use common\models\general\GeneralFunction;

/**
 * Login form
 */
class LoginForm extends Model
{
    public $username;
    public $password;
    public $confirm_password;
    public $rememberMe = true;

    private $_user = false;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password'], 'required'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
            [['password'], StrengthValidator::className(), 'digit'=>1, 'special'=>1, 'lower' => 1, 'upper' => 0, 
                'digitError'=>GeneralMessage::yii_validation_password_strength,
                'specialError'=>GeneralMessage::yii_validation_password_strength,
                'lowerError'=>GeneralMessage::yii_validation_password_strength,
                'hasUserError'=>GeneralMessage::yii_validation_password_contain_username,
                'on' => 'new-password']
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            
            if($user && $user->login_attempted > 2) {
                $this->addError($attribute, 'Akaun anda disekat kerana cubaan login maksimum, sila hubungi admin.');
            }else if (!$user || !$user->validatePassword($this->password)) {
                if($user) {
                    $user->login_attempted = intval($user->login_attempted) + 1;
                    $user->last_login_fail = GeneralFunction::getCurrentTimestamp();
                    $user->save();
                }
                
                //$this->addError($attribute, 'Incorrect username or password, or account deactivated.');
                $this->addError($attribute, 'Nama pengguna atau kata laluan salah, atau akaun dinyahaktifkan');
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     *
     * @return boolean whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
		// eddie start
            // start time out
            Yii::$app->user->authTimeout = Yii::$app->params['expiryTimeout'];

            $user = $this->getUser();
            
            $dateActiveExpired = null;
            
            if($user->expiry_date){
                $dateExpiry=date_create($user->expiry_date);
                date_add($dateExpiry,date_interval_create_from_date_string("30 days"));
                $dateActiveExpired = date_format($dateExpiry,"Y-m-d");
            }
            
            if($user->expiry_date && ($user->expiry_date < date("Y-m-d")) && $user->peranan == UserPeranan::PERANAN_PJS_PERSATUAN){
                //$user->login_attempted = 0;
                //$user->save();
                $this->addError('username', 'Akaun anda disekat kerana tidak menghantar laporan tahunan. Sila hubungi Pejabat Pesuruhjaya Sukan ditalian 03 8994 4800');
                return false;
            } else if($user->expiry_date && $dateActiveExpired && $dateActiveExpired < date("Y-m-d")){
                $this->addError('username', 'Akaun anda telah dinyahaktifkan. Sila hubungi admin SPSB.');
                return false;
            } else if($user->expiry_date && $user->expiry_date < date("Y-m-d")){
                $this->addError('username', 'Akaun anda telah digantung. Sila hubungi admin SPSB.');
                return false;
            }
            
            if($user->login_attempted < 3) {
                $is_login = Yii::$app->user->login($user, $this->rememberMe ? 3600 * 24 * 30 : 0);
                
                $user->last_login = $user->current_login;
                
                $user->current_login = GeneralFunction::getCurrentTimestamp();
                
                $user->save();
                
                if($is_login) {
                    if(Yii::$app->params['allowConcurrentLogin']) {
                        return $is_login;
                    } else {
                        $user->generateAuthKey();
                        if($user->save()) {
                            return $is_login;
                        } else {
                            return false;
                        }
                    }
                } else {
                    return false;
                }
            } else {
                //$this->addError('password', 'Your account is block due to maximum login attemption, please reset your password.');
                $this->addError('password', 'Akaun anda disekat kerana cubaan login maksimum, sila hubungi admin.');
                return false;
            }
// eddie end
        } else {
            return false;
        }
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = User::findByUsername($this->username);
        }

        return $this->_user;
    }
}
