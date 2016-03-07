<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_soal_selidik_sebelum_ujian".
 *
 * @property integer $soal_selidik_sebelum_ujian_id
 * @property integer $atlet_id
 * @property string $tarikh
 * @property string $soalan
 * @property string $jawapan
 */
class SoalSelidikSebelumUjian extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_soal_selidik_sebelum_ujian';
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
            [['atlet_id', 'tarikh', 'soalan', 'jawapan'], 'required', 'skipOnEmpty' => true],
            [['atlet_id'], 'integer'],
            [['tarikh'], 'safe'],
            [['soalan'], 'string', 'max' => 80],
            [['jawapan'], 'string', 'max' => 30]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'soal_selidik_sebelum_ujian_id' => 'Soal Selidik Sebelum Ujian ID',
            'atlet_id' => 'Atlet ID',
            'tarikh' => 'Tarikh',
            'soalan' => 'Soalan',
            'jawapan' => 'Jawapan',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefAtlet(){
        return $this->hasOne(Atlet::className(), ['atlet_id' => 'atlet_id']);
    }
    
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefSoalanSoalSelidik(){
        return $this->hasOne(RefSoalanSoalSelidik::className(), ['id' => 'soalan']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefJawapanSoalSelidik(){
        return $this->hasOne(RefJawapanSoalSelidik::className(), ['id' => 'jawapan']);
    }
}
