<?php

namespace app\models;

use Yii;

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
            [['nama_projek_program_aktiviti_kejohanan', 'peringkat', 'nama_penganjur_persatuan_kerjasama', 'jumlah_bantuan_peruntukan', 'no_cek_eft', 'tarikh_cek_eft', 'tarikh_pelaksanaan_mula', 'tarikh_pelaksanaan_tarikh', 'objektif_pelaksaan', 'dirasmikan_oleh', 'lelaki', 'wanita', 'melayu', 'cina', 'india', 'lain_lain', 'jumlah_penyertaan', 'rumusan_program', 'kelulusan'], 'required', 'skipOnEmpty' => true],
            [['jumlah_bantuan_peruntukan', 'jumlah_perbelanjaan'], 'number'],
            [['tarikh_cek_eft', 'tarikh_pelaksanaan_mula', 'tarikh_pelaksanaan_tarikh'], 'safe'],
            [['lelaki', 'wanita', 'melayu', 'cina', 'india', 'lain_lain', 'jumlah_penyertaan', 'kelulusan'], 'integer'],
            [['nama_projek_program_aktiviti_kejohanan', 'nama_penganjur_persatuan_kerjasama', 'dirasmikan_oleh', 'creator_nama'], 'string', 'max' => 80],
            [['peringkat', 'rumusan_program'], 'string', 'max' => 30],
            [['no_cek_eft'], 'string', 'max' => 50],
            [['objektif_pelaksaan'], 'string', 'max' => 255],
            [['tempat_pelaksanaan'], 'string', 'max' => 90],
            [['creator_mobile_no'], 'string', 'max' => 14],
            [['muat_naik', 'creator_emel'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'elaporan_pelaksaan_id' => 'Elaporan Pelaksaan ID',
            'nama_projek_program_aktiviti_kejohanan' => 'Nama Projek Program Aktiviti Kejohanan',
            'peringkat' => 'Peringkat',
            'nama_penganjur_persatuan_kerjasama' => 'Nama Penganjur Persatuan Kerjasama',
            'jumlah_bantuan_peruntukan' => 'Jumlah Bantuan Peruntukan',
            'jumlah_perbelanjaan' => 'Jumlah Perbelanjaan',
            'no_cek_eft' => 'No Cek Eft',
            'tarikh_cek_eft' => 'Tarikh Cek Eft',
            'tarikh_pelaksanaan_mula' => 'Tarikh Pelaksanaan Mula',
            'tarikh_pelaksanaan_tarikh' => 'Tarikh Pelaksanaan Tarikh',
            'objektif_pelaksaan' => 'Objektif Pelaksaan',
            'tempat_pelaksanaan' => 'Tempat Pelaksanaan',
            'dirasmikan_oleh' => 'Dirasmikan Oleh',
            'lelaki' => 'Lelaki',
            'wanita' => 'Wanita',
            'melayu' => 'Melayu',
            'cina' => 'Cina',
            'india' => 'India',
            'lain_lain' => 'Lain Lain',
            'jumlah_penyertaan' => 'Jumlah Penyertaan',
            'rumusan_program' => 'Rumusan Program',
            'muat_naik' => 'Muat Naik',
            'creator_nama' => 'Nama Pelapor',
            'creator_emel' => 'Emel Pelapor',
            'creator_mobile_no' => 'Tel No Pelapor',
            'kelulusan' => 'Kelulusan',
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
