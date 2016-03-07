<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_pengurusan_kelayakan_jaringan_antarabangsa".
 *
 * @property integer $pengurusan_kelayakan_jaringan_antarabangsa_id
 * @property integer $pengurusan_jaringan_antarabangsa_id
 * @property string $nama_kursus
 * @property string $tarikh
 * @property string $tempat
 * @property string $tahap_kelayakan
 */
class PengurusanKelayakanJaringanAntarabangsa extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_pengurusan_kelayakan_jaringan_antarabangsa';
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
            [['nama_kursus', 'tarikh', 'tempat', 'tahap_kelayakan'], 'required', 'skipOnEmpty' => true],
            [['pengurusan_jaringan_antarabangsa_id'], 'integer'],
            [['tarikh'], 'safe'],
            [['nama_kursus', 'tahap_kelayakan'], 'string', 'max' => 80],
            [['tempat'], 'string', 'max' => 90]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pengurusan_kelayakan_jaringan_antarabangsa_id' => 'Pengurusan Kelayakan Jaringan Antarabangsa ID',
            'pengurusan_jaringan_antarabangsa_id' => 'Pengurusan Jaringan Antarabangsa ID',
            'nama_kursus' => 'Nama Kursus',
            'tarikh' => 'Tarikh',
            'tempat' => 'Tempat',
            'tahap_kelayakan' => 'Tahap Kelayakan',
        ];
    }
}
