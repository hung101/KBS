<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_elaporan_kewangan_dan_perbelanjaan".
 *
 * @property integer $elaporan_kewangan_dan_perbelanjaan_id
 * @property integer $elaporan_pelaksaan_id
 * @property string $program_aktiviti_butir
 * @property string $jenis_kewangan
 * @property string $jumlah
 */
class ElaporanKewanganDanPerbelanjaan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_elaporan_kewangan_dan_perbelanjaan';
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
            [['elaporan_pelaksaan_id', 'program_aktiviti_butir', 'jenis_kewangan', 'jumlah'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['elaporan_pelaksaan_id'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['jumlah'], 'number', 'message' => GeneralMessage::yii_validation_number],
            [['program_aktiviti_butir'], 'string', 'max' => 80, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['jenis_kewangan'], 'string', 'max' => 30, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['program_aktiviti_butir','jenis_kewangan'], function ($attribute, $params) {
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
            'elaporan_kewangan_dan_perbelanjaan_id' => GeneralLabel::elaporan_kewangan_dan_perbelanjaan_id,
            'elaporan_pelaksaan_id' => GeneralLabel::elaporan_pelaksaan_id,
            'program_aktiviti_butir' => GeneralLabel::program_aktiviti_butir,
            'jenis_kewangan' => GeneralLabel::jenis_kewangan,
            'jumlah' => GeneralLabel::jumlah,

        ];
    }
}
