<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;
use app\models\general\Upload;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_six_step".
 *
 * @property integer $six_step_id
 * @property integer $atlet_id
 * @property string $stage
 * @property string $status
 */
class SixStepSuaianFizikal extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_six_step_suaian_fizikal';
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
            [['atlet_id', 'stage', 'status'], 'required', 'skipOnEmpty' => true],
            [['atlet_id', 'kategori_atlet', 'sukan', 'acara'], 'integer'],
            [['stage', 'status'], 'string', 'max' => 30],
            [['muat_naik'],'validateFileUpload', 'skipOnEmpty' => false]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'six_step_id' => 'Six Step ID',
            'atlet_id' => 'Atlet',
            'kategori_atlet' => 'Kategori Atlet',
            'sukan' => 'Sukan',
            'acara' => 'Acara',
            'stage' => 'Stage',
            'status' => 'Status',
            'muat_naik' => 'Muat Naik',
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
    public function getAtlet(){
        return $this->hasOne(Atlet::className(), ['atlet_id' => 'atlet_id']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefSixstepSuaianFizikalStage(){
        return $this->hasOne(RefSixstepSuaianFizikalStage::className(), ['id' => 'stage']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefSixstepSuaianFizikalStatus(){
        return $this->hasOne(RefSixstepSuaianFizikalStatus::className(), ['id' => 'status']);
    }
}
