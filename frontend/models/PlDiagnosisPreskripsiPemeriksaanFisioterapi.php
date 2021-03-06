<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_pl_diagnosis_preskripsi_pemeriksaan".
 *
 * @property integer $pl_diagnosis_preskripsi_pemeriksaan_id
 * @property integer $pl_temujanji_id
 * @property string $jenis_diagnosis_preskripsi_pemeriksaan
 * @property string $status_diagnosis_preskripsi_pemeriksaan
 * @property string $catitan_ringkas
 */
class PlDiagnosisPreskripsiPemeriksaanFisioterapi extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_pl_diagnosis_preskripsi_pemeriksaan_fisioterapi';
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
            [['bahagian_kecederaan'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['pl_temujanji_id', 'unit', 'bahagian_kecederaan', 'rawatan_fisioterapi'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['harga'], 'number', 'message' => GeneralMessage::yii_validation_number],
            [['tarikh'], 'safe'],
            [['jenis_diagnosis_preskripsi_pemeriksaan'], 'string', 'max' => 30, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['pegawai_yang_bertanggungjawab'], 'string', 'max' => 80, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['status_diagnosis_preskripsi_pemeriksaan'], 'string', 'max' => 100, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['catitan_ringkas'], 'string', 'max' => 255, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['jenis_diagnosis_preskripsi_pemeriksaan', 'status_diagnosis_preskripsi_pemeriksaan','pegawai_yang_bertanggungjawab','catitan_ringkas'], function ($attribute, $params) {
                if (!\common\models\general\GeneralFunction::validateXSS($this->$attribute)) {
                    $this->addError($attribute, GeneralMessage::yii_validation_xss);
                }
            }],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pl_diagnosis_preskripsi_pemeriksaan_id' => GeneralLabel::pl_diagnosis_preskripsi_pemeriksaan_id,
            'pl_temujanji_id' => GeneralLabel::pl_temujanji_id,
            'tarikh' => GeneralLabel::tarikh,
            'jenis_diagnosis_preskripsi_pemeriksaan' => GeneralLabel::jenis_diagnosis_preskripsi_pemeriksaan,
            'status_diagnosis_preskripsi_pemeriksaan' => GeneralLabel::fisioterapi_diagnosis,
            'pegawai_yang_bertanggungjawab' => GeneralLabel::fisio_doktor_bertanggungjawab,
            'unit' => GeneralLabel::unit,
            'harga' => GeneralLabel::caj_fi,
            'catitan_ringkas' => GeneralLabel::catitan_ringkas,
            'bahagian_kecederaan' => GeneralLabel::bahagian_kecederaan,
            'rawatan_fisioterapi' => GeneralLabel::rawatan_fisioterapi,
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefJenisKecederaanMasalahKesihatan(){
        return $this->hasOne(RefJenisKecederaanMasalahKesihatan::className(), ['id' => 'jenis_diagnosis_preskripsi_pemeriksaan']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefStatusDiagnosisPreskripsiPemeriksaanPenyiasatan(){
        return $this->hasOne(RefStatusDiagnosisPreskripsiPemeriksaanPenyiasatan::className(), ['id' => 'status_diagnosis_preskripsi_pemeriksaan']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefBahagianKecederaan(){
        return $this->hasOne(RefBahagianKecederaan::className(), ['id' => 'bahagian_kecederaan']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefRawatanFisioterapi(){
        return $this->hasOne(RefRawatanFisioterapi::className(), ['id' => 'rawatan_fisioterapi']);
    }
}
