<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_atlet_pembangunan_kursuskem".
 *
 * @property integer $kursus_kem_id
 * @property integer $atlet_id
 * @property string $jenis
 * @property string $tarikh_mula
 * @property string $lokasi
 * @property string $nama_kursus_kem
 */
class AtletPembangunanKursuskem extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_atlet_pembangunan_kursuskem';
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
            [['atlet_id', 'tarikh_mula', 'tarikh_tamat', 'nama_kursus_kem', 'penganjur'], 'required', 'skipOnEmpty' => true],
            [['atlet_id'], 'integer'],
            [['tarikh_mula', 'jenis'], 'safe'],
            [['lokasi'], 'string', 'max' => 90],
            [['nama_kursus_kem'], 'string', 'max' => 40]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'kursus_kem_id' => 'Kursus / Kem ID',
            'atlet_id' => 'Atlet ID',
            'jenis' => 'Jenis',
            'tarikh_mula' => 'Tarikh Mula',
            'tarikh_tamat' => 'Tarikh Tamat',
            'lokasi' => 'Lokasi',
            'nama_kursus_kem' => 'Nama Kursus / Kem',
            'penganjur' => 'Penganjur'
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefJenisKursuskem(){
        return $this->hasOne(RefJenisKursuskem::className(), ['id' => 'jenis']);
    }
}
