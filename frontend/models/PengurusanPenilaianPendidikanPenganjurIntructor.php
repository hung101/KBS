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
            [['tarikh_kursus'], 'safe'],
            [['pengurusan_permohonan_kursus_persatuan_id'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['nama_penganjuran_kursus', 'instructor', 'nama_penyelaras'], 'string', 'max' => 80, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['tempat_kursus'], 'string', 'max' => 90, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['kod_kursus'], 'string', 'max' => 30, 'tooLong' => GeneralMessage::yii_validation_string_max]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pengurusan_penilaian_pendidikan_penganjur_intructor_id' => GeneralLabel::pengurusan_penilaian_pendidikan_penganjur_intructor_id,
            'pengurusan_permohonan_kursus_persatuan_id' => GeneralLabel::tarikh_kursus,
            'nama_penganjuran_kursus' => GeneralLabel::nama_kursus,
            'kod_kursus' => GeneralLabel::kod_kursus,
            'tarikh_kursus' => GeneralLabel::tarikh_kursus,
            'instructor' => GeneralLabel::instructor,
            'nama_penyelaras' => GeneralLabel::nama_penyelaras,
            'tempat_kursus' => GeneralLabel::tempat_kursus,
        ];
    }
}
