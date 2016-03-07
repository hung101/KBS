<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_bsp_pembayaran".
 *
 * @property integer $bsp_pembayaran_id
 * @property integer $bsp_pemohon_id
 * @property string $tarikh
 * @property string $bayaran
 */
class BspPembayaran extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_bsp_pembayaran';
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
            [['bsp_pemohon_id', 'tarikh', 'bayaran','semester'], 'required', 'skipOnEmpty' => true],
            [['bsp_pemohon_id'], 'integer'],
            [['tarikh'], 'safe'],
            [['bayaran'], 'number'],
            [['catatan'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'bsp_pembayaran_id' => 'Bsp Pembayaran ID',
            'bsp_pemohon_id' => 'Pemohon',
            'tarikh' => 'Tarikh',
            'bayaran' => 'Yuran',
            'semester' => 'Semester',
            'catatan' => 'Catatan',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefPemohonEBiasiswa(){
        return $this->hasOne(RefPemohonEBiasiswa::className(), ['id' => 'bsp_pemohon_id']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefSemesterTerkini(){
        return $this->hasOne(RefSemesterTerkini::className(), ['id' => 'semester']);
    }
}
