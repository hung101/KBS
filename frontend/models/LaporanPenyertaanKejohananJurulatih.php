<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;

/**
 * This is the model class for table "tbl_laporan_penyertaan_kejohanan_jurulatih".
 *
 * @property integer $laporan_penyertaan_kejohanan_jurulatih_id
 * @property integer $penyertaan_sukan_id
 * @property string $nama
 * @property string $session_id
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created
 * @property string $updated
 */
class LaporanPenyertaanKejohananJurulatih extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_laporan_penyertaan_kejohanan_jurulatih';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['penyertaan_sukan_id', 'jurulatih_id', 'created_by', 'updated_by'], 'integer'],
            [['created', 'updated'], 'safe'],
            //[['nama'], 'string', 'max' => 255],
            [['session_id'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'laporan_penyertaan_kejohanan_jurulatih_id' => 'Laporan Penyertaan Kejohanan Jurulatih ID',
            'penyertaan_sukan_id' => 'Penyertaan Sukan ID',
            'jurulatih_id' => GeneralLabel::jurulatih,
            'session_id' => 'Session ID',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created' => 'Created',
            'updated' => 'Updated',
        ];
    }
}
