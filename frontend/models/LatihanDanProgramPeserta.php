<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_latihan_dan_program_peserta".
 *
 * @property integer $latihan_dan_program_peserta_id
 * @property integer $latihan_dan_program_id
 * @property string $nama
 * @property string $no_kad_pengenalan
 * @property string $nama_badan_sukan
 * @property string $no_pendaftaran_sukan
 * @property string $jawatan
 * @property string $tempoh_memegang_jawatan
 * @property string $no_tel_bimbit
 * @property string $emel
 */
class LatihanDanProgramPeserta extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_latihan_dan_program_peserta';
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
            [['nama', 'no_kad_pengenalan', 'nama_badan_sukan', 'no_pendaftaran_sukan', 'jawatan', 'tempoh_memegang_jawatan', 'no_tel_bimbit'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['latihan_dan_program_id', 'ahli_jawatan_induk_id', 'ahli_jawatan_kecil_id'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['nama', 'nama_badan_sukan', 'jawatan', 'tempoh_memegang_jawatan'], 'string', 'max' => 80, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['no_kad_pengenalan'], 'string', 'max' => 12, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['no_pendaftaran_sukan', 'jenis_jawatankuasa'], 'string', 'max' => 30, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['no_tel_bimbit'], 'string', 'max' => 14, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['no_tel_bimbit', 'no_kad_pengenalan'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['emel'], 'string', 'max' => 100, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['emel'], 'email', 'message' => GeneralMessage::yii_validation_email],
            [['nama', 'nama_badan_sukan', 'jawatan', 'tempoh_memegang_jawatan','no_pendaftaran_sukan', 'jenis_jawatankuasa','emel'], 'filter', 'filter' => function ($value) {
                return  \common\models\general\GeneralFunction::filterXSS($value);
            }],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'latihan_dan_program_peserta_id' => GeneralLabel::latihan_dan_program_peserta_id,
            'latihan_dan_program_id' => GeneralLabel::latihan_dan_program_id,
            'ahli_jawatan_induk_id' => GeneralLabel::ahli_jawatan_induk_id,
            'ahli_jawatan_kecil_id' => GeneralLabel::ahli_jawatan_kecil_id,
            'nama' => GeneralLabel::nama,
            'no_kad_pengenalan' => GeneralLabel::no_kad_pengenalan,
            'nama_badan_sukan' => GeneralLabel::nama_badan_sukan,
            'no_pendaftaran_sukan' => GeneralLabel::no_pendaftaran_sukan,
            'jawatan' => GeneralLabel::jawatan,
            'tempoh_memegang_jawatan' => GeneralLabel::tarikh_mula_memegang_jawatan,
            'no_tel_bimbit' => GeneralLabel::no_tel_bimbit,
            'emel' => GeneralLabel::emel,
            'jenis_jawatankuasa' => GeneralLabel::jenis_jawatankuasa,

        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefBadanSukan(){
        return $this->hasOne(ProfilBadanSukan::className(), ['profil_badan_sukan' => 'nama_badan_sukan']);
    }
}
