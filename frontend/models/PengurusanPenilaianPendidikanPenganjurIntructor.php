<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_pengurusan_penilaian_pendidikan_penganjur_intructor".
 *
 * @property integer $pengurusan_penilaian_pendidikan_penganjur_intructor_id
 * @property string $nama_penganjuran_kursus
 * @property string $kod_kursus
 * @property string $tarikh_kursus
 * @property string $instructor
 */
class PengurusanPenilaianPendidikanPenganjurIntructor extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_pengurusan_penilaian_pendidikan_penganjur_intructor';
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
            [['nama_penganjuran_kursus', 'tarikh_kursus', 'instructor'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['tarikh_kursus', 'tarikh_tamat_kursus'], 'safe'],
            [['pengurusan_permohonan_kursus_persatuan_id', 'tahap'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['nama_penganjuran_kursus', 'instructor', 'nama_penyelaras'], 'string', 'max' => 80, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['tempat_kursus'], 'string', 'max' => 90, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['kod_kursus'], 'string', 'max' => 30, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['nama_penganjuran_kursus', 'instructor', 'nama_penyelaras','tempat_kursus','kod_kursus'], function ($attribute, $params) {
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
            'pengurusan_penilaian_pendidikan_penganjur_intructor_id' => GeneralLabel::pengurusan_penilaian_pendidikan_penganjur_intructor_id,
            'pengurusan_permohonan_kursus_persatuan_id' => GeneralLabel::agensi,
            'nama_penganjuran_kursus' => GeneralLabel::nama_kursus,
            'kod_kursus' => GeneralLabel::kod_kursus,
            'tarikh_kursus' => GeneralLabel::tarikh_mula_kursus,
            'instructor' => GeneralLabel::instructor,
            'nama_penyelaras' => GeneralLabel::nama_penyelaras,
            'tempat_kursus' => GeneralLabel::tempat_kursus,
			'tahap' => GeneralLabel::tahap,
			'tarikh_tamat_kursus' => GeneralLabel::tarikh_tamat_kursus,
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefPengurusanPermohonanKursusPersatuan(){
        return $this->hasOne(PengurusanPermohonanKursusPersatuan::className(), ['pengurusan_permohonan_kursus_persatuan_id' => 'pengurusan_permohonan_kursus_persatuan_id']);
    }
}
