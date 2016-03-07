<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_atlet_kewangan_elaun".
 *
 * @property integer $elaun_id
 * @property integer $atlet_id
 * @property string $jumlah_elaun
 * @property string $tarikh
 */
class AtletKewanganElaun extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_atlet_kewangan_elaun';
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
            [['atlet_id', 'jenis_elaun', 'jumlah_elaun', 'tarikh_mula', 'tarikh_tamat'], 'required', 'skipOnEmpty' => true],
            [['atlet_id'], 'integer'],
            [['jumlah_elaun'], 'number'],
            [['tarikh_mula', 'tarikh_tamat'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'elaun_id' => 'Elaun ID',
            'atlet_id' => 'Atlet ID',
            'jenis_elaun' => 'Jenis Elaun',
            'jumlah_elaun' => 'Jumlah Elaun',
            'tarikh_mula' => 'Tarikh Mula',
            'tarikh_tamat' => 'Tarikh Tamat',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefJenisElaun(){
        return $this->hasOne(RefJenisElaun::className(), ['id' => 'jenis_elaun']);
    }
}
