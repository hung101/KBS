<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_atlet_pembangunan_kemahiran".
 *
 * @property integer $kemahiran_id
 * @property integer $atlet_id
 * @property string $jenis_kemahiran
 * @property string $nama_kemahiran
 */
class AtletPembangunanKemahiran extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_atlet_pembangunan_kemahiran';
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
            [['atlet_id', 'jenis_kemahiran', 'tarikh_mula', 'tarikh_tamat', 'penganjur', 'lokasi'], 'required', 'skipOnEmpty' => true],
            [['atlet_id'], 'integer'],
            [['jenis_kemahiran'], 'string', 'max' => 30],
            [['nama_kemahiran'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'kemahiran_id' => 'Kemahiran ID',
            'atlet_id' => 'Atlet ID',
            'jenis_kemahiran' => 'Jenis Kemahiran',
            'nama_kemahiran' => 'Nama Kemahiran',
            'tarikh_mula' => 'Tarikh Mula',
            'tarikh_tamat' => 'Tarikh Tamat',
            'penganjur' => 'Penganjur',
            'lokasi' => 'Lokasi'
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefJenisKemahiran(){
        return $this->hasOne(RefJenisKemahiran::className(), ['id' => 'jenis_kemahiran']);
    }
}
