<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_six_step".
 *
 * @property integer $six_step_id
 * @property integer $atlet_id
 * @property string $stage
 * @property string $status
 */
class SixStep extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_six_step';
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
            [['atlet_id', 'stage', 'status'], 'required', 'skipOnEmpty' => true],
            [['atlet_id', 'kategori_atlet', 'sukan', 'acara'], 'integer'],
            [['stage', 'status'], 'string', 'max' => 30]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'six_step_id' => 'Six Step ID',
            'atlet_id' => 'Atlet',
            'kategori_atlet' => 'Kategori Atlet',
            'sukan' => 'Sukan',
            'acara' => 'Acara',
            'stage' => 'Stage',
            'status' => 'Status',
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
    public function getRefSixStepStage(){
        return $this->hasOne(RefSixstepStage::className(), ['id' => 'stage']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefSixStepStatus(){
        return $this->hasOne(RefSixstepStatus::className(), ['id' => 'status']);
    }
}
