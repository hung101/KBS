<?php

namespace app\models;

use Yii;
use app\models\general\GeneralLabel;

/**
 * This is the model class for table "tbl_laporan_pendedahan_latihan_atlet".
 *
 * @property integer $laporan_pendedahan_latihan_atlet_id
 * @property integer $penyertaan_sukan_id
 * @property integer $atlet_id
 * @property string $session_id
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created
 * @property string $updated
 */
class LaporanPendedahanLatihanAtlet extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_laporan_pendedahan_latihan_atlet';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['penyertaan_sukan_id', 'atlet_id', 'created_by', 'updated_by'], 'integer'],
            [['created', 'updated'], 'safe'],
            [['session_id'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'laporan_pendedahan_latihan_atlet_id' => 'Laporan Pendedahan Latihan Atlet ID',
            'penyertaan_sukan_id' => 'Penyertaan Sukan ID',
            'atlet_id' => GeneralLabel::atlet,
            'session_id' => 'Session ID',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created' => 'Created',
            'updated' => 'Updated',
        ];
    }
}
