<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_pengurusan_kejohanan_temasya".
 *
 * @property integer $pengurusan_kejohanan_temasya_id
 * @property string $tarikh_kejohanan
 * @property string $nama_sukan
 * @property string $nama_acara
 * @property string $lokasi_kejohanan
 * @property string $nama_ketua_kontijen
 * @property string $nama_atlet
 * @property string $nama_pegawai
 * @property string $nama_doktor
 * @property string $nama_fisio
 * @property string $tarikh_penginapan_mula
 * @property string $tarikh_penginapan_akhir
 * @property string $tarikh_perjalanan_pesawat
 * @property string $tarikh_pulang_perjalanan_pesawat
 * @property string $catatan_pesawat
 */
class PengurusanKejohananTemasya extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_pengurusan_kejohanan_temasya';
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
            [['tarikh_kejohanan', 'nama_kejohanan_temasya', 'peringkat', 'nama_sukan', 'nama_acara', 'lokasi_kejohanan', 'nama_ketua_kontijen', 'nama_atlet', 'nama_pegawai', 'nama_doktor', 'nama_fisio', 'tarikh_penginapan_mula', 'tarikh_penginapan_akhir', 'tarikh_perjalanan_pesawat', 'tarikh_pulang_perjalanan_pesawat'], 'required', 'skipOnEmpty' => true],
            [['tarikh_kejohanan', 'tarikh_penginapan_mula', 'tarikh_penginapan_akhir', 'tarikh_perjalanan_pesawat', 'tarikh_pulang_perjalanan_pesawat'], 'safe'],
            [['nama_sukan', 'nama_acara', 'nama_ketua_kontijen', 'nama_atlet', 'nama_pegawai', 'nama_doktor', 'nama_fisio'], 'string', 'max' => 80],
            [['lokasi_kejohanan'], 'string', 'max' => 90],
            [['catatan_pesawat'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pengurusan_kejohanan_temasya_id' => 'Pengurusan Kejohanan Temasya ID',
            'nama_kejohanan_temasya' => 'Nama Kejohanan / Temasya',
            'peringkat' => 'Peringkat',
            'tarikh_kejohanan' => 'Tarikh Kejohanan',
            'nama_sukan' => 'Nama Sukan',
            'nama_acara' => 'Nama Acara',
            'lokasi_kejohanan' => 'Lokasi Kejohanan',
            'nama_ketua_kontijen' => 'Nama Ketua Kontijen',
            'nama_atlet' => 'Nama Atlet',
            'nama_pegawai' => 'Nama Pegawai',
            'nama_doktor' => 'Nama Doktor',
            'nama_fisio' => 'Nama Fisio',
            'tarikh_penginapan_mula' => 'Tarikh Penginapan Mula',
            'tarikh_penginapan_akhir' => 'Tarikh Penginapan Akhir',
            'tarikh_perjalanan_pesawat' => 'Tarikh Perjalanan Kapal Terbang Dari',
            'tarikh_pulang_perjalanan_pesawat' => 'Ke',
            'catatan_pesawat' => 'Catatan',
        ];
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
