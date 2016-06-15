<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_bsp_bendahari_ipt".
 *
 * @property integer $bsp_bendahari_ipt_id
 * @property string $nama_pelajar
 * @property string $no_kad_pengenalan
 * @property string $no_uni_matrix
 * @property string $yuran_pengajian
 */
class PengurusanPenyelia extends \yii\db\ActiveRecord
{
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
            [['username', 'peranan', 'full_name', 'status', 'aduan_venue', 'aduan_bahagian'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required ],
            [['username','jabatan_id', 'peranan', 'status', 'profil_badan_sukan', 'ipt_bendahari_e_biasiswa', 'no_kad_pengenalan', 
                'urusetia_negeri_e_bantuan', 'urusetia_kategori_program_e_bantuan'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['password_hash', 'password_reset_token', 'email'], 'string', 'max' => 255, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['aduan_venue', 'aduan_bahagian', 'aduan_kawasan_kemudahan'], 'safe'],
            [['email'], 'email', 'message' => GeneralMessage::yii_validation_email],
            [['auth_key'], 'string', 'max' => 32, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['full_name', 'new_password', 'password_confirm'], 'string', 'max' => 50, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['aduan_jawatan'], 'string', 'max' => 80, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['tel_mobile_no', 'tel_no'], 'string', 'max' => 14, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['tel_mobile_no', 'tel_no'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['no_kad_pengenalan', 'username'], 'string', 'min' => 12, 'max' => 12, 'tooLong' => GeneralMessage::yii_validation_string_max, 'tooShort' => GeneralMessage::yii_validation_string_min],
            ['new_password', 'validatePassword'],
            ['new_password', 'string', 'min' => 12, 'tooShort' => GeneralMessage::yii_validation_string_min],
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
            'tel_no' => GeneralLabel::no_telefon_pejabat,
            'email' => GeneralLabel::email,
            'status' => GeneralLabel::status,
            'no_kad_pengenalan' => GeneralLabel::no_kad_pengenalan,
            'ipt_bendahari_e_biasiswa' => GeneralLabel::ipt_bendahari_e_biasiswa,
            'urusetia_negeri_e_bantuan' => GeneralLabel::urusetia_negeri_e_bantuan,
            'urusetia_kategori_program_e_bantuan' => GeneralLabel::urusetia_kategori_program_e_bantuan,
            'aduan_jawatan' => GeneralLabel::jawatan,
            'aduan_venue' => GeneralLabel::venue,
            'aduan_bahagian' => GeneralLabel::bahagian,
            'aduan_kawasan_kemudahan' => GeneralLabel::kawasan_kemudahan,
        ];
    }
    
    /**
     * Validate Password and Password Retype must same
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
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefNegeri(){
        return $this->hasOne(RefNegeri::className(), ['id' => 'urusetia_negeri_e_bantuan']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefKategoriProgram(){
        return $this->hasOne(RefKategoriProgram::className(), ['id' => 'urusetia_kategori_program_e_bantuan']);
    }
}
