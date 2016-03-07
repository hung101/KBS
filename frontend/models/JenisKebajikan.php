<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_jenis_kebajikan".
 *
 * @property integer $jenis_kebajikan_id
 * @property string $jenis_kebajikan
 * @property string $perkara
 * @property string $sukan_sea_para_asean
 * @property string $sukan_asia_komenwel_para_asia_ead
 * @property string $sukan_olimpik_paralimpik
 * @property string $kejohanan_asia_dunia
 */
class JenisKebajikan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_jenis_kebajikan';
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
            [['jenis_kebajikan', 'perkara', 'sukan_sea_para_asean', 'sukan_asia_komenwel_para_asia_ead', 'sukan_olimpik_paralimpik', 'kejohanan_asia_dunia'], 'required', 'skipOnEmpty' => true],
            [['sukan_sea_para_asean', 'sukan_asia_komenwel_para_asia_ead', 'sukan_olimpik_paralimpik', 'kejohanan_asia_dunia'], 'number'],
            [['jenis_kebajikan'], 'string', 'max' => 30],
            [['perkara'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'jenis_kebajikan_id' => 'Jenis Kebajikan ID',
            'jenis_kebajikan' => 'Jenis Kebajikan',
            'perkara' => 'Perkara',
            'sukan_sea_para_asean' => 'Sukan SEA/Para Asean (RM)',
            'sukan_asia_komenwel_para_asia_ead' => 'Sukan Asia/Komenwel/Para Asia/EAD (RM)',
            'sukan_olimpik_paralimpik' => 'Sukan Olimpik/Paralimpik (RM)',
            'kejohanan_asia_dunia' => 'Kejohanan Asia/Dunia (RM)',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefJenisKebajikan(){
        return $this->hasOne(RefJenisKebajikan::className(), ['id' => 'jenis_kebajikan']);
    }
}
