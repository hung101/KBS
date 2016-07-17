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
            [['tarikh_temujanji', 'nama_pemohon_rujukan', 'kes_latarbelakang', 'no_telefon', 'nama_pemohon_rujukan', 'emel', 'jawatan',
               'program', 'tarikh_permohonan', 'kes_latarbelakang', 'agensi', 'sukan_atlet_jurulatih'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['atlet_id', 'bil_adik_beradik', 'umur'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['emel'], 'email', 'message' => GeneralMessage::yii_validation_email],
            [['tarikh_rujukan', 'jurulatih', 'sukan', 'negeri'], 'safe'],
            [['status_permohonan', 'kes_latarbelakang', 'agensi', 'jantina', 'taraf_perkahwinan', 'no_rujukan_kes'], 'string', 'max' => 30, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['nama_pemohon_rujukan', 'pekerjaan_bapa', 'pekerjaan_ibu', 'cawangan_isn'], 'string', 'max' => 80, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['notis', 'diagnosis', 'cadangan', 'tindakan_kaunselor'], 'string', 'max' => 255, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['no_telefon'], 'string', 'max' => 14, 'tooLong' => GeneralMessage::yii_validation_string_max],
            ['cawangan', 'required', 'message' => GeneralMessage::yii_validation_required, 'when' => function ($model) {
                    return $model->agensi == RefAgensiKaunseling::MSN;
                }, 'whenClient' => "function (attribute, value) {
                    return $('#agensi').val() == '" . RefAgensiKaunseling::MSN . "';
                }"],
            ['cawangan_isn', 'required', 'message' => GeneralMessage::yii_validation_required, 'when' => function ($model) {
                    return $model->agensi == RefAgensiKaunseling::ISN;
                }, 'whenClient' => "function (attribute, value) {
                    return $('#agensi').val() == '" . RefAgensiKaunseling::ISN . "';
                }"],
            [['sukan', 'persatuan'], 'required', 'message' => GeneralMessage::yii_validation_required, 'when' => function ($model) {
                    return $model->agensi == RefAgensiKaunseling::PSK;
                }, 'whenClient' => "function (attribute, value) {
                    return $('#agensi').val() == '" . RefAgensiKaunseling::PSK . "';
                }"],
            [['negeri'], 'required', 'message' => GeneralMessage::yii_validation_required, 'when' => function ($model) {
                    return $model->agensi == RefAgensiKaunseling::MAJLIS_SUKAN_NEGERI;
                }, 'whenClient' => "function (attribute, value) {
                    return $('#agensi').val() == '" . RefAgensiKaunseling::MAJLIS_SUKAN_NEGERI . "';
                }"],
            [['jurulatih, atlet_id'], 'validateJurulatihAtlet', 'skipOnEmpty' => false],
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
            'tarikh_temujanji' => GeneralLabel::tarikh_cadangan,
            'status_permohonan' => GeneralLabel::status_permohonan,
            'tarikh_rujukan' => GeneralLabel::tarikh_rujukan,
            'nama_pemohon_rujukan' => GeneralLabel::nama,
            'kes_latarbelakang' => GeneralLabel::kes_latarbelakang,
            'kes_latarbelakang_lain' => GeneralLabel::kes_latarbelakang_lain,
            'notis' => GeneralLabel::catatan_permohonan,
            'pekerjaan_bapa' => GeneralLabel::pekerjaan_bapa,
            'pekerjaan_ibu' => GeneralLabel::pekerjaan_ibu,
            'bil_adik_beradik' => GeneralLabel::bil_adik_beradik,
            'no_telefon' => GeneralLabel::no_telefon,
            'agensi' => GeneralLabel::agensi,
            'sukan' => GeneralLabel::sukan,
            'negeri' => GeneralLabel::negeri,
            'cawangan_isn' => GeneralLabel::cawangan,
            'sukan_atlet_jurulatih' => GeneralLabel::sukan,
        ];
    }
    
    public function validateJurulatihAtlet()
    {
        if (($this->jurulatih==null)&&($this->atlet_id==null))      
        {
                $this->addError('jurulatih', GeneralMessage::yii_validation_required_either);
                $this->addError('atlet_id', GeneralMessage::yii_validation_required_either);
        } else if (($this->jurulatih!=null)&&($this->atlet_id!=null))      
        {
                $this->addError('jurulatih', GeneralMessage::yii_validation_required_only_one);
                $this->addError('atlet_id', GeneralMessage::yii_validation_required_only_one);
        }
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
    public function getRefJurulatih(){
        return $this->hasOne(Jurulatih::className(), ['jurulatih_id' => 'jurulatih']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefStatusPermohonan(){
        return $this->hasOne(RefStatusPermohonan::className(), ['id' => 'status_permohonan']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefLatarbelakangKes(){
        return $this->hasOne(RefLatarbelakangKes::className(), ['id' => 'kes_latarbelakang']);
    }
    
    
}
