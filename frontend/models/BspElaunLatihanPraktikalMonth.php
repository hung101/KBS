<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_bsp_elaun_latihan_praktikal_month".
 *
 * @property integer $bsp_elaun_latihan_praktikal_month_id
 * @property integer $bsp_elaun_latihan_praktikal_id
 * @property string $bulan
 * @property integer $jumlah_hari
 */
class BspElaunLatihanPraktikalMonth extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_bsp_elaun_latihan_praktikal_month';
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
            [['bulan', 'jumlah_hari'], 'required', 'skipOnEmpty' => true],
            [['bsp_elaun_latihan_praktikal_id', 'jumlah_hari'], 'integer'],
            [['bulan'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'bsp_elaun_latihan_praktikal_month_id' => 'Bsp Elaun Latihan Praktikal Month ID',
            'bsp_elaun_latihan_praktikal_id' => 'Bsp Elaun Latihan Praktikal ID',
            'bulan' => 'Bulan',
            'jumlah_hari' => 'Jumlah Hari',
        ];
    }
}
