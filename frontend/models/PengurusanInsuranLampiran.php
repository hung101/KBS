<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;
use app\models\general\Upload;
use app\models\general\GeneralMessage;

use app\models\general\GeneralLabel;

/**
 * This is the model class for table "tbl_pengurusan_insuran_lampiran".
 *
 * @property integer $pengurusan_insuran_lampiran_id
 * @property integer $pengurusan_insuran_id
 * @property string $lampiran
 * @property string $session_id
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created
 * @property string $updated
 */
class PengurusanInsuranLampiran extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_pengurusan_insuran_lampiran';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pengurusan_insuran_id', 'created_by', 'updated_by', 'nama_dokumen'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['created', 'updated'], 'safe'],
            [['lampiran'], 'string', 'max' => 255, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['session_id'], 'string', 'max' => 100, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['lampiran'], 'validateFileUpload', 'skipOnEmpty' => false],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pengurusan_insuran_lampiran_id' => 'Pengurusan Insuran Lampiran ID',
            'pengurusan_insuran_id' => 'Pengurusan Insuran ID',
            'lampiran' => GeneralLabel::lampiran,  //'Lampiran',
			'nama_dokumen' => GeneralLabel::nama_dokumen,
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
	
	/**
     * @return \yii\db\ActiveQuery
     */
    public function getRefDokumenPengurusanInsurans(){
        return $this->hasOne(RefDokumenPengurusanInsurans::className(), ['id' => 'nama_dokumen']);
    }
}
