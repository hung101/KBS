<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_atlet_kewangan_insentif".
 *
 * @property integer $insentif_id
 * @property integer $atlet_id
 * @property string $tarikh_mula
 * @property string $jenis_insentif
 * @property string $jumlah
 * @property string $kejohanan
 * @property string $pencapaian
 */
class AtletKewanganInsentif extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_atlet_kewangan_insentif';
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
            'encryption' => [
                'class' => '\nickcv\encrypter\behaviors\EncryptionBehavior',
                'attributes' => [
                    'jumlah',
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['atlet_id', 'tarikh_mula', 'jenis_insentif', 'jumlah', 'pencapaian'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['atlet_id'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['tarikh_mula', 'rekods'], 'safe'],
            [['jumlah'], 'number', 'message' => GeneralMessage::yii_validation_number],
            [['jenis_insentif', 'pencapaian'], 'string', 'max' => 30, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['kejohanan'], 'string', 'max' => 60, 'tooLong' => GeneralMessage::yii_validation_string_max]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'insentif_id' => GeneralLabel::insentif_id,
            'atlet_id' => GeneralLabel::atlet_id,
            'tarikh_mula' => GeneralLabel::tarikh_mula,
            'tarikh_tamat' => GeneralLabel::tarikh_tamat,
            'jenis_insentif' => GeneralLabel::jenis_insentif,
            'jumlah' => GeneralLabel::jumlah,
            'kejohanan' => GeneralLabel::kejohanan,
            'pencapaian' => GeneralLabel::pencapaian,
            'rekods' => GeneralLabel::rekods,

        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefJenisInsentif(){
        return $this->hasOne(RefJenisInsentif::className(), ['id' => 'jenis_insentif']);
    }
}
