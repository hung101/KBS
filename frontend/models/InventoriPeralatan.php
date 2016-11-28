<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;

/**
 * This is the model class for table "tbl_inventori_peralatan".
 *
 * @property integer $inventori_peralatan_id
 * @property integer $inventori_id
 * @property string $nama_peralatan
 * @property string $no_inv_do
 * @property integer $kuantiti
 * @property string $harga_per_unit
 * @property string $jumlah
 * @property string $session_id
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created
 * @property string $updated
 */
class InventoriPeralatan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_inventori_peralatan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['inventori_id', 'kuantiti', 'created_by', 'updated_by'], 'integer'],
            [['nama_peralatan', 'kuantiti'], 'required'],
            [['harga_per_unit', 'jumlah'], 'number'],
            [['created', 'updated'], 'safe'],
            [['nama_peralatan'], 'string', 'max' => 80],
            [['no_inv_do'], 'string', 'max' => 30],
            [['session_id'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'inventori_peralatan_id' => 'Inventori Peralatan ID',
            'inventori_id' => 'Inventori ID',
            'nama_peralatan' => GeneralLabel::nama_peralatan,
            'no_inv_do' => GeneralLabel::no_inv_do,
            'kuantiti' => GeneralLabel::kuantiti,
            'harga_per_unit' => GeneralLabel::harga_per_unit,
            'jumlah' => GeneralLabel::jumlah,
            'session_id' => 'Session ID',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created' => 'Created',
            'updated' => 'Updated',
        ];
    }
}
