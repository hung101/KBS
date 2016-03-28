<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;
use app\models\general\Upload;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_akk_sijil_pertolongan_cemas".
 *
 * @property integer $akk_sijil_pertolongan_cemas_id
 * @property integer $akademi_akk_id
 * @property string $no_sijil
 * @property string $tahap
 * @property string $tahun
 * @property string $sijil
 * @property string $session_id
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created
 * @property string $updated
 */
class AkkSijilPertolonganCemas extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_akk_sijil_pertolongan_cemas';
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
            [['no_sijil', 'tahap', 'tahun'], 'required'],
            [['akademi_akk_id', 'created_by', 'updated_by'], 'integer'],
            [['tahun', 'created', 'updated'], 'safe'],
            [['no_sijil'], 'string', 'max' => 30],
            [['tahap'], 'string', 'max' => 80],
            [['sijil', 'session_id'], 'string', 'max' => 100],
            [['sijil'], 'validateFileUpload', 'skipOnEmpty' => false],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'akk_sijil_pertolongan_cemas_id' => 'Akk Sijil Pertolongan Cemas ID',
            'akademi_akk_id' => 'Akademi Akk ID',
            'no_sijil' => 'No Sijil',
            'tahap' => 'Tahap',
            'tahun' => 'Tahun',
            'sijil' => 'Sijil',
            'session_id' => 'Session ID',
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

        if(!$file && $this->$attribute==""){
            $this->addError($attribute, GeneralMessage::uploadEmptyError);
        }
    }
}
