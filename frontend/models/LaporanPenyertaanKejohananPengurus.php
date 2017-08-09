<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;

/**
 * This is the model class for table "tbl_laporan_penyertaan_kejohanan_pengurus".
 *
 * @property integer $laporan_penyertaan_kejohanan_pengurus_id
 * @property integer $penyertaan_sukan_id
 * @property string $nama
 * @property string $session_id
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created
 * @property string $updated
 */
class LaporanPenyertaanKejohananPengurus extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_laporan_penyertaan_kejohanan_pengurus';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['penyertaan_sukan_id', 'created_by', 'updated_by'], 'integer'],
            [['created', 'updated'], 'safe'],
            [['nama'], 'string', 'max' => 255],
            [['session_id'], 'string', 'max' => 100],
            [['nama'], 'filter', 'filter' => function ($value) {
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
            'laporan_penyertaan_kejohanan_pengurus_id' => 'Laporan Penyertaan Kejohanan Pegawai ID',
            'penyertaan_sukan_id' => 'Penyertaan Sukan ID',
            'nama' => GeneralLabel::nama,
            'session_id' => 'Session ID',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created' => 'Created',
            'updated' => 'Updated',
        ];
    }
}
