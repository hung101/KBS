<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;
use app\models\general\Upload;
use app\models\general\GeneralMessage;

use app\models\general\GeneralLabel;
use common\models\general\GeneralFunction;

/**
 * This is the model class for table "tbl_pengurusan_berita_antarabangsa".
 *
 * @property integer $pengurusan_berita_antarabangsa_id
 * @property string $kategori_berita
 * @property string $nama_berita
 * @property string $tarikh_berita
 * @property string $muatnaik
 */
class PengurusanBeritaAntarabangsa extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_pengurusan_berita_antarabangsa';
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
            [['kategori_berita', 'nama_berita', 'tarikh_berita', 'nama_negara'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['tarikh_berita'], 'safe'],
            [['nama_negara', 'country', 'population', 'celcius'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['malaysia_rm'], 'number', 'message' => GeneralMessage::yii_validation_number],
            [['kategori_berita', 'nama_berita', 'nama_pegawai_embassy', 'climate', 'region', 'state', 'goverment_mayor',
                'area_municipality', 'economy_gpp', 'popular_sports'], 'string', 'max' => 80, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['alamat_1', 'alamat_2', 'alamat_3', 'area_code'], 'string', 'max' => 30, 'tooLong' => GeneralMessage::yii_validation_string_max],
            //[['alamat_negeri'], 'string', 'max' => 3, 'tooLong' => GeneralMessage::yii_validation_string_max],
            //[['alamat_bandar', 'alamat_poskod'], 'string', 'max' => 5, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['alamat_poskod'], 'string', 'max' => 30, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['alamat_poskod'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            //[['no_telefon', 'no_faks'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['muatnaik'], 'string', 'max' => 100, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['gps'], 'string', 'max' => 50, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['currency', 'timezone', 'malaysian_timezone'], 'string', 'max' => 30, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['catatan', 'public_transportation'], 'string', 'max' => 255, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['muatnaik'],'validateFileUpload', 'skipOnEmpty' => false],
            //[['no_telefon'],'validateInternationalPhoneNo', 'skipOnEmpty' => true],
            [['no_telefon', 'no_faks'], 'match', 'pattern' => '/^[0-9-+.]+$/', 'message' => GeneralMessage::yii_validation_match], //only allow international number
            [['kategori_berita', 'nama_berita', 'nama_pegawai_embassy', 'climate', 'region', 'state', 'goverment_mayor',
                'area_municipality', 'economy_gpp', 'popular_sports','alamat_1', 'alamat_2', 'alamat_3', 'area_code',
                'gps','currency', 'timezone', 'malaysian_timezone','catatan', 'public_transportation'], 'filter', 'filter' => function ($value) {
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
            'pengurusan_berita_antarabangsa_id' => GeneralLabel::pengurusan_berita_antarabangsa_id,
            'kategori_berita' => GeneralLabel::kategori_berita,
            'nama_berita' => GeneralLabel::nama_berita,
            'tarikh_berita' => GeneralLabel::tarikh_berita,
            'muatnaik' => GeneralLabel::muatnaik,
            'alamat_1' => GeneralLabel::alamat_1,
            'alamat_2' => GeneralLabel::alamat_2,
            'alamat_3' => GeneralLabel::alamat_3,
            'alamat_negeri' => GeneralLabel::alamat_negeri,
            'alamat_bandar' => GeneralLabel::alamat_bandar,
            'alamat_poskod' => GeneralLabel::alamat_poskod,
            'gps' => 'GPS',
            'currency' => GeneralLabel::matawang, 
            'malaysia_rm' => GeneralLabel::malaysia_rm, //Malaysia (RM)',
            'goverment_mayor' => GeneralLabel::goverment_mayor, //'Kerajaan (Datuk Bandar)',
            'area_municipality' => GeneralLabel::area_municipality, //'Kawasan (Perbandaran)',
            'timezone' => GeneralLabel::timezone, //'Zon Masa',
            'malaysian_timezone' => GeneralLabel::malaysian_timezone, //'Zon Masa Malaysia',
            'economy_gpp' => GeneralLabel::economy_gpp, //'Ekonomi GDP',
            'celcius' => GeneralLabel::celcius, //"Celsius (°C)",
            'area_code' => GeneralLabel::area_code, //"Kod Kawasan",
            'popular_sports' => GeneralLabel::sukan, //"Sukan Popular",
            'region' => GeneralLabel::kawasan,  //'Kawasan',
            'country' => GeneralLabel::negara, //'Negara',
            'state' => GeneralLabel::negeri, //'Negeri',
            'population' => GeneralLabel::population,
            'public_transportation' =>  GeneralLabel::pengangkutan, //'Pengangkutan Awam',
            'climate' => GeneralLabel::iklim, //'Iklim',
            'no_faks' => GeneralLabel::no_faks,
            'no_telefon' => GeneralLabel::no_telefon,
            'nama_pegawai_embassy' => GeneralLabel::nama_pegawai_embassy,  //'Nama Pegawai Kedutaan'
            'nama_negara' => GeneralLabel::negara,  //'Nama Pegawai Kedutaan'
            'catatan' => GeneralLabel::catatan,
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

        if(!$file && $this->$attribute==""){
            $this->addError($attribute, GeneralMessage::uploadEmptyError);
        }
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefKategoriBerita(){
        return $this->hasOne(RefKategoriBerita::className(), ['id' => 'kategori_berita']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefNegara(){
        return $this->hasOne(RefNegara::className(), ['id' => 'nama_negara']);
    }
}
