<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_bsp_elaun_latihan_praktikal".
 *
 * @property integer $bsp_elaun_latihan_praktikal_id
 * @property integer $bsp_pemohon_id
 * @property string $tarikh
 * @property string $jenis_latihan_amali
 * @property string $tempat_latihan_praktikal
 * @property string $tarikh_mula
 * @property string $tarikh_tamat
 * @property integer $jumlah_hari
 */
class BspElaunLatihanPraktikal extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_bsp_elaun_latihan_praktikal';
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
            [['tarikh', 'jenis_latihan_amali', 'tempat_latihan_praktikal', 'tarikh_mula', 'tarikh_tamat', 'jumlah_hari'], 'required', 'skipOnEmpty' => true],
            [['bsp_pemohon_id', 'jumlah_hari'], 'integer'],
            [['tarikh', 'tarikh_mula', 'tarikh_tamat'], 'safe'],
            [['jenis_latihan_amali'], 'string', 'max' => 30],
            [['tempat_latihan_praktikal'], 'string', 'max' => 90]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'bsp_elaun_latihan_praktikal_id' => 'Bsp Elaun Latihan Praktikal ID',
            'bsp_pemohon_id' => 'Bsp Pemohon ID',
            'tarikh' => 'Tarikh',
            'jenis_latihan_amali' => 'Jenis Latihan Amali',
            'tempat_latihan_praktikal' => 'Tempat Latihan Praktikal',
            'tarikh_mula' => 'Tarikh Mula',
            'tarikh_tamat' => 'Tarikh Tamat',
            'jumlah_hari' => 'Jumlah Hari',
            'muat_naik' => 'Muat Naik (Borang Tuntutan Elaun Latihan Praktikal)',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefJenisLatihanAmali(){
        return $this->hasOne(RefJenisLatihanAmali::className(), ['id' => 'jenis_latihan_amali']);
    }
}
