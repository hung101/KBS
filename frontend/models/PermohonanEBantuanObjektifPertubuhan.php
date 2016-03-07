<?php

namespace app\models;

use Yii;

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
            [['objektif'], 'required', 'skipOnEmpty' => true],
            [['permohonan_e_bantuan_id'], 'integer'],
            [['objektif'], 'string', 'max' => 80]
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
