<?php

namespace app\models;

use yii\web\UploadedFile;

use Yii;

use app\models\general\GeneralMessage;

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
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tahap', 'tid', 'cawangan', 'name_penuh', 'tarikh_lahir', 'umur', 'tempat_lahir_bandar', 'tempat_lahir_negeri', 
                'bangsa', 'agama', 'jantina', 'taraf_perkahwinan', 'tinggi', 'berat', 'tel_bimbit_no_1', 'tel_no', 'alamat_rumah_1', 'alamat_rumah_negeri', 
                'alamat_rumah_bandar', 'alamat_rumah_poskod', 'alamat_surat_menyurat_1', 'alamat_surat_negeri', 'alamat_surat_bandar', 'alamat_surat_poskod', 
                'nama_kecemasan', 'pertalian_kecemasan', 'tel_no_kecemasan', 'tel_bimbit_no_kecemasan'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['tarikh_lahir', 'lesen_tamat_tempoh', 'passport_tamat_tempoh'], 'safe'],
            [['umur', 'tel_bimbit_no_1', 'tel_bimbit_no_2', 'tel_no', 'tid', 'tel_no_kecemasan', 'tel_bimbit_no_kecemasan'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['tinggi', 'berat'], 'number', 'message' => GeneralMessage::yii_validation_number],
            [['lesen_memandu_no', 'dari_bahagian', 'sumber', 'pertalian_kecemasan'], 'string', 'max' => 20, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['name_penuh', 'nama_kecemasan'], 'string', 'max' => 80, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['tempat_lahir_bandar', 'alamat_rumah_bandar', 'alamat_surat_bandar'], 'string', 'max' => 30, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['tempat_lahir_negeri', 'alamat_rumah_negeri', 'alamat_surat_negeri', 'passport_tempat_dikeluarkan', 'negeri_diwakili'], 'string', 'max' => 40, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['bangsa', 'bahasa_ibu'], 'string', 'max' => 25, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['agama', 'taraf_perkahwinan', 'no_sijil_lahir', 'passport_no'], 'string', 'max' => 15, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['jantina'], 'string', 'max' => 1, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['ic_no', 'ic_tentera'], 'string', 'max' => 12, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['alamat_rumah_poskod', 'alamat_surat_poskod'], 'string', 'max' => 5, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['ic_no_lama'], 'string', 'max' => 8, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['jenis_lesen', 'emel', 'facebook', 'twitter'], 'string', 'max' => 100, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['alamat_rumah_1','alamat_rumah_2','alamat_rumah_3', 'alamat_surat_menyurat_1', 'alamat_surat_menyurat_2', 'alamat_surat_menyurat_3'], 'string', 'max' => 30, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['file'], 'safe'],
            [['file'], 'file', 'extensions' => 'png, jpg'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'atlet_id' => 'Atlet ID',
            'gambar' => 'Gambar',
            'tahap' => 'Tahap',
            'tid' => 'TID',
            'cawangan' => 'Cawangan',
            'name_penuh' => 'Nama Penuh',
            'tarikh_lahir' => 'Tarikh Lahir',
            'umur' => 'Umur',
            'tempat_lahir_bandar' => 'Tempat Lahir Bandar',
            'tempat_lahir_negeri' => 'Tempat Lahir Negeri',
            'bangsa' => 'Bangsa',
            'agama' => 'Agama',
            'jantina' => 'Jantina',
            'taraf_perkahwinan' => 'Taraf Perkahwinan',
            'tinggi' => 'Tinggi (CM)',
            'berat' => 'Berat (KG)',
            'bahasa_ibu' => 'Bahasa Ibunda',
            'no_sijil_lahir' => 'No Sijil Lahir',
            'ic_no' => 'No Kad Pengenalan (Baru)',
            'ic_no_lama' => 'No Kad Pengenalan (Lama)',
            'ic_tentera' => 'No Tentera',
            'passport_no' => 'No Passport',
            'passport_tempat_dikeluarkan' => 'Tempat Dikeluarkan',
            'passport_tamat_tempoh' => 'Tamat Tempoh',
            'lesen_memandu_no' => 'No Lesen Memandu',
            'lesen_tamat_tempoh' => 'Lesen Tamat Tempoh',
            'jenis_lesen' => 'Jenis Lesen',
            'tel_bimbit_no_1' => 'No Tel Bimbit 1',
            'tel_bimbit_no_2' => 'No Tel Bimbit 2',
            'tel_no' => 'No Tel',
            'emel' => 'Emel',
            'facebook' => 'Facebook',
            'twitter' => 'Twitter',
            'alamat_rumah_1' => 'Alamat Rumah',
            'alamat_rumah_2' => '',
            'alamat_rumah_3' => '',
            'alamat_rumah_negeri' => 'Negeri',
            'alamat_rumah_bandar' => 'Bandar',
            'alamat_rumah_poskod' => 'Poskod',
            'alamat_surat_menyurat_1' => 'Alamat Surat Menyurat',
            'alamat_surat_menyurat_2' => '',
            'alamat_surat_menyurat_3' => '',
            'alamat_surat_negeri' => 'Negeri',
            'alamat_surat_bandar' => 'Bandar',
            'alamat_surat_poskod' => 'Poskod',
            //'kumpulan' => 'Kumpulan',
            'dari_bahagian' => 'Dari Bahagian',
            'sumber' => 'Sumber',
            'negeri_diwakili' => 'Negeri Diwakili',
            'nama_kecemasan' => 'Nama',
            'pertalian_kecemasan' => 'Hubungan',
            'tel_no_kecemasan' => 'No Tel',
            'tel_bimbit_no_kecemasan' => 'No Tel Bimbit',
            'tawaran' => 'Tawaran',
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
    
    public function getNameAndIC(){
        $returnValue = "";
        
        if($this->ic_no != ""){
            $returnValue = $this->name_penuh.' ('.$this->ic_no.')';
        } else {
            $returnValue = $this->name_penuh;
        }
        
        return $returnValue;
    }
}
