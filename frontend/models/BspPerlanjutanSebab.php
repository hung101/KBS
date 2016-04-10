<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_bsp_perlanjutan_sebab".
 *
 * @property integer $bsp_perlanjutan_sebab_id
 * @property integer $bsp_perlanjutan_id
 * @property string $sebab
 */
class BspPerlanjutanSebab extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_bsp_perlanjutan_sebab';
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
            [['sebab'], 'required', 'skipOnEmpty' => true],
            [['bsp_perlanjutan_id'], 'integer'],
            [['sebab'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'bsp_perlanjutan_sebab_id' => GeneralLabel::bsp_perlanjutan_sebab_id,
            'bsp_perlanjutan_id' => GeneralLabel::bsp_perlanjutan_id,
            'sebab' => GeneralLabel::sebab,

        ];
    }
}
