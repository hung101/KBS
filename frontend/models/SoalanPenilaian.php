<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;

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
            [['borang_penilaian_id', 'bahagian', 'soalan', 'jawapan'], 'required', 'skipOnEmpty' => true],
            [['borang_penilaian_id', 'jawapan'], 'integer'],
            [['bahagian'], 'string', 'max' => 80],
            [['soalan'], 'string', 'max' => 255]
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
