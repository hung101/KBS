<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_laporan_pendedahan_latihan".
 *
 * @property integer $laporan_pendedahan_latihan_id
 * @property integer $penyertaan_sukan_id
 * @property integer $sukan
 * @property integer $kategori_kejohanan
 * @property integer $aktiviti
 * @property string $tarikh_mula
 * @property string $tarikh_tamat
 * @property string $tempat
 * @property string $tarikh_bertolak
 * @property string $tarikh_balik
 * @property string $objektif
 * @property string $penginapan
 * @property string $makan
 * @property string $pengangkutan
 * @property string $venue_latihan
 * @property string $jadual_latihan
 * @property string $latihan_aktiviti
 * @property string $hal_lain
 * @property string $laporan_kewangan
 * @property string $rumusan
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created
 * @property string $updated
 */
class LaporanPendedahanLatihan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_laporan_pendedahan_latihan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['penyertaan_sukan_id'], 'required'],
            [['penyertaan_sukan_id', 'sukan', 'kategori_kejohanan', 'aktiviti', 'created_by', 'updated_by'], 'integer'],
            [['tarikh_mula', 'tarikh_tamat', 'tarikh_bertolak', 'tarikh_balik', 'created', 'updated'], 'safe'],
            [['objektif', 'penginapan', 'makan', 'pengangkutan', 'venue_latihan', 'latihan_aktiviti', 'hal_lain', 'rumusan'], 'string'],
            [['tempat', 'jadual_latihan', 'laporan_kewangan'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'laporan_pendedahan_latihan_id' => 'Laporan Pendedahan Latihan ID',
            'penyertaan_sukan_id' => 'Penyertaan Sukan ID',
            'sukan' => 'Sukan',
            'kategori_kejohanan' => 'Kategori Kejohanan',
            'aktiviti' => 'Aktiviti',
            'tarikh_mula' => 'Tarikh Mula',
            'tarikh_tamat' => 'Tarikh Tamat',
            'tempat' => 'Tempat',
            'tarikh_bertolak' => 'Tarikh Bertolak',
            'tarikh_balik' => 'Tarikh Balik',
            'objektif' => 'Objektif',
            'penginapan' => 'Penginapan',
            'makan' => 'Makan',
            'pengangkutan' => 'Pengangkutan',
            'venue_latihan' => 'Venue Latihan',
            'jadual_latihan' => 'Jadual Latihan',
            'latihan_aktiviti' => 'Latihan Aktiviti',
            'hal_lain' => 'Hal Lain',
            'laporan_kewangan' => 'Laporan Kewangan',
            'rumusan' => 'Rumusan',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created' => 'Created',
            'updated' => 'Updated',
        ];
    }
}
