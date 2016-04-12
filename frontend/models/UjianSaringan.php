<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_ujian_saringan".
 *
 * @property integer $ujian_saringan_id
 * @property string $nama
 * @property string $sekolah
 * @property string $alamat_1
 * @property string $alamat_2
 * @property string $alamat_3
 * @property string $alamat_negeri
 * @property string $alamat_bandar
 * @property string $alamat_poskod
 * @property string $jantina
 * @property string $no_telefon
 * @property string $darjah
 * @property string $berat_badan
 * @property string $ketinggian
 * @property string $tinggi_duduk
 * @property string $panjang_depa
 * @property string $body_mass_index
 * @property string $catatan
 */
class UjianSaringan extends \yii\db\ActiveRecord
{
    //public $umur;
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_ujian_saringan';
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
            [['nama', 'sekolah', 'no_kad_pengenalan'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['berat_badan', 'ketinggian', 'tinggi_duduk', 'panjang_depa', 'body_mass_index'], 'number', 'message' => GeneralMessage::yii_validation_number],
            [['nama', 'sekolah'], 'string', 'max' => 80, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['alamat_1', 'alamat_2', 'alamat_3'], 'string', 'max' => 90, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['alamat_negeri', 'darjah'], 'string', 'max' => 30, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['alamat_bandar'], 'string', 'max' => 40, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['alamat_poskod'], 'string', 'max' => 5, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['jantina'], 'string', 'max' => 1, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['no_telefon'], 'string', 'max' => 14, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['catatan'], 'string', 'max' => 255, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['no_kad_pengenalan'], 'string', 'max' => 12, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['no_kad_pengenalan'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['umur'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['bangsa', 'sukan', 'tarikh_lahir', 'maklumat_program'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ujian_saringan_id' => GeneralLabel::ujian_saringan_id,
            'nama' => GeneralLabel::nama,
            'sekolah' => GeneralLabel::sekolah,
            'alamat_1' => GeneralLabel::alamat_1,
            'alamat_2' => GeneralLabel::alamat_2,
            'alamat_3' => GeneralLabel::alamat_3,
            'alamat_negeri' => GeneralLabel::alamat_negeri,
            'alamat_bandar' => GeneralLabel::alamat_bandar,
            'alamat_poskod' => GeneralLabel::alamat_poskod,
            'jantina' => GeneralLabel::jantina,
            'no_telefon' => GeneralLabel::no_telefon,
            'darjah' => GeneralLabel::darjah,
            'berat_badan' => GeneralLabel::berat_badan,
            'ketinggian' => GeneralLabel::ketinggian,
            'tinggi_duduk' => GeneralLabel::tinggi_duduk,
            'panjang_depa' => GeneralLabel::panjang_depa,
            'body_mass_index' => GeneralLabel::body_mass_index,
            'catatan' => GeneralLabel::catatan,
            'no_kad_pengenalan' => GeneralLabel::no_kad_pengenalan,
            'maklumat_program' => GeneralLabel::maklumat_program,
            'umur' => GeneralLabel::umur,
            'bangsa' => GeneralLabel::bangsa,
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefSekolah(){
        return $this->hasOne(RefSekolah::className(), ['id' => 'sekolah']);
    }
    
     /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefJantina(){
        return $this->hasOne(RefJantina::className(), ['id' => 'jantina']);
    }
}
