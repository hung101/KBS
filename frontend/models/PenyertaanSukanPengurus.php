<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_penyertaan_sukan_pengurus".
 *
 * @property integer $penyertaan_sukan_pengurus_id
 * @property integer $penyertaan_sukan_id
 * @property string $nama
 */
class PenyertaanSukanPengurus extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_penyertaan_sukan_pengurus';
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
            [['nama'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['penyertaan_sukan_id'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['nama'], 'string', 'max' => 255, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['nama'], function ($attribute, $params) {
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
            'penyertaan_sukan_pengurus_id' => GeneralLabel::id,
            'penyertaan_sukan_id' => GeneralLabel::penyertaan_sukan_id,
            'nama' => GeneralLabel::nama,
        ];
    }
}
