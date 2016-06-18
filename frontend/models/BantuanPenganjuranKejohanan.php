<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_bantuan_penganjuran_kejohanan".
 *
 * @property integer $bantuan_penganjuran_kejohanan_id
 * @property string $badan_sukan
 * @property string $sukan
 * @property string $no_pendaftaran
 * @property string $alamat_1
 * @property string $alamat_2
 * @property string $alamat_3
 * @property string $alamat_negeri
 * @property string $alamat_bandar
 * @property string $alamat_poskod
 * @property string $no_telefon
 * @property string $no_faks
 * @property string $laman_sesawang
 * @property string $facebook
 * @property string $twitter
 * @property string $nama_bank
 * @property string $no_akaun
 * @property string $nama_kejohanan_pertandingan
 * @property string $peringkat
 * @property string $tarikh_mula
 * @property string $tarikh_tamat
 * @property string $tempat
 * @property string $tujuan
 * @property integer $bil_pasukan
 * @property integer $bil_peserta
 * @property integer $bil_pengadil_hakim
 * @property integer $bil_pegawai_teknikal
 * @property integer $bilangan_pembantu
 * @property string $anggaran_perbelanjaan
 * @property string $kertas_kerja
 * @property string $surat_rasmi_badan_sukan_ms_negeri
 * @property string $permohonan_rasmi_dari_ahli_gabungan
 * @property string $maklumat_lain_sokongan
 * @property string $jumlah_bantuan_yang_dipohon
 * @property string $status_permohonan
 * @property string $catatan
 * @property string $tarikh_permohonan
 * @property string $jumlah_dilulus
 * @property string $jkb
 * @property string $tarikh_jkb
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created
 * @property string $updated
 */
class BantuanPenganjuranKejohanan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_bantuan_penganjuran_kejohanan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tarikh_mula', 'tarikh_tamat', 'tarikh_permohonan', 'tarikh_jkb', 'created', 'updated'], 'safe'],
            [['bil_pasukan', 'bil_peserta', 'bil_pengadil_hakim', 'bil_pegawai_teknikal', 'bilangan_pembantu', 'created_by', 'updated_by'], 'integer'],
            [['anggaran_perbelanjaan', 'jumlah_bantuan_yang_dipohon', 'jumlah_dilulus'], 'number'],
            [['badan_sukan', 'nama_bank', 'tujuan', 'jkb'], 'string', 'max' => 80],
            [['sukan', 'no_pendaftaran', 'alamat_1', 'alamat_2', 'alamat_3', 'no_akaun', 'nama_kejohanan_pertandingan', 'peringkat', 'status_permohonan'], 'string', 'max' => 30],
            [['alamat_negeri'], 'string', 'max' => 3],
            [['alamat_bandar', 'alamat_poskod'], 'string', 'max' => 5],
            [['no_telefon', 'no_faks'], 'string', 'max' => 14],
            [['laman_sesawang', 'facebook', 'twitter'], 'string', 'max' => 100],
            [['tempat'], 'string', 'max' => 90],
            [['kertas_kerja', 'surat_rasmi_badan_sukan_ms_negeri', 'permohonan_rasmi_dari_ahli_gabungan', 'maklumat_lain_sokongan', 'catatan'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'bantuan_penganjuran_kejohanan_id' => 'Bantuan Penganjuran Kejohanan ID',
            'badan_sukan' => 'Badan Sukan',
            'sukan' => 'Sukan',
            'no_pendaftaran' => 'No. Pendaftaran',
            'alamat_1' => 'Alamat',
            'alamat_2' => '',
            'alamat_3' => '',
            'alamat_negeri' => 'Negeri',
            'alamat_bandar' => 'Bandar',
            'alamat_poskod' => 'Poskod',
            'no_telefon' => 'No. Telefon',
            'no_faks' => 'No. Faks',
            'laman_sesawang' => 'Laman Sesawang',
            'facebook' => 'Facebook',
            'twitter' => 'Twitter',
            'nama_bank' => 'Nama Bank',
            'no_akaun' => 'No. Akaun',
            'nama_kejohanan_pertandingan' => 'Nama Kejohanan / Pertandingan',
            'peringkat' => 'Peringkat',
            'tarikh_mula' => 'Tarikh Mula',
            'tarikh_tamat' => 'Tarikh Tamat',
            'tempat' => 'Tempat',
            'tujuan' => 'Tujuan',
            'bil_pasukan' => 'Bilangan Pasukan',
            'bil_peserta' => 'Bilangan Peserta',
            'bil_pengadil_hakim' => 'Bilangan Pengadil / Hakim',
            'bil_pegawai_teknikal' => 'Bilangan Pegawai Teknikal',
            'bilangan_pembantu' => 'Bilangan Pembantu',
            'anggaran_perbelanjaan' => 'Anggaran Perbelanjaan (RM)',
            'kertas_kerja' => 'Kertas Kerja',
            'surat_rasmi_badan_sukan_ms_negeri' => 'Surat Rasmi Badan Sukan Ms Negeri',
            'permohonan_rasmi_dari_ahli_gabungan' => 'Permohonan Rasmi Dari Ahli Gabungan',
            'maklumat_lain_sokongan' => 'Maklumat Lain (Sokongan)',
            'jumlah_bantuan_yang_dipohon' => 'Jumlah (RM)',
            'status_permohonan' => 'Status Permohonan',
            'catatan' => 'Catatan',
            'tarikh_permohonan' => 'Tarikh Permohonan',
            'jumlah_dilulus' => 'Jumlah Dilulus',
            'jkb' => 'JKB',
            'tarikh_jkb' => 'Tarikh JKB',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created' => 'Created',
            'updated' => 'Updated',
        ];
    }
}
