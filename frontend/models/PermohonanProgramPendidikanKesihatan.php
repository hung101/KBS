<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;
use app\models\general\Upload;
use app\models\general\GeneralMessage;

use app\models\general\GeneralLabel;

/**
 * This is the model class for table "tbl_permohonan_program_pendidikan_kesihatan".
 *
 * @property integer $permohonan_program_pendidikan_kesihatan_id
 * @property string $nama_program
 * @property string $tarikh_program
 * @property string $tempat_program
 * @property string $nama_pemohon
 * @property string $no_tel_pemohon
 * @property string $pegawai_bertugas
 * @property string $muat_naik
 * @property integer $kelulusan_ceo
 * @property integer $kelulusan_pbu
 */
class PermohonanProgramPendidikanKesihatan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_permohonan_program_pendidikan_kesihatan';
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
            //[['nama_program', 'tarikh_program', 'tempat_program', 'nama_pemohon', 'no_tel_pemohon', 'pegawai_bertugas', 'kelulusan_ceo', 'kelulusan_pbu'], 'required', 'skipOnEmpty' => true],
            [['tarikh_program'], 'safe'],
            [['kelulusan_ceo', 'kelulusan_pbu'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['nama_program', 'nama_pemohon', 'pegawai_bertugas'], 'string', 'max' => 80, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['tempat_program'], 'string', 'max' => 90, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['no_tel_pemohon'], 'string', 'max' => 14, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['muat_naik'], 'string', 'max' => 100, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['muat_naik'],'validateFileUpload', 'skipOnEmpty' => false]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'permohonan_program_pendidikan_kesihatan_id' => GeneralLabel::permohonan_program_pendidikan_kesihatan_id,
            'nama_program' => GeneralLabel::nama_program,
            'tarikh_program' => GeneralLabel::tarikh_program,
            'tempat_program' => GeneralLabel::tempat_program,
            'nama_pemohon' => GeneralLabel::nama_pemohon,
            'no_tel_pemohon' => GeneralLabel::no_tel_pemohon,
            'pegawai_bertugas' => GeneralLabel::pegawai_bertugas,
            'muat_naik' => GeneralLabel::muat_naik,
            'kelulusan_ceo' => GeneralLabel::kelulusan_ceo,
            'kelulusan_pbu' => GeneralLabel::kelulusan_pbu,

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
    public function getRefKelulusanCEO(){
        return $this->hasOne(RefKelulusan::className(), ['id' => 'kelulusan_ceo']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefKelulusanPBU(){
        return $this->hasOne(RefKelulusan::className(), ['id' => 'kelulusan_pbu']);
    }
}
