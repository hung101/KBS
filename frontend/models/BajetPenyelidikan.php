<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_bajet_penyelidikan".
 *
 * @property integer $bajet_penyelidikan_id
 * @property integer $permohonana_penyelidikan_id
 * @property string $jenis_bajet
 * @property string $tahun
 * @property string $jumlah
 */
class BajetPenyelidikan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_bajet_penyelidikan';
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
            [['jenis_bajet', 'tahun', 'jumlah'], 'required', 'skipOnEmpty' => true],
            [['permohonana_penyelidikan_id'], 'integer'],
            [['tahun'], 'safe'],
            [['jumlah'], 'number'],
            [['jenis_bajet'], 'string', 'max' => 80]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'bajet_penyelidikan_id' => 'Bajet Penyelidikan ID',
            'permohonana_penyelidikan_id' => 'Permohonana Penyelidikan ID',
            'jenis_bajet' => 'Jenis Bajet',
            'tahun' => 'Tahun',
            'jumlah' => 'Jumlah',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefJenisBajet(){
        return $this->hasOne(RefJenisBajet::className(), ['id' => 'jenis_bajet']);
    }
}
