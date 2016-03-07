<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_permohonan_e_bantuan_cadangan_kertas_kerja".
 *
 * @property integer $permohonan_e_bantuan_cadangan_kertas_kerja_id
 * @property integer $permohonan_e_bantuan_id
 * @property string $nama_cadangan_kertas_kerja
 * @property string $muat_naik
 */
class PermohonanEBantuanCadanganKertasKerja extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_permohonan_e_bantuan_cadangan_kertas_kerja';
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
            [['permohonan_e_bantuan_id', 'nama_cadangan_kertas_kerja', 'muat_naik'], 'required', 'skipOnEmpty' => true],
            [['permohonan_e_bantuan_id'], 'integer'],
            [['nama_cadangan_kertas_kerja'], 'string', 'max' => 80],
            [['muat_naik'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'permohonan_e_bantuan_cadangan_kertas_kerja_id' => 'Permohonan E Bantuan Cadangan Kertas Kerja ID',
            'permohonan_e_bantuan_id' => 'Permohonan E Bantuan ID',
            'nama_cadangan_kertas_kerja' => 'Nama Cadangan Kertas Kerja',
            'muat_naik' => 'Muat Naik',
        ];
    }
}
