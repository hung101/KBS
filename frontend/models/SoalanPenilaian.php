<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_soalan_penilaian".
 *
 * @property integer $soalan_penilaian_id
 * @property integer $borang_penilaian_id
 * @property string $bahagian
 * @property string $soalan
 * @property integer $jawapan
 */
class SoalanPenilaian extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_soalan_penilaian';
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
            [['borang_penilaian_id', 'bahagian', 'soalan', 'jawapan'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['borang_penilaian_id', 'jawapan'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['bahagian'], 'string', 'max' => 80, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['soalan'], 'string', 'max' => 255, 'tooLong' => GeneralMessage::yii_validation_string_max]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'soalan_penilaian_id' => GeneralLabel::soalan_penilaian_id,
            'borang_penilaian_id' => GeneralLabel::borang_penilaian_id,
            'bahagian' => GeneralLabel::bahagian,
            'soalan' => GeneralLabel::soalan,
            'jawapan' => GeneralLabel::jawapan,

        ];
    }
}
