<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;
use app\models\general\Upload;
use app\models\general\GeneralMessage;
use app\models\general\GeneralLabel;

/**
 * This is the model class for table "tbl_bantuan_penyertaan_pegawai_teknikal_dicadangkan".
 *
 * @property integer $bantuan_penyertaan_pegawai_teknikal_dicadangkan_id
 * @property integer $bantuan_penyertaan_pegawai_teknikal_id
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
class BantuanPenyertaanPegawaiTeknikalDicadangkan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_bantuan_penyertaan_pegawai_teknikal_dicadangkan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bantuan_penyertaan_pegawai_teknikal_dicadangkan_id', 'umur', 'created_by', 'updated_by', 'no_kad_pengenalan',
                'maklumat_pegawai_teknikal_id'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['badan_sukan', 'sukan', 'nama', 'alamat_1', 'alamat_negeri', 'alamat_bandar', 'alamat_poskod', 'no_kad_pengenalan', 'umur', 'jantina', 
                'no_telefon', 'tahap_akademik', 'nama_majikan', 'no_telefon_majikan', 'jawatan', 'nama_kejohanan_kursus', 'tarikh_mula', 'tarikh_tamat', 
                'tempat'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['tarikh_mula', 'tarikh_tamat', 'created', 'updated'], 'safe'],
            [['alamat_e_mail'], 'email', 'message' => GeneralMessage::yii_validation_email],
            [['badan_sukan', 'nama_majikan', 'jawatan'], 'string', 'max' => 80, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['sukan', 'nama', 'alamat_1', 'alamat_2', 'alamat_3', 'no_passport', 'tahap_akademik'], 'string', 'max' => 30, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['alamat_negeri'], 'string', 'max' => 3, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['alamat_bandar', 'alamat_poskod'], 'string', 'max' => 5, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['alamat_poskod'], 'string', 'min' => 5, 'tooShort' => GeneralMessage::yii_validation_string_min],
            [['alamat_poskod'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['no_kad_pengenalan'], 'string', 'max' => 12, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['jantina'], 'string', 'max' => 1, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['no_telefon', 'no_telefon_majikan', 'no_faks'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['no_telefon', 'no_telefon_majikan', 'no_faks'], 'string', 'max' => 14, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['alamat_e_mail', 'tahap_kelayakan_sukan_peringkat_kebangsaan', 'tahap_kelayakan_sukan_peringkat_antarabangsa', 'session_id'], 'string', 'max' => 100, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['gred'], 'string', 'max' => 10, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['tempat'], 'string', 'max' => 90, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['nama_kejohanan_kursus'], 'string', 'max' => 255, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['tahap_kelayakan_sukan_peringkat_kebangsaan', 'tahap_kelayakan_sukan_peringkat_antarabangsa'],'validateFileUpload', 'skipOnEmpty' => false],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'bantuan_penyertaan_pegawai_teknikal_dicadangkan_id' => 'Bantuan Penyertaan Pegawai Teknikal Dicadangkan ID',
            'bantuan_penyertaan_pegawai_teknikal_id' => 'Bantuan Penyertaan Pegawai Teknikal ID',
            'maklumat_pegawai_teknikal_id' => GeneralLabel::maklumat_pegawai_teknikal_id,  //'Pegawai Teknikal',
            'badan_sukan' => GeneralLabel::badan_sukan,  //'Badan Sukan',
            'sukan' => GeneralLabel::sukan,  //'Sukan',
            'nama' => GeneralLabel::nama,  //'Nama',
            'alamat_1' => GeneralLabel::alamat_1,  //'Alamat',
            'alamat_2' => '',
            'alamat_3' => '',
            'alamat_negeri' => GeneralLabel::alamat_negeri,  //'Negeri',
            'alamat_bandar' => GeneralLabel::alamat_bandar,  //'Bandar',
            'alamat_poskod' => GeneralLabel::alamat_poskod,  //'Poskod',
            'no_kad_pengenalan' => GeneralLabel::no_kad_pengenalan,  //'No. Kad Pengenalan',
            'umur' => GeneralLabel::umur,  //'Umur',
            'no_passport' => GeneralLabel::no_passport,  //'No. Passport',
            'jantina' => GeneralLabel::jantina,  //'Jantina',
            'no_telefon' => GeneralLabel::no_telefon,  //'No. Telefon',
            'alamat_e_mail' => GeneralLabel::emel,  //'Emel',
            'tahap_akademik' => GeneralLabel::tahap_akademik,  //'Tahap Akademik',
            'tahap_kelayakan_sukan_peringkat_kebangsaan' => GeneralLabel::tahap_kelayakan_sukan_peringkat_kebangsaan,  //'Tahap Kelayakan Sukan Peringkat Kebangsaan',
            'tahap_kelayakan_sukan_peringkat_antarabangsa' => GeneralLabel::tahap_kelayakan_sukan_peringkat_antarabangsa,  //'Tahap Kelayakan Sukan Peringkat Antarabangsa',
            'nama_majikan' => GeneralLabel::nama_majikan,  //'Nama Majikan',
            'no_telefon_majikan' => GeneralLabel::no_telefon_majikan,  //'No. Telefon Majikan',
            'no_faks' => GeneralLabel::no_faks,  //'No. Faks',
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
