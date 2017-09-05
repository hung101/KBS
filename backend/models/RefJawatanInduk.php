<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_ref_jawatan_induk".
 *
 * @property integer $id
 * @property string $desc
 * @property integer $aktif
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created
 * @property string $updated
 */
class RefJawatanInduk extends \yii\db\ActiveRecord
{
    const PRESIDEN = 1;
    const TIMBALAN_PRESIDEN = 2;
    const NAIB_PRESIDEN_1 = 3;
    const NAIB_PRESIDEN_2 = 4;
    const NAIB_PRESIDEN_3 = 5;    
    const NAIB_PRESIDEN_4 = 6;
    const NAIB_PRESIDEN_5 = 7;
    const NAIB_PRESIDEN_6 = 8;
    const NAIB_PRESIDEN_7 = 9;
    const NAIB_PRESIDEN_8 = 10;
    const NAIB_PRESIDEN_9 = 11;
    const NAIB_PRESIDEN_10 = 12;
    const BENDAHARI = 13;
    const PENOLONG_BENDAHARI = 14;
    const SETIAUSAHA = 15;
    const PENOLONG_SETIAUSAHA = 16;
    const AHLI_JAWATANKUASA = 17;
    const JURUAUDIT_1 = 18;
    const JURUAUDIT_2 = 19;
    const PENAUNG = 20;
    const PENASIHAT = 21;
    
    /**
     * @inheritdoc
     */
    public static function tableName() 
    {
        return 'tbl_ref_jawatan_induk';
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
            [['desc'], function ($attribute, $params) {
                if (!\common\models\general\GeneralFunction::validateXSS($this->$attribute)) {
                    $this->addError($attribute, GeneralMessage::yii_validation_xss);
                }
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
