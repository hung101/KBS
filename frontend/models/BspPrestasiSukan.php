<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_bsp_prestasi_sukan".
 *
 * @property integer $bsp_prestasi_sukan_id
 * @property integer $bsp_pemohon_id
 * @property string $tarikh
 * @property string $kejohanan_yang_disertai
 * @property string $lokasi_kejohanan
 * @property string $pencapaian
 */
class BspPrestasiSukan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_bsp_prestasi_sukan';
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
            [['bsp_pemohon_id', 'tarikh', 'kejohanan_yang_disertai', 'lokasi_kejohanan', 'pencapaian'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['bsp_pemohon_id'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['tarikh'], 'safe'],
            [['kejohanan_yang_disertai'], 'string', 'max' => 80, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['lokasi_kejohanan'], 'string', 'max' => 90, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['pencapaian'], 'string', 'max' => 30, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['kejohanan_yang_disertai','lokasi_kejohanan','pencapaian'], function ($attribute, $params) {
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
            'bsp_prestasi_sukan_id' => GeneralLabel::bsp_prestasi_sukan_id,
            'bsp_pemohon_id' => GeneralLabel::bsp_pemohon_id,
            'tarikh' => GeneralLabel::tarikh,
            'kejohanan_yang_disertai' => GeneralLabel::kejohanan_yang_disertai,
            'lokasi_kejohanan' => GeneralLabel::lokasi_kejohanan,
            'pencapaian' => GeneralLabel::pencapaian,

        ];
    }
}
