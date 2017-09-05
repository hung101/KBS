<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;
use app\models\general\Upload;
use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;
use common\models\general\GeneralFunction;

/**
 * This is the model class for table "tbl_kelayakan_sukan_spesifik_akk".
 *
 * @property integer $kelayakan_sukan_spesifik_akk_id
 * @property integer $akademi_akk_id
 * @property string $nama_kursus
 * @property string $tahap
 * @property string $tahun_lulus
 * @property string $persatuan_sukan
 */
class KelayakanSukanSpesifikAkk extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_kelayakan_sukan_spesifik_akk';
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
            [['nama_kursus', 'tahap', 'tahun_lulus', 'persatuan_sukan'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['akademi_akk_id'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['tahun_lulus'], 'safe'],
            [['nama_kursus', 'persatuan_sukan'], 'string', 'max' => 80, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['tahap'], 'string', 'max' => 30, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['muat_naik'],'validateFileUpload', 'skipOnEmpty' => false],
            [['nama_kursus', 'persatuan_sukan','tahap'], function ($attribute, $params) {
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
            'kelayakan_sukan_spesifik_akk_id' => GeneralLabel::kelayakan_sukan_spesifik_akk_id,
            'akademi_akk_id' => GeneralLabel::akademi_akk_id,
            'nama_kursus' => GeneralLabel::nama_kursus,
            'tahap' => GeneralLabel::tahap,
            'tahun_lulus' => GeneralLabel::tahun_lulus,
            'persatuan_sukan' => GeneralLabel::persatuan_sukan,
            'muat_naik' => GeneralLabel::muat_naik,
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
}
