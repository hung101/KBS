<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;
use app\models\general\Upload;
use app\models\general\GeneralMessage;
use common\models\general\GeneralFunction;
use app\models\general\GeneralLabel;

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
            [['tarikh_kelulusan', 'status'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['tarikh_kelulusan_Terkini', 'tarikh_pindaan', 'tarikh_kelulusan', 'pengesahan'], 'safe'],
            [['bilangan_pindaan_perlembagaan_dilakukan'], 'string', 'max' => 50, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['profil_badan_sukan_id', 'status'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            //[['muat_naik'], 'string', 'max' => 100, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['muat_naik'],'validateFileUpload', 'skipOnEmpty' => false],
            [['bilangan_pindaan_perlembagaan_dilakukan'], function ($attribute, $params) {
                if (!\common\models\general\GeneralFunction::validateXSS($this->$attribute)) {
                    $this->addError($attribute, GeneralMessage::yii_validation_xss);
                }
            }],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'perlembagaan_badan_sukan_id' => GeneralLabel::perlembagaan_badan_sukan_id,
            'tarikh_kelulusan_Terkini' => GeneralLabel::tarikh_kelulusan_Terkini,
            'bilangan_pindaan_perlembagaan_dilakukan' => GeneralLabel::bilangan_pindaan_perlembagaan_dilakukan,
            'tarikh_pindaan' => GeneralLabel::tarikh_pindaan,
            'tarikh_kelulusan' => GeneralLabel::tarikh_kelulusan,
            'muat_naik' => GeneralLabel::muat_naik,
            'pengesahan' => GeneralLabel::pengesahan_perakuan_maklumat_oleh_psk,
            'status' => GeneralLabel::status,

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
        
        if($file){
            if(!GeneralFunction::checkFileExtension($file->getExtension())){
                $this->addError($attribute, GeneralMessage::uploadFileTypeError);
            }
        }
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefStatusLaporanMesyuaratAgung(){
        return $this->hasOne(RefStatusLaporanMesyuaratAgung::className(), ['id' => 'status']);
    }
}
