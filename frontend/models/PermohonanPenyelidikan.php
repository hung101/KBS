<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;

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
            'permohonana_penyelidikan_id' => GeneralLabel::permohonana_penyelidikan_id,
            'nama_permohon' => GeneralLabel::nama_permohon,
            'tarikh_permohonan' => GeneralLabel::tarikh_permohonan,
            'tajuk_penyelidikan' => GeneralLabel::tajuk_penyelidikan,
            'ringkasan_permohonan' => GeneralLabel::ringkasan_permohonan,
            'biasa_dengan_keperluan_penyelidikan' => GeneralLabel::biasa_dengan_keperluan_penyelidikan,
            'kelulusan_echics' => GeneralLabel::kelulusan_echics,
            'kelulusan' => GeneralLabel::kelulusan,

        ];
    }
}
