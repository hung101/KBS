<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_permohonan_perganjuran_instructor".
 *
 * @property integer $permohonan_perganjuran_instructor_id
 * @property integer $permohonan_perganjuran_id
 * @property string $nama_instructor
 */
class PermohonanPerganjuranInstructor extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_permohonan_perganjuran_instructor';
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
            [['nama_instructor'], 'required', 'skipOnEmpty' => true],
            [['permohonan_perganjuran_id'], 'integer'],
            [['nama_instructor'], 'string', 'max' => 80]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'permohonan_perganjuran_instructor_id' => GeneralLabel::permohonan_perganjuran_instructor_id,
            'permohonan_perganjuran_id' => GeneralLabel::permohonan_perganjuran_id,
            'nama_instructor' => GeneralLabel::nama_instructor,

        ];
    }
}
