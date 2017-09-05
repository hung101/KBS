<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;
use app\models\general\Upload;
use app\models\general\GeneralMessage;

use app\models\general\GeneralLabel;
use common\models\general\GeneralFunction;

/**
 * This is the model class for table "tbl_penganjuran_kursus_peserta".
 *
 * @property integer $penganjuran_kursus_peserta_id
 * @property string $kategori_kursus
 * @property string $nama_kursus
 * @property string $kod_kursus
 * @property string $tarikh
 * @property string $tempat
 * @property string $yuran
 * @property string $nama_penuh
 * @property string $muatnaik_gambar
 * @property string $jantina
 * @property string $taraf_perkahwinan
 * @property string $no_passport
 * @property string $no_kad_pengenalan
 * @property string $no_kp_polis_tentera
 * @property string $kaum
 * @property string $alamat_1
 * @property string $alamat_2
 * @property string $alamat_3
 * @property string $alamat_negeri
 * @property string $alamat_bandar
 * @property string $alamat_poskod
 * @property string $no_tel_bimbit
 * @property string $no_tel_rumah
 * @property string $emel
 * @property string $pekerjaan
 * @property string $nama_majikan
 * @property string $alamat_majikan_1
 * @property string $alamat_majikan_2
 * @property string $alamat_majikan_3
 * @property string $alamat_majikan_negeri
 * @property string $alamat_majikan_bandar
 * @property string $alamat_majikan_poskod
 * @property string $no_tel_majikan
 * @property string $no_faks_majikan
 * @property string $kelulusan_akademi
 * @property string $nama_kelulusan
 * @property string $kelulusan_sukan_spesifik
 * @property string $nama_sukan_akademi
 * @property string $kelulusan_sains_sukan
 * @property string $sijil_spkk_msn
 * @property string $lesen_kejurulatihan_msn
 * @property string $status_jurulatih
 * @property string $lantikan
 * @property string $nama_sukan_jurulatih
 * @property string $tahun_berkhidmat_mula
 * @property string $tahun_berkhidmat_tamat
 * @property string $pencapaian
 * @property integer $kelulusan
 */
