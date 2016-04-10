<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_atlet_perubatan_donator".
 *
 * @property integer $donator_id
 * @property integer $atlet_id
 * @property string $no_donator_dokumen
 * @property string $jenis_organ
 */
class AtletPerubatanDonator extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_atlet_perubatan_donator';
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
            [['atlet_id', 'no_donator_dokumen', 'jenis_organ'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['atlet_id'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['no_donator_dokumen'], 'string', 'max' => 20, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['jenis_organ'], 'string', 'max' => 30, 'tooLong' => GeneralMessage::yii_validation_string_max]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'donator_id' => GeneralLabel::donator_id,
            'atlet_id' => GeneralLabel::atlet_id,
            'no_donator_dokumen' => GeneralLabel::no_donator_dokumen,
            'jenis_organ' => GeneralLabel::jenis_organ,

        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefJenisOrgan(){
        return $this->hasOne(RefJenisOrgan::className(), ['id' => 'jenis_organ']);
    }
}
