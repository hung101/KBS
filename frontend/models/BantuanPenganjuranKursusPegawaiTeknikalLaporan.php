<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_bantuan_penganjuran_kursus_pegawai_teknikal_laporan".
 *
 * @property integer $bantuan_penganjuran_kursus_pegawai_teknikal_laporan_id
 * @property string $tarikh
 * @property string $tempat
 * @property string $tujuan_kursus_kejohanan
 * @property integer $bilangan_pasukan
 * @property integer $bilangan_peserta
 * @property integer $bilangan_pegawai_teknikal
 * @property integer $bilangan_pembantu
 * @property string $laporan_bergambar
 * @property string $penyata_perbelanjaan_resit_yang_telah_disahkan
 * @property string $jadual_keputusan_pertandingan
 * @property string $senarai_peserta
 * @property string $statistik_penyertaan
 * @property string $senarai_pegawai_penceramah
 * @property string $senarai_urusetia_sukarelawan
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created
 * @property string $updated
 */
class BantuanPenganjuranKursusPegawaiTeknikalLaporan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_bantuan_penganjuran_kursus_pegawai_teknikal_laporan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tarikh', 'tempat', 'tujuan_kursus_kejohanan', 'bilangan_pasukan', 'bilangan_peserta', 'bilangan_pembantu', 'bilangan_pegawai_teknikal'], 'required'],
            [['tarikh', 'created', 'updated'], 'safe'],
            [['bilangan_pasukan', 'bilangan_peserta', 'bilangan_pegawai_teknikal', 'bilangan_pembantu', 'created_by', 'updated_by'], 'integer'],
            [['tempat'], 'string', 'max' => 90],
            [['tujuan_kursus_kejohanan'], 'string', 'max' => 80],
            [['laporan_bergambar', 'penyata_perbelanjaan_resit_yang_telah_disahkan', 'jadual_keputusan_pertandingan', 'senarai_peserta', 'statistik_penyertaan', 'senarai_pegawai_penceramah', 'senarai_urusetia_sukarelawan'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'bantuan_penganjuran_kursus_pegawai_teknikal_laporan_id' => 'Bantuan Penganjuran Kursus Pegawai Teknikal Laporan ID',
            'tarikh' => 'Tarikh',
            'tempat' => 'Tempat',
            'tujuan_kursus_kejohanan' => 'Tujuan Kursus / Kejohanan',
            'bilangan_pasukan' => 'Bilangan Pasukan',
            'bilangan_peserta' => 'Bilangan Peserta',
            'bilangan_pegawai_teknikal' => 'Bilangan Pegawai Teknikal',
            'bilangan_pembantu' => 'Bilangan Pembantu',
            'laporan_bergambar' => 'Laporan Bergambar',
            'penyata_perbelanjaan_resit_yang_telah_disahkan' => 'Penyata Perbelanjaan / Resit Yang Telah Disahkan',
            'jadual_keputusan_pertandingan' => 'Jadual & Keputusan Pertandingan',
            'senarai_peserta' => 'Senarai Peserta',
            'statistik_penyertaan' => 'Statistik Penyertaan',
            'senarai_pegawai_penceramah' => 'Senarai Pegawai Penceramah',
            'senarai_urusetia_sukarelawan' => 'Senarai Urusetia / Sukarelawan',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created' => 'Created',
            'updated' => 'Updated',
        ];
    }
}
