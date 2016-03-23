<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;

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
            [['jenis', 'sumber', 'jumlah'], 'required', 'skipOnEmpty' => true],
            [['profil_badan_sukan_id'], 'integer'],
            [['jumlah'], 'number'],
            [['jenis'], 'string', 'max' => 30],
            [['sumber'], 'string', 'max' => 100]
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
