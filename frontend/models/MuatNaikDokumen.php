<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;
use app\models\general\Upload;
use app\models\general\GeneralMessage;

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
            [['kategori_muat_naik'], 'required', 'skipOnEmpty' => true],
            [['tarikh_muat_naik'], 'safe'],
            [['kategori_muat_naik'], 'string', 'max' => 80],
            [['muat_naik_dokumen'], 'string', 'max' => 100],
            [['muat_naik_dokumen'], 'validateFileUpload', 'skipOnEmpty' => false],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'muat_naik_dokumen_id' => 'Muat Naik Dokumen ID',
            'kategori_muat_naik' => 'Kategori Muat Naik',
            'muat_naik_dokumen' => 'Muat Naik Dokumen',
            'tarikh_muat_naik' => 'Tarikh Muat Naik',
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
