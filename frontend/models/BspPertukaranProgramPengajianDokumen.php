<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;
use app\models\general\Upload;
use app\models\general\GeneralMessage;
use common\models\general\GeneralFunction;
use app\models\general\GeneralLabel;

/**
 * This is the model class for table "tbl_bsp_pertukaran_program_pengajian_dokumen".
 *
 * @property integer $bsp_pertukaran_program_pengajian_dokumen_id
 * @property integer $bsp_pertukaran_program_pengajian_id
 * @property string $nama_dokumen
 * @property string $upload
 */
class BspPertukaranProgramPengajianDokumen extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_bsp_pertukaran_program_pengajian_dokumen';
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
            [['nama_dokumen'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['bsp_pertukaran_program_pengajian_id'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['nama_dokumen'], 'string', 'max' => 80, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['upload'], 'string', 'max' => 100, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['upload'], 'validateFileUpload', 'skipOnEmpty' => false],
            [['nama_dokumen'], 'filter', 'filter' => function ($value) {
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
            'bsp_pertukaran_program_pengajian_dokumen_id' => GeneralLabel::bsp_pertukaran_program_pengajian_dokumen_id,
            'bsp_pertukaran_program_pengajian_id' => GeneralLabel::bsp_pertukaran_program_pengajian_id,
            'nama_dokumen' => GeneralLabel::nama_dokumen,
            'upload' => GeneralLabel::upload,

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
}
