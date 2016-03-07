<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_geran_bantuan_gaji".
 *
 * @property integer $geran_bantuan_gaji_id
 * @property string $muatnaik_gambar
 * @property string $nama_jurulatih
 * @property string $cawangan
 * @property string $sub_cawangan
 * @property string $program_msn
 * @property string $lain_lain_program
 * @property string $pusat_latihan
 * @property string $nama_sukan
 * @property string $nama_acara
 * @property string $status_jurulatih
 * @property string $status_permohonan
 * @property string $status_keaktifan_jurulatih
 * @property string $kategori_geran
 * @property string $jumlah_geran
 * @property string $status_geran
 * @property integer $kelulusan
 * @property string $catatan
 */
class GeranBantuanGaji extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_geran_bantuan_gaji';
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
            [['nama_jurulatih', 'tarikh_mula', 'tarikh_tamat', 'status_permohonan', 'kategori_geran', 'jumlah_geran', 'status_geran', 'kelulusan'], 'required', 'skipOnEmpty' => true],
            [['jumlah_geran'], 'number'],
            [['kelulusan'], 'integer'],
            [['muatnaik_gambar'], 'string', 'max' => 100],
            [['nama_jurulatih', 'cawangan', 'sub_cawangan', 'program_msn', 'lain_lain_program', 'pusat_latihan', 'nama_sukan', 'nama_acara'], 'string', 'max' => 80],
            [['status_jurulatih', 'status_permohonan', 'status_keaktifan_jurulatih', 'kategori_geran', 'status_geran'], 'string', 'max' => 30],
            [['catatan'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'geran_bantuan_gaji_id' => 'Geran Bantuan Gaji ID',
            'muatnaik_gambar' => 'Muatnaik Gambar',
            'nama_jurulatih' => 'Nama Jurulatih',
            'cawangan' => 'Cawangan',
            'sub_cawangan' => 'Sub Cawangan',
            'program_msn' => 'Program Msn',
            'lain_lain_program' => 'Lain Lain Program',
            'pusat_latihan' => 'Pusat Latihan',
            'nama_sukan' => 'Nama Sukan',
            'nama_acara' => 'Nama Acara',
            'tarikh_mula' => 'Tarikh Mula',
            'tarikh_tamat' => 'Tarikh Tamat',
            'status_jurulatih' => 'Status Jurulatih',
            'status_permohonan' => 'Status Permohonan',
            'status_keaktifan_jurulatih' => 'Status Keaktifan Jurulatih',
            'kategori_geran' => 'Kategori Geran',
            'jumlah_geran' => 'Jumlah Geran',
            'status_geran' => 'Status Geran',
            'kelulusan' => 'Kelulusan',
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
    public function getRefStatusPermohonanGeranBantuanGajiJurulatih(){
        return $this->hasOne(RefStatusPermohonanGeranBantuanGajiJurulatih::className(), ['id' => 'status_permohonan']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefKategoriGeranJurulatih(){
        return $this->hasOne(RefKategoriGeranJurulatih::className(), ['id' => 'kategori_geran']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefKelulusan(){
        return $this->hasOne(RefKelulusan::className(), ['id' => 'kelulusan']);
    }
}
