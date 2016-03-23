<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;
use app\models\general\Upload;
use app\models\general\GeneralMessage;

use app\models\general\GeneralLabel;

/**
 * This is the model class for table "tbl_pengurusan_berita_antarabangsa".
 *
 * @property integer $pengurusan_berita_antarabangsa_id
 * @property string $kategori_berita
 * @property string $nama_berita
 * @property string $tarikh_berita
 * @property string $muatnaik
 */
class PengurusanBeritaAntarabangsa extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_pengurusan_berita_antarabangsa';
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
            [['kategori_berita', 'nama_berita', 'tarikh_berita'], 'required', 'skipOnEmpty' => true],
            [['tarikh_berita'], 'safe'],
            [['kategori_berita', 'nama_berita'], 'string', 'max' => 80],
            [['muatnaik'], 'string', 'max' => 100],
            [['muatnaik'],'validateFileUpload', 'skipOnEmpty' => false],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pengurusan_berita_antarabangsa_id' => GeneralLabel::pengurusan_berita_antarabangsa_id,
            'kategori_berita' => GeneralLabel::kategori_berita,
            'nama_berita' => GeneralLabel::nama_berita,
            'tarikh_berita' => GeneralLabel::tarikh_berita,
            'muatnaik' => GeneralLabel::muatnaik,

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
    public function getRefKategoriBerita(){
        return $this->hasOne(RefKategoriBerita::className(), ['id' => 'kategori_berita']);
    }
}
