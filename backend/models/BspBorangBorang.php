<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;
use app\models\general\Upload;
use app\models\general\GeneralMessage;
use common\models\general\GeneralFunction;

/**
 * This is the model class for table "tbl_bsp_borang_borang".
 *
 * @property integer $bsp_borang_borang_id
 * @property integer $bsp_pemohon_id
 * @property string $bsp_03
 * @property string $bsp_04
 * @property string $bsp_05
 * @property string $bsp_07
 * @property string $bsp_08
 * @property string $bsp_09
 * @property string $bsp_12
 * @property string $bsp_13
 * @property string $bsp_14
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created
 * @property string $updated
 */
class BspBorangBorang extends \yii\db\ActiveRecord
{
    public $bsp_06;
    public $bsp_10;
    public $bsp_11;
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_bsp_borang_borang';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bsp_pemohon_id', 'created_by', 'updated_by'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['created', 'updated'], 'safe'],
            [['bsp_01', 'bsp_02', 'bsp_03', 'bsp_04', 'bsp_05', 'bsp_07', 'bsp_08', 'bsp_09', 'bsp_12', 'bsp_13', 'bsp_14'], 'string', 'max' => 255, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['bsp_03', 'bsp_04', 'bsp_05'],'validateFileUploadWithRequired', 'skipOnEmpty' => false],
            [['bsp_01', 'bsp_02', 'bsp_07', 'bsp_08', 'bsp_09', 'bsp_12', 'bsp_13', 'bsp_14'],'validateFileUpload', 'skipOnEmpty' => false],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'bsp_borang_borang_id' => 'Bsp Borang Borang ID',
            'bsp_pemohon_id' => 'Bsp Pemohon ID',
            'bsp_01' => 'KBS/BSP-01 - Senarai Semak Dokumen Untuk Tawaran Biasiswa',
            'bsp_02' => 'KBS/BSP-02 - Borang Persetujuan Penerima Tawaran Biasiswa',
            'bsp_03' => 'KBS/BSP-03 - Maklumat Pelajar dan Penjamin 1 & Penjamin 2',
            'bsp_04' => 'KBS/BSP-04 - Borang Perakuan Kedudukan Kewangan Penjamin 1',
            'bsp_05' => 'KBS/BSP-05 - Borang Perakuan Kedudukan Kewangan Penjamin 2',
            'bsp_06' => 'KBS/BSP-06 - Borang Maklumat Terkini Prestasi Akademik/Sukan Mengikut Semester',
            'bsp_07' => 'KBS/BSP-07 - Borang Pengesahan Tuntutan Elaun Tesis',
            'bsp_08' => 'KBS/BSP-08 - Borang Tuntutan Elaun Latihan Praktikal',
            'bsp_09' => 'KBS/BSP-09 - Borang Laporan Kehadiran Praktikal',
            'bsp_10' => 'KBS/BSP-10 - Borang Permohonan Bayaran Tuntutan Elaun Perjalanan Udara',
            'bsp_11' => 'KBS/BSP-11 - Borang Permohonan Perlanjutan Biasiswa KBS',
            'bsp_12' => 'KBS/BSP-12 - Borang Permohonan Pertukaran Program Pengajian',
            'bsp_13' => 'KBS/BSP-13 - Borang Pengesahan Tamat Pengajian Penerima Biasiswa Sukan Persekutuan KBS',
            'bsp_14' => 'KBS/BSP-14 - Borang Perjanjian Biasiswa Sukan Persekutuan KBS',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created' => 'Created',
            'updated' => 'Updated',
        ];
    }
    
    /**
     * Validate upload file cannot be empty
     */
    public function validateFileUploadWithRequired($attribute, $params){
        $file = UploadedFile::getInstance($this, $attribute);
        
        if($file && $file->getHasError()){
            $this->addError($attribute, 'File error :' . Upload::getUploadErrorDesc($file->error));
        }
        
        if($file){
            if(!GeneralFunction::checkFileExtension($file->getExtension())){
                $this->addError($attribute, GeneralMessage::uploadFileTypeError);
            }
        }

        if(!$file && $this->$attribute==""){
            $this->addError($attribute, GeneralMessage::uploadEmptyError);
        }
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
