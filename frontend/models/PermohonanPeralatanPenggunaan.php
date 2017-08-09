<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;

/**
 * This is the model class for table "tbl_permohonan_peralatan_penggunaan".
 *
 * @property integer $permohonan_peralatan_penggunaan_id
 * @property integer $permohonan_peralatan_id
 * @property string $nama_peralatan
 * @property string $harga_per_unit
 * @property integer $jumlah_unit
 * @property integer $bilangan
 * @property string $jumlah
 * @property string $session_id
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created
 * @property string $updated
 */
class PermohonanPeralatanPenggunaan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_permohonan_peralatan_penggunaan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['permohonan_peralatan_id', 'jumlah_unit', 'bilangan', 'created_by', 'updated_by'], 'integer'],
            [['nama_peralatan', 'harga_per_unit', 'jumlah_unit', 'bilangan', 'jumlah'], 'required'],
            [['harga_per_unit', 'jumlah'], 'number'],
            [['created', 'updated'], 'safe'],
            [['nama_peralatan'], 'string', 'max' => 80],
            [['session_id'], 'string', 'max' => 100],
            [['nama_peralatan'], 'filter', 'filter' => function ($value) {
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
            'permohonan_peralatan_penggunaan_id' => 'Permohonan Peralatan Penggunaan ID',
            'permohonan_peralatan_id' => 'Permohonan Peralatan ID',
            'nama_peralatan' => 'Nama Peralatan',
            'harga_per_unit' => 'Harga (per unit) (RM)',
            'jumlah_unit' => GeneralLabel::jumlah_unit,
            'bilangan' => 'Bilangan',
            'jumlah' => 'Jumlah (RM)',
            'session_id' => 'Session ID',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created' => 'Created',
            'updated' => 'Updated',
        ];
    }
}
