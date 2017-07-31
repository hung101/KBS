<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;
use app\models\general\Upload;
use app\models\general\GeneralMessage;

use app\models\general\GeneralLabel;

/**
 * This is the model class for table "tbl_pengurusan_penyambungan_dan_penamatan_kontrak_jurulatih".
 *
 * @property integer $pengurusan_penyambungan_dan_penamatan_kontrak_jurulatih_id
 * @property string $jurulatih
 * @property string $muatnaik_gambar
 * @property string $cawangan
 * @property string $sub_cawangan
 * @property string $program_msn
 * @property string $lain_lain_program
 * @property string $pusat_latihan
 * @property string $nama_sukan
 * @property string $nama_acara
 * @property string $status_jurulatih
 * @property string $status_permohonan
 * @property string $status_keaktifan_jurulatih
 * @property string $muat_naik_document
 */
class PengurusanPenyambunganDanPenamatanKontrakJurulatih extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_pengurusan_penyambungan_dan_penamatan_kontrak_jurulatih';
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
            [['jurulatih', 'tarikh_mula', 'status_permohonan', 'tarikh_tamat'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['jurulatih', 'status_tawaran_jkb', 'status_tawaran_mpj', 'status_jurulatih', 'sukan', 'cadangan_status_jurulatih', 'bahagian'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['jumlah_gaji_elaun', 'cadangan_jumlah_gaji_elaun'], 'number', 'message' => GeneralMessage::yii_validation_number],
            [['tarikh_mula_lantikan', 'tarikh_tamat_lantikan', 'penamatan_tarikh_berkuatkuasa', 'tarikh_jkb', 'tarikh_mpj'], 'safe'],
            //[[ 'muat_naik_document'], 'string', 'max' => 100],
            [['status_permohonan', 'jenis_permohonan', 'program_baru', 'cadangan_gaji_elaun', 'bil_jkb', 'bil_mpj'], 'string', 'max' => 30, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['gaji_elaun', 'program'], 'string', 'max' => 80, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['sebab', 'muat_naik_cadangan', 'kelulusan_dkp', 'catatan_jkb', 'pengerusi', 'catatan_mpj'], 'string', 'max' => 255, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['muat_naik_document'],'validateFileUpload', 'skipOnEmpty' => false]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pengurusan_penyambungan_dan_penamatan_kontrak_jurulatih_id' => GeneralLabel::pengurusan_penyambungan_dan_penamatan_kontrak_jurulatih_id,
            'jurulatih' => GeneralLabel::jurulatih,
            'tarikh_mula' => GeneralLabel::tarikh_mula,
            'tarikh_tamat' => GeneralLabel::tarikh_tamat,
            'status_permohonan' => GeneralLabel::status_permohonan,
            'muat_naik_document' => GeneralLabel::muat_naik_document,
            'gaji_elaun' => GeneralLabel::gaji_elaun,
            'program' => GeneralLabel::program,
            'cadangan_jumlah_gaji_elaun' => GeneralLabel::jumlah,
            'jumlah_gaji_elaun' => GeneralLabel::jumlah,
            'cadangan_gaji_elaun' => GeneralLabel::gaji_elaun,
            'jenis_permohonan' => GeneralLabel::jenis_permohonan,
            'sebab' => 'Sebab',
            'bil_jkb' => GeneralLabel::bilangan_jkb,
            'tarikh_jkb' => GeneralLabel::tarikh_jkb,
            'muat_naik_cadangan' => GeneralLabel::upload,
            'kelulusan_dkp' => GeneralLabel::kelulusan_dkp,
            'catatan_jkb' => GeneralLabel::catatan,
            'status_tawaran_jkb' => GeneralLabel::status_tawaran_jkb,
            'bil_mpj' => GeneralLabel::bilangan_mpj,
            'tarikh_mpj' => GeneralLabel::tarikh_mpj,
            'pengerusi' => GeneralLabel::pengerusi,
            'catatan_mpj' => GeneralLabel::catatan,
            'status_tawaran_mpj' => GeneralLabel::status_tawaran_mpj,
            'status_jurulatih' => GeneralLabel::status_jurulatih,
            'sukan' => GeneralLabel::sukan,
            'cadangan_status_jurulatih' => GeneralLabel::status_jurulatih,
            'bahagian' => GeneralLabel::bahagian,
        ];
    }
    
    /**
     * Validate upload file cannot be empty
     */
    public function validateFileUpload($attribute, $params){
        $file = UploadedFile::getInstance($this, $attribute);
        
        if($file && $file->getHasError()){
            $this->addError($attribute, 'File error :' . Upload::getUploadErrorDesc($file->error));
        }
    }
    
    public function getRefJurulatih()
    {
        return $this->hasOne(Jurulatih::className(), ['jurulatih_id' => 'jurulatih']);
    }
    
    public function getRefStatusPermohonanKontrakJurulatih()
    {
        return $this->hasOne(RefStatusPermohonanKontrakJurulatih::className(), ['id' => 'status_permohonan']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefJurulatihSukan(){
        return $this->hasMany(JurulatihSukan::className(), ['jurulatih_id' => 'jurulatih']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefStatusJkb(){
        return $this->hasOne(RefStatusTawaran::className(), ['id' => 'status_tawaran_jkb'])->from(['st1' => RefStatusTawaran::tableName()]);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefStatusMpj(){
        return $this->hasOne(RefStatusTawaran::className(), ['id' => 'status_tawaran_mpj'])->from(['st2' => RefStatusTawaran::tableName()]);
    }
}
