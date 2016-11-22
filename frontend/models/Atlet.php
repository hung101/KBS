<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;
use yii\web\Session;
use app\models\general\Upload;
use app\models\general\GeneralMessage;
use app\models\general\GeneralLabel;

/**
 * This is the model class for table "atlet".
 *
 * @property string $atlet_id
 * @property string $gambar
 * @property string $tahap
 * @property integer $tid
 * @property string $name_penuh
 * @property string $tarikh_lahir
 * @property integer $umur
 * @property string $tempat_lahir_bandar
 * @property string $tempat_lahir_negeri
 * @property string $bangsa
 * @property string $agama
 * @property string $jantina
 * @property string $taraf_perkahwinan
 * @property string $tinggi
 * @property string $berat
 * @property string $bahasa_ibu
 * @property string $no_sijil_lahir
 * @property string $ic_no
 * @property string $ic_no_lama
 * @property string $passport_no
 * @property string $passport_tempat_dikeluarkan
 * @property string $lesen_memandu_no
 * @property string $lesen_tamat_tempoh
 * @property string $jenis_lesen
 * @property integer $tel_bimbit_no_1
 * @property integer $tel_bimbit_no_2
 * @property integer $tel_no
 * @property string $emel
 * @property string $facebook
 * @property string $twitter
 * @property string $alamat_rumah
 * @property string $alamat_surat_menyurat
 * @property integer $kumpulan
 * @property string $dari_bahagian
 * @property string $sumber
 * @property string $negeri_diwakili
 * @property string $nama_kecemasan
 * @property string $pertalian_kecemasan
 * @property integer $tel_no_kecemasan
 * @property integer $tel_bimbit_no_kecemasan
 */
class Atlet extends \yii\db\ActiveRecord
{
    public $file;
    public $tawaran_id;
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_atlet';
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
            /*'encryption' => [
                'class' => '\nickcv\encrypter\behaviors\EncryptionBehavior',
                'attributes' => [
                    'ic_no',
                    'passport_no',
                    'tel_bimbit_no_1',
                    'tel_bimbit_no_2',
                ],
            ],*/
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        $session = new Session;
        $session->open();
        
