<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_ref_sub_kategori_penilaian_jurulatih_ketua".
 *
 * @property integer $id
 * @property integer $ref_kategori_penilaian_jurulatih_id
 * @property string $desc
 * @property integer $aktif
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created
 * @property string $updated
 */
class RefSubKategoriPenilaianJurulatihKetua extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_ref_sub_kategori_penilaian_jurulatih_ketua';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ref_kategori_penilaian_jurulatih_id', 'aktif', 'created_by', 'updated_by'], 'integer'],
            [['desc'], 'required'],
            [['created', 'updated'], 'safe'],
            [['desc'], 'string', 'max' => 80],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ref_kategori_penilaian_jurulatih_id' => 'Ref Kategori Penilaian Jurulatih ID',
            'desc' => 'Desc',
            'aktif' => 'Aktif',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created' => 'Created',
            'updated' => 'Updated',
        ];
    }
}
