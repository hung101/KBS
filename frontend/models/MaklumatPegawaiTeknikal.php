<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;
use app\models\general\Upload;
use app\models\general\GeneralMessage;
use app\models\general\GeneralLabel;

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

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bantuan_penganjuran_kursus_pegawai_teknikal_id', 'umur', 'created_by', 'updated_by'], 'integer'],
            [['badan_sukan', 'sukan', 'nama', 'alamat_1', 'alamat_negeri', 'alamat_bandar', 'alamat_poskod', 'no_kad_pengenalan', 'umur', 'jantina', 'no_telefon', 'tahap_akademik', 'nama_majikan', 'no_telefon_majikan', 'jawatan', 'nama_kejohanan_kursus', 'tarikh_mula', 'tarikh_tamat', 'tempat'], 'required'],
            [['tarikh_mula', 'tarikh_tamat', 'created', 'updated'], 'safe'],
            [['badan_sukan', 'nama_majikan', 'jawatan', 'nama_kejohanan_kursus'], 'string', 'max' => 80],
            [['sukan', 'nama', 'alamat_1', 'alamat_2', 'alamat_3', 'no_passport', 'tahap_akademik'], 'string', 'max' => 30],
            [['alamat_negeri'], 'string', 'max' => 3],
            [['alamat_bandar', 'alamat_poskod'], 'string', 'max' => 5],
            [['no_kad_pengenalan'], 'string', 'max' => 12],
            [['jantina'], 'string', 'max' => 1],
            [['no_telefon', 'no_telefon_majikan', 'no_faks'], 'string', 'max' => 14],
            [['alamat_e_mail', 'tahap_kelayakan_sukan_peringkat_kebangsaan', 'tahap_kelayakan_sukan_peringkat_antarabangsa', 'session_id'], 'string', 'max' => 100],
            [['gred'], 'string', 'max' => 10],
            [['tempat'], 'string', 'max' => 90],
            [['tahap_kelayakan_sukan_peringkat_kebangsaan', 'tahap_kelayakan_sukan_peringkat_antarabangsa'],'validateFileUpload', 'skipOnEmpty' => false],
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
            'badan_sukan' => 'Badan Sukan',
            'sukan' => 'Sukan',
            'nama' => 'Nama',
            'alamat_1' => 'Alamat',
            'alamat_2' => '',
            'alamat_3' => '',
            'alamat_negeri' => 'Negeri',
            'alamat_bandar' => 'Bandar',
            'alamat_poskod' => 'Poskod',
            'no_kad_pengenalan' => 'No Kad Pengenalan',
            'umur' => 'Umur',
            'no_passport' => 'No Passport',
            'jantina' => 'Jantina',
            'no_telefon' => 'No Telefon',
            'alamat_e_mail' => 'Alamat E-Mail',
            'tahap_akademik' => 'Tahap Akademik',
            'tahap_kelayakan_sukan_peringkat_kebangsaan' => 'Tahap Kelayakan Sukan Peringkat Kebangsaan',
            'tahap_kelayakan_sukan_peringkat_antarabangsa' => 'Tahap Kelayakan Sukan Peringkat Antarabangsa',
            'nama_majikan' => 'Nama Majikan',
            'no_telefon_majikan' => 'No Telefon Majikan',
            'no_faks' => 'No Faks',
            'jawatan' => 'Jawatan',
            'gred' => 'Gred',
            'nama_kejohanan_kursus' => 'Nama Kejohanan / Kursus',
            'tarikh_mula' => 'Tarikh Mula',
            'tarikh_tamat' => 'Tarikh Tamat',
            'tempat' => 'Tempat',
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