        if(isset($session['atlet_cacat']) && $session['atlet_cacat']){
            return [
                [['tahap', 'tid', 'cawangan', 'name_penuh', 'tarikh_lahir', 'umur', 'tempat_lahir_bandar', 'tempat_lahir_negeri', 
                    'bangsa', 'agama', 'jantina', 'taraf_perkahwinan', 'tel_bimbit_no_1', 'alamat_rumah_1', 'alamat_rumah_negeri', 
                    'alamat_rumah_bandar', 'alamat_rumah_poskod', 'alamat_surat_menyurat_1', 'alamat_surat_negeri', 'alamat_surat_bandar', 'alamat_surat_poskod', 
                    'nama_kecemasan', 'pertalian_kecemasan', 'tel_no_kecemasan', 'tel_bimbit_no_kecemasan', 'ic_no', 'tempat_lahir_alamat_1', 'cacat', 'status_atlet',
                    'kategori_kecacatan', 'jenis_kecederaan', 'agensi', 'ms_negeri'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
                [['tarikh_lahir', 'lesen_tamat_tempoh', 'passport_tamat_tempoh', 'kategori_kecacatan', 'cacat', 'tawaran', 'tarikh_luput'], 'safe'],
                [['umur', 'tel_bimbit_no_1', 'tel_bimbit_no_2', 'tel_no', 'tid', 'tel_no_kecemasan', 'tel_bimbit_no_kecemasan',
                    'tawaran_id', 'mesyuarat_id','alamat_rumah_poskod', 'alamat_surat_poskod'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
                [['tinggi', 'berat'], 'number', 'message' => GeneralMessage::yii_validation_number],
                [['emel'], 'email', 'message' => GeneralMessage::yii_validation_email],
                [['tinggi', 'berat'], 'string', 'max' => 6, 'tooLong' => GeneralMessage::yii_validation_string_max],
                [[ 'dari_bahagian', 'sumber', 'pertalian_kecemasan'], 'string', 'max' => 20, 'tooLong' => GeneralMessage::yii_validation_string_max],
                [['name_penuh', 'nama_kecemasan', 'jenis_kecederaan'], 'string', 'max' => 80, 'tooLong' => GeneralMessage::yii_validation_string_max],
                [['tempat_lahir_bandar', 'alamat_rumah_bandar', 'alamat_surat_bandar', 'status_atlet', 'jenis_lesen_paralimpik', 'agensi'], 'string', 'max' => 30, 'tooLong' => GeneralMessage::yii_validation_string_max],
                [['tempat_lahir_negeri', 'alamat_rumah_negeri', 'alamat_surat_negeri', 'passport_tempat_dikeluarkan', 'negeri_diwakili'], 'string', 'max' => 40, 'tooLong' => GeneralMessage::yii_validation_string_max],
                [['bangsa', 'bahasa_ibu'], 'string', 'max' => 25, 'tooLong' => GeneralMessage::yii_validation_string_max],
                [['agama', 'taraf_perkahwinan', 'no_sijil_lahir', 'passport_no'], 'string', 'max' => 15, 'tooLong' => GeneralMessage::yii_validation_string_max],
                [['tel_bimbit_no_1', 'tel_bimbit_no_2', 'tel_no', 'tel_no_kecemasan', 'tel_bimbit_no_kecemasan'], 'string', 'max' => 14, 'tooLong' => GeneralMessage::yii_validation_string_max],
                [['jantina'], 'string', 'max' => 1, 'tooLong' => GeneralMessage::yii_validation_string_max],
                [['ic_no', 'ic_tentera'], 'string', 'max' => 12, 'tooLong' => GeneralMessage::yii_validation_string_max],
                [['ms_negeri'], 'string', 'max' => 3, 'tooLong' => GeneralMessage::yii_validation_string_max],
                [['alamat_rumah_poskod', 'alamat_surat_poskod'], 'string', 'min' => 5, 'max' => 5, 'tooLong' => GeneralMessage::yii_validation_string_max, 'tooShort' => GeneralMessage::yii_validation_string_max],
                [['ic_no_lama'], 'string', 'max' => 8, 'tooLong' => GeneralMessage::yii_validation_string_max],
                [['lesen_memandu_no','jenis_lesen', 'emel', 'facebook', 'twitter'], 'string', 'max' => 100, 'tooLong' => GeneralMessage::yii_validation_string_max],
                [['tawaran_fail_rujukan', 'no_lesen_ipc'], 'string', 'max' => 50, 'tooLong' => GeneralMessage::yii_validation_string_max],
                [['tempat_lahir_alamat_1'], 'string', 'max' => 90, 'tooLong' => GeneralMessage::yii_validation_string_max],
                [['gambar'], 'string', 'max' => 255, 'tooLong' => GeneralMessage::yii_validation_string_max],
                [['alamat_rumah_1','alamat_rumah_2','alamat_rumah_3', 'alamat_surat_menyurat_1', 'alamat_surat_menyurat_2', 'alamat_surat_menyurat_3'], 'string', 'max' => 30, 'tooLong' => GeneralMessage::yii_validation_string_max],
                [['file'], 'safe'],
                [['file'], 'file', 'extensions' => 'png, jpg'],
                [['muat_naik_surat_persetujuan'],'validateFileUpload', 'skipOnEmpty' => false],
            ];
        } else {
            return [
                [['tahap', 'tid', 'cawangan', 'name_penuh', 'tarikh_lahir', 'umur', 'tempat_lahir_bandar', 'tempat_lahir_negeri', 
                    'bangsa', 'agama', 'jantina', 'taraf_perkahwinan', 'tinggi', 'berat', 'tel_bimbit_no_1', 'alamat_rumah_1', 'alamat_rumah_negeri', 
                    'alamat_rumah_bandar', 'alamat_rumah_poskod', 'alamat_surat_menyurat_1', 'alamat_surat_negeri', 'alamat_surat_bandar', 'alamat_surat_poskod', 
                    'nama_kecemasan', 'pertalian_kecemasan', 'tel_no_kecemasan', 'tel_bimbit_no_kecemasan', 'ic_no', 'tempat_lahir_alamat_1', 'cacat', 'status_atlet',
                    'kategori_kecacatan', 'jenis_kecederaan', 'agensi', 'ms_negeri'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
                [['tarikh_lahir', 'lesen_tamat_tempoh', 'passport_tamat_tempoh', 'kategori_kecacatan', 'cacat', 'tawaran', 'tarikh_luput'], 'safe'],
                [['umur', 'tel_bimbit_no_1', 'tel_bimbit_no_2', 'tel_no', 'tid', 'tel_no_kecemasan', 'tel_bimbit_no_kecemasan',
                    'tawaran_id', 'mesyuarat_id', 'alamat_rumah_poskod', 'alamat_surat_poskod'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
                [['tinggi', 'berat'], 'number', 'message' => GeneralMessage::yii_validation_number],
                [['emel'], 'email', 'message' => GeneralMessage::yii_validation_email],
                [['tinggi', 'berat'], 'string', 'max' => 6, 'tooLong' => GeneralMessage::yii_validation_string_max],
                [['dari_bahagian', 'sumber', 'pertalian_kecemasan'], 'string', 'max' => 20, 'tooLong' => GeneralMessage::yii_validation_string_max],
                [['name_penuh', 'nama_kecemasan', 'jenis_kecederaan'], 'string', 'max' => 80, 'tooLong' => GeneralMessage::yii_validation_string_max],
                [['tempat_lahir_bandar', 'alamat_rumah_bandar', 'alamat_surat_bandar', 'status_atlet', 'jenis_lesen_paralimpik', 'agensi'], 'string', 'max' => 30, 'tooLong' => GeneralMessage::yii_validation_string_max],
                [['tempat_lahir_negeri', 'alamat_rumah_negeri', 'alamat_surat_negeri', 'passport_tempat_dikeluarkan', 'negeri_diwakili'], 'string', 'max' => 40, 'tooLong' => GeneralMessage::yii_validation_string_max],
                [['bangsa', 'bahasa_ibu'], 'string', 'max' => 25, 'tooLong' => GeneralMessage::yii_validation_string_max],
                [['agama', 'taraf_perkahwinan', 'no_sijil_lahir', 'passport_no'], 'string', 'max' => 15, 'tooLong' => GeneralMessage::yii_validation_string_max],
                [['tel_bimbit_no_1', 'tel_bimbit_no_2', 'tel_no', 'tel_no_kecemasan', 'tel_bimbit_no_kecemasan'], 'string', 'max' => 14, 'tooLong' => GeneralMessage::yii_validation_string_max],
                [['jantina'], 'string', 'max' => 1, 'tooLong' => GeneralMessage::yii_validation_string_max],
                [['ic_no', 'ic_tentera'], 'string', 'max' => 12, 'tooLong' => GeneralMessage::yii_validation_string_max],
                [['ms_negeri'], 'string', 'max' => 3, 'tooLong' => GeneralMessage::yii_validation_string_max],
                [['alamat_rumah_poskod', 'alamat_surat_poskod'], 'string', 'min' => 5, 'max' => 5, 'tooLong' => GeneralMessage::yii_validation_string_max, 'tooShort' => GeneralMessage::yii_validation_string_max],
                [['ic_no_lama'], 'string', 'max' => 8, 'tooLong' => GeneralMessage::yii_validation_string_max],
                [['lesen_memandu_no', 'jenis_lesen', 'emel', 'facebook', 'twitter'], 'string', 'max' => 100, 'tooLong' => GeneralMessage::yii_validation_string_max],
                [['tawaran_fail_rujukan', 'no_lesen_ipc'], 'string', 'max' => 50, 'tooLong' => GeneralMessage::yii_validation_string_max],
                [['tempat_lahir_alamat_1'], 'string', 'max' => 90, 'tooLong' => GeneralMessage::yii_validation_string_max],
                [['gambar'], 'string', 'max' => 255, 'tooLong' => GeneralMessage::yii_validation_string_max],
                [['alamat_rumah_1','alamat_rumah_2','alamat_rumah_3', 'alamat_surat_menyurat_1', 'alamat_surat_menyurat_2', 'alamat_surat_menyurat_3'], 'string', 'max' => 30, 'tooLong' => GeneralMessage::yii_validation_string_max],
                [['file'], 'safe'],
                [['file'], 'file', 'extensions' => 'png, jpg'],
                [['muat_naik_surat_persetujuan'],'validateFileUpload', 'skipOnEmpty' => false],
            ];
        }
        
        $session->close();
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'atlet_id' => GeneralLabel::atlet_id,
            'gambar' => GeneralLabel::gambar,
            'tahap' => GeneralLabel::tahap,
            'tid' => GeneralLabel::tid,
            'cawangan' => GeneralLabel::cawangan,
            'name_penuh' => GeneralLabel::nama,
            'tarikh_lahir' => GeneralLabel::tarikh_lahir,
            'umur' => GeneralLabel::umur,
            'tempat_lahir_bandar' => GeneralLabel::tempat_lahir,
            'tempat_lahir_negeri' => GeneralLabel::tempat_lahir_negeri,
            'bangsa' => GeneralLabel::bangsa,
            'agama' => GeneralLabel::agama,
            'jantina' => GeneralLabel::jantina,
            'taraf_perkahwinan' => GeneralLabel::taraf_perkahwinan,
            'tinggi' => GeneralLabel::tinggi,
            'berat' => GeneralLabel::berat,
            'bahasa_ibu' => GeneralLabel::bahasa_ibu,
            'no_sijil_lahir' => GeneralLabel::no_sijil_lahir,
            'ic_no' => GeneralLabel::no_kad_pengenalan_tentera_polis,
            'ic_no_lama' => GeneralLabel::ic_no_lama,
            'ic_tentera' => GeneralLabel::ic_tentera,
            'passport_no' => GeneralLabel::passport_no,
            'passport_tempat_dikeluarkan' => GeneralLabel::passport_tempat_dikeluarkan,
            'passport_tamat_tempoh' => GeneralLabel::passport_tamat_tempoh,
            'lesen_memandu_no' => GeneralLabel::lesen_memandu_no,
            'lesen_tamat_tempoh' => GeneralLabel::lesen_tamat_tempoh,
            'jenis_lesen' => GeneralLabel::jenis_lesen,
            'tel_bimbit_no_1' => GeneralLabel::tel_bimbit_no_1,
            'tel_bimbit_no_2' => GeneralLabel::tel_bimbit_no_2,
            'tel_no' => GeneralLabel::no_tel_rumah,
            'emel' => GeneralLabel::emel,
            'facebook' => GeneralLabel::facebook,
            'twitter' => GeneralLabel::twitter,
            'alamat_rumah_1' => GeneralLabel::alamat_rumah_1,
            'alamat_rumah_2' => GeneralLabel::alamat_rumah_2,
            'alamat_rumah_3' => GeneralLabel::alamat_rumah_3,
            'alamat_rumah_negeri' => GeneralLabel::alamat_rumah_negeri,
            'alamat_rumah_bandar' => GeneralLabel::alamat_rumah_bandar,
            'alamat_rumah_poskod' => GeneralLabel::alamat_rumah_poskod,
            'alamat_surat_menyurat_1' => GeneralLabel::alamat_surat_menyurat_1,
            'alamat_surat_menyurat_2' => GeneralLabel::alamat_surat_menyurat_2,
            'alamat_surat_menyurat_3' => GeneralLabel::alamat_surat_menyurat_3,
            'alamat_surat_negeri' => GeneralLabel::alamat_surat_negeri,
            'alamat_surat_bandar' => GeneralLabel::alamat_surat_bandar,
            'alamat_surat_poskod' => GeneralLabel::alamat_surat_poskod,
            'kumpulan' => GeneralLabel::kumpulan,
            'dari_bahagian' => GeneralLabel::dari_bahagian,
            'sumber' => GeneralLabel::sumber,
            'negeri_diwakili' => GeneralLabel::negeri_diwakili,
            'nama_kecemasan' => GeneralLabel::nama_kecemasan,
            'pertalian_kecemasan' => GeneralLabel::pertalian_kecemasan,
            'tel_no_kecemasan' => GeneralLabel::tel_no,
            'tel_bimbit_no_kecemasan' => GeneralLabel::tel_bimbit_no_kecemasan,
            'tawaran' => GeneralLabel::status_tawaran,
            'tempat_lahir_alamat_1' => GeneralLabel::tempat_lahir, 
            'cacat' => GeneralLabel::cacat, 
            'kategori_kecacatan' => GeneralLabel::kategori_kecacatan, 
            'jenis_kecederaan' => GeneralLabel::jenis_kecederaan, 
            'tawaran_fail_rujukan' => GeneralLabel::tawaran_fail_rujukan, 
            'muat_naik_surat_persetujuan' => GeneralLabel::muat_naik_surat_persetujuan, 
            'status_atlet' => GeneralLabel::status_atlet, 
            'jenis_lesen_paralimpik' => GeneralLabel::jenis_lesen, 
            'no_lesen_ipc' => GeneralLabel::no_lesen_ipc, 
            'tarikh_luput' => GeneralLabel::tarikh_luput, 
            'agensi' => GeneralLabel::agensi, 
            'ms_negeri' => "Negeri (Sila pilih, jika agensi 'MS Negeri')", 
        ];
    }
    
    public function upload()
    {
        if ($this->validate()) {
            $this->gambar->saveAs('uploads/' . $this->gambar->baseName . '.' . $this->gambar->extension);
            return true;
        } else {
            return false;
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
    }
    
    public function getNameAndIC(){
        $returnValue = $this->name_penuh;
        
        if($this->ic_no != ""){
            $returnValue.=' ('.$this->ic_no.')';
        }else if($this->passport_no != ""){
            $returnValue.= ' - ('.$this->passport_no.')';
        }
        
        return $returnValue;
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefStatusTawaran(){
        return $this->hasOne(RefStatusTawaran::className(), ['id' => 'tawaran']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefAtletSukan(){
        return $this->hasMany(AtletSukan::className(), ['atlet_id' => 'atlet_id']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefAtletPendidikan(){
        return $this->hasMany(AtletPendidikan::className(), ['atlet_id' => 'atlet_id']);
    }
}
