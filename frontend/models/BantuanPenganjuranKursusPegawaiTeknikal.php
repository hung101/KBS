<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;
use app\models\general\Upload;
use app\models\general\GeneralMessage;
use app\models\general\GeneralLabel;
use common\models\general\GeneralFunction;

/**
 * This is the model class for table "tbl_bantuan_penganjuran_kursus_pegawai_teknikal".
 *
 * @property integer $bantuan_penganjuran_kursus_pegawai_teknikal_id
 * @property string $badan_sukan
 * @property string $sukan
 * @property string $no_pendaftaran
 * @property string $alamat_1
 * @property string $alamat_2
 * @property string $alamat_3
 * @property string $alamat_negeri
 * @property string $alamat_bandar
 * @property string $alamat_poskod
 * @property string $no_telefon
 * @property string $no_faks
 * @property string $laman_sesawang
 * @property string $facebook
 * @property string $twitter
 * @property string $nama_bank
 * @property string $no_akaun
 * @property string $nama_kursus_seminar_bengkel
 * @property string $tarikh
 * @property string $tempat
 * @property string $tujuan
 * @property string $yuran_penyertaan
 * @property string $surat_rasmi_badan_sukan
 * @property string $surat_jemputan_daripada_pengelola
 * @property string $butiran_perbelanjaan
 * @property string $salinan_passport
 * @property string $maklumat_lain_sokongan
 * @property string $jumlah_bantuan_yang_dipohon
 * @property string $status_permohonan
 * @property string $catatan
 * @property string $tarikh_permohonan
 * @property string $jumlah_dilulus
 * @property string $jkb
 * @property string $tarikh_jkb
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created
 * @property string $updated
 */
class BantuanPenganjuranKursusPegawaiTeknikal extends \yii\db\ActiveRecord
{
    public $status_permohonan_id;
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_bantuan_penganjuran_kursus_pegawai_teknikal';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['badan_sukan', 'sukan', 'jumlah_bantuan_yang_dipohon'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['tarikh', 'tarikh_permohonan', 'tarikh_jkb', 'created', 'updated', 'tarikh_tamat'], 'safe'],
            [['yuran_penyertaan', 'jumlah_bantuan_yang_dipohon', 'jumlah_dilulus'], 'number', 'message' => GeneralMessage::yii_validation_number],
            [['created_by', 'updated_by', 'no_akaun'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['badan_sukan', 'nama_bank', 'jkb'], 'string', 'max' => 80, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['sukan', 'no_pendaftaran', 'alamat_1', 'alamat_2', 'alamat_3', 'no_akaun', 'status_permohonan'], 'string', 'max' => 30, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['alamat_negeri'], 'string', 'max' => 3, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['alamat_bandar', 'alamat_poskod'], 'string', 'max' => 5, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['no_telefon', 'no_faks'], 'string', 'max' => 14, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['laman_sesawang', 'facebook', 'twitter'], 'string', 'max' => 100, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['tempat', 'nama_kursus_seminar_bengkel', 'tujuan'], 'string', 'max' => 255, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['surat_rasmi_badan_sukan', 'surat_jemputan_daripada_pengelola', 'butiran_perbelanjaan', 'salinan_passport', 'maklumat_lain_sokongan', 'catatan'], 'string', 'max' => 255, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['surat_rasmi_badan_sukan', 'surat_jemputan_daripada_pengelola', 'butiran_perbelanjaan', 'salinan_passport', 'maklumat_lain_sokongan'],'validateFileUpload', 'skipOnEmpty' => false],
            ['tarikh','validateBeforePenganjuran', 'on' => 'create'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'bantuan_penganjuran_kursus_pegawai_teknikal_id' => 'Bantuan Penganjuran Kursus Pegawai Teknikal ID',
            'badan_sukan' => 'Badan Sukan',
            'sukan' => 'Sukan',
            'no_pendaftaran' => 'No. Pendaftaran',
            'alamat_1' => 'Alamat',
            'alamat_2' => '',
            'alamat_3' => '',
            'alamat_negeri' => 'Negeri',
            'alamat_bandar' => 'Bandar',
            'alamat_poskod' => 'Poskod',
            'no_telefon' => 'No. Telefon',
            'no_faks' => 'No. Faks',
            'laman_sesawang' => 'Laman Sesawang',
            'facebook' => 'Facebook',
            'twitter' => 'Twitter',
            'nama_bank' => 'Nama Bank',
            'no_akaun' => 'No. Akaun',
            'nama_kursus_seminar_bengkel' => 'Nama Kursus / Seminar / Bengkel',
            'tarikh' => 'Tarikh Mula',
            'tempat' => 'Tempat',
            'tujuan' => 'Tujuan',
            'yuran_penyertaan' => 'Yuran Penyertaan (RM)',
            'surat_rasmi_badan_sukan' => 'Surat Rasmi Badan Sukan',
            'surat_jemputan_daripada_pengelola' => 'Surat Jemputan Daripada Pengelola',
            'butiran_perbelanjaan' => 'Butiran Perbelanjaan',
            'salinan_passport' => 'Salinan Passport',
            'maklumat_lain_sokongan' => 'Maklumat Lain (Sokongan)',
            'jumlah_bantuan_yang_dipohon' => 'Jumlah (RM)',
            'status_permohonan' => 'Status Permohonan',
            'catatan' => 'Catatan',
            'tarikh_permohonan' => 'Tarikh Permohonan',
            'jumlah_dilulus' => 'Jumlah Dilulus',
            'jkb' => 'JKB',
            'tarikh_jkb' => 'Tarikh JKB',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created' => 'Created',
            'updated' => 'Updated',
            'tarikh_tamat'=> 'Tarikh Tamat',
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
    
    public function validateBeforePenganjuran(){
        $dateMinus = new \DateTime($this->tarikh);
        $dateMinus->modify('-3 month'); // 3 months before tarikh kejohanan berlangsung

        if($dateMinus->format('Y-m-d') <= GeneralFunction::getCurrentDate()){
            $this->addError('tarikh','Permohonan tidak boleh lewat 3 bulan dari tarikh kejohanan berlangsung');
        }
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefProfilBadanSukan(){
        return $this->hasOne(ProfilBadanSukan::className(), ['profil_badan_sukan' => 'badan_sukan']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefStatusBantuanPenganjuranKursusPegawaiTeknikal(){
        return $this->hasOne(RefStatusBantuanPenganjuranKursusPegawaiTeknikal::className(), ['id' => 'status_permohonan']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefSukan(){
        return $this->hasOne(RefSukan::className(), ['id' => 'sukan']);
    }
}
