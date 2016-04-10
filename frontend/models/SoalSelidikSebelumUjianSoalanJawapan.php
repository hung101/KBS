<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_soal_selidik_sebelum_ujian_soalan_jawapan".
 *
 * @property integer $soal_selidik_sebelum_ujian_soalan_jawapan_id
 * @property integer $soal_selidik_sebelum_ujian_id
 * @property integer $soalan
 * @property integer $jawapan
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created
 * @property string $updated
 */
class SoalSelidikSebelumUjianSoalanJawapan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_soal_selidik_sebelum_ujian_soalan_jawapan';
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
            [['soal_selidik_sebelum_ujian_id', 'soalan', 'jawapan', 'created_by', 'updated_by'], 'integer'],
            [['created', 'updated'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'soal_selidik_sebelum_ujian_soalan_jawapan_id' => GeneralLabel::soal_selidik_sebelum_ujian_soalan_jawapan_id,
            'soal_selidik_sebelum_ujian_id' => GeneralLabel::soal_selidik_sebelum_ujian_id,
            'soalan' => GeneralLabel::soalan,
            'jawapan' => GeneralLabel::jawapan,
            'created_by' => GeneralLabel::created_by,
            'updated_by' => GeneralLabel::updated_by,
            'created' => GeneralLabel::created,
            'updated' => GeneralLabel::updated,

        ];
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
