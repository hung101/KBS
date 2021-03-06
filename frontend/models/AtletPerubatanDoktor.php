<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_atlet_perubatan_doktor".
 *
 * @property integer $doktor_id
 * @property integer $atlet_id
 * @property string $name_doktor
 * @property integer $no_telefon
 * @property string $hospital_klinik
 */
class AtletPerubatanDoktor extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_atlet_perubatan_doktor';
    }
    
    public function behaviors()
    {
        return [
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
            [['atlet_id', 'nama_doktor', 'no_telefon', 'hospital_klinik'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['atlet_id', 'no_telefon'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
                        [['no_telefon'], 'string', 'max' => 14, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['nama_doktor'], 'string', 'max' => 80, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['hospital_klinik'], 'string', 'max' => 100, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['nama_doktor','hospital_klinik'], function ($attribute, $params) {
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
            'doktor_id' => GeneralLabel::doktor_id,
            'atlet_id' => GeneralLabel::atlet_id,
            'nama_doktor' => GeneralLabel::nama_doktor,
            'no_telefon' => GeneralLabel::no_telefon,
            'hospital_klinik' => GeneralLabel::hospital_klinik,

        ];
    }
}
