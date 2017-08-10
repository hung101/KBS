<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_ref_program_semasa_sukan_atlet".
 *
 * @property integer $id
 * @property string $desc
 * @property integer $aktif
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created
 * @property string $updated
 */
class RefProgramSemasaSukanAtlet extends \yii\db\ActiveRecord
{
    const SENIOR = 1;
    const PELAPIS_KEBANGSAAN = 2;
    const PELAPIS_SERANTAU = 3;
    const PELAPIS_NEGERI = 4;
    const BAKAT = 5;
    const SENIOR_PARALIMPIK = 6;
    const PELAPIS_PARALIMPIK = 7;
    const BAKAT_PARALIMPIK = 8;
    const PODIUM = 9;
    const PODIUM_PARALIMPIK = 10;
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_ref_program_semasa_sukan_atlet';
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
            [['desc'], 'required', 'message' => GeneralMessage::yii_validation_required],
            [['aktif', 'created_by', 'updated_by'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['created', 'updated'], 'safe'],
            [['desc'], 'string', 'max' => 80, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['desc'], 'filter', 'filter' => function ($value) {
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
            'id' => GeneralLabel::id,
            'desc' => GeneralLabel::desc,
            'aktif' => GeneralLabel::aktif,
            'created_by' => GeneralLabel::created_by,
            'updated_by' => GeneralLabel::updated_by,
            'created' => GeneralLabel::created,
            'updated' => GeneralLabel::updated,
        ];
    }
}
