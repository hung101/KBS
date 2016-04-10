<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_biomekanik_anthropometrics".
 *
 * @property integer $biomekanik_anthropometrics_id
 * @property integer $perkhidmatan_biomekanik_id
 * @property string $anthropometrics
 * @property string $cm_kg
 */
class BiomekanikAnthropometrics extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_biomekanik_anthropometrics';
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
            [['anthropometrics', 'cm_kg'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['perkhidmatan_analisa_perlawanan_biomekanik_id'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['cm_kg'], 'number', 'message' => GeneralMessage::yii_validation_number],
            [['anthropometrics'], 'string', 'max' => 80, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['catatan'], 'string', 'max' => 80, 'tooLong' => GeneralMessage::yii_validation_string_max]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'biomekanik_anthropometrics_id' => GeneralLabel::biomekanik_anthropometrics_id,
            'perkhidmatan_analisa_perlawanan_biomekanik_id' => GeneralLabel::perkhidmatan_analisa_perlawanan_biomekanik_id,
            'anthropometrics' => GeneralLabel::anthropometrics,
            'cm_kg' => GeneralLabel::cm_kg,
            'catatan' => GeneralLabel::catatan,

        ];
    }
    
    public function getRefAnthropometricsUjian()
    {
        return $this->hasOne(RefAnthropometricsUjian::className(), ['id' => 'anthropometrics']);
    }
}
