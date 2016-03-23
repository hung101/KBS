<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;
use app\models\general\Upload;
use app\models\general\GeneralMessage;

use app\models\general\GeneralLabel;

/**
 * This is the model class for table "tbl_ltbs_penyata_kewangan".
 *
 * @property integer $penyata_kewangan_id
 * @property string $penyata_penerimaan_dan_pembayaran
 * @property string $penyata_pendapatan_dan_perbelanjaan
 * @property string $kunci_kira_kira
 */
class LtbsPenyataKewangan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_ltbs_penyata_kewangan';
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
            [['penyata_penerimaan_dan_pembayaran', 'penyata_pendapatan_dan_perbelanjaan', 'kunci_kira_kira'], 'string', 'max' => 100],
            [['profil_badan_sukan_id'], 'integer'],
            [['penyata_penerimaan_dan_pembayaran', 'penyata_pendapatan_dan_perbelanjaan', 'kunci_kira_kira'],'validateFileUpload', 'skipOnEmpty' => false],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'penyata_kewangan_id' => GeneralLabel::penyata_kewangan_id,
            'profil_badan_sukan_id' => GeneralLabel::profil_badan_sukan_id,
            'penyata_penerimaan_dan_pembayaran' => GeneralLabel::penyata_penerimaan_dan_pembayaran,
            'penyata_pendapatan_dan_perbelanjaan' => GeneralLabel::penyata_pendapatan_dan_perbelanjaan,
            'kunci_kira_kira' => GeneralLabel::kunci_kira_kira,

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
