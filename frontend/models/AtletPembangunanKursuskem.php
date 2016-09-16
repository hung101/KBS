<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;
use app\models\general\Upload;
use app\models\general\GeneralMessage;
use app\models\general\GeneralLabel;

/**
 * This is the model class for table "tbl_atlet_pembangunan_kursuskem".
 *
 * @property integer $kursus_kem_id
 * @property integer $atlet_id
 * @property string $jenis
 * @property string $tarikh_mula
 * @property string $lokasi
 * @property string $nama_kursus_kem
 */
class AtletPembangunanKursuskem extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_atlet_pembangunan_kursuskem';
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
            [['atlet_id', 'tarikh_mula', 'tarikh_tamat', 'nama_kursus_kem', 'penganjur'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['atlet_id', 'pengurusan_program_binaan_id'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['tarikh_mula', 'jenis'], 'safe'],
            [['lokasi'], 'string', 'max' => 90, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['nama_kursus_kem'], 'string', 'max' => 40, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['muat_naik_sijil'],'validateFileUpload', 'skipOnEmpty' => false],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'kursus_kem_id' => GeneralLabel::kursus_kem_id,
            'atlet_id' => GeneralLabel::atlet_id,
            'jenis' => GeneralLabel::jenis,
            'tarikh_mula' => GeneralLabel::tarikh_mula,
            'tarikh_tamat' => GeneralLabel::tarikh_tamat,
            'lokasi' => GeneralLabel::lokasi,
            'nama_kursus_kem' => GeneralLabel::nama_kursus_kem,
            'penganjur' => GeneralLabel::penganjur,
            'muat_naik_sijil' => GeneralLabel::muat_naik_sijil,

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
    public function getRefJenisKursuskem(){
        return $this->hasOne(RefJenisKursuskem::className(), ['id' => 'jenis']);
    }
}
