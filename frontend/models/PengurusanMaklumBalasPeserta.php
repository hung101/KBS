<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_pengurusan_maklum_balas_peserta".
 *
 * @property integer $pengurusan_maklum_balas_peserta_id
 * @property string $nama_penganjuran_kursus
 * @property string $kod_kursus
 * @property string $tarikh_kursus
 * @property string $catatan
 */
class PengurusanMaklumBalasPeserta extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_pengurusan_maklum_balas_peserta';
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
            [['nama_penganjuran_kursus', 'jantina', 'bangsa'], 'required', 'skipOnEmpty' => true],
            [['tarikh_kursus'], 'safe'],
            [['nama_penganjuran_kursus'], 'string', 'max' => 80],
            [['kod_kursus'], 'string', 'max' => 30],
            [['catatan'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pengurusan_maklum_balas_peserta_id' => 'Pengurusan Maklum Balas Peserta ID',
            'nama_penganjuran_kursus' => 'Nama',
            'jantina' => 'Jantina',
            'bangsa' => 'Bangsa',
            'kod_kursus' => 'Kod Kursus',
            'tarikh_kursus' => 'Tarikh Kursus',
            'catatan' => 'Catatan',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefJantina(){
        return $this->hasOne(RefJantina::className(), ['id' => 'jantina']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefBangsa(){
        return $this->hasOne(RefBangsa::className(), ['id' => 'bangsa']);
    }
}
