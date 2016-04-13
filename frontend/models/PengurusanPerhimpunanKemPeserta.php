<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_pengurusan_perhimpunan_kem_peserta".
 *
 * @property integer $pengurusan_perhimpunan_kem_peserta_id
 * @property integer $pengurusan_perhimpunan_kem_id
 * @property string $nama_peserta
 * @property string $kategori_peserta
 * @property string $jawatan
 */
class PengurusanPerhimpunanKemPeserta extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_pengurusan_perhimpunan_kem_peserta';
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
            [['nama_peserta', 'kategori_peserta', 'jawatan'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['pengurusan_perhimpunan_kem_id'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['nama_peserta'], 'string', 'max' => 80, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['kategori_peserta', 'jawatan'], 'string', 'max' => 30, 'tooLong' => GeneralMessage::yii_validation_string_max]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pengurusan_perhimpunan_kem_peserta_id' => GeneralLabel::pengurusan_perhimpunan_kem_peserta_id,
            'pengurusan_perhimpunan_kem_id' => GeneralLabel::pengurusan_perhimpunan_kem_id,
            'nama_peserta' => GeneralLabel::nama_peserta,
            'kategori_peserta' => GeneralLabel::kategori_peserta,
            'jawatan' => GeneralLabel::jawatan,

        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefKategoriPesertaPerhimpunanKem(){
        return $this->hasOne(RefKategoriPesertaPerhimpunanKem::className(), ['id' => 'kategori_peserta']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefJawatanPesertaPerhimpunanKem(){
        return $this->hasOne(RefJawatanPesertaPerhimpunanKem::className(), ['id' => 'jawatan']);
    }
}
