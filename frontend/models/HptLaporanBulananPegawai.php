<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;
use app\models\general\Upload;
use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;
use common\models\general\GeneralFunction;

/**
 * This is the model class for table "tbl_hpt_laporan_bulanan_pegawai".
 *
 * @property integer $hpt_laporan_bulanan_pegawai_id
 * @property string $nama_pegawai
 * @property string $bahagian_pusat_unit
 * @property string $tajuk_laporan
 * @property string $tarikh
 * @property string $perkara
 * @property string $catatan
 * @property string $muat_naik
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created
 * @property string $updated
 */
class HptLaporanBulananPegawai extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_hpt_laporan_bulanan_pegawai';
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
            [['nama_pegawai', 'tajuk_laporan', 'perkara', 'tarikh'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['tarikh', 'created', 'updated'], 'safe'],
            [['created_by', 'updated_by'], 'integer', 'message' => GeneralMessage::yii_validation_number],
            [['nama_pegawai', 'bahagian_pusat_unit', 'tajuk_laporan', 'perkara'], 'string', 'max' => 80, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['catatan'], 'string', 'max' => 255, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['muat_naik'], 'string', 'max' => 100, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['muat_naik'],'validateFileUpload', 'skipOnEmpty' => false],
            [['nama_pegawai', 'bahagian_pusat_unit', 'tajuk_laporan', 'perkara','catatan'], 'filter', 'filter' => function ($value) {
                return  \common\models\general\GeneralFunction::filterXSS($value);
            }],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'hpt_laporan_bulanan_pegawai_id' => 'Hpt Laporan Bulanan Pegawai ID',
            'nama_pegawai' => GeneralLabel::nama_pegawai,
            'bahagian_pusat_unit' => GeneralLabel::bahagian_pusat_unit,
            'tajuk_laporan' => GeneralLabel::tajuk_laporan,
            'tarikh' => GeneralLabel::tarikh,
            'perkara' => GeneralLabel::perkara,
            'catatan' => GeneralLabel::catatan,
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
        
        if($file){
            if(!GeneralFunction::checkFileExtension($file->getExtension())){
                $this->addError($attribute, GeneralMessage::uploadFileTypeError);
            }
        }
    }
}
