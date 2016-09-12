<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_bantuan_penyertaan_pegawai_teknikal_disertai".
 *
 * @property integer $bantuan_penyertaan_pegawai_teknikal_dicadangkan_id
 * @property integer $bantuan_penyertaan_pegawai_teknikal_id
 * @property string $kursus_seminar_bengkel
 * @property string $tarikh_mula
 * @property string $tarikh_tamat
 * @property string $tempat
 * @property string $anjuran
 * @property string $session_id
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created
 * @property string $updated
 */
class BantuanPenyertaanPegawaiTeknikalDisertai extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_bantuan_penyertaan_pegawai_teknikal_disertai';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['kursus_seminar_bengkel', 'tarikh_mula', 'tarikh_tamat', 'tempat', 'anjuran'], 'required'],
            [['bantuan_penyertaan_pegawai_teknikal_id', 'created_by', 'updated_by'], 'integer'],
            [['tarikh_mula', 'tarikh_tamat', 'created', 'updated'], 'safe'],
            [['anjuran'], 'string', 'max' => 80],
            [['tempat'], 'string', 'max' => 90],
            [['session_id'], 'string', 'max' => 100],
            [['kursus_seminar_bengkel'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'bantuan_penyertaan_pegawai_teknikal_dicadangkan_id' => 'Bantuan Penyertaan Pegawai Teknikal Dicadangkan ID',
            'bantuan_penyertaan_pegawai_teknikal_id' => 'Bantuan Penyertaan Pegawai Teknikal ID',
            'kursus_seminar_bengkel' => 'Kejohanan',
            'tarikh_mula' => 'Tarikh Mula',
            'tarikh_tamat' => 'Tarikh Tamat',
            'tempat' => 'Tempat',
            'anjuran' => 'Anjuran',
            'session_id' => 'Session ID',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created' => 'Created',
            'updated' => 'Updated',
        ];
    }
}
