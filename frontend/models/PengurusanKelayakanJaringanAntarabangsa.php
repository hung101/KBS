<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_pengurusan_kelayakan_jaringan_antarabangsa".
 *
 * @property integer $pengurusan_kelayakan_jaringan_antarabangsa_id
 * @property integer $pengurusan_jaringan_antarabangsa_id
 * @property string $nama_kursus
 * @property string $tarikh
 * @property string $tempat
 * @property string $tahap_kelayakan
 */
class PengurusanKelayakanJaringanAntarabangsa extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_pengurusan_kelayakan_jaringan_antarabangsa';
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
            [['nama_kursus', 'tarikh', 'tempat', 'tahap_kelayakan'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['pengurusan_jaringan_antarabangsa_id'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['tarikh'], 'safe'],
            [['nama_kursus', 'tahap_kelayakan'], 'string', 'max' => 80, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['tempat'], 'string', 'max' => 90, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['nama_kursus', 'tahap_kelayakan','tempat'], function ($attribute, $params) {
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
            'pengurusan_kelayakan_jaringan_antarabangsa_id' => GeneralLabel::pengurusan_kelayakan_jaringan_antarabangsa_id,
            'pengurusan_jaringan_antarabangsa_id' => GeneralLabel::pengurusan_jaringan_antarabangsa_id,
            'nama_kursus' => GeneralLabel::nama_kursus,
            'tarikh' => GeneralLabel::tarikh,
            'tempat' => GeneralLabel::tempat,
            'tahap_kelayakan' => GeneralLabel::tahap_kelayakan,

        ];
    }
}
