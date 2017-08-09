<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;
use app\models\general\Upload;
use app\models\general\GeneralMessage;
use common\models\general\GeneralFunction;
use app\models\general\GeneralLabel;

/**
 * This is the model class for table "tbl_pengurusan_perhimpunan_kem".
 *
 * @property integer $pengurusan_perhimpunan_kem_id
 * @property string $nama_ppn
 * @property string $pengurus_pn
 * @property string $nama_penganjuran
 * @property string $kategori_penganjuran
 * @property string $sub_kategori_penganjuran
 * @property string $tahap_penganjuran
 * @property string $negeri
 * @property string $kategori_sukan
 * @property string $tarikh_penganjuran
 * @property string $activiti
 * @property string $tempat
 * @property integer $jumlah_peserta
 * @property integer $sokongan_pn
 * @property integer $kelulusan
 */
class PengurusanPerhimpunanKem extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_pengurusan_perhimpunan_kem';
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
            [['nama_ppn', 'pengurus_pn', 'nama_penganjuran', 'kategori_penganjuran', 'sub_kategori_penganjuran', 'tahap_penganjuran', 'negeri', 
                'kategori_sukan', 'tarikh_penganjuran', 'activiti', 'tempat', 'jumlah_peserta', 'sokongan_pn', 'kelulusan'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['tarikh_penganjuran', 'kategori_geran_bantuan'], 'safe'],
            [['jumlah_peserta', 'sokongan_pn', 'kelulusan'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['nama_ppn', 'pengurus_pn', 'nama_penganjuran', 'kategori_penganjuran', 'sub_kategori_penganjuran', 'tahap_penganjuran', 'kategori_sukan', 'activiti'], 'string', 'max' => 80, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['negeri'], 'string', 'max' => 30, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['tempat'], 'string', 'max' => 90, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['muat_naik'],'validateFileUpload', 'skipOnEmpty' => false],
            [['nama_ppn', 'pengurus_pn', 'nama_penganjuran', 'kategori_penganjuran', 'sub_kategori_penganjuran', 'tahap_penganjuran', 'kategori_sukan', 'activiti',
                'negeri','tempat'], 'filter', 'filter' => function ($value) {
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
            'pengurusan_perhimpunan_kem_id' => GeneralLabel::pengurusan_perhimpunan_kem_id,
            'kategori_geran_bantuan' => GeneralLabel::kategori_geran_bantuan,
            'nama_ppn' => GeneralLabel::nama_ppn,
            'pengurus_pn' => GeneralLabel::pengurus_pn,
            'nama_penganjuran' => GeneralLabel::nama_penganjuran,
            'kategori_penganjuran' => GeneralLabel::kategori_penganjuran,
            'sub_kategori_penganjuran' => GeneralLabel::sub_kategori_penganjuran,
            'tahap_penganjuran' => GeneralLabel::tahap_penganjuran,
            'negeri' => GeneralLabel::negeri,
            'kategori_sukan' => GeneralLabel::kategori_sukan,
            'tarikh_penganjuran' => GeneralLabel::tarikh_penganjuran,
            'activiti' => GeneralLabel::activiti,
            'tempat' => GeneralLabel::tempat,
            'jumlah_peserta' => GeneralLabel::jumlah_peserta,
            'disahkan' => GeneralLabel::disahkan,
            'sokongan_pn' => GeneralLabel::sokongan_pn,
            'muat_naik' => GeneralLabel::muat_naik,
            'kelulusan' => GeneralLabel::kelulusan,

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
    
    public function getRefKategoriPenganjuran()
    {
        return $this->hasOne(RefKategoriPenganjuran::className(), ['id' => 'kategori_penganjuran']);
    }
}
