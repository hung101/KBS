<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_atlet_kewangan_akaun".
 *
 * @property integer $akaun_id
 * @property integer $atlet_id
 * @property string $nama_bank
 * @property string $cawangan
 * @property string $no_akaun
 * @property string $jenis_akaun
 */
class AtletKewanganAkaun extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_atlet_kewangan_akaun';
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
            [['atlet_id', 'nama_bank', 'no_akaun', 'jenis_akaun'], 'required', 'skipOnEmpty' => true],
            [['atlet_id'], 'integer'],
            [['nama_bank', 'cawangan'], 'string', 'max' => 100],
            [['no_akaun'], 'string', 'max' => 20],
            [['jenis_akaun'], 'string', 'max' => 30]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'akaun_id' => GeneralLabel::akaun_id,
            'atlet_id' => GeneralLabel::atlet_id,
            'nama_bank' => GeneralLabel::nama_bank,
            'cawangan' => GeneralLabel::cawangan,
            'no_akaun' => GeneralLabel::no_akaun,
            'jenis_akaun' => GeneralLabel::jenis_akaun,

        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefBank(){
        return $this->hasOne(RefBank::className(), ['id' => 'nama_bank']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefJenisBankAkaun(){
        return $this->hasOne(RefJenisBankAkaun::className(), ['id' => 'jenis_akaun']);
    }
}
