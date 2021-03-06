<?php

namespace app\models;

use Yii;
use app\models\general\GeneralVariable;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_jurulatih_pengalaman".
 *
 * @property integer $jurulatih_pengalaman_id
 * @property integer $jurulatih_id
 * @property string $tahun
 * @property string $perkara_aktiviti
 */
class JurulatihPengalaman extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_jurulatih_pengalaman';
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
            [['jurulatih_id', 'tahun', 'tahun_akhir', 'perkara_aktiviti'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['jurulatih_id'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['tahun', 'tahun_akhir'], 'integer','min'=>GeneralVariable::yearMin,'max'=>GeneralVariable::yearMax, 'message' => GeneralMessage::yii_validation_integer, 'tooBig' => GeneralMessage::yii_validation_integer_max, 'tooSmall' => GeneralMessage::yii_validation_integer_min],
            [['perkara_aktiviti'], 'string', 'max' => 80, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['tahun_akhir'], 'compare', 'compareAttribute'=>'tahun', 'operator'=>'>=', 'skipOnEmpty'=>true, 'message' => GeneralMessage::yii_validation_compare],
            [['perkara_aktiviti'], function ($attribute, $params) {
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
            'jurulatih_pengalaman_id' => GeneralLabel::jurulatih_pengalaman_id,
            'jurulatih_id' => GeneralLabel::jurulatih_id,
            'tahun' => GeneralLabel::tahun_mula,
            'perkara_aktiviti' => GeneralLabel::perkara_aktiviti,
            'tahun_akhir' => GeneralLabel::tahun_akhir,
        ];
    }
}
