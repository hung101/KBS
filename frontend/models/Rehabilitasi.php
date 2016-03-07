<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_rehabilitasi".
 *
 * @property integer $rehabilitasi_id
 * @property integer $pl_diagnosis_preskripsi_pemeriksaan_id
 * @property string $tarikh
 * @property string $kesan_klinikal
 * @property string $masalah_yang_dikenal_pasti
 * @property string $potensi_rehabilitasi
 * @property string $matlamat_rehabilitasi
 */
class Rehabilitasi extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_rehabilitasi';
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
            [['pl_diagnosis_preskripsi_pemeriksaan_id', 'tarikh', 'masalah_yang_dikenal_pasti', 'matlamat_rehabilitasi'], 'required', 'skipOnEmpty' => true],
            [['pl_diagnosis_preskripsi_pemeriksaan_id'], 'integer'],
            [['tarikh'], 'safe'],
            [['kesan_klinikal', 'masalah_yang_dikenal_pasti', 'potensi_rehabilitasi', 'matlamat_rehabilitasi'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'rehabilitasi_id' => 'Rehabilitasi ID',
            'pl_diagnosis_preskripsi_pemeriksaan_id' => 'Pl Diagnosis Preskripsi Pemeriksaan ID',
            'tarikh' => 'Tarikh',
            'kesan_klinikal' => 'Kesan Klinikal',
            'masalah_yang_dikenal_pasti' => 'Masalah Yang Dikenal Pasti',
            'potensi_rehabilitasi' => 'Potensi Rehabilitasi',
            'matlamat_rehabilitasi' => 'Matlamat Rehabilitasi',
        ];
    }
}
