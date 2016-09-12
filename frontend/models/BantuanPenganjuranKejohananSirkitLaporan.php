<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;
use app\models\general\Upload;
use app\models\general\GeneralMessage;
use app\models\general\GeneralLabel;

/**
 * This is the model class for table "tbl_bantuan_penganjuran_kejohanan_laporan".
 *
 * @property integer $bantuan_penganjuran_kejohanan_laporan_id
 * @property integer $bantuan_penganjuran_kejohanan_id
 * @property string $tarikh
 * @property string $tempat
 * @property string $tujuan_penganjuran
 * @property integer $bilangan_pasukan
 * @property integer $bilangan_peserta
 * @property integer $bilangan_pegawai_teknikal
 * @property integer $bilangan_pembantu
 * @property string $laporan_bergambar
 * @property string $penyata_perbelanjaan_resit_yang_telah_disahkan
 * @property string $jadual_keputusan_pertandingan
 * @property string $senarai_pasukan
 * @property string $senarai_statistik_penyertaan
 * @property string $senarai_pegawai_pembantu_teknikal
 * @property string $senarai_urusetia_sukarelawan
 * @property string $senarai_pegawai_pembantu_perubatan
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created
 * @property string $updated
 */
class BantuanPenganjuranKejohananSirkitLaporan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_bantuan_penganjuran_kejohanan_sirkit_laporan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bantuan_penganjuran_kejohanan_id', 'bilangan_pasukan', 'bilangan_peserta', 'bilangan_pegawai_teknikal', 'bilangan_pembantu', 'created_by', 'updated_by'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['tarikh', 'tempat', 'tujuan_penganjuran', 'bilangan_pasukan', 'bilangan_peserta', 'bilangan_pegawai_teknikal', 'bilangan_pembantu'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['tarikh', 'created', 'updated'], 'safe'],
            [['tempat'], 'string', 'max' => 90, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['tujuan_penganjuran'], 'string', 'max' => 80, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['laporan_bergambar', 'penyata_perbelanjaan_resit_yang_telah_disahkan', 'jadual_keputusan_pertandingan', 'senarai_pasukan', 'senarai_statistik_penyertaan', 
                'senarai_pegawai_pembantu_teknikal', 'senarai_urusetia_sukarelawan', 'senarai_pegawai_pembantu_perubatan'], 'string', 'max' => 255, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['penyata_perbelanjaan_resit_yang_telah_disahkan'], 'validateFileUploadRequired', 'skipOnEmpty' => false],
            [['laporan_bergambar', 'jadual_keputusan_pertandingan', 'senarai_pasukan', 'senarai_statistik_penyertaan', 
                'senarai_pegawai_pembantu_teknikal', 'senarai_urusetia_sukarelawan', 'senarai_pegawai_pembantu_perubatan'],'validateFileUpload', 'skipOnEmpty' => false],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'bantuan_penganjuran_kejohanan_laporan_id' => 'Bantuan Penganjuran Kejohanan Laporan ID',
            'bantuan_penganjuran_kejohanan_id' => 'Bantuan Penganjuran Kejohanan ID',
            'tarikh' => 'Tarikh',
            'tempat' => 'Tempat',
            'tujuan_penganjuran' => 'Tujuan Penganjuran',
            'bilangan_pasukan' => 'Bilangan Pasukan',
            'bilangan_peserta' => 'Bilangan Peserta',
            'bilangan_pegawai_teknikal' => 'Bilangan Pegawai Teknikal',
            'bilangan_pembantu' => 'Bilangan Pembantu',
            'laporan_bergambar' => 'Laporan Bergambar',
            'penyata_perbelanjaan_resit_yang_telah_disahkan' => 'Penyata Perbelanjaan / Resit Yang Telah Disahkan',
            'jadual_keputusan_pertandingan' => 'Jadual & Keputusan Pertandingan',
            'senarai_pasukan' => 'Senarai Pasukan',
            'senarai_statistik_penyertaan' => 'Senarai Statistik Penyertaan',
            'senarai_pegawai_pembantu_teknikal' => 'Senarai Pegawai / Pembantu Teknikal',
            'senarai_urusetia_sukarelawan' => 'Senarai Urusetia / Sukarelawan',
            'senarai_pegawai_pembantu_perubatan' => 'Senarai Pegawai / Pembantu Perubatan',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created' => 'Created',
            'updated' => 'Updated',
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
    }
}
