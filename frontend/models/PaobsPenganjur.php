<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;
use app\models\general\Upload;
use app\models\general\GeneralMessage;

use app\models\general\GeneralLabel;

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
            'penganjur_id' => GeneralLabel::penganjur_id,
            'penganjuran_id' => GeneralLabel::penganjuran_id,
            'profil_syarikat' => GeneralLabel::profil_syarikat,
            'nama_penganjur' => GeneralLabel::nama_penganjur,
            'no_pendaftaran_syarikat' => GeneralLabel::no_pendaftaran_syarikat,
            'tarikh_penubuhan_syarikat' => GeneralLabel::tarikh_penubuhan_syarikat,
            'sijil_pendaftaran' => GeneralLabel::sijil_pendaftaran,
            'alamat_penganjur_1' => GeneralLabel::alamat_penganjur_1,
            'alamat_penganjur_2' => GeneralLabel::alamat_penganjur_2,
            'alamat_penganjur_3' => GeneralLabel::alamat_penganjur_3,
            'alamat_penganjur_negeri' => GeneralLabel::alamat_penganjur_negeri,
            'alamat_penganjur_bandar' => GeneralLabel::alamat_penganjur_bandar,
            'alamat_penganjur_poskod' => GeneralLabel::alamat_penganjur_poskod,
            'no_telefon_penganjur' => GeneralLabel::no_telefon_penganjur,
            'no_faks_penganjur' => GeneralLabel::no_faks_penganjur,
            'emel_penganjur' => GeneralLabel::emel_penganjur,
            'kertas_cadangan_pelaksanaan' => GeneralLabel::kertas_cadangan_pelaksanaan,
            'nama_aktiviti' => GeneralLabel::nama_aktiviti,
            'jenis_sukan' => GeneralLabel::jenis_sukan,
            'tarikh_aktiviti' => GeneralLabel::tarikh_aktiviti,
            'alamat_lokasi' => GeneralLabel::alamat_lokasi,
            'pemilik_lokasi' => GeneralLabel::pemilik_lokasi,
            'bilangan_peserta' => GeneralLabel::bilangan_peserta,
            'negara_peserta' => GeneralLabel::negara_peserta,
            'kos_aktiviti' => GeneralLabel::kos_aktiviti,
            'sumber_kewangan' => GeneralLabel::sumber_kewangan,
            'surat_sokongan' => GeneralLabel::surat_sokongan,
            'laporan_penganjuran' => GeneralLabel::laporan_penganjuran,

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
