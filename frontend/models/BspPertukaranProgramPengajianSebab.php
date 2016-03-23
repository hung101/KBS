<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;

/**
 * This is the model class for table "tbl_bsp_pertukaran_program_pengajian_sebab".
 *
 * @property integer $bsp_pertukaran_program_pengajian_sebab_id
 * @property integer $bsp_pertukaran_program_pengajian_id
 * @property string $sebab
 */
class BspPertukaranProgramPengajianSebab extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_bsp_pertukaran_program_pengajian_sebab';
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
            [['bsp_pertukaran_program_pengajian_sebab_id', 'bsp_pertukaran_program_pengajian_id'], 'integer'],
            [['sebab'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'bsp_pertukaran_program_pengajian_sebab_id' => GeneralLabel::bsp_pertukaran_program_pengajian_sebab_id,
            'bsp_pertukaran_program_pengajian_id' => GeneralLabel::bsp_pertukaran_program_pengajian_id,
            'sebab' => GeneralLabel::sebab,

        ];
    }
}
