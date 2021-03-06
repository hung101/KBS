<?php
namespace common\models;

use Yii;
use yii\base\Model;

use app\models\general\GeneralLabel;

/**
 * Login form
 */
class LoginFormPublic extends Model
{
    public $username;
    public $password;
    public $confirm_password;
    public $rememberMe = true;

    private $_user = false;
    private $_access_id;
    
    /**
     * Creates a form model given a access id.
     *
     * @param  string                          $access_id
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
            // username and password are both required
            [['username', 'password'], 'required'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
        ];
    }
    
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'username' => GeneralLabel::id_pengguna,
            'password' => GeneralLabel::kata_laluan,
            'confirm_password' => GeneralLabel::pengesahan_kata_laluan,
            'rememberMe' => GeneralLabel::ingat_saya,
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
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Incorrect username or password.');
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
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
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
            $this->_user = PublicUser::findByUsernameAndAccess($this->username, $this->_access_id);
        }

        return $this->_user;
    }
}
