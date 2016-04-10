<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_atlet_pembangunan_kursuskem".
 *
 * @property integer $kursus_kem_id
 * @property integer $atlet_id
 * @property string $jenis
 * @property string $tarikh_mula
 * @property string $lokasi
 * @property string $nama_kursus_kem
 */
class AtletPembangunanKursuskem extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_atlet_pembangunan_kursuskem';
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
            [['atlet_id', 'tarikh_mula', 'tarikh_tamat', 'nama_kursus_kem', 'penganjur'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['atlet_id'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['tarikh_mula', 'jenis'], 'safe'],
            [['lokasi'], 'string', 'max' => 90, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['nama_kursus_kem'], 'string', 'max' => 40, 'tooLong' => GeneralMessage::yii_validation_string_max]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'kursus_kem_id' => GeneralLabel::kursus_kem_id,
            'atlet_id' => GeneralLabel::atlet_id,
            'jenis' => GeneralLabel::jenis,
            'tarikh_mula' => GeneralLabel::tarikh_mula,
            'tarikh_tamat' => GeneralLabel::tarikh_tamat,
            'lokasi' => GeneralLabel::lokasi,
            'nama_kursus_kem' => GeneralLabel::nama_kursus_kem,
            'penganjur' => GeneralLabel::penganjur,

        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefJenisKursuskem(){
        return $this->hasOne(RefJenisKursuskem::className(), ['id' => 'jenis']);
    }
}
