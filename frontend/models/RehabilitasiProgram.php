<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_rehabilitasi_program".
 *
 * @property integer $rehabilitasi_program_id
 * @property integer $rehabilitasi_id
 * @property string $tarikh
 * @property string $nama_exercise_modality
 */
class RehabilitasiProgram extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_rehabilitasi_program';
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
            [['rehabilitasi_id', 'tarikh', 'nama_exercise_modality'], 'required', 'skipOnEmpty' => true],
            [['rehabilitasi_id'], 'integer'],
            [['tarikh'], 'safe'],
            [['nama_exercise_modality'], 'string', 'max' => 80]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'rehabilitasi_program_id' => 'Rehabilitasi Program ID',
            'rehabilitasi_id' => 'Rehabilitasi ID',
            'tarikh' => 'Tarikh',
            'nama_exercise_modality' => 'Nama Exercise/Modality',
        ];
    }
}
