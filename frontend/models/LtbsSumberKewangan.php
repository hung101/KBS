<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_ltbs_sumber_kewangan".
 *
 * @property integer $sumber_kewangan_id
 * @property string $jenis
 * @property string $sumber
 * @property string $jumlah
 */
class LtbsSumberKewangan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_ltbs_sumber_kewangan';
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
            [['jenis', 'sumber', 'jumlah'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['profil_badan_sukan_id'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['jumlah'], 'number', 'message' => GeneralMessage::yii_validation_number],
            [['jenis'], 'string', 'max' => 30, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['sumber'], 'string', 'max' => 100, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['jenis','sumber'], 'filter', 'filter' => function ($value) {
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
            'sumber_kewangan_id' => GeneralLabel::sumber_kewangan_id,
            'profil_badan_sukan_id' => GeneralLabel::profil_badan_sukan_id,
            'jenis' => GeneralLabel::jenis,
            'sumber' => GeneralLabel::sumber,
            'jumlah' => GeneralLabel::jumlah,

        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefJenisKewangan(){
        return $this->hasOne(RefJenisKewangan::className(), ['id' => 'jenis']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefJenisKewanganSumber(){
        return $this->hasOne(RefJenisKewanganSumber::className(), ['id' => 'sumber']);
    }
}
