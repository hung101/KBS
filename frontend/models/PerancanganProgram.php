<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;
use app\models\general\Upload;
use app\models\general\GeneralMessage;

use app\models\general\GeneralLabel;

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
            [['tarikh_mula', 'tarikh_tamat', 'jenis_program', 'nama_program', 'bahagian', 'jenis_aktiviti', 'status_program'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['tarikh_mula', 'tarikh_tamat', 'tarikh_kelulusan', 'status_program', 'sukan'], 'safe'],
            [['mesyuarat_id'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['nama_program'], 'string', 'max' => 80, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['kelulusan'], 'string', 'max' => 50, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['lokasi'], 'string', 'max' => 90, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['muat_naik'], 'string', 'max' => 100, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['catatan'], 'string', 'max' => 255, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['muat_naik'],'validateFileUpload', 'skipOnEmpty' => false],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'perancangan_program_id' => GeneralLabel::perancangan_program_id,
            'tarikh_mula' => GeneralLabel::tarikh_mula,
            'tarikh_tamat' => GeneralLabel::tarikh_tamat,
            'nama_program' => GeneralLabel::kejohanan_pendedahan_latihan,
            'jenis_program' => GeneralLabel::program,
            'lokasi' => GeneralLabel::tempat,
            'muat_naik' => GeneralLabel::muat_naik,
            'bahagian' => GeneralLabel::bahagian,
            'cawangan' => GeneralLabel::cawangan,
            'jenis_aktiviti' => GeneralLabel::jenis_aktiviti,
            'tarikh_kelulusan' => GeneralLabel::tarikh_kelulusan,
            'kelulusan' => GeneralLabel::kelulusan,
            'status_program' => GeneralLabel::status_kelulusan,
            'sukan' => GeneralLabel::sukan,
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
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefStatusProgram(){
        return $this->hasOne(RefStatusProgram::className(), ['id' => 'status_program']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefSukan(){
        return $this->hasOne(RefSukan::className(), ['id' => 'sukan']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefProgramSemasaSukanAtlet(){
        return $this->hasOne(RefProgramSemasaSukanAtlet::className(), ['id' => 'jenis_program']);
    }
}
