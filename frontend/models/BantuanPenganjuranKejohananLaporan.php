<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_bantuan_penganjuran_kejohanan_laporan".
 *
 * @property integer $bantuan_penganjuran_kejohanan_laporan_id
 * @property integer $bantuan_penganjuran_kejohanan_id
 * @property string $tarikh
 * @property string $tempat
 * @property string $tujuan_penganjuran
 * @property integer $bilangan_pasukan
 * @property integer $bilangan_peserta
 * @property integer $bilangan_pegawai_teknikal
 * @property integer $bilangan_pembantu
 * @property string $laporan_bergambar
 * @property string $penyata_perbelanjaan_resit_yang_telah_disahkan
 * @property string $jadual_keputusan_pertandingan
 * @property string $senarai_pasukan
 * @property string $senarai_statistik_penyertaan
 * @property string $senarai_pegawai_pembantu_teknikal
 * @property string $senarai_urusetia_sukarelawan
 * @property string $senarai_pegawai_pembantu_perubatan
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created
 * @property string $updated
 */
class BantuanPenganjuranKejohananLaporan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_bantuan_penganjuran_kejohanan_laporan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bantuan_penganjuran_kejohanan_id', 'bilangan_pasukan', 'bilangan_peserta', 'bilangan_pegawai_teknikal', 'bilangan_pembantu', 'created_by', 'updated_by'], 'integer'],
            [['tarikh', 'tempat', 'tujuan_penganjuran', 'bilangan_pasukan', 'bilangan_peserta', 'bilangan_pegawai_teknikal', 'bilangan_pembantu'], 'required'],
            [['tarikh', 'created', 'updated'], 'safe'],
            [['tempat'], 'string', 'max' => 90],
            [['tujuan_penganjuran'], 'string', 'max' => 80],
            [['laporan_bergambar', 'penyata_perbelanjaan_resit_yang_telah_disahkan', 'jadual_keputusan_pertandingan', 'senarai_pasukan', 'senarai_statistik_penyertaan', 'senarai_pegawai_pembantu_teknikal', 'senarai_urusetia_sukarelawan', 'senarai_pegawai_pembantu_perubatan'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'bantuan_penganjuran_kejohanan_laporan_id' => 'Bantuan Penganjuran Kejohanan Laporan ID',
            'bantuan_penganjuran_kejohanan_id' => 'Bantuan Penganjuran Kejohanan ID',
            'tarikh' => 'Tarikh',
            'tempat' => 'Tempat',
            'tujuan_penganjuran' => 'Tujuan Penganjuran',
            'bilangan_pasukan' => 'Bilangan Pasukan',
            'bilangan_peserta' => 'Bilangan Peserta',
            'bilangan_pegawai_teknikal' => 'Bilangan Pegawai Teknikal',
            'bilangan_pembantu' => 'Bilangan Pembantu',
            'laporan_bergambar' => 'Laporan Bergambar',
            'penyata_perbelanjaan_resit_yang_telah_disahkan' => 'Penyata Perbelanjaan / Resit Yang Telah Disahkan',
            'jadual_keputusan_pertandingan' => 'Jadual & Keputusan Pertandingan',
            'senarai_pasukan' => 'Senarai Pasukan',
            'senarai_statistik_penyertaan' => 'Senarai Statistik Penyertaan',
            'senarai_pegawai_pembantu_teknikal' => 'Senarai Pegawai / Pembantu Teknikal',
            'senarai_urusetia_sukarelawan' => 'Senarai Urusetia / Sukarelawan',
            'senarai_pegawai_pembantu_perubatan' => 'Senarai Pegawai / Pembantu Perubatan',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created' => 'Created',
            'updated' => 'Updated',
        ];
    }
}
