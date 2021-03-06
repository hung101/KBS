<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_pengurusan_perhimpunan_kem_kos".
 *
 * @property integer $pengurusan_perhimpunan_kem_kos_id
 * @property integer $permohonan_perganjuran_id
 * @property string $kategori_kos
 * @property string $anggaran_kos_per_kategori
 * @property string $revised_kos_per_kategori
 * @property string $approved_kos_per_kategori
 * @property string $catatan
 */
class PermohonanPenganjuranKos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_permohonan_perganjuran_kos';
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
            [['permohonan_perganjuran_id'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['anggaran_kos_per_kategori', 'revised_kos_per_kategori', 'approved_kos_per_kategori'], 'number', 'message' => GeneralMessage::yii_validation_number],
            [['kategori_kos'], 'string', 'max' => 30, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['catatan'], 'string', 'max' => 255, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['kategori_kos','catatan'], function ($attribute, $params) {
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
            'pengurusan_perhimpunan_kem_kos_id' => GeneralLabel::pengurusan_perhimpunan_kem_kos_id,
            'permohonan_perganjuran_id' => GeneralLabel::permohonan_perganjuran_id,
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
