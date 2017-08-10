<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_senarai_jurulatih".
 *
 * @property integer $senarai_jurulatih_id
 * @property integer $pengurusan_jkk_jkp_program_id
 * @property string $jurulatih
 */
class SenaraiJurulatih extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_senarai_jurulatih';
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
            [['jurulatih'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['pengurusan_jkk_jkp_program_id'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['jurulatih'], 'string', 'max' => 80, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['jurulatih'], 'filter', 'filter' => function ($value) {
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
            'senarai_jurulatih_id' => GeneralLabel::senarai_jurulatih_id,
            'pengurusan_jkk_jkp_program_id' => GeneralLabel::pengurusan_jkk_jkp_program_id,
            'jurulatih' => GeneralLabel::jurulatih,

        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefJurulatih(){
        return $this->hasOne(Jurulatih::className(), ['jurulatih_id' => 'jurulatih']);
    }
}
