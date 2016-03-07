<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_pengurusan_pemantauan_dan_penilaian_jurulatih".
 *
 * @property integer $pengurusan_pemantauan_dan_penilaian_jurulatih_id
 * @property string $nama_jurulatih_dinilai
 * @property string $nama_sukan
 * @property string $nama_acara
 * @property string $pusat_latihan
 */
class PengurusanPemantauanDanPenilaianJurulatih extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_pengurusan_pemantauan_dan_penilaian_jurulatih';
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
            [['nama_jurulatih_dinilai', 'nama_sukan', 'nama_acara', 'pusat_latihan', 'penilaian_oleh', 'tarikh_dinilai'], 'required', 'skipOnEmpty' => true],
            [['nama_jurulatih_dinilai', 'nama_sukan', 'nama_acara', 'pusat_latihan'], 'string', 'max' => 80]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pengurusan_pemantauan_dan_penilaian_jurulatih_id' => 'Pengurusan Pemantauan Dan Penilaian Jurulatih ID',
            'nama_jurulatih_dinilai' => 'Nama Jurulatih',
            'nama_sukan' => 'Sukan',
            'nama_acara' => 'Acara',
            'pusat_latihan' => 'Pusat Latihan',
            'penilaian_oleh' => 'Pernilaian Oleh',
            'tarikh_dinilai' => 'Tarikh Dinilai',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefJurulatih(){
        return $this->hasOne(Jurulatih::className(), ['jurulatih_id' => 'nama_jurulatih_dinilai']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefSukan(){
        return $this->hasOne(RefSukan::className(), ['id' => 'nama_sukan']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefAcara(){
        return $this->hasOne(RefAcara::className(), ['id' => 'nama_acara']);
    }
}
