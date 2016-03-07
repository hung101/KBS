<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_atlet_kewangan_insentif".
 *
 * @property integer $insentif_id
 * @property integer $atlet_id
 * @property string $tarikh_mula
 * @property string $jenis_insentif
 * @property string $jumlah
 * @property string $kejohanan
 * @property string $pencapaian
 */
class AtletKewanganInsentif extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_atlet_kewangan_insentif';
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
            [['atlet_id', 'tarikh_mula', 'tarikh_tamat', 'jenis_insentif', 'jumlah', 'kejohanan', 'pencapaian'], 'required', 'skipOnEmpty' => true],
            [['atlet_id'], 'integer'],
            [['tarikh_mula', 'rekods'], 'safe'],
            [['jumlah'], 'number'],
            [['jenis_insentif', 'pencapaian'], 'string', 'max' => 30],
            [['kejohanan'], 'string', 'max' => 60]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'insentif_id' => 'Insentif ID',
            'atlet_id' => 'Atlet ID',
            'tarikh_mula' => 'Tarikh Mula',
            'tarikh_tamat' => 'Tarikh Tamat',
            'jenis_insentif' => 'Jenis Insentif',
            'jumlah' => 'Jumlah',
            'kejohanan' => 'Kejohanan',
            'pencapaian' => 'Pencapaian',
            'rekods' => 'Rekod',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefJenisInsentif(){
        return $this->hasOne(RefJenisInsentif::className(), ['id' => 'jenis_insentif']);
    }
}
