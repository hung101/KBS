<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_atlet_pembangunan_kaunseling".
 *
 * @property integer $kaunseling_id
 * @property integer $atlet_id
 * @property string $tarikh
 * @property string $tujuan
 * @property string $susulan
 */
class AtletPembangunanKaunseling extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_atlet_pembangunan_kaunseling';
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
            [['atlet_id', 'tarikh', 'tujuan'], 'required', 'skipOnEmpty' => true],
            [['atlet_id'], 'integer'],
            [['tarikh'], 'safe'],
            [['tujuan', 'susulan'], 'string', 'max' => 250]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'kaunseling_id' => 'Kaunseling ID',
            'atlet_id' => 'Atlet ID',
            'tarikh' => 'Tarikh',
            'tujuan' => 'Tujuan',
            'susulan' => 'Susulan',
        ];
    }
}
