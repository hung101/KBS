<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;
use app\models\general\Upload;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_perancangan_program".
 *
 * @property integer $perancangan_program_id
 * @property string $tarikh_mula
 * @property string $nama_program
 * @property string $muat_naik
 */
class PerancanganProgram extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_perancangan_program';
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
            [['tarikh_mula', 'tarikh_tamat', 'jenis_program', 'nama_program'], 'required', 'skipOnEmpty' => true],
            [['tarikh_mula', 'tarikh_tamat'], 'safe'],
            [['nama_program'], 'string', 'max' => 80],
            [['lokasi'], 'string', 'max' => 90],
            [['muat_naik'], 'string', 'max' => 100],
            [['muat_naik'],'validateFileUpload', 'skipOnEmpty' => false],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'perancangan_program_id' => 'Perancangan Program ID',
            'tarikh_mula' => 'Tarikh Mula',
            'tarikh_tamat' => 'Tarikh Akhir',
            'nama_program' => 'Nama Program',
            'jenis_program' => 'Jenis Program',
            'lokasi' => 'Lokasi',
            'muat_naik' => 'Muat Naik',
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
    }
}
