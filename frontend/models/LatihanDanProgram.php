<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_latihan_dan_program".
 *
 * @property integer $latihan_dan_program_id
 * @property string $nama_kursus
 * @property string $tarikh_kursus
 * @property string $lokasi_kursus
 * @property string $penganjuran_kursus
 * @property integer $bilangan_ahli_yang_menyertai
 */
class LatihanDanProgram extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_latihan_dan_program';
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
            [['kategori_kursus', 'nama_kursus', 'tarikh_kursus', 'lokasi_kursus', 'penganjuran_kursus'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['tarikh_kursus'], 'safe'],
            [['bilangan_ahli_yang_menyertai'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['nama_kursus', 'lokasi_kursus'], 'string', 'max' => 100, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['penganjuran_kursus'], 'string', 'max' => 255, 'tooLong' => GeneralMessage::yii_validation_string_max]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'latihan_dan_program_id' => GeneralLabel::latihan_dan_program_id,
            'kategori_kursus' => GeneralLabel::kategori_kursus,
            'nama_kursus' => GeneralLabel::nama_kursus,
            'tarikh_kursus' => GeneralLabel::tarikh_kursus,
            'lokasi_kursus' => GeneralLabel::lokasi_kursus,
            'penganjuran_kursus' => GeneralLabel::penganjuran_kursus,
            'bilangan_ahli_yang_menyertai' => GeneralLabel::bilangan_ahli_yang_menyertai,

        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefKategoriKursus(){
        return $this->hasOne(RefKategoriKursus::className(), ['id' => 'kategori_kursus']);
    }
}
