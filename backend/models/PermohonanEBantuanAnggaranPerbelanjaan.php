<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_permohonan_e_bantuan_anggaran_perbelanjaan".
 *
 * @property integer $anggaran_perbelanjaan_id
 * @property integer $permohonan_e_bantuan_id
 * @property string $butir_butir_perbelanjaan
 * @property string $jumlah_perbelanjaan
 */
class PermohonanEBantuanAnggaranPerbelanjaan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_permohonan_e_bantuan_anggaran_perbelanjaan';
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
            [['butir_butir_perbelanjaan', 'jumlah_perbelanjaan'], 'required', 'skipOnEmpty' => true],
            [['permohonan_e_bantuan_id'], 'integer'],
            [['jumlah_perbelanjaan', 'jumlah_disokong', 'jumlah_diperakuankan'], 'number'],
            [['butir_butir_perbelanjaan'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'anggaran_perbelanjaan_id' => 'Anggaran Perbelanjaan ID',
            'permohonan_e_bantuan_id' => 'Permohonan E Bantuan ID',
            'butir_butir_perbelanjaan' => 'Butir-butir Perbelanjaan',
            'jumlah_perbelanjaan' => 'Jumlah Perbelanjaan (RM)',
            'jumlah_disokong' => 'Disokong (RM)',
            'jumlah_diperakuankan' => 'Diperakukan (RM)',
        ];
    }
}
