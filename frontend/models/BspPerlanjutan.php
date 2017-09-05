<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_bsp_perlanjutan".
 *
 * @property integer $bsp_perlanjutan_id
 * @property integer $bsp_pemohon_id
 * @property string $tarikh
 * @property string $tempoh_mohon_perlanjutan
 * @property string $permohonan_pelanjutan
 */
class BspPerlanjutan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_bsp_perlanjutan';
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
            [['tarikh', 'tempoh_mohon_perlanjutan', 'permohonan_pelanjutan'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['bsp_pemohon_id'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['tarikh'], 'safe'],
            [['tempoh_mohon_perlanjutan', 'permohonan_pelanjutan'], 'string', 'max' => 30, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['tempoh_mohon_perlanjutan', 'permohonan_pelanjutan'], function ($attribute, $params) {
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
            'bsp_perlanjutan_id' => GeneralLabel::bsp_perlanjutan_id,
            'bsp_pemohon_id' => GeneralLabel::bsp_pemohon_id,
            'tarikh' => GeneralLabel::tarikh,
            'tempoh_mohon_perlanjutan' => GeneralLabel::tempoh_mohon_perlanjutan,
            'permohonan_pelanjutan' => GeneralLabel::permohonan_pelanjutan,

        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefPermohonanPelanjutan(){
        return $this->hasOne(RefPermohonanPelanjutan::className(), ['id' => 'permohonan_pelanjutan']);
    }
}
