<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_borang_penilaian".
 *
 * @property integer $borang_penilaian_id
 * @property string $nama_program
 * @property string $tarikh_program
 * @property string $tempat
 */
class BorangPenilaian extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_borang_penilaian';
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
            [['nama_program', 'tarikh_program', 'tempat'], 'required', 'skipOnEmpty' => true],
            [['tarikh_program'], 'safe'],
            [['nama_program'], 'string', 'max' => 80],
            [['tempat'], 'string', 'max' => 90]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'borang_penilaian_id' => GeneralLabel::borang_penilaian_id,
            'nama_program' => GeneralLabel::nama_program,
            'tarikh_program' => GeneralLabel::tarikh_program,
            'tempat' => GeneralLabel::tempat,

        ];
    }
}
