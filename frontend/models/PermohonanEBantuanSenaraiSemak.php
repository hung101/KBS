<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;
use app\models\general\Upload;
use app\models\general\GeneralMessage;
use common\models\general\GeneralFunction;
use app\models\general\GeneralLabel;

/**
 * This is the model class for table "tbl_permohonan_e_bantuan_senarai_semak".
 *
 * @property integer $senarai_semak_id
 * @property integer $permohonan_e_bantuan_id
 * @property string $kertas_kerja_projek_program
 * @property string $salinan_sijil_pendaftaran_persatuan_pertubuhan
 * @property string $salinan_perlembagaan_persatuan_pertubuhan
 * @property string $salinan_buku_bank
 */
class PermohonanEBantuanSenaraiSemak extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_permohonan_e_bantuan_senarai_semak';
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
            [['kertas_kerja_projek_program','salinan_sijil_pendaftaran_persatuan_pertubuhan','salinan_perlembagaan_persatuan_pertubuhan','salinan_buku_bank'], 'validateFileUpload', 'skipOnEmpty' => false],
            [['permohonan_e_bantuan_id'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['kertas_kerja_projek_program', 'salinan_sijil_pendaftaran_persatuan_pertubuhan', 'salinan_perlembagaan_persatuan_pertubuhan', 'salinan_buku_bank'], 'string', 'max' => 100, 'tooLong' => GeneralMessage::yii_validation_string_max],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'senarai_semak_id' => GeneralLabel::senarai_semak_id,
            'permohonan_e_bantuan_id' => GeneralLabel::permohonan_e_bantuan_id,
            'kertas_kerja_projek_program' => GeneralLabel::kertas_kerja_projek_program,
            'salinan_sijil_pendaftaran_persatuan_pertubuhan' => GeneralLabel::salinan_sijil_pendaftaran_persatuan_pertubuhan,
            'salinan_perlembagaan_persatuan_pertubuhan' => GeneralLabel::salinan_perlembagaan_persatuan_pertubuhan,
            'salinan_buku_bank' => GeneralLabel::salinan_buku_bank,

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