class PenganjuranKursusPeserta extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_penganjuran_kursus_peserta';
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
            [['kategori_kursus', 'nama_kursus', 'kod_kursus', 'tarikh', 'tempat', 'yuran', 'nama_penuh', 'jantina', 'taraf_perkahwinan', 'kaum', 
                'alamat_1', 'alamat_negeri', 'alamat_poskod', 'no_tel_bimbit', 'pekerjaan', 'nama_majikan', 'alamat_majikan_1', 
                'alamat_majikan_negeri', 'alamat_majikan_poskod', 'kelulusan', 'sukan'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['tarikh', 'tahun_berkhidmat_mula', 'tahun_berkhidmat_tamat', 'tarikh_mula_tempoh_sah_laku_sijil', 'tarikh_tamat_tempoh_sah_laku_sijil', 'tarikh_kelulusan'], 'safe'],
            [['yuran'], 'number', 'message' => GeneralMessage::yii_validation_number],
            [['kelulusan', 'sukan'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['kategori_kursus', 'nama_kursus', 'tempat', 'nama_penuh', 'pekerjaan', 'nama_majikan', 'kelulusan_akademi', 'nama_kelulusan', 
                'kelulusan_sukan_spesifik', 'nama_sukan_akademi', 'kelulusan_sains_sukan', 'sijil_spkk_msn', 'lesen_kejurulatihan_msn', 
                'lantikan', 'nama_sukan_jurulatih', 'catatan'], 'string', 'max' => 80, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['kod_kursus', 'alamat_negeri', 'alamat_majikan_negeri', 'status_jurulatih', 'no_lesen'], 'string', 'max' => 30, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['muatnaik_gambar', 'emel'], 'string', 'max' => 100, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['jantina'], 'string', 'max' => 1, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['taraf_perkahwinan', 'kaum'], 'string', 'max' => 25, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['no_passport'], 'string', 'max' => 15, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['no_kad_pengenalan'], 'integer', 'message' => GeneralMessage::yii_validation_integer],            
            [['no_kad_pengenalan', 'no_kp_polis_tentera'], 'string', 'max' => 12, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['alamat_1', 'alamat_2', 'alamat_3', 'alamat_majikan_1', 'alamat_majikan_2', 'alamat_majikan_3'], 'string', 'max' => 90],
            [['alamat_bandar', 'alamat_majikan_bandar'], 'string', 'max' => 40, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['alamat_poskod', 'alamat_majikan_poskod'], 'string', 'max' => 5, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['alamat_poskod', 'alamat_majikan_poskod','no_faks_majikan'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['no_tel_bimbit', 'no_tel_rumah', 'no_tel_majikan', 'no_faks_majikan'], 'string', 'max' => 14, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['no_tel_bimbit', 'no_tel_rumah', 'no_tel_majikan', 'no_faks_majikan'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['pencapaian'], 'string', 'max' => 255, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['maklumat_persamaan_taraf'], 'string', 'max' => 50, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['muatnaik_gambar','dokumen_lampiran'], 'validateFileUpload', 'skipOnEmpty' => false],
            [['tahun_berkhidmat_tamat'], 'compare', 'compareAttribute'=>'tahun_berkhidmat_mula', 'operator'=>'>=', 'message' => GeneralMessage::yii_validation_compare],
            [['tarikh_tamat_tempoh_sah_laku_sijil'], 'compare', 'compareAttribute'=>'tarikh_mula_tempoh_sah_laku_sijil', 'operator'=>'>=', 'message' => GeneralMessage::yii_validation_compare],
            [['kategori_kursus', 'nama_kursus', 'tempat', 'nama_penuh', 'pekerjaan', 'nama_majikan', 'kelulusan_akademi', 'nama_kelulusan', 
                'kelulusan_sukan_spesifik', 'nama_sukan_akademi', 'kelulusan_sains_sukan', 'sijil_spkk_msn', 'lesen_kejurulatihan_msn', 
                'lantikan', 'nama_sukan_jurulatih', 'catatan','kod_kursus', 'alamat_negeri', 'alamat_majikan_negeri', 'status_jurulatih', 'no_lesen','emel',
                'taraf_perkahwinan', 'kaum','no_passport','no_kp_polis_tentera','alamat_1', 'alamat_2', 'alamat_3', 'alamat_majikan_1', 'alamat_majikan_2', 'alamat_majikan_3',
                'alamat_bandar', 'alamat_majikan_bandar','pencapaian','maklumat_persamaan_taraf'], function ($attribute, $params) {
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
            'penganjuran_kursus_peserta_id' => GeneralLabel::penganjuran_kursus_peserta_id,
            'kategori_kursus' => GeneralLabel::kategori_kursus,
            'nama_kursus' => GeneralLabel::nama_kursus,
            'kod_kursus' => GeneralLabel::kod_kursus,
            'tarikh' => GeneralLabel::tarikh,
            'tempat' => GeneralLabel::tempat,
            'yuran' => GeneralLabel::yuran,
            'nama_penuh' => GeneralLabel::nama_penuh,
            'muatnaik_gambar' => GeneralLabel::muatnaik_gambar,
            'jantina' => GeneralLabel::jantina,
            'taraf_perkahwinan' => GeneralLabel::taraf_perkahwinan,
            'no_passport' => GeneralLabel::no_passport,
            'no_kad_pengenalan' => GeneralLabel::no_kad_pengenalan,
            'no_kp_polis_tentera' => GeneralLabel::no_kp_polis_tentera,
            'kaum' => GeneralLabel::kaum,
            'alamat_1' => GeneralLabel::alamat_1,
            'alamat_2' => GeneralLabel::alamat_2,
            'alamat_3' => GeneralLabel::alamat_3,
            'alamat_negeri' => GeneralLabel::alamat_negeri,
            'alamat_bandar' => GeneralLabel::alamat_bandar,
            'alamat_poskod' => GeneralLabel::alamat_poskod,
            'no_tel_bimbit' => GeneralLabel::no_tel_bimbit,
            'no_tel_rumah' => GeneralLabel::no_tel_rumah,
            'emel' => GeneralLabel::emel,
            'pekerjaan' => GeneralLabel::pekerjaan,
            'nama_majikan' => GeneralLabel::nama_majikan,
            'alamat_majikan_1' => GeneralLabel::alamat_majikan_1,
            'alamat_majikan_2' => GeneralLabel::alamat_majikan_2,
            'alamat_majikan_3' => GeneralLabel::alamat_majikan_3,
            'alamat_majikan_negeri' => GeneralLabel::alamat_majikan_negeri,
            'alamat_majikan_bandar' => GeneralLabel::alamat_majikan_bandar,
            'alamat_majikan_poskod' => GeneralLabel::alamat_majikan_poskod,
            'no_tel_majikan' => GeneralLabel::no_tel_majikan,
            'no_faks_majikan' => GeneralLabel::no_faks_majikan,
            'kelulusan_akademi' => GeneralLabel::kelulusan_akademi,
            'nama_kelulusan' => GeneralLabel::nama_kelulusan,
            'kelulusan_sukan_spesifik' => GeneralLabel::kelulusan_sukan_spesifik,
            'nama_sukan_akademi' => GeneralLabel::nama_sukan_akademi,
            'kelulusan_sains_sukan' => GeneralLabel::kelulusan_sains_sukan,
            'sijil_spkk_msn' => GeneralLabel::sijil_spkk_msn,
            'lesen_kejurulatihan_msn' => GeneralLabel::lesen_kejurulatihan_msn,
            'status_jurulatih' => GeneralLabel::status_jurulatih,
            'lantikan' => GeneralLabel::lantikan,
            'nama_sukan_jurulatih' => GeneralLabel::nama_sukan_jurulatih,
            'tahun_berkhidmat_mula' => GeneralLabel::tahun_berkhidmat_mula,
            'tahun_berkhidmat_tamat' => GeneralLabel::tahun_berkhidmat_tamat,
            'pencapaian' => GeneralLabel::pencapaian,
            'dokumen_lampiran' => GeneralLabel::dokumen_lampiran,
            'kelulusan' => GeneralLabel::kelulusan,
            'maklumat_persamaan_taraf' => GeneralLabel::maklumat_persamaan_taraf,
            'sukan' => GeneralLabel::sukan,
            'catatan' => GeneralLabel::catatan,
			'tarikh_kelulusan' => GeneralLabel::tarikh_kelulusan,
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
     * @return \yii\db\ActiveQuery
     */
    public function getRefJantina(){
        return $this->hasOne(RefJantina::className(), ['id' => 'jantina']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefKelulusan(){
        return $this->hasOne(RefKelulusan::className(), ['id' => 'kelulusan']);
    }
}
