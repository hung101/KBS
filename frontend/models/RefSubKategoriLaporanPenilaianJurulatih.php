<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_ref_sub_kategori_laporan_penilaian_jurulatih".
 *
 * @property integer $id
 * @property integer $ref_kategori_laporan_penilaian_jurulatih_id
 * @property string $desc
 * @property integer $aktif
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created
 * @property string $updated
 */
class RefSubKategoriLaporanPenilaianJurulatih extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_ref_sub_kategori_laporan_penilaian_jurulatih';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ref_kategori_laporan_penilaian_jurulatih_id', 'aktif', 'created_by', 'updated_by'], 'integer'],
            [['desc'], 'required'],
            [['desc'], 'string'],
            [['created', 'updated'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ref_kategori_laporan_penilaian_jurulatih_id' => 'Ref Kategori Laporan Penilaian Jurulatih ID',
            'desc' => 'Desc',
            'aktif' => 'Aktif',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created' => 'Created',
            'updated' => 'Updated',
        ];
    }
}
