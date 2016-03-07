<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_atlet_perubatan_doktor".
 *
 * @property integer $doktor_id
 * @property integer $atlet_id
 * @property string $name_doktor
 * @property integer $no_telefon
 * @property string $hospital_klinik
 */
class AtletPerubatanDoktor extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_atlet_perubatan_doktor';
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
            [['atlet_id', 'nama_doktor', 'no_telefon', 'hospital_klinik'], 'required', 'skipOnEmpty' => true],
            [['atlet_id', 'no_telefon'], 'integer'],
            [['nama_doktor'], 'string', 'max' => 80],
            [['hospital_klinik'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'doktor_id' => 'Doktor ID',
            'atlet_id' => 'Atlet ID',
            'nama_doktor' => 'Nama Doktor',
            'no_telefon' => 'No Telefon',
            'hospital_klinik' => 'Hospital / Klinik',
        ];
    }
}
