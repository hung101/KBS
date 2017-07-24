<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;
use app\models\general\Upload;
use app\models\general\GeneralMessage;

use app\models\general\GeneralLabel;

/**
 * This is the model class for table "tbl_pemohon_kursus_tahap_akk".
 *
 * @property integer $pemohon_kursus_tahap_akk_id
 * @property integer $akademi_akk_id
 * @property string $tahap
 * @property string $tahun_lulus
 * @property string $no_sijil
 * @property string $kod_kursus
 * @property string $tempat
 * @property string $muatnaik_sijil
 */
class PemohonKursusTahapAkk extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_pemohon_kursus_tahap_akk';
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
            [['tahap', 'tahun_lulus', 'no_sijil', 'kod_kursus', 'tempat'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['akademi_akk_id'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['tahun_lulus'], 'safe'],
            [['tahap', 'no_sijil', 'kod_kursus'], 'string', 'max' => 30, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['tempat'], 'string', 'max' => 80, 'tooLong' => GeneralMessage::yii_validation_string_max],
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
            'pemohon_kursus_tahap_akk_id' => GeneralLabel::pemohon_kursus_tahap_akk_id,
            'akademi_akk_id' => GeneralLabel::akademi_akk_id,
            'tahap' => GeneralLabel::tahap,
            'tahun_lulus' => GeneralLabel::tahun_lulus,
            'no_sijil' => GeneralLabel::no_sijil,
            'kod_kursus' => GeneralLabel::kod_kursus,
            'tempat' => GeneralLabel::tempat,
            'muatnaik_sijil' => GeneralLabel::muatnaik_sijil,

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
    public function getRefTahapSainsSukan(){
        return $this->hasOne(RefTahapSainsSukan::className(), ['id' => 'tahap']);
    }
}
