<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;
use app\models\general\Upload;
use app\models\general\GeneralMessage;
use app\models\general\GeneralLabel;
use common\models\general\GeneralFunction;

/**
 * This is the model class for table "tbl_bantuan_penganjuran_kursus_pegawai_teknikal_laporan".
 *
 * @property integer $bantuan_penganjuran_kursus_pegawai_teknikal_laporan_id
 * @property string $tarikh
 * @property string $tempat
 * @property string $tujuan_kursus_kejohanan
 * @property integer $bilangan_pasukan
 * @property integer $bilangan_peserta
 * @property integer $bilangan_pegawai_teknikal
 * @property integer $bilangan_pembantu
 * @property string $laporan_bergambar
 * @property string $penyata_perbelanjaan_resit_yang_telah_disahkan
 * @property string $jadual_keputusan_pertandingan
 * @property string $senarai_peserta
 * @property string $statistik_penyertaan
 * @property string $senarai_pegawai_penceramah
 * @property string $senarai_urusetia_sukarelawan
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created
 * @property string $updated
 */
class BantuanPenganjuranKursusPegawaiTeknikalLaporan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_bantuan_penganjuran_kursus_pegawai_teknikal_laporan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tarikh', 'tarikh_tamat', 'tempat', 'tujuan_kursus_kejohanan', 'bilangan_pasukan', 'bilangan_peserta', 'bilangan_pembantu', 
                'bilangan_pegawai_teknikal','bilangan_penceramah','bilangan_urusetia'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['tarikh', 'created', 'updated', 'tarikh_tamat'], 'safe'],
            [['bilangan_pasukan', 'bilangan_peserta', 'bilangan_pegawai_teknikal', 'bilangan_pembantu', 'created_by', 
                'updated_by', 'bantuan_penganjuran_kursus_pegawai_teknikal_id', 'bantuan_penyertaan_pegawai_teknikal_id', 'bantuan_penganjuran_kursus_id'
                ,'bilangan_penceramah','bilangan_urusetia'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['tempat'], 'string', 'max' => 90, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['tujuan_kursus_kejohanan'], 'string', 'max' => 80, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['bilangan_pasukan', 'bilangan_peserta', 'bilangan_pembantu','bilangan_pegawai_teknikal','bilangan_penceramah','bilangan_urusetia'], 'string', 'max' => 11, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['jumlah_kelulusan'], 'number', 'message' => GeneralMessage::yii_validation_number],
            [['laporan_bergambar', 'penyata_perbelanjaan_resit_yang_telah_disahkan', 'jadual_keputusan_pertandingan', 'senarai_peserta', 
                'statistik_penyertaan', 'senarai_pegawai_penceramah', 'senarai_urusetia_sukarelawan'], 'string', 'max' => 255, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['penyata_perbelanjaan_resit_yang_telah_disahkan'], 'validateFileUploadRequired', 'skipOnEmpty' => false],
            [['laporan_bergambar', 'jadual_keputusan_pertandingan', 'senarai_peserta', 
                'statistik_penyertaan', 'senarai_pegawai_penceramah', 'senarai_urusetia_sukarelawan'],'validateFileUpload', 'skipOnEmpty' => false],
            [['tempat','tujuan_kursus_kejohanan','bilangan_pasukan', 'bilangan_peserta', 'bilangan_pembantu','bilangan_pegawai_teknikal','bilangan_penceramah','bilangan_urusetia'], 'filter', 'filter' => function ($value) {
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
            'bantuan_penganjuran_kursus_pegawai_teknikal_laporan_id' => 'Bantuan Penganjuran Kursus Pegawai Teknikal Laporan ID',
            'tarikh' => 'Tarikh Mula',
            'tarikh_tamat' => 'Tarikh Tamat',
            'tempat' => 'Tempat',
            'tujuan_kursus_kejohanan' => 'Nama Kejohanan',
            'bilangan_pasukan' => 'Bilangan Pasukan',
            'bilangan_peserta' => 'Bilangan Peserta',
            'bilangan_pegawai_teknikal' => 'Bilangan Pegawai Teknikal',
            'bilangan_pembantu' => 'Bilangan Pembantu',
            'laporan_bergambar' => 'Laporan Bergambar',
            'penyata_perbelanjaan_resit_yang_telah_disahkan' => 'Penyata Perbelanjaan / Resit Yang Telah Disahkan',
            'jadual_keputusan_pertandingan' => 'Jadual & Keputusan Pertandingan',
            'senarai_peserta' => 'Senarai Peserta',
            'statistik_penyertaan' => 'Statistik Penyertaan',
            'senarai_pegawai_penceramah' => 'Senarai Pegawai Penceramah',
            'senarai_urusetia_sukarelawan' => 'Senarai Urusetia / Sukarelawan',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created' => 'Created',
            'updated' => 'Updated',
            'bilangan_penceramah' => 'Bilangan Penceramah',
            'bilangan_urusetia' => 'Bilangan Urusetia',
        ];
    }
    
    /**
     * Validate upload file cannot be empty
     */
    public function validateFileUploadRequired($attribute, $params){
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
