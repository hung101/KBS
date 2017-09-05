<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;
use app\models\general\Upload;
use app\models\general\GeneralMessage;
use common\models\general\GeneralFunction;
use app\models\general\GeneralLabel;

/**
 * This is the model class for table "tbl_permohonan_e_biasiswa".
 *
 * @property integer $permohonan_e_biasiswa_id
 * @property string $muat_naik_gambar
 * @property string $nama
 * @property string $no_kad_pengenalan
 * @property string $jantina
 * @property string $keturunan
 * @property string $agama
 * @property string $taraf_perkahwinan
 * @property string $kawasan_temuduga_anda
 * @property string $alamat_1
 * @property string $alamat_2
 * @property string $alamat_3
 * @property string $alamat_negeri
 * @property string $alamat_bandar
 * @property string $alamat_poskod
 * @property string $no_tel_bimbit
 * @property string $no_pendaftaran_oku
 * @property string $kategori_oku
 * @property string $oku_lain_lain
 * @property string $universiti_institusi
 * @property string $program_pengajian
 * @property string $kursus_bidang_pengajian
 * @property string $falkulti
 * @property string $kategori
 * @property string $tarikh_tamat
 * @property integer $semester_terkini
 * @property integer $baki_semester_yang_tinggal
 * @property string $no_matriks
 * @property string $mendapat_pembiayaan_pendidikan
 * @property string $sukan
 * @property integer $perakuan_pemohon
 * @property integer $kelulusan
 * @property string $status_permohonan
 */
