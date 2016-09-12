<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_forum_seminar_persidangan_di_luar_negara".
 *
 * @property integer $forum_seminar_persidangan_di_luar_negara_id
 * @property string $nama
 * @property string $amaun
 * @property string $negara
 * @property string $status_permohonan
 * @property string $catatan
 */
class ForumSeminarPersidanganDiLuarNegara extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_forum_seminar_persidangan_di_luar_negara';
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
            [['jenis_program','nama', 'nama_program', 'tarikh', 'tarikh_tamat', 'persatuan', 'jawatan', 'nama_wakil_persatuan_1', 'nama_wakil_persatuan_2', 'amaun', 'negara', 
                'status_permohonan', 'peringkat'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['tarikh_kelulusan_jkb', 'tarikh_tamat'], 'safe'],        
            [['amaun', 'jumlah_diluluskan'], 'number', 'message' => GeneralMessage::yii_validation_number],
            [['nama'], 'string', 'max' => 80, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['negara', 'status_permohonan', 'bilangan_jkb'], 'string', 'max' => 30, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['catatan'], 'string', 'max' => 255, 'tooLong' => GeneralMessage::yii_validation_string_max]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'forum_seminar_persidangan_di_luar_negara_id' => GeneralLabel::forum_seminar_persidangan_di_luar_negara_id,
            'nama_pemohon' => GeneralLabel::nama_pemohon,
            'jawatan_pemohon' => GeneralLabel::jawatan_pemohon,
            'persatuan_pemohon' => GeneralLabel::persatuan_pemohon,
            'jenis_program' => GeneralLabel::jenis_program,
            'nama' => GeneralLabel::nama,
            'nama_program' => GeneralLabel::nama_program,
            'tarikh' => GeneralLabel::tarikh,
            'persatuan' => GeneralLabel::persatuan,
            'jawatan' => GeneralLabel::jawatan,
            'nama_wakil_persatuan_1' => GeneralLabel::nama_peserta_program,
            'nama_wakil_persatuan_2' => GeneralLabel::nama_wakil_persatuan_2,
            'amaun' => GeneralLabel::jumlah_dipohon,
            'negara' => GeneralLabel::negara,
            'status_permohonan' => GeneralLabel::status_permohonan,
            'catatan' => GeneralLabel::catatan,
            'jumlah_diluluskan' => GeneralLabel::jumlah_diluluskan,
            'tarikh_kelulusan_jkb' => GeneralLabel::tarikh_kelulusan_jkb,
            'bilangan_jkb' => GeneralLabel::bilangan_jkb,
            'peringkat' => GeneralLabel::peringkat,
            'tarikh_tamat' => GeneralLabel::tarikh_tamat,
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefNegara(){
        return $this->hasOne(RefNegara::className(), ['id' => 'negara']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefStatusPermohonanBantuanMenghadiriProgramAntarabangs(){
        return $this->hasOne(RefStatusPermohonanBantuanMenghadiriProgramAntarabangs::className(), ['id' => 'status_permohonan']);
    }
}
