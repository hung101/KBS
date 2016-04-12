<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;
use app\models\general\Upload;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_admin_e_biasiswa".
 *
 * @property integer $admin_e_biasiswa_id
 * @property string $nama
 * @property string $tarikh_mula
 * @property string $tarikh_tamat
 * @property integer $aktif
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created
 * @property string $updated
 */
class AdminEBiasiswa extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_admin_e_biasiswa';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['aktif', 'nama', 'tarikh_mula', 'tarikh_tamat', 'tarikh_semakan_panggilan_temuduga', 'tarikh_semakan_keputusan_temuduga', 'tawaran_biasiswa_tarikh_masa', 'tawaran_biasiswa_tempat'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['tarikh_mula', 'tarikh_tamat', 'created', 'updated'], 'safe'],
            [['aktif', 'created_by', 'updated_by'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['nama'], 'string', 'max' => 80, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['muat_naik_syarat_kelayakan'], 'validateFileUpload', 'skipOnEmpty' => false],
            //[['tarikh_mula'], 'compare', 'compareAttribute'=>'tarikh_tamat', 'operator'=>'<=', 'skipOnEmpty'=>true],
            [['tarikh_tamat'], 'compare', 'compareAttribute'=>'tarikh_mula', 'operator'=>'>=', 'message' => GeneralMessage::yii_validation_compare],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'admin_e_biasiswa_id' => 'Admin E Biasiswa ID',
            'nama' => 'Nama Sesi',
            'tarikh_mula' => 'Tarikh Mula',
            'tarikh_tamat' => 'Tarikh Tamat',
            'aktif' => 'Aktif',
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
