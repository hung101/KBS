<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_six_step".
 *
 * @property integer $six_step_id
 * @property integer $atlet_id
 * @property string $stage
 * @property string $status
 */
class SixStepSatelit extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_six_step_satelit';
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
            [['atlet_id', 'stage', 'status'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['atlet_id', 'kategori_atlet', 'sukan', 'acara'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['stage', 'status'], 'string', 'max' => 30, 'tooLong' => GeneralMessage::yii_validation_string_max]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'six_step_id' => GeneralLabel::six_step_id,
            'atlet_id' => GeneralLabel::atlet_id,
            'kategori_atlet' => GeneralLabel::kategori_atlet,
            'sukan' => GeneralLabel::sukan,
            'acara' => GeneralLabel::acara,
            'stage' => GeneralLabel::stage,
            'status' => GeneralLabel::status,

        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAtlet(){
        return $this->hasOne(Atlet::className(), ['atlet_id' => 'atlet_id']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefSixstepSatelitStage(){
        return $this->hasOne(RefSixstepSatelitStage::className(), ['id' => 'stage']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefSixstepSatelitStatus(){
        return $this->hasOne(RefSixstepSatelitStatus::className(), ['id' => 'status']);
    }
}
