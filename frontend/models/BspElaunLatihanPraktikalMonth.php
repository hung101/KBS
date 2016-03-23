<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;

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
            'bsp_elaun_latihan_praktikal_month_id' => GeneralLabel::bsp_elaun_latihan_praktikal_month_id,
            'bsp_elaun_latihan_praktikal_id' => GeneralLabel::bsp_elaun_latihan_praktikal_id,
            'bulan' => GeneralLabel::bulan,
            'jumlah_hari' => GeneralLabel::jumlah_hari,

        ];
    }
}
