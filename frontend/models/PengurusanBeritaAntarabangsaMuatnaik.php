<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;
use app\models\general\Upload;
use app\models\general\GeneralMessage;

use app\models\general\GeneralLabel;

/**
 * This is the model class for table "tbl_pengurusan_berita_antarabangsa_muatnaik".
 *
 * @property integer $pengurusan_berita_antarabangsa_muatnaik_id
 * @property integer $pengurusan_berita_antarabangsa_id
 * @property string $muatnaik
 * @property string $tarikh
 * @property string $session_id
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created
 * @property string $updated
 */
class PengurusanBeritaAntarabangsaMuatnaik extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_pengurusan_berita_antarabangsa_muatnaik';
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
            [['pengurusan_berita_antarabangsa_id', 'created_by', 'updated_by'], 'integer'],
            [['tarikh'], 'required'],
            [['tarikh', 'created', 'updated'], 'safe'],
            [['muatnaik'], 'string', 'max' => 255],
            [['session_id'], 'string', 'max' => 100],
            [['muatnaik'],'validateFileUpload', 'skipOnEmpty' => false],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pengurusan_berita_antarabangsa_muatnaik_id' => 'Pengurusan Berita Antarabangsa Muatnaik ID',
            'pengurusan_berita_antarabangsa_id' => 'Pengurusan Berita Antarabangsa ID',
            'muatnaik' => GeneralLabel::muatnaik,  //'Muatnaik',
            'tarikh' => GeneralLabel::tarikh,  //'Tarikh',
            'session_id' => 'Session ID',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created' => 'Created',
            'updated' => 'Updated',
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
}
