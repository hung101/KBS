<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;
use app\models\general\Upload;
use app\models\general\GeneralMessage;

use app\models\general\GeneralLabel;
use common\models\general\GeneralFunction;

/**
 * This is the model class for table "tbl_pengurusan_dokumen_media_program".
 *
 * @property integer $pengurusan_dokumen_media_program_id
 * @property integer $pengurusan_media_program_id
 * @property string $kategori_dokumen
 * @property string $nama_dokumen
 * @property string $muatnaik
 */
class PengurusanDokumenMediaProgram extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_pengurusan_dokumen_media_program';
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
            [['kategori_dokumen', 'nama_dokumen'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['pengurusan_media_program_id'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['kategori_dokumen', 'nama_dokumen'], 'string', 'max' => 80, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['muatnaik'], 'string', 'max' => 100, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['muatnaik'], 'validateFileUpload', 'skipOnEmpty' => false],
            [['kategori_dokumen', 'nama_dokumen'], function ($attribute, $params) {
                if (!\common\models\general\GeneralFunction::validateXSS($this->$attribute)) {
                    $this->addError($attribute, GeneralMessage::yii_validation_xss);
                }
            }],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pengurusan_dokumen_media_program_id' => GeneralLabel::pengurusan_dokumen_media_program_id,
            'pengurusan_media_program_id' => GeneralLabel::pengurusan_media_program_id,
            'kategori_dokumen' => GeneralLabel::kategori_dokumen,
            'nama_dokumen' => GeneralLabel::nama_dokumen,
            'muatnaik' => GeneralLabel::muatnaik,

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
    public function getRefKategoriDokumen(){
        return $this->hasOne(RefKategoriDokumen::className(), ['id' => 'kategori_dokumen']);
    }
}
