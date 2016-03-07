<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_pembayaran_elaun".
 *
 * @property integer $pembayaran_elaun_id
 * @property string $jenis_atlet
 * @property integer $atlet_id
 * @property string $kategori_elaun
 * @property string $tempoh_elaun
 * @property string $sebab_elaun
 * @property string $jumlah_elaun
 * @property integer $kelulusan
 */
class PembayaranElaun extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_pembayaran_elaun';
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
            [[ 'atlet_id', 'kategori_elaun', 'tempoh_elaun', 'tarikh_mula', 'tarikh_tamat', 'jumlah_elaun', 'status_elaun', 'kelulusan'], 'required', 'skipOnEmpty' => true],
            [['atlet_id', 'kelulusan'], 'integer'],
            [['jumlah_elaun'], 'number'],
            [['kategori_elaun'], 'string', 'max' => 30],
            [['jumlah_elaun'], 'string', 'max' => 10],
            [['tempoh_elaun'], 'string', 'max' => 20],
            [['sebab_elaun'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pembayaran_elaun_id' => 'Pembayaran Elaun ID',
            //'jenis_atlet' => 'Jenis Atlet',
            'atlet_id' => 'Atlet',
            'kategori_elaun' => 'Kategori Elaun',
            'tarikh_mula' => 'Tarikh Mula',
            'tarikh_tamat' => 'Tarikh Tamat',
            'tempoh_elaun' => 'Tempoh Elaun',
            'sebab_elaun' => 'Catatan',
            'status_elaun' => 'Status Elaun',
            'jumlah_elaun' => 'Jumlah Elaun',
            'kelulusan' => 'Kelulusan',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKategoriElaun(){
        return $this->hasOne(RefKategoriElaun::className(), ['id' => 'kategori_elaun']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAtlet(){
        return $this->hasOne(Atlet::className(), ['atlet_id' => 'atlet_id']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStatusElaun(){
        return $this->hasOne(RefStatusElaun::className(), ['id' => 'status_elaun']);
    }
}
