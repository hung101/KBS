<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_kursus".
 *
 * @property integer $kursus_id
 * @property string $nama_kursus
 * @property string $tempat
 * @property string $tarikh
 * @property string $penganjur
 * @property string $kod_kursus
 * @property string $pengkhususan
 */
class Kursus extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_kursus';
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
            [['nama_kursus', 'tempat', 'tarikh', 'penganjur', 'kod_kursus'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['tarikh'], 'safe'],
            [['nama_kursus', 'penganjur', 'pengkhususan'], 'string', 'max' => 80, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['tempat'], 'string', 'max' => 90, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['kod_kursus'], 'string', 'max' => 30, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['tempat','nama_kursus', 'penganjur', 'pengkhususan','kod_kursus'], 'filter', 'filter' => function ($value) {
                return  \common\models\general\GeneralFunction::filterXSS($value);
            }],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'kursus_id' => GeneralLabel::kursus_id,
            'nama_kursus' => GeneralLabel::nama_kursus,
            'tempat' => GeneralLabel::tempat,
            'tarikh' => GeneralLabel::tarikh,
            'penganjur' => GeneralLabel::penganjur,
            'kod_kursus' => GeneralLabel::kod_kursus,
            'pengkhususan' => GeneralLabel::pengkhususan,

        ];
    }
}
