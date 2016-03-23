<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;
use app\models\general\Upload;
use app\models\general\GeneralMessage;

use app\models\general\GeneralLabel;

/**
 * This is the model class for table "tbl_informasi_permohonan".
 *
 * @property integer $informasi_permohonan_id
 * @property string $butiran_permohonan
 * @property string $amaun
 * @property string $muatnaik_dokumen
 */
class InformasiPermohonanProgramAntarabangsa extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_informasi_permohonan_program_antarabangsa';
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
            [['butiran_permohonan', 'amaun'], 'required', 'skipOnEmpty' => true],
            [['amaun'], 'number'],
            [['butiran_permohonan'], 'string', 'max' => 80],
            [['muatnaik_dokumen'], 'string', 'max' => 100],
            [['muatnaik_dokumen'], 'validateFileUpload', 'skipOnEmpty' => false],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'informasi_permohonan_id' => GeneralLabel::informasi_permohonan_id,
            'butiran_permohonan' => GeneralLabel::butiran_permohonan,
            'amaun' => GeneralLabel::amaun,
            'muatnaik_dokumen' => GeneralLabel::muatnaik_dokumen,

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

        if(!$file && $this->$attribute==""){
            $this->addError($attribute, GeneralMessage::uploadEmptyError);
        }
    }
}
