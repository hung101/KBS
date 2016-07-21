<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_jurulatih_sukan_acara".
 *
 * @property integer $jurulatih_sukan_acara_id
 * @property integer $jurulatih_sukan_id
 * @property string $acara
 * @property string $session_id
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created
 * @property string $updated
 */
class JurulatihSukanAcara extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_jurulatih_sukan_acara';
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
            [['jurulatih_sukan_id', 'created_by', 'updated_by'], 'integer'],
            [['acara'], 'required'],
            [['created', 'updated'], 'safe'],
            [['acara'], 'string', 'max' => 30],
            [['session_id'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'jurulatih_sukan_acara_id' => 'Jurulatih Sukan Acara ID',
            'jurulatih_sukan_id' => 'Jurulatih Sukan ID',
            'acara' => 'Acara',
            'session_id' => 'Session ID',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created' => 'Created',
            'updated' => 'Updated',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefAcara(){
        return $this->hasOne(RefAcara::className(), ['id' => 'acara']);
    }
}
