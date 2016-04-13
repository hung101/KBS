<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_keputusan_ujian_saringan".
 *
 * @property integer $keputusan_ujian_saringan_id
 * @property integer $ujian_saringan_id
 * @property string $jenis_ujian_saringan
 * @property string $percubaan_1
 * @property string $percubaan_2
 * @property string $terbaik
 */
class KeputusanUjianSaringan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_keputusan_ujian_saringan';
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
            [['ujian_saringan_id', 'jenis_ujian_saringan', 'percubaan_1', 'terbaik'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['ujian_saringan_id'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['percubaan_1', 'percubaan_2', 'terbaik'], 'number', 'message' => GeneralMessage::yii_validation_number],
            [['jenis_ujian_saringan'], 'string', 'max' => 80, 'tooLong' => GeneralMessage::yii_validation_string_max]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'keputusan_ujian_saringan_id' => GeneralLabel::keputusan_ujian_saringan_id,
            'ujian_saringan_id' => GeneralLabel::ujian_saringan_id,
            'jenis_ujian_saringan' => GeneralLabel::jenis_ujian_saringan,
            'percubaan_1' => GeneralLabel::percubaan_1,
            'percubaan_2' => GeneralLabel::percubaan_2,
            'terbaik' => GeneralLabel::terbaik,

        ];
    }
}
