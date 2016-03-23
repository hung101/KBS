<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;
use app\models\general\Upload;
use app\models\general\GeneralMessage;

use app\models\general\GeneralLabel;

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
                'jawatankuasa_setiausaha', 'jawatankuasa_bendahari'], 'required', 'skipOnEmpty' => true],
            [['tarikh_didaftarkan', 'catatan', 'nama_program', 'tarikh_pelaksanaan', 'tempat_pelaksanaan', 'bilangan_peserta', 'tujuan_program_aktiviti', 'tarikh_mesyuarat', 'tarikh_bayar'], 'safe'],
            [['bilangan_keahlian', 'bilangan_cawangan_badan_gabungan', 'laporan', 'status_permohonan', 'negeri_sokongan', 'user_public_id'], 'integer'],
            [['pertubuhan_persatuan_sendiri', 'lain_lain_sumbangan', 'yuran_bayaran_penyertaan', 'jumlah_bantuan_yang_dipohon', 'jumlah_perbelanjaan', 'jumlah_diluluskan'], 'number'],
            [[ 'pejabat_yang_mendaftarkan', 'jawatankuasa_penaung', 'jawatankuasa_pegerusi', 'jawatankuasa_timbalan_pengerusi', 'jawatankuasa_naib_pengerusi', 'jawatankuasa_setiausaha', 'jawatankuasa_bendahari'], 'string', 'max' => 80],
            [['no_pendaftaran', 'alamat_negeri', 'alamat_surat_menyurat_negeri', 'bil_mesyuarat', 'peringkat_program'], 'string', 'max' => 30],
            [['alamat_1', 'alamat_2', 'alamat_3', 'alamat_surat_menyurat_1', 'alamat_surat_menyurat_2', 'alamat_surat_menyurat_3'], 'string', 'max' => 90],
            [['alamat_bandar', 'alamat_surat_menyurat_bandar'], 'string', 'max' => 40],
            [['alamat_poskod', 'alamat_surat_menyurat_poskod', 'alamat_parlimen', 'alamat_surat_menyurat_parlimen'], 'string', 'max' => 5],
            [['no_telefon_pejabat', 'no_telefon_bimbit', 'no_fax'], 'string', 'max' => 14],
            [['email'], 'string', 'max' => 100],
            [['objektif_pertubuhan', 'aktiviti_dan_kejayaan_yang_dicapai', 'catatan_admin'], 'string', 'max' => 255],
            [['muat_naik_pb4', 'muat_naik_pb5', 'muat_naik_pb6'],'validateFileUpload', 'skipOnEmpty' => false]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'permohonan_e_bantuan_id' => GeneralLabel::permohonan_e_bantuan_id,
            'nama_pertubuhan_persatuan' => GeneralLabel::nama_pertubuhan_persatuan,
            'ebantuan_id' => GeneralLabel::ebantuan_id,
            'kategori_persatuan' => GeneralLabel::kategori_persatuan,
            'kategori_program' => GeneralLabel::kategori_program,
            'no_pendaftaran' => GeneralLabel::no_pendaftaran,
            'tarikh_didaftarkan' => GeneralLabel::tarikh_didaftarkan,
            'pejabat_yang_mendaftarkan' => GeneralLabel::pejabat_yang_mendaftarkan,
            'alamat_1' => GeneralLabel::alamat_1,
            'alamat_2' => GeneralLabel::alamat_2,
            'alamat_3' => GeneralLabel::alamat_3,
            'alamat_negeri' => GeneralLabel::alamat_negeri,
            'alamat_bandar' => GeneralLabel::alamat_bandar,
            'alamat_poskod' => GeneralLabel::alamat_poskod,
            'alamat_surat_menyurat_1' => GeneralLabel::alamat_surat_menyurat_1,
            'alamat_surat_menyurat_2' => GeneralLabel::alamat_surat_menyurat_2,
            'alamat_surat_menyurat_3' => GeneralLabel::alamat_surat_menyurat_3,
            'alamat_surat_menyurat_negeri' => GeneralLabel::alamat_surat_menyurat_negeri,
            'alamat_surat_menyurat_bandar' => GeneralLabel::alamat_surat_menyurat_bandar,
            'alamat_surat_menyurat_poskod' => GeneralLabel::alamat_surat_menyurat_poskod,
            'no_telefon_pejabat' => GeneralLabel::no_telefon_pejabat,
            'no_telefon_bimbit' => GeneralLabel::no_telefon_bimbit,
            'no_fax' => GeneralLabel::no_fax,
            'email' => GeneralLabel::email,
            'bilangan_keahlian' => GeneralLabel::bilangan_keahlian,
            'bilangan_cawangan_badan_gabungan' => GeneralLabel::bilangan_cawangan_badan_gabungan,
            'jumlah_perbelanjaan' => GeneralLabel::jumlah_perbelanjaan,
            'no_akaun' => GeneralLabel::no_akaun,
            'nama_bank' => GeneralLabel::nama_bank,
            'cawangan_dan_alamat_bank' => GeneralLabel::cawangan_dan_alamat_bank,
            'nama_program' => GeneralLabel::nama_program,
            'tarikh_pelaksanaan' => GeneralLabel::tarikh_pelaksanaan,
            'tempat_pelaksanaan' => GeneralLabel::tempat_pelaksanaan,
            'bilangan_peserta' => GeneralLabel::bilangan_peserta,
            'tujuan_program_aktiviti' => GeneralLabel::tujuan_program_aktiviti,
            'pertubuhan_persatuan_sendiri' => GeneralLabel::pertubuhan_persatuan_sendiri,
            'lain_lain_sumbangan' => GeneralLabel::lain_lain_sumbangan,
            'yuran_bayaran_penyertaan' => GeneralLabel::yuran_bayaran_penyertaan,
            'jumlah_bantuan_yang_dipohon' => GeneralLabel::jumlah_bantuan_yang_dipohon,
            'objektif_pertubuhan' => GeneralLabel::objektif_pertubuhan,
            'aktiviti_dan_kejayaan_yang_dicapai' => GeneralLabel::aktiviti_dan_kejayaan_yang_dicapai,
            'sokongan' => GeneralLabel::sokongan,
            'kelulusan' => GeneralLabel::kelulusan,
            'catatan' => GeneralLabel::catatan,
            'disclaimer' => GeneralLabel::disclaimer,
            'bil_mesyuarat' => GeneralLabel::bil_mesyuarat,
            'tarikh_mesyuarat' => GeneralLabel::tarikh_mesyuarat,
            'jumlah_diluluskan' => GeneralLabel::jumlah_diluluskan,
            'tarikh_bayar' => GeneralLabel::tarikh_bayar,
            'peringkat_program' => GeneralLabel::peringkat_program,
            'alamat_parlimen' => GeneralLabel::alamat_parlimen,
            'alamat_surat_menyurat_parlimen' => GeneralLabel::alamat_surat_menyurat_parlimen,
            'catatan_admin' => GeneralLabel::catatan_admin,
            'status_permohonan' => GeneralLabel::status_permohonan,
            'negeri_sokongan' => GeneralLabel::negeri_sokongan,
            'muat_naik_pb4' => GeneralLabel::muat_naik_pb4,
            'muat_naik_pb5' => GeneralLabel::muat_naik_pb5,
            'muat_naik_pb6' => GeneralLabel::muat_naik_pb6,
            'jawatankuasa_penaung' => GeneralLabel::jawatankuasa_penaung,
            'jawatankuasa_pegerusi' => GeneralLabel::jawatankuasa_pegerusi,
            'jawatankuasa_timbalan_pengerusi' => GeneralLabel::jawatankuasa_timbalan_pengerusi,
            'jawatankuasa_naib_pengerusi' => GeneralLabel::jawatankuasa_naib_pengerusi,
            'jawatankuasa_setiausaha' => GeneralLabel::jawatankuasa_setiausaha,
            'jawatankuasa_bendahari' => GeneralLabel::jawatankuasa_bendahari,

        ];
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
