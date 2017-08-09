<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;
use app\models\general\Upload;
use app\models\general\GeneralMessage;
use app\models\general\GeneralLabel;
use common\models\general\GeneralFunction;

/**
 * This is the model class for table "tbl_maklumat_pegawai_teknikal".
 *
 * @property integer $bantuan_penganjuran_kursus_pegawai_teknikal_dicadangkan_id
 * @property integer $bantuan_penganjuran_kursus_pegawai_teknikal_id
 * @property string $badan_sukan
 * @property string $sukan
 * @property string $nama
 * @property string $alamat_1
 * @property string $alamat_2
 * @property string $alamat_3
 * @property string $alamat_negeri
 * @property string $alamat_bandar
 * @property string $alamat_poskod
 * @property string $no_kad_pengenalan
 * @property integer $umur
 * @property string $no_passport
 * @property string $jantina
 * @property string $no_telefon
 * @property string $alamat_e_mail
 * @property string $tahap_akademik
 * @property string $tahap_kelayakan_sukan_peringkat_kebangsaan
 * @property string $tahap_kelayakan_sukan_peringkat_antarabangsa
 * @property string $nama_majikan
 * @property string $no_telefon_majikan
 * @property string $no_faks
 * @property string $jawatan
 * @property string $gred
 * @property string $nama_kejohanan_kursus
 * @property string $tarikh_mula
 * @property string $tarikh_tamat
 * @property string $tempat
 * @property string $session_id
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created
 * @property string $updated
 */
