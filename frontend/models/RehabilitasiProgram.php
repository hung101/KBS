<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_rehabilitasi_program".
 *
 * @property integer $rehabilitasi_program_id
 * @property integer $rehabilitasi_id
 * @property string $tarikh
 * @property string $nama_exercise_modality
 */
class RehabilitasiProgram extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_rehabilitasi_program';
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
            [['rehabilitasi_id', 'tarikh', 'nama_exercise_modality'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['rehabilitasi_id'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['tarikh'], 'safe'],
            [['nama_exercise_modality'], 'string', 'max' => 80, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['nama_exercise_modality'], function ($attribute, $params) {
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
            'rehabilitasi_program_id' => GeneralLabel::rehabilitasi_program_id,
            'rehabilitasi_id' => GeneralLabel::rehabilitasi_id,
            'tarikh' => GeneralLabel::tarikh,
            'nama_exercise_modality' => GeneralLabel::nama_exercise_modality,

        ];
    }
}