class PermohonanEBiasiswa extends \yii\db\ActiveRecord
{
    public $umur;
    public $kategori_oku_id;
    public $status_permohonan_id;
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_permohonan_e_biasiswa';
    }

    public function behaviors()
    {
        return [
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
            [['nama', 'no_kad_pengenalan', 'tarikh_lahir', 'jantina', 'keturunan', 'agama', 'taraf_perkahwinan', 
                'kawasan_temuduga_anda', 'alamat_1', 'alamat_negeri', 'alamat_poskod', 
                'no_tel_bimbit', 'universiti_institusi', 'program_pengajian', 'kursus_bidang_pengajian', 'falkulti', 
                'kategori', 'tarikh_mula', 'tarikh_tamat', 'semester_terkini', 'baki_semester_yang_tinggal', 'no_matriks', 
                'sukan', 'perakuan_pemohon', 'status_permohonan'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required ],
            [['tarikh_tamat', 'tarikh_temuduga', 'tarikh_lahir', 'tarikh_permohonan'], 'safe'],
            [['semester_terkini', 'baki_semester_yang_tinggal', 'perakuan_pemohon', 'kelulusan', 'mendapat_pembiayaan_pendidikan_bool', 'contoh', 'admin_e_biasiswa_id', 'alamat_poskod', 'no_tel_bimbit'], 'integer', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_integer],
            [['muat_naik_gambar'], 'string', 'max' => 100, 'skipOnEmpty' => true, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['nama', 'oku_lain_lain', 'universiti_institusi', 'program_pengajian', 'kursus_bidang_pengajian', 'falkulti', 'sukan', 'nyatakan_nama_penaja'], 'string', 'max' => 80, 'skipOnEmpty' => true, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['no_kad_pengenalan'], 'string', 'max' => 12, 'skipOnEmpty' => true, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['no_kad_pengenalan'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['png_semasa', 'pngk_semasa'], 'number', 'message' => GeneralMessage::yii_validation_number],
            [['jantina'], 'string', 'max' => 1, 'skipOnEmpty' => true, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['keturunan'], 'string', 'max' => 25, 'skipOnEmpty' => true, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['agama', 'taraf_perkahwinan'], 'string', 'max' => 15, 'skipOnEmpty' => true, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['png_semasa', 'pngk_semasa'], 'string', 'max' => 20, 'skipOnEmpty' => true, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['kawasan_temuduga_anda', 'alamat_1', 'alamat_2', 'alamat_3', 'alamat_negeri', 'no_pendaftaran_oku', 'kategori_oku', 'kategori', 'no_matriks', 'mendapat_pembiayaan_pendidikan', 'status_permohonan'], 'string', 'max' => 30, 'skipOnEmpty' => true, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['alamat_bandar'], 'string', 'max' => 40, 'skipOnEmpty' => true, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['alamat_poskod'], 'string', 'max' => 5, 'skipOnEmpty' => true, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['alamat_poskod', 'no_tel_bimbit'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['no_tel_bimbit'], 'string', 'max' => 14, 'skipOnEmpty' => true, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['tempat_temuduga'], 'string', 'max' => 90, 'skipOnEmpty' => true, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['umur'],'validateUmur', 'skipOnEmpty' => false],
            [['muat_naik_gambar'],'validateFileUpload', 'skipOnEmpty' => false],
            [['oku_lain_lain'],'validateOKULainlain', 'skipOnEmpty' => false],
            //[['tarikh_mula'], 'compare', 'compareAttribute'=>'tarikh_tamat', 'operator'=>'<=', 'skipOnEmpty'=>true],
            [['tarikh_tamat'], 'compare', 'compareAttribute'=>'tarikh_mula', 'operator'=>'>=', 'message' => GeneralMessage::yii_validation_compare],
            [['nama', 'oku_lain_lain', 'universiti_institusi', 'program_pengajian', 'kursus_bidang_pengajian', 'falkulti', 'sukan', 'nyatakan_nama_penaja',
                'keturunan','agama', 'taraf_perkahwinan','png_semasa', 'pngk_semasa','kawasan_temuduga_anda', 'alamat_1', 'alamat_2', 'alamat_3', 'alamat_negeri', 
                'no_pendaftaran_oku', 'kategori_oku', 'kategori', 'no_matriks', 'mendapat_pembiayaan_pendidikan', 'status_permohonan','alamat_bandar','tempat_temuduga',
                ], function ($attribute, $params) {
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

            'permohonan_e_biasiswa_id' => GeneralLabel::permohonan_e_biasiswa_id,
            'admin_e_biasiswa_id' => GeneralLabel::admin_e_biasiswa_id,
            'muat_naik_gambar' => GeneralLabel::muat_naik_gambar,
            'nama' => GeneralLabel::nama,
            'no_kad_pengenalan' => GeneralLabel::no_kad_pengenalan,
            'tarikh_lahir' => GeneralLabel::tarikh_lahir,
            'umur' => GeneralLabel::umur,
            'jantina' => GeneralLabel::jantina,
            'keturunan' => GeneralLabel::keturunan,
            'agama' => GeneralLabel::agama,
            'taraf_perkahwinan' => GeneralLabel::taraf_perkahwinan,
            'kawasan_temuduga_anda' => GeneralLabel::kawasan_temuduga_anda,
            'tarikh_temuduga' => GeneralLabel::tarikh_temuduga,
            'alamat_1' => GeneralLabel::alamat_1,
            'alamat_2' => GeneralLabel::alamat_2,
            'alamat_3' => GeneralLabel::alamat_3,
            'alamat_negeri' => GeneralLabel::alamat_negeri,
            'alamat_bandar' => GeneralLabel::alamat_bandar,
            'alamat_poskod' => GeneralLabel::alamat_poskod,
            'no_tel_bimbit' => GeneralLabel::no_tel_bimbit,
            'no_pendaftaran_oku' => GeneralLabel::no_pendaftaran_oku,
            'kategori_oku' => GeneralLabel::kategori_oku,
            'oku_lain_lain' => GeneralLabel::oku_lain_lain,
            'universiti_institusi' => GeneralLabel::universiti_institusi,
            'program_pengajian' => GeneralLabel::program_pengajian,
            'kursus_bidang_pengajian' => GeneralLabel::kursus_bidang_pengajian,
            'falkulti' => GeneralLabel::falkulti,
            'kategori' => GeneralLabel::kategori,
            'tarikh_mula' => GeneralLabel::tarikh_mula,
            'tarikh_tamat' => GeneralLabel::tarikh_tamat,
            'semester_terkini' => GeneralLabel::semester_terkini,
            'baki_semester_yang_tinggal' => GeneralLabel::baki_semester_yang_tinggal,
            'png_semasa' => GeneralLabel::png_semasa,
            'pngk_semasa' => GeneralLabel::pngk_semasa,
            'no_matriks' => GeneralLabel::no_matriks,
            'mendapat_pembiayaan_pendidikan' => GeneralLabel::mendapat_pembiayaan_pendidikan,
            'mendapat_pembiayaan_pendidikan_bool' => GeneralLabel::mendapat_pembiayaan_pendidikan_bool,
            'nyatakan_nama_penaja' => GeneralLabel::nyatakan_nama_penaja,
            'sukan' => GeneralLabel::sukan,
            'perakuan_pemohon' => GeneralLabel::perakuan_pemohon,
            'contoh' => GeneralLabel::contoh,
            'catatan' => GeneralLabel::catatan,
            'kelulusan' => GeneralLabel::kelulusan,
            'status_permohonan' => GeneralLabel::status_permohonan,
            'tarikh_permohonan' => GeneralLabel::tarikh_permohonan,
            'tempat_temuduga' => GeneralLabel::tempat_temuduga,

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
    
    /**
     * Validate upload file cannot be empty
     */
    public function validateUmur($attribute, $params){
        if($this->program_pengajian == RefProgramPengajian::DIPLOMA){
            if($this->umur > 25){
                $this->addError($attribute, 'Umur tidak boleh lebih 25');
            }
        } elseif($this->program_pengajian == RefProgramPengajian::IJAZAH){
            if($this->umur > 30){
                $this->addError($attribute, 'Umur tidak boleh lebih 30');
            }
        }
    }
    
    /**
     * Validate upload file cannot be empty
     */
    public function validateOKULainlain($attribute, $params){
        if($this->kategori_oku == RefKategoriOkuEBiasiswa::OKU_LAIN_LAIN && $this->oku_lain_lain == ""){
            $this->addError($attribute, GeneralMessage::custom_validation_nyatakan_oku_lain);
        }
    }
    
    public function getRefJantina()
    {
        return $this->hasOne(RefJantina::className(), ['id' => 'jantina']);
    }
    
    public function getRefSesiPermohonan()
    {
        return $this->hasOne(AdminEBiasiswa::className(), ['admin_e_biasiswa_id' => 'admin_e_biasiswa_id']);
    }
    
    public function getRefStatusPermohonanEBiasiswa()
    {
        return $this->hasOne(RefStatusPermohonanEBiasiswa::className(), ['id' => 'status_permohonan']);
    }
    
    public function getNameAndIC(){
        $returnValue = "";
        
        if($this->no_kad_pengenalan != ""){
            $returnValue = $this->nama.' ('.$this->no_kad_pengenalan.')';
        } else {
            $returnValue = $this->nama;
        }
        
        return $returnValue;
    }
}
