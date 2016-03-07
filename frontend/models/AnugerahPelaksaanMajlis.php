<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_anugerah_pelaksaan_majlis".
 *
 * @property integer $anugerah_pelaksaan_majlis_id
 * @property string $tarikh_majlis_anugerah
 * @property string $nama_ahli_jawatan_kuasa
 * @property string $jawatan
 * @property string $tarikh_pelantikan
 * @property string $tempoh
 * @property string $nama_tugas
 * @property string $status_tugas
 */
class AnugerahPelaksaanMajlis extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_anugerah_pelaksaan_majlis';
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
            [['tarikh_majlis_anugerah', 'nama_ahli_jawatan_kuasa', 'tarikh_pelantikan', 'tempoh'], 'required', 'skipOnEmpty' => true],
            [['tarikh_majlis_anugerah', 'tarikh_pelantikan'], 'safe'],
            [['nama_ahli_jawatan_kuasa', 'jawatan', 'nama_tugas'], 'string', 'max' => 80],
            [['tempoh', 'status_tugas'], 'string', 'max' => 30]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'anugerah_pelaksaan_majlis_id' => 'Anugerah Pelaksaan Majlis ID',
            'tarikh_majlis_anugerah' => 'Tarikh Majlis Anugerah',
            'nama_ahli_jawatan_kuasa' => 'Nama Ahli Jawatan Kuasa',
            'jawatan' => 'Jawatan',
            'tarikh_pelantikan' => 'Tarikh Pelantikan',
            'tempoh' => 'Tempoh',
            'nama_tugas' => 'Nama Tugas',
            'status_tugas' => 'Status Tugas',
        ];
    }
}
