<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_tempahan_kemudahan".
 *
 * @property integer $tempahan_kemudahan_sub_msn_id
 * @property string $nama
 * @property string $no_kad_pengenalan
 * @property string $location
 * @property string $venue
 * @property string $tarikh_mula
 * @property string $catatan
 */
class TempahanKemudahanSubMsn extends \yii\db\ActiveRecord
{
    const SEJAM_SIANG = 1;
    const SEHARI_SIANG = 2;
    const SEMINGGU_SIANG = 3;
    const SEBULAN_SIANG = 4;
    const SEJAM_MALAM = 5;
    const SEHARI_MALAM = 6;
    const SEMINGGU_MALAM = 7;
    const SEBULAN_MALAM = 8;
    
    public $negeri_search;
    public $kategori_hakmilik_search;
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_tempahan_kemudahan_sub_msn';
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
            [['nama', 'no_kad_pengenalan', 'no_tel', 'emel', 'kemudahan', 'bayaran_sewa', 'jenis_kadar', 'quantity_kadar', 'tarikh_mula', 
                'tarikh_akhir', 'jumlah_orang', 'status', 'agensi'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            //[['tarikh_mula'], 'safe'],
            [['tarikh_mula'], 'compare', 'compareValue'=>date("Y-m-d"), 'operator'=>'>=', 'skipOnEmpty'=>true, 'message' => GeneralMessage::yii_validation_compare],
            [['emel'], 'email', 'message' => GeneralMessage::yii_validation_email],
            [['no_tel', 'jumlah_jam'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['no_tel'], 'string', 'max' => 14, 'tooLong' => GeneralMessage::yii_validation_string_max],            
            [['nama', 'venue', 'nama_pemilik'], 'string', 'max' => 80, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['quantity_kadar', 'jumlah_jam'], 'string', 'max' => 11, 'skipOnEmpty' => true, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['no_kad_pengenalan'], 'string', 'max' => 12, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['no_kad_pengenalan'], 'integer', 'message' => GeneralMessage::yii_validation_integer],            
            [['tel_bimbit_no_pemilik', 'fax_no_pemilik'], 'string', 'max' => 14, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['tel_bimbit_no_pemilik', 'fax_no_pemilik'], 'integer', 'message' => GeneralMessage::yii_validation_integer],            
            [['location_alamat_1', 'location_alamat_2', 'location_alamat_3'], 'string', 'max' => 30, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['location_alamat_bandar', 'location_alamat_poskod'], 'string', 'max' => 5, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['location_alamat_poskod'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['location_alamat_negeri'], 'string', 'max' => 3, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['email_pemilik'], 'string', 'max' => 100, 'tooLong' => GeneralMessage::yii_validation_string_max],
            //[['lelaki', 'wanita', 'melayu', 'cina', 'india', 'lain_lain', 'jumlah_orang'], 'string', 'max' => 11],
            [['lelaki', 'wanita', 'melayu', 'cina', 'india', 'lain_lain', 'jumlah_orang', 'kemudahan', 'jenis_kadar', 'quantity_kadar', 'public_user_pemohon_id', 'public_user_pemilik_id', 'kategori_hakmilik', 'no_kad_pengenalan', 'no_tel'], 'integer', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_integer],
            [['kadar_sewaan_sejam_siang','kadar_sewaan_sehari_siang','kadar_sewaan_seminggu_siang','kadar_sewaan_sebulan_siang','kadar_sewaan_sejam_malam',
                'kadar_sewaan_sehari_malam','kadar_sewaan_seminggu_malam','kadar_sewaan_sebulan_malam', 'no_kad_pengenalan', 'no_tel',
                'kadar_sewaan_sejam_siang_cuti_umum','kadar_sewaan_sehari_siang_cuti_umum','kadar_sewaan_seminggu_siang_cuti_umum','kadar_sewaan_sebulan_siang_cuti_umum','kadar_sewaan_sejam_malam_cuti_umum',
                'kadar_sewaan_sehari_malam_cuti_umum','kadar_sewaan_seminggu_malam_cuti_umum','kadar_sewaan_sebulan_malam_cuti_umum'], 'number', 'message' => GeneralMessage::yii_validation_number],
            [['catatan'], 'string', 'max' => 255, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['emel','nama', 'venue', 'nama_pemilik','quantity_kadar','location_alamat_1', 
                'location_alamat_2', 'location_alamat_3','location_alamat_bandar','location_alamat_negeri','email_pemilik','catatan'], function ($attribute, $params) {
                if (!\common\models\general\GeneralFunction::validateXSS($this->$attribute)) {
                    $this->addError($attribute, GeneralMessage::yii_validation_xss);
                }
            }],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'tempahan_kemudahan_sub_msn_id' => GeneralLabel::tempahan_kemudahan_id,
            'nama' => GeneralLabel::nama,
            'no_kad_pengenalan' => GeneralLabel::no_kad_pengenalan,
            'no_tel' => GeneralLabel::no_tel,
            'emel' => GeneralLabel::emel,
            'nama_pemilik' => GeneralLabel::nama_pemilik,
            'fax_no_pemilik' => GeneralLabel::fax_no_pemilik,
            'tel_bimbit_no_pemilik' => GeneralLabel::tel_bimbit_no_pemilik,
            'email_pemilik' => GeneralLabel::email_pemilik,
            'venue' => GeneralLabel::venue,
            'kemudahan' => GeneralLabel::kemudahan,
            'jenis_kadar' => GeneralLabel::jenis_kadar,
            'quantity_kadar' => GeneralLabel::quantity_kadar,
            'bayaran_sewa' => GeneralLabel::bayaran_sewa_rm,
            'tarikh_mula' => GeneralLabel::tarikh_mula,
            'tarikh_akhir' => GeneralLabel::tarikh_tamat,
            'kadar_sewaan_sejam_siang' => GeneralLabel::kadar_sewaan_sejam_siang,
            'kadar_sewaan_sehari_siang' => GeneralLabel::kadar_sewaan_sehari_siang,
            'kadar_sewaan_seminggu_siang' => GeneralLabel::kadar_sewaan_seminggu_siang,
            'kadar_sewaan_sebulan_siang' => GeneralLabel::kadar_sewaan_sebulan_siang,
            'kadar_sewaan_sejam_malam' => GeneralLabel::kadar_sewaan_sejam_malam,
            'kadar_sewaan_sehari_malam' => GeneralLabel::kadar_sewaan_sehari_malam,
            'kadar_sewaan_seminggu_malam' => GeneralLabel::kadar_sewaan_seminggu_malam,
            'kadar_sewaan_sebulan_malam' => GeneralLabel::kadar_sewaan_sebulan_malam,
            'kadar_sewaan_sejam_siang_cuti_umum' => GeneralLabel::kadar_sewaan_sejam_siang_cuti_umum,
            'kadar_sewaan_sehari_siang_cuti_umum' => GeneralLabel::kadar_sewaan_sehari_siang_cuti_umum,
            'kadar_sewaan_seminggu_siang_cuti_umum' => GeneralLabel::kadar_sewaan_seminggu_siang_cuti_umum,
            'kadar_sewaan_sebulan_siang_cuti_umum' => GeneralLabel::kadar_sewaan_sebulan_siang_cuti_umum,
            'kadar_sewaan_sejam_malam_cuti_umum' => GeneralLabel::kadar_sewaan_sejam_malam_cuti_umum,
            'kadar_sewaan_sehari_malam_cuti_umum' => GeneralLabel::kadar_sewaan_sehari_malam_cuti_umum,
            'kadar_sewaan_seminggu_malam_cuti_umum' => GeneralLabel::kadar_sewaan_seminggu_malam_cuti_umum,
            'kadar_sewaan_sebulan_malam_cuti_umum' => GeneralLabel::kadar_sewaan_sebulan_malam_cuti_umum,
            'location_alamat_1' => GeneralLabel::location_alamat_1,
            'location_alamat_2' => GeneralLabel::location_alamat_2,
            'location_alamat_3' => GeneralLabel::location_alamat_3,
            'location_alamat_negeri' => GeneralLabel::location_alamat_negeri,
            'location_alamat_bandar' => GeneralLabel::location_alamat_bandar,
            'location_alamat_poskod' => GeneralLabel::location_alamat_poskod,
            'lelaki' => GeneralLabel::lelaki,
            'wanita' => GeneralLabel::wanita,
            'melayu' => GeneralLabel::melayu,
            'cina' => GeneralLabel::cina,
            'india' => GeneralLabel::india,
            'lain_lain' => GeneralLabel::lain_lain,
            'jumlah_orang' => GeneralLabel::jumlah_orang,
            'catatan' => GeneralLabel::catatan,
            'negeri_search' => GeneralLabel::negeri_search,
            'kategori_hakmilik_search' => GeneralLabel::kategori_hakmilik_search,
            'agensi'=> GeneralLabel::agensi,
            'jumlah_jam'=> GeneralLabel::jumlah_jam,
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefPengurusanKemudahanVenue(){
        return $this->hasOne(PengurusanKemudahanVenue::className(), ['pengurusan_kemudahan_venue_id' => 'venue']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefStatusTempahanKemudahan(){
        return $this->hasOne(RefStatusTempahanKemudahan::className(), ['id' => 'status']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefJenisKadarKemudahan(){
        return $this->hasOne(RefJenisKadarKemudahanMsn::className(), ['id' => 'jenis_kadar']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefKategoriHakmilik(){
        return $this->hasOne(RefKategoriHakmilik::className(), ['id' => 'kategori_hakmilik']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefAgensiKemudahan(){
        return $this->hasOne(RefAgensiKemudahan::className(), ['id' => 'agensi']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefPengurusanKemudahanSediaAdaMsn(){
        return $this->hasOne(PengurusanKemudahanSediaAdaMsn::className(), ['pengurusan_kemudahan_sedia_ada_id' => 'kemudahan']);
    }
    
}
