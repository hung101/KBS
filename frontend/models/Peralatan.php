<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_peralatan".
 *
 * @property integer $peralatan_id
 * @property integer $permohonan_peralatan_id
 * @property string $nama_peralatan
 * @property string $spesifikasi
 * @property string $kuantiti_unit
 * @property string $catatan
 */
class Peralatan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_peralatan';
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
            [['nama_peralatan', 'kuantiti_unit'], 'required', 'skipOnEmpty' => true],
            [['permohonan_peralatan_id'], 'integer'],
            [['nama_peralatan'], 'string', 'max' => 80],
            [['spesifikasi', 'kuantiti_unit'], 'string', 'max' => 30],
            [['catatan'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'peralatan_id' => 'Peralatan ID',
            'permohonan_peralatan_id' => 'Permohonan Peralatan ID',
            'nama_peralatan' => 'Nama Peralatan',
            'spesifikasi' => 'Spesifikasi',
            'kuantiti_unit' => 'Kuantiti / Unit',
            'catatan' => 'Catatan',
        ];
    }
}
