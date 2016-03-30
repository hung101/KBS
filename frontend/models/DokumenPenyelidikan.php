<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;
use app\models\general\Upload;
use app\models\general\GeneralMessage;

use app\models\general\GeneralLabel;

/**
 * This is the model class for table "tbl_dokumen_penyelidikan".
 *
 * @property integer $dokumen_penyelidikan_id
 * @property integer $permohonana_penyelidikan_id
 * @property string $nama_dokumen
 * @property string $muat_naik
 */
class DokumenPenyelidikan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_dokumen_penyelidikan';
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
            [['nama_dokumen'], 'required', 'skipOnEmpty' => true],
            [['permohonana_penyelidikan_id'], 'integer'],
            [['nama_dokumen'], 'string', 'max' => 80],
            [['muat_naik'], 'string', 'max' => 100],
            [['muat_naik'], 'validateFileUpload', 'skipOnEmpty' => false],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'dokumen_penyelidikan_id' => GeneralLabel::dokumen_penyelidikan_id,
            'permohonana_penyelidikan_id' => GeneralLabel::permohonana_penyelidikan_id,
            'nama_dokumen' => GeneralLabel::nama_dokumen,
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

        if(!$file && $this->$attribute==""){
            $this->addError($attribute, GeneralMessage::uploadEmptyError);
        }
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefDokumenPenyelidikan(){
        return $this->hasOne(RefDokumenPenyelidikan::className(), ['id' => 'nama_dokumen']);
    }
}
