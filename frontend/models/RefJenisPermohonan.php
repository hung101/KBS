<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_ref_jenis_permohonan".
 *
 * @property integer $id
 * @property string $desc
 * @property integer $aktif
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created
 * @property string $updated
 */
class RefJenisPermohonan extends \yii\db\ActiveRecord
{
    const MAJLIS_SUKAN_NEGARA = 1;
    const PSK = 2;
    const USPTN = 3;
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_ref_jenis_permohonan';
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
            'butiran' => GeneralLabel::butiran,
            'created_by' => GeneralLabel::created_by,
            'updated_by' => GeneralLabel::updated_by,
            'created' => GeneralLabel::created,
            'updated' => GeneralLabel::updated,

        ];
    }
}
