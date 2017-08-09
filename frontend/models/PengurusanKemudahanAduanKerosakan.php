<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_pengurusan_kemudahan_aduan_kerosakan".
 *
 * @property integer $pengurusan_kemudahan_aduan_kerosakan_id
 * @property integer $pengurusan_kemudahan_aduan_id
 * @property string $jenis_kerosakan
 * @property string $lokasi_kerosakan
 */
class PengurusanKemudahanAduanKerosakan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_pengurusan_kemudahan_aduan_kerosakan';
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
            [['pengurusan_kemudahan_aduan_id', 'jenis_kerosakan', 'lokasi_kerosakan'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['pengurusan_kemudahan_aduan_id'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['jenis_kerosakan'], 'string', 'max' => 30, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['lokasi_kerosakan'], 'string', 'max' => 90, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['jenis_kerosakan','lokasi_kerosakan'], 'filter', 'filter' => function ($value) {
                return  \common\models\general\GeneralFunction::filterXSS($value);
            }],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pengurusan_kemudahan_aduan_kerosakan_id' => GeneralLabel::pengurusan_kemudahan_aduan_kerosakan_id,
            'pengurusan_kemudahan_aduan_id' => GeneralLabel::pengurusan_kemudahan_aduan_id,
            'jenis_kerosakan' => GeneralLabel::jenis_kerosakan,
            'lokasi_kerosakan' => GeneralLabel::lokasi_kerosakan,

        ];
    }
}
