<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;
use app\models\general\Upload;
use app\models\general\GeneralMessage;
use app\models\general\GeneralLabel;

/**
 * This is the model class for table "tbl_akk_program_jurulatih".
 *
 * @property integer $akk_program_jurulatih_id
 * @property integer $peningkatan_kerjaya_jurulatih_id
 * @property string $nama_program
 * @property string $tarikh_program
 * @property string $tempat_program
 * @property string $kod_kursus
 * @property string $tahap
 */
class AkkProgramJurulatih extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_akk_program_jurulatih';
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
            [['jurulatih','penganjur', 'nama_program', 'tarikh_program', 'tempat_program'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['peningkatan_kerjaya_jurulatih_id', 'senarai_kursus_akk'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['tarikh_program', 'tarikh_mpj', 'tarikh_jkb', 'kelulusan_mpj', 'kelulusan_jkb'], 'safe'],
            [['nama_program', 'bilangan_mpj', 'bilangan_jkb'], 'string', 'max' => 80, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['tempat_program'], 'string', 'max' => 90, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['kod_kursus', 'tahap'], 'string', 'max' => 30, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['catatan'], 'string', 'max' => 255, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['muat_naik'],'validateFileUpload', 'skipOnEmpty' => false],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'akk_program_jurulatih_id' => GeneralLabel::akk_program_jurulatih_id,
            'peningkatan_kerjaya_jurulatih_id' => GeneralLabel::peningkatan_kerjaya_jurulatih_id,
            'jurulatih' => GeneralLabel::jurulatih,
            'penganjur' => GeneralLabel::penganjur,
            'nama_program' => GeneralLabel::nama_program,
            'tarikh_program' => GeneralLabel::tarikh_program,
            'tempat_program' => GeneralLabel::tempat_program,
            'kod_kursus' => GeneralLabel::kod_kursus,
            'tahap' => GeneralLabel::tahap,
            'muat_naik' => GeneralLabel::muat_naik,
            'catatan' => GeneralLabel::catatan,
            'senarai_kursus_akk' => GeneralLabel::senarai_kursus_akk,
            'bilangan_mpj' => GeneralLabel::bilangan_mpj,
            'tarikh_mpj' => GeneralLabel::tarikh_mpj,
            'kelulusan_mpj' => GeneralLabel::kelulusan_mpj,
            'bilangan_jkb' => GeneralLabel::bilangan_jkb,
            'tarikh_jkb' => GeneralLabel::tarikh_jkb,
            'kelulusan_jkb' => GeneralLabel::kelulusan_jkb,
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefAkkProgramJurulatihPeserta(){
        return $this->hasMany(AkkProgramJurulatihPeserta::className(), ['akk_program_jurulatih_id' => 'akk_program_jurulatih_id']);
    }
    
    /**
     * Validate upload file cannot be empty
     */
    public function validateFileUpload($attribute, $params){
        $file = UploadedFile::getInstance($this, $attribute);
        
        if($file && $file->getHasError()){
            $this->addError($attribute, 'File error :' . Upload::getUploadErrorDesc($file->error));
        }
    }
}
