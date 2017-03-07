<?php

namespace app\models;

use Yii;
use app\models\general\GeneralVariable;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

use yii\web\UploadedFile;
use app\models\general\Upload;

/**
 * This is the model class for table "tbl_jurulatih_pendidikan".
 *
 * @property integer $jurulatih_pendidikan_id
 * @property integer $jurulatih_id
 * @property string $tahun
 * @property string $sekolah_kolej_universiti
 * @property string $gred
 */
class JurulatihPendidikan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_jurulatih_pendidikan';
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
            [['jurulatih_id', 'tahun', 'sekolah_kolej_universiti', 'gred', 'tahap_pendidikan'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['jurulatih_id'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            //[['tahun'], 'safe'],
            [['tahun'], 'integer','min'=>GeneralVariable::yearMin,'max'=>GeneralVariable::yearMax, 'message' => GeneralMessage::yii_validation_integer, 'tooBig' => GeneralMessage::yii_validation_integer_max, 'tooSmall' => GeneralMessage::yii_validation_integer_min],
            [['sekolah_kolej_universiti'], 'string', 'max' => 80, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['tahap_pendidikan'], 'string', 'max' => 30, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['gred', 'salinan_sijil'], 'string', 'max' => 255, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['salinan_sijil'], 'validateFileUpload', 'skipOnEmpty' => false],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'jurulatih_pendidikan_id' => GeneralLabel::jurulatih_pendidikan_id,
            'jurulatih_id' => GeneralLabel::jurulatih_id,
            'tahun' => GeneralLabel::tahun,
            'sekolah_kolej_universiti' => GeneralLabel::nama_institusi_sekolah,
            'gred' => GeneralLabel::pencapaian,
            'tahap_pendidikan' => GeneralLabel::tahap_pendidikan,
            'salinan_sijil' => GeneralLabel::salinan_sijil_pendidikan,
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
    public function getRefTahapPendidikan(){
        return $this->hasOne(RefTahapPendidikan::className(), ['id' => 'tahap_pendidikan']);
    }
}
