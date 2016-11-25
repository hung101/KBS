<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_elaporan_pelaksanaan".
 *
 * @property integer $elaporan_pelaksaan_id
 * @property string $kategori_elaporan
 * @property string $nama_projek_program_aktiviti_kejohanan
 * @property string $peringkat
 * @property string $nama_penganjur_persatuan_kerjasama
 * @property string $jumlah_bantuan_peruntukan
 * @property string $jumlah_perbelanjaan
 * @property string $no_cek_eft
 * @property string $tarikh_cek_eft
 * @property string $tarikh_pelaksanaan_mula
 * @property string $tarikh_pelaksanaan_akhir
 * @property string $objektif_pelaksaan
 * @property string $alamat_tempat_pelaksanaan_1
 * @property string $dirasmikan_oleh
 * @property integer $lelaki
 * @property integer $perempuan
 * @property integer $l_melayu
 * @property integer $l_cina
 * @property integer $l_india
 * @property integer $l_lain_lain
 * @property integer $jumlah_penyertaan
 * @property string $rumusan_program
 * @property string $muat_naik
 */
class ElaporanPelaksanaan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_elaporan_pelaksanaan';
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
            [['kelulusan','kategori_elaporan', 'nama_projek_program_aktiviti_kejohanan', 'peringkat', 'nama_penganjur_persatuan_kerjasama', 'jumlah_bantuan_peruntukan', 'tarikh_pelaksanaan_mula', 'tarikh_pelaksanaan_akhir', 'dirasmikan_oleh', 'lelaki', 'perempuan', 'l_melayu', 'l_cina', 'l_india', 'l_lain_lain', 'p_melayu', 'p_cina', 'p_india', 'p_lain_lain', 'jumlah_penyertaan'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['jumlah_bantuan_peruntukan', 'jumlah_perbelanjaan'], 'number', 'message' => GeneralMessage::yii_validation_number],
            [['tarikh_cek_eft', 'tarikh_pelaksanaan_mula', 'tarikh_pelaksanaan_akhir'], 'safe'],
            [['lelaki', 'perempuan', 'l_melayu', 'l_cina', 'l_india', 'l_lain_lain', 'p_melayu', 'p_cina', 'p_india', 'p_lain_lain', 'jumlah_penyertaan', 'bahagian', 'cawangan', 'user_public_id', 'kategori_elaporan', 'permohonan_e_bantuan_id', 'kelulusan'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['peringkat', 'rumusan_program'], 'string', 'max' => 30, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['nama_projek_program_aktiviti_kejohanan', 'nama_penganjur_persatuan_kerjasama', 'dirasmikan_oleh', 'creator_nama'], 'string', 'max' => 80, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['no_cek_eft'], 'string', 'max' => 50, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['objektif_pelaksaan'], 'string', 'max' => 255, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['alamat_tempat_pelaksanaan_1', 'alamat_tempat_pelaksanaan_2', 'alamat_tempat_pelaksanaan_3'], 'string', 'max' => 30, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['alamat_tempat_pelaksanaan_bandar', 'alamat_tempat_pelaksanaan_poskod'], 'string', 'max' => 5, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['alamat_tempat_pelaksanaan_poskod'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['alamat_tempat_pelaksanaan_negeri', 'alamat_tempat_pelaksanaan_parlimen'], 'string', 'max' => 3, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['creator_mobile_no'], 'string', 'max' => 14, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['muat_naik', 'creator_emel'], 'string', 'max' => 100, 'tooLong' => GeneralMessage::yii_validation_string_max],
            //[['tarikh_pelaksanaan_mula'], 'compare', 'compareAttribute'=>'tarikh_pelaksanaan_akhir', 'operator'=>'<=', 'skipOnEmpty'=>true],
            [['tarikh_pelaksanaan_akhir'], 'compare', 'compareAttribute'=>'tarikh_pelaksanaan_mula', 'operator'=>'>=', 'message' => GeneralMessage::yii_validation_compare],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'elaporan_pelaksaan_id' => GeneralLabel::elaporan_pelaksaan_id,
            'kategori_elaporan' => GeneralLabel::kategori_elaporan,
            'nama_projek_program_aktiviti_kejohanan' => GeneralLabel::nama_projek_program_aktiviti_kejohanan,
            'peringkat' => GeneralLabel::peringkat,
            'nama_penganjur_persatuan_kerjasama' => GeneralLabel::nama_penganjur_persatuan_kerjasama,
            'jumlah_bantuan_peruntukan' => GeneralLabel::jumlah_bantuan_peruntukan,
            'jumlah_perbelanjaan' => GeneralLabel::jumlah_perbelanjaan,
            'no_cek_eft' => GeneralLabel::no_cek_eft,
            'tarikh_cek_eft' => GeneralLabel::tarikh_cek_eft,
            'tarikh_pelaksanaan_mula' => GeneralLabel::tarikh_pelaksanaan_mula,
            'tarikh_pelaksanaan_akhir' => GeneralLabel::tarikh_pelaksanaan_akhir,
            'objektif_pelaksaan' => GeneralLabel::objektif_pelaksaan,
            'alamat_tempat_pelaksanaan_1' => GeneralLabel::alamat_tempat_pelaksanaan_1,
            'alamat_tempat_pelaksanaan_2' => GeneralLabel::alamat_tempat_pelaksanaan_2,
            'alamat_tempat_pelaksanaan_3' => GeneralLabel::alamat_tempat_pelaksanaan_3,
            'alamat_tempat_pelaksanaan_negeri' => GeneralLabel::alamat_tempat_pelaksanaan_negeri,
            'alamat_tempat_pelaksanaan_bandar' => GeneralLabel::alamat_tempat_pelaksanaan_bandar,
            'alamat_tempat_pelaksanaan_parlimen' => GeneralLabel::alamat_tempat_pelaksanaan_parlimen,
            'alamat_tempat_pelaksanaan_poskod' => GeneralLabel::alamat_tempat_pelaksanaan_poskod,
            'dirasmikan_oleh' => GeneralLabel::dirasmikan_oleh,
            'lelaki' => GeneralLabel::lelaki,
            'perempuan' => GeneralLabel::perempuan,
            'l_melayu' => GeneralLabel::l_melayu,
            'l_cina' => GeneralLabel::l_cina,
            'l_india' => GeneralLabel::l_india,
            'l_lain_lain' => GeneralLabel::l_lain_lain,
            'p_melayu' => GeneralLabel::p_melayu,
            'p_cina' => GeneralLabel::p_cina,
            'p_india' => GeneralLabel::p_india,
            'p_lain_lain' => GeneralLabel::p_lain_lain,
            'jumlah_penyertaan' => GeneralLabel::jumlah_penyertaan,
            'bahagian' => GeneralLabel::bahagian,
            'cawangan' => GeneralLabel::cawangan,
            'rumusan_program' => GeneralLabel::rumusan_program,
            'muat_naik' => GeneralLabel::muat_naik,
            'creator_nama' => GeneralLabel::creator_nama,
            'creator_emel' => GeneralLabel::creator_emel,
            'creator_mobile_no' => GeneralLabel::creator_mobile_no,
            'kelulusan' => GeneralLabel::kelulusan,

        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefKategoriELaporan(){
        return $this->hasOne(RefKategoriELaporan::className(), ['id' => 'kategori_elaporan']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefPeringkatELaporan(){
        return $this->hasOne(RefPeringkatELaporan::className(), ['id' => 'peringkat']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefParlimen(){
        return $this->hasOne(RefParlimen::className(), ['id' => 'alamat_tempat_pelaksanaan_parlimen']);
    }
}
