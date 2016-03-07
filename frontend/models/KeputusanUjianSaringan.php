<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_keputusan_ujian_saringan".
 *
 * @property integer $keputusan_ujian_saringan_id
 * @property integer $ujian_saringan_id
 * @property string $jenis_ujian_saringan
 * @property string $percubaan_1
 * @property string $percubaan_2
 * @property string $terbaik
 */
class KeputusanUjianSaringan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_keputusan_ujian_saringan';
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
            [['ujian_saringan_id', 'jenis_ujian_saringan', 'percubaan_1', 'terbaik'], 'required', 'skipOnEmpty' => true],
            [['ujian_saringan_id'], 'integer'],
            [['percubaan_1', 'percubaan_2', 'terbaik'], 'number'],
            [['jenis_ujian_saringan'], 'string', 'max' => 80]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'keputusan_ujian_saringan_id' => 'Keputusan Ujian Saringan ID',
            'ujian_saringan_id' => 'Ujian Saringan ID',
            'jenis_ujian_saringan' => 'Jenis Ujian Saringan',
            'percubaan_1' => 'Percubaan 1',
            'percubaan_2' => 'Percubaan 2',
            'terbaik' => 'Terbaik',
        ];
    }
}
