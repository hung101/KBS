<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;
use app\models\general\Upload;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_penganjuran_kursus_peserta".
 *
 * @property integer $penganjuran_kursus_peserta_id
 * @property string $kategori_kursus
 * @property string $nama_kursus
 * @property string $kod_kursus
 * @property string $tarikh
 * @property string $tempat
 * @property string $yuran
 * @property string $nama_penuh
 * @property string $muatnaik_gambar
 * @property string $jantina
 * @property string $taraf_perkahwinan
 * @property string $no_passport
 * @property string $no_kad_pengenalan
 * @property string $no_kp_polis_tentera
 * @property string $kaum
 * @property string $alamat_1
 * @property string $alamat_2
 * @property string $alamat_3
 * @property string $alamat_negeri
 * @property string $alamat_bandar
 * @property string $alamat_poskod
 * @property string $no_tel_bimbit
 * @property string $no_tel_rumah
 * @property string $emel
 * @property string $pekerjaan
 * @property string $nama_majikan
 * @property string $alamat_majikan_1
 * @property string $alamat_majikan_2
 * @property string $alamat_majikan_3
 * @property string $alamat_majikan_negeri
 * @property string $alamat_majikan_bandar
 * @property string $alamat_majikan_poskod
 * @property string $no_tel_majikan
 * @property string $no_faks_majikan
 * @property string $kelulusan_akademi
 * @property string $nama_kelulusan
 * @property string $kelulusan_sukan_spesifik
 * @property string $nama_sukan_akademi
 * @property string $kelulusan_sains_sukan
 * @property string $sijil_spkk_msn
 * @property string $lesen_kejurulatihan_msn
 * @property string $status_jurulatih
 * @property string $lantikan
 * @property string $nama_sukan_jurulatih
 * @property string $tahun_berkhidmat_mula
 * @property string $tahun_berkhidmat_tamat
 * @property string $pencapaian
 * @property integer $kelulusan
 */
class PenganjuranKursusPeserta extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_penganjuran_kursus_peserta';
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
            [['kategori_kursus', 'nama_kursus', 'kod_kursus', 'tarikh', 'tempat', 'yuran', 'nama_penuh', 'jantina', 'taraf_perkahwinan', 'kaum', 'alamat_1', 'alamat_negeri', 'alamat_bandar', 'alamat_poskod', 'no_tel_bimbit', 'no_tel_rumah', 'pekerjaan', 'nama_majikan', 'alamat_majikan_1', 'alamat_majikan_negeri', 'alamat_majikan_bandar', 'alamat_majikan_poskod', 'no_tel_majikan', 'kelulusan'], 'required', 'skipOnEmpty' => true],
            [['tarikh', 'tahun_berkhidmat_mula', 'tahun_berkhidmat_tamat'], 'safe'],
            [['yuran'], 'number'],
            [['kelulusan'], 'integer'],
            [['kategori_kursus', 'nama_kursus', 'tempat', 'nama_penuh', 'pekerjaan', 'nama_majikan', 'kelulusan_akademi', 'nama_kelulusan', 'kelulusan_sukan_spesifik', 'nama_sukan_akademi', 'kelulusan_sains_sukan', 'sijil_spkk_msn', 'lesen_kejurulatihan_msn', 'lantikan', 'nama_sukan_jurulatih'], 'string', 'max' => 80],
            [['kod_kursus', 'alamat_negeri', 'alamat_majikan_negeri', 'status_jurulatih', 'no_lesen'], 'string', 'max' => 30],
            [['muatnaik_gambar', 'emel'], 'string', 'max' => 100],
            [['jantina'], 'string', 'max' => 1],
            [['taraf_perkahwinan', 'kaum'], 'string', 'max' => 25],
            [['no_passport'], 'string', 'max' => 15],
            [['no_kad_pengenalan', 'no_kp_polis_tentera'], 'string', 'max' => 12],
            [['alamat_1', 'alamat_2', 'alamat_3', 'alamat_majikan_1', 'alamat_majikan_2', 'alamat_majikan_3'], 'string', 'max' => 90],
            [['alamat_bandar', 'alamat_majikan_bandar'], 'string', 'max' => 40],
            [['alamat_poskod', 'alamat_majikan_poskod'], 'string', 'max' => 5],
            [['no_tel_bimbit', 'no_tel_rumah', 'no_tel_majikan', 'no_faks_majikan'], 'string', 'max' => 14],
            [['pencapaian'], 'string', 'max' => 255],
            [['muatnaik_gambar','dokumen_lampiran'], 'validateFileUpload', 'skipOnEmpty' => false],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'penganjuran_kursus_peserta_id' => 'Penganjuran Kursus Peserta ID',
            'kategori_kursus' => 'Kategori Kursus',
            'nama_kursus' => 'Nama Kursus',
            'kod_kursus' => 'Kod Kursus',
            'tarikh' => 'Tarikh',
            'tempat' => 'Tempat',
            'yuran' => 'Yuran',
            'nama_penuh' => 'Nama Penuh',
            'muatnaik_gambar' => 'Muatnaik Gambar',
            'jantina' => 'Jantina',
            'taraf_perkahwinan' => 'Taraf Perkahwinan',
            'no_passport' => 'No Passport',
            'no_kad_pengenalan' => 'No Kad Pengenalan',
            'no_kp_polis_tentera' => 'No KP Polis/Tentera',
            'kaum' => 'Kaum',
            'alamat_1' => 'Alamat',
            'alamat_2' => '',
            'alamat_3' => '',
            'alamat_negeri' => 'Negeri',
            'alamat_bandar' => 'Bandar',
            'alamat_poskod' => 'Poskod',
            'no_tel_bimbit' => 'No Tel Bimbit',
            'no_tel_rumah' => 'No Tel Rumah',
            'emel' => 'Emel',
            'pekerjaan' => 'Pekerjaan',
            'nama_majikan' => 'Nama Majikan',
            'alamat_majikan_1' => 'Alamat Majikan',
            'alamat_majikan_2' => '',
            'alamat_majikan_3' => '',
            'alamat_majikan_negeri' => 'Negeri',
            'alamat_majikan_bandar' => 'Bandar',
            'alamat_majikan_poskod' => 'Poskod',
            'no_tel_majikan' => 'No Tel Majikan',
            'no_faks_majikan' => 'No Faks Majikan',
            'kelulusan_akademi' => 'Kelulusan Akademik',
            'nama_kelulusan' => 'Nama Kelulusan',
            'kelulusan_sukan_spesifik' => 'Kelulusan Sukan Spesifik',
            'nama_sukan_akademi' => 'Nama Sukan Akademi',
            'kelulusan_sains_sukan' => 'Kelulusan Sains Sukan',
            'sijil_spkk_msn' => 'Sijil SPKK',
            'lesen_kejurulatihan_msn' => 'Lesen Kejurulatihan AKK',
            'status_jurulatih' => 'Status Jurulatih',
            'lantikan' => 'Lantikan',
            'nama_sukan_jurulatih' => 'Nama Sukan Jurulatih',
            'tahun_berkhidmat_mula' => 'Tahun Berkhidmat Mula',
            'tahun_berkhidmat_tamat' => 'Tahun Berkhidmat Tamat',
            'pencapaian' => 'Pencapaian',
            'dokumen_lampiran' => 'Dokumen Lampiran',
            'kelulusan' => 'Kelulusan',
            'no_lesen' => 'No Lesen',
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
    public function getRefJantina(){
        return $this->hasOne(RefJantina::className(), ['id' => 'jantina']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefKelulusan(){
        return $this->hasOne(RefKelulusan::className(), ['id' => 'kelulusan']);
    }
}
