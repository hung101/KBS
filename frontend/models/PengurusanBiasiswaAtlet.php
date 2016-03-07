<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_pengurusan_biasiswa_atlet".
 *
 * @property integer $pengurusan_biasiswa_atlet_id
 * @property integer $atlet_id
 * @property string $tarikh_mula
 * @property string $tarikh_akhir
 * @property string $nama_biasiswa_sponsor
 * @property string $jumlah_penajaan
 */
class PengurusanBiasiswaAtlet extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_pengurusan_biasiswa_atlet';
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
            [['atlet_id', 'tarikh_mula', 'tarikh_akhir', 'nama_biasiswa_sponsor', 'jumlah_penajaan'], 'required', 'skipOnEmpty' => true],
            [['atlet_id'], 'integer'],
            [['tarikh_mula', 'tarikh_akhir'], 'safe'],
            [['jumlah_penajaan'], 'number'],
            [['nama_biasiswa_sponsor'], 'string', 'max' => 80]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pengurusan_biasiswa_atlet_id' => 'Pengurusan Biasiswa Atlet ID',
            'atlet_id' => 'Atlet',
            'tarikh_mula' => 'Tarikh Mula',
            'tarikh_akhir' => 'Tarikh Akhir',
            'nama_biasiswa_sponsor' => 'Nama Biasiswa/Sponsor',
            'jumlah_penajaan' => 'Jumlah Penajaan',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefAtlet(){
        return $this->hasOne(Atlet::className(), ['atlet_id' => 'atlet_id']);
    }
}
