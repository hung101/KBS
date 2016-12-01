<?php

namespace app\models;

use Yii;
use app\models\general\GeneralLabel;

/**
 * This is the model class for table "tbl_bantuan_penyertaan_pegawai_teknikal_oleh_msn".
 *
 * @property integer $bantuan_penyertaan_pegawai_teknikal_oleh_msn_id
 * @property integer $bantuan_penyertaan_pegawai_teknikal_id
 * @property string $kejohanan
 * @property string $tarikh_mula
 * @property string $tarikh_tamat
 * @property string $tempat
 * @property string $status_penganjuran
 * @property string $jumlah_bantuan
 * @property integer $laporan_dikemukakan
 * @property string $session_id
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created
 * @property string $updated
 */
class BantuanPenyertaanPegawaiTeknikalOlehMsn extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_bantuan_penyertaan_pegawai_teknikal_oleh_msn';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bantuan_penyertaan_pegawai_teknikal_id', 'laporan_dikemukakan', 'created_by', 'updated_by'], 'integer'],
            [['kejohanan', 'tarikh_mula', 'tarikh_tamat', 'tempat', 'status_penganjuran', 'jumlah_bantuan', 'laporan_dikemukakan'], 'required'],
            [['tarikh_mula', 'tarikh_tamat', 'created', 'updated'], 'safe'],
            [['jumlah_bantuan', 'status_penganjuran_lain_lain'], 'string', 'max' => 80],
            [['tempat'], 'string', 'max' => 90],
            [['status_penganjuran'], 'string', 'max' => 30],
            [['session_id'], 'string', 'max' => 100],
            [['kejohanan'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'bantuan_penyertaan_pegawai_teknikal_oleh_msn_id' => 'Bantuan Penyertaan Pegawai Teknikal Oleh Msn ID',
            'bantuan_penyertaan_pegawai_teknikal_id' => 'Bantuan Penyertaan Pegawai Teknikal ID',
            'kejohanan' => GeneralLabel::kejohanan,  //'Kejohanan',
            'tarikh_mula' => GeneralLabel::tarikh_mula,  //'Tarikh Mula',
            'tarikh_tamat' => GeneralLabel::tarikh_tamat,  //'Tarikh Tamat',
            'tempat' => GeneralLabel::tempat,  //'Tempat',
            'status_penganjuran' => GeneralLabel::status_penganjuran,  //'Status Penganjuran',
            'jumlah_bantuan' => GeneralLabel::jumlah_bantuan,  //'Jumlah Bantuan',
            'laporan_dikemukakan' => GeneralLabel::laporan_dikemukakan,  //'Laporan Dikemukakan',
            'session_id' => 'Session ID',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created' => 'Created',
            'updated' => 'Updated',
            'status_penganjuran_lain_lain' => GeneralLabel::nyatakan_jika_lain_lain,
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefKelulusan(){
        return $this->hasOne(RefKelulusan::className(), ['id' => 'laporan_dikemukakan']);
    }
}
