<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;
use app\models\general\Upload;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_profil_badan_sukan".
 *
 * @property integer $profil_badan_sukan
 * @property string $nama_badan_sukan
 * @property string $nama_badan_sukan_sebelum_ini
 * @property string $no_pendaftaran_sijil_pendaftaran
 * @property string $tarikh_lulus_pendaftaran
 * @property string $jenis_sukan
 * @property string $alamat_tetap_badan_sukan
 * @property string $alamat_surat_menyurat_badan_sukan
 * @property integer $no_telefon_pejabat
 * @property integer $no_faks_pejabat
 * @property string $emel_badan_sukan
 * @property string $pengiktirafan_yang_pernah_diterima_badan_sukan
 */
class ProfilBadanSukan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_profil_badan_sukan';
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
            [['nama_badan_sukan', 'no_pendaftaran', 'nama_badan_sukan_sebelum_ini', 'no_pendaftaran_sijil_pendaftaran', 'tarikh_lulus_pendaftaran', 'peringkat_badan_sukan', 'jenis_sukan', 'no_telefon_pejabat'], 'required', 'skipOnEmpty' => true],
            [['tarikh_lulus_pendaftaran', 'tarikh_kelulusan_Terkini', 'tarikh_pindaan', 'tarikh_kelulusan'], 'safe'],
            [['no_telefon_pejabat', 'no_telefon_pejabat_2', 'no_telefon_pejabat_3', 'no_tel_bimbit', 'no_faks_pejabat'], 'string', 'max' => 14],
            [['nama_badan_sukan', 'nama_badan_sukan_sebelum_ini', 'emel_badan_sukan', 'pengiktirafan_yang_pernah_diterima_badan_sukan'], 'string', 'max' => 100],
            [['jenis_sukan', 'alamat_tetap_badan_sukan_1', 'alamat_tetap_badan_sukan_2', 'alamat_tetap_badan_sukan_3', 'alamat_tetap_badan_sukan_bandar', 'alamat_surat_menyurat_badan_sukan_1', 'alamat_surat_menyurat_badan_sukan_2', 'alamat_surat_menyurat_badan_sukan_3', 'alamat_surat_menyurat_badan_sukan_bandar'], 'string', 'max' => 30],
            [['alamat_tetap_badan_sukan_negeri', 'alamat_surat_menyurat_badan_sukan_negeri'], 'string', 'max' => 20],
            [['no_pendaftaran'], 'string', 'max' => 30],
            [['alamat_tetap_badan_sukan_poskod', 'alamat_surat_menyurat_badan_sukan_poskod'], 'string', 'max' => 5],
            [['no_pendaftaran_sijil_pendaftaran'], 'string', 'max' => 100],
            [['bilangan_pindaan_perlembagaan_dilakukan'], 'string', 'max' => 50],
            [['muat_naik_perlembagaan_terkini', 'gambar'],'validateFileUpload', 'skipOnEmpty' => false]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'profil_badan_sukan' => 'Profil Badan Sukan',
            'nama_badan_sukan' => 'Nama Badan Sukan',
            'nama_badan_sukan_sebelum_ini' => 'Nama Badan Sukan Sebelum Ini',
            'no_pendaftaran_sijil_pendaftaran' => 'Sijil Pendaftaran',
            'no_pendaftaran' => 'No Pendaftaran',
            'tarikh_lulus_pendaftaran' => 'Tarikh Lulus Pendaftaran',
            'peringkat_badan_sukan' => 'Peringkat Badan Sukan',
            'jenis_sukan' => 'Jenis Sukan',
            'alamat_tetap_badan_sukan_1' => 'Alamat Tetap Badan Sukan',
            'alamat_tetap_badan_sukan_2' => '',
            'alamat_tetap_badan_sukan_3' => '',
            'alamat_tetap_badan_sukan_negeri' => 'Negeri',
            'alamat_tetap_badan_sukan_bandar' => 'Bandar',
            'alamat_tetap_badan_sukan_poskod' => 'Poskod',
            'alamat_surat_menyurat_badan_sukan_1' => 'Alamat Surat Menyurat Badan Sukan',
            'alamat_surat_menyurat_badan_sukan_2' => '',
            'alamat_surat_menyurat_badan_sukan_3' => '',
            'alamat_surat_menyurat_badan_sukan_negeri' => 'Negeri',
            'alamat_surat_menyurat_badan_sukan_bandar' => 'Bandar',
            'alamat_surat_menyurat_badan_sukan_poskod' => 'Poskod',
            'no_telefon_pejabat' => 'No Telefon Pejabat 1',
            'no_telefon_pejabat_2' => 'No Telefon Pejabat 2',
            'no_telefon_pejabat_3' => 'No Telefon Pejabat 3',
            'no_tel_bimbit' => 'No Telefon Bimbit',
            'no_faks_pejabat' => 'No Faks Pejabat',
            'emel_badan_sukan' => 'Emel Badan Sukan',
            'pengiktirafan_yang_pernah_diterima_badan_sukan' => 'Pengelola Badan Sukan Antarabangsa',
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
}
