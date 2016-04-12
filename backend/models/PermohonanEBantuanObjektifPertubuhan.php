<?php

namespace app\models;

use Yii;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_permohonan_e_bantuan_objektif_pertubuhan".
 *
 * @property integer $objektif_pertubuhan_id
 * @property integer $permohonan_e_bantuan_id
 * @property string $objektif
 */
class PermohonanEBantuanObjektifPertubuhan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_permohonan_e_bantuan_objektif_pertubuhan';
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
            [['objektif'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['permohonan_e_bantuan_id'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['objektif'], 'string', 'max' => 80, 'tooLong' => GeneralMessage::yii_validation_string_max]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'objektif_pertubuhan_id' => 'Objektif Pertubuhan ID',
            'permohonan_e_bantuan_id' => 'Permohonan E Bantuan ID',
            'objektif' => 'Objektif',
        ];
    }
}
