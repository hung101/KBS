<?php

namespace app\models;

use Yii;

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
            [['atlet_id_staff_id', 'program', 'tarikh_permohonan', 'status_permohonan', 'kategori_permohonan', 'kelulusan'], 'required', 'skipOnEmpty' => true],
            [['atlet_id_staff_id', 'kelulusan'], 'integer'],
            [['tarikh_permohonan'], 'safe'],
            [['program'], 'string', 'max' => 80],
            [['status_permohonan', 'kategori_permohonan'], 'string', 'max' => 30],
            [['catitan_ringkas'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'program_pendidikan_pencegahan_id' => 'Program Pendidikan Pencegahan ID',
            'atlet_id_staff_id' => 'Atlet Id Staff ID',
            'program' => 'Program',
            'tarikh_permohonan' => 'Tarikh Permohonan',
            'status_permohonan' => 'Status Permohonan',
            'kategori_permohonan' => 'Kategori Permohonan',
            'catitan_ringkas' => 'Catitan Ringkas',
            'kelulusan' => 'Kelulusan',
        ];
    }
}
