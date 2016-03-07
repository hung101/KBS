<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_gaji_dan_elaun_jurulatih".
 *
 * @property integer $gaji_dan_elaun_jurulatih_id
 * @property integer $nama_jurulatih
 * @property string $no_kad_pengenalan
 * @property string $no_passport
 * @property string $nama_sukan
 * @property string $tarikh_mula
 * @property string $bank
 * @property string $no_akaun
 * @property string $cawangan
 * @property string $catatan
 */
class GajiDanElaunJurulatih extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_gaji_dan_elaun_jurulatih';
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
            [['nama_jurulatih', 'bank', 'no_akaun', 'cawangan'], 'required', 'skipOnEmpty' => true],
            [['nama_jurulatih'], 'integer'],
            [['no_kad_pengenalan'], 'string', 'max' => 12],
            [['no_passport'], 'string', 'max' => 15],
            [['nama_sukan', 'bank', 'cawangan'], 'string', 'max' => 80],
            [['tarikh_mula', 'tarikh_tamat'], 'safe'],
            [['no_akaun'], 'string', 'max' => 50],
            [['catatan'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'gaji_dan_elaun_jurulatih_id' => 'Gaji Dan Elaun Jurulatih ID',
            'nama_jurulatih' => 'Nama Jurulatih',
            'no_kad_pengenalan' => 'No Kad Pengenalan',
            'no_passport' => 'No Passport',
            'nama_sukan' => 'Nama Sukan',
            'tarikh_mula' => 'Tarikh Mula',
            'tarikh_tamat' => 'Tarikh Tamat',
            'bank' => 'Bank',
            'no_akaun' => 'No Akaun',
            'cawangan' => 'Cawangan',
            'catatan' => 'Catatan',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefJurulatih(){
        return $this->hasOne(Jurulatih::className(), ['jurulatih_id' => 'nama_jurulatih']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefBank(){
        return $this->hasOne(RefBank::className(), ['id' => 'bank']);
    }
}
