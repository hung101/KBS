<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_permohonan_membaiki_peralatan".
 *
 * @property integer $permohonan_membaiki_peralatan_id
 * @property string $tarikh_permohonan
 * @property string $pemohon
 * @property string $nama_peralatan
 * @property string $model
 * @property string $nombor_siri
 * @property string $tarikh_diterima
 * @property string $tarikh_dipulang
 * @property string $kerosakan
 * @property string $simptom_kerosakan
 * @property string $komponen_utama
 * @property string $proses_pemeriksaan
 * @property string $pembaikan
 * @property string $cadangan
 * @property string $pegawai_yang_bertanggungjawab
 * @property string $catitan_ringkas
 * @property string $status_permohonan
 */
class PermohonanMembaikiPeralatan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_permohonan_membaiki_peralatan';
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
            [['tarikh_permohonan', 'pemohon', 'nama_peralatan', 'pegawai_yang_bertanggungjawab', 'status_permohonan'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['tarikh_permohonan', 'tarikh_diterima', 'tarikh_dipulang'], 'safe'],
            [['pemohon', 'nama_peralatan', 'pegawai_yang_bertanggungjawab'], 'string', 'max' => 80, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['model', 'nombor_siri'], 'string', 'max' => 40, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['kerosakan', 'simptom_kerosakan', 'komponen_utama', 'proses_pemeriksaan', 'pembaikan', 'cadangan', 'catitan_ringkas'], 'string', 'max' => 255, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['status_permohonan'], 'string', 'max' => 30, 'tooLong' => GeneralMessage::yii_validation_string_max]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'permohonan_membaiki_peralatan_id' => GeneralLabel::permohonan_membaiki_peralatan_id,
            'tarikh_permohonan' => GeneralLabel::tarikh_permohonan,
            'pemohon' => GeneralLabel::pemohon,
            'nama_peralatan' => GeneralLabel::nama_peralatan,
            'model' => GeneralLabel::model,
            'nombor_siri' => GeneralLabel::nombor_siri,
            'tarikh_diterima' => GeneralLabel::tarikh_diterima,
            'tarikh_dipulang' => GeneralLabel::tarikh_dipulang,
            'kerosakan' => GeneralLabel::kerosakan,
            'simptom_kerosakan' => GeneralLabel::simptom_kerosakan,
            'komponen_utama' => GeneralLabel::komponen_utama,
            'proses_pemeriksaan' => GeneralLabel::proses_pemeriksaan,
            'pembaikan' => GeneralLabel::pembaikan,
            'cadangan' => GeneralLabel::cadangan,
            'pegawai_yang_bertanggungjawab' => GeneralLabel::pegawai_yang_bertanggungjawab,
            'catitan_ringkas' => GeneralLabel::catitan_ringkas,
            'status_permohonan' => GeneralLabel::status_permohonan,

        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefPeralatanPermohonanMembaiki(){
        return $this->hasOne(RefPeralatanPermohonanMembaiki::className(), ['id' => 'nama_peralatan']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefStatusPermohonanMembaikiPeralatan(){
        return $this->hasOne(RefStatusPermohonanMembaikiPeralatan::className(), ['id' => 'status_permohonan']);
    }
}
