<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_peralatan".
 *
 * @property integer $peralatan_id
 * @property integer $permohonan_peralatan_id
 * @property string $nama_peralatan
 * @property string $spesifikasi
 * @property string $kuantiti_unit
 * @property string $catatan
 */
class Peralatan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_peralatan';
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
            [['nama_peralatan', 'kuantiti_unit'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['permohonan_peralatan_id'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['nama_peralatan'], 'string', 'max' => 80, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['spesifikasi', 'kuantiti_unit'], 'string', 'max' => 30, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['catatan'], 'string', 'max' => 255, 'tooLong' => GeneralMessage::yii_validation_string_max]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'peralatan_id' => GeneralLabel::peralatan_id,
            'permohonan_peralatan_id' => GeneralLabel::permohonan_peralatan_id,
            'nama_peralatan' => GeneralLabel::nama_peralatan,
            'spesifikasi' => GeneralLabel::spesifikasi,
            'kuantiti_unit' => GeneralLabel::kuantiti_unit,
            'catatan' => GeneralLabel::catatan,

        ];
    }
}
