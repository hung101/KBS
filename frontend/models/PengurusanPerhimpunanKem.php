<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;
use app\models\general\Upload;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_pengurusan_perhimpunan_kem".
 *
 * @property integer $pengurusan_perhimpunan_kem_id
 * @property string $nama_ppn
 * @property string $pengurus_pn
 * @property string $nama_penganjuran
 * @property string $kategori_penganjuran
 * @property string $sub_kategori_penganjuran
 * @property string $tahap_penganjuran
 * @property string $negeri
 * @property string $kategori_sukan
 * @property string $tarikh_penganjuran
 * @property string $activiti
 * @property string $tempat
 * @property integer $jumlah_peserta
 * @property integer $sokongan_pn
 * @property integer $kelulusan
 */
class PengurusanPerhimpunanKem extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_pengurusan_perhimpunan_kem';
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
            [['nama_ppn', 'pengurus_pn', 'nama_penganjuran', 'kategori_penganjuran', 'sub_kategori_penganjuran', 'tahap_penganjuran', 'negeri', 'kategori_sukan', 'tarikh_penganjuran', 'activiti', 'tempat', 'jumlah_peserta', 'sokongan_pn', 'kelulusan'], 'required', 'skipOnEmpty' => true],
            [['tarikh_penganjuran', 'kategori_geran_bantuan'], 'safe'],
            [['jumlah_peserta', 'sokongan_pn', 'kelulusan'], 'integer'],
            [['nama_ppn', 'pengurus_pn', 'nama_penganjuran', 'kategori_penganjuran', 'sub_kategori_penganjuran', 'tahap_penganjuran', 'kategori_sukan', 'activiti'], 'string', 'max' => 80],
            [['negeri'], 'string', 'max' => 30],
            [['tempat'], 'string', 'max' => 90],
            [['muat_naik'],'validateFileUpload', 'skipOnEmpty' => false]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pengurusan_perhimpunan_kem_id' => 'Pengurusan Perhimpunan/Kem ID',
            'kategori_geran_bantuan' => 'Kategori Geran Bantuan',
            'nama_ppn' => 'Nama PPN',
            'pengurus_pn' => 'Pegawai PSK',
            'nama_penganjuran' => 'Nama Penganjuran',
            'kategori_penganjuran' => 'Kategori Penganjuran',
            'sub_kategori_penganjuran' => 'Sub Kategori Penganjuran',
            'tahap_penganjuran' => 'Tahap Penganjuran',
            'negeri' => 'Negeri',
            'kategori_sukan' => 'Kategori Sukan',
            'tarikh_penganjuran' => 'Tarikh Penganjuran',
            'activiti' => 'Activiti',
            'tempat' => 'Tempat',
            'jumlah_peserta' => 'Jumlah Peserta',
            'disahkan' => 'Disahkan',
            'sokongan_pn' => 'Sokongan PN',
            'muat_naik' => 'Muat Naik',
            'kelulusan' => 'Kelulusan',
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
    
    public function getRefKategoriPenganjuran()
    {
        return $this->hasOne(RefKategoriPenganjuran::className(), ['id' => 'kategori_penganjuran']);
    }
}
