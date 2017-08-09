<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_bsp_elaun_perjalanan_udara".
 *
 * @property integer $bsp_elaun_perjalanan_udara_id
 * @property integer $bsp_pemohon_id
 * @property string $tarikh
 * @property string $destinasi_pergi
 * @property string $tarikh_pergi
 * @property string $destinasi_balik
 * @property string $tarikh_balik
 */
class BspElaunPerjalananUdara extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_bsp_elaun_perjalanan_udara';
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
            [['tarikh', 'destinasi_pergi', 'tarikh_pergi', 'destinasi_balik', 'tarikh_balik'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['bsp_pemohon_id'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['tarikh', 'tarikh_pergi', 'tarikh_balik'], 'safe'],
            [['destinasi_pergi', 'destinasi_balik'], 'string', 'max' => 90, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['destinasi_pergi', 'destinasi_balik'], 'filter', 'filter' => function ($value) {
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
            'bsp_elaun_perjalanan_udara_id' => GeneralLabel::bsp_elaun_perjalanan_udara_id,
            'bsp_pemohon_id' => GeneralLabel::bsp_pemohon_id,
            'tarikh' => GeneralLabel::tarikh,
            'destinasi_pergi' => GeneralLabel::destinasi_pergi,
            'tarikh_pergi' => GeneralLabel::tarikh_pergi,
            'destinasi_balik' => GeneralLabel::destinasi_balik,
            'tarikh_balik' => GeneralLabel::tarikh_balik,
            'muat_naik' => GeneralLabel::muat_naik,

        ];
    }
}
