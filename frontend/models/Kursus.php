<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_kursus".
 *
 * @property integer $kursus_id
 * @property string $nama_kursus
 * @property string $tempat
 * @property string $tarikh
 * @property string $penganjur
 * @property string $kod_kursus
 * @property string $pengkhususan
 */
class Kursus extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_kursus';
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
            [['nama_kursus', 'tempat', 'tarikh', 'penganjur', 'kod_kursus'], 'required', 'skipOnEmpty' => true],
            [['tarikh'], 'safe'],
            [['nama_kursus', 'penganjur', 'pengkhususan'], 'string', 'max' => 80],
            [['tempat'], 'string', 'max' => 90],
            [['kod_kursus'], 'string', 'max' => 30]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'kursus_id' => 'Kursus ID',
            'nama_kursus' => 'Nama Kursus',
            'tempat' => 'Tempat',
            'tarikh' => 'Tarikh',
            'penganjur' => 'Penganjur',
            'kod_kursus' => 'Kod Kursus',
            'pengkhususan' => 'Pengkhususan',
        ];
    }
}
