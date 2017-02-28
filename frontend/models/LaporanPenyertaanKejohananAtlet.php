<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;

/**
 * This is the model class for table "tbl_laporan_penyertaan_kejohanan_atlet".
 *
 * @property integer $laporan_penyertaan_kejohanan_atlet_id
 * @property integer $penyertaan_sukan_id
 * @property integer $atlet_id
 * @property string $session_id
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created
 * @property string $updated
 */
class LaporanPenyertaanKejohananAtlet extends \yii\db\ActiveRecord
{
    public $jantina;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_laporan_penyertaan_kejohanan_atlet';
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
            'laporan_penyertaan_kejohanan_atlet_id' => 'Laporan Penyertaan Kejohanan Atlet ID',
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
