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
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['atlet_id', 'jenis_elaun', 'jumlah_elaun', 'tarikh_mula', 'tarikh_tamat'], 'required', 'skipOnEmpty' => true],
            [['atlet_id'], 'integer'],
            [['jumlah_elaun'], 'number'],
            [['tarikh_mula', 'tarikh_tamat'], 'safe']
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
            'jumlah_elaun' => GeneralLabel::jumlah_elaun,
            'tarikh_mula' => GeneralLabel::tarikh_mula,
            'tarikh_tamat' => GeneralLabel::tarikh_tamat,

        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefJenisElaun(){
        return $this->hasOne(RefJenisElaun::className(), ['id' => 'jenis_elaun']);
    }
}
