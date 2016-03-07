<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;
use app\models\general\Upload;
use app\models\general\GeneralMessage;

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
            [['no_fail', 'bahagian', 'cawangan', 'program', 'sub_cawangan_pelapis', 'lain_lain_program', 'pusat_latihan', 'nama_sukan', 'nama_acara', 'status_jurulatih', 'status_permohonan', 'status_keaktifan_jurulatih', 'nama', 'bangsa', 'agama', 'jantina', 'warganegara', 'tarikh_lahir', 'tempat_lahir', 'taraf_perkahwinan', 'bil_tanggungan', 'alamat_rumah_1', 'alamat_rumah_negeri', 'alamat_rumah_bandar', 'alamat_rumah_poskod', 'alamat_surat_menyurat_1', 'alamat_surat_menyurat_negeri', 'alamat_surat_menyurat_bandar', 'alamat_surat_menyurat_poskod', 'no_telefon', 'no_telefon_bimbit', 'sektor', 'jawatan', 'no_telefon_pejabat', 'alamat_majikan_1', 'alamat_majikan_negeri', 'alamat_majikan_bandar', 'alamat_majikan_poskod'], 'required', 'skipOnEmpty' => true],
            [['tarikh_lahir', 'tamat_tempoh', 'tamat_visa_tempoh', 'tamat_permit_tempoh'], 'safe'],
            [['bil_tanggungan'], 'integer'],
            [['gambar', 'warganegara', 'emel'], 'string', 'max' => 100],
            [['cawangan', 'sub_cawangan_pelapis', 'lain_lain_program', 'pusat_latihan', 'nama_sukan', 'nama_acara', 'nama', 'nama_majikan'], 'string', 'max' => 80],
            [['status_jurulatih', 'status_permohonan', 'status_keaktifan_jurulatih', 'no_visa', 'no_permit_kerja', 'alamat_rumah_negeri', 'alamat_surat_menyurat_negeri', 'status', 'sektor', 'jawatan', 'alamat_majikan_negeri'], 'string', 'max' => 30],
            [['bangsa'], 'string', 'max' => 25],
            [['agama', 'taraf_perkahwinan', 'passport_no'], 'string', 'max' => 15],
            [['jantina'], 'string', 'max' => 1],
            [['tempat_lahir', 'alamat_rumah_1', 'alamat_rumah_2', 'alamat_rumah_3', 'alamat_surat_menyurat_1', 'alamat_surat_menyurat_2', 'alamat_surat_menyurat_3', 'alamat_majikan_1', 'alamat_majikan_2', 'alamat_majikan_3'], 'string', 'max' => 90],
            [['ic_no', 'ic_tentera'], 'string', 'max' => 12],
            [['ic_no_lama'], 'string', 'max' => 8],
            [['alamat_rumah_bandar', 'alamat_surat_menyurat_bandar', 'alamat_majikan_bandar'], 'string', 'max' => 40],
            [['alamat_rumah_poskod', 'alamat_surat_menyurat_poskod', 'alamat_majikan_poskod'], 'string', 'max' => 5],
            [['no_telefon', 'no_telefon_pejabat', 'no_telefon_bimbit'], 'string', 'max' => 14],
            [['gambar'], 'validateFileUpload', 'skipOnEmpty' => false],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'jurulatih_id' => 'Jurulatih ID',
            'gambar' => 'Gambar',
            'no_fail' => 'No Fail',
            'bahagian' => 'Bahagian',
            'cawangan' => 'Cawangan',
            'program' => 'Program',
            'sub_cawangan_pelapis' => 'Sub Program Pelapis',
            'lain_lain_program' => 'Lain-lain Program',
            'pusat_latihan' => 'Pusat Latihan',
            'nama_sukan' => 'Nama Sukan',
            'nama_acara' => 'Nama Acara',
            'status_jurulatih' => 'Status Jurulatih',
            'status_permohonan' => 'Status Permohonan',
            'status_keaktifan_jurulatih' => 'Status Keaktifan Jurulatih',
            'nama' => 'Nama',
            'bangsa' => 'Bangsa',
            'agama' => 'Agama',
            'jantina' => 'Jantina',
            'warganegara' => 'Warganegara',
            'tarikh_lahir' => 'Tarikh Lahir',
            'tempat_lahir' => 'Tempat Lahir',
            'taraf_perkahwinan' => 'Taraf Perkahwinan',
            'bil_tanggungan' => 'Bil. Tanggungan',
            'ic_no' => 'IC No',
            'ic_no_lama' => 'IC No Lama',
            'ic_tentera' => 'IC Tentera',
            'passport_no' => 'Passport No',
            'tamat_tempoh' => 'Tamat Tempoh',
            'no_visa' => 'No Visa',
            'tamat_visa_tempoh' => 'Tamat Visa Tempoh',
            'no_permit_kerja' => 'No Permit Kerja',
            'tamat_permit_tempoh' => 'Tamat Permit Tempoh',
            'alamat_rumah_1' => 'Alamat Rumah',
            'alamat_rumah_2' => '',
            'alamat_rumah_3' => '',
            'alamat_rumah_negeri' => 'Negeri',
            'alamat_rumah_bandar' => 'Bandar',
            'alamat_rumah_poskod' => 'Poskod',
            'alamat_surat_menyurat_1' => 'Alamat Surat Menyurat',
            'alamat_surat_menyurat_2' => '',
            'alamat_surat_menyurat_3' => '',
            'alamat_surat_menyurat_negeri' => 'Negeri',
            'alamat_surat_menyurat_bandar' => 'Bandar',
            'alamat_surat_menyurat_poskod' => 'Poskod',
            'no_telefon' => 'No Telefon',
            'no_telefon_bimbit' => 'No Telefon Bimbit',
            'emel' => 'Emel',
            'status' => 'Status',
            'sektor' => 'Sektor',
            'jawatan' => 'Jawatan',
            'no_telefon_pejabat' => 'No Telefon Pejabat',
            'nama_majikan' => 'Nama Majikan',
            'alamat_majikan_1' => 'Alamat Majikan',
            'alamat_majikan_2' => '',
            'alamat_majikan_3' => '',
            'alamat_majikan_negeri' => 'Negeri',
            'alamat_majikan_bandar' => 'Bandar',
            'alamat_majikan_poskod' => 'Poskod',
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
}
