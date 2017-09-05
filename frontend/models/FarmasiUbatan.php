<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_farmasi_ubatan".
 *
 * @property integer $farmasi_ubatan_id
 * @property integer $farmasi_permohonan_ubatan_id
 * @property string $nama_ubat
 * @property string $size
 * @property integer $kuantiti
 * @property string $harga
 */
class FarmasiUbatan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_farmasi_ubatan';
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
            //[['farmasi_permohonan_ubatan_id', 'nama_ubat', 'kuantiti', 'harga'], 'required', 'skipOnEmpty' => true],
            [['farmasi_permohonan_ubatan_id', 'kuantiti'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['harga'], 'number', 'message' => GeneralMessage::yii_validation_number],
            [['nama_ubat'], 'string', 'max' => 80, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['size'], 'string', 'max' => 30, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['nama_ubat','size'], function ($attribute, $params) {
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
            'farmasi_ubatan_id' => GeneralLabel::farmasi_ubatan_id,
            'farmasi_permohonan_ubatan_id' => GeneralLabel::farmasi_permohonan_ubatan_id,
            'nama_ubat' => GeneralLabel::nama_ubat,
            'size' => GeneralLabel::dosage_mg_ml,
            'kuantiti' => GeneralLabel::kuantiti,
            'harga' => GeneralLabel::harga,

        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefUbat(){
        return $this->hasOne(RefUbat::className(), ['id' => 'nama_ubat']);
    }
}
