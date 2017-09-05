<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_pengurusan_kejohanan_temasya".
 *
 * @property integer $pengurusan_kejohanan_temasya_id
 * @property string $tarikh_kejohanan
 * @property string $nama_sukan
 * @property string $nama_acara
 * @property string $lokasi_kejohanan
 * @property string $nama_ketua_kontijen
 * @property string $nama_atlet
 * @property string $nama_pegawai
 * @property string $nama_doktor
 * @property string $nama_fisio
 * @property string $tarikh_penginapan_mula
 * @property string $tarikh_penginapan_akhir
 * @property string $tarikh_perjalanan_pesawat
 * @property string $tarikh_pulang_perjalanan_pesawat
 * @property string $catatan_pesawat
 */
class PengurusanKejohananTemasya extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_pengurusan_kejohanan_temasya';
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
            [['tarikh_kejohanan', 'nama_kejohanan_temasya', 'peringkat', 'nama_sukan', 'nama_acara', 'lokasi_kejohanan', 'nama_ketua_kontijen', 'nama_atlet', 
                'nama_pegawai', 'nama_doktor', 'nama_fisio', 'tarikh_penginapan_mula', 'tarikh_penginapan_akhir', 'tarikh_perjalanan_pesawat', 
                'tarikh_pulang_perjalanan_pesawat'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['tarikh_kejohanan', 'tarikh_penginapan_mula', 'tarikh_penginapan_akhir', 'tarikh_perjalanan_pesawat', 'tarikh_pulang_perjalanan_pesawat'], 'safe'],
            [['nama_sukan', 'nama_acara', 'nama_ketua_kontijen', 'nama_atlet', 'nama_pegawai', 'nama_doktor', 'nama_fisio'], 'string', 'max' => 80, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['lokasi_kejohanan'], 'string', 'max' => 90, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['catatan_pesawat'], 'string', 'max' => 255, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['nama_sukan', 'nama_acara', 'nama_ketua_kontijen', 'nama_atlet', 'nama_pegawai', 'nama_doktor', 'nama_fisio','lokasi_kejohanan','catatan_pesawat'], function ($attribute, $params) {
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
            'pengurusan_kejohanan_temasya_id' => GeneralLabel::pengurusan_kejohanan_temasya_id,
            'nama_kejohanan_temasya' => GeneralLabel::nama_kejohanan_temasya,
            'peringkat' => GeneralLabel::peringkat,
            'tarikh_kejohanan' => GeneralLabel::tarikh_kejohanan,
            'nama_sukan' => GeneralLabel::nama_sukan,
            'nama_acara' => GeneralLabel::nama_acara,
            'lokasi_kejohanan' => GeneralLabel::lokasi_kejohanan,
            'nama_ketua_kontijen' => GeneralLabel::nama_ketua_kontijen,
            'nama_atlet' => GeneralLabel::nama_atlet,
            'nama_pegawai' => GeneralLabel::nama_pegawai,
            'nama_doktor' => GeneralLabel::nama_doktor,
            'nama_fisio' => GeneralLabel::nama_fisio,
            'tarikh_penginapan_mula' => GeneralLabel::tarikh_penginapan_mula,
            'tarikh_penginapan_akhir' => GeneralLabel::tarikh_penginapan_akhir,
            'tarikh_perjalanan_pesawat' => GeneralLabel::tarikh_perjalanan_pesawat,
            'tarikh_pulang_perjalanan_pesawat' => GeneralLabel::tarikh_pulang_perjalanan_pesawat,
            'catatan_pesawat' => GeneralLabel::catatan_pesawat,

        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefSukan(){
        return $this->hasOne(RefSukan::className(), ['id' => 'nama_sukan']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefAcara(){
        return $this->hasOne(RefAcara::className(), ['id' => 'nama_acara']);
    }
}
