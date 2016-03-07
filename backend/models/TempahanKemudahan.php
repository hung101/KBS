<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_tempahan_kemudahan".
 *
 * @property integer $tempahan_kemudahan_id
 * @property string $nama
 * @property string $no_kad_pengenalan
 * @property string $location
 * @property string $venue
 * @property string $tarikh_mula
 * @property string $catatan
 */
class TempahanKemudahan extends \yii\db\ActiveRecord
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
        return 'tbl_tempahan_kemudahan';
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
            [['nama', 'no_kad_pengenalan', 'no_tel', 'emel', 'kemudahan', 'bayaran_sewa', 'jenis_kadar', 'quantity_kadar', 'tarikh_mula', 'tarikh_akhir', 'jumlah_orang', 'status'], 'required', 'skipOnEmpty' => true],
            [['tarikh_mula'], 'safe'],
            [['nama', 'venue', 'nama_pemilik'], 'string', 'max' => 80],
            [['quantity_kadar'], 'string', 'max' => 11, 'skipOnEmpty' => true],
            [['no_kad_pengenalan'], 'string', 'max' => 12],
            [['tel_bimbit_no_pemilik', 'fax_no_pemilik'], 'string', 'max' => 14],
            [['location_alamat_1', 'location_alamat_2', 'location_alamat_3'], 'string', 'max' => 30],
            [['location_alamat_bandar', 'location_alamat_poskod'], 'string', 'max' => 5],
            [['location_alamat_negeri'], 'string', 'max' => 3],
            [['email_pemilik'], 'string', 'max' => 100],
            //[['lelaki', 'wanita', 'melayu', 'cina', 'india', 'lain_lain', 'jumlah_orang'], 'string', 'max' => 11],
            [['lelaki', 'wanita', 'melayu', 'cina', 'india', 'lain_lain', 'jumlah_orang', 'kemudahan', 'jenis_kadar', 'quantity_kadar', 'public_user_pemohon_id', 'public_user_pemilik_id', 'kategori_hakmilik'], 'integer', 'skipOnEmpty' => true],
            [['kadar_sewaan_sejam_siang','kadar_sewaan_sehari_siang','kadar_sewaan_seminggu_siang','kadar_sewaan_sebulan_siang','kadar_sewaan_sejam_malam','kadar_sewaan_sehari_malam','kadar_sewaan_seminggu_malam','kadar_sewaan_sebulan_malam'], 'number'],
            [['catatan'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'tempahan_kemudahan_id' => 'Tempahan Kemudahan ID',
            'nama' => 'Nama Pemohon',
            'no_kad_pengenalan' => 'No Kad Pengenalan',
            'no_tel' => 'No Tel',
            'emel' => 'Emel',
            'nama_pemilik' => 'Nama',
            'fax_no_pemilik' => 'No Faks',
            'tel_bimbit_no_pemilik' => 'No Tel',
            'email_pemilik' => 'Emel',
            'venue' => 'Venue',
            'kemudahan' => 'Kemudahan',
            'jenis_kadar' => 'Jenis Kadar',
            'quantity_kadar' => 'Kuantiti',
            'bayaran_sewa' => 'Bayaran Sewa',
            'tarikh_mula' => 'Tarikh & Masa Mula',
            'tarikh_akhir' => 'Tarikh & Masa Akhir',
            'kadar_sewaan_sejam_siang' => 'Sejam - Siang (RM)',
            'kadar_sewaan_sehari_siang' => 'Sehari - Siang (RM)',
            'kadar_sewaan_seminggu_siang' => 'Seminggu - Siang (RM)',
            'kadar_sewaan_sebulan_siang' => 'Sebulan - Siang (RM)',
            'kadar_sewaan_sejam_malam' => 'Sejam - Malam (RM)',
            'kadar_sewaan_sehari_malam' => 'Sehari - Malam (RM)',
            'kadar_sewaan_seminggu_malam' => 'Seminggu - Malam (RM)',
            'kadar_sewaan_sebulan_malam' => 'Sebulan - Malam (RM)',
            'location_alamat_1' => 'Lokasi Alamat',
            'location_alamat_2' => '',
            'location_alamat_3' => '',
            'location_alamat_negeri' => 'Negeri',
            'location_alamat_bandar' => 'Bandar',
            'location_alamat_poskod' => 'Poskod',
            'lelaki' => 'Lelaki',
            'wanita' => 'Wanita',
            'melayu' => 'Melayu',
            'cina' => 'Cina',
            'india' => 'India',
            'lain_lain' => 'Lain-lain',
            'jumlah_orang' => 'Jumlah Orang',
            'catatan' => 'Catatan',
            'negeri_search' => 'Negeri',
            'kategori_hakmilik_search' => 'Kategori Hakmilik',
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
        return $this->hasOne(RefJenisKadarKemudahan::className(), ['id' => 'jenis_kadar']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefKategoriHakmilik(){
        return $this->hasOne(RefKategoriHakmilik::className(), ['id' => 'kategori_hakmilik']);
    }
}
