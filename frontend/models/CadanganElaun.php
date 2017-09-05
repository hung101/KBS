<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_cadangan_elaun".
 *
 * @property integer $cadangan_elaun_id
 * @property integer $atlet
 * @property string $elaun_semasa
 * @property string $elaun_cadangan
 * @property string $tarikh_mula
 * @property string $tarikh_tamat
 * @property string $ulasan
 * @property string $jenis_kelulusan
 * @property string $muat_naik
 */
class CadanganElaun extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_cadangan_elaun';
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
            [['atlet', 'elaun_semasa', 'elaun_cadangan', 'tarikh_mula', 'tarikh_tamat', 'jenis_kelulusan'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['atlet'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['elaun_semasa', 'elaun_cadangan'], 'number', 'message' => GeneralMessage::yii_validation_number],
            [['tarikh_mula', 'tarikh_tamat'], 'safe'],
            [['ulasan'], 'string', 'max' => 255, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['jenis_kelulusan'], 'string', 'max' => 30, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['muat_naik'], 'string', 'max' => 100, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['ulasan','jenis_kelulusan'], function ($attribute, $params) {
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
            'cadangan_elaun_id' => GeneralLabel::cadangan_elaun_id,
            'atlet' => GeneralLabel::atlet,
            'elaun_semasa' => GeneralLabel::elaun_semasa,
            'elaun_cadangan' => GeneralLabel::elaun_cadangan,
            'tarikh_mula' => GeneralLabel::tarikh_mula,
            'tarikh_tamat' => GeneralLabel::tarikh_tamat,
            'ulasan' => GeneralLabel::ulasan,
            'jenis_kelulusan' => GeneralLabel::jenis_kelulusan,
            'muat_naik' => GeneralLabel::muat_naik,

        ];
    }
}
