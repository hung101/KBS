<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;

/**
 * This is the model class for table "tbl_jurulatih_kesihatan_masalah".
 *
 * @property integer $jurulatih_kesihatan_kesihatan_id
 * @property integer $jurulatih_kesihatan_id
 * @property string $masalah_kesihatan
 * @property string $session_id
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created
 * @property string $updated
 */
class JurulatihKesihatanMasalah extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_jurulatih_kesihatan_masalah';
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
            [['jurulatih_kesihatan_id', 'created_by', 'updated_by'], 'integer'],
            [['masalah_kesihatan'], 'required'],
            [['created', 'updated'], 'safe'],
            [['masalah_kesihatan'], 'string', 'max' => 30],
            [['session_id'], 'string', 'max' => 100],
            [['masalah_kesihatan'], function ($attribute, $params) {
                if (!\common\models\general\GeneralFunction::validateXSS($this->$attribute)) {
                    $this->addError($attribute, GeneralMessage::yii_validation_xss);
                }
            }],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'jurulatih_kesihatan_kesihatan_id' => 'Jurulatih Kesihatan Kesihatan ID',
            'jurulatih_kesihatan_id' => 'Jurulatih Kesihatan ID',
            'masalah_kesihatan' => GeneralLabel::masalah_kesihatan,
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
    public function getRefMasalahKesihatan(){
        return $this->hasOne(RefMasalahKesihatan::className(), ['id' => 'masalah_kesihatan']);
    }
}
