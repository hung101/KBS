<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_bantuan_penganjuran_kejohanan_laporan_tuntutan".
 *
 * @property integer $bantuan_penganjuran_kejohanan_laporan_tuntutan_id
 * @property integer $bantuan_penganjuran_kejohanan_laporan_id
 * @property string $kejohanan
 * @property string $tarikh_mula
 * @property string $tarikh_tamat
 * @property string $tempat
 * @property string $jumlah_kelulusan
 * @property string $pendahuluan_80
 * @property string $no_cek
 * @property string $no_boucer
 * @property string $jumlah_yang_dituntut_20
 * @property string $session_id
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created
 * @property string $updated
 */
class BantuanPenganjuranKejohananLaporanTuntutan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_bantuan_penganjuran_kejohanan_laporan_tuntutan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bantuan_penganjuran_kejohanan_laporan_id', 'created_by', 'updated_by'], 'integer'],
            [['kejohanan', 'tarikh_mula', 'tarikh_tamat', 'tempat', 'jumlah_kelulusan', 'pendahuluan_80', 'jumlah_yang_dituntut_20'], 'required'],
            [['tarikh_mula', 'tarikh_tamat', 'created', 'updated'], 'safe'],
            [['jumlah_kelulusan', 'pendahuluan_80', 'jumlah_yang_dituntut_20'], 'number'],
            [['kejohanan'], 'string', 'max' => 80],
            [['tempat'], 'string', 'max' => 90],
            [['no_cek', 'no_boucer'], 'string', 'max' => 50],
            [['session_id'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'bantuan_penganjuran_kejohanan_laporan_tuntutan_id' => 'Bantuan Penganjuran Kejohanan Laporan Tuntutan ID',
            'bantuan_penganjuran_kejohanan_laporan_id' => 'Bantuan Penganjuran Kejohanan Laporan ID',
            'kejohanan' => 'Kejohanan',
            'tarikh_mula' => 'Tarikh Mula',
            'tarikh_tamat' => 'Tarikh Tamat',
            'tempat' => 'Tempat',
            'jumlah_kelulusan' => 'Jumlah Kelulusan (RM)',
            'pendahuluan_80' => 'Pendahuluan (80%) (RM)',
            'no_cek' => 'No. Cek',
            'no_boucer' => 'No. Boucer',
            'jumlah_yang_dituntut_20' => 'Jumlah Yang Dituntut (20%) (RM)',
            'session_id' => 'Session ID',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created' => 'Created',
            'updated' => 'Updated',
        ];
    }
}