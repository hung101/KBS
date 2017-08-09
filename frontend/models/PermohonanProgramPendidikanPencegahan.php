<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_permohonan_program_pendidikan_pencegahan".
 *
 * @property integer $program_pendidikan_pencegahan_id
 * @property integer $atlet_id_staff_id
 * @property string $program
 * @property string $tarikh_permohonan
 * @property string $status_permohonan
 * @property string $kategori_permohonan
 * @property string $catitan_ringkas
 * @property integer $kelulusan
 */
class PermohonanProgramPendidikanPencegahan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_permohonan_program_pendidikan_pencegahan';
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
            [['atlet_id_staff_id', 'program', 'tarikh_permohonan', 'status_permohonan', 'kategori_permohonan', 'kelulusan'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['atlet_id_staff_id', 'kelulusan'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['tarikh_permohonan'], 'safe'],
            [['program'], 'string', 'max' => 80, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['status_permohonan', 'kategori_permohonan'], 'string', 'max' => 30, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['catitan_ringkas'], 'string', 'max' => 255, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['program','status_permohonan', 'kategori_permohonan','catitan_ringkas'], 'filter', 'filter' => function ($value) {
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
            'program_pendidikan_pencegahan_id' => GeneralLabel::program_pendidikan_pencegahan_id,
            'atlet_id_staff_id' => GeneralLabel::atlet_id_staff_id,
            'program' => GeneralLabel::program,
            'tarikh_permohonan' => GeneralLabel::tarikh_permohonan,
            'status_permohonan' => GeneralLabel::status_permohonan,
            'kategori_permohonan' => GeneralLabel::kategori_permohonan,
            'catitan_ringkas' => GeneralLabel::catitan_ringkas,
            'kelulusan' => GeneralLabel::kelulusan,

        ];
    }
}
