<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;
use app\models\general\Upload;
use app\models\general\GeneralMessage;

use app\models\general\GeneralLabel;

/**
 * This is the model class for table "tbl_jurulatih".
 *
 * @property integer $jurulatih_id
 * @property string $gambar
 * @property string $cawangan
 * @property string $sub_cawangan_pelapis
 * @property string $lain_lain_program
 * @property string $pusat_latihan
 * @property string $nama_sukan
 * @property string $nama_acara
 * @property string $status_jurulatih
 * @property string $status_permohonan
 * @property string $status_keaktifan_jurulatih
 * @property string $nama
 * @property string $bangsa
 * @property string $agama
 * @property string $jantina
 * @property string $warganegara
 * @property string $tarikh_lahir
 * @property string $tempat_lahir
 * @property string $taraf_perkahwinan
 * @property integer $bil_tanggungan
 * @property string $ic_no
 * @property string $ic_no_lama
 * @property string $ic_tentera
 * @property string $passport_no
 * @property string $tamat_tempoh
 * @property string $no_visa
 * @property string $tamat_visa_tempoh
 * @property string $no_permit_kerja
 * @property string $tamat_permit_tempoh
 * @property string $alamat_rumah_1
 * @property string $alamat_rumah_2
 * @property string $alamat_rumah_3
 * @property string $alamat_rumah_negeri
 * @property string $alamat_rumah_bandar
 * @property string $alamat_rumah_poskod
 * @property string $alamat_surat_menyurat_1
 * @property string $alamat_surat_menyurat_2
 * @property string $alamat_surat_menyurat_3
 * @property string $alamat_surat_menyurat_negeri
 * @property string $alamat_surat_menyurat_bandar
 * @property string $alamat_surat_menyurat_poskod
 * @property string $no_telefon
 * @property string $emel
 * @property string $status
 * @property string $sektor
 * @property string $jawatan
 * @property string $no_telefon_pejabat
 * @property string $nama_majikan
 * @property string $alamat_majikan_1
 * @property string $alamat_majikan_2
 * @property string $alamat_majikan_3
 * @property string $alamat_majikan_negeri
 * @property string $alamat_majikan_bandar
 * @property string $alamat_majikan_poskod
 */
