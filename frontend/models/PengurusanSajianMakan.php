<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_pengurusan_sajian_makan".
 *
 * @property integer $pengurusan_sajian_makan_id
 * @property integer $atlet_id
 * @property string $tarikh_mula
 * @property string $tarikh_akhir
 * @property string $bilangan_tempahan_makan
 */
class PengurusanSajianMakan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_pengurusan_sajian_makan';
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
            [['atlet_id', 'tarikh_mula', 'tarikh_akhir', 'bilangan_tempahan_makan'], 'required', 'skipOnEmpty' => true],
            [['atlet_id'], 'integer'],
            [['tarikh_mula', 'tarikh_akhir'], 'safe'],
            [['bilangan_tempahan_makan'], 'string', 'max' => 50],
            [['catatan'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pengurusan_sajian_makan_id' => 'Pengurusan Sajian Makan ID',
            'atlet_id' => 'Atlet',
            'tarikh_mula' => 'Tarikh Mula',
            'tarikh_akhir' => 'Tarikh Akhir',
            'bilangan_tempahan_makan' => 'Bilangan Tempahan Makan',
            'catatan' => 'Catatan',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefAtlet(){
        return $this->hasOne(Atlet::className(), ['atlet_id' => 'atlet_id']);
    }
}
