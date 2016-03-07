<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_senarai_atlet".
 *
 * @property integer $senarai_atlet_id
 * @property integer $pengurusan_jkk_jkp_program_id
 * @property string $atlet
 */
class SenaraiAtlet extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_senarai_atlet';
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
            [['atlet'], 'required', 'skipOnEmpty' => true],
            [['pengurusan_jkk_jkp_program_id'], 'integer'],
            [['atlet'], 'string', 'max' => 80]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'senarai_atlet_id' => 'Senarai Atlet ID',
            'pengurusan_jkk_jkp_program_id' => 'Pengurusan Jkk Jkp Program ID',
            'atlet' => 'Atlet',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefAtlet(){
        return $this->hasOne(Atlet::className(), ['atlet_id' => 'atlet']);
    }
}
