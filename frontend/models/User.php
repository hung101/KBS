<?php

namespace app\models;

use Yii;
use kartik\password\StrengthValidator;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_user".
 *
 * @property integer $id
 * @property string $username
 * @property integer $jabatan_id
 * @property integer $peranan
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $full_name
 * @property string $tel_mobile_no
 * @property string $tel_no
 * @property string $email
 * @property integer $status
 */
class User extends \yii\db\ActiveRecord
{
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 10;
    public $new_password;
    public $password_confirm;
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_user';
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
            [['username', 'jabatan_id', 'peranan', 'full_name', 'status', 'ipt_bendahari_e_biasiswa'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['jabatan_id', 'peranan', 'status', 'profil_badan_sukan', 'ipt_bendahari_e_biasiswa', 'no_kad_pengenalan','bahagian','cawangan'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            //[['expiry_date'], 'safe'],
            [['username'], 'integer', 'message' => GeneralMessage::yii_validation_integer, 'on' => 'create'],
            [['password_hash', 'password_reset_token', 'email'], 'string', 'max' => 255, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['auth_key'], 'string', 'max' => 32, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['full_name', 'new_password', 'password_confirm'], 'string', 'max' => 50, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['sukan', 'negeri'], 'string', 'max' => 255, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['tel_mobile_no', 'tel_no'], 'string', 'max' => 14, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['tel_mobile_no', 'tel_no'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['email'], 'email', 'message' => GeneralMessage::yii_validation_email],
            [['no_kad_pengenalan'], 'string', 'min' => 12, 'max' => 12, 'tooLong' => GeneralMessage::yii_validation_string_max, 'tooShort' => GeneralMessage::yii_validation_string_min],
            [['username'], 'string', 'min' => 12, 'max' => 12, 'tooLong' => GeneralMessage::yii_validation_string_max, 'tooShort' => GeneralMessage::yii_validation_string_min, 'on' => 'create'],
            ['new_password', 'validatePassword'],
            ['new_password', 'string', 'min' => 12, 'tooShort' => GeneralMessage::yii_validation_string_min],
            [['username'], 'unique', 'message' => GeneralMessage::yii_validation_unique],
            [['new_password'], StrengthValidator::className(), 'digit'=>1, 'special'=>1, 'lower' => 1, 'upper' => 1, 
                'digitError'=>GeneralMessage::yii_validation_password_strength,
                'specialError'=>GeneralMessage::yii_validation_password_strength,
                'lowerError'=>GeneralMessage::yii_validation_password_strength,
                'upperError'=>GeneralMessage::yii_validation_password_strength,
                'hasUserError'=>GeneralMessage::yii_validation_password_contain_username,],
            [['expiry_date'], 'compare', 'compareValue'=>date("Y-m-d"), 'operator'=>'>', 'skipOnEmpty'=>true, 'message' => GeneralMessage::yii_validation_compare],
            [['full_name', 'email'], function ($attribute, $params) {
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
            'id' => GeneralLabel::id,
            'username' => GeneralLabel::username,
            'jabatan_id' => GeneralLabel::jabatan_id,
            'profil_badan_sukan' => GeneralLabel::profil_badan_sukan,
            'peranan' => GeneralLabel::peranan,
            'auth_key' => GeneralLabel::auth_key,
            'password_hash' => GeneralLabel::password_hash,
            'new_password' => GeneralLabel::new_password,
            'password_confirm' => GeneralLabel::password_confirm,
            'password_reset_token' => GeneralLabel::password_reset_token,
            'full_name' => GeneralLabel::full_name,
            'tel_mobile_no' => GeneralLabel::tel_mobile_no,
            'tel_no' => GeneralLabel::tel_no,
            'email' => GeneralLabel::email,
            'status' => GeneralLabel::status,
            'no_kad_pengenalan' => GeneralLabel::no_kad_pengenalan,
            'ipt_bendahari_e_biasiswa' => GeneralLabel::ipt_bendahari_e_biasiswa,
            'sukan' => GeneralLabel::sukan,
            'negeri' => GeneralLabel::negeri,
            'expiry_date' => GeneralLabel::tarikh_pergandungan,
            'bahagian' => GeneralLabel::bahagian,
            'cawangan' => GeneralLabel::cawangan_pusat,
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
     * @return \yii\db\ActiveQuery
     */
    public function getRefJabatanUser(){
        return $this->hasOne(RefJabatanUser::className(), ['id' => 'jabatan_id']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefUserPeranan(){
        return $this->hasOne(UserPeranan::className(), ['user_peranan_id' => 'peranan']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefUniversitiInstitusiEBiasiswa(){
        return $this->hasOne(RefUniversitiInstitusiEBiasiswa::className(), ['id' => 'ipt_bendahari_e_biasiswa']);
    }
}
