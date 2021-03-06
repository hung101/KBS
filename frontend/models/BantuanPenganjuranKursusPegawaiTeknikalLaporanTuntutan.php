<?php

namespace app\models;

use Yii;
use app\models\general\GeneralMessage;
use app\models\general\GeneralLabel;

/**
 * This is the model class for table "tbl_bantuan_penganjuran_kursus_pegawai_teknikal_laporan_tuntutan".
 *
 * @property integer $bantuan_penganjuran_kursus_pegawai_teknikal_laporan_tuntutan_id
 * @property integer $bantuan_penganjuran_kursus_pegawai_teknikal_laporan_id
 * @property string $kejohanan_kursus_seminar_bengkel
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
class BantuanPenganjuranKursusPegawaiTeknikalLaporanTuntutan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_bantuan_penganjuran_kursus_pegawai_teknikal_laporan_tuntutan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bantuan_penganjuran_kursus_pegawai_teknikal_laporan_id', 'created_by', 'updated_by'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['kejohanan_kursus_seminar_bengkel', 'tarikh_mula', 'tarikh_tamat', 'tempat', 'jumlah_kelulusan', 'jumlah_yang_dituntut_20'], 'required', 'message' => GeneralMessage::yii_validation_required],
            [['tarikh_mula', 'tarikh_tamat', 'created', 'updated'], 'safe'],
            [['jumlah_kelulusan', 'pendahuluan_80', 'jumlah_yang_dituntut_20'], 'number', 'message' => GeneralMessage::yii_validation_number],
            [['kejohanan_kursus_seminar_bengkel'], 'string', 'max' => 80, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['tempat'], 'string', 'max' => 90, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['no_cek', 'no_boucer'], 'string', 'max' => 50, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['session_id'], 'string', 'max' => 100, 'tooLong' => GeneralMessage::yii_validation_string_max],
            ['jumlah_yang_dituntut_20','validateJumlahDituntut'],
            [['kejohanan_kursus_seminar_bengkel','tempat','no_cek', 'no_boucer'], 'filter', 'filter' => function ($value) {
                return  \common\models\general\GeneralFunction::filterXSS($value);
            }],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'bantuan_penganjuran_kursus_pegawai_teknikal_laporan_tuntutan_id' => 'Bantuan Penganjuran Kursus Pegawai Teknikal Laporan Tuntutan ID',
            'bantuan_penganjuran_kursus_pegawai_teknikal_laporan_id' => 'Bantuan Penganjuran Kursus Pegawai Teknikal Laporan ID',
            'kejohanan_kursus_seminar_bengkel' => 'Kejohanan ATAU Kursus / Seminar / Bengkel',
            'tarikh_mula' => 'Tarikh Mula',
            'tarikh_tamat' => 'Tarikh Tamat',
            'tempat' => 'Tempat',
            'jumlah_kelulusan' => 'Jumlah Kelulusan (RM)',
            'pendahuluan_80' => 'Pendahuluan (RM)',
            'no_cek' => 'No. Cek',
            'no_boucer' => 'No. Boucer',
            'jumlah_yang_dituntut_20' => 'Jumlah Yang Dituntut (RM)',
            'session_id' => 'Session ID',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created' => 'Created',
            'updated' => 'Updated',
        ];
    }
    
    public function validateJumlahDituntut(){
        $hakJumlahDituntut = 0;
        
        if($this->jumlah_kelulusan > 0){
            $hakJumlahDituntut = $this->jumlah_kelulusan * 0.2;
        }

        if($this->jumlah_yang_dituntut_20 > $hakJumlahDituntut){
            $this->addError('jumlah_yang_dituntut_20','Jumlah Yang Dituntut tidak boleh melebihi RM' . $hakJumlahDituntut);
        }
    }
}
