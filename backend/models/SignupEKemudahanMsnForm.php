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
class SignupEKemudahanMsnForm extends Model
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
    public $alamat_kemudahan_msn;
    public $majikan_kemudahan_msn;
    public $majikan_alamat_kemudahan_msn;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required', 'message' => GeneralMessage::yii_validation_required, 'skipOnEmpty' => true],
            ['username', 'unique', 'targetClass' => '\common\models\PublicUser'
                , 'filter' => ['category_access' => PublicUser::ACCESS_KEMUDAHAN_MSN]
                , 'message' => GeneralMessage::yii_validation_unique],
            ['username', 'string', 'min' => 12, 'max' => 12, 'tooLong' => GeneralMessage::yii_validation_string_max, 'tooShort' => GeneralMessage::yii_validation_string_min],
            [['username'], 'integer', 'message' => GeneralMessage::yii_validation_integer],

            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required', 'message' => GeneralMessage::yii_validation_required, 'skipOnEmpty' => true],
            ['email', 'email', 'message' => GeneralMessage::yii_validation_email],
            ['email', 'unique', 'targetClass' => '\common\models\PublicUser'
                , 'filter' => ['category_access' => PublicUser::ACCESS_KEMUDAHAN_MSN]
                , 'message' => GeneralMessage::yii_validation_unique],

            ['password', 'required', 'message' => GeneralMessage::yii_validation_required, 'skipOnEmpty' => true],
            ['password', 'string', 'min' => 12, 'tooLong' => GeneralMessage::yii_validation_string_max, 'tooShort' => GeneralMessage::yii_validation_string_min],
            
            [['tel_bimbit_no', 'jenis_pengguna_e_kemudahan'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['kategory_hakmilik_e_kemudahan', 'tel_no', 'full_name'], 'required', 'skipOnEmpty' => true, 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['tel_bimbit_no', 'tel_no', 'fax_no'], 'number', 'message' => GeneralMessage::yii_validation_number],
            [['full_name', 'majikan_kemudahan_msn'], 'string', 'max' => 80, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['alamat_kemudahan_msn', 'majikan_alamat_kemudahan_msn'], 'string', 'max' => 90, 'tooLong' => GeneralMessage::yii_validation_string_max],
            
            [['jenis_pengguna_e_kemudahan', 'kategory_hakmilik_e_kemudahan'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            
            [['tel_bimbit_no'], 'string', 'min' => 10, 'tooShort' => GeneralMessage::yii_validation_string_min],
            
            [['email','full_name','alamat_kemudahan_msn', 'majikan_alamat_kemudahan_msn','majikan_kemudahan_msn'], function ($attribute, $params) {
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
            'jenis_pengguna_e_kemudahan' => GeneralLabel::jenis_pengguna,
            'kategory_hakmilik_e_kemudahan' => GeneralLabel::kategori_hakmilik,
            'fax_no' => GeneralLabel::no_fax,
            'alamat_kemudahan_msn' => GeneralLabel::alamat,
            'majikan_kemudahan_msn' => GeneralLabel::majikan,
            'majikan_alamat_kemudahan_msn' => GeneralLabel::alamat_majikan_1,
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
            $user->category_access = PublicUser::ACCESS_KEMUDAHAN_MSN;
            $user->username = $this->username;
            $user->email = $this->email;
            $user->full_name = $this->full_name;
            $user->tel_bimbit_no = $this->tel_bimbit_no;
            $user->jenis_pengguna_e_kemudahan = $this->jenis_pengguna_e_kemudahan;
            $user->kategory_hakmilik_e_kemudahan = $this->kategory_hakmilik_e_kemudahan;
            $user->fax_no = $this->fax_no;
            $user->tel_no = $this->tel_no;
            $user->alamat_kemudahan_msn = $this->alamat_kemudahan_msn;
            $user->majikan_kemudahan_msn = $this->majikan_kemudahan_msn;
            $user->majikan_alamat_kemudahan_msn = $this->majikan_alamat_kemudahan_msn;
            //$user->setAttributes($this->attributes);
            $user->setPassword($this->password);
            $user->generateAuthKey();
            if ($user->save()) {
                return $user;
            }
        }

        return null;
    }
    
    
    /**
     * Update profile.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function update()
    {
        if (($user = PublicUser::findOne(['id' => Yii::$app->user->identity->id])) !== null) {
            
            $user->email = "";
            $user->save();
        
            if ($this->validate()) {
                    //$user->category_access = PublicUser::ACCESS_KEMUDAHAN_MSN;
                    //$user->username = $this->username;
                    $user->email = $this->email;
                    $user->full_name = $this->full_name;
                    $user->tel_bimbit_no = $this->tel_bimbit_no;
                    $user->jenis_pengguna_e_kemudahan = $this->jenis_pengguna_e_kemudahan;
                    $user->kategory_hakmilik_e_kemudahan = $this->kategory_hakmilik_e_kemudahan;
                    $user->fax_no = $this->fax_no;
                    $user->tel_no = $this->tel_no;
                    $user->alamat_kemudahan_msn = $this->alamat_kemudahan_msn;
                    $user->majikan_kemudahan_msn = $this->majikan_kemudahan_msn;
                    $user->majikan_alamat_kemudahan_msn = $this->majikan_alamat_kemudahan_msn;
                    if($this->password){
                        $user->setPassword($this->password);
                    }
                    $user->generateAuthKey();
                    if ($user->save()) {
                        return $user;
                    }
            }
        }

        return null;
    }
    
    /**
     * Load profile.
     *
     * @return null|null the saved model or null if saving fails
     */
    public function loadProfile()
    {
        if ($this->validate()) {
            if (($user = PublicUser::findOne(['id' => Yii::$app->user->identity->id])) !== null) {
                //$this->category_access = PublicUser::ACCESS_KEMUDAHAN_MSN;
                $this->username = $user->username;
                $this->email = $user->email;
                $this->full_name = $user->full_name;
                $this->tel_bimbit_no = $user->tel_bimbit_no;
                $this->jenis_pengguna_e_kemudahan = $user->jenis_pengguna_e_kemudahan;
                $this->kategory_hakmilik_e_kemudahan = $user->kategory_hakmilik_e_kemudahan;
                $this->fax_no = $user->fax_no;
                $this->tel_no = $user->tel_no;
                $this->alamat_kemudahan_msn = $user->alamat_kemudahan_msn;
                $this->majikan_kemudahan_msn = $user->majikan_kemudahan_msn;
                $this->majikan_alamat_kemudahan_msn = $user->majikan_alamat_kemudahan_msn;
            }
        }

        return null;
    }
}
