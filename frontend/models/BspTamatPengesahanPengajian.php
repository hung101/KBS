<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;
use app\models\general\Upload;

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
            [['nama_ipts', 'pengajian', 'bidang'], 'required', 'skipOnEmpty' => true],
            [['tarikh_tamat'], 'safe'],
            [['nama_ipts', 'pengajian', 'bidang'], 'string', 'max' => 80],
            [['cgpa_pngk'], 'string', 'max' => 30],
            [['muat_naik'],'validateFileUpload', 'skipOnEmpty' => false]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'bsp_tamat_pengesahan_pengajian_id' => 'Bsp Tamat Pengesahan Pengajian ID',
            'nama_ipts' => 'Nama IPT',
            'pengajian' => 'Pengajian',
            'bidang' => 'Bidang',
            'cgpa_pngk' => 'CGPA / PNGK',
            'tarikh_tamat' => 'Tarikh Tamat',
            'muat_naik' => 'Muat Naik (Surat Pengesahan Tamat Pengajian)',
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
