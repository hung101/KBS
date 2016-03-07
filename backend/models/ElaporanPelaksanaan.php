<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_elaporan_pelaksanaan".
 *
 * @property integer $elaporan_pelaksaan_id
 * @property string $kategori_elaporan
 * @property string $nama_projek_program_aktiviti_kejohanan
 * @property string $peringkat
 * @property string $nama_penganjur_persatuan_kerjasama
 * @property string $jumlah_bantuan_peruntukan
 * @property string $jumlah_perbelanjaan
 * @property string $no_cek_eft
 * @property string $tarikh_cek_eft
 * @property string $tarikh_pelaksanaan_mula
 * @property string $tarikh_pelaksanaan_akhir
 * @property string $objektif_pelaksaan
 * @property string $alamat_tempat_pelaksanaan_1
 * @property string $dirasmikan_oleh
 * @property integer $lelaki
 * @property integer $perempuan
 * @property integer $l_melayu
 * @property integer $l_cina
 * @property integer $l_india
 * @property integer $l_lain_lain
 * @property integer $jumlah_penyertaan
 * @property string $rumusan_program
 * @property string $muat_naik
 */
class ElaporanPelaksanaan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_elaporan_pelaksanaan';
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
            [['kelulusan','kategori_elaporan', 'nama_projek_program_aktiviti_kejohanan', 'peringkat', 'nama_penganjur_persatuan_kerjasama', 'jumlah_bantuan_peruntukan', 'tarikh_pelaksanaan_mula', 'tarikh_pelaksanaan_akhir', 'dirasmikan_oleh', 'lelaki', 'perempuan', 'l_melayu', 'l_cina', 'l_india', 'l_lain_lain', 'p_melayu', 'p_cina', 'p_india', 'p_lain_lain', 'jumlah_penyertaan'], 'required', 'skipOnEmpty' => true],
            [['jumlah_bantuan_peruntukan', 'jumlah_perbelanjaan'], 'number'],
            [['tarikh_cek_eft', 'tarikh_pelaksanaan_mula', 'tarikh_pelaksanaan_akhir'], 'safe'],
            [['lelaki', 'perempuan', 'l_melayu', 'l_cina', 'l_india', 'l_lain_lain', 'p_melayu', 'p_cina', 'p_india', 'p_lain_lain', 'jumlah_penyertaan', 'bahagian', 'cawangan', 'user_public_id', 'kategori_elaporan', 'permohonan_e_bantuan_id', 'kelulusan'], 'integer'],
            [['peringkat', 'rumusan_program'], 'string', 'max' => 30],
            [['nama_projek_program_aktiviti_kejohanan', 'nama_penganjur_persatuan_kerjasama', 'dirasmikan_oleh', 'creator_nama'], 'string', 'max' => 80],
            [['no_cek_eft'], 'string', 'max' => 50],
            [['objektif_pelaksaan'], 'string', 'max' => 255],
            [['alamat_tempat_pelaksanaan_1', 'alamat_tempat_pelaksanaan_2', 'alamat_tempat_pelaksanaan_3'], 'string', 'max' => 30],
            [['alamat_tempat_pelaksanaan_bandar', 'alamat_tempat_pelaksanaan_poskod'], 'string', 'max' => 5],
            [['alamat_tempat_pelaksanaan_negeri', 'alamat_tempat_pelaksanaan_parlimen'], 'string', 'max' => 3],
            [['creator_mobile_no'], 'string', 'max' => 14],
            [['muat_naik', 'creator_emel'], 'string', 'max' => 100],
            //[['tarikh_pelaksanaan_mula'], 'compare', 'compareAttribute'=>'tarikh_pelaksanaan_akhir', 'operator'=>'<=', 'skipOnEmpty'=>true],
            [['tarikh_pelaksanaan_akhir'], 'compare', 'compareAttribute'=>'tarikh_pelaksanaan_mula', 'operator'=>'>='],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'elaporan_pelaksaan_id' => 'Elaporan Pelaksaan ID',
            'kategori_elaporan' => 'Kategori E-Laporan',
            'nama_projek_program_aktiviti_kejohanan' => 'Nama Projek Program / Aktiviti / Kejohanan',
            'peringkat' => 'Peringkat',
            'nama_penganjur_persatuan_kerjasama' => 'Nama Penganjur / Persatuan',
            'jumlah_bantuan_peruntukan' => 'Jumlah Bantuan / Peruntukan (RM)',
            'jumlah_perbelanjaan' => 'Jumlah Perbelanjaan (RM)',
            'no_cek_eft' => 'No Cek / EFT',
            'tarikh_cek_eft' => 'Tarikh Cek / EFT',
            'tarikh_pelaksanaan_mula' => 'Tarikh Mula',
            'tarikh_pelaksanaan_akhir' => 'Tarikh Akhir',
            'objektif_pelaksaan' => 'Objektif Pelaksaan',
            'alamat_tempat_pelaksanaan_1' => 'Alamat Tempat Pelaksanaan',
            'alamat_tempat_pelaksanaan_2' => '',
            'alamat_tempat_pelaksanaan_3' => '',
            'alamat_tempat_pelaksanaan_negeri' => 'Negeri',
            'alamat_tempat_pelaksanaan_bandar' => 'Bandar',
            'alamat_tempat_pelaksanaan_parlimen' => 'Parlimen',
            'alamat_tempat_pelaksanaan_poskod' => 'Poskod',
            'dirasmikan_oleh' => 'Dirasmikan Oleh',
            'lelaki' => 'Lelaki',
            'perempuan' => 'Perempuan',
            'l_melayu' => 'Melayu (Lelaki)',
            'l_cina' => 'Cina (Lelaki)',
            'l_india' => 'India (Lelaki)',
            'l_lain_lain' => 'Lain-lain (Lelaki)',
            'p_melayu' => 'Melayu (Perempuan)',
            'p_cina' => 'Cina (Perempuan)',
            'p_india' => 'India (Perempuan)',
            'p_lain_lain' => 'Lain-lain (Perempuan)',
            'jumlah_penyertaan' => 'Jumlah Penyertaan',
            'bahagian' => 'Bahagian',
            'cawangan' => 'Cawangan',
            'rumusan_program' => 'Rumusan Program',
            'muat_naik' => 'Muat Naik',
            'creator_nama' => 'Nama Pelapor',
            'creator_emel' => 'Emel Pelapor',
            'creator_mobile_no' => 'Tel No Pelapor',
            'kelulusan' => 'Kelulusan',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefKategoriELaporan(){
        return $this->hasOne(RefKategoriELaporan::className(), ['id' => 'kategori_elaporan']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefPeringkatELaporan(){
        return $this->hasOne(RefPeringkatELaporan::className(), ['id' => 'peringkat']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefParlimen(){
        return $this->hasOne(RefParlimen::className(), ['id' => 'alamat_tempat_pelaksanaan_parlimen']);
    }
}
