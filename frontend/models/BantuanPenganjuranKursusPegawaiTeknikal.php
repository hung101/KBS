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
            [['badan_sukan', 'sukan', 'jumlah_bantuan_yang_dipohon'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['tarikh', 'tarikh_permohonan', 'tarikh_jkb', 'created', 'updated', 'tarikh_tamat', 'selesai'], 'safe'],
            [['yuran_penyertaan', 'jumlah_bantuan_yang_dipohon', 'jumlah_dilulus', 'anggaran_perbelanjaan'], 'number', 'message' => GeneralMessage::yii_validation_number],
            [['created_by', 'updated_by', 'no_akaun', 'status_permohonan'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['badan_sukan', 'nama_bank', 'jkb'], 'string', 'max' => 80, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['sukan', 'no_pendaftaran', 'alamat_1', 'alamat_2', 'alamat_3', 'no_akaun'], 'string', 'max' => 30, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['alamat_negeri'], 'string', 'max' => 3, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['alamat_bandar', 'alamat_poskod'], 'string', 'max' => 5, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['alamat_poskod'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['no_telefon', 'no_faks'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['no_telefon', 'no_faks'], 'string', 'max' => 14, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['laman_sesawang', 'facebook', 'twitter'], 'string', 'max' => 100, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['tempat', 'nama_kursus_seminar_bengkel', 'tujuan'], 'string', 'max' => 255, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['surat_rasmi_badan_sukan', 'surat_jemputan_daripada_pengelola', 'butiran_perbelanjaan', 'salinan_passport', 'maklumat_lain_sokongan', 'surat_kelulusan', 'catatan'], 'string', 'max' => 255, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['surat_rasmi_badan_sukan', 'surat_jemputan_daripada_pengelola', 'butiran_perbelanjaan', 'salinan_passport', 'maklumat_lain_sokongan', 'surat_kelulusan'],'validateFileUpload', 'skipOnEmpty' => false],
            ['tarikh','validateBeforePenganjuran', 'on' => 'create'],
            [['badan_sukan', 'nama_bank', 'jkb','sukan', 'no_pendaftaran', 'alamat_1', 'alamat_2', 'alamat_3', 'no_akaun','alamat_negeri',
                'alamat_bandar', 'alamat_poskod','laman_sesawang', 'facebook', 'twitter','tempat', 'nama_kursus_seminar_bengkel', 'tujuan','catatan'], function ($attribute, $params) {
                if (!\common\models\general\GeneralFunction::validateXSS($this->$attribute)) {
                    $this->addError($attribute, GeneralMessage::yii_validation_xss);
                }
            }],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'bantuan_penganjuran_kursus_pegawai_teknikal_id' => 'Bantuan Penganjuran Kursus Pegawai Teknikal ID',
            'badan_sukan' => GeneralLabel::badan_sukan,  //'Badan Sukan',
            'sukan' => GeneralLabel::sukan,  //'Sukan',
            'no_pendaftaran' => GeneralLabel::no_pendaftaran,  //'No. Pendaftaran',
            'alamat_1' => GeneralLabel::alamat_1,  //'Alamat',
            'alamat_2' => '',
            'alamat_3' => '',
            'alamat_negeri' => GeneralLabel::alamat_negeri,  //'Negeri',
            'alamat_bandar' => GeneralLabel::alamat_bandar,  //'Bandar',
            'alamat_poskod' => GeneralLabel::alamat_poskod,  //'Poskod',
            'no_telefon' => GeneralLabel::no_telefon,  //'No. Telefon',
            'no_faks' => GeneralLabel::no_faks,  //'No. Faks',
            'laman_sesawang' => GeneralLabel::laman_web,  //'Laman Sesawang',
            'facebook' => GeneralLabel::facebook,  //'Facebook',
            'twitter' => GeneralLabel::twitter,  //'Twitter',
            'nama_bank' => GeneralLabel::nama_bank,  //'Nama Bank',
            'no_akaun' => GeneralLabel::no_akaun,  //'No. Akaun',
            'nama_kursus_seminar_bengkel' => GeneralLabel::nama_kursus_seminar_bengkel,  //'Nama Kursus / Seminar / Bengkel',
            'tarikh' => GeneralLabel::tarikh,  //'Tarikh Mula',
            'tempat' => GeneralLabel::tempat,  //'Tempat',
            'tujuan' => GeneralLabel::tujuan,  //'Tujuan',
            'yuran_penyertaan' => GeneralLabel::yuran_penyertaan,  //'Yuran Penyertaan (RM)',
            'surat_rasmi_badan_sukan' => GeneralLabel::surat_rasmi_badan_sukan,  //'Surat Rasmi Badan Sukan',
            'surat_jemputan_daripada_pengelola' => GeneralLabel::surat_jemputan_daripada_pengelola,  //'Surat Jemputan Daripada Pengelola',
            'butiran_perbelanjaan' => GeneralLabel::butiran_perbelanjaan,  //'Butiran Perbelanjaan',
            'salinan_passport' => GeneralLabel::salinan_passport,  //'Salinan Passport',
            'maklumat_lain_sokongan' => GeneralLabel::maklumat_lain_sokongan,  //'Maklumat Lain (Sokongan)',
            'jumlah_bantuan_yang_dipohon' => GeneralLabel::jumlah_bantuan_yang_dipohon,  //'Jumlah (RM)',
            'status_permohonan' => GeneralLabel::status_permohonan,  //'Status Permohonan',
            'catatan' => GeneralLabel::catatan,  //'Catatan',
            'tarikh_permohonan' => GeneralLabel::tarikh_permohonan,  //'Tarikh Permohonan',
            'jumlah_dilulus' => GeneralLabel::jumlah_diluluskan,  //'Jumlah Dilulus',
            'jkb' => GeneralLabel::bil_jkb,  //'JKB',
            'tarikh_jkb' => 'Tarikh JKB',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created' => 'Created',
            'updated' => 'Updated',
            'tarikh_tamat'=> GeneralLabel::tarikh_tamat,  //'Tarikh Tamat',
            'surat_kelulusan' => GeneralLabel::surat_kelulusan,
            'anggaran_perbelanjaan' => GeneralLabel::anggaran_perbelanjaan,   //'Anggaran Perbelanjaan (RM)',
            'selesai' => GeneralLabel::selesai, 
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
        
        if($file){
            if(!GeneralFunction::checkFileExtension($file->getExtension())){
                $this->addError($attribute, GeneralMessage::uploadFileTypeError);
            }
        }
    }
    
    public function validateBeforePenganjuran(){
        $dateMinus = new \DateTime($this->tarikh);
        //$dateMinus->modify('-3 month'); // 3 months before tarikh kejohanan berlangsung
        $dateMinus->modify('-45 days'); // 45 days before tarikh kejohanan berlangsung

        if($dateMinus->format('Y-m-d') <= GeneralFunction::getCurrentDate()){
            $this->addError('tarikh','Permohonan tidak boleh lewat 45 hari dari tarikh kejohanan berlangsung');
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
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefKelulusan(){
        return $this->hasOne(RefKelulusan::className(), ['id' => 'selesai']);
    }
}
