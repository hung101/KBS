<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_pengurusan_program_binaan_kos".
 *
 * @property integer $pengurusan_program_binaan_kos_id
 * @property integer $pengurusan_program_binaan_id
 * @property string $kategori_kos
 * @property string $anggaran_kos_per_kategori
 * @property string $revised_kos_per_kategori
 * @property string $approved_kos_per_kategori
 * @property string $catatan
 */
class PengurusanProgramBinaanKos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_pengurusan_program_binaan_kos';
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
            [['kategori_kos', 'anggaran_kos_per_kategori', 'revised_kos_per_kategori', 'approved_kos_per_kategori', 'perbelanjaan_dipohon', 'jumlah_dipohon', 'anggaran_perbelanjaan', 'jumlah_cadangan'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['pengurusan_program_binaan_id', 'kategori_perbelanjaan', 'bilangan_pohon', 'bilangan_cadangan', 'hari_pohon', 'hari_cadangan'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['jumlah_dipohon', 'jumlah_cadangan', 'anggaran_perbelanjaan', 'kadar_pohon', 'kadar_cadangan'], 'number', 'message' => GeneralMessage::yii_validation_number],
            [['anggaran_kos_per_kategori', 'revised_kos_per_kategori', 'approved_kos_per_kategori'], 'number', 'message' => GeneralMessage::yii_validation_number],
            [['kategori_kos'], 'string', 'max' => 30, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['catatan', 'catatan_cadangan'], 'string', 'max' => 255, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['kategori_kos','catatan', 'catatan_cadangan'], function ($attribute, $params) {
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
            'pengurusan_program_binaan_kos_id' => GeneralLabel::pengurusan_program_binaan_kos_id,
            'pengurusan_program_binaan_id' => GeneralLabel::pengurusan_program_binaan_id,
            'kategori_kos' => GeneralLabel::kategori_kos,
            'anggaran_kos_per_kategori' => GeneralLabel::anggaran_kos_per_kategori,
            'revised_kos_per_kategori' => GeneralLabel::revised_kos_per_kategori,
            'approved_kos_per_kategori' => GeneralLabel::approved_kos_per_kategori,
            'catatan' => GeneralLabel::catatan,
            'jumlah_dipohon' => GeneralLabel::jumlah,
            'anggaran_perbelanjaan' => GeneralLabel::anggaran_perbelanjaan,
            'jumlah_cadangan' => GeneralLabel::jumlah,
            'catatan_cadangan' => GeneralLabel::catatan,
            'perbelanjaan_dipohon' => GeneralLabel::butiran_dipohon,
            'kategori_perbelanjaan' => GeneralLabel::kategori_perbelanjaan,
            'kadar_pohon' => GeneralLabel::kadar,
            'bilangan_pohon' => GeneralLabel::bilangan,
            'hari_pohon' => GeneralLabel::hari,
            'kadar_cadangan' => GeneralLabel::kadar,
            'bilangan_cadangan' => GeneralLabel::bilangan,
            'hari_cadangan' => GeneralLabel::hari,
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefKategoriKosProgramBinaan(){
        return $this->hasOne(RefKategoriKosProgramBinaan::className(), ['id' => 'kategori_kos']);
    }
    
    public function getRefKategoriPerbelanjaan(){
        return $this->hasOne(RefKategoriPerbelanjaan::className(), ['id' => 'kategori_perbelanjaan']);
    }
}
