<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_pendaftaran_gym".
 *
 * @property integer $pendaftaran_gym_id
 * @property integer $atlet_id
 * @property string $tarikh
 * @property string $sukan
 */
class PendaftaranGym extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_pendaftaran_gym';
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
            [['atlet_id', 'tarikh', 'sukan'], 'required', 'skipOnEmpty' => true],
            [['atlet_id'], 'integer'],
            ['tarikh', 'compare', 'compareValue' => date('Y-m-d H:i:s'), 'operator' => '>='],
            [['sukan'], 'string', 'max' => 30]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pendaftaran_gym_id' => 'Pendaftaran Gym ID',
            'atlet_id' => 'Atlet',
            'tarikh' => 'Tarikh & Masa',
            'sukan' => 'Sukan',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefAtlet(){
        return $this->hasOne(Atlet::className(), ['atlet_id' => 'atlet_id']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefSukan(){
        return $this->hasOne(RefSukan::className(), ['id' => 'sukan']);
    }
}
