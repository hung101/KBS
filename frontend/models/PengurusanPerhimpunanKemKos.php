<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_pengurusan_perhimpunan_kem_kos".
 *
 * @property integer $pengurusan_perhimpunan_kem_kos_id
 * @property integer $pengurusan_perhimpunan_kem_id
 * @property string $kategori_kos
 * @property string $anggaran_kos_per_kategori
 * @property string $revised_kos_per_kategori
 * @property string $approved_kos_per_kategori
 * @property string $catatan
 */
class PengurusanPerhimpunanKemKos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_pengurusan_perhimpunan_kem_kos';
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
            [['kategori_kos', 'anggaran_kos_per_kategori', 'revised_kos_per_kategori', 'approved_kos_per_kategori'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['pengurusan_perhimpunan_kem_id'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['anggaran_kos_per_kategori', 'revised_kos_per_kategori', 'approved_kos_per_kategori'], 'number', 'message' => GeneralMessage::yii_validation_number],
            [['kategori_kos'], 'string', 'max' => 30, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['catatan'], 'string', 'max' => 255, 'tooLong' => GeneralMessage::yii_validation_string_max]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pengurusan_perhimpunan_kem_kos_id' => GeneralLabel::pengurusan_perhimpunan_kem_kos_id,
            'pengurusan_perhimpunan_kem_id' => GeneralLabel::pengurusan_perhimpunan_kem_id,
            'kategori_kos' => GeneralLabel::kategori_kos,
            'anggaran_kos_per_kategori' => GeneralLabel::anggaran_kos_per_kategori,
            'revised_kos_per_kategori' => GeneralLabel::revised_kos_per_kategori,
            'approved_kos_per_kategori' => GeneralLabel::approved_kos_per_kategori,
            'catatan' => GeneralLabel::catatan,

        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefKategoriKosPerhimpunanKem(){
        return $this->hasOne(RefKategoriKosPerhimpunanKem::className(), ['id' => 'kategori_kos']);
    }
}
