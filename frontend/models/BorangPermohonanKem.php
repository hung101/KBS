<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;

/**
 * This is the model class for table "tbl_borang_permohonan_kem".
 *
 * @property integer $borang_permohonan_kem_id
 * @property string $nama_program
 * @property string $tarikh_program
 * @property string $tempat
 * @property string $objektif
 * @property string $cadangan
 */
class BorangPermohonanKem extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_borang_permohonan_kem';
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
            [['nama_program', 'tarikh_program', 'tempat', 'objektif', 'cadangan'], 'required', 'skipOnEmpty' => true],
            [['tarikh_program'], 'safe'],
            [['nama_program'], 'string', 'max' => 80],
            [['tempat'], 'string', 'max' => 90],
            [['objektif', 'cadangan'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'borang_permohonan_kem_id' => GeneralLabel::borang_permohonan_kem_id,
            'nama_program' => GeneralLabel::nama_program,
            'tarikh_program' => GeneralLabel::tarikh_program,
            'tempat' => GeneralLabel::tempat,
            'objektif' => GeneralLabel::objektif,
            'cadangan' => GeneralLabel::cadangan,

        ];
    }
}
