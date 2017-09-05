<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_penganjuran_kursus".
 *
 * @property integer $penganjuran_kursus_id
 * @property string $tarikh_kursus_mula
 * @property string $tempat_kursus
 * @property string $negeri
 * @property string $nama_penyelaras
 * @property string $no_telefon
 * @property integer $kuota_kursus
 */
class PenganjuranKursus extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_penganjuran_kursus';
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
            [['kategori_kursus_penganjuran','kod_kursus', 'tarikh_kursus_mula', 'tarikh_kursus_tamat', 'penganjur', 'tempat_kursus', 'negeri', 'nama_penyelaras', 'no_telefon', 'kuota_kursus', 'nama_kursus'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['tarikh_kursus_mula', 'tarikh_kursus_tamat', 'jenis_kursus', 'tarikh_status'], 'safe'],
            [['kuota_kursus', 'kategori_kursus_penganjuran'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['tempat_kursus'], 'string', 'max' => 90, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['tempoh_kursus'], 'string', 'max' => 100, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['kod_kursus','negeri'], 'string', 'max' => 30, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['nama_penyelaras', 'nama_kursus', 'penganjur'], 'string', 'max' => 80, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['no_telefon'], 'string', 'max' => 14, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['no_telefon'], 'integer', 'message' => GeneralMessage::yii_validation_integer],            
            [['tarikh_kursus_tamat'], 'compare', 'compareAttribute'=>'tarikh_kursus_mula', 'operator'=>'>=', 'message' => GeneralMessage::yii_validation_compare],
            [['tempat_kursus','tempoh_kursus','kod_kursus','negeri','nama_penyelaras', 'nama_kursus', 'penganjur'], function ($attribute, $params) {
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
            'penganjuran_kursus_id' => GeneralLabel::penganjuran_kursus_id,
            'jenis_kursus' => GeneralLabel::jenis_tahap_kursus,
            'negeri' => GeneralLabel::negeri,
            'tarikh_kursus_mula' => GeneralLabel::tarikh_kursus_mula,
            'tarikh_kursus_tamat' => GeneralLabel::tarikh_kursus_tamat,
            'tempat_kursus' => GeneralLabel::tempat_kursus,
            'negeri' => GeneralLabel::negeri,
            'nama_penyelaras' => GeneralLabel::nama_penyelaras,
            'no_telefon' => GeneralLabel::no_telefon,
            'kuota_kursus' => GeneralLabel::kuota_kursus,
            'nama_kursus' => GeneralLabel::nama_kursus,
            'kod_kursus' => GeneralLabel::kod_kursus,
            'penganjur' => GeneralLabel::penganjur,
            'tempoh_kursus' => GeneralLabel::tempoh_kursus,
            'kategori_kursus_penganjuran' => GeneralLabel::kategori_kursus_penganjuran,
			'tarikh_status' => GeneralLabel::tarikh_status_permohonan,
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefJenisKursusPenganjuran(){
        return $this->hasOne(RefJenisKursusPenganjuran::className(), ['id' => 'jenis_kursus']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefNegeri(){
        return $this->hasOne(RefNegeri::className(), ['id' => 'negeri']);
    }
}
