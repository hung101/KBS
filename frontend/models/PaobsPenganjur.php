<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;
use app\models\general\Upload;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_paobs_penganjur".
 *
 * @property integer $penganjur_id
 * @property integer $penganjuran_id
 * @property string $profil_syarikat
 * @property string $nama_penganjur
 * @property string $no_pendaftaran_syarikat
 * @property string $tarikh_penubuhan_syarikat
 * @property string $sijil_pendaftaran
 * @property string $alamat_penganjur
 * @property integer $no_telefon_penganjur
 * @property integer $no_faks_penganjur
 * @property string $emel_penganjur
 * @property string $kertas_cadangan_pelaksanaan
 * @property string $nama_aktiviti
 * @property string $jenis_sukan
 * @property string $tarikh_aktiviti
 * @property string $alamat_lokasi
 * @property string $pemilik_lokasi
 * @property integer $bilangan_peserta
 * @property integer $negara_peserta
 * @property string $kos_aktiviti
 * @property string $sumber_kewangan
 * @property string $surat_sokongan
 * @property string $laporan_penganjuran
 */
class PaobsPenganjur extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName() 
    {
        return 'tbl_paobs_penganjur';
    }

    public function behaviors()
    {
        return [
            'bedezign\yii2\audit\AuditTrailBehavior',
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nama_penganjur', 'no_pendaftaran_syarikat', 'tarikh_penubuhan_syarikat', 'alamat_penganjur_1', 'alamat_penganjur_negeri', 'alamat_penganjur_bandar', 'alamat_penganjur_poskod', 'no_telefon_penganjur', 'nama_aktiviti', 'jenis_sukan', 'tarikh_aktiviti', 'alamat_lokasi', 'bilangan_peserta', 'kos_aktiviti'], 'required', 'skipOnEmpty' => true],
            [['penganjuran_id', 'no_telefon_penganjur', 'no_faks_penganjur', 'bilangan_peserta', 'negara_peserta'], 'integer'],
            [['tarikh_penubuhan_syarikat', 'tarikh_aktiviti'], 'safe'],
            [['kos_aktiviti', 'sumber_kewangan'], 'number'],
            [['profil_syarikat', 'surat_sokongan'], 'string', 'max' => 255],
            [['nama_penganjur', 'nama_aktiviti'], 'string', 'max' => 80],
            [['no_pendaftaran_syarikat', 'jenis_sukan', 'alamat_penganjur_1', 'alamat_penganjur_2', 'alamat_penganjur_3'], 'string', 'max' => 30],
            [['sijil_pendaftaran', 'emel_penganjur', 'kertas_cadangan_pelaksanaan', 'laporan_penganjuran'], 'string', 'max' => 100],
            [['alamat_lokasi', 'pemilik_lokasi'], 'string', 'max' => 90],
            [['surat_sokongan', 'laporan_penganjuran', 'kertas_cadangan_pelaksanaan'],'validateFileUpload', 'skipOnEmpty' => false],
            [['sijil_pendaftaran'],'validateFileUploadWithRequired', 'skipOnEmpty' => false],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'penganjur_id' => 'Penganjur ID',
            'penganjuran_id' => 'Penganjuran ID',
            'profil_syarikat' => 'Profil Syarikat/Badan Sukan',
            'nama_penganjur' => 'Nama Penganjur',
            'no_pendaftaran_syarikat' => 'No Pendaftaran Syarikat/Badan Sukan',
            'tarikh_penubuhan_syarikat' => 'Tarikh Penubuhan Syarikat/Badan Sukan',
            'sijil_pendaftaran' => 'Sijil Pendaftaran',
            'alamat_penganjur_1' => 'Alamat Penganjur',
            'alamat_penganjur_2' => '',
            'alamat_penganjur_3' => '',
            'alamat_penganjur_negeri' => 'Negeri',
            'alamat_penganjur_bandar' => 'Bandar',
            'alamat_penganjur_poskod' => 'Poskod',
            'no_telefon_penganjur' => 'No Telefon Penganjur',
            'no_faks_penganjur' => 'No Faks Penganjur',
            'emel_penganjur' => 'Emel Penganjur',
            'kertas_cadangan_pelaksanaan' => 'Kertas Cadangan Pelaksanaan',
            'nama_aktiviti' => 'Nama Aktiviti',
            'jenis_sukan' => 'Jenis Sukan',
            'tarikh_aktiviti' => 'Tarikh Aktiviti',
            'alamat_lokasi' => 'Alamat Lokasi',
            'pemilik_lokasi' => 'Pemilik Lokasi',
            'bilangan_peserta' => 'Bilangan Peserta',
            'negara_peserta' => 'Negara Peserta',
            'kos_aktiviti' => 'Kos Aktiviti',
            'sumber_kewangan' => 'Sumber Kewangan',
            'surat_sokongan' => 'Surat Sokongan/Sanksi Dari Badan Antarabangsa',
            'laporan_penganjuran' => 'Laporan Penganjuran',
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
     * Validate upload file cannot be empty
     */
    public function validateFileUploadWithRequired($attribute, $params){
        $file = UploadedFile::getInstance($this, $attribute);
        
        if($file && $file->getHasError()){
            $this->addError($attribute, 'File error :' . Upload::getUploadErrorDesc($file->error));
        }

        if(!$file && $this->$attribute==""){
            $this->addError($attribute, GeneralMessage::uploadEmptyError);
        }
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefSukan(){
        return $this->hasOne(RefSukan::className(), ['id' => 'jenis_sukan']);
    }
}
