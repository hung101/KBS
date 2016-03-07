<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_biomekanik_ujian".
 *
 * @property integer $biomekanik_ujian_id
 * @property integer $perkhidmatan_biomekanik_id
 * @property string $tarikh
 * @property string $biomekanik_ujian
 */
class BiomekanikUjian extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_biomekanik_ujian';
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
            [['tarikh', 'biomekanik_ujian'], 'required', 'skipOnEmpty' => true],
            [['perkhidmatan_analisa_perlawanan_biomekanik_id'], 'integer'],
            [['tarikh'], 'safe'],
            [['biomekanik_ujian'], 'string', 'max' => 80]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'biomekanik_ujian_id' => 'Biomekanik Ujian ID',
            'perkhidmatan_analisa_perlawanan_biomekanik_id' => 'Perkhidmatan Biomekanik ID',
            'tarikh' => 'Tarikh',
            'biomekanik_ujian' => 'Biomekanik Ujian',
        ];
    }
    
    public function getRefBiomekanikUjian()
    {
        return $this->hasOne(RefBiomekanikUjian::className(), ['id' => 'biomekanik_ujian']);
    }
}
