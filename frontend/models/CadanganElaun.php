<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_cadangan_elaun".
 *
 * @property integer $cadangan_elaun_id
 * @property integer $atlet
 * @property string $elaun_semasa
 * @property string $elaun_cadangan
 * @property string $tarikh_mula
 * @property string $tarikh_tamat
 * @property string $ulasan
 * @property string $jenis_kelulusan
 * @property string $muat_naik
 */
class CadanganElaun extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_cadangan_elaun';
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
            [['atlet', 'elaun_semasa', 'elaun_cadangan', 'tarikh_mula', 'tarikh_tamat', 'jenis_kelulusan'], 'required', 'skipOnEmpty' => true],
            [['atlet'], 'integer'],
            [['elaun_semasa', 'elaun_cadangan'], 'number'],
            [['tarikh_mula', 'tarikh_tamat'], 'safe'],
            [['ulasan'], 'string', 'max' => 255],
            [['jenis_kelulusan'], 'string', 'max' => 30],
            [['muat_naik'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'cadangan_elaun_id' => 'Cadangan Elaun ID',
            'atlet' => 'Atlet',
            'elaun_semasa' => 'Elaun Semasa',
            'elaun_cadangan' => 'Elaun Cadangan',
            'tarikh_mula' => 'Tarikh Mula',
            'tarikh_tamat' => 'Tarikh Tamat',
            'ulasan' => 'Ulasan',
            'jenis_kelulusan' => 'Jenis Kelulusan',
            'muat_naik' => 'Muat Naik',
        ];
    }
}
