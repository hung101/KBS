<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_permohonan_bimbingan_kaunseling".
 *
 * @property integer $permohonan_bimbingan_kaunseling_id
 * @property integer $atlet_id
 * @property string $status_permohonan
 * @property string $tarikh_rujukan
 * @property string $nama_pemohon_rujukan
 * @property string $kes_latarbelakang
 * @property string $notis
 * @property string $pekerjaan_bapa
 * @property string $pekerjaan_ibu
 * @property integer $bil_adik_beradik
 * @property string $no_telefon
 */
class PermohonanBimbinganKaunseling extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_permohonan_bimbingan_kaunseling';
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
            [['atlet_id', 'tarikh_temujanji', 'nama_pemohon_rujukan', 'kes_latarbelakang'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['atlet_id', 'bil_adik_beradik'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['tarikh_rujukan'], 'safe'],
            [['status_permohonan', 'kes_latarbelakang'], 'string', 'max' => 30, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['nama_pemohon_rujukan', 'pekerjaan_bapa', 'pekerjaan_ibu'], 'string', 'max' => 80, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['notis'], 'string', 'max' => 255, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['no_telefon'], 'string', 'max' => 14, 'tooLong' => GeneralMessage::yii_validation_string_max]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'permohonan_bimbingan_kaunseling_id' => GeneralLabel::permohonan_bimbingan_kaunseling_id,
            'atlet_id' => GeneralLabel::atlet_id,
            'tarikh_temujanji' => GeneralLabel::tarikh_temujanji,
            'status_permohonan' => GeneralLabel::status_permohonan,
            'tarikh_rujukan' => GeneralLabel::tarikh_rujukan,
            'nama_pemohon_rujukan' => GeneralLabel::nama_pemohon_rujukan,
            'kes_latarbelakang' => GeneralLabel::kes_latarbelakang,
            'kes_latarbelakang_lain' => GeneralLabel::kes_latarbelakang_lain,
            'notis' => GeneralLabel::notis,
            'pekerjaan_bapa' => GeneralLabel::pekerjaan_bapa,
            'pekerjaan_ibu' => GeneralLabel::pekerjaan_ibu,
            'bil_adik_beradik' => GeneralLabel::bil_adik_beradik,
            'no_telefon' => GeneralLabel::no_telefon,

        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAtlet(){
        return $this->hasOne(Atlet::className(), ['atlet_id' => 'atlet_id']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefStatusPermohonan(){
        return $this->hasOne(RefStatusPermohonan::className(), ['id' => 'status_permohonan']);
    }
}
