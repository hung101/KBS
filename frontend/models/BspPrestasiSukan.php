<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_bsp_prestasi_sukan".
 *
 * @property integer $bsp_prestasi_sukan_id
 * @property integer $bsp_pemohon_id
 * @property string $tarikh
 * @property string $kejohanan_yang_disertai
 * @property string $lokasi_kejohanan
 * @property string $pencapaian
 */
class BspPrestasiSukan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_bsp_prestasi_sukan';
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
            [['bsp_pemohon_id', 'tarikh', 'kejohanan_yang_disertai', 'lokasi_kejohanan', 'pencapaian'], 'required', 'skipOnEmpty' => true],
            [['bsp_pemohon_id'], 'integer'],
            [['tarikh'], 'safe'],
            [['kejohanan_yang_disertai'], 'string', 'max' => 80],
            [['lokasi_kejohanan'], 'string', 'max' => 90],
            [['pencapaian'], 'string', 'max' => 30]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'bsp_prestasi_sukan_id' => 'Bsp Prestasi Sukan ID',
            'bsp_pemohon_id' => 'Bsp Pemohon ID',
            'tarikh' => 'Tarikh',
            'kejohanan_yang_disertai' => 'Kejohanan Yang Disertai',
            'lokasi_kejohanan' => 'Lokasi Kejohanan',
            'pencapaian' => 'Pencapaian',
        ];
    }
}
