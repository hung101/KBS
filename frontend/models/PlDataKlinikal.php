<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;

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
            'pl_data_klinikal_id' => GeneralLabel::pl_data_klinikal_id,
            'atlet_id' => GeneralLabel::atlet_id,
            'penglihatan_tanpa_cermin_mata_kiri' => GeneralLabel::penglihatan_tanpa_cermin_mata_kiri,
            'penglihatan_tanpa_cermin_mata_kanan' => GeneralLabel::penglihatan_tanpa_cermin_mata_kanan,
            'penglihatan_cermin_mata_kiri' => GeneralLabel::penglihatan_cermin_mata_kiri,
            'penglihatan_cermin_mata_kanan' => GeneralLabel::penglihatan_cermin_mata_kanan,
            'usia_kali_pertama_haid' => GeneralLabel::usia_kali_pertama_haid,
            'haid_kitaran' => GeneralLabel::haid_kitaran,
            'status_haid' => GeneralLabel::status_haid,
            'haid_kali_terakhir_hari_pertama' => GeneralLabel::haid_kali_terakhir_hari_pertama,
            'kali_terakhir_bersalin' => GeneralLabel::kali_terakhir_bersalin,
            'bilangan_kanak_kanak' => GeneralLabel::bilangan_kanak_kanak,
            'masalah_haid' => GeneralLabel::masalah_haid,
            'perokok_tempoh' => GeneralLabel::perokok_tempoh,
            'status_perokok' => GeneralLabel::status_perokok,
            'alkohol' => GeneralLabel::alkohol,
            'jenis_alkohol' => GeneralLabel::jenis_alkohol,
            'diet_harian' => GeneralLabel::diet_harian,
            'berat_badan_turun' => GeneralLabel::berat_badan_turun,
            'berat_badan_naik' => GeneralLabel::berat_badan_naik,
            'supplements' => GeneralLabel::supplements,

        ];
    }
}
