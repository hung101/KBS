<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_elaporan_pelaksanaan_objektif".
 *
 * @property integer $elaporan_pelaksanaan_objektif_id
 * @property integer $elaporan_pelaksaan_id
 * @property string $objektif_pelaksanaan
 */
class ElaporanPelaksanaanObjektif extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_elaporan_pelaksanaan_objektif';
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
            [['objektif_pelaksanaan'], 'required', 'skipOnEmpty' => true],
            [['elaporan_pelaksaan_id'], 'integer'],
            [['objektif_pelaksanaan'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'elaporan_pelaksanaan_objektif_id' => 'Elaporan Pelaksanaan Objektif ID',
            'elaporan_pelaksaan_id' => 'Elaporan Pelaksaan ID',
            'objektif_pelaksanaan' => 'Objektif Pelaksanaan',
        ];
    }
}
