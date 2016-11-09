<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;
use app\models\general\Upload;
use app\models\general\GeneralMessage;

use app\models\general\GeneralLabel;

/**
 * This is the model class for table "tbl_jurulatih_spkk".
 *
 * @property integer $jurulatih_spkk_id
 * @property integer $jurulatih_id
 * @property string $jenis_spkk
 * @property string $tahap
 * @property string $muatnaik_sijil
 */
class JurulatihSpkk extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_jurulatih_spkk';
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
            [['jurulatih_id', 'tahap', 'jenis_spkk'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['jurulatih_id', 'sukan'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['jenis_spkk', 'tahap', 'no_sijil', 'kod_kursus'], 'string', 'max' => 30, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['muatnaik_sijil'], 'string', 'max' => 100, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['muatnaik_sijil'], 'validateFileUpload', 'skipOnEmpty' => false],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'jurulatih_spkk_id' => GeneralLabel::jurulatih_spkk_id,
            'jurulatih_id' => GeneralLabel::jurulatih_id,
            'jenis_spkk' => GeneralLabel::sijil,
            'tahap' => GeneralLabel::tahap,
            'sukan' => GeneralLabel::sukan,
            'muatnaik_sijil' => GeneralLabel::muatnaik_sijil,
            'no_sijil' => GeneralLabel::no_sijil,
            'kod_kursus' => GeneralLabel::kod_kursus,
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
    public function getRefJenisSijilKelayakanJurulatih(){
        return $this->hasOne(RefJenisSijilKelayakanJurulatih::className(), ['id' => 'jenis_spkk']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefTahapKelayakanJurulatih(){
        return $this->hasOne(RefTahapKelayakanJurulatih::className(), ['id' => 'tahap']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefSukan(){
        return $this->hasOne(RefSukan::className(), ['id' => 'sukan']);
    }
}
