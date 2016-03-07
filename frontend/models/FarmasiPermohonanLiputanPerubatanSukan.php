<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;
use app\models\general\Upload;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_farmasi_permohonan_liputan_perubatan_sukan".
 *
 * @property integer $permohonan_liputan_perubatan_sukan_id
 * @property string $nama_program
 * @property string $tarikh_program
 * @property string $tempat_program
 * @property string $nama_pemohon
 * @property string $no_tel_pemohon
 * @property string $pegawai_bertugas
 * @property string $muat_naik
 * @property integer $kelulusan_ceo
 * @property integer $kelulusan_pbu
 */
class FarmasiPermohonanLiputanPerubatanSukan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_farmasi_permohonan_liputan_perubatan_sukan';
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
            [['nama_program', 'tarikh_program', 'tempat_program', 'nama_pemohon', 'no_tel_pemohon', 'pegawai_bertugas', 'kelulusan_ceo', 'kelulusan_pbu'], 'required', 'skipOnEmpty' => true],
            [['tarikh_program'], 'safe'],
            [['kelulusan_ceo', 'kelulusan_pbu'], 'integer'],
            [['nama_program', 'nama_pemohon', 'pegawai_bertugas'], 'string', 'max' => 80],
            [['tempat_program'], 'string', 'max' => 90],
            [['no_tel_pemohon'], 'string', 'max' => 14],
            [['muat_naik'], 'string', 'max' => 100],
            [['muat_naik'],'validateFileUpload', 'skipOnEmpty' => false]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'permohonan_liputan_perubatan_sukan_id' => 'Permohonan Liputan Perubatan Sukan ID',
            'nama_program' => 'Nama Program',
            'tarikh_program' => 'Tarikh Program',
            'tempat_program' => 'Tempat Program',
            'nama_pemohon' => 'Nama Pemohon',
            'no_tel_pemohon' => 'No Tel Pemohon',
            'pegawai_bertugas' => 'Pegawai Bertugas',
            'muat_naik' => 'Muat Naik',
            'kelulusan_ceo' => 'Kelulusan CEO',
            'kelulusan_pbu' => 'Kelulusan PBU',
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
    public function getRefKelulusanCEO(){
        return $this->hasOne(RefKelulusan::className(), ['id' => 'kelulusan_ceo']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefKelulusanPBU(){
        return $this->hasOne(RefKelulusan::className(), ['id' => 'kelulusan_pbu']);
    }
}
