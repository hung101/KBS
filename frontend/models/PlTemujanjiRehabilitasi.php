<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;
use app\models\general\Upload;
use app\models\general\GeneralMessage;
use app\models\general\GeneralLabel;
use common\models\general\GeneralFunction;

/**
 * This is the model class for table "tbl_pl_temujanji".
 *
 * @property integer $pl_temujanji_id
 * @property integer $atlet_id
 * @property string $tarikh_temujanji
 * @property string $doktor_pegawai_perubatan
 * @property string $makmal_perubatan
 * @property string $status_temujanji
 * @property string $pegawai_yang_bertanggungjawab
 * @property string $catitan_ringkas
 */
class PlTemujanjiRehabilitasi extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_pl_temujanji_rehabilitasi';
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
            [['tarikh_temujanji', 'doktor_pegawai_perubatan', 'status_temujanji', 'pegawai_yang_bertanggungjawab'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['atlet_id', 'nama_rehabilitasi', 'kategori_pesakit_luar', 'tindakan_selanjutnya'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['tarikh_temujanji'], 'safe'],
            [['doktor_pegawai_perubatan', 'makmal_perubatan', 'pegawai_yang_bertanggungjawab', 'nama_pesakit_luar'], 'string', 'max' => 80, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['status_temujanji'], 'string', 'max' => 30, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['catitan_ringkas', 'maklumbalas'], 'string', 'max' => 255, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['no_kad_pengenalan'], 'string', 'min' => 12, 'max' => 12, 'tooLong' => GeneralMessage::yii_validation_string_max, 'tooShort' => GeneralMessage::yii_validation_string_min],
            [['no_kad_pengenalan'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['muat_naik', 'gambar'],'validateFileUpload', 'skipOnEmpty' => false],
            [['doktor_pegawai_perubatan', 'makmal_perubatan', 'pegawai_yang_bertanggungjawab','nama_pesakit_luar','status_temujanji',
                'catitan_ringkas', 'maklumbalas'], function ($attribute, $params) {
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
            'pl_temujanji_id' => GeneralLabel::pl_temujanji_id,
            'atlet_id' => GeneralLabel::atlet_id,
            'tarikh_temujanji' => GeneralLabel::tarikh_temujanji,
            'doktor_pegawai_perubatan' => GeneralLabel::doktor_pegawai_perubatan,
            'makmal_perubatan' => GeneralLabel::makmal_perubatan,
            'status_temujanji' => GeneralLabel::status_temujanji,
            'pegawai_yang_bertanggungjawab' => GeneralLabel::pegawai_perubatan_pakar_perubatan_sukan,
            'catitan_ringkas' => GeneralLabel::catitan_ringkas,
            'nama_rehabilitasi' => GeneralLabel::pegawai_bertanggungjawab,
            'nama_pesakit_luar' => GeneralLabel::nama_pesakit_luar,
            'no_kad_pengenalan' => GeneralLabel::no_kad_pengenalan,
            'kategori_pesakit_luar' => GeneralLabel::kategori_pesakit_luar,
            'muat_naik' => GeneralLabel::muat_naik,
            'tindakan_selanjutnya' => GeneralLabel::tindakan_selanjutnya,
            'maklumbalas' => GeneralLabel::maklumbalas,
        ];
    }
    
    public function getRefStatusTemujanjiPesakitLuar()
    {
        return $this->hasOne(RefStatusTemujanjiFisioterapi::className(), ['id' => 'status_temujanji']);
    }
    
    public function getRefNamaFisioterapi()
    {
        return $this->hasOne(RefNamaFisioterapi::className(), ['id' => 'nama_rehabilitasi']);
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
}
