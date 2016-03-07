<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_pl_data_klinikal".
 *
 * @property integer $pl_data_klinikal_id
 * @property integer $atlet_id
 * @property string $penglihatan_tanpa_cermin_mata_kiri
 * @property string $penglihatan_tanpa_cermin_mata_kanan
 * @property string $penglihatan_cermin_mata_kiri
 * @property string $penglihatan_cermin_mata_kanan
 * @property integer $usia_kali_pertama_haid
 * @property string $haid_kitaran
 * @property string $status_haid
 * @property string $haid_kali_terakhir_hari_pertama
 * @property string $kali_terakhir_bersalin
 * @property integer $bilangan_kanak_kanak
 * @property string $masalah_haid
 * @property integer $perokok_tempoh
 * @property string $status_perokok
 * @property integer $alkohol
 * @property string $jenis_alkohol
 * @property string $diet_harian
 * @property integer $berat_badan_turun
 * @property integer $berat_badan_naik
 */
class PlDataKlinikal extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_pl_data_klinikal';
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
            [['atlet_id'], 'required', 'skipOnEmpty' => true],
            [['atlet_id', 'usia_kali_pertama_haid', 'bilangan_kanak_kanak', 'perokok_tempoh', 'alkohol', 'berat_badan_turun', 'berat_badan_naik'], 'integer'],
            [['haid_kali_terakhir_hari_pertama', 'kali_terakhir_bersalin'], 'safe'],
            [['penglihatan_tanpa_cermin_mata_kiri', 'penglihatan_tanpa_cermin_mata_kanan', 'penglihatan_cermin_mata_kiri', 'penglihatan_cermin_mata_kanan', 'status_haid', 'status_perokok', 'jenis_alkohol', 'diet_harian'], 'string', 'max' => 30],
            [['haid_kitaran'], 'string', 'max' => 20],
            [['masalah_haid','supplements'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pl_data_klinikal_id' => 'Pl Data Klinikal ID',
            'atlet_id' => 'Atlet ID',
            'penglihatan_tanpa_cermin_mata_kiri' => 'Penglihatan Tanpa Cermin Mata Kiri',
            'penglihatan_tanpa_cermin_mata_kanan' => 'Penglihatan Tanpa Cermin Mata Kanan',
            'penglihatan_cermin_mata_kiri' => 'Penglihatan Cermin Mata Kiri',
            'penglihatan_cermin_mata_kanan' => 'Penglihatan Cermin Mata Kanan',
            'usia_kali_pertama_haid' => 'Usia Kali Pertama Haid',
            'haid_kitaran' => 'Haid Kitaran',
            'status_haid' => 'Status Haid',
            'haid_kali_terakhir_hari_pertama' => 'Haid Kali Terakhir Hari Pertama',
            'kali_terakhir_bersalin' => 'Kali Terakhir Bersalin',
            'bilangan_kanak_kanak' => 'Bilangan Kanak Kanak',
            'masalah_haid' => 'Masalah Haid',
            'perokok_tempoh' => 'Perokok Tempoh (Tahun)',
            'status_perokok' => 'Status Perokok',
            'alkohol' => 'Alkohol (M/Minggu)',
            'jenis_alkohol' => 'Jenis Alkohol',
            'diet_harian' => 'Diet Harian',
            'berat_badan_turun' => 'Berat Badan Turun (KG)',
            'berat_badan_naik' => 'Berat Badan Naik (KG)',
            'supplements' => 'Supplements',
        ];
    }
}
