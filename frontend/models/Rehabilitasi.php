<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_rehabilitasi".
 *
 * @property integer $rehabilitasi_id
 * @property integer $pl_diagnosis_preskripsi_pemeriksaan_id
 * @property string $tarikh
 * @property string $kesan_klinikal
 * @property string $masalah_yang_dikenal_pasti
 * @property string $potensi_rehabilitasi
 * @property string $matlamat_rehabilitasi
 */
class Rehabilitasi extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_rehabilitasi';
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
            [['pl_diagnosis_preskripsi_pemeriksaan_id', 'tarikh', 'masalah_yang_dikenal_pasti', 'matlamat_rehabilitasi'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['pl_diagnosis_preskripsi_pemeriksaan_id'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['tarikh'], 'safe'],
            [['kesan_klinikal', 'masalah_yang_dikenal_pasti', 'potensi_rehabilitasi', 'matlamat_rehabilitasi'], 'string', 'max' => 255, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['kesan_klinikal', 'masalah_yang_dikenal_pasti', 'potensi_rehabilitasi', 'matlamat_rehabilitasi'], function ($attribute, $params) {
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
            'rehabilitasi_id' => GeneralLabel::rehabilitasi_id,
            'pl_diagnosis_preskripsi_pemeriksaan_id' => GeneralLabel::pl_diagnosis_preskripsi_pemeriksaan_id,
            'tarikh' => GeneralLabel::tarikh,
            'kesan_klinikal' => GeneralLabel::kesan_klinikal,
            'masalah_yang_dikenal_pasti' => GeneralLabel::masalah_yang_dikenal_pasti,
            'potensi_rehabilitasi' => GeneralLabel::potensi_rehabilitasi,
            'matlamat_rehabilitasi' => GeneralLabel::matlamat_rehabilitasi,

        ];
    }
}
