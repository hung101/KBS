<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;
use app\models\general\Upload;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_bsp_prestasi_akademik".
 *
 * @property integer $bsp_prestasi_akademik_id
 * @property integer $bsp_pemohon_id
 * @property string $tarikh
 * @property string $png
 * @property string $pngk
 */
class BspPrestasiAkademik extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_bsp_prestasi_akademik';
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
            [['tarikh', 'png', 'pngk'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['bsp_pemohon_id', 'bsp_borang_borang_id', 'semester'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['tarikh'], 'safe'],
            [['png', 'pngk'], 'number', 'message' => GeneralMessage::yii_validation_number],
            [['muat_naik'],'validateFileUpload', 'skipOnEmpty' => false]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'bsp_prestasi_akademik_id' => GeneralLabel::bsp_prestasi_akademik_id,
            'bsp_pemohon_id' => GeneralLabel::bsp_pemohon_id,
            'tarikh' => GeneralLabel::tarikh,
            'semester' => GeneralLabel::semester,
            'png' => GeneralLabel::png,
            'pngk' => GeneralLabel::pngk,
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
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefSemesterTerkini(){
        return $this->hasOne(RefSemesterTerkini::className(), ['id' => 'semester']);
    }
}
