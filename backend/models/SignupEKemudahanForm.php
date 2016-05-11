<?php
namespace backend\models;

use common\models\PublicUser;
use yii\base\Model;
use Yii;

use app\models\general\GeneralMessage;

/**
 * Signup form
 */
class SignupEKemudahanForm extends Model
{
    const PEMILIK = 1;
    const PENGGUNA = 2;
    
    public $username;
    public $email;
    public $password;
    public $full_name;
    public $tel_bimbit_no;
    public $tel_no;
    public $fax_no;
    public $status_id;
    public $jenis_pengguna_e_kemudahan;
    public $kategory_hakmilik_e_kemudahan;
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
            ['username', 'unique', 'targetClass' => '\common\models\PublicUser', 'message' => GeneralMessage::yii_validation_unique],
            ['username', 'string', 'min' => 12, 'max' => 12, 'tooLong' => GeneralMessage::yii_validation_string_max, 'tooShort' => GeneralMessage::yii_validation_string_min],
            [['username'], 'integer', 'message' => GeneralMessage::yii_validation_integer],

            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required', 'message' => GeneralMessage::yii_validation_required],
            ['email', 'email', 'message' => GeneralMessage::yii_validation_email],
            //['email', 'unique', 'targetClass' => '\common\models\PublicUser', 'message' => GeneralMessage::yii_validation_unique],

            ['password', 'required', 'message' => GeneralMessage::yii_validation_required],
            ['password', 'string', 'min' => 12, 'tooLong' => GeneralMessage::yii_validation_string_max, 'tooShort' => GeneralMessage::yii_validation_string_min],
            
            [['tel_bimbit_no', 'jenis_pengguna_e_kemudahan'], 'required', 'message' => GeneralMessage::yii_validation_required],
            [['kategory_hakmilik_e_kemudahan', 'tel_no', 'full_name'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['tel_bimbit_no', 'tel_no', 'fax_no'], 'number', 'message' => GeneralMessage::yii_validation_number],
            ['full_name', 'string', 'max' => 80, 'tooLong' => GeneralMessage::yii_validation_string_max],
            
            [['jenis_pengguna_e_kemudahan', 'kategory_hakmilik_e_kemudahan'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
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
            'tel_bimbit_no' => 'No Tel Bimbit',
            'tel_no' => 'No Tel',
            'password' => 'Kata Laluan',
            'jenis_pengguna_e_kemudahan' => 'Jenis Pengguna',
            'kategory_hakmilik_e_kemudahan' => 'Kategori Hakmilik',
            'fax_no' => 'No Fax',
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
            $user->category_access = PublicUser::ACCESS_KEMUDAHAN;
            $user->username = $this->username;
            $user->email = $this->email;
            $user->full_name = $this->full_name;
            $user->tel_bimbit_no = $this->tel_bimbit_no;
            $user->jenis_pengguna_e_kemudahan = $this->jenis_pengguna_e_kemudahan;
            $user->kategory_hakmilik_e_kemudahan = $this->kategory_hakmilik_e_kemudahan;
            $user->fax_no = $this->fax_no;
            $user->tel_no = $this->tel_no;
            //$user->setAttributes($this->attributes);
            $user->setPassword($this->password);
            $user->generateAuthKey();
            if ($user->save()) {
                return $user;
            }
        }

        return null;
    }
}
