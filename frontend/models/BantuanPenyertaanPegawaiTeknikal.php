<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_bantuan_penyertaan_pegawai_teknikal".
 *
 * @property integer $bantuan_penyertaan_pegawai_teknikal_id
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
 * @property string $nama_kejohanan
 * @property string $peringkat
 * @property string $peringkat_lain_lain
 * @property string $tarikh
 * @property string $tempat
 * @property string $tujuan
 * @property string $surat_rasmi_badan_sukan_ms_negeri
 * @property string $surat_jemputan_lantikan_daripada_pengelola
 * @property string $butiran_perbelanjaan
 * @property string $salinan_passport
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
class BantuanPenyertaanPegawaiTeknikal extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_bantuan_penyertaan_pegawai_teknikal';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['badan_sukan', 'sukan', 'no_pendaftaran', 'alamat_1', 'alamat_negeri', 'alamat_bandar', 'alamat_poskod', 'no_telefon', 'nama_bank', 'no_akaun', 'nama_kejohanan', 'peringkat', 'tarikh', 'tempat', 'tujuan', 'jumlah_bantuan_yang_dipohon', 'tarikh_permohonan'], 'required'],
            [['tarikh', 'tarikh_permohonan', 'tarikh_jkb', 'created', 'updated'], 'safe'],
            [['jumlah_bantuan_yang_dipohon', 'jumlah_dilulus'], 'number'],
            [['created_by', 'updated_by'], 'integer'],
            [['badan_sukan', 'nama_bank', 'nama_kejohanan', 'peringkat_lain_lain', 'tujuan', 'jkb'], 'string', 'max' => 80],
            [['sukan', 'no_pendaftaran', 'alamat_1', 'alamat_2', 'alamat_3', 'no_akaun', 'peringkat', 'status_permohonan'], 'string', 'max' => 30],
            [['alamat_negeri'], 'string', 'max' => 3],
            [['alamat_bandar', 'alamat_poskod'], 'string', 'max' => 5],
            [['no_telefon', 'no_faks'], 'string', 'max' => 14],
            [['laman_sesawang', 'facebook', 'twitter'], 'string', 'max' => 100],
            [['tempat'], 'string', 'max' => 90],
            [['surat_rasmi_badan_sukan_ms_negeri', 'surat_jemputan_lantikan_daripada_pengelola', 'butiran_perbelanjaan', 'salinan_passport', 'maklumat_lain_sokongan', 'catatan'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'bantuan_penyertaan_pegawai_teknikal_id' => 'Bantuan Penyertaan Pegawai Teknikal ID',
            'badan_sukan' => 'Badan Sukan',
            'sukan' => 'Sukan',
            'no_pendaftaran' => 'No Pendaftaran',
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
            'nama_kejohanan' => 'Nama Kejohanan',
            'peringkat' => 'Peringkat',
            'peringkat_lain_lain' => 'Peringkat Lain Lain',
            'tarikh' => 'Tarikh',
            'tempat' => 'Tempat',
            'tujuan' => 'Tujuan',
            'surat_rasmi_badan_sukan_ms_negeri' => 'Surat Rasmi Badan Sukan',
            'surat_jemputan_lantikan_daripada_pengelola' => 'Surat Jemputan / Lantikan Daripada Pengelola',
            'butiran_perbelanjaan' => 'Butiran Perbelanjaan',
            'salinan_passport' => 'Salinan Passport',
            'maklumat_lain_sokongan' => 'Maklumat Lain (Sokongan)',
            'jumlah_bantuan_yang_dipohon' => 'Jumlah Bantuan Yang Dipohon',
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