<?php

namespace app\models;

use Yii;

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
            [['jurulatih','penganjur', 'nama_program', 'tarikh_program', 'tempat_program', 'kod_kursus', 'tahap'], 'required', 'skipOnEmpty' => true],
            [['peningkatan_kerjaya_jurulatih_id'], 'integer'],
            [['tarikh_program'], 'safe'],
            [['nama_program'], 'string', 'max' => 80],
            [['tempat_program'], 'string', 'max' => 90],
            [['kod_kursus', 'tahap'], 'string', 'max' => 30]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'akk_program_jurulatih_id' => 'Akk Program Jurulatih ID',
            'peningkatan_kerjaya_jurulatih_id' => 'Peningkatan Kerjaya Jurulatih ID',
            'jurulatih' => 'Jurulatih',
            'penganjur' => 'Penganjur',
            'nama_program' => 'Nama Program/Kursus/Seminar',
            'tarikh_program' => 'Tarikh',
            'tempat_program' => 'Tempat',
            'kod_kursus' => 'Kod Kursus',
            'tahap' => 'Tahap',
        ];
    }
}
