<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_bantuan_penganjuran_kursus_oleh_msn".
 *
 * @property integer $bantuan_penganjuran_kursus_oleh_msn_id
 * @property integer $bantuan_penganjuran_kursus_id
 * @property string $kursus_seminar_bengkel
 * @property string $tarikh_mula
 * @property string $tarikh_tamat
 * @property string $tempat
 * @property string $jumlah_bantuan
 * @property integer $laporan_dikemukakan
 * @property string $session_id
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created
 * @property string $updated
 */
class BantuanPenganjuranKursusOlehMsn extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_bantuan_penganjuran_kursus_oleh_msn';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bantuan_penganjuran_kursus_id', 'laporan_dikemukakan', 'created_by', 'updated_by'], 'integer'],
            [['kursus_seminar_bengkel', 'tarikh_mula', 'tarikh_tamat', 'tempat', 'jumlah_bantuan', 'laporan_dikemukakan'], 'required'],
            [['tarikh_mula', 'tarikh_tamat', 'created', 'updated'], 'safe'],
            [['kursus_seminar_bengkel', 'jumlah_bantuan'], 'string', 'max' => 80],
            [['tempat'], 'string', 'max' => 90],
            [['session_id'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'bantuan_penganjuran_kursus_oleh_msn_id' => 'Bantuan Penganjuran Kursus Oleh Msn ID',
            'bantuan_penganjuran_kursus_id' => 'Bantuan Penganjuran Kursus ID',
            'kursus_seminar_bengkel' => 'Kursus / Seminar / Bengkel',
            'tarikh_mula' => 'Tarikh Mula',
            'tarikh_tamat' => 'Tarikh Tamat',
            'tempat' => 'Tempat',
            'jumlah_bantuan' => 'Jumlah Bantuan',
            'laporan_dikemukakan' => 'Laporan Dikemukakan',
            'session_id' => 'Session ID',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created' => 'Created',
            'updated' => 'Updated',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefKelulusan(){
        return $this->hasOne(RefKelulusan::className(), ['id' => 'laporan_dikemukakan']);
    }
}
