<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

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
            [['permohonan_pendahuluan_pelagai', 'menghantar_surat_cuti_tanpa', 'keperluan_bengkel_telah', 'membuat_tempahan_penginapan', 'membuat_tempahan_tempat_untuk', 'mengesahan_kehadiran_panel', 'mengesahan_pendaftaran_panel', 'memberi_taklimat', 'mengumpul_dan_membukukan', 'membuat_pelarasan_kewangan'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['permohonan_pendahuluan_pelagai', 'menghantar_surat_cuti_tanpa', 'keperluan_bengkel_telah', 'membuat_tempahan_penginapan', 'membuat_tempahan_tempat_untuk', 'mengesahan_kehadiran_panel', 'mengesahan_pendaftaran_panel', 'memberi_taklimat', 'mengumpul_dan_membukukan', 'membuat_pelarasan_kewangan'], 'integer', 'message' => GeneralMessage::yii_validation_integer]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'penganjuran_pemantuan_id' => GeneralLabel::penganjuran_pemantuan_id,
            'permohonan_pendahuluan_pelagai' => GeneralLabel::permohonan_pendahuluan_pelagai,
            'menghantar_surat_cuti_tanpa' => GeneralLabel::menghantar_surat_cuti_tanpa,
            'keperluan_bengkel_telah' => GeneralLabel::keperluan_bengkel_telah,
            'membuat_tempahan_penginapan' => GeneralLabel::membuat_tempahan_penginapan,
            'membuat_tempahan_tempat_untuk' => GeneralLabel::membuat_tempahan_tempat_untuk,
            'mengesahan_kehadiran_panel' => GeneralLabel::mengesahan_kehadiran_panel,
            'mengesahan_pendaftaran_panel' => GeneralLabel::mengesahan_pendaftaran_panel,
            'memberi_taklimat' => GeneralLabel::memberi_taklimat,
            'mengumpul_dan_membukukan' => GeneralLabel::mengumpul_dan_membukukan,
            'membuat_pelarasan_kewangan' => GeneralLabel::membuat_pelarasan_kewangan,
        ];
    }
}
