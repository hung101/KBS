<?php
namespace backend\models;

use common\models\PublicUser;
use yii\base\Model;
use Yii;
use yii\web\UploadedFile;
use app\models\general\Upload;
use app\models\general\GeneralMessage;

/**
 * Signup form
 */
class SignupEBantuanForm extends Model
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
    public $nama_persatuan_e_bantuan;
    public $jawatan_e_bantuan;
    public $sijil_pendaftaran;
    

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\PublicUser', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'max' => 30],

            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'unique', 'targetClass' => '\common\models\PublicUser', 'message' => 'This email address has already been taken.'],
            
            [['tel_bimbit_no', 'tel_no'], 'required', 'skipOnEmpty' => true],
            [['tel_bimbit_no', 'tel_no'], 'number'],
            ['full_name', 'string', 'max' => 80],

            ['password', 'required'],
            ['password', 'string', 'min' => 12],
            
            [['nama_persatuan_e_bantuan', 'jawatan_e_bantuan'], 'required'],
            [['nama_persatuan_e_bantuan', 'jawatan_e_bantuan'], 'string', 'max' => 80],
            ['sijil_pendaftaran', 'string', 'max' => 255],
            [['sijil_pendaftaran'],'validateFileUploadWithRequired', 'skipOnEmpty' => false],
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
            'nama_persatuan_e_bantuan' => 'Nama Persatuan',
            'jawatan_e_bantuan' => 'Jawatan',
            'sijil_pendaftaran' => 'Sijil Pendaftaran',
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
            $user->category_access = PublicUser::ACCESS_BANTUAN;
            $user->username = $this->username;
            $user->email = $this->email;
            $user->full_name = $this->full_name;
            $user->tel_bimbit_no = $this->tel_bimbit_no;
            $user->nama_persatuan_e_bantuan = $this->nama_persatuan_e_bantuan;
            $user->jawatan_e_bantuan = $this->jawatan_e_bantuan;
            
            $user->setPassword($this->password);
            $user->generateAuthKey();
            
            if ($user->save()) {
                $file = UploadedFile::getInstance($this, 'sijil_pendaftaran');
                $filename = $user->id;
                if($file){
                    $user->sijil_pendaftaran = Upload::uploadFile($file, Upload::eBantuanPublicUserFolder, $filename);
                }
                
                if ($user->save()) {
                    return $user;
                }
            }
        }

        return null;
    }
    
    /**
     * Validate upload file cannot be empty
     */
    public function validateFileUploadWithRequired($attribute, $params){
        $file = UploadedFile::getInstance($this, $attribute);
        
        if($file && $file->getHasError()){
            $this->addError($attribute, 'File error :' . Upload::getUploadErrorDesc($file->error));
        }

        if(!$file && $this->$attribute==""){
            $this->addError($attribute, GeneralMessage::uploadEmptyError);
        }
    }
}
