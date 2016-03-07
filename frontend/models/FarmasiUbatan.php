<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_farmasi_ubatan".
 *
 * @property integer $farmasi_ubatan_id
 * @property integer $farmasi_permohonan_ubatan_id
 * @property string $nama_ubat
 * @property string $size
 * @property integer $kuantiti
 * @property string $harga
 */
class FarmasiUbatan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_farmasi_ubatan';
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
            //[['farmasi_permohonan_ubatan_id', 'nama_ubat', 'kuantiti', 'harga'], 'required', 'skipOnEmpty' => true],
            [['farmasi_permohonan_ubatan_id', 'kuantiti'], 'integer'],
            [['harga'], 'number'],
            [['nama_ubat'], 'string', 'max' => 80],
            [['size'], 'string', 'max' => 30]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'farmasi_ubatan_id' => 'Farmasi Ubatan ID',
            'farmasi_permohonan_ubatan_id' => 'Farmasi Permohonan Ubatan ID',
            'nama_ubat' => 'Nama Ubat',
            'size' => 'Size',
            'kuantiti' => 'Kuantiti',
            'harga' => 'Harga',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefUbat(){
        return $this->hasOne(RefUbat::className(), ['id' => 'nama_ubat']);
    }
}