class Jurulatih extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_jurulatih';
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
            [['no_fail', 'bahagian', 'cawangan', 'program', 'sub_cawangan_pelapis', 'lain_lain_program', 'pusat_latihan', 'nama_sukan', 
                'nama_acara', 'status_jurulatih', 'status_permohonan', 'status_keaktifan_jurulatih', 'nama', 'bangsa', 'agama', 
                'jantina', 'warganegara', 'tarikh_lahir', 'tempat_lahir', 'taraf_perkahwinan', 'bil_tanggungan', 'alamat_rumah_1', 
                'alamat_rumah_negeri', 'alamat_rumah_bandar', 'alamat_rumah_poskod', 'alamat_surat_menyurat_1', 'alamat_surat_menyurat_negeri', 
                'alamat_surat_menyurat_bandar', 'alamat_surat_menyurat_poskod', 'no_telefon', 'no_telefon_bimbit', 'sektor', 'jawatan', 
                'no_telefon_pejabat', 'alamat_majikan_1', 'alamat_majikan_negeri', 'alamat_majikan_bandar', 'alamat_majikan_poskod'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['tarikh_lahir', 'tamat_tempoh', 'tamat_visa_tempoh', 'tamat_permit_tempoh'], 'safe'],
            [['bil_tanggungan', 'approved', 'nama_sukan', 'nama_acara', 'ic_no', 'ic_tentera', 'ic_no_lama',
                'alamat_rumah_poskod', 'alamat_surat_menyurat_poskod', 'alamat_majikan_poskod'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['gambar', 'warganegara', 'emel'], 'string', 'max' => 100, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['cawangan', 'sub_cawangan_pelapis', 'lain_lain_program', 'pusat_latihan', 'nama', 'nama_majikan'], 'string', 'max' => 80, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['status_jurulatih', 'status_permohonan', 'status_keaktifan_jurulatih', 'no_visa', 'no_permit_kerja', 'alamat_rumah_negeri', 'alamat_surat_menyurat_negeri', 'status', 'sektor', 'jawatan', 'alamat_majikan_negeri'], 'string', 'max' => 30, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['bangsa'], 'string', 'max' => 25, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['agama', 'taraf_perkahwinan', 'passport_no'], 'string', 'max' => 15, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['jantina'], 'string', 'max' => 1, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['tempat_lahir', 'alamat_rumah_1', 'alamat_rumah_2', 'alamat_rumah_3', 'alamat_surat_menyurat_1', 'alamat_surat_menyurat_2', 'alamat_surat_menyurat_3', 'alamat_majikan_1', 'alamat_majikan_2', 'alamat_majikan_3'], 'string', 'max' => 30, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['ic_no', 'ic_tentera'], 'string', 'max' => 12, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['ic_no_lama'], 'string', 'max' => 8, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['alamat_rumah_bandar', 'alamat_surat_menyurat_bandar', 'alamat_majikan_bandar'], 'string', 'max' => 40, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['alamat_rumah_poskod', 'alamat_surat_menyurat_poskod', 'alamat_majikan_poskod'], 'string', 'max' => 5, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['no_telefon', 'no_telefon_pejabat', 'no_telefon_bimbit'], 'string', 'max' => 14, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['gambar'], 'validateFileUpload', 'skipOnEmpty' => false],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'jurulatih_id' => GeneralLabel::jurulatih_id,
            'gambar' => GeneralLabel::gambar,
            'no_fail' => GeneralLabel::no_fail,
            'bahagian' => GeneralLabel::bahagian,
            'cawangan' => GeneralLabel::cawangan,
            'program' => GeneralLabel::program,
            'sub_cawangan_pelapis' => GeneralLabel::sub_cawangan_pelapis,
            'lain_lain_program' => GeneralLabel::lain_lain_program,
            'pusat_latihan' => GeneralLabel::pusat_latihan,
            'nama_sukan' => GeneralLabel::sukan,
            'nama_acara' => GeneralLabel::acara,
            'status_jurulatih' => GeneralLabel::status_jurulatih,
            'status_permohonan' => GeneralLabel::status_permohonan,
            'status_keaktifan_jurulatih' => GeneralLabel::status_keaktifan_jurulatih,
            'nama' => GeneralLabel::nama,
            'bangsa' => GeneralLabel::bangsa,
            'agama' => GeneralLabel::agama,
            'jantina' => GeneralLabel::jantina,
            'warganegara' => GeneralLabel::warganegara,
            'tarikh_lahir' => GeneralLabel::tarikh_lahir,
            'tempat_lahir' => GeneralLabel::tempat_lahir,
            'taraf_perkahwinan' => GeneralLabel::taraf_perkahwinan,
            'bil_tanggungan' => GeneralLabel::bil_tanggungan,
            'ic_no' => GeneralLabel::no_kp_no_kp_lama,
            'ic_no_lama' => GeneralLabel::ic_no_lama,
            'ic_tentera' => GeneralLabel::ic_tentera,
            'passport_no' => GeneralLabel::passport_no,
            'tamat_tempoh' => GeneralLabel::tamat_tempoh,
            'no_visa' => GeneralLabel::no_visa,
            'tamat_visa_tempoh' => GeneralLabel::tamat_visa_tempoh,
            'no_permit_kerja' => GeneralLabel::no_permit_kerja,
            'tamat_permit_tempoh' => GeneralLabel::tamat_permit_tempoh,
            'alamat_rumah_1' => GeneralLabel::alamat_rumah_1,
            'alamat_rumah_2' => GeneralLabel::alamat_rumah_2,
            'alamat_rumah_3' => GeneralLabel::alamat_rumah_3,
            'alamat_rumah_negeri' => GeneralLabel::alamat_rumah_negeri,
            'alamat_rumah_bandar' => GeneralLabel::alamat_rumah_bandar,
            'alamat_rumah_poskod' => GeneralLabel::alamat_rumah_poskod,
            'alamat_surat_menyurat_1' => GeneralLabel::alamat_surat_menyurat_1,
            'alamat_surat_menyurat_2' => GeneralLabel::alamat_surat_menyurat_2,
            'alamat_surat_menyurat_3' => GeneralLabel::alamat_surat_menyurat_3,
            'alamat_surat_menyurat_negeri' => GeneralLabel::alamat_surat_menyurat_negeri,
            'alamat_surat_menyurat_bandar' => GeneralLabel::alamat_surat_menyurat_bandar,
            'alamat_surat_menyurat_poskod' => GeneralLabel::alamat_surat_menyurat_poskod,
            'no_telefon' => GeneralLabel::no_telefon,
            'no_telefon_bimbit' => GeneralLabel::no_telefon_bimbit,
            'emel' => GeneralLabel::emel,
            'status' => GeneralLabel::status,
            'sektor' => GeneralLabel::sektor,
            'jawatan' => GeneralLabel::jawatan_hakiki,
            'no_telefon_pejabat' => GeneralLabel::no_telefon_pejabat,
            'nama_majikan' => GeneralLabel::nama_majikan,
            'alamat_majikan_1' => GeneralLabel::alamat_majikan_1,
            'alamat_majikan_2' => GeneralLabel::alamat_majikan_2,
            'alamat_majikan_3' => GeneralLabel::alamat_majikan_3,
            'alamat_majikan_negeri' => GeneralLabel::alamat_majikan_negeri,
            'alamat_majikan_bandar' => GeneralLabel::alamat_majikan_bandar,
            'alamat_majikan_poskod' => GeneralLabel::alamat_majikan_poskod,

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

        if(!$file && $this->$attribute==""){
            $this->addError($attribute, GeneralMessage::uploadEmptyError);
        }
    }
    
    public function getNameAndIC(){
        $returnValue = "";
        
        if($this->ic_no != ""){
            $returnValue = $this->nama.' ('.$this->ic_no.')';
        } else {
            $returnValue = $this->nama;
        }
        
        return $returnValue;
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefCawangan(){
        return $this->hasOne(RefCawangan::className(), ['id' => 'cawangan']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefSubProgramPelapisJurulatih(){
        return $this->hasOne(RefSubProgramPelapisJurulatih::className(), ['id' => 'sub_cawangan_pelapis']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefSukan(){
        return $this->hasOne(RefSukan::className(), ['id' => 'nama_sukan']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefAcara(){
        return $this->hasOne(RefAcara::className(), ['id' => 'nama_acara']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefBahagianJurulatih(){
        return $this->hasOne(RefBahagianJurulatih::className(), ['id' => 'bahagian']);
    }
}
