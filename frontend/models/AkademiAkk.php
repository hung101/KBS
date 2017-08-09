<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;
use app\models\general\Upload;
use app\models\general\GeneralMessage;

use app\models\general\GeneralLabel;
use app\models\general\GeneralVariable;
use common\models\general\GeneralFunction;


/**
 * This is the model class for table "tbl_akademi_akk".
 *
 * @property integer $akademi_akk_id
 * @property string $nama
 * @property string $muatnaik_gambar
 * @property string $no_kad_pengenalan
 * @property string $no_passport
 * @property string $tarikh_lahir
 * @property string $tempat_lahir
 * @property string $no_telefon
 * @property string $emel
 * @property string $nama_majikan
 * @property string $alamat_majikan_1
 * @property string $alamat_majikan_2
 * @property string $alamat_majikan_3
 * @property string $alamat_majikan_negeri
 * @property string $alamat_majikan_bandar
 * @property string $alamat_majikan_poskod
 * @property string $no_telefon_pejabat
 * @property string $kategori_pensijilan
 */
class AkademiAkk extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_akademi_akk';
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
            [['nama_jurulatih', 'no_kad_pengenalan', 'tarikh_lahir', 'tempat_lahir', 'no_telefon', 'kategori_pensijilan', 'jenis_sukan', 'tahun',
                'jantina', 'bangsa', 'kategori_jurulatih', 'alamat_1', 'alamat_negeri', 'alamat_poskod'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['tarikh_lahir', 'tarikh_terima_borang', 'tarikh_mula_lesen', 'tarikh_tamat_lesen'], 'safe'],
            [['jantina', 'bangsa', 'status_jurulatih', 'no_kad_pengenalan', 'alamat_poskod', 'no_telefon', 'no_telefon_pejabat', 'alamat_majikan_poskod', 'kategori_jurulatih', 'jurulatih_di_negeri','status_perlesenan'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['emel'], 'email', 'message' => GeneralMessage::yii_validation_email],
            [['nama', 'nama_majikan', 'jenis_sukan', 'nama_jurulatih'], 'string', 'max' => 80, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['senarai_nama_peserta'], 'string', 'max' => 255, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['muatnaik_gambar', 'emel'], 'string', 'max' => 100, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['no_kad_pengenalan'], 'string', 'max' => 12, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['no_passport'], 'string', 'max' => 15, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['tempat_lahir', 'alamat_majikan_1', 'alamat_majikan_2', 'alamat_majikan_3'], 'string', 'max' => 90, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['no_telefon', 'no_telefon_pejabat'], 'string', 'max' => 14, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['alamat_majikan_negeri', 'kategori_pensijilan', 'alamat_1', 'alamat_2', 'alamat_3', 'no_lesen_jurulatih', 'no_sijil_spkk'], 'string', 'max' => 30, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['alamat_majikan_bandar'], 'string', 'max' => 40, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['alamat_majikan_poskod', 'alamat_bandar', 'alamat_poskod'], 'string', 'max' => 5, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['tahun'], 'string', 'max' => 4, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['alamat_negeri'], 'string', 'max' => 3, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['tahun'], 'integer', 'min' => GeneralVariable::yearMin, 'max' => GeneralVariable::yearMax, 'message' => GeneralMessage::yii_validation_integer, 'tooBig' => GeneralMessage::yii_validation_integer_max, 'tooSmall' => GeneralMessage::yii_validation_integer_min],
            [['muatnaik_gambar'],'validateFileUpload', 'skipOnEmpty' => false],
            [['tarikh_tamat_lesen'], 'compare', 'compareAttribute'=>'tarikh_mula_lesen', 'operator'=>'>=', 'message' => GeneralMessage::yii_validation_compare],
            [['alamat_majikan_poskod', 'alamat_poskod'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            //[['nama, nama_jurulatih'], 'validateJurulatihFreeText', 'skipOnEmpty' => false],
            
            [['emel','nama', 'nama_majikan', 'jenis_sukan', 'nama_jurulatih','senarai_nama_peserta','tempat_lahir', 'alamat_majikan_1', 'alamat_majikan_2', 
                'alamat_majikan_3', 'no_passport', 'tempat_lahir', 'alamat_majikan_1', 'alamat_majikan_2', 'alamat_majikan_3', 'alamat_majikan_negeri', 
                'kategori_pensijilan', 'alamat_1', 'alamat_2', 'alamat_3', 'no_lesen_jurulatih', 'no_sijil_spkk', 'alamat_majikan_bandar', 
                'alamat_bandar','alamat_negeri'], 'filter', 'filter' => function ($value) {
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
            'akademi_akk_id' => GeneralLabel::akademi_akk_id,
            'senarai_nama_peserta' => GeneralLabel::senarai_nama_peserta,
            'nama' => GeneralLabel::jurulatih_msn,
            'nama_jurulatih' => GeneralLabel::nama,
            'muatnaik_gambar' => GeneralLabel::muatnaik_gambar,
            'no_kad_pengenalan' => GeneralLabel::no_kad_pengenalan,
            'no_passport' => GeneralLabel::no_passport,
            'tarikh_lahir' => GeneralLabel::tarikh_lahir,
            'tempat_lahir' => GeneralLabel::tempat_lahir,
            'no_telefon' => GeneralLabel::no_telefon,
            'emel' => GeneralLabel::emel,
            'nama_majikan' => GeneralLabel::nama_majikan,
            'alamat_majikan_1' => GeneralLabel::alamat_majikan_1,
            'alamat_majikan_2' => GeneralLabel::alamat_majikan_2,
            'alamat_majikan_3' => GeneralLabel::alamat_majikan_3,
            'alamat_majikan_negeri' => GeneralLabel::alamat_majikan_negeri,
            'alamat_majikan_bandar' => GeneralLabel::alamat_majikan_bandar,
            'alamat_majikan_poskod' => GeneralLabel::alamat_majikan_poskod,
            'no_telefon_pejabat' => GeneralLabel::no_telefon_pejabat,
            'kategori_pensijilan' => GeneralLabel::kategori_pensijilan,
            'tarikh_terima_borang' => GeneralLabel::tarikh_terima_borang,
            'no_lesen_jurulatih' => GeneralLabel::no_lesen_jurulatih,
            'tarikh_mula_lesen' => GeneralLabel::tarikh_mula_lesen,
            'tarikh_tamat_lesen' => GeneralLabel::tarikh_tamat_lesen,
            'no_sijil_spkk' => GeneralLabel::no_sijil_spkk,
            'jantina' => GeneralLabel::jantina,
            'bangsa' => GeneralLabel::bangsa,
            'alamat_1' => GeneralLabel::alamat_1,
            'alamat_2' => GeneralLabel::alamat_2,
            'alamat_3' => GeneralLabel::alamat_3,
            'alamat_negeri' => GeneralLabel::alamat_negeri,
            'alamat_bandar' => GeneralLabel::alamat_bandar,
            'alamat_poskod' => GeneralLabel::alamat_poskod,
            'jenis_sukan' => GeneralLabel::jenis_sukan,
            'tahun' => GeneralLabel::tahun,
            'status_jurulatih' => GeneralLabel::status_kejurulatihan,
            'kategori_jurulatih' => GeneralLabel::kategori_jurulatih,
            'jurulatih_di_negeri' => GeneralLabel::jurulatih_di_negeri,
            'status_perlesenan' => GeneralLabel::status_perlesenan,
        ];
    }
    
    public function validateJurulatihFreeText()
    {
        if (($this->nama==null)&&($this->nama_jurulatih==null))      
        {
                $this->addError('nama', GeneralMessage::yii_validation_required_either);
                $this->addError('nama_jurulatih', GeneralMessage::yii_validation_required_either);
        } else if (($this->nama!=null)&&($this->nama_jurulatih!=null))      
        {
                $this->addError('nama', GeneralMessage::yii_validation_required_only_one);
                $this->addError('nama_jurulatih', GeneralMessage::yii_validation_required_only_one);
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
        
        if($file){
            if(!GeneralFunction::checkFileExtension($file->getExtension())){
                $this->addError($attribute, GeneralMessage::uploadFileTypeError);
            }
        }
    }
    
    public function getRefJurulatih()
    {
        return $this->hasOne(Jurulatih::className(), ['jurulatih_id' => 'nama']);
    }
    
    public function getRefKategoriPensijilanAkademiAkk()
    {
        return $this->hasOne(RefKategoriPensijilanAkademiAkk::className(), ['id' => 'kategori_pensijilan']);
    }
    
    public function getRefSukan()
    {
        return $this->hasOne(RefSukan::className(), ['id' => 'jenis_sukan']);
    }
}
