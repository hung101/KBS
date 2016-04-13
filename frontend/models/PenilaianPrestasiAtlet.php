<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

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
            [['atlet_id', 'nama_sukan', 'nama_acara', 'break_record', 'maklumat_shakam_shakar'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['atlet_id', 'break_record'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['tahun_penilaian', 'jadual_latihan'], 'safe'],
            [['tahap_kesihatan', 'tahap_kecederaan', 'nama_sukan', 'nama_acara', 'keputusan'], 'string', 'max' => 80, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['sasaran'], 'string', 'max' => 50, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['maklumat_shakam_shakar', 'ulasan', 'tindakan'], 'string', 'max' => 255, 'tooLong' => GeneralMessage::yii_validation_string_max]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'penilaian_prestasi_atlet_id' => GeneralLabel::penilaian_prestasi_atlet_id,
            'atlet_id' => GeneralLabel::atlet_id,
            'tahap_kesihatan' => GeneralLabel::tahap_kesihatan,
            'tahap_kecederaan' => GeneralLabel::tahap_kecederaan,
            'kecederaan_tarikh_mula' => GeneralLabel::kecederaan_tarikh_mula,
            'kecederaan_tarikh_tamat' => GeneralLabel::kecederaan_tarikh_tamat,
            'ulasan' => GeneralLabel::ulasan,
            'tindakan' => GeneralLabel::tindakan,
            'tahun_penilaian' => GeneralLabel::tahun_penilaian,
            'jadual_latihan' => GeneralLabel::jadual_latihan,
            'nama_sukan' => GeneralLabel::nama_sukan,
            'nama_acara' => GeneralLabel::nama_acara,
            'sasaran' => GeneralLabel::sasaran,
            'keputusan' => GeneralLabel::keputusan,
            'break_record' => GeneralLabel::break_record,
            'maklumat_shakam_shakar' => GeneralLabel::maklumat_shakam_shakar,

        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefAtlet(){
        return $this->hasOne(Atlet::className(), ['atlet_id' => 'atlet_id']);
    }
}
