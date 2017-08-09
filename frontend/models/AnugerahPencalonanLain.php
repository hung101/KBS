<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;
use app\models\general\Upload;
use app\models\general\GeneralMessage;
use app\models\general\GeneralLabel;
use common\models\general\GeneralFunction;

/**
 * This is the model class for table "tbl_anugerah_pencalonan_lain".
 *
 * @property integer $anugerah_pencalonan_lain_id
 * @property string $kategori
 * @property string $nama
 * @property string $gambar
 * @property string $no_kad_pengenalan
 * @property string $no_tel_1
 * @property string $no_tel_2
 * @property string $sumbangan_dalam_pencapaian
 * @property string $ulasan_justifikasi
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created
 * @property string $updated
 */
class AnugerahPencalonanLain extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_anugerah_pencalonan_lain';
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
            [['kategori', 'nama', 'no_tel_1'], 'required', 'skipOnEmpty' => true],
            [['sumbangan_dalam_pencapaian', 'ulasan_justifikasi'], 'string'],
            [['created_by', 'updated_by'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['created', 'updated', 'atlet', 'jurulatih', 'persatuan_sukan'], 'safe'],
            [['nama'], 'string', 'max' => 80, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['gambar'], 'string', 'max' => 100, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['no_kad_pengenalan'], 'string', 'max' => 12, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['no_tel_1', 'no_tel_2'], 'string', 'max' => 14, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['no_tel_1', 'no_tel_2', 'no_kad_pengenalan'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['gambar'],'validateFileUpload', 'skipOnEmpty' => false],
            [['nama','sumbangan_dalam_pencapaian', 'ulasan_justifikasi'], 'filter', 'filter' => function ($value) {
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
            'anugerah_pencalonan_lain_id' => 'Anugerah Pencalonan Lain ID',
            'kategori' => GeneralLabel::kategori,  //'Kategori',
            'nama' => GeneralLabel::nama,  //'Nama',
            'gambar' => GeneralLabel::gambar,  //'Gambar',
            'no_kad_pengenalan' => GeneralLabel::no_kad_pengenalan,  //'No Kad Pengenalan',
            'no_tel_1' => GeneralLabel::no_telefon_1,  //'No Telefon 1',
            'no_tel_2' => GeneralLabel::no_telefon_2,  //'No Telefon 2',
            'sumbangan_dalam_pencapaian' => GeneralLabel::sumbangan_dalam_pencapaian,  //'Sumbangan Dalam Pencapaian Cemerlang Atlet / Pasukan',
            'ulasan_justifikasi' => GeneralLabel::ulasan_justifikasi,  //'Ulasan / Justifikasi Pencalonan',
            'atlet' => GeneralLabel::atlet,  
            'jurulatih' => GeneralLabel::jurulatih,  
            'persatuan_sukan' => GeneralLabel::persatuan_sukan,  
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
        
        if($file){
            if(!GeneralFunction::checkFileExtension($file->getExtension())){
                $this->addError($attribute, GeneralMessage::uploadFileTypeError);
            }
        }
    }
    
     /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefKategoriPencalonanLain(){
        return $this->hasOne(RefKategoriPencalonanLain::className(), ['id' => 'kategori']);
    }
}
