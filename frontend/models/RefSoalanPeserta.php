<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_ref_soalan_peserta".
 *
 * @property integer $id
 * @property integer $ref_kategori_soalan_peserta_id
 * @property string $desc
 * @property integer $aktif
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created
 * @property string $updated
 */
class RefSoalanPeserta extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_ref_soalan_peserta';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ref_kategori_soalan_peserta_id', 'aktif', 'created_by', 'updated_by'], 'integer'],
            [['desc'], 'required'],
            [['created', 'updated'], 'safe'],
            [['desc'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ref_kategori_soalan_peserta_id' => 'Ref Kategori Soalan Peserta ID',
            'desc' => 'Desc',
            'aktif' => 'Aktif',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created' => 'Created',
            'updated' => 'Updated',
        ];
    }
}
