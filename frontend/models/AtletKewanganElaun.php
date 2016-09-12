<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_atlet_kewangan_elaun".
 *
 * @property integer $elaun_id
 * @property integer $atlet_id
 * @property string $jumlah_elaun
 * @property string $tarikh
 */
class AtletKewanganElaun extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_atlet_kewangan_elaun';
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
            /*'encryption' => [
                'class' => '\nickcv\encrypter\behaviors\EncryptionBehavior',
                'attributes' => [
                    'jumlah_elaun',
                ],
            ],*/
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['atlet_id', 'jenis_elaun', 'jumlah_elaun', 'tarikh_mula', 'tarikh_tamat'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['atlet_id'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['jumlah_elaun'], 'number', 'message' => GeneralMessage::yii_validation_number],
            [['elaun_diterima', 'kelulusan'], 'string', 'max' => 80, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['tarikh_mula', 'tarikh_tamat', 'tarikh_kredit', 'tarikh_kelulusan', 'tarikh_jkb'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'elaun_id' => GeneralLabel::elaun_id,
            'atlet_id' => GeneralLabel::atlet_id,
            'jenis_elaun' => GeneralLabel::jenis_elaun,
            'jumlah_elaun' => GeneralLabel::jumlah,
            'tarikh_mula' => GeneralLabel::tarikh_mula,
            'tarikh_tamat' => GeneralLabel::tarikh_tamat,
            'elaun_diterima' => GeneralLabel::elaun_diterima,
            'kelulusan' => GeneralLabel::bilangan_jkb,
            'tarikh_kredit' => GeneralLabel::tarikh_kredit,
            'tarikh_kelulusan' => GeneralLabel::tarikh_kelulusan,
            'tarikh_jkb' => GeneralLabel::tarikh_jkb,

        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefJenisElaun(){
        return $this->hasOne(RefJenisElaun::className(), ['id' => 'jenis_elaun']);
    }
}
