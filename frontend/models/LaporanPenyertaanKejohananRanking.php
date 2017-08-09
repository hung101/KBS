<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_laporan_penyertaan_kejohanan_ranking".
 *
 * @property integer $laporan_penyertaan_kejohanan_ranking_id
 * @property integer $penyertaan_sukan_id
 * @property string $ranking
 * @property string $negara
 * @property integer $emas
 * @property integer $perak
 * @property integer $gangsa
 * @property string $session_id
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created
 * @property string $updated
 */
class LaporanPenyertaanKejohananRanking extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_laporan_penyertaan_kejohanan_ranking';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['penyertaan_sukan_id'], 'required'],
            [['penyertaan_sukan_id', 'ranking', 'emas', 'perak', 'gangsa', 'created_by', 'updated_by'], 'integer'],
            [['created', 'updated'], 'safe'],
            [['negara'], 'string', 'max' => 255],
            [['session_id'], 'string', 'max' => 100],
            [['negara'], 'filter', 'filter' => function ($value) {
                return  \common\models\general\GeneralFunction::filterXSS($value);
            }],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'laporan_penyertaan_kejohanan_ranking_id' => 'Laporan Penyertaan Kejohanan Ranking ID',
            'penyertaan_sukan_id' => 'Penyertaan Sukan ID',
            'negara' => 'Negara',
            'emas' => 'Emas',
            'perak' => 'Perak',
            'gangsa' => 'Gangsa',
            'session_id' => 'Session ID',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created' => 'Created',
            'updated' => 'Updated',
        ];
    }
}
