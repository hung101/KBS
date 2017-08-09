<?php

namespace app\models;

use Yii;
use app\models\general\GeneralMessage;
use common\models\general\GeneralFunction;
use app\models\general\GeneralLabel;

/**
 * This is the model class for table "tbl_permohonan_penganjuran_bengkel".
 *
 * @property integer $permohonan_penganjuran_bengkel_id
 * @property string $badan_sukan
 * @property string $sukan
 * @property string $no_pendaftaran
 * @property string $alamat_1
 * @property string $alamat_2
 * @property string $alamat_3
 * @property string $alamat_negeri
 * @property string $alamat_bandar
 * @property string $alamat_poskod
 * @property string $no_telefon
 * @property string $no_faks
 * @property string $laman_sesawang
 * @property string $facebook
 * @property string $twitter
 * @property string $nama_bank
 * @property string $no_akaun
 * @property string $nama_kursus_seminar_bengkel
 * @property string $tarikh
 * @property string $tempat
 * @property string $tujuan
 * @property integer $bil_penceramah
 * @property integer $bil_peserta
 * @property integer $bil_urusetia
 * @property string $anggaran_perbelanjaan
 * @property string $kertas_kerja
 * @property string $surat_rasmi_badan_sukan_ms_negeri
 * @property string $butiran_perbelanjaan
 * @property string $maklumat_lain_sokongan
 * @property string $jumlah_bantuan_yang_dipohon
 * @property string $status_permohonan
 * @property string $catatan
 * @property string $tarikh_permohonan
 * @property string $jumlah_dilulus
 * @property string $jkb
 * @property string $tarikh_jkb
 * @property string $tarikh_tamat
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created
 * @property string $updated
 */
