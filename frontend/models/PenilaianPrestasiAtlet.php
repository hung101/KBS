<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_penilaian_prestasi_atlet".
 *
 * @property integer $penilaian_prestasi_atlet_id
 * @property integer $atlet_id
 * @property string $tahap_kesihatan
 * @property string $tahap_kecederaan
 * @property string $tahun_penilaian
 * @property string $jadual_latihan
 * @property string $nama_sukan
 * @property string $nama_acara
 * @property string $sasaran
 * @property string $keputusan
 * @property integer $break_record
 * @property string $maklumat_shakam_shakar
 */
class PenilaianPrestasiAtlet extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_penilaian_prestasi_atlet';
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
            [['atlet_id', 'nama_sukan', 'nama_acara', 'break_record', 'maklumat_shakam_shakar'], 'required', 'skipOnEmpty' => true],
            [['atlet_id', 'break_record'], 'integer'],
            [['tahun_penilaian', 'jadual_latihan'], 'safe'],
            [['tahap_kesihatan', 'tahap_kecederaan', 'nama_sukan', 'nama_acara', 'keputusan'], 'string', 'max' => 80],
            [['sasaran'], 'string', 'max' => 50],
            [['maklumat_shakam_shakar', 'ulasan', 'tindakan'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'penilaian_prestasi_atlet_id' => 'Penilaian Prestasi Atlet ID',
            'atlet_id' => 'Atlet',
            'tahap_kesihatan' => 'Tahap Kesihatan',
            'tahap_kecederaan' => 'Tahap Kecederaan',
            'kecederaan_tarikh_mula' => 'Kecederaan Tarikh Mula',
            'kecederaan_tarikh_tamat' => 'Kecederaan Tarikh Tamat',
            'ulasan' => 'Ulasan',
            'tindakan' => 'Tindakan',
            'tahun_penilaian' => 'Tahun Penilaian',
            'jadual_latihan' => 'Jadual Latihan',
            'nama_sukan' => 'Nama Sukan',
            'nama_acara' => 'Nama Acara',
            'sasaran' => 'Sasaran',
            'keputusan' => 'Keputusan',
            'break_record' => 'Break Record',
            'maklumat_shakam_shakar' => 'Maklumat Shakam Shakar',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefAtlet(){
        return $this->hasOne(Atlet::className(), ['atlet_id' => 'atlet_id']);
    }
}
