<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;

/**
 * This is the model class for table "tbl_anugerah_pencalonan_atlet".
 *
 * @property integer $anugerah_pencalonan_atlet
 * @property string $nama_atlet
 * @property string $tahun_pencalonan
 * @property string $nama_sukan
 * @property string $nama_acara
 * @property string $status_pencalonan
 * @property string $kejayaan
 * @property string $ulasan_kejayaan
 * @property string $susan_ranking_kebangsaan
 * @property string $susan_ranking_asia
 * @property string $susan_ranking_asia_tenggara
 * @property string $susan_ranking_dunia
 * @property integer $sifat_kepimpinan_ketua_pasukan
 * @property integer $sifat_kepimpinan_jurulatih
 * @property integer $sifat_kepimpinan_asia_tenggara
 * @property integer $sifat_kepimpinan_penolong_jurulatih
 * @property integer $sifat_kepimpinan_pegawai_teknikal
 * @property string $nama_sukan_sebelum_dicalon
 * @property string $mewakili
 * @property string $pencalonan_olahragawan_tahun
 * @property string $pencalonan_olahragawati_tahun
 * @property string $pencalonan_pasukan_lelaki_kebangsaan_tahun
 * @property string $pencalonan_pasukan_wanita_kebangsaan_tahun
 * @property string $pencalonan_olahragawan_harapan_tahun
 * @property string $pencalonan_olahragawati_harapan_tahun
 * @property integer $memenangi_kategori_dalam_anugerah_sukan
 * @property string $nama_kategori
 * @property string $tahun
 * @property integer $kelulusan
 */
class AnugerahPencalonanAtlet extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_anugerah_pencalonan_atlet';
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
            [['nama_atlet', 'tahun_pencalonan', 'nama_sukan', 'nama_acara', 'status_pencalonan', 'kejayaan', 'ulasan_kejayaan', 'sifat_kepimpinan_ketua_pasukan', 'sifat_kepimpinan_jurulatih', 'sifat_kepimpinan_asia_tenggara', 'sifat_kepimpinan_penolong_jurulatih', 'sifat_kepimpinan_pegawai_teknikal', 'nama_sukan_sebelum_dicalon', 'memenangi_kategori_dalam_anugerah_sukan', 'nama_kategori', 'tahun', 'kelulusan'], 'required', 'skipOnEmpty' => true],
            [['tahun_pencalonan', 'tahun'], 'safe'],
            [['sifat_kepimpinan_ketua_pasukan', 'sifat_kepimpinan_jurulatih', 'sifat_kepimpinan_asia_tenggara', 'sifat_kepimpinan_penolong_jurulatih', 'sifat_kepimpinan_pegawai_teknikal', 'memenangi_kategori_dalam_anugerah_sukan', 'kelulusan'], 'integer'],
            [['nama_atlet', 'nama_sukan', 'nama_acara', 'susan_ranking_kebangsaan', 'susan_ranking_asia', 'susan_ranking_asia_tenggara', 'susan_ranking_dunia', 'nama_sukan_sebelum_dicalon', 'mewakili', 'pencalonan_olahragawan_tahun', 'pencalonan_olahragawati_tahun', 'pencalonan_pasukan_lelaki_kebangsaan_tahun', 'pencalonan_pasukan_wanita_kebangsaan_tahun', 'pencalonan_olahragawan_harapan_tahun', 'pencalonan_olahragawati_harapan_tahun', 'nama_kategori'], 'string', 'max' => 80],
            [['status_pencalonan'], 'string', 'max' => 30],
            [['kejayaan', 'ulasan_kejayaan'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'anugerah_pencalonan_atlet' => GeneralLabel::anugerah_pencalonan_atlet,
            'nama_atlet' => GeneralLabel::nama_atlet,
            'tahun_pencalonan' => GeneralLabel::tahun_pencalonan,
            'nama_sukan' => GeneralLabel::nama_sukan,
            'nama_acara' => GeneralLabel::nama_acara,
            'status_pencalonan' => GeneralLabel::status_pencalonan,
            'kejayaan' => GeneralLabel::kejayaan,
            'ulasan_kejayaan' => GeneralLabel::ulasan_kejayaan,
            'susan_ranking_kebangsaan' => GeneralLabel::susan_ranking_kebangsaan,
            'susan_ranking_asia' => GeneralLabel::susan_ranking_asia,
            'susan_ranking_asia_tenggara' => GeneralLabel::susan_ranking_asia_tenggara,
            'susan_ranking_dunia' => GeneralLabel::susan_ranking_dunia,
            'sifat_kepimpinan_ketua_pasukan' => GeneralLabel::sifat_kepimpinan_ketua_pasukan,
            'sifat_kepimpinan_jurulatih' => GeneralLabel::sifat_kepimpinan_jurulatih,
            'sifat_kepimpinan_asia_tenggara' => GeneralLabel::sifat_kepimpinan_asia_tenggara,
            'sifat_kepimpinan_penolong_jurulatih' => GeneralLabel::sifat_kepimpinan_penolong_jurulatih,
            'sifat_kepimpinan_pegawai_teknikal' => GeneralLabel::sifat_kepimpinan_pegawai_teknikal,
            'nama_sukan_sebelum_dicalon' => GeneralLabel::nama_sukan_sebelum_dicalon,
            'mewakili' => GeneralLabel::mewakili,
            'pencalonan_olahragawan_tahun' => GeneralLabel::pencalonan_olahragawan_tahun,
            'pencalonan_olahragawati_tahun' => GeneralLabel::pencalonan_olahragawati_tahun,
            'pencalonan_pasukan_lelaki_kebangsaan_tahun' => GeneralLabel::pencalonan_pasukan_lelaki_kebangsaan_tahun,
            'pencalonan_pasukan_wanita_kebangsaan_tahun' => GeneralLabel::pencalonan_pasukan_wanita_kebangsaan_tahun,
            'pencalonan_olahragawan_harapan_tahun' => GeneralLabel::pencalonan_olahragawan_harapan_tahun,
            'pencalonan_olahragawati_harapan_tahun' => GeneralLabel::pencalonan_olahragawati_harapan_tahun,
            'memenangi_kategori_dalam_anugerah_sukan' => GeneralLabel::memenangi_kategori_dalam_anugerah_sukan,
            'nama_kategori' => GeneralLabel::nama_kategori,
            'tahun' => GeneralLabel::tahun,
            'kelulusan' => GeneralLabel::kelulusan,

        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefSukan(){
        return $this->hasOne(RefSukan::className(), ['id' => 'nama_sukan']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefAcara(){
        return $this->hasOne(RefAcara::className(), ['id' => 'nama_acara']);
    }
}
