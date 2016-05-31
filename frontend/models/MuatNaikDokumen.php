<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;
use app\models\general\Upload;
use app\models\general\GeneralMessage;

use app\models\general\GeneralLabel;

/**
 * This is the model class for table "tbl_muat_naik_dokumen".
 *
 * @property integer $muat_naik_dokumen_id
 * @property string $kategori_muat_naik
 * @property string $muat_naik_dokumen
 * @property string $tarikh_muat_naik
 */
class MuatNaikDokumen extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_muat_naik_dokumen';
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
            [['kategori_muat_naik', 'temasya', 'negeri', 'tarikh_mula', 'tarikh_tamat'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['tarikh_muat_naik', 'kategori_dokumen_nyatakan', 'tarikh_mula', 'tarikh_tamat'], 'safe'],
            [['kategori_muat_naik'], 'string', 'max' => 80, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['muat_naik_dokumen'], 'string', 'max' => 100, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['muat_naik_dokumen'], 'validateFileUpload', 'skipOnEmpty' => false],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'muat_naik_dokumen_id' => GeneralLabel::muat_naik_dokumen_id,
            'kategori_muat_naik' => GeneralLabel::kategori_dokumen,
            'muat_naik_dokumen' => GeneralLabel::muat_naik_dokumen,
            'tarikh_muat_naik' => GeneralLabel::tarikh_muat_naik,
            'temasya' => GeneralLabel::temasya,
            'negeri' => GeneralLabel::negeri,
            'kategori_dokumen_nyatakan' => 'Nyatakan Kategori Dokumen (Jika Lain-lain)',
            'tarikh_muat_naik' => GeneralLabel::tarikh_muat_naik,
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
    public function getRefKategoriMuatnaik(){
        return $this->hasOne(RefKategoriMuatnaik::className(), ['id' => 'kategori_muat_naik']);
    }
}
