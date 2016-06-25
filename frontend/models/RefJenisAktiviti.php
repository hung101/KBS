<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_ref_jenis_aktiviti".
 *
 * @property integer $id
 * @property string $desc
 * @property string $peringkat
 * @property integer $aktif
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created
 * @property string $updated
 */
class RefJenisAktiviti extends \yii\db\ActiveRecord
{
    const KEJOHANAN_DALAM_NEGARA = 1;
    const KEJOHANAN_LUAR_NEGARA = 2;
    const PENDEDAHAN_LATIHAN_DALAM_NEGARA = 3;
    const PENDEDAHAN_LATIHAN_LUAR_NEGARA = 4;
    const PROGRAM_BINAAN = 5;
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_ref_jenis_aktiviti';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['desc'], 'required'],
            [['aktif', 'created_by', 'updated_by'], 'integer'],
            [['created', 'updated'], 'safe'],
            [['desc', 'peringkat'], 'string', 'max' => 80],
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
            'peringkat' => 'Peringkat',
            'aktif' => 'Aktif',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created' => 'Created',
            'updated' => 'Updated',
        ];
    }
}
