<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_ref_kategori_laporan_penilaian_jurulatih".
 *
 * @property integer $id
 * @property string $desc
 * @property integer $aktif
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created
 * @property string $updated
 */
class RefKategoriLaporanPenilaianJurulatih extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_ref_kategori_laporan_penilaian_jurulatih';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['desc'], 'required'],
            [['desc'], 'string'],
            [['aktif', 'created_by', 'updated_by'], 'integer'],
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
            'desc' => 'Desc',
            'aktif' => 'Aktif',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created' => 'Created',
            'updated' => 'Updated',
        ];
    }
}
