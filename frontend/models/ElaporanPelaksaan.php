<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_elaporan_pelaksaan".
 *
 * @property integer $elaporan_pelaksaan_id
 * @property string $nama_projek_program_aktiviti_kejohanan
 * @property string $peringkat
 * @property string $nama_penganjur_persatuan_kerjasama
 * @property string $jumlah_bantuan_peruntukan
 * @property string $jumlah_perbelanjaan
 * @property string $no_cek_eft
 * @property string $tarikh_cek_eft
 * @property string $tarikh_pelaksanaan_mula
 * @property string $tarikh_pelaksanaan_tarikh
 * @property string $objektif_pelaksaan
 * @property string $tempat_pelaksanaan
 * @property string $dirasmikan_oleh
 * @property integer $lelaki
 * @property integer $wanita
 * @property integer $melayu
 * @property integer $cina
 * @property integer $india
 * @property integer $lain_lain
 * @property integer $jumlah_penyertaan
 * @property string $rumusan_program
 * @property string $muat_naik
 */
class ElaporanPelaksaan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_elaporan_pelaksaan';
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
            [['nama_projek_program_aktiviti_kejohanan', 'peringkat', 'nama_penganjur_persatuan_kerjasama', 'jumlah_bantuan_peruntukan', 'no_cek_eft', 'tarikh_cek_eft', 'tarikh_pelaksanaan_mula', 'tarikh_pelaksanaan_tarikh', 'objektif_pelaksaan', 'dirasmikan_oleh', 'lelaki', 'wanita', 'melayu', 'cina', 'india', 'lain_lain', 'jumlah_penyertaan', 'rumusan_program', 'kelulusan'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['jumlah_bantuan_peruntukan', 'jumlah_perbelanjaan'], 'number', 'message' => GeneralMessage::yii_validation_number],
            [['tarikh_cek_eft', 'tarikh_pelaksanaan_mula', 'tarikh_pelaksanaan_tarikh'], 'safe'],
            [['lelaki', 'wanita', 'melayu', 'cina', 'india', 'lain_lain', 'jumlah_penyertaan', 'kelulusan'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['nama_projek_program_aktiviti_kejohanan', 'nama_penganjur_persatuan_kerjasama', 'dirasmikan_oleh', 'creator_nama'], 'string', 'max' => 80, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['peringkat', 'rumusan_program'], 'string', 'max' => 30, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['no_cek_eft'], 'string', 'max' => 50, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['objektif_pelaksaan'], 'string', 'max' => 255, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['tempat_pelaksanaan'], 'string', 'max' => 90, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['creator_mobile_no'], 'string', 'max' => 14, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['muat_naik', 'creator_emel'], 'string', 'max' => 100, 'tooLong' => GeneralMessage::yii_validation_string_max]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'elaporan_pelaksaan_id' => 'Elaporan Pelaksaan ID',
            'nama_projek_program_aktiviti_kejohanan' => GeneralLabel::nama_projek_program_aktiviti_kejohanan,
            'peringkat' => GeneralLabel::peringkat,
            'nama_penganjur_persatuan_kerjasama' => GeneralLabel::nama_penganjur_persatuan_kerjasama,
            'jumlah_bantuan_peruntukan' => GeneralLabel::jumlah_bantuan_peruntukan,
            'jumlah_perbelanjaan' => GeneralLabel::jumlah_perbelanjaan,
            'no_cek_eft' => GeneralLabel::no_cek_eft,
            'tarikh_cek_eft' => GeneralLabel::tarikh_cek_eft,
            'tarikh_pelaksanaan_mula' => GeneralLabel::tarikh_pelaksanaan_mula,
            'tarikh_pelaksanaan_tarikh' => GeneralLabel::tarikh_pelaksanaan_tarikh,
            'objektif_pelaksaan' => GeneralLabel::objektif_pelaksaan,
            'tempat_pelaksanaan' => GeneralLabel::tempat_pelaksanaan,
            'dirasmikan_oleh' => GeneralLabel::dirasmikan_oleh,
            'lelaki' => GeneralLabel::lelaki,
            'wanita' => GeneralLabel::wanita,
            'melayu' => GeneralLabel::melayu,
            'cina' => GeneralLabel::cina,
            'india' => GeneralLabel::india,
            'lain_lain' => GeneralLabel::lain_lain,
            'jumlah_penyertaan' => GeneralLabel::jumlah_penyertaan,
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
