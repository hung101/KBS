<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_bsp_prestasi".
 *
 * @property integer $bsp_prestasi_id
 * @property integer $bsp_pemohon_id
 * @property string $laporan_ulasan
 * @property string $nyatakan_sebab_sebab_tidak_menyertai_kejohanan
 */
class BspPrestasi extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_bsp_prestasi';
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
            [['bsp_pemohon_id'], 'required', 'skipOnEmpty' => true],
            [['bsp_pemohon_id'], 'integer'],
            [['laporan_ulasan', 'nyatakan_sebab_sebab_tidak_menyertai_kejohanan'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'bsp_prestasi_id' => 'Bsp Prestasi ID',
            'bsp_pemohon_id' => 'Bsp Pemohon ID',
            'laporan_ulasan' => 'Laporan Ulasan',
            'nyatakan_sebab_sebab_tidak_menyertai_kejohanan' => 'Nyatakan Sebab Sebab Tidak Menyertai Kejohanan',
        ];
    }
}
