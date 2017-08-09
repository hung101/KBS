<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;
use app\models\general\Upload;
use app\models\general\GeneralMessage;
use app\models\general\GeneralLabel;
use common\models\general\GeneralFunction;

/**
 * This is the model class for table "tbl_gaji_dan_elaun_jurulatih".
 *
 * @property integer $gaji_dan_elaun_jurulatih_id
 * @property integer $nama_jurulatih
 * @property string $no_kad_pengenalan
 * @property string $no_passport
 * @property string $nama_sukan
 * @property string $tarikh_mula
 * @property string $bank
 * @property string $no_akaun
 * @property string $cawangan
 * @property string $catatan
 */
class GajiDanElaunJurulatih extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_gaji_dan_elaun_jurulatih';
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
            [['nama_jurulatih', 'bank', 'no_akaun', 'cawangan'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['nama_jurulatih', 'program', 'no_kad_pengenalan', 'no_akaun'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['no_kad_pengenalan'], 'string', 'max' => 12, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['no_passport'], 'string', 'max' => 15, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['nama_sukan', 'bank', 'cawangan'], 'string', 'max' => 80, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['tarikh_mula', 'tarikh_tamat', 'tarikh_jkb', 'tarikh_mpj', 'status_tawaran_jkb', 'status_tawaran_mpj'], 'safe'],
            [['no_pekerja', 'no_kwsp'], 'string', 'max' => 30, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['dokumen_muat_naik'], 'string', 'max' => 100, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['no_akaun', 'bil_jkb', 'bil_mpj'], 'string', 'max' => 50, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['catatan', 'pengerusi', 'kelulusan_dkp', 'catatan_jkb', 'catatan_mpj'], 'string', 'max' => 255, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['dokumen_muat_naik', 'surat_tawaran', 'kelulusan_pinjaman', 'rekod_cuti'],'validateFileUpload', 'skipOnEmpty' => false],
            [['no_passport','nama_sukan', 'bank', 'cawangan','no_pekerja', 'no_kwsp','no_akaun', 'bil_jkb', 'bil_mpj',
                'catatan', 'pengerusi', 'kelulusan_dkp', 'catatan_jkb', 'catatan_mpj'], 'filter', 'filter' => function ($value) {
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
            'gaji_dan_elaun_jurulatih_id' => GeneralLabel::gaji_dan_elaun_jurulatih_id,
            'nama_jurulatih' => GeneralLabel::nama_jurulatih,
            'no_kad_pengenalan' => GeneralLabel::no_kad_pengenalan,
            'no_passport' => GeneralLabel::no_passport,
            'nama_sukan' => GeneralLabel::nama_sukan,
            'tarikh_mula' => GeneralLabel::tarikh_mula,
            'tarikh_tamat' => GeneralLabel::tarikh_tamat,
            'bank' => GeneralLabel::bank,
            'no_akaun' => GeneralLabel::no_akaun,
            'cawangan' => GeneralLabel::cawangan,
            'catatan' => GeneralLabel::catatan,
            'program' => GeneralLabel::program,
            'no_pekerja' => GeneralLabel::no_pekerja,
            'dokumen_muat_naik' => GeneralLabel::dokumen_muat_naik_buku_akaun,
            'no_kwsp' => GeneralLabel::no_kwsp,
            'surat_tawaran' => GeneralLabel::surat_tawaran,
            'kelulusan_pinjaman' => GeneralLabel::kelulusan_pinjaman,
            'rekod_cuti' => GeneralLabel::rekod_cuti,
            'bil_jkb' => GeneralLabel::bilangan_jkb,
            'tarikh_jkb' => GeneralLabel::tarikh_jkb,
            'status_tawaran_jkb' => GeneralLabel::status_tawaran_jkb,
            'kelulusan_dkp' => GeneralLabel::kelulusan_dkp,
            'catatan_jkb' => GeneralLabel::catatan,
            'bil_mpj' => GeneralLabel::bilangan_mpj,
            'tarikh_mpj' => GeneralLabel::tarikh_mpj,
            'status_tawaran_mpj' => GeneralLabel::status_tawaran_mpj,
            'pengerusi' => GeneralLabel::pengerusi,
            'catatan_mpj' => GeneralLabel::catatan,
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
    public function getRefJurulatih(){
        return $this->hasOne(Jurulatih::className(), ['jurulatih_id' => 'nama_jurulatih']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefBank(){
        return $this->hasOne(RefBank::className(), ['id' => 'bank']);
    }
}
