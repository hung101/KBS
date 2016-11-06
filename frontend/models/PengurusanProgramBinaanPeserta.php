<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_pengurusan_program_binaan_peserta".
 *
 * @property integer $pengurusan_program_binaan_peserta_id
 * @property integer $pengurusan_program_binaan_id
 * @property string $kategori_peserta
 * @property string $atlet_id
 * @property string $nama_peserta
 * @property string $jantina
 */
class PengurusanProgramBinaanPeserta extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_pengurusan_program_binaan_peserta';
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
            [['kategori_peserta', 'nama_peserta', 'jantina', 'peranan_peserta'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['pengurusan_program_binaan_id', 'atlet_id', 'jurulatih_id', 'peranan_peserta'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['kategori_peserta'], 'string', 'max' => 30, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['nama_peserta'], 'string', 'max' => 80, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['jantina'], 'string', 'max' => 1, 'tooLong' => GeneralMessage::yii_validation_string_max]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pengurusan_program_binaan_peserta_id' => GeneralLabel::pengurusan_program_binaan_peserta_id,
            'pengurusan_program_binaan_id' => GeneralLabel::pengurusan_program_binaan_id,
            'kategori_peserta' => GeneralLabel::jenis_peserta,
            'atlet_id' => GeneralLabel::atlet_id,
            'jurulatih_id' => GeneralLabel::jurulatih_id,
            'nama_peserta' => GeneralLabel::nama_pegawai,
            'jantina' => GeneralLabel::jantina,

        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefKategoriPesertaProgramBinaan(){
        return $this->hasOne(RefKategoriPesertaProgramBinaan::className(), ['id' => 'kategori_peserta']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefAtlet(){
        return $this->hasOne(Atlet::className(), ['atlet_id' => 'atlet_id']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefJurulatih(){
        return $this->hasOne(Jurulatih::className(), ['jurulatih_id' => 'jurulatih_id']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefJantina(){
        return $this->hasOne(RefJantina::className(), ['id' => 'jantina']);
    }
}
