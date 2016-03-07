<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_penganjuran_pemantuan".
 *
 * @property integer $penganjuran_pemantuan_id
 * @property integer $permohonan_pendahuluan_pelagai
 * @property integer $menghantar_surat_cuti_tanpa
 * @property integer $keperluan_bengkel_telah
 * @property integer $membuat_tempahan_penginapan
 * @property integer $membuat_tempahan_tempat_untuk
 * @property integer $mengesahan_kehadiran_panel
 * @property integer $mengesahan_pendaftaran_panel
 * @property integer $memberi_taklimat
 * @property integer $mengumpul_dan_membukukan
 * @property integer $membuat_pelarasan_kewangan
 */
class PenganjuranPemantuan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_penganjuran_pemantuan';
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
            [['permohonan_pendahuluan_pelagai', 'menghantar_surat_cuti_tanpa', 'keperluan_bengkel_telah', 'membuat_tempahan_penginapan', 'membuat_tempahan_tempat_untuk', 'mengesahan_kehadiran_panel', 'mengesahan_pendaftaran_panel', 'memberi_taklimat', 'mengumpul_dan_membukukan', 'membuat_pelarasan_kewangan'], 'required', 'skipOnEmpty' => true],
            [['permohonan_pendahuluan_pelagai', 'menghantar_surat_cuti_tanpa', 'keperluan_bengkel_telah', 'membuat_tempahan_penginapan', 'membuat_tempahan_tempat_untuk', 'mengesahan_kehadiran_panel', 'mengesahan_pendaftaran_panel', 'memberi_taklimat', 'mengumpul_dan_membukukan', 'membuat_pelarasan_kewangan'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'penganjuran_pemantuan_id' => 'Penganjuran Pemantuan ID',
            'permohonan_pendahuluan_pelagai' => 'Permohonan pendahuluan pelbagai untuk tuntutan perjalanan instruktur',
            'menghantar_surat_cuti_tanpa' => 'Menghantar surat cuti tanpa rekod kepada majikan instruktur selewat-lewatnya 1 bulan sebelum tarikh pembengkelan',
            'keperluan_bengkel_telah' => 'Keperluan bengkel telah disediakan, iaitu, alat bantu mengajar, alat tulis, manual teknikal dan kepegawaian',
            'membuat_tempahan_penginapan' => 'Membuat tempahan penginapan termasuk makan/minum untuk instruktur',
            'membuat_tempahan_tempat_untuk' => 'Membuat tempahan tempat untuk pembengkelan',
            'mengesahan_kehadiran_panel' => 'Mengesahkan kehadiran panel instruktur sebelum tarikh pembengkelan',
            'mengesahan_pendaftaran_panel' => 'Mengesahkan pendaftaran panel instruktur',
            'memberi_taklimat' => 'Memberi taklimat dan garis panduan penyediaan sukatan/manual',
            'mengumpul_dan_membukukan' => 'Mengumpul dan membukukan nota semasa bengkel',
            'membuat_pelarasan_kewangan' => 'Membuat Pelarasan Kewangan',
        ];
    }
}
