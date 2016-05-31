<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_pengurusan_jawatankuasa_khas_sukan_malaysia".
 *
 * @property integer $pengurusan_jawatankuasa_khas_sukan_malaysia_id
 * @property string $temasya
 * @property string $tarikh_mula
 * @property string $tarikh_tamat
 * @property integer $jawatankuasa
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created
 * @property string $updated
 */
class PengurusanJawatankuasaKhasSukanMalaysia extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_pengurusan_jawatankuasa_khas_sukan_malaysia';
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
            [['tarikh_mula', 'tarikh_tamat', 'created', 'updated'], 'safe'],
            [['jawatankuasa', 'created_by', 'updated_by'], 'integer'],
            [['temasya'], 'string', 'max' => 80]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pengurusan_jawatankuasa_khas_sukan_malaysia_id' => 'Pengurusan Jawatankuasa Khas Sukan Malaysia ID',
            'temasya' => 'Temasya',
            'tarikh_mula' => 'Tarikh Mula',
            'tarikh_tamat' => 'Tarikh Tamat',
            'jawatankuasa' => 'Jawatankuasa',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created' => 'Created',
            'updated' => 'Updated',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefJawatankuasaKhas(){
        return $this->hasOne(RefJawatankuasaKhas::className(), ['id' => 'jawatankuasa']);
    }
}
