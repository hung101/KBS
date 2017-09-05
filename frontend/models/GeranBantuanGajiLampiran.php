<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;
use app\models\general\Upload;
use app\models\general\GeneralMessage;
use common\models\general\GeneralFunction;
use app\models\general\GeneralLabel;

class GeranBantuanGajiLampiran extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_geran_bantuan_gaji_lampiran';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
			[['nama_dokumen'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['geran_bantuan_gaji_id', 'created_by', 'updated_by', 'nama_dokumen'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['created', 'updated'], 'safe'],
            [['lampiran'], 'string', 'max' => 255, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['session_id'], 'string', 'max' => 100, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['lampiran'], 'validateFileUpload', 'skipOnEmpty' => false],
            [['nama_dokumen'], function ($attribute, $params) {
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
            'geran_bantuan_gaji_lampiran_id' => 'geran_bantuan_gaji_lampiran_id ID',
            'geran_bantuan_gaji_id' => 'Geran Bantuan Gaji ID',
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
    public function getRefDokumenGeranBantuanGaji(){
        return $this->hasOne(RefDokumenGeranBantuanGaji::className(), ['id' => 'nama_dokumen']);
    }
}
