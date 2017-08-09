<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;
use app\models\general\Upload;
use app\models\general\GeneralMessage;
use app\models\general\GeneralLabel;
use common\models\general\GeneralFunction;

/**
 * This is the model class for table "tbl_anugerah_pencalonan_pasukan".
 *
 * @property integer $anugerah_pencalonan_pasukan_id
 * @property string $kategori
 * @property string $sukan
 * @property string $nama_pasukan
 * @property string $gambar_pasukan
 * @property string $ulasan_pencapaian
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created
 * @property string $updated
 */
class AnugerahPencalonanPasukan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_anugerah_pencalonan_pasukan';
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
            [['kategori', 'sukan', 'nama_pasukan'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['created_by', 'updated_by'], 'integer'],
            [['created', 'updated'], 'safe'],
            [['kategori', 'sukan'], 'string', 'max' => 30, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['nama_pasukan'], 'string', 'max' => 80, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['gambar_pasukan'], 'string', 'max' => 100, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['ulasan_pencapaian', 'asas_pencalonan', 'sumbangan_pencapaian'], 'string', 'max' => 255, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['gambar_pasukan'],'validateFileUpload', 'skipOnEmpty' => false],
            [['kategori', 'sukan','nama_pasukan'], 'filter', 'filter' => function ($value) {
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
            'anugerah_pencalonan_pasukan_id' => 'Anugerah Pencalonan Pasukan ID',
            'kategori' => GeneralLabel::kategori,  //'Kategori',
            'sukan' => GeneralLabel::sukan,  //'Sukan',
            'nama_pasukan' => GeneralLabel::nama_pasukan,  //'Nama Pasukan',
            'gambar_pasukan' => GeneralLabel::gambar_pasukan,  //'Gambar Pasukan',
            'ulasan_pencapaian' => GeneralLabel::ulasan_pencapaian,  //'Ulasan Pencapaian',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created' => 'Created',
            'updated' => 'Updated',
            'asas_pencalonan' => GeneralLabel::asas_pencalonan,  //'Asas Pencalonan',
            'sumbangan_pencapaian' => GeneralLabel::sumbangan_pencapaian,  //'Sumbangan/Pencapaian Dalam Bidang Lain Selain Sukan',
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
    public function getRefSukan(){
        return $this->hasOne(RefSukan::className(), ['id' => 'sukan']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefKategoriPencalonanPasukan(){
        return $this->hasOne(RefKategoriPencalonanPasukan::className(), ['id' => 'kategori']);
    }
}
