<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;
use app\models\general\Upload;
use app\models\general\GeneralMessage;
use app\models\general\GeneralLabel;
use common\models\general\GeneralFunction;

/**
 * This is the model class for table "tbl_bantuan_penganjuran_kejohanan".
 *
 * @property integer $bantuan_penganjuran_kejohanan_id
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
 * @property string $nama_kejohanan_pertandingan
 * @property string $peringkat
 * @property string $tarikh_mula
 * @property string $tarikh_tamat
 * @property string $tempat
 * @property string $tujuan
 * @property integer $bil_pasukan
 * @property integer $bil_peserta
 * @property integer $bil_pengadil_hakim
 * @property integer $bil_pegawai_teknikal
 * @property integer $bilangan_pembantu
 * @property string $anggaran_perbelanjaan
 * @property string $kertas_kerja
 * @property string $surat_rasmi_badan_sukan_ms_negeri
 * @property string $permohonan_rasmi_dari_ahli_gabungan
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
class BantuanPenganjuranKejohanan extends \yii\db\ActiveRecord
{
    public $status_permohonan_id;
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_bantuan_penganjuran_kejohanan';
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
            [['tarikh_mula', 'tarikh_tamat', 'tarikh_permohonan', 'tarikh_jkb', 'created', 'updated', 'selesai'], 'safe'],
            [['bil_pasukan', 'bil_peserta', 'bil_pengadil_hakim', 'bil_pegawai_teknikal', 'bilangan_pembantu', 'created_by', 'updated_by'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['anggaran_perbelanjaan', 'jumlah_bantuan_yang_dipohon', 'jumlah_dilulus'], 'number', 'message' => GeneralMessage::yii_validation_number],
            [['badan_sukan', 'nama_bank', 'jkb'], 'string', 'max' => 80, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['sukan', 'no_pendaftaran', 'alamat_1', 'alamat_2', 'alamat_3', 'no_akaun', 'peringkat'], 'string', 'max' => 30, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['alamat_negeri'], 'string', 'max' => 3, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['alamat_bandar', 'alamat_poskod'], 'string', 'max' => 5, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['alamat_poskod'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['no_telefon', 'no_faks', 'status_permohonan'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['no_telefon', 'no_faks'], 'string', 'max' => 14, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['laman_sesawang', 'facebook', 'twitter'], 'string', 'max' => 100, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['tempat', 'tujuan', 'nama_kejohanan_pertandingan'], 'string', 'max' => 255, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['kertas_kerja', 'surat_rasmi_badan_sukan_ms_negeri', 'permohonan_rasmi_dari_ahli_gabungan', 'maklumat_lain_sokongan', 'surat_kelulusan', 'catatan'], 'string', 'max' => 255, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['tarikh_tamat'], 'compare', 'compareAttribute'=>'tarikh_mula', 'operator'=>'>=', 'message' => GeneralMessage::yii_validation_compare],
            [['kertas_kerja', 'surat_rasmi_badan_sukan_ms_negeri'], 'validateFileUploadRequired', 'skipOnEmpty' => false],
            [['permohonan_rasmi_dari_ahli_gabungan', 'maklumat_lain_sokongan', 'surat_kelulusan'],'validateFileUpload', 'skipOnEmpty' => false],
            [['badan_sukan', 'nama_bank', 'jkb','sukan', 'no_pendaftaran', 'alamat_1', 'alamat_2', 'alamat_3', 'no_akaun', 'peringkat','alamat_negeri','alamat_bandar', 'alamat_poskod',
                'laman_sesawang', 'facebook', 'twitter','tempat', 'tujuan', 'nama_kejohanan_pertandingan','kertas_kerja', 'surat_rasmi_badan_sukan_ms_negeri', 
                'permohonan_rasmi_dari_ahli_gabungan', 'maklumat_lain_sokongan', 'surat_kelulusan', 'catatan'], 'filter', 'filter' => function ($value) {
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
            'bantuan_penganjuran_kejohanan_id' => 'Bantuan Penganjuran Kejohanan ID',
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
            'nama_kejohanan_pertandingan' => GeneralLabel::nama_kejohanan_pertandingan,  //'Nama Kejohanan / Pertandingan',
            'peringkat' => GeneralLabel::peringkat,  //'Peringkat',
            'tarikh_mula' => GeneralLabel::tarikh_mula,  //'Tarikh Mula',
            'tarikh_tamat' => GeneralLabel::tarikh_tamat,  //'Tarikh Tamat',
            'tempat' => GeneralLabel::tempat,  //'Tempat',
            'tujuan' => GeneralLabel::tujuan,  //'Tujuan',
            'bil_pasukan' => GeneralLabel::bilangan_pasukan,  //'Bilangan Pasukan',
            'bil_peserta' => GeneralLabel::bil_peserta,  //'Bilangan Peserta',
            'bil_pengadil_hakim' => GeneralLabel::bilangan_pengadil_hakim,  //'Bilangan Pengadil / Hakim',
            'bil_pegawai_teknikal' => GeneralLabel::bilangan_pegawai_teknikal,  //'Bilangan Pegawai Teknikal',
            'bilangan_pembantu' => GeneralLabel::bilangan_pembantu,  //'Bilangan Pembantu',
            'anggaran_perbelanjaan' => GeneralLabel::anggaran_perbelanjaan,  //'Anggaran Perbelanjaan (RM)',
            'kertas_kerja' => GeneralLabel::kertas_kerja,  //'Kertas Kerja',
            'surat_rasmi_badan_sukan_ms_negeri' => GeneralLabel::surat_rasmi_badan_sukan_ms_negeri,  //'Surat Rasmi Badan Sukan Ms Negeri',
            'permohonan_rasmi_dari_ahli_gabungan' => GeneralLabel::permohonan_rasmi_dari_ahli_gabungan,  //'Permohonan Rasmi Dari Ahli Gabungan',
            'maklumat_lain_sokongan' => GeneralLabel::maklumat_lain_sokongan,  //'Maklumat Lain (Sokongan)',
            'jumlah_bantuan_yang_dipohon' => GeneralLabel::jumlah_bantuan_yang_dipohon,  //'Jumlah (RM)',
            'status_permohonan' => GeneralLabel::status_permohonan,  //'Status Permohonan',
            'catatan' => GeneralLabel::catatan,  //'Catatan',
            'tarikh_permohonan' => GeneralLabel::tarikh_permohonan,  //'Tarikh Permohonan',
            'jumlah_dilulus' => GeneralLabel::jumlah_diluluskan,  //'Jumlah Kelulusan',
            'jkb' => GeneralLabel::bil_jkb,  //'Bil. JKB',
            'tarikh_jkb' => 'Tarikh JKB',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created' => 'Created',
            'updated' => 'Updated',
            'surat_kelulusan' => GeneralLabel::surat_kelulusan,
            'selesai' => GeneralLabel::selesai,
        ];
    }
    
    /**
     * Validate upload file cannot be empty
     */
    public function validateFileUploadRequired($attribute, $params){
        $file = UploadedFile::getInstance($this, $attribute);
        
        if($file && $file->getHasError()){
            $this->addError($attribute, 'File error :' . Upload::getUploadErrorDesc($file->error));
        }
        
        if($file){
            if(!GeneralFunction::checkFileExtension($file->getExtension())){
                $this->addError($attribute, GeneralMessage::uploadFileTypeError);
            }
        }

        if(!$file && $this->$attribute==""){
            $this->addError($attribute, GeneralMessage::uploadEmptyError);
        }
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
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefProfilBadanSukan(){
        return $this->hasOne(ProfilBadanSukan::className(), ['profil_badan_sukan' => 'badan_sukan']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefStatusBantuanPenganjuranKejohanan(){
        return $this->hasOne(RefStatusBantuanPenganjuranKejohanan::className(), ['id' => 'status_permohonan']);
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
