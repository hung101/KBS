<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_profil_konsultan".
 *
 * @property integer $profil_konsultan_id
 * @property string $nama_konsultan
 * @property string $ic_no
 * @property string $emel
 * @property string $no_bimbit
 * @property string $bidang_konsultansi
 */
class ProfilKonsultan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_profil_konsultan';
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
            [['nama_konsultan', 'ic_no', 'no_bimbit'], 'required', 'skipOnEmpty' => true],
            [['nama_konsultan', 'bidang_konsultansi'], 'string', 'max' => 80],
            [['ic_no'], 'string', 'max' => 12],
            [['emel'], 'string', 'max' => 100],
            [['kepakaran_pengalaman'], 'string', 'max' => 255],
            [['no_bimbit'], 'string', 'max' => 14]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'profil_konsultan_id' => 'Profil Konsultan ID',
            'nama_konsultan' => 'Nama',
            'ic_no' => 'No Kad Pengenalan',
            'emel' => 'Emel',
            'no_bimbit' => 'No Tel Bimbit',
            'bidang_konsultansi' => 'Bidang Konsultansi',
            'kepakaran_pengalaman' => 'Kepakaran/Pengalaman',
        ];
    }
}
