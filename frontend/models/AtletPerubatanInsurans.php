<?php

namespace app\models;

use Yii;

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
            [['atlet_id', 'syarikat_insurans'], 'required', 'skipOnEmpty' => true],
            [['atlet_id'], 'integer'],
            [['syarikat_insurans'], 'string', 'max' => 100],
            [['no_polisi_hayat', 'no_polisi_kad_perubatan'], 'string', 'max' => 20]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'insurans_id' => 'Insurans ID',
            'atlet_id' => 'Atlet ID',
            'syarikat_insurans' => 'Syarikat Insurans',
            'no_polisi_hayat' => 'No Polisi Hayat',
            'no_polisi_kad_perubatan' => 'No Polisi Kad Perubatan',
        ];
    }
}
