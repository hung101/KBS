<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_elaporan_dokumen_sokongan".
 *
 * @property integer $elaporan_dokumen_sokongan_id
 * @property integer $elaporan_pelaksaan_id
 * @property string $nama
 * @property string $muat_nail
 */
class ElaporanDokumenSokongan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_elaporan_dokumen_sokongan';
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
            [['elaporan_pelaksaan_id', 'nama', 'muat_nail'], 'required', 'skipOnEmpty' => true],
            [['elaporan_pelaksaan_id'], 'integer'],
            [['nama'], 'string', 'max' => 80],
            [['muat_nail'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'elaporan_dokumen_sokongan_id' => 'Elaporan Dokumen Sokongan ID',
            'elaporan_pelaksaan_id' => 'Elaporan Pelaksaan ID',
            'nama' => 'Nama Dokumen',
            'muat_nail' => 'Muat Naik',
        ];
    }
}
