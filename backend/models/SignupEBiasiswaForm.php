<?php
namespace backend\models;

use common\models\PublicUser;
use yii\base\Model;
use Yii;

/**
 * Signup form
 */
class SignupEBiasiswaForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $full_name;
    public $tel_bimbit_no;
    public $tel_no;
    public $status_id;
    public $department_id;
    public $role_id;
    

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\PublicUser', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 12, 'max' => 12],
            [['username'], 'integer'],

            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            //['email', 'unique', 'targetClass' => '\common\models\PublicUser', 'message' => 'This email address has already been taken.'],
            
            [['tel_bimbit_no', 'tel_no'], 'required', 'skipOnEmpty' => true],
            [['tel_bimbit_no', 'tel_no'], 'number'],
            ['full_name', 'string', 'max' => 80],

            ['password', 'required'],
            ['password', 'string', 'min' => 12],
        ];
    }
    
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'email' => 'Emel',
            'full_name' => 'Nama Penuh',
            'tel_mobile_no' => 'No Tel Bimbit',
            'password' => 'Kata Laluan',
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if ($this->validate()) {
            $user = new PublicUser();
            $user->category_access = PublicUser::ACCESS_BIASISWA;
            $user->username = $this->username;
            $user->email = $this->email;
            $user->full_name = $this->full_name;
            $user->tel_bimbit_no = $this->tel_bimbit_no;
            $user->setPassword($this->password);
            $user->generateAuthKey();
            if ($user->save()) {
                return $user;
            }
        }

        return null;
    }
}
