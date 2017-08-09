<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;
use app\models\general\Upload;
use app\models\general\GeneralMessage;
use app\models\general\GeneralLabel;
use common\models\general\GeneralFunction;

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
            [['nama_atlet', 'kategori', 'no_kad_pengenalan', 'no_telefon_1', 'no_telefon_2', 'tahun_pencalonan', 'nama_sukan', 'nama_acara', 'status_pencalonan', 
                'kejayaan', 'ulasan_kejayaan', 'sifat_kepimpinan_ketua_pasukan', 'sifat_kepimpinan_jurulatih', 'sifat_kepimpinan_asia_tenggara', 
                'sifat_kepimpinan_penolong_jurulatih', 'sifat_kepimpinan_pegawai_teknikal', 'nama_sukan_sebelum_dicalon', 'memenangi_kategori_dalam_anugerah_sukan', 
                'nama_kategori', 'tahun', 'kelulusan'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['tahun_pencalonan', 'tahun', 'tarikh_mesyuarat'], 'safe'],
            [['sifat_kepimpinan_ketua_pasukan', 'sifat_kepimpinan_jurulatih', 'sifat_kepimpinan_asia_tenggara', 'sifat_kepimpinan_penolong_jurulatih', 
                'sifat_kepimpinan_pegawai_teknikal', 'memenangi_kategori_dalam_anugerah_sukan', 'kelulusan', 'no_kad_pengenalan'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['nama_atlet', 'nama_sukan', 'nama_acara', 'susan_ranking_kebangsaan', 'susan_ranking_asia', 'susan_ranking_asia_tenggara', 'susan_ranking_dunia', 
                'nama_sukan_sebelum_dicalon', 'mewakili', 'pencalonan_olahragawan_tahun', 'pencalonan_olahragawati_tahun', 'pencalonan_pasukan_lelaki_kebangsaan_tahun', 
                'pencalonan_pasukan_wanita_kebangsaan_tahun', 'pencalonan_olahragawan_harapan_tahun', 'pencalonan_olahragawati_harapan_tahun', 'nama_kategori',
                'bil_mesyuarat'], 'string', 'max' => 80, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['status_pencalonan'], 'string', 'max' => 30, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['kejayaan', 'ulasan_kejayaan', 'gambar'], 'string', 'max' => 255, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['no_kad_pengenalan'], 'string', 'max' => 12, 'tooLong' => GeneralMessage::yii_validation_string_max],
                        [['no_telefon_1', 'no_telefon_2'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['no_telefon_1', 'no_telefon_2'], 'string', 'max' => 14, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['gambar'],'validateFileUpload', 'skipOnEmpty' => false],
            [['nama_atlet', 'nama_sukan', 'nama_acara', 'susan_ranking_kebangsaan', 'susan_ranking_asia', 'susan_ranking_asia_tenggara', 'susan_ranking_dunia', 
                'nama_sukan_sebelum_dicalon', 'mewakili', 'pencalonan_olahragawan_tahun', 'pencalonan_olahragawati_tahun', 'pencalonan_pasukan_lelaki_kebangsaan_tahun', 
                'pencalonan_pasukan_wanita_kebangsaan_tahun', 'pencalonan_olahragawan_harapan_tahun', 'pencalonan_olahragawati_harapan_tahun', 'nama_kategori',
                'bil_mesyuarat', 'status_pencalonan', 'kejayaan', 'ulasan_kejayaan'], 'filter', 'filter' => function ($value) {
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
            'anugerah_pencalonan_atlet' => GeneralLabel::anugerah_pencalonan_atlet,
            'nama_atlet' => GeneralLabel::nama_atlet,
            'tahun_pencalonan' => GeneralLabel::tahun_pencalonan,
            'nama_sukan' => GeneralLabel::sukan,
            'nama_acara' => GeneralLabel::nama_acara,
            'status_pencalonan' => GeneralLabel::status_pencalonan,
            'kejayaan' => GeneralLabel::kejayaan,
            'ulasan_kejayaan' => GeneralLabel::ulasan_pencapaian,
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
            'no_kad_pengenalan' => GeneralLabel::no_kad_pengenalan,
            'no_telefon_1' => GeneralLabel::no_tel,
            'no_telefon_2' => GeneralLabel::no_tel_bimbit,
            'kategori' => GeneralLabel::kategori,
            'bil_mesyuarat' => GeneralLabel::bil_mesyuarat,
            'tarikh_mesyuarat' => GeneralLabel::tarikh_mesyuarat,
            'gambar' => GeneralLabel::gambar,
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
        
        if($file){
            if(!GeneralFunction::checkFileExtension($file->getExtension())){
                $this->addError($attribute, GeneralMessage::uploadFileTypeError);
            }
        }
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
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefKategoriPencalonanAtlet(){
        return $this->hasOne(RefKategoriPencalonanAtlet::className(), ['id' => 'kategori']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefAtlet(){
        return $this->hasOne(Atlet::className(), ['atlet_id' => 'nama_atlet']);
    }
}
