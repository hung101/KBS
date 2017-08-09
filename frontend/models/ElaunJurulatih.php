<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_elaun_jurulatih".
 *
 * @property integer $elaun_jurulatih_id
 * @property integer $gaji_dan_elaun_jurulatih_id
 * @property string $jenis_elaun
 * @property string $jumlah_elaun
 */
class ElaunJurulatih extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_elaun_jurulatih';
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
            [['jenis_elaun', 'jumlah_elaun'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['elaun_jurulatih_id', 'gaji_dan_elaun_jurulatih_id'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['jumlah_elaun'], 'number', 'message' => GeneralMessage::yii_validation_number],
            [['jenis_elaun'], 'string', 'max' => 80, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['tarikh_mula', 'tarikh_tamat'], 'safe'],
            [['jenis_elaun'], 'filter', 'filter' => function ($value) {
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
            'elaun_jurulatih_id' => GeneralLabel::elaun_jurulatih_id,
            'gaji_dan_elaun_jurulatih_id' => GeneralLabel::gaji_dan_elaun_jurulatih_id,
            'jenis_elaun' => GeneralLabel::jenis_elaun,
            'jumlah_elaun' => GeneralLabel::jumlah_elaun,
            'tarikh_mula' => GeneralLabel::tarikh_mula,
            'tarikh_tamat' => GeneralLabel::tarikh_tamat,
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefJenisElaunJurulatih(){
        return $this->hasOne(RefJenisElaunJurulatih::className(), ['id' => 'jenis_elaun']);
    }
}
