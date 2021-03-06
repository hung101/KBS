<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_pengurusan_sajian_makan".
 *
 * @property integer $pengurusan_sajian_makan_id
 * @property integer $atlet_id
 * @property string $tarikh_mula
 * @property string $tarikh_akhir
 * @property string $bilangan_tempahan_makan
 */
class PengurusanSajianMakan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_pengurusan_sajian_makan';
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
            [['atlet_id', 'tarikh_mula', 'tarikh_akhir', 'bilangan_tempahan_makan'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            //[['atlet_id'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['tarikh_mula', 'tarikh_akhir','atlet'], 'safe'],
            [['atlet_id'], 'string', 'max' => 90, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['bilangan_tempahan_makan'], 'string', 'max' => 50, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['catatan', 'lampiran_senarai_nama'], 'string', 'max' => 255, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['atlet_id','bilangan_tempahan_makan','catatan', 'lampiran_senarai_nama'], function ($attribute, $params) {
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
            'pengurusan_sajian_makan_id' => GeneralLabel::pengurusan_sajian_makan_id,
            'atlet_id' => GeneralLabel::tempat_sajian,  //"Tempat Sajian",
            'tarikh_mula' => GeneralLabel::tarikh_mula,
            'tarikh_akhir' => GeneralLabel::tarikh_akhir,
            'bilangan_tempahan_makan' => GeneralLabel::bilangan_tempahan_makan,
            'atlet' => GeneralLabel::atlet,
            'catatan' => GeneralLabel::catatan,
            'lampiran_senarai_nama' => GeneralLabel::lampiran_senarai_nama,  //"Lampiran Senarai Nama",
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefAtlet(){
        return $this->hasOne(Atlet::className(), ['atlet_id' => 'atlet_id']);
    }
}
