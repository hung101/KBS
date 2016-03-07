<?php

namespace app\models;

use Yii;

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
            'permohonan_perganjuran_instructor_id' => 'Permohonan Perganjuran Instruktur ID',
            'permohonan_perganjuran_id' => 'Permohonan Perganjuran ID',
            'nama_instructor' => 'Nama Instruktur',
        ];
    }
}
