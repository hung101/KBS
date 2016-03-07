<?php

namespace app\models;

use Yii;

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
            [['nama_penganjuran_kursus', 'kod_kursus', 'tarikh_kursus', 'instructor'], 'required', 'skipOnEmpty' => true],
            [['tarikh_kursus'], 'safe'],
            [['nama_penganjuran_kursus', 'instructor'], 'string', 'max' => 80],
            [['kod_kursus'], 'string', 'max' => 30]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pengurusan_penilaian_pendidikan_penganjur_intructor_id' => 'Pengurusan Penilaian Pendidikan Penganjur Intructor ID',
            'nama_penganjuran_kursus' => 'Nama Penganjuran Kursus',
            'kod_kursus' => 'Kod Kursus',
            'tarikh_kursus' => 'Tarikh Kursus',
            'instructor' => 'Instructor',
        ];
    }
}
