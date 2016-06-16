<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_penilaian_pestasi".
 *
 * @property integer $penilaian_pestasi_id
 * @property integer $atlet_id
 * @property string $tahap_sihat
 * @property string $pencapaian_sukan_dalam_tahun_yang_dinilai
 * @property string $kecederaan_jika_ada
 * @property string $laporan_kesihatan
 * @property string $elaun_yang_diterima
 * @property string $skim_hadiah_kemenangan_sukan
 */
class PenilaianPestasi extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_penilaian_pestasi';
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
            [['atlet_id', 'tarikh', 'tahap_sihat', 'pencapaian_sukan_dalam_tahun_yang_dinilai', 'kategori_kecergasan', 'sukan', 'program', 'disiplin', 'acara',
                'kejohanan'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['atlet_id'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['elaun_yang_diterima'], 'number', 'message' => GeneralMessage::yii_validation_number],
            [['kejohanan'], 'safe'],
            [['tahap_sihat', 'pencapaian_sukan_dalam_tahun_yang_dinilai', 'kecederaan_jika_ada', 'laporan_kesihatan', 'skim_hadiah_kemenangan_sukan'], 'string', 'max' => 100, 'tooLong' => GeneralMessage::yii_validation_string_max]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'penilaian_pestasi_id' => GeneralLabel::penilaian_pestasi_id,
            'atlet_id' => GeneralLabel::atlet_id,
            'tarikh' => GeneralLabel::tarikh,
            'kategori_kecergasan' => GeneralLabel::kategori_kecergasan,
            'tahap_sihat' => GeneralLabel::tahap_sihat,
            'kejohanan' => GeneralLabel::kejohanan,
            'pencapaian_sukan_dalam_tahun_yang_dinilai' => GeneralLabel::pencapaian_sukan_dalam_tahun_yang_dinilai,
            'kecederaan_jika_ada' => GeneralLabel::kecederaan_jika_ada,
            'laporan_kesihatan' => GeneralLabel::laporan_kesihatan,
            'elaun_yang_diterima' => GeneralLabel::elaun_yang_diterima,
            'skim_hadiah_kemenangan_sukan' => GeneralLabel::skim_hadiah_kemenangan_sukan,

        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAtlet(){
        return $this->hasOne(Atlet::className(), ['atlet_id' => 'atlet_id']);
    }
}
