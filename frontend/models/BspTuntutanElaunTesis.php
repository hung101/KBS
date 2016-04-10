<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;
use app\models\general\Upload;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_bsp_tuntutan_elaun_tesis".
 *
 * @property integer $bsp_tuntutan_elaun_tesis_od
 * @property integer $bsp_pemohon_id
 * @property string $tarikh
 * @property string $tajuk_tesis
 */
class BspTuntutanElaunTesis extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_bsp_tuntutan_elaun_tesis';
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
            [['tarikh', 'tajuk_tesis'], 'required', 'skipOnEmpty' => true],
            [['bsp_pemohon_id'], 'integer'],
            [['tarikh'], 'safe'],
            [['tajuk_tesis'], 'string', 'max' => 90],
            [['muat_naik'],'validateFileUpload', 'skipOnEmpty' => false]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'bsp_tuntutan_elaun_tesis_od' => GeneralLabel::bsp_tuntutan_elaun_tesis_od,
            'bsp_pemohon_id' => GeneralLabel::bsp_pemohon_id,
            'tarikh' => GeneralLabel::tarikh,
            'tajuk_tesis' => GeneralLabel::tajuk_tesis,
            'muat_naik' => GeneralLabel::muat_naik,

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
