<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_bsp_perlanjutan".
 *
 * @property integer $bsp_perlanjutan_id
 * @property integer $bsp_pemohon_id
 * @property string $tarikh
 * @property string $tempoh_mohon_perlanjutan
 * @property string $permohonan_pelanjutan
 */
class BspPerlanjutan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_bsp_perlanjutan';
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
            [['tarikh', 'tempoh_mohon_perlanjutan', 'permohonan_pelanjutan'], 'required', 'skipOnEmpty' => true],
            [['bsp_pemohon_id'], 'integer'],
            [['tarikh'], 'safe'],
            [['tempoh_mohon_perlanjutan', 'permohonan_pelanjutan'], 'string', 'max' => 30]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'bsp_perlanjutan_id' => 'Bsp Pelanjutan ID',
            'bsp_pemohon_id' => 'Bsp Pemohon ID',
            'tarikh' => 'Tarikh',
            'tempoh_mohon_perlanjutan' => 'Tempoh Mohon Pelanjutan',
            'permohonan_pelanjutan' => 'Permohonan Pelanjutan',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefPermohonanPelanjutan(){
        return $this->hasOne(RefPermohonanPelanjutan::className(), ['id' => 'permohonan_pelanjutan']);
    }
}
