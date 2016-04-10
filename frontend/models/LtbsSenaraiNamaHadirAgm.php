<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_ltbs_senarai_nama_hadir_agm".
 *
 * @property integer $senarai_nama_hadir_id
 * @property integer $mesyuarat_agm_id
 * @property string $nama_penuh
 * @property string $no_kad_pengenalan
 * @property string $jantina
 * @property string $jawatan
 * @property string $kategori_keahlian
 * @property integer $kehadiran
 */
class LtbsSenaraiNamaHadirAgm extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_ltbs_senarai_nama_hadir_agm';
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
            [['nama_penuh', 'no_kad_pengenalan', 'jantina', 'kategori_keahlian'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['mesyuarat_agm_id', 'kehadiran'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['nama_penuh'], 'string', 'max' => 100, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['no_kad_pengenalan'], 'string', 'max' => 12, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['jantina'], 'string', 'max' => 1, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['jawatan'], 'string', 'max' => 50, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['kategori_keahlian'], 'string', 'max' => 30, 'tooLong' => GeneralMessage::yii_validation_string_max]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'senarai_nama_hadir_id' => GeneralLabel::senarai_nama_hadir_id,
            'mesyuarat_agm_id' => GeneralLabel::mesyuarat_agm_id,
            'nama_penuh' => GeneralLabel::nama_penuh,
            'no_kad_pengenalan' => GeneralLabel::no_kad_pengenalan,
            'jantina' => GeneralLabel::jantina,
            'jawatan' => GeneralLabel::jawatan,
            'kategori_keahlian' => GeneralLabel::kategori_keahlian,
            'kehadiran' => GeneralLabel::kehadiran,

        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefKategoriKeahlian(){
        return $this->hasOne(RefKategoriKeahlian::className(), ['id' => 'kategori_keahlian']);
    }
}
