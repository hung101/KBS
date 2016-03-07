<?php

namespace app\models;

use Yii;

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
            [['atlet_id', 'tarikh', 'tahap_sihat', 'pencapaian_sukan_dalam_tahun_yang_dinilai', 'kategori_kecergasan'], 'required', 'skipOnEmpty' => true],
            [['atlet_id'], 'integer'],
            [['elaun_yang_diterima'], 'number'],
            [['kejohanan'], 'safe'],
            [['tahap_sihat', 'pencapaian_sukan_dalam_tahun_yang_dinilai', 'kecederaan_jika_ada', 'laporan_kesihatan', 'skim_hadiah_kemenangan_sukan'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'penilaian_pestasi_id' => 'Penilaian Pestasi ID',
            'atlet_id' => 'Atlet',
            'tarikh' => 'Tarikh',
            'kategori_kecergasan' => 'Kategori Kecergasan',
            'tahap_sihat' => 'Kesihatan / Kecergasan',
            'kejohanan' => 'Kejohanan',
            'pencapaian_sukan_dalam_tahun_yang_dinilai' => 'Pencapaian Sukan Dalam Tahun Yang Dinilai',
            'kecederaan_jika_ada' => 'Kecederaan Jika Ada',
            'laporan_kesihatan' => 'Laporan Kesihatan',
            'elaun_yang_diterima' => 'Elaun Yang Diterima',
            'skim_hadiah_kemenangan_sukan' => 'Skim Hadiah Kemenangan Sukan',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAtlet(){
        return $this->hasOne(Atlet::className(), ['atlet_id' => 'atlet_id']);
    }
}
