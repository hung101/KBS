<?php
namespace app\models;

use common\models\PublicUser;
use yii\base\Model;
use Yii;
use yii\web\UploadedFile;
use app\models\general\Upload;
use app\models\general\GeneralMessage;

/**
 * Signup form
 */
class AdminPublicUserEBantuan extends Model
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
            ['username', 'required', 'message' => GeneralMessage::yii_validation_required],
            ['username', 'unique', 'targetClass' => '\common\models\PublicUser', 'message' => GeneralMessage::yii_validation_unique],
            ['username', 'string', 'max' => 30, 'tooLong' => GeneralMessage::yii_validation_string_max],

            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required', 'message' => GeneralMessage::yii_validation_required],
            ['email', 'email', 'message' => GeneralMessage::yii_validation_email],
            ['email', 'unique', 'targetClass' => '\common\models\PublicUser', 'message' => GeneralMessage::yii_validation_unique],
            
            [['tel_bimbit_no', 'tel_no'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['tel_bimbit_no', 'tel_no'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['tel_bimbit_no', 'tel_no'], 'string', 'max' => 14, 'tooLong' => GeneralMessage::yii_validation_string_max],            
            ['full_name', 'string', 'max' => 80, 'tooLong' => GeneralMessage::yii_validation_string_max],

            ['password', 'required', 'message' => GeneralMessage::yii_validation_required],
            ['password', 'string', 'min' => 12, 'tooLong' => GeneralMessage::yii_validation_string_max],
            
            [['nama_persatuan_e_bantuan', 'jawatan_e_bantuan'], 'required', 'message' => GeneralMessage::yii_validation_required],
            [['nama_persatuan_e_bantuan', 'jawatan_e_bantuan'], 'string', 'max' => 80, 'tooLong' => GeneralMessage::yii_validation_string_max],
            ['sijil_pendaftaran', 'string', 'max' => 255, 'tooLong' => GeneralMessage::yii_validation_string_max],
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
