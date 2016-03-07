<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_latihan_dan_program".
 *
 * @property integer $latihan_dan_program_id
 * @property string $nama_kursus
 * @property string $tarikh_kursus
 * @property string $lokasi_kursus
 * @property string $penganjuran_kursus
 * @property integer $bilangan_ahli_yang_menyertai
 */
class LatihanDanProgram extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_latihan_dan_program';
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
            [['kategori_kursus', 'nama_kursus', 'tarikh_kursus', 'lokasi_kursus', 'penganjuran_kursus'], 'required', 'skipOnEmpty' => true],
            [['tarikh_kursus'], 'safe'],
            [['bilangan_ahli_yang_menyertai'], 'integer'],
            [['nama_kursus', 'lokasi_kursus'], 'string', 'max' => 100],
            [['penganjuran_kursus'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'latihan_dan_program_id' => 'Latihan Dan Program ID',
            'kategori_kursus' => 'Kategori Kursus',
            'nama_kursus' => 'Nama Kursus',
            'tarikh_kursus' => 'Tarikh Kursus',
            'lokasi_kursus' => 'Lokasi Kursus',
            'penganjuran_kursus' => 'Penganjuran Kursus',
            'bilangan_ahli_yang_menyertai' => 'Bilangan Ahli Yang Menyertai',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefKategoriKursus(){
        return $this->hasOne(RefKategoriKursus::className(), ['id' => 'kategori_kursus']);
    }
}
