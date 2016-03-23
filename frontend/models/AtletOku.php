<?php

namespace app\models;

use Yii;

use app\models\general\GeneralVariable;

use app\models\general\GeneralLabel;

/**
 * This is the model class for table "tbl_atlet_oku".
 *
 * @property integer $oku_id
 * @property integer $atlet_id
 * @property integer $jenis_kurang_upaya
 * @property string $jenis_kurang_upaya_pendengaran
 */
class AtletOku extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_atlet_oku';
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
            [['atlet_id', 'jenis_kurang_upaya', 'negara', 'tahun', 'status'], 'required', 'skipOnEmpty' => true],
            [['jenis_kurang_upaya', 'jenis_kurang_upaya_pendengaran'], 'string', 'max' => 50],
            [['tahun'], 'integer', 'min' => GeneralVariable::yearMin, 'max' => GeneralVariable::yearMax]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'oku_id' => GeneralLabel::oku_id,
            'atlet_id' => GeneralLabel::atlet_id,
            'jenis_kurang_upaya' => GeneralLabel::jenis_kurang_upaya,
            'jenis_kurang_upaya_pendengaran' => GeneralLabel::jenis_kurang_upaya_pendengaran,
            'negara' => GeneralLabel::negara,
            'tahun' => GeneralLabel::tahun,
            'status' => GeneralLabel::status,

        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefJenisKurangUpaya(){
        return $this->hasOne(RefJenisKurangUpaya::className(), ['id' => 'jenis_kurang_upaya']);
    }
}
