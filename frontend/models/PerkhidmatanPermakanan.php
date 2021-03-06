<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_perkhidmatan_permakanan".
 *
 * @property integer $perkhidmatan_permakanan_id
 * @property integer $permohonan_perkhidmatan_permakanan_id
 * @property string $tarikh
 * @property string $pegawai_yang_bertanggungjawab
 * @property string $catitan_ringkas
 */
class PerkhidmatanPermakanan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_perkhidmatan_permakanan';
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
            [['tarikh', 'pegawai_yang_bertanggungjawab'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['permohonan_perkhidmatan_permakanan_id'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['tarikh', 'jantina', 'sukan'], 'safe'],
            [['pegawai_yang_bertanggungjawab'], 'string', 'max' => 80, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['catitan_ringkas'], 'string', 'max' => 255, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['pegawai_yang_bertanggungjawab','catitan_ringkas'], function ($attribute, $params) {
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
            'perkhidmatan_permakanan_id' => GeneralLabel::perkhidmatan_permakanan_id,
            'permohonan_perkhidmatan_permakanan_id' => GeneralLabel::permohonan_perkhidmatan_permakanan_id,
            'tarikh' => GeneralLabel::tarikh,
            'pegawai_yang_bertanggungjawab' => GeneralLabel::pegawai_yang_bertanggungjawab,
            'catitan_ringkas' => GeneralLabel::catitan_ringkas,
            'jantina' => GeneralLabel::jantina,
            'sukan' => GeneralLabel::sukan,
        ];
    }
}
