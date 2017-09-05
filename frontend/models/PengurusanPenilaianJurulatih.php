<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_pengurusan_penilaian_jurulatih".
 *
 * @property integer $pengurusan_penilaian_jurulatih_id
 * @property integer $pengurusan_pemantauan_dan_penilaian_jurulatih_id
 * @property string $penilaian_oleh
 * @property string $nama
 * @property string $tarikh_dinilai
 */
class PengurusanPenilaianJurulatih extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_pengurusan_penilaian_jurulatih';
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
            [['pengurusan_pemantauan_dan_penilaian_jurulatih_id', 'penilaian_oleh', 'nama', 'tarikh_dinilai'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['pengurusan_pemantauan_dan_penilaian_jurulatih_id'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['tarikh_dinilai'], 'safe'],
            [['penilaian_oleh', 'nama'], 'string', 'max' => 80, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['penilaian_oleh', 'nama'], function ($attribute, $params) {
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
            'pengurusan_penilaian_jurulatih_id' => GeneralLabel::pengurusan_penilaian_jurulatih_id,
            'pengurusan_pemantauan_dan_penilaian_jurulatih_id' => GeneralLabel::pengurusan_pemantauan_dan_penilaian_jurulatih_id,
            'penilaian_oleh' => GeneralLabel::penilaian_oleh,
            'nama' => GeneralLabel::nama,
            'tarikh_dinilai' => GeneralLabel::tarikh_dinilai,
            'catatan' => GeneralLabel::catatan,

        ];
    }
}
