<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_peningkatan_kerjaya_jurulatih".
 *
 * @property integer $peningkatan_kerjaya_jurulatih_id
 * @property string $nama_jurulatih
 * @property string $cawangan
 * @property string $sub_cawangan
 * @property string $program_msn
 * @property string $lain_lain_program
 * @property string $pusat_latihan
 * @property string $nama_sukan
 * @property string $nama_acara
 */
class PeningkatanKerjayaJurulatih extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_peningkatan_kerjaya_jurulatih';
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
            [['nama_jurulatih', 'cawangan', 'sub_cawangan', 'program_msn', 'lain_lain_program', 'pusat_latihan', 'nama_sukan', 'nama_acara'], 'required', 'skipOnEmpty' => true],
            [['nama_jurulatih', 'cawangan', 'sub_cawangan', 'program_msn', 'lain_lain_program', 'pusat_latihan', 'nama_sukan', 'nama_acara'], 'string', 'max' => 80]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'peningkatan_kerjaya_jurulatih_id' => 'Peningkatan Kerjaya Jurulatih ID',
            'nama_jurulatih' => 'Nama Jurulatih',
            'cawangan' => 'Cawangan',
            'sub_cawangan' => 'Sub Cawangan',
            'program_msn' => 'Program Msn',
            'lain_lain_program' => 'Lain Lain Program',
            'pusat_latihan' => 'Pusat Latihan',
            'nama_sukan' => 'Nama Sukan',
            'nama_acara' => 'Nama Acara',
        ];
    }
}
