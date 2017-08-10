<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;
use app\models\general\Upload;
use app\models\general\GeneralMessage;
use app\models\general\GeneralLabel;
use common\models\general\GeneralFunction;

/**
 * This is the model class for table "tbl_profil_badan_sukan".
 *
 * @property integer $profil_badan_sukan
 * @property string $nama_badan_sukan
 * @property string $nama_badan_sukan_sebelum_ini
 * @property string $no_pendaftaran_sijil_pendaftaran
 * @property string $tarikh_lulus_pendaftaran
 * @property string $jenis_sukan
 * @property string $alamat_tetap_badan_sukan
 * @property string $alamat_surat_menyurat_badan_sukan
 * @property integer $no_telefon_pejabat
 * @property integer $no_faks_pejabat
 * @property string $emel_badan_sukan
 * @property string $pengiktirafan_yang_pernah_diterima_badan_sukan
 */
class ProfilBadanSukan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_profil_badan_sukan';
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
        if(Yii::$app->user->identity->profil_badan_sukan){
            return [
                [['nama_badan_sukan', 'no_pendaftaran', 'nama_badan_sukan_sebelum_ini', 'no_pendaftaran_sijil_pendaftaran', 'tarikh_lulus_pendaftaran', 'peringkat_badan_sukan', 'jenis_sukan', 'no_telefon_pejabat'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
                [['tarikh_lulus_pendaftaran', 'tarikh_kelulusan_Terkini', 'tarikh_pindaan', 'tarikh_kelulusan'], 'safe'],
                [['no_telefon_pejabat', 'no_telefon_pejabat_2', 'no_telefon_pejabat_3', 'no_tel_bimbit', 'no_faks_pejabat', 'alamat_tetap_badan_sukan_poskod', 'alamat_surat_menyurat_badan_sukan_poskod', 'status'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
                [['no_telefon_pejabat', 'no_telefon_pejabat_2', 'no_telefon_pejabat_3', 'no_tel_bimbit', 'no_faks_pejabat'], 'string', 'max' => 14, 'tooLong' => GeneralMessage::yii_validation_string_max],
                [['nama_badan_sukan', 'nama_badan_sukan_sebelum_ini', 'emel_badan_sukan', 'pengiktirafan_yang_pernah_diterima_badan_sukan'], 'string', 'max' => 100, 'tooLong' => GeneralMessage::yii_validation_string_max],
                [['jenis_sukan', 'alamat_tetap_badan_sukan_1', 'alamat_tetap_badan_sukan_2', 'alamat_tetap_badan_sukan_3', 'alamat_tetap_badan_sukan_bandar', 'alamat_surat_menyurat_badan_sukan_1', 'alamat_surat_menyurat_badan_sukan_2', 'alamat_surat_menyurat_badan_sukan_3', 'alamat_surat_menyurat_badan_sukan_bandar'], 'string', 'max' => 30, 'tooLong' => GeneralMessage::yii_validation_string_max],
                [['alamat_tetap_badan_sukan_negeri', 'alamat_surat_menyurat_badan_sukan_negeri'], 'string', 'max' => 20, 'tooLong' => GeneralMessage::yii_validation_string_max],
                [['no_pendaftaran'], 'string', 'max' => 30, 'tooLong' => GeneralMessage::yii_validation_string_max],
                [['alamat_tetap_badan_sukan_poskod', 'alamat_surat_menyurat_badan_sukan_poskod'], 'string', 'max' => 5, 'tooLong' => GeneralMessage::yii_validation_string_max],
                [['no_pendaftaran_sijil_pendaftaran'], 'string', 'max' => 100, 'tooLong' => GeneralMessage::yii_validation_string_max],
                [['bilangan_pindaan_perlembagaan_dilakukan'], 'string', 'max' => 50, 'tooLong' => GeneralMessage::yii_validation_string_max],
                [['muat_naik_perlembagaan_terkini', 'gambar'],'validateFileUpload', 'skipOnEmpty' => false],
                [['emel_badan_sukan'], 'email', 'message' => GeneralMessage::yii_validation_email],
                [['nama_badan_sukan', 'nama_badan_sukan_sebelum_ini', 'emel_badan_sukan', 'pengiktirafan_yang_pernah_diterima_badan_sukan','jenis_sukan', 
                    'alamat_tetap_badan_sukan_1', 'alamat_tetap_badan_sukan_2', 'alamat_tetap_badan_sukan_3', 'alamat_tetap_badan_sukan_bandar', 
                    'alamat_surat_menyurat_badan_sukan_1', 'alamat_surat_menyurat_badan_sukan_2', 'alamat_surat_menyurat_badan_sukan_3', 
                    'alamat_surat_menyurat_badan_sukan_bandar','alamat_tetap_badan_sukan_negeri', 'alamat_surat_menyurat_badan_sukan_negeri','no_pendaftaran',
                    'no_pendaftaran_sijil_pendaftaran','bilangan_pindaan_perlembagaan_dilakukan'], 'filter', 'filter' => function ($value) {
                    return  \common\models\general\GeneralFunction::filterXSS($value);
                }],
            ];
        } else {
            return [
                [['nama_badan_sukan', 'nama_badan_sukan_sebelum_ini'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
                [['tarikh_lulus_pendaftaran', 'tarikh_kelulusan_Terkini', 'tarikh_pindaan', 'tarikh_kelulusan'], 'safe'],
                [['no_telefon_pejabat', 'no_telefon_pejabat_2', 'no_telefon_pejabat_3', 'no_tel_bimbit', 'no_faks_pejabat', 'alamat_tetap_badan_sukan_poskod', 'alamat_surat_menyurat_badan_sukan_poskod', 'status'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
                [['no_telefon_pejabat', 'no_telefon_pejabat_2', 'no_telefon_pejabat_3', 'no_tel_bimbit', 'no_faks_pejabat'], 'string', 'max' => 14, 'tooLong' => GeneralMessage::yii_validation_string_max],
                [['nama_badan_sukan', 'nama_badan_sukan_sebelum_ini', 'emel_badan_sukan', 'pengiktirafan_yang_pernah_diterima_badan_sukan'], 'string', 'max' => 100, 'tooLong' => GeneralMessage::yii_validation_string_max],
                [['jenis_sukan', 'alamat_tetap_badan_sukan_1', 'alamat_tetap_badan_sukan_2', 'alamat_tetap_badan_sukan_3', 'alamat_tetap_badan_sukan_bandar', 'alamat_surat_menyurat_badan_sukan_1', 'alamat_surat_menyurat_badan_sukan_2', 'alamat_surat_menyurat_badan_sukan_3', 'alamat_surat_menyurat_badan_sukan_bandar'], 'string', 'max' => 30, 'tooLong' => GeneralMessage::yii_validation_string_max],
                [['alamat_tetap_badan_sukan_negeri', 'alamat_surat_menyurat_badan_sukan_negeri'], 'string', 'max' => 20, 'tooLong' => GeneralMessage::yii_validation_string_max],
                [['no_pendaftaran'], 'string', 'max' => 30, 'tooLong' => GeneralMessage::yii_validation_string_max],
                [['alamat_tetap_badan_sukan_poskod', 'alamat_surat_menyurat_badan_sukan_poskod'], 'string', 'max' => 5, 'tooLong' => GeneralMessage::yii_validation_string_max],
                [['no_pendaftaran_sijil_pendaftaran'], 'string', 'max' => 100, 'tooLong' => GeneralMessage::yii_validation_string_max],
                [['bilangan_pindaan_perlembagaan_dilakukan'], 'string', 'max' => 50, 'tooLong' => GeneralMessage::yii_validation_string_max],
                [['muat_naik_perlembagaan_terkini', 'gambar'],'validateFileUpload', 'skipOnEmpty' => false],
                [['emel_badan_sukan'], 'email', 'message' => GeneralMessage::yii_validation_email],
                [['nama_badan_sukan', 'nama_badan_sukan_sebelum_ini', 'emel_badan_sukan', 'pengiktirafan_yang_pernah_diterima_badan_sukan','jenis_sukan', 
                    'alamat_tetap_badan_sukan_1', 'alamat_tetap_badan_sukan_2', 'alamat_tetap_badan_sukan_3', 'alamat_tetap_badan_sukan_bandar', 
                    'alamat_surat_menyurat_badan_sukan_1', 'alamat_surat_menyurat_badan_sukan_2', 'alamat_surat_menyurat_badan_sukan_3', 
                    'alamat_surat_menyurat_badan_sukan_bandar','alamat_tetap_badan_sukan_negeri', 'alamat_surat_menyurat_badan_sukan_negeri','no_pendaftaran',
                    'no_pendaftaran_sijil_pendaftaran','bilangan_pindaan_perlembagaan_dilakukan'], 'filter', 'filter' => function ($value) {
                    return  \common\models\general\GeneralFunction::filterXSS($value);
                }],
            ];
        }
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'profil_badan_sukan' => GeneralLabel::profil_badan_sukan,
            'nama_badan_sukan' => GeneralLabel::nama_badan_sukan,
            'nama_badan_sukan_sebelum_ini' => GeneralLabel::nama_badan_sukan_sebelum_ini,
            'no_pendaftaran_sijil_pendaftaran' => GeneralLabel::no_pendaftaran_sijil_pendaftaran,
            'no_pendaftaran' => GeneralLabel::no_pendaftaran,
            'tarikh_lulus_pendaftaran' => GeneralLabel::tarikh_lulus_pendaftaran,
            'peringkat_badan_sukan' => GeneralLabel::peringkat_badan_sukan,
            'jenis_sukan' => GeneralLabel::jenis_sukan,
            'alamat_tetap_badan_sukan_1' => GeneralLabel::alamat_tetap_badan_sukan_1,
            'alamat_tetap_badan_sukan_2' => GeneralLabel::alamat_tetap_badan_sukan_2,
            'alamat_tetap_badan_sukan_3' => GeneralLabel::alamat_tetap_badan_sukan_3,
            'alamat_tetap_badan_sukan_negeri' => GeneralLabel::alamat_tetap_badan_sukan_negeri,
            'alamat_tetap_badan_sukan_bandar' => GeneralLabel::alamat_tetap_badan_sukan_bandar,
            'alamat_tetap_badan_sukan_poskod' => GeneralLabel::alamat_tetap_badan_sukan_poskod,
            'alamat_surat_menyurat_badan_sukan_1' => GeneralLabel::alamat_surat_menyurat_badan_sukan_1,
            'alamat_surat_menyurat_badan_sukan_2' => GeneralLabel::alamat_surat_menyurat_badan_sukan_2,
            'alamat_surat_menyurat_badan_sukan_3' => GeneralLabel::alamat_surat_menyurat_badan_sukan_3,
            'alamat_surat_menyurat_badan_sukan_negeri' => GeneralLabel::alamat_surat_menyurat_badan_sukan_negeri,
            'alamat_surat_menyurat_badan_sukan_bandar' => GeneralLabel::alamat_surat_menyurat_badan_sukan_bandar,
            'alamat_surat_menyurat_badan_sukan_poskod' => GeneralLabel::alamat_surat_menyurat_badan_sukan_poskod,
            'no_telefon_pejabat' => GeneralLabel::no_telefon_pejabat,
            'no_telefon_pejabat_2' => GeneralLabel::no_telefon_pejabat_2,
            'no_telefon_pejabat_3' => GeneralLabel::no_telefon_pejabat_3,
            'no_tel_bimbit' => GeneralLabel::no_tel_bimbit,
            'no_faks_pejabat' => GeneralLabel::no_faks_pejabat,
            'emel_badan_sukan' => GeneralLabel::emel_badan_sukan,
            'pengiktirafan_yang_pernah_diterima_badan_sukan' => GeneralLabel::pengiktirafan_yang_pernah_diterima_badan_sukan,
            'status' => GeneralLabel::status,

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
    public function getRefStatusLaporanMesyuaratAgung(){
        return $this->hasOne(RefStatusLaporanMesyuaratAgung::className(), ['id' => 'status']);
    }
}
