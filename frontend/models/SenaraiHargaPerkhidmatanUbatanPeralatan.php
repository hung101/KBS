<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_senarai_harga_perkhidmatan_ubatan_peralatan".
 *
 * @property integer $senarai_harga_perkhidmatan_ubatan_peralatan_id
 * @property string $nama_perkhidmatan_ubatan_peralatan
 * @property string $harga
 * @property string $catitan_ringkas
 */
class SenaraiHargaPerkhidmatanUbatanPeralatan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_senarai_harga_perkhidmatan_ubatan_peralatan';
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
            [['nama_perkhidmatan_ubatan_peralatan', 'harga'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['harga'], 'number', 'message' => GeneralMessage::yii_validation_number],
            [['nama_perkhidmatan_ubatan_peralatan', 'dikemaskini_oleh'], 'string', 'max' => 80, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['catitan_ringkas'], 'string', 'max' => 255, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['tarikh'], 'safe'],
            [['nama_perkhidmatan_ubatan_peralatan', 'dikemaskini_oleh','catitan_ringkas'], function ($attribute, $params) {
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
            'senarai_harga_perkhidmatan_ubatan_peralatan_id' => GeneralLabel::senarai_harga_perkhidmatan_ubatan_peralatan_id,
            'nama_perkhidmatan_ubatan_peralatan' => GeneralLabel::nama_perkhidmatan_ubatan_peralatan,
            'harga' => GeneralLabel::harga,
            'catitan_ringkas' => GeneralLabel::catitan_ringkas,
            'tarikh' => GeneralLabel::tarikh,
            'dikemaskini_oleh' => GeneralLabel::dikemaskini_oleh,
        ];
    }
}
