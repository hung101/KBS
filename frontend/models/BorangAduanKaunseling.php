<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_borang_aduan_kaunseling".
 *
 * @property integer $borang_aduan_kaunseling_id
 * @property string $nama_pengadu
 * @property string $tarikh_aduan
 * @property string $no_aduan
 * @property string $status_aduan
 * @property string $aduan_kategori
 * @property string $penyataan_aduan
 * @property string $tindakan_yang_telah_diambil
 * @property string $dokumen_berkaitan_yang_dilampirkan
 * @property string $bantuan_yang_anda_perlukan
 * @property string $rujukan_aduan_kepada_cawangan_yang_berkaitan
 * @property string $rujuk_aduan_kepada_atlet
 * @property string $tiada_sebarang_tindakan
 * @property string $maklumbalas_kepada_pengadu
 * @property string $tindakan_susulan
 * @property string $aduan_dimajukan_kepada_agensi_lain
 * @property string $catatan
 */
class BorangAduanKaunseling extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_borang_aduan_kaunseling';
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
            [['nama_pengadu', 'tarikh_aduan', 'no_aduan', 'status_aduan', 'aduan_kategori'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['tarikh_aduan'], 'safe'],
            [['nama_pengadu'], 'string', 'max' => 80, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['no_aduan', 'status_aduan', 'aduan_kategori'], 'string', 'max' => 30, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['penyataan_aduan', 'tindakan_yang_telah_diambil', 'dokumen_berkaitan_yang_dilampirkan', 'bantuan_yang_anda_perlukan', 'rujukan_aduan_kepada_cawangan_yang_berkaitan', 'rujuk_aduan_kepada_atlet', 'tiada_sebarang_tindakan', 'maklumbalas_kepada_pengadu', 'tindakan_susulan', 'aduan_dimajukan_kepada_agensi_lain', 'catatan'], 'string', 'max' => 255, 'tooLong' => GeneralMessage::yii_validation_string_max]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'borang_aduan_kaunseling_id' => GeneralLabel::borang_aduan_kaunseling_id,
            'nama_pengadu' => GeneralLabel::nama_pengadu,
            'tarikh_aduan' => GeneralLabel::tarikh_aduan,
            'no_aduan' => GeneralLabel::no_aduan,
            'status_aduan' => GeneralLabel::status_aduan,
            'aduan_kategori' => GeneralLabel::aduan_kategori,
            'penyataan_aduan' => GeneralLabel::penyataan_aduan,
            'tindakan_yang_telah_diambil' => GeneralLabel::tindakan_yang_telah_diambil,
            'dokumen_berkaitan_yang_dilampirkan' => GeneralLabel::dokumen_berkaitan_yang_dilampirkan,
            'bantuan_yang_anda_perlukan' => GeneralLabel::bantuan_yang_anda_perlukan,
            'rujukan_aduan_kepada_cawangan_yang_berkaitan' => GeneralLabel::rujukan_aduan_kepada_cawangan_yang_berkaitan,
            'rujuk_aduan_kepada_atlet' => GeneralLabel::rujuk_aduan_kepada_atlet,
            'tiada_sebarang_tindakan' => GeneralLabel::tiada_sebarang_tindakan,
            'maklumbalas_kepada_pengadu' => GeneralLabel::maklumbalas_kepada_pengadu,
            'tindakan_susulan' => GeneralLabel::tindakan_susulan,
            'aduan_dimajukan_kepada_agensi_lain' => GeneralLabel::aduan_dimajukan_kepada_agensi_lain,
            'catatan' => GeneralLabel::catatan,

        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAtlet(){
        return $this->hasOne(Atlet::className(), ['atlet_id' => 'nama_pengadu']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefStatusAduan(){
        return $this->hasOne(RefStatusAduan::className(), ['id' => 'status_aduan']);
    }
}
