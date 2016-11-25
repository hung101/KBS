<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;
use app\models\general\Upload;
use app\models\general\GeneralMessage;
use app\models\general\GeneralLabel;

/**
 * This is the model class for table "tbl_permohonan_penyelidikan".
 *
 * @property integer $permohonana_penyelidikan_id
 * @property string $nama_permohon
 * @property string $tarikh_permohonan
 * @property string $tajuk_penyelidikan
 * @property string $ringkasan_permohonan
 * @property integer $biasa_dengan_keperluan_penyelidikan
 * @property integer $kelulusan_echics
 * @property integer $kelulusan
 */
class PermohonanPenyelidikan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_permohonan_penyelidikan';
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
            [['nama_permohon', 'tarikh_permohonan', 'tajuk_penyelidikan', 'ringkasan_permohonan', 'biasa_dengan_keperluan_penyelidikan', 'kelulusan_echics', 'kelulusan', 'jenis_projek'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['tarikh_permohonan', 'tarikh_direkodkan', 'akademik_tarikh_pelantikan_pertama', 'akademik_kontrak_tarikh_tamat', 'tarikh_pengisytiharan'], 'safe'],
            [['biasa_dengan_keperluan_penyelidikan', 'kelulusan_echics', 'kelulusan', 'jenis_projek', 'akademik_jenis_perkhidmatan', 'akademik_kursus', 'pengisytiharan', 'akademik_no_tel_bimbit'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['nama_permohon', 'akademik_nama', 'akademik_nama_yang_dicadangkan'], 'string', 'max' => 80, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['ringkasan_permohonan', 'pengecualian_persetujuan', 'sebab_tiada_penyertaan_lembaran_maklumat', 'sebab_tiada_borang_persetujuan_penyertaan', 'tajuk_penyelidikan'], 'string', 'max' => 255, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['isnrp_no', 'akademik_no_kakitangan'], 'string', 'max' => 30, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['akademik_ic_no'], 'string', 'max' => 12, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['akademik_no_tel_bimbit'], 'string', 'max' => 14, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['akademik_emel'], 'string', 'max' => 100, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['akademik_dokumen_sokongan', 'penyertaan_lembaran_maklumat', 'borang_persetujuan_penyertaan'],'validateFileUpload', 'skipOnEmpty' => false],
            [['semak_borang_permohonan_yang_lengkap', 'semak_carta_gantt', 'semak_carta_aliran', 'semak_senarai_rujukan_kajian_bibliografi', 'semak_cv_ringkas_pasukan_penyelidikan', 
                'semak_salinan_sebelum_kelulusan_etika', 'semak_salinan_cadangan_penyelidikan_sepenuhnya', 'semak_salinan_kunci_maklumat', 'semak_salinan_borang_kebenaran', 
                'semak_salinan_penepian_persetujuan', 'semak_salinan_surat_pemberitahuan_kepada_isn', 'semak_salinan_surat_tawaran_pengajian_daripada_institusi', 
                'semak_salinan_dokumen_dokumen_sokongan', 'semak_salinan_soal_selidik'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'permohonana_penyelidikan_id' => GeneralLabel::permohonana_penyelidikan_id,
            'nama_permohon' => GeneralLabel::nama_permohon,
            'tarikh_permohonan' => GeneralLabel::tarikh_permohonan,
            'tajuk_penyelidikan' => GeneralLabel::tajuk_penyelidikan,
            'ringkasan_permohonan' => GeneralLabel::ringkasan_permohonan,
            'biasa_dengan_keperluan_penyelidikan' => GeneralLabel::biasa_dengan_keperluan_penyelidikan,
            'kelulusan_echics' => GeneralLabel::kelulusan_echics,
            'kelulusan' => GeneralLabel::kelulusan,
            'jenis_projek' => GeneralLabel::jenis_projek,
            'isnrp_no' => GeneralLabel::isnrp_no,
            'tarikh_direkodkan' => GeneralLabel::tarikh_direkod,
            'akademik_nama' => GeneralLabel::nama,
            'akademik_ic_no' => GeneralLabel::no_ic,
            'akademik_no_kakitangan' => GeneralLabel::no_kakitangan,
            'akademik_tarikh_pelantikan_pertama' => GeneralLabel::tarikh_pelantikan_pertama_isn,
            'akademik_jenis_perkhidmatan' => GeneralLabel::jenis_perkhidmatan,
            'akademik_kontrak_tarikh_tamat' => GeneralLabel::kontrak_tarikh_tamat,
            'akademik_no_tel_bimbit' => GeneralLabel::no_tel_bimbit,
            'akademik_emel' => GeneralLabel::emel,
            'akademik_nama_yang_dicadangkan' => GeneralLabel::nama_yang_dicadangkan,
            'akademik_kursus' => GeneralLabel::kursus,
            'akademik_dokumen_sokongan' => GeneralLabel::dokumen_sokongan,
            'penyertaan_lembaran_maklumat' => GeneralLabel::penyertaan_lembaran_maklumat,
            'sebab_tiada_penyertaan_lembaran_maklumat' => GeneralLabel::sebab_tiada_penyertaan_lembaran_maklumat,
            'borang_persetujuan_penyertaan' => GeneralLabel::borang_persetujuan_penyertaan,
            'sebab_tiada_borang_persetujuan_penyertaan' => GeneralLabel::sebab_tiada_borang_persetujuan_penyertaan,
            'pengecualian_persetujuan' => GeneralLabel::pengecualian_persetujuan,
            'tarikh_pengisytiharan' => GeneralLabel::tarikh,
            'pengisytiharan' => GeneralLabel::perakuan_pemohon_penyelidikan_isn,
            'semak_borang_permohonan_yang_lengkap' => GeneralLabel::semak_borang_permohonan_yang_lengkap,
            'semak_carta_gantt' => GeneralLabel::semak_carta_gantt,
            'semak_carta_aliran' => GeneralLabel::semak_carta_aliran,
            'semak_senarai_rujukan_kajian_bibliografi' => GeneralLabel::semak_senarai_rujukan_kajian_bibliografi,
            'semak_cv_ringkas_pasukan_penyelidikan' => GeneralLabel::semak_cv_ringkas_pasukan_penyelidikan,
            'semak_salinan_sebelum_kelulusan_etika' => GeneralLabel::semak_salinan_sebelum_kelulusan_etika,
            'semak_salinan_cadangan_penyelidikan_sepenuhnya' => GeneralLabel::semak_salinan_cadangan_penyelidikan_sepenuhnya,
            'semak_salinan_kunci_maklumat' => GeneralLabel::semak_salinan_kunci_maklumat,
            'semak_salinan_borang_kebenaran' => GeneralLabel::semak_salinan_borang_kebenaran,
            'semak_salinan_pengecualian_persetujuan' => GeneralLabel::semak_salinan_pengecualian_persetujuan,
            'semak_salinan_surat_pemberitahuan_kepada_isn' => GeneralLabel::semak_salinan_surat_pemberitahuan_kepada_isn,
            'semak_salinan_surat_tawaran_pengajian_daripada_institusi' => GeneralLabel::semak_salinan_surat_tawaran_pengajian_daripada_institusi,
            'semak_salinan_dokumen_dokumen_sokongan' => GeneralLabel::semak_salinan_dokumen_dokumen_sokongan,
            'semak_salinan_penepian_persetujuan' => GeneralLabel::semak_salinan_penepian_persetujuan,
            'semak_salinan_soal_selidik' => GeneralLabel::semak_salinan_soal_selidik,
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
}
