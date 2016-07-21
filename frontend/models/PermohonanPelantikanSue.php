<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_permohonan_pelantikan_sue".
 *
 * @property integer $permohonan_pelantikan_sue_id
 * @property string $nama_sue
 * @property string $no_kad_pengenalan
 * @property string $emel
 * @property string $jumlah_dipohon
 * @property integer $nama_persatuan
 * @property string $tarikh_mula_khidmat
 * @property string $sehingga
 * @property string $muatnaik
 * @property integer $status_permohonan
 * @property string $catatan
 * @property string $tarikh_dipohon
 * @property string $jumlah_diluluskan
 * @property string $tarikh_kelulusan_jkb
 * @property string $bilangan_jkb
 * @property string $tarikh_lantikan
 * @property string $tarikh_tamat_lantikan
 * @property string $tempoh
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created
 * @property string $updated
 */
class PermohonanPelantikanSue extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_permohonan_pelantikan_sue';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nama_sue', 'no_kad_pengenalan', 'emel', 'jumlah_dipohon', 'nama_persatuan', 'tarikh_mula_khidmat', 'sehingga'], 'required'],
            [['nama_persatuan', 'status_permohonan', 'created_by', 'updated_by'], 'integer'],
            [['tarikh_mula_khidmat', 'sehingga', 'tarikh_dipohon', 'tarikh_kelulusan_jkb', 'tarikh_lantikan', 'tarikh_tamat_lantikan', 'created', 'updated'], 'safe'],
            [['jumlah_diluluskan'], 'number'],
            [['nama_sue', 'jumlah_dipohon'], 'string', 'max' => 80],
            [['no_kad_pengenalan'], 'string', 'max' => 12],
            [['emel', 'muatnaik'], 'string', 'max' => 100],
            [['catatan'], 'string', 'max' => 255],
            [['bilangan_jkb'], 'string', 'max' => 30],
            [['tempoh'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'permohonan_pelantikan_sue_id' => 'Permohonan Pelantikan Sue ID',
            'nama_sue' => 'Nama SUE',
            'no_kad_pengenalan' => 'No Kad Pengenalan',
            'emel' => 'Emel',
            'jumlah_dipohon' => 'Jumlah Dipohon',
            'nama_persatuan' => 'Nama Persatuan',
            'tarikh_mula_khidmat' => 'Tarikh Mula Khidmat',
            'sehingga' => 'Sehingga',
            'muatnaik' => 'Muatnaik',
            'status_permohonan' => 'Status Permohonan',
            'catatan' => 'Catatan',
            'tarikh_dipohon' => 'Tarikh Dipohon',
            'jumlah_diluluskan' => 'Jumlah Diluluskan',
            'tarikh_kelulusan_jkb' => 'Tarikh Kelulusan JKB',
            'bilangan_jkb' => 'Bilangan JKB',
            'tarikh_lantikan' => 'Tarikh Lantikan',
            'tarikh_tamat_lantikan' => 'Tarikh Tamat Lantikan',
            'tempoh' => 'Tempoh',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created' => 'Created',
            'updated' => 'Updated',
        ];
    }
}
