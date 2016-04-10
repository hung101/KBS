<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_pl_sejarah_perubatan".
 *
 * @property integer $pl_sejarah_perubatan_id
 * @property integer $atlet_id
 * @property string $tarikh
 * @property string $nama_perubatan
 * @property string $butiran_perubatan
 */
class PlSejarahPerubatan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_pl_sejarah_perubatan';
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
            [['atlet_id', 'tarikh', 'nama_perubatan', 'butiran_perubatan'], 'required', 'skipOnEmpty' => true],
            [['atlet_id'], 'integer'],
            [['tarikh'], 'safe'],
            [['nama_perubatan'], 'string', 'max' => 80],
            [['butiran_perubatan'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pl_sejarah_perubatan_id' => GeneralLabel::pl_sejarah_perubatan_id,
            'atlet_id' => GeneralLabel::atlet_id,
            'tarikh' => GeneralLabel::tarikh,
            'nama_perubatan' => GeneralLabel::nama_perubatan,
            'butiran_perubatan' => GeneralLabel::butiran_perubatan,

        ];
    }
}
