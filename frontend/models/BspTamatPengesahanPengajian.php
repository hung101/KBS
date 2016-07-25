<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;
use app\models\general\Upload;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_bsp_tamat_pengesahan_pengajian".
 *
 * @property integer $bsp_tamat_pengesahan_pengajian_id
 * @property string $nama_ipts
 * @property string $pengajian
 * @property string $bidang
 * @property string $cgpa_pngk
 * @property string $tarikh_tamat
 */
class BspTamatPengesahanPengajian extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_bsp_tamat_pengesahan_pengajian';
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
            [['nama_ipts', 'pengajian', 'bidang', 'nama_pelajar'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['tarikh_tamat'], 'safe'],
            [['nama_ipts', 'pengajian', 'bidang', 'nama_pelajar'], 'string', 'max' => 80, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['cgpa_pngk'], 'string', 'max' => 30, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['cgpa_pngk'], 'number', 'message' => GeneralMessage::yii_validation_number],
            [['muat_naik'],'validateFileUpload', 'skipOnEmpty' => false]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'bsp_tamat_pengesahan_pengajian_id' => GeneralLabel::bsp_tamat_pengesahan_pengajian_id,
            'nama_ipts' => GeneralLabel::nama_ipts,
            'pengajian' => GeneralLabel::pengajian,
            'bidang' => GeneralLabel::bidang,
            'cgpa_pngk' => GeneralLabel::cgpa_pngk,
            'tarikh_tamat' => GeneralLabel::tarikh_tamat,
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
    public function getRefPengajianEBiasiswa(){
        return $this->hasOne(RefPengajianEBiasiswa::className(), ['id' => 'pengajian']);
    }
}
