<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_pengurusan_program_binaan_laporan_penganjuran".
 *
 * @property integer $pengurusan_program_binaan_laporan_penganjuran_id
 * @property integer $pengurusan_program_binaan_id
 * @property string $negeri
 * @property string $sukan
 * @property integer $jenis_laporan

 */
class PengurusanProgramBinaanLaporanPenganjuran extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_pengurusan_program_binaan_laporan_penganjuran';
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
            [['pengurusan_program_binaan_id', 'aktiviti', 'tempat', 'tarikh_mula', 'tarikh_tamat'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['tarikh_mula', 'tarikh_tamat', 'negeri', 'sukan', 'jenis_laporan', 'tahap', 'jenis_aktiviti'], 'safe'],
            [['pengurusan_program_binaan_id', 'atlet_lelaki', 'atlet_perempuan', 'jurulatih_lelaki', 'jurulatih_perempuan', 'pegawai_lelaki', 'pegawai_perempuan', 'teknikal_lelaki', 'teknikal_perempuan', 'urusetia_lelaki', 'urusetia_perempuan'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['peruntukan_dipohon_msn', 'peruntukan_dipohon_psn', 'peruntukan_dilulus_msn', 'peruntukan_dilulus_psn', 'jumlah_diterima_msn', 'jumlah_diterima_psn', 'jumlah_perbelanjaan', 'perbelanjaan_sebenar', 'baki_dituntut'], 'number', 'message' => GeneralMessage::yii_validation_number],
            [['aktiviti', 'tempat'], 'string', 'max' => 255, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['aktiviti', 'tempat','negeri', 'sukan', 'jenis_laporan', 'tahap', 'jenis_aktiviti'], 'filter', 'filter' => function ($value) {
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
            'pengurusan_program_binaan_id' => GeneralLabel::pengurusan_program_binaan_id,
            'negeri' => GeneralLabel::negeri,
            'sukan' => GeneralLabel::sukan,
            'jenis_laporan' => GeneralLabel::jenis_laporan,
            'aktiviti' => GeneralLabel::aktiviti,
            'tahap' => GeneralLabel::tahap,
            'jenis_aktiviti' => GeneralLabel::jenis_aktiviti,
            'tempat' => GeneralLabel::tempat,
            'tarikh_mula' => GeneralLabel::tarikh_mula,
            'tarikh_tamat' => GeneralLabel::tarikh_tamat,
            'tempat' => GeneralLabel::tempat,
            'tahap' => GeneralLabel::tahap,
            'atlet_lelaki' => '',
            'atlet_perempuan' => '',
            'jurulatih_lelaki' => '',
            'jurulatih_perempuan' => '',
            'pegawai_lelaki' => '',
            'pegawai_perempuan' => '',
            'teknikal_lelaki' => '',
            'teknikal_perempuan' => '',
            'urusetia_lelaki' => '',
            'urusetia_perempuan' => '',
            'peruntukan_dipohon_msn' => GeneralLabel::peruntukan_dipohon,
            'peruntukan_dipohon_psn' => GeneralLabel::peruntukan_dipohon,
            'peruntukan_dilulus_msn' => GeneralLabel::peruntukan_dilulus,
            'peruntukan_dilulus_psn' => GeneralLabel::peruntukan_dilulus,
            'jumlah_diterima_msn' => GeneralLabel::jumlah_diterima,
            'jumlah_diterima_psn' => GeneralLabel::jumlah_diterima,
            'jumlah_perbelanjaan' => GeneralLabel::jumlah_perbelanjaan_without_rm,
            'perbelanjaan_sebenar' => GeneralLabel::perbelanjaan_sebenar,
            'baki_dituntut' => GeneralLabel::baki_dituntut,
        ];
    }
}
