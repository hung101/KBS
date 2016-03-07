<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_permohonan_penyelidikan".
 *
 * @property integer $permohonana_penyelidikan_id
 * @property string $nama_permohon
 * @property string $tarikh_permohonan
 * @property string $tajuk_penyelidikan
 * @property string $ringkasan_permohonan
 * @property integer $biasa_dengan_keperluan_penyelidikan
 * @property integer $kelulusan_echics
 * @property integer $kelulusan
 */
class PermohonanPenyelidikan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_permohonan_penyelidikan';
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
            [['nama_permohon', 'tarikh_permohonan', 'tajuk_penyelidikan', 'ringkasan_permohonan', 'biasa_dengan_keperluan_penyelidikan', 'kelulusan_echics', 'kelulusan'], 'required', 'skipOnEmpty' => true],
            [['tarikh_permohonan'], 'safe'],
            [['biasa_dengan_keperluan_penyelidikan', 'kelulusan_echics', 'kelulusan'], 'integer'],
            [['nama_permohon', 'tajuk_penyelidikan'], 'string', 'max' => 80],
            [['ringkasan_permohonan'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'permohonana_penyelidikan_id' => 'Permohonana Penyelidikan ID',
            'nama_permohon' => 'Nama Permohon',
            'tarikh_permohonan' => 'Tarikh Permohonan',
            'tajuk_penyelidikan' => 'Tajuk Penyelidikan',
            'ringkasan_permohonan' => 'Ringkasan Permohonan',
            'biasa_dengan_keperluan_penyelidikan' => 'Biasa Dengan Keperluan Penyelidikan',
            'kelulusan_echics' => 'Kelulusan Echics',
            'kelulusan' => 'Kelulusan Permohonan',
        ];
    }
}
