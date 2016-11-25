<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_user".
 *
 * @property integer $id
 * @property string $username
 * @property integer $peranan
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $full_name
 * @property string $tel_bimbit_no
 * @property string $tel_no
 * @property string $email
 * @property integer $status
 */
class PublicUserEKemudahan extends \yii\db\ActiveRecord
{
    public $new_password;
    public $password_confirm;
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_user_public';
    }
    
    public function behaviors()
    {
        return [
            'bedezign\yii2\audit\AuditTrailBehavior',
            [
                'class' => \yii\behaviors\BlameableBehavior::className(),
                'createdByAttribute' => 'created_by',
                'updatedByAttribute' => 'updated_by',
            ],
            [
                'class' => \yii\behaviors\TimestampBehavior::className(),
                'createdAtAttribute' => 'created',
                'updatedAtAttribute' => 'updated',
                'value' => new \yii\db\Expression('NOW()'),
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'tel_bimbit_no', 'email', 'nama_persatuan_e_bantuan', 'jawatan_e_bantuan', 'status'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['nama_persatuan_e_bantuan', 'jawatan_e_bantuan', 'full_name'], 'string', 'max' => 80, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['tel_bimbit_no', 'tel_no'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['tel_bimbit_no', 'tel_no'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['tel_bimbit_no', 'tel_no'], 'string', 'max' => 14, 'tooLong' => GeneralMessage::yii_validation_string_max],            
            ['new_password', 'validatePassword'],
            [['new_password', 'password_confirm'], 'string', 'min' => 12, 'tooShort' => GeneralMessage::yii_validation_string_min],
            [['username'], 'unique', 'message' => GeneralMessage::yii_validation_unique]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => GeneralLabel::id,
            'email' => GeneralLabel::email,
            'username' => GeneralLabel::username,
            'full_name' => GeneralLabel::full_name,
            'tel_bimbit_no' => GeneralLabel::no_tel_bimbit,
            'new_password' => GeneralLabel::new_password,
            'password_confirm' => GeneralLabel::password_confirm,
            'jenis_pengguna_e_kemudahan' => GeneralLabel::jenis_pengguna,
            'fax_no' => GeneralLabel::no_fax,
            'kategory_hakmilik_e_kemudahan' => GeneralLabel::kategori_hakmilik,
            'status' => GeneralLabel::status,
        ];
    }
    
    /**
     * Validate Mobile no cannot same with Office Contact/House Contact
     */
    public function validatePassword($attribute, $params){
        if(isset($this->new_password)){
            if(trim($this->new_password) != trim($this->password_confirm)){
                //$this->addError('new_password', 'Sila semak Taip Semula Kata Laluan yang berbeza daripada Kata Laluan');
                $this->addError('password_confirm', GeneralMessage::custom_validation_password_equal);
            }
        }
    }
    
    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }
    
    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
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