class MaklumatPegawaiTeknikal extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_maklumat_pegawai_teknikal';
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
            [['no_kad_pengenalan'], 'unique', 'message' => GeneralMessage::yii_validation_unique],
            [['bantuan_penganjuran_kursus_pegawai_teknikal_id', 'umur', 'created_by', 'updated_by', 'no_kad_pengenalan'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['badan_sukan', 'sukan', 'jawatan_pengawai', 'kategori', 'program', 'nama', 'alamat_1', 'alamat_negeri', 'alamat_poskod', 'no_kad_pengenalan', 'umur', 'jantina', 
                'no_telefon', 'tahap_akademik', 'nama_majikan', 'no_telefon_majikan', 'jawatan', 'nama_kejohanan_kursus', 'tarikh_mula', 'tarikh_tamat', 
                'tempat'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['tarikh_mula', 'tarikh_tamat', 'created', 'updated'], 'safe'],
            [['alamat_e_mail'], 'email', 'message' => GeneralMessage::yii_validation_email],
            [['badan_sukan', 'nama_majikan', 'jawatan', 'nama_kejohanan_kursus', 'tahap_akademik_lain_lain'], 'string', 'max' => 80, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['sukan', 'nama', 'alamat_1', 'alamat_2', 'alamat_3', 'no_passport', 'tahap_akademik'], 'string', 'max' => 30, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['alamat_negeri'], 'string', 'max' => 3, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['alamat_bandar', 'alamat_poskod'], 'string', 'max' => 5, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['alamat_poskod', 'no_kad_pengenalan'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['no_kad_pengenalan'], 'string', 'max' => 12, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['jantina'], 'string', 'max' => 1, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['no_telefon', 'no_telefon_majikan', 'no_faks'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['no_telefon', 'no_telefon_majikan', 'no_faks'], 'string', 'max' => 14, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['alamat_e_mail', 'tahap_kelayakan_sukan_peringkat_kebangsaan', 'tahap_kelayakan_sukan_peringkat_antarabangsa', 'session_id'], 'string', 'max' => 100, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['gred'], 'string', 'max' => 10, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['tempat'], 'string', 'max' => 90, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['tahap_kelayakan_sukan_peringkat_kebangsaan', 'tahap_kelayakan_sukan_peringkat_antarabangsa'],'validateFileUpload', 'skipOnEmpty' => false],
            [['badan_sukan', 'nama_majikan', 'jawatan', 'nama_kejohanan_kursus', 'tahap_akademik_lain_lain','sukan', 'nama', 'alamat_1', 'alamat_2', 
                'alamat_3', 'no_passport', 'tahap_akademik','alamat_negeri','alamat_bandar','alamat_e_mail'], 'filter', 'filter' => function ($value) {
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
            'bantuan_penganjuran_kursus_pegawai_teknikal_dicadangkan_id' => 'Bantuan Penganjuran Kursus Pegawai Teknikal Dicadangkan ID',
            'bantuan_penganjuran_kursus_pegawai_teknikal_id' => 'Bantuan Penganjuran Kursus Pegawai Teknikal ID',
            'badan_sukan' => GeneralLabel::badan_sukan,  //'Badan Sukan',
            'jawatan_pengawai' => GeneralLabel::jawatan,  //'Jawatan',
            'kategori' => GeneralLabel::kategori,  //'Kategori',
            'program' => GeneralLabel::program,  //'Program', 
            'sukan' => GeneralLabel::sukan,  //'Sukan',
            'nama' => GeneralLabel::nama,  //'Nama',
            'alamat_1' => GeneralLabel::alamat_1,  //'Alamat',
            'alamat_2' => '',
            'alamat_3' => '',
            'alamat_negeri' => GeneralLabel::alamat_negeri,  //'Negeri',
            'alamat_bandar' => GeneralLabel::alamat_bandar,  //'Bandar',
            'alamat_poskod' => GeneralLabel::alamat_poskod,  //'Poskod',
            'no_kad_pengenalan' => GeneralLabel::no_kad_pengenalan,  //'No Kad Pengenalan',
            'umur' => GeneralLabel::umur,  //'Umur',
            'no_passport' => GeneralLabel::no_passport,  //'No Passport',
            'jantina' => GeneralLabel::jantina,  //'Jantina',
            'no_telefon' => GeneralLabel::no_telefon,  //'No Telefon',
            'alamat_e_mail' => GeneralLabel::emel,  //'Alamat E-Mail',
            'tahap_akademik' => GeneralLabel::tahap_akademik,  //'Tahap Akademik',
            'tahap_kelayakan_sukan_peringkat_kebangsaan' => GeneralLabel::tahap_kelayakan_sukan_peringkat_kebangsaan,  //'Tahap Teknikal / Kepegawaian Kelayakan (Kebangsaan)',
            'tahap_kelayakan_sukan_peringkat_antarabangsa' => GeneralLabel::tahap_kelayakan_sukan_peringkat_antarabangsa,  //'Tahap Kelayakan Teknikal / Kepegawaian (Antarabangsa)',
            'nama_majikan' => GeneralLabel::nama_majikan,  //'Nama Majikan',
            'no_telefon_majikan' => GeneralLabel::no_telefon_majikan,  //'No Telefon Majikan',
            'no_faks' => GeneralLabel::no_faks,  //'No Faks',
            'jawatan' => GeneralLabel::jawatan,  //'Jawatan',
            'gred' => GeneralLabel::gred,  //'Gred',
            'nama_kejohanan_kursus' => GeneralLabel::nama_kejohanan_kursus,  //'Nama Kejohanan / Kursus',
            'tarikh_mula' => GeneralLabel::tarikh_mula,  //'Tarikh Mula',
            'tarikh_tamat' => GeneralLabel::tarikh_tamat,  //'Tarikh Tamat',
            'tempat' => GeneralLabel::tempat,  //'Tempat',
            'session_id' => 'Session ID',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created' => 'Created',
            'updated' => 'Updated',
            'tahap_akademik_lain_lain' => GeneralLabel::nyatakan_jika_lain_lain,
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
    public function getRefProfilBadanSukan(){
        return $this->hasOne(ProfilBadanSukan::className(), ['profil_badan_sukan' => 'badan_sukan']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefSukan(){
        return $this->hasOne(RefSukan::className(), ['id' => 'sukan']);
    }
}
