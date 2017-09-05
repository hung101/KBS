<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_atlet_perubatan_insurans".
 *
 * @property integer $insurans_id
 * @property integer $atlet_id
 * @property string $syarikat_insurans
 * @property string $no_polisi_hayat
 * @property string $no_polisi_kad_perubatan
 */
class AtletPerubatanInsurans extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_atlet_perubatan_insurans';
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
            [['atlet_id', 'syarikat_insurans'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['atlet_id'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['syarikat_insurans'], 'string', 'max' => 100, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['no_polisi_hayat', 'no_polisi_kad_perubatan'], 'string', 'max' => 20, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['syarikat_insurans','no_polisi_hayat', 'no_polisi_kad_perubatan'], function ($attribute, $params) {
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
            'insurans_id' => GeneralLabel::insurans_id,
            'atlet_id' => GeneralLabel::atlet_id,
            'syarikat_insurans' => GeneralLabel::syarikat_insurans,
            'no_polisi_hayat' => GeneralLabel::no_polisi_hayat,
            'no_polisi_kad_perubatan' => GeneralLabel::no_polisi_kad_perubatan,

        ];
    }
}
