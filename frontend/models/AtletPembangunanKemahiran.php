<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_atlet_pembangunan_kemahiran".
 *
 * @property integer $kemahiran_id
 * @property integer $atlet_id
 * @property string $jenis_kemahiran
 * @property string $nama_kemahiran
 */
class AtletPembangunanKemahiran extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_atlet_pembangunan_kemahiran';
    }
    
    public function behaviors()
    {
        return [
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
            [['atlet_id', 'jenis_kemahiran', 'tarikh_mula', 'tarikh_tamat', 'penganjur', 'lokasi'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['atlet_id'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['jenis_kemahiran'], 'string', 'max' => 30, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['nama_kemahiran'], 'string', 'max' => 100, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['jenis_kemahiran','nama_kemahiran'], function ($attribute, $params) {
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
            'kemahiran_id' => GeneralLabel::kemahiran_id,
            'atlet_id' => GeneralLabel::atlet_id,
            'jenis_kemahiran' => GeneralLabel::jenis_kemahiran,
            'nama_kemahiran' => GeneralLabel::nama_kemahiran,
            'tarikh_mula' => GeneralLabel::tarikh_mula,
            'tarikh_tamat' => GeneralLabel::tarikh_tamat,
            'penganjur' => GeneralLabel::penganjur,
            'lokasi' => GeneralLabel::lokasi,

        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefJenisKemahiran(){
        return $this->hasOne(RefJenisKemahiran::className(), ['id' => 'jenis_kemahiran']);
    }
}
