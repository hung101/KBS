<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;
use app\models\general\Upload;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_permohonan_e_bantuan".
 *
 * @property integer $permohonan_e_bantuan_id
 * @property string $nama_pertubuhan_persatuan
 * @property string $no_pendaftaran
 * @property string $tarikh_didaftarkan
 * @property string $pejabat_yang_mendaftarkan
 * @property string $alamat_1
 * @property string $alamat_2
 * @property string $alamat_3
 * @property string $alamat_negeri
 * @property string $alamat_bandar
 * @property string $alamat_poskod
 * @property string $alamat_surat_menyurat_1
 * @property string $alamat_surat_menyurat_2
 * @property string $alamat_surat_menyurat_3
 * @property string $alamat_surat_menyurat_negeri
 * @property string $alamat_surat_menyurat_bandar
 * @property string $alamat_surat_menyurat_poskod
 * @property string $no_telefon_pejabat
 * @property string $no_telefon_bimbit
 * @property string $no_fax
 * @property string $email
 * @property integer $bilangan_keahlian
 * @property integer $bilangan_cawangan_badan_gabungan
 * @property string $objektif_pertubuhan
 * @property string $aktiviti_dan_kejayaan_yang_dicapai
 */
class PermohonanEBantuan extends \yii\db\ActiveRecord
{
    public $jumlah_perbelanjaan;
    public $negeri_sokongan_id;
    public $kelulusan_id;
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_permohonan_e_bantuan';
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
            [['nama_pertubuhan_persatuan','no_akaun','nama_bank','cawangan_dan_alamat_bank','kategori_persatuan','kategori_program', 'no_pendaftaran','email', 
                'tarikh_didaftarkan', 'alamat_1', 'alamat_negeri', 'alamat_bandar', 'alamat_poskod', 'alamat_surat_menyurat_1', 'alamat_surat_menyurat_negeri', 
                'alamat_surat_menyurat_bandar', 'alamat_surat_menyurat_poskod', 'no_telefon_pejabat', 'no_telefon_bimbit', 'bilangan_keahlian', 'sokongan', 
                'alamat_parlimen', 'alamat_surat_menyurat_parlimen', 'jawatankuasa_penaung', 'jawatankuasa_pegerusi', 'jawatankuasa_timbalan_pengerusi', 'jawatankuasa_naib_pengerusi', 
                'jawatankuasa_setiausaha', 'jawatankuasa_bendahari'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['tarikh_didaftarkan', 'catatan', 'nama_program', 'tarikh_pelaksanaan', 'tempat_pelaksanaan', 'bilangan_peserta', 'tujuan_program_aktiviti', 'tarikh_mesyuarat', 'tarikh_bayar'], 'safe'],
            [['bilangan_keahlian', 'bilangan_cawangan_badan_gabungan', 'laporan', 'status_permohonan', 'negeri_sokongan', 'user_public_id'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['pertubuhan_persatuan_sendiri', 'lain_lain_sumbangan', 'yuran_bayaran_penyertaan', 'jumlah_bantuan_yang_dipohon', 'jumlah_perbelanjaan', 'jumlah_diluluskan'], 'number', 'message' => GeneralMessage::yii_validation_number],
            [[ 'pejabat_yang_mendaftarkan', 'jawatankuasa_penaung', 'jawatankuasa_pegerusi', 'jawatankuasa_timbalan_pengerusi', 'jawatankuasa_naib_pengerusi', 'jawatankuasa_setiausaha', 'jawatankuasa_bendahari'], 'string', 'max' => 80, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['no_pendaftaran', 'alamat_negeri', 'alamat_surat_menyurat_negeri', 'bil_mesyuarat', 'peringkat_program'], 'string', 'max' => 30, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['alamat_1', 'alamat_2', 'alamat_3', 'alamat_surat_menyurat_1', 'alamat_surat_menyurat_2', 'alamat_surat_menyurat_3'], 'string', 'max' => 90, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['alamat_bandar', 'alamat_surat_menyurat_bandar'], 'string', 'max' => 40, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['alamat_poskod', 'alamat_surat_menyurat_poskod', 'alamat_parlimen', 'alamat_surat_menyurat_parlimen'], 'string', 'max' => 5, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['no_telefon_pejabat', 'no_telefon_bimbit', 'no_fax'], 'string', 'max' => 14, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['email'], 'string', 'max' => 100, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['objektif_pertubuhan', 'aktiviti_dan_kejayaan_yang_dicapai', 'catatan_admin'], 'string', 'max' => 255, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['muat_naik_pb4', 'muat_naik_pb5', 'muat_naik_pb6'],'validateFileUpload', 'skipOnEmpty' => false]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'permohonan_e_bantuan_id' => 'Permohonan E Bantuan ID',
            'nama_pertubuhan_persatuan' => 'Nama Pertubuhan / Persatuan',
            'ebantuan_id' => 'E-Bantuan ID',
            'kategori_persatuan' => 'Kategori Persatuan',
            'kategori_program' => 'Kategori Program',
            'no_pendaftaran' => 'No Pendaftaran Pertubuhan / Persatuan',
            'tarikh_didaftarkan' => 'Tarikh Didaftarkan',
            'pejabat_yang_mendaftarkan' => 'Pejabat Yang Mendaftarkan',
            'alamat_1' => 'Alamat Berdaftar',
            'alamat_2' => '',
            'alamat_3' => '',
            'alamat_negeri' => 'Negeri',
            'alamat_bandar' => 'Bandar',
            'alamat_poskod' => 'Poskod',
            'alamat_surat_menyurat_1' => 'Alamat Surat Menyurat',
            'alamat_surat_menyurat_2' => '',
            'alamat_surat_menyurat_3' => '',
            'alamat_surat_menyurat_negeri' => 'Negeri',
            'alamat_surat_menyurat_bandar' => 'Bandar',
            'alamat_surat_menyurat_poskod' => 'Poskod',
            'no_telefon_pejabat' => 'No Telefon Pejabat',
            'no_telefon_bimbit' => 'No Telefon Bimbit',
            'no_fax' => 'No Fax',
            'email' => 'Email',
            'bilangan_keahlian' => 'Bilangan Keahlian',
            'bilangan_cawangan_badan_gabungan' => 'Bilangan Cawangan / Badan Gabungan',
            'jumlah_perbelanjaan' => 'Jumlah Perbelanjaan Tahun Lepas',
            'no_akaun' => 'No Akaun',
            'nama_bank' => 'Nama Bank',
            'cawangan_dan_alamat_bank' => 'Cawangan Dan Alamat Bank',
            'nama_program' => 'Nama Program',
            'tarikh_pelaksanaan' => 'Tarikh Pelaksanaan',
            'tempat_pelaksanaan' => 'Tempat Pelaksanaan',
            'bilangan_peserta' => 'Bilangan Peserta',
            'tujuan_program_aktiviti' => 'Tujuan Program / Aktiviti',
            'pertubuhan_persatuan_sendiri' => 'Anggaran Pendapatan Pertubuhan / Persatuan sendiri',
            'lain_lain_sumbangan' => 'Anggaran Pendapatan Lain-lain Sumbangan',
            'yuran_bayaran_penyertaan' => 'Anggaran Pendapatan Yuran/Bayaran Penyertaan',
            'jumlah_bantuan_yang_dipohon' => 'Jumlah Bantuan Yang Dipohon Daripada KBS / JBSN Untuk Program / Aktiviti Ini',
            'objektif_pertubuhan' => 'Objektif Pertubuhan',
            'aktiviti_dan_kejayaan_yang_dicapai' => 'Aktiviti Dan Kejayaan Yang Dicapai',
            'sokongan' => 'Sokongan',
            'kelulusan' => 'Kelulusan HQ',
            'catatan' => 'Catatan',
            'disclaimer' => 'Adalah disahkan bahawa maklumat yang dikemukakan adalah benar. Jika tidak, Permohonan ini tidak akan dipertimbangkan dan dibatalkan serta merta',
            'bil_mesyuarat' => 'Bil Mesyuarat',
            'tarikh_mesyuarat' => 'Tarikh Mesyuarat',
            'jumlah_diluluskan' => 'Jumlah Diluluskan',
            'tarikh_bayar' => 'Tarikh Bayar',
            'peringkat_program' => 'Peringkat Program',
            'alamat_parlimen' => 'Parlimen',
            'alamat_surat_menyurat_parlimen' => 'Parlimen',
            'catatan_admin' => 'Catatan / Ulasan',
            'status_permohonan' => 'Status Permohonan',
            'negeri_sokongan' => 'Negeri Sokongan',
            'muat_naik_pb4' => 'Muat Naik PB-4',
            'muat_naik_pb5' => 'Muat Naik PB-5',
            'muat_naik_pb6' => 'Muat Naik PB-6',
            'jawatankuasa_penaung' => 'Penaung',
            'jawatankuasa_pegerusi' => 'Pengerusi/Presiden/Yang Di Pertua',
            'jawatankuasa_timbalan_pengerusi' => 'Timbalan Pengerusi/Timbalan Presiden/Timbalan Yang Di Pertua',
            'jawatankuasa_naib_pengerusi' => 'Naib Pengerusi/Naib Presiden/Naib Yang Di Pertua',
            'jawatankuasa_setiausaha' => 'Setiausaha',
            'jawatankuasa_bendahari' => 'Bendahari',
        ];
    }
    
    public function getRefStatusPermohonanEBantuan()
    {
        return $this->hasOne(RefStatusPermohonanEBantuan::className(), ['id' => 'status_permohonan']);
    }
    
    public function getRefKelulusan()
    {
        return $this->hasOne(RefKelulusan::className(), ['id' => 'kelulusan']);
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
