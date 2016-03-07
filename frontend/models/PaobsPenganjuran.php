<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;
use app\models\general\Upload;
use app\models\general\GeneralMessage;

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
            [['nama_aktiviti', 'jenis_sukan', 'peringkat_sukan', 'tarikh_aktiviti', 'alamat_lokasi_1', 'alamat_lokasi_negeri', 'alamat_lokasi_bandar', 'alamat_lokasi_poskod', 'pemilik_lokasi', 'bilangan_peserta', 'kos_aktiviti'], 'required', 'skipOnEmpty' => true],
            [['tarikh_aktiviti'], 'safe'],
            [['bilangan_peserta', 'negara_peserta', 'peringkat_sukan'], 'integer'],
            [['kos_aktiviti'], 'number'],
            [['nama_aktiviti'], 'string', 'max' => 80],
            [['alamat_lokasi_1','alamat_lokasi_2','alamat_lokasi_3','jenis_sukan'], 'string', 'max' => 30],
            [['pemilik_lokasi'], 'string', 'max' => 90],
            [['sumber_kewangan'], 'string', 'max' => 100],
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
            'penganjuran_id' => 'Penganjuran ID',
            'nama_aktiviti' => 'Nama Aktiviti',
            'jenis_sukan' => 'Jenis Sukan',
            'peringkat_sukan' => 'Peringkat Sukan',
            'tarikh_aktiviti' => 'Tarikh Aktiviti',
            'alamat_lokasi_1' => 'Alamat Lokasi',
            'alamat_lokasi_2' => '',
            'alamat_lokasi_3' => '',
            'alamat_lokasi_negeri' => 'Negeri',
            'alamat_lokasi_bandar' => 'Bandar',
            'alamat_lokasi_poskod' => 'Poskod',
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
     * @return \yii\db\ActiveQuery
     */
    public function getRefSukan(){
        return $this->hasOne(RefSukan::className(), ['id' => 'jenis_sukan']);
    }
}
