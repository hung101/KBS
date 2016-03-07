<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_biomekanik_anthropometrics".
 *
 * @property integer $biomekanik_anthropometrics_id
 * @property integer $perkhidmatan_biomekanik_id
 * @property string $anthropometrics
 * @property string $cm_kg
 */
class BiomekanikAnthropometrics extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_biomekanik_anthropometrics';
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
            [['anthropometrics', 'cm_kg'], 'required', 'skipOnEmpty' => true],
            [['perkhidmatan_analisa_perlawanan_biomekanik_id'], 'integer'],
            [['cm_kg'], 'number'],
            [['anthropometrics'], 'string', 'max' => 80],
            [['catatan'], 'string', 'max' => 80]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'biomekanik_anthropometrics_id' => 'Biomekanik Anthropometrics ID',
            'perkhidmatan_analisa_perlawanan_biomekanik_id' => 'Perkhidmatan Biomekanik ID',
            'anthropometrics' => 'Anthropometrics',
            'cm_kg' => 'cm/kg',
            'catatan' => 'Catatan',
        ];
    }
    
    public function getRefAnthropometricsUjian()
    {
        return $this->hasOne(RefAnthropometricsUjian::className(), ['id' => 'anthropometrics']);
    }
}
