<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_kelayakan_akademi_akk".
 *
 * @property integer $kelayakan_akademi_akk_id
 * @property integer $akademi_akk_id
 * @property string $nama_peperiksaan
 * @property string $tahun
 * @property string $keputusan
 */
class KelayakanAkademiAkk extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_kelayakan_akademi_akk';
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
            [['nama_peperiksaan', 'tahun', 'keputusan'], 'required', 'skipOnEmpty' => true],
            [['akademi_akk_id'], 'integer'],
            [['tahun'], 'safe'],
            [['nama_peperiksaan', 'keputusan'], 'string', 'max' => 80]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'kelayakan_akademi_akk_id' => 'Kelayakan Akademi Akk ID',
            'akademi_akk_id' => 'Akademi Akk ID',
            'nama_peperiksaan' => 'Nama Peperiksaan',
            'tahun' => 'Tahun',
            'keputusan' => 'Keputusan',
        ];
    }
}
