<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_permohonan_perganjuran".
 *
 * @property integer $permohonan_perganjuran_id
 * @property string $tarikh_kursus
 * @property string $tempat_kursus
 * @property string $aktiviti
 * @property string $nama_instructor
 * @property integer $kelulusan
 */
class PermohonanPerganjuran extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_permohonan_perganjuran';
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
            [['tarikh_kursus', 'tempat_kursus', 'aktiviti', 'kelulusan'], 'required', 'skipOnEmpty' => true],
            [['tarikh_kursus'], 'safe'],
            [['kelulusan'], 'integer'],
            [['tempat_kursus'], 'string', 'max' => 90],
            [['aktiviti', 'nama_instructor'], 'string', 'max' => 80]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'permohonan_perganjuran_id' => GeneralLabel::permohonan_perganjuran_id,
            'tarikh_kursus' => GeneralLabel::tarikh_kursus,
            'tempat_kursus' => GeneralLabel::tempat_kursus,
            'aktiviti' => GeneralLabel::aktiviti,
            'nama_instructor' => GeneralLabel::nama_instructor,
            'kelulusan' => GeneralLabel::kelulusan,

        ];
    }
}
