<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;
use app\models\general\Upload;
use app\models\general\GeneralMessage;
use common\models\general\GeneralFunction;
use app\models\general\GeneralLabel;

/**
 * This is the model class for table "tbl_elaporan_pelaksanaan_gambar".
 *
 * @property integer $elaporan_pelaksanaan_gambar_id
 * @property integer $elaporan_pelaksaan_id
 * @property string $muat_naik_gambar
 * @property string $tajuk
 */
class ElaporanPelaksanaanGambar extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_elaporan_pelaksanaan_gambar';
    }
    
    public function behaviors()
    {
        return [
            //'bedezign\yii2\audit\AuditTrailBehavior',
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
            [['tajuk'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['elaporan_pelaksaan_id'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['tajuk'], 'string', 'max' => 100, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['muat_naik_gambar'], 'validateFileUpload', 'skipOnEmpty' => false],
            [['muat_naik_gambar'], 'file', 'extensions'=>'jpg, png', 'maxSize' => 1024 * 1024 * 3],
            [['tajuk'], function ($attribute, $params) {
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
            'elaporan_pelaksanaan_gambar_id' => GeneralLabel::elaporan_pelaksanaan_gambar_id,
            'elaporan_pelaksaan_id' => GeneralLabel::elaporan_pelaksaan_id,
            'muat_naik_gambar' => GeneralLabel::muat_naik_gambar,
            'tajuk' => GeneralLabel::tajuk,
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
