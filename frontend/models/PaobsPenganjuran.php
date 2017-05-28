<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;
use app\models\general\Upload;
use app\models\general\GeneralMessage;

use app\models\general\GeneralLabel;

/**
 * This is the model class for table "tbl_paobs_penganjuran".
 *
 * @property integer $penganjuran_id
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
class PaobsPenganjuran extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_paobs_penganjuran';
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
            [['nama_aktiviti', 'jenis_sukan', 'peringkat_sukan', 'tarikh_aktiviti', 'alamat_lokasi_1', 'alamat_lokasi_negeri', 'alamat_lokasi_poskod', 'pemilik_lokasi', 'bilangan_peserta', 'kos_aktiviti'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['tarikh_aktiviti', 'tarikh_tamat_aktiviti', 'pengesahan'], 'safe'],
            [['bilangan_peserta', 'peringkat_sukan', 'alamat_lokasi_poskod', 'status'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['alamat_lokasi_poskod', 'alamat_lokasi_bandar'], 'string', 'max' => 5, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['kos_aktiviti'], 'number', 'message' => GeneralMessage::yii_validation_number],
            [['nama_aktiviti'], 'string', 'max' => 80, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['alamat_lokasi_1','alamat_lokasi_2','alamat_lokasi_3','jenis_sukan'], 'string', 'max' => 30, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['tempoh'], 'string', 'max' => 20, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['alamat_lokasi_1','alamat_lokasi_2','alamat_lokasi_3','jenis_sukan', 'negara_peserta', 'catatan'], 'string', 'max' => 255, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['pemilik_lokasi'], 'string', 'max' => 90, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['sumber_kewangan'], 'string', 'max' => 100, 'tooLong' => GeneralMessage::yii_validation_string_max],
            //[['laporan_penganjuran'], 'string', 'max' => 100],
            //[['surat_sokongan'], 'string', 'max' => 255],
            [['surat_sokongan', 'laporan_penganjuran'],'validateFileUpload', 'skipOnEmpty' => false],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'penganjuran_id' => GeneralLabel::penganjuran_id,
            'nama_aktiviti' => GeneralLabel::nama_aktiviti,
            'jenis_sukan' => GeneralLabel::jenis_sukan,
            'peringkat_sukan' => GeneralLabel::peringkat_sukan,
            'tarikh_aktiviti' => GeneralLabel::tarikh_mula_aktiviti,
            'alamat_lokasi_1' => GeneralLabel::alamat_lokasi_1,
            'alamat_lokasi_2' => GeneralLabel::alamat_lokasi_2,
            'alamat_lokasi_3' => GeneralLabel::alamat_lokasi_3,
            'alamat_lokasi_negeri' => GeneralLabel::alamat_lokasi_negeri,
            'alamat_lokasi_bandar' => GeneralLabel::alamat_lokasi_bandar,
            'alamat_lokasi_poskod' => GeneralLabel::alamat_lokasi_poskod,
            'pemilik_lokasi' => GeneralLabel::pemilik_lokasi,
            'bilangan_peserta' => GeneralLabel::bilangan_peserta,
            'negara_peserta' => GeneralLabel::negara_peserta,
            'kos_aktiviti' => GeneralLabel::kos_aktiviti,
            'sumber_kewangan' => GeneralLabel::sumber_kewangan,
            'surat_sokongan' => GeneralLabel::surat_sokongan,
            'laporan_penganjuran' => GeneralLabel::laporan_penganjuran,
            'tarikh_tamat_aktiviti' => GeneralLabel::tarikh_tamat_aktiviti,
            'tempoh' => GeneralLabel::tempoh,
            'status' => GeneralLabel::status,
            'pengesahan' => GeneralLabel::pengesahan_perakuan_maklumat_oleh_psk,
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
    public function getRefSukan(){
        return $this->hasOne(RefSukan::className(), ['id' => 'jenis_sukan']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefStatusLaporanMesyuaratAgung(){
        return $this->hasOne(RefStatusLaporanMesyuaratAgung::className(), ['id' => 'status']);
    }
}
