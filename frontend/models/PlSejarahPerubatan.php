<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_pl_sejarah_perubatan".
 *
 * @property integer $pl_sejarah_perubatan_id
 * @property integer $atlet_id
 * @property string $tarikh
 * @property string $nama_perubatan
 * @property string $butiran_perubatan
 */
class PlSejarahPerubatan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_pl_sejarah_perubatan';
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
            [['atlet_id', 'tarikh', 'nama_perubatan', 'butiran_perubatan'], 'required', 'skipOnEmpty' => true],
            [['atlet_id'], 'integer'],
            [['tarikh'], 'safe'],
            [['nama_perubatan'], 'string', 'max' => 80],
            [['butiran_perubatan'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pl_sejarah_perubatan_id' => 'Pl Sejarah Perubatan ID',
            'atlet_id' => 'Atlet ID',
            'tarikh' => 'Tarikh',
            'nama_perubatan' => 'Nama Perubatan',
            'butiran_perubatan' => 'Butiran Perubatan',
        ];
    }
}
