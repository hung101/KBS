<?php
namespace backend\models;

use common\models\PublicUser;
use yii\base\Model;
use Yii;

use app\models\general\GeneralMessage;
use app\models\general\GeneralLabel;

/**
 * Signup form
 */
class SignupELaporanForm extends Model
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
            ['username', 'required', 'message' => GeneralMessage::yii_validation_required],
            ['username', 'unique', 'targetClass' => '\common\models\PublicUser'
                , 'filter' => ['category_access' => PublicUser::ACCESS_LAPORAN]
                , 'message' => GeneralMessage::yii_validation_unique],
            ['username', 'string', 'min' => 12, 'max' => 12, 'tooLong' => GeneralMessage::yii_validation_string_max, 'tooShort' => GeneralMessage::yii_validation_string_min],
            [['username'], 'integer', 'message' => GeneralMessage::yii_validation_integer],

            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required', 'message' => GeneralMessage::yii_validation_required],
            ['email', 'email', 'message' => GeneralMessage::yii_validation_email],
            ['email', 'unique', 'targetClass' => '\common\models\PublicUser'
                , 'filter' => ['category_access' => PublicUser::ACCESS_LAPORAN]
                , 'message' => GeneralMessage::yii_validation_unique],
            
            [['tel_bimbit_no', 'tel_no'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['tel_bimbit_no', 'tel_no'], 'number', 'message' => GeneralMessage::yii_validation_number],
            ['full_name', 'string', 'max' => 80, 'tooLong' => GeneralMessage::yii_validation_string_max],

            ['password', 'required', 'message' => GeneralMessage::yii_validation_required],
            ['password', 'string', 'min' => 12, 'tooLong' => GeneralMessage::yii_validation_string_max, 'tooShort' => GeneralMessage::yii_validation_string_min],
            
            [['email','full_name'], function ($attribute, $params) {
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
            'full_name' => GeneralLabel::nama_penuh,
            'tel_bimbit_no' => GeneralLabel::no_tel_bimbit,
            'tel_no' => GeneralLabel::no_tel,
            'password' => GeneralLabel::kata_laluan,
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
            $user->category_access = PublicUser::ACCESS_LAPORAN;
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
