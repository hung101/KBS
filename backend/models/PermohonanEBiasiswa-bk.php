<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;
use app\models\general\Upload;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_permohonan_e_biasiswa".
 *
 * @property integer $permohonan_e_biasiswa_id
 * @property string $muat_naik_gambar
 * @property string $nama
 * @property string $no_kad_pengenalan
 * @property string $jantina
 * @property string $keturunan
 * @property string $agama
 * @property string $taraf_perkahwinan
 * @property string $kawasan_temuduga_anda
 * @property string $alamat_1
 * @property string $alamat_2
 * @property string $alamat_3
 * @property string $alamat_negeri
 * @property string $alamat_bandar
 * @property string $alamat_poskod
 * @property string $no_tel_bimbit
 * @property string $no_pendaftaran_oku
 * @property string $kategori_oku
 * @property string $oku_lain_lain
 * @property string $universiti_institusi
 * @property string $program_pengajian
 * @property string $kursus_bidang_pengajian
 * @property string $falkulti
 * @property string $kategori
 * @property string $tarikh_tamat
 * @property integer $semester_terkini
 * @property integer $baki_semester_yang_tinggal
 * @property string $no_matriks
 * @property string $mendapat_pembiayaan_pendidikan
 * @property string $sukan
 * @property integer $perakuan_pemohon
 * @property integer $kelulusan
 * @property string $status_permohonan
 */
class PermohonanEBiasiswa extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_permohonan_e_biasiswa';
    }

    public function behaviors()
    {
        return [
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
            [['nama', 'no_kad_pengenalan', 'tarikh_lahir', 'jantina', 'keturunan', 'agama','nyatakan_nama_penaja', 'taraf_perkahwinan', 'kawasan_temuduga_anda', 'alamat_1', 'alamat_negeri', 'alamat_bandar', 'alamat_poskod', 'no_tel_bimbit', 'universiti_institusi', 'program_pengajian', 'kursus_bidang_pengajian', 'falkulti', 'kategori', 'tarikh_mula', 'tarikh_tamat', 'semester_terkini', 'baki_semester_yang_tinggal', 'no_matriks', 'sukan', 'perakuan_pemohon'], 'required'],
            [['tarikh_tamat', 'tarikh_temuduga', 'tarikh_lahir'], 'safe'],
            [['user_public_id', 'semester_terkini', 'baki_semester_yang_tinggal', 'perakuan_pemohon', 'kelulusan', 'mendapat_pembiayaan_pendidikan_bool', 'contoh'], 'integer'],
            [['muat_naik_gambar'], 'string', 'max' => 100],
            [['nama', 'oku_lain_lain', 'universiti_institusi', 'program_pengajian', 'kursus_bidang_pengajian', 'falkulti', 'sukan'], 'string', 'max' => 80],
            [['no_kad_pengenalan'], 'integer'],
            [['no_kad_pengenalan'], 'string', 'max' => 12],
            [['jantina'], 'string', 'max' => 1],
            [['keturunan'], 'string', 'max' => 25],
            [['agama', 'taraf_perkahwinan'], 'string', 'max' => 15],
            [['png_semasa', 'pngk_semasa'], 'string', 'max' => 20],
            [['kawasan_temuduga_anda', 'alamat_1', 'alamat_2', 'alamat_3', 'alamat_negeri', 'no_pendaftaran_oku', 'kategori_oku', 'kategori', 'no_matriks', 'mendapat_pembiayaan_pendidikan', 'status_permohonan'], 'string', 'max' => 30],
            [['alamat_bandar'], 'string', 'max' => 40],
            [['alamat_poskod'], 'string', 'max' => 5],
            [['no_tel_bimbit'], 'string', 'max' => 14],
            [['muat_naik_gambar'],'validateFileUpload', 'skipOnEmpty' => false]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'permohonan_e_biasiswa_id' => 'Permohonan E Biasiswa ID',
            'muat_naik_gambar' => 'Muat Naik Gambar',
            'nama' => 'Nama',
            'no_kad_pengenalan' => 'No Kad Pengenalan',
            'tarikh_lahir' => 'Tarikh Lahir',
            'umur' => 'Umur',
            'jantina' => 'Jantina',
            'keturunan' => 'Keturunan',
            'agama' => 'Agama',
            'taraf_perkahwinan' => 'Taraf Perkahwinan',
            'kawasan_temuduga_anda' => 'Kawasan Temuduga Anda',
            'tarikh_temuduga' => '',
            'alamat_1' => 'Alamat',
            'alamat_2' => '',
            'alamat_3' => '',
            'alamat_negeri' => 'Negeri',
            'alamat_bandar' => 'Bandar',
            'alamat_poskod' => 'Poskod',
            'no_tel_bimbit' => 'No Tel Rumah / Bimbit',
            'no_pendaftaran_oku' => 'No Pendaftaran OKU',
            'kategori_oku' => 'Kategori OKU',
            'oku_lain_lain' => 'Lain-lain',
            'universiti_institusi' => 'Universiti Institusi',
            'program_pengajian' => 'Program Pengajian',
            'kursus_bidang_pengajian' => 'Kursus Bidang Pengajian',
            'falkulti' => 'Fakulti',
            'kategori' => 'Kategori',
            'tarikh_mula' => 'Tarikh Mula',
            'tarikh_tamat' => 'Tarikh Tamat',
            'semester_terkini' => 'Semester Terkini',
            'baki_semester_yang_tinggal' => 'Baki Semester Yang Tinggal',
            'png_semasa' => 'PNG Semasa',
            'pngk_semasa' => 'PNGK Semasa',
            'no_matriks' => 'No Matriks',
            'mendapat_pembiayaan_pendidikan' => 'Tajaan Pembiayaan Pendidikan',
            'mendapat_pembiayaan_pendidikan_bool' => 'Tajaan Pembiayaan Pendidikan',
            'nyatakan_nama_penaja' => 'Jika Ya, Nyatakan Nama Penaja',
            'sukan' => 'Sukan',
            'perakuan_pemohon' => 'Saya mengaku bahawa segala kenyataan yang diberi adalah benar. Sekiranya didapati maklumat yang dikemukakan ini tidak benar, Kementerian Belia dan Sukan Malaysia berhak membatalkan permohonan saya dan tindakan akan diambil bagi membatalkan penawaran ini. Saya juga berjanji akan mematuhi semua syarat-syarat yang ditetapkan oleh Kementerian Belia dan Sukan Malaysia',
            'contoh' => 'Contoh',
            'catatan' => 'Catatan',
            'kelulusan' => 'Kelulusan',
            'status_permohonan' => 'Status Permohonan',
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
    
    public function getRefJantina()
    {
        return $this->hasOne(RefJantina::className(), ['id' => 'jantina']);
    }
    
    public function getRefStatusPermohonanEBiasiswa()
    {
        return $this->hasOne(RefStatusPermohonanEBiasiswa::className(), ['id' => 'status_permohonan']);
    }
}
