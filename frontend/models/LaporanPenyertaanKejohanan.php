<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;

/**
 * This is the model class for table "tbl_laporan_penyertaan_kejohanan".
 *
 * @property integer $laporan_penyertaan_kejohanan_id
 * @property integer $penyertaan_sukan_id
 * @property integer $sukan
 * @property integer $nama_kejohanan
 * @property integer $kategori_kejohanan
 * @property integer $status
 * @property string $tarikh_mula
 * @property string $tarikh_tamat
 * @property string $tempat
 * @property string $tarikh_bertolak
 * @property string $tarikh_balik
 * @property string $penginapan
 * @property string $makan
 * @property string $pengangkutan
 * @property string $venue_pertandingan
 * @property string $penyertaan_negara_lain
 * @property string $jadual_pertandingan
 * @property string $ulasan_prestasi
 * @property string $rumusan_prestasi
 * @property string $laporan_kewangan
 * @property string $rumusan
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created
 * @property string $updated
 */
class LaporanPenyertaanKejohanan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_laporan_penyertaan_kejohanan';
    }
    
    public function behaviors()
    {
        return [
            'bedezign\yii2\audit\AuditTrailBehavior',
            [
                'class' => \yii\behaviors\BlameableBehavior::className(),
                'createdByAttribute' => 'created_by',
                'updatedByAttribute' => 'updated_by',
            ],
            [
                'class' => \yii\behaviors\TimestampBehavior::className(),
                'createdAtAttribute' => 'created',
                'updatedAtAttribute' => 'updated',
                'value' => new \yii\db\Expression('NOW()'),
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['penyertaan_sukan_id', 'nama_kejohanan'], 'required'],
            [['penyertaan_sukan_id', 'sukan', 'nama_kejohanan', 'kategori_kejohanan', 'status', 'created_by', 'updated_by'], 'integer'],
            [['tarikh_mula', 'tarikh_tamat', 'tarikh_bertolak', 'tarikh_balik', 'created', 'updated'], 'safe'],
            [['penginapan', 'makan', 'pengangkutan', 'venue_pertandingan', 'penyertaan_negara_lain', 'ulasan_prestasi', 'rumusan_prestasi', 'rumusan'], 'string'],
            [['tempat', 'jadual_pertandingan', 'laporan_kewangan'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'laporan_penyertaan_kejohanan_id' => 'Laporan Penyertaan Kejohanan ID',
            'penyertaan_sukan_id' => 'Penyertaan Sukan ID',
            'sukan' => GeneralLabel::sukan,
            'nama_kejohanan' => GeneralLabel::nama,
            'kategori_kejohanan' => GeneralLabel::kategori,
            'status' => 'Status',
            'tarikh_mula' => GeneralLabel::tarikh_mula,
            'tarikh_tamat' => GeneralLabel::tarikh_tamat,
            'tempat' => GeneralLabel::tempat,
            'tarikh_bertolak' => GeneralLabel::tarikh_bertolak,
            'tarikh_balik' => GeneralLabel::tarikh_balik,
            'penginapan' => GeneralLabel::penginapan,
            'makan' => GeneralLabel::makan,
            'pengangkutan' => GeneralLabel::pengangkutan,
            'venue_pertandingan' => GeneralLabel::venue_pertandingan,
            'penyertaan_negara_lain' => GeneralLabel::penyertaan_negara_lain,
            'jadual_pertandingan' => GeneralLabel::jadual_pertandingan,
            'ulasan_prestasi' => GeneralLabel::ulasan_prestasi,
            'rumusan_prestasi' => GeneralLabel::rumusan_prestasi,
            'laporan_kewangan' => GeneralLabel::laporan_kewangan,
            'rumusan' => GeneralLabel::rumusan,
        ];
    }
}
