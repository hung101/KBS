<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_ref_kategori_e_laporan".
 *
 * @property integer $id
 * @property string $desc
 * @property integer $show_public
 * @property integer $aktif
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created
 * @property string $updated
 */
class RefKategoriELaporan extends \yii\db\ActiveRecord
{
    const KATEGORI_NGO = 3;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_ref_kategori_e_laporan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['desc'], 'required'],
            [['show_public', 'aktif', 'created_by', 'updated_by'], 'integer'],
            [['created', 'updated'], 'safe'],
            [['desc'], 'string', 'max' => 80]
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
            'show_public' => 'Show Public',
            'aktif' => 'Aktif',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created' => 'Created',
            'updated' => 'Updated',
        ];
    }
}
