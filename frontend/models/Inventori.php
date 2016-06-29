<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_inventori".
 *
 * @property integer $inventori_id
 * @property string $tarikh
 * @property string $program
 * @property string $sukan
 * @property string $no_co
 * @property string $alamat_pembekal_1
 * @property string $alamat_pembekal_2
 * @property string $alamat_pembekal_3
 * @property string $alamat_pembekal_negeri
 * @property string $alamat_pembekal_bandar
 * @property string $alamat_pembekal_poskod
 * @property string $perkara
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created
 * @property string $updated
 */
class Inventori extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_inventori';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tarikh', 'created', 'updated'], 'safe'],
            [['perkara'], 'string'],
            [['created_by', 'updated_by'], 'integer'],
            [['program', 'sukan', 'no_co', 'alamat_pembekal_1', 'alamat_pembekal_2', 'alamat_pembekal_3'], 'string', 'max' => 30],
            [['alamat_pembekal_negeri'], 'string', 'max' => 3],
            [['alamat_pembekal_bandar', 'alamat_pembekal_poskod'], 'string', 'max' => 5],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'inventori_id' => 'Inventori ID',
            'tarikh' => 'Tarikh',
            'program' => 'Program',
            'sukan' => 'Sukan',
            'no_co' => 'No. C/O',
            'alamat_pembekal_1' => 'Alamat Pembekal',
            'alamat_pembekal_2' => '',
            'alamat_pembekal_3' => '',
            'alamat_pembekal_negeri' => 'Negeri',
            'alamat_pembekal_bandar' => 'Bandar',
            'alamat_pembekal_poskod' => 'Poskod',
            'perkara' => 'Perkara',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created' => 'Created',
            'updated' => 'Updated',
        ];
    }
}