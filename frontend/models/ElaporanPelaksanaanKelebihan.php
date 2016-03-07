<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_elaporan_pelaksanaan_kelebihan".
 *
 * @property integer $elaporan_pelaksanaan_kelebihan_id
 * @property integer $elaporan_pelaksaan_id
 * @property string $kelebihan
 * @property string $session_id
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created
 * @property string $updated
 */
class ElaporanPelaksanaanKelebihan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName() 
    {
        return 'tbl_elaporan_pelaksanaan_kelebihan';
    }

    public function behaviors()
    {
        return [
            'bedezign\yii2\audit\AuditTrailBehavior',
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['kelebihan'], 'required', 'skipOnEmpty' => true],
            [['elaporan_pelaksaan_id', 'created_by', 'updated_by'], 'integer'],
            [['created', 'updated'], 'safe'],
            [['kelebihan'], 'string', 'max' => 255],
            [['session_id'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'elaporan_pelaksanaan_kelebihan_id' => 'Elaporan Pelaksanaan Kelebihan ID',
            'elaporan_pelaksaan_id' => 'Elaporan Pelaksaan ID',
            'kelebihan' => 'Kelebihan',
            'session_id' => 'Session ID',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created' => 'Created',
            'updated' => 'Updated',
        ];
    }
}
