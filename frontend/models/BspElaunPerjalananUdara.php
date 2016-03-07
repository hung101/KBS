<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_bsp_elaun_perjalanan_udara".
 *
 * @property integer $bsp_elaun_perjalanan_udara_id
 * @property integer $bsp_pemohon_id
 * @property string $tarikh
 * @property string $destinasi_pergi
 * @property string $tarikh_pergi
 * @property string $destinasi_balik
 * @property string $tarikh_balik
 */
class BspElaunPerjalananUdara extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_bsp_elaun_perjalanan_udara';
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
            [['tarikh', 'destinasi_pergi', 'tarikh_pergi', 'destinasi_balik', 'tarikh_balik'], 'required', 'skipOnEmpty' => true],
            [['bsp_pemohon_id'], 'integer'],
            [['tarikh', 'tarikh_pergi', 'tarikh_balik'], 'safe'],
            [['destinasi_pergi', 'destinasi_balik'], 'string', 'max' => 90]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'bsp_elaun_perjalanan_udara_id' => 'Bsp Elaun Perjalanan Udara ID',
            'bsp_pemohon_id' => 'Bsp Pemohon ID',
            'tarikh' => 'Tarikh',
            'destinasi_pergi' => 'Destinasi Pergi',
            'tarikh_pergi' => 'Tarikh Pergi',
            'destinasi_balik' => 'Destinasi Balik',
            'tarikh_balik' => 'Tarikh Balik',
            'muat_naik' => 'Muat Naik (Borang Permohonan Bayaran Tuntutan Elaun Perjalanan Udara)',
        ];
    }
}
