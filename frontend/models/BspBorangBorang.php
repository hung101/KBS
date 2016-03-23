<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;
use app\models\general\Upload;
use app\models\general\GeneralMessage;

use app\models\general\GeneralLabel;

/**
 * This is the model class for table "tbl_bsp_borang_borang".
 *
 * @property integer $bsp_borang_borang_id
 * @property integer $bsp_pemohon_id
 * @property string $bsp_03
 * @property string $bsp_04
 * @property string $bsp_05
 * @property string $bsp_07
 * @property string $bsp_08
 * @property string $bsp_09
 * @property string $bsp_12
 * @property string $bsp_13
 * @property string $bsp_14
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created
 * @property string $updated
 */
class BspBorangBorang extends \yii\db\ActiveRecord
{
    public $bsp_06;
    public $bsp_10;
    public $bsp_11;
    
    /**
     * @inheritdoc
     */
    public static function tableName() 
    {
        return 'tbl_bsp_borang_borang';
    }

    public function behaviors()
    {
        return [
            'bedezign\yii2\audit\AuditTrailBehavior',
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bsp_pemohon_id', 'created_by', 'updated_by'], 'integer'],
            [['created', 'updated'], 'safe'],
            [['bsp_01', 'bsp_02', 'bsp_03', 'bsp_04', 'bsp_05', 'bsp_07', 'bsp_08', 'bsp_09', 'bsp_12', 'bsp_13', 'bsp_14'], 'string', 'max' => 255],
            [['bsp_03', 'bsp_04', 'bsp_05'],'validateFileUploadWithRequired', 'skipOnEmpty' => false],
            [['bsp_01', 'bsp_02', 'bsp_07', 'bsp_08', 'bsp_09', 'bsp_12', 'bsp_13', 'bsp_14'],'validateFileUpload', 'skipOnEmpty' => false],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'bsp_borang_borang_id' => GeneralLabel::bsp_borang_borang_id,
            'bsp_pemohon_id' => GeneralLabel::bsp_pemohon_id,
            'bsp_01' => GeneralLabel::bsp_01,
            'bsp_02' => GeneralLabel::bsp_02,
            'bsp_03' => GeneralLabel::bsp_03,
            'bsp_04' => GeneralLabel::bsp_04,
            'bsp_05' => GeneralLabel::bsp_05,
            'bsp_06' => GeneralLabel::bsp_06,
            'bsp_07' => GeneralLabel::bsp_07,
            'bsp_08' => GeneralLabel::bsp_08,
            'bsp_09' => GeneralLabel::bsp_09,
            'bsp_10' => GeneralLabel::bsp_10,
            'bsp_11' => GeneralLabel::bsp_11,
            'bsp_12' => GeneralLabel::bsp_12,
            'bsp_13' => GeneralLabel::bsp_13,
            'bsp_14' => GeneralLabel::bsp_14,
            'created_by' => GeneralLabel::created_by,
            'updated_by' => GeneralLabel::updated_by,
            'created' => GeneralLabel::created,
            'updated' => GeneralLabel::updated,

        ];
    }
    
    /**
     * Validate upload file cannot be empty
     */
    public function validateFileUploadWithRequired($attribute, $params){
        $file = UploadedFile::getInstance($this, $attribute);
        
        if($file && $file->getHasError()){
            $this->addError($attribute, 'File error :' . Upload::getUploadErrorDesc($file->error));
        }

        if(!$file && $this->$attribute==""){
            $this->addError($attribute, GeneralMessage::uploadEmptyError);
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
    }
}