class PermohonanPenganjuranBengkel extends \yii\db\ActiveRecord
{
    public $status_permohonan_id;
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_permohonan_penganjuran_bengkel';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['badan_sukan', 'sukan', 'no_pendaftaran', 'alamat_1', 'alamat_negeri', 'alamat_poskod', 'no_telefon', 
                'no_faks', 'nama_bank', 'no_akaun', 'nama_kursus_seminar_bengkel', 'tarikh', 'tarikh_tamat', 'tempat', 'tujuan', 
                'bil_penceramah', 'bil_peserta', 'bil_urusetia', 'anggaran_perbelanjaan', 'jumlah_bantuan_yang_dipohon', 'status_permohonan', 
                'tarikh_permohonan'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['tarikh', 'tarikh_permohonan', 'created', 'updated', 'tarikh_jkb', 'tarikh_tamat'], 'safe'],
            [['bil_penceramah', 'bil_peserta', 'bil_urusetia', 'created_by', 'updated_by', 'status_permohonan_id'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['anggaran_perbelanjaan', 'jumlah_bantuan_yang_dipohon', 'jumlah_dilulus'], 'number', 'message' => GeneralMessage::yii_validation_number],
            [['badan_sukan', 'nama_bank', 'jkb'], 'string', 'max' => 80, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['sukan', 'no_pendaftaran', 'alamat_1', 'alamat_2', 'alamat_3', 'no_akaun', 'status_permohonan'], 'string', 'max' => 30, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['alamat_negeri'], 'string', 'max' => 3, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['alamat_bandar', 'alamat_poskod'], 'string', 'max' => 5, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['alamat_poskod'], 'string', 'min' => 5, 'tooShort' => GeneralMessage::yii_validation_string_min],
            [['alamat_poskod'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['no_telefon', 'no_faks'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['no_telefon', 'no_faks'], 'string', 'max' => 14, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['laman_sesawang', 'facebook', 'twitter'], 'string', 'max' => 100, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['tempat'], 'string', 'max' => 90, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['tujuan'], 'string', 'max' => 255, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['tarikh_tamat'], 'compare', 'compareAttribute'=>'tarikh', 'operator'=>'>=', 'message' => GeneralMessage::yii_validation_compare],
            ['tarikh','validateBeforePenganjuran', 'on' => 'create'],
            [['badan_sukan', 'nama_bank', 'jkb','sukan', 'no_pendaftaran', 'alamat_1', 'alamat_2', 'alamat_3', 'no_akaun', 'status_permohonan','alamat_negeri',
                'alamat_bandar','laman_sesawang', 'facebook', 'twitter','tempat','tujuan'], 'filter', 'filter' => function ($value) {
                return  \common\models\general\GeneralFunction::filterXSS($value);
            }],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'permohonan_penganjuran_bengkel_id' => 'Permohonan Penganjuran Bengkel ID',
            'badan_sukan' => GeneralLabel::badan_sukan,  //'Badan Sukan',
            'sukan' => GeneralLabel::sukan,  //'Sukan',
            'no_pendaftaran' => GeneralLabel::no_pendaftaran,  //'No. Pendaftaran',
            'alamat_1' => GeneralLabel::alamat_1,  //'Alamat',
            'alamat_2' => '',
            'alamat_3' => '',
            'alamat_negeri' => GeneralLabel::alamat_negeri,  //'Negeri',
            'alamat_bandar' => GeneralLabel::alamat_bandar,  //'Bandar',
            'alamat_poskod' => GeneralLabel::poskod,  //'Poskod',
            'no_telefon' => GeneralLabel::no_telefon,  //'No. Telefon',
            'no_faks' => GeneralLabel::no_faks,  //'No. Faks',
            'laman_sesawang' => GeneralLabel::laman_web,  //'Laman Sesawang',
            'facebook' => GeneralLabel::facebook,  //'Facebook',
            'twitter' => GeneralLabel::twitter,  //'Twitter',
            'nama_bank' => GeneralLabel::nama_bank,  //'Nama Bank',
            'no_akaun' => GeneralLabel::no_akaun,  //'No Akaun',
            'nama_kursus_seminar_bengkel' => GeneralLabel::nama_bengkel,  //'Nama Bengkel',
            'tarikh' => GeneralLabel::tarikh,  //'Tarikh Mula',
            'tempat' => GeneralLabel::tempat,  //'Tempat',
            'tujuan' => GeneralLabel::tujuan,  //'Tujuan',
            'bil_penceramah' => GeneralLabel::bil_penceramah,  //'Bil. Penceramah',
            'bil_peserta' => GeneralLabel::bil_peserta,  //'Bil. Peserta',
            'bil_urusetia' => GeneralLabel::bil_urusetia,  //'Bil. Urusetia',
            'anggaran_perbelanjaan' => GeneralLabel::anggaran_perbelanjaan,  //'Anggaran Perbelanjaan (RM)',
            'kertas_kerja' => GeneralLabel::kertas_kerja,  //'Kertas Kerja',
            'surat_rasmi_badan_sukan_ms_negeri' => GeneralLabel::surat_rasmi_badan_sukan_ms_negeri,  //'Surat Rasmi / Badan Sukan / MS Negeri',
            'butiran_perbelanjaan' => GeneralLabel::butiran_perbelanjaan,  //'Butiran Perbelanjaan',
            'maklumat_lain_sokongan' => GeneralLabel::maklumat_lain_sokongan,  //'Maklumat Lain (Sokongan)',
            'jumlah_bantuan_yang_dipohon' => GeneralLabel::jumlah_bantuan_yang_dipohon_bengkel,  //'Jumlah (RM)',
            'status_permohonan' => GeneralLabel::status_permohonan,  //'Status Permohonan',
            'catatan' => GeneralLabel::catatan,  //'Catatan',
            'tarikh_permohonan' => GeneralLabel::tarikh_permohonan,  //'Tarikh Permohonan',
            'jumlah_dilulus' => GeneralLabel::jumlah_diluluskan,  //'Jumlah Diluluskan (RM)',
            'jkb' => GeneralLabel::bil_jkb,  //'Bil. JKB',
            'tarikh_jkb' => 'Tarikh JKB',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created' => 'Created',
            'updated' => 'Updated',
            'tarikh_tamat' => GeneralLabel::tarikh_tamat,  //'Tarikh Tamat',
        ];
    }
    
    public function validateBeforePenganjuran(){
        $dateMinus = new \DateTime($this->tarikh);
        $dateMinus->modify('-1 month'); // 1 months before tarikh penganjuran berlangsung

        if($dateMinus->format('Y-m-d') <= GeneralFunction::getCurrentDate()){
            $this->addError('tarikh','Permohonan tidak boleh lewat 1 bulan dari tarikh sesi pembengkelan');
        }
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefProfilBadanSukan(){
        return $this->hasOne(ProfilBadanSukan::className(), ['profil_badan_sukan' => 'badan_sukan']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefStatusBantuanPenganjuranKursus(){
        return $this->hasOne(RefStatusBantuanPenganjuranKursus::className(), ['id' => 'status_permohonan']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefSukan(){
        return $this->hasOne(RefSukan::className(), ['id' => 'sukan']);
    }
}
