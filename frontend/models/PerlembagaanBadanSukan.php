<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;
use app\models\general\Upload;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_perlembagaan_badan_sukan".
 *
 * @property integer $perlembagaan_badan_sukan_id
 * @property string $tarikh_kelulusan_Terkini
 * @property string $bilangan_pindaan_perlembagaan_dilakukan
 * @property string $tarikh_pindaan
 * @property string $tarikh_kelulusan
 * @property string $muat_naik
 */
class PerlembagaanBadanSukan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_perlembagaan_badan_sukan';
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
            [['tarikh_kelulusan', 'status'], 'required', 'skipOnEmpty' => true],
            [['tarikh_kelulusan_Terkini', 'tarikh_pindaan', 'tarikh_kelulusan'], 'safe'],
            [['bilangan_pindaan_perlembagaan_dilakukan'], 'string', 'max' => 50],
            [['profil_badan_sukan_id', 'status'], 'integer'],
            //[['muat_naik'], 'string', 'max' => 100],
            [['muat_naik'],'validateFileUpload', 'skipOnEmpty' => false],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'perlembagaan_badan_sukan_id' => 'Perlembagaan Badan Sukan ID',
            'tarikh_kelulusan_Terkini' => 'Tarikh Kelulusan Terkini',
            'bilangan_pindaan_perlembagaan_dilakukan' => 'Bilangan Pindaan Perlembagaan Sebelum Ini',
            'tarikh_pindaan' => 'Tarikh Pindaan',
            'tarikh_kelulusan' => 'Tarikh Kelulusan',
            'muat_naik' => 'Muat Naik Perlembagaan Terkini',
            'status' => 'Status',
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
}
